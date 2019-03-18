<?php
require "constant.php";

$template=$_POST['email_new'];
$id=$_POST['id'];

$link = mysqli_connect(LINK_DB, LOGIN_DB, PASS_DB,TABLE_DB) or die("Не удалось связаться с БД");

mysqli_query($link,"SET CHARACTER SET utf8");
mysqli_query($link,"SET NAMES utf8");
     
$query = "UPDATE email_template SET template='$template'  WHERE email_template.ID ='$id';";
$res = mysqli_query($link,$query);
if ($res=true){
    echo "Отправлено";
}else{
    echo "Не удалось отправить";
}
mysqli_close($link);
echo "\nСоединение разорвано";
?>