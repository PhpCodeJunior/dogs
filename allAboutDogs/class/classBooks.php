<?php
include_once(dirname(__FILE__) . '/../connect.php');


class Books
{
    private $conn;
    public $error;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->error = array();
    }

    public function category()
    {
        $stmt = $this->conn->prepare("select * from categoryBooks");
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }


    public function selectCategory()
    {
        ?>
        <table border="1">
            <tr>
                <td>Title</td>
                <td>action</td>
            </tr>
            <?php foreach ($this->category() as $ctg){ ?>
            <tr>
                <td><?php echo $ctg->title; ?></a></td>
                <td><a href="../admin/category.php?catId=<?php echo $ctg->catId; ?>">Delete</a>|
                    <a href="../admin/category.php?editId=<?php echo $ctg->catId; ?>">Edit</a>
                </td>
                <?php } ?>
            </tr>
        </table>
    <?php }

    public function categoryId($catId)
    {
        $stmt = $this->conn->prepare("select * from books where catId=:catId");
        $stmt->bindValue(":catId", $catId);
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }

    public function deleteCategoryId($id)
    {
        $stmt = $this->conn->prepare("delete from categoryBooks where catId=:catId");
        $stmt->bindValue(":catId", $id);
        $stmt->execute();
    }

    public function delete()
    {
        if (isset($_GET["catId"])) {
            $id = $_GET["catId"];
            $this->deleteCategoryId($id);
        }
    }

    public function insertCategory($title)
    {
        if (empty($title)) {
            echo "input filed<br>";
        } elseif (!empty($title)) {
            $stmt = $this->conn->prepare("insert into categoryBooks(title)values(:title)");;
            $stmt->bindValue(":title", $title);
            return $stmt->execute();
        }
    }

    public function categoryTable()
    {
        if (isset($_POST["insert"])) {
            if ($this->insertCategory($_POST["title"])) {
            } else {
                echo "Your category not inserted<br>";
            }
        }
        echo '<form method="post" action="' . $_SERVER["PHP_SELF"] . '">
            <input type="text" name="title" placeholder="insert category">
            <input type="submit" name="insert" value="insert category">
            </form>';
    }

    public function editCategory($id, $title)
    {
        $stmt = $this->conn->prepare("update  categoryBooks set title=:title where catId=:catId");
        $stmt->bindValue(":title", $title);
        $stmt->bindValue(":catId", $id);
        return $stmt->execute();
    }

    public function editTable()
    {
        if (isset($_POST["edit"])) {
            if ($this->editCategory($_POST["catId"], $_POST["title"])) {
            } else {
                echo "Your category not edit<br>";
            }
        }
        if (isset($_GET["editId"])) {
            $stmt = $this->conn->prepare("select * from categoryBooks where catId=:catId");
            $stmt->bindValue(":catId", $_GET["editId"]);
            $stmt->execute();
            $edit = $stmt->fetch(PDO::FETCH_OBJ);

            echo '<form method="post" action="' . $_SERVER["PHP_SELF"] . '">
            <input type="hidden" name="catId" value="' . $edit->catId . '">
            <input type="text" name="title" value="' . $edit->title . '">
            <input type="submit" name="edit" value="edit category">
            </form>';
        }
    }

// end category option

