<?php
include_once(dirname(__FILE__) . '/../connect.php');
class Register{
    private $conn;
    public function __construct($conn){ $this->conn = $conn; }
    public function insertUsers($fName,$lName,$nName,$email,$pass,$images)
    {
            $stmt = $this->conn->prepare("insert into users(fName,lName,nName,email,pass,images)values(:fName,:lName,:nName,:email,:pass,:images)");
            $stmt->bindValue(":fName", $fName);
            $stmt->bindValue(":lName", $lName);
            $stmt->bindValue(":nName", $nName);
            $stmt->bindValue(":email", $email);
            $stmt->bindValue(":pass", $pass);
            $stmt->bindValue(":images", $images);
            return $stmt->execute();
        }
    public function selectUsers()
    {
        $stmt = $this->conn->prepare("select * from users");
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }

    public function filterEmail()
    {
        $email = @$_POST['email'];
        return (!filter_var($email, FILTER_VALIDATE_EMAIL));
    }

    public function emailExist()
    {
        $email = @$_POST['email'];
        $stmt = $this->conn->prepare("SELECT email FROM users WHERE  email=:email");
        $stmt->execute(array(':email' => $email));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['email'] == $email) {
        }
    }
    public function account($id){
        $stmt = $this->conn->prepare("select users.usersId, users.fName,users.lName,users.nName,users.email,users.pass,users.images
 from users where users.usersId=:usersId");
        $stmt->bindValue(":usersId", $id);
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }
    public function deleteUser($id)
    {
        $stmt = $this->conn->prepare("delete from users where usersId=:usersId");
        $stmt->bindValue(":usersId", $id);
        return $stmt->execute();
       // $rez = $stmt->fetch(PDO::FETCH_OBJ);
    }
        public function returnDelete(){
            if(isset($_GET["delId"])){
                session_start();
               if($_SESSION["usersId"] = $_GET["delId"]) {
                   $this->deleteUser($_SESSION["usersId"]);
                   $this->redirect("profile.php");
                   session_destroy();
               } else{
                   echo "delete is  failed";
               }
            }
        }


    public function editUser($id,$fName, $lName, $nName, $email, $pass, $images){
        $stmt = $this->conn->prepare("update  users set fName=:fName,lName=:lName,nName=:nName,
email=:email,pass=:pass,images=:images where usersId=:usersId");
        $stmt->bindValue(":fName", $fName);
         $stmt->bindValue(":lName", $lName);
         $stmt->bindValue(":nName", $nName);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":pass", $pass);
        $stmt->bindValue(":images", $images);
        $stmt->bindValue(":usersId", $id);
        return $stmt->execute();
    }
    public function editTableUser()
    {
        if ($_SERVER["REQUEST_METHOD"]=="POST") {
            if ($this->editUser($_POST["usersId"],$_POST["fName"], $_POST["lName"],$_POST["nName"],$_POST["email"],$_POST["pass"],
                $_FILES["images"]["name"])) {
                $img = $_FILES["images"]["name"];
                $img_tmp = $_FILES["images"]["tmp_name"];
                $t = (dirname(__FILE__) . '/../slike/users/');
                $target = $t;
                $finalTarget = $target.basename($img);
                move_uploaded_file($img_tmp,$finalTarget);
                $this->redirect("profile.php");
            } else {
                echo "BOOKS IS NOT EDIT<br>";
            }
        }
        if (isset($_GET["edId"])) {
            $stmt = $this->conn->prepare("select * from users where usersId=:usersId");
            $stmt->bindValue(":usersId", $_GET["edId"]);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);

            echo '<form method="post"  enctype="multipart/form-data" action="' . $_SERVER["PHP_SELF"] . '">
            <input type="hidden" name="usersId" value="' . $user->usersId . '">
            <input type="text" name="fName" value="' . $user->fName . '">
             <input type="text" name="lName" value="' . $user->lName . '">
              <input type="text" name="nName" value="' . $user->nName . '">
             <input type="text" name="email" value="' . $user->email . '">
             <input type="text" name="pass" value="' . $user->pass . '">
            <input type="file" name="images" value="' . $user->images . '">
            <input type="submit" name="editUser" value="edit user">
            </form>';
        }
    }

    public function changePass($id)
    {
        // session_start();
        $pass = md5($_POST["pass"]);
        $newPass = $_POST["newPass"];
        $passMd5 = md5($newPass);
        $confirmPass = $_POST["confirmPass"];
        $id = $_SESSION["usersId"];
        if (empty($pass) or empty($newPass) or empty($confirmPass)) {
            echo "empty password";
        }else{
            $query = $this->conn->prepare('SELECT * FROM users WHERE usersId=:usersId');
            $query->execute(array(':usersId' => $id));
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $_SESSION['usersId'] = $row['usersId'];
            $password = $row['pass'];
            if ($password == $pass) {
                if ($newPass == $confirmPass) {
                    $update = $this->conn->prepare("UPDATE users set pass='$passMd5' WHERE usersId='" . $_SESSION["usersId"] . "'");
                    return $update->execute();
                }
            }
        }
    }

public function validate($var){
    if(!preg_match("/^[a-zA-Z0-9_]{3,40}$/", $var)){
    }
}
    public function redirect($url){ header("location:$url"); }

    public function insertDogWalker($fullName, $age, $phone, $email, $description, $images){
        $stmt = $this->conn->prepare("insert into dogwalker(fullName,age,phone,email,description,images)
    values(:fullName,:age,:phone,:email,:description,:images)");
        $stmt->bindValue(":fullName", $fullName);
        $stmt->bindValue(":age", $age);
        $stmt->bindValue(":phone", $phone);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":description", $description);
        $stmt->bindValue(":images", $images);
        return $stmt->execute();
    }
    public function selectWalker()
    {
        $stmt = $this->conn->prepare("select * from dogwalker");
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }
    public function walkerId($walkerId)
    {
        $stmt = $this->conn->prepare("select * from dogwalker where walkerId=:walkerId");
        $stmt->bindValue(":walkerId", $walkerId);
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }
}

