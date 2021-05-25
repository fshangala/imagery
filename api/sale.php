<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'models.php';

$planObj = new Plan();
$fileObj = new PlanFile();
$saleObj = new Sale();


function random_string(){
    $arr = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"];
    $r = date("ymd");
    $r .= $arr[array_rand($arr)];
    $r .= date("Hm");
    $r .= $arr[array_rand($arr)];
    $r .= date("sa");
    $r .= $arr[array_rand($arr)];
    return $r;
}

if(isset($_GET["type"])){
    $type = $_GET["type"];
    if($type=="all"){
        //api/sale.php?type=all
        $all_sales = $saleObj->get_all();
        echo json_encode($all_sales);
    } elseif($type=="single"){
        //api/sale.php?type=single&id=any
        $single_sale = $saleObj->get($_GET["id"]);
        echo json_encode($single_sale);
    } elseif($type=="decline") {
        //api/sale.php?type=decline&sale_id=any
        if($planObj->update_item_by_id($_GET["sale_id"], ["status"=>"declined"])){
            echo json_encode(["status"=>true, "message"=>"Sale successfully declined"]);
        } else {
            echo json_encode(["status"=>false, "message"=>$planObj->error]);
        }
    } elseif($type=="plan_files"){
        //api/sale.php?type=plan_files&access_code=any
        if($code_sale = $saleObj->get_where(["access_code"=>$_GET["access_code"]], false)){
            if($plan_files = $fileObj->get_where(["plan_id"=>$code_sale["plan_id"]])){
                echo json_encode($plan_files);
            } else {
                echo json_encode(["status"=>false, "message"=>"Error: ".$fileObj->error]);
            }
        } else {
            echo json_encode(["status"=>false, "message"=>"Wrong access code"]);
        }
    } elseif($type=="sale"){
        //api/sale.php?type=sale&access_code=any
        if($code_sale = $saleObj->get_where(["access_code"=>$_GET["access_code"]], false)){
            echo json_encode($code_sale);
        } else {
            echo json_encode(["status"=>false, "message"=>$saleObj->error]);
        }
    }
} elseif (isset($_POST["type"])){
    $type = $_POST["type"];
    if($type=="approve"){
        //api/sale.php type:approve sale_id:any amount:any name:any phone:any
        if($saleObj->update_item_by_id($_POST["sale_id"], ["amount"=>$_POST["amount"], "name"=>$_POST["name"], "phone"=>$_POST["phone"], "status"=>"approved"])){
            echo json_encode(["status"=>true, "message"=>"Sale successfully approved!"]);
        } else {
            echo json_encode(["status"=>false, "message"=>$saleObj->error]);
        }
    } elseif($type=="buy"){
        //api/sale.php type:buy plan_id:any alt_phone:any txnid:any
        $access_code = random_string();
        if($saleObj->post_item(["txnid"=>$_POST["txnid"], "plan_id"=>$_POST["plan_id"], "alt_phone"=>$_POST["alt_phone"], "access_code"=>$access_code])){
            echo json_encode(["status"=>true, "message"=>"Your purchase has been submitted successfully!", "access_code"=>$access_code]);
        } else {
            echo json_encode(["status"=>false, "message"=>$saleObj->error]);
        }
    }
}
?>