<?php
  $word = $_GET['word']; 
  $parameter = substr($word,0,2); 
  if($parameter == '-d') $word = substr($word,2);  
  $trans = youdaoDic($word);
  
  switch ($parameter) {
    case '-d':
      echo "\n";
      //翻译及音标
      $translation = $trans['translation'];
      $phonetic    = $trans['basic']['phonetic'];
      
      //输出释义
      if(count($translation) == 1)
        echo "\033[44;37;5m ".$translation[0]." \033[0m ";
      else
        foreach($translation as $item) echo $item." | ";
      
      //输出音标
      if(isset($phonetic)) 
        echo $trans['query'].' /'.$trans['basic']['phonetic'].'/ ';
      echo "\n";
      
      //解释
      echo "\n\e[1;31m基本释义:\e[0m ";
      foreach($trans['basic']['explains'] as $item) echo $item."\n";

      //网络释义
      echo "\n\e[1;32m网络释义:\e[0m\n";
      foreach($trans['web'] as $webitem){
        echo $webitem['key'].' | ';
        foreach($webitem['value'] as $item) echo $item." ";
        echo "\n";
      }
      break;
    default:
      //翻译结果
      echo $trans['translation'][0];
      break;
  }

  function youdaoDic($word){
    $keyfrom = "orchid";      //申请APIKEY时所填表的网站名称的内容
    $apikey = "1008797533";   //从有道申请的APIKEY
    
    //有道翻译-json格式
    $url_youdao = 'http://fanyi.youdao.com/fanyiapi.do?keyfrom='.$keyfrom.'&key='.$apikey.'&type=data&doctype=json&version=1.1&q='.$word;
    $jsonStyle = file_get_contents($url_youdao);
    $result = json_decode($jsonStyle,true);
    $errorCode = $result['errorCode'];
    $trans = '';
    if(isset($errorCode)){
      switch ($errorCode){
        case 0:
          $trans = $result;
          break;
        case 20:
          $trans = '要翻译的文本过长';
          break;
        case 30:
          $trans = '无法进行有效的翻译';
          break;
        case 40:
          $trans = '不支持的语言类型';
          break;
        case 50:
          $trans = '无效的key';
          break;
        default:
          $trans = '出现异常';
          break;
      }
    }
    return $trans;
  }
