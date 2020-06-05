$_GET=new Array();
$_COOKIE=new Array();
$_POST=new Array();
$_COOKIE["uid"]=glu();
$_COOKIE["cid"]=glc();
$_COOKIE["gid"]="";
sessionStorage.locallist=0;
sessionStorage.allct=0;
function gl(){
 return "localhost";   //本系统mysql 数据库IP 
}
function glu(){
 return localStorage.uid;   //本系统mysql 数据库用户名  
}
function glp(){
 return localStorage.pwd;  //本系统mysql 数据库密码  
}
function glc(){
 return localStorage.cid;  //本系统mysql 数据库密码  
}
function glw(){
 return document.domain+"/";   //本服务器域名  结尾要加/ 如果没有域名请用本机分配的固定IP,结尾也要加/
}
function glb(){
 return "blueprints";      //本系统mysql 数据库  
}
function  dfp(){
return "/ORG/BRAIN/images/coode.jpg";
}
function  gln(){
return "blueprints";
}
function ceil(numx){
  return Math.ceil(numx);
}
function myfirstpos(){
  return "";
}
function getip(){
  return location.href;
}
function _cookie(gcx){
  return "";  
}
function _post(gcx){
  return "";
}
function strlen(strx){
  return strx.length;
}
function tohex(strx){
  return a2hex(strx);
}
function getRandChar(n){
  return randomWord(false,n);
}
Date.prototype.format =function(format)
{
  var o = {
"y+" : this.getYear(),
"M+" : this.getMonth()+1, //month
"d+" : this.getDate(), //day
"h+" : this.getHours(), //hour
"m+" : this.getMinutes(), //minute
"s+" : this.getSeconds(), //second
"q+" : Math.floor((this.getMonth()+3)/3), //quarter
"S" : this.getMilliseconds() //millisecond
}
if(/(y+)/.test(format)) format=format.replace(RegExp.$1,(this.getFullYear()+"").substr(4- RegExp.$1.length));
  for(var k in o)if(new RegExp("("+ k +")").test(format))
  format = format.replace(RegExp.$1,RegExp.$1.length==1? o[k] :("00"+ o[k]).substr((""+ o[k]).length));
   return format;
}
function date(fmt){
  timex="";  
  switch (fmt){        
    case "Y-m-d":
    dt=new Date();
    timex = dt.format("yyyy-MM-dd");     
    break;
    case "Y-m-d H:i:s":
    dt=new Date();
    timex = dt.format("yyyy-MM-dd hh:mm:ss");     
    break;
    default:
    timex = dt.format("yyyy-MM-dd");         
   }
  return timex;
}
function atv(strx){
  //return ajaxhtmlpost("/DNA/EXF/anyfuns.php?fid=atv","strx="+mkstr(strx));
  return  "";
}
function utv(ustr){
  //return ajaxhtmlpost("/DNA/EXF/anyfuns.php?fid=utv","strx="+mkstr(strx));
  return "";
}
function onlymark(){
  return randomWord(false,6);
}
function mysql_connect(glx,glux,glpx){
  return "gl="+glx+"&uid="+glux+"&pwd="+glpx;
}
function updatings(cnx,dbs,sqlstr,lanx){
  return ajaxhtmlpost("/DNA/EXF/anyfuns.php?fid=updatings&"+cnx+"&lan="+lanx,"sql="+mkstr(sqlstr));
}
function updatingx(cnx,dbs,sqlstr,lanx){
   return ajaxhtmlpost("/DNA/EXF/anyfuns.php?fid=updatingx&"+cnx+"&lan="+lanx,"sql="+mkstr(sqlstr));
}
function selectedx(cnx,dbs,sqlstr,lanx,tpx){
   return ajaxhtmlpost("/DNA/EXF/anyfuns.php?fid=selectedx&"+cnx+"&lan="+lanx+"&type="+tpx,"sql="+mkstr(sqlstr));
}
function selecteds(cnx,dbs,sqlstr,lanx,tpx){
   return ajaxhtmlpost("/DNA/EXF/anyfuns.php?fid=selecteds&"+cnx+"&lan="+lanx+"&type="+tpx,"sql="+mkstr(sqlstr));
}
function makenextselect(tbnm,nkey,sno,prekey,qry){
  bkd=ajaxhtmlpost("/DNA/EXF/anyfuns.php?fid=makeselect&"+qry+"&prekey="+prekey+"&tabname="+tbnm+"&tabkey="+nkey+"&tabsno="+sno,"");
  $("#"+nkey+sno).html(bkd);
}
function plsc(surl,tbnm){
Notiflix.Confirm.Show( '批量删除确认','你确定要删除这些条记录吗?', '是', '否', function(){scxz(surl,tbnm);});
}
function scxz(surl,tbnm){
var fmk='';
$("input:checkbox[name='chksno']:checked").each(function(i){
var val = $(this).val();
fmk = fmk + val + ','; }
);
qajaxps('批量删除','/DNA/EXF/anyrcv.php?tbnm='+tbnm+'&kies=-killitem&SNO='+fmk,'');
}
function initdetail(){
  //?stid=zWdfMn&SNO=1&cfid=newdftstyle
  stid=GetRequest().stid;
  SNO=GetRequest().SNO;
  cfid=GetRequest().cfid;
  bodyhtml=document.body.innerHTML;
  if (stid!=undefined && stid!="" && bodyhtml.indexOf("{contentx}")>0){
    if (SNO=="" || SNO==undefined){
      SNO="0";
    }
    if (cfid=="" || cfid==undefined){
      cfid="";
    }
    bkdata=ajaxhtmlpost("/SPEC/EDITOR/anyshortnew.php?stid="+stid+"&SNO="+SNO+"&cfid="+cfid+"&tmp=data","");     
    document.body.innerHTML=bkdata;
  }else{
    return false;
  }
}
function resetkey($xid,$keyx,$sno){
 prehref=location.href;
  houhref=hou(prehref,"?");
  pthref=houhref.split("&");
  totp=pthref.length;
  if (prehref.indexOf("pnum:")>0){
   pn=qian(hou(prehref,"pnum:"),"-");
  }else{
   pn="";
  }
  fmxxx="";
  pppp="";
  tmpss="";
  for (i=0;i<totp;i++){
    if (qian(pthref[i],"=")!="page" && qian(pthref[i],"=")!="pnum"){
      if (qian(pthref[i],"=")!=""){
        eval("tmpss=sessionStorage."+qian(pthref[i],"=")+";");      
        eval("console.log(sessionStorage."+qian(pthref[i],"=")+")+\"--tmpss\";");
      }else{
        tmpss="";
      }
      if (tmpss!=undefined && tmpss!=""){
        fmxxx=fmxxx+"&"+qian(pthref[i],"=")+"="+tmpss;
       }else{
        fmxxx=fmxxx+"&"+pthref[i];
       }
    }
  }
 if (sessionStorage.pgnum=="" || sessionStorage.pgnum==undefined){
   if (pn==""){
     pgnum=GetRequest().pnum;
   }else{
     pgnum=pn;
   }
 }else{   
  pgnum=sessionStorage.pnum;
 }
 if (sessionStorage.page==""){
  pgpage=GetRequest().page;
 }else{
  pgpage=sessionStorage.page;
 }
 if  (typeof(pgnum)=="un"+"defined" || pgnum==""){
   pgnum="30";
 }
if  (typeof(pgpage)!="un"+"defined"){  
  if (pgpage.indexOf(":")>0){
    pppp="page="+pgpage+"&pnum="+pgnum;
     if (strpos(prehref,"stid=")>0){
     }else{        
        if (strpos(prehref,"/shortid")>0){
            sid=hou(qian(prehref,"/shortid/"),"/");
            pppp=pppp+"&stid="+sid;
        };        
     };
    sessionStorage.page=pgpage;
    sessionStorage.pnum=pgnum;
  }else{
    pppp="page="+pgpage+"&pnum="+pgnum;
     if (strpos(prehref,"stid=")>0){
     }else{        
        if (strpos(prehref,"/shortid")>0){
            sid=hou(qian(prehref,"/shortid/"),"/");
            pppp=pppp+"&stid="+sid;
        };        
     };
    sessionStorage.page=pgpage;
    sessionStorage.pnum=pgnum;
  }
}else{
  pppp="pnum="+pgnum+"&page=1";
     if (strpos(prehref,"stid=")>0){
     }else{        
        if (strpos(prehref,"/shortid")>0){
            sid=hou(qian(prehref,"/shortid/"),"/");
            pppp=pppp+"&stid="+sid;
        };        
     };
  sessionStorage.page="1";
  sessionStorage.pnum=pgnum;
}
  if (fmxxx.indexOf("qry=")==-1){
   if (sessionStorage.qry!=undefined && sessionStorage.qry!=""){
     fmxxx=fmxxx+"&qry="+sessionStorage.qry;
   }else{
     if (sessionStorage.xkey!=undefined && sessionStorage.xkey!="" && sessionStorage.xval!=undefined && sessionStorage.xval!=""){
       fmxxx=fmxxx+"&xkey="+sessionStorage.xkey+"&xval="+sessionStorage.xval;
     }
   }
  }else{
    //如果存在qry 则不继续探索
  } 
  purl="/SPEC/EDITOR/anyshort.php?"+pppp+fmxxx;   
  tbnm=$('table[name="tabunit"]').attr("tbname");
   if (tbnm!="" && tbnm!="un"+"defined"){
   }else{
     tbnm="";
   }
   stid=GetRequest().stid;
   sid=qian(stid,"-");   
   if ($xid=="" || $xid==undefined){
     $xid=sid;
   }
   if(pgnum.indexOf(":")>0){
      pnum=qian(pgnum,":");
   }else{
      pnum=pgnum;
   }
   if(pgpage.indexOf(":")>0){
     page=qian(pgpage,":");
   }else{
     page=pgpage;
   }
  bkxyz=ajaxhtmlpost(purl+"&datatype=table&tabkey="+$keyx+"&SNO="+$sno,"");  
  if (bkxyz!=""){
    $("#"+$keyx+$sno).html(bkxyz);       
    layrender();
    newtdlisten();   
    listenclsduo();
    newjsfile("/FACE/imginout/js/boxImg.js");
    newjsfile("/FACE/inputpm/js/num-alignment.js");
  }
 layui.use(['form'], function(){
 form=layui.form;
 form.on('select(brickType)', function(data){ 
 ocg=$(this).parent().parent().prev().attr("onchange");
  nv=$(this).attr("lay-value");
  if (typeof(ocg)!="un"+"defined" && typeof(nv)!="un"+"defined"){
   if (ocg!=""){
     ocg=ocg.replace(/<thisnewvalue>/g,nv);
     eval(ocg);
     form.render(); 
    };
   };
  });
 });   
}
function resetline($xid,$sno){
 prehref=location.href;
  houhref=hou(prehref,"?");
  pthref=houhref.split("&");
  totp=pthref.length;
  if (prehref.indexOf("pnum:")>0){
   pn=qian(hou(prehref,"pnum:"),"-");
  }else{
   pn="";
  }
  fmxxx="";
  pppp="";
  tmpss="";
  for (i=0;i<totp;i++){
    if (qian(pthref[i],"=")!="page" && qian(pthref[i],"=")!="pnum"){
      if (qian(pthref[i],"=")!=""){
        eval("tmpss=sessionStorage."+qian(pthref[i],"=")+";");      
        eval("console.log(sessionStorage."+qian(pthref[i],"=")+")+\"--tmpss\";");
      }else{
        tmpss="";
      }
      if (tmpss!=undefined && tmpss!=""){
        fmxxx=fmxxx+"&"+qian(pthref[i],"=")+"="+tmpss;
       }else{
        fmxxx=fmxxx+"&"+pthref[i];
       }
    }
  }
 if (sessionStorage.pgnum=="" || sessionStorage.pgnum==undefined){
   if (pn==""){
     pgnum=GetRequest().pnum;
   }else{
     pgnum=pn;
   }
 }else{   
  pgnum=sessionStorage.pnum;
 }
 if (sessionStorage.page==""){
  pgpage=GetRequest().page;
 }else{
  pgpage=sessionStorage.page;
 }
 if  (typeof(pgnum)=="un"+"defined" || pgnum==""){
   pgnum="30";
 }
if  (typeof(pgpage)!="un"+"defined"){  
  if (pgpage.indexOf(":")>0){
    pppp="page="+pgpage+"&pnum="+pgnum;
     if (strpos(prehref,"stid=")>0){
     }else{        
        if (strpos(prehref,"/shortid")>0){
            sid=hou(qian(prehref,"/shortid/"),"/");
            pppp=pppp+"&stid="+sid;
        };        
     };
    sessionStorage.page=pgpage;
    sessionStorage.pnum=pgnum;
  }else{
    pppp="page="+pgpage+"&pnum="+pgnum;
     if (strpos(prehref,"stid=")>0){
     }else{        
        if (strpos(prehref,"/shortid")>0){
            sid=hou(qian(prehref,"/shortid/"),"/");
            pppp=pppp+"&stid="+sid;
        };        
     };
    sessionStorage.page=pgpage;
    sessionStorage.pnum=pgnum;
  }
}else{
  pppp="pnum="+pgnum+"&page=1";
     if (strpos(prehref,"stid=")>0){
     }else{        
        if (strpos(prehref,"/shortid")>0){
            sid=hou(qian(prehref,"/shortid/"),"/");
            pppp=pppp+"&stid="+sid;
        };        
     };
  sessionStorage.page="1";
  sessionStorage.pnum=pgnum;
}
  if (fmxxx.indexOf("qry=")==-1){
   if (sessionStorage.qry!=undefined && sessionStorage.qry!=""){
     fmxxx=fmxxx+"&qry="+sessionStorage.qry;
   }else{
     if (sessionStorage.xkey!=undefined && sessionStorage.xkey!="" && sessionStorage.xval!=undefined && sessionStorage.xval!=""){
       fmxxx=fmxxx+"&xkey="+sessionStorage.xkey+"&xval="+sessionStorage.xval;
     }
   }
  }else{
    //如果存在qry 则不继续探索
  } 
  purl="/SPEC/EDITOR/anyshort.php?"+pppp+fmxxx;   
  tbnm=$('table[name="tabunit"]').attr("tbname");
   if (tbnm!="" && tbnm!="un"+"defined"){
   }else{
     tbnm="";
   }
   stid=GetRequest().stid;
   sid=qian(stid,"-");   
   if ($xid=="" || $xid==undefined){
     $xid=sid;
   }
   if(pgnum.indexOf(":")>0){
      pnum=qian(pgnum,":");
   }else{
      pnum=pgnum;
   }
   if(pgpage.indexOf(":")>0){
     page=qian(pgpage,":");
   }else{
     page=pgpage;
   }
  bkxyz=ajaxhtmlpost(purl+"&datatype=table&SNO="+$sno,"");  
  if (bkxyz!=""){
    $("#"+$xid+$sno).html(bkxyz);       
    layrender();
    newtdlisten();   
    listenclsduo();
    newjsfile("/FACE/imginout/js/boxImg.js");
    newjsfile("/FACE/inputpm/js/num-alignment.js");
  }
 layui.use(['form'], function(){
 form=layui.form;
 form.on('select(brickType)', function(data){ 
 ocg=$(this).parent().parent().prev().attr("onchange");
  nv=$(this).attr("lay-value");
  if (typeof(ocg)!="un"+"defined" && typeof(nv)!="un"+"defined"){
   if (ocg!=""){
     ocg=ocg.replace(/<thisnewvalue>/g,nv);
     eval(ocg);
     form.render(); 
    };
   };
  });
 });   
}
function tospage(pg){
  prehref=location.href;
  houhref=hou(prehref,"?");
  pthref=houhref.split("&");
  totp=pthref.length;
  if (prehref.indexOf("pnum:")>0){
   pn=qian(hou(prehref,"pnum:"),"-");
  }else{
   pn="";
  }
  fmxxx="";
  pppp="";
  tmpss="";
  for (i=0;i<totp;i++){
    if (qian(pthref[i],"=")!="page" && qian(pthref[i],"=")!="pnum"){
      if (qian(pthref[i],"=")!=""){
        eval("tmpss=sessionStorage."+qian(pthref[i],"=")+";");      
        eval("console.log(sessionStorage."+qian(pthref[i],"=")+")+\"--tmpss\";");
      }else{
        tmpss="";
      }
      if (tmpss!=undefined && tmpss!=""){
        fmxxx=fmxxx+"&"+qian(pthref[i],"=")+"="+tmpss;
       }else{
        fmxxx=fmxxx+"&"+pthref[i];
       }
    }
  }
 if (sessionStorage.pgnum=="" || sessionStorage.pgnum==undefined){
   if (pn==""){
     pgnum=GetRequest().pnum;
   }else{
     pgnum=pn;
   }
 }else{   
  pgnum=sessionStorage.pnum;
 }
 if (sessionStorage.page==""){
  pgpage=GetRequest().page;
 }else{
  pgpage=sessionStorage.page;
 }
 if  (typeof(pgnum)=="un"+"defined" || pgnum==""){
   pgnum="30";
 }
if  (typeof(pgpage)!="un"+"defined"){  
  if (pgpage.indexOf(":")>0){
    pppp="page="+pg+":"+hou(pgpage,":")+"&pnum="+pgnum;
     if (strpos(prehref,"stid=")>0){
     }else{        
        if (strpos(prehref,"/shortid")>0){
            sid=hou(qian(prehref,"/shortid/"),"/");
            pppp=pppp+"&stid="+sid;
        };        
     };
    sessionStorage.page=pg+":"+hou(pgpage,":");
    sessionStorage.pnum=pgnum;
  }else{
    pppp="page="+pg+"&pnum="+pgnum;
     if (strpos(prehref,"stid=")>0){
     }else{        
        if (strpos(prehref,"/shortid")>0){
            sid=hou(qian(prehref,"/shortid/"),"/");
            pppp=pppp+"&stid="+sid;
        };        
     };
    sessionStorage.page=pg;
    sessionStorage.pnum=pgnum;
  }
}else{
  pppp="pnum="+pgnum+"&page="+pg;
     if (strpos(prehref,"stid=")>0){
     }else{        
        if (strpos(prehref,"/shortid")>0){
            sid=hou(qian(prehref,"/shortid/"),"/");
            pppp=pppp+"&stid="+sid;
        };        
     };
  sessionStorage.page=pg;
  sessionStorage.pnum=pgnum;
}
  if (fmxxx.indexOf("qry=")==-1){
   if (sessionStorage.qry!=undefined && sessionStorage.qry!=""){
     fmxxx=fmxxx+"&qry="+sessionStorage.qry;
   }else{
     if (sessionStorage.xkey!=undefined && sessionStorage.xkey!="" && sessionStorage.xval!=undefined && sessionStorage.xval!=""){
       fmxxx=fmxxx+"&xkey="+sessionStorage.xkey+"&xval="+sessionStorage.xval;
     }
   }
  }else{
    //如果存在qry 则不继续探索
  }
 
  purl="/SPEC/EDITOR/anyshort.php?"+pppp+fmxxx;  
 if (sessionStorage.dpage==0){
  tbnm=$('table[name="tabunit"]').attr("tbname");
   if (tbnm!="" && tbnm!="un"+"defined"){
   }else{
     tbnm="";
   }
   stid=GetRequest().stid;
   sid=qian(stid,"-");   
   if(pgnum.indexOf(":")>0){
      pnum=qian(pgnum,":");
   }else{
      pnum=pgnum;
   }
   if(pgpage.indexOf(":")>0){
     page=qian(pgpage,":");
   }else{
     page=pgpage;
   }
  bkxyz=anyjson(purl,tbnm,page,sid);
  bktable=bkxyz["html"];
  if (bktable!=""){
   $("form[name='tabform']").html(bktable);    
   $("#customPages").html(pageabc(intval(bkxyz["totrcd"])/intval(pnum),intval(pg),intval(pnum),intval(bkxyz["totrcd"]),$('table[name="tabunit"]').attr("tbname")));
   //$(".layui-select").show();
    layrender();
    newtdlisten();
    eval(bkxyz["script"]);
    listenclsduo();
    newjsfile("/FACE/imginout/js/boxImg.js");
    newjsfile("/FACE/inputpm/js/num-alignment.js");
  }
 }else{
   location.href=qian(prehref,"?")+"?"+pppp+fmxxx;
 }

 layui.use(['form'], function(){
 form=layui.form;
 form.on('select(brickType)', function(data){ 
 ocg=$(this).parent().parent().prev().attr("onchange");
  nv=$(this).attr("lay-value");
  if (typeof(ocg)!="un"+"defined" && typeof(nv)!="un"+"defined"){
   if (ocg!=""){
     ocg=ocg.replace(/<thisnewvalue>/g,nv);
     eval(ocg);
     form.render(); 
    };
   };
  });
 }); 
  
}
function setpage(pgn){
  prehref=location.href;
  houhref=hou(prehref,"?");
  pthref=houhref.split("&");
  totp=pthref.length;
  fmxxx="";
  pppp="";
  stid=GetRequest().stid;
  xtid=qian(stid,"-");
  for (i=0;i<totp;i++){
    if (qian(pthref[i],"=")!="page" && qian(pthref[i],"=")!="pnum" && qian(pthref[i],"=")!="stid"){
      fmxxx=fmxxx+"&"+pthref[i];
    }
  }
 pgnum=GetRequest().pnum;
 pgpage=GetRequest().page;
if  (typeof(pgnum)!="un"+"defined"){
  if  (typeof(pgpage)!="un"+"defined"){
     if (pgnum.indexOf(":")>0){
        if (pgpage.indexOf(":")>0){
          pppp="page=1:"+hou(pgpage,":")+"&pnum="+pgn+":"+hou(pgnum,":");
        }else{
          pppp="page=1:&pnum="+pgn+":"+hou(pgnum,":");
        }
     }else{
        if (pgpage.indexOf(":")>0){
          pppp="page=1&pnum="+pgn;
        }else{
          pppp="page=1&pnum="+pgn;
        }
     }//ifpgnumindex
  }else{//pgpage==ud
     if (pgnum.indexOf(":")>0){
          pppp="page=1&pnum="+pgn;
     }else{
          pppp="page=1&pnum="+pgn;
     }
  }//undefi
}else{//
     pppp="page=1&pnum="+pgn; 
}
 if (pgn!="0"){
   location.href=qian(prehref,"?")+"?"+pppp+"&stid="+stid+fmxxx;
 }else{
   location.href=qian(prehref,"?")+"?stid="+xtid+fmxxx;
 }
}
function allsearch(xid){
  prehref=location.href;
  houhref=hou(prehref,"?");
  pthref=houhref.split("&");
  if (prehref.indexOf("pnum:")>0){
    pn=qian(hou(prehref,"pnum:"),"-");
  }else{
    pn="";
  }
  totp=pthref.length;
  fmxxx="";
  pppp="";
  for (i=0;i<totp;i++){
    if (qian(pthref[i],"=")!="page" && qian(pthref[i],"=")!="pnum" && qian(pthref[i],"=")!="xkey"  && qian(pthref[i],"=")!="xval"  && qian(pthref[i],"=")!="qry"){
      fmxxx=fmxxx+"&"+pthref[i];
    }
  }
if (sessionStorage.pnum=="" || sessionStorage.pnum==undefined){
  pgnum=GetRequest().pnum;
}else{
  if (pn==""){
    pgnum=sessionStorage.pnum;
  }else{
    pgnum=pn;
  }
}
if (sessionStorage.page=="" || sessionStorage.page==undefined){
  pgpage=GetRequest().page;
}else{
  pgpage=sessionStorage.page
}
 if  (typeof(pgpage)=="un"+"defined"){
   pgpage="";
 }
if  (typeof(pgpage)!="un"+"defined" && pgpage!=""){
  if  (typeof(pgnum)=="un"+"defined" || pgnum==""){
    pgnum="30";
  }
  if (pgpage.indexOf(":")>0){    
    pppp="page=1:"+hou(pgpage,":")+"&pnum="+pgnum+"&qry="+mkstr($("#searchkey").val());
    if (strpos(prehref,"stid=")>0){
    }else{        
        if (strpos(prehref,"/shortid")>0){
            sid=hou(qian(prehref,"/shortid/"),"/");
            pppp=pppp+"&stid="+sid;
        };        
    };
     sessionStorage.page="page=1:"+hou(pgpage,":");
     sessionStorage.pnum=pgnum;
     sessionStorage.xkey="";
     sessionStorage.xval="";
    sessionStorage.qry=mkstr($("#searchkey").val());
  }else{
     pppp="page=1&pnum="+pgnum+"&qry="+mkstr($("#searchkey").val());
     if (strpos(prehref,"stid=")>0){
     }else{        
        if (strpos(prehref,"/shortid")>0){
            sid=hou(qian(prehref,"/shortid/"),"/");
            pppp=pppp+"&stid="+sid;
        };        
     };
     sessionStorage.page=1;
     sessionStorage.pnum=pgnum;
     sessionStorage.xkey="";
     sessionStorage.xval="";
     sessionStorage.qry=mkstr($("#searchkey").val());
  }
}else{
     pppp="page=1&qry="+mkstr($("#searchkey").val());
     if (strpos(prehref,"stid=")>0){
     }else{        
        if (strpos(prehref,"/shortid")>0){
            sid=hou(qian(prehref,"/shortid/"),"/");
            pppp=pppp+"&stid="+sid;
        };        
     };
     sessionStorage.page=1;
     sessionStorage.pnum="";
     sessionStorage.xkey="";
     sessionStorage.xval="";
     sessionStorage.qry=mkstr($("#searchkey").val());
} 
 purl="/SPEC/EDITOR/anyshort.php?"+pppp+fmxxx;  
  if (sessionStorage.dpage==0){
   tbnm=$('table[name="tabunit"]').attr("tbname");
   if (tbnm!="" && tbnm!="un"+"defined"){
   }else{
     tbnm="";
   }
   stid=GetRequest().stid;
   sid=qian(stid,"-");   
   if(pgnum.indexOf(":")>0){
      pnum=qian(pgnum,":");
   }else{
      pnum=pgnum;
   }
   if(pgpage.indexOf(":")>0){
     page=qian(pgpage,":");
   }else{
     page=pgpage;
   }
  bkxyz=anyjson(purl,tbnm,page,sid);
  bktable=bkxyz["html"];
  if (bktable!=""){
   $("form[name='tabform']").html(bktable);
    
   $("#customPages").html(pageabc(intval(bkxyz["totrcd"])/intval(pnum),intval(page),intval(pnum),intval(bkxyz["totrcd"]),$('table[name="tabunit"]').attr("tbname")));
   //$(".layui-select").show();
    layrender();
    newtdlisten();
    eval(bkxyz["script"]);
    listenclsduo();
    newjsfile("/FACE/imginout/js/boxImg.js");
    newjsfile("/FACE/inputpm/js/num-alignment.js");
  }
 }else{
   location.href=qian(prehref,"?")+"?"+pppp+fmxxx;
 }
 layui.use(['form'], function(){
 form=layui.form;
 form.on('select(brickType)', function(data){ 
 ocg=$(this).parent().parent().prev().attr("onchange");
  nv=$(this).attr("lay-value");
  if (typeof(ocg)!="un"+"defined" && typeof(nv)!="un"+"defined"){
   if (ocg!=""){
     ocg=ocg.replace(/<thisnewvalue>/g,nv);
     eval(ocg);
     form.render(); 
    };
   };
  });
 }); 
}
function newtdlisten(){
  $('td').click(function (){
    var isup=$('#isupdate').prop('checked');
    var isuv=$('#isupdate').val();
  if (isup==true || (isuv*1)==1){
    var snoid=$(this).attr('snoid');
    var knmid=$(this).attr('knm');
    var tiptid=knmid+snoid;
    var tiptidx="p_"+knmid+snoid;
    var oldvl=$('#'+tiptid).html();
    var olddtvl=unquote($(this).attr('tdata'));
    var olddtvl=hhth(olddtvl);
     var iptsize=$('#'+tiptid).html().length;
     var kntp=$(this).attr('tpnm');
  atb=document.getElementsByName("anytable");
  tota=atb.length;
 allck="";
  for (m=0;m<tota;m++){
  allck=allck+$(atb[m]).attr("cantkies")+",";
  }
  var cks="xy-"+allck;
  var knmx=$(this).attr("knm");
       if (iptsize==0 || iptsize>10){iptsize=15};
      if (oldvl.indexOf('<input')<=-1 && oldvl.indexOf('<textarea')<=-1 && oldvl.indexOf('<select')<=-1 && cks.indexOf(knmx)<=-1){
        if (kntp=='text' || kntp=='longtext'){
          inhtml='<text'+'area id="'+tiptidx+'" rows=3 cols=50 >'+olddtvl+'</text'+'area>';
          $('#'+tiptid).html(inhtml);
        }else{
          inhtml= '<text'+'area id="'+tiptidx+'" rows=2 cols=33 >'+olddtvl+'</text'+'area>';
          $('#'+tiptid).html(inhtml);
       };
   };
   showsc();
  }else{
  };
 }
);
  return true;
}
function uniturl(ourl){
  prehref=location.href;
  houhref=hou(prehref,"?");
  pthref=houhref.split("&");
  totp=pthref.length;
  fmxxx="";
  pppp="";
  for (i=0;i<totp;i++){
    pkey="";    
    pkey=qian(pthref[i],"=")+"=";
    if (ourl.indexOf(pkey)>0){      
    }else{
      fmxxx=fmxxx+"&"+pthref[i];
    }
  }
 location.href=ourl+fmxxx;
}
function upfl(sno,tb,key){
          var srcd=$("#imghead"+key+sno).attr("src");
          var x=ajaxhtmlpost('/DNA/EXF/anyfun.php?fid=anyrcvimg&tbnm='+tb+'&SNO='+sno+'&key='+key,'src='+srcd);          
           if(x=="1"){
             alert("成功");
           };
     }

