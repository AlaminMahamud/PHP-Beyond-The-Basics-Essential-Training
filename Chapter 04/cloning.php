<?php

    class Beverage
    {
        public $fname;
        function __construct()
        {
            echo "New beverage was created<br/>";
        }

        function __clone()
        {
            echo "Existing Beverages was cloned<br/>";
        }
    }

    $a = new Beverage();
    $a->name = "Coffee";
    echo $a->name;
    echo "<br/>";

    $b = $a; // always a references with objects
    $b->name = "tea";
    echo $a->name;
    echo "<br/>";

    $c = clone $a; // here $a and $c are reference types
    $c->name = "orange juice";
    echo $a->name;
    echo "<br/>";
    echo $c->name;
?>