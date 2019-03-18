<?php 
require "constant.php";

$tableString="<tr>
<th>Идентификатор</th>
<th>MAIL</th>
<th>ФИО</th>
<th>АКТ</th>
<th>ID Шаблона письма<th>
</tr>";

    $link = mysqli_connect(LINK_DB, LOGIN_DB, PASS_DB,TABLE_DB);
    // if ( mysqli_connect_errno() ) {
    //     printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    //     die();
    // }
    // else {
    //     printf("Удалось подключиться: %s\n", mysqli_get_host_info($link));
    // }
    mysqli_query($link,"SET CHARACTER SET utf8");
    mysqli_query($link,"SET NAMES utf8");
    
    $query = "SELECT ID ,mail, act_num, FIO, id_email_template, phone_num FROM mail_data";
    $res = mysqli_query($link,$query);  
    mysqli_close($link);
    
while($result= mysqli_fetch_assoc($res)){
$tableString.="<tr><th>{$result['ID']}</th><th>{$result['mail']}</th><th>{$result['FIO']}</th><th>{$result['act_num']}</th><th>{$result['id_email_template']}</th></tr>";
};
echo $tableString;
exit();
    ?>