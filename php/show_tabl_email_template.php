<?php 
require "constant.php";

$tableString="<tr>
<th>Идентификатор</th>
<th>Шаблон</th>
<th>Кнопка</th>
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

    $query = "SELECT ID, template FROM email_template";
    $res = mysqli_query($link,$query);  
    mysqli_close($link);
while($result= mysqli_fetch_assoc($res)){

    $template_small=substr($result['template'],0,200)."...";

$tableString.="<tr><th>{$result['ID']}</th><th>{$template_small}</th><th><button data-email='{$result["template"]}' data-id='{$result["ID"]}' class='menu__button'>Изменить</button></th></tr>";
};

echo $tableString;
exit();
    ?>