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
$set['title']='Пополнение счета';
include_once THEAD;
title();
aut();
only_reg();

$bill = mysql_fetch_assoc(mysql_query("select `wmr` from `billing` "));

    echo'<form class="mess" action="https://merchant.webmoney.ru/lmi/payment.asp" method="POST">
	Введите сумму:<br />
	<input type="text" name="LMI_PAYMENT_AMOUNT" value="1"><br />
	<input type="hidden" name="LMI_PAYMENT_DESC_BASE64" value="'.base64_encode('Пополнение счета:: ' . $user['nick']).'">
	<input type="hidden" name="LMI_PAYEE_PURSE" value="'.$bill['wmr'].'">
	<input type="hidden" name="id_user" value="'.$user['id'].'">
	<input type="submit" class="wmbtn" value="Пополнить">
	</form>';
	

echo '<div class="foot"><img src="img/billing.png"> <a href="index.php">Биллинг</a></div>';


include_once TFOOT;
?>
