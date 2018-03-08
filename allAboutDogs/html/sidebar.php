<div id="sidebar">
<div id="comments">
    <script>
        var slide_index = 0;
        var slide_array = ["funny","best friend","amazing","interesting"];
        var element;
        function slideNext(){
            slide_index++;
            element.style.opacity=0;
            if(slide_index >(slide_array.length-1)){
                slide_index=0;
            }
            setTimeout(" slide()",1000);

        }
        function slide(){
            element.innerHTML = slide_array[slide_index];
            element.style.opacity=1;
            setTimeout(" slideNext()",2000);
        }
    </script>
    <p style="color: #8a6d3b;"> &nbsp;Be human, because, dogs is <span id="slide" style="color: red;opacity: 0;transition: opacity 1.0s linear 0s;"></span></p>
    <script>element = document.getElementById("slide");slide();</script>

    <br>
    <?php
    include_once(dirname(__FILE__) . '/../class/classRegister.php');

    $walker = new Register($conn);

    $errName=$errAge=$errPhone=$errEmail=$errDesc=$errImg="";
    $valid=true;
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $name=@$_POST["fullName"];
        $age=@$_POST["age"];
        $phone=@$_POST["phone"];
        $email=@$_POST["email"];
        $desc=@$_POST["description"];
        $img = @$_FILES["images"]["name"];
        $imgTmp = @$_FILES["images"]["tmp_name"];
        $imgSize =@$_FILES["images"]["size"];
        $t = (dirname(__FILE__) . '/../admin/imgStories/dogWalker/');
        $target = $t;
        $target_file = $target . basename($img);
        $image_type = pathinfo($target_file, PATHINFO_EXTENSION);

        if(file_exists($target_file)){
            $errImg= "images already exists";
            $valid=false;
        }
        if($image_type !="jpg" && "png" && "gif" && "jpeg"){
            $errImg= "extensions is wrong";
            $valid=false;
        }
        if($imgSize>500000000){
            $errImg= "iamges is too big";
            $valid=false;
        }


        if(empty($name)){
            $errName="Please input your name";
            $valid=false;}
        if(empty($phone)){
            $errPhone="Please input your phone";
            $formValid=false;}
        if($walker->validate($name)){
            $errName= "minimum 3, max 40 characters, and alphanumeric";
            $valid=false;
        }
        if(empty($desc)){
            $errDesc="Please input your  description";
            $valid=false;
        }


        if(empty($email)){
            $errEmail="Please input your email";
            $valid=false;
        }
        if($walker->filterEmail()){
            $errEmail="Please input your valid email";
            $valid=false;
        }
        if($walker->emailExist()){
            $errEmail="Please choose another email";
            $vallid=false;
        }
        if(empty($age)){
            $errAge="Please input your age";
            $valid=false;
        }
        if(empty($img)){
            $errImg="Please input your images";
            $valid=false;
        }
        if($valid) {
            if ($walker->insertDogWalker($name, $age, $phone, $email, $desc, $img)) {
                move_uploaded_file($imgTmp,$target_file);
                echo "<script>window.alert('CONGRATULATIONS,YOUR PROFILE SEE AT DOG WALKER NAVIGATION.');</script>";
            }
        }
    }
    ?>
    <button onclick="hide_show()" style="color: red; width: 100%;height: 30px;">Click to see form for dog walker</button>
    <form id="text" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data" style="display:none;">
        <h1 class="contact">Log in as a dog set</h1>

        <input type="text" name="fullName"  placeholder="your fullname"><br><?php echo $errName; ?>
        <input type="text" name="age"  placeholder="age"><br><?php echo $errAge; ?>
        <input type="text" name="phone" placeholder="phone number"><br><?php echo $errPhone; ?>
        <input type="text" name="email"  placeholder="your email"><br><?php echo $errEmail; ?>
        <textarea name="description"  type="text"  placeholder="something about yourself and your job"></textarea><br><?php echo $errDesc; ?>
        <input type="file" name="images"><br><?php echo $errImg; ?>
        <input type="submit" name="send request"  value="send message"><br>
    </form>


    <script>
        function hide_show(){
            var x =  document.getElementById('text');
            if(x.style.display==='none'){
                x.style.display='block';
            }else{
                x.style.display='none';
            }
        }
    </script>
</div>
</div><!--sidebar-->