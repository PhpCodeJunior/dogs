<?php
include_once(dirname(__FILE__) . '/../class/classBooks.php');
$book = new Books($conn);
$cat=$book->category();
$brand=$book->brand();
$writer=$book->writer();


if(isset($_POST["insert"])){
    if($book->insertBooks($_POST["catId"],$_POST["brandId"],$_POST["writerId"],$_POST["title"],
        $_POST["description"],$img=$_FILES["images"]["name"],$img1=$_FILES["images"]["tmp_name"])){
        move_uploaded_file($img1,"/../../admin/imgStories/$img");
    }
}
include_once(dirname(__FILE__) . '/head.php');

?>
<div id="main">
    <h1 class="contact">ADD BOOKS</h1>

    <form method="post" action="<?php $_SERVER["PHP_SELF"] ;?>" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td>Select category</td>
                <td>
                    <select name="catId">
                        <option>Select a category</option>
                        <?php
                        foreach($cat as $ctg){?>
                            <option value='<?php echo $ctg->catId; ?>'><?php echo $ctg->title; ?></option>
                        <?php } ?>
                    </select></td>
            </tr>
            <tr>
                <td>Select brand</td>
                <td><select name="brandId">
                        <option>Select a brand</option>
                        <?php
                        foreach($brand as $b){?>
                            <option value='<?php echo $b->brandId; ?>'><?php echo $b->title; ?></option>
                        <?php } ?>
                    </select></td>
            </tr>
            <tr>
                <td>Select writer</td>
                <td><select name="writerId">
                        <option>Select a writer</option>
                        <?php
                        foreach($writer as $w){?>
                            <option value='<?php echo $w->writerId; ?>'><?php echo $w->fullname; ?></option>
                        <?php } ?>
                    </select></td>
            </tr>

            <tr>
                <td>Title</td>
                <td><input type="text" name="title"></td>
            </tr>

            <tr>
                <td>Desc</td>
                <td><input type="text" name="description"></td>
            </tr>

            <tr>
                <td>Images</td>
                <td><input type="file" name="images"></td>
            </tr>

            <tr>
                <td>Action</td>
                <td><input type="submit" name="insert"></td>
            </tr>
        </table>
    </form>
    <?php
    $p = $book->selectBooks();
    $book->deleteBooks();

    foreach($p as $prd) {
    echo "<h3>$prd->title</h3>
        <img src='../admin/imgStories/$prd->images' alt='slika'
             style='width: 30px;height: 30px;border:2px solid black;'><br>
        <b>$$prd->description</b><br>
        <a href='books.php?booksId=$prd->booksId'>Delete</a>
    ";}
    $book->editTableBooks();

    ?>
</div>
<div id="sidebar">
    <div id="form">
        <h1 class="contact">ADMIN STAF</h1>
        <a href="brand.php">SYSTEM FOR BOOKS/BRAND</a><br>
        <a href="category.php">SYSTEM FOR BOOKS/CATEGORY</a><br>
        <a href="writer.php">SYSTEM FOR BOOKS/WRITER</a><br>


    </div>

</div><!--sidebar-->
<?php

include_once(dirname(__FILE__) . '/footer.php');

?>


