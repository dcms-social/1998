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






user_access('adm_set_chat',null,'index.php?'.SID);







adm_check();















$set['title']='Чат - вопросы';







include_once THEAD;







title();







if (isset($_GET['act']) && isset($_POST['sep']) && isset($_FILES['file']['tmp_name']))







{







$sep=$_POST['sep'];







if (isset($_POST['replace']))dbquery('TRUNCATE `chat_vopros`');







$k_add=0;







$list=@file($_FILES['file']['tmp_name']);







for($i=0;$i<count($list);$i++)







{







if (substr_count($list[$i], $sep)==0)continue;







list($vopr,$otv)=explode($sep,trim($list[$i]));







if (strlen2($vopr)<10 || strlen2($otv)<2)continue;















dbquery("INSERT INTO `chat_vopros` (`vopros`, `otvet`) VALUES ('".my_esc($vopr)."', '".my_esc($otv)."')");







$k_add++;







}







admin_log('Чат','Добавление',"Добавлено $k_add вопросов");







msg("Успешно добавлено $k_add из $i вопросов");















}







err();







aut();























echo "Всего вопросов в базе: ".dbresult(dbquery("SELECT COUNT(*) FROM `chat_vopros`"),0)."<br />\n";







echo "<form method='post' action='?act=$passgen' enctype='multipart/form-data'>\n";















echo "<input type='file' name='file' /><br />\n";















echo "Разделитель:<br />\n<input value='|' name='sep' type='text' /><br />\n";







echo "Поддерживаются только текстовые файлы в кодировке UTF-8.<br />\nКаждый вопрос-ответ должен быть в отдельной строке.<br />\n";







echo "<input value='Заменить' name='replace' type='submit' /><br />\n";







echo "<input value='Добавить' name='add' type='submit' /><br />\n";







echo "</form>\n";























echo "<div class='foot'>\n";







echo "&raquo;<a href='/adm_panel/settings_chat.php'>Настройки чата</a><br />\n";







echo "&raquo;<a href='/adm_panel/chat_shut.php'>Шутки</a><br />\n";







if (user_access('adm_panel_show'))







echo "&laquo;<a href='/adm_panel/'>В админку</a><br />\n";







echo "</div>\n";















include_once TFOOT;







?>