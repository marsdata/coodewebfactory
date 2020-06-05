<?php
 header('Content-Type:text/html;charset=utf-8');
 header("Access-Control-Allow-Origin:*");
 header("Access-Control-Allow-Headers:content-type");
 header("Access-Control-Request-Method:GET,POST");
 if(strtoupper($_SERVER['REQUEST_METHOD'])== 'OPTIONS'){
  exit;
 }
 //$ptx=str_replace("\\","/",dirname(__FILE__));
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
 //error_reporting(0);
 //register_shutdown_function('zyfshutdownfunc'); 
 //set_error_handler('zyferror');
include substr($xdml,0,3*$tms).'RNA/EARTH.php';
echo anyfunrun("newusers",_get("appid"),"","");
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
