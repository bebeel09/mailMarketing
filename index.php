<?php 
include_once "php/constant.php";
include_once 'Controller/sendMail.class.php';

$patterns=array();
$patterns[1]='/{FIO}/';
$patterns[2]='/{act}/';


$Tema = "Ваше оборудование готово к выдаче.";
$FromName = "ШТОРМ. Сварочное оборудование";
$From = "info@shtorm-its.ru";
$dommen = "shtorm-its.ru";



function jsondecode ($sText){
	if (!$sText) return false;
	$sText = iconv('cp1251', 'utf8', $sText);
	$aJson = json_decode($sText, true);
	return $aJson;
}
//декодируем полученный JSON

$arr =  file_get_contents('php://input');
$jsonText = jsondecode($arr);


if($jsonText && $jsonText['email']!="" && $jsonText['fio']!="")
{
    switch ($jsonText['status']) {

        case 'Готов к выдаче':
            $mail= $jsonText['email'];
            $act=$jsonText['number_akt']; 
            $first_name=$jsonText['fio'];
            $status=$jsonText['status'];
        
        
            //подключение к БД
            $link = mysqli_connect(LINK_DB, LOGIN_DB, PASS_DB,TABLE_DB);
            
            mysqli_query($link,"SET CHARACTER SET utf8");
            mysqli_query($link,"SET NAMES utf8");
           
            $query = "SELECT * FROM mail_data WHERE mail='$mail' AND act_num='$act' AND FIO='$first_name' AND status_give='$status';";
            $res = mysqli_query($link,$query);
            if(mysqli_num_rows($res)>0){
              die("Такая запись уже существует");
            }else{
              $query = "INSERT INTO mail_data (mail,act_num,FIO,create_date,sent,status_give) VALUES ('$mail','$act','$first_name',CURDATE(),0,'$status');";
              $res = mysqli_query($link,$query);
              $last_id = mysqli_insert_id($link);
            }
          
            mysqli_close($link);

            if (!$res) 
            {
                $f = fopen('debug_query.txt', 'w+');
                fwrite($f, $query);
                fclose($f);
                die();
            }
           
            $smtp = new SendMailSmtpClass("info@shtorm-its.ru", "jikmjikm", "mail.shtorm-its.ru", "info@shtorm-its.ru", $smtp_port = 25, $smtp_charset = "utf-8") or die("всё плохо");
            
            $replacement=array();
            $replacement[1]=$first_name;
            $replacement[2]=$act;

            $template="<div>
            <center>
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
                                <h1 style=\"color: #2ab27b; font-size: 1.8em; line-height: 26px; margin-bottom: 12px;\">Уважаемый(ая) {FIO}"."!</h1>
                                <p style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-size: 17px; line-height: 24px; margin: 0 0 16px; text-size-adjust: 100%;\">Оборудование принятое на ремонт по акту {act} готово к выдаче.</p>
                                <p style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-size: 17px; line-height: 24px; margin: 0 0 16px; text-size-adjust: 100%;\">
                                  <b>Благодарим вас за выбор нашей организации для ремонта/диагностики Вашего оборудования. Будем рады, если оно прослужит Вам долго.</b>
                                </p>
                                  <hr style=\"margin-bottom: 25px;\">
                                  <p style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-size: 17px; line-height: 24px; margin: 0 0 16px; text-size-adjust: 100%;\">
                                  <b>Вот несколько простых советов по обслуживанию оборудования, которые необходимо регулярно проводить: </b>
                                  </p>
                                  <p style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-size: 17px; line-height: 24px; margin: 0 0 16px; text-size-adjust: 100%;\">1. Перед началом работы осматривайте сварочное оборудование для выявления случайных повреждений отдельных наружных частей, проверяйте заземление источника питания и надёжность подключения сварочных проводов к зажимам источника питания и свариваемому изделию.</p>
                                  <p style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-size: 17px; line-height: 24px; margin: 0 0 16px; text-size-adjust: 100%;\">2. Ежемесячно очищайте сварочное оборудование от пыли и грязи, продувая источник питания сжатым воздухом, а в доступных местах протирайте ветошью.</p>
                                  <p style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-size: 17px; line-height: 24px; margin: 0 0 16px; text-size-adjust: 100%;\">3. Не реже одного раза в месяц проверяйте состояние электрических проводов, электрических контактов и паек, обеспечте надёжные контакты.</p>
                                  <p style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-size: 17px; line-height: 24px; margin: 0 0 16px; text-size-adjust: 100%;\">4. Один раз в 6 месяцев (при интенсивной эксплуатации) проводите полный плановый текущий осмотр для выявления необходимости ремонта.</p>
                                  <p style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-size: 17px; line-height: 24px; margin: 0 0 16px; text-size-adjust: 100%;\">
                                    <b>При выдаче оборудования Вам будет дана индивидуальная рекомендация по дальнейшей эксплуатации.</b>
                                  </p>
                                  <hr>
                                  <h2 style=\"color: #2ab27b; font-size: 1.5em; line-height: 26px; margin-bottom: 12px;\">В настоящий момент действуют акции:</h2>
                                  <a href=\" https://www.shtorm-its.ru/catalog/svarka/orbitalnaya-svarka/\"><img src=\"https://www.shtorm-its.ru/upload/iblock/1cb/1cb701b87b8ee8654d91157a821f835c.jpg\" alt=\"\" width=\"546\" height=\"142\" title=\"Машинка для заточки вольфрамовых электродов в подарок!\" style=\"-ms-interpolation-mode: bicubic; border: 0; height: auto; line-height: 100%; outline: 0; text-decoration: none;\"></a>
                                  <p style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-size: 17px; line-height: 24px; margin: 0 0 16px; text-size-adjust: 100%;\">При покупке установки орбитальной сварки дарим машинку для заточки вольфрамовых электродов!
                                  Предложение действительно до 31 мая!.</p>
                               <a href=\"https://www.shtorm-its.ru/info/stock/obmen-svarochnogo-oborudovaniya-trade-in/\"><img src=\"https://www.shtorm-its.ru/images/tradein.png\" alt=\"\" width=\"546\" height=\"142\" title=\"Расчитать трейд-ин и получить максимальную выгоду\" style=\"-ms-interpolation-mode: bicubic; border: 0; height: auto; line-height: 100%; outline: 0; text-decoration: none;\"></a>
                                <p style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-size: 17px; line-height: 24px; margin: 0 0 16px; text-size-adjust: 100%;\">При сдаче сварочных инверторов, эксплуатировавшихся не более 7 лет, предлагаем специальные условия приобретения нового сварочного оборудования LORCH.</p>
                               <hr>
                              </td>
                            </tr>
                            <tr>
                              <td valign=\"top\" style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0; mso-table-rspace: 0; text-size-adjust: 100%;\">
                                <h2 style=\"color: #2ab27b; font-size: 1.5em; line-height: 26px; margin-bottom: 12px;\">Узнавайте первыми о скидках!</h2>
                                <p style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-size: 17px; line-height: 24px; margin: 0 0 16px; text-size-adjust: 100%;\">Для получения полезной и интересной информации об оборудовани и технологиях сварки и резки металлов подписывайтесь на наши аккаунты в соцсетях в Instagram и Youtube!</p>
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
                              <a href=\"https://shtorm-its.ru/?utm_source=email&utm_medium=community&utm_campaign=link_in_rassilka\" style=\"-moz-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #439fe0; font-weight: bold; text-decoration: none; text-size-adjust: 100%; word-break: break-word;\">www.shtorm-its.ru</a> •&nbsp;2019
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
            </center></div>";

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
          if ($smtp->send($mail, $Tema, $body, $header)){
            $link = mysqli_connect(LINK_DB, LOGIN_DB, PASS_DB,TABLE_DB);
            
            mysqli_query($link,"SET CHARACTER SET utf8");
            mysqli_query($link,"SET NAMES utf8");
           
            $query = "UPDATE mail_data SET sent=1 WHERE ID={$last_id};";
            $res = mysqli_query($link,$query);
            mysqli_close($link);
          }
            echo "Отправлено";
            
            break;
        
        default:
            die("Не готов к выдаче");
            break;
    }

} else die("Данные не получены или отсутствуют критически важные поля. Операция прервана");

	?>