<?php include './include/head.php'; ?>
<?php include './include/nav.php'; ?>
<?php include "./lib/phpqrcode/qrlib.php"; ?>

<?php require_once './database/EventsDB.php';?>
<?php require_once './database/TicketDB.php';?>
<?php require_once './database/UserTicketDB.php';?>
<?php require_once './include/check-capacity.php';?>
<?php require_once './include/clean-input.php';?>
<?php require_once './include/send-email.php';?>

<?php
$eventsDB = new EventsDB();
$ticketDB = new TicketDB();
$userTicketDB = new UserTicketDB();
$messageSuccess = '';
$messageFail = '';

if (isset($_REQUEST['udalost']) && !empty($_REQUEST['udalost']))
$eventId = $_REQUEST['udalost'];
$emailAdress = $_COOKIE["email"];

$event = $eventsDB->fetchById($eventId);
$ticket = $ticketDB->fetchByEventId($eventId);

if (!empty($_POST)) {
  $salt = mt_rand(10000, 99999);
  $ticket_hash_code = strtoupper(md5($salt . "-". $userId . "-". $eventId));
  QRcode::png("ticket-e-$eventId-$ticket_hash_code", "./img/qrcodes/ticket-e-$eventId-$ticket_hash_code.png"); // creates qr code

  $success = $userTicketDB->insertRow($ticket['ticket_id'], $userId , $ticket_hash_code);

  if($success){
    $messageSuccess = 'Lístek zakoupen. Podrobnosti byly zaslány emailem.';
    $subject = 'Váš lístek na ' . $event['name'] ;
    $message = 'Váš lístek na akci ' . $event['name'] . ' je ' . $ticket_hash_code . '. QR kód naleznete po přihlášení v sekci lístky.';
    sendEmail($emailAdress, $subject, $message);
  }
  if(!$success){
    $messageFail = 'Lístek se nepodařilo zakoupit.';
  }
}
?>

<main>
  <div class="wrapper">
    <div class="event-container">
      <?php if(strlen(trim($messageSuccess)) > 0) { echo '<p class="success">' . $messageSuccess . '</p>';}?>
      <?php if(strlen(trim($messageFail)) > 0) { echo '<p class="fail">' . $messageFail . '</p>';}?>
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
          <div class="event-body-message">
            <h3>Datum: <span class="body-message"><?php echo date('Y/m/d', strtotime($event['start_date']))?></span></h3>
            <h3>Čas: <span class="body-message"><?php echo date('H:i', strtotime($event['start_date']))?></span></h3>
            <h3>Místo: <span class="body-message"><?php echo $event['location_name']?></span></h3>
            <h3>Adresa: <span class="body-message"><?php echo $event['location_adress']?></span></h3>
            <h3>Kapacita: <span class="body-message"><?php echo $ticket['capacity']?> </span></h3>
          </div>
        </div>

        <?php if (isset($_SESSION['user_id'])) {
          if (!checkCapacity($eventId)) {
            include './include/html/event-registration-buy.php';
          } else {
            include './include/html/event-registration-full.php';
          }
          } else {
            include './include/html/event-registration-denied.php';
          }?>
    </div>
  </div>
</main>

<?php include './include/foot.php'; ?>