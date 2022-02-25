<?php 
require_once("Person.php");

function generatePeople(){
    $person1 = new Person(
        "https://gallery.lajtkep.dev/resources/db5d5e98c00dc5cc113b195441395f06e35685edb622986e44f63882d8757d4a.jpg",
        "Lajtkep",
        "Matěj",
        '5-Oct-2000',
        "Fullstack developer",
        "xDent",
        "Duch█████ ███",
        "4██ █3",
        "███",
        "Teplice",
        "+420 735 ███ ███",
        "matej.lajtkep@gmail.com",
        "https://lajtkep.dev",
        true
    );
    
    $person2 = new Person(
        "https://gallery.lajtkep.dev/resources/552bba184c1ff4994ac51a4e1dced91a8ffc1c74f0baf051f32216614d79f6ae.jpg",
        "Paul",
        "Catovák",
        '12-Dec-1948',
        "Fulltime cat",
        "Street s.r.o.",
        "Vyšehrad",
        "133 7",
        "134",
        "Praha",
        "0118 999 881 999 119 725 3",
        "paul.cat@meow.com",
        "https://paul.cat",
        false
    );
    
    $person3 = new Person(
        "https://gallery.lajtkep.dev/resources/faf47b90b63710d8a3c929917fd2c840066485e45bed084db73ba9443d78ef5a.gif",
        "Pepe",
        "Pepinson",
        '1-Jan-2008',
        "Fullstack honker",
        "4chan",
        "Pepestreet",
        "981 43",
        "42",
        "Pepe",
        "+420 343 123 442",
        "pepe@clown.li",
        "https://honk,honk",
        true
    );

    return [$person1, $person2, $person3];
}
?>