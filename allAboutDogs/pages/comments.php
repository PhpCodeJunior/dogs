<?php
include_once(dirname(__FILE__) . '/../html/head2.php');
include_once(dirname(__FILE__) . '/../html/nav2.php');
$nameErr = $emailErr =  $commentErr = "";
$sent = "";
$sentErr = "";

$valid = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Input your filed name";
        $valid =false;

    }if (!preg_match("/^[a-zA-Z ]*$/",$_POST["name"])) {
        $nameErr = "Only letters and white space allowed";
        $valid =false;

    }
    if (empty($_POST["email"])) {
        $emailErr = "Input your filed name";
        $valid =false;
    }
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        $valid =false;

    }
    if (empty($_POST["message"])) {
        $commentErr = "Input your message";
        $valid =false;

    }if($valid){
        $subject = "your name ".$_POST['name'];
        $message = "your message".$_POST['message'];
        $headers = "from".$_POST['email'];
        if (mail($subject, $message, $headers)) {
            $sent = "message sent";
        } else {
            $sentErr = "failed";
        }
    }
}
?>
<div id="main">
<div id="comments">
        <form method="post"  action="<?php echo $_SERVER["PHP_SELF"];?>">
            <h1>SEND AS A MESSAGE</h1>

            <label>Name</label>&nbsp;<?php echo $nameErr; ?>
            <input type="text" name="name" placeholder="Your name..">

            <label>Email</label>&nbsp;<?php echo $emailErr; ?>
            <input type="text" name="email" placeholder="Your email..">

            <label>Message</label>&nbsp;<?php echo $commentErr; ?>
            <textarea name="message" type="text" placeholder="Your message.."></textarea>

            <input type="submit" value="Send">&nbsp;<?php echo $sent; ?><?php echo $sentErr; ?>
        </form>
</div>
</div>
    <?php
    include_once(dirname(__FILE__) . '/../html/sidebar.php');
    include_once(dirname(__FILE__) . '/../html/footer.php');
?>

