<?php 
require "constant.php";

$jsonText =json_decode( $_POST['myJson'],true);

if($jsonText)
{
 $mail= $jsonText['mail'];
$act=$jsonText['act']; 
$first_name=$jsonText['first_name'];
$last_name=$jsonText['last_name'];
$medium_name=$jsonText['medium_name'];
$phone_num=$jsonText['phone_num'];
} else die("Данные не получены, операция прервана");

    $link = mysqli_connect(LINK_DB, LOGIN_DB, PASS_DB,TABLE_DB);
    if ( mysqli_connect_errno() ) {
        printf("Не удалось подключиться: %s\n", mysqli_connect_error());
        die();
    }
    else {
        printf("Удалось подключиться: %s\n", mysqli_get_host_info($link));
    }
  

    $query = "INSERT INTO mail_tb (mail,act_num,first_name,last_name,medium_name,create_time,phone_num) VALUES ('$mail','$act','$first_name','$last_name','$medium_name',CURDATE(),'$phone_num');";
    $res = mysqli_query($link,$query);
    if ($res) echo "Запись добавлена в таблицу.\n";
    else die( "Не удалось выполнить запрос! ".mysqli_error($link));
    
    $query = "SELECT * FROM mail_tb";
    $res = mysqli_query($link,$query);
   echo "Записей в таблице: ".mysqli_num_rows($res)."\n";
    mysqli_close($link);
    echo "Соединение разорвано";
    ?>