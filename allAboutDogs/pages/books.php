<?php
include_once(dirname(__FILE__) . '/../html/head2.php');
include_once(dirname(__FILE__) . '/../html/nav2.php');

include_once(dirname(__FILE__) . '/../class/classBooks.php');
$book = new Books($conn);
$cat=$book->category();
$brand=$book->brand();
$writer=$book->writer();
?>
<div id="main">
    <div id="comments">
    <div id="block">
        <?php
        $p = $book->selectBooks();
        foreach($p as $prd) {?>
            <div class="gallery">
                <img src="./../admin/imgStories/<?php echo $prd->images; ?>" alt="slika"
               style="width: 225px;height: 225px;">
                <div class="desc"><?php echo $prd->description; ?><br></div>
            </div><!--gallery-->
        <?php } ?>
    </div><!--block-->
    </div>
</div>
<div id="sidebar">
    <div id="comments">
    <h1 style="color: white;
    text-shadow: 2px 2px 4px #000000;text-align: center;">CATEGORY BOOKS</h1>
    <ul>
        <?php foreach($cat as $ctg){?>
            <li><a href="./../pages/category.php?catId=<?php echo $ctg->catId; ?>"><?php echo $ctg->title; ?></a></li>
        <?php } ?>
    </ul>
    <h1 style="color: white;
    text-shadow: 2px 2px 4px #000000;text-align: center;">NAME BOOKS</h1>    <ul>
        <?php foreach($brand as $books){?>
            <li><a href="./../pages/brand.php?brandId=<?php echo $books->brandId; ?>"><?php echo $books->title; ?></a></li>
        <?php } ?>
    </ul>
    <h1 style="text-align: center;color: white;
    text-shadow: 2px 2px 4px #000000;">WRITER</h1>    <ul>
        <?php foreach($writer as $writers){?>
            <li><a href="./../pages/writer.php?writerId=<?php echo $writers->writerId; ?>"><?php echo $writers->fullname; ?></a></li>
        <?php } ?>
    </ul>
    </div>
</div>



<?php
include_once(dirname(__FILE__) . '/../html/footer.php');

?>