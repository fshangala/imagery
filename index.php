<?php
require_once 'header.php';
$featured = $planObj->get_featured();

$slideObj = new Slide();
$slides = $slideObj->get_all();
?>
    <div class="slider">
    <?php 
    foreach($slides as $slide){
        echo '<img src="'.$slide["picture"].'">';
    }
    ?>
    </div>

    <div class="container">

      <center><h1>Featured Plans</h1></center>
      
      <div class="row" id="all-plans">
      
      <?php
      foreach($featured as $plan){
          ?>
        <div class="col"> 
          <div class="card">
            <img src="<?php echo $plan["picture"];?>">
            <div class="body">
              <p><?php echo $plan["description"];?></p>
              <div class="btn-group">
                <a href="plan.php?id=<?php echo $plan["id"];?>" class="btn">View Plan</a>
              </div>
            </div>
          </div>
        </div>
        <?php
      }
      ?>

      </div>
      <br>
      <center><a href="plans.html" class="btn" style="width:100%;">View more</a></center>

      <div class="modal" id="modal">
        <div class="dialog">
          <div class="header"><button class="btn close" data-target="#modal">Close</button></div>
          <div class="body">

            <div class="card">
              <img src="assets/images/sunset-in-the-mountains.png">
              <div class="body">
                <p>House Plan description goes here</p>

                <ul class="list">
                  <li class="item">house plan attributes</li>
                  <li class="item">house plan attributes</li>
                  <li class="item">house plan attributes</li>
                  <li class="item">house plan attributes</li>
                </ul>

                <div class="row">
                  <div class="col">
                    <div class="btn-group">
                      <button class="btn">Buy Plan</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
    <script>
    $(".slider").slick({
        infinity: true,
        dots: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        speed: 500,
        responsive: [
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    $(".slick-prev").html("<");
    $(".slick-next").html(">");
    </script>

    <footer>
      <div class="container">
        <form action="plan-files.html" method="get">
            <div class="input-group">
                <label>Access Code</label>
                <input type="text" class="form-control" name="access_code" placeholder="Enter access code" required>
            </div>
            <input type="submit" class="btn form-control" value="Submit"> 
        </form>
      </div>
      <h2 class="footer-heading">Social Links</h2>
      <a href="#" class="btn">Facebook</a>
      <a href="#" class="btn">Tweeter</a>
      <a href="#" class="btn">YouTube</a>
      <div class="bar">
        &copy; Imagery 2021, proudly designed by <a href="https://linkedin.com/in/fshangala">fshangala</a>
      </div>
    </footer>

    <!--Imagery javascript-->
    <script src="assets/js/main.js"></script>
  </body>
</html>