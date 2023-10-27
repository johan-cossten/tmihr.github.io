function list_notif() {
    var base_url = $("base_url").val().trim();
    $.post(base_url+"dashboard/list_notif", {}, function(result){
        var data = jQuery.parseJSON(result)
        $("#list-notif").html('').html(data['result']);
        $(".count_notification").html('').html(data['notif_count']);
    })
}