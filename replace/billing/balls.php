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
$set['title']="Покупка баллов"; 
include_once THEAD; 
title(); 
aut(); 
only_reg();
$bill = mysql_fetch_assoc(mysql_query("select `balls` from `billing` "));



if (isset($_GET['ok']) && isset($_POST['ok'])){ 

$bls = intval($_POST['wmr']*$bill['balls']);

if(($user['billing'] >= $_POST['wmr'])){

if($_POST['wmr'] != 0){

$wmr = intval($_POST['wmr']);

mysql_query("UPDATE `user` SET `balls` = '".($user['balls']+$bls)."' WHERE `id` = '$user[id]' LIMIT 1");

mysql_query("UPDATE `user` SET `billing` = '".($user['billing']-intval($_POST['wmr']))."' WHERE `id` = '$user[id]' LIMIT 1");

mysql_query("INSERT INTO `billing_operations` (`id_user`, `wmr`, `op`, `time`, `comm`) VALUES ('".$user['id']."', '".$wmr."', 'balls', '".$time."', '".$bls."')");


$_SESSION['message'] = "Вы успешно купили $bls баллов за $wmr wmr!";

header("Location: ?good".SID); 

}else{
echo "<div class='err'>Введите сумму!</div>";
}

}else{
echo "<div class='err'>На вашем счету недостаточно средств!</div>";
}
err(); 

}
echo '<div class="mess"><img src="img/wmr.gif">  <font color="gray">На счету:</font> <font color="green">';
echo $user['billing'];
echo ' </font> <font color="#9966cc"><b>wmr</b></font>
<br /> </div>';
echo "<div class='mess'>";
echo "<form method='post' action='?nick&ok'>"; 
echo '<font color="green">1</font> <font color="#9966cc"><b>wmr</b></font> = '.$bill['balls'].' баллов<hr>'; 
echo "Введите сумму: <br /><input type='text' size = '8' name='wmr'> wmr<br />
"; 
echo "<input type='submit' name='ok' value='Купить'></form>";
echo "</div>";

echo '<div class="foot"><img src="img/billing.png"> <a href="index.php">Биллинг</a></div>';

include_once TFOOT;
?>
