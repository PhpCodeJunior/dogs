
<?php

include_once(dirname(__FILE__) . '/../class/classRegister.php');
$reg = new Register($conn);
$errFname=$errLname=$errNick=$errEmail=$errPass=$errImg="";
$formValid=true;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name=$_POST["fName"];
    $lname=$_POST["lName"];
    $nname=$_POST["nName"];
    $email=$_POST["email"];
    $pass=$_POST["pass"];
    //$pass2=password_hash($pass,PASSWORD_DEFAULT);
    $pass2 = md5($pass);
    $img = $_FILES["images"]["name"];
    $imgTmp = $_FILES["images"]["tmp_name"];
    $imgSize = $_FILES["images"]["size"];
    $t = (dirname(__FILE__) . '/../slike/users/');
    $target = $t;
    $target_file = $target . basename($img);
    $image_type = pathinfo($target_file, PATHINFO_EXTENSION);

    if(file_exists($target_file)){
        $errImg= "images already exists";
        $formValid=false;
    }
    if($image_type !="jpg" && $image_type !="png" && $image_type !="gif" && $image_type !="jpeg"){
        $errImg= "extensions is wrong";
        $formValid=false;
    }
    if($imgSize>500000000){
        $errImg= "iamges is too big";
        $formValid=false;
    }


    if(empty($name)){
            $errFname="Please input your name";
            $formValid=false;}

    if($reg->validate($name)){
        $errFname= "minimum 6, max 40 characters, and alphanumeric";
        $formValid=false;
    }
        if(empty($lname)){
            $errLname="Please input your  last name";
            $formValid=false;
        }
    if($reg->validate($lname)){
        $errLname= "minimum 6, max 40 characters, and alphanumeric";
        $formValid=false;
    }
        if(empty($nname)){
            $errNick="Please input your nick name";
            $formValid=false;
        }
    if($reg->validate($nname)){
        $errNick= "minimum 6, max 40 characters, and alphanumeric";
        $formValid=false;
    }
        if(empty($email)){
            $errEmail="Please input your email";
            $formValid=false;
        }
    if($reg->filterEmail()){
        $errEmail="Please input your valid email";
        $formValid=false;
    }
    if($reg->emailExist()){
        $errEmail="Please choose another email";
        $formValid=false;
    }
        if(empty($pass)){
            $errFname="Please input your password";
            $formValid=false;
        }
        if(empty($img)){
            $errImg="Please input your images";
            $formValid=false;
        }

if($formValid) {
    if ($reg->insertUsers($name, $lname, $nname, $email, $pass2, $img)) {
move_uploaded_file($imgTmp,$target_file);
        echo "<script>window.alert('YOUR ARE REGISTER IN OUR WEB SITE,CONGRATULATIONS');</script>";
        }
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
    <style>
        body{
            font-family: 'Righteous', cursive;
        }

        .containerReg{
            width: 50%;
            height: 650px;
            background: #c9e2b3;
            margin: 0 auto;
            border: 2px solid #fff;
            box-shadow: 0 15px 40px rgba(0,0,0,.5);
        }
        .containerReg .leftReg{
            float: left;
            width: 50%;
            height: 650px;
            box-sizing: border-box;
        }
        .containerReg .rightReg{
            float: right;
            width: 50%;
            height: 650px;
            box-sizing: border-box;
        }
        .formReg{
            box-sizing: border-box;
            width: 100%;
            padding: 80px 40px;
            height: 650px;
            background: #fff;
        }

        .formReg p{
            margin: 0;
            padding: 0;
            font-weight: bold;
            color: #1b6d85;
        }
        .formReg input{
            margin-bottom: 20px;
        }
        .formReg input[type="text"],
        .formReg input[type="password"]{
            border: none;
            border-bottom: 2px solid #c0a16b;
            outline: none;
            height: 40px;
        }
        .formReg input[type="text"]:focus,
        .formReg input[type="password"]:focus{
            border-bottom: 2px solid #c0a16b;
        }
        .formReg input[type="submit"]{
            border: none;
            outline: none;
            height: 40px;
            color: #fff;
            background: chartreuse;
            cursor: pointer;
            width: 69%;
        }
        .formReg input[type="submit"]:hover{ background: chocolate;}
        .formReg a{
            color: #1b6d85;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="title"></div>
<div class="containerReg">
    <div class="leftReg">
        <h1>Sing up form</h1><br>
        <a href="../pages/login.php">Login here</a>

    </div>
    <div class="rightReg">
        <div class="formReg">
            <form  method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
                <p>First name<br><?php echo $errFname; ?></p>
                <input type="text" name="fName" placeholder="frist name">
                <p>Last name<br><?php echo $errLname; ?></p>
                <input type="text" name="lName" placeholder="last name">
                <p>Nick name<br><?php echo $errNick; ?></p>
                <input type="text" name="nName" placeholder="nick name">
                <p>Email<br><?php echo $errEmail; ?></p>
                <input type="text" name="email" placeholder="email">
                <p>Password<br><?php echo $errPass; ?></p>
                <input type="password" name="pass" placeholder="*******"><br>
                <p>Profil images<br><?php echo $errImg; ?></p>
                <input type="file" name="images"><br>
                <input type="submit" name="submit" value="sing up"><br>
            </form>
        </div>
    </div>
</div>
</body>
</html>