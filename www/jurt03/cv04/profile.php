<?php require('./utils/utils.php');?>
<?php
$path= './';
$email = $_GET['email'];

$user = fetchUser($email);

?>

<?php include('./includes/head.php');?>
<main>
    <h1>Dashboard</h1>
    <p><?php echo "Welcome, $user[0].";?></p>
</main>

<?php include('./includes/foot.php');?>