$(".close_btn").on("click", function() {
    var base_url=$("#base_url").val().trim();
    if (confirm('Are you sure you want to navigate away from this page?')) {
        window.location = base_url+'training';
    }
});

$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

function afterupdate_topic() {
    var topic_id = document.getElementById("PLN_SYS_ID").value;
    console.log(topic_id);
    $.ajax({
        url: 'get_plan',
        method: 'POST',
        dataType: 'json',
        data: {
            topicid: topic_id
        },
        error: err => {
            console.log(err)
            toastr["error"](console.log(err));
        },
        success: function(resp) {
            $("#TR_DUR").val(resp[0].PLN_PLAN_QTY);
            $("#TR_DUR_UNIT").val(resp[0].PLN_PLAN_UNIT).change();
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

	check_field("PLN_SYS_ID");
    check_field("TR_INSTITUTION");

    if(flag==false) {
		toastr["warning"]("You have Missed Something to Fillup!")
		return;
    }

    var this_id=this.id;
    if(this_id=="save") {
		if(confirm("Do You Wants to Save Record ?")){
            var this_id=this.id;
            e.preventDefault();
            data = new FormData($('#training-form')[0]);//form name
            /*Check XSS Code*/
            if(!xss_validation(data)){ return false; }
            
            $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
            $("#"+this_id).attr('disabled',true);  //Enable Save or Update button
            $.ajax({
                type: 'POST',
                url: base_url+'training/newtrainingrecord?command='+this_id,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {
                    if(result=="success") {
                        window.location=base_url+"training";
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
            data = new FormData($('#training-form')[0]);
            if(!xss_validation(data)){ return false; }
            $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
            $("#"+this_id).attr('disabled',true);
            $.ajax({
                type: 'POST',
                url: base_url+'training/newtrainingrecord?command='+this_id,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result){
                    if(result=="success") {
                        window.location=base_url+"training";
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

function delete_training(id, status) 
{
    if(confirm("Do You Wants to Delete Record ?")){
        if (status == 0) {
            $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
            $.post("training/delete_training",{id:id},function(result){
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
        } else {
            toastr["warning"]("Something Went Wrong, Can't Delete If Status Approve or Close");
            return false;
        }
    }
}

function update_training(id, status) {
    var base_url=$("#base_url").val().trim();
    if (status == 4 || status == 3) {
        toastr["warning"]("Something Went Wrong, Can't Update If Status Approve or Cancel");
        return false;
    } else {
        window.location.href = base_url+'training/update/'+id;
    }
}

function update_status(id,status) {
    $.post("training/update_status",{id:id,status:status},function(result){
        if(result=="success") {
            toastr["success"]("Status Updated Successfully!");
            $('#example2').DataTable().ajax.reload();
            if(status==0) {
                status="Entry";
                var span_class="label label-danger";
                $("#span_"+id).attr('onclick','update_status('+id+',1)');
            } else if (status==1) {
                status="Approve";
                var span_class="label label-success";
                $("#span_"+id).attr('onclick','update_status('+id+',0)');
            } else {
                status="Close";
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
}

function status_training(id, status) {
    $.post('training/view_training_modal', {id: id, status: status}, function(result) {
        $(".view_training_modal").html('').html(result);
        $('#view_training_modal').modal('toggle');
    });
}

function save_training(){
    var base_url=$("#base_url").val().trim();
    var id=$("#ID").val().trim();
    var status=$("#training_status").val().trim();
    
    $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
    $(".save_training").attr('disabled',true);  //Enable Save or Update button
    $.post('training/status_training', {id: id,status:status}, function(result) {
    result=result.trim();
        if(result=="success"){
            $('#view_training_modal').modal('toggle');
            toastr["success"]("Update Status Successfully!");
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