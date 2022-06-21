<form method="POST">
    <?php if (isset($err['form'])) : ?>
        <p class="text-danger"><?php echo $err['form']; ?></p>
    <?php endif ?>
    <div class="row">
        <div class="col m-3">
            <div class="mb-3">
                <label class="form-label" for="category">Category</label>
                <select class="form-select<?php echo (isset($err) && isset($err['category'])) ? ' border border-danger' : '' ?>" name="category">
                    <option></option>
                    <?php foreach ($categories as $oneCategory) : ?>
                        <option <?php echo isset($category) && $oneCategory['category_name'] == $category ? 'selected="true"' : '' ?>>
                            <?php echo $oneCategory['category_name'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
                <?php if (isset($err) && isset($err['category'])) : ?>
                    <small class="text-danger"><?php echo $err['category'] ?></small>
                <?php endif ?>
            </div>
            <div class="mb-3">
                <label class="form-label" for="description">Description</label>
                <textarea class="form-control" name="description" rows="4"><?php echo isset($description) ? $description : '' ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="address">Address</label>
                <input class="form-control<?php echo (isset($err) && isset($err['address'])) ? ' border border-danger' : '' ?>" name="address" value="<?php echo isset($address) ? $address : '' ?>" required>
                <?php if (isset($err) && isset($err['address'])) : ?>
                    <small class="text-danger"><?php echo $err['address'] ?></small>
                <?php endif ?>
            </div>
            <div class="mb-3">
                <label class="form-label" for="owner">Majitel</label>
                <input class="form-control<?php echo (isset($err) && isset($err['owner'])) ? ' border border-danger' : '' ?>" name="owner" value="<?php echo isset($owner) ? $owner : '' ?>" required>
                <?php if (isset($err) && isset($err['owner'])) : ?>
                    <small class="text-danger"><?php echo $err['owner'] ?></small>
                <?php endif ?>
            </div>
            <div class="mb-3">
                <label class="form-label" for="photo">Photo</label>
                <input class="form-control<?php echo (isset($err) && isset($err['photo'])) ? ' border border-danger' : '' ?>" name="photo" value="<?php echo isset($photo) ? $photo : '' ?>" required>
                <?php if (isset($err) && isset($err['photo'])) : ?>
                    <small class="text-danger"><?php echo $err['photo'] ?></small>
                <?php endif ?>
            </div>
        </div>
        <div class="col m-3">
            <div class="mb-3">
                <label class="form-label" for="price">Cena za noc</label>
                <input class="form-control<?php echo (isset($err) && isset($err['price'])) ? ' border border-danger' : '' ?>" name="price" value="<?php echo isset($price) ? $price : '' ?>">
                <?php if (isset($err) && isset($err['price'])) : ?>
                    <small class="text-danger"><?php echo $err['price'] ?></small>
                <?php endif ?>
            </div>
            <div class="mb-3">
                <label class="form-label" for="phone">Phone</label>
                <input class="form-control<?php echo (isset($err) && isset($err['phone'])) ? ' border border-danger' : '' ?>" type="text" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>" required>
                <?php if (isset($err) && isset($err['name'])) : ?>
                    <small class="text-danger"><?php echo $err['name'] ?></small>
                <?php endif ?>
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input class="form-control<?php echo (isset($err) && isset($err['email'])) ? ' border border-danger' : '' ?>" type="email" name="email" value="<?php echo isset($email) ? $email : '' ?>" required>
                <?php if (isset($err) && isset($err['email'])) : ?>
                    <small class="text-danger"><?php echo $err['email'] ?></small>
                <?php endif ?>
            </div>
        </div>
    </div>
    <button class="btn btn-primary m-3" type="submit">Submit</button>
    <a href="property-list.php" class="m-3">Back</a>
</form>