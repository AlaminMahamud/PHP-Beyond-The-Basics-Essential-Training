<?php

require_once("../../includes/initialize.php");

if(!$session->is_logged_in())
    redirect_to("login.php");
?>

<?php
$file = SITE_ROOT.DS."logs".DS."log.txt";
if($handle = fopen($file,'w'))
{
    $content = fread($handle, filesize($file));
    fclose($handle);
}else
{
    echo "file is not readable<br/>";
}

echo nl2br($content);

if($_GET['clear'] = true)
{
    log_action('clear', "Log has been cleared");
}

?>

<?php include_layout_template('admin_header.php')?>
    <h2>Menu</h2>
    <a href = "logfile.php?clear=true">Clear</a>
<?php include_layout_template('admin_header.php')?>