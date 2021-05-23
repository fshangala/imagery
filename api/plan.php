<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'models.php';

$planObj = new Plan();
$attributeObj = new PlanAttribute();
$fileObj = new PlanFile();
$pictureObj = new PlanPicture();
$slideObj = new Slide();

if(isset($_GET["type"])){
    $type = $_GET["type"];
    if($type=="all"){
        //api/plan.php?type=all
        $all_plans = $planObj->get_all();
        echo json_encode($all_plans);
    } elseif($type=="single"){
        //api/plan.php?type=single&id=any
        $single_plan = $planObj->get($_GET["id"]);
        echo json_encode($single_plan);
    } elseif($type=="delete_plan") {
        //api/plan.php?type=delete_plan&plan_id=any
        if($planObj->delete_item_by_id($_GET["plan_id"])){
            echo json_encode(["status"=>true, "message"=>"Plan successfully deleted"]);
        } else {
            echo json_encode(["status"=>false, "message"=>$planObj->error]);
        }
    } elseif($type=="all_attribute"){
        //api/plan.php?type=all_attribute&plan_id=any
        $all_attribute = $attributeObj->get_where(["plan_id"=>$_GET["plan_id"]]);
        echo json_encode($all_attribute);
    } elseif($type=="all_file"){
        //api/plan.php?type=all_file&plan_id=any
        $all_file = $fileObj->get_where(["plan_id"=>$_GET["plan_id"]]);
        echo json_encode($all_file);
    } elseif($type=="delete_file"){
        //api/plan.php?type=delete_file&file_id=any
        if($fileObj->delete_item_by_id($_GET["file_id"])){
            echo json_encode(["status"=>true, "message"=>"File successfully deleted"]);
        } else {
            echo json_encode(["status"=>false, "message"=>$fileObj->error]);
        }
    } elseif($type=="all_picture"){
        //api/plan.php?type=all_picture&plan_id=any
        $all_picture = $pictureObj->get_where(["plan_id"=>$_GET["plan_id"]]);
        echo json_encode($all_picture);
    } elseif($type=="all_slide"){
        //api/plan.php?type=all_slide
        $all_slides = $slideObj->get_all();
        echo json_encode($all_slides);
    } elseif($type=="delete_slide"){
        //api/plan.php?type=delete_slide&slide_id=any
        if($slideObj->delete_item_by_id($_GET["slide_id"])){
            echo json_encode(["status"=>true, "message"=>"Slide successfully deleted"]);
        } else {
            echo json_encode(["status"=>false, "message"=>$slideObj->error]);
        }
    }
} elseif (isset($_POST["type"])){
    $type = $_POST["type"];
    if($type=="add_plan"){
        //api/plan.php type:add_plan description:any price:any picture:file
        $filepath = "assets/images/plans/".date("Y.m.d.H.m.s")."-".$_FILES["picture"]["name"];
        if($planObj->post_item(["description"=>$_POST["description"], "picture"=>$filepath, "price"=>$_POST["price"]])){
            move_uploaded_file($_FILES["picture"]["tmp_name"], "../".$filepath);
            echo json_encode(["status"=>true, "message"=>"Plan added successfully!"]);
        } else {
            echo json_encode(["status"=>false, "message"=>$planObj->error]);
        }
    } elseif($type=="edit_picture"){
        //api/plan.php type:edit_picture plan_id:any picture:file
        $filepath = "assets/images/plans/".date("Y.m.d.H.m.s")."-".$_FILES["picture"]["name"];
        if($planObj->update_item_by_id($_POST["plan_id"], ["picture"=>$filepath])){
            move_uploaded_file($_FILES["picture"]["tmp_name"], "../".$filepath);
            echo json_encode(["status"=>true, "message"=>"Plan added successfully!"]);
        } else {
            echo json_encode(["status"=>false, "message"=>$planObj->error]);
        }
    } elseif($type=="add_attribute"){
        //api/plan.php type:add_attribute plan_id:any value:any
        if($attributeObj->post_item(["plan_id"=>$_POST["plan_id"], "value"=>$_POST["attribute"]])){
            echo json_encode(["status"=>true, "message"=>"Attribute successfully added to plan!"]);
        } else {
            echo json_encode(["status"=>false, "message"=>$attributeObj->error]);
        }
    } elseif($type=="edit_description"){
        //api/plan.php type:edit_description plan_id:any description:any
        if($planObj->update_item_by_id($_POST["plan_id"], ["description"=>$_POST["description"]])){
            echo json_encode(["status"=>true, "message"=>"Description successfully edited!"]);
        } else {
            echo json_encode(["status"=>false, "message"=>$planObj->error]);
        }
    } elseif($type=="add_file"){
        //api/plan.php type:add_file plan_id:any file:file
        $filepath = "assets/files/".$_POST["plan_id"]."-".date("Y.m.d.H.m.s")."-".$_FILES["file"]["name"];
        if($fileObj->post_item(["plan_id"=>$_POST["plan_id"], "file"=>$filepath])){
            move_uploaded_file($_FILES["file"]["tmp_name"], "../".$filepath);
            echo json_encode(["status"=>true, "message"=>"File added successfully!"]);
        } else {
            echo json_encode(["status"=>false, "message"=>$fileObj->error]);
        }
    } elseif($type=="add_picture"){
        //api/plan.php type:add_picture plan_id:any picture:file
        $filepath = "assets/images/plans/".$_POST["plan_id"]."-".date("Y.m.d.H.m.s")."-".$_FILES["picture"]["name"];
        if($pictureObj->post_item(["plan_id"=>$_POST["plan_id"], "picture"=>$filepath])){
            move_uploaded_file($_FILES["picture"]["tmp_name"], "../".$filepath);
            echo json_encode(["status"=>true, "message"=>"File added successfully!"]);
        } else {
            echo json_encode(["status"=>false, "message"=>$pictureObj->error]);
        }
    } elseif($type=="add_slide"){
        //api/plan.php type:add_slide picture:file
        $filepath = "assets/images/slide/".date("Y.m.d.H.m.s")."-".$_FILES["picture"]["name"];
        if($slideObj->post_item(["picture"=>$filepath])){
            move_uploaded_file($_FILES["picture"]["tmp_name"], "../".$filepath);
            echo json_encode(["status"=>true, "message"=>"Slide added successfully!"]);
        } else {
            echo json_encode(["status"=>false, "message"=>$slideObj->error]);
        }
    }
}
?>
