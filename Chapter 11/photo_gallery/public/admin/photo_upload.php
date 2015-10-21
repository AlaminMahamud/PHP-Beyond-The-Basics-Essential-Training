<?php

require_once("../../includes/initializer.php");
if(!$session->is_logged_in())
    redirect_to("login.php");

$max_file_size = 1048576;    // expressed in bytes
                            // 10240    = 10KB
                            // 102400   = 100 KB
                            // 1048576  = 1 KB
                            // 10485760 = 10KB


$message = "";
if(isset($_POST['submit']))
{
    $photo = new Photograph();
    $photo->caption = $_POST['caption'];
    $photo->attach_file($_FILES['file_upload']);
    if($photo->save())
    {
        // Success
        $message = "Photographs uploaded successfully";
        // Failure
        $message = join("<br/>", $photo->erros);
    }
}

include_layout_template('admin_header.php');?>
    <h2>Photo Upload</h2>
    <?php echo output_message($message);?>
    <form action = "photo_upload.php" enctype="multipart/form-data" method="post">
        <input type="hidden" name = "MAX_FILE_SIZE" value = "<?php echo $max_file_size;?>"/>
        <p><input type="file" name = "file_upload"/></form></p>
        <p>Caption: <input type="text" name = "caption" value=""></p>
        <input type="submit" name="submit" value="upload"/>
    </form>
<?php
include_layout_template('admin_footer.php');
?>

