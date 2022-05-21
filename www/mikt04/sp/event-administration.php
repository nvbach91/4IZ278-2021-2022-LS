<?php
session_start();

require_once './database/CategoryDB.php';
require_once './database/EventsDB.php';
require_once './database/ticketDB.php';

$categoryDB = new CategoryDB();
$categories = $categoryDB->fetchAll();
$eventsDB = new EventsDB();
$ticketDB = new TicketDB();

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $locationName = $_POST['location-name'];
    $locationAdress = $_POST['location-adress'];
    $ticketCount = $_POST['ticket-count'];
    $urlLink = $_POST['url'];
    $category = $_POST['category'];
    $ticketPrice = $_POST['ticket-price'];

    $categoryId = (int)$category;
    $dateRnd = new DateTime($date);
    $dateFixed = DATE_FORMAT($dateRnd, 'Y-m-d H:i:s'); 
    $valid = TRUE;

    /*
    $name = "Pubquiz";
    $description = "Popis";
    $date = "2022-05-24T15:03";
    $locationName = "Praha";
    $locationAdress = "Ulice 123/10";
    $ticketCount = 60;
    $urlLink = "www.example.com";
    $category = "5";
    */
    //2022-05-24T15:03

    $insertEvent = $eventsDB->insertRow($name, $description, $dateFixed, $locationName, $locationAdress, $ticketCount, $urlLink, $categoryId);
    $eventId = $eventsDB->fetchNameById($name);
    $insertTicket = $ticketDB->insertRow($eventId['event_id'], $ticketPrice);
    echo "inserted";
}
?>

<?php include './include/head.php'; ?>
<?php include './include/nav.php'; ?>

<main>
    <div class="wrapper">
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
                    <input type="datetime-local" name="date" class="form-control" placeholder="Datum" required autofocus>
                </div>
                <div class="form-label-group">
                    <input type="text" name="location-name" class="form-control" placeholder="Místo" required autofocus>
                </div>
                <div class="form-label-group">
                    <input type="text" name="location-adress" class="form-control" placeholder="Adresa" required autofocus>
                </div>
                <div class="form-label-group">
                    <input type="number" name="ticket-count" class="form-control" placeholder="Počet míst" required autofocus>
                </div>
                <div class="form-label-group">
                    <input type="number" name="ticket-price" class="form-control" placeholder="Cena lístku" required autofocus>
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