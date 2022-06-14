<?php
session_start();
$alerts = [];



require_once __DIR__ . '/includes/requireAdmin.php';
require_once __DIR__ . '/db/AnimalsDB.php';
require_once __DIR__ . '/db/DonationsDB.php';

if (isset($_GET['animal_id'])) {
    $animal_id = (int)$_GET['animal_id'];
} else {
    $animal_id = 0;
}


if($animal_id > 0) {
    $animalsDB = new AnimalsDB();
    $animal =  $animalsDB->fetchById($animal_id)[0];
    } else {
        header('Location: animals.php');
    }


if (!empty($_POST)) {
    $toBeRaised = (int)$_POST['toBeRaised'];
    
    if($toBeRaised <= $animal['raised_yet']){
        array_push($alerts,'Tato částka je nižší než aktuálně vybrané peníze.');
    }

    if(!count($alerts)){
        //change to_be_raised value
        $changeToBeRaisedValue = $animalsDB->changeToBeRaised($animal_id, $toBeRaised);
        header('Location: animals.php?changedSucessfully=1');
    }

}







require_once __DIR__ . '/includes/header.php'; 







?>

<main class="dashboard animals">
    <div class="container">
        <div class="welcome-container">
        <p class="heading">Změna pro <?php echo $animal['animal_name'] . ' '. $animal['nickname'];?></p>
            <div class="donation">
            
        <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="<?php echo $animal['image'];?>" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-heading"><?php echo $animal['nickname'];?></p>
                            <p class="card-subheading"><?php echo $animal['animal_name'];?></p>
                            <p class="card-text"><?php echo $animal['description'];?></p>                
                        </div>
                        <div class="progress-info">
                            vybráno <?php echo $animal['raised_yet'];?>,-Kč z <?php echo $animal['to_be_raised'];?>,-Kč
                        </div>
                        <div class="progress">
                            <?php 
                            $progress = round($animal['raised_yet'] / $animal['to_be_raised'] * 100);
                            ?>
                            <div class="progress-bar" role="progressbar" style="width: <?php echo $progress; ?>%;" aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100"> <?php echo $progress; ?>
                             %
                            </div>
                        </div>
                          
                    </div> 
                    <div class="donationForm">
                    <form method="POST">
  <div class="form-group">
    <label for="toBeRaised">Nová částka, kolik se bude vybírat</label>
    <input type="number" class="form-control" id="toBeRaised" name="toBeRaised" aria-describedby="toBeRaisedHelp" placeholder="Vlož částku" required>
    
  </div>
  
  <button type="submit" class="btn btn-success">Změnit</button>
</form>
<?php if(!empty($alerts)): ?>
   <div class="errors">
<?php foreach($alerts as $alert): ?>
            <div class="error"><?php echo $alert; ?></div>
        <?php endforeach; ?>
</div>
<?php endif; ?>
</div>
        </div>
</div>
        
    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>