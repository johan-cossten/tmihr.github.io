$(".close_btn").on("click",function(){
    if(confirm('Are you sure you want to navigate away from this page?')){
        window.location='<?php echo base_url ?>users/view';
    }
});

function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    } else {
        return false;
    }
}

$('#save,#update').click(function(e){
	var base_url=$("#base_url").val().trim();
	var flag=true;
	var this_id=this.id;
	var new_user=document.getElementById("new_user").value.trim();
	var newpass=document.getElementById("pass").value.trim();
	var retypepass=document.getElementById("confirm").value.trim();
	var email=document.getElementById("email").value.trim();
	var q_id=document.getElementById("q_id").value.trim();
	var role_id=document.getElementById("role_id").value.trim();
	var user_id=document.getElementById("userid").value.trim();
	var flag=true;

	function check_field(id) {
		if(!$("#"+id).val().trim() ) {
			$('#'+id+'_msg').fadeIn(200).show().html('Required Field').addClass('required');
			$('#'+id).css({'background-color' : '#E8E2E9'});
			flag=false;
		} else {
			$('#'+id+'_msg').fadeOut(200).hide();
			$('#'+id).css({'background-color' : '#FFFFFF'});    //White color
		}
	}

	check_field("new_user");
	check_field("email");
	check_field("dept");
	check_field("role_id");
  	
    if(this_id!='update'){
		check_field("pass");
        check_field("confirm");
        if(newpass!='' && (newpass!=retypepass)) {
           toastr["warning"]("Warning! Password Mismatched!");
           return;
        }
    }

    if(flag==false) {
    	toastr["warning"]("You have Missed Something to Fillup!")
    	return;
    }

    if (email!='' && !validateEmail(email)) {
        $("#email_msg").html("Invalid Email!").show();
        toastr["warning"]("Invalid Email!")
        return false;
    }

    if(confirm("Do you wants to Save ?")){
    	e.preventDefault();
        data = new FormData($('#users-form')[0]);
        if(!xss_validation(data)){return false;}
        $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
        $("#"+this_id).attr('disabled',true);
        $.ajax({
        	type: 'POST',
        	url: base_url+'users/save_or_update',
        	data: data,
        	cache: false,
        	contentType: false,
        	processData: false,
        	success: function(result){
          		if(result=="success") {
					if (user_id == 1) {
						window.location=base_url+"users/view";	
					} else {
						window.location=base_url;	
					}
          		} else if(result=="failed") {
             		toastr["error"]("Sorry! Failed to save Record.Try again!");
          		} else {
             		toastr["error"](result); 
				}
          		$("#"+this_id).attr('disabled',false);
          		$(".overlay").remove();
          		return;
         	}
        });
    }
});

function shift_cursor(kevent,target){
    if(kevent.keyCode==13){
		$("#"+target).focus();
    }
}

function update_status(id,status)
{
    $.post("status_update",{id:id,status:status},function(result){
        if(result=="success") {
        	toastr["success"]("Status Updated Successfully!");
        	// $('#example2').DataTable().ajax.reload();
          	if(status==0) {
            	status="Inactive";
            	var span_class="label label-danger";
            	$("#span_"+id).attr('onclick','update_status('+id+',1)');
			} else{
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
        } else{
        	toastr["error"](result);
        	return false;
        }
    });
}

function delete_user(q_id)
{
	if(confirm("Are you sure ?")){
		$(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
		$.post("delete_user",{q_id:q_id},function(result){
			if(result=="success") {
				location.reload();
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

function status_users(id, status) {
    $.post('users/view_users_modal', {id: id, status: status}, function(result) {
        $(".view_users_modal").html('').html(result);
        $('#view_users_modal').modal('toggle');
    });
}

function save_users(){
    var base_url=$("#base_url").val().trim();
    var id=$("#ID").val().trim();
    var status=$("#users_status").val().trim();
    
    $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
    $(".save_users").attr('disabled',true);  //Enable Save or Update button
    $.post('users/status_users', {id: id,status:status}, function(result) {
    result=result.trim();
        if(result=="success"){
            $('#view_users_modal').modal('toggle');
            toastr["success"]("Update Status Successfully!");
            $('#example2').DataTable().ajax.reload();
        } else if(result=="failed") {
            toastr["error"]("Sorry! Failed to save Record.Try again!");
        } else {
            toastr["error"](result);
        }
          $(".users_save").attr('disabled',false);  //Enable Save or Update button
          $(".overlay").remove();
    });
}