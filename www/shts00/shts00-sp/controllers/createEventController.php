<?php require_once __DIR__ . '/../db/EventDB.php'; ?>
<?php require_once __DIR__ . '/../db/OrganizerDB.php'; ?>
<?php require_once __DIR__ . '/../db/TicketDB.php'; ?>
<?php require_once __DIR__ . '/../db/VenueDB.php'; ?>
<?php require_once __DIR__ . '/../db/CategoryToEventDB.php'; ?>

<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$errors = [];

if(!empty($_POST))
{
    $name = $_POST['name'];
    $description = $_POST['description'];
    $categories = $_POST['category']; //odkaz na CategoryDB
    $venue =$_POST['venue']; //odkaz na VenueDB
    $organizer =$_POST['organizer']; //odkaz na OrganizerDB
    $date = strtotime($_POST['date']);
    $capacity = $_POST['capacity'];
    $price =$_POST['price'];

    if(!empty($_POST['openForSale'])){
        $openForSale =$_POST['openForSale'];
    } else {
        $openForSale = 0;
    }

    if(strlen($name) < 3) {
        array_push($errors, 'Název musí mít aspoň 3 znaky');
    }

    if(strlen($description) < 3) {
        array_push($errors, 'Popis musí mít aspoň 3 znaky');
    }

    if(empty($venue)) {
        array_push($errors, "Vyberte místo konání akce");
    }

    if(empty($categories)) {
        array_push($errors, "Zvolte aspoň jednu kategorii");
    }

    if(empty($organizer)) {
        array_push($errors, "Zvolte pořadatele");
    }

    if ($date && ($date > date('Y-m-d'))) {
        $date = date('Y-m-d', $date);
    } 
    else {
        array_push($errors, "Zadejte validní datum konání.");
    }
    
    //check if capacity is not bigger than max_capacity of a venue
    $venueDB = new VenueDB();
    $venueInstance = $venueDB->fetchById(intval($venue))[0];
    $maxCapacity = intval($venueInstance['max_capacity']);

    if (!is_numeric($capacity) || (intval($capacity) > $maxCapacity)) {
        array_push($errors, "Chybně zadaná kapacita. Zkontrolujte maximální kapacitu tohoto prostoru");
    }

    if(!count($errors)) 
    {
        // create new organizer
        $organizerDB = new OrganizerDB();
        $argsOrg=[
            'name'=>$organizer,
            'description'=>""
        ];
        $organizerDB->create($argsOrg);

        // fetching Ids
        $newOrganizer = $organizerDB->fetchMaxId()[0];
        $newOrganizerId = $newOrganizer['organizer_id'];

        // create new event
        $eventDB = new EventDB();
        $argsEvt=[
            'name'=>$name,
            'description'=>$description,
            'date'=>$date,
            'capacity'=>$capacity,
            'organizer_id'=>$newOrganizerId,
            'venue_id'=>$venue,
            'open_for_sale'=>$openForSale
        ];
        $eventDB->create($argsEvt);
 
        $newEvent = $eventDB->fetchMaxId()[0];
        $newEventId = $newEvent['event_id'];

        //create category to event
        foreach($categories as $categoryId){
            $catToEventDB = new CategoryToEventDB();
            $argsCTE=[
                'category_id'=>$categoryId,
                'event_id'=>$newEventId
            ];
            $catToEventDB->create($argsCTE);
        }

        //create tickets
        for($i = 1; $i <= $capacity; $i++) {
            $ticketDB = new TicketDB();
            $argsTicket=[
                'seat'=>null,
                'row'=>null,
                'price'=>$price,
                'event_id'=>$newEventId,
                'order_item_id'=>null
            ];
            $ticketDB->create($argsTicket);
        }

        $_SESSION['addevent_errors'] = [];
        header('Location: https://eso.vse.cz/~shts00/shts00-sp/editOrAddEvent.php?success=1');
        exit();
    }
    else {
        $_SESSION['addevent_errors'] = $errors;
        header('Location: ../editOrAddEvent.php?error=1');
        exit();
    }
}

?>