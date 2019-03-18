<?php
require "constant.php";

$link = mysqli_connect(LINK_DB, LOGIN_DB, PASS_DB,TABLE_DB) or die("Не удалось подключиться к БД");

$query="SELECT * FROM data_mail_and_template;";
$res_send_info=mysqli_query($link,$query);

$query="SELECT * FROM data_mail_and_template_where_feedback;";
$res_send_feedback=mysqli_query($link,$query);

$data['stack']="Информирующего письма: ".mysqli_num_rows($res_send_info);
$data['stack_feedback']="Письма обратной связи: ".mysqli_num_rows($res_send_feedback);
$data['server']="Расположение: ".$link->host_info."<br>";
$data['ip']="ваш IP: ".$_SERVER['REMOTE_ADDR'];
echo json_encode($data);
mysqli_close($link);
?>