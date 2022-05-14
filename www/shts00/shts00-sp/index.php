<?php require_once __DIR__ . '/db/EventDB.php'; ?>
<?php require_once __DIR__ . '/includes/header.php'; ?>

<?php 
$eventDB = new EventDB();
$events = $eventDB->fetchAll();
?>

<div class="container">
    <div class="row">
        <?php foreach($events as $event) : ?>
            <div class="col-md">
                <div class="card" style="width: 26rem;">
                    <img class="card-img-top" src="img/conference.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $event['name']; ?></h5>
                        <p class="card-text"><?php echo $event['description']; ?></p>
                        <a href="#" class="btn btn-primary">Vstupenky</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>