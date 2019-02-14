<?php 
require "constant.php";

    $link = mysqli_connect(LINK_DB, LOGIN_DB, PASS_DB,TABLE_DB);
    if ( mysqli_connect_errno() ) {
        printf("Не удалось подключиться: %s\n", mysqli_connect_error());
        die();
    }
    else {
        printf("Удалось подключиться: %s\n", mysqli_get_host_info($link));
    }

    $query = "DELETE FROM mail_tb WHERE DATEDIFF( CURDATE(),create_time)>=10";
    $res = mysqli_query($link,$query);
echo "Запрос на удаление был выполнен.\n";

$query = "SELECT * FROM mail_tb";
$res = mysqli_query($link,$query);
echo "Записей в таблице: ".mysqli_num_rows($res)."\n";

    mysqli_close($link);
    echo "Соединение разорвано";
    ?>