//修改规格
function specificationsBut(){
layui.use('layer', function() {
var layer = layui.layer;
//iframe层-父子操作
layer.open({
type: 2,
area: ['70%', '60%'],
fixed: false, //不固定
maxmin: true,
content: 'specifications_list.html'
});
});
}
//修改按钮
var updateFrame = null;
function updateBut(){
layui.use('layer', function() {
var layer = layui.layer;
//iframe层-父子操作
updateFrame = layer.open({
                    title: "商品信息修改",
type: 2,
area: ['70%', '60%'],
scrollbar: false,//默认：true,默认允许浏览器滚动,如果设定scrollbar: false,则屏蔽
maxmin: true,
content: 'goods_update.html'
});
});
}

    function update(xyz,sno) {
     bku=F('gaddpage','stid='+xyz);
      if (bku.length>10){
        ptnhtxt=bku.split("[get-");
        totpt=ptnhtxt.length;
        for (f=1;f<totpt;f++){
          tmpok=qian(ptnhtxt[f],"]");
          eval("gvl=GetRequest()."+tmpok+";");
          bku=bku.replace("[get-"+tmpok+"]",gvl); 
        };
        bku=bku.replace("[stid]",xyz); 
        bku=bku.replace("[sno]",sno); 
        bku=bku.replace("[appid]",GetRequest().appid); 
           if (bku.indexOf("?")==-1){
            bku=bku+"?rdr=1&rnd="+randomWord(false,10);
           }else{
            bku=bku+"&rdr=1&rnd="+randomWord(false,10);
           }
           bkurl=ajaxhtmlpost(bku,"");
           if (bkurl.indexOf("location:")==0){
             surl=bkurl.replace("location:","");
           }else{
             surl=bku;
           }
      }else{
        if (xyz.length>10){
           bku=xyz;
            ptnhtxt=bku.split("[get-");
            totpt=ptnhtxt.length;
          for (f=1;f<totpt;f++){
            tmpok=qian(ptnhtxt[f],"]");
            eval("gvl=GetRequest()."+tmpok+";");
            bku=bku.replace("[get-"+tmpok+"]",gvl); 
          };
          bku=bku.replace("[stid]",xyz); 
          bku=bku.replace("[sno]",sno); 
          bku=bku.replace("[appid]",GetRequest().appid); 
           if (bku.indexOf("?")==-1){
            bku=bku+"?rdr=1&rnd="+randomWord(false,10);
           }else{
            bku=bku+"&rdr=1&rnd="+randomWord(false,10);
           }
           bkurl=ajaxhtmlpost(bku,"");
           if (bkurl.indexOf("location:")==0){
             surl=bkurl.replace("location:","");
           }else{
             surl=bku;
           }
        }else{
          surl='/SPEC/EDITOR/anyshortnew.php?stid='+xyz+'&SNO='+sno+'&cfid=newdftstyle&appid='+GetRequest().appid+'&rnd='+randomWord(false,10);
        }
     };
   bkwhf= F('getstwh','stid='+xyz,''); 
   whf=eval('('+bkwhf+')');
   if (whf.status==1){
     hx=whf.h+"px";
     wx=whf.w+"px";
   }else{
     hx='600px';
     wx='893px';
     mx=true;
   }
     tt=whf.t;
     if (surl.indexOf("SNO")>0){
        if (surl.indexOf("SNO=0")>0){
         ttt="为"+tt+"新增记录";
       }else{
         ttt="编辑"+tt+"的详情";
       }
      }else{
       ttt=""+tt+"的列表";
      }
       if (whf.f==1){
         mx=false;
       }else{
         mx=true;
       }
     layer.open({
      type: 2,
      title: ttt,
      shadeClose: true,
      shade: false,
      maxmin: mx, //开启最大化最小化按钮
      area: [wx, hx],
      content: surl //这里content是一个URL,如果你不想让iframe出现滚动条,你还可以content: ['http://sentsin.com', 'no']
     });
    }
function newwin(title,url) {     
           bku=url;
            ptnhtxt=bku.split("[get-");
            totpt=ptnhtxt.length;
          for (f=1;f<totpt;f++){
            tmpok=qian(ptnhtxt[f],"]");
            eval("gvl=GetRequest()."+tmpok+";");
            bku=bku.replace("[get-"+tmpok+"]",gvl); 
          };
          bku=bku.replace("[stid]",qian(GetRequest().stid,"-")); 
          bku=bku.replace("[appid]",GetRequest().appid); 
           if (bku.indexOf("?")==-1){
            bku=bku+"?rdr=1&rnd="+randomWord(false,10);
           }else{
            bku=bku+"&rdr=1&rnd="+randomWord(false,10);
           }
           bkurl=ajaxhtmlpost(bku,"");
           if (bkurl.indexOf("location:")==0){
             surl=bkurl.replace("location:","");
           }else{
             surl=bku;
           }
  if (surl.indexOf("stid=")>0){
     xyz=qian(qian(hou(surl,"stid="),"&"),"-");
  }else{
     xyz=surl;
  }
   bkwhf= F('getstwh','stid='+xyz,''); 
   whf=eval('('+bkwhf+')');
   if (whf.status==1){
     hx=whf.h+"px";
     wx=whf.w+"px";
   }else{
     hx='600px';
     wx='893px';
     mx=true;
   }
     tt=whf.t;
     if (surl.indexOf("SNO")>0){
        if (surl.indexOf("SNO=0")>0){
         ttt="为"+tt+"新增记录";
       }else{
         ttt="编辑"+tt+"的详情";
       }
      }else{
       ttt=""+tt+"的列表";
      }
       if (whf.f==1){
         mx=false;
       }else{
         mx=true;
       }
    console.log(hx+wx);
     layer.open({
      type: 2,
      title: ttt,
      shadeClose: true,
      shade: false,
      maxmin: mx, //开启最大化最小化按钮
      area: [wx, hx],
      content: surl //这里content是一个URL,如果你不想让iframe出现滚动条,你还可以content: ['http://sentsin.com', 'no']
     });
    }
function openwin(title,url,w,h) {     
           bku=url;
           ptnhtxt=bku.split("[get-");
           totpt=ptnhtxt.length;
          for (f=1;f<totpt;f++){
            tmpok=qian(ptnhtxt[f],"]");
            eval("gvl=GetRequest()."+tmpok+";");
            bku=bku.replace("[get-"+tmpok+"]",gvl); 
          };
          bku=bku.replace("[stid]",qian(GetRequest().stid,"-")); 
          bku=bku.replace("[appid]",GetRequest().appid); 
           if (bku.indexOf("?")==-1){
            bku=bku+"?rdr=1&rnd="+randomWord(false,10);
           }else{
            bku=bku+"&rdr=1&rnd="+randomWord(false,10);
           }
           bkurl=ajaxhtmlpost(bku,"");
           if (bkurl.indexOf("location:")==0){
             surl=bkurl.replace("location:","");
           }else{
             surl=bku;
           }
   if (surl.indexOf("stid=")>0){
     xyz=qian(qian(hou(surl,"stid="),"&"),"-");
   }else{
     xyz=surl;
   }   
   if (h>0){
     hx=h+"px";
     wx=w+"px";
   }else{
     hx='600px';
     wx='893px';
   }
    mx=true;            
     layer.open({
      type: 2,
      title: title,
      shadeClose: true,
      shade: false,
      maxmin: mx, //开启最大化最小化按钮
      area: [wx, hx],
      content: surl //这里content是一个URL,如果你不想让iframe出现滚动条,你还可以content: ['http://sentsin.com', 'no']
     });
  }
function intourl(turl){
 var furl=window.location.href;
 var dmn=window.location.host;
 localStorage.setItem("preurl",furl) ;
 localStorage.setItem("pretitle",document.title) ;
 ptit=turl.split("{");
 totp=ptit.length;
 for (i=1;i<totp;i++){
   inx=qian(ptit[i],"}");
   xxx=qian(inx,"-");
   yyy=hou(inx,"-");
   zzz="";
   if (xxx="get"){
     eval("zzz=GetRequest()."+yyy);
   }
  if (typeof(zzz)!="un"+"defined"){
   turl=turl.replace("{"+inx+"}",zzz);
  }else{
   turl=turl.replace("{"+inx+"}","");
  }
 }
 location.href=turl;
}
function supersearch(sid,nox){
  prehref=location.href;
  houhref=hou(prehref,"?");
  pthref=houhref.split("&");
  if (prehref.indexOf("pnum:")>0){
    pn=qian(hou(prehref,"pnum:"),"-");
  }else{
    pn="";
  }
 allk=$("#supers").attr("skey");
 sc=$("#supers").attr("sc");
 if (allk!="" && allk!=undefined ){
  if (allk.indexOf("/")>0){
    ptk=allk.split("/");
    totk=ptk.length;
  }else{
    totk=0;
  }
  fmkv="";
 for (t=0;t<totk-1;t++){
  tmpk=qian(ptk[t],":");
  tmtp=hou(ptk[t],":");
   switch (tmtp){
   case "varchar":
   if (sc=="9"){
    for (p=1;p<7;p++){
      fmkv=fmkv+"q_"+tmpk+p+":"+$("#q_"+tmpk+p).val()+"/";
    }
  }else{
      fmkv=fmkv+"q_"+tmpk+"0"+":"+$("#q_"+tmpk+"0").val()+"/";
  }
   break;
   case "text":
   if (sc=="9"){
    for (p=1;p<7;p++){
      fmkv=fmkv+"q_"+tmpk+p+":"+$("#q_"+tmpk+p).val()+"/";
    }
  }else{
    fmkv=fmkv+"q_"+tmpk+"0"+":"+$("#q_"+tmpk+"0").val()+"/";
  }
   break;
   default:
   if (sc=="9"){
     for (p=1;p<7;p++){
      fmkv=fmkv+"qa_"+tmpk+p+":"+$("#qa_"+tmpk+p).val()+"/"+"qb_"+tmpk+p+":"+$("#qb_"+tmpk+p).val()+"/";
    }
  }else{
      fmkv=fmkv+"qa_"+tmpk+"0"+":"+$("#qa_"+tmpk+"0").val()+"/"+"qb_"+tmpk+"0"+":"+$("#qb_"+tmpk+"0").val()+"/";
  }
 }//switch
 }//for t
  prehref=location.href;
  houhref=hou(prehref,"?");
  pthref=houhref.split("&");
  totp=pthref.length;
  fmxxx="";
  pppp="";
  for (i=0;i<totp;i++){
    if (qian(pthref[i],"=")!="page" && qian(pthref[i],"=")!="pnum" && qian(pthref[i],"=")!="xkey"  && qian(pthref[i],"=")!="xval"  && qian(pthref[i],"=")!="qry"){
      fmxxx=fmxxx+"&"+pthref[i];
    }
  }
  if (sessionStorage.pnum==""){
   pgnum=GetRequest().pnum;
  }else{
   if (pn==""){
     pgnum=sessionStorage.pnum;
   }else{
     pgnum=pn;
   }
 }
 if (sessionStorage.page==""){
   pgpage=GetRequest().page;
 }else{
   pgpage=sessionStorage.page;
 }
if  (typeof(pgpage)!="un"+"defined"){
  if  (typeof(pgnum)=="un"+"defined"){
   pgnum="";
  }
  if (pgpage.indexOf(":")>0){
    pppp="page=1:"+hou(pgpage,":")+"&pnum="+pgnum+"&xkey="+allk+"&xval="+fmkv+"&sc="+sc;
     if (strpos(prehref,"stid=")>0){
     }else{        
        if (strpos(prehref,"/shortid")>0){
            sid=hou(qian(prehref,"/shortid/"),"/");
            pppp=pppp+"&stid="+sid;
        };        
     };
    sessionStorage.page="1:"+hou(pgpage,":");
    sessionStorage.pnum=pgnum;
    sessionStorage.xkey=allk
    sessionStorage.xval=fmkv;
    sessionStorage.sc=sc;
  }else{
    pppp="page=1&pnum="+pgnum+"&xkey="+allk+"&xval="+fmkv+"&sc="+sc;
     if (strpos(prehref,"stid=")>0){
     }else{        
        if (strpos(prehref,"/shortid")>0){
            sid=hou(qian(prehref,"/shortid/"),"/");
            pppp=pppp+"&stid="+sid;
        };        
     };
    sessionStorage.page="1";
    sessionStorage.pnum=pgnum;
    sessionStorage.xkey=allk
    sessionStorage.xval=fmkv;
    sessionStorage.sc=sc;
  }
 }else{
   pppp="page=1";
     if (strpos(prehref,"stid=")>0){
     }else{        
        if (strpos(prehref,"/shortid")>0){
            sid=hou(qian(prehref,"/shortid/"),"/");
            pppp=pppp+"&stid="+sid;
        };        
     };
    sessionStorage.page="1";
    sessionStorage.pnum="";
    sessionStorage.xkey=""
    sessionStorage.xval="";
    sessionStorage.sc="";
 }
  if (sessionStorage!=0){
   location.href=qian(prehref,"?")+"?"+pppp+fmxxx;
  }else{
   purl="/SPEC/EDITOR/anyshort.php?"+pppp+fmxxx;    
   tbnm=$('table[name="tabunit"]').attr("tbname");
   if (tbnm!="" && tbnm!="un"+"defined"){
   }else{
     tbnm="";
   }
   stid=GetRequest().stid;
   sid=qian(stid,"-");   
   if(pgnum.indexOf(":")>0){
      pnum=qian(pgnum,":");
   }else{
      pnum=pgnum;
   }
   if(pgpage.indexOf(":")>0){
     page=qian(pgpage,":");
   }else{
     page=pgpage;
   }
   bkxyz=anyjson(purl,tbnm,page,sid);
   bktable=bkxyz["html"];
   if (bktable!=""){
    $("form[name='tabform']").html(bktable);
    eval(bkxyz["script"]);
    $("#customPages").html(pageabc(intval(bkxyz["totrcd"])/intval(pnum),intval(page),intval(pnum),intval(bkxyz["totrcd"]),$('table[name="tabunit"]').attr("tbname")));
    //$(".layui-select").show();
     layrender();
     newtdlisten();
     listenclsduo();
     newjsfile("/FACE/imginout/js/boxImg.js");
     newjsfile("/FACE/inputpm/js/num-alignment.js");     
   }
  }
 }//not defined
 layui.use(['form'], function(){
 form=layui.form;
 form.on('select(brickType)', function(data){ 
 ocg=$(this).parent().parent().prev().attr("onchange");
  nv=$(this).attr("lay-value");
  if (typeof(ocg)!="un"+"defined" && typeof(nv)!="un"+"defined"){
   if (ocg!=""){
     ocg=ocg.replace(/<thisnewvalue>/g,nv);
     eval(ocg);
     form.render(); 
    };
   };
  });
 }); 
}

function totb(){
 tbnm=$('table[name="tabunit"]').attr("tbname");
 openwin("编辑"+tbnm+"表格","/SPEC/EDITOR/anyjsshort.php?stid=2qPIqS-sfile:anyjsshort.php-&pnum=150:"+tbnm+"&page=1:TABLE_NAME",1746,806);
}
function uptb(){
 stid=GetRequest().stid;
 if (stid.indexOf("-")>0){
  stid=qian(stid,"-");
 }
 openwin("编辑短数据表格"+stid,"/SPEC/EDITOR/anyjsshort.php?datatype=html&stid=keydtly-sfile:anyjsshort.php-&pnum=150:"+stid+"&page=1:shortid",1846,806);
}
function topmt(){
 appid=GetRequest().appid;
 openwin("编辑此应用相关用户权限"+appid,"/SPEC/EDITOR/anyjsshort.php?stid=pmissps-sfile:anyjsshort.php-pnum:150-&page=1:appid&pnum=30:"+appid,1846,806);
}
function tofun(){
 appid=GetRequest().appid;
 bkfun=F('getfunbyappid','appid='+appid,'');
 openwin("编辑此应用涉及方法-"+appid,"/SPEC/EDITOR/anyjsshort.php?stid=appfuns-sfile:anyjsshort.php-pnum:150-&funs="+bkfun,1846,806);
}
function killsave(tbnmx,snox){
  if (tbnmx!="" && snox!="" ){
   if (sessionStorage.locallist==1){
     xz=UY("delete from "+tbnmx+" where SNO='"+snox+"'");    
   }else{
     z=ajaxhtmlpost("/DNA/EXF/anyrcv.php?tbnm="+tbnmx+"&SNO="+snox+"&kies=-killitem","");
   }
    x=localitem();
    return "1";
  }else{
    return "0";
  }
}

function uplocal(kxs,pxs){
  allkxs="xyz=1&"+kxs+"&rnd=abcd";
  tbnm=qian(hou(allkxs,"tbnm="),"&");
  kies=qian(hou(allkxs,"kies="),"&");
  snox=qian(hou(allkxs,"SNO="),"&");
 if (isnx(snox)){
 }else{
   pxs=str_replace(snox,"0",pxs);
   x=ajaxhtmlpost("/DNA/EXF/anyrcv.php?tbnm="+tbnm+"&kies="+kies+"&SNO=0",pxs);
  if (x=="1"){    
    x=UY("delete from "+tbnm+" where SNO='"+snox+"'");
    x=localitem();
    return "1";
  }else{
    return "0";
  }  
 }
}
function localitem(){  
  sessionStorage.locallist=1;
  stid=GetRequest().stid;
  xtid=qian(stid,"-");
  lhtm=localshort(xtid,"","");
 $("form").html(lhtm);
}
function isnx(strx){
     if (strx*1>-1){
        return true;
      }else{
        return false;
      }
}
function localupdate(kxs,pxs){
  allkxs=kxs+"&rnd=abcd";
  tbnm=qian(hou(allkxs,"tbnm="),"&");
  kies=qian(hou(allkxs,"kies="),"&");
  snox=qian(hou(allkxs,"SNO="),"&");
  if (snox==""){
    snox="0";
  }
  if (tbnm!="" && kies!=""){
    ptkx=kies.split(",");
    totx=ptkx.length;
    fmkx="";
    fmvx="";
    fmsets="";
    for (i=0;i<totx;i++){
      fmkx=fmkx+ptkx[i]+",";
      fmsets=fmsets+ptkx[i]+"='"+qian(hou(pxs,"p_"+ptkx[i]+snox),"&")+"',";
      fmvx="'"+qian(hou(pxs,"p_"+ptkx[i]+snox),"&")+"',";
    }
    fmkx=killlasttring(fmkx);
    fmvx=killlasttring(fmvx);
    fmsets=killlasttring(fmsets);
    x=UY("update "+tbnm+" set "+fmsets+" where SNO='"+snox+"'");
    return "1";
  }else{
    return "0";
  }  
}
function localsave(kxs,pxs){
  allkxs="#&"+kxs+"&rnd=abcd";
  tbnm=qian(hou(allkxs,"tbnm="),"&");
  kies=qian(hou(allkxs,"kies="),"&");
  snox=qian(hou(allkxs,"SNO="),"&");
  if (snox==""){
    snox="0";
  }
  apxs="@"+pxs;  
  if (kxs!="" && kxs!=undefined && tbnm!="" && kies!="" && tbnm!=undefined && kies!=undefined && pxs!=""){    
    ptkx=kies.split(",");
    totx=ptkx.length;
    fmkx="";
    fmvx="";    
    tmpvx="";
    for (i=0;i<totx;i++){
      fmkx=fmkx+ptkx[i]+",";      
      if (apxs.indexOf("p_"+ptkx[i]+snox)>0){
        tmpvx=qian(hou("@"+pxs+"&","p_"+ptkx[i]+snox+"="),"&");
        tmpvx=str_replace("undefined","",tmpvx);
        fmvx=fmvx+"'"+tmpvx+"',";
      }else{
        fmvx=fmvx+"'',";
      }
     }    
    fmkx=killlasttring(fmkx);
    fmvx=killlasttring(fmvx);    
    x=UY("insert into "+tbnm+"("+fmkx+")values("+fmvx+")");
    return 1;
  }else{
    return 0;
  }  
}
function qajaxp(ttt,aurl,adata){
		$.ajax({
			url:encodeURI(aurl),
			data:adata,
			type:'POST',
			dataType:"html",
			success: function(data){
			  if (data*1==1 || data.indexOf('uccess')>0 ||  data.indexOf('UCCESS')>0  || data.indexOf('okay')>0){
                Notiflix.Notify.Success(ttt+'成功'); 
                if (aurl.indexOf("anyrcv.php")>0 && aurl.indexOf("SNO=")>0){
                  sid=GetRequest().stid;
                  if (sid!=undefined){
                    sno=qian(hou(aurl,"SNO="),"&");
                    z=resetline(qian(sid,"-"),sno);
                  }
                }
              }else{
                Notiflix.Notify.Failure(ttt+'失败,代码:'+data);
                console.log(ttt+'失败,代码:'+data);
              };
			}
		});				
}			//游客不能登录提示框，执行此代码 
function qajaxpx(ttt,aurl,adata){
		$.ajax({
			url:encodeURI(aurl),
			data:adata,
			type:'POST',
			dataType:"html",
			success: function(data){
			  if (data*1==1 || data.indexOf('uccess')>0 ||  data.indexOf('UCCESS')>0   || data.indexOf('okay')>0){
                Notiflix.Notify.Success(ttt+'成功'); 
              }else{
                Notiflix.Notify.Failure(ttt+'失败,代码:'+data);
                console.log(ttt+'失败,代码:'+data);
              };
            }
		});				
}

