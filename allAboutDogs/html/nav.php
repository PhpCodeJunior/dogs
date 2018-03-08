<div id="joinus">
    <img src="././slike/joinus.png">
</div><!--joinus-->

<div id="nav">
    <?php

   /* function htmlpath($realpath) {
        $i = substr_count($_SERVER["DOCUMENT_ROOT"],'/')."<br>";
        $baserealpath=realpath(str_repeat('../',$i-1));
        $htmlpath=str_replace($baserealpath,'',$realpath);
        return $htmlpath;
    }

    function rp($path) {
        $out=array();
        foreach(explode('/', $path) as $i=>$fold){
            if ($fold=='' || $fold=='.') continue;
            if ($fold=='..' && $i>0 && end($out)!='..') array_pop($out);
            else $out[]= $fold;
        } return ($path{0}=='/'?'/':'').join('/', $out);
    }*/

    //define("root",dirname(__FILE__));
?>

    <ul>
        <li><a href="index.php">HOME</a></li>
        <li><a href="pages/books.php">BOOKS FOR DOGS</a></li>
        <li><a href="pages/dogWalker.php">DOG WALKER</a></li>
        <li><a href="pages/comments.php">SEND AS A MESSAGE</a></li>
        <li><a href="pages/chat.php">CHAT</a></li>
        <li><?php
            if(isset($_SESSION["email"])){?>
                <a href="pages/profile.php">Profile page</a><?php } ?></li>
    </ul>
</div><!--nav-->