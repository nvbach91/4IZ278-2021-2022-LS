<?php include ROOT . '/views/layout/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

        <h5>Order info</h5>
            <table class="table-admin-small table-bordered table-striped table">
                <tr>
                    <td>Order number</td>
                    <td><?php echo $order['id']; ?></td>
                </tr>
                <tr>
                    <td>Customer name</td>
                    <td><?php echo htmlspecialchars($order['user_name']); ?></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><?php echo htmlspecialchars($order['user_phone']); ?></td>
                </tr>
                <tr>
                    <td>Customer email</td>
                    <td><?php echo htmlspecialchars($order['user_email']); ?></td>
                </tr>
                <tr>
                    <td>Comment</td>
                    <td><?php echo htmlspecialchars($order['user_comment']); ?></td>
                </tr>
                <?php if ($order['country'] != ''): ?>
                    <tr>
                        <td>Country</td>
                        <td><?php echo htmlspecialchars($order['country']); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($order['city'] != ''): ?>
                    <tr>
                        <td>City</td>
                        <td><?php echo htmlspecialchars($order['city']); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($order['province'] != ''): ?>
                    <tr>
                        <td>Province</td>
                        <td><?php echo htmlspecialchars($order['province']); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($order['user_id'] != 0): ?>
                    <tr>
                        <td>Customer ID</td>
                        <td><?php echo $order['user_id']; ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td><b>Status</b></td>
                    <td><?php echo Order::getStatusText($order['status']); ?></td>
                </tr>
                <tr>
                    <td><b>Date</b></td>
                    <td><?php echo $order['date']; ?></td>
                </tr>
            </table>

            <h5>Items</h5>

            <table class="table-admin-medium table-bordered table-striped table ">
                <tr>
                    <th>Item ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['product_id']); ?></td>
                        <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                        <td>$<?php echo htmlspecialchars($product['price']); ?></td>
                        <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            
        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer.php'; ?>