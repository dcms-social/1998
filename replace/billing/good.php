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


echo '<div class="mess">';
echo 'Ваш счет успешно пополнен!';
echo '</div>';


echo '<div class="foot"><img src="img/billing.png"> <a href="index.php">Биллинг</a></div>';


include_once TFOOT;

?>