function qajaxps(ttt,aurl,adata){
		$.ajax({
			url:encodeURI(aurl),
			data:adata,
			type:'POST',
			dataType:"html",
			success: function(data){
			  if (data*1==1 || data.indexOf('uccess')>0 ||  data.indexOf('UCCESS')>0   || data.indexOf('okay')>0){                               
                Notiflix.Notify.Success(ttt+'成功'); 
                  window.location.reload();
              }else{
                  Notiflix.Notify.Failure(ttt+'失败,代码:'+data);
                  console.log(ttt+'失败,代码:'+data);
              };
			}
		});				
}
function qajaxpu(uuu,aurl,adata){
		$.ajax({
			url:encodeURI(aurl),
			data:adata,
			type:'POST',
			dataType:"html",
			success: function(data){
			  if (data*1==1 || data.indexOf('uccess')>0 ||  data.indexOf('UCCESS')>0   || data.indexOf('okay')>0){ 
                Notiflix.Notify.Success('操作成功'); 
                  location.href=uuu;
              }else{
                  Notiflix.Notify.Failure('操作失败-代码:'+data);
                 console.log('操作失败,代码:'+data);
              };
			}
		});				
}
function quickstrength(){
  newjsfile('/FACE/18841880246/strength/editsys.js');
  return true;
}
function savedata(kx,vx){
  if (typeof(Storage) !== "undefined") {  
    localStorage.setItem(kx,vx);
    return true;    
   } else {
    return false;
  }
}
function usedata(kx){
  if (typeof(Storage) !== "undefined") {       
     return  localStorage.getItem(kx);    
   } else {
    return "";
  }
}
function ajaxposthtml(urlx,adata,evalfun){
$.ajax({
       type: "POST",
       async : true, //默认为true 异步 
       url: encodeURI(urlx),
       data: adata,         
       dataType:"html",
       success: function(data){                  
         eval(evalfun); 
         return true;
        }    
       });       
  }
function ajaxhtmlpost(aurl,adata){
       returnValue='';
		$.ajax({
			url:encodeURI(aurl),
			data:adata,
            async:false,
			type:'POST',
			dataType:"html",
			success:function(data){
               returnValue=data;
			}
           });
       return returnValue;
 }
 function textform(){
  tot=0;   
   for (i=1;i<10;i++){
     if($("#LAY_layedit_"+i).attr("textarea")!=undefined){ 
      teid=$("#LAY_layedit_"+i).attr("textarea");
       //ifr_window=window.parent.frames["LAY_layedit_"+i];
       //console.log($(document.getElementById('LAY_layedit_1').contentWindow.document.body).html())
       //ifr_window.document.body.innerHTML  oldstringcode
      bodhtml=$(document.getElementById('LAY_layedit_'+i).contentWindow.document.body).html();
      $("#"+teid).html(bodhtml);         
       tot=tot+1;
     };
   }
   return tot;
 }
 function _get(gkx){
   grst="";
   if (gkx=="" || gkx==undefined || strpos(gkx," ")==-1 || strlen(gkx)>=15 || strpos(gkx,">")>0 ||  strpos(gkx,"=")>0 || strpos(gkx,"<")>0){
     return "";
   }else{
    eval("grst=GetRequest()."+gkx+";");
    if (grst!="" && grst!=undefined){
     return grst+"";
    }else{
      return "";     
    }
   }
 }

 function getknm(kvs,kxx){
    var xkeys=kvs.keys;
    var ptkx=xkeys.split(",");
    var totptk=ptkx.length;
    var ktpx=kvs.ktps;
    var totkt=ktpx.length;
    var ktt="";
    if (totkt>0){
      for (p=0;p<totkt;p++){
         if (ktpx[p].keyname==kxx){
          var ktt=ktpx[p].typetitle;
         }  
      }
          return ktt;
    }else{
      return "";
    }   
 }
function getkcnm(kvs,kxx,kvv){
    var xkeys=kvs.keys;
    var ptkx=xkeys.split(",");
    var totptk=ptkx.length;
    var ktpx=kvs.ktps;
    var totkt=ktpx.length;
    var ktxt="";
    var knm="";
    if (totkt>0){
       for (p=0;p<totkt;p++){
          if (ktpx[p].keyname==kxx){
          var ktxt=ktpx[p].clstxt;
          }  
       }
       if (ktxt==""){
        knm="";
       }else{
         var qqq=qian(ktxt,"|");
         var hhh=hou(ktxt,"|");
         var ptq=qqq.split(",");
         var pth=hhh.split(",");
         var totptq=ptq.length;
         for (q=0;q<totptq;q++){
           if (pth[q]==kvv){
            knm=ptq[q];
           }//if
         }//for        
        }
      return knm;
    }else{
      return "";
    }   
}
function tabledft(tbnm){
   eval("frmtp=typeof(TBFRM"+tbnm+");");
   if (frmtp=="undefined"){
     x=newjsfile("/DNA/EXF/anyfuns.php?fid=tabcol&tablename="+tbnm+"&rnd="+Math.random());
     return true;
   }else{
     return false;
   }  
}
function shortdft(stid){
   eval("frmtp=typeof(STDFT"+stid+");");
   if (frmtp=="undefined"){
     x=newjsfile("/DNA/EXF/anyfuns.php?fid=shortdft&shortid="+stid+"&rnd="+Math.random());
     return true;
   }else{
     return false;
   }  
}
function explode(bstr,longstr){
  return longstr.split(bstr);
}
function count(ptx){
  return ptx.length;
}
function strpos(strx,strsub){
  if (strx!="" && strx!=undefined && strsub!="" && strsub!=undefined){
    return strx.indexOf(strsub);
  }else{
    return -1;
  }
}
function countresult(fullresult)
 {  
  partkn=explode("#/#",fullresult);
  countkn=count(partkn);
  return countkn-2;
 }
