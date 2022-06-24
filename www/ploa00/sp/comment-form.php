<?php

require __DIR__ . '/utils/logged.php';

$pageName = 'BookInPrague | Comment Edit';

require_once __DIR__ . '/db/property-db.php';
$propertyDB = new PropertyDB();
$properties = $propertyDB->fetchAll();

foreach ($properties as $property) {
  $propertyInDB = $property['property_id'];
}

require_once __DIR__ . '/db/comments-db.php';
$commentsDB = new CommentsDB();

if (!empty($_POST)) {
  $content = $_POST['content'];
  $rating = $_POST['rating'];

  $commentsDB->insert($propertyInDB, $content, $user['name'], $rating);
  header('Location: property-info.php');
  exit();
}

$options = array('1', '2', '3', '4', '5');

?>

<?php require __DIR__ . '/incl/head.php'; ?>


<main>
  <h1>Přidát kommentář</h1>

  <form class="my-5 mx-auto w-50" method="POST">
    <div class="mb-3">
      <label class="form-label" for="content">Kommentář</label>
      <textarea class="form-control<?php echo (isset($err) && isset($err['content'])) ? ' border border-danger' : '' ?>" type="text" name="content" value="<?php echo isset($content) ? $content : '' ?>" required></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label" for="rating">Rating</label>
      <select class="form-select" name="rating">
        <?php foreach ($options as $option) : ?>
          <option>
            <?php echo $option ?>
          </option>
        <?php endforeach ?>
      </select>
    </div>
    <form method="POST">
      <button class="btn btn-primary m-3" type="submit" name="comments-button">Přidát kommentář</button>
    </form>
  </form>
</main>


<?php require __DIR__ . '/incl/foot.php'; ?>