<?php

require_once 'Eat.php';
require_once 'Movement.php';
require_once 'Eaten.php';

require_once 'Mouse.php';
require_once 'Cat.php';
require_once 'Dog.php';



$mouse = new Mouse();
$dog = new Dog();
$cat = new Cat();

$mouse->move();

$cat->eat($mouse);
$cat->move();

$dog->eat($cat);
$dog->move();
