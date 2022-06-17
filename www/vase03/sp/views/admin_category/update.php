<?php include ROOT . '/views/layout/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/~vase03/sp/admin">Adminpanel</a></li>
                    <li><a href="/~vase03/sp/admin/category">Category managment</a></li>
                    <li class="active">Edit category</li>
                </ol>
            </div>


            <h4>Edit category "<?php echo htmlspecialchars($category['name']); ?>"</h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post">

                        <p>Name</p>
                        <input type="text" name="name" placeholder="" value="<?php echo htmlspecialchars($category['name']); ?>">

                        <p>Number</p>
                        <input type="text" name="sort_order" placeholder="" value="<?php echo htmlspecialchars($category['sort_order']); ?>">
                        
                        <p>Status</p>
                        <select name="status">
                            <option value="1" <?php if ($category['status'] == 1) echo ' selected="selected"'; ?>>Showing</option>
                            <option value="0" <?php if ($category['status'] == 0) echo ' selected="selected"'; ?>>Hidden</option>
                        </select>

                        <br><br>
                        
                        <input type="submit" name="submit" class="btn btn-default" value="Save">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer_admin.php'; ?>