<?


include_once 'sys/inc/start.php';


include_once COMPRESS;


include_once SESS;


include_once 'sys/inc/home.php';


include_once SETTINGS;


include_once DB_CONNECT;


include_once IPUA;


include_once FNC;


$banpage = TRUE;


include_once USER;


only_reg();


$set['title'] = 'БАН';


include_once THEAD;


title();


err();


aut();


if (!isset($user)) {
  header("Location: /index.php?" . SID);
  exit;
}


if (dbresult(dbquery("SELECT COUNT(*) FROM `ban` WHERE `id_user` = '$user[id]' AND (`time` > '$time' OR `view` = '0')"), 0) == 0) {


  header('Location: /index.php?' . SID);
  exit;


}


dbquery("UPDATE `ban` SET `view` = '1' WHERE `id_user` = '$user[id]'"); // увидел причину бана


$k_post = dbresult(dbquery("SELECT COUNT(*) FROM `ban` WHERE `id_user` = '$user[id]'"), 0);


$k_page = k_page($k_post, $set['p_str']);


$page = page($k_page);


$start = $set['p_str'] * $page - $set['p_str'];


echo "<table class='post'>\n";


$q = dbquery("SELECT * FROM `ban` WHERE `id_user` = '$user[id]' ORDER BY `time` DESC LIMIT $start, $set[p_str]");


while ($post = dbassoc($q)) {


  $ank = get_user($post['id_ban']);


  /*-----------зебра-----------*/
  if ($num == 0) {
    echo "  <div class='nav1'>\n";
    $num = 1;
  } elseif ($num == 1) {
    echo "  <div class='nav2'>\n";
    $num = 0;
  }/*---------------------------*/


  echo "Бан выдал" . ($ank['pol'] == 0 ? "а" : "") . " $ank[nick]: ";


  if ($post['navsegda'] == 1) {
    echo " бан <font color=red><b>навсегда</b></font><br />";
  } else {
    echo " до " . vremja($post['time']) . "<br />";
  }


  echo '<b>Причина:</b> ' . $pBan[$post['pochemu']] . '<br />';
  echo '<b>Раздел:</b> ' . $rBan[$post['razdel']] . '<br />';
  echo '<b>Комментарий:</b> ' . esc(trim(br(bbcode(smiles(links(stripcslashes(htmlspecialchars($post['prich'])))))))) . "<br />\n";
  if ($post['time'] > $time) echo "<font color=red><b>Активен</b></font><br />\n";


  echo "   </div>\n";


}


echo "</table>\n";


if ($k_page > 1) str('?', $k_page, $page); // Вывод страниц


echo "Чтобы больше не возникало подобных ситуаций, рекомендуем Вам изучить <a href=\"/rules.php\">правила</a> нашего сайта<br />\n";


include_once TFOOT;
