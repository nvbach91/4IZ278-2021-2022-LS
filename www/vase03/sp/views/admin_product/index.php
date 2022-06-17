<?php include ROOT . '/views/layout/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/~vase03/sp/admin">Adminpanel</a></li>
                    <li class="active">Product managment</li>
                </ol>
            </div>

            <a href="/~vase03/sp/admin/product/create" class="btn btn-default back"><i class="fa fa-plus"></i> Add product</a>
            
            <h4>Product list</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>Product ID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($productsList as $product): ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo htmlspecialchars($product['code']); ?></td>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?php echo htmlspecialchars($product['price']); ?></td>  
                        <td><a href="/~vase03/sp/admin/product/update/<?php echo $product['id']; ?>" title="Edit"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/~vase03/sp/admin/product/delete/<?php echo $product['id']; ?>" title="Delete"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer_admin.php'; ?>