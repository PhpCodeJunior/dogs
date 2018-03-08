<?php
include_once(dirname(__FILE__) . '/../html/head2.php');
include_once(dirname(__FILE__) . '/../html/nav2.php');
?>
<div id="main"><!--div main-->
    <div id="comments"><!--div comments-->

        <?php
        //forma za glavni komentar
            if(!isset($_SESSION["usersId"]) && !isset($_SESSION["email"])){
             echo "<h1>Welcome guest, please login.</h1><br>";
             }else{
                echo "welcome".$_SESSION["email"]."<br>";
                include_once(dirname(__FILE__) . '/../class/classLogin.php');
                $comm = new Login($conn);
                $errT="";
                $valid=true;
                if($_SERVER["REQUEST_METHOD"]=="POST") {
                 $t = $_POST["txt"];
                if(empty($t)){
                echo "please fill";
                $valid=false;
                }
                if($valid) {
                $user_id = $comm->getLoggedInUserId($_SESSION["email"]);
                if ($comm->insertComm($t, $_POST["realdate"], $user_id)) {
                    echo "Your messages has delivered<br>";
                    $valid = true;
                }
            }
        }
    }
    ?>
    <form method='post'  enctype='multipart/form-data' action='<?php echo $_SERVER["PHP_SELF"]; ?>'>
        <input type='hidden'  name='id' ><br>
        <input type='hidden' name='realdate' ><br>
        <p>Leave a comment</p>
        <textarea name='txt' type='txt'></textarea><br>
        <input type='submit' name='comm' value='INSERT'><br>
    </form>

    <?php
    include_once(dirname(__FILE__) . '/../class/classLogin.php');
    $comm = new Login($conn);
    $c = $comm->join();
    echo "<br>";
    foreach($c as $cm) {
        echo "<img src='./../slike/users/$cm->images' style='width: 50px;height: 50px;border-radius: 10px;'>";
        echo '&nbsp;';
        echo $cm->nName . "<br>";
        echo '&nbsp;';
        echo $cm->txt . "<br>";
        echo '&nbsp;';
        echo $cm->realdate . "<br>";
        echo "<hr>";
    }
    ?>
    </div><!--end div comments-->
</div><!--end div main-->
<?php
include_once(dirname(__FILE__) . '/../html/sidebar.php');
include_once(dirname(__FILE__) . '/../html/footer.php');
?>