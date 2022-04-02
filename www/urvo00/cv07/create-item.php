<?php include __DIR__ . '/incl/header.php' ?>
<?php
require __DIR__ . '/db.php';

if (!empty($_POST)) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $stmt = $db->prepare("INSERT INTO goods (name, description, price) VALUES (:name, :description, :price)");
    $stmt->execute(['name' => $name, 'description' => $description, 'price' => $price]);

    echo 'mango added';
}
?>
<main class="container">
    <h1>Create a new mango</h1>
    <br><br>
    <form method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" placeholder="name">
            <label for="name">Description</label>
            <input class="form-control" placeholder="description" name="description" type="text">
            <label for="name">Price</label>
            <input class="form-control" placeholder="price" name="price" type="text">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <a href="index.php">Back to main page</a>
</main>
<?php include __DIR__ . '/incl/footer.php'; ?>