<?php
use \RedBeanPHP\R as R;

ini_set('max_execution_time', 7000);

set_time_limit(7000);

ini_set('session.gc_maxlifetime', 7000);

require_once 'vendor/autoload.php';
require_once 'Controller/sendMail.class.php';

$smtp = new SendMailSmtpClass("info@shtorm-its.ru", "jikmjikm", "mail.shtorm-its.ru", "info@shtorm-its.ru", $smtp_port = 25, $smtp_charset = "utf-8");

//R::setup('mysql:host=shtorm-its.ru;dbname=email_sender', 'shtorm_new', 'dupiz4peliz');
R::setup('mysql:host=localhost:8889;dbname=email_baza', 'root', 'root');
$current = R::findAll('testbemail', 'sended = 0 and stopped = 0');
//$current = R::findAll('rrrbemail', 'tradeinsend = 0 and stopped = 0');
define('UNSUBSCRIBE_SF', '<mailto:nk@shtorm-its.ru>');

$sended = 0;
$maxsended = 300;


foreach ($current as $client) {

    if($sended >= $maxsended) { die("Отправил ".$maxsended." сообщений"); }
//    var_dump($client);
//    if($client->sended) continue;


//            <img src=\"https://shtorm-its.ru/emailsimg/".$client->hash_email.".png\" width=\"1\" height=\"1\" alt=\"-\" style=\"-ms-interpolation-mode: bicubic; outline: none; text-decoration: none;\">

$msg = "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title></title>
    
    <meta name=\"format-detection\" content=\"telephone=no\"> </head>
  <body leftmargin=\"0\" marginwidth=\"0\" topmargin=\"0\" marginheight=\"0\" offset=\"0\" style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-box-sizing: border-box; -webkit-text-size-adjust: 100%; background: #f9f9f9; box-sizing: border-box; height: 100% !important; margin: 0; padding: 0; text-size-adjust: 100%; width: 100% !important;\">
  <div style='display:none;font-size:1px;color:#f9f9f9;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;'>
  Меняйтесь к лучшему на выгодных условиях!
</div>
    <center>
      <img src=\"https://shtorm-its.ru/emailsimg/".$client->hash_email.".png\" width=\"1\" height=\"1\" alt=\"-\" style=\"-ms-interpolation-mode: bicubic; outline: none; text-decoration: none;\">
      <table class=\"wrapper\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" border=\"0\" width=\"100%\" height=\"100%\" id=\"bodyTable\" style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-box-sizing: border-box; -webkit-text-size-adjust: 100%; background: #f9f9f9; border-collapse: collapse !important; box-sizing: border-box; color: #373737; height: 100% !important; margin: 0; mso-table-lspace: 0; mso-table-rspace: 0; padding: 0; text-size-adjust: 100%; width: 100% !important;\">
        <tr>
          <td align=\"center\" valign=\"top\" id=\"bodyCell\" style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-box-sizing: border-box; -webkit-text-size-adjust: 100%; background: #f9f9f9; box-sizing: border-box; height: 100% !important; margin: 0; mso-table-lspace: 0; mso-table-rspace: 0; padding: 0; text-size-adjust: 100%; width: 100% !important;\">
            <!-- BEGIN TEMPLATE -->
            <table botder=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"templateContainer\" style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse !important; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif !important; margin-bottom: 1rem; mso-table-lspace: 0; mso-table-rspace: 0; text-size-adjust: 100%; width: 600px;\">
              <!-- HEADER -->
              <tr>
                <td align=\"center\" valign=\"top\" style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0; mso-table-rspace: 0; text-size-adjust: 100%;\">
                  <table border=\"0\" cellpadding=\"32\" cellspacing=\"0\" width=\"100%\" id=\"templateHeader\" style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse !important; mso-table-lspace: 0; mso-table-rspace: 0; text-size-adjust: 100%;\">
                    <tr>
                      <td align=\"left\" class=\"templateColumn text_l\" style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0; mso-table-rspace: 0; text-align: left; text-size-adjust: 100%; width: 300px;\">
                        <a href=\"https://shtorm-its.ru/?utm_source=email&utm_medium=community&utm_campaign=link_in_rassilka\" style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #439fe0; font-weight: 700; text-decoration: none; text-size-adjust: 100%; word-break: break-word;\">
                          <img src=\"https://www.shtorm-its.ru/upload/emailsimg/logo150.png\" width=\"150\" height=\"51\" class=\"logo\" id=\"headerImage\" alt=\"Сварочное оборудование ШТОРМ\" style=\"-ms-interpolation-mode: bicubic; border: 0; height: 51px !important; line-height: 100%; margin-left: -1.5rem; outline: 0; text-decoration: none; width: 150px !important;\"> </a>
                      </td>
                      <td class=\"templateColumn text_r headerPhone\" align=\"right\" style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-size: 20px; mso-table-lspace: 0; mso-table-rspace: 0; text-align: right; text-size-adjust: 100%; width: 300px;\"> 8 (343) 304-64-50 </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <!-- END HEADER -->
              <!-- CONTENT -->
              <tr>
                <td style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0; mso-table-rspace: 0; text-size-adjust: 100%;\">
                  <table border=\"0\" cellpadding=\"32\" cellspacing=\"0\" width=\"100%\" id=\"content\" style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background: #fff; border-collapse: collapse !important; border-radius: .5rem; margin-bottom: 1.5rem; mso-table-lspace: 0; mso-table-rspace: 0; text-size-adjust: 100%;\">
                    <tr>
                      <td valign=\"top\" style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0; mso-table-rspace: 0; text-size-adjust: 100%;\">
                        <!-- <h1>Евгения Лунина! Здравствуйте!</h1> -->
                        <h1 style=\"color: #2ab27b; font-size: 1.8em; line-height: 26px; margin-bottom: 12px;\">Уважаемый(ая) ".$client->email."!</h1>
                        <p style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-size: 17px; line-height: 24px; margin: 0 0 16px; text-size-adjust: 100%;\">Вы уже работали с нашей компанией, поэтому сообщаем Вам в числе первых, что мы запустили программу TRADE-IN при покупке сварочного оборудования LORCH.</p>
                        <p style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-size: 17px; line-height: 24px; margin: 0 0 16px; text-size-adjust: 100%;\">
                          <b>Оставьте заявку для расчета трейд-ин</b>
                        </p>
                        <img src=\"https://www.shtorm-its.ru/images/tradein.png\" alt=\"\" width=\"546\" height=\"142\" title=\"Расчитать трейд-ин и получить максимальную выгоду\" style=\"-ms-interpolation-mode: bicubic; border: 0; height: auto; line-height: 100%; outline: 0; text-decoration: none;\">
                        <p style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-size: 17px; line-height: 24px; margin: 0 0 16px; text-size-adjust: 100%;\">При сдаче сварочных инверторов, эксплуатировавшихся не более 7 лет, предлагаем специальные условия приобретения нового оборудования LORCH.</p>
                        <p style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-size: 12px; line-height: 24px; margin: 0 0 16px; text-size-adjust: 100%;\">*дополнительно действует программа лояльности для постоянных клиентов
                          <br> *подробную информацию можно получить у специалистов компании по тел. (343) 304 64 50 или отправив запрос на
                          <a href=\"mailto:ekb@shtorm-its.ru\" style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #439fe0; font-weight: 700; text-decoration: none; text-size-adjust: 100%; word-break: break-word;\">ekb@shtorm-its.ru</a>
                        </p>
                      </td>
                    </tr>
                    <tr>
                      <td valign=\"top\" style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0; mso-table-rspace: 0; text-size-adjust: 100%;\">
                        <h2 style=\"color: #2ab27b; font-size: 1.5em; line-height: 26px; margin-bottom: 12px;\">Узнавайте первыми о скидках!</h2>
                        <p style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-size: 17px; line-height: 24px; margin: 0 0 16px; text-size-adjust: 100%;\">Подписывайтесь на наши соцсети в Instagram и Youtube!</p>
                        <div style=\"margin: 0 auto 8px; margin-bottom: 12px; text-align: center;\" class=\"text_c\">
                          <a href=\"https://www.instagram.com/shtorm_its/\" style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #555549; font-weight: bold; margin-right: 8px; text-decoration: none; text-size-adjust: 100%; word-break: break-word;\">
                            <img src=\"https://shtorm-its.ru/upload/emailsimg/instagramm.jpg\" alt=\"\" width=\"150\" height=\"80\" title=\"Подписаться на Instagram\" style=\"-ms-interpolation-mode: bicubic; border: none; height: auto; line-height: 100%; outline: none; text-decoration: none;\"> </a>
                          <a href=\"https://www.youtube.com/user/shtormTv?sub_confirmation=1\" style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #717274; font-size: 12px; font-weight: normal; text-decoration: none; text-size-adjust: 100%; word-break: break-word;\">
                            <img src=\"https://shtorm-its.ru/upload/emailsimg/youtube.jpg\" alt=\"\" width=\"150\" height=\"80\" title=\"Подписаться на Youtube\" style=\"-ms-interpolation-mode: bicubic; border: none; height: auto; line-height: 100%; outline: none; text-decoration: none;\"> </a>
                        </div>
                        <p style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-size: 17px; line-height: 24px; margin: 0 0 16px; text-size-adjust: 100%;\">С уважением, коллектив компании ШТОРМ.</p>
                      </td>
                    </tr>
                  </table>
                  <table border=\"0\" cellpadding=\"32\" cellspacing=\"0\" width=\"100%\" id=\"content\" style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background: #fff; border-collapse: collapse !important; border-radius: .5rem; margin-bottom: 1.5rem; mso-table-lspace: 0; mso-table-rspace: 0; text-size-adjust: 100%;\">
                    <tr>
                      <td style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0; mso-table-rspace: 0; text-size-adjust: 100%;\">
                        <p style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #AAA; font-size: 10px; line-height: 20px; margin: 0 auto 1rem; margin-bottom: 0; max-width: 100%; text-align: center; text-size-adjust: 100%; word-break: break-word;\"> Не хотите больше получать от нас письма?
                          <br>
                          <a href=\"https://www.shtorm-its.ru/unsubscribe/".$client->hash_email." style = \"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #439fe0; font-weight: bold; text-decoration: none; text-size-adjust: 100%; word-break: break-word;\">Отказаться от писем</a>
                        </p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0; mso-table-rspace: 0; text-size-adjust: 100%;\">
            <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" id=\"templateFooter\" style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background: #fff; border-collapse: collapse !important; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif !important; mso-table-lspace: 0; mso-table-rspace: 0; text-size-adjust: 100%;\">
              <tr>
                <td valign=\"top\" align=\"center\" style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0; mso-table-rspace: 0; padding: 16px 8px 24px; text-size-adjust: 100%;\">
                  <div style=\"max-width: 600px; margin: 0 auto;\">
                    <p style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-size: 12px; line-height: 20px; margin: 0 0 16px; margin-top: 16px; text-size-adjust: 100%;\"> ООО \"ШТОРМ\" -
                      <a href=\"https://shtorm-its.ru/?utm_source=email&utm_medium=community&utm_campaign=link_in_rassilka\" style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #439fe0; font-weight: bold; text-decoration: none; text-size-adjust: 100%; word-break: break-word;\">www.shtorm-its.ru</a> •&nbsp;2018
                      <br>
                      <a href=\"#\" style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #989EA6; font-weight: normal; pointer-events: none; text-decoration: none; text-size-adjust: 100%; word-break: break-word;\"> г. Верхняя Пышма ул. Бажова 28 </a>
                      <br> 8 (343) 304 64 50 </p>
                  </div>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </center>
    <!-- END content -->
  </body>
</html>
";

    $Tema = "TRADE-IN при покупке сварочного оборудования LORCH.";
    $FromName = "ШТОРМ. Сварочное оборудование";
    $From = "info@shtorm-its.ru";
    $dommen = "shtorm-its.ru";
    $To = $client->client;
//    $To = "nk@shtorm-its.ru";


    $uid = uniqid('sf');
    var_dump($uid);
    $header = "MIME-Version: 1.0\r\n";
    $header .= "From: =?utf-8?B?"  . base64_encode($FromName) . "?= <" . $From . ">" . "\r\n";
    $header .= "Organization: " . $dommen . " \r\n";
//    $header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n"; //work
    $header .= "Content-Type: multipart/alternative; boundary=\"" . $uid . "\"\r\n";
    $header .= "To: " . $To . "\r\n";
    $header .= "List-Unsubscribe: " . UNSUBSCRIBE_SF;
    $body = "This is a MIME encoded message.";
    $body .= "\r\n\r\n--" . $uid . "\r\n";
    $body .= "Content-type: text/plain;charset=utf-8\r\n\r\n";
    $body .= "\r\n";
    $body .= trim(strip_tags($msg));
    $body .= "\r\n\r\n--" . $uid . "\r\n";
    $body .= "Content-type: text/html;charset=utf-8\r\n\r\n";
    $body .= "\r\n";
    $body .= $msg;

//    $body .= "\r\n\r\n--" . $uid . "\r\n";

// START FILE
//    $attachments = "buklet.pdf";
//    $file = 'buklet.pdf';
//    $file_size = filesize($file);
//    $handle = fopen($file, "r");
//    $content = fread($handle, $file_size);
//    fclose($handle);
//    $content = chunk_split(base64_encode($content));
//    $body .= "Content-Type: application/octet-stream; name=\"".$file."\"\r\n"; // use different content types here
//    $body .= "Content-Transfer-Encoding: base64\r\n";
//    $body .= "Content-Disposition: attachment; filename=\"".$file."\"\r\n\r\n";
//    $body .= $content."\r\n\r\n";
// END FILE

//    $body .= "--" . $uid . "\r\n";


//    $body .= "Content-Type: application/octet-stream; name=\"".$attachments."\"\r\n\r\n";

//    $body .= "Content-Type: application/pdf; name=\"".$attachments."\"\r\n\r\n";
//    $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
//    $att = fopen($attachments, "rb");
//
//    $dataAtt = fread($att, filesize($attachments));
//    fclose($att);
//
//    $body .= chunk_split(base64_encode($dataAtt))."\r\r";
//    $body .= "\r\n\r\n--" . $uid . "\r\n";
    $smtp->send('nk@shtorm-its.ru', $Tema, $body, $header);
   $res = $smtp->send($To, $Tema, $body, $header);

//   if($sended%10 == 0) {
//       $test_emails = [
//           'nk@shtorm-its.ru',
//
//       ];
       $rand = mt_rand(0,2);
       $smtp->send('nk@shtorm-its.ru', $Tema, $body, $header);
//   }

//    $client->sended = 1;
    $client->tradeinsend = 1;
    R::store($client);
    $sended++;
    sleep(15);
   if($res) {
        echo $client->client . " --- <span style='color:green;'>success</span><br>";
   } else {
       echo $client->client . " --- <span style='color:red;'>UNSUCCESS</span>";
   }
}
//if($res) {
    echo "successs";
//}