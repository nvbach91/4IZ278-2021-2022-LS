<?php include ROOT . '/views/layout/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/~vase03/sp/admin">Adminpanel</a></li>
                    <li><a href="/~vase03/sp/admin/product">Product managment</a></li>
                    <li class="active">Edit product</li>
                </ol>
            </div>


            <h4>Edit product #<?php echo $id; ?></h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Product name</p>
                        <input type="text" name="name" placeholder="" value="<?php echo htmlspecialchars($product['name']); ?>">

                        <p>Code</p>
                        <input type="text" name="code" placeholder="" value="<?php echo htmlspecialchars($product['code']); ?>">

                        <p>Price, $</p>
                        <input type="text" name="price" placeholder="" value="<?php echo htmlspecialchars($product['price']); ?>">

                        <p>Category</p>
                        <select name="category_id">
                            <?php if (is_array($categoriesList)): ?>
                                <?php foreach ($categoriesList as $category): ?>
                                    <option value="<?php echo $category['id']; ?>" 
                                        <?php if ($product['category_id'] == $category['id']) echo ' selected="selected"'; ?>>
                                        <?php echo htmlspecialchars($category['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        
                        <br/><br/>

                        <p>Manufactured</p>
                        <input type="text" name="brand" placeholder="" value="<?php echo htmlspecialchars($product['brand']); ?>">

                        <p>Image</p>
                        <img src="<?php echo Product::getImage($product['id']); ?>" width="200" alt="" />
                        <input type="file" name="image" placeholder="" value="<?php echo $product['image']; ?>">

                        <p>Description</p>
                        <textarea name="description"><?php echo htmlspecialchars($product['description']); ?></textarea>
                        
                        <br/><br/>

                        <p>In stock</p>
                        <select name="availability">
                            <option value="1" <?php if ($product['availability'] == 1) echo ' selected="selected"'; ?>>Yes</option>
                            <option value="0" <?php if ($product['availability'] == 0) echo ' selected="selected"'; ?>>No</option>
                        </select>
                        
                        <br/><br/>
                        
                        <p>New</p>
                        <select name="is_new">
                            <option value="1" <?php if ($product['is_new'] == 1) echo ' selected="selected"'; ?>>Yes</option>
                            <option value="0" <?php if ($product['is_new'] == 0) echo ' selected="selected"'; ?>>No</option>
                        </select>
                        
                        <br/><br/>

                        <p>Recommended</p>
                        <select name="is_recommended">
                            <option value="1" <?php if ($product['is_recommended'] == 1) echo ' selected="selected"'; ?>>Yes</option>
                            <option value="0" <?php if ($product['is_recommended'] == 0) echo ' selected="selected"'; ?>>No</option>
                        </select>
                        
                        <br/><br/>

                        <p>Status</p>
                        <select name="status">
                            <option value="1" <?php if ($product['status'] == 1) echo ' selected="selected"'; ?>>Showing</option>
                            <option value="0" <?php if ($product['status'] == 0) echo ' selected="selected"'; ?>>Hidden</option>
                        </select>
                        
                        <br/><br/>
                        
                        <input type="submit" name="submit" class="btn btn-default" value="Save">
                        
                        <br/><br/>
                        
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer_admin.php'; ?>