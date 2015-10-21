<?php
    echo "<pre>";
    if(!empty($_FILES['file_upload']))
    print_r($_FILES['file_upload']);
    echo "</pre>";
    echo "<hr/>";
?>

<html>
<head>
    <title>Photo upload</title>
</head>

<body>
<?php
    // the maximum file size (in bytes) must be declared before the file input field
    // and can't be larger than setting for upload_max_file_size in php.ini
    //
    // This form value can be manipulated. You Should still use it, but you rely
    // on upload_maxfilesize as the absoulte limit
    // think of it as a polite declaration: "Hey PHP, here comes a file less than X.."\
    // PHP will stop and complain once X is exceeded
    //
    // 1 megabyte is actually 1,048,576 bytes
    // You can round it unless the precission matters

?>


<?php
    if(!empty($message))
        echo "<p>{$message}</p>";
?>

<form action = "upload.php" enctype = "multipart/form-data" method = "POST">
    <input type = "hidden" name ="MAX_FILE_SIZE" value = "1000000"/>
    <input type = "file" name="file_upload"/>
    <input type = "submit" name = "submit" value = "Upload"/>
</form>

</body>
</html>