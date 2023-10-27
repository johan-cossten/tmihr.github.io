$(".close_btn").on("click",function(){
    if(confirm('Are you sure you want to navigate away from this page?')){
        window.location='<?php echo base_url ?>assessment';
    }
});

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

	check_field("employeeid");

    if(flag==false) {
		toastr["warning"]("You have Missed Something to Fillup!")
		return;
    }

    var this_id=this.id;
    if(this_id=="save") {
		if(confirm("Do You Wants to Save Record ?")){
            var this_id=this.id;
            e.preventDefault();
            data = new FormData($('#assessment-form')[0]);//form name
            /*Check XSS Code*/
            if(!xss_validation(data)){ return false; }
            
            $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
            $("#"+this_id).attr('disabled',true);  //Enable Save or Update button
            $.ajax({
                type: 'POST',
                url: base_url+'assessment/newassessment?command='+this_id,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {
                    if(result=="success") {
                        window.location=base_url+"assessment";
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
            data = new FormData($('#assessment-form')[0]);
            if(!xss_validation(data)){ return false; }
            $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
            $("#"+this_id).attr('disabled',true);
            $.ajax({
                type: 'POST',
                url: base_url+'assessment/update_assessment',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result){
                    if(result=="success") {
                        window.location=base_url+"assessment/view";
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

function shift_cursor(kevent,target){
    if(kevent.keyCode==13){
		$("#"+target).focus();
    }
}

function delete_assessment(id, status) {
    if(confirm("Do You Wants to Delete Record ?")) {
        if (status == 4) {
            $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
            $.post("assessment/delete_assessment",{id:id},function(result){
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
            toastr["error"]("Something Went Wrong, Can't Update If Status Approve or Close");
            return false;
        }
   }
}

function update_status(id,status) {
    $.post("assessment/update_status",{id:id,status:status},function(result){
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
}

function update_assessment(id, status) {
    var base_url=$("#base_url").val().trim();
    if (status == 4 || status == 3) {
        toastr["warning"]("Something Went Wrong, Can't Update If Status Approve or Cancel");
        return false;
    } else {
        window.location.href = base_url+'assessment/update/'+id;
    }
}

function status_assessment(id, status) {
    $.post('assessment/view_assessment_modal', {id: id, status: status}, function(result) {
        $(".view_assessment_modal").html('').html(result);
        $('#view_assessment_modal').modal('toggle');
    });
}

function save_assessment(){
    var base_url=$("#base_url").val().trim();
    var id=$("#ID").val().trim();
    var status=$("#assessment_status").val().trim();
    
    $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
    $(".save_assessment").attr('disabled',true);  //Enable Save or Update button
    $.post('assessment/status_assessment', {id: id,status:status}, function(result) {
    result=result.trim();
        if(result=="success"){
            $('#view_assessment_modal').modal('toggle');
            toastr["success"]("Update Status Successfully!");
            $('#example2').DataTable().ajax.reload();
        } else if(result=="failed") {
            toastr["error"]("Sorry! Failed to save Record.Try again!");
        } else {
            toastr["error"](result);
        }
          $(".assessment_save").attr('disabled',false);  //Enable Save or Update button
          $(".overlay").remove();
    });
}