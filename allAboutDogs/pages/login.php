<?php
session_start();
include_once(dirname(__FILE__) . '/../class/classLogin.php');


$login = new Login($conn);
$errEmail=$errPass="";
$formValid=true;
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    $passMd5 = md5($pass);
    if (empty($email)) {
        $errEmail = "Please select your email";
    }
    if ($login->filterEmail()) {
        $errEmail = "Please input valid email";
    }
    if ($login->emailExist()) {
        $errEmail = "Please input original email";
    }

    if (empty($pass)) {
        $errPass = "Please select your pass";
    }

    if ($formValid) {
        $login->selectUsers($email, $passMd5);
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
<style>
    body{
        font-family: 'Righteous', cursive;
    }


    .title h1{
        margin: 0;padding: 0;
        color: #777777;
        text-transform: uppercase;
        font-size: 36px;
    }
    .container{
        width: 50%;
        height: 450px;
        background: #c9e2b3;
        margin: 0 auto;
        border: 2px solid #fff;
        box-shadow: 0 15px 40px rgba(0,0,0,.5);
    }
    .container .left{
        float: left;
        width: 50%;
        height: 450px;
        box-sizing: border-box;
    }
    .container .right{
        float: right;
        width: 50%;
        height: 450px;
        box-sizing: border-box;
    }
    .form{
        box-sizing: border-box;
        width: 100%;
        padding: 80px 40px;
        height: 450px;
        background: #fff;
    }

    .form p{
        margin: 0;
        padding: 0;
        font-weight: bold;
        color: #1b6d85;
    }
    .form input{
        margin-bottom: 20px;
    }
    .form input[type="text"],
    .form input[type="password"]{
        border: none;
        border-bottom: 2px solid #c0a16b;
        outline: none;
        height: 40px;
    }
    .form input[type="text"]:focus,
    .form input[type="password"]:focus{
        border-bottom: 2px solid #c0a16b;
    }
    .form input[type="submit"]{
        border: none;
        outline: none;
        height: 40px;
        color: #fff;
        background: chartreuse;
        cursor: pointer;
        width: 69%;
    }
    .form input[type="submit"]:hover{ background: chocolate;}
    .form a{
        color: #1b6d85;
        font-size: 20px;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="container">
    <div class="left">
        <h1>Sing in <br>or be our guest <a href="../index.php">HOME PAGE</a></h1>
    </div>
    <div class="right">
        <div class="form">
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <p>Email<br><?php echo $errEmail; ?></p>
                <input type="text" name="email" placeholder="email">
                <p>Password<br><?php echo $errPass; ?></p>
                <input type="password" name="pass" placeholder="*******"><br>
                <input type="submit" name="submit" value="login"><br>
                <p id="func"></p>
                <a href="../pages/register.php">Register here</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>