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

    public function eat(Eaten &$animal)
    {
        if(! $animal instanceof Cat && ! $animal instanceof Mouse)
        {
            echo 'Ошибка! Собака может съесть только кошку или мышь!<br>';
            return;
        }
        echo self::class . ' съела животное класса '. get_class($animal).'<br>';

        $animal->eaten($animal);
    }
}