<?php
$pragueTime = new DateTime('', new DateTimeZone('Europe/Prague'));
$pragueTimeForm = date_format($pragueTime, 'H:i:s d.m.Y e');
$pragueDiff = $pragueTime->getOffset() / 3600 - $pragueTime->getOffset() / 3600;

$newfoundlandTime = new DateTime('', new DateTimeZone('Canada/Newfoundland'));
$newfoundlandTimeForm = date_format($newfoundlandTime, 'h:i:s m/d/y e');
$newfoundlandDiff = $newfoundlandTime->getOffset() / 3600 - $pragueTime->getOffset() / 3600;

$chungkingTime = new DateTime('', new DateTimeZone('Asia/Chungking'));
$chungkingTimeForm = date_format($chungkingTime, 'h:i:s y-m-d e');
$chungkingDiff = $chungkingTime->getOffset() / 3600 - $pragueTime->getOffset() / 3600;

$caseyTime = new DateTime('', new DateTimeZone('Antarctica/Casey'));
$caseyTimeForm = date_format($caseyTime, 'h:i:s y-m-d e');
$caseyDiff = $caseyTime->getOffset() / 3600 - $pragueTime->getOffset() / 3600;

$easterTime = new DateTime('', new DateTimeZone('Pacific/Easter'));
$easterTimeForm = date_format($easterTime, 'h:i:s m/d/y e');
$easterDiff = $easterTime->getOffset() / 3600 - $pragueTime->getOffset() / 3600;
?>
<?php include __DIR__ . '/incl/header.php'; ?>
<?php include __DIR__ . '/incl/navbar.php'; ?>

<main class="container">
    <h1>World clock</h1>
    <div>
        <h2>Prague</h2>
        <p>
            Datetime: <?php echo $pragueTimeForm; ?>
        </p>
        <p>
            Prague difference: <?php echo $pragueDiff; ?> hours
        </p>
    </div>
    <div>
        <h2>Newfoundland</h2>
        <p>
            Datetime: <?php echo $newfoundlandTimeForm; ?>
        </p>
        <p>
            Prague difference: <?php echo $newfoundlandDiff; ?> hours
        </p>
    </div>
    <div>
        <h2>Chungking</h2>
        <p>
            Datetime: <?php echo $chungkingTimeForm; ?>
        </p>
        <p>
            Prague difference: <?php echo $chungkingDiff; ?> hours
        </p>
    </div>
    <div>
        <h2>Casey</h2>
        <p>
            Datetime: <?php echo $caseyTimeForm; ?>
        </p>
        <p>
            Prague difference: <?php echo $caseyDiff; ?> hours
        </p>
    </div>
    <div>
        <h2>Easter</h2>
        <p>
            Datetime: <?php echo $easterTimeForm; ?>
        </p>
        <p>
            Prague difference: <?php echo $easterDiff; ?> hours
        </p>
    </div>
    <div style="margin-bottom: 600px"></div>
</main>
<?php include __DIR__ . '/incl/footer.php'; ?>