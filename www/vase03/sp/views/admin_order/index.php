<?php include ROOT . '/views/layout/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>
                        
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/~vase03/sp/admin">Adminpanel</a></li>
                    <li class="active">Order managment</li>
                </ol>
            </div>

            <h4>Order list</h4>

            <br/>

            
            <table class="table-bordered table-striped table">
                <tr>
                    <th>Order ID</th>
                    <th>Customer name</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($ordersList as $order): ?>
                    <tr>
                        <td>
                            <a href="/~vase03/sp/admin/order/view/<?php echo $order['id']; ?>">
                                <?php echo $order['id']; ?>
                            </a>
                        </td>
                        <td><?php echo htmlspecialchars($order['user_name']); ?></td>
                        <td><?php echo htmlspecialchars($order['user_phone']); ?></td>
                        <td><?php echo $order['date']; ?></td>
                        <td><?php echo Order::getStatusText($order['status']); ?></td>    
                        <td><a href="/~vase03/sp/admin/order/view/<?php echo $order['id']; ?>" title="Show"><i class="fa fa-eye"></i></a></td>
                        <td><a href="/~vase03/sp/admin/order/update/<?php echo $order['id']; ?>" title="Edit"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/~vase03/sp/admin/order/delete/<?php echo $order['id']; ?>" title="Delete"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer_admin.php'; ?>