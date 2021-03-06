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

/* Бан пользователя */ 
if (dbresult(dbquery("SELECT COUNT(*) FROM `ban` WHERE `razdel` = 'forum' AND `id_user` = '$user[id]' AND (`time` > '$time' OR `view` = '0' OR `navsegda` = '1')"), 0)!=0)
{
	header('Location: /ban.php?'.SID);
	exit;
}

// Заголовок страницы
$set['title']='Форум - новое в темах';

include_once THEAD;
title();
aut(); // форма авторизации


// Меню возврата
echo '<div class="foot">';
echo '<img src="/style/icons/str2.gif" /> <a href="/forum/">Форум</a> | <b>Новые посты</b>';
echo '</div>';


$adm_add = NULL;
$adm_add2 = NULL;

if (!isset($user) || $user['level'] == 0)
{
	$q222 = dbquery("SELECT * FROM `forum_f` WHERE `adm` = '1'");
	
	while ($adm_f = dbassoc($q222))
	{
		$adm_add[] = "`id_forum` <> '$adm_f[id]'";
	}
	if (sizeof($adm_add) != 0)
	$adm_add2 = ' WHERE'.implode(' AND ', $adm_add);
}


$k_post = dbresult(dbquery("SELECT COUNT(*) FROM `forum_t`$adm_add2"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];


echo '<table class="post">';

$q = dbquery("SELECT * FROM `forum_t`$adm_add2 ORDER BY `time` DESC LIMIT $start, $set[p_str]");

// Если список пуст
if ($k_post == 0) 
{
	echo '<div class="mess">';
	echo 'Ваших тем нет в форуме';
	echo '</div>';
}



while ($them = dbassoc($q))
{
	// Определение подфорума
	$forum = dbarray(dbquery("SELECT * FROM `forum_f` WHERE `id` = '$them[id_forum]' LIMIT 1"));
	
	// Определение раздела
	$razdel = dbarray(dbquery("SELECT * FROM `forum_r` WHERE `id` = '$them[id_razdel]' LIMIT 1"));
	
	// Лесенка дивов
	if ($num == 0)
	{
		echo '<div class="nav1">';
		$num = 1;
	}
	elseif ($num == 1)
	{
		echo '<div class="nav2">';
		$num = 0;
	}
	
	// Иконка темы
	echo '<img src="/style/themes/' . $set['set_them'] . '/forum/14/them_' . $them['up'] . $them['close'] . '.png" alt="" /> ';
	
	// Ссылка на тему
	echo '<a href="/forum/' . $forum['id'] . '/' . $razdel['id'] . '/' . $them['id'] . '/">' . text($them['name']) . '</a> 
	<a href="/forum/' . $forum['id'] . '/' . $razdel['id'] . '/' . $them['id'] . '/?page=' . $pageEnd . '">
	(' . dbresult(dbquery("SELECT COUNT(*) FROM `forum_p` WHERE `id_forum` = '$forum[id]' AND `id_razdel` = '$razdel[id]' AND `id_them` = '$them[id]'"),0) . ')</a><br/>';
	
	// Подфорум и раздел
	echo '<a href="/forum/' . $forum['id'] . '/">' . text($forum['name']) . '</a> &gt; <a href="/forum/' . $forum['id'] . '/' . $razdel['id'] . '/">' . text($razdel['name']) . '</a><br />';
	
	// Автор темы
	$ank = dbassoc(dbquery("SELECT * FROM `user` WHERE `id` = $them[id_user] LIMIT 1"));
	echo 'Автор: <a href="/info.php?id=' . $ank['id'] . '">' . $ank['nick'] . '</a> (' . vremja($them['time_create']) . ')<br />';

	// Последний пост 
	$post = dbarray(dbquery("SELECT * FROM `forum_p` WHERE `id_them` = '$them[id]' AND `id_razdel` = '$razdel[id]' AND `id_forum` = '$forum[id]' ORDER BY `time` DESC LIMIT 1"));

	// Автор последнего поста
	if($post['id']) {
	$ank2 = dbassoc(dbquery("SELECT * FROM `user` WHERE `id` = $post[id_user] LIMIT 1"));
	if ($ank2['id']) echo 'Посл.: <a href="/info.php?id=' . $ank2['id'] . '">' . $ank2['nick'] . '</a> (' . vremja($post['time']) . ')<br />';
	}
	
	echo '</div>';
}

echo '</table>';

// Вывод cтраниц 
if ($k_page>1)str("?",$k_page,$page); 


// Меню возврата
echo '<div class="foot">';
echo '<img src="/style/icons/str2.gif" /> <a href="/forum/">Форум</a> | <b>Новые посты</b>';
echo '</div>';

include_once TFOOT;
?>