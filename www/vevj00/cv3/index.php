<?php include './includes/header.php'?>
<?php
$errors = [];
var_dump($_POST);
if(!empty($_POST) ){
	
$name = $_POST['name'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$avatar = $_POST['avatar'];

if(strlen($name)<3){
array_push($errors,'wrong name');
}

if(!in_array($gender,['N','F','M'])){
	array_push($errors,'how');
}

if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
	array_push($errors,'wrong email');
}

if(!preg_match('/\+?\d{0,}/',$phone)){
	array_push($errors,'wrong phone');
}

if(!filter_var($avatar,FILTER_VALIDATE_URL)){
	array_push($errors,'wrong url');
}

if (!count($errors)){
	header('location: ./registration-success.php');
	die();
}
}
?>
<main>
	<form action="." method="POST">
		<?php foreach($errors as $error):?>
			<div class="error"><?php echo $error;?></div>
		<?php endforeach?>
<div>
	<label for="name"></label>
	<input value="<?php echo isset($name) ? $name : '' ?>" name = "name" required pattern= "\w{3,}">
</div>
<div>
	<label for="gender"></label>
	<select name="gender">
		<option value="N">Neutral</option>
		<option value="F">Female</option>
		<option value="M">Male</option>
	</select>
</div>
<div>
	<label for="email"></label>
	<input value="<?php echo isset($email) ? $email : '' ?>" name= "email" require type= "email">
</div>
<div>
	<label for="phone"></label>
	<input value="<?php echo isset($phone) ? $phone : '' ?>" name= "phone" require type= "\+?\d{9,}">
</div>
<div>
	<label for="avatar"></label>
	<input value="<?php echo isset($avatar) ? $avatar : '' ?>" name= "avatar" required>
</div>
<button>Submit</button>
</form>
</main>
<?php include './includes/footer.php'?>