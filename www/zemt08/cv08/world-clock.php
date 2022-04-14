<?php
$pragueTime = new DateTime('', new DateTimeZone('Europe/Prague'));
$pragueTimeForm = date_format($pragueTime, 'H:i:s d.m.Y e');
$pragueDiff = $pragueTime->getOffset() / 3600 - $pragueTime->getOffset() / 3600;

$melbourneTime = new DateTime('', new DateTimeZone('Australia/Melbourne'));
$melbourneTimeForm = date_format($melbourneTime, 'H:i:s d/m/Y e');
$melbourneDiff = $melbourneTime->getOffset() / 3600 - $pragueTime->getOffset() / 3600;

$londonTime = new DateTime('', new DateTimeZone('Europe/London'));
$londonTimeForm = date_format($londonTime, 'H:i:s d/m/Y e');
$londonDiff = $londonTime->getOffset() / 3600 - $pragueTime->getOffset() / 3600;

$fijiTime = new DateTime('', new DateTimeZone('Pacific/Fiji'));
$fijiTimeForm = date_format($fijiTime, 'H:i:s Y/d/m e');
$fijiDiff = $fijiTime->getOffset() / 3600 - $pragueTime->getOffset() / 3600;

$dakarTime = new DateTime('', new DateTimeZone('Africa/Dakar'));
$dakarTimeForm = date_format($dakarTime, 'H:i:s d.m.Y e');
$dakarDiff = $dakarTime->getOffset() / 3600 - $pragueTime->getOffset() / 3600;




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
        <h2>Melbourne</h2>
        <p>
            Datetime: <?php echo $melbourneTimeForm; ?>
        </p>
        <p>
            Prague difference: <?php echo $melbourneDiff; ?> hours
        </p>
    </div>

    <div>
        <h2>London</h2>
        <p>
            Datetime: <?php echo $londonTimeForm; ?>
        </p>
        <p>
            Prague difference: <?php echo $londonDiff; ?> hours
        </p>
    </div>

    <div>
        <h2>Fiji</h2>
        <p>
            Datetime: <?php echo $fijiTimeForm; ?>
        </p>
        <p>
            Prague difference: <?php echo $fijiDiff; ?> hours
        </p>
    </div>

    <div>
        <h2>Dakar</h2>
        <p>
            Datetime: <?php echo $dakarTimeForm; ?>
        </p>
        <p>
            Prague difference: <?php echo $dakarDiff; ?> hours
        </p>
    </div>
</main>
<?php include __DIR__ . '/incl/footer.php'; ?>