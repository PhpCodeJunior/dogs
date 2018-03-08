<?php
include_once(dirname(__FILE__) . '/head.php');
include_once(dirname(__FILE__) . '/../class/classDogs.php');
$dogs = new Dogs($conn);
$errMSGauthor =$errMSGtxt=$errMSGimg= "";
$valid = true;
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $author = $_POST['author'];
    $txt = $_POST['txt'];
    $imgFile = $_FILES['img']['name'];
    if (empty($author)) {
        $errMSGauthor = "Please Enter Author.";
        $valid = false;
    }
    if (empty($txt)) {
        $errMSGtxt = "Please Enter Your Text.";
        $valid = false;

    }
    if (empty($imgFile)) {
        $errMSGimg = "Please Select Image File.";
        $valid = false;
    }
    if ($valid) {
        if ($dogs->addStories($author, $txt, $_POST['date'], $imgFile)) {
            $dogs->getImages();
        }
    }
}

?>
<div id="main">
    <h1 style="color: white;
    text-shadow: 2px 2px 4px #000000;">ADD STORIES</h1>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
    <table border="1">
        <tr>
            <th>AUTHOR</th>
            <th>TEXT</th>
            <th>IMAGES</th>
            <th>ACTION</th>
        </tr>
        <tr>
            <td><input type="text" name="author"><p><?php echo $errMSGauthor; ?></p></td>
            <td><textarea name="txt" type="text"></textarea><p><?php echo $errMSGtxt; ?></p></td>
            <input type="hidden" name="date">
            <td><input type="file" name="img"><p><?php echo $errMSGimg; ?></p></td>
            <td><input type="submit" name="insert" value="INSERT"></td>
        </tr>
    </table>
</form>

    <h1 style="color: white;
    text-shadow: 2px 2px 4px #000000;">VIEW ALL STORIES</h1>

    <?php
    $dogs->deleteStorie();
    $select = $dogs->selectStories();

    ?>
            <table border="1">
                <tr>
                    <th>AUTHOR</th>
                    <th>TEXT</th>
                    <th>DATE</th>
                    <th>IMAGES</th>
                    <th>ACTION</th>
                </tr>
                <?php
                foreach($select as $e) {
                $text = $e->txt;
                $maxText = substr($text, 0 , 100);?>
                <tr>
                    <td><?php echo $e->author; ?></td>
                    <td><?php echo $maxText; ?></td>
                    <td><?php echo $e->date; ?></td>
                    <td><img src="../admin/imgStories/<?php echo $e->img; ?>" alt="slika" style="width: 50px;height: 50px;"></td>
                    <td><a href="stories.php?id=<?php echo $e->id; ?>">DELETE</a></td>
                </tr>
                <?php  }?>
                </table>
</div>
<?php
include_once(dirname(__FILE__) . '/sidebar.php');
include_once(dirname(__FILE__) . '/footer.php');

