

<?php require './../utils/utils.php';?>

<?php 
$path= './../';
$users = fetchUsers();
?>

<head>
  <!--  <link rel="stylesheet" href="./../css/main.css">-->
</head>
<?php include './../includes/head.php';?>
<main>
    <h1>List of users</h1>
    <div class="users">
<?php foreach($users as $user):?>
    <div class="usercard">
        <div class="name"><?php echo $user[0];?></div>
        <div class="email"><?php echo $user[1];?></div>
        <div class="password"><?php echo $user[2];?></div>
    </div>
<?php endforeach;?>
<div class="users">
</main>

<?php include './../includes/foot.php';?>