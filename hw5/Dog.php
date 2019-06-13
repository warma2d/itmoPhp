<?php

class Dog implements Movement, Eat
{
    public function __construct()
    {
        echo 'Собака родилась!<br>';
    }

    public function move()
    {
        echo 'Собака движется<br>';
    }

    public function eat(& $animal)
    {
        if(! $animal instanceof Cat)
        {
            echo 'Ошибка! Собака может съесть только кошку!<br>';
            return;
        }
        echo self::class . ' съела животное класса '. get_class($animal).'<br>';

        $animal->eaten($animal);
    }
}