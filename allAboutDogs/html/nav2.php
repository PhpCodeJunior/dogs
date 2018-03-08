<div id="joinus">
    <img src="./../slike/joinus.png">
</div><!--joinus-->

<div id="nav">

    <ul>
        <li><a href="../index.php">HOME</a></li>
        <li><a href="../pages/books.php">BOOKS FOR DOGS</a></li>
        <li><a href="">ADOPTION</a></li>
        <li><a href="../pages/dogWalker.php">DOG WALKER</a></li>
        <li><a href="../pages/comments.php">SEND AS A MESSAGE</a></li>
        <li><a href="../pages/chat.php">CHAT</a></li>
        <li><?php
            if(isset($_SESSION["email"])){?>
                <a href="../pages/profile.php">Profile page</a><?php } ?></li>
    </ul>
</div><!--nav-->