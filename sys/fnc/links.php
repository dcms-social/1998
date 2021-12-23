<?

function getimgsize($url)
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1667.0 Safari/537.36');
  $img = curl_exec($ch);
  curl_close($ch);

  $tmpfile = tempnam('/tmp', '__myprefix__');
  file_put_contents($tmpfile, $img);

  $info = @getimagesize($tmpfile);
  unlink($tmpfile);

  return $info;
}

function img_preg($arr)
{

  if (preg_match('#^https://' . preg_quote($_SERVER['HTTP_HOST']) . '#',$arr[1]) || !preg_match('#://#',$arr[1]))
  {
    if (preg_match('/\.(?:jp(?:e?g|e|2)|gif|png|tiff?|bmp|ico)$/i', $arr[1])) {

      if (true) {
        return '<a href="https://' . $_SERVER['HTTP_HOST'] . '/go.php?go=' . base64_encode(html_entity_decode($arr[1])) . '"><img  decoding=async  style="max-width:240px; max-height:320px;" src="http://' . $_SERVER['HTTP_HOST'] . '/go.php?go=' . base64_encode(html_entity_decode($arr[1])) . '" alt="img" /></a>';
      } else {
        return '<img style="max-width:240px;" src="/style/no_image.png" alt="No Image" />';
      }
    }
  }
  else
  {
    return '<a href="https://' . $_SERVER['HTTP_HOST'] . '/go.php?go='.base64_encode(html_entity_decode($arr[1])) . '">Ссылка на изображение</a>';

  }




}

function links_preg1($arr)
{
	global $set;

	if (preg_match('#^https://' . preg_quote($_SERVER['HTTP_HOST']) . '#',$arr[1]) || !preg_match('#://#',$arr[1]))
	return '<a href="' . $arr[1] . '">' . $arr[2] . '</a>';
	else
	return '<a' . ($set['web'] ? ' target="_blank"' : null) . ' href="http://' . $_SERVER['HTTP_HOST'] . '/go.php?go=' . base64_encode(html_entity_decode($arr[1])) . '">' . $arr[2] . '</a>';

}

function links_preg2($arr)
{
	global $set;
	if (preg_match('#^https://' . preg_quote($_SERVER['HTTP_HOST']) . '#',$arr[2]))
	return $arr[1] . '<a href="' . $arr[2] . '">' . $arr[2] . '</a>' . $arr[4];
	else
	return $arr[1] . '<a' . ($set['web'] ? ' target="_blank"' : null) . ' href="http://' . $_SERVER['HTTP_HOST'] . '/go.php?go=' . base64_encode(html_entity_decode($arr[2])) . '">Ссылка</a>' . $arr[4];
}

function links($msg)
{
	global $set;
  	if ($set['bb_img'])$msg = preg_replace_callback('/\[img\]((?!javascript:|data:|document.cookie).+)\[\/img\]/isU', 'img_preg', $msg);
  	if ($set['bb_url'])$msg = preg_replace_callback('/\[url=((?!javascript:|data:|document.cookie).+)\](.+)\[\/url\]/isU', 'links_preg1', $msg); 
  	if ($set['bb_http'])$msg = preg_replace_callback('~(^|\s)([a-z]+://([^ \r\n\t`\'"]+))(\s|$)~iu', 'links_preg2', $msg);
    
  	return $msg;
}
?>