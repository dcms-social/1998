<?
$k_p = dbresult(dbquery("SELECT COUNT(*) FROM `gallery_foto`",$db), 0);
$k_n = dbresult(dbquery("SELECT COUNT(*) FROM `gallery_foto` WHERE `time` > '".$ftime."'",$db), 0);

if ($k_n == 0)$k_n = NULL;
else $k_n = '+' . $k_n;
echo '(' . $k_p . ') <font color="red">' . $k_n . '</font>';
?>