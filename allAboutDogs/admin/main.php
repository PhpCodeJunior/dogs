<div id="main">
    <img src="./../slike/dogs.jpg" class="img">
    <h1 style="color: white;
    text-shadow: 2px 2px 4px #000000;">WELCOME TO ADMIN PANEL</h1>
    <?php session_start();
    include_once(dirname(__FILE__) . '/../class/classLogin.php');
    $role = $_SESSION["admin"];
    if(!isset($_SESSION["admin"]) || $role!="admin") {
        echo "admin, please login";
    }else{ ?>
        <h1 style="color: yellowgreen; font-size: medium;"> welcome <?php echo $_SESSION["email"]; ?><a href="./../pages/logout.php">LOGOUT</a></h1>
    <hr>
<?php } ?>
</div><!--main-->