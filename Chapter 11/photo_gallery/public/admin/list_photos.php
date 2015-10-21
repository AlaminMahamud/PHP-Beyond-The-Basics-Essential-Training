<?php
require_once("../../includes/initialize.php");
if(!$session->is_logged_in())
{
    redirect_to('login.php');
}
// Find all the photos
$photos = Photograph :: find_all();
include_layout_template('admin_header.php');
?>
<h2>paragraph</h2>
<table class="bordered">
    <tr>
        <th>Image</th>
        <th>Filename</th>
        <th>Caption</th>
        <th>Size</th>
        <th>Type</th>
    </tr>
    <?php foreach($photos as $photo):?>
        <td><img src="../<?php echo $photo->image_path();?>" width ="100"/></td>
        <td><?php echo $photo->filename;?></td>
        <td><?php echo $photo->caption;?></td>
        <td><?php echo $photo->size_as_text();?></td>
        <td><?php echo $photo->type;?></td>
        <td>
            <a href="comments.php?id=<?php echo $photo->id; ?>">
                <?php echo count($photo->comments()); ?>
            </a>
        </td>
        <td><a href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a></td>

    <?php endforeach;?>
</table>
<br/>
<a href="photo_upload.php">Upload a new photograph</a>
<?php include_layout_template('admin_footer.php');?>