<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$pageName = 'BookInPrague | Profile';

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

require_once __DIR__ . '/db/user-db.php';
$userDB = new UserDB();
$existingUser = $userDB->fetchById($user['user_id']);

$name = $existingUser['name'];
$surname = $existingUser['surname'];
$email = $existingUser['email'];
$phone = $existingUser['phone'];

?>

<?php require __DIR__ . '/incl/head.php'; ?>

<main>
    <h1>Váš Profile</h1>
    <div class="wrapper">
        <div class="mb=3">
            <?php if (isset($user['name'])) : ?>
                <div>Jmeno:
                    <p class="single-item"><?php echo $name ?></p>
                </div>
            <?php endif ?>
        </div>
        <div class="mb=3">
            <div>Přijmení:
                <p class="single-item"><?php echo $surname ?></p>
            </div>
        </div>
        <div class="mb=3">
            <div>Email:
                <p class="single-item"><?php echo $email ?></p>
            </div>
        </div>
        <div class="mb=3">
            <div>Phone:
                <p class="single-item"><?php echo $phone ?></p>
            </div>
        </div><br> 
        <a class="btn btn-primary ms-1" href="edit-profile.php">Upravít profile</a>
        <a href="index.php" class="m-3">Zpatky</a>
    </div>
</main>



<?php require __DIR__ . '/incl/foot.php'; ?>