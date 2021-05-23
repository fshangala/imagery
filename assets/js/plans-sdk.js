class PlanSDK {
    constructor(){
        console.log(this);
    }

    get_plans(){
        $.get("/api/plan.php?type=all", function(data, status){
            var response = JSON.parse(data);
            return response;
        });
    }

    get_plan(plan_id){
        $.get("/api/plan.php?type=single&id="+plan_id, function(data, status){
            var response = JSON.parse(data);
            return response;
        });
    }
}