//books option
    public function deleteBrandId($id)
    {
        $stmt = $this->conn->prepare("delete from brandBooks where brandId=:brandId");
        $stmt->bindValue(":brandId", $id);
        $stmt->execute();
    }

    public function deleteBrand()
    {
        if (isset($_GET["brandId"])) {
            $id = $_GET["brandId"];
            $this->deleteBrandId($id);
        }
    }

    public function brand()
    {
        $stmt = $this->conn->prepare("select * from brandBooks");
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }

    public function selectBrand()
    {
        ?>
        <table border="1">
            <tr>
                <td>Title</td>
                <td>action</td>
            </tr>
            <?php foreach ($this->brand() as $b){ ?>
            <tr>
                <td><?php echo $b->title; ?></a></td>
                <td><a href="../admin/brand.php?brandId=<?php echo $b->brandId; ?>">Delete</a>|
                    <a href="../admin/brand.php?editBrandId=<?php echo $b->brandId; ?>">Edit</a>
                </td>
                <?php } ?>
            </tr>
        </table>
    <?php }

    public function brandId($brandId)
    {
        $stmt = $this->conn->prepare("select * from books where brandId=:brandId");
        $stmt->bindValue(":brandId", $brandId);
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }

    public function insertBrand($title)
    {
        if (empty($title)) {
            echo "input filed<br>";
        } elseif (!empty($title)) {
            $stmt = $this->conn->prepare("insert into brandBooks(title)values(:title)");;
            $stmt->bindValue(":title", $title);
            return $stmt->execute();
        }
    }

    public function brandTable()
    {
        if (isset($_POST["insert"])) {
            if ($this->insertBrand($_POST["title"])) {
            } else {
                echo "Your brand not inserted<br>";
            }
        }
        echo '<form method="post" action="' . $_SERVER["PHP_SELF"] . '">
            <input type="text" name="title" placeholder="insert brand">
            <input type="submit" name="insert" value="insert brand">
            </form>';
    }

    public function editBrand($id, $title)
    {
        $stmt = $this->conn->prepare("update  brandBooks set title=:title where brandId=:brandId");
        $stmt->bindValue(":title", $title);
        $stmt->bindValue(":brandId", $id);
        return $stmt->execute();
    }

    public function editTableBrand()
    {
        if (isset($_POST["editBrand"])) {
            if ($this->editBrand($_POST["brandId"], $_POST["title"])) {
            } else {
                echo "Your brand not edit<br>";
            }
        }
        if (isset($_GET["editBrandId"])) {
            $stmt = $this->conn->prepare("select * from brandBooks where brandId=:brandId");
            $stmt->bindValue(":brandId", $_GET["editBrandId"]);
            $stmt->execute();
            $brand = $stmt->fetch(PDO::FETCH_OBJ);

            echo '<form method="post" action="' . $_SERVER["PHP_SELF"] . '">
            <input type="hidden" name="brandId" value="' . $brand->brandId . '">
            <input type="text" name="title" value="' . $brand->title . '">
            <input type="submit" name="editBrand" value="edit brand">
            </form>';
        }
    }
//end brand
// writer option
    public function editWriter($id, $fullname)
    {
        $stmt = $this->conn->prepare("update  writerBooks set fullname=:fullname where writerId=:writerId");
        $stmt->bindValue(":fullname", $fullname);
        $stmt->bindValue(":writerId", $id);
        return $stmt->execute();
    }

    public function editTableWriter()
    {
        if (isset($_POST["editWriter"])) {
            if ($this->editWriter($_POST["writerId"], $_POST["fullname"])) {
            } else {
                echo "Your writer not edit<br>";
            }
        }
        if (isset($_GET["editWriterId"])) {
            $stmt = $this->conn->prepare("select * from writerBooks where writerId=:writerId");
            $stmt->bindValue(":writerId", $_GET["editWriterId"]);
            $stmt->execute();
            $writer = $stmt->fetch(PDO::FETCH_OBJ);

            echo '<form method="post" action="' . $_SERVER["PHP_SELF"] . '">
            <input type="hidden" name="writerId" value="' . $writer->writerId . '">
            <input type="text" name="fullname" value="' . $writer->fullname . '">
            <input type="submit" name="editWriter" value="edit writer">
            </form>';
        }
    }

        public function insertWriter($writer)
        {
            if (empty($writer)) {
                echo "input filed<br>";
            } elseif (!empty($writer)) {
                $stmt = $this->conn->prepare("insert into writerBooks(fullname)values(:fullname)");;
                $stmt->bindValue(":fullname", $writer);
                return $stmt->execute();
            }
        }

        public function writerTable()
        {
            if (isset($_POST["insertWriter"])) {
                if ($this->insertWriter($_POST["fullname"])) {
                } else {
                    echo "Your writer not inserted<br>";
                }
            }
            echo '<form method="post" action="' . $_SERVER["PHP_SELF"] . '">
            <input type="text" name="fullname" placeholder="insert writer">
            <input type="submit" name="insertWriter" value="insert writer">
            </form>';
        }

        public function deleteWriterId($id)
        {
            $stmt = $this->conn->prepare("delete from writerBooks where writerId=:writerId");
            $stmt->bindValue(":writerId", $id);
            $stmt->execute();
        }

    public function deleteWriter()
    {
        if (isset($_GET["writerId"])) {
            $id = $_GET["writerId"];
            $this->deleteWriterId($id);
        }
    }


    public function writer()
    {
        $stmt = $this->conn->prepare("select * from writerBooks");
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }

    public function selectWriter()
    {
        ?>
        <table border="1">
            <tr>
                <td>Full name</td>
                <td>action</td>
            </tr>
            <?php foreach ($this->writer() as $w){ ?>
            <tr>
                <td><?php echo $w->fullname; ?></a></td>
                <td><a href="../admin/writer.php?writerId=<?php echo $w->writerId; ?>">Delete</a>|
                    <a href="../admin/writer.php?editWriterId=<?php echo $w->writerId; ?>">Edit</a>
                </td>
                <?php } ?>
            </tr>
        </table>
    <?php }

    public function writerId($writerId)
    {
        $stmt = $this->conn->prepare("select * from books where writerId=:writerId");
        $stmt->bindValue(":writerId", $writerId);
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }

