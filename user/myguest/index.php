<?
include_once '../../sys/inc/start.php';
include_once COMPRESS;
include_once SESS;
include_once '../../sys/inc/home.php';
include_once SETTINGS;
include_once DB_CONNECT;
include_once IPUA;
include_once FNC;
include_once USER;
only_reg();

// Очистка гостей
if (isset($_GET['truncate']))
{
	dbquery("DELETE FROM `my_guests` WHERE `id_ank` = '$user[id]'");
	$_SESSION['message'] = 'Список гостей очищен';
}

// заголовок страницы
$set['title'] = 'Гости';

include_once THEAD;

title();
aut();

echo '<div class="foot">';
echo '<img src="/style/icons/str2.gif" alt="*"> <a href="/info.php?id=' . $user['id'] . '">' . $user['nick'] . '</a> | ';
echo '<b>Гости</b>';
echo '</div>';

$k_post = dbresult(dbquery("SELECT COUNT(*) FROM `my_guests` WHERE `id_ank` = '$user[id]'"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str'] * $page - $set['p_str'];

if ($k_post == 0)
{	
	echo '<div class="mess">';		
	echo 'Вашу страничку еще не посещали';		
	echo '</div>';	
}

$q = dbquery("SELECT * FROM `my_guests` WHERE `id_ank` = '$user[id]' ORDER BY `id` DESC  LIMIT $start, $set[p_str]");

echo '<table class="post">';

while ($post = dbarray($q))
{
	$ank = get_user($post['id_user']);
	
	/*-----------зебра-----------*/ 
	if ($num == 0){
		echo '<div class="nav1">';
		$num = 1;
	}elseif ($num == 1){
		echo '<div class="nav2">';
		$num = 0;
	}
	/*---------------------------*/

	echo avatar($ank['id']) . group($ank['id']) . ' <a href="/info.php?id='.$ank['id'].'">' . $ank['nick'] . '</a> ' . medal($ank['id']) . ' ' . online($ank['id']) . ' ';
	
	if ($post['read'] == 1)
	echo ' <span class="time" style="color:red">' . vremja($post['time']) . '</span><br />';
	else 
	echo ' <span>' . vremja($post['time']) . '</span><br />';	
	
	echo '<a href="/mail.php?id=' . $ank['id'] . '"><img src="/style/icons/pochta.gif" alt="*" /> Сообщение</a> ';
	
	echo '</div>';
	
	// Помечаем пост прочитанным
	dbquery("UPDATE `my_guests` SET `read` = '0' WHERE `id` = '$post[id]' LIMIT 1");
}

echo '</table>';

if ($k_page>1)str("?",$k_page,$page);

echo '<div class="foot">';
echo '<img src="/style/icons/delete.gif" alt="*"> <a href="?truncate">Очистить список гостей</a><br />';
echo '</div>';

echo '<div class="foot">';
echo '<img src="/style/icons/str2.gif" alt="*"> <a href="/info.php?id=' . $user['id'] . '">' . $user['nick'] . '</a> | ';
echo '<b>Гости</b>';
echo '</div>';

include_once TFOOT;
?>