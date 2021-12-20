<?
ini_set('max_execution_time', 180);
header('Content-Type: text/html; charset=utf-8');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
?>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>DCMS-Social Launcher</title>
    <style>
        body {
            font-size: 20px;
            text-align: center;
            padding: 100px 0 0 0;
            line-height: 1.8;
        }
    </style>
</head>
<h1>DCMS-Social Launcher </br>(Установщик)</h1>
<h4><a href="https://dcms-social.ru">https://dcms-social.ru</a></h4>

<?
$version = 0.9;
$type = "beta";

$content=file_get_contents("https://dcms-social.ru/launcher/launcher.json");
$data=json_decode($content,true);
//var_dump($data);


echo "Текущая версия установщика: ".$version."";
if ($version<$data['stable']['version']) echo " (<span style='color:red'>Есть более новая версия: {$data['stable']['version']} <a href='?action=update'>Обновить</a></span>)</br>";
else echo " (это актуальная версия)</br>";

if (isset($_GET['action'])&&$_GET['action']=="update")
{
	if ($version<$data['stable']['version']) 
	{
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


$dir='update';
array_map('unlink', glob("$dir/*.*"));
rmdir($dir);

	}

}

}
$install = 0;
if (file_exists('sys/dat/settings_6.2.dat'))
{
$install = 1;
}



$upload = 0;
if (file_exists("sys/dat/default.ini"))

{
	$upload = 1;
}

$zip = 0;
if (file_exists("social-new.zip"))

{
	$zip= 1;
}




$content=file_get_contents("https://dcms-social.ru/launcher/social.json");
$data=json_decode($content,true);

echo "Стабильная версия DCMS-social: ".$data['stable']['version']." </br/>";
if ($install==0&&$upload==0) echo "<a href='?action=update-stable'>Скачать</a></br>";

if (isset($data['beta']['version']))
{
echo "Бета версия DCMS-Social: ".$data['beta']['version']." </br/>";
if ($install==0&&$upload==0) echo "<a href='?action=update-beta'>Скачать</a></br>";
}




if (isset($_GET['action'])&&($_GET['action']=="update-stable"||$_GET['action']=="update-beta"))
{
if($install==0&&$upload==0)
{

	
	if ($_GET['action']=="update-stable")
	$url = $data['stable']['url'];
if ($_GET['action']=="update-beta")
	$url = $data['beta']['url'];

	if ($updated = file_get_contents($url)) {
    file_put_contents("social-new.zip", $updated);
	echo "Скачивание</br>";
	
	$zip = new ZipArchive;
$res = $zip->open('social-new.zip');
if ($res === TRUE) {
  $zip->extractTo(dirname(__FILE__));
  $zip->close();
  echo 'ok</br>';
  $upload = 1;
} else {
  echo 'failed</br>';
}

	}
}

}


if ($upload==1&&$install==0)
{
	$set=parse_ini_file('sys/dat/default.ini',false);


	echo "Скачанная версия: ". $set['dcms_version']."</br>";
	echo "Движок уже скачан. Если вы хотите загрузить другую версию, то удалите файл sys/dat/default.ini</br>";
}

	




if ($upload==1&&$install==0)
{
echo "<h2>Движок загружен. <a href='install/'>Перейти к установке</a></h2>";
}




if ($install==1)
{
		$set=parse_ini_file('sys/dat/default.ini',false);

	echo "Установленная версия: ". $set['dcms_version']."</br>";
	echo '<h4>Движок уже установлен. Если вы хотите установить его заново, то  удалите файл <b>sys/dat/settings_6.2.dat</b></br> Автоматическое обновление на данный момент не поддерживается.</h4></br>';

}


//echo getFilesSize(dirname(__FILE__));

function getFilesSize($path)
{
    $fileSize = 0;
    $dir = scandir($path);

    foreach($dir as $file)
    {
        if (($file!='.') && ($file!='..'))
            if(is_dir($path . '/' . $file))
                $fileSize += getFilesSize($path.'/'.$file);
            else
                $fileSize += filesize($path . '/' . $file);
    }

    return $fileSize;
}