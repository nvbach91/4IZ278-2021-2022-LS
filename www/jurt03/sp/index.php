<?php require_once __DIR__ . '/includes/header.php'; 

require_once __DIR__ . '/db/ZooDB.php';
require_once __DIR__ . '/db/AnimalsDB.php';

$zooDB = new ZooDB();
$zoo = $zooDB->fetchAll();

$animalsDB = new AnimalsDB();
$animals = $animalsDB->fetchAll();

if (isset($_GET['signedOut'])) {
    $signedOut = (int)$_GET['signedOut'];
} else {
    $signedOut = 0;
}

?>

<main class="dashboard">
    <div class="container">
        <?php if($signedOut): ?>
        <div class="welcome-container signedOut">
            You were signed out!
        </div>
        <?php endif;?>
        <div class="welcome-container">
            <div class="text-center m-5">
                <img class="welcome-logo" src="img/logo_transparent.png" alt="Logo zoonation">
                <h1>Vítáme Tě na webu Zoonation!</h1>
            </div>
            <div class="text-center m-5"><h2>Daruj zvířatům peníze na jídlo a udělej je šťastnější.</h2>
                <p class="m-5">Celkem můžeš darovat <?php echo count($animals);?> zvířatům z <?php echo count($zoo); ?>   zoo.<br>Tak na co ještě čekáš?</p></div>
            <div class="text-center m-5">Pro pokračování se prosím <a href="login.php">přihlaš</a> zde.</div>
        </div>

        <div class="welcome-container">
            <div class="zooList">
                <p class="heading">ZOO, se kterými aktuálně spolupracujeme</p>
                <div class="list-group">
                    <?php foreach($zoo as $one_zoo): ?>
                    <p class="zooItem"><?php echo $one_zoo['name']; ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

      <!--  <div class="welcome-container">
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
                            <div class="progress-info">vybráno <?php echo $animal['raised_yet'];?>,-Kč z <?php echo $animal['to_be_raised'];?>,-Kč</div>
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

</div> -->


</main>

<?php require __DIR__ . '/includes/footer.php'; ?> 