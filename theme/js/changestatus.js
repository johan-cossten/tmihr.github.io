function change_status() {
    var this_id = this.id;
    var changeto = document.getElementById("changeto").value.trim();
    console.log(changeto);
    if (changeto == '') {
        toastr["warning"]("Sorry! Change To Status Must be Fill");
    } else {
        if (confirm("Are you sure ?")) {
            $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
            $("#"+this_id).attr('disabled', true);
    
            data = new FormData($('#table_form')[0]);
            $.ajax({
                type: 'POST',
                url: $("#base_url").val()+'settings/multi_status',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result){
                    result=result.trim();
                    if(result=="success") {
                        toastr["success"]("Change Status Successfully!");
                        $('#example2').DataTable().ajax.reload();
                        $(".change_btn").hide();
                        $(".group_check").prop("checked",false).iCheck('update');
                    } else if(result=="failed") {
                        toastr["error"]("Sorry! Failed to save Record.Try again!");
                    } else {
                        toastr["error"](result);
                    }
                    $("#"+this_id).attr('disabled',false);  //Enable Save or Update button
                    $(".overlay").remove();
                }
            })
        }    
    }
}