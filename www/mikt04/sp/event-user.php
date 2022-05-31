<?php include './include/head.php'; ?>
<?php include './include/nav.php'; ?>

<?php
require_once './database/EventsDB.php';
require_once './database/TicketDB.php';
require_once './database/UserTicketDB.php';
require_once './database/VTicketEventDB.php';
require_once './include/check-login.php';


$eventsDB = new EventsDB();
$ticketDB = new TicketDB();
$vTicketEventDB = new VTicketEventDB();
$message = "";

$userTickets = $vTicketEventDB->fetchAllByUserId($userId);
$usedEvents = [];
?>

<main>
  <div class="wrapper">
    <h1 class="page-title">Lístky</h1>
    <div class="tickets-container">
      <?php foreach($userTickets as $userTicket):?>
        <?php if(!in_array($userTicket['name'], $usedEvents)):?>
          <div class="ticket-section">
            <h2 class="ticket-item"><?php echo $userTicket['name'] . ' - ' . date('Y/m/d', strtotime($userTicket['start_date'])); ?></h2>
            <?php array_push($usedEvents, $userTicket['name']);?>
          </div>
        <?php endif;?>
          <div class="ticket-block">
              <img class="ticket-item" src="<?php echo "./img/qrcodes/ticket-e-".$userTicket['event_id'] . '-'. $userTicket['code'] . ".png";?>" alt="qr-ticket">
              <h3 class="ticket-item">Datum: <span class="body-message"><?php echo date('Y/m/d', strtotime($userTicket['start_date']))?></span></h3>
              <h3 class="ticket-item">Čas: <span class="body-message"><?php echo date('H:i', strtotime($userTicket['start_date']))?></span></h3>
              <a class="ticket-item ticket-link" href="sp/event-buy.php?udalost=<?php echo $userTicket['event_id']?>">Odkaz na akci</a>
          </div>
      <?php endforeach ;?>
    </div>
  </div>
</main>

<?php include './include/foot.php'; ?>