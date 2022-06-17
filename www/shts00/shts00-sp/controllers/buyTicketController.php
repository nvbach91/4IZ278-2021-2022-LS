<?php require_once __DIR__ . '/../db/OrderItemDB.php'; ?>
<?php require_once __DIR__ . '/../db/EventDB.php'; ?>
<?php require_once __DIR__ . '/../db/OrderDB.php'; ?>
<?php require_once __DIR__ . '/../db/TicketDB.php'; ?>

<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$errors = [];

if(!empty($_POST))
{
    if(!empty($_SESSION['user_id'])){
        $userId = $_SESSION['user_id'];
    } else {
        header('Location: ../signin.php?error=2');
        exit();
    }
    
    $eventId = $_POST['event_id'];
    $count = intval($_POST['count']);

    $eventDB = new EventDB();
    $eventEntity = $eventDB->fetchById($eventId)[0];

    //check if an event is available for sale
    $availability = intval($eventEntity['open_for_sale']);
    if($availability == 0) {
        header('Location: ../detail.php?id=' . $eventId . '&error=2');
        exit();
    }

    if(empty($eventId)) {
        array_push($errors, 'Konference neexistuje');
    }

    if($count <= 0) {
        array_push($errors, 'Vyberte počet vstupenek');
    }

    if(!count($errors)) 
    {
        try{
            $tickets = $eventDB->fetchTicketByEventId($eventId);

            if(!empty($tickets)){
                $ticket = $tickets[0];
                $price = intval($ticket["price"]);
            } else {
                $price = 0;
            }

            $total_price =  $price * $count;

            // create new order
            $orderDB = new OrderDB();
            $argsOrder = [
                'total_price'=>$total_price,
                'date'=>date('Y-m-d'),
                'user_id'=>$userId,
                ];
            $orderDB->create($argsOrder);
            
            //get new order's id
            $newOrder = $orderDB->fetchMaxId()[0];
            $newOrderId = $newOrder['order_id'];
            
            // create new order items
            foreach($tickets as $ticket) {
                for($i = 1; $i <= $count; $i++) {
                    $orderItemDB = new OrderItemDB();
                    $argsOI=[
                        'price'=>strval($price),
                        'order_id'=>$newOrderId,
                        ];
                    $orderItemDB->create($argsOI);
                    }
                    
                    //update event capacity to lower
                    $event = $eventDB->fetchById($eventId)[0];
                    $oldCapacity = $event['capacity'];
                    $newCapacity = intval($oldCapacity) - 1;
                    $eventDB->updateById($eventId, 'capacity', $newCapacity);

                    if($event['capacity'] == 0) {
                        $eventDB->updateById($eventId, 'open_for_sale', 0);
                    }

                    //get id of a new orderItem instance
                    $newOrderItem = $orderItemDB->fetchMaxId()[0];
                    $newOrderItemId = $newOrderItem['order_item_id'];

                    //update ticket with adding order_item_id
                    $ticketDB = new TicketDB();
                    $ticketDB->updateById($ticket['ticket_id'], 'order_item_order_item_id', $newOrderItemId);
                }   
            
            $_SESSION['buyticket_errors'] = [];
            header('Location: ../succeedPayment.php');
            exit();
        }  
        catch(Exception $ex) {
            header('Location: ../detail.php?id=' . $eventId . '&error=1');
            exit();
        }
    }
    else {
        $_SESSION['buyticket_errors'] = $errors;
        header('Location: ../detail.php?id=' . $eventId );
        exit();
    }    
}
?>