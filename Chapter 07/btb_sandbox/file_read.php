<?php

$file = 'filetest.txt';
if($handle = fopen($file, 'r'))
{
    $content = fread($handle, 6);
    fclose($handle);
}

echo $content;
echo "<br/>";
echo nl2br($content);
echo "<hr/>";

// use filesize() to read the whole file
$file = 'filetest.txt';
if($handle = fopen($file, 'r'))
{
    $content = fread($handle, filesize($file));
    fclose($handle);
}

echo $content;
echo "<br/>";
echo nl2br($content);
echo "<hr/>";


// incremetal reading
$file = 'filetest.txt';
$content = "";
if($handle = fopen($file,'r'))
{
    while(!feof($handle))
    {
        $content.=fgets($handle);
    }
    fclose($handle);
}

echo $content;
echo "<hr/>";

?>