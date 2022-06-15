<?php require_once __DIR__ . '/../db/VenueDB.php'; ?>

<?php 
session_start();
$errors = [];

if(!empty($_POST))
{
    $name = $_POST['name'];
    $address =$_POST['address'];
    $city =$_POST['city'];
    $max_capacity =$_POST['max_capacity'];


    if(strlen($name) < 3) {
        array_push($errors, 'Název musí mít aspoň 3 znaky');
    }

    if(strlen($address) < 3) {
        array_push($errors, 'Adresa musí mít aspoň 3 znaky');
    }

    if(strlen($city) < 2) {
        array_push($errors, 'Město musí mít aspoň 3 znaky');
    }

    if (!is_numeric($max_capacity)) {
        array_push($errors, "Enter a valid number of seats");
    }

    if(!count($errors)) 
    {
        $venueDB = new VenueDB();
        $args=[
        'name'=>$name,
        'address'=>$address,
        'city'=>$city,
        'max_capacity'=>$max_capacity
        ];

        $venueDB->create($args);

        $_SESSION['addvenue_errors'] = [];
        header('Location: ../editOrAddVenue.php?success=1.php');
        exit();

    } else {
        $_SESSION['addvenue_errors'] = $errors;
        header('Location: ../editOrAddVenue.php');
        exit();
    }
    
}  

?>