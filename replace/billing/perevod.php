<?
include_once '../sys/inc/start.php';
include_once COMPRESS; 
include_once SESS; 
include_once '../sys/inc/home.php'; 
include_once SETTINGS; 
include_once DB_CONNECT; 
include_once IPUA; 
include_once FNC; 
include_once '../sys/inc/user.php'; 
$set['title']="Перевод средств"; 
include_once THEAD; 
title(); 
aut(); 
only_reg();

if (isset($_GET['user'])){ 

$us = get_user(intval($_GET['user']));

if($us['id'] == 0) {
$err = 'Пользователь не найден!';
}
elseif($us['id'] == $user['id']) {
$err = 'Вы не можете себе передавать средства!';
}
else {

echo '<div class="mess"><img src="img/wmr.gif">  <font color="gray">На счету:</font> <font color="green">';
echo $user['billing'];
echo ' </font> <font color="#9966cc"><b>wmr</b></font></div>';

echo '<div class="main"> Получатель: <font color="#3b5998">'.$us['nick'].'</font> </div>';
echo "<div class='mess'><form method='post' action='?user=$us[id]&ok'>";  
echo "Введите сумму: <br /><input type='text' size = '8' name='wmr'> wmr<br />"; 

echo "Комментарий: <br /><textarea name='comm'></textarea><br />"; 

echo "<input type='submit' name='ok' value='Передать'></form>";
echo "</div>";

if (isset($_GET['ok']) && isset($_POST['ok'])){ 

$wmr = intval($_POST['wmr']);
$comm = my_esc($_POST['comm']);

if($user['billing'] >= $wmr){

if ($wmr<1)$err="Неверная сумма!"; 
if (strlen2($comm)<3)$err="Короткий комментарий!";

if (!isset($err)){ 
mysql_query("UPDATE `user` SET `billing` = '".($user['billing']-$wmr)."' WHERE `id` = '$user[id]' LIMIT 1");

mysql_query("UPDATE `user` SET `billing` = '".($us['billing']+$wmr)."' WHERE `id` = '$us[id]' LIMIT 1");

mysql_query("INSERT INTO `billing_operations` (`id_user`, `wmr`, `op`, `time`, `id_user2`, `comm`) VALUES ('".$user['id']."', '".$wmr."', 'perevod', '".$time."', '".$us['id']."', '".$comm."')");

mysql_query("INSERT INTO `mail` (`id_user`, `id_kont`, `msg`, `time`) 
values('0', '".$us['id']."', 'Пользователь [url=/info.php?id=$user[id]][b]$user[nick][/b][/url] перевел на ваш счет [url=/billing/my_operations.php][b]$wmr wmr[/b][/url]. Комментарий: $comm', '$time')");
 
 
$_SESSION['message'] = 'Перевод средств успешно завершен!';

header("Location: my_operations.php");

}

}
else
{
$err = 'На вашем счету недостаточно средств!';
}


}

}
}

err();


if (!isset($_GET['user'])){ 

echo "<form method=\"GET\" />";
echo "ID получателя<br/><input type=\"text\" name=\"user\" maxlength=\"16\"  /><br/>\n";
echo "<input type=\"submit\" value=\"Найти\" />";
echo "</form>\n";

}
echo '<div class="foot"><img src="img/billing.png"> <a href="index.php">Биллинг</a></div>';

include_once TFOOT;
?>
