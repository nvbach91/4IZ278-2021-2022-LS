<?php
$books =[
        [
        "name"=>"Karkulka",
        "year"=> 2007,
        "author"=> "Karel",
        "price"=> 205
        ],
    [
        "name"=>"Popelka",
        "year"=> 1980,
        "author"=> "Pepa",
        "price"=> 185
    ],
    [
        "name"=>"Růženka",
        "year"=> 1950,
        "author"=> "Jan",
        "price"=> 120
    ],
    [
        "name"=>"Zlatovláska",
        "year"=> 1999,
        "author"=> "Matěj",
        "price"=> 129
    ],
    [
        "name"=>"Jasněnka",
        "year"=> 1984,
        "author"=> "Zdeněk",
        "price"=> 175
    ]
    ]
?>


<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        .container{
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-left: 30px;
            width: 300px;
        }
        .book{
            display: flex;
            flex-direction: column;
            border: black 1px solid;
            padding: 10px 0 10px 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php foreach ($books as $book):?>
        <div class="book">
            <h2><?php echo $book['name'] ?></h2>
            autor: <?php echo $book['author'] ?> <br>
            rok vydání: <?php echo $book['year'] ?> <br>
            stáří: <?php echo 2022-$book['year'] ?> <br>
            cena: <?php echo $book['price'] ?> <br>
        </div>
        <?php endforeach ?>
        </div>
</body>
</html>