<?php require_once __DIR__ . '/includes/header.php'; ?>
<?php require_once __DIR__ . '/db/EventDB.php'; ?>
<?php require_once __DIR__ . '/db/VenueDB.php'; ?>
<?php require_once __DIR__ . '/controllers/buyTicketController.php'; ?>

<?php
$event;

if(!empty($_GET['id'])) {

    $id = $_GET['id'];
    
    $eventDB = new EventDB();
    $eventArr = $eventDB->fetchById($id);
    if(empty($eventArr)) {
        echo '<div class="alert alert-danger" role="alert">
                Něco se pokazilo. Zkuste dotaz opakovat, případně se obrátit na správce.
              </div>';
    }
    else {
        $event = $eventArr[0];
        $price = $eventDB->fetchTicketByEventId($id);

        $venueDB = new VenueDB();
        $venue = $venueDB->fetchByEventId($id)[0];

        $ticket = $eventDB->fetchTicketByEventId($event['event_id']);
        if(!empty($ticket)) {
            $price = $ticket[0]["price"];
        } else {
            $price = 0;
        }

        $availability = "";
        if($event["open_for_sale"] == 1) {
            $availability = "Lístky jsou v prodeji";
        } 
        else if ($event["open_for_sale"] == 0) {
            $availability = "Lístky nejsou momentálně v prodeji";
        }
    }  
}   
?>

<?php
 $errors = [];

 if(!empty($_SESSION['buyticket_errors'])){
     $errors = $_SESSION['buyticket_errors'];
 
     //po prvnim zobrazeni warningy vyprazdnime
     $_SESSION['buyticket_errors'] = [];
 }
?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger" role="alert">
        <?php foreach ($errors as $error): ?>
            <p><?php echo $error; ?></p>
        <?php endforeach;?>
    </div>
<?php endif;?>

<?php if (!empty($_GET['error']) && ($_GET['error'] == 1)): ?>
    <div class="alert alert-danger" role="alert">Něco se pokazilo a nákup se nepovedl. Zkuste prosím znovu</div>
<?php endif;?>

<?php if (!empty($_GET['error']) && ($_GET['error'] == 2)): ?>
    <div class="alert alert-danger" role="alert">Lístky nejsou momentálně v prodeji.</div>
<?php endif;?>

<div class="container">
    <div class="row">
    <div class="col-md-9">
        <?php 
        if(!empty($event)) {
            echo '<h2>' . $event["name"] . '</h2>
                  <p>' . $event["description"] . '</p>
                  <p>' . date("d.m.Y", strtotime($event['date'])) . '</p>
                  <p>' . $venue["name"] . ', ' . $venue["address"] . '</p>
                  <p>' . $availability . '</p>
                  <p>Vstupné: ' . $price . ' Kč</p>';

        }
        ?>
    </div>
    <div class="col-md-3">
    <?php
        if(!empty($event)) {
            echo '<p>Počet vstupenek</p>
                <form method="post" action="controllers/buyTicketController.php">
                  <input type="hidden" name="event_id" id="event_id" value="' . $event['event_id'] . '">
                  <input type="number" name="count" id="count" class="form-control" value="1" min="1" max="' . $event["capacity"] . '" step="1" />
                  <button type="submit" class="btn btn-primary">Koupit</button>
                </form>'; 
        }
    ?>
    </div>
  </div>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

 