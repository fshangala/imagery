<?php 
require_once 'header.php';
$plans = $planObj->get_all();
?>

    <div class="container">
        
      <div class="row" id="all-plans">

      <?php
      foreach($plans as $plan){
          ?>
        <div class="col">
          <div class="card">
            <img src="<?php echo $plan["picture"]; ?>">
            <div class="body">
              <p><?php echo $plan["description"]; ?></p>
              <div class="btn-group">
                <a href="plan.html?id=<?php echo $plan["id"]; ?>" class="btn"><?php echo $plan["price"]; ?> View</a>
              </div>
            </div>
          </div>
        </div>
        <?php
      }
      ?>

      </div>
    </div>

    <script>
    </script>

    <footer>
      <h2>Social Links</h2>
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