function isx1(brst,frst){
  if (strpos("xx-"+brst,frst)>0){
    return true;
  }else{
    return false;
  }
}
function iso1(brst,frst,isxy){
  if (isxy==true){
    if (strpos("xx-"+brst,frst)>0){
      return true;
    }else{
      return false;
   }
  }else{
    return false;
  }
}
function isx2($brst,$frst,$trst){
  if (strpos("xx-"+$brst,$frst)>0 && strpos("xx-"+$brst,$trst)>0){
    return true;
  }else{
    return false;
  }
}
function iso2($brst,$frst,$trst){
  if (strpos("xx-"+$brst,$frst)>0 || strpos("xx-"+$brst,$trst)>0){
    return true;
  }else{
    return false;
  }
}
function isx3($brst,$frst,$trst,$thrst){
  if (strpos("xx-"+$brst,$frst)>0 && strpos("xx-"+$brst,$trst)>0 && strpos("xx-"+$brst,$thrst)>0){
    return true;
  }else{
    return false;
  }
}
function iso3($brst,$frst,$trst,$thrst){
  if (strpos("xx-"+$brst,$frst)>0 || strpos("xx-"+$brst,$trst)>0 || strpos("xx-"+$brst,$thrst)>0){
    return true;
  }else{
    return false;
  }
}
function substr(strstrstr,sts,lens){
  return strstrstr.substr(sts,lens);
}
function str_replace(oldstr,newstr,rplst){
  rtnstr="";
  oldstr=turncon(oldstr);
  if (oldstr!="" && oldstr!=undefined && newstr!=undefined && rplst!="" && rplst!=undefined){
   if ((oldstr.indexOf(" ")>0 && oldstr.indexOf("\"")>0) || oldstr.indexOf("/")>0 || oldstr.indexOf("[")>0){
    eval("rtnstr=rplst.replace('"+oldstr.replace(/\'/g,"\\\'")+"','"+newstr.replace(/\'/g,"\\\'")+"');")
    return rtnstr;
   }else{
    eval("rtnstr=rplst.replace(/"+oldstr.replace(/\'/g,"\\\'")+"/g,'"+newstr.replace(/\'/g,"\\\'")+"');")
    return rtnstr;
   }
  }else{
    return rplst;
  }
}
function tostring($vlsx){
 if ($vlsx!="" && $vlsx!=undefined){
  if (strpos("x"+$vlsx,"TYPE_HEX:")>0){
    $houvlx=hex2a(hou(hou($vlsx,"TYPE_HEX:"),"TYPE_HEX:"));
      if (strpos("x"+$houvlx,"TYPE_HEX:")>0){
        $houvlx=hex2a(hou(hou($houvlx,"TYPE_HEX:"),"TYPE_HEX:"));
      }
     $houvlx=hhth($houvlx);
  }else{   
    $houvlx=hhth($vlsx);
  };
  return $houvlx;
 }else{
   return "";
 }
}
 function instance($mstr){
   $mstr=str_replace("{","<",$mstr);
   $mstr=str_replace("}",">",$mstr);
   $mstr=$mstr.replace(/\[/g,"{");
   $mstr=$mstr.replace(/\]/g,"}");
   return $mstr;
 }
function shortinfo(stid){
 $stbase=new Array();
 eval("frmtp=typeof(STDFT"+stid+");");
if (frmtp=="undefined"){
  return $stbase;
}else{
  eval("tmpst=STDFT"+stid+";");
  $stbase["shortid"]=stid;
  $stbase["tablename"]=tmpst.vls[0].tablename;
  $stbase["showkeys"]=tmpst.vls[0].showkeys;
  if (strpos("XX"+$stbase["showkeys"],"SNO,")>0){
    if (substr($stbase["showkeys"],0,3)!="SNO"){
      $stbase["showkeys"]="SNO,"+str_replace("SNO,","",$stbase["showkeys"]);
    };
  }else{
    $stbase["showkeys"]="SNO,"+$stbase["showkeys"];
  }
  if (strpos("XX"+$stbase["showkeys"],"OLMK")>0){
  }else{
    $stbase["showkeys"]=$stbase["showkeys"]+",OLMK";
  }
  $stbase["cdt"]=tostring(tmpst.vls[0].cdt);
  $stbase["orddt"]=tostring(tmpst.vls[0].orddt);
  $stbase["caseid"]=tostring(tmpst.vls[0].caseid);
  $stbase["pageid"]=tostring(tmpst.vls[0].lang);
  $stbase["dttp"]=tostring(tmpst.vls[0].dttp);  
  $stbase["addpage"]=tostring(tmpst.vls[0].addpage);
  $stbase["addtitle"]=tostring(tmpst.vls[0].addtitle);
  $stbase["shorttitle"]=tostring(tmpst.vls[0].shorttitle);
  $stbase["updatepage"]=tostring(tmpst.vls[0].updatepage);
  $stbase["detailpage"]=tostring(tmpst.vls[0].detailpage);
  $stbase["additemx"]=tmpst.vls[0].additemx*1;
  $stbase["newbutton"]=tmpst.vls[0].newbutton*1;
  $stbase["obtn"]=tmpst.vls[0].obtn*1;
  $stbase["vbtn"]=tmpst.vls[0].vbtn*1;
  $stbase["xbtn"]=tmpst.vls[0].xbtn*1;
  $stbase["oprtx"]=tmpst.vls[0].oprtx*1;
  if ($stbase["oprtx"]*1>0){
    if (strpos("XX"+$stbase["showkeys"],"OPRT")>0){
    }else{
     $stbase["showkeys"]=$stbase["showkeys"]+",OPRT";
    }
  }
  $stbase["diycode"]=instance(tostring(tmpst.vls[0].diycode));
  $stbase["headx"]=instance(tostring(tmpst.vls[0].headx));
  $stbase["diytop"]=instance(tostring(tmpst.vls[0].diytop));
  $stbase["diybottom"]=instance(tostring(tmpst.vls[0].diybottom));  
  $stbase["topbtn"]=tostring(tmpst.vls[0].topbtn)*1;
  $stbase["bottombtn"]=tostring(tmpst.vls[0].bottombtn)*1;
  $stbase["tbhd"]=tostring(tmpst.vls[0].tbhd)*1;
  $stbase["sps"]=tostring(tmpst.vls[0].sps)*1;
  $stbase["dtx"]=tostring(tmpst.vls[0].dtx)*1;
  $stbase["ctraw"]=tostring(tmpst.vls[0].ctraw)*1;
  $stbase["allkillbtn"]=tostring(tmpst.vls[0].allkillbtn)*1;  
  return $stbase;
 }
  
}
function jsontosx(jsonx){
  if (jsonx.keys!=undefined){
     akeys=jsonx.keys;
     ptak=explode(",",akeys);
     totp=count(ptak);
     fmx="";
   if (jsonx.vls.length>0){
     fmx=fmx+akeys.replace(/,/g,"#-#")+"#/#";
    for (j=0;j<jsonx.vls.length;j++){   
     for (i=0;i<totp;i++){
       tmpv="";
       if (strpos(ptak[i],"clstxt")>0){
         tmpmd5="";
         eval("tmpmd5=jsonx.vls["+j+"]."+ptak[i]+";");
         if (tmpmd5!=""){
           eval("tmpv=tostring("+"jsonx.md5txt."+tmpmd5+");");
           if (tmpv!=undefined && tmpv!=""){
           }else{
             eval("tmpv=tostring("+"jsonx.vls["+j+"]."+ptak[i]+");");
           }
         }else{
           eval("tmpv=tostring("+"jsonx.vls["+j+"]."+ptak[i]+");");
         }
       }else{
         eval("tmpv=tostring("+"jsonx.vls["+j+"]."+ptak[i]+");");
       }
       tmpv=tmpv.replace(/\\\"/g,'');
       fmx=fmx+tmpv+"#-#";
     }
      fmx=killlast3(fmx)+"#/#";
    }
     return fmx;//有记录的
   }else{
     return akeys.replace(/,/g,"#-#")+"#/#";//无记录
   }
  }else{
     return "";
  }
}
function arrdata(selerst){
tbrst=new Array();
tmpkies=qian(selerst,"#/#");
tmpkiep=tmpkies.split("#-#");
totpx=tmpkiep.length;
tmpvalrp=selerst.split("#/#")
tottbrst=tmpvalrp.length-1;
 for (ix=0;ix<totpx;ix++){
   tbrst[tmpkiep[ix]]=new Array();
   tbrst[tmpkiep[ix]][tottbrst]=0;       
   tbrst[tmpkiep[ix]][0]=tmpkies;          
 }  
 for (jx=1;jx<tottbrst;jx++){ //因为第一行是KEYS所以数量不变如果不存在他就是0-N      
   for (ix=0;ix<totpx;ix++){
     tmpvalrx=tmpvalrp[jx].split("#-#");     
      tbrst[tmpkiep[ix]][jx]=tmpvalrx[ix];     
      if (tmpvalrx[ix]*1>0 || tmpvalrx[ix]*1<0){
          tbrst[tmpkiep[ix]][tottbrst]=tbrst[tmpkiep[ix]][tottbrst]+(tmpvalrx[ix]*1);
      }else{
          tbrst[tmpkiep[ix]][tottbrst]=tbrst[tmpkiep[ix]][tottbrst]+0;
      }
   };   
  };
   return tbrst;
}

function TX(sqlstr){  
  if (sqlstr.indexOf("elect ")>0 && sqlstr.indexOf(" from ")>0){
     skeys=qian(hou(sqlstr,"elect ")," from ");    
     tbnm=qian(hou(sqlstr," from ")," where ");
     cdts=hou(sqlstr," where ");
     stype="select";
    skeys=skeys.replace(/ /g,"");
    tmptx={"skeys":skeys,"tbnm":tbnm,"cdts":cdts,"stype":"select"};
   }
   if (sqlstr.indexOf("elete ")>0 && sqlstr.indexOf(" from ")>0){     
     tbnm=qian(hou(sqlstr," from ")," where ");
     cdts=hou(sqlstr," where ");
     stype="delete";     
     tmptx={"skeys":"","tbnm":tbnm,"cdts":cdts,"stype":"select"};
   }
   if (sqlstr.indexOf("nsert ")>0 && sqlstr.indexOf(" into ")>0){     
     tbnm=qian(hou(sqlstr," into "),"(");
     skeys=qian(hou(sqlstr,"("),")");
     vals=hou(sqlstr,"values");
     vals=killfirsttring(vals);
     vals=killlasttring(vals);
     vals=vals.replace(/'/g,"");
     stype="insert";
     skeys=skeys.replace(/ /g,"");
     tmptx={"skeys":skeys,"tbnm":tbnm,"cdts":vals,"stype":"insert"};
   }
   if (sqlstr.indexOf("pdate ")>0 && sqlstr.indexOf(" set ")>0){
     skvs=qian(hou(sqlstr," set ")," where ");
     skvs=skvs.replace(/'/g,"");
     tbnm=qian(hou(sqlstr,"update ")," set ");
     cdts=hou(sqlstr," where ");
     stype="update";
     tmptx={"skeys":"","tbnm":tbnm,"cdts":cdts,"stype":"update","sets":skvs};
   }
  return tmptx;
}
function UY(sqlstr){  
 if (sqlstr!=""){
   skeys="";
   if (sqlstr.indexOf("elect ")>0 && sqlstr.indexOf(" from ")>0){
     if (strpos(sqlstr," where ")==-1){
       sqlstr=sqlstr+" where ";
     }
     skeys=qian(hou(sqlstr,"elect ")," from ");
     tbnm=qian(hou(sqlstr," from ")," where ");
     cdts=hou(sqlstr," where ");
     stype="select";
   }
   if (sqlstr.indexOf("elete ")>0 && sqlstr.indexOf(" from ")>0){     
     if (strpos(sqlstr," where ")==-1){
       sqlstr=sqlstr+" where ";
     }
     tbnm=qian(hou(sqlstr," from ")," where ");
     cdts=hou(sqlstr," where ");
     stype="delete";
   }
   if (sqlstr.indexOf("nsert ")>0 && sqlstr.indexOf(" into ")>0){     
     //console.log("s-"+sqlstr);
     tbnm=qian(hou(sqlstr," into "),"(");
     skeys=qian(hou(sqlstr,"("),")");
     vals=hou(sqlstr,"values");
     vals=killfirsttring(vals);
     vals=killlasttring(vals);     
     stype="insert";
   }
   if (sqlstr.indexOf("pdate ")>0 && sqlstr.indexOf(" set ")>0){
     if (strpos(sqlstr," where ")==-1){
       sqlstr=sqlstr+" where ";
     }
     skvs=qian(hou(sqlstr," set ")," where ");
     tbnm=qian(hou(sqlstr,"pdate")," set ");
     if (sqlstr.indexOf(" where ")>0){
       cdts=hou(sqlstr," where ");
     }else{
       cdts="";
     }
     stype="update";
   }
   skeys=skeys.replace(/ /g,"");
   tbnm=tbnm.replace(/ /g,"");
   eval("frmtp=typeof(TBFRM"+tbnm+");");
   if (frmtp=="undefined"){
     x=newjsfile("/DNA/EXF/anyfuns.php?fid=tabcol&tablename="+tbnm);
   }
   switch(stype){
     case "select":
       eval (tbnm+"txt=localStorage."+tbnm);
       eval (tbnm+"=eval('('+"+tbnm+"txt+')')");       
       eval("tbtp=typeof("+tbnm+");");
          if (tbtp=="undefined" || extkeys(skeys,tbnm)==false){
             return [];
          }else{
            eval ("tmptable="+tbnm+";");     
            sltable=[];
            sltable=selectx(cdts,tmptable,tbnm);
            tmpvl="";            
            switch(skeys){
              case "count(*)":
              return sltable.length;
              break;
              default:
              if (sltable.length>0){
               eval("tmpvl=sltable[0]."+skeys+";");
               return tmpvl;        
              }
            }
          }       
       break;
     case "delete":
       eval (tbnm+"txt=localStorage."+tbnm);
       eval (tbnm+"=eval('('+"+tbnm+"txt+')')");
       eval("tbtp=typeof("+tbnm+");");
          if (tbtp=="undefined" || extkeys(skeys,tbnm)==false){             
            sltable=[];
            eval ("localStorage."+tbnm+"=JSON.stringify(sltable, null, 2)");
          }else{
            eval ("tmptable="+tbnm+";");     
            sltable=[];
            sltable=deletex(cdts,tmptable,tbnm);          
           eval ("localStorage."+tbnm+"=JSON.stringify(sltable, null, 2)");
          }
       return sltable;
       break;
     case "insert":
       tbtp="";
       eval (tbnm+"txt=localStorage."+tbnm);
       eval (tbnm+"=eval('('+"+tbnm+"txt+')')");
       eval("tbtp=typeof("+tbnm+");");
       if (tbtp=="undefined"){
            eval(tbnm+"=[]");            
       }else{
       }
      if (extkeys(skeys,tbnm)==false){
        eval("tmptb="+tbnm+";");
        return tmptb;
      }else{
          ptskey=skeys.split(",");
          ptsval=vals.split(",");
          totpt=ptskey.length;
          eval("extpush=extdftval(skeys,TBFRM"+tbnm+")");
          fmpush="";
          for (i=0;i<totpt;i++){
            fmpush=fmpush+"\""+ptskey[i]+"\":\""+killquote(ptsval[i])+"\",";
          }
           if (extpush!=""){
              extpush=killlasttring(extpush);
            }
          fmpush=fmpush+extpush;
          fmpush="{"+fmpush+"}";
          eval (tbnm+".push("+fmpush+")");
          eval("tmptb="+tbnm+";");
          eval ("localStorage."+tbnm+"=JSON.stringify("+tbnm+", null, 2)");
          return tmptb;
       }
       break;
     case "update":
       tbtp="";       
       //console.log("tbnm-"+tbnm+"-skvs-"+skvs+"cdts-"+cdts);
       eval ("xtxt=localStorage."+tbnm+";");
       //console.log("xtxt=localStorage."+tbnm+";");
       //console.log("xtxt-"+xtxt);
       eval ("tmptable=eval('('+xtxt+')');");
       tbtp=typeof(tmptable);       
       //console.log("tbtp-"+tbtp);
          if (tbtp=="undefined"){
             return [];
          }else{
            sltable=updatex(cdts,tmptable,tbnm,skvs);
            eval ("localStorage."+tbnm+"=JSON.stringify(sltable, null, 2)");
            return sltable;
          }
       break;
   }
  }
}
function killquote(xstr){
  if (substr(xstr,0,1)=="'"){
    tmpx=substr(xstr,1,strlen(xstr)-2);
    tmpx=str_replace("undefined","",tmpx);
    return tmpx;
  }else{
    tmpx=str_replace("undefined","",xstr);
    return tmpx;
  }
}
function extkeys(skx,tbnm){
  eval ("tmpfrm=TBFRM"+tbnm+";");
  if (typeof(tmpfrm)!="undefined"){
    k=1;
    for (i=0;i<tmpfrm.length;i++){
      kkk="x,"+skx+",";
      if (kkk.indexOf(","+tmpfrm.vls[i].COLUMN_NAME+",")>0){
      }else{
        k=k*0;
      }
    }
  }else{
    k=0;
  }
  if (k==1){
    return true;
  }else{
    return false;
  }  
}
function deletex(cdty,tbdata,tbnmy){
    z=0;
    etxt="if ([tbcdts]){z〓1;}else{z〓0;};";
    if (cdty==""){
      cdty=" 1>0 ";
    }
    etxt=etxt.replace("[tbcdts]",cdty);
    xtxt=cdty;
    etxt=etxt.replace(/=/g,"==");
    xtxt=xtxt.replace(/=/g,"==");
    etxt=etxt.replace(/〓/g,"=");
    xtxt=xtxt.replace(/〓/g,"=");
    etxt=etxt.replace(" and "," && ");
    xtxt=xtxt.replace(" and "," && ");
    etxt=etxt.replace(" or "," || "); 
    xtxt=xtxt.replace(" or "," || "); 
    eval("tmpfrm=TBFRM"+tbnmy+";");
   tmps=[];
   if (cdty.replace(/ /,"")==""){
     return [];
   }else{
    for (i=0;i<tbdata.length;i++){
      z=0;
      detxt=etxt;
      for (j=0;j<tmpfrm.totrcd;j++){
        detxt=detxt.replace(tmpfrm.vls[j].COLUMN_NAME,"tbdata[i]."+tmpfrm.vls[j].COLUMN_NAME);
      }
     if (detxt.indexOf("order")>0){
       eval(qian(detxt,"order")+")"+hou(detxt,")"));
     }else{
       eval(detxt);
     }
        if (z==1){          
        }else{
          tmps.push(tbdata[i]);
        }
     }
     return tmps;
   }
  
}
function updatex(cdty,tbdata,tbnmy,sets){
    z=0;
    etxt="if ([tbcdts]){z〓1;}else{z〓0;};";
    if (cdty==""){
      cdty=" 1>0 ";
    }
    etxt=etxt.replace("[tbcdts]",cdty);
    xtxt=cdty;
    etxt=etxt.replace(/=/g,"==");
    xtxt=xtxt.replace(/=/g,"==");
    etxt=etxt.replace(/〓/g,"=");
    xtxt=xtxt.replace(/〓/g,"=");
    etxt=etxt.replace(" and "," && ");
    xtxt=xtxt.replace(" and "," && ");
    etxt=etxt.replace(" or "," || "); 
    xtxt=xtxt.replace(" or "," || ");   
    eval("tmpfrm=TBFRM"+tbnmy+";");  
    for (j=0;j<tmpfrm.totrcd;j++){
      sets=sets.replace(tmpfrm.vls[j].COLUMN_NAME,"tbdata[i]."+tmpfrm.vls[j].COLUMN_NAME);
    }  
    sets=sets+";";
   tmps=[];
 if (cdty.replace(/ /,"")==""){
    for (i=0;i<tbdata.length;i++){           
      eval(sets);      
    }
   return tbdata;
 }else{
   for (i=0;i<tbdata.length;i++){
      z=0;
      detxt=etxt;
      for (j=0;j<tmpfrm.totrcd;j++){
        detxt=detxt.replace(tmpfrm.vls[j].COLUMN_NAME,"tbdata[i]."+tmpfrm.vls[j].COLUMN_NAME);
      }
     if (detxt.indexOf("order")>0){
       eval(qian(detxt,"order")+")"+hou(detxt,")"));
     }else{
       eval(detxt);
     }
        if (z==1){
          eval(sets);
        }else{
        }
    }
   return tbdata;
 }
  
 }
function selectx(cdty,tbdata,tbnmy){
    z=0;
    etxt="if ([tbcdts]){z〓1;}else{z〓0;};";
    if (cdty==""){
      cdty=" 1>0 ";
    }
    etxt=etxt.replace("[tbcdts]",cdty);
    xtxt=cdty;
    etxt=etxt.replace(/=/g,"==");
    xtxt=xtxt.replace(/=/g,"==");
    etxt=etxt.replace(/〓/g,"=");
    xtxt=xtxt.replace(/〓/g,"=");
    etxt=etxt.replace(" and "," && ");
    xtxt=xtxt.replace(" and "," && ");
    etxt=etxt.replace(" or "," || "); 
    xtxt=xtxt.replace(" or "," || "); 
    eval("tmpfrm=TBFRM"+tbnmy+";");
   tmps=[];
  if (cdty.replace(/ /,"")==""){
    return tbdata;
  }else{
   for (i=0;i<tbdata.length;i++){
      z=0;
      detxt=etxt;
      for (j=0;j<tmpfrm.totrcd;j++){
        detxt=detxt.replace(tmpfrm.vls[j].COLUMN_NAME,"tbdata[i]."+tmpfrm.vls[j].COLUMN_NAME);
        xtxt=xtxt.replace(tmpfrm.vls[j].COLUMN_NAME,"tbdata[i]."+tmpfrm.vls[j].COLUMN_NAME);
      }
     
     if (detxt.indexOf("order")>0){
       eval(qian(detxt,"order")+")"+hou(detxt,")"));
       dxtxt=qian(xtxt,"order")+hou(xtxt,")");;
     }else{
       eval(detxt);
     }
        if (z==1){
          tmps.push(tbdata[i]);
        }else{
        }
    }
    return tmps;
  }
 }
function extdftval(sks,frmtb){
  fmek="";
  skkx=",,"+sks;
  for (j=0;j<frmtb.totrcd;j++){
    if (skkx.indexOf(frmtb.vls[j].COLUMN_NAME)>0){
    }else{
      tmpk=frmtb.vls[j].COLUMN_NAME;
    //  console.log("sf-"+frmtb.vls[j].sysshowfun);
      tmdft=tostring(frmtb.vls[j].sysshowfun);
      tmdft=tostring(tmdft);
      if (tmdft==""){
        if (frmtb.vls[j].COLUMN_NAME=="SNO"){
           fmek=fmek+"\""+frmtb.vls[j].COLUMN_NAME+"\":\""+randomWord(false,5)+"\",";
         }else{
           fmek=fmek+"\""+frmtb.vls[j].COLUMN_NAME+"\":\"\",";
         }
      }else{
         dftv=hou("x"+tmdft,"|");  
      //  console.log("dftv="+dftv);         
         $thusvalue="";
         eval(dftv);
         if ($thusvalue==undefined){
            $thusvalue="";
          }
        //switch        
         fmek=fmek+"\""+frmtb.vls[j].COLUMN_NAME+"\":\""+$thusvalue+"\",";
      }
    }
  }
  return fmek;
}
function UX($asqlstr){
  $conn=mysql_connect(gl(),glu(),glp());
  return updatings($conn,glb(),$asqlstr,"utf8");
}
function SX($asqlstr){
  $conn=mysql_connect(gl(),glu(),glp());
  return selecteds($conn,glb(),$asqlstr,"utf8","");
}
function SY(sqlstr){
 if (sqlstr.indexOf(" where")>0){
 }else{
   sqlstr=sqlstr+" where 1>0 ";
 }
  //console.log("sqlstr-"+sqlstr);
 if (sqlstr!=""){
   if (sqlstr.indexOf("elect ")>0 && sqlstr.indexOf(" from ")>0){
     skeys=qian(hou(sqlstr,"elect ")," from ");
     tbnm=qian(hou(sqlstr," from ")," where ");
     if (sqlstr.indexOf(" where ")>0){
       cdts=hou(sqlstr," where ");
     }else{
       cdts="";
     }
     tbnm=tbnm.replace(/ /g,"");
     skeys=skeys.replace(/ /g,"");
   }
    eval("frmtp=typeof(TBFRM"+tbnm+");");
    if (frmtp=="undefined"){
      x=newjsfile("/DNA/EXF/anyfuns.php?fid=tabcol&tablename="+tbnm);
    }   
       eval (tbnm+"txt=localStorage."+tbnm);
       eval (tbnm+"=eval('('+"+tbnm+"txt+')')");       
       eval("tbtp=typeof("+tbnm+");");
          if (tbtp=="undefined"){
             return [];
          }else{
            eval ("tmptable="+tbnm+";");     
            sltable=[];
            //console.log("cdts-"+cdts);
            sltable=selectx(cdts,tmptable,tbnm);
          }
       return sltable;
  }
}
function fmsx(tbnm,tkeys,stable){
  fmx="";
  if (tkeys=="*"){
    eval("tkeys="+tbnm+"akb[\"COLUMN\"][\"ALLKEY\"];");    
  }else{   
  }
  ptk=tkeys.split(",");
  for (j=0;j<stable.length;j++){
    fmy="";
    for (i=0;i<ptk.length;i++){
     eval("fmy=fmy+stable[j]."+ptk[i]+"+',';");
    }
    fmy=killlasttring(fmy);
    fmy=fmy.replace(/,/g,"#-#");
    fmx=fmx+fmy+";";
  }    
  fmx=fmx.replace(/;/g,"#/#");
  tkeys=tkeys.replace(/,/g,"#-#");
  return tkeys+"#/#"+fmx;
}
function anyvalue(fullresult,keynm,sqc)
{
  keyname=qian(fullresult,"#/#");
  partkn=keyname.split("#-#");
  partresult=fullresult.split("#/#");
  countprs=partresult.length;
  countkn=partkn.length;
  tempkey=0;
  for (x=0;x<=countkn-1;x++)
   {
    if (partkn[x]==keynm)
    {
     tempkey=x;
     };
   };
  sqcresult=partresult[sqc+1];
  partpart=sqcresult.split("#-#");
  return partpart[tempkey];
}
function GetRequest(){
  var url = location.search; //获取url中"?"符后的字串
  var theRequest = new Object();
  if (url.indexOf("?") != -1) {
    var str = url.substr(1);
    strs = str.split("&");
    for(var i = 0; i < strs.length; i ++) {
      theRequest[strs[i].split("=")[0]] = unescape(strs[i].split("=")[1]);
    }
  }
  return theRequest;
}

function GetUrlParam(paraName) {
　　　　var url = document.location.toString();
　　　　var arrObj = url.split("?");

　　　　if (arrObj.length > 1) {
　　　　　　var arrPara = arrObj[1].split("&");
　　　　　　var arr;

　　　　　　for (var i = 0; i < arrPara.length; i++) {
　　　　　　　　arr = arrPara[i].split("=");

　　　　　　　　if (arr != null && arr[0] == paraName) {
　　　　　　　　　　return arr[1];
　　　　　　　　}
　　　　　　}
　　　　　　return "";
　　　　}
　　　　else {
　　　　　　return "";
　　　　}
　　}

function qian(str,qq){
  tpit=typeof(str);
 if (tpit === 'string'){
  var fpos=str.indexOf(qq);
  if (fpos>0){
    return str.substring(0,fpos);
  }else{
    if (fpos==0){
      return "";
    }else{
      return str;
    }
  };
 }else{
   return "";
 }
}
function hou(str,hh){
  tpit=typeof(str);
   if (tpit === 'string'){
    var fpos=str.indexOf(hh);
    var flen=hh.length;
    var slen=str.length;
    if (fpos>0){
      return str.substring(fpos+flen,slen);
    }else{
      if (fpos==0){
        return "";
      }else{
       return str;
      }
    };
   }else{
      return "";
   }
}
function killlastsplit(strx,sx){
  tpit=typeof(strx);
if (tpit === 'string'){
 if (("x"+strx).indexOf(sx)>0){
  ptstrx=strx.split(sx);
  totpart=ptstrx.length;
  fmstrx="";
  for (var kx=0;kx<$totpart-2;$kx++){
   fmstrx=fmstrx+ptstrx[kx]+sx; 
  };
  return fmstrx;
 }else{
  return "";
 }
}else{
  return "";
}
}
function getlastsplit(strx,sx){
tpit=typeof(strx);
if (tpit === 'string'){
 if (("x"+strx).indexOf(sx)>0){
  ptstrx=strx.split(sx);
  totpart=ptstrx.length;
  return ptstrx[totpart-1];
 }else{
  return "";
 };
}else{
  return "";
}
}
function killlasttring(strx){
  tpit=typeof(strx);
 if (tpit === 'string'){
  if (strx.length>0){
   strx=strx.substring(0,strx.length-1);
  };
  return strx;
 }else{
  return "";
 }
}
function killlast3(strx){
  tpit=typeof(strx);
 if (tpit === 'string'){
  if (strx.length>0){
   strx=strx.substring(0,strx.length-3);
  };
  return strx;
 }else{
  return "";
 }
}
function killfirsttring(strx){
   tpit=typeof(strx);
 if (tpit === 'string'){
   if (strx.length>0){
   strx=strx.substring(1,strx.length-1);
   };
   return strx;
 }else{
   return "";
 }
}
dec2utf8 = function (arr) {
    if (typeof arr === 'string') {
        return arr;
    }

    var unicodeString = '', _arr = arr;
    for (var i = 0; i < _arr.length; i++) {
        var one = _arr[i].toString(2);
        var v = one.match(/^1+?(?=0)/);

        if (v && one.length === 8) {
            var bytesLength = v[0].length;
            var store = _arr[i].toString(2).slice(7 - bytesLength);

            for (var st = 1; st < bytesLength; st++) {
                store += _arr[st + i].toString(2).slice(2)
            }

            unicodeString += String.fromCharCode(parseInt(store, 2));
            i += bytesLength - 1;
        } else {
            unicodeString += String.fromCharCode(_arr[i]);
        }
    }
    return unicodeString
};
function hhth(strx){
  strx=strx.replace(/-r-n/g,'\r\n');
  strx=strx.replace(/`/g,'\'');    
  strx=strx.replace(/\'/g,'\'');
  strx=strx.replace(/\\`/g,'\'');   
  return strx;
}
function hex2a(hexx) {
    var hex = hexx.toString();//force conversion    
    var str_list = [];
    for (var i = 0; (i < hex.length && hex.substr(i, 2) !== '00'); i += 2)
        str_list.push(parseInt(hex.substr(i, 2), 16));    
    return dec2utf8(str_list);
}
function a2hex(str){
　if(str === "")
　　return "";
　　var hexCharCode = [];
　　//hexCharCode.push("0x"); 
　　for(var i = 0; i < str.length; i++) {
　　　　hexCharCode.push((str.charCodeAt(i)).toString(16));
　　}
　　return hexCharCode.join("");
  }
function fmduoselect(fk,fv,pv,fid,fcls,fcdes){
 if (fk.indexOf("/")>0){
 ptfk=fk.split("/");
 }else{
 ptfk=fk.split(",");
 };
 if (fv.indexOf("/")>0){
 ptfv=fv.split("/");
 }else{
 ptfv=fv.split(",");
 };
 if (ptfk.length<=15){
 var fm="";
 if (ptfk.length>0){
    for (fi=0;fi<ptfk.length;fi++){
      if (("-"+pv).indexOf(ptfv[fi])>0){
      fm=fm+"<label><input type=\"checkbox\" name=\""+fid+"\" class=\""+fcls+"\" "+fcdes+" value=\""+ptfv[fi]+"\" checked>"+ptfk[fi]+"</label>";
      }else{
      fm=fm+"<label><input type=\"checkbox\" name=\""+fid+"\" class=\""+fcls+"\" "+fcdes+" value=\""+ptfv[fi]+"\">"+ptfk[fi]+"</label>";
      };
    };
  };
 return fm;

 }else{

 };
}
function localshort($stid,$page,$pagenum){  
  sttype="";
  //eval("shortdft=STDFT"+$stid+";");
  //eval ("sttype=typeof(shortdft);");  
 if (sttype!="undefined"){  
   //$tbnmm=shortdft.vls[0].tablename;
   //$tbkiss=shortdft.vls[0].showkeys;
   //$flx=SY("select "+$stbkis+" from "+$tbnm+" where "+$tbcdts+$ordercdt);
   //$flrst=fmsx($tbnm,$stbkis,$flx);
   //$x=tablist($flrst,$tbnmm,$tbkiss,countresult($flrst),1,$stid);
   return "";
 }else{
   return "";
 }
}
function anyjson(url,tbnm,page,xid){
  $jsonx=new Array();
  bkdata=ajaxhtmlpost(url+"&datatype=json","");
  datax=eval('('+bkdata+')');  
  sxy=jsontosx(datax);
  $tabinfo=tablist(sxy,tbnm,datax.keys,datax.totrcd,page,xid);
  $x=$tabinfo["html"];
  $jsonx["totrcd"]=datax.totrcd;
  $jsonx["html"]=$x;
  $jsonx["script"]=$tabinfo["tmpdtx"];
  $jsonx["keys"]=datax.keys;
  $jsonx["sxy"]=sxy;
  $jsonx["url"]=url;  
  return $jsonx;
}
function layrender(){
 layui.use('form', function(){
   var form = layui.form;//高版本建议把括号去掉，有的低版本，需要加()
   form.render();
  });
}
function formselect($opname,$opvalue,$prevalue,$selectselfname,$selectselfclass,$htmcod){
 tmpvx="";
 smd5=$opname+$opvalue+$prevalue+$selectselfname+$selectselfclass+$htmcod;
 smd5="a"+smd5.MD5();
eval('tmpvx=sessionStorage.'+smd5+';');
if (tmpvx!="" && tmpvx!=undefined){
     return tmpvx;
 }else{
 $partopname=explode(",",$opname);
 $partopvalue=explode(",",$opvalue);
 $totopnm=count($partopname);
 $totopvl=count($partopvalue);
 $sfxz=0;
 $formselects="";
  $onlyone="";
  if  ($selectselfclass=="readonly"){
     $htmcod="style=\"display:none;\"";
  }
 if ($totopnm==$totopvl){
   if ($htmcod.indexOf("nchange")>0){
     $lf=" lay-filter=\"brickType\" ";
   }else{
     $lf="";
   }
  $formselects=$formselects+"<SELECT id=\""+$selectselfname+"\" name=\""+$selectselfname+"\" "+$htmcod+$lf+" lay-search class=\""+$selectselfclass+"\">\r\n";
       if  ($selectselfclass=="readonly"){
         $onlyone="无选项";
       }else{
         $formselects=$formselects+"<option value=\".\" >无选项</option>\r\n";         
       };
   for ($tempk=0;$tempk<=$totopnm-1;$tempk++){
     if ($partopvalue[$tempk]==$prevalue || $partopname[$tempk]==$prevalue) {
       $sfxz=$sfxz+1;  
       $formselects=$formselects+"<option value=\""+$partopvalue[$tempk]+"\" selected>"+$partopname[$tempk]+"</option>\r\n";
       $onlyone=$partopname[$tempk];
       }
     else{
        if  ($selectselfclass=="readonly"){
        }else{
          $formselects=$formselects+"<option value=\""+$partopvalue[$tempk]+"\" >"+$partopname[$tempk]+"</option>\r\n";         
        };  
       };
   };
     if  ($selectselfclass=="readonly"){
       $formselects=$formselects+"</SELECT>"+$onlyone+"\r\n";
     }else{
       $formselects=$formselects+"</SELECT>\r\n";
     }
 };    
  eval('sessionStorage.'+smd5+'=$formselects;');
  return $formselects;  
}
 
}
function formselecty($opname,$opvalue,$prevalue,$selectselfname,$selectselfclass,$htmcod)
{
  $partopname=explode(",",$opname);
 $partopvalue=explode(",",$opvalue);
 $totopnm=count($partopname);
 $totopvl=count($partopvalue);
 $sfxz=0;
 $formselects="";
  $onlyone="";  
 if ($totopnm==$totopvl){
 $formselects=$formselects+"<select id=\""+$selectselfname+"\" name=\""+$selectselfname+"\" "+$htmcod+"  multiple lay-search lay-case class=\""+$selectselfclass+"\">\r\n";
       if  ($selectselfclass=="readonly"){
         $onlyone="无选项";
       }else{
         $formselects=$formselects+"<option value=\".\" >无选项</option>\r\n";         
       };
   for ($tempk=0;$tempk<=$totopnm-1;$tempk++){
     if ($partopvalue[$tempk]==$prevalue || $partopname[$tempk]==$prevalue) {
       $sfxz=$sfxz+1;  
       $formselects=$formselects+"<option value=\""+$partopvalue[$tempk]+"\" selected>"+$partopname[$tempk]+"</option>\r\n";
       $onlyone=$partopname[$tempk];
       }
     else{
        if  ($selectselfclass=="readonly"){
        }else{
          $formselects=$formselects+"<option value=\""+$partopvalue[$tempk]+"\" >"+$partopname[$tempk]+"</option>\r\n";         
        };  
       };
   };

 };
 return $formselects;

}
function listenclsduo(){
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
	         eval(tmpq+"='';");
		  };
		  for (i=0;i<totx;i++){
             tmpvx="";
             tmpq="";
             tmpv="";
             tmpz="";
             tmpvx=$(slctx[i]).attr("data-value");
             tmpq=qian(tmpvx,"--");
             tmpv=hou(tmpvx,"--");
             eval(tmpq+"="+tmpq+"+'"+tmpv+",';");
             eval("tmpz="+tmpq+";");
	         $("#"+tmpq).val(onlyone(tmpz,","));
		  };
		  var tmpcss=$(this).attr("class");
          tmpvb=$(this).attr("data-value");
          tmpbq=qian(tmpvb,"--");
          tmpbv=hou(tmpvb,"--");
		  if (tmpcss.indexOf("selected")>0){
             eval(tmpbq+"="+tmpbq+".replace('"+tmpbv+",','');");
             eval(tmpbq+"="+tmpbq+".replace('"+tmpbv+",','');");
             eval("tmpz="+tmpbq);
             $("#"+tmpbq).val(onlyone(tmpz,","));
             }else{
              eval("tpof=typeof("+tmpbq+");");
              if (tpof=="object"){
               eval(tmpbq+"='';");
              }
             eval(tmpbq+"="+tmpbq+"+'"+tmpbv+",';");
             eval("tmpz="+tmpbq+";");
             $("#"+tmpbq).val(onlyone(tmpz,","));
		  };
      });
      return true;
}
function formselectx($opname,$opvalue,$prevalue,$selectselfname,$selectselfclass,$htmcod){
 tmpvx="";
 smd5=$opname+$opvalue+$prevalue+$selectselfname+$selectselfclass+$htmcod;
 smd5="a"+smd5.MD5();
eval('tmpvx=sessionStorage.'+smd5+';');
if (tmpvx!="" && tmpvx!=undefined){
     return tmpvx;
 }else{
 $partopname=explode(",","无选项,"+$opname);
 $partopvalue=explode(",",".,"+$opvalue);
 $totopnm=count($partopname);
 $totopvl=count($partopvalue);
 $sfxz=0;
 $formselects="\r\n";
 if ($totopnm==$totopvl){
      $formselects=$formselects+"<select  name=\"sl"+$selectselfname+"\"  "+$htmcod+" class=\""+$selectselfname+"\" lay-ignore=\"1\"  style=\"float:right;width:0px;height:0px;\" multiple=\"multiple\">\r\n";
      $formselects=$formselects+"<optgroup label=\""+$selectselfname+"\"  >\r\n";
   for ($tempk=0;$tempk<=$totopnm-1;$tempk++){
     if (strpos("xx-"+$prevalue+",",$partopvalue[$tempk]+",")>0){
       $sfxz=$sfxz+1;  
       $formselects=$formselects+"<option value=\""+$selectselfname+"--"+$partopvalue[$tempk]+"\" selected >"+$partopname[$tempk]+"</option>\r\n";
     }else{
        $formselects=$formselects+"<option value=\""+$selectselfname+"--"+$partopvalue[$tempk]+"\"  >"+$partopname[$tempk]+"</option>\r\n";
     };
   };
       $formselects=$formselects+"</optgroup>\r\n</select>\r\n";
 }; 
  eval('sessionStorage.'+smd5+'=$formselects;');
  return $formselects;
 }
}
function fmselect(fk,fv,pv,fid,fcls,fdes,fcdes){
 if (fk.indexOf("/")>0){
 ptfk=fk.split("/");
 }else{
 ptfk=fk.split(",");
 };
 if (fv.indexOf("/")>0){
 ptfv=fv.split("/");
 }else{
 ptfv=fv.split(",");
 };
 if (ptfk.length==1 ){
   fm="";
   fm=fm+"<select id=\""+fid+"\" class=\""+fcls+"\" "+fdes+"><option value=\""+fv+"\" selected >"+fk+"</option></select>";
   return fm;
 }else{
  var fm="<select id=\""+fid+"\" class=\""+fcls+"\" "+fdes+">";
 if (ptfk.length>0){
    for (fi=0;fi<ptfk.length;fi++){
      if (pv==ptfv[fi] || pv==ptfk[fi]){
       fm=fm+"<option value=\""+ptfv[fi]+"\" selected >"+ptfk[fi]+"</option>";
      }else{
       fm=fm+"<option value=\""+ptfv[fi]+"\">"+ptfk[fi]+"</option>";
      };//if pv
    };//if fi
  };//if ptfk
   fm=fm+"<option value=\".\">无选项</option>";
  return fm+"</select>";
 };//if length=1
}//fun
function fmcheckx(fk,fv,pv,fid,fcls,fdes,fcdes){
 if (fk.indexOf("/")>0){
 ptfk=fk.split("/");
 }else{
 ptfk=fk.split(",");
 };
 if (fv.indexOf("/")>0){
 ptfv=fv.split("/");
 }else{
 ptfv=fv.split(",");
 };
 if (ptfk.length==1 ){
      var fm="";          
      fm=fm+"<label><input type=\"radio\" id=\""+fid+"\" name=\""+fid+"\" class=\""+fcls+"\" "+fcdes+" value=\""+fv+"\" checked>"+fk+"</label>";          
      return fm;

 }else{
    for (fi=0;fi<ptfk.length;fi++){
      if (pv==ptfv[fi] || pv==ptfk[fi]){
      fm=fm+"<label><input type=\"radio\" name=\""+fid+"\" class=\""+fcls+"\" "+fcdes+" value=\""+ptfv[fi]+"\" checked>"+ptfk[fi]+"</label>";
      }else{
      fm=fm+"<label><input type=\"radio\" name=\""+fid+"\" class=\""+fcls+"\" "+fcdes+" value=\""+ptfv[fi]+"\">"+ptfk[fi]+"</label>";
      };
    };//for
    return fm;
 };//length
}//fun
function fmipt(slc,pv,fid,fcls,fdes){
 var fmx="";
 if (slc==""){
  fmx="<input id=\""+fid+"\" class=\""+fcls+"\" value=\""+pv+"\" "+fdes+">"; 
 }else{
  fmx=fmselect(qian(slc,"|"),hou(slc,"|"),pv,fid,fcls,fdes.replace("size=",""));
 };
 return fmx;
}

function mkstr(hstr){
  if (hstr==null || hstr==undefined || hstr==""){
    return "";
   }else{
   fmtxt=hstr;
   fmtxt=fmtxt.replace(/'/g,"^");
   fmtxt=fmtxt.replace(/&amp;/g,"δ");
   fmtxt=fmtxt.replace(/&/g,"δ");
   fmtxt=fmtxt.replace(/\+/g,"＋");
   fmtxt=fmtxt.replace(/=/g,"＝");
   fmtxt=fmtxt.replace(/\?/g,"？");
   fmtxt=fmtxt.replace(/\\/g,"↘");
//   fmtxt=fmtxt.replace(/\r\n/g,"卍");
   fmtxt=fmtxt.replace(/[\r\n][\r\n]/g,"卍");
   fmtxt=fmtxt.replace(/[\r\n]/g,"卍");   
   return fmtxt;
   };
}
function unstr(strx){
  strx=strx.replace(/-r-n/g,"\r\n");
  strx=strx.replace(/-\/-\//g,"");
  strx=strx.replace(/\\'/g,"'");
  return strx;
}
 
   function topage(url){
    var pghtml=ajaxhtmlpost(url,'');
    $('#content').html(pghtml);
   }
   function page(url){
    location.href=url;
   }
function fmslcthtm(clstext,prev,keynm,clss){
 if (clstext.indexOf('|')>0){
  var nowcls="";
  var nowcls=hou(clss,keynm+":");
  var nowcls=qian(nowcls,";");
  var nowhtml="";
  var nowhtml=hou(clss,keynm+"html:");
  var nowhtml=hex2a(qian(nowhtml,";"));
  return fmselect(qian(clstext,"|"),hou(clstext,"|"),prev,keynm,nowcls,nowhtml);
 };
 if (clstext.indexOf('/')>0){
  var nowcls="";
  var nowcls=hou(clss,keynm+":");
  var nowcls=qian(nowcls,";");
  var nowhtml="";
  var nowhtml=hou(clss,keynm+"html:");
  var nowhtml=hex2a(qian(nowhtml,";"));
  return fmduoselect(qian(clstext,"/"),hou(clstext,"/"),prev,keynm,nowcls,"");
 };
 if (clstext.indexOf('|')<=0 && clstext.indexOf(']')>0){
  var domain = document.domain;
  var nclstxt=ajaxhtmlpost("/DNA/EXF/anyshort.php?stid="+clstext+"&dttp=clstxt",nowhtml);
  var nowcls="";
  var nowcls=hou(clss,keynm+":");
  var nowcls=qian(nowcls,";");
  var nowhtml="";
  var nowhtml=hou(clss,keynm+"html:");
  var nowhtml=hex2a(qian(nowhtml,";"));
  return fmselect(qian(nclstxt,"|"),hou(nclstxt,"|"),prev,keynm,nowcls,nowhtml);
 };
} 
function getchkvalue(tagnm){
      //获取所有的input标签

      var input = document.getElementsByName(tagnm);
      var str="";

      for (var i = 0; i < input.length; i++){
        var obj = input[i];
        //判断是否是checkbox并且已经选中
        if (obj.type == "checkbox" && obj.checked) 
        {
          var code = obj.value;//获取checkbox的值
          str=str+code+",";
        }
      }
     return str;
  }
function getduovalue(tagnm){
      //获取所有的input标签
      var input = document.getElementsByName(tagnm);
      var str="";
      for (var i = 0; i < input.length; i++){
        var obj = input[i];
        //判断是否是checkbox并且已经选中
        if (obj.checked) 
        {         
          var code = obj.value;
          str=str+code+",";
        }
      }
     return killlasttring(str);
  }
function getduocolumn(colm){
      //获取所有的input标签
      var input = document.getElementsByName("chksno");
      var str="";
      for (var i = 0; i < input.length; i++){
        var obj = input[i];
        //判断是否是checkbox并且已经选中
        if (obj.checked) 
        {         
          var code = obj.value;
          str=str+$("#"+colm+code).html()+",";
        }
      }
     return killlasttring(str);
  }
function putvalue(url,ocls){
var pgdata=ajaxhtmlpost(url,"");
pgo=eval('('+pgdata+')');
var pgk=pgo.ktps;
//alert(pgk);
var pgv=pgo.vls;
var totk=pgk.length;
eval("var sno=pgv[0].SNO");
 for (i=0;i<totk;i++){
   var knm=pgk[i].keyname;
   var newhtml="";
   var tvl="";
   if (knm!=="SNO"){
     if (pgk[i].jshow!==""){
        var newhtml=pgk[i].jshow;
           if (newhtml.indexOf("TYPE_HEX")>0){
             newhtml=hou(newhtml,"TYPE_HEX-");
             newhtml=hou(newhtml,"TYPE_HEX:");
             newhtml=hex2a(newhtml);
           }else{
           };

           eval("var tvl=pgv[0]."+knm+"");
           newhtml=newhtml.replace('[thisvalue]',tvl);
           newhtml=newhtml.replace('[thisvalue]',tvl);
           newhtml=newhtml.replace('[thissno]',pgv[0].SNO);
           newhtml=newhtml.replace('[thissno]',pgv[0].SNO);
           newhtml=newhtml.replace('[thiskey]',knm);
           newhtml=newhtml.replace('[thiskey]',knm);
           newhtml=newhtml.replace('[thisktp]',pgk[i].datatype);
           newhtml=newhtml.replace('[thisktp]',pgk[i].datatype);
           newhtml=newhtml.replace(/{/g,'<');
           newhtml=newhtml.replace(/}/g,'>');

           var pgktxt=pgk[i].clstxt;

           if (pgktxt!==""){

             if (pgktxt.indexOf("TYPE_HEX")>0){
                pgktxt=hou(pgktxt,"TYPE_HEX:");
                pgktxt=hou(pgktxt,"TYPE_HEX-");
                pgktxt=hex2a(pgktxt);

                newhtml=newhtml.replace('[selecthtm]',fmslcthtm(pgktxt,tvl,knm,ocls));
              }else{
                newhtml=newhtml.replace('[selecthtm]',fmslcthtm(pgktxt,tvl,knm,ocls));
              };
           };
          $('#'+knm+sno+'div').html(newhtml);
           var pgktxt="";
      }else{//jshow
          eval("var tvl=pgv[0]."+knm+"");
           var pgktxt=pgk[i].clstxt;
           if (pgktxt!==""){
             if (pgktxt.indexOf("TYPE_HEX")>0){
                pgktxt=hou(pgktxt,"TYPE_HEX:");
                pgktxt=hou(pgktxt,"TYPE_HEX-");
                pgktxt=hex2a(pgktxt);
                newhtml=fmslcthtm(pgktxt,tvl,knm,ocls);
                // alert(pgktxt);
              }else{
                newhtml=fmslcthtm(pgktxt,tvl,knm,ocls);
                 //alert(pgktxt);
              };


            $('#'+knm+sno+'div').html(newhtml);
             $("#p_"+knm+sno).attr("selected",true);
             //alert(newhtml);
           }else{
            $('#p_'+knm+sno).val(tvl);
           };
      };//jshow
   };//sno
 };//for

}

function savevalue(url){
var pgdata=ajaxhtmlpost(url,"");
pgo=eval('('+pgdata+')');
var pgk=pgo.ktps;
var pgv=pgo.vls;
var pgallk=pgo.keys;
var tbnm=pgo.tbname;
var totk=pgk.length;
 var sno=pgv[0].SNO;
  if ((sno*1)==0){
   sno="0";
  };
   var fmpst="";
 for (i=0;i<totk;i++){

   var knm=pgk[i].keyname;
   var newhtml="";
   var tvl="";
   
   if (knm!=="SNO"){
    var cltxt=pgk[i].clstxt;
      if (cltxt!==""){
        if (cltxt.indexOf("/")>0){
         var tvl=getchkvalue(knm);
         //alert(tvl);
        };
        if (cltxt.indexOf("|")>0 ){
           qttxt=qian(cltxt,"|");
           if (qttxt.indexOf(",")>0){
            pttxt=qttxt.split(",");
           };
           if (qttxt.indexOf("/")>0){
            pttxt=qttxt.split("/");
           };
           var totpt=pttxt.length;
           if (totpt<=5){
            eval ("var tvl=$(\"input[name='"+knm+"']:checked\").val()");
           }else{
           };
        };
       if (tvl==""){
        eval("var tvl=$('#p_"+knm+sno+"').val()");
       };
       fmpst=fmpst+"p_"+knm+sno+"="+tvl+"&";
      }else{
       eval("var tvl=$('#p_"+knm+sno+"').val()");
       fmpst=fmpst+"p_"+knm+sno+"="+tvl+"&";
      };
   };
 };
  var domain = document.domain;
  fmpst=fmpst+"love=you";
  svit=ajaxhtmlpost("/DNA/EXF/anyrcv.php?tbnm="+tbnm+"&kies="+pgallk+"&SNO="+sno,fmpst);
  return svit;
}
function choosebyid(eid,evl){
	$("#"+eid).find("option[value='"+evl+"']").attr("selected",true);
}
function Base64() {

    // private property  
    _keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";

    // public method for encoding  
    this.encode = function(input) {
        var output = "";
        var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
        var i = 0;
        input = _utf8_encode(input);
        while (i < input.length) {
            chr1 = input.charCodeAt(i++);
            chr2 = input.charCodeAt(i++);
            chr3 = input.charCodeAt(i++);
            enc1 = chr1 >> 2;
            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
            enc4 = chr3 & 63;
            if (isNaN(chr2)) {
                enc3 = enc4 = 64;
            } else if (isNaN(chr3)) {
                enc4 = 64;
            }
            output = output + _keyStr.charAt(enc1) + _keyStr.charAt(enc2) + _keyStr.charAt(enc3) + _keyStr.charAt(enc4);
        }
        return output;
    }

    // public method for decoding  
    this.decode = function(input) {
        var output = "";
        var chr1, chr2, chr3;
        var enc1, enc2, enc3, enc4;
        var i = 0;
        input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
        while (i < input.length) {
            enc1 = _keyStr.indexOf(input.charAt(i++));
            enc2 = _keyStr.indexOf(input.charAt(i++));
            enc3 = _keyStr.indexOf(input.charAt(i++));
            enc4 = _keyStr.indexOf(input.charAt(i++));
            chr1 = (enc1 << 2) | (enc2 >> 4);
            chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
            chr3 = ((enc3 & 3) << 6) | enc4;
            output = output + String.fromCharCode(chr1);
            if (enc3 != 64) {
                output = output + String.fromCharCode(chr2);
            }
            if (enc4 != 64) {
                output = output + String.fromCharCode(chr3);
            }
        }
        output = _utf8_decode(output);
        return output;
    }

    // private method for UTF-8 encoding  
    _utf8_encode = function(string) {
        string = string.replace(/\r\n/g, "\n");
        var utftext = "";
        for (var n = 0; n < string.length; n++) {
            var c = string.charCodeAt(n);
            if (c < 128) {
                utftext += String.fromCharCode(c);
            } else if ((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            } else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }
        return utftext;
    }

    // private method for UTF-8 decoding  
    _utf8_decode = function(utftext) {
        var string = "";
        var i = 0;
        var c = c1 = c2 = 0;
        while (i < utftext.length) {
            c = utftext.charCodeAt(i);
            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            } else if ((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i + 1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            } else {
                c2 = utftext.charCodeAt(i + 1);
                c3 = utftext.charCodeAt(i + 2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }
        }
        return string;
    }
}
function randomWord(randomFlag, min, max){
    var str = "",
        range = min,
        arr = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
 
    // 随机产生
    if(randomFlag){
        range = Math.round(Math.random() * (max-min)) + min;
    }
    for(var i=0; i<range; i++){
        pos = Math.round(Math.random() * (arr.length-1));
        str += arr[pos];
    }
    return str;
}


function editfile(url){
   var domain = document.domain;
   var nu=url.replace('//'+domain+'/','');
   window.open('/SPEC/EDITOR/editfilex.html?filename='+nu) ;
}
function editfun(fid){
   var domain = document.domain;  
   window.open('/SPEC/EDITOR/editfunx.html?funid='+fid) ;
}

function imgsize(image){
  str=image.substring(22); // 1.需要计算文件流大小，首先把头部的data:image/png;base64,（注意有逗号）去掉。
  equalIndex= str.indexOf("=");//2.找到等号，把等号也去掉
  if(str.indexOf("=")>0) {
   str=str.substring(0, equalIndex);
  }
  strLength=str.length;//3.原来的字符流大小，单位为字节
  size=strLength-(strLength/8)*2;//4.计算后得到的文件流大小，单位为字节
  return size;
 }

function _cttmx(eid){
  return function(){
     tmpbyd=0;
     tmpct=0;
     tmpfun="";         
     eval("sessionStorage.ct"+eid+"=intval(sessionStorage.ct"+eid+")+1;");    
     eval("tmpct=sessionStorage.ct"+eid+";");    
     eval("tmpbyd=sessionStorage.byd"+eid+";");    
     eval("tmpval=sessionStorage.val"+eid+";");        
     if (intval(tmpct)>intval(tmpbyd) || tmpval==1){
       eval("tmpfun=sessionStorage.bydevfun"+eid+";");          
       if (tmpval==1){
         $("#"+eid).html("<a><img src=\"/ORG/BRAIN/images/icon/system/stt1.svg\" style=\"width:20px;height:20px;\">已操作完成</a>");
       }else{
         eval(tmpfun.replace(/@@@@/g,'\\"'));       
       }
       eval("clearInterval(count"+eid+");");
     }    
   return true;
  }
}
function setcounttime(ctid,bydtime,bydevfun){
  allct=sessionStorage.allct;
  if (allct==undefined || allct=="" || allct=="0" || allct==0){
    sessionStorage.allct="1";
    tmpallct="1";
  }else{
    tmpallct=intval(allct)+1;
    sessionStorage.allct=tmpallct;
  };
  eval("sessionStorage.ct"+tmpallct+"='"+ctid+"';");
  eval("sessionStorage.ct"+ctid+"=0;");
  eval("sessionStorage.val"+ctid+"=-1;");
  eval("sessionStorage.byd"+ctid+"="+bydtime+";");  
  eval("sessionStorage.bydevfun"+ctid+"='"+bydevfun.replace(/\'/g,"\\\'")+"';");  
  eval("count"+ctid+"=setInterval(_cttmx('"+ctid+"'),1000);");
}
 function F(fid,fstr,fpst,myunid,mway){   	 
     switch(mway){
       case "refresh":
         baxr=ajaxhtmlpost("/DNA/EXF/anyfun.php?fid="+fid+"&"+fstr,fpst);	 
         $("#"+myunid).html(baxr);       
         return true;
       break;
       case "process":
         oldhtml=$("#"+myunid).html();
         $("#"+myunid).html("<a><img src=\"/ORG/BRAIN/images/tinyload.gif\"></a>");         
         baxr=ajaxposthtml("/DNA/EXF/anyfun.php?fid="+fid+"&"+fstr,fpst,"sessionStorage.val"+myunid+"=1;clearInterval(count"+myunid+");sessionStorage.allct=intval(sessionStorage.allct)-1;$('#"+myunid+"').html('<a><img src=\"/ORG/BRAIN/images/icon/system/stt1.svg\" style=\"width:20px;height:20px;\">已操作完成</a>');");	                   
         z=setcounttime(myunid,30,"$(\"#"+myunid+"\").html(\"<a>超时-</a>"+oldhtml.replace(/"/g,'@@@@')+"\");");
         return true;
       break;
       case "alert":
         baxr=ajaxhtmlpost("/DNA/EXF/anyfun.php?fid="+fid+"&"+fstr,fpst);	 
        if (baxr*1==1 || baxr.indexOf('uccess')>0  || baxr.indexOf('UCCESS')>0  || baxr.indexOf('okay')>0){
         Notiflix.Notify.Success(fid+'操作成功'); 
        }else{
         Notiflix.Notify.Failure(fid+'操作失败,代码:'+data); 
         console.log(fid+'操作失败,代码:'+data);
        };       
        return true;
       break;
       default:         
         baxr=ajaxhtmlpost("/DNA/EXF/anyfun.php?fid="+fid+"&"+fstr,fpst);	
         return baxr;
     }
 }
 function V(id,vlx){
	if (vlx=="()"){
     var ysx=$("input[name='"+id+"']");
     if (ysx.length>=1){        
		 ckdel=$("input[name='"+id+"']:checked");
		 var totck=ckdel.length;
		 var fmckv='';
		 if (totck>1){
		   for (j=0;j<totck;j++){
			   fmckv=fmckv+$(ckdel[j]).val()+'/';
		   }
		   fmckv=killlasttring(fmckv);
		 }else{
			fmckv=$(ckdel).val();
		 }
			 
		return fmckv;
		
     }else{
		 return $("#"+id).val();
     }
	}else{
		$("#"+id).val(vlx);
	}//根据不同情况加上自动跳转选择的功能
 }
 function P(pids,vids,tps){
	 if (tps>0){
	  ptpidx=pids.split(',');
	  totpid=ptpidx.length;
	 }else{
	   totpid=0;
	 };
	 ptvidx=vids.split(',');
	 totvid=ptvidx.length;
	 if (totpid==totvid || tps==0){
		 var fmkvx='';
		if (tps==0){
		 for (i=0;i<totvid;i++){
			fmkvx=fmkvx+V(ptvidx[i],'()')+",";
		 };
		 if (totvid>0){
			fmkvx=killlasttring(fmkvx);
		 };
		}else{
		 for (i=0;i<totvid;i++){
			 if (tps==1){
			  fmkvx=fmkvx+'&'+ptpidx[i]+'='+V(ptvidx[i],'()');
			 }else if(tps==2){
				 fmkvx=fmkvx+'&'+ptpidx[i]+'='+mkstr(V(ptvidx[i],'()'));
			 }
		 };
		};
		return fmkvx;
	 }else{
       return 0;
	 };
 }
function onlyone(strx,fh){
  ptstr=strx.split(fh);
  totpt=ptstr.length;
  tmpx="";
  for (i=0;i<totpt;i++){
    if (("mm-"+tmpx).indexOf(ptstr[i])>0 && ptstr[i]!=""){
    }else{
      if ( ptstr[i]!=""){
       tmpx=tmpx+ptstr[i]+fh;
      };
    }
  }//fori
  return tmpx;
}//func
function huanhang(){
  return "\r\n";
}
function GetDistance( lat1,  lng1,  lat2,  lng2){
    var radLat1 = lat1*Math.PI / 180.0;
    var radLat2 = lat2*Math.PI / 180.0;
    var a = radLat1 - radLat2;
    var  b = lng1*Math.PI / 180.0 - lng2*Math.PI / 180.0;
    var s = 2 * Math.asin(Math.sqrt(Math.pow(Math.sin(a/2),2) +
    Math.cos(radLat1)*Math.cos(radLat2)*Math.pow(Math.sin(b/2),2)));
    s = s *6378.137 ;// EARTH_RADIUS;
    s = Math.round(s * 10000) / 10000;
    return s;
}
function newjsfile(jfname){
 var script = document.createElement("script");
 script.type = "text/javascript";
 script.src = jfname;
 document.getElementsByTagName("head")[0].appendChild(script);
}
function makekey($mkei){
 $partmk=explode(",",$mkei);
 $tot=count($partmk);
 $fmmk="";
 for ($i=0;$i<$tot;$i++){
   if (hou($partmk[$i],".")!="SNO" && strpos("--"+$fmmk,hou($partmk[$i],"."))<=0){
    $fmmk=$fmmk+$partmk[$i]+",";
   };
 };
 if ($tot>0){
  $fmmk=substr($fmmk,0,strlen($fmmk)-1);
 };
 return $fmmk;
}
function turncon($mstr){
  //把[]标签替换成{} 防止静态模板自己被解析，使用的时候实例化与静态有区别，不然编辑静态的时候容易出错  
  $mstr=$mstr.replace(/\[/g,"{");
  $mstr=$mstr.replace(/\]/g,"}");  
  return $mstr;
}
function conturn($mstr){
  $mstr=$mstr.replace(/{/g,"\[");
  $mstr=$mstr.replace(/}/g,"\]");
  return $mstr;
}
function labturn($mstr){
  //把真实代码模板化存储  
  if ( strpos("xx".$mstr,"<")>0 && strpos("xx".$mstr,">")>0){
    $mstr=str_replace("{","｛",$mstr);
    $mstr=str_replace("}","｝",$mstr);
    $mstr=str_replace("<","{",$mstr);
    $mstr=str_replace(">","}",$mstr);
  }
  return $mstr;
}
function labturns($mstr){    
    $mstr=str_replace("{","｛",$mstr);
    $mstr=str_replace("}","｝",$mstr);
    $mstr=str_replace("<","{",$mstr);
    $mstr=str_replace(">","}",$mstr);
    $mstr=str_replace("\"","@",$mstr);
    $mstr=str_replace("'","#",$mstr);
    $mstr=str_replace("OC","onclick",$mstr);
    $mstr=str_replace("OC","ONCLICK",$mstr);

  return $mstr;
}
function turnlab($mstr){
  //把模板实例化使用
  if (strpos("xx"+$mstr,"{")>0 && strpos("xx"+$mstr,"}")>0 ){
    $mstr=str_replace("{","<",$mstr);
    $mstr=str_replace("}",">",$mstr);
    $mstr=str_replace("｛","{",$mstr);
    $mstr=str_replace("｝","}",$mstr);
  }
  return $mstr;
}
function fmcdt($tbns,$kie){
 $parttb=explode(",",substr($tbns,0,strlen($tbns)-1));
 $tot=count($parttb);
 $fmtj="";
 switch ($tot){
   case 2:
  $fmtj=$parttb[0]+"."+$kie+"="+$parttb[1]+"."+$kie+"  ";
  break;
   case 3:
  $fmtj=$parttb[0]+"."+$kie+"="+$parttb[1]+"."+$kie+" and "+$parttb[1]+"."+$kie+"="+$parttb[2]+"."+$kie+" ";
  break;
 }
 return $fmtj;
}
function keyexc($kxyz,$allkx,$kifx,$funxx){         
        if (strpos("xx"+$allkx,$kxyz)>0 && strpos("xx"+$funxx,"[col-")>0){
         $funxx=str_replace("[col-"+$kxyz+":clstxt]",$kifx[$dkey]["COLUMN_CLSTXT"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":classp]",$kifx[$dkey]["COLUMN_CLASSP"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":title]",$kifx[$dkey]["COLUMN_TITLE"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":sshow]",$kifx[$dkey]["COLUMN_SSHOW"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":spost]",$kifx[$dkey]["COLUMN_SPOST"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":jshow]",$kifx[$dkey]["COLUMN_JSHOW"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":jpost]",$kifx[$dkey]["COLUMN_JPOST"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":cange]",$kifx[$dkey]["COLUMN_CANGE"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":dspld]",$kifx[$dkey]["COLUMN_DSPLD"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":dxtype]",$kifx[$dkey]["COLUMN_DXTYPE"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":default]",$kifx[$dkey]["COLUMN_DEFAULT"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":explain]",$kifx[$dkey]["COLUMN_EXPLAIN"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":sqx]",$kifx[$dkey]["COLUMN_SQX"],$funxx); 
         $funxx=str_replace("[col-"+$kxyz+":type]",$kifx[$dkey]["COLUMN_TYPE"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":tpnm]",$kifx[$dkey]["COLUMN_TPNM"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":tplen]",$kifx[$dkey]["COLUMN_TPLEN"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":acthtm]",$kifx[$dkey]["COLUMN_ACTHTM"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":atnhtm]",$kifx[$dkey]["COLUMN_ATNHTM"],$funxx);
         $kxyz="key";
         $funxx=str_replace("[col-"+$kxyz+":clstxt]",$kifx[$dkey]["COLUMN_CLSTXT"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":classp]",$kifx[$dkey]["COLUMN_CLASSP"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":title]",$kifx[$dkey]["COLUMN_TITLE"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":sshow]",$kifx[$dkey]["COLUMN_SSHOW"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":spost]",$kifx[$dkey]["COLUMN_SPOST"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":jshow]",$kifx[$dkey]["COLUMN_JSHOW"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":jpost]",$kifx[$dkey]["COLUMN_JPOST"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":cange]",$kifx[$dkey]["COLUMN_CANGE"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":dspld]",$kifx[$dkey]["COLUMN_DSPLD"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":dxtype]",$kifx[$dkey]["COLUMN_DXTYPE"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":default]",$kifx[$dkey]["COLUMN_DEFAULT"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":explain]",$kifx[$dkey]["COLUMN_EXPLAIN"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":sqx]",$kifx[$dkey]["COLUMN_SQX"],$funxx); 
         $funxx=str_replace("[col-"+$kxyz+":type]",$kifx[$dkey]["COLUMN_TYPE"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":tpnm]",$kifx[$dkey]["COLUMN_TPNM"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":tplen]",$kifx[$dkey]["COLUMN_TPLEN"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":acthtm]",$kifx[$dkey]["COLUMN_ACTHTM"],$funxx);
         $funxx=str_replace("[col-"+$kxyz+":atnhtm]",$kifx[$dkey]["COLUMN_ATNHTM"],$funxx);
        }
   return $funxx;
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
      if (strlen($kzm)<=4 && strlen($kzm)>0){
        if (strpos($tmpkzm,$kzm+",")>0){
          //发现定义域中的扩展名了
          if (strpos("xjpg,jpeg,png,bmp,gif",$kzm)>0){
          	$fmxhtm=$fmxhtm+"<a href=\""+$ptdv[$d]+"\" target=\"about_blank\"><img src=\""+$ptdv[$d]+"\"  width=\""+$kw+"px\" height=\""+$kh+"px\"></a>";
          }else{
            $fmxhtm=$fmxhtm+"<a href=\""+$ptdv[$d]+"\" target=\"about_blank\"><img src=\"/ORG/BRAIN/images/icon/filetypes/"+$kzm+"-"+$kcss+".svg"+"\" width=\""+$kw+"px\" height=\""+$kh+"px\"></a>";
          }                    
        }else{
          //没发现定义域中的扩展名
          $fmxhtm=$fmxhtm+"<a href=\""+$ptdv[$d]+"\" target=\"about_blank\"><img src=\"/ORG/BRAIN/images/icon/filetypes/svg-c.svg"+"\" width=\""+$kw+"px\" height=\""+$kh+"px\"></a>";
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
function fmvalue($tbnmx,$dvalue,$dsno,$dkey,$sfun,$dn,$arrdt){     
$nhtxt="";
$sfunx="";
$funvalue="";
$newfunx="";    
tmpvx="";
smd5=$tbnmx+$dvalue+$dsno+$dkey+$sfun+$dn;
smd5="a"+smd5.MD5();
eval('tmpvx=sessionStorage.'+smd5+';');
if (tmpvx!="" && tmpvx!=undefined && $dvalue!="" && $dsno!="" && $dkey!=""){
  return tostring(tmpvx);
}else{
  if ($dkey=="apps"){   
  }
  $sfun=qian(" "+$sfun,"|");
 if ($sfun=="" || $dn==-1 || $sfun==undefined){
   if(strlen($dvalue)>20){
      return substr($dvalue,0,20);
   }else{
      return $dvalue;
   };
 }  
fd=0;
$tmpvlx="";
  if (strpos("x"+$sfun,"CASE")>0 && strpos("x"+$sfun,"E@CS")>0){
    $ptfunx=explode("CASE",$sfun);
    $totpf=count($ptfunx);
    $fd=0;
    for ($pf=1;$pf<$totpf;$pf++){      
       $tmpfn=qian(hou($ptfunx[$pf],"::"),"E@CS");
       $tmpct=qian($ptfunx[$pf],"::");
       $tmptj=substr($ptfunx[$pf],0,1);
       $tmpvlx=qian($ptfunx[$pf],"::");      
       $tmpvlx=$tmpvlx.replace($tmptj,"");        
       switch($tmptj){
         case "@":
         if (((strpos("xxx"+$dvalue,$tmpvlx)>0 && $tmpvlx!="") || $tmpvlx=="") && $fd==0){
           $newfunx=$tmpfn;
           $fd=$fd+1;
         }
         break;
         case "=":
          if ($dvalue==$tmpvlx || intval($dvalue)*1==intval($tmpvlx)*1 && $tmpvlx!="" && $fd==0){
             $newfunx=$tmpfn;            
             $fd=$fd+1;
           };
         break;
         case ">":
            if ((($tmpvlx*1)>($dvalue*1)) && $tmpvlx!="" && $fd==0){
             $newfunx=$tmpfn;
             $fd=$fd+1;
            };
          break;
         case "<":
            if ((($tmpvlx*1)<($dvalue*1)) && $tmpvlx!="" && $fd==0){
             $newfunx=$tmpfn;
             $fd=$fd+1;
            };
           break;
         default:         
           $sfun="";
       }
    };//for
    $sfun="";
    if ($fd==0){      
    }
  }else{
  };  
 if ($newfunx!=""){
   $sfun=turncon($newfunx);   
 }else{
   $sfun=turncon($sfun); 
 }
  if (strpos("x"+$sfun,"{")>0 || strpos($sfun,"}")>0 ){        
   $nhtxt=str_replace("{thisid}","ipt"+$dkey+$dsno,$sfun);   
   $nhtxt=str_replace("{thiskey}",$dkey,$nhtxt);
   if (strpos("xxx"+$nhtxt,"{col-key")>0){
        $kfun=array(array());
        $kfun=thekeyfun($kfun,glb(),$tbnmx,$arrdt["table"]["keys"]);                             
       $nhtxt=keyexc($dkey,$arrdt["table"]["keys"],$kfun,$nhtxt);
    }
   $nhtxt=str_replace("{thistable}",$tbnmx,$nhtxt);
   $grp=atv("(coode_sysdefault@companyid='"+glc()+"').groupid");
   $nhtxt=str_replace("{grp}",$grp,$nhtxt);
   $nhtxt=str_replace("{thissno}",$dsno,$nhtxt);
            $nhtxt=str_replace("{SNO}",$dsno,$nhtxt);
            $nhtxt=str_replace("{key}",$dkey,$nhtxt);
            $nhtxt=str_replace("{key0}","p_"+$dkey+$dsno,$nhtxt);
            $nhtxt=str_replace("{table}",$tbnmx,$nhtxt);
            $nhtxt=str_replace("{OLMK}",onlymark(),$nhtxt);
      $nhtxt=str_replace("{date}",date("Y-m-d"),$nhtxt);
       $nhtxt=str_replace("{now}",date("Y-m-d H:i:s"),$nhtxt);
   $nhtxt=str_replace("{uid}",glu(),$nhtxt);
   $nhtxt=str_replace("{gid}","",$nhtxt);
   $nhtxt=str_replace("{cid}",glc(),$nhtxt);
   $nhtxt=str_replace("{appid}",_get("appid"),$nhtxt);
   $nhtxt=str_replace("{thisshort}",_get("tmpshortid"),$nhtxt);
   $nhtxt=str_replace("{thisshort}",_get("tmpstid"),$nhtxt);
   $nhtxt=str_replace("{shortid}",_get("shortid"),$nhtxt);
   $nhtxt=str_replace("{shortid}",_get("stid"),$nhtxt);
   $nhtxt=str_replace("{thisvalue}",tostring($dvalue),$nhtxt);
   if ($dvalue=="1" || $dvalue=="checked"){
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
   if (strpos("xxx".$nhtxt,"{duofile-")>0){     
     $ftj=qian(hou($nhtxt,"{duofile-"),"}");
     $nhtxt=str_replace("{duofile-"+$ftj+"}",duofilex($ftj,tostring($dvalue)),$nhtxt);    
   };//

  if ($nhtxt.indexOf("{key-")>0){
    $ptnhtxt=explode("{key-",$nhtxt);
    $totpt=count($ptnhtxt);    
   for ($f=1;$f<$totpt;$f++){
      $tmpok=qian($ptnhtxt[$f],"}");     
      if (strpos($arrdt[$dkey][0],$tmpok)>0){
        $nhtxt=str_replace("{key-"+$tmpok+"}",$arrdt[$tmpok][$dn*1],$nhtxt);
      }
   };//
  }
     if (strpos("xxx"+$nhtxt,"{col-")>0){
        //$kfun=array(array());
        $kfun=thekeyfun($kfun,glb(),$tbnmx,$arrdt[$dkey][0]);                     
        $ptnhtxt=explode("{col-",$nhtxt);
        $totpt=count($ptnhtxt);
       for ($f=1;$f<$totpt;$f++){
         $tmpok=qian($ptnhtxt[$f],"}");
         $tmpokx=qian($tmpok,":");
         $nhtxt=keyexc($tmpokx,$arrdt[$dkey][0],$kfun,$nhtxt);
       };//
    }
  if ($nhtxt.indexOf("{get-")>0){
   $ptnhtxt=explode("{get-",$nhtxt);
   $totpt=count($ptnhtxt);
    for ($f=1;$f<$totpt;$f++){
      $tmpok=qian($ptnhtxt[$f],"}");
      $nhtxt=str_replace("{get-"+$tmpok+"}",_get($tmpok),$nhtxt);
    };//
  }
  if ($nhtxt.indexOf("{post-")>0){
    $ptnhtxt=explode("{post-",$nhtxt);
    $totpt=count($ptnhtxt);
    for ($f=1;$f<$totpt;$f++){
      $tmpok=qian($ptnhtxt[$f],"}");
      $nhtxt=str_replace("{post-"+$tmpok+"}",_post($tmpok),$nhtxt);
    };//
  }
  if ($nhtxt.indexOf("{cookie-")>0){
   $ptnhtxt=explode("{cookie-",$nhtxt);
   $totpt=count($ptnhtxt);
   for ($f=1;$f<$totpt;$f++){
      $tmpok=qian($ptnhtxt[$f],"}");
      $nhtxt=str_replace("{cookie-"+$tmpok+"}",_cookie($tmpok),$nhtxt);
   };//
  }
 if ($nhtxt.indexOf("{atv-")>0){
  if (strpos($nhtxt,"{atv-")>0){
   $ptatv=explode("{atv-",$nhtxt);
   $totatv=count($ptatv);
   for ($g=1;$g<$totatv;$g++){
      $tmpatv=qian($ptatv[$g],"}");
      $nhtxt=str_replace("{atv-"+$tmpatv+"}",atv($tmpatv),$nhtxt);
   };//
  };//
 };
 if ($nhtxt.indexOf("{utv-")>0){
  if (strpos($nhtxt,"{utv-")>0){
   $ptutv=explode("{utv-",$nhtxt);
   $totutv=count($ptutv);
   for ($h=1;$h<$totutv;$h++){
      $tmputv=qian($ptutv[$h],"}");
      $nhtxt=str_replace("{utv-"+$tmputv+"}",utv($tmputv),$nhtxt);
    };//
   };//   
  };
 }else{
     $nhtxt=$dvalue;
 };//

   $nhtxt=turnlab($nhtxt);
   $nhtxt=turnquote($nhtxt);
   eval('sessionStorage.'+smd5+'=$nhtxt;');
   return $nhtxt;
 };
}
function turnquote(tutxt){
  tutxt=tutxt.replace(/\\\'/g,"'")
  return tutxt;
}
function formdiybtn($stid,$diycode){
  $fmx="";
  $fmxy="";
 if ($diycode!=""){
     if (strpos($diycode,",")>0){
       $ptdiy=explode(",",$diycode);
       $totptd=count($ptdiy);
       $fmx="";
       $fmxy="";
       for ($p=0;$p<$totptd;$p++){
         $ttx=qian($ptdiy[$p],":");
         $uux=hou($ptdiy[$p],":");
         if (strpos($uux,")")>0){
           $fmx=$fmx+"<a class=\"layui-btn\" onclick=\""+$uux+"\">"+$ttx+"</a>";
           if (($gsqc*1)==$p){
             $fmxy=$fmxy+"<li><a href=\"javascript:void(0);\" onclick=\""+$uux+"\" class=\"current\">"+$ttx+"</a></li>";
           }else{
              $fmxy=$fmxy+"<li><a href=\"javascript:void(0);\" onclick=\""+$uux+"\">"+$ttx+"</a></li>";
           };
         }else{
           $fmx=$fmx+"<a class=\"layui-btn\" onclick=\"intourl('"+$uux+"')\">"+$ttx+"</a>";
           if (($gsqc*1)==1){
             $fmxy=$fmxy+"<li><a href=\"javascript:void(0);\" onclick=\"intourl('"+$uux+"')\" class=\"current\">"+$ttx+"</a></li>";
           }else{
              $fmxy=$fmxy+"<li><a href=\"javascript:void(0);\" onclick=\"intourl('"+$uux+"')\">"+$ttx+"</a></li>";
           };
         };
       };//for
      }else{
         $ttx=qian($diycode,":");
         $uux=hou($diycode,":");
         if (strpos($uux,")")>0){
           $fmx=$fmx+"<a class=\"layui-btn\" href=\"javascript:void(0);\" onclick=\""+$uux+"\">"+$ttx+"</a>";
           if (($gsqc*1)==1){
            $fmxy=$fmxy+"<li><a href=\"javascript:void(0);\" onclick=\""+$uux+"\">"+$ttx+"</a></li>";
           }
         }else{
           $fmx=$fmx+"<a class=\"layui-btn\" href=\"javascript:void(0);\" onclick=\"intourl('"+$uux+"')\">"+$ttx+"</a>";
           if (($gsqc*1)==1){
            $fmxy=$fmxy+"<li><a href=\"javascript:void(0);\" onclick=\"intourl('"+$uux+"')\">"+$ttx+"</a></li>";
           };
         };   
     };
    $dbtn="<div id=\"wrap\"><div id=\"content\" ><ul >"+$fmxy+"</ul></div></div>";
    return $dbtn;
  }else{
   return "";
  };
}
function maketbheadin($totk,$chtml,$dtp,$tbhd,$oprtx,$headx,$keyinfo,$kpart){
 $fmch="";
 $fmtb="";
 $fmexl="";
 $fmtp="";
 $fmdft="";
 $thusvalue="";
 for ($pp=0;$pp<$totk;$pp++){
  if (strpos(hou($kpart[$pp],"."),"clstxt")>0){
  }else{
   $demo=$chtml;
    $dftfun=$keyinfo[hou($kpart[$pp],".")]["COLUMN_SSHOW"];
    $hfun="";
    $tmppost="";
    if (strpos("x"+$dftfun,"|")>0){
      //$hfun=hou("x"+$dftfun,"|");
      //eval($hfun);
      $fmdft=$fmdft+"\""+hou($kpart[$pp],".")+"\":\"\",";
    }else{
      $fmdft=$fmdft+"\""+hou($kpart[$pp],".")+"\":\"\",";
    };
    if (($tbhd*1)==0 && strpos("x"+$dtp,"print")<=0){
    }else{
     if ($keyinfo[hou($kpart[$pp],".")]["COLUMN_DSPLD"]*1==1){
       $coldspl="";
     }else{
       $coldspl="style=\"display:none;\"";
     }
     if ( $keyinfo[hou($kpart[$pp],".")]["COLUMN_TITLE"]!=""){
      if (hou($kpart[$pp],".")=="SNO"){
        $fmtb=$fmtb+"<th knm=\""+hou($kpart[$pp],".")+"\"  "+$coldspl+">"+$keyinfo[hou($kpart[$pp],".")]["COLUMN_TITLE"]+"</th>\r\n";
        $fmtp=$fmtp+"<th knm=\""+hou($kpart[$pp],".")+"\"  align=\"right\" width=\"50\">"+$keyinfo[hou($kpart[$pp],".")]["COLUMN_TITLE"]+"</th>\r\n";
        $fmexl=$fmexl+$keyinfo[hou($kpart[$pp],".")]["COLUMN_TITLE"]+"[tab]";
      }else{
        $fmtb=$fmtb+"<th knm=\""+hou($kpart[$pp],".")+"\"  "+$coldspl+">"+$keyinfo[hou($kpart[$pp],".")]["COLUMN_TITLE"]+"</th>\r\n";
        $fmtp=$fmtp+"<th knm=\""+hou($kpart[$pp],".")+"\"  align=\"center\">"+$keyinfo[hou($kpart[$pp],".")]["COLUMN_TITLE"]+"</th>\r\n";
        $fmexl=$fmexl+$keyinfo[hou($kpart[$pp],".")]["COLUMN_TITLE"]+"[tab]";
      }     
     }else{
      if (hou($kpart[$pp],".")=="SNO"){
        $fmtb=$fmtb+"<th knm=\""+hou($kpart[$pp],".")+"\"  "+$coldspl+">"+hou($kpart[$pp],".")+"</th>\r\n";
        $fmtp=$fmtp+"<th knm=\""+hou($kpart[$pp],".")+"\"  align=\"right\" width=\"50\">"+hou($kpart[$pp],".")+"</th>\r\n";
        $fmexl=$fmexl+hou($kpart[$pp],".")+"[tab]";
      }else{
        $fmtb=$fmtb+"<th knm=\""+hou($kpart[$pp],".")+"\"  "+$coldspl+">"+hou($kpart[$pp],".")+"</th>\r\n";
        $fmtp=$fmtp+"<th knm=\""+hou($kpart[$pp],".")+"\"  align=\"center\" >"+hou($kpart[$pp],".")+"</th>\r\n";
        $fmexl=$fmexl+hou($kpart[$pp],".")+"[tab]";
      }
     };      
   };
  };
 };
  $fmdft=substr($fmdft,0,strlen($fmdft)-1)+"}";
  $fmexl=$fmexl+huanhang();
  if (strpos($dtp+$headx,"nooprt")>0 || ($oprtx*1)==0 ){
  }else{
    if (strpos($dtp+$headx,"theadc")>0 ){
      $fmtb=$fmtb+"<th knm=\"operation\">操作</th>";
     }else{
      $fmtb=$fmtb+"<th knm=\"operation\">操作</th>";
     };
  };
  $headtxt=new Array();
  $headtxt["ftb"]=$fmtb;
  $headtxt["ftp"]=$fmtp;
  $headtxt["exl"]=$fmexl;
  $headtxt["dft"]=$fmdft;
  return $headtxt;
}
function shortcls(stid){
  tmpval="";
  eval("tmpval=localStorage.shortcls"+stid+";");
  if (tmpval=="" || tmpval==undefined){
    bktxt=ajaxhtmlpost("/SPEC/EDITOR/anyshort.php?stid="+stid,"");
    eval("localStorage.shortcls"+stid+"=bktxt;");
    return bktxt;
  }else{
    return tmpval;
  }
}
function toquote(txtx){
  return txtx.replace(/\"/g,'\\\"');  
}
function unquote(txtx){
  return txtx.replace(/\\\"/g,'\"');  
}
function maketbdata($totrst,$chtml,$tbnm,$sresult,$kpart,$keyinfo,$xid){  
  $tmpdtx="";
  $fmtb="";  
  $fmtmpselect="";
  $tmpatn="";
  $tmpact="";
  $funvalue="";
  $thusvalue="";
  $exkkk="";
  $appid="";
  $tbkis="";
  $totk=count($kpart);
  for ($ii=0;$ii<$totk;$ii++){            
      $tbkis=$tbkis+$kpart[$ii]+",";        
  }
  $tbkis=killlasttring($tbkis);  
  $shortbase=shortinfo($xid);  
  $obtn=$shortbase["obtn"];
  $vbtn=$shortbase["vbtn"];
  $xbtn=$shortbase["xbtn"];
  $oprtx=$shortbase["oprtx"];  
  $headx=$shortbase["headx"];
  $allkillbtn=$shortbase["allkillbtn"];
  for ($jj=1;$jj<$totrst+1;$jj++){
    $fmtb=$fmtb+"<tr id=\""+$xid+$sresult["SNO"][$jj]+"\" rowidx=\""+($jj)+"\">";    
    $tmp=0;
    $fmudt="";
    
    $demo=$chtml;
    for ($ii=0;$ii<$totk;$ii++){
      $tmpact="";
      $tmpatn="";
     if(strpos(hou($kpart[$ii],"."),"clstxt")>0){     
     }else{
             if (strpos("x"+$exkkk+",","-"+hou($kpart[$ii],".")+",")>0){
               $sresult[hou($kpart[$ii],".")][$jj]="***";
              };             
             if ($keyinfo[hou($kpart[$ii],".")]["COLUMN_DSPLD"]*1==1){
               $coldspl="";
             }else{
               $coldspl="style=\"display:none;\"";
             }
             if ($keyinfo[hou($kpart[$ii],".")]["COLUMN_CANGE"]*1==1){
               $rdonly="";
             }else{
               $rdonly="readonly";
             }
      if (hou($kpart[$ii],".")=='SNO'){
        $fmtb=$fmtb+"<td id=\"SNO"+$sresult['SNO'][$jj]+"\" class=\"SNO\" "+$coldspl+"><input type=\"checkbox\" id=\"chk"+$sresult['SNO'][$jj]+"\" name=\"chksno\"  lay-skin=\"primary\"  value=\""+$sresult['SNO'][$jj]+"\">"+$sresult['SNO'][$jj]+"</td>\r\n";        
        $demo=str_replace("[SNO]",$sresult['SNO'][$jj],$demo);
        $demo=str_replace("[key-SNO]",$sresult['SNO'][$jj],$demo);
        $demo=str_replace("[thissno]",$sresult['SNO'][$jj],$demo);
           $tmp=$tmp+1;        
      }else{                  
        if ($tmp>0){          
            $newonex=tostring($keyinfo[hou($kpart[$ii],".")]["COLUMN_CLSTXT"]);
            $kclstxt=tostring($keyinfo[hou($kpart[$ii],".")]["COLUMN_CLSTXT"]);          
           if ($kclstxt!="" ){ 
                 if (strpos($newonex,"key-")>0){
                   $hk=qian(hou($newonex,"key-"),"]");
                   $newonex=tostring($sresult[$hk][$jj]);
                 }else{
                   if (strpos($newonex,"key")>0 ){
                    $newonex=$sresult[hou($kpart[$ii],".")+"clstxt"][$jj];                   
                   };
                 };
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
            $ckcd=" onclick=\"qajaxp('修改记录','/DNA/EXF/anyrcv.php?appid="+$appid+"&tbnm="+$tbnm+"&kies="+hou($kpart[$ii],".")+"&SNO="+$sresult['SNO'][$jj]+"','p_"+hou($kpart[$ii],".")+$sresult['SNO'][$jj]+"='+getduovalue('"+"p_"+hou($kpart[$ii],".")+$sresult['SNO'][$jj]+"'));\"";
          };
           $selecthcd="";
          if (strlen($tmpact)>5){
            $selecthcd=$tmpact;
          }else{
            if ($rdonly==""){
             $selecthcd=" onchange=\"qajaxp('修改记录','/DNA/EXF/anyrcv.php?appid="+$appid+"&tbnm="+$tbnm+"&kies="+hou($kpart[$ii],".")+"&SNO="+$sresult['SNO'][$jj]+"','p_"+hou($kpart[$ii],".")+$sresult['SNO'][$jj]+"='+$('#"+"p_"+hou($kpart[$ii],".")+$sresult['SNO'][$jj]+"').val())\"";
            }
          };
                  if ($keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]=="clstxt"){
                     $fmtmpselect=formselect(qian($newonex,"|"),hou($newonex,"|"),$sresult[hou($kpart[$ii],".")][$jj],"p_"+hou($kpart[$ii],".")+$sresult['SNO'][$jj],"layui-select",$selecthcd);                      
                     //$fmtmpselect=$fmtmpselect.replace(/"/g,"\\\"");
                     $fmtmpselect=$fmtmpselect.replace(/\r\n/g,"");
                  }                 
                  if ($keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]=="clsduo"){                                                   
                     $fmtmpselect="<input type=\"hidden\" id=\""+"p_"+hou($kpart[$ii],".")+$sresult['SNO'][$jj]+"\" value=\""+$sresult[hou($kpart[$ii],".")][$jj]+"\">"+formselectx(qian($newonex,"|"),hou($newonex,"|"),$sresult[hou($kpart[$ii],".")][$jj],"p_"+hou($kpart[$ii],".")+$sresult['SNO'][$jj],"","");                    
                     //$fmtmpselect=$fmtmpselect.replace(/"/g,"\\\"");
                     $fmtmpselect=$fmtmpselect.replace(/\r\n/g,"");
                 };
                  
             };//kclstxt
                $tmpvl="";
                $houduanzhanshi=qian(tostring($keyinfo[hou($kpart[$ii],".")]["COLUMN_SSHOW"]),"|");
                if ($houduanzhanshi!=""){                                  
                   $tmpvl=fmvalue($tbnm,$sresult[hou($kpart[$ii],".")][$jj],$sresult['SNO'][$jj],hou($kpart[$ii],"."),qian(tostring($keyinfo[hou($kpart[$ii],".")]["COLUMN_SSHOW"]),"|"),$jj,$sresult);//先套上外壳                                                                          
                    $tmpvl=str_replace("<selected>",$fmtmpselect,$tmpvl);                                                        
                    $fmtb=$fmtb+"<td id=\""+hou($kpart[$ii],".")+$sresult['SNO'][$jj]+"\" snoid=\""+$sresult['SNO'][$jj]+"\"  tpnm=\""+$keyinfo[hou($kpart[$ii],".")]["COLUMN_TPNM"]+"\" "+$coldspl+" class=\"td"+hou($kpart[$ii],".")+"\" knm=\""+hou($kpart[$ii],".")+"\" tdata=\""+toquote($sresult[hou($kpart[$ii],".")][$jj])+"\">"+$tmpvl+"</td>\r\n";                     
                     $demo=str_replace("["+hou($kpart[$ii],".")+"]",$tmpvl,$demo);
                     $demo=str_replace("[key-"+hou($kpart[$ii],".")+"]",$sresult[hou($kpart[$ii],".")][$jj],$demo);
                }else{
                   if (strlen($fmtmpselect)>5){                     
                     $fmtb=$fmtb+"<td id=\""+hou($kpart[$ii],".")+$sresult['SNO'][$jj]+"\" snoid=\""+$sresult['SNO'][$jj]+"\"  tpnm=\""+$keyinfo[hou($kpart[$ii],".")]["COLUMN_TPNM"]+"\" "+$coldspl+" dxtp=\""+$keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]+"\"  class=\"td"+hou($kpart[$ii],".")+"\" knm=\""+hou($kpart[$ii],".")+"\">"+$fmtmpselect+"</td>\r\n";                     
                     $demo=str_replace("["+hou($kpart[$ii],".")+"]",$fmtmpselect,$demo);
                     $demo=str_replace("[key-"+hou($kpart[$ii],".")+"]",$sresult[hou($kpart[$ii],".")][$jj],$demo);
                   }else{
                    if (strlen($sresult[hou($kpart[$ii],".")][$jj])>33){
                      $fmtb=$fmtb+"<td id=\""+hou($kpart[$ii],".")+$sresult['SNO'][$jj]+"\" snoid=\""+$sresult['SNO'][$jj]+"\"  tpnm=\""+$keyinfo[hou($kpart[$ii],".")]["COLUMN_TPNM"]+"\" "+$coldspl+" dxtp=\""+$keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]+"\" class=\"td"+hou($kpart[$ii],".")+"\" knm=\""+hou($kpart[$ii],".")+"\" tdata=\""+toquote($sresult[hou($kpart[$ii],".")][$jj])+"\" title=\""+labturns(toquote($sresult[hou($kpart[$ii],".")][$jj]))+"\">"+substr(tostring($sresult[hou($kpart[$ii],".")][$jj]),0,32)+"</td>\r\n";                      
                      $demo=str_replace("["+hou($kpart[$ii],".")+"]",$sresult[hou($kpart[$ii],".")][$jj],$demo);
                      $demo=str_replace("[key-"+hou($kpart[$ii],".")+"]",$sresult[hou($kpart[$ii],".")][$jj],$demo);
                    }else{
                       if ($keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]=="dttm" || $keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]=="date"){
                         $fmtb=$fmtb+"<td id=\""+hou($kpart[$ii],".")+$sresult['SNO'][$jj]+"\" snoid=\""+$sresult['SNO'][$jj]+"\" tpnm=\""+$keyinfo[hou($kpart[$ii],".")]["COLUMN_TPNM"]+"\" "+$coldspl+" dxtp=\""+$keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]+"\" class=\"td"+hou($kpart[$ii],".")+"\" knm=\""+hou($kpart[$ii],".")+"\" tdata=\""+toquote($sresult[hou($kpart[$ii],".")][$jj])+"\" ><input id=\"p_"+hou($kpart[$ii],".")+$sresult['SNO'][$jj]+"\" class=\"demo-input\"  value=\""+$sresult[hou($kpart[$ii],".")][$jj]+"\"></td>\r\n";                         
                       }else{                         
                         $fmtb=$fmtb+"<td id=\""+hou($kpart[$ii],".")+$sresult['SNO'][$jj]+"\" snoid=\""+$sresult['SNO'][$jj]+"\"  tpnm=\""+$keyinfo[hou($kpart[$ii],".")]["COLUMN_TPNM"]+"\" "+$coldspl+" dxtp=\""+$keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]+"\"  class=\"td"+hou($kpart[$ii],".")+"\" knm=\""+hou($kpart[$ii],".")+"\" tdata=\""+toquote($sresult[hou($kpart[$ii],".")][$jj])+"\" title=\""+labturns(toquote($sresult[hou($kpart[$ii],".")][$jj]))+"\">"+$sresult[hou($kpart[$ii],".")][$jj]+"</td>\r\n";                         
                       }                                          
                      $demo=str_replace("["+hou($kpart[$ii],".")+"]",$sresult[hou($kpart[$ii],".")][$jj],$demo);                      
                      $demo=str_replace("[key-"+hou($kpart[$ii],".")+"]",$sresult[hou($kpart[$ii],".")][$jj],$demo);
                    };//33
                  };//tmpselect>5
                };//show
               $fmtmpselect="";
         $fmudt=$fmudt+"'&p_"+hou($kpart[$ii],".")+$sresult['SNO'][$jj]+"='+mkstr($('#p_"+hou($kpart[$ii],".")+$sresult['SNO'][$jj]+"').val())+";
        }else{//tmp>0
          $newonex=tostring($keyinfo[hou($kpart[$ii],".")]["COLUMN_CLSTXT"]);
           $kclstxt=tostring($keyinfo[hou($kpart[$ii],".")]["COLUMN_CLSTXT"]);
           if ($kclstxt!="" && (strpos($kclstxt,"|")>0 || strpos($kclstxt,"/")>0)){        
                 if (strpos($newonex,"key-")>0){
                   $hk=qian(hou($newonex,"key-"),"]");
                   $newonex=$sresult[$hk][$jj];
                 };
                  if ($rdonly==""){
                    $selecthcd=" onchange=\"qajaxp('修改记录','/DNA/EXF/anyrcv.php?appid="+$appid+"&tbnm="+$tbnm+"&kies="+hou($kpart[$ii],".")+"&SNO="+$sresult['SNO'][$jj]+"','p_"+hou($kpart[$ii],".")+$sresult['SNO'][$jj]+"='+$('#"+"p_"+hou($kpart[$ii],".")+$sresult['SNO'][$jj]+"').val())\"";
                  }
                  if ($keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]=="clstxt"){
                      $fmtmpselect=formselect(qian($newonex,"|"),hou($newonex,"|"),$sresult[hou($kpart[$ii],".")][$jj],"p_"+hou($kpart[$ii],".")+$sresult['SNO'][$jj],"layui-select",$selecthcd);
                  }
                 if ($keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]=="clsduo"){
                   $fmtmpselect="<input type=\"hidden\" id=\""+"p_"+hou($kpart[$ii],".")+$sresult['SNO'][$jj]+"\" value=\""+$sresult[hou($kpart[$ii],".")][$jj]+"\">"+formselectx(qian($newonex,"|"),hou($newonex,"|"),$sresult[hou($kpart[$ii],".")][$jj],"p_"+hou($kpart[$ii],".")+$sresult['SNO'][$jj],"","");
                  };
                 $fmtb=$fmtb+"<td class=\"td"+hou($kpart[$ii],".")+"\" "+$coldspl+">"+$fmtmpselect+"</td>\r\n";
               $demo=str_replace("["+hou($kpart[$ii],".")+"]",$fmtmpselect,$demo);
               $demo=str_replace("[key-"+hou($kpart[$ii],".")+"]",$sresult[hou($kpart[$ii],".")][$jj],$demo);
           }else{
              $houtaizhanshi=qian(tostring($keyinfo[hou($kpart[$ii],".")]["COLUMN_SSHOW"]),"|");
               if ($houtaizhanshi!=""){
                  $tmpvl=fmvalue($tbnm,$sresult[hou($kpart[$ii],".")][$jj],$sresult['SNO'][$jj],hou($kpart[$ii],"."),qian(tostring($keyinfo[hou($kpart[$ii],".")]["COLUMN_SSHOW"]),"|"),$jj,$sresult);                 
                 $fmtb=$fmtb+"<td class=\"td"+hou($kpart[$ii],".")+"\" "+$coldspl+">"+$tmpvl+"</td>\r\n";
                 $demo=str_replace("["+hou($kpart[$ii],".")+"]",$tmpvl,$demo);
                 $demo=str_replace("[key-"+hou($kpart[$ii],".")+"]",$sresult[hou($kpart[$ii],".")][$jj],$demo);
              }else{
               if (strlen($sresult[hou($kpart[$ii],".")][$jj])>33){
                 $fmtb=$fmtb+"<td class=\"td"+hou($kpart[$ii],".")+"\" "+$coldspl+" title=\""+labturns(toquote($sresult[hou($kpart[$ii],".")][$jj]))+"\">"+substr(tostring($sresult[hou($kpart[$ii],".")][$jj]),0,32)+"</td>\r\n";
                 $demo=str_replace("["+hou($kpart[$ii],".")+"]",$sresult[hou($kpart[$ii],".")][$jj],$demo);
                 $demo=str_replace("[key-"+hou($kpart[$ii],".")+"]",$sresult[hou($kpart[$ii],".")][$jj],$demo);
               }else{
                 $fmtb=$fmtb+"<td class=\"td"+hou($kpart[$ii],".")+"\" "+$coldspl+" title=\""+labturns($sresult[hou($kpart[$ii],".")][$jj])+"\">"+$sresult[hou($kpart[$ii],".")][$jj]+"</td>\r\n";                 
                 $demo=str_replace("["+hou($kpart[$ii],".")+"]",$sresult[hou($kpart[$ii],".")][$jj],$demo);
                 $demo=str_replace("[key-"+hou($kpart[$ii],".")+"]",$sresult[hou($kpart[$ii],".")][$jj],$demo);
               };
             };    
           };
        };//if
      };//if
       if ($keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]=="date"){
         $tmpdtx=$tmpdtx+"laydatex('p_"+hou($kpart[$ii],".")+$sresult['SNO'][$jj]+"');";
       };
       if ($keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]=="dttm"){
         $tmpdtx=$tmpdtx+"laydttmx('p_"+hou($kpart[$ii],".")+$sresult['SNO'][$jj]+"');";
       };
       if ($keyinfo[hou($kpart[$ii],".")]["COLUMN_DXTYPE"]=="clsduo"){
         $tmpdtx=$tmpdtx+"$(\".p_"+hou($kpart[$ii],".")+$sresult['SNO'][$jj]+"\").fSelect();";
       };
     };//not clstxt     
    };//for    
  
    
     $fmudt=substr($fmudt,0,strlen($fmudt)-1);  
     
    if ( ($oprtx*1)==1){
     if (strpos($tbnm,",")>0){
         $odspl="";
        $vdspl="";
        $xdspl="";
        if ($obtn*1==0){
          $odspl="style=\"display:none;\"";
        }
        if ($vbtn*1==0){
          $vdspl="style=\"display:none;\"";
        }
        if ($xbtn*1==0){
          $xdspl="style=\"display:none;\"";
        }
        $fmtb=$fmtb+"<td class=\"tdoperate\"><a href=\"javascript:void(0)\"  "+$odspl+" onclick=\"update('"+$xid+"','"+$sresult["SNO"][$jj]+"')\" snox=\""+$sresult["SNO"][$jj]+"\"><img src=\"/ORG/BRAIN/images/icon/system/detail5.svg\" style=\"width:20px;height:20px;\"></a><a href=\"javascript:void(0)\" "+$vdspl+" onclick=\"qajaxp('修改记录','/DNA/EXF/anyrcv.php?appid="+$appid+"&tbnm="+$tbnm+"&kies="+$tbkis+"&SNO="+$sresult['SNO'][$jj]+"',"+$fmudt+")\" snox=\""+$sresult["SNO"][$jj]+"\"><img src=\"/ORG/BRAIN/images/icon/system/tongguoqr.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\" "+$xdspl+" onclick=\"Notiflix.Confirm.Show( '删除确认', '你确定要删除该条记录吗?', '是', '否', function(){ killsave('"+$tbnm+"','"+$sresult["SNO"][$jj]+"'); } );\" "+$xdspl+" snox=\""+$sresult["SNO"][$jj]+"\"><img src=\"/ORG/BRAIN/images/icon/system/shanchu13.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"newwin('查看数据评论','/SPEC/EDITOR/anyjsshort.php?stid=0Ak5hM-sfile:anyjsshort.php-pnum:30-&tbnm="+$tbnm+"&tbsno="+$sresult["SNO"][$jj]+"')\"><img src=\"/ORG/BRAIN/images/icon/system/liuyan0.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"newwin('查看数据工单','/SPEC/EDITOR/anyjsshort.php?stid=aneVcy-sfile:anyjsshort.php-pnum:30-&tbnm="+$tbnm+"&tbsno="+$sresult["SNO"][$jj]+"&prob=problem')\"><img src=\"/ORG/BRAIN/images/icon/system/probm.svg\" style=\"width:20px;height:20px\"></a></td>\r\n";
        $demo=str_replace("[OPRT]","<a  href=\"javascript:void(0)\"  "+$odspl+" onclick=\"update('"+$xid+"','"+$sresult["SNO"][$jj]+"')\" snox=\""+$sresult["SNO"][$jj]+"\"><img src=\"/ORG/BRAIN/images/icon/system/detail5.svg\" style=\"width:20px;height:20px;\"></a><a href=\"javascript:void(0)\" "+$vdspl+" onclick=\"qajaxp('修改记录','/DNA/EXF/anyrcv.php?appid="+$appid+"&tbnm="+$tbnm+"&kies="+$tbkis+"&SNO="+$sresult['SNO'][$jj]+"',"+$fmudt+")\" snox=\""+$sresult["SNO"][$jj]+"\"><img src=\"/ORG/BRAIN/images/icon/system/tongguoqr.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\" "+$xdspl+" onclick=\"Notiflix.Confirm.Show( '删除确认', '你确定要删除该条记录吗?', '是', '否', function(){ killsave('"+$tbnm+"','"+$sresult["SNO"][$jj]+"'); } );\" "+$xdspl+" snox=\""+$sresult["SNO"][$jj]+"\"><img src=\"/ORG/BRAIN/images/icon/system/shanchu13.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"newwin('查看数据评论','/SPEC/EDITOR/anyjsshort.php?stid=0Ak5hM-sfile:anyjsshort.php-pnum:30-&tbnm="+$tbnm+"&tbsno="+$sresult["SNO"][$jj]+"')\"><img src=\"/ORG/BRAIN/images/icon/system/liuyan0.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"newwin('查看数据工单','/SPEC/EDITOR/anyjsshort.php?stid=aneVcy-sfile:anyjsshort.php-pnum:30-&tbnm="+$tbnm+"&tbsno="+$sresult["SNO"][$jj]+"&prob=problem')\"><img src=\"/ORG/BRAIN/images/icon/system/probm.svg\" style=\"width:20px;height:20px\"></a>",$demo);
     }else{
        $odspl="";
        $vdspl="";
        $xdspl="";
        if ($obtn*1==0){
          $odspl="style=\"display:none;\"";
        }
        if ($vbtn*1==0){
          $vdspl="style=\"display:none;\"";
        }
        if ($xbtn*1==0){
          $xdspl="style=\"display:none;\"";
        }
      $fmtb=$fmtb+"<td class=\"tdoperate\"><a  href=\"javascript:void(0)\" "+$odspl+" onclick=\"update('"+$xid+"','"+$sresult["SNO"][$jj]+"')\" snox=\""+$sresult["SNO"][$jj]+"\"><img src=\"/ORG/BRAIN/images/icon/system/detail5.svg\" style=\"width:20px;height:20px;\"></a><a href=\"javascript:void(0)\" "+$vdspl+" onclick=\"qajaxp('修改记录','/DNA/EXF/anyrcv.php?appid="+$appid+"&tbnm="+$tbnm+"&kies="+$tbkis+"&SNO="+$sresult['SNO'][$jj]+"',"+$fmudt+")\" snox=\""+$sresult["SNO"][$jj]+"\"><img src=\"/ORG/BRAIN/images/icon/system/tongguoqr.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"Notiflix.Confirm.Show( '删除确认', '你确定要删除该条记录吗?', '是', '否', function(){ killsave('"+$tbnm+"','"+$sresult["SNO"][$jj]+"'); } );\" "+$xdspl+" snox=\""+$sresult["SNO"][$jj]+"\"><img src=\"/ORG/BRAIN/images/icon/system/shanchu13.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"newwin('查看数据评论','/SPEC/EDITOR/anyjsshort.php?stid=0Ak5hM-sfile:anyjsshort.php-pnum:30-&tbnm="+$tbnm+"&tbsno="+$sresult["SNO"][$jj]+"')\"><img src=\"/ORG/BRAIN/images/icon/system/liuyan0.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"newwin('查看数据工单','/SPEC/EDITOR/anyjsshort.php?stid=aneVcy-sfile:anyjsshort.php-pnum:30-&tbnm="+$tbnm+"&tbsno="+$sresult["SNO"][$jj]+"&prob=problem')\"><img src=\"/ORG/BRAIN/images/icon/system/probm.svg\" style=\"width:20px;height:20px\"></a></td>\r\n";
       $demo=str_replace("[OPRT]","<a  href=\"javascript:void(0)\" "+$odspl+" onclick=\"update('"+$xid+"','"+$sresult["SNO"][$jj]+"')\" snox=\""+$sresult["SNO"][$jj]+"\"><img src=\"/ORG/BRAIN/images/icon/system/detail5.svg\" style=\"width:20px;height:20px;\"></a><a href=\"javascript:void(0)\" "+$vdspl+" onclick=\"qajaxp('修改记录','/DNA/EXF/anyrcv.php?appid="+$appid+"&tbnm="+$tbnm+"&kies="+$tbkis+"&SNO="+$sresult['SNO'][$jj]+"',"+$fmudt+")\" snox=\""+$sresult["SNO"][$jj]+"\"><img src=\"/ORG/BRAIN/images/icon/system/tongguoqr.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"Notiflix.Confirm.Show( '删除确认', '你确定要删除该条记录吗?', '是', '否', function(){ killsave('"+$tbnm+"','"+$sresult["SNO"][$jj]+"'); } );\" "+$xdspl+" snox=\""+$sresult["SNO"][$jj]+"\"><img src=\"/ORG/BRAIN/images/icon/system/shanchu13.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"newwin('查看数据评论','/SPEC/EDITOR/anyjsshort.php?stid=0Ak5hM-sfile:anyjsshort.php-pnum:30-&tbnm="+$tbnm+"&tbsno="+$sresult["SNO"][$jj]+"')\"><img src=\"/ORG/BRAIN/images/icon/system/liuyan0.svg\" style=\"width:20px;height:20px\"></a><a href=\"javascript:void(0)\"  onclick=\"newwin('查看数据工单','/SPEC/EDITOR/anyjsshort.php?stid=aneVcy-sfile:anyjsshort.php-pnum:30-&tbnm="+$tbnm+"&tbsno="+$sresult["SNO"][$jj]+"&prob=problem')\"><img src=\"/ORG/BRAIN/images/icon/system/probm.svg\" style=\"width:20px;height:20px\"></a>",$demo);
     };
    };
    $fmtb=$fmtb+"</tr>\r\n";    
    if ($totrst>0){
      $fmch=$fmch+$demo;
    }else{
    };
  };
  $tbdatay=new Array();
  $tbdatay["fmtb"]=$fmtb+"<br><br><br>";
  $tbdatay["fmch"]=$fmch;  
  $tbdatay["tmpdtx"]=$tmpdtx;
  return $tbdatay;
}
function makectraw($totk,$tbnm,$dtp,$ctraw,$sresult,$keyinfo,$kpart){
  $fmtd="";
 if (($ctraw*1==1)){
  $fmtd="";
  $fmtd=$fmtd+"<tr rowidx=\"x\">";
  for ($pp=0;$pp<$totk;$pp++){
    if (strpos(hou($kpart[$pp],"."),"clstxt")>0){
    }else{
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
           $fmtd=$fmtd+"<td knm=\""+hou($kpart[$pp],".")+"\"  "+$coldspl+">合计</td>\r\n";
         }else{
           if ($keyinfo[hou($kpart[$pp],".")]["COLUMN_TPNM"]=="int" || $keyinfo[hou($kpart[$pp],".")]["COLUMN_TPNM"]=="decimal"){
             $fmtd=$fmtd+"<td knm=\""+hou($kpart[$pp],".")+"\" "+$coldspl+">"+$sresult[hou($kpart[$pp],".")][$totrst+2]+"</td>\r\n";
           }else{
             $fmtd=$fmtd+"<td knm=\""+hou($kpart[$pp],".")+"\" "+$coldspl+"></td>\r\n";
           }
        };         
    };
  };//for
  if ($oprtx*1==1){
    if (strpos($tbnm,",")>0){//没有太大区分
      $fmtd=$fmtd+"<td knm=\"operation\">";
      if (strpos("."+$dtp,"nocreate")<=0){       
       $fmtd=$fmtd+"";
      };
      $fmtd=$fmtd+"</td>\r\n";
     }else{
      $fmtd=$fmtd+"<td knm=\"operation\">";
      if (strpos("."+$dtp,"nocreate")<=0){
        $fmtd=$fmtd+"";
      };
      $fmtd=$fmtd+"</td>\r\n";
     };
   };
    $fmtd=$fmtd+"</tr>"; 
  }
  return $fmtd;
}
function intval(sint){
   return Number(sint);
}
function makeaddoprt($totk,$appid,$tbnm,$tbkis,$dtp,$headx,$additemx,$oprtx,$keyinfo,$kpart){
  $fmtb="";
if (strpos("."+$dtp+$headx,"noadd")<=0 && ($additemx*1)==1){  
  $fmtb=$fmtb+"<tr rowidx=\"0\">";
  $fmdt="";
  $fmsdt="";
  for ($pp=0;$pp<$totk;$pp++){
     if (strpos(hou($kpart[$pp],"."),"clstxt")>0){
     }else{
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
              $fmtb=$fmtb+"<td knm=\""+hou($kpart[$pp],".")+"\" "+$coldspl+">"+formselect(qian($newonex,"|"),hou($newonex,"|"),"","p_"+hou($kpart[$pp],".")+"0","layui-select"," onchange")+"</td>";
              $yzd=$yzd+1;
            }else{
               $fmtb=$fmtb+"<td knm=\""+hou($kpart[$pp],".")+"\" "+$coldspl+"></td>";
              $yzd=$yzd+1;
            }
          }        
           if ($keyinfo[hou($kpart[$pp],".")]["COLUMN_DXTYPE"]=="clsduo"){             
             if(strpos($newonex,"|")>0){
              $fmtb=$fmtb+"<td knm=\""+hou($kpart[$pp],".")+"\" "+$coldspl+">"+formselectx(qian($newonex,"|"),hou($newonex,"|"),"","p_"+hou($kpart[$pp],".")+"0","","")+"</td>";
               $yzd=$yzd+1;
             }else{
               $fmtb=$fmtb+"<td knm=\""+hou($kpart[$pp],".")+"\" "+$coldspl+"></td>";
               $yzd=$yzd+1;
             }
          };
        if ($yzd==0){
              $fmtb=$fmtb+"<td knm=\""+hou($kpart[$pp],".")+"\" "+$coldspl+"></td>";
         };
    }else{
         $tmpdft="";
         if (_get("s_"+hou($kpart[$pp],".")+"0")==""){
           if (hou(tostring($keyinfo[hou($kpart[$pp],".")]["COLUMN_SSHOW"]),"|")!=""){
             //$x=eval(hou("x"+tostring($keyinfo[hou($kpart[$pp],".")]["COLUMN_SSHOW"]),"|"));
             $tmpdft="";//$thusvalue;
           };
         }else{
             $tmpdft=_get("s_"+hou($kpart[$pp],".")+"0");
         };
         if (strpos(",,"+$keyinfo["COLUMN"]["READONLY"]+"," , ","+hou($kpart[$pp],".")+",")>0 || $keyinfo[hou($kpart[$pp],".")]["COLUMN_CANGE"]=="0"){
           if (hou($kpart[$pp],".")=="SNO"){
              $snodspl="style=\"display:none;\"";
           }else{
              $snodspl="";
           };
             $fmtb=$fmtb+"<td knm=\""+hou($kpart[$pp],".")+"\"  "+$coldspl+"><input id=\"p_"+hou($kpart[$pp],".")+"0\" size=\"10\" readonly value=\""+$tmpdft+"\" "+$snodspl+" placeholder=\""+hou($kpart[$pp],".")+"\"></td>";
          }else{
           if (hou($kpart[$pp],".")=="SNO"){
             $snodspl="style=\"display:none;\"";
           }else{
             $snodspl="";
           };
            $fmtb=$fmtb+"<td knm=\""+hou($kpart[$pp],".")+"\"  "+$coldspl+"><input id=\"p_"+hou($kpart[$pp],".")+"0\" size=\"10\" value=\""+$tmpdft+"\" "+$snodspl+" placeholder=\""+hou($kpart[$pp],".")+"\"></td>";
          };
       };
       $tmpdft="";
       if (hou($kpart[$pp],".")!="SNO"){
         $fmdt=$fmdt+"'&p_"+hou($kpart[$pp],".")+"0='+$('#p_"+hou($kpart[$pp],".")+"0')+val()+";
         $fmsdt=$fmsdt+"'&s_"+hou($kpart[$pp],".")+"0='+$('#p_"+hou($kpart[$pp],".")+"0').val()+";
       };
     };//clstxt
   };//for
    $fmdt="'"+substr($fmdt,2,strlen($fmdt)-3);
    $fmsdt=substr($fmsdt,2,strlen($fmsdt)-3);
    if (strpos("."+$dtp+$headx,"noadd")<=0 && ($additemx*1)==1 && ($oprtx*1)==1){
      if (strpos($tbnm,",")>0){
           $fmtb=$fmtb+"<td knm=\"operation\">";
         if (strpos("."+$dtp+$headx,"nooprt")<=0 && ($additemx*1)==1){
           $fmtb=$fmtb+"<a href=\"javascript:void(0)\" onclick=\"ajaxhtmlpost('/DNA/EXF/anyrcv.php?appid="+$appid+"&tbnm="+$tbnm+"&SNO=0&kies="+$tbkis+"',"+$fmdt+");window.location.reload();\"><img src=\"/ORG/BRAIN/images/icon/system/newitem.svg\" style=\"width:20px;height:20px\"></a>";
         }
           $fmtb=$fmtb+"</th>\r\n"; 
      }else{
           $fmtb=$fmtb+"<td knm=\"operation\">";
      if (strpos("."+$dtp+$headx,"nooprt")<=0 && ($additemx*1)==1){
           $fmtb=$fmtb+"<a href=\"javascript:void(0)\" onclick=\"ajaxhtmlpost('/DNA/EXF/anyrcv.php?appid="+$appid+"&tbnm="+$tbnm+"&SNO=0&kies="+$tbkis+"',"+$fmdt+");window.location.reload();\"><img src=\"/ORG/BRAIN/images/icon/system/newitem.svg\" style=\"width:20px;height:20px\"></a>";
      };
           $fmtb=$fmtb+"</th>\r\n";
      };
    };
    $fmtb=$fmtb+"</tr>\r\n";    
 };//判断展示与否的控件
  return $fmtb;
}
function pagexyz($totye,$pg,$pgn,$allkillbtn,$totallrst,$tbnm){
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
   $fmslct=$fmslct+($t+1)+",";
   $fmslctb=$fmslctb+"第"+($t+1)+"页,";
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
   if ($pg==($t+1)){
      $fmy=$fmy+"<span class=\"layui-laypage-curr\"><em class=\"layui-laypage-em\"></em><em>"+($t+1)+"</em></span>";      
   }else{
      $fmy=$fmy+"<a href=\"javascript:void(0);\" onclick=\"tospage("+($t+1)+")\">"+($t+1)+"</a>";      
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

  $fmy="<div id=\"customPages\" class=\"customPages\"><a href=\"javascript:void(0)\" onclick=\"tochange()\"><img id=\"tcg\" src=\"/ORG/BRAIN/images/icon/system/移动.svg\" style=\"width:20px;height:20px;\"></a><a href=\"javascript:void(0);\" id=\"setwh\" style=\"display:none;\" onclick=\"setwh()\">设置</a><a href=\"javascript:void(0)\" onclick=\"window.open(location.href)\"><img src=\"/ORG/BRAIN/images/icon/system/qj37.svg\" style=\"width:20px;height:20px;\"></a><span class=\"layui-laypage-count\">共"+$totallrst+"条(共"+$totye+"页)</span><span class=\"layui-laypage-limits\">"+$fmselectjs+"</span><span class=\"layui-laypage-limits\">"+$fmpagejs+"</span><div class=\"layui-box layui-laypage layui-laypage-default\" id=\"layui-laypage-1\"><a href=\"javascript:void(0)\" onclick=\"tospage("+$lstpg+")\" class=\"layui-laypage-prev\" data-page=\""+$lstpg+"\">上一页</a><a href=\"javascript:void(0);\" onclick=\"tospage(1)\" class=\"layui-laypage-first\">首页</a>"+$fmy+"<a href=\"javascript:void(0)\" onclick=\"tospage("+$totye+")\" class=\"layui-laypage-last\">尾页</a><a href=\"javascript:void(0);\" onclick=\"tospage("+$nxtpg+")\" class=\"layui-laypage-next\" data-page=\""+$nxtpg+"\">下一页</a></div>&nbsp;&nbsp;&nbsp;<a class=\"layui-btn\" id=\"tbnm\" tbnm=\""+$tbnm+"\" "+$allkh+" onclick=\"plsc('','"+$tbnm+"');\">批量删除</a>&nbsp;&nbsp;&nbsp;<a class=\"layui-btn\"  onclick=\"quanxuan();\">全选</a>&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" id=\"isu\" onclick=\"changeb()\"><img src=\"/ORG/BRAIN/images/icon/system/xg0.svg\" style=\"width:20px;height:20px;\"></a><input id=\"isupdate\" type=\"hidden\" value=\"0\" lay-skin=\"primary\"></div>";
 return $fmy; 
}
function pageabc($totye,$pg,$pgn,$totallrst,$tbnm){
  if (($totye>0)==false ){
    $totye=1;
  }else{
    $totye=Math.ceil($totye);
  }
  if (($pg>0)==false ){
    $pg=1;
  }
  if (($pgn>0)==false ){
    $pgn=30;
  }
  if ( $pg=="NaN"){
    $pg=1;
  }  
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
   $fmslct=$fmslct+($t+1)+",";
   $fmslctb=$fmslctb+"第"+($t+1)+"页,";
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
   if ($pg==($t+1)){
      $fmy=$fmy+"<span class=\"layui-laypage-curr\"><em class=\"layui-laypage-em\"></em><em>"+($t+1)+"</em></span>";      
   }else{
      $fmy=$fmy+"<a href=\"javascript:void(0);\" onclick=\"tospage("+($t+1)+")\">"+($t+1)+"</a>";      
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

  $fmy="<a href=\"javascript:void(0)\" onclick=\"tochange()\"><img id=\"tcg\" src=\"/ORG/BRAIN/images/icon/system/移动.svg\" style=\"width:20px;height:20px;\"></a><a href=\"javascript:void(0);\" id=\"setwh\" style=\"display:none;\" onclick=\"setwh()\">设置</a><a href=\"javascript:void(0)\" onclick=\"window.open(location.href)\"><img src=\"/ORG/BRAIN/images/icon/system/qj37.svg\" style=\"width:20px;height:20px;\"></a><span class=\"layui-laypage-count\">共"+$totallrst+"条(共"+$totye+"页)</span><span class=\"layui-laypage-limits\">"+$fmselectjs+"</span><span class=\"layui-laypage-limits\">"+$fmpagejs+"</span><div class=\"layui-box layui-laypage layui-laypage-default\" id=\"layui-laypage-1\"><a href=\"javascript:void(0)\" onclick=\"tospage("+$lstpg+")\" class=\"layui-laypage-prev\" data-page=\""+$lstpg+"\">上一页</a><a href=\"javascript:void(0);\" onclick=\"tospage(1)\" class=\"layui-laypage-first\">首页</a>"+$fmy+"<a href=\"javascript:void(0)\" onclick=\"tospage("+$totye+")\" class=\"layui-laypage-last\">尾页</a><a href=\"javascript:void(0);\" onclick=\"tospage("+$nxtpg+")\" class=\"layui-laypage-next\" data-page=\""+$nxtpg+"\">下一页</a></div>&nbsp;&nbsp;&nbsp;<a class=\"layui-btn\" id=\"tbnm\" tbnm=\""+$tbnm+"\"  onclick=\"plsc('','"+$tbnm+"');\">批量删除</a>&nbsp;&nbsp;&nbsp;<a class=\"layui-btn\"  onclick=\"quanxuan();\">全选</a>&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" id=\"isu\" onclick=\"changeb()\"><img src=\"/ORG/BRAIN/images/icon/system/xg0.svg\" style=\"width:20px;height:20px;\"></a><input id=\"isupdate\" type=\"hidden\" value=\"0\" lay-skin=\"primary\">";
 return $fmy; 
}
//页面识别本用户访问是否有错误码--

function exchangestr($strx,$xid,$tbnm){
  if ($strx!=""){
    $nhtxt=$strx;
    if ($nhtxt.indexOf("get-")>0){
     $ptnhtxt=explode("[get-",$nhtxt);
     $totpt=count($ptnhtxt);
     for ($f=0;$f<$totpt;$f++){
       $tmpok=qian($ptnhtxt[$f],"]");
       $nhtxt=str_replace("[get-"+$tmpok+"]",_get($tmpok),$nhtxt);     
     };
    }
   if ($nhtxt.indexOf("atv-")>0){ 
    if (strpos($nhtxt,"{atv-")>0){
      $ptatv=explode("{atv-",$nhtxt);
      $totatv=count($ptatv);
      for ($g=0;$g<$totatv;$g++){
        $tmpatv=qian($ptatv[$g],"}");
        $nhtxt=str_replace("{atv-"+$tmpatv+"}",atv($tmpatv),$nhtxt);
      };
    };
   };
   if ($nhtxt.indexOf("utv-")>0){
    if (strpos($nhtxt,"{utv-")>0){
      $ptutv=explode("{utv-",$nhtxt);
      $totutv=count($ptutv);
     for ($h=0;$h<$totutv;$h++){
       $tmputv=qian($ptutv[$h],"}");
       $nhtxt=str_replace("{utv-"+$tmputv+"}",utv($tmputv),$nhtxt);
     };
    };
   };
    $nhtxt=str_replace("[shortid]",$xid,$nhtxt);
    $nhtxt=str_replace("[tablename]",$tbnm,$nhtxt);
    return $nhtxt;
  }else{
    return "";
  }
}
function setkeysearch($shortid){
 $tmfx='<script>\
   $(function() {\
    layui.use(\'laydate\', function() {\
     var laydate = layui.laydate;\
     laydate.render({\
      elem: \'#qa_[keyid][N]\'\
     });\
     laydate.render({\
      elem: \'#qb_[keyid][N]\'\
     });\
    });\
   })\
</script>';
$allkeyx=SX("select COLUMN_NAME,DATA_TYPE,keytitle,VQX,clstxt,dxtype from coode_keydetaily where shortid='"+$shortid+"' and VQX>0");
$fmlix="";
$fmkix="";
$tot=countresult($allkeyx);
$prevqx=anyvalue($allkeyx,"VQX",0);
for ($i=0;$i<$tot;$i++){
  $fmkix=$fmkix+anyvalue($allkeyx,"COLUMN_NAME",$i)+":"+anyvalue($allkeyx,"DATA_TYPE",$i)+"/";
      if (anyvalue($allkeyx,"clstxt",$i)!=""){
                $newonex=anyvalue($allkeyx,"clstxt",$i);                
      };
  switch (anyvalue($allkeyx,"DATA_TYPE",$i)){
    case "tinyint":    
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
        if (anyvalue($allkeyx,"clstxt",$i)!=""){
         $tmpkx="<label class=\"layui-form-label\" >"+cut_str(anyvalue($allkeyx,"keytitle",$i),3)+"</label><div class=\"layui-input-inline\" >"+formselect(qian($newonex,"|"),hou($newonex,"|"),"","q_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]","layui-select","")+"</div>";
        }else{
         $tmpkx="<label class=\"layui-form-label\" >"+cut_str(anyvalue($allkeyx,"keytitle",$i),3)+"</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"qa_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"8\">--<input id=\"qb_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"8\"></div>";
        }
      }else{
       if (anyvalue($allkeyx,"clstxt",$i)!=""){
        $tmpkx="<label class=\"layui-form-label\" >"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"</label><div class=\"layui-input-inline\" >"+formselect(qian($newonex,"|"),hou($newonex,"|"),"","q_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]","layui-select","")+"</div>";
       }else{
        $tmpkx="<label class=\"layui-form-label\" >"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"qa_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"8\">--<input id=\"qb_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"8\"></div>";
       }
      };
    break;
    case "int":           
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
        if (anyvalue($allkeyx,"clstxt",$i)!=""){
         $tmpkx="<label class=\"layui-form-label\" >"+cut_str(anyvalue($allkeyx,"keytitle",$i),3)+"</label><div class=\"layui-input-inline\" >"+formselect(qian($newonex,"|"),hou($newonex,"|"),"","q_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]","layui-select","")+"</div>";
        }else{
         $tmpkx="<label class=\"layui-form-label\" >"+cut_str(anyvalue($allkeyx,"keytitle",$i),3)+"</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"qa_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"8\">--<input id=\"qb_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"8\"></div>";
        };
      }else{
        if (anyvalue($allkeyx,"clstxt",$i)!=""){
         $tmpkx="<label class=\"layui-form-label\" >"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"</label><div class=\"layui-input-inline\" >"+formselect(qian($newonex,"|"),hou($newonex,"|"),"","q_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]","layui-select","")+"</div>";
        }else{
         $tmpkx="<label class=\"layui-form-label\" >"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"qa_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"8\">--<input id=\"qb_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"8\"></div>";
        }
      };
    break;
    case "date":
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
         $tmpkx="<label class=\"layui-form-label\" >"+cut_str(anyvalue($allkeyx,"keytitle",$i),3)+"</label><div class=\"layui-input-inline\" ><input id=\"qa_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"10\">-<input id=\"qb_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"10\">"+str_replace("[keyid]",anyvalue($allkeyx,"COLUMN_NAME",$i),$tmfx)+"</div>";
      }else{
        $tmpkx="<label class=\"layui-form-label\" >"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"</label><div class=\"layui-input-inline\" ><input id=\"qa_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"10\">-<input id=\"qb_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"10\">"+str_replace("[keyid]",anyvalue($allkeyx,"COLUMN_NAME",$i),$tmfx)+"</div>";
      };
    break;
    case "datetime":
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
         $tmpkx="<label class=\"layui-form-label\" >"+cut_str(anyvalue($allkeyx,"keytitle",$i),3)+"</label><div class=\"layui-input-inline\" ><input id=\"qa_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"10\">-<input id=\"qb_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"10\">"+str_replace("[keyid]",anyvalue($allkeyx,"COLUMN_NAME",$i),$tmfx)+"</div>";
      }else{
        $tmpkx="<label class=\"layui-form-label\" >"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"</label><div class=\"layui-input-inline\" ><input id=\"qa_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"10\">-<input id=\"qb_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"10\">"+str_replace("[keyid]",anyvalue($allkeyx,"COLUMN_NAME",$i),$tmfx)+"</div>";
      };
    break;
    case "varchar":          
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
         if (anyvalue($allkeyx,"clstxt",$i)!=""){
           $tmpkx="<label class=\"layui-form-label\" >"+cut_str(anyvalue($allkeyx,"keytitle",$i),3)+"</label><div class=\"layui-input-inline\" >"+formselect(qian($newonex,"|"),hou($newonex,"|"),"","q_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]","layui-select","")+"</div>";
         }else{
           $tmpkx="<label class=\"layui-form-label\" >"+cut_str(anyvalue($allkeyx,"keytitle",$i),3)+"</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"q_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" ></div>";
         }
      }else{
        if (anyvalue($allkeyx,"clstxt",$i)!=""){
          $tmpkx="<label class=\"layui-form-label\" >"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"</label><div class=\"layui-input-inline\" >"+formselect(qian($newonex,"|"),hou($newonex,"|"),"","q_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]","layui-select","")+"</div>";
        }else{
          $tmpkx="<label class=\"layui-form-label\" >"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"q_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" ></div>";
        }
      };      
    break;
    case "text":
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
         $tmpkx="<label class=\"layui-form-label\" >"+cut_str(anyvalue($allkeyx,"keytitle",$i),3)+"</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"q_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" ></div>";
      }else{
        $tmpkx="<label class=\"layui-form-label\" >"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"q_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" ></div>";
      };
    break;
    case "decimal":
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
         $tmpkx="<label class=\"layui-form-label\" >"+cut_str(anyvalue($allkeyx,"keytitle",$i),3)+"</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"qa_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"4\">--<input id=\"qb_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"4\"></div>";
      }else{
        $tmpkx="<label class=\"layui-form-label\" >"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"</label><div class=\"layui-input-inline\" ><inpu class=\"layui-input\"t id=\"qa_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"4\">--<input id=\"qb_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"4\"></div>";
      };
    break;
    case "float":
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
         $tmpkx="<label class=\"layui-form-label\" >"+cut_str(anyvalue($allkeyx,"keytitle",$i),3)+"</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"qa_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"4\">--<input id=\"qb_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"4\"></div>";
      }else{
        $tmpkx="<label class=\"layui-form-label\" >"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"qa_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"4\">--<input id=\"qb_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" size=\"4\"></div>";
      };
    break;
    default:
      if (anyvalue($allkeyx,"keytitle",$i)!=""){
         $tmpkx="<label class=\"layui-form-label\" >"+cut_str(anyvalue($allkeyx,"keytitle",$i),3)+"</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"q_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" ></div>";
      }else{
        $tmpkx="<label class=\"layui-form-label\" >"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"</label><div class=\"layui-input-inline\" ><input class=\"layui-input\" id=\"q_"+anyvalue($allkeyx,"COLUMN_NAME",$i)+"[N]\" ></div>";
      };      
  }//switch
  if (intval(anyvalue($allkeyx,"VQX",$i))==intval($prevqx)){
    $fmlix=$fmlix+""+$tmpkx+"";
  }else{
    $fmlix=$fmlix+"</div><div class=\"layui-form-item\" style=\"margin-left:55px;\">"+$tmpkx+"";
  }
  $prevqx=anyvalue($allkeyx,"VQX",$i);
}//for
  $fmlix=str_replace("[N]","0",$fmlix);
  if ($tot>0){
        $scbtn='<div class="layui-input-inline" style="margin-left:125px;">\
         <a class="layui-btn" onclick="supersearch(\''+$xid+'\',0)">超级检索</a>\
       </div>';       
  }else{
   $scbtn="";
  }
  return $fmlix+$scbtn;  
}
function tablist($frsts,$tbnm,$tbkis,$tota,$page,$xid){
 
 $totrst=countresult($frsts);
 $totallrst=$totrst;
 $kpart=explode(",",$tbkis);
 $totk=count($kpart);  
 $sresult=arrdata($frsts); 
 $fmtbx="";
  eval("$keyinfo="+$tbnm+"kbase;"); 
  $shortbase=shortinfo($xid);
  $diycode=$shortbase["diycode"];
  $addpage=$shortbase["addpage"];
  $addtitle=$shortbase["addtitle"];
  $shorttitle=$shortbase["shorttitle"];
  $updatepage=$shortbase["updatepage"];
  $detailpage=$shortbase["detailpage"];
  $additemx=$shortbase["additemx"];
  $newbutton=$shortbase["newbutton"];
  $obtn=$shortbase["obtn"];
  $vbtn=$shortbase["vbtn"];
  $xbtn=$shortbase["xbtn"];
  $oprtx=$shortbase["oprtx"];
  $headx=$shortbase["headx"];
  $diytop=$shortbase["diytop"];
  $diybottom=$shortbase["diybottom"];
  $topbtn=$shortbase["topbtn"];
  $bottombtn=$shortbase["bottombtn"];
  $tbhd=$shortbase["tbhd"];
  $dtx=$shortbase["dtx"];
  $ctraw=$shortbase["ctraw"];
  $allkillbtn=$shortbase["allkillbtn"];
  $gsqc=$_GET["sqc"];
  $dbtn=formdiybtn($xid,$diycode);
  
  $tabsrd="<table  name=\"tabunit\" class=\"layui-table\"    tbname=\""+$tbnm+"\" tbkies=\""+$tbkis+"\"   totrcd=\""+$tota+"\" prepage=\""+$page+"\"  >@tbheadbody@</table>";
 
  $fmtbx=$fmtbx+"<thead><tr rowidx=\"head\">";
  
  $chtml="";
  
  $dtp="html";
 
  $headxyz=maketbheadin($totk,$chtml,$dtp,$tbhd,$oprtx,$headx,$keyinfo,$kpart);   
  
  $fmtbx=$fmtbx+$headxyz["ftb"]+"</tr></thead><tbody>";   
  
  $tbdatax=maketbdata($totrst,$chtml,$tbnm,$sresult,$kpart,$keyinfo,$xid); 
  
  $fmtbx=$fmtbx+$tbdatax["fmtb"];
    
  $fmtbx=$fmtbx+makectraw($totk,$tbnm,$dtp,$ctraw,$sresult,$keyinfo,$kpart);    
  
  $fmtbx=$fmtbx+makeaddoprt($totk,$appid,$tbnm,$tbkis,"html",$headx,$additemx,$oprtx,$keyinfo,$kpart);  
 

  
  $fmtbx=$fmtbx+"</tbody>";
  
  $tabledata=$tabsrd.replace("@tbheadbody@",$fmtbx);    
  $tabdata=new Array();
  $tabdata["html"]=$tabledata;
  $tabdata["tmpdtx"]=$tbdatax["tmpdtx"];
  return $tabdata;

 }//fun
String.prototype.MD5 = function (bit)
{
    var sMessage = this;
    function RotateLeft(lValue, iShiftBits) { return (lValue<<iShiftBits) | (lValue>>>(32-iShiftBits)); } 
    function AddUnsigned(lX,lY)
    {
        var lX4,lY4,lX8,lY8,lResult;
        lX8 = (lX & 0x80000000);
        lY8 = (lY & 0x80000000);
        lX4 = (lX & 0x40000000);
        lY4 = (lY & 0x40000000);
        lResult = (lX & 0x3FFFFFFF)+(lY & 0x3FFFFFFF); 
        if (lX4 & lY4) return (lResult ^ 0x80000000 ^ lX8 ^ lY8); 
        if (lX4 | lY4)
        { 
            if (lResult & 0x40000000) return (lResult ^ 0xC0000000 ^ lX8 ^ lY8); 
            else return (lResult ^ 0x40000000 ^ lX8 ^ lY8); 
        } else return (lResult ^ lX8 ^ lY8); 
    } 
    function F(x,y,z) { return (x & y) | ((~x) & z); } 
    function G(x,y,z) { return (x & z) | (y & (~z)); } 
    function H(x,y,z) { return (x ^ y ^ z); } 
    function I(x,y,z) { return (y ^ (x | (~z))); } 
    function FF(a,b,c,d,x,s,ac)
    { 
        a = AddUnsigned(a, AddUnsigned(AddUnsigned(F(b, c, d), x), ac)); 
        return AddUnsigned(RotateLeft(a, s), b); 
    } 
    function GG(a,b,c,d,x,s,ac)
    { 
        a = AddUnsigned(a, AddUnsigned(AddUnsigned(G(b, c, d), x), ac)); 
        return AddUnsigned(RotateLeft(a, s), b); 
    } 
    function HH(a,b,c,d,x,s,ac)
    { 
        a = AddUnsigned(a, AddUnsigned(AddUnsigned(H(b, c, d), x), ac)); 
        return AddUnsigned(RotateLeft(a, s), b); 
    } 
    function II(a,b,c,d,x,s,ac)
    { 
        a = AddUnsigned(a, AddUnsigned(AddUnsigned(I(b, c, d), x), ac)); 
        return AddUnsigned(RotateLeft(a, s), b); 
    } 
    function ConvertToWordArray(sMessage)
    { 
        var lWordCount; 
        var lMessageLength = sMessage.length; 
        var lNumberOfWords_temp1=lMessageLength + 8; 
        var lNumberOfWords_temp2=(lNumberOfWords_temp1-(lNumberOfWords_temp1 % 64))/64; 
        var lNumberOfWords = (lNumberOfWords_temp2+1)*16; 
        var lWordArray=Array(lNumberOfWords-1); 
        var lBytePosition = 0; 
        var lByteCount = 0; 
        while ( lByteCount < lMessageLength )
        { 
            lWordCount = (lByteCount-(lByteCount % 4))/4; 
            lBytePosition = (lByteCount % 4)*8; 
            lWordArray[lWordCount] = (lWordArray[lWordCount] | (sMessage.charCodeAt(lByteCount)<<lBytePosition)); 
            lByteCount++; 
        } 
        lWordCount = (lByteCount-(lByteCount % 4))/4; 
        lBytePosition = (lByteCount % 4)*8; 
        lWordArray[lWordCount] = lWordArray[lWordCount] | (0x80<<lBytePosition); 
        lWordArray[lNumberOfWords-2] = lMessageLength<<3; 
        lWordArray[lNumberOfWords-1] = lMessageLength>>>29; 
        return lWordArray; 
    } 
    function WordToHex(lValue)
    { 
        var WordToHexValue="",WordToHexValue_temp="",lByte,lCount; 
        for (lCount = 0;lCount<=3;lCount++)
        { 
            lByte = (lValue>>>(lCount*8)) & 255; 
            WordToHexValue_temp = "0" + lByte.toString(16); 
            WordToHexValue = WordToHexValue + WordToHexValue_temp.substr(WordToHexValue_temp.length-2,2); 
        } 
        return WordToHexValue; 
    } 
    var x=Array(); 
    var k,AA,BB,CC,DD,a,b,c,d 
    var S11=7, S12=12, S13=17, S14=22; 
    var S21=5, S22=9 , S23=14, S24=20; 
    var S31=4, S32=11, S33=16, S34=23; 
    var S41=6, S42=10, S43=15, S44=21; 
    // Steps 1 and 2. Append padding bits and length and convert to words 
    x = ConvertToWordArray(sMessage); 
    // Step 3. Initialise 
    a = 0x67452301; b = 0xEFCDAB89; c = 0x98BADCFE; d = 0x10325476; 
    // Step 4. Process the message in 16-word blocks 
    for (k=0;k<x.length;k+=16)
    { 
        AA=a; BB=b; CC=c; DD=d; 
        a=FF(a,b,c,d,x[k+0], S11,0xD76AA478); 
        d=FF(d,a,b,c,x[k+1], S12,0xE8C7B756); 
        c=FF(c,d,a,b,x[k+2], S13,0x242070DB); 
        b=FF(b,c,d,a,x[k+3], S14,0xC1BDCEEE); 
        a=FF(a,b,c,d,x[k+4], S11,0xF57C0FAF); 
        d=FF(d,a,b,c,x[k+5], S12,0x4787C62A); 
        c=FF(c,d,a,b,x[k+6], S13,0xA8304613); 
        b=FF(b,c,d,a,x[k+7], S14,0xFD469501); 
        a=FF(a,b,c,d,x[k+8], S11,0x698098D8); 
        d=FF(d,a,b,c,x[k+9], S12,0x8B44F7AF); 
        c=FF(c,d,a,b,x[k+10],S13,0xFFFF5BB1); 
        b=FF(b,c,d,a,x[k+11],S14,0x895CD7BE); 
        a=FF(a,b,c,d,x[k+12],S11,0x6B901122); 
        d=FF(d,a,b,c,x[k+13],S12,0xFD987193); 
        c=FF(c,d,a,b,x[k+14],S13,0xA679438E); 
        b=FF(b,c,d,a,x[k+15],S14,0x49B40821); 
        a=GG(a,b,c,d,x[k+1], S21,0xF61E2562); 
        d=GG(d,a,b,c,x[k+6], S22,0xC040B340); 
        c=GG(c,d,a,b,x[k+11],S23,0x265E5A51); 
        b=GG(b,c,d,a,x[k+0], S24,0xE9B6C7AA); 
        a=GG(a,b,c,d,x[k+5], S21,0xD62F105D); 
        d=GG(d,a,b,c,x[k+10],S22,0x2441453); 
        c=GG(c,d,a,b,x[k+15],S23,0xD8A1E681); 
        b=GG(b,c,d,a,x[k+4], S24,0xE7D3FBC8); 
        a=GG(a,b,c,d,x[k+9], S21,0x21E1CDE6); 
        d=GG(d,a,b,c,x[k+14],S22,0xC33707D6); 
        c=GG(c,d,a,b,x[k+3], S23,0xF4D50D87); 
        b=GG(b,c,d,a,x[k+8], S24,0x455A14ED); 
        a=GG(a,b,c,d,x[k+13],S21,0xA9E3E905); 
        d=GG(d,a,b,c,x[k+2], S22,0xFCEFA3F8); 
        c=GG(c,d,a,b,x[k+7], S23,0x676F02D9); 
        b=GG(b,c,d,a,x[k+12],S24,0x8D2A4C8A); 
        a=HH(a,b,c,d,x[k+5], S31,0xFFFA3942); 
        d=HH(d,a,b,c,x[k+8], S32,0x8771F681); 
        c=HH(c,d,a,b,x[k+11],S33,0x6D9D6122); 
        b=HH(b,c,d,a,x[k+14],S34,0xFDE5380C); 
        a=HH(a,b,c,d,x[k+1], S31,0xA4BEEA44); 
        d=HH(d,a,b,c,x[k+4], S32,0x4BDECFA9); 
        c=HH(c,d,a,b,x[k+7], S33,0xF6BB4B60); 
        b=HH(b,c,d,a,x[k+10],S34,0xBEBFBC70); 
        a=HH(a,b,c,d,x[k+13],S31,0x289B7EC6); 
        d=HH(d,a,b,c,x[k+0], S32,0xEAA127FA); 
        c=HH(c,d,a,b,x[k+3], S33,0xD4EF3085); 
        b=HH(b,c,d,a,x[k+6], S34,0x4881D05); 
        a=HH(a,b,c,d,x[k+9], S31,0xD9D4D039); 
        d=HH(d,a,b,c,x[k+12],S32,0xE6DB99E5); 
        c=HH(c,d,a,b,x[k+15],S33,0x1FA27CF8); 
        b=HH(b,c,d,a,x[k+2], S34,0xC4AC5665); 
        a=II(a,b,c,d,x[k+0], S41,0xF4292244); 
        d=II(d,a,b,c,x[k+7], S42,0x432AFF97); 
        c=II(c,d,a,b,x[k+14],S43,0xAB9423A7); 
        b=II(b,c,d,a,x[k+5], S44,0xFC93A039); 
        a=II(a,b,c,d,x[k+12],S41,0x655B59C3); 
        d=II(d,a,b,c,x[k+3], S42,0x8F0CCC92); 
        c=II(c,d,a,b,x[k+10],S43,0xFFEFF47D); 
        b=II(b,c,d,a,x[k+1], S44,0x85845DD1); 
        a=II(a,b,c,d,x[k+8], S41,0x6FA87E4F); 
        d=II(d,a,b,c,x[k+15],S42,0xFE2CE6E0); 
        c=II(c,d,a,b,x[k+6], S43,0xA3014314); 
        b=II(b,c,d,a,x[k+13],S44,0x4E0811A1); 
        a=II(a,b,c,d,x[k+4], S41,0xF7537E82); 
        d=II(d,a,b,c,x[k+11],S42,0xBD3AF235); 
        c=II(c,d,a,b,x[k+2], S43,0x2AD7D2BB); 
        b=II(b,c,d,a,x[k+9], S44,0xEB86D391); 
        a=AddUnsigned(a,AA); b=AddUnsigned(b,BB); c=AddUnsigned(c,CC); d=AddUnsigned(d,DD); 
    }
    if(bit==32)
    {
        return WordToHex(a)+WordToHex(b)+WordToHex(c)+WordToHex(d);
    }
    else
    {
        return WordToHex(b)+WordToHex(c);
    }
}
function timestampFormat( timestamp ) {
function zeroize( num ) {
return (String(num).length == 1 ? '0' : '') + num;
}

var curTimestamp = parseInt(new Date().getTime() / 1000); //当前时间戳
var timestampDiff = curTimestamp - timestamp; // 参数时间戳与当前时间戳相差秒数

var curDate = new Date( curTimestamp * 1000 ); // 当前时间日期对象
var tmDate = new Date( timestamp * 1000 ); // 参数时间戳转换成的日期对象

var Y = tmDate.getFullYear(), m = tmDate.getMonth() + 1, d = tmDate.getDate();
var H = tmDate.getHours(), i = tmDate.getMinutes(), s = tmDate.getSeconds();

if ( timestampDiff < 60 ) { // 一分钟以内
return "刚刚";
} else if( timestampDiff < 3600 ) { // 一小时前之内
return Math.floor( timestampDiff / 60 ) + "分钟前";
} else if ( curDate.getFullYear() == Y && curDate.getMonth()+1 == m && curDate.getDate() == d ) {
return '今天' + zeroize(H) + ':' + zeroize(i);
} else {
var newDate = new Date( (curTimestamp - 86400) * 1000 ); // 参数中的时间戳加一天转换成的日期对象
if ( newDate.getFullYear() == Y && newDate.getMonth()+1 == m && newDate.getDate() == d ) {
return '昨天' + zeroize(H) + ':' + zeroize(i);
} else if ( curDate.getFullYear() == Y ) {
return zeroize(m) + '月' + zeroize(d) + '日 ' + zeroize(H) + ':' + zeroize(i);
} else {
return Y + '年' + zeroize(m) + '月' + zeroize(d) + '日 ' + zeroize(H) + ':' + zeroize(i);
}
}
}
function makedttm(date){         
 var strDate = date.getFullYear()+"-"; 
 strDate += date.getMonth()+1+"-";       
 strDate += date.getDate()+"-";      
 strDate += date.getHours()+":";     
 strDate += date.getMinutes()+":";       
  strDate += date.getSeconds();     
  return strDate ;  
 } 
