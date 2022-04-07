<?php

if ($_POST) {
  $name = $_POST['name'];

  setcookie('name', $name, time() + 3600);
  header('Location: index.php');
  exit();
}


?>


<?php require __DIR__ . '/head.php'; ?>

<main style="min-height: 75vh;">
  <h1>Login</h1>
  <form action="./login.php" method="POST">
    <div>
      <label for="name">Name</label>
      <input type="name" name="name">
    </div>
    <button>Submit</button>
  </form>
</main>

<?php require __DIR__ . '/foot.php'; ?>