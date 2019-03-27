<?php
include_once "constant.php";
include_once '../Controller/sendMail.class.php';

$Tema = "Расскажите об опыте работы с нами.";
$FromName = "ШТОРМ. Сварочное оборудование";
$From = "info@shtorm-its.ru";
$dommen = "shtorm-its.ru";


$patterns=array();
$patterns[1]='/{FIO}/';

            //подключение к БД
            $link = mysqli_connect(LINK_DB, LOGIN_DB, PASS_DB,TABLE_DB) or die("Не удалось подключиться к базе.\n");

            mysqli_query($link,"SET CHARACTER SET utf8");
            mysqli_query($link,"SET NAMES utf8");
            
            //запрос на получение данных из БД
            $query = "SELECT ID, mail, act_num, FIO, act_date, feedback_template, status_give  FROM data_mail_and_template_where_feedback WHERE DATEDIFF(CURDATE(),create_date)>=7;";
            $res = mysqli_query($link,$query) or die("Не удалось отправить запрос.\n");
            
            //закрываем соединение
            mysqli_close($link);

           var_dump(mysqli_fetch_assoc($res));
            $smtp = new SendMailSmtpClass("info@shtorm-its.ru", "jikmjikm", "mail.shtorm-its.ru", "info@shtorm-its.ru", $smtp_port = 25, $smtp_charset = "utf-8") or die("всё плохо");
            
            while($result = mysqli_fetch_assoc($res)){

              $replacement=array();
              $replacement[1]=$result['FIO'];

              $mail=$result['mail'];
              $ID=$result['ID'];
              $template=$result['feedback_template'];

              $message=preg_replace( $patterns,$replacement,$template);
      
              // Отправляем
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
              $body .= $message;
              
              $mail = "elunina@shtorm-its.ru";
              //if ($smtp->send($mail, $Tema, $body, $header)){
              if (mail($mail, $Tema, $body, $header)){
                  $link = mysqli_connect(LINK_DB, LOGIN_DB, PASS_DB,TABLE_DB);
                  
                  mysqli_query($link,"SET CHARACTER SET utf8");
                  mysqli_query($link,"SET NAMES utf8");
                
                  $query = "UPDATE mail_data SET sent_feedback=1 WHERE ID={$ID};";
                  $res = mysqli_query($link,$query);
                  mysqli_close($link);
              }
              echo "Отправлено";
        }
        echo "Отправку закончил";
            
        


?>