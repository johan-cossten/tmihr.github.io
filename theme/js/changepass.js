
$("#save").click(function(){
    var currentpass=document.getElementById("current_pass").value.trim();
    var newpass=document.getElementById("pass").value.trim();
    var retypepass=document.getElementById("confirm").value.trim();
    if(currentpass=="") {
        toastr["warning"]("Enter Current Password!");
        document.getElementById("current_pass").focus();
        return;
    }
    
    if(newpass=="") {
        toastr["warning"]("Please Enter New Password!");
        $("#pass").focus();
        return;
    }
    
    if(retypepass=="") {
        toastr["warning"]("Please Confirm Password!");
        $("#confirm").focus();
        return;
    }
    
    if(newpass!=retypepass) {
        toastr["error"]("Password Mismatch!");
        document.getElementById("pass").focus();
        return;
    } else {
        if(confirm("Are you Sure ?")){
            if(!xss_validation(currentpass)){ return false; }
            if(!xss_validation(newpass)){ return false; }
            $.post("password_update",{currentpass:currentpass,newpass:newpass},function(result){
                if(result=="success") {
                    toastr["success"]("Password Updated Successfully!");
                    $("#current_pass,#pass,#confirm").val('');
                    return false;
                } else if(result=="failed") {
                    toastr["error"]("Password Not Updated.Try again!");
                    return false;
                } else {
                    toastr["error"](result);
                    return false;
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