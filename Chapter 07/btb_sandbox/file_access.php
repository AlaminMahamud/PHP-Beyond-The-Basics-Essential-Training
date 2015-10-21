<?php

$file = 'filetest.txt';
if($handle = fopen($file, 'w'))
{
    echo "file is successfully opened";
    fclose($handle);
}
else
{
    echo "could not open file for writing";
}

?>