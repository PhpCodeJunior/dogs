<?php
include_once(dirname(__FILE__) . '/../connect.php');
class Dogs
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->error = array();
    }

    public function selectStories()
    {
        $stmt = $this->conn->prepare("select * from stories");
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }

    public function selectStoriesId($id)
    {
        $stmt = $this->conn->prepare("select * from stories where id=:id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }

    public function deleteStories($id)
    {
        $stmt = $this->conn->prepare("delete  from stories where id=:id");
        $stmt->bindValue(":id", $id);
        return $stmt->execute();
    }

    public function deleteStorie()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            if ($this->deleteStories($id)) {
                echo "stories is deleted";
            } else {
                $this->error[] = "failed delete";
            }
        }
    }

    public function addStories($author, $txt, $date, $img)
    {
        $real_time = date("Y-m-d H:i:s");
        $stmt = $this->conn->prepare("insert into stories(author,txt,date,img)values(:author,:txt,:date,:img)");
        $stmt->bindValue(":author", $author);
        $stmt->bindValue(":txt", $txt);
        $stmt->bindValue(":date", $real_time);
        $stmt->bindValue(":img", $img);
        return $stmt->execute();
    }

    public function getImages()
    {
        $imgFile = $_FILES["img"]["name"];
        $img_tmp = $_FILES["img"]["tmp_name"];
        $images_size = $_FILES["img"]["size"];
        $images_target = "C:\wamp\www\allAboutDogs/admin/imgStories/";
        $target_file = $images_target . basename($imgFile);
        $image_type = pathinfo($target_file, PATHINFO_EXTENSION);
        $check = getimagesize($img_tmp);
        if ($check == false) {
            echo "fajl nije slika";
        }
        if (file_exists($target_file)) {
            echo "fajl vec postoji";
        }
        if ($images_size > 50000) {
            $this->error[] = "slika je prevelika";
        }
        if ($image_type != "jpg" && $image_type != "jpeg" && $image_type != "gif" && $image_type != "png") {
            echo "ekstenzija nije dobra";
        }
        if (
        move_uploaded_file($img_tmp, $target_file)
        ) {
        } else {
            echo "failed";
        }
    }

    public function redirect($url)
    {
        header("location:$url");
    }

    public function editStories($id, $author, $txt, $date, $img)
    {
        //$realTime = $date;
        $date = date("Y-m-d H:i:s");
        $xplode = explode(" ", $date);
        $string = "$xplode[1]";
        $realTime = date("Y-m-d H:i:s", strtotime($string));

        $stmt = $this->conn->prepare("update stories set  author=:author,
        txt=:txt,
        date=:date,
        img=:img,
        where id=:id");
        $stmt->bindValue(":author", $author);
        $stmt->bindValue(":txt", $txt);
        $stmt->bindValue(":date", $realTime);
        $stmt->bindValue(":img", $img);
        $stmt->bindValue(":id", $id);
        return $stmt->execute();
    }

    public function editTable()
    {

        if (isset($_GET["editId"])) {
            $stmt = $this->conn->prepare("select * from stories where id=:id");
            $stmt->bindValue(":id", $_GET["editId"]);
            $stmt->execute();
            $e = $stmt->fetch(PDO::FETCH_OBJ);

            echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '" enctype="multipart/form-data">
                <input type="hidden" name="id" value="' . $e->id . '"><br>
                <input type="text" name="author" placeholder="author name" value="' . $e->author . '"><br>
                <textarea name="txt" type="text" placeholder="text">' . $e->txt . '</textarea><br>
                <input type="hidden" name="date"  value="' . $e->date . '"><br>
                <input type="file" name="img" value="' . $e->img . '"><br>
                <input type="submit" name="edit" class="input"><br>
            </form>';
        }
    }

    public function comm()
    {
        $stmt = $this->conn->prepare("select * from comments");
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }

    public function commId($id)
    {
        $stmt = $this->conn->prepare("select * from comments where commId=:commId");
        $stmt->bindValue(":commId", $id);
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }

    public function addComm($mess)
    {
        $real_time = date("Y-m-d H:i:s");
        $stmt = $this->conn->prepare("insert into comments(mess)values(:mess)");
        $stmt->bindValue(":mess", $mess);
        return $stmt->execute();
    }

    /*public function commIdid($id)
    {
        $stmt = $this->conn->prepare("select * from comments where id=:id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }
*/
    public function insertComm($mess)
    {
        if (empty($mess)) {
            echo "input filed<br>";
        } elseif (!empty($mess)) {
            $stmt = $this->conn->prepare("insert into comments(mess)values(:mess)");;
            $stmt->bindValue(":mess", $mess);
            return $stmt->execute();
        }
    }

    public function commTable()
    {
        if (isset($_POST["insert"])) {
            if ($this->insertComm($_POST["mess"])) {
            } else {
                echo "Your brand not inserted<br>";
            }
        }
        echo '<form method="post" action="' . $_SERVER["PHP_SELF"] . '">
            <input type="text" name="mess" placeholder="message">
            <input type="submit" name="insert" value="insert brand">
            </form>';

}

}
