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
 include substr($xdml,0,3*$tms).'DNA/DFT/connmysql.php';
 include substr($xdml,0,3*$tms).'DNA/DFT/sysfunc.php';
 include substr($xdml,0,3*$tms).'DNA/DFT/connect.php';
 include substr($xdml,0,3*$tms).'DNA/DFT/dbfun.php';
 include substr($xdml,0,3*$tms).'DNA/DFT/pubfun.php';
 include substr($xdml,0,3*$tms).'DNA/DFT/pubscript.php';
 include substr($xdml,0,3*$tms).'DNA/DFT/anyshort-fun.php';
 include substr($xdml,0,3*$tms).'DNA/DFT/anyrcv-fun.php';
 include substr($xdml,0,3*$tms).'DNA/DFT/pagejsshow-fun.php';
 include substr($xdml,0,3*$tms).'DNA/DFT/sys_enunstr.php';
 error_reporting(0);
 register_shutdown_function('zyfshutdownfunc'); 
 set_error_handler('zyferror');
//https://open.weixin.qq.com/connect/qrconnect?appid=wx0d31f11c3fdba346&redirect_uri=http://shifu.link/testfun/wechatback.php&&response_type=code&scope=snsapi_login&state=3d6be0a4035d839573b04816624a415e#wechat_redirect
//$lll=$_SERVER['HTTP_REFERER'];
$CODE=$_GET["code"];
$state=$_GET["state"];
$nstate=qian($state,"@");
if ($state==$nstate){
  $appid="wx0d31f11c3fdba346";
  $scrt="d6253345a5fa12fcdc6b193eb83767f9";
  $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$scrt."&code=".$CODE."&grant_type=authorization_code";
  //echo "code=".$CODE."<br>";
  $rtn=file_get_contents($url);
}else{
  $appid="wxa85e179a9cb1111b";
  $scrt="ec15fc7987024d66af88fb75adc2ab4e";
  $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$scrt."&code=".$CODE."&grant_type=authorization_code";
  $rtn=file_get_contents($url);
 //echo "rtn2=".$rtn;
}
//echo "state=".$state."--state2=".$nstate."--";
//echo $rtn;
$token=qian(hou($rtn,"access_token\":\""),"\"");
$openid=qian(hou($rtn,"openid\":\""),"\"");
$urlx="https://api.weixin.qq.com/sns/userinfo?access_token=".$token."&openid=".$openid;
//echo $urlx;
$uif=file_get_contents($urlx);
//echo $uif;
$finish=$_GET["finish"];
//echo $uif;
$unionid=qian(hou($uif,"unionid\":\""),"\"");
$nickname=qian(hou($uif,"nickname\":\""),"\"");
$city=qian(hou($uif,"city\":\""),"\"");
$province=qian(hou($uif,"province\":\""),"\"");
$country=qian(hou($uif,"country\":\""),"\"");
$sex=qian(hou($uif,"sex\":"),",");
if ($sex=="1"){
  $xingbie="男";
}else{
  $xingbie="女";
}
if ($finish!=""){
 $conn=mysql_connect(gl(),glu(),glp());
  $x=updatings($conn,glb(),"update app_vxloginx set status=1 where onlymark='".$finish."'","utf8");
}
$headimgurl=str_replace("\\","",qian(hou($uif,"headimgurl\":\""),"\""));
$conn=mysql_connect(gl(),glu(),glp());
$extx=updatings($conn,glb(),"select count(*) as result from app_vxloginx where vxuid='".$unionid."' and date(logintime)=date(now()) and status=0","utf8");
$sqla="vxuid,nickname,sex,country,province,city,logintime,state,finishtime,headpic,onlymark,partof,creator";
$sqlb="'".$unionid."','".$nickname."','".$xingbie."','".$country."','".$province."','".$city."',now(),'".$nstate."',now(),'".$headimgurl."','".onlymark()."','GUEST','".getip()."'";
if ($unionid!="{" and $nickname!="{"){
 $sqlx="insert into app_vxloginx(".$sqla.")values(".$sqlb.")";
  //echo $sqlx;
 $conn=mysql_connect(gl(),glu(),glp());
  if ($extx*1==0){
   $xx=updatings($conn,glb(),$sqlx,"utf8");
  }
}
//{"openid":"owWht1LpsT49IY53qEKz_LZj3t-k","nickname":"海田","sex":1,"language":"zh_CN","city":"Shenyang","province":"Liaoning","country":"CN","headimgurl":"http:\/\/thirdwx.qlogo.cn\/mmopen\/vi_32\/Q0j4TwGTfTL05AC7FuWEkwdS4IZsvmpaQXibBrz50e9rruSfTALHAU2GMuZsH5x56tyvtnKsOraf5vJO9EZUiaQQ\/132","privilege":[],"unionid":"oqbVt1TbZUkivxE2-Zt-Aw6ak_P8"}
$myurl="http://shifu.link/testfun/wechatback.php?code=".$code."&state=".$state;
 $fmtb="<div ><a href=\"https://open.weixin.qq.com/connect/qrconnect?appid=wx0d31f11c3fdba346&redirect_uri=http://shifu.link/testfun/wechatback.php&&response_type=code&scope=snsapi_login&state=oqbVt1TbZUkivxE2-Zt-Aw6ak_P8#wechat_redirect\">我要预约</a></div><table class=\"fl-table\">";
