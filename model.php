<?php
class Device
{ 
	private $skey;
	private $name;
	private $ip;
	private $status;
	private $rack_id;
	private $rack_floor;
	private $nb_u;
	private $device_type;
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
class Rack
{
	private $skey;
	private $name;
	private $nb_u;
	private $idc_row;
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

class OpenstackUsage
{
	private $skey;
	private $hostset;
	private $hostnumber;
	private $vhostnumber;
	private $totalcpu;
	private $totalmem;
	private $totaldisk;
	private $freecpu;
	private $freemem;
	private $freedisk;
	private $description;
	private $usablefield;
	
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
  
   function cpuUs(){
		$cpuUsage=round(($this->totalcpu-$this->freecpu)/$this->totalcpu,4);
		return $cpuUsage;
   }
   function memUs(){
        $memUsage=round(($this->totalmem-$this->freemem)/$this->totalmem,4);
		return $memUsage;
   }
   function diskUs(){
        $diskUsage=round(($this->totaldisk-$this->freedisk)/$this->totaldisk,4);
		return $diskUsage;
   }
   

}

?>