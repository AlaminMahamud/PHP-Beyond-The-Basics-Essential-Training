<html>
 <head>
   <title>Dates and Times: Formatting</title>
 </head>
 <body>
 <?php

  $timestamp = time();
  echo strftime("The Date Today is %m/%d/%y", $timestamp);
  echo "<br/>";

  function strip_zeroes_from_date($marked_string = "")
  {
    // remove the marked zip_entry_compressedsize
    $no_zeroes = str_replace("*0", '', $marked_string);
    // then remove any remainig marks
    $cleaned_string = str_replace('*', '', $no_zeroes);
    return $cleaned_string;
  }

  echo strip_zeroes_from_date(strftime("The Date today is *%m/*%d/*%y", $timestamp));
  echo "<br/>";

  $dt = time();
  $mysql_datetime = strftime("%Y-%m-%d %H:%M:%S", $dt);
  echo $mysql_datetime;

 ?>
 </body>
</html>