$fmtb=$fmtb."<tr><td>头像</td><td style=\"display:none;\">unionid</td><td>昵称</td><td>性别</td><td>国家</td><td>省份</td><td>城市</td><td>登录时刻</td><td>操作</td></tr>";
$conn=mysql_connect(gl(),glu(),glp());
$xs=selecteds($conn,glb(),"select headpic,vxuid,nickname,sex,country,province,city,logintime,creator,onlymark from app_vxloginx where state='".$nstate."' and status=0","utf8","");
$totxs=countresult($xs);
$seshead='<section class="aui-flexView">
     <header class="aui-navBar aui-navBar-fixed">
          <a href="#" onclick="window.location.reload()" class="aui-navBar-item">
               <i class="icon icon-return"></i>刷新
          </a>
          <div class="aui-center" onclick="location.href=\'https://open.weixin.qq.com/connect/qrconnect?appid=wx0d31f11c3fdba346&redirect_uri=http://shifu.link/testfun/wechatback.php&&response_type=code&scope=snsapi_login&state=oqbVt1TbZUkivxE2-Zt-Aw6ak_P8#wechat_redirect\'">
               <span class="aui-center-title">点击此处获取预约二维码</span>
          </div>
          <a id="denglu" href="javascript:;" class="aui-navBar-item">
               <i class="icon icon-more"></i>
          </a>
     </header>
     <section style="margin-top:10%;padding-top:10%;" class="aui-scrollView">';
$sebodyhead='          <div class="aui-chg-box">               
               <div class="aui-chg-link">';
$sebodyfoot='</div>
          </div>';
