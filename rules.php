<?








include_once 'sys/inc/start.php';








include_once COMPRESS;








include_once SESS;








include_once 'sys/inc/home.php';








include_once SETTINGS;








include_once DB_CONNECT;








include_once IPUA;








include_once FNC;








$banpage=true;








include_once USER;

















//only_reg();








$set['title']='Правила';








include_once THEAD;








title();








err();








aut();








if ((!isset($_SESSION['refer']) || $_SESSION['refer']==NULL)








&& isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=NULL &&








!preg_match('#info\.php#',$_SERVER['HTTP_REFERER']))








$_SESSION['refer']=str_replace('&','&amp;',preg_replace('#^http://[^/]*/#','/', $_SERVER['HTTP_REFERER']));

















if (test_file(H.'sys/add/rules.txt'))








{








$f=file(H.'sys/add/rules.txt');

















$k_page=k_page(count($f),$set['p_str']);








$page=page($k_page);








$start=$set['p_str']*($page-1);








$end=$set['p_str']*$page;








for ($i=$start;$i<$end && $i<count($f);$i++)








echo ($i+1).') '.trim(stripcslashes(htmlspecialchars($f[$i])))."<br />\n";








if ($k_page>1)str("?",$k_page,$page); // Вывод страниц








}

















if(isset($_SESSION['refer']) && $_SESSION['refer']!=NULL && otkuda($_SESSION['refer']))








{








echo "<div class=\"foot\">\n";








echo "&laquo;<a href='$_SESSION[refer]'>".otkuda($_SESSION['refer'])."</a><br />\n";








echo "</div>\n";








}



































include_once TFOOT;








?>