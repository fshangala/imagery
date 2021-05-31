<?php
require_once 'header.php';

if(!isset($_GET["access_code"])){
    header("Location: /");
}

$saleObj = new Sale();
$planFileObj = new PlanFile();
$code_sale = $saleObj->get_where(["access_code"=>$_GET["access_code"]], false);
$code_plan = $planObj->get($code_sale["plan_id"]);
if($code_sale["status"]=="approved"){
    $plan_files = $planFileObj->get_where(["plan_id"=>$code_plan["id"]]);
} else {
    $plan_files = [];
}

?>

    <div class="container">
        
        <div class="card">
            <img id="plan-picture" src="<?php echo $code_plan["picture"]; ?>">
            <div class="body">
                <ul class="list">
                    <li class="item">ID: <?php echo $code_sale["id"]; ?></li>
                    <li class="item">PHONE: <?php echo $code_sale["phone"]; ?></li>
                    <li class="item">STATUS: <?php echo $code_sale["status"]; ?></li>
                </ul>
                <hr>
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>File</th>
                        <th></th>
                    </tr>
                    <?php
                    foreach($plan_files as $file){
                        ?>
                        <tr>
                            <td><?php echo $file["id"]; ?></td>
                            <td><?php echo $file["file"]; ?></td>
                            <td><a href="<?php echo $file["id"]; ?>" download>Download</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>

      <div class="row" id="plan-pictures"></div>

    </div>
    <script>
    var access_code = "";
    var url = location.search;
    var paramstr = url.substring(1);
    var paramarr = paramstr.split("&");
    for(var i=0;i<paramarr.length;i++){
      var arr = paramarr[i].split("=");
      if(arr[0] == "access_code"){
        access_code = arr[1];
      }
    }
    if(access_code == ""){
      alert("Restricted access! Navigating to plans page.");
      location.assign("plans.php");
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