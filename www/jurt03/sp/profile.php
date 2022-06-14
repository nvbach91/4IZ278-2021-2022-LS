<?php
session_start();

require_once __DIR__ . '/includes/requireUser.php';

 if (isset($_GET['passwordChanged'])) {
    $passwordChanged = (int)$_GET['passwordChanged'];
} else {
    $passwordChanged = 0;
}

require_once __DIR__ . '/db/UsersDB.php';
require_once __DIR__ . '/db/AnimalsDB.php';
require_once __DIR__ . '/db/DonationsDB.php';
require_once __DIR__ . '/includes/header.php'; 



$usersDB = new UsersDB();
$loggedUser = $usersDB->fetchById($_SESSION['user_id'])[0];

$donationsDB = new DonationsDB();
$usersDonations = $donationsDB->fetchByUser($_SESSION['user_id']);

//pro ziskani jmena zvirete v donations. Nasledne pouzito pri vypisu transakci nize.
$animalsDB = new AnimalsDB();

?>

<main class="dashboard animals">
    <div class="container">
    <?php if($passwordChanged): ?>
        <div class="welcome-container signedOut">
            Password was changed!
        </div>
        <?php endif;?>
        <div class="welcome-container">
    <section class="section about-section gray-bg" id="about">
            
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-lg-6">
                        <div class="about-text go-to">
                            <h3 class="dark-color"><?php echo $loggedUser['first_name'] . ' ' . $loggedUser['last_name'];?></h3>
                            <h6 class="theme-color lead">
                                <?php if($loggedUser['is_admin']): ?>
                                    <?php echo "Administrátor"; ?>
                                    <?php endif; ?>
                                    <?php if(!$loggedUser['is_admin']): ?>
                                    <?php echo "Uživatel"; ?>
                                    <?php endif; ?>
                            </h6>
                            
                            <div class="row about-list">
                                <div class="col-md-6">
                                    <div class="media">
                                        <label>Adresa</label>
                                        <p><?php echo $loggedUser['address']; ?></p>
                                    </div>
                                    <div class="media">
                                        <label>Město</label>
                                        <p><?php echo $loggedUser['city']; ?></p>
                                    </div>
                                    <div class="media">
                                        <label>Země</label>
                                        <p><?php echo $loggedUser['state']; ?></p>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="media">
                                        <label>E-mail</label>
                                        <p><?php echo $loggedUser['email']; ?></p>
                                    </div>
                                    <div class="media">
                                        <label>Telefon</label>
                                        <p><?php echo $loggedUser['phone']; ?></p>
                                    </div>
                                    <div class="media">
                                        <a href="editUser.php"><button type="button" class="btn btn-info">Změnit heslo</button></a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-avatar">
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" title="" alt="">
                        </div>
                    </div>
                </div>
                <div class="counter">
                    <div class="row">
                        <div class="col-sm">
                            <div class="count-data text-center">
                                <h6 class="count h2" data-to="500" data-speed="500"><?php echo $loggedUser['credit']; ?> ,-Kč</h6>
                                <p class="m-0px font-w-600">Kredit</p>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="count-data text-center">
                                <h6 class="count h2" data-to="150" data-speed="150"><?php echo $loggedUser['donated']; ?> ,-Kč</h6>
                                <p class="m-0px font-w-600">Darováno</p>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="count-data text-center">
                                <h6 class="count h2" data-to="850" data-speed="850"><?php echo count($usersDonations);?></h6>
                                <p class="m-0px font-w-600">Počet darování</p>
                            </div>
                        </div>
                        
                        </div>
                    </div>
                    
                    
                </div>
            
        </section>
        <div class="welcome-container">
        <p class="heading">Historie transakcí:</p> 
    <div class="list-group">
     
     <?php foreach($usersDonations as $userDonation): ?>
        <?php $donatedAnimal = $animalsDB->fetchById($userDonation['animal_id'])[0]; ?>
                    <p class="zooItem"><?php echo $userDonation['value'] . ',-Kč dne '. $userDonation['date']. ' zvířeti ' . $donatedAnimal['animal_name']. ' se jménem '. $donatedAnimal['nickname'] . ' a vzkazem: ' . $userDonation['description']; ?></p>
                    <?php endforeach; ?>
    </div>
    

</div>
</div>




    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>