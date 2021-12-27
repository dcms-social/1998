<!DOCTYPE html>
<html lang="ru">
<head>
<title><?echo $set['title'];?></title>
<link rel="stylesheet" href="/style/themes/<? echo $set['set_them']; ?>/style.css" type="text/css" />
</head>
<body>
<div class="body">
<div class="logo"><img src="/style/themes/default/logo.png"  alt="Logotype" /><br />
DCMS Social - Движок социальной сети</div>
<div class="title">
<?
echo $set['title']."\n";
ob_start();
?>
</div>