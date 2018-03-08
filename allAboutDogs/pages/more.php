<?php
include_once(dirname(__FILE__) . '/../html/head2.php');
include_once(dirname(__FILE__) . '/../html/nav2.php');


include_once(dirname(__FILE__) . '/../class/classDogs.php');
$dogs = new Dogs($conn);


?>
<div id="main">
    <h1 style="color: white;
    text-shadow: 2px 2px 4px #000000;text-align: center;">STORIES</h1>
    <hr>
    <div id="block">
        <?php
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $storiesId = $dogs->selectStoriesId($id);
            foreach($storiesId as $m){
             ?>
            <div style="width: 100%;">
                <img src="./../admin/imgStories/<?php echo $m->img; ?>" alt="img" style="width: 100%;height: 300px;">
                <p style="color: #255625;">Author:<?php echo $m->author; ?></p>
                <div style="width: 100%;">
                    <?php echo $m->txt; ?><br><p style="color: #1b6d85;"><?php echo $m->date; ?></p></div>
            </div><!--gallery-->
        <?php }} ?>



    </div><!--block-->
</div><!--main-->
<?php
include_once(dirname(__FILE__) . '/../html/sidebar.php');
include_once(dirname(__FILE__) . '/../html/footer.php');
?>

