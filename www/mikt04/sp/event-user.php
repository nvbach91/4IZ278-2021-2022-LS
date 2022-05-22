<?php include './include/head.php'; ?>
<?php include './include/nav.php'; ?>


<?php
require_once './database/EventsDB.php';
require_once './database/ticketDB.php';
require_once './database/UserTicketDB.php';
require_once './include/check-login.php';


$eventsDB = new EventsDB();
$ticketDB = new TicketDB();
$userTicketDB = new UserTicketDB();
$message = "";

$userTickets = $userTicketDB->fetchAllByUserId($userId);
?>

<main>
  <div class="wrapper">
    <div class="tickets-container">
      <?php foreach($userTickets as $userTicket):?>
          <div class="ticket-item">
              <h2><?php echo $userTicket['user_ticket_id'] ?></h2>
              <img src="<?php echo "./img/qrcodes/ticket-e-".$userTicket['event_id'] . '-'. $userTicket['code'] . ".png";?>" alt="">
          </div>
      <?php endforeach ;?>
    </div>
  </div>
</main>

<?php include './include/foot.php'; ?>