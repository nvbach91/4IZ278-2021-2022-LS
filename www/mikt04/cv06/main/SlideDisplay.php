
<?php require_once __DIR__ . '/../db/SliderDB.php';

$slidesDB = new SlidesDB();
$slides = $slidesDB->fetchAll();

$index = 0;
?>

<div id="slider" class="carousel slide my-4" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php foreach($slides as $index=>$slide): ?>
        <li data-target="#slider" data-slide-to="<?php echo $index; ?>" class="<?php echo $index == 0 ? 'active' : ''; ?>"></li>
        <?php $index++; endforeach; ?>
    </ol>
    <div class="carousel-inner" role="listbox">
        <?php foreach($slides as $index=>$slide): ?>
        <div class="carousel-item slide <?php echo $index == 0 ? 'active' : ''; ?>">
            <img class="d-block img-fluid slide-image" src="<?php echo $slide['img']; ?>" alt="<?php echo $slide['text']; ?>">
        </div>
        <?php $index++; endforeach; ?>
    </div>
    <a class="carousel-control-prev slide-div" href="#slider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next slide-div" href="#slider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div> 