$sesfoot='     </section>
</section>';
$items="";
for ($i=0;$i<$totxs;$i++){
   $caozuobt="<button href=\"#\"  onclick=\"finishx('".anyvalue($xs,"onlymark",$i)."')\">操作完成</button>";
  if ($nstate==$unionid or $_COOKIE["vid"]==$nstate){
   $fmtb=$fmtb."<tr><td><img src=\"".anyvalue($xs,"headpic",$i)."\"></td><td  style=\"display:none;\">".anyvalue($xs,"vxuid",$i)."</td><td>".anyvalue($xs,"nickname",$i)."</td><td>".anyvalue($xs,"sex",$i)."</td><td>".anyvalue($xs,"country",$i)."</td><td>".anyvalue($xs,"province",$i)."</td><td>".anyvalue($xs,"city",$i)."</td><td>".anyvalue($xs,"logintime",$i)."</td><td>".$caozuobt."</td></tr>";
   $items=$items.'<a href="'.$myurl.'&finish='.anyvalue($xs,"onlymark",$i).'" class="aui-flex b-line">
                         <div class="aui-logo-block">
                              <img src="'.anyvalue($xs,"headpic",$i).'" alt="">
                         </div>
                         <div class="aui-flex-box">
                              <h3>'.anyvalue($xs,"nickname",$i).'</h3>
                         </div>
                    <div class="aui-flex-box">
                              <h3>'.anyvalue($xs,"logintime",$i).'</h3>
                         </div>
                         <div class="aui-button-dot">
                              '.$caozuobt.'
                         </div>
                    </a>';
  }else{
   $fmtb=$fmtb."<tr><td><img src=\"".anyvalue($xs,"headpic",$i)."\"></td><td  style=\"display:none;\">".anyvalue($xs,"vxuid",$i)."</td><td>".anyvalue($xs,"nickname",$i)."</td><td>".anyvalue($xs,"sex",$i)."</td><td>".anyvalue($xs,"country",$i)."</td><td>".anyvalue($xs,"province",$i)."</td><td>".anyvalue($xs,"city",$i)."</td><td>".anyvalue($xs,"logintime",$i)."</td><td></td></tr>";
    $items=$items.'<a  href="'.$myurl.'&finish='.anyvalue($xs,"onlymark",$i).'" class="aui-flex b-line">
                         <div class="aui-logo-block">
                              <img src="'.anyvalue($xs,"headpic",$i).'" alt="">
                         </div>
                         <div class="aui-flex-box">
                              <h3>'.anyvalue($xs,"nickname",$i).'</h3>
                         </div>
                    <div class="aui-flex-box">
                              <h3>'.anyvalue($xs,"logintime",$i).'</h3>
                         </div>
                         <div class="aui-button-dot">
                         </div>
                    </a>';
  }
}
 $fmtb=$fmtb."</table>";
  $htmlhead='<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <title>爱心理发店预约系统</title>
     <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport" />
     <meta content="yes" name="apple-mobile-web-app-capable" />
     <meta content="black" name="apple-mobile-web-app-status-bar-style" />
     <meta content="telephone=no" name="format-detection" />
     <script type="text/javascript" src="../js/sysbase/sysjs.js"></script>
<script type="text/javascript" src="../js/sysbase/jquery.min.js"></script>
<script type="text/javascript" src="http://shifu.link/testview/TCBmnJ/js/jquery.alertWindow.min.js"></script>
<link href="http://shifu.link/testview/YYufz8/css/style.css" rel="stylesheet" type="text/css" />';
  //http://shifu.link/testview/YYufz8/css/style.css
  $htmlbody="<body>".$seshead.$sebodyhead.$items.$sebodyfoot.$sesfoot."</body>";
  $tmpscript='
 
    <script>
      imgx=F("axlfdimg","");
      
        function finishx(omk){
              x=S(\'app_vxloginx.status<onlymark=\'+omk+\'>.val(1)\');
              if (x.status==\'1\'){
               window.location.reload();
              }
        }
   </script>
   <script>
    $(function(){
        $("#denglu").click(function(){
            var htm="密码:<input id=\"login\" ><button onclick=\"dl($(\'#login\').val())\">登录</button><div id=\"dlcg\"></div>";
            jQuery.alertWindow("快捷登录",htm);
        });
        
    });
</script>
<script>
function dl(pass){
  var state=GetRequest().state;
  //x=S=("app_vxloginx.vxuid<state="+state+"*passwd="+pass+">.val()");
  x=F("vxtmplogin","state="+qian(state,"@")+"&pass="+pass);
  if (x*1==1) {
   $("#dlcg").html("登录成功，<a href=\"#\" onclick=\"window.location.reload()\">请点我刷新。</a>");
  }
}
</script>
  ';
  $htmlhtml=$htmlhead.$htmlbody.$tmpscript.$htmlscript;
  
  echo $htmlhtml."</html>";
  
?>