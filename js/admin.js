    $('#btn_insert_mail').click(function () {
        $.ajax({
            url: "form_insert.html",
            cache: false,
            success: function (html) {
                $("#admin-content").html(html);
            }
        });
    });

    $('#btn_show_dude').click(function () {
        $.ajax({
            url: "php/show_tabl_sql.php",
            cache: false,
            success: function (html) {
                var tableString = '<table class="MyTable">';
                tableString += html;
                tableString += '</table>';
                $("#admin-content").html(tableString);
            }
        });
    });

    $('#btn_send_mail').click(function () {
       // alert("Отключено!");
        $.ajax({
            url: "php/send_feedback.php",
            method: "POST",
            // cache: false,
            success: function (res) {
                alert(res);
            }
        });
    });
    $('#btn_email_template').click(function () {
        $.ajax({
            url: "php/show_tabl_email_template.php",
            cache: false,
            success: function (html) {
                var tableString = '<table class="MyTable">';
                tableString += html;
                tableString += '</table>';
                $("#admin-content").html(tableString);

                $('[data-id]').each(function (index) {
                    $(this).click(function () {
                        var id_data = $(this).data('id');
                        var template_data = $(this).data('email');
                        console.log(template_data);
                        $("#admin-content").html(
                            "<div class='button__shortcode'>" +
                            "<button id='fio' class='button' >{FIO}</button>" +
                            "<button id='act' class='button'>{act}</button>" +
                            "<button id='date' class='button'>{date}</button>" +
                            "</div>" +
                            "<div>" +
                            "<textarea name='' id='email' cols='100' rows='18'>" +
                            template_data +
                            "</textarea></div></div>" +
                            "<button id='send' class='btn__send' data-id='" +
                            id_data + "'>Сохранить</button></div>");
                        $('#send').click(function (el) {
                            el.preventDefault();
                            var email = document.getElementById('email').value
                            $.ajax({
                                url: "php/rebild.php",
                                method: "POST",
                                data: {
                                    "email_new": email,
                                    "id": id_data
                                },
                                success: function (message) {
                                    alert(message);
                                }
                            });
                        });
                        $("#fio").click(function () {
                            insert_shortcode("email", "{FIO}");
                        });
                        $("#act").click(function () {
                            insert_shortcode("email", "{act}")
                        });
                        $("#date").click(function () {
                            insert_shortcode("email", "{date}")
                        });
                    })
                });
            }
        });
    });

    $('#see_template').click(function () {
       // window.open("php/see_template.php");
        $.ajax({
            url: "php/see_template.php",
            method: "POST",
            data: {"text":"aidar"},
            success: function (html) {
                wnd = window.open("php/see_template.php");
                
            }
        });
    });

    $('#see_template_again').click(function () {
         window.open("test_email_template_for_send_mail.html");
        
     });

    function insert_shortcode(idElement, text) {
        var area = document.getElementById(idElement);
        var position_cursor = area.selectionStart;
        area.value = area.value.substring(0,
            position_cursor) + text + area.value.substring(
            position_cursor, area.value.length);
        area.setSelectionRange(position_cursor + text.length, position_cursor + text.length);
        area.focus();
    };