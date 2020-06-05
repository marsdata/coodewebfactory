<?php
session_start();
 header('Content-Type:text/html;charset=utf-8');
 header("Access-Control-Allow-Origin:*");
 header("Access-Control-Allow-Headers:content-type");
 header("Access-Control-Request-Method:GET,POST");
 if(strtoupper($_SERVER['REQUEST_METHOD'])== 'OPTIONS'){
  exit;
 }
  if (substr(str_replace("\\","/",$_SERVER["DOCUMENT_ROOT"]),-1)!="/"){
    $gml=str_replace("\\","/",$_SERVER["DOCUMENT_ROOT"])."/";
  }else{
    $gml=str_replace("\\","/",$_SERVER["DOCUMENT_ROOT"]);
  };
 if (strpos($gml,":")>0){
  $qdq=xqian($gml,":");
  $gml=strtoupper($qdq).":".xhou($gml,":");
 }
error_reporting(0);
register_shutdown_function('zyfshutdownfunc'); 
set_error_handler('zyferror');
 include mdir().'RNA/EARTH.php';
//if (($_COOKIE["deadline"]*1-time())<60*20){
     setcookie("uid",$_COOKIE["uid"],time()+3600,"/");
     setcookie("cid",$_COOKIE["cid"],time()+3600,"/");
     setcookie("rids",$_COOKIE["rids"],time()+3600,"/");
     setcookie("pme",$_COOKIE["pme"],time()+3600,"/");
     setcookie("gnm",$_COOKIE["gnm"],time()+3600,"/");
     setcookie("did",$_COOKIE["did"],time()+3600,"/");
     setcookie("deadline",time()+3600,time()+3600,"/");
//};
if (_cookie("uid")!=""){
  echo anyfunrun(_get("fid"),_get("appid"),"","");
}else{
  echo "Failure:relogin";
}
function mdir(){
  if (substr(str_replace("\\","/",$_SERVER["DOCUMENT_ROOT"]),-1)!="/"){
    $gml=str_replace("\\","/",$_SERVER["DOCUMENT_ROOT"])."/";
  }else{
    $gml=str_replace("\\","/",$_SERVER["DOCUMENT_ROOT"]);
  };
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
 return substr($xdml,0,3*$tms);
}
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
