<?php
include_once(dirname(__FILE__) . '/../connect.php');
class Login
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function selectUsers($email, $pass)
    {
        $query = $this->conn->prepare('SELECT * FROM users WHERE email=:email AND pass=:pass');
        $query->execute(array(':email' => $email, ':pass' => $pass));
        if ($query->rowCount() == 0) {
            echo "bad account";
        } else {
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $_SESSION["email"] = $row['email'];
            $_SESSION['usersId'] = $row['usersId'];
            $_SESSION['admin'] = $row['role'];
            if ($_SESSION['admin'] == "admin") {
                $this->redirect("./../admin/indexAdmin.php");
            } else {
                $this->session();
            }
        }
    }

    public function filterEmail()
    {
        $email = $_POST['email'];
        return (!filter_var($email, FILTER_VALIDATE_EMAIL));
    }

    public function emailExist()
    {
        $email = $_POST['email'];
        $stmt = $this->conn->prepare("SELECT email FROM users WHERE  email=:email");
        $stmt->execute(array(':email' => $email));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['email'] != $email) {
        }
    }

    public function redirect($url)
    {
        header("location:$url");
    }

    public function session()
    {
        $_SESSION['email'] = $_POST["email"];
        if (isset($_SESSION["email"])) {
            $this->redirect("/allAboutDogs/index.php");
        }
    }

    /*public function hashPass(){
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $stmt = $this->conn->prepare("SELECT pass FROM users WHERE  email=:email");
        $stmt->bindValue(":email",$email);
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $hash_pass = $row->pass;
        $hash = password_verify($pass,$hash_pass);
        if ($hash==0) {
            echo "password do not match";
        }
    }*/

    public function logout()
    {
        //session_start();
        session_destroy();
        echo "<a href='./../pages/login.php'>Login again</a>";
    }

    public function forgotPassword($email)
    {
        $stmt = $this->conn->prepare("select * from users where email=:email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            echo "send email";
        } else {
            echo "email does not exists";
        }

    }

     public function getForgotPassword(){
         if(isset($_POST["forgot"])) {
             if ($r = $this->forgotPassword($_POST["email"])) {
                 $rez = $r->fetchAll(PDO::FETCH_OBJ);
                 $pass = $rez->pass;
                 $to = $rez->email;
                 $subject = "your recover password";
                 $message = "pLEASE Use THIs PASSWORD" . $pass;
                 $headers = "from :slavisa";
                 if (mail($to, $subject, $message, $headers)) {
                     echo "your password has been sent to your email";
                 } else {
                     echo "not sent";
                 }
             }
         }
         echo "
           <form method='post' action='".$_SERVER["PHP_SELF"]."'>
           <input type='text' name='email' placeholder='your email'><br>
           <input type='submit' name='forgot' value='send'><br>
           </form>
           ";
     }
    public function insertComm($txt, $realdate, $user_id)
    {
        $date1 = date("Y-m-d H:i:s");
        $stmt = $this->conn->prepare("insert into comm(txt,realdate,usersId)values(:txt,:realdate,:usersId)");
        $stmt->bindValue(":txt", $txt);
        $stmt->bindValue(":realdate", $date1);
        $stmt->bindValue(":usersId", $user_id);
        return $stmt->execute();
    }

    public function insertParentId($txt, $realdate, $user_id, $parentId)
    {
        $date1 = date("Y-m-d H:i:s");
        $stmt = $this->conn->prepare("insert into comm(txt,realdate,usersId,parentId)values(:txt,:realdate,:usersId,:parentId)");
        $stmt->bindValue(":txt", $txt);
        $stmt->bindValue(":realdate", $date1);
        $stmt->bindValue(":usersId", $user_id);
        $stmt->bindValue(":parentId", $parentId);

        return $stmt->execute();
    }

    public function getLoggedInUserId($email)
    {
        $stmt = $this->conn->prepare("SELECT usersId FROM users WHERE email = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function selectComm()
    {
        $stmt = $this->conn->prepare("select * from comm");
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }

    public function selectCommId($id)
    {
        $stmt = $this->conn->prepare("select * from comm where parentId=:parentId");
        $stmt->bindValue(":parentId", $id);
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }


    public function join()
    {
        $stmt = $this->conn->prepare("select users.usersId, users.nName,users.email,
 users.images, comm.id,comm.txt,comm.realdate from users inner join
         comm on users.usersId= comm.usersid");
        $stmt->execute();
        //$stmt->debugDumpParams();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo "total comments-" . ($stmt->rowCount());
        return $rez;

    }

   /* public function joinParentId($id)
    {
        $stmt = $this->conn->prepare("select users.usersId, users.nName,users.email,
 users.images, comm.id,comm.txt,comm.realdate from users inner join
         comm on users.usersId= comm.usersid where parentId=:parentId");
        $stmt->bindValue(":parentId", $id);
        $stmt->execute();
        //$stmt->debugDumpParams();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        //echo "ukupno komentara-" . ($stmt->rowCount());
        return $rez;

    }*/
}