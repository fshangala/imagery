<?php
require_once 'database-connection.php';

class Plan extends Db {
    function __init__() {
        $this->table = "plan";
        $this->fields = ["description"=>"", "picture"=>"assets/images/plan-default.png", "price"=>0.0];
    }
    function get_featured(){
		$sql = "SELECT * FROM ".$this->table;
		return $this->return_many($sql);
    }
}
class PlanAttribute extends Db {
    function __init__() {
        $this->table = "attribute";
        $this->fields = ["plan_id"=>0, "value"=>""];
    }
}
class PlanFile extends Db {
    function __init__() {
        $this->table = "file";
        $this->fields = ["plan_id"=>0, "file"=>""];
    }
}
class PlanPicture extends Db {
    function __init__() {
        $this->table = "picture";
        $this->fields = ["plan_id"=>0, "picture"=>""];
    }
}
class Slide extends Db {
    function __init__() {
        $this->table = "slide";
        $this->fields = ["picture"=>""];
    }
}
class Sale extends Db {
    function __init__() {
        $this->table = "sale";
        $this->fields = ["txnid"=>"", "plan_id"=>0, "amount"=>0.0, "name"=>"", "phone"=>"", "alt_phone"=>"", "access_code"=>"", "status"=>"unapproved"];
    }
}
?>