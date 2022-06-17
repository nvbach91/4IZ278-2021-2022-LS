<form method="POST">
  <?php if (isset($err['form'])) : ?>
    <p class="text-danger"><?php echo $err['form']; ?></p>
  <?php endif ?>
  <div class="row">
    <div class="col m-3">
      <div class="mb-3">
        <label class="form-label" for="name">Name*</label>
        <input class="form-control<?php echo (isset($err) && isset($err['name'])) ? ' border border-danger' : '' ?>" name="name" value="<?php echo isset($name) ? $name : '' ?>" required>
        <?php if (isset($err) && isset($err['name'])) : ?>
          <small class="text-danger"><?php echo $err['name'] ?></small>
        <?php endif ?>
      </div>
      <div class="mb-3">
        <label class="form-label" for="category">Category</label>
        <select class="form-select<?php echo (isset($err) && isset($err['category'])) ? ' border border-danger' : '' ?>" name="category">
          <option></option>
          <?php foreach ($categories as $oneCategory) : ?>
            <option <?php echo isset($category) && $oneCategory['name'] == $category ? 'selected="true"' : '' ?>>
              <?php echo $oneCategory['name'] ?>
            </option>
          <?php endforeach ?>
        </select>
        <?php if (isset($err) && isset($err['category'])) : ?>
          <small class="text-danger"><?php echo $err['category'] ?></small>
        <?php endif ?>
      </div>
      <div class="mb-3">
        <label class="form-label" for="image">Image URL</label>
        <input class="form-control<?php echo (isset($err) && isset($err['image'])) ? ' border border-danger' : '' ?>" name="image" value="<?php echo isset($image) ? $image : '' ?>">
        <?php if (isset($err) && isset($err['image'])) : ?>
          <small class="text-danger"><?php echo $err['image'] ?></small>
        <?php endif ?>
      </div>
      <div class="mb-3">
        <label class="form-label" for="description">Description</label>
        <textarea class="form-control" name="description" rows="4"><?php echo isset($description) ? $description : '' ?></textarea>
      </div>
    </div>
    <div class="col m-3">
      <div class="mb-3">
        <label class="form-label" for="datetime">Date & time*</label>
        <input class="form-control<?php echo (isset($err) && isset($err['datetime'])) ? ' border border-danger' : '' ?>" type="datetime-local" name="datetime" value="<?php echo isset($datetime) ? $datetime : '' ?>" required>
        <?php if (isset($err) && isset($err['datetime'])) : ?>
          <small class="text-danger"><?php echo $err['datetime'] ?></small>
        <?php endif ?>
      </div>
      <div class="mb-3">
        <label class="form-label" for="capacity">Capacity</label>
        <input class="form-control<?php echo (isset($err) && isset($err['capacity'])) ? ' border border-danger' : '' ?>" type="number" name="capacity" value="<?php echo isset($capacity) ? $capacity : '' ?>">
        <?php if (isset($err) && isset($err['capacity'])) : ?>
          <small class="text-danger"><?php echo $err['capacity'] ?></small>
        <?php endif ?>
      </div>
      <div class="mb-3">
        <label class="form-label" for="street">Street</label>
        <input class="form-control<?php echo (isset($err) && isset($err['street'])) ? ' border border-danger' : '' ?>" name="street" value="<?php echo isset($street) ? $street : '' ?>">
        <?php if (isset($err) && isset($err['street'])) : ?>
          <small class="text-danger"><?php echo $err['street'] ?></small>
        <?php endif ?>
      </div>
      <div class="mb-3">
        <label class="form-label" for="city">City</label>
        <input class="form-control<?php echo (isset($err) && isset($err['city'])) ? ' border border-danger' : '' ?>" name="city" value="<?php echo isset($city) ? $city : '' ?>">
        <?php if (isset($err) && isset($err['city'])) : ?>
          <small class="text-danger"><?php echo $err['city'] ?></small>
        <?php endif ?>
      </div>
      <div class="mb-3">
        <label class="form-label" for="zip">ZIP</label>
        <input class="form-control<?php echo (isset($err) && isset($err['zip'])) ? ' border border-danger' : '' ?>" name="zip" value="<?php echo isset($zip) ? $zip : '' ?>">
        <?php if (isset($err) && isset($err['zip'])) : ?>
          <small class="text-danger"><?php echo $err['zip'] ?></small>
        <?php endif ?>
      </div>
    </div>
  </div>
  <button class="btn btn-primary m-3" type="submit">Submit</button>
  <a href="events.php" class="m-3">Back</a>
</form>