<?php

class Cat implements Movement, Eat, Eaten
{

    public function __construct()
    {
        echo 'Кошка родилась!<br>';
    }

    public function __destruct()
    {
        echo 'Кошка умерла!<br>';
    }

    public function move()
    {
        echo 'Кошка движется<br>';
    }

    public function eat(Eaten &$animal) //съесть можно только съедобное животное
    {
        if(! $animal instanceof Mouse)
        {
            echo 'Ошибка! Кошка может съесть только мышь!<br>';
            return;
        }
        echo self::class . ' съела животное класса '. get_class($animal).'<br>';

        $animal->eaten($animal);
    }

    public function eaten(&$animal)
    {
        $animal = null;
    }

}