<?php
session_start();
$alerts = [];


require_once __DIR__ . '/includes/requireAdmin.php';
require_once __DIR__ . '/db/UsersDB.php';
require_once __DIR__ . '/includes/header.php'; 



$usersDB = new UsersDB();
$allUsers= $usersDB -> fetchAll();



?>

<main class="dashboard animals">
    <div class="container">
        <div class="welcome-container">
            <p class="heading">Uživatelé:</p>
            <div class="list-animals">
                    <?php foreach($allUsers as $user): ?>
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <p class="card-heading"><?php echo $user['first_name'];?></p>
                            <p class="card-subheading"><?php echo $user['last_name'];?></p>
                            <p class="card-text">Kredit: <?php echo $user['credit'];?> ,-Kč</p>                
                        </div>
                    </div>
                    <?php endforeach; ?>                  
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>