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
only_reg();

$set['title'] = 'Сменить иконку';
include_once THEAD;
title();


aut();

$bill = mysql_fetch_assoc(mysql_query("select `icon` from `billing` "));


echo '<div class="mess"><img src="img/wmr.gif">  <font color="gray">На счету:</font> <font color="green">';
echo $user['billing'];
echo ' </font> <font color="#9966cc"><b>wmr</b></font>
<br /> </div>';

echo '<div class="mess">';
echo 'Текущая иконка ' . user::avatar($user['id'], 2) . user::nick($user['id'], 1,1,1);
echo '</div>';

if(isset($_GET['size_error'])) {

$file = H.'/style/billing_icon/'.$user['id'].'.png';

if(file_exists($file)) {
$size = GetImageSize(H.'/style/billing_icon/'.$user['id'].'.png');
$w = $size[0];
$h = $size[1];

if($w != 16 or $h != 16) {
unlink(H.'style/billing_icon/'.$user['id'].'.png');

$err = 'Размер иконки должен быть 16 на 16!';
}
}
}

if(isset($_GET['save']) && isset($_POST['ok']))
{
if(($user['billing'] >= $bill['icon'])){
if (isset($_FILES['file']))
{
$type = $_FILES['file']['type'];
if ($type!=='image/jpeg' && $type!=='image/jpg' && $type!=='image/gif' && $type!=='image/png')$err='Это не картинка!';

}
if (!isset($err))
{
$tmp = $_FILES['file']['tmp_name'];
unlink(H.'style/billing_icon/'.$user['id'].'.png');
move_uploaded_file($tmp, 
H.'style/billing_icon/'.$user['id'].'.png');
chmod(H.'style/billing_icon/'.$user['id'].'.png', 0777);

$size = GetImageSize(H.'/style/billing_icon/'.$user['id'].'.png');
$w = $size[0];
$h = $size[1];

if($w != 16 or $h != 16) header("location: ?size_error");
else {
$_SESSION['message'] = "Иконка успешно установлена!";
mysql_query("UPDATE `user` SET `billing` = '".($user['billing']-$bill['icon'])."' WHERE `id` = '$user[id]' LIMIT 1");
mysql_query("INSERT INTO `billing_operations` (`id_user`, `wmr`, `op`, `time`, `comm`) VALUES ('".$user['id']."', '".$bill['icon']."', 'icon', '".$time."', '')");

header("Location: ?".SID); 

}


}
}
else
{
$err = "<div class='err'>На вашем счету недостаточно средств!</div>";

}
}
echo "<form method='post' action='?save' enctype='multipart/form-data'>";

echo 'Смена иконки стоит <font color="green">'.$bill['icon'].' </font> <font color="#9966cc"><b>wmr</b></font> <br />';
echo "<input type='file' name='file'/><br/>";
echo "<input value='Сменить' type='submit' name='ok' /><br />\n";
echo "</form>";





err();



echo '<div class="foot"><img src="img/billing.png"> <a href="index.php">Биллинг</a></div>';


include_once TFOOT;
?>