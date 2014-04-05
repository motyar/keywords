<?php                                                                                                            
$query = $_GET['keyword'];
function object2array($object){
    $return = NULL;
 
    if(is_array($object))
    {
        foreach($object as $key => $value)
            $return[$key] = object2array($value);
    }
    else
    {
        $var = @get_object_vars($object);
 
        if($var)
        {
            foreach($var as $key => $value)
                $return[$key] = ($key && !$value) ? NULL : object2array($value);
        }
        else return $object;
    }
 
    return $return;
}

function getList($keyword){
    $list = range('a', 'z');
    array_push($list,"");
    foreach ($list as $letter) {
        if($letter!=''){
            $keywordToUse = $keyword."+".$letter;
        }else{
            $keywordToUse = $keyword;
            $cnt.='<li><a href="?keyword='.str_replace(" ","+",$keyword).'" >'.urldecode(ucfirst(trim($keyword))).'</a></li>';
        }                                                                                                            
        $url = "http://www.google.com/complete/search?output=toolbar&q=".trim($keywordToUse);
        $contents.='';
        $completeS = object2array(simplexml_load_string(utf8_encode(file_get_contents($url))));
        $sugs = $completeS['CompleteSuggestion'];
        if(is_array($sugs) && !empty($sugs)){
            $i=1;
            foreach($sugs as $sug){
                $kwd = $sug['suggestion']['@attributes']['data'];
                if($kwd!=''){
                    $cnt.='<li><a href="/keyword/'.str_replace(" ","+",$kwd).'" >'.ucfirst(trim($kwd)).'</a></li>'; 
 }
            
        $url = "http://www.google.com/complete/search?output=toolbar&q=".trim($keywordToUse);
        $contents.='';
        $completeS = object2array(simplexml_load_string(utf8_encode(file_get_contents($url))));
        $sugs = $completeS['CompleteSuggestion'];
        if(is_array($sugs) && !empty($sugs)){
            $i=1;
            foreach($sugs as $sug){
                $kwd = $sug['suggestion']['@attributes']['data'];                                                                if($kwd!=''){ 
                    $cnt.='<li><a href="/keyword/'.str_replace(" ","+",$kwd).'" >'.ucfirst(trim($kwd)).'</a></li>'; 
                    $i++;
                }   
            }
        }           
    }               
    return $cnt;
}           
        
   ?>
<!DOCTYPE html>
<html>
<head>                                                                                                           
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Best long tail keyword generator</title>
<body>
    <div style="text-align:left;width:50%; margin:0 auto;">
    <h1>Best long tail keyword generator</h1>
    <h2><a href="mailto:dharmmotyar@gmail.com">Need source code of this app? ask me</a></h2>
    <script>
    function setURL(){
        window.location.href='?keyword='+(document.getElementById('keyword').value).replace(/ /g, '+');
    };
    </script>
    <input name="keyword" id="keyword" onkeyup="if(event.keyCode==13){ setURL();};" placeholder="Enter Keyword here"/>
    <button onclick="setURL();">Fetch</button>
    <?php
    $keyword = $query[0];
     
    if($keyword!=''){
        ?>
        <br /><span>All possible long tail keywords for <b><?=urldecode($keyword)?></b> are:-</span>
     
        <?php
     
    }
    echo getList($keyword);
?>   
</body>                                                                                                          </html>