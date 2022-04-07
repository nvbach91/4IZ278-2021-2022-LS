<?php
session_start();
require __DIR__ . '/db.php';
$ids = $_SESSION['cart'];
if (count($ids) == 0) {
    $count = 0;
} else {
    $count = count($ids);
}
if (is_array($ids) && $count != 0) {
    $qmarks = "";
    foreach ($ids as $id) {
        $qmarks = $qmarks . "?,";
    }
    $qmarks = substr($qmarks, 0, -1);

    $stmt = $db->prepare("SELECT * FROM goods WHERE id IN ($qmarks) ORDER BY name");
    $stmt->execute(array_values($ids));
    $goods = $stmt->fetchAll();
}
?>



<?php include __DIR__ . '/incl/header.php' ?>
<?php include __DIR__ . '/incl/navbar.php' ?>
<main class="container">
    <h1>My shopping cart</h1>
    Total goods selected: <?= $count ?>
    <br><br>
    <a href="index.php">Back to main page</a>
    <br><br>
    <?php if (@$goods) : ?>
        <div class="products">
            <?php foreach ($goods as $row) : ?>
                <div class="card product" style="width: calc(100% / 3)">
                    <img class="card-img-top" src="https://via.placeholder.com/300x150" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name'] ?></h5>
                        <div class="card-subtitle"><?php echo $row['price'] ?></div>
                        <div class="card-text"><?php echo $row['description'] ?></div>
                        <form action="remove-item.php" method="POST">
                            <input class="d-none" name="id" value="<?php echo $row['id'] ?>">
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <h5>No goods yet</h5>
    <?php endif; ?>
</main>
<?php include __DIR__ . '/incl/footer.php'; ?>