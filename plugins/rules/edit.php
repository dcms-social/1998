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
$set['title']='Редактирование';
include_once THEAD;

$post['name_url'] = null;
$post['url'] = null;
$post['title'] = null;
$post['msg'] = null;

if (isset($user) && $user['level'] < 3)
header("Location: /");

title();
aut();

// Редактирование поста

if (isset($_GET['act']) && $_GET['act'] == 'edit')
{
	if (isset($_GET['id']) && dbresult(dbquery("SELECT COUNT(*) FROM `rules_p` WHERE `id` = '".intval($_GET['id'])."'"),0)==1)
	{	$post=dbassoc(dbquery("SELECT * FROM `rules_p` WHERE `id` = '".intval($_GET['id'])."' LIMIT 1"));
		$ank=dbassoc(dbquery("SELECT * FROM `user` WHERE `id` = $post[id_user] LIMIT 1"));
		if (isset($_POST['change']) && isset($_GET['id']) && isset($_POST['name']) && $_POST['name']!=NULL)
		{
			$id = intval($_GET['id']);
			$msg = my_esc($_POST['name']);
					
			dbquery("UPDATE `rules_p` SET `msg` = '$msg' WHERE `id` = '$id' LIMIT 1");				
			$_SESSION['message'] = 'Пункт меню успешно изменен';
			header("Location: post.php?id=$post[id_news]");
			exit;
		}
	}

	if (isset($_GET['id']) && isset($_GET['act']) && $_GET['act'] == 'edit')
	{	
		echo '<form action="?id=' . $post['id'] . '&amp;act=edit" method="post">';	
		echo 'Редактирование поста:<br />';
		echo '<textarea name="name">' . text($post['msg']) . '</textarea><br />';	
		echo '<input class="submit" name="change" type="submit" value="Изменить" /><br />';
		echo '</form>';
	}
}
// Редактирование пункта

if (isset($_GET['act']) && $_GET['act'] == 'edits')
{
	if (isset($_GET['id']) && dbresult(dbquery("SELECT COUNT(*) FROM `rules` WHERE `id` = '".intval($_GET['id'])."'"),0)==1)
	{
		$post = dbassoc(dbquery("SELECT * FROM `rules` WHERE `id` = '".intval($_GET['id'])."' LIMIT 1"));
		$ank = dbassoc(dbquery("SELECT * FROM `user` WHERE `id` = $post[id_user] LIMIT 1"));
		
		if (isset($_POST['change']) && isset($_GET['id']))
		{
			$id=intval($_GET['id']);
			$name=my_esc($_POST['msg']);
			$url=esc($_POST['url'],1);
			$name_url=esc($_POST['name_url'],1);
			$title=esc($_POST['title'],1);
			dbquery("UPDATE `rules` SET `msg` = '$name' WHERE `id` = '$id' LIMIT 1");
			dbquery("UPDATE `rules` SET `title` = '$title' WHERE `id` = '$id' LIMIT 1");
			dbquery("UPDATE `rules` SET `url` = '$url' WHERE `id` = '$id' LIMIT 1");
			dbquery("UPDATE `rules` SET `name_url` = '$name_url' WHERE `id` = '$id' LIMIT 1");
			$_SESSION['message'] = 'Пункт меню успешно изменен';
			header("Location: index.php");
			exit;
		}
	}

	if (isset($_GET['id']) && $_GET['id'] == $post['id'] && isset($_GET['act']) && $_GET['act']=='edits')
	{	
		echo '<form action="?id=' . $post['id'] . '&amp;act=edits" method="post">';	
		echo 'Название ссылки:<br /><input name="name_url" size="16" value="' . text($post['name_url']) . '" type="text" /><br />';
		echo 'Адрес ссылки:<br /><input name="url" size="16" value="' . text($post['url']) . '" type="text" /><br />';	
		echo 'Название пункта:<br /><input name="title" size="16" value="' . text($post['title']) . '" type="text" /><br />';	
		echo 'Редактирование текста:<br />';
		echo '<textarea name="msg">' . text($post['msg']) . '</textarea><br />';	
		echo '<input class="submit" name="change" type="submit" value="Изменить" /><br />';
		echo '</form>';
	}
}
echo '<div class="foot"><img src="/style/icons/str2.gif" alt="*"/> <a href="index.php">Информация</a></div>';
include_once TFOOT;
?>