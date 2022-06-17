<?php include ROOT . '/views/layout/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br />

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/~vase03/sp/admin">Adminpanel</a></li>
                    <li><a href="/~vase03/sp/admin/users">Users managment</a></li>
                    <li class="active">Edit user</li>
                </ol>
            </div>


            <h4>Edit user "<?php echo htmlspecialchars($user['name']); ?>"</h4>

            <br />

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post">

                        <p>Name</p>
                        <input type="text" name="name" placeholder="Name" value="<?php echo htmlspecialchars($user['name']); ?>" />

                        <p>Email</p>
                        <input type="text" name="email" placeholder="E-mail" value="<?php echo htmlspecialchars($user['email']); ?>">

                        <p>Password</p>
                        <input type="password" name="password" placeholder="Password" value="" />

                        <p>Role</p>
                        <select name="role">
                            <option value="user" <?php if ($user['role'] == 'user') echo ' selected="selected"'; ?>>User</option>
                            <option value="admin" <?php if ($user['role'] == 'admin') echo ' selected="selected"'; ?>>Admin</option>
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