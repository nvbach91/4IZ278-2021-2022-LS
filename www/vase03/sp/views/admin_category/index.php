<?php include ROOT . '/views/layout/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/~vase03/sp/admin">Adminpanel</a></li>
                    <li class="active">Category managment</li>
                </ol>
            </div>

            <a href="/~vase03/sp/admin/category/create" class="btn btn-default back"><i class="fa fa-plus"></i> Add category</a>
            
            <h4>Category list</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>Category ID</th>
                    <th>Category name</th>
                    <th>Number</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($categoriesList as $category): ?>
                    <tr>
                        <td><?php echo $category['id']; ?></td>
                        <td><?php echo htmlspecialchars($category['name']); ?></td>
                        <td><?php echo htmlspecialchars($category['sort_order']); ?></td>
                        <td><?php echo Category::getStatusText($category['status']); ?></td>  
                        <td><a href="/~vase03/sp/admin/category/update/<?php echo $category['id']; ?>" title="Edit"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/~vase03/sp/admin/category/delete/<?php echo $category['id']; ?>" title="Delete"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            
        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer_admin.php'; ?>