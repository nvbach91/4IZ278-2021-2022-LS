<?php
session_start();

require './database/CategoryDB.php';

$categoryDB = new CategoryDB();
$categories = $categoryDB->fetchAll();

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $name = $_POST['name'];
    $descriptioj = $_POST['description'];
    $date = $_POST['date'];
    $locationName = $_POST['location-name'];
    $locationAdress = $_POST['location-adress'];
    $ticketCount = $_POST['ticket-count'];
    $category = $_POST['category'];
    $valid = TRUE;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo ('Invalid email');
        $valid = FALSE;
    }

    if (strlen($password) < 3) {
        echo ('Password must be at least 3 characters long');
        $valid = FALSE;
    }
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
                    <input type="date" name="date" class="form-control" placeholder="Datum" required autofocus>
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