<?php
$step=iget("step");
$act=iget("act");
$gl=iget("gl");
$glu=iget("glu");
$glp=iget("glp");
$glb=iget("glb");
$sysid=iget("sysid");
$host=iget("host");
$regcode=iget("glr");
 error_reporting(0);
 register_shutdown_function('zyfshutdownfunc'); 
 set_error_handler('zyferror');
if ($host==""){
  $host="coode.com.cn";
}
if ($act==""){
  $getcode=file_get_contents("http://".$host."/DNA/EXF/anyfuns.php?fid=installbystep&step=".$step."&sysid=".$sysid."&gl=".$gl."&glu=".$glu."&glp=".$glp."&glb=".$glb."&host=".$host);
  echo $getcode;
}else{  
  if ($gl!="" and $glu!="" and $glp!="" and $glb!="" and $regcode!=""){
   $bkcore=file_get_contents("http://".$host."/DNA/EXF/anyfuns.php?fid=getcorefun&regcode=".$regcode."&sysid=".$sysid);
   if (strpos($bkcore,"-PERMISSIONS FOR")<=0){
    $bkcore=str_replace("[gl]",$gl,$bkcore);
    $bkcore=str_replace("[glu]",$glu,$bkcore);
    $bkcore=str_replace("[glp]",$glp,$bkcore);
    $bkcore=str_replace("[glb]",$glb,$bkcore);
    $bkcore=str_replace("[gln]",$sysid,$bkcore);
    $bkcore=str_replace("[glt]",$glb."@".$gl,$bkcore);
    $bkcore=str_replace("[motherhost]",$host,$bkcore);
    $bkcore=str_replace("[regcode]",$regcode,$bkcore); 
    eval($bkcore);
	switch($act){
    case "test":      
       $imark=iget("imark");
       $earth='<?php'.huanhang().$bkcore.huanhang().'?>';      
      $pathx=combineurl(localroot(),"RNA");
      is_dir($pathx) OR mkdir($pathx, 0777, true);       
      $conn=mysql_connect(gl(),glu(),glp());
      $x=updatingx($conn,"information_schema","select count(*) as result from SCHEMATA where SCHEMA_NAME='".glb()."'","utf8");                  
      if (intval($x)>0 ){
        $z=overfile(combineurl($pathx,"EARTH.php"),$earth);
        $getctab=file_get_contents("http://".$host."/DNA/EXF/anyfuns.php?fid=getcoodetab&host=".$host."&sysid=".$sysid."&imark=".$imark);
        $z=runinstall("","",$getctab,$imark);
        echo "1";
      }else{
        echo "0";
      }
    break;
    case "coodefiles":
        $part=iget("part");
        $geteval=file_get_contents("http://".$host."/DNA/EXF/anyfuns.php?fid=getcoodefiles&host=".$host."&part=".$part);        
        $zz=downunits($geteval,$host);
        echo "1";
    break;
    case "publicfiles":
        $getunits=file_get_contents("http://".$host."/DNA/EXF/anyfuns.php?fid=getsysunits&host=".$host."&sysid=public");
        $zz=downunits($getunits,$host);
        echo "1";
   break;
    case "sysfiles":
        $getunits=file_get_contents("http://".$host."/DNA/EXF/anyfuns.php?fid=getsysunits&host=".$host."&sysid=".$sysid);
        $zz=downunits($getunits,$host);
        echo "1";
    break;       
    default:
       $ids=ipost("ids").iget("ids");
       $imark=iget("imark");
       if ($ids!=""){  
        $getcode=file_get_contents("http://".$host."/DNA/EXF/anyfuns.php?fid=getinstallbak&act=".$act."&ids=".$ids."&sysid=".$sysid."&imark=".$imark);         
        if ($getcode!="nodata" and strpos("XX".$getcode,"SE:")<=0){          
          $z=runinstall($act,$ids,$getcode,$imark);          
          echo $z;
        }else{          
          echo "1:SE-".$getcode;
        }         
       }else{
         echo "1";
       };
   }
  }else{
	  echo "-1";
  }   
 }else{    
    if ($act=="judge"){          
      $host=iget("orisite");
      echo file_get_contents("http://".$host."/DNA/EXF/anyfuns.php?fid=iscoode");      
    }else{           
      if ($act=="uperror"){
        $upstr=iget("upstr");
        $imark=iget("imark");
        $sysid=iget("sysid");               
        $host=iget("host");
        $upe=file_get_contents("http://".$host."/DNA/EXF/anyfuns.php?fid=uperror&upstr=".$upstr."&imark=".$imark."&sysid=".$sysid);
        echo $upe;
      }else{        
       echo "0";
      }
    }
 }
}
function iget($str){ 
$val = !empty($_GET[$str]) ? $_GET[$str] : ""; 
return $val; 
} 
function ipost($str){ 
$val = !empty($_POST[$str]) ? $_POST[$str] : ""; 
return $val; 
} 
?>