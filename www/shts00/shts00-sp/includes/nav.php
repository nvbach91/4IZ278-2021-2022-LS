<?php require_once __DIR__ . '/../db/CategoryDB.php'; ?>
<?php require_once __DIR__ . '/../db/UserDB.php'; ?>

<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$categoryDB = new CategoryDB();
$categories = $categoryDB->fetchAll();
?>

<header class="header-margin">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Konference</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Kategorie
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php foreach($categories as $category) : ?>
                    <?php echo "<a class='dropdown-item' href='https://eso.vse.cz/~shts00/shts00-sp/index.php?category=$category[category_id]'>$category[name]</a>" ?>
                <?php endforeach; ?>
            </div>
        </li>
        </ul>
        <?php

        if(!isset($_COOKIE['user_id'])) {
            echo '<a href="https://eso.vse.cz/~shts00/shts00-sp/signin.php" class="btn btn-success">Přihlásit se</a>';
        }

        if(isset($_COOKIE['user_id'])){
            $userDB = new UserDB();
            $user = $userDB->fetchById($_COOKIE['user_id'])[0];
            if($user['privilege'] == 'admin') {
                echo '<a class="btn btn-success" href="https://eso.vse.cz/~shts00/shts00-sp/adminPanel.php" >Admin panel</a>';
            }
            else if($user['privilege'] == 'user') {
                echo '<a class="btn btn-success" href="https://eso.vse.cz/~shts00/shts00-sp/ticketsHistory.php" >Moje vstupenky</a>';
            }
            echo '<a class="btn btn-link" href="https://eso.vse.cz/~shts00/shts00-sp/index.php?status=1" >Odhlásit se</a>';
        }
        ?>
    </div>
    </nav>
</header>
        
    