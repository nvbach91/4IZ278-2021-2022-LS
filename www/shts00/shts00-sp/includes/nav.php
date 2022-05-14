<?php require_once __DIR__ . '/../db/CategoryDB.php'; ?>

<?php 
$categoryDB = new CategoryDB();
$categories = $categoryDB->fetchAll();
?>

<header>
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
                    <button class="dropdown-item" type="button"><?php echo $category['name']; ?></button>
                <?php endforeach; ?>
            </div>
        </li>
        </ul>
        <a href="signin.php" class="btn btn-success">Přihlásit se</a>
    </div>
    </nav>
</header>
        
    