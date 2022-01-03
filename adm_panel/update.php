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


//user_access('adm_mysql', NULL, 'index.php?' . SID);


adm_check();

//user_access('adm_set_sys', NULL, 'index.php?' . SID);
$temp_set = $set;

$set['title'] = 'Обновление движка';


include_once THEAD;


title();


err();


aut();


if (isset($_POST['update'])) {


  if (function_exists("disk_free_space")) {
    if (disk_free_space("/") < 1048576) exit("Для системы обновления нужно 20 мб свободного места");
  }


  $content = file_get_contents("https://dcms-social.ru/launcher/social.json");
  $data = json_decode($content, TRUE);

  $temp_set['dcms_version'] = $data['stable']['version'];
  $downloads = H . "update/";
  if (!file_exists($downloads)) {
    mkdir($downloads, 0777, TRUE);
  }
  if (!file_exists($downloads . ".htaccess")) {
    $f = fopen($downloads . ".htaccess", "a+");
    fwrite($f, "Options All -Indexes
deny from all");
    fclose($f);
  }

  $url = $data['stable']['url'];;
  $version = $data['stable']['version'];

  // Скачивание
  if ($updated = file_get_contents($url)) {

    $nf = $data['stable']['version'] . ".social-new.zip";
    file_put_contents($downloads . $nf, $updated);
    //  echo "Скачивание</br>";


    $zip = new ZipArchive;
    $res = $zip->open($downloads . $nf);
    if ($res === TRUE) {

      $dir30 = $downloads . $version . "_" . time() . "/";
      if (!file_exists($dir30)) {
        mkdir($dir30, 0777, TRUE);
      }


      $zip->extractTo($dir30);


      $zip->close();


      //  echo "Установка</br>";


      $files_new = getFileListAsArray($dir30);

      $newpatch = H . "tester3/";
      if (!file_exists($newpatch)) {
        mkdir($newpatch, 0755, TRUE);
      }

      foreach ($files_new as $index => $file) {
        if (!file_exists(dirname($newpatch . $index))) mkdir(dirname($newpatch . $index), 0755, TRUE);

        copy($dir30 . $index, $newpatch . $index);
      }


      if (save_settings($temp_set)) {
        admin_log('Настройки', 'Система', 'Обновление системы');
        msg('Система обновлена');
      }
    }
  }

}


$content = file_get_contents("https://dcms-social.ru/launcher/social.json");
$data = json_decode($content, TRUE);

echo "	<div class='mess'> <font color='green'>Установленная версия: " . $set['dcms_version'] . " </font>		</div>	";
echo "	<div class='mess'> <font color='green'>Актуальная версия: " . $data['stable']['version'] . " </font>		</div>	";


if ($data['stable']['version'] <= $set['dcms_version'])
  echo "<div class='mess'> У вас последняя актуальная версия. Вы можете проверить наличие новой версии вручную на официальном сайте движка  <a target='_blank' href='https://dcms-social.ru'>DCMS-Social.ru</a></div>";
else {
  echo "<div class='mess'>Есть новая версия! Требуется обновление. Вся информация о новом релизе на официальном сайте <a target='_blank' href='https://dcms-social.ru'>DCMS-Social.ru</a> </div>";
  echo "<div class='mess'> <h4 style='color: red'>Внимание! При обновлении все вручную внесенные изменения в оригинальные файлы движка вне папки  /replace/ будут потеряны. Сделайте резервные копии!</h4>  </div>";

  echo "<form method='post' >";
  echo "<input type='submit' name='update' value='Обновить!' />";
  echo "</form>";
}

if (user_access('adm_panel_show')) {
  echo "<div class='foot'>\n";
  echo "&laquo;<a href='/adm_panel/'>В админку</a><br />\n";
  echo "</div>\n";
}


include_once TFOOT;

function getFileListAsArray(string $dir, bool $recursive = TRUE, string $basedir = ''): array
{
  if ($dir == '') {
    return array();
  } else {
    $results = array();
    $subresults = array();
  }
  if (!is_dir($dir)) {
    $dir = dirname($dir);
  } // so a files path can be sent
  if ($basedir == '') {
    $basedir = realpath($dir) . DIRECTORY_SEPARATOR;
  }

  $files = scandir($dir);
  foreach ($files as $key => $value) {
    if (($value != '.') && ($value != '..')) {
      $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
      if (is_dir($path)) { // do not combine with the next line or..
        if ($recursive) { // ..non-recursive list will include subdirs
          $subdirresults = getFileListAsArray($path, $recursive, $basedir);
          $results = array_merge($results, $subdirresults);
        }
      } else { // strip basedir and add to subarray to separate file list
        $subresults[str_replace($basedir, '', $path)] = $value;
      }
    }
  }
  // merge the subarray to give the list of files then subdirectory files
  if (count($subresults) > 0) {
    $results = array_merge($subresults, $results);
  }
  return $results;
}