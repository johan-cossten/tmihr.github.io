
$(".close_btn").on("click",function(){
    if(confirm('Are you sure you want to navigate away from this page?')){
        window.location='<?php echo base_url ?>employee';
    }
});

function transfer(id) {
    $.post('view_transfer_modal', {id: id}, function(result) {
        $(".view_transfer_modal").html('').html(result);
        $('#view_transfer_modal').modal('toggle');
    });
}
function evaluation(employee_id) {
    $.post('view_evaluation_modal', {id: employee_id}, function(result) {
        $(".view_evaluation_modal").html('').html(result);
        $('#view_evaluation_modal').modal('toggle');
    });
}

function save_transfer(){
    var base_url=$("#base_url").val().trim();
    var employee_old=$("#employee_old").val().trim();
    var employee_new=$("#employee_new").val().trim();
    
    $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
    $(".save_transfer").attr('disabled',true);  //Enable Save or Update button
    $.post('save_transfer', {employee_new: employee_new,employee_old:employee_old}, function(result) {
    result=result.trim();
        if(result=="success"){
            $('#view_transfer_modal').modal('toggle');
            toastr["success"]("Transfer Training Successfully!");
            $('#example2').DataTable().ajax.reload();
        } else if(result=="failed") {
            toastr["error"]("Sorry! Failed to save Record.Try again!");
        } else {
            toastr["error"](result);
        }
          $(".training_save").attr('disabled',false);  //Enable Save or Update button
          $(".overlay").remove();
    });
}

function show_eval(){
    var base_url=$("#base_url").val().trim();
    var employee_id=$("#employee_id").val().trim();
    var employee_name=$("#employee_name").val().trim();
    var department=$("#department").val().trim();
    var topic_id=$("#topic_id").val().trim();
    var conducted=$("#conducted").val().trim();
    var cost_con=$("#cost_con").val().trim();
    var qty=$("#qty").val().trim();
    var unit=$("#unit").val().trim();
    var fr_date = $('#from_dt').val();
    var to_date = $('#to_dt').val();
    window.location=base_url+"employee/preview_evaluation?id="+employee_id+"&employee_name="+employee_name+"&department="+department+"&topic="+topic_id+"&conducted="+conducted+"&cost="+cost_con+"&qty="+qty+"&unit="+unit+"&fr_date="+fr_date+"&to_date="+to_date;

    // window.location.href = base_url+"employee/preview_evaluation&id="+employee_id+"&name="+employee_name+"&department="+department+"&topic="+topic_id+"&conducted="+conducted+"&cost="+cost_con+"&fr_date="+fr_date+"&to_date="+to_date;
}

function updateduration() {
    var pln_topic = document.getElementById("topic_id").value;
    $.ajax({
        url: 'get_duration',
        method: 'POST',
        dataType: 'json',
        data: {
            pln_topic: pln_topic
        },
        error: err => {
            console.log(err)
            toastr["error"](console.log(err));
        },
        success: function(resp) {
            $("#duration_unit").val(resp[0].PLAN_UNIT).change();
            $("#duration").val(resp[0].PLAN_QTY);
            $("#qty").val(resp[0].PLAN_QTY);
            $("#unit").val(resp[0].PLAN_UNIT);
            $("#from_dt").val(resp[0].PLN_ST_DT);
            $("#to_dt").val(resp[0].PLN_EN_DT);
        }
    });
}