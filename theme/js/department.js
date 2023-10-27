$(".close_btn").on("click",function(){
    var base_url=$("#base_url").val().trim();
    if(confirm('Are you sure you want to navigate away from this page?')){
        window.location=base_url+'department/view';
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
	check_field("department");	
    
    if(flag==false) {
		toastr["warning"]("You have Missed Something to Fillup!")
		return;
    }

    var this_id=this.id;
    
    if(this_id=="save") {
		if(confirm("Do You Wants to Save Record ?")){
            e.preventDefault();
            data = new FormData($('#department-form')[0]);
            if(!xss_validation(data)){ return false; }
            $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
            $("#"+this_id).attr('disabled',true);
            $.ajax({
                type: 'POST',
                url: base_url+'department/newdepartment',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result){
                    if(result=="success") {
						window.location=base_url+"department/view";
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
            data = new FormData($('#department-form')[0]);
            if(!xss_validation(data)){ return false; }
            $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
            $("#"+this_id).attr('disabled',true);  //Enable Save or Update button
			$.ajax({
                type: 'POST',
                url: base_url+'department/update_department',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result){
                    if(result=="success") {
						window.location=base_url+"department/view";
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
    }
});

function shift_cursor(kevent,target){
    if(kevent.keyCode==13){
		$("#"+target).focus();
    }
}

function delete_department(id) 
{
    if(confirm("Do You Wants to Delete Record ?")){
        $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
        $.post("delete_department",{id:id},function(result){
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