<?

	// SimbaSocialNetwork

	// http://mydcms.ru

	// Искатель

	

include_once 'sys/inc/start.php';

include_once COMPRESS;

include_once SESS;

include_once 'sys/inc/home.php';

include_once SETTINGS;

include_once DB_CONNECT;

include_once IPUA;

include_once FNC;

include_once USER;



only_reg();

$set['title']='Мой аватар';

include_once THEAD;

title();



err();

aut();

	

	

	echo "<div class='main'>";

	echo avatar($ank['id'], true, 128, false);

	echo "</div>";

	echo "<div class='main'>";

	echo "Для того что бы установить аватар на соей страничке, загрузите фото в свой фотоальбом, и нажмите ссылку \"Сделать главной\"";

	echo "</div>";

	

	

	//--------------------------фотоальбомы-----------------------------//

	echo "<div class='main'>";echo "<img src='/style/icons/foto.png' alt='*' /> ";

	echo "<a href='/foto/$user[id]/'>Фотографии</a> ";

	echo "(" . dbresult(dbquery("SELECT COUNT(*) FROM `gallery_foto` WHERE `id_user` = '$user[id]'"),0) . ")";

	echo "</div>";

	

	

	//------------------------------------------------------------------// 



include_once TFOOT;

?>