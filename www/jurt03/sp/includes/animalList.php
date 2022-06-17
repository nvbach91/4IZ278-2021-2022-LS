<?php 
require_once __DIR__ . '../db/UsersDB.php';
$usersDB = new UsersDB();
$loggedUser = $usersDB->fetchById($_SESSION['user_id'])[0];
?>

<div class="welcome-container">
            <div class="animalList">
                <p class="heading">Zvířata, pro která aktuálně vybíráme peníze</p>
                <div class="list-animals">
                    <?php foreach($animals as $animal): ?>
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="<?php echo $animal['image'];?>" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-heading"><?php echo $animal['nickname'];?></p>
                                <p class="card-subheading"><?php echo $animal['animal_name'];?></p>
                                <p class="card-text"><?php echo $animal['description'];?></p>
      
                            </div>
                            <?php if($loggedUser['credit'] > 0): ?>
                                <a href="donation.php" class="btn btn-primary">Darovat</a>
                             <?php endif;?>   
                            
                            <?php if($loggedUser['is_admin']): ?>
                                <a href="donation.php" class="btn btn-danger">Upravit</a>
                             <?php endif; ?>  
                            <div class="progress-info">Vybráno <?php echo $animal['raised_yet'];?>,-Kč z <?php echo $animal['to_be_raised'];?>,-Kč</div>
                            <div class="progress">
                                <?php 
                                $progress = round($animal['raised_yet'] / $animal['to_be_raised'] * 100);
                                ?>
                                
                    <div class="progress-bar" role="progressbar" style="width: <?php echo $progress; ?>%;" aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100"> <?php echo $progress; ?> %</div>
                    </div>
                        </div>
                        
                    <?php endforeach; ?>
                    
                </div>
                <p class="ending">Pro darování se <a href="login.php">přihlašte</a>.</p>
            </div>
        </div>