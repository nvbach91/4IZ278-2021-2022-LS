<?php
require __DIR__ . '/db.php';

if (!empty($_COOKIE)) {
    if (isset($_COOKIE['name'])) {
        $name = $_COOKIE['name'];
    }
}

$itemsPerPage = 5;
$offset = 0;
if (!empty($_GET)) {
    $offset = $_GET['offset'];
}

$count = $db->query("SELECT COUNT(id) FROM goods")->fetchColumn();

$stmt = $db->prepare("SELECT * FROM goods ORDER BY id DESC LIMIT $itemsPerPage OFFSET ?");
$stmt->bindValue(1, $offset, PDO::PARAM_INT);
$stmt->execute();
$goods = $stmt->fetchAll();
?>
<?php include __DIR__ . '/incl/header.php'; ?>
<?php include __DIR__ . '/incl/navbar.php'; ?>

<main class="container">
    <h1>Mango index</h1>
    Total mango count: <?php echo $count ?>
    <br><br>
    <?php if (isset($_SESSION['user_privilege']) && $_SESSION['user_privilege'] >= 2) { ?>
        <a class="btn btn-primary" href="create-item.php">Add new mango</a>
    <?php } ?>

    <br><br>

    <div class="pagination">
        <?php for ($i = 1; $i <= ceil($count / $itemsPerPage); $i++) { ?>
            <a class="<?php echo $offset / $itemsPerPage + 1 == $i ? "active" : ""; ?>" href="./index.php?offset=<?php echo ($i - 1) * $itemsPerPage; ?>">
                <?php echo $i; ?>
            </a>
        <?php } ?>
    </div>
    <?php if ($count) { ?>
        <div class="products">
            <?php foreach ($goods as $row) : ?>
                <div class="card product" style="width: calc(33% - 30px)">
                    <div class="card-img-top" style="background-image: url('https://elbefruit.eu/wp-content/uploads/2018/07/tommy-variety-1.jpg')">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name'] ?></h5>
                        <div class="card-subtitle"><?php echo $row['price'] ?></div>
                        <div class="card-text"><?php echo $row['description'] ?></div>
                        <div class="card-controls">
                            <a class="btn btn-secondary card-link" href='./buy.php?id=<?php echo $row['id'] ?>'>Buy</a>
                            <?php if (isset($_SESSION['user_privilege']) && $_SESSION['user_privilege'] >= 2) { ?>
                                <a class="btn btn-secondary card-link" href='./edit-item.php?id=<?php echo $row['id'] ?>'>Edit</a>
                                <a class="btn btn-secondary card-link" href='./delete-item.php?id=<?php echo $row['id'] ?>'>Delete</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <br>
        <div class="pagination">
            <?php for ($i = 1; $i <= ceil($count / $itemsPerPage); $i++) { ?>
                <a class="<?php echo $offset / $itemsPerPage + 1 == $i ? "active" : ""; ?>" href="./index.php?offset=<?php echo ($i - 1) * $itemsPerPage; ?>">
                    <?php echo $i; ?>
                </a>
            <?php } ?>
        </div>
        <br>
    <?php } ?>
</main>

<?php include __DIR__ . '/incl/footer.php'; ?>