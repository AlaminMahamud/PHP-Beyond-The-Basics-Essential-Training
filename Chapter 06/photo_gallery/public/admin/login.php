<?php
require_once("../../includes/initialize.php");
?>

<?php
if($session->is_logged_in())
    redirect_to("index.php");

// Remember to give your form's submit tag a name = "submit" attribute
if(isset($_POST['submit']))
{
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // check database to see if username and password exist
    $found_user = User::authienticate($usernmae, $password);
    if($found_user)
    {
        $session->login($found_user);
        redirect_to("index.php");
    }
    else
    {
        // username/password combo was not found in the database
        $message = "Username/password combination incorrect";
    }
}
else
{
    $username = "";
    $password = "";
}

?>



<?php include_layout_template('admin_header.php')?>

            <h2>Staff Login</h2>
            <?php echo output_message($message);?>

            <form action = "login.php" method = "post">
                <table>
                    <tr>
                        <td>Username: </td>
                        <td><input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username);?>" </td>
                    </tr>
                    <tr>
                        <td>Password: </td>
                        <td><input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password);?>" </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type = "submit" name = "submit" value = "login"/>
                        </td>
                    </tr>
                </table>
            </form>

<?php include_layout_template('admin_footer.php')?>

<?php if(isset($database))
    {
        $database->close_connection();
    }
?>