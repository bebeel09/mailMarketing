<?php 
require "constant.php";

//декодируем полученный JSON
$jsonText =json_decode( $_POST['myJson'],true);

//Если полученный JSON не поустой выполняем добавление в БД данных
if($jsonText)
{
 $mail= $jsonText['mail'];
$act=$jsonText['act']; 
$first_name=$jsonText['contact_person'];
$phone_num=$jsonText['phone_num'];
} else die("Данные не получены, операция прервана");

//подключение к БД
    $link = mysqli_connect(LINK_DB, LOGIN_DB, PASS_DB,TABLE_DB);
   
//запрос на добавление данных в БД
    $query = "INSERT INTO mail_data (mail,act_num,contact_person,create_time,phone_num) VALUES ('$mail','$act','$first_name',CURDATE(),'$phone_num');";
    $res = mysqli_query($link,$query);
    if ($res) echo "Запись добавлена в таблицу.\n";
    else die( "Не удалось выполнить запрос! ".mysqli_error($link));
   
//запрос на подсчёт записей после добавления
    $query = "SELECT * FROM mail_data";
    $res = mysqli_query($link,$query);
   echo "Записей в таблице: ".mysqli_num_rows($res)."\n";
    mysqli_close($link);
    echo "Соединение разорвано";
    ?>