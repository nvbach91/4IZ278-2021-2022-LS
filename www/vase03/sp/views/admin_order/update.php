<?php include ROOT . '/views/layout/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/~vase03/sp/admin">Adminpanel</a></li>
                    <li><a href="/~vase03/sp/admin/order">Order managment</a></li>
                    <li class="active">Edit order</li>
                </ol>
            </div>


            <h4>Edit order #<?php echo $id; ?></h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post">

                        <p>Customer name</p>
                        <input type="text" name="userName" placeholder="" value="<?php echo htmlspecialchars($order['user_name']); ?>">

                        <p>Phone</p>
                        <input type="text" name="userPhone" placeholder="" value="<?php echo htmlspecialchars($order['user_phone']); ?>">
                        
                        <p>Country</p>
                        <input type="text" name="userCountry" placeholder="" value="<?php echo htmlspecialchars($order['country']); ?>">

                        <p>City</p>
                        <input type="text" name="userCity" placeholder="" value="<?php echo htmlspecialchars($order['city']); ?>">

                        <p>Province</p>
                        <input type="text" name="userProvince" placeholder="" value="<?php echo htmlspecialchars($order['province']); ?>">

                        <p>Comment</p>
                        <input type="text" name="userComment" placeholder="" value="<?php echo htmlspecialchars($order['user_comment']); ?>">

                        <p>Date</p>
                        <input type="text" name="date" placeholder="" value="<?php echo $order['date']; ?>">

                        <p>Status</p>
                        <select name="status">
                            <option value="1" <?php if ($order['status'] == 1) echo ' selected="selected"'; ?>>New order</option>
                            <option value="2" <?php if ($order['status'] == 2) echo ' selected="selected"'; ?>>In progress</option>
                            <option value="3" <?php if ($order['status'] == 3) echo ' selected="selected"'; ?>>Delivery</option>
                            <option value="4" <?php if ($order['status'] == 4) echo ' selected="selected"'; ?>>Closed</option>
                        </select>
                        <br>
                        <br>
                        <input type="submit" name="submit" class="btn btn-default" value="Save">
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer_admin.php'; ?>