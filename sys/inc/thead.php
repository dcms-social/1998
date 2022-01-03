<?
if (setget('toolbar',1)==1)
{
?>
<div class="toolbar">
<div class="toolbar_inner"><a href="/">Главная</a>  |
<a href="/adm_panel/">Админ панель</a> |
  <a target="_blank" href="https://dcms-social.ru">DCMS-Social.ru</a>
</div>
</div>

<style>
  .toolbar {
    position: fixed;
    text-align: center;
    vertical-align: middle;

    color: #e07dc0;
    top: 0;
    left: 0;
    right: 0;
    margin-bottom: 50px;

    z-index: 9999;
    border-bottom: 1px solid #656969;
    width: 100%;

    background: rgb(15, 15, 15);
    height: 40px;

  }
  .toolbar_inner
  {
    display: inline-block;

    vertical-align: middle;
    text-align: center;
  }

html {

  padding-top: 40px;
}
</style>
<?php } ?>

<?php
$set['meta_keywords']=(isset($set['meta_keywords']))?$set['meta_keywords']:null;
$set['meta_description']=(isset($set['meta_description']))?$set['meta_description']:null;

// Ключевые слова
if ($set['meta_keywords']!=NULL)
{ 
	function meta_keywords($str)
	{
		global $set;
		return str_replace('</head>', '<meta name="keywords" content="'.$set['meta_keywords'].'" />'."\n</head>", $str);
	}
	ob_start('meta_keywords');
}

// Описание мета
if ($set['meta_description']!=NULL)
{
	function meta_description($str)
	{
		global $set;
		return str_replace('</head>', '<meta name="description" content="'.$set['meta_description'].'" />'."\n</head>", $str);
	}
	ob_start('meta_description');
}

if (file_exists(H."style/themes/$set[set_them]/head.php"))
include_once H."style/themes/$set[set_them]/head.php";
else
{
	$set['web'] = false;
	//header("Content-type: application/vnd.wap.xhtml+xml");
	//header("Content-type: application/xhtml+xml");
	header("Content-type: text/html");
	// echo '<?xml version="1.0" encoding="utf-8"?>';
	?><!DOCTYPE html>
  <html>
	<head>
	<title><?=$set['title']?></title>
	<link rel="shortcut icon" href="/favicon.ico" />
	<link rel="stylesheet" href="/style/themes/<?=$set['set_them']?>/style.css" type="text/css" />
	<link rel="alternate" title="Новости RSS" href="/news/rss.php" type="application/rss+xml" />
	</head>
	<body>
	<div class="body">
	<?
}

// Уведомления 
if (isset($_SESSION['message']))
{
	echo '<div class="msg">' . $_SESSION['message'] . '</div>'; 
	$_SESSION['message'] = NULL;
}

// Вывод ошибок
if (isset($_SESSION['err']))
{
	echo '<div class="msg">' . $_SESSION['err'] . '</div>';
	$_SESSION['err'] = NULL;
}


?>


<link rel="stylesheet" href="/style/system.css" type="text/css" />

    <div id="load"></div>
    <div id="content">