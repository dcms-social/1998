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





include_once THEAD;








$post=dbassoc(dbquery("SELECT * FROM `rules` WHERE `id` = '".intval($_GET['id'])."' LIMIT 1"));


$set['title'] = htmlspecialchars($post['title']);





title();


aut(); // форма авторизации





$k_post=dbresult(dbquery("SELECT COUNT(*) FROM `rules`"),0);





if (!isset($_GET['id']) && !is_numeric($_GET['id']));


if ($user['level'] > 2){


	


	if (isset($_POST['msg']) && isset($user))


	{


		$msg=$_POST['msg'];








		if (strlen2($msg)>99999){$err='Сообщение слишком длинное';}


		elseif (strlen2($msg)<2){$err='Короткое сообщение';}


		elseif (dbresult(dbquery("SELECT COUNT(*) FROM `rules_p` WHERE `id_news` = '".intval($_GET['id'])."' AND `id_user` = '$user[id]' AND `msg` = '".my_esc($msg)."' LIMIT 1"),0)!=0){$err='Ваше сообщение повторяет предыдущее';}


		elseif(!isset($err)){


			$pos=dbresult(dbquery("SELECT MAX(`pos`) FROM `rules_p` WHERE `id_news` = '".intval($_GET['id'])."'"), 0)+1;


			dbquery("INSERT INTO `rules_p` (`pos`, `id_user`, `time`, `msg`, `id_news`) values('$pos', '$user[id]', '$time', '".my_esc($msg)."', '".intval($_GET['id'])."')");


			$_SESSION['message'] = 'Ваш пост успешно принят';


			header("Location: ?id=$post[id]");


			exit;


		}


	}





	if (isset($_GET['ids']))$menu=dbassoc(dbquery("SELECT * FROM `rules_p` WHERE `id` = '".intval($_GET['ids'])."' LIMIT 1"));


	


	if (isset($_GET['ids']) && isset($_GET['act']) && $_GET['act']=='up')


	{


		dbquery("UPDATE `rules_p` SET `pos` = '".($menu['pos'])."' WHERE `pos` = '".($menu['pos']-1)."' LIMIT 1");


		dbquery("UPDATE `rules_p` SET `pos` = '".($menu['pos']-1)."' WHERE `id` = '".intval($_GET['ids'])."' LIMIT 1");





		$_SESSION['message'] = 'Пункт меню сдвинут на позицию вверх';


		header("Location: ?id=$post[id]");


		exit;





	}


	if (isset($_GET['ids']) && isset($_GET['act']) && $_GET['act']=='down')


	{


		dbquery("UPDATE `rules_p` SET `pos` = '".($menu['pos'])."' WHERE `pos` = '".($menu['pos']+1)."' LIMIT 1");


		dbquery("UPDATE `rules_p` SET `pos` = '".($menu['pos']+1)."' WHERE `id` = '".intval($_GET['ids'])."' LIMIT 1");





		$_SESSION['message'] = 'Пункт меню сдвинут на позицию вниз';


		header("Location: ?id=$post[id]");


		exit;


	}





}








$k_post=dbresult(dbquery("SELECT COUNT(*) FROM `rules_p` WHERE `id_news` = '".intval($_GET['id'])."'"),0);





$q=dbquery("SELECT * FROM `rules_p` WHERE `id_news` = '".intval($_GET['id'])."' ORDER BY `pos` ASC");


echo "<table class='post'>\n";


while ($post2 = dbassoc($q))


{


	$ank=get_user($post2['id_user']);


	


		/*-----------зебра-----------*/


		if ($num==0)


		{echo '<div class="nav1">';


		$num=1;


		}elseif ($num==1)


		{echo '<div class="nav2">';


		$num=0;}


		/*---------------------------*/





	echo (($user['level'] > 2)? $post2['pos'] . ") ":"");


		echo output_text($post2['msg']) . '</br>';





	if ($user['level'] > 2)


	{


				echo '<a href="?ids=' . $post2['id'] . '&amp;id=' . $post['id'] . '&amp;act=up&amp;' . $passgen . '"><img src="/style/icons/up.gif" alt="*" /></a> | ';


				echo '<a href="?ids=' . $post2['id'] . '&amp;id=' . $post['id'] . '&amp;act=down&amp;' . $passgen . '"><img src="/style/icons/down.gif" alt="*" /></a> | ';


				echo '<a href="edit.php?id=' . $post2['id'] . '&amp;act=edit&amp;' . $passgen . '"><img src="/style/icons/edit.gif" alt="*" /></a> | ';


				echo '<a href="delete.php?del=' . $post2['id'] . '"><img src="/style/icons/delete.gif" alt="*" /></a>';


	}





	echo '</div>';


}


echo '</table>';








if ($user['level'] > 2)


{


	if(isset($_GET['new']))


	{


		echo '<form method="post" name="message" action="?id='.intval($_GET['id']) . '">';


		if ($set['web'] && test_file(H.'style/themes/'.$set['set_them'].'/altername_post_form.php'))


		include_once H.'style/themes/'.$set['set_them'].'/altername_post_form.php';


		else


		echo '<textarea name="msg"></textarea><br />';


		echo '<input value="Добавить" type="submit" />';


		echo '</form>';


	}





	echo '<div class="foot"><img src="/style/icons/ok.gif" alt="*"/> <a href="post.php?id=' . intval($_GET['id']) . '&new">Новый пост</a></div>';


}


echo '<div class="foot"><img src="/style/icons/str2.gif" alt="*"/> <a href="index.php">Информация</a></div>';





include_once TFOOT;


?>


