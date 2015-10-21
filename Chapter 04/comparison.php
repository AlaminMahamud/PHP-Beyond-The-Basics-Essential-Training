<?php

    class Box
    {
        public $name = 'Box';
    }

    $box         = new Box();
    $box_ref     = $box;         // both are pointing to the same object
    $box_clone   = clone $box;   // they are just shallow copy

    $box_changed = clone $box;
    $box_changed -> name = "changed box";

    $another_box = new Box();

    // == is casual and just checks to see if the attributes are the same
    echo $box == $box_ref ? 'true':'false';
    echo "<br/>";
    echo $box == $box_clone ? 'true':'false';
    echo "<br/>";
    echo $box == $box_changed ? 'true':'false';
    echo "<br/>";
    echo $box == $another_box ? 'true':'false';
    echo "<br/>";

    // === is strict and checks to see if the references are the same object
    echo $box === $box_ref ? 'true':'false';    //true
    echo "<br/>";
    echo $box === $box_clone ? 'true':'false';  //false
    echo "<br/>";
    echo $box === $box_changed ? 'true':'false'; // false
    echo "<br/>";
    echo $box === $another_box ? 'true':'false'; // false
    echo "<br/>";


?>