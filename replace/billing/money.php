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



$bill = mysql_fetch_assoc(mysql_query("select `secretKey`,`wmr` from `billing` "));



$rub = $_POST['LMI_PAYMENT_AMOUNT'];

$secretKey = $bill['secretKey'];
$wmr = $bill['wmr'];



$user = intval($_POST['id_user']);
$us = mysql_fetch_array(mysql_query("SELECT id, billing  FROM `user` WHERE `id` = $user LIMIT 1"));


if( isset($_POST['LMI_PREREQUEST']) && $_POST['LMI_PREREQUEST'] == 1) 
{	



    if($_POST['LMI_PAYEE_PURSE'] != $wmr)
	{
	$error = TRUE;
    }
	elseif (!isset($us['id']))
	{
	$error = TRUE;
    }
	elseif(!isset($rub) or $rub < 1 or $rub > 99999)
	{
	$error = TRUE;
    }
	elseif ($error == TRUE)
	{
	echo 'Ошибка! Данные не совпадают!';
	exit();
	}
	else
	{
	print 'YES';
	

}
}

	 $common_string = $_POST['LMI_PAYEE_PURSE'].$_POST['LMI_PAYMENT_AMOUNT'].$_POST['LMI_PAYMENT_NO'].
     $_POST['LMI_MODE'].$_POST['LMI_SYS_INVS_NO'].$_POST['LMI_SYS_TRANS_NO'].
     $_POST['LMI_SYS_TRANS_DATE'].$secretKey.$_POST['LMI_PAYER_PURSE'].$_POST['LMI_PAYER_WM'];
  
  $hash = strtoupper(md5($common_string));
  
 
  if($hash==$_POST['LMI_HASH']) {
  
  
	mysql_query("UPDATE `user` SET `billing` = '".($us['billing'] + $rub)."' WHERE `id` = '".$us['id']."' LIMIT 1");
	
	mysql_query("INSERT INTO `billing_operations` (`id_user`, `wmr`, `op`, `time`) VALUES ('".$us['id']."', '".$rub."', 'add', '".$time."')");

	exit;

    }
    else {
    echo 'Секретный ключ не совпадает!';
    exit;
    }
?>
