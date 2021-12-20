<?
include_once '../sys/inc/start.php';
include_once COMPRESS;
include_once SESS;
include_once '../sys/inc/home.php';
include_once SETTINGS;
include_once DB_CONNECT;
include_once IPUA;
include_once FNC;
include_once USER;
$set['title']='История моих операций';

include_once THEAD;

?>
<style>
.vpravo{float:right;}
</style>
<?
title();
aut();
only_reg();
$bill = mysql_fetch_assoc(mysql_query("select balls,money from `billing` "));


$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `billing_operations`  WHERE  `id_user` = '".$user['id']."' "), 0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];

if ($k_post==0)
{
echo '<div class="err">У вас нет операций!</div>';
}

$q=mysql_query("SELECT * FROM `billing_operations`  WHERE  `id_user` = '".$user['id']."' or `id_user2` = '".$user['id']."' ORDER BY `time` DESC LIMIT $start, $set[p_str]");
while ($res = mysql_fetch_assoc($q)) {


if($res['op'] == 'add') { $op = '<img src="img/plus.gif"> Вы пополнили свой счет на <span class="mess"><font color="green"><b>'.$res['wmr'].'</b></font> <font color="#9966cc"><b>wmr</b></font></span>'; }
elseif($res['op'] == 'nick') { $op = '<img src="img/minus.gif"> Вы сменили свой ник на <font color="3b5998">'.$res['comm'].'</font> за <span class="mess"><font color="red"><b>'.$res['wmr'].'</b></font> <font color="#9966cc"><b>wmr</b></font></span>'; }
elseif($res['op'] == 'balls') { 
$op = '<img src="img/minus.gif"> Вы купили себе <font color="#3b5998">'.$res['comm'].'</font> баллов за <span class="mess"><font color="red"><b>'.$res['wmr'].'</b></font> <font color="#9966cc"><b>wmr</b></font></span>'; }

elseif($res['op'] == 'money') { 
if ($res['wmr'] == 1) $a = 'у';
else $a = '';
$op = '<img src="img/minus.gif"> Вы купили себе <font color="#3b5998">'.$res['comm'].'</font> монет'.$a.' за <span class="mess"><font color="red"><b>'.$res['wmr'].'</b></font> <font color="#9966cc"><b>wmr</b></font></span>'; }

elseif($res['op'] == 'perevod' and $res['id_user'] == $user['id']) {
$us2 = get_user($res['id_user2']); 
$op = '<img src="img/minus.gif"> Вы перевели пользователю <a href="/info.php?id='.$us2['id'].'">'.$us2['nick'].' </a> <span class="mess"><font color="red"><b>'.$res['wmr'].'</b></font> <font color="#9966cc"><b>wmr</b></font></span>'; }

elseif($res['op'] == 'perevod' and $res['id_user2'] == $user['id']) {
$us = get_user($res['id_user']); 
$op = '<img src="img/minus.gif"> Пользователь <a href="/info.php?id='.$us['id'].'">'.$us['nick'].' </a> перевел вам <span class="mess"><font color="red"><b>'.$res['wmr'].'</b></font> <font color="#9966cc"><b>wmr</b></font></span>'; }

elseif($res['op'] == 'icon') { 
$op = '<img src="img/minus.gif"> Вы купили себе иконку за <span class="mess"><font color="red"><b>'.$res['wmr'].'</b></font> <font color="#9966cc"><b>wmr</b></font></span>'; }



echo '<div class="mess"> '.$op.' <span class="vpravo">'.vremja($res['time']).'</span></div>';


}
if ($k_page>1)str('?',$k_page,$page); // Вывод страниц


echo '<div class="foot"><img src="img/billing.png"> <a href="index.php">Биллинг</a></div>';


err();
include_once TFOOT;
?>