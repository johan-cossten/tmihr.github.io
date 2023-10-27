
$('input[type="number"]').change(function() {
    var min = Globalize.parseFloat($(this).attr("min"));
    var max = Globalize.parseFloat($(this).attr("max"));
    var value = Globalize.parseFloat($(this).val());
    if(value < min) { value = min; }        
    if(value > max) { value = max; }
    $(this).val(value);
    //value = Globalize.format(value,"c");
    console.log(value);
});

$(".close_btn").on("click", function() {
    if (confirm('Are you sure you want to navigate away from this page?')) {
        window.location = '<?php echo base_url ?>evaluation';
    }
});

function add_topic() {
    var employee = document.getElementById("EMP_CODE").value;
    $.post("gettopic", {employee: employee,}, function(result) {
        $("#PLN_SYS_ID").html('').html(result);
    });
}

function updateduration() {
    var pln_topic = document.getElementById("PLN_SYS_ID").value;
    $.ajax({
        url: "get_duration",
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
            $("#plan_unit").val(resp[0].PLAN_UNIT).change();
            $("#plan_qty").val(resp[0].PLAN_QTY);
            $("#FROM_DT").val(resp[0].PLN_ST_DT);
            $("#TO_DT").val(resp[0].PLN_EN_DT);
            $("#FIELDDATE1").val(resp[0].date7);
            $("#FIELDDATE2").val(resp[0].date_month);
        }
    });
}
$('#save,#update').click(function (e) {
	var base_url=$("#base_url").val().trim();
    var flag=true;

    function check_field(id)
    {
        if(!$("#"+id).val().trim() ) {
            $('#'+id+'_msg').fadeIn(200).show().html('Required Field').addClass('required');
            flag=false;
        } else {
            $('#'+id+'_msg').fadeOut(200).hide();
        }
    }

	check_field("EMP_CODE");
    check_field("PLN_SYS_ID");

    if(flag==false) {
		toastr["warning"]("You have Missed Something to Fillup!")
		return;
    }
    var this_id=this.id;
    if(this_id=="save") {
		if(confirm("Do You Wants to Save Record ?")){
            var this_id=this.id;
            e.preventDefault();
            data = new FormData($('#evaluation-form')[0]);//form name
            /*Check XSS Code*/
            if(!xss_validation(data)){ return false; }
            
            $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
            $("#"+this_id).attr('disabled',true);  //Enable Save or Update button
            $.ajax({
                type: 'POST',
                url: base_url+'evaluation/newevaluation?command='+this_id,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {
                    if(result=="success") {
                        window.location=base_url+"evaluation";
                        return;
                    } else if(result=="failed") {
                        toastr["error"]("Sorry! Failed to save Record.Try again!");
                    } else {
                        toastr["error"](result);
                    }
                    $("#"+this_id).attr('disabled',false);
                    $(".overlay").remove();
                }
            });
        }
    } else if(this_id=="update") {
        if(confirm("Do You Wants to Update Record ?")){
            e.preventDefault();
            data = new FormData($('#evaluation-form')[0]);
            if(!xss_validation(data)){ return false; }
            $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
            $("#"+this_id).attr('disabled',true);
            $.ajax({
                type: 'POST',
                url: base_url+'evaluation/newevaluation?command='+this_id,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result){
                    if(result=="success") {
                        window.location=base_url+"evaluation";
                    }
                    else if(result=="failed") {
                        toastr["error"]("Sorry! Failed to save Record.Try again!");
                    } else {
                        toastr["error"](result);
                    }
                    $("#"+this_id).attr('disabled',false);  //Enable Save or Update button
                    $(".overlay").remove();
                }
            });
        }
    }
});

function delete_evaluation(id, status) {
    if(confirm("Do You Wants to Delete Record ?")){
        if (status == 4 || status == 3) {
            toastr["error"]("Something Went Wrong, Can't Update If Status Approve or Close");
            return false;            
        } else {
            $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
            $.post("evaluation/delete_evaluation",{id:id},function(result){
                if(result=="success") {
                    toastr["success"]("Record Deleted Successfully!");
                    $('#example2').DataTable().ajax.reload();
                } else if(result=="failed"){
                    toastr["error"]("Failed to Delete .Try again!");
                } else{
                    toastr["error"](result);
                }
                    $(".overlay").remove();
                    return false;
            });
        }
    }
}

function update_evaluation(id, status) {
    var base_url=$("#base_url").val().trim();
    if (status == 4 || status == 3) {
        toastr["warning"]("Something Went Wrong, Can't Update If Status Approve or Cancel");
        return false;
    } else {
        window.location.href = base_url+'evaluation/update/'+id;
    }
}

function update_status(id,status) {
    var role = document.getElementById("role").value;
    if (role == 1 || role == 141) {
        $.post("evaluation/update_status",{id:id,status:status},function(result){
            if(result=="success") {
                toastr["success"]("Status Updated Successfully!");
                $('#example2').DataTable().ajax.reload();
                if(status==0) {
                    status="Inactive";
                    var span_class="label label-danger";
                    $("#span_"+id).attr('onclick','update_status('+id+',1)');
                } else {
                    status="Active";
                    var span_class="label label-success";
                    $("#span_"+id).attr('onclick','update_status('+id+',0)');
                }
                $("#span_"+id).attr('class',span_class);
                $("#span_"+id).html(status);
                return false;
                    
            } else if(result=="failed"){
                toastr["error"]("Failed to Update Status.Try again!");
                return false;
            } else {
                toastr["error"](result);
                return false;
            }
        });
    } else {
        toastr["error"]("You Don't Have Enough Permission for this Operation!");
        return false;
    }	
}

function status_evaluation(id, status) {
    $.post('evaluation/view_evaluation_modal', {id: id, status: status}, function(result) {
        $(".view_evaluation_modal").html('').html(result);
        $('#view_evaluation_modal').modal('toggle');
    });
}

function save_evaluation(){
    var base_url=$("#base_url").val().trim();
    var id=$("#ID").val().trim();
    var status=$("#evaluation_status").val().trim();
    
    $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
    $(".save_evaluation").attr('disabled',true);  //Enable Save or Update button
    $.post('evaluation/status_evaluation', {id: id,status:status}, function(result) {
    result=result.trim();
        if(result=="success"){
            $('#view_evaluation_modal').modal('toggle');
            toastr["success"]("Update Status Successfully!");
            $('#example2').DataTable().ajax.reload();
        } else if(result=="failed") {
            toastr["error"]("Sorry! Failed to save Record.Try again!");
        } else {
            toastr["error"](result);
        }
          $(".evaluation_save").attr('disabled',false);  //Enable Save or Update button
          $(".overlay").remove();
    });
}