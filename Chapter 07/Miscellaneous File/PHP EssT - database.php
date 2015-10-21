<?php

    require_once("config.php");

    // 1. Create a Database Connection
    $connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
    if(!$connection)
            die("Database Connection Failed: ".mysql_error());

    // 2. Select a Database to use
    $db_select = mysql_select_db(DB_NAME,$connection);
    if(!$db_select)
        die("Database Selection Failed: ".mysql_error());

    // 3. Perform a Database Query
    $sql = "SELECT * FROM subjects";
    $result = mysql_query($sql,$connection);

    // 4. Use Returned Data
    while($row = mysql_fetch_array($result))
    {
        // output data
    }

    // 5. Close Connection
    if(isset($connection))
    {
        mysql_close($connection);
        unset($connection);
    }
?>