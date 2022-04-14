<?php include __DIR__ . '/incl/header.php' ?>
<?php include __DIR__ . '/incl/navbar.php' ?>
<?php
require __DIR__ . '/db.php';
require 'check-user.php';
require 'check-access.php';

if (!empty($_GET)) {
    $id = $_GET['id'];
    $stmt = $db->prepare("SELECT * FROM goods 
    WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $currentMango = $stmt->fetch();
} else {
    header('Location: index.php');
    exit();
}

if (!empty($_POST)) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $stmt = $db->prepare("UPDATE goods 
    SET name = :name, description = :description, price = :price 
    WHERE id = :id");
    $stmt->execute(['name' => $name, 'description' => $description, 'price' => $price, 'id' => $id]);

    echo 'mango edited';

    $stmt = $db->prepare("SELECT * FROM goods 
    WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $currentMango = $stmt->fetch();
}
?>
<main class="container">
    <h1>Edit mango</h1>
    <br><br>
    <form method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" placeholder="name" value="<?php echo $currentMango['name']; ?>">
            <label for="name">Description</label>
            <input class="form-control" placeholder="description" name="description" type="text" value="<?php echo $currentMango['description']; ?>">
            <label for="name">Price</label>
            <input class="form-control" placeholder="price" name="price" type="text" value="<?php echo $currentMango['price']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <a href="index.php">Back to main page</a>
</main>
<?php include __DIR__ . '/incl/footer.php'; ?>