<?php 
require "constant.php";


//получем данные с формы добавления нового email-а
$mail= $_POST['mail'];
$act=$_POST['act']; 
$person_name=$_POST['fio'];
$phone_num=$_POST['phone'];

//подключение к БД
$link = mysqli_connect(LINK_DB, LOGIN_DB, PASS_DB,TABLE_DB)or die ("Не удалось подключиться. Возможно неправильно указано название базы.\n");
mysqli_query($link,"SET CHARACTER SET utf8");
mysqli_query($link,"SET NAMES utf8");
     
//запрос на вставку
$query = "INSERT INTO mail_data (mail,act_num,FIO,create_date,phone_num) VALUES ('$mail','$act','$person_name',CURDATE(),'$phone_num');";
$res = mysqli_query($link,$query) or die("Не удалось отправить запрос.\n");
    
//запрос на количество записей после добавления    
$query = "SELECT * FROM mail_data";
$res = mysqli_query($link,$query);
echo "Записей в таблице: ".mysqli_num_rows($res)."\n";
  
mysqli_close($link);
echo "Соединение разорвано";
?>