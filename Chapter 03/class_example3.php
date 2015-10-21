<?php

class Person
{
    function say_hello()
    {
        echo "Hello From inside a class.<br/>";
    }
}

$person = new Person();
$person2 = new Person();

echo get_class($person) . "<br/>";
if(is_a($person, "Person"))
    echo "Yup! it is a person<br/>";
else
    echo "No It is not a Person<br/>";

$person->say_hello();

?>