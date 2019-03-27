<?php

//CREATE VIEW data_mail_and_template AS SELECT mail_data.ID, mail, act_num, FIO, act_date,mail_data.status_give, mail_data.sent, email_template.template FROM mail_data, email_template WHERE email_template.ID=mail_data.ID_email_template AND mail_data.sent=0;

include_once "constant.php";
include_once '../Controller/sendMail.class.php';


$Tema = "TRADE-IN при покупке сварочного оборудования LORCH.";
$FromName = "ШТОРМ. Сварочное оборудование";
$From = "info@shtorm-its.ru";
$dommen = "shtorm-its.ru";



$smtp = new SendMailSmtpClass("info@shtorm-its.ru", "jikmjikm", "mail.shtorm-its.ru", "info@shtorm-its.ru", $smtp_port = 25, $smtp_charset = "utf-8") or die("всё плохо");

//Подключение к БД
$link = mysqli_connect(LINK_DB, LOGIN_DB, PASS_DB,TABLE_DB) or die("Не удалось подключиться к базе.\n");

mysqli_query($link,"SET CHARACTER SET utf8");
mysqli_query($link,"SET NAMES utf8");

//запрос на получение данных из БД
$query = "SELECT ID, mail, act_num, FIO, act_date, template, status_give  FROM data_mail_and_template";
$res = mysqli_query($link,$query) or die("Не удалось отправить запрос.\n");

//закрываем соединение
mysqli_close($link);

$patterns=array();
$patterns[1]='/{FIO}/';
$patterns[2]='/{act}/';
$patterns[3]='/{date}/';

//var_dump(mysqli_fetch_assoc($res));

//die ("asdasd");
while($result =mysqli_fetch_assoc($res)){

    if ($result['status_give']==2){

        $replacement=array();
        $replacement[1]=$result['FIO'];
        $replacement[2]=$result['act_num'];
        $replacement[3]=$result['act_date'];

        $mail=$result['mail'];
        $ID_clinet=$result['ID'];


        $test_message= html_entity_decode(preg_replace( $patterns,$replacement,$result['template']));


        // Отправляем
        $To = $mail;
        $uid = uniqid('sf');
        $header = "MIME-Version: 1.0\r\n";
        $header .= "From: =?utf-8?B?" . "?= <" . $From . ">" . "\r\n";
        $header .= "Organization: " . $dommen . " \r\n";
        $header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n"; //work
        //$header .= "Content-Type: multipart/alternative; boundary=\"" . "\"\r\n";
        $header .= "To: " . $To . "\r\n";
        $header .= "List-Unsubscribe: " . UNSUBSCRIBE_SF;
        $body = "This is a MIME encoded message.";
        $body .= "\r\n\r\n--" . $uid . "\r\n";
        $body .= "Content-type: text/plain;charset=utf-8\r\n\r\n";
        $body .= "\r\n";
        // $body .= trim(strip_tags($msg));
        $body .= "\r\n\r\n--" . $uid . "\r\n";
        $body .= "Content-type: text/html;charset=utf-8\r\n\r\n";
        $body .= "\r\n";
        $body .= $test_message;

        $smtp->send($To, $Tema, $body, $header);
            // if ($smtp->send($To, $Tema, $body, $header)){
            //     $link = mysqli_connect(LINK_DB, LOGIN_DB, PASS_DB,TABLE_DB);
            //     $query = "UPDATE mail_data SET sent=0 WHERE ID={$ID_clinet}";
            //     $res = mysqli_query($link,$query);
            //     mysqli_close($link);
            //     echo "Изменение в бд";
            // }else echo "косяк";
        echo "Отправлено";
       //sleep(5);
    }else echo "Статус: не готов к выдаче!";
}


?>