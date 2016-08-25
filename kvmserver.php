<?php

//��ȡtokenid
$json_data='{"auth": {"tenantName": "admin", "passwordCredentials":{"username": "admin", "password": "sySwin321"}}}';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "http://10.252.1.254:5000/v2.0/tokens");
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($json_data))
);
curl_setopt($curl, CURLOPT_POST, 1); 
curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$response=curl_exec($curl);
#var_dump(json_decode($response, true));
$tokens=json_decode($response, true);
#echo "======".$tokens["access"]["token"]["id"];
$tokenid=$tokens["access"]["token"]["id"];
$tenantid=$tokens['access']['token']['tenant']['id'];
#print "tenantid-------".$tenantid;
//��tokenid���ݲ�ͬurl��ȡkvm��Ϣ
function getKvmInfo($url,$tokenid){
	$cu=curl_init();
	curl_setopt($cu, CURLOPT_URL, $url);
	curl_setopt($cu, CURLOPT_TIMEOUT,6000);
	curl_setopt($cu,CURLOPT_HTTPHEADER, array("X-Auth-Token:".$tokenid));
	curl_setopt($cu, CURLOPT_RETURNTRANSFER, 1);
	$response=curl_exec($cu); 
	return json_decode($response,true);
}
//��ȡ������������ϸ��Ϣ����������ip��ʣ���ڴ桢���̿ռ��
$serversurl="http://10.252.1.254:8774/v2/".$tenantid."/os-hypervisors/detail";
$hypers=getKvmInfo($serversurl,$tokenid);
#echo $hypers["hypervisors"][0]["host_ip"];

//��ȡ����ҵƽ̨���������� ���磺HYPERVISOR-LXC-SAS,HYPERQITOON-KVM-SSD
$agurl="http://10.252.1.254:8774/v2/".$tenantid."/os-aggregates";
$ags=getKvmInfo($agurl,$tokenid);
$aggregates=$ags["aggregates"];
$hostsetnames=array();
foreach($aggregates as $ag){
	array_push($hostsetnames,$ag["name"]);
	#echo $ag["name"]."<br/>";	
}
//�ҵ�kvm���������ĸ�������
function getHostSetName($aggregates,$hostname){
   foreach($aggregates as $ag){
	   foreach($ag["hosts"] as $host){
		   if ($hostname==$host){
			       # echo  $ag["name"];
                    return $ag["name"];
		   }
	   }
	 }
}
//����kvm����
class Hypervisor
{
	private $hostname;
	private $free_disk_gb;
	private $memory_mb_used;
	private $disk_available_least;
	private $free_ram_mb;
	private $vcpus;
	private $vcpus_used;
	private $memory_mb;
	private $hypervisor_type;
	private $hostsetName;
	private $running_vms;
	function __get($property_name)
	{
		if(isset($this->$property_name))
		{
			return ($this->$property_name);
		}
		else
		{
			return null;
		}
	}
	function __set($property_name,$value)
	{
		$this->$property_name = $value;
	}

}
$kvmhosts=array();
//����������Ϣ����ʵ��������ӵ�����
foreach($hypers["hypervisors"] as $hy){
	$hype=new Hypervisor();
	$hype->hostname=$hy["hypervisor_hostname"];
    $hype->free_disk_gb=$hy["free_disk_gb"];
	$hype->memory_mb_used=$hy["memory_mb_used"];
    $hype->disk_available_least=$hy["disk_available_least"];
	$hype->free_ram_mb=$hy["free_ram_mb"];
	$hype->vcpus=$hy["vcpus"];
	#echo $hype->vcpus."<br/>";
	$hype->vcpus_used=$hy["vcpus_used"];
	$hype->memory_mb=$hy["memory_mb"];
	$hype->hypervisor_type=$hy["hypervisor_type"];
	$hype->running_vms=$hy["running_vms"];
    $hype->hostsetName=getHostSetName($aggregates,$hype->hostname);
    array_push($kvmhosts,$hype);
	#echo $hype->hostsetName."<br/>";
}


?>