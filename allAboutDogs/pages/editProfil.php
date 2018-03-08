<?php
include_once(dirname(__FILE__) . '/../html/head2.php');
include_once(dirname(__FILE__) . '/../html/nav2.php');
include_once(dirname(__FILE__) . '/../class/classRegister.php');
$reg = new Register($conn);
?>
    <div id="main"><!--div main-->
        <div id="comments"><!--div comments-->
            <?php $reg->editTableUser(); ?>

        </div>
        </div>
<?php
include_once(dirname(__FILE__) . '/../html/sidebar.php');
include_once(dirname(__FILE__) . '/../html/footer.php');
?>