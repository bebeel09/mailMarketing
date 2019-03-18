$(document).ready(function () {
    $.ajax({
        url: "php/link_script.php",
        cache: false,
        success:function (html1) {
            var html=JSON.parse(html1);
            $("#link_info").html(html.server+'<br>'+html.ip);
            $("#send_info").html('Ожидают отправки: <br>'+html.stack+'<br>'+html.stack_feedback);
        }
    });
});