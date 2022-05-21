<?php include './include/head.php'; ?>
<?php include './include/nav.php'; ?>

<?php 
require_once './database/EventsDB.php';
require_once './database/ticketDB.php';

$eventsDB = new EventsDB();
$ticketDB = new TicketDB();
$information = "";

if (isset($_REQUEST['udalost']) && !empty($_REQUEST['udalost']))
$eventId = $_REQUEST['udalost'];

if (!empty($_POST)) {
  $information = "Lístek koupen";
}

$event = $eventsDB->fetchById($eventId);
?>


<main>
  <div class="wrapper">
    <div class="event-container">
      <?php if(strlen(trim($information)) > 0) { echo '<p class="success">' . $information . '</p>';}?>
      <div class="event-menu">
        <div class="event-heading">
          <h1 class="event-title"><?php echo $event['name']?></h1>
          <h2 class="event-subtitle"><?php echo $event['start_date']?><h2>
        </div>
        <div class="event-image-container">
          <img class="event-image" src="<?php echo $event['image_url']?>" alt="event-cover">
        </div>
        </div>
        <div class="event-body">
          <div class="event-body-description">
            <h3>Informace:</h3>
            <p><?php echo $event['description']?></p>
          </div>
          <div class="event-body-information">
            <h3>Datum: <span class="body-information"><?php echo date('Y/m/d', strtotime($event['start_date']))?></span></h3>
            <h3>Čas: <span class="body-information"><?php echo date('H:i', strtotime($event['start_date']))?></span></h3>
            <h3>Místo: <span class="body-information"><?php echo $event['location_name']?></span></h3>
            <h3>Adresa: <span class="body-information"><?php echo $event['location_adress']?></span></h3>
            <h3>Kapacita: <span class="body-information"><?php echo $event['ticket_count']?> míst</span></h3>
          </div>
        </div>
        <div class="event-registration">
          <form class="form-template-2" method="POST">
            <h2>Nákup lístku</h2>
                <div class="form-label-group">
                    <textarea type="text" name="text" class="form-control" placeholder="Doplňující informace"></textarea>
                </div>
                <button id="buy" type="submit" class="button-3">Koupit</button>
            </form>
        </div>
    </div>
  </div>
</main>

<?php include './include/foot.php'; ?>