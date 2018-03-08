<?php
include_once(dirname(__FILE__) . '/../html/head2.php');
include_once(dirname(__FILE__) . '/../html/nav2.php');
?>
<div id="main">
    <div id="comments">
        <?php
        include_once(dirname(__FILE__) . '/../class/classRegister.php');
        $reg = new Register($conn);
        if(isset($_SESSION["usersId"])) {
            if (isset($_SESSION["email"])) {
                $id = $_SESSION["usersId"];
                $users = $reg->account($_SESSION["usersId"]);
                foreach ($users as $user) { ?>
        <table border="1">
            <tr>
                <td>Name</td>
                <td><?php echo $user->fName; ?></td>
            </tr>
            <tr>
                <td>Last name</td>
                <td><?php echo $user->lName; ?></td>
            </tr><tr>
                <td>Nick name</td>
                <td><?php echo $user->nName; ?></td>
            </tr><tr>
                <td>Email</td>
                <td><?php echo $user->email; ?></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><?php echo $user->pass; ?></td>
            </tr>
            <tr>
                <td>Images</td>
                <td><img src="./../slike/users/<?php echo $user->images; ?>" style="width: 30px;height: 30px;border-radius:5px; "></td>
            </tr>
        </table>
                    <?php
            } }else {
                echo "You must be logged in to manage your account";
            }
        }
        ?>

    </div>
</div>
<div id="sidebar">
    <div id="comments">

            <?php
            if(isset($_SESSION["usersId"])){
            if(isset($_SESSION["email"])){?>
                <ul>
                    <?php
                $u = $reg->account($_SESSION["usersId"]);
                foreach ($u as $user) { ?>
                    <li><a href="deleteProfil.php?delId=<?php echo $user->usersId; ?>">DELETE</a></li>
                    <li><a href="editProfil.php?edId=<?php echo $user->usersId; ?>">EDIT</a></li>
                    <li><a href="changePass.php">CHANGE PASSWORD</a></li>
                    <?php } ?>
        </ul>
            <?php }else{
                echo "You must be logged in to manage your account ";
            }}
            ?>

    </div>
</div>

<?php
include_once(dirname(__FILE__) . '/../html/footer.php');?>

