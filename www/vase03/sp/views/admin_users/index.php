<?php include ROOT . '/views/layout/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/~vase03/sp/admin">Adminpanel</a></li>
                    <li class="active">User managment</li>
                </ol>
            </div>

            <h4>Admin list</h4>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>Name</th>
                    <th>E-mail</th>
                </tr>
                <?php foreach ($userList as $user): ?>
                    <?php if ($user['role'] === 'admin'): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td> 
                        </tr>
                    <?php endif;?>
                <?php endforeach; ?>
            </table>

            <br/>

            
            
            <h4>User list</h4>
            <a href="/~vase03/sp/admin/users/create" class="btn btn-default back"><i class="fa fa-plus"></i> Add user</a>

            <h4></h4>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php foreach ($userList as $user): ?>
                    <?php if ($user['role'] !== 'admin'): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td> 
                            <td><a href="/~vase03/sp/admin/users/update/<?php echo $user['id']; ?>" title="Edit"><i class="fa fa-pencil-square-o"></i></a></td>
                            <td><a href="/~vase03/sp/admin/users/delete/<?php echo $user['id']; ?>" title="Delete"><i class="fa fa-times"></i></a></td>
                        </tr>
                    <?php endif;?>
                <?php endforeach; ?>
            </table>
            
        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer_admin.php'; ?>