//end writer
    //books
public function insertBooks($catId, $brandId, $writerId, $title, $description, $images){
    $stmt = $this->conn->prepare("insert into books(catId,brandId,writerId,title,description,images)
    values(:catId,:brandId,:writerId,:title,:description,:images)");
    $stmt->bindValue(":catId", $catId);
    $stmt->bindValue(":brandId", $brandId);
    $stmt->bindValue(":writerId", $writerId);
    $stmt->bindValue(":title", $title);
    $stmt->bindValue(":description", $description);
    $stmt->bindValue(":images", $images);
    return $stmt->execute();
}

public function selectBooks()
{
    $stmt = $this->conn->prepare("select * from books");
    $stmt->execute();
    $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $rez;
}

public function deleteBooksId($id)
{
    $stmt = $this->conn->prepare("delete from books where booksId=:booksId");
    $stmt->bindValue(":booksId", $id);
    $stmt->execute();
}

public function deleteBooks(){
    if (isset($_GET["booksId"])){
        $id = $_GET["booksId"];
        $this->deleteBooksId($id);
    }
}

    public function editBooks(/*$catId, $brandId, $writerId,*/ $booksId, $title, $description, $images){
        $stmt = $this->conn->prepare("update  books set /*catId=:catId,brandId=:brandId,writerId=:writerId,
*/title=:title,description=:description,images=:images where booksId=:booksId");
       /* $stmt->bindValue(":catId", $catId);
        $stmt->bindValue(":brandId", $brandId);
        $stmt->bindValue(":writerId", $writerId);*/
        $stmt->bindValue(":title", $title);
        $stmt->bindValue(":description", $description);
        $stmt->bindValue(":images", $images);
        $stmt->bindValue(":booksId", $booksId);
        return $stmt->execute();
    }
    public function editTableBooks()
    {
        if ($_SERVER["REQUEST_METHOD"]=="POST") {
            if ($this->editBooks(/*$_POST["catId"], $_POST["brandId"],$_POST["writerId"],*/$_POST["booksId"],$_POST["title"],$_POST["description"],
                $_FILES["images"]["name"])) {
                $img = $_FILES["images"]["name"];
                $img_tmp = $_FILES["images"]["tmp_name"];
                $target = "/../../admin/imgStories/";
                $finalTarget = $target.basename($img);
                move_uploaded_file($img_tmp,$finalTarget);
            } else {
                echo "BOOKS IS NOT EDIT<br>";
            }
        }
        if (isset($_GET["editBooksId"])) {
            $stmt = $this->conn->prepare("select * from books where booksId=:booksId");
            $stmt->bindValue(":booksId", $_GET["editBooksId"]);
            $stmt->execute();
            $book = $stmt->fetch(PDO::FETCH_OBJ);

            echo '<form method="post"  enctype="multipart/form-data" action="' . $_SERVER["PHP_SELF"] . '">
            <input type="hidden" name="booksId" value="' . $book->booksId . '">
            <input type="text" name="title" value="' . $book->title . '">
             <input type="text" name="description" value="' . $book->description . '">
            <input type="file" name="images" value="' . $book->images . '">
            <input type="submit" name="edit" value="edit books">
            </form>';
        }
    }
}



