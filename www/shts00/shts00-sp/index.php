<?php require_once __DIR__ . '/db/EventDB.php'; ?>
<?php require_once __DIR__ . '/db/CategoryDB.php'; ?>
<?php require_once __DIR__ . '/includes/header.php'; ?>

<?php 
$eventDB = new EventDB();
$events = $eventDB->fetchAll();

if(!empty($_GET['category'])) {

    $id = $_GET['category'];
    $events = $eventDB->fetchByCategory($id);
    if(count($events) === 0) {
        echo '<div class="alert alert-warning" role="alert">
                V dané kategorii momentálně nejsou žádné konference k zobrazení. Zkuste se podívat na všechny dostupné události.
              </div>';
        $events = $eventDB->fetchAll();
    };
}

if(!empty($_GET['success']))
    echo '<div class="alert alert-warning" role="alert">
            Nyní jste přihlášen
            </div>';
?>

<?php if (!empty($_GET['success'])): ?>
    <div class="alert alert-warning" role="alert">Nyní jste přihlášen</div>
<?php endif;?>

<div class="container">
    <div class="row">
        <?php foreach($events as $event) : ?>
            <div class="col-md">
                <div class="card" style="width: 26rem;">
                    <img class="card-img-top" src="img/conference.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $event['name']; ?></h5>
                        <p class="card-text"><?php echo $event['description']; ?></p>
                        <?php echo '<a class="btn btn-primary" href="https://eso.vse.cz/~shts00/shts00-sp/detail.php?id=' . $event['event_id']  . '" >Vstupenky</a>' ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>