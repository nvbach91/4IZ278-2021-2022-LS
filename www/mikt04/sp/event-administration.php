<?php include './include/head.php'; ?>
<?php include './include/nav.php'; ?>

<?php
require_once './database/CategoryDB.php';
require_once './database/EventsDB.php';
require_once './database/ticketDB.php';
require_once './include/check-admin.php';
require_once './include/clean-input.php';

$categoryDB = new CategoryDB();
$categories = $categoryDB->fetchAll();
$eventsDB = new EventsDB();
$ticketDB = new TicketDB();
$messageSuccess = '';
$messageFail = '';
$valid = TRUE;

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $name = cleanInput($_POST['name']);
    $description = cleanInput($_POST['description']);
    $locationName = cleanInput($_POST['location-name']);
    $locationAdress = cleanInput($_POST['location-adress']);
    $urlLink = cleanInput($_POST['url']);
    $date = $_POST['date'];
    $ticketCount = $_POST['ticket-count'];
    $category = $_POST['category'];
    $ticketPrice = $_POST['ticket-price'];

    $categoryId = (int)$category;
    $dateRnd = new DateTime($date);
    $dateFixed = DATE_FORMAT($dateRnd, 'Y-m-d H:i:s');

    if($valid){
        $insertEvent = $eventsDB->insertRow($name, $description, $dateFixed, $locationName, $locationAdress, $urlLink, $categoryId);
        $eventId = $eventsDB->fetchNameById($name);
        $insertTicket = $ticketDB->insertRow($eventId['event_id'], $ticketPrice, $ticketCount);
        $messageSuccess = "Událost založena";
        header("Location: event-administration.php");
    }
}
?>

<main>
    <div class="wrapper">
    <h1 class="page-title">Správa událostí</h1>
    <?php include './include/message.php'?>
        <div class="signup event-admin-create">
            <form class="form-template form-create-event" method="POST">
                <h2>Nová událost</h2>
                <div class="form-label-group">
                    <input type="text" name="name" class="form-control" placeholder="Název události" required autofocus>
                </div>
                <div class="form-label-group">
                    <textarea type="text" name="description" class="form-control input-large" maxlength="255" placeholder="Popis" required autofocus></textarea>
                </div>
                <div class="form-label-group">
                    <input type="datetime-local" name="date" class="form-control" placeholder="Datum" min="2018-01-01" required autofocus>
                </div>
                <div class="form-label-group">
                    <input type="text" name="location-name" class="form-control" placeholder="Místo" required autofocus>
                </div>
                <div class="form-label-group">
                    <input type="text" name="location-adress" class="form-control" placeholder="Adresa" required autofocus>
                </div>
                <div class="form-label-group">
                    <input type="number" name="ticket-count" class="form-control" placeholder="Počet míst" min="1" max="900000"required autofocus>
                </div>
                <div class="form-label-group">
                    <input type="number" name="ticket-price" class="form-control" placeholder="Cena lístku" min="0" min="0" max="10000000" required autofocus>
                </div>
                <div class="form-label-group">
                    <input type="url" name="url" class="form-control" placeholder="URL obrázek" required autofocus>
                </div>
                <div class="form-label-group">
                <p>Kategorie:</p> 
                    <select name="category" id="listBox">
                        <?php foreach($categories as $category):?>
                            <option value=<?php echo $category['category_id']; ?>> <?php echo $category['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="button-2" type="submit">Založit</button>
            </form>
        </div>
    </div>
</main>

<?php include './include/foot.php'; ?>