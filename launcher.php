<?
ini_set('max_execution_time', 180);
header('Content-Type: text/html; charset=utf-8');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
if (!defined('H')) define("H", __DIR__. "/");
//echo H;


if (!class_exists('ZipArchive')) {
 exit("У вас на хостинге не установлена библиотека ZipArchive.");
}

define("BACKUP",H."backup/");



$install = 0;
if (file_exists('sys/dat/settings_6.2.dat')) {
  $install = 1;
}


if ($install == 1) {
  include_once 'sys/inc/home.php';
  include_once 'sys/inc/start.php';
  include_once INC;
  include_once H.'sys/inc/adm_check.php';

  include_once COMPRESS;
  include_once SESS;

  include_once SETTINGS;
  include_once DB_CONNECT;
  include_once IPUA;
  include_once FNC;
  include_once USER;



}

?>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>DCMS-Social Launcher</title>
  <style>
    body {
font-family: Calibri;
      font-size: 18px;
      text-align: center;
      padding: 100px 50px 50px 50px;
      line-height: 1.8;
    }
    a{
      color: #4a5aac;
    }
  </style>
</head>
<body>
<div class="" style="border:2px; border-radius:10px; background-color: #f6f6f6; ">
<h1>DCMS-Social Launcher </br>(Установщик)</h1>
<h4><a href="https://dcms-social.ru">https://dcms-social.ru</a>
  <br> <a href="https://dcms-social.ru">https://masterbang.ru</a>
</h4>

  <div style="padding-left:150px; padding-right:150px; padding-bottom:50px; text-align:left">

<?




function getFileListAsArray(string $dir, bool $recursive = true, string $basedir = ''): array {
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

$version = 0.9;
$type = "beta";

$content = file_get_contents("https://dcms-social.ru/launcher/launcher.json");
$data = json_decode($content, TRUE);
//var_dump($data);


$updated = file_get_contents($data['stable']['url']);

$dir = "downloads";
if (!file_exists($dir)) {
  mkdir($dir, 0777, true);
}
$name = H."/downloads/".basename($data['stable']['url'])."_".time().".zip";
file_put_contents($name, $updated);

$dir2 = H."/downloads/".time()."_".$data['stable']['version']; // Например /var/www/localhost/public
if (!file_exists($dir)) {
  mkdir($dir, 0777, true);
}
$zip=new ZipArchive();
$res = $zip->open($name);
if ($res === TRUE) {
  $zip->extractTo($dir2);
  $zip->close();
  echo 'ok</br>';
} else {
  echo 'failed</br>';
}

$files_new = getFileListAsArray(H."/downloads/test/");

$backup_files = array();

foreach ($files_new as $index => $file )
{
  if(file_exists(H.$index))
    if (hash_file("md5",H.$index)!=hash_file("md5",H."/downloads/test/".$index))
    $backup_files[$index]=$file;
}
$dir3 = H."/downloads/backup";
if (!file_exists($dir3)) {
  mkdir($dir3, 0777, true);
}

//var_dump($backup_files);


$zip = new ZipArchive(); //Создаём объект для работы с ZIP-архивами
$zip->open("archive.zip", ZIPARCHIVE::CREATE); //Открываем (создаём) архив archive.zip

foreach($backup_files AS $index=> $file) {
  echo $index;
  // первый параметр - откуда взять, второй как назвать внутри архива
  $zip->addFile(H.$index,$index);


}


$zip->close(); //Завершаем работу с архивом

echo "<br>";
foreach($backup_files AS $index=> $file) {
  echo H."/downloads/test/".$index;
  // первый параметр - откуда взять, второй как назвать внутри архива
  copy(H."/downloads/test/".$index,$index);


}







echo "Текущая версия установщика: " . $version . "";
if ($version < $data['stable']['version']) echo " (<span style='color:#ff0000'>Есть более новая версия: {$data['stable']['version']} <a href='?action=update'>Обновить</a></span>)</br>";
else echo " (это актуальная версия)</br>";

if (isset($_GET['action']) && $_GET['action'] == "update") {


  // РЕЗЕРВНОЕ КОПИРОВАНИЕ



  if ($version < $data['stable']['version']) {
    echo "Скачивание</br>";
    $url = $data['stable']['url'];

    if ($updated = file_get_contents($url)) {
      file_put_contents("new.zip", $updated);


      $zip = new ZipArchive;
      $res = $zip->open('new.zip');
      if ($res === TRUE) {
        $zip->extractTo('update/');
        $zip->close();
        echo 'ok</br>';
      } else {
        echo 'failed</br>';
      }

      rename('update/launcher.php', 'launcher.php');


      $dir = 'update';
      array_map('unlink', glob("$dir/*.*"));
      rmdir($dir);

    }

  }

}

$upload = 0;
if (file_exists("sys/dat/default.ini")) {
  $upload = 1;
}

$zip = 0;
if (file_exists("social-new.zip")) {
  $zip = 1;
}


$content = file_get_contents("https://dcms-social.ru/launcher/social.json");
$data = json_decode($content, TRUE);

echo "Стабильная версия DCMS-social: " . $data['stable']['version'] . " </br/>";
if ($install == 0 && $upload == 0) echo "<a href='?action=update-stable'>Скачать</a></br>";

if (isset($data['beta']['version'])) {
  echo "Бета версия DCMS-Social: " . $data['beta']['version'] . " </br/>";
  if ($install == 0 && $upload == 0) echo "<a href='?action=update-beta'>Скачать</a></br>";
}


if (isset($_GET['action'])&&$_GET['action']=="cabinet")
{
  if ($install == 1) {
    include_once 'sys/inc/home.php';
    include_once INC;
    include_once ADM_CHECK;
    only_reg();
    user_access('adm_mysql',null,'index.php?'.SID);
    adm_check();


    echo "<a href='/'>Обновить до последней версии</a>";
  }
}



if (isset($_GET['action']) && ($_GET['action'] == "update-stable" || $_GET['action'] == "update-beta")) {
  if ($install == 0 && $upload == 0) {


    if ($_GET['action'] == "update-stable")
      $url = $data['stable']['url'];
    if ($_GET['action'] == "update-beta")
      $url = $data['beta']['url'];

    if ($updated = file_get_contents($url)) {
      file_put_contents("social-new.zip", $updated);
      echo "Скачивание</br>";

      $zip = new ZipArchive;
      $res = $zip->open('social-new.zip');
      if ($res === TRUE) {

        $dir30 = H."/downloads/";
        if (!file_exists($dir30)) {
          mkdir($dir30, 0777, true);
        }

        $zip->extractTo($dir30);


        $zip->close();
        echo 'ok</br>';
        $upload = 1;
      } else {
        echo 'failed</br>';
      }

    }
  }

}





if ($upload == 1 && $install == 0) {
  $set = parse_ini_file('sys/dat/default.ini', FALSE);


  echo "Скачанная версия: " . $set['dcms_version'] . "</br>";
  echo "Движок уже скачан. Если вы хотите загрузить другую версию, то удалите файл sys/dat/default.ini</br>




";
}


if ($upload == 1 && $install == 0) {
  echo "<h2>Движок загружен. <a href='install/'>Перейти к установке</a></h2>";
}


if ($install == 1) {
  $set = parse_ini_file('sys/dat/default.ini', FALSE);

  echo "Установленная версия: " . $set['dcms_version'] . "</br>";
  echo '<h4>Движок уже установлен. Если вы хотите установить его заново, то  удалите файл <b>sys/dat/settings_6.2.dat</b></br> </h4></br>';

if (isset($user))
{
  echo "Вы вошли под аккаунтам админа";
  }
else
{
  echo "Если вы хотите иметь возможность обновлять движок, то вйдите в админ аккаун и вернитесь на в лаунчер";


}




}


//echo getFilesSize(dirname(__FILE__));

function getFilesSize($path)
{
  $fileSize = 0;
  $dir = scandir($path);

  foreach ($dir as $file) {
    if (($file != '.') && ($file != '..'))
      if (is_dir($path . '/' . $file))
        $fileSize += getFilesSize($path . '/' . $file);
      else
        $fileSize += filesize($path . '/' . $file);
  }

  return $fileSize;
}




?>
  </div>
</div>
</body>
</html>
