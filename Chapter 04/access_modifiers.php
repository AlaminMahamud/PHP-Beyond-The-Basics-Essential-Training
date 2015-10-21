<?php

class Example
{
    public $a = 1;
    private $b = 2;
    protected $c = 3;

    function show_abc()
    {
        echo $this->a."<br/>";
        echo $this->b."<br/>";
        echo $this->c."<br/>";
    }

    public function hello_everyone()
    {
        return "Hello Everyone<br/>";
    }

    private function hello_me()
    {
        return "Hello Me<br/>";
    }

    protected function hello_family()
    {
        return "Hello Family<br/>";
    }

    // public by default
    function hello()
    {
        $output = $this -> hello_everyone();
        $output.= $this -> hello_family();
        $output.= $this -> hello_me();
        return $output;
    }
}


$example = new Example();
echo "Public a: {$example->a} <br/>";
//echo "Private c: {$example->c} <br/>";
//echo "Protected b: {$example->b} <br/>";
$example-> show_abc();
echo "<br/>";
echo "Hello Everyone: {$example->hello_everyone()} <br/>";
//echo "Hello Family: {$example->hello_family()}<br/>";
//echo "Hello Me: {$example->hello_me()}<br/>";

echo $example->hello();

?>