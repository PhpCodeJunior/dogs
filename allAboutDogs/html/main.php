
<?php
include_once(dirname(__FILE__) . '/../class/classDogs.php');

$dogs = new Dogs($conn);
$main = $dogs->selectStories();
?>
<div id="main">
    <div id="comments">
    <div id="slideShow">

        <img class="slideImages" src="././slike/slidePhoto/1.jpg">
        <img class="slideImages" src="././slike/slidePhoto/2.jpg">
        <img class="slideImages" src="././slike/slidePhoto/3.jpg">
        <button class="btn" onclick="plusImage(-1)" id="btn1">&#10094;</button>
        <button class="btn" onclick="plusImage(1)" id="btn2">&#10095;</button>
        <script>
            var index = 1;
            function plusImage(n){
                index =  index+n;
                showImage(index);
            }
            showImage(1);
            function showImage(n){
                var i;
                var x = document.getElementsByClassName("slideImages");
                if(n > x.length){index = 1};
                if(n < 1 ){index = x.length};

                for(i=0;i< x.length;i++){
                    x[i].style.display="none";
                }
                x[index-1].style.display="block";
            }
            autoSlide();
            function autoSlide(){
                var i;
                var x = document.getElementsByClassName("slideImages");
                for(i=0;i< x.length;i++){
                    x[i].style.display="none";
                }
                if(index> x.length){index=1};
                x[index-1].style.display="block";
                index++;
                setTimeout(autoSlide,2000);
            }
        </script>

    </div>
    <h1 style="color: white;
    text-shadow: 2px 2px 4px #000000;text-align: center;">TOP STORIES</h1>
    <hr>
    <div id="block">

        <?php foreach($main as $m){
            $text = $m->txt;
            $max = substr($text,0,20); ?>
        <div class="gallery">

            <img src="././admin/imgStories/<?php echo $m->img; ?>" alt="img" style="width: 225px;height: 225px;">
            <div class="desc">&nbsp; <?php echo $max; ?><br><a href="././pages/more.php?id=<?php echo $m->id; ?>">More</a></div>
        </div><!--gallery-->
        <?php } ?>
    </div><!--block-->
</div>
</div><!--main-->