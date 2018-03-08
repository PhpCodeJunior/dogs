<?php
include_once(dirname(__FILE__) . '/../class/classRegister.php');
$walkers = new Register($conn);
$walker= $walkers->selectWalker();
include_once(dirname(__FILE__) . '/../html/head2.php');
include_once(dirname(__FILE__) . '/../html/nav2.php');
?>
<div id="main">
    <div id="comments">
        <table class="table">
<?php foreach($walker as $w){
    $name = $w->fullName;
    $age = $w->age;
    ?>
            <tr>
                <th>Full Name</th>
                <th>Age</th>
            </tr>
            <tr>
                <td><a href="./../pages/fullDogWalker.php?id=<?php echo $w->walkerId; ?>"><?php echo $name; ?></td>
                <td><?php echo $age; ?></td>
            </tr>
    <?php } ?>
        </table>

    </div>
</div>
<?php

include_once(dirname(__FILE__) . '/../html/sidebar.php');
include_once(dirname(__FILE__) . '/../html/footer.php');
?>