<?php 
require_once './database/EventsDB.php';

$eventsDB = new EventsDB();
$events = $eventsDB->fetchAll();
$nItemsPerPagination = 6;
$count = count($events);
$pageId = '';
$address = '';
$offset = 0;

if (isset($_REQUEST['offset']) && !empty($_REQUEST['offset'])) {
    $offset = (int)$_GET['offset'];
} else {
    $offset = 0;
}

if (isset($_REQUEST['category_id']) && !empty($_REQUEST['category_id']))
{
    $categoryId = $_REQUEST['category_id'];
    //$events = $eventsDB->fetchByCategoryId($categoryId);
    $events = $eventsDB->fetchOrderById($categoryId, $nItemsPerPagination, $offset);
    $address = "category_id=$categoryId";
    $count = count($eventsDB->fetchByCategoryId($categoryId));
}  else {
    $events = $eventsDB->fetchAllPagination($nItemsPerPagination, $offset);
    $address = '';
}

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $pageId = $_POST['button-id'];
    header("Location: ./event-buy.php?udalost=$pageId");
}
?>

<div class="event-grid">
<?php foreach($events as $event): ?>
    <div class="event">
        <img class="event-cover" src="<?php echo $event['image_url']?>" alt="event-cover">
        <h3 class="event-title"><?php echo $event['name']?></h3>
        <form method="POST" >
            <button name="button-id" value="<?php echo $event['event_id']?>" class="event-button">Koupit lístek</button>
        </form>
    </div>
<?php endforeach?>
</div>
<div class="pagination">
    <?php for ($i = 1; $i <= ceil($count / $nItemsPerPagination); $i++) { ?>
        <a class="<?php echo $offset / $nItemsPerPagination + 1 == $i ? "page active-page" : "page not-active-page"; ?>" href="./index.php?offset=<?php echo ($i - 1) * $nItemsPerPagination . '&' . $address;?>">
            <?php echo $i;?>
        </a>
    <?php } ?>
</div>