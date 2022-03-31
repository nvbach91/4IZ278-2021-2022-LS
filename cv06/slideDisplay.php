<?php

require './SlidesDB.php';

$slidesDB = new SlidesDB();
$slides = $slidesDB->fetchAll();

$counter = 0;

?>

<div id="slider" class="carousel slide my-4" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php foreach ($slides as $slide) : ?>
            <li data-target="#slider" data-slide-to="<?php echo $counter; ?>" class="<?php echo $counter == 0 ? 'active' : ''; ?>"></li>
            <?php $counter++; ?>
        <?php endforeach; ?>
    </ol>
    <div class="carousel-inner" role="listbox">
        <?php $counter = 0; ?>
        <?php foreach ($slides as $slide) : ?>
            <div class="carousel-item slide <?php echo $counter == 0 ? 'active' : ''; ?>">
                <img class="d-block img-fluid slide-image" src="<?php echo $slide['img']; ?>" alt="<?php echo $slide['title']; ?>" width="400">
            </div>
            <?php $counter++; ?>
        <?php endforeach; ?>
    </div>
    <a class="carousel-control-prev bg-primary" href="#slider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Předchozí</span>
    </a>
    <a class="carousel-control-next bg-primary" href="#slider" role="button" data-slide="next">
        <span class="sr-only">Další</span>
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </a>
</div>