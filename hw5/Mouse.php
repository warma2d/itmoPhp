<?php

class Mouse implements Movement, Eaten
{
    public function __construct()
    {
        echo 'Мышь родилась!<br>';
    }

    public function __destruct()
    {
        echo 'Мышь умерла!<br>';
    }

    public function move()
    {
        echo 'Мышь движется<br>';
    }

    public function eaten(&$animal)
    {
        $animal = null;
    }
}