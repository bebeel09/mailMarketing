$(document).ready(function () {

    $('#btn-info').click(function () {
        $.ajax({
            url: "info.html",
            cache: false,
            success: function (html) {
                $("#content").html(html);
            }
        });
    });

    $('#btn-settings').click(function () {
        $.ajax({
            url: "settings.html",
            cache: false,
            success: function (html) {
                $("#content").html(html);
            }
        });
    });

    $('#btn-admin').click(function () {
        $.ajax({
            url: "admin.html",
            cache: false,
            success: function (html) {
                $("#content").html(html);
            }
        });
    });
});