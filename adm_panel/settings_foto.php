<?







include_once '../sys/inc/start.php';







include_once COMPRESS;







include_once SESS;







include_once '../sys/inc/home.php';







include_once SETTINGS;







$temp_set=$set;







include_once DB_CONNECT;







include_once IPUA;







include_once FNC;







include_once ADM_CHECK;







include_once USER;






user_access('adm_set_foto',null,'index.php?'.SID);







adm_check();







$set['title']='Настройки фотогалереи';







include_once THEAD;







title();







if (isset($_POST['save']))







{







$temp_set['max_upload_foto_x']=intval($_POST['max_upload_foto_x']);







$temp_set['max_upload_foto_y']=intval($_POST['max_upload_foto_y']);















if (save_settings($temp_set))







{







admin_log('Настройки','Фотогалерея','Изменение настроек фотогалереи');







msg('Настройки успешно приняты');







}







else







$err='Нет прав для изменения файла настроек';







}







err();







aut();































echo "<form method=\"post\" action=\"?\">\n";















echo "Ширина фото (max):<br />\n<input type='text' name='max_upload_foto_x' value='$temp_set[max_upload_foto_x]' /><br />\n";







echo "Высота фото (max):<br />\n<input type='text' name='max_upload_foto_y' value='$temp_set[max_upload_foto_y]' /><br />\n";















echo "<input value=\"Изменить\" name='save' type=\"submit\" />\n";







echo "</form>\n";















if (user_access('adm_panel_show')){







echo "<div class='foot'>\n";







echo "&laquo;<a href='/adm_panel/'>В админку</a><br />\n";







echo "</div>\n";







}







include_once TFOOT;







?>