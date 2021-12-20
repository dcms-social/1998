<?
include_once '../sys/inc/start.php';
include_once COMPRESS;
include_once SESS;
include_once '../sys/inc/home.php';
include_once SETTINGS;
include_once DB_CONNECT;
include_once IPUA;
include_once FNC;
include_once ADM_CHECK;
include_once USER;




$set['title']='Настройки биллинга';
include_once THEAD;
title();
err();
aut();

if($user['level'] == 10) {

$bill = mysql_fetch_assoc(mysql_query("select * from `billing` "));


echo "<div class='mess'>
<form action='?' method='POST'>

WMR кошелек:<br/>
<input type='text' name='wmr'  value ='".input_value_text($bill['wmr'])."' /> <br/> 

Секретный ключ:<br/>
<input type='text' name='secretKey'  value ='".input_value_text($bill['secretKey'])."' /> <br/> 

Смена ника:<br/>
<input type='text' name='nick' size = '8' value ='".input_value_text($bill['nick'])."' /> wmr<br/> 

1 wmr:<br/>
<input type='text' name='balls' size = '8' value ='".input_value_text($bill['balls'])."' /> баллов<br/> 

1 wmr:<br/> 
<input type='text' name='money' size = '8' value ='".input_value_text($bill['money'])."' /> монет<br/> 

Иконка:<br/> 
<input type='text' name='icon' size = '8' value ='".input_value_text($bill['icon'])."' /> wmr<br/> 

Статистика биллинга:<br /> <input name='stat' type='radio' ".($bill['stat']==1?' checked="checked"':null)." value='1' />Видна всем<br />
<input name='stat' type='radio' ".($bill['stat']==0?' checked="checked"':null)." value='0' />Только администрации<br />

<input type='submit' name='add' value='Изменить'/><br/> 
</form>
</div>";


if(isset($_POST['add'])) {
if($_POST['nick'] >= 0 and $_POST['balls'] >= 0 and $_POST['money'] >= 0 and $_POST['wmr'] != "") {


if (isset($_POST['stat']) && $_POST['stat']==1)
{
mysql_query("UPDATE `billing` SET `stat` = '1' LIMIT 1");
}
if (isset($_POST['stat']) && $_POST['stat']==0)
{
mysql_query("UPDATE `billing` SET `stat` = '0' LIMIT 1");
}


mysql_query("update `billing` set `wmr` = '".my_esc($_POST['wmr'])."' ");
mysql_query("update `billing` set `secretKey` = '".my_esc($_POST['secretKey'])."' ");
mysql_query("update `billing` set `nick` = '".intval($_POST['nick'])."' ");
mysql_query("update `billing` set `balls` = '".intval($_POST['balls'])."' ");
mysql_query("update `billing` set `money` = '".intval($_POST['money'])."' ");
mysql_query("update `billing` set `icon` = '".intval($_POST['icon'])."' ");

$_SESSION['message'] = "Настройки сохранены!";

header("location: ?save");
} else
{
echo '<div class="err"> Ошибка доступа!</div>';
}




}
}
else { header("Location: index.php".SID); }

echo '<div class="foot"><img src="img/billing.png"> <a href="index.php">Биллинг</a></div>';

include_once TFOOT;
?>