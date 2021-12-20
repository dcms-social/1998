<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/sys/inc/home.php';
include_once H.'sys/inc/start.php';
include_once COMPRESS;
include_once SESS;
include_once SETTINGS;
include_once DB_CONNECT;
include_once H.'sys/inc/ipua.php';
include_once H.'sys/inc/fnc.php';
include_once H.'sys/inc/user.php';
$set['title']='Биллинг';
include_once THEAD;
title();
aut();
only_reg();

$bill = mysql_fetch_assoc(mysql_query("select `billing` from `user` where `id` = {$user['id']}"));
$stat = mysql_fetch_assoc(mysql_query("select `stat` from `billing` "));

echo '<div class="mess"><img src="img/wmr.gif"> <font color="gray">На счету:</font> <font color="green">';
echo $bill['billing'];
echo ' </font> <font color="#9966cc"><b>wmr</b></font>
<br /> </div>';

echo'<div class="main_menu"><img src="img/add.png">
<a href="merchant.php">Пополнить счет</a></div>';

echo'<div class="main_menu"><img src="img/nick.png">
<a href="nick.php">Сменить ник</a></div>';

echo'<div class="main_menu"><img src="img/nick.png">
<a href="icon.php">Сменить иконку</a></div>';

echo'<div class="main_menu"><img src="img/money.png">
<a href="balls.php">Купить баллы</a></div>';

echo'<div class="main_menu"><img src="img/money.png">
<a href="moneys.php">Купить монеты</a></div>';

echo'<div class="main_menu"><img src="img/perevod.gif">
<a href="perevod.php">Перевод средств</a></div>';

echo'<div class="main_menu"><img src="img/my.png">
<a href="my_operations.php">Мои операции</a></div>';

if($stat['stat'] == 1) {
echo'<div class="main_menu"><img src="img/stat.png">
<a href="stat.php">Статистика биллинга</a></div>';
}
else {
if ($user['level'] > 4){
echo'<div class="main_menu"><img src="img/stat.png">
<a href="stat.php">Статистика биллинга</a></div>';
}
}


if($user['level'] == 10) {
echo'<div class="main_menu"><img src="img/set.png">
<a href="settings.php">Настройки биллинга</a></div>';
}

include_once TFOOT;

?>