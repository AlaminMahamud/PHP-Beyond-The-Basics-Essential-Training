<?php

class Person
{

}

if(class_exists("Person"))
    echo "That Class has been defined <br/>";
else
    echo "Class Not Defined <br/>";

echo "<hr/>";

// A Cool Way to iterate through all the classes
$classes = get_declared_classes();
foreach($classes as $class)
{
    static $a = 1;
    if($a<10)
    {
        echo "0".$a++." => ".$class."<br/>";
        continue;
    }
    echo $a++." => ".$class."<br/>";
}


?>