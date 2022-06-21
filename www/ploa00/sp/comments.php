<div class="wrapper">
    <h2>Kommentáře:</h2>
    <?php foreach ($comments as $comment) : ?>
        <?php if ($property['property_id'] === $comment['fk_property_id']) : ?>
            <div class="prev-comments">
                <div>Username:
                    <p class="single-item"><?php echo $comment['username'] ?></p>
                </div>
                <div>Popis: <br>
                    <p class="single-item"><?php echo $comment['content'] ?></p>
                </div>
                <div>Rating:
                    <?php if (isset($comment['rating'])) : ?>
                        <img class="rating-img" src="./img/<?php echo $comment['rating'] ?>stars.jpg" alt="Image">
                    <?php endif ?>
                </div>
                <u></u>
            </div>
        <?php endif ?>
    <?php endforeach ?>
</div>