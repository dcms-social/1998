<?php

$file2 = $_GET['file'];


if ($_SERVER['REQUEST_URI']=="/") $index = "/index.php"; else $index="";
$replace = $_SERVER['DOCUMENT_ROOT']."/replace/".$file2;
if (file_exists($replace))
{


  ob_start();
  require_once (check_replace($replace));
  $str_sidebar = ob_get_clean();
  $body = (str_replace("../", $_SERVER['DOCUMENT_ROOT'].'/', $str_sidebar));
  echo $body;

}

