<?php
$name = 'uwu';
$lastname = 'owo';
$fullname = $name . ' ' . $lastname;
echo $fullname;
$a = 5;
$a = $a + 5;
echo $a;
echo '5' === 5;
/*if ($person['name'] === 'homer'){
    echo 'ano';
} else {
    echo 'ne';
}*/
function add($a, $b)
{
    $result = $a + $b;
    return $result;
}
$addResult = add(55, 6);
$addResult = 55 + 6;
echo $addResult;
//vytvorte pole z 5 objektu
//informace o knihack nazev autor rok cena 

//v html se vypiose tolik divu
// v kazdem divu jsou tyto informace pod sebou
//6 informace jak stara je publikace

$fruits = ['blueberry', 'melon', 'kiwi', 'orange', 'stairfruit'];
$person = [
    'name' => 'homer',
    'lastname' => 'simpson',
    'age' => 75,

];

$books = [
    [
        'author' => 'author6',
        'title' => 'book6',
        'year' => 1975,
        'price' => 30.5,
    ], [
        'author' => 'author3',
        'title' => 'book3',
        'year' => 1999,
        'price' => 130,
    ],
    [
        'author' => 'author4',
        'title' => 'book4',
        'year' => 1999,
        'price' => 130,
    ], [
        'author' => 'author5',
        'title' => 'book5',
        'year' => 1999,
        'price' => 130,
    ]
];
class Person{
    private $name;
    private $age;
    private $gender;
    
    public function __construct($name, $age, $gender)
    {
        $this -> name = $name; 
        $this -> age = $age;
        $this -> gender = $gender;
    }
    public function getName(){
        return $this -> name;
    }
    public function getAge(){
        return $this -> age;
    }
    public function getGender(){
        return $this -> gender;
    }
    
}
$person1 = new Person('Dave', 20, 'M');
echo $person1 -> getName ();
echo $person1 -> getAge ();
echo $person1 -> getGender ();
function getAge($year)
{
    return date("Y") - $year;
}
var_dump($person);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">f
    <title>Document</title>
</head>

<body>
    <h1></h1>
    <h2><?php echo $name; ?></h2>
    <ul>
        <?php foreach ($fruits as $fruit) : ?>
            <li><?php echo $fruit; ?></li>
        <?php endforeach; ?>
    </ul>
    <p>
        this is <?php $person['name']; ?> <?php $person['lastname']; ?>
        and he is <?php $person['age']; ?> years old
    </p>
    <div>
        <?php foreach ($books as $book) : ?>
            <div>
                <p><?php echo $book['author']; ?></p>
                <p><?php echo $book['title']; ?></p>
                <p><?php echo $book['year']; ?></p>
                <p><?php echo $book['price']; ?></p>
                <p><?php echo getAge($book['year']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>