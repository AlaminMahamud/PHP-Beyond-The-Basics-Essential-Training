<?php

// ..

$dir = ".";
if(is_dir($dir))
{
    if($dir_handle = opendir($dir))
    {
        while($filename = readdir($dir_handle))
        {
            echo "filename: {$filename} <br/>";
        }
        closedir($dir_handle);
    }
}

echo "<hr/>";

// scandir(): reads all filenames into an array
if(is_dir($dir))
{
    $dir_array = scandir($dir);
    foreach($dir_array as $file)
    {
        if(stripos($file, '.')>0)
        {
            echo "filename: {$file}<br/>";
        }
    }
}


?>