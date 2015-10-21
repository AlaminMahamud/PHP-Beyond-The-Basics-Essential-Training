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
    file_put_contents($file, '');
    log_action('Logs Cleared', "by User Id {$session -> user_id}");
    redirect_to('logfile.php');
}

?>

<?php include_layout_template('admin_header.php')?>
    <h2>Menu</h2>
    <a href = "logfile.php?clear=true">Clear</a>
<?php
    if(file_exists($file) && is_readable($file) && $handle = fopen($file, 'r'))
    {
        echo "<ul class=\"log-entries\">";
        while(!feof($handle))
        {
            $entry = fgets($handle);
            if(trim($entry) != "")
            {
                echo "<li>{$entry}</li>";
            }

        }
        echo "</ul>";
        fclose($handle);
    }else
    {
        echo "could not read from {$file}";
    }
?>
<?php include_layout_template('admin_footer.php')?>