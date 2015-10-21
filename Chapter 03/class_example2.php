<?php

class Person
{
    function say_hello()
    {
        echo "Hello World From Classes<br/>";
    }
}

$methods = get_class_methods("Person");
foreach($methods as $method)
{
    echo $method . "<br/>";
}

if(method_exists('Person', 'say_hello'))
    echo "Method Does Exist.<br/>";
else
    echo "Method Does Not Exist.<br/>";


?>