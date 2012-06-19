<html><body>
各リンクをクリックしてdebugerにアクセスしてください。

<hr />

<script>
var winds = []
<?php
    $urls = $_POST['urls']."\n";

    if(isset($_FILES['urlfile'])){
        $urls .= "\n".file_get_contents($_FILES['urlfile']['tmp_name']);
    }

    $urls = str_replace("\r\n","\n",$urls);
    $url = explode("\n",$urls);
    $n=1;
    $separate = 25;
    $scriptNo = 1;
    $script = '';
    $links = array();
    foreach($url as $v){
        if(!strlen($v)) continue;

        $v2 = urlencode(trim($v));
        $windowname = $n%$separate;
        //$script .= "winds['{$windowname}'] = window.open('http://developers.facebook.com/tools/debug/og/object?q={$v2}','".$windowname."','width=200,height=200');\n";
        $script .= "winds['{$windowname}'] = window.open('http://example.com?q={$v2}','".$windowname."','width=200,height=200');\n";
        if($n%$separate == 0){
            echo 'function e'.$scriptNo.'(){'.$script.'}'."\n";
            $script = '';
            $links[] = '<a href="javascript:e'.$scriptNo.'();">その'.$scriptNo.'を開く</a>&nbsp;';
            $links[] = '<a href="javascript:closeSubwin('.$scriptNo.');">閉じる</a><br />';
            $scriptNo++;
        }

        $n++;
    }
    echo 'function e'.$scriptNo.'(){'.$script.'}'."\n";
            $links[] = '<a href="javascript:e'.$scriptNo.'();">その'.$scriptNo.'を開く</a>&nbsp;';
            $links[] = '<a href="javascript:closeSubwin('.$scriptNo.');">閉じる</a><br />';

    $script = '';
    echo 'var separate = '.$separate;
?>

function closeSubwin(number){
    var start = 0
    var end = separate
    var n = start
    while(n < end){
        if(typeof(winds[n]) == "object"){
            winds[n].close();
        }
        n++;
    }
}
</script>
<?php
    foreach($links as $link){
        echo $link;
    }

?>
<hr />
<a href="./">&lt;&lt; 戻る</a>

</body></html>