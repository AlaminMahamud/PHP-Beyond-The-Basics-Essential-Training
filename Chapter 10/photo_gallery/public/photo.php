<?php
require_once("../includes/initialize.php");
if(empty($_GET['id']))
{
    $session->message("No photograph id was provided");
    redirect_to(index.php);
}

$photo = Photograph::find_by_id($_GET['id']);
if(!$photo)
{
    $session->message("The photo could not be located");
    redirect_to("index.php");
}

if(isset($_POST['submit']))
{
    $author = trim($_POST['author']);
    $body   = trim($_POST['body']);

    $new_comment = Commnet::make($photo->id, $author, $body);
    if($new_comment && $new_comment->save())
    {
        // Comment Saved
        // No Message needed; seeing the comment is proof enough

        // Important! You could the page render from here
        // But then if the page is reloaded, the form will try
        // to resubmit the comment, So redirect instead
        redirect_to("photo.php?id={$photo->id}");
    }
    else
    {
        $message = "There was an error that prevented the comment from being saved.";
    }

}else
{
    $author = "";
    $body   = "";
}

$comments = $photo->comments();

?>

<?php include_layout_template('header.php');?>

<a href = "index.php">
    &laquo; Back
</a>
<br/>

<div style="margin-left:20px;">
    <img src = "<?php echo $photo->image_path();?>" />
    <p>
        <?php echo $photo->caption;?>
    </p>
</div>


<div id="comments">
    <?php foreach($comments as $comment):?>
        <div class="comment" style="">
            <div  class ="author">
                <?php echo htmlentities($comment->author);?>
            </div>
            <div  class ="body">
                <?php echo strip_tags($comment->body, '<strong><em><p>');?>
            </div>
            <div class="meta-info">
                <?php echo datetime_to_text($comment->created);?>
            </div>
        </div>
    <?php endforeach;?>
    <?php if(empty($comments)) echo "No Commnets");?>
</div>

<!--List Comments-->
<div id="comment-form">
    <h3>New Comments</h3>
    <?php echo output_message($message); ?>
    <form action="photo.php?id=<?php echo $photo->id;?>" method="post">
        <table>
            <tr>
                <td>Your Name</td>
                <td><input type="text" name="author" value="<?php echo $author;?>"></td>
            </tr>
            <tr>
                <td>Your Comment</td>
                <td><textare name="body" cols = "40" row= "8" value="<?php echo $body;?>"></textare><
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Submit Comment"/></td>
            </tr>
        </table>
    </form>
</div>


<?php include_layout_template('footer.php');?>