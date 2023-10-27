
$(".close_btn").on("click",function(){
    if(confirm('Are you sure you want to navigate away from this page?')){
        window.location='<?php echo base_url ?>roles/view';
    }
});

$('#save,#update').click(function (e) {
	var base_url=$("#base_url").val().trim();
    var flag=true;
    function check_field(id)
    {
      if(!$("#"+id).val()) {
            $('#'+id+'_msg').fadeIn(200).show().html('Required Field').addClass('required');
            flag=false;
        } else {
             $('#'+id+'_msg').fadeOut(200).hide();
        }
    }
	check_field("ROLE_NAME");
    
	if(flag==false) {
		toastr["warning"]("You have Missed Something to Fillup!")
		return;
    }

    var this_id=this.id;
    if(this_id=="save") {
		if(confirm("Do You Wants to Save Record ?")){
			e.preventDefault();
			data = new FormData($('#roles-form')[0]);
			if(!xss_validation(data)){ return false; }
			$(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
			$("#"+this_id).attr('disabled',true);
			$.ajax({
			type: 'POST',
			url: base_url+'roles/newrole',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			success: function(result){
				if(result=="success") {
					window.location=base_url+"roles/view";
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
			data = new FormData($('#roles-form')[0]);
			if(!xss_validation(data)){ return false; }
			$(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
			$("#"+this_id).attr('disabled',true);
			$.ajax({
				type: 'POST',
				url: base_url+'roles/update_role',
				data: data,
				cache: false,
				contentType: false,
				processData: false,
				success: function(result) {
					if(result=="success") {
						window.location=base_url+"roles/view";
					} else if(result=="failed") {
						toastr["error"]("Sorry! Failed to save Record.Try again!");
					} else {
						toastr["error"](result);
					} $("#"+this_id).attr('disabled',false);
						$(".overlay").remove();
					}
				});
			}
		}
	});

	//On Enter Move the cursor to desigtation Id
	// function shift_cursor(kevent,target){

	// 	if(kevent.keyCode==13){
	// 		$("#"+target).focus();
	// 	}

	// }

//update status start
	function update_status(id,status)
	{
		$.post("update_status",{id:id,status:status},function(result){
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
//update status end

	//Delete Record start
	function delete_roles(q_id) {
   		if(confirm("Do You Wants to Delete Record ?")){
   			$(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
   			$.post("delete_roles",{q_id:q_id},function(result) {
				if(result=="success") {
						toastr["success"]("Record Deleted Successfully!");
						$('#example2').DataTable().ajax.reload();
				} else if(result=="failed") {
						toastr["error"]("Failed to Delete .Try again!");
				} else {
					toastr["error"](result);
				}
				$(".overlay").remove();
				return false;
   			});
   		}//end confirmation
	}
	//Delete Record end

	function multi_delete(){
		//var base_url=$("#base_url").val().trim();
    	var this_id=this.id;
		if(confirm("Are you sure ?")){
			$(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
			$("#"+this_id).attr('disabled',true);

			data = new FormData($('#table_form')[0]);//form name
			$.ajax({
			type: 'POST',
			url: 'multi_delete',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			success: function(result){
				result=result.trim();
				if(result=="success") {
					toastr["success"]("Record Deleted Successfully!");
					success.currentTime = 0;
				  	success.play();
					$('#example2').DataTable().ajax.reload();
					$(".delete_btn").hide();
					$(".group_check").prop("checked",false).iCheck('update');
				}
				else if(result=="failed")
				{
				   toastr["error"]("Sorry! Failed to save Record.Try again!");
				   failed.currentTime = 0;
				   failed.play();
				}
				else
				{
					toastr["error"](result);
					failed.currentTime = 0;
				  	failed.play();
				}
				$("#"+this_id).attr('disabled',false);
				$(".overlay").remove();
		   }
		   });
	}
	//e.preventDefault
}

/*Roles Table*/
// $('.change_me').on('ifChanged', function(event) {
// 	var id=this.id;
//     if(event.target.checked){
//      $("."+id+"_all").prop("checked",true).iCheck('update');
//     }
//     else{
//       $("."+id+"_all").prop("checked",false).iCheck('update');
//     }
// });


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