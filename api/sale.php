<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'models.php';

$planObj = new Plan();
$fileObj = new PlanFile();
$saleObj = new Sale();

if(isset($_GET["type"])){
    $type = $_GET["type"];
    if($type=="all"){
        //api/sale.php?type=all
        $all_plans = $planObj->get_all();
        echo json_encode($all_plans);
    } elseif($type=="single"){
        //api/sale.php?type=single&id=any
        $single_plan = $planObj->get($_GET["id"]);
        echo json_encode($single_plan);
    } elseif($type=="decline") {
        //api/sale.php?type=decline&sale_id=any
        if($planObj->update_item_by_id($_GET["sale_id"], ["status"=>"declined"])){
            echo json_encode(["status"=>true, "message"=>"Sale successfully declined"]);
        } else {
            echo json_encode(["status"=>false, "message"=>$planObj->error]);
        }
    }
} elseif (isset($_POST["type"])){
    $type = $_POST["type"];
    if($type=="approve"){
        //api/sale.php type:approve sale_id:any amount:any name:any phone:any code:any
        if($saleObj->update_item_by_id($_POST["sale_id"], ["amount"=>$_POST["amount"], "name"=>$_POST["name"], "phone"=>$_POST["phone"], "access_code"=>$_POST["code"], "status"=>"approved"])){
            echo json_encode(["status"=>true, "message"=>"Sale successfully approved!"]);
        } else {
            echo json_encode(["status"=>false, "message"=>$saleObj->error]);
        }
    } elseif($type=="buy"){
        //api/sale.php type:buy plan_id:any alt_phone:any txnid:any
        if($saleObj->post_item(["txnid"=>$_POST["txnid"], "plan_id"=>$_POST["plan_id"], "alt_phone"=>$_POST["alt_phone"]])){
            echo json_encode(["status"=>true, "message"=>"Your purchase has been submitted successfully, you will receive an access code to this plan by sms."]);
        } else {
            echo json_encode(["status"=>false, "message"=>$saleObj->error]);
        }
    }
}
?>