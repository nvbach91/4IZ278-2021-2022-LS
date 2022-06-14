<?php include ROOT . '/views/layout/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <h1>User cabinet</h1>
            
            <h3>Hello, <?php echo htmlspecialchars($user['name']);?>!</h3>
            <ul>
                <li><a href="/~vase03/sp/cabinet/edit/name">Edit name</a></li>
                <li><a href="/~vase03/sp/cabinet/edit/password">Set new password</a></li>
                <li><a href="/~vase03/sp/cabinet/history">Orders</a></li>
            </ul>
            
        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer.php'; ?>