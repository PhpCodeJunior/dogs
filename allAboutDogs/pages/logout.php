<?php
//include_once(dirname(__FILE__) . '/../html/head2.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>

    <link rel="stylesheet" href='../s.css' type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
    <meta charset="utf-8">
</head>
<body>
<div id="container">
    <div id="container_fluid">


<div id="main">
    <div id="comments">
        <?php
        session_start();
        include_once(dirname(__FILE__) . '/../class/classLogin.php');
        $login = new Login($conn);
        $login->logout();
        echo "you are logout";
        ?>
    </div>
</div>
        <body>
        </body>
        </html>

