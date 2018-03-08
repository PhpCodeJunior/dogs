<?php
include_once(dirname(__FILE__) . '/../html/head2.php');
include_once(dirname(__FILE__) . '/../html/nav2.php');
?>
<div id="main">
    <div id="comments">
        <div class="container">
            <?php
            include_once(dirname(__FILE__) . '/../class/classRegister.php');
            $walker = new Register($conn);
            if(isset($_GET["id"])){
            $id = $_GET["id"];
            $walkerId = $walker->walkerId($id);
            foreach($walkerId as $w){
            ?>
            <img src="./../admin/imgStories/dogWalker/<?php echo $w->images; ?>" alt="img" class="image">
            <div class="overlay">
                <p><?php echo $w->description; ?></p>
                <p><?php echo $w->email; ?></p>
                <p><?php echo $w->phone; ?></p>

            </div>
            <?php }} ?>
        </div>
    </div>
</div>

<?php

include_once(dirname(__FILE__) . '/../html/sidebar.php');
include_once(dirname(__FILE__) . '/../html/footer.php');
?>
