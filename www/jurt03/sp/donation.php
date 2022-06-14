<?php
session_start();
$alerts = [];

require_once __DIR__ . '/includes/requireUser.php';
require_once __DIR__ . '/db/AnimalsDB.php';
require_once __DIR__ . '/db/DonationsDB.php';
require_once __DIR__ . '/db/UsersDB.php';

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

$usersDB = new UsersDB();
$loggedUser = $usersDB->fetchById($_SESSION['user_id'])[0];

if (!empty($_POST)) {
    $value = (int)$_POST['value'];
    $description = $_POST['description'];
    if($value < 1 || $value > $loggedUser['credit']){
        array_push($alerts,'Tato částka nelze darovat.');
    }

    if(!count($alerts)){
        //uloz transakci do historie transakci
        $date = date('Y-m-d H:i:s');
        $donationsDB = new DonationsDB();
        $createDonation= $donationsDB->create([
            'animal_id' => $animal_id,
            'user_id' => $loggedUser['user_id'],
            'value' => $value,
            'date' => $date,
            'description' => $description
        ]);
        //pripis zvireti darovanou castku
        $addValueToAnimal = $animalsDB->changeMoney($animal_id, $value);
        //odeber kredit uzivateli a tuto hodnotu pricti k jeho attributu donated
        $minusCredit = $usersDB->minusCreditAndAddToDonated($loggedUser['user_id'], $value);
        mail($loggedUser['email'],"Děkujeme za darování",'Děkujeme, že jsi daroval' . ' ' . $value .' ,-Kč na našem webu Zoonation');
        header('Location: animals.php?thankYou=1');
    }

}


require_once __DIR__ . '/includes/header.php'; 



?>

<main class="dashboard animals">
    <div class="container">
        <div class="welcome-container">
        <p class="heading">Darování pro <?php echo $animal['animal_name'] . ' '. $animal['nickname'];?></p>
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
    <label for="value">Částka mezi 1 a <?php echo $loggedUser['credit']; ?> (tvůj kredit)</label>
    <input type="number" class="form-control" id="value" name="value" aria-describedby="valueHelp" placeholder="Vlož částku" required>
    <small id="valueHelp" class="form-text text-muted">Děkujeme za darování</small>
  </div>
  <div class="form-group">
    <label for="description">Vzkaz</label>
    <input type="text" class="form-control" id="description" name="description" aria-describedby="descriptionHelp" placeholder="Napiš vzkaz">
    
  </div>
  <button type="submit" class="btn btn-success">Darovat peníze</button>
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