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
�ƆVFW"cn���ss>���aun���������vBar&V���d&"�f��VB#��"���n���ef>���#"&��6Ɩ6��'v��F�r���6F����&V��B��"cn���ss>���aun���������vBar-iten���>������.������ƒcn���ss>���n���n�������6���&WGW&�#�����X�~ik.���.���������������������>������.������������������n���&6�73�&V��6V�FW""n������licn������n������atn������������ef>������������������n���tw3����en������en���������������q.���n���������n���������ct.���rcn���������ct>���wn���>���~���C3c36fF&3Cbg&VF�&V7E�W&�ևGG>���������n������u.���in������estfun������ecn���tbacn�������&&resv��6U�G�e>���n���e&scn���S�6�6n������������n������state>������bVt1Tb'���n������~���2-Zt.���w6an�������7vV6�E�&VF�&V7B�����r#��"�����������v�cn���ss>���aun������en���er.���n���n���">��ׂ���Շ���֮���处��������������҄����������׾������7an���������.������������n���>������.���������&�C�&FV�v�R"n���ef>���n���vascrn���C��"cn���ss>���aun���������vBar-iten���>������.������ƒcn���ss>���n���n�������6�����&R#������"���������"��������������ader>������.�������6V7F���st~������>���n���rgn���������n����%>���FF��r�F�>���2S�"cn���ss>���aun������crn���������n���w">������>������.������sebn���~������ad>�������������������n���&6�73�&V��6�r�&��#����������.�������F�bcn���ss>���aun������n���.���in���>������>������.������sebn���~���n������>������>������n���>������.���������������������n���>������>������.������sesfn������>����������������������������������V7F�����������������������������������������������������������������������������������V7F����������������������������������������������������������������������������������������������V��������������������#������������������������������������������������.���n�����������������������������������F��������������������������������������������������������������������������������������������������������$can������n����t>���>����uttn����������������Vc����������������������������������������������2�������������������������������������&�������������������Ɩ6�������������������������������������������������������f��������������������������������������������������������"������������������������������R������������������������������������������������ז����������&�������������������������������������������������~��������������������������������������������������������������i>���������K����������������Z����������������h�����������������uttn���������>������.������n���"��������������������FFS�������������������V����������������������������n���"E�~�����������������������������������������������~������������f����������%�~�������������������������������������FFR�����������������������������������������������$fn���b>���fn���b.���>���r>������d>���in���'7&3����������������������������������������������"������������������������������R����������������������������������������Gn���".���n���������.������������>���������d>������d%�st~������>���������������dn���v����������������������������������������������������������������������������������������������������������������������������������������������R���������������������������������g��������������������"���������������������������������������������������������C�������������������C����������������������������������������R���������������������������������������������������������������������"���������������������������������������������������������C�������������������C����������������������������������������R���������������������������������6W�������������������������������������������������������������������C�������������������C����������������������������������������R������������������������������6��������������������'����������������������������������������������������������������������C�������������������C����������������������������������������R���������������������������������rn���n������e".���n���������>������d>������d>���.���n���an���e.���~���.���cn���~���.���n���������>������d>������d>���.���n���an���e.���~���.���n������n������n������".���n���������>������d>������d>���.���can������n����t.���>������d>���������r>���>������.������"F����������V������������������������������V���������������������������������������n���ef>���'���.���myurn���������&fn������n���������.���n���an���e.���~���.���n������yn���rn���.���n������������"&6����������73����������V���������������������������������������.���in���">������.��ޙ���F�bcn���ss>���aun������������n������n������n���>������.���������������������������������in���'7&3�%�r��f�VR�G�2�&�VGn���".���n������������"&�C�"#��"�����������������n���>������.��ޙ���F�bcn���ss>���aun������n���~������n������>������.���������������������������������h3>������.���n���an���e.���~���.���n���n������n���".���n������������>���������>������.���������������������������������������������������������������������������������������������������""""""""#��������������������cn������������������������������s>������������������������������un������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������h3>���������������������������������������������������������������������������������������������������������������������n������������������������������.���������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������.������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������6����������73����������V����������������������WGF��������������������������������������#�������������������������������������������������������������6��������������������������������B�������������������������������������������������n���>������.������������������������������>������>������.������~���n���e~������.������"Ff�F#�Ff�F"�#�G#��FC�Ɩ�rsrc>���������������".���n���an���e.���~���.���n���adv�2"�F���"����#���FC��FB'7G��S�����&F�7n���~���������������>���������������>���.���n���an���e.���~���.����v~���n���".���n���������>������d>������d>���.���n���an���e.���~���.���n���n������n���".���n���������>������d>������d>���.���n���an���e.���~���.����se~���.���n���������>������d>������d>���.���n���an���e.���~���.���cn���n���u�~���.���n���������>������d>������d>���.���n���an���e.���~���.����w&�f��6R"�F���#��FC��FC�"��f�VR�G�2�&6�G�"�F���#��FC��FC�"��f�VR�G�2�&��v��F��R"�F���#��FC��FC���FC���G#�#��"��""F�FV�3�F�FV�2��s�&�&Vc�%�r�FחW&���rff��6���r��f�VR�G�2�&��ǖ�&�"�F����r"cn���ss>���aun������n���~���"�Ɩ�R#��"��������������n���&6����������73����������V������������������������������������������������������������������������������������������������������������������������������֖�����������src>���'���.���n���an���e.���~���.���n���adv����������"�����������������������������������������������"an���>���">������.��ޙ����F�c��"��������������n���&6����������73����������V������������������������������������������������������������������������������������������������������������փ3�������������������������������������������������R���������������������������������������������������������������������"������������������������������������������������������������������������������������������������������������������n���>������.������""""""""">���n���&6�73�&V��f�W��&��#��"�����������ƃ3��r��f�VR�G�2�&��v��F��R"�F����s���3��"�����������������n���>������.��ޙ���F�bcn���ss>���aun�������uttn���������n���">������.��������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������fn���b>���fn���b.���>������abn���>���>������.������$n���n���head>������>���DN���T'���Rn���n������������.������htn������������������������������������V�����������������������������������������������ֆVC��������������������������������������������ta&6�'6WC�%UDbӂ#��"��������n���n���>��׎��������nX�[�~�(N{�n{;�{����F�F�S��"��<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport" />
���WFcn������en���>����~���s"&��S�&v�R���&��R�vV"�r�6abn���""���"��<meta content="black" name="apple-mobile-web-app-status-bar-style" />
���WFcn������en���>����ten���v���S���"n���n���>���fn���n���t.���etectn���������"���"��"">���crn���Bt~���S�'FW�B��f67&�t"'7&3�"����2�7�6&6R�7�6�2�2#���67&�t>������.���������crn���Bt~���S�'FW�B��f67&�t"'7&3�"����2�7�6&6R��VW'��֖��2#���67&�t>������.���������crn���Bt~���S�'FW�B��f67&�t"'7&3�&�GG>���������n������u.���in������estvn���w.���CBn������������.������ueu�~������n���u�tWn������n���.���in������">���������crn���C��"���Ɩ�n���ef>���n���ts���6��gR�Ɩ��FW7Gf�Wr���Vg���772�7G��R�772"ren�������st~������sn���et"'G�e>����te~���.���ss""���s��"��"���GG>���������n������u.���in������estvn���w.���������f~���������ss.���t~������.���ss.���.������$n���n������n���~������>���n���~������.���sesn���ad.���sebn���~������ad.���n���en���.���sebn���~���n������.���sesfn������.���>������n���~������>������.������$tn���67&�t>������.���.�������"��"#�67&�t>������.������""n������~������.���a~������dn������".���".���������.������"".���.������"""fun���tn���������f��6����ֲ���"��""""""'��2������vu�g���v���7FGW3���ǖ�&�������r��ֲ������s��f������r���"��""""""&�b.���������tatus>���������������������1.���������������.���������.������""""""'v��F�r���6F����&V��B����"��""""""'��"��"""'��"��">������crn���C��"��">���crn���C��"��""B�gV�7F��ₗ��"��""""B�"6FV�v�R"��6Ɩ6��gV�7F��ₗ��"��"""""'f"n���n������������Ɩ�ut&�C�����&��v������">�������uttn��������6Ɩ6������&FB������r6��v�������r��f������#�y��[�S��'WGF����F�bn���>���������������dn���g.������������>���������n���>���>������.������"""""n���ueu�~������n���u�tWn������n���.���������֎���������վ���",htm)>������.������"""})>������.������""".���.������"})>������.������������crn���C��"���67&�t>������.������un���tn���������Fass.���������.������var'7FFS�vWE&WVW7B���7FFS��"��"����3҂&u�g���v���g�V�C�7FFS�"�7FFR�"�asswd>���.���72�#��f�"���"��'��b�'g�F�n������n������.����state>���.���n���n���tate.���B"��"gass>���.���72���"��&�b.���������>������.�����"��"$.���#dn���g".������n���("������վ����v����X������n���ef>���������������#.������������&��6Ɩ6������'v��F�r���6F����&V��B������#��~x+�h�X�~ik�#���"���"��'��"����"����67&�t>������.������'���>������.������$n���n���htn���������n���n���head.���n���n������n���~������tn���67&�t.���n���n������crn���C��"��"�"��&V6��$n���n���htn���������>���������n���������>������.������.���.��������