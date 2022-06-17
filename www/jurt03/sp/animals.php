<?php

session_start();
require_once __DIR__ . '/includes/requireUser.php';
require_once __DIR__ . '/db/UsersDB.php';
require_once __DIR__ . '/includes/header.php'; 
require_once __DIR__ . '/db/AnimalsDB.php';
require_once __DIR__ . '/db/CategoriesDB.php';

if (isset($_GET['offset'])) {
    $offset = (int)$_GET['offset'];
} else {
    $offset = 0;
}

if (isset($_GET['thankYou'])) {
    $thankYou = (int)$_GET['thankYou'];
} else {
    $thankYou = 0;
}

if (isset($_GET['changedSucessfully'])) {
    $changedSucessfully = (int)$_GET['changedSucessfully'];
} else {
    $changedSucessfully = 0;
}

if(isset($_POST['categoryChoice'])){
    $categoryChoice=$_POST['categoryChoice'];
    $offset = 0;
} else {
    $categoryChoice = 0;
}


$numberOfItemsPerPagination = 8;


$categoryDB = new CategoryDB();
$categories = $categoryDB->fetchAll();

$animalsDB = new AnimalsDB();
$animals = $animalsDB->fetchAllWithOffsetAndCategory($numberOfItemsPerPagination, $offset, $categoryChoice);
if($categoryChoice == 0){
    $count = count($animalsDB->fetchAll());
} else {
$count =count($animalsDB->fetchAllByCategory($categoryChoice));
}

$usersDB = new UsersDB();
$loggedUser = $usersDB->fetchById($_SESSION['user_id'])[0];



?>

<main class="dashboard animals">
    <div class="container">
    <?php if($thankYou): ?>
        <div class="welcome-container signedOut">
            Darování bylo úspěšné. Děkujeme.
        </div>
        <?php endif;?>
        <?php if($changedSucessfully): ?>
        <div class="welcome-container signedOut">
            Změna byla úspěšně provedena.
        </div>
        <?php endif;?>
        <div class="welcome-container">
            <h1 class="welcomeSlogan"> Vítej, <?php echo $loggedUser['first_name'] . ' ' . $loggedUser['last_name']; ?>  </h1>      
            <h2 class="welcomeSlogan">Aktuálně můžeš darovat těmto zvířatům:</h2>  
            <p class="balance">Kredit: <?php echo $loggedUser['credit'];?> ,-Kč</p>
            <?php if($loggedUser['credit'] == 0): ?>
                <p class="noCredit">Nemáte dostatečný kredit na darování.<br> Dobijte si peníze na přepážce a administrátor Vám kredit do několika hodin připíše.</p>
            <?php endif;?>   
        </div>

        <div class="welcome-container">
            <h3 class="welcomeSlogan">Filtrovat podle:</h1>  
            <div class="filterForm">
                <form method="POST">
                <?php foreach($categories as $category): ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="categoryChoice" id="inlineRadio1" value="<?php echo $category['category_id'];?>" <?php echo isset($categoryChoice) && $categoryChoice == $category['category_id'] ? 'checked' : '';?>>
                        <label class="form-check-label" for="inlineRadio1"><?php echo $category['name'];?></label>
                    </div>
                <?php endforeach; ?>
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="categoryChoice" id="inlineRadio1" value="0" <?php echo isset($categoryChoice) && $categoryChoice == 0 ? 'checked' : '';?>>
                <label class="form-check-label" for="inlineRadio1">Všechna zvířata</label>
                </div>
                <button type="submit" class="btn btn-primary">Vybrat</button>
                </form>
            </div>
        </div>

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
                        <?php if($loggedUser['credit'] > 0): ?>
                            <a href="donation.php?animal_id=<?php echo $animal['animal_id']; ?>" class="btn btn-primary">Darovat</a>
                        <?php endif;?>   
                            
                        <?php if($loggedUser['is_admin']): ?>
                            <a href="editAnimal.php?animal_id=<?php echo $animal['animal_id']; ?>" class="btn btn-danger">Upravit</a>
                        <?php endif; ?>   
                    </div>   
                    <?php endforeach; ?>
                
                </div>
            </div>
            <div class="paginationItems">
                <?php for ($i = 1; $i <= ceil($count / $numberOfItemsPerPagination); $i++) { ?>
                <a class="<?php echo $offset / $numberOfItemsPerPagination + 1 == $i ? "active" : ""; ?>" href="./animals.php?offset=<?php echo ($i - 1) * $numberOfItemsPerPagination; ?>">
                <?php echo $i; ?>
                </a>
                <?php } ?>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>