<?php
require_once('model.php');//定义类
function transitop($itopurl,$version,$auth_user,$auth_passwd,$json_data){ //连接itop函数
  $fields=array(
  'version'=>urlencode($version),
  'auth_user'=>urlencode($auth_user),
  'auth_pwd'=>urlencode($auth_passwd),
  'json_data'=>urlencode($json_data),
   );  
  foreach($fields as $key=>$value)
  {
    $fields_string.=$key.'='.$value.'&';   
  }
  $fields_string=rtrim($fields_string,'&');
   //echo  $fields_string;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_POST, count($fields));
  curl_setopt($ch, CURLOPT_URL, $itopurl);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//fan hui de shuju keyi fuzhi gei qita bianliang 
 $response=curl_exec($ch); 
//var_dump(json_decode($response, true));//var_dump打印类型及数值
$objects=json_decode($response, true);
return $objects;
}


 $itopurl='http://172.31.33.28/itop/webservices/rest.php';
 $version='1.3';
 $auth_user='admin';
 $auth_pwd='sysw1in';
 $get_OpenstackUsage='{"operation": "core/get",                
                "class": "OpenstackUsage",				
                "key":"SELECT OpenstackUsage WHERE org_id=4",				
                "output_fields": "hostset,hostnumber,vhostnumber,totalcpu,totalmem,totaldisk,freecpu,freemem,freedisk,description,usablefield"				
                }';
$objects=transitop($itopurl,$version,$auth_user,$auth_pwd,$get_OpenstackUsage); //服务器
//print var_dump($objects);
$cpuUsage=array();
$memUsage=array();
$diskUsage=array();
$hostsets=array();
$toontotalcpu=0;
$toonfreecpu=0;
$toontotalmem=0;
$toonfreemem=0;
$toontotaldisk=0;
$toonfreedisk=0;
$phyname=array();
$phyhostnum=array();

 foreach($objects as $OpenstackUsages){
	 foreach($OpenstackUsages as $ou){
		 $o1=new OpenstackUsage();
		
         $o1->hostset=$ou["fields"]["hostset"];
         $o1->hostnumber=$ou["fields"]["hostnumber"];
		 $o1->vhostnumber=$ou["fields"]["vhostnumber"];
		 $o1->totalcpu=$ou["fields"]["totalcpu"];
		 $o1->totalmem=$ou["fields"]["totalmem"];
		 $o1->totaldisk=$ou["fields"]["totaldisk"];
		 $o1->freecpu=$ou["fields"]["freecpu"];
		 $o1->freemem=$ou["fields"]["freemem"];
		 $o1->freedisk=$ou["fields"]["freedisk"];
		 $o1->description=$ou["fields"]["description"];
		 $o1->usablefield=$ou["fields"]["usablefield"];
         //$cu=round($o1->freecpu/$o1->totalcpu,4);
		 //$cu=$cu*100;
         //print $server["fields"]["key"];
		 if($o1->usablefield!="physical"){
		 $cu=$o1->cpuUs();
		 $mu=$o1->memUs();
		 $du=$o1->diskUs();
		 array_push($cpuUsage,$cu);
         array_push($memUsage,$mu);
		 array_push($diskUsage,$du);
		
			 //print $o1->usablefield;
		 array_push($hostsets, $o1->hostset);
		 }
		 //print "server-skey=".$s1->skey."<br/>";
		 switch($o1->usablefield){
			 case "hypervisor":
               $toontotalcpu=$toontotalcpu+$o1->totalcpu;
			   $toonfreecpu=$toonfreecpu+$o1->freecpu;
               $toontotalmem=$toontotalmem+$o1->totalmem;
			   $toonfreemem=$toonfreemem+$o1->freemem;
			   $toontotaldisk=$toontotaldisk+$o1->totaldisk;
			   $toonfreedisk=$toonfreedisk+$o1->freedisk;
			   $toonhostnum=$toonhostnum+$o1->hostnumber;
			   $toonvhostnum=$toonvhostnum+$o1->vhostnumber;
			   break;
			  case "hyperqitoon":
			   $qitoontotalcpu=$qitoontotalcpu+$o1->totalcpu;
			   $qitoonfreecpu=$qitoonfreecpu+$o1->freecpu;
               $qitoontotalmem=$qitoontotalmem+$o1->totalmem;
			   $qitoonfreemem=$qitoonfreemem+$o1->freemem;
			   $qitoontotaldisk=$qitoontotaldisk+$o1->totaldisk;
			   $qitoonfreedisk=$qitoonfreedisk+$o1->freedisk;
			   $qitoonhostnum=$qitoonhostnum+$o1->hostnumber;
			   $qitoonvhostnum=$qitoonvhostnum+$o1->vhostnumber;
			   break;
			  case "hyperpred":
               $preprototalcpu=$preprototalcpu+$o1->totalcpu;
			   $preprofreecpu=$preprofreecpu+$o1->freecpu;
               $preprototalmem=$preprototalmem+$o1->totalmem;
			   $preprofreemem=$preprofreemem+$o1->freemem;
			   $preprototaldisk=$preprototaldisk+$o1->totaldisk;
			   $preprofreedisk=$preprofreedisk+$o1->freedisk;
			   $preprohostnum=$preprohostnum+$o1->hostnumber;
			   $preprovhostnum=$preprovhostnum+$o1->vhostnumber;
			   break;
			  case "hyperothers":
               $othertoontotalcpu=$othertoontotalcpu+$o1->totalcpu;
			   $othertoonfreecpu=$othertoonfreecpu+$o1->freecpu;
               $othertoontotalmem=$othertoontotalmem+$o1->totalmem;
			   $othertoonfreemem=$othertoonfreemem+$o1->freemem;
			   $othertoontotaldisk=$othertoontotaldisk+$o1->totaldisk;
			   $othertoonfreedisk=$othertoonfreedisk+$o1->freedisk;
			   $othertoonhostnum=$othertoonhostnum+$o1->hostnumber;
			   $othertoonvhostnum=$othertoonvhostnum+$o1->vhostnumber;
			   break;
			 case "physical":
				 //print $o1->hostnumber."<br>";
			 //print $o1->hostset."<br>";
			   array_push($phyname, $o1->hostset);
			   array_push($phyhostnum, $o1->hostnumber);
				break;
		 }
	 }  
 }


 $freecpu=$toonfreecpu+$qitoonfreecpu+$preprofreecpu+$othertoonfreecpu;
 $tooncpuUsage=$toontotalcpu-$toonfreecpu;
 $toonmemUsage=$toontotalmem-$toonfreemem;
 $toondiskUsage=$toontotaldisk-$toonfreedisk;

 $qitooncpuUsage=$qitoontotalcpu-$qitoonfreecpu;
 $qitoonmemUsage=$qitoontotalmem-$qitoonfreemem;
 $qitoondiskUsage=$qitoontotaldisk-$qitoonfreedisk;

 $prepromemUsage=$preprototalmem-$preprofreemem;
 $preprocpuUsage=$preprototalcpu-$preprofreecpu;
 $preprodiskUsage=$preprototaldisk-$preprofreedisk;
 
 $othertooncpuUsage=$othertoontotalcpu-$othertoonfreecpu;
 $othertoonmemUsage=$othertoontotalmem-$othertoonfreemem;
 $othertoondiskUsage=$othertoontotaldisk-$othertoonfreedisk;

 $freemem=$toonfreemem+$qitoonfreemem+$preprofreemem+$othertoonfreemem;
 $freedisk=$toonfreedisk+$qitoonfreedisk+$preprofreedisk+$othertoonfreedisk;
//print  $tooncpuUsage."####". $qitooncpuUsage."###".$preprocpuUsage."###".$othertooncpuUsage."####".$freecpu;

?>