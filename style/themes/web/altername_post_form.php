<script language="JavaScript" type="text/javascript">
    function tag(text1, text2) {
        if ((document.selection)) {
            document.message.msg.focus();
            document.message.document.selection.createRange().text = text1 + document.message.document.selection.createRange().text + text2;
        } else if (document.forms['message'].elements['msg'].selectionStart != undefined) {
            var element = document.forms['message'].elements['msg'];
            var str = element.value;
            var start = element.selectionStart;
            var length = element.selectionEnd - element.selectionStart;
            element.value = str.substr(0, start) + text1 + str.substr(start, length) + text2 + str.substr(start + length);
            document.forms['message'].elements['msg'].focus();
        } else
            document.message.msg.value += text1 + text2;
        document.forms['message'].elements['msg'].focus();
    }</script>
<?
echo "<table width='100%'>\n";
echo "<tr>\n";
if (!isset($msg2))
    $msg2 = NULL;
?>
<div id='comments' class='tpanel'>
    <div class='tmenu'>
        <a href='#' id='opener'>Смайлы</a>
    </div>
    <div class='tmenu'>
        <a href='/plugins/rules/bb-code.php'>Теги</a>
    </div>
</div>
<div style="margin:4px;">
    <a href="javascript:tag('[b]', '[/b]')"><img src="/style/value/b.png" alt="b" title="Жирный"/></a>
    <a href="javascript:tag('[i]', '[/i]')"><img src="/style/value/i.png" alt="i" title="Наклонный"/></a>
    <a href="javascript:tag('[u]', '[/u]')"><img src="/style/value/u.png" alt="u" title="Подчёркнутый"/></a>
    <a href="javascript:tag('&#60;?php', '?&#62;')"><img src="/style/value/cod.png" alt="cod" title="Код"/></a>
    <a href="javascript:tag('[url=]', '[/url]')"><img src="/style/value/l.png" alt="url" title="Ссылка" /></a>
    <a href="javascript:tag('[red]', '[/red]')"><img src="/style/value/re.png" alt="red" title="Красный"/></a>
    <a href="javascript:tag('[green]', '[/green]')"><img src="/style/value/gr.png" alt="green" title="Зелёный"/></a>
    <a href="javascript:tag('[blue]', '[/blue]')"><img src="/style/value/bl.png" alt="blue" title="Синий"/></a>
</div>
<textarea name="msg" 
          onselect="storeCaret(this);"
          onclick="storeCaret(this);"
          onkeyup="storeCaret(this);"><?= $otvet . $msg2 ?></textarea>
<br />
<script>    $.fx.speeds._default = 1000;
    $("#dialog").dialog({autoOpen: false, show: "blind", hide: "explode"});
    $("#opener").click(function() {
        $("#dialog").dialog("open");
        showContent2('/ajax/php/smiles.php');
        return false;
    });
</script>