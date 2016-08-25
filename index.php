<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"  content="5">
<script src='js/server_top.js' language='javascript'></script>
<head>
<link rel="stylesheet" type="text/css" href="images/style.css">
<?php require_once('itopapi.php'); ?>
</head>
<body>
<div id="Container">
  <div id="header">
    <h1>机房共<?php echo $k;?>个设备:
	服务器<?php echo $servercount; ?>
	网络设备<?php echo $netdevicecount; ?>
	存储设备<?php echo $storcount; ?>
	
	</h1>
  </div>
<?php

for($i=1;$i<=5;$i++)//排
{
	echo "<div id='row'>";
	  echo "<div id='rowname'>第".$i."排</div>";
	  $racks=$arrayracks;
	  for($r=0;$r<count($racks);$r++){//机柜
          if($racks[$r]->idc_row==$i){
			  echo "<div id='list'>";
			    echo "<div id='rackname'>".$racks[$r]->name."</div>";
			    echo "<div id='rack'>";
				for($e=45;$e>=0;$e--){ //机柜层				
				   //$devices=$arrayservers;
		           //$k=count($devices);
				   for($j=0;$j<$k;$j++){//服务器
					   $device=$devices[$j];
					   if($device->rack_id==$racks[$r]->skey){ //判断服务器在哪个机柜
						   $rack_floor=$device->rack_floor;
						   if($device->nb_u>1){ //由于div是从上往下叠但服务器记录的U位是从下往上的
                                $rack_floor=$rack_floor+($device->nb_u-1);
						   }
						   if($rack_floor==$e){
							  if($device->device_type=="server"){
							   if($device->nb_u==1){
				                switch ($device->status)
				                {
									case "Active":
									echo "<div id='rackfloor'>";									
									echo "<a href='http://itop.syswin.com/pages/UI.php?operation=details&class=Server&id=".$device->skey."&c[org_id]=4&c[menu]=ConfigManagementOverview' target='_black'><img src='images/serverico/1u_normal.gif' id='one_nu' onmouseover=\"displayDIV('operate".$racks[$r]->name.$e."'); return false\" onmouseout=\"hiddenDIV('operate".$racks[$r]->name.$e."'); return false\"
																		
									/></a>
									<div id=\"operate".$racks[$r]->name.$e."\" class='displaydiv'>
                                    <div>Name:".$device->name."</div>
									<div>IP:".$device->ip."</div>
                                    <div>location:".$racks[$r]->name."-".$e."</div>
									</div>
									";
									echo "</div>";
									break;
									case "Down":
									echo "<div id='rackfloor'>";
									echo "<a href='http://itop.syswin.com/pages/UI.php?operation=details&class=Server&id=".$device->skey."&c[org_id]=4&c[menu]=ConfigManagementOverview' target='_black' target='_black'><img src='images/serverico/1u_down.gif' id='one_nu' onmouseover=\"displayDIV('operate".$racks[$r]->name.$e."'); return false\" onmouseout=\"hiddenDIV('operate".$racks[$r]->name.$e."'); return false\"/></a>
									<div id=\"operate".$racks[$r]->name.$e."\" class='displaydiv'>
                                    <div>Name:".$device->name."</div>
									<div>IP:".$device->ip."</div>
                                    <div>location:".$racks[$r]->name."-".$e."</div>
									</div>
									";
									echo "</div>";
									break;
								
								}
							   }elseif($device->nb_u==2){
                                  switch ($device->status)
				                  {
									  case "Active":
                                      echo "<div id='rackfloor2'>";
                                      echo "<a href='http://itop.syswin.com/pages/UI.php?operation=details&class=Server&id=".$device->skey."&c[org_id]=4&c[menu]=ConfigManagementOverview' target='_black' target='_black'><img src='images/serverico/2u_normal.gif' id='two_nu' onmouseover=\"displayDIV('operate".$racks[$r]->name.$e."'); return false\" onmouseout=\"hiddenDIV('operate".$racks[$r]->name.$e."'); return false\"/></a>
									<div id=\"operate".$racks[$r]->name.$e."\" class='displaydiv'>
									<div>Name:".$device->name."</div>
									<div>IP:".$device->ip."</div>
									<div>location:".$racks[$r]->name."-".$device->rack_floor."</div>
									</div>
									";
									  echo "</div>";
									  break;
									  case "Down":
                                      echo "<div id='rackfloor2'>";
                                      echo "<a href='http://itop.syswin.com/pages/UI.php?operation=details&class=Server&id=".$device->skey."&c[org_id]=4&c[menu]=ConfigManagementOverview' target='_black' target='_black'><img src='images/serverico/2u_down.gif' id='two_nu' onmouseover=\"displayDIV('operate".$racks[$r]->name.$e."'); return false\" onmouseout=\"hiddenDIV('operate".$racks[$r]->name.$e."'); return false\"/></a>
									<div id=\"operate".$racks[$r]->name.$e."\" class='displaydiv'>
									<div>Name:".$device->name."</div>
									<div>IP:".$device->ip."</div>
									<div>location:".$racks[$r]->name."-".$device->rack_floor."</div>
									</div>
									";
									  echo "</div>";
									  break;
								  
								  }
							     }elseif($device->nb_u==10){
                                  switch ($device->status)
				                  {
									  case "Active":
                                      echo "<div id='rackfloor10'>";
                                      echo "<a href='http://itop.syswin.com/pages/UI.php?operation=details&class=Server&id=".$device->skey."&c[org_id]=4&c[menu]=ConfigManagementOverview' target='_black' target='_black'><img src='images/serverico/ta_normal.gif' id='ten_nu' onmouseover=\"displayDIV('operate".$racks[$r]->name.$e."'); return false\" onmouseout=\"hiddenDIV('operate".$racks[$r]->name.$e."'); return false\"/></a>
									<div id=\"operate".$racks[$r]->name.$e."\" class='displaydiv'>
									<div>Name:".$device->name."</div>
									<div>IP:".$device->ip."</div>
									<div>location:".$racks[$r]->name."-".$device->rack_floor."</div>
									</div>
									";
									  echo "</div>";
									  break;
									  case "Down":
                                      echo "<div id='rackfloor10'>";
                                      echo "<a href='http://itop.syswin.com/pages/UI.php?operation=details&class=Server&id=".$device->skey."&c[org_id]=4&c[menu]=ConfigManagementOverview' target='_black' target='_black'><img src='images/serverico/ta_down.gif' id='ten_nu' onmouseover=\"displayDIV('operate".$racks[$r]->name.$e."'); return false\" onmouseout=\"hiddenDIV('operate".$racks[$r]->name.$e."'); return false\"/></a>
									<div id=\"operate".$racks[$r]->name.$e."\" class='displaydiv'>
									<div>Name:".$device->name."</div>
									<div>IP:".$device->ip."</div>
									<div>location:".$racks[$r]->name."-".$device->rack_floor."</div>
									</div>
									";
									  echo "</div>";
									  break;
								  
								  }
							     }elseif($device->nb_u==4){
                                  switch ($device->status)
				                  {
									  case "Active":
                                      echo "<div id='rackfloor4'>";
                                      echo "<a href='http://itop.syswin.com/pages/UI.php?operation=details&class=Server&id=".$device->skey."&c[org_id]=4&c[menu]=ConfigManagementOverview' target='_black' target='_black'><img src='images/serverico/4u_normal.gif' id='four_nu' onmouseover=\"displayDIV('operate".$racks[$r]->name.$e."'); return false\" onmouseout=\"hiddenDIV('operate".$racks[$r]->name.$e."'); return false\"/></a>
									<div id=\"operate".$racks[$r]->name.$e."\" class='displaydiv'>
									<div>Name:".$device->name."</div>
									<div>IP:".$device->ip."</div>
									<div>location:".$racks[$r]->name."-".$device->rack_floor."</div>
									</div>
									";
									  echo "</div>";
									  break;
									  case "Down":
                                      echo "<div id='rackfloor4'>";
                                      echo "<a href='http://itop.syswin.com/pages/UI.php?operation=details&class=Server&id=".$device->skey."&c[org_id]=4&c[menu]=ConfigManagementOverview' target='_black' target='_black'><img src='images/serverico/4u_down.gif' id='four_nu' onmouseover=\"displayDIV('operate".$racks[$r]->name.$e."'); return false\" onmouseout=\"hiddenDIV('operate".$racks[$r]->name.$e."'); return false\"/></a>
									<div id=\"operate".$racks[$r]->name.$e."\" class='displaydiv'>
									<div>Name:".$device->name."</div>
									<div>IP:".$device->ip."</div>
									<div>location:".$racks[$r]->name."-".$device->rack_floor."</div>
									</div>
									";
									  echo "</div>";
									  break;
								  
								  }
							     }
							   }elseif($device->device_type=="network"){
                                  if($device->nb_u==1){
				                switch ($device->status)
				                {
									case "Active":
									echo "<div id='rackfloor'>";
									echo "<a href='http://itop.syswin.com/pages/UI.php?operation=details&class=NetworkDevice&id=".$device->skey."&c[org_id]=4&c[menu]=ConfigManagementOverview' target='_black' target='_black'><img src='images/serverico/1u_netnormal.gif' id='net_nu' onmouseover=\"displayDIV('operate".$racks[$r]->name.$e."'); return false\" onmouseout=\"hiddenDIV('operate".$racks[$r]->name.$e."'); return false\"/></a>
									<div id=\"operate".$racks[$r]->name.$e."\" class='displaydiv'>
                                    <div>Name:".$device->name."</div>
									<div>IP:".$device->ip."</div>
                                    <div>location:".$racks[$r]->name."-".$e."</div>
									</div>
									";
									echo "</div>";
									break;
									case "Down":
									echo "<div id='rackfloor'>";
									echo "<a href='http://itop.syswin.com/pages/UI.php?operation=details&class=NetworkDevice&id=".$device->skey."&c[org_id]=4&c[menu]=ConfigManagementOverview' target='_black' target='_black'><img src='images/serverico/1u_netdown.gif' id='one_nu' onmouseover=\"displayDIV('operate".$racks[$r]->name.$e."'); return false\" onmouseout=\"hiddenDIV('operate".$racks[$r]->name.$e."'); return false\"/></a>
									<div id=\"operate".$racks[$r]->name.$e."\" class='displaydiv'>
                                    <div>Name:".$device->name."</div>
									<div>IP:".$device->ip."</div>
                                    <div>location:".$racks[$r]->name."-".$e."</div>
									</div>
									";
									echo "</div>";
									break;
								
								}
							   }elseif($device->nb_u==2){
                                  switch ($device->status)
				                  {
									  case "Active":
                                      echo "<div id='rackfloor2'>";
                                      echo "<a href='http://itop.syswin.com/pages/UI.php?operation=details&class=NetworkDevice&id=".$device->skey."&c[org_id]=4&c[menu]=ConfigManagementOverview' target='_black' target='_black'><img src='images/serverico/2u_netnormal.gif' id='two_nu' onmouseover=\"displayDIV('operate".$racks[$r]->name.$e."'); return false\" onmouseout=\"hiddenDIV('operate".$racks[$r]->name.$e."'); return false\"/></a>
									<div id=\"operate".$racks[$r]->name.$e."\" class='displaydiv'>
									<div>Name:".$device->name."</div>
									<div>IP:".$device->ip."</div>
									<div>location:".$racks[$r]->name."-".$device->rack_floor."</div>
									</div>
									";
									  echo "</div>";
									  break;
									  case "Down":
                                      echo "<div id='rackfloor2'>";
                                      echo "<a href='http://itop.syswin.com/pages/UI.php?operation=details&class=NetworkDevice&id=".$device->skey."&c[org_id]=4&c[menu]=ConfigManagementOverview' target='_black' target='_black'><img src='images/serverico/2u_netdown.gif' id='two_nu' onmouseover=\"displayDIV('operate".$racks[$r]->name.$e."'); return false\" onmouseout=\"hiddenDIV('operate".$racks[$r]->name.$e."'); return false\"/></a>
									<div id=\"operate".$racks[$r]->name.$e."\" class='displaydiv'>
									<div>Name:".$device->name."</div>
									<div>IP:".$device->ip."</div>
									<div>location:".$racks[$r]->name."-".$device->rack_floor."</div>
									</div>
									";
									  echo "</div>";
									  break;
								  
								  }
							     }elseif($device->nb_u==21){
                                  switch ($device->status)
				                  {
									  case "Active":
                                      echo "<div id='rackfloor21'>";
                                      echo "<a href='http://itop.syswin.com/pages/UI.php?operation=details&class=NetworkDevice&id=".$device->skey."&c[org_id]=4&c[menu]=ConfigManagementOverview' target='_black'><img src='images/serverico/21u_netnormal.gif' id='Twenty_one' onmouseover=\"displayDIV('operate".$racks[$r]->name.$e."'); return false\" onmouseout=\"hiddenDIV('operate".$racks[$r]->name.$e."'); return false\"/></a>
									<div id=\"operate".$racks[$r]->name.$e."\" class='displaydiv'>
									<div>Name:".$device->name."</div>
									<div>IP:".$device->ip."</div>
									<div>location:".$racks[$r]->name."-".$device->rack_floor."</div>
									</div>
									";
									  echo "</div>";
									  break;
									  case "Down":
                                      echo "<div id='rackfloor21'>";
                                      echo "<a href='http://itop.syswin.com/pages/UI.php?operation=details&class=NetworkDevice&id=".$device->skey."&c[org_id]=4&c[menu]=ConfigManagementOverview' target='_black'><img src='images/serverico/21u_netdown.gif' id='Twenty_one' onmouseover=\"displayDIV('operate".$racks[$r]->name.$e."'); return false\" onmouseout=\"hiddenDIV('operate".$racks[$r]->name.$e."'); return false\"/></a>
									<div id=\"operate".$racks[$r]->name.$e."\" class='displaydiv'>
									<div>Name:".$device->name."</div>
									<div>IP:".$device->ip."</div>
									<div>location:".$racks[$r]->name."-".$device->rack_floor."</div>
									</div>
									";
									  echo "</div>";
									  break;
								  
								  }
							     }elseif($device->nb_u==4){
                                  switch ($device->status)
				                  {
									  case "Active":
                                      echo "<div id='rackfloor4'>";
                                      echo "<a href='http://itop.syswin.com/pages/UI.php?operation=details&class=NetworkDevice&id=".$device->skey."&c[org_id]=4&c[menu]=ConfigManagementOverview' target='_black'><img src='images/serverico/4u_netnormal.gif' id='four_nu' onmouseover=\"displayDIV('operate".$racks[$r]->name.$e."'); return false\" onmouseout=\"hiddenDIV('operate".$racks[$r]->name.$e."'); return false\"/></a>
									<div id=\"operate".$racks[$r]->name.$e."\" class='displaydiv'>
									<div>Name:".$device->name."</div>
									<div>IP:".$device->ip."</div>
									<div>location:".$racks[$r]->name."-".$device->rack_floor."</div>
									</div>
									";
									  echo "</div>";
									  break;
									  case "Down":
                                      echo "<div id='rackfloor4'>";
                                      echo "<a href='http://itop.syswin.com/pages/UI.php?operation=details&class=NetworkDevice&id=".$device->skey."&c[org_id]=4&c[menu]=ConfigManagementOverview' target='_black'><img src='images/serverico/4u_net.gif' id='four_nu' onmouseover=\"displayDIV('operate".$racks[$r]->name.$e."'); return false\" onmouseout=\"hiddenDIV('operate".$racks[$r]->name.$e."'); return false\"/></a>
									<div id=\"operate".$racks[$r]->name.$e."\" class='displaydiv'>
									<div>Name:".$device->name."</div>
									<div>IP:".$device->ip."</div>
									<div>location:".$racks[$r]->name."-".$device->rack_floor."</div>
									</div>
									";
									  echo "</div>";
									  break;
								  
								  }
							     }        

								 }elseif($device->device_type=="storage"){
                                  if($device->nb_u==1){
				                    switch ($device->status)
				                {
									case "Active":
									echo "<div id='rackfloor'>";
									echo "<a href='http://itop.syswin.com/pages/UI.php?operation=details&class=StorageSystem&id=".$device->skey."&c[org_id]=4&c[menu]=ConfigManagementOverview' target='_black'><img src='images/serverico/2u_storage.gif' id='one_nu' onmouseover=\"displayDIV('operate".$racks[$r]->name.$e."'); return false\" onmouseout=\"hiddenDIV('operate".$racks[$r]->name.$e."'); return false\"/></a>
									<div id=\"operate".$racks[$r]->name.$e."\" class='displaydiv'>
                                    <div>Name:".$device->name."</div>
									<div>IP:".$device->ip."</div>
                                    <div>location:".$racks[$r]->name."-".$e."</div>
									</div>
									";
									echo "</div>";
									break;
									case "Down":
									echo "<div id='rackfloor'>";
									echo "<a href='http://itop.syswin.com/pages/UI.php?operation=details&class=StorageSystem&id=".$device->skey."&c[org_id]=4&c[menu]=ConfigManagementOverview' target='_black'><img src='images/serverico/2u_storage.gif' id='one_nu' onmouseover=\"displayDIV('operate".$racks[$r]->name.$e."'); return false\" onmouseout=\"hiddenDIV('operate".$racks[$r]->name.$e."'); return false\"/></a>
									<div id=\"operate".$racks[$r]->name.$e."\" class='displaydiv'>
                                    <div>Name:".$device->name."</div>
									<div>IP:".$device->ip."</div>
                                    <div>location:".$racks[$r]->name."-".$e."</div>
									</div>
									";
									echo "</div>";
									break;
								
								}
							   }elseif($device->nb_u==2){
                                  switch ($device->status)
				                  {
									  case "Active":
                                      echo "<div id='rackfloor2'>";
                                      echo "<a href='http://itop.syswin.com/pages/UI.php?operation=details&class=StorageSystem&id=".$device->skey."&c[org_id]=4&c[menu]=ConfigManagementOverview' target='_black'><img src='images/serverico/2u_storage.gif' id='two_nu' onmouseover=\"displayDIV('operate".$racks[$r]->name.$e."'); return false\" onmouseout=\"hiddenDIV('operate".$racks[$r]->name.$e."'); return false\"/></a>
									<div id=\"operate".$racks[$r]->name.$e."\" class='displaydiv'>
									<div>Name:".$device->name."</div>
									<div>IP:".$device->ip."</div>
									<div>location:".$racks[$r]->name."-".$device->rack_floor."</div>
									</div>
									";
									  echo "</div>";
									  break;
									  case "Down":
                                      echo "<div id='rackfloor2'>";
                                      echo "<a href='http://itop.syswin.com/pages/UI.php?operation=details&class=StorageSystem&id=".$device->skey."&c[org_id]=4&c[menu]=ConfigManagementOverview' target='_black'><img src='images/serverico/2u_storage.gif' id='two_nu' onmouseover=\"displayDIV('operate".$racks[$r]->name.$e."'); return false\" onmouseout=\"hiddenDIV('operate".$racks[$r]->name.$e."'); return false\"/></a>
									<div id=\"operate".$racks[$r]->name.$e."\" class='displaydiv'>
									<div>Name:".$device->name."</div>
									<div>IP:".$device->ip."</div>
									<div>location:".$racks[$r]->name."-".$device->rack_floor."</div>
									</div>
									";
									  echo "</div>";
									  break;
								  
								  }
							     }elseif($device->nb_u==4){
                                  switch ($device->status)
				                  {
									  case "Active":
                                      echo "<div id='rackfloor4'>";
                                      echo "<a href='http://itop.syswin.com/pages/UI.php?operation=details&class=StorageSystem&id=".$device->skey."&c[org_id]=4&c[menu]=ConfigManagementOverview' target='_black'><img src='images/serverico/2u_storage.gif' id='four_nu' onmouseover=\"displayDIV('operate".$racks[$r]->name.$e."'); return false\" onmouseout=\"hiddenDIV('operate".$racks[$r]->name.$e."'); return false\"/></a>
									<div id=\"operate".$racks[$r]->name.$e."\" class='displaydiv'>
									<div>Name:".$device->name."</div>
									<div>IP:".$device->ip."</div>
									<div>location:".$racks[$r]->name."-".$device->rack_floor."</div>
									</div>
									";
									  echo "</div>";
									  break;
									  case "Down":
                                      echo "<div id='rackfloor4'>";
                                      echo "<a href='http://itop.syswin.com/pages/UI.php?operation=details&class=StorageSystem&id=".$device->skey."&c[org_id]=4&c[menu]=ConfigManagementOverview' target='_black'><img src='images/serverico/2u_storage.gif' id='four_nu' onmouseover=\"displayDIV('operate".$racks[$r]->name.$e."'); return false\" onmouseout=\"hiddenDIV('operate".$racks[$r]->name.$e."'); return false\"/></a>
									<div id=\"operate".$racks[$r]->name.$e."\" class='displaydiv'>
									<div>Name:".$device->name."</div>
									<div>IP:".$device->ip."</div>
									<div>location:".$racks[$r]->name."-".$device->rack_floor."</div>
									</div>
									";
									  echo "</div>";
									  break;
								  
								  }
							     }        

								 }
				              if($device->nb_u>1){ //占机柜几层
				                  $e=$e-($device->nb_u-1);
				              }
							  break;
						   }elseif($j==$k-1){
                              echo "<div id='rackfloor'></div>";
						   }
					   }elseif($j==$k-1){
                              echo "<div id='rackfloor'></div>";
						}
				   }

                }

				echo "</div>";
			  echo "</div>";
		  }
      }
	echo "</div>";
}
?>
</div>
<div id='footer'>
syswin@beijing</div>
</div>
</body>
</html>