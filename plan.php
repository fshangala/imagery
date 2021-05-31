<?php
require_once 'header.php';
if(!isset($_GET["id"])){
    header("Location: /plans.php");
}
$plan = $planObj->get($_GET["id"]);

$planAttributeObj = new PlanAttribute();
$planAttributes = $planAttributeObj->get_where(["plan_id"=>$plan["id"]]);

$planPictureObj = new PlanPicture();
$pictures = $planPictureObj->get_where(["plan_id"=>$plan["id"]]);
?>

    <div class="container">
        
        <div class="card">
            <img id="plan-picture" src="<?php echo $plan["picture"];?>">
            <div class="body">
              <h3 id="plan-price"><?php echo $plan['price']; ?></h3>
                <p id="plan-description"><?php echo $plan["description"];?></p>

                <ul class="list" id="plan-attributes">
                <?php
                foreach($planAttributes as $attribute){
                    echo '<li class="item">'.$attribute["value"].'</li>';
                }
                ?>
                </ul>

                <div class="row">
                    <div class="col">
                        <div class="btn-group">
                            <button class="btn" data-toggle="modal" data-target="#modal">Buy Plan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      <div class="modal" id="modal">
        <div class="dialog">
          <div class="header"><button class="btn close" data-target="#modal">Close</button></div>
          <div class="body">

            <div class="card">
              <div class="body">
                <center>Airtel Money Payment</center>
                <form action="/api/sale.php" method="post">
                    <input type="hidden" name="type" value="buy">
                    <input type="hidden" class="input-plan-id" name="plan_id" value="<?php echo $plan['id']; ?>" required>
                    <div class="input-group">
                        <label>Phone</label>
                        <input type="text" name="alt_phone" class="form-control" placeholder="Enter your phone number here" required>
                    </div>
                    <div class="input-group">
                        <label>Transaction ID</label>
                        <input type="text" name="txnid" class="form-control" placeholder="Enter the transaction ID here" required>
                    </div>
                    <input type="submit" class="btn form-control" value="Submit"> 
                </form>
                <p>
                    Make a payment to <b>0978310632</b> and enter the Transaction ID  above.
                </p>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="row" id="plan-pictures">
      <?php
      foreach($pictures as $picture){
          echo '<div class="col"><img src="'.$picture["picture"].'"></div>';
      }
      ?>
      </div>

    </div>
    <script>
    var plan_id = 0;
    var url = location.search;
    var paramstr = url.substring(1);
    var paramarr = paramstr.split("&");
    for(var i=0;i<paramarr.length;i++){
      var arr = paramarr[i].split("=");
      if(arr[0] == "id"){
        plan_id = arr[1];
      }
    }
    if(plan_id == 0){
      alert("No plan to view! Navigating to plans page.");
      location.assign("plans.html");
    }
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