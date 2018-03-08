<?php
include_once(dirname(__FILE__) . '/../class/classBooks.php');
$book = new Books($conn);

include_once(dirname(__FILE__) . '/head.php');

?>
    <div id="main">
        <br>
        <?php $book->categoryTable(); ?>
        <br>
        <?php $book->editTable();
        $book->delete();
        $book->selectCategory();?>
        <hr>

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