<html>

  <head>
    <title>Date and Times : Unix </title>
  </head>

  <body>
    <?php
    /**
     * Created by PhpStorm.
     * User: Md. Alamin Mahamud
     * Date: 10/16/2015
     * Time: 8:10 AM
     */

     echo time();
     echo '<br/>';
     echo mktime(2,30,45,10,1,2009);
     echo '<br/>';

     // checkdate
     echo checkdate(12,31,2000) ? 'true' : 'false';
     echo '<br/>';
     echo checkdate(2,31,2009) ? 'true' : 'false';
     echo '<br/>';

     $unix_timestamp = strtotime(last monday);
     echo $unix_timestamp . "<br/>";
     ?>
  </body>

</html>
