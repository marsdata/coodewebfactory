<?php
 header('Content-Type:text/html;charset=utf-8');
 $gml=str_replace("\\","/",$_SERVER['DOCUMENT_ROOT'])."/";
 if (strpos($gml,":")>0){
  $qdq=xqian($gml,":");
  $gml=strtoupper($qdq).":".xhou($gml,":");
}
$tmpdqml=str_replace("\\","/",dirname(__FILE__));
 if (strpos($tmpdqml,":")>0){
  $qdqx=xqian($tmpdqml,":");
  $tmpdqml=strtoupper($qdqx).":".xhou($tmpdqml,":");
}
 $pathx=str_replace($gml,"",$tmpdqml)."/";
 $xdml="../../../../../../../../";
 $tms=0;
 for ($c=0;$c<strlen($pathx);$c++){
   if (substr($pathx,$c,1)=="/"){
    $tms=$tms+1;
   };
 }
 error_reporting(0);
 register_shutdown_function('zyfshutdownfunc'); 
 set_error_handler('zyferror');
include substr($xdml,0,3*$tms).'RNA/EARTH.php';
 
//先CURL 获取源代码,从源代码中获取JS文件和CSS文件,写入目录 FACE/markid/js/js.js,markid1.js;   FACE/markid/css/markid1.css
//获取script 区函数;获取style 区样式表;放入变量,放入input [data]区
echo anyfunrun("downhtml",_get("appid"),"","");
function xqian($fullstr,$astr){
//完美兼容中文混合
$cunzaibu=strpos("x".$fullstr,$astr);
if ($cunzaibu>0){
 $astrlen=strpos($fullstr,$astr);
 $fmrt=substr($fullstr,0,$astrlen);
  return $fmrt;
 }else{
  return $fullstr;
 }
}
function xhou($fullstr,$astr){
//完美兼容中文混合
$cunzaibu=strpos("x".$fullstr,$astr);
if ($cunzaibu>0){
  $spos=strpos($fullstr,$astr);
  $lens=strlen($astr);
  $alll=strlen($fullstr);
  return substr($fullstr,($spos+$lens),($alll-($spos+$lens)));
 }else{
  return $fullstr;
 };
}
?>
