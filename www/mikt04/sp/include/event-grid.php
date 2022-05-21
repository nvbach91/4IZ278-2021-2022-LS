<?php 
require_once './database/CategoryDB.php';
require_once './database/EventsDB.php';

    $categoryDB = new CategoryDB();
    $categories = $categoryDB->fetchAll();
    $eventsDB = new EventsDB();
    $events = $eventsDB->fetchAll();
    $pageId = '';

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

<div class="filter">
    <?php foreach($categories as $category):?>
        <div class="filter-item">
            <?php echo $category['name'];?>
        </div>
    <?php endforeach ;?>
</div>