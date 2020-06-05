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
 include substr($xdml,0,3*$tms).'RNA/connmysql.php';
 include substr($xdml,0,3*$tms).'RNA/linkdata.php';
 include substr($xdml,0,3*$tms).'RNA/connect.php';
 include substr($xdml,0,3*$tms).'DNA/DFT/viewofdata.php';
 include substr($xdml,0,3*$tms).'DNA/DFT/unicode.php';
 include substr($xdml,0,3*$tms).'RNA/opfile.php';
 include substr($xdml,0,3*$tms).'RNA/enunstr.php';
 
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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ANYCONTROL</title>
<meta name="description" content="any control" />
</head>
<link rel="stylesheet" type="text/css" href="/FACE/jseditor/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/FACE/jseditor/built-editor.css"/>
<link rel="stylesheet" href="/FACE/jseditor/css/asidenav.css">
<link rel="stylesheet" href="/DNA/EXF/sysbase/table1.css">
<script src="/FACE/jseditor/built-editor.min.js"></script>
<script src="/FACE/jseditor/jquery.min.js"></script>
<script src="/DNA/EXF/sysbase/sysjs.js"></script>
<script type="text/javascript" src="/FACE/jseditor/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   // 更多新闻
   function ml_close_demo() {
      $('.float-news').animate({
            left: '-450px'
       }, 300, function(){
            $('.float-open').delay(50).animate({
              left: '-2px'
            }, 300);
       });
   }
   function ml_open_demo() {
      $('.float-open').animate({
            left: '-70px'
       }, 100, function(){
            $('.float-news').delay(50).animate({
              left: '0px'
            }, 300);
       });
   }
   
   $('.float-close').click(function(){
       ml_close_demo();
       return false;
   });
   $('.open-btn').click(function(){
       ml_open_demo();
       return false;
   });
   
   setTimeout(function(){ml_close_demo()},1000);
   
});
</script>
<script>
   require(["orion/editor/edit"], function(edit) {
      edit({className: "editor"});
   });
</script>
<style type="text/css">
   * {
      padding: 0;
      margin: 0;
      font-family: "microsoft yahei";
   }
   
   ul li {
      list-style-type: none;
   }
   
   .box {
      width: 200px;
      /*border: 1px solid red;*/
   }
   
   ul {
      margin-left: 20px;
      /*border: 1px solid blue;*/
   }
   
   .menuUl li {
      margin: 10px 0;
   }
   
   .menuUl li span:hover {
      text-decoration: underline;
      cursor: pointer;
   }
   
   .menuUl li i { margin-right: 10px; top: 0px; cursor: pointer; color: #161616;          }
       .div-inline{ overflow-y:scroll;} 
</style>
<style type="text/css">
*{margin:0;padding:0;list-style-type:none;}
a,img{border:0;}
body{_background-image:url(about:blank);/*用浏览器空白页面作为背景*/_background-attachment:fixed; /* prevent screen flash in IE6 确保滚动条滚动时，元素不闪动*/ }
body{font:12px/180% Arial, Helvetica, sans-serif, "新宋体";background:#E3E4E2;}
/* float-news  display:inline;*/
.float-news,.float-open{background:#fbfbfb;border:2px solid #e1e1e1;border-left:0 none;border-top-right-radius:4px;border-bottom-right-radius:4px;box-shadow:1px 1px 2px rgba(0, 0, 0, 0.5);display:inline-block;font-size:16px;}
.float-news{height:880px;left:0px;padding:10px 15px;width:300px;z-index:100;top:20px;_margin-top:117px;}
.float-open{height:48px;left:-70px;padding:4px 4px 4px 6px;width:48px;z-index:99;top:206px;_margin-top:206px;}
.float-news,.float-open{position:fixed;*zoom:1;_position:absolute;_top:expression(eval(document.documentElement.scrollTop));}
.float-close{background:url(SOURCE/sys_control_php/images/nav-close.png) no-repeat left top;overflow:hidden;;height:48px;opacity:.6;filter:alpha(opacity=60);position:absolute;right:9px;text-indent:100%;top:10px;white-space:nowrap;width:48px;}
.open-btn{background:url(SOURCE/sys_control_php/images/ml-open-demo.png) no-repeat left top;display:block;overflow:hidden;height:48px;opacity:.6;filter:alpha(opacity=60);text-indent:100%;white-space:nowrap;width:48px;}
.float-close:hover,.open-btn:hover{opacity:1;filter:alpha(opacity=100);}
.newslist h3{color:#333;border-bottom:4px solid #F2F2F2;font-size:26px;height:54px;line-height:54px;font-family:Microsoft Yahei,simsun,arial,sans-serif;}
.newslist ul{margin-top:10px;}
.newslist li{position:relative;height:30px;line-height:30px;font-size:14px;border-bottom:1px #ccc dotted}
.newslist li a{color:#404040;}
.newslist li span{position:absolute;right:0;color:#ccc;}
.newslist li:last-child{border-bottom:0;}
</style>
<body>
<!-- class="innerUl" $('i').attr('ischek','false');$('i').removeClass('fa fa-folder-open-o');$('i').addClass('fa fa-folder-o');  $("i[class='fa fa-folder-open-o']").removeClass('fa fa-folder-open-o');$("i[class='fa fa-folder-open-o']").addClass('fa fa-folder-o')  fa fa-folder-open-o-->
<div class="float-open" id="float-open" style="left:-2px;"><a class="open-btn" onclick="$('.innerUl>ul>li>ul').hide();$('li:has(ul)>i').attr('ischek','false');$('li:has(ul)>i').removeClass('fa-folder-open-o');$('li:has(ul)>i').addClass('fa-folder-o');" href="javascript:void(0);">&gt;</a></div>
<div class="float-news" id="float-news" style="left:-450px;overflow:scroll;">
   <a class="float-close" href="javascript:void(0);">X</a>
<div align="center"><button onclick="gettbs();">表格</button>&nbsp;&nbsp;&nbsp;<button onclick="getfls();">文件</button>&nbsp;&nbsp;&nbsp;<button onclick="getfuns();">函数</button></div>
 <div class="innerUl" class="div-inline" ></div>
</div>
<div>
    <svg width="0" height="0">
        <defs>
            <filter id="goo">
                <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur"></feGaussianBlur>
                <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"></feColorMatrix>
                <feComposite in="SourceGraphic" in2="goo" operator="atop"></feComposite>
            </filter>
        </defs>
    </svg>
    <div class="aside-nav bounceInUp animated" id="aside-nav">
        <label for="" class="aside-menu" title="按住拖动">控制</label>
        <a href="javascript:void(0)" onclick="window.open('/DNA/EXF/anytiny.php?tiny=yxTn3l');" title="空间" class="menu-item menu-first">空间</a>
        <a href="javascript:void(0)" onclick="window.open('/DNA/EXF/anytiny.php?tiny=LvUOWk');" title="进程" class="menu-item menu-second">进程</a>
        <a href="javascript:void(0)" onclick="window.open('/DNA/EXF/anytiny.php?tiny=LTj0xW');" title="日志" class="menu-item menu-third">日志</a>
        <a href="javascript:void(0)" onclick="window.open('/DNA/EXF/anytiny.php?tiny=DtiI4n');" title="版本" class="menu-item menu-line menu-fourth">版本</a> 
    </div>
</div>
 <div style="height:1500px;">
<div style="float:left;width:10%;" ></div><div style="float:right;width:90%;"><iframe name="viewfile" id="viewfile" frameborder="0" src="/FACE/superui/tgls/index.html"  frameborder="0" scrolling="yes" height="auto" width="100%"></iframe></div>
 </div>
</body>
<script type="text/javascript" src="/FACE/jseditor/jquery.min.js"></script>
<script type="text/javascript" src="/FACE/jseditor/js/proTree.js" ></script>
<script type="text/javascript">
function getfls(){
sarr=ajaxhtmlpost("/DNA/EXF/anyfun.php?fid=getrootsrc","");
$(".innerUl").html('');
var arr=JSON.parse(sarr);
$(".innerUl").ProTree({
   arr: arr,
   simIcon: "fa fa-file-o",//单个标题字体图标 不传默认glyphicon-file
   mouIconOpen: "fa fa-folder-open-o",//含多个标题的打开字体图标  不传默认glyphicon-folder-open
   mouIconClose:"fa fa-folder-o",//含多个标题的关闭的字体图标  不传默认glyphicon-folder-close
   callback: function(id,name) {
           if (name.indexOf('.')!=-1){
            $('#viewfile').attr('src','/SPEC/EDITOR/editfilex.html?filename='+name);
           }else{
             $('#viewfile').attr('src','/SPEC/EDITOR/anyjsshort.php?stid=bpPOVC-pnum:30-&folder='+name+'/');
           };
   }
});
 
}
function getfuns(){
sarr=ajaxhtmlpost("/DNA/EXF/anyfun.php?fid=getfuns","");
$(".innerUl").html('');
var arr=JSON.parse(sarr);
$(".innerUl").ProTree({
   arr: arr,
   simIcon: "fa fa-file-o",//单个标题字体图标 不传默认glyphicon-file
   mouIconOpen: "fa fa-folder-open-o",//含多个标题的打开字体图标  不传默认glyphicon-folder-open
   mouIconClose:"fa fa-folder-o",//含多个标题的关闭的字体图标  不传默认glyphicon-folder-close
   callback: function(id,name) {
           if (name.indexOf(':')!=-1){
             fid=hou(name,":");
             fid=fid.replace("()","");
            $('#viewfile').attr('src','/SPEC/EDITOR/editfunx.html?funid='+fid);
             setIframeHeight(document.getElementById('viewfile'));
           };
   }
});
 
}
function gettbs(){
sarr=ajaxhtmlpost("/DNA/EXF/anyfun.php?fid=gettables","");
$(".innerUl").html('');
var arr=JSON.parse(sarr);
$(".innerUl").ProTree({
   arr: arr,
   simIcon: "fa fa-file-o",//单个标题字体图标 不传默认glyphicon-file
   mouIconOpen: "fa fa-folder-open-o",//含多个标题的打开字体图标  不传默认glyphicon-folder-open
   mouIconClose:"fa fa-folder-o",//含多个标题的关闭的字体图标  不传默认glyphicon-folder-close
   callback: function(id,name) {
           if (name.indexOf(':')==-1 && name.indexOf('.')==-1){
            //window.open('sys_editt.php?tnm='+name);
              $('#viewfile').attr('src','/SPEC/EDITOR/anyjsshort.php?datatype=html&stid=2qPIqS-sfile:anyjsshort.php-&pnum=30:'+name+'&page=1:TABLE_NAME');
             setIframeHeight(document.getElementById('viewfile'));
           };
   }
});
}
function setIframeHeight(iframe) {
if (iframe) {
var iframeWin = iframe.contentWindow || iframe.contentDocument.parentWindow;
if (iframeWin.document.body) {
iframe.height = iframeWin.document.documentElement.scrollHeight || iframeWin.document.body.scrollHeight;
}
}
};
window.onload = function () {
setIframeHeight(document.getElementById('viewfile'));
};
</script>
<script type="text/javascript" src="/FACE/jseditor/js/asidenav.js"></script>
</html>
