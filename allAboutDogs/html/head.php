<!DOCTYPE html>
<html>
<head>
    <title></title>

    <link rel="stylesheet" href='s.css' type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
    <meta charset="utf-8">
</head>
<body>
<div id="container">
    <div id="container_fluid">

    <div id="login">
    <ul>
        <li><a href="././pages/register.php">Register</a></li>
        <li><a href="././pages/login.php">Login</a></li>
        <li><?php session_start();
            include_once("C:\wamp\www\allAboutDogs/class/classLogin.php");
            if(isset($_SESSION["usersId"])){
                if(isset($_SESSION["email"])){
                    echo "<p style='color: white;'>welcome".$_SESSION["email"]."</p>"; ?>
        <li><a href="././pages/logout.php">Logout</a></li>

        <?php  }}
            ?></li>
    </ul>

</div><!--login-->