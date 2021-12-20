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
$set['title']="Сменить ник!"; 
include_once THEAD; 
title(); 
aut(); 
only_reg();
$bill = mysql_fetch_assoc(mysql_query("select `nick` from `billing` "));

echo "dd".$bill;

if (isset($_GET['ok']) && isset($_POST['ok'])){ 
if($user['billing'] >= $bill['nick']){
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `nick` = '".my_esc($_POST['nick'])."'"),0)==0){ 
$nick=my_esc($_POST['nick']); 
if( !preg_match("#^([A-zА-я0-9-_ ])+$#ui", $_POST['nick']))$err[]='В нике присутствуют запрещенные символы';
if (preg_match("#[a-z]+#ui", $_POST['nick']) && preg_match("#[а-я]+#ui", $_POST['nick']))$err[]='Разрешается использовать символы только русского или только английского алфавита';
if (preg_match("#(^ )|( $)#ui", $_POST['nick']))$err[]='Запрещено использовать пробел в начале и конце ника';
if (strlen2($nick)<3)$err="Короткий ник"; 
if (strlen2($nick)>32)$err="Длинный ник"; 
} 
else $err[]='Ник "'.stripcslashes(htmlspecialchars($_POST['nick'])).'" уже занят';
if (!isset($err)){ 
mysql_query("UPDATE `user` SET `billing` = '".($user['billing']-$bill['nick'])."' WHERE `id` = '$user[id]' LIMIT 1");
mysql_query("UPDATE `user` SET `nick` = '".$nick."' WHERE `id` = '$user[id]' LIMIT 1");
mysql_query("INSERT INTO `billing_operations` (`id_user`, `wmr`, `op`, `time`, `comm`) VALUES ('".$user['id']."', '".$bill['nick']."', 'nick', '".$time."', '".$nick."')");

msg("Ваш ник успешно изменен на $nick! 
С вашего счета списано $bill[nick] wmr!");
echo '<div class="foot"><img src="img/billing.png"> <a href="index.php">Биллинг</a></div>';
include_once TFOOT; 
} 
}else{
echo "<div class='err'>На вашем счету недостаточно средств!</div>";
}
} 
err(); 

echo '<div class="mess"><img src="img/wmr.gif">  <font color="gray">На счету:</font> <font color="green">';
echo $user['billing'];
echo ' </font> <font color="#9966cc"><b>wmr</b></font>
<br /> </div>';
echo "<div class='mess'>";
echo "<form method='post' action='?nick&ok'>"; 
echo 'Смена ника стоит <font color="green">'.$bill['nick'].'</font> <font color="#9966cc"><b>wmr</b></font><br>'; 
echo "<input type='text' name='nick'><br>
"; 
echo "<input type='submit' name='ok' value='Изменить'></form>";
echo "</div>";

echo '<div class="foot"><img src="img/billing.png"> <a href="index.php">Биллинг</a></div>';

include_once TFOOT;
?>
