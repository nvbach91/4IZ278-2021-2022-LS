<?php include ROOT . '/views/layout/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/~vase03/sp/admin">Adminpanel</a></li>
                    <li><a href="/~vase03/sp/admin/users">User managment</a></li>
                    <li class="active">Delete user</li>
                </ol>
            </div>


            <h4>Delete user #<?php echo $id; ?></h4>


            <p>Are you sure?</p>

            <form method="post">
                <input type="submit" name="submit" value="Delete" />
            </form>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer_admin.php'; ?>