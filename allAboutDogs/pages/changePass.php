<?php
include_once(dirname(__FILE__) . '/../html/head2.php');
include_once(dirname(__FILE__) . '/../html/nav2.php');
?>
<div id="main">
    <div id="comments">
        <?php
include_once(dirname(__FILE__) . '/../class/classRegister.php');
$pass = new Register($conn);
if($_SERVER["REQUEST_METHOD"]=="POST") {
    if($pass->changePass($_SESSION["usersId"])){
        session_destroy();
        $pass->redirect("login.php");

    }
}
       ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="password" name="pass" placeholder="pass"></br>
        <input type="password" name="newPass" placeholder="new pass"></br>
        <input type="password" name="confirmPass" placeholder="confirm pass"></br>
        <input type="submit" name="submit">
    </form>

    </div>
</div>
<div id="sidebar">
    <div id="comments">



    </div>
</div>

<?php
include_once(dirname(__FILE__) . '/../html/footer.php');?>
