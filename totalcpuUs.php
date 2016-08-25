<?php // content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_pie.php');
require_once('datas.php');
$data = array($tooncpuUsage,$qitooncpuUsage,$preprocpuUsage,$othertooncpuUsage,$freecpu);
//$data=array(2236,149,888,1204);
// A new pie graph
$totlcpuknum=array_sum($data);
$graph = new PieGraph(500,400);
$graph->SetShadow();

// Title setup
$graph->title->Set("Openstack Cpu使用率统计图 共计".$totlcpuknum."C");
$graph->title->SetFont(FF_SIMSUN,FS_BOLD);

// Setup the pie plot
$p1 = new PiePlot($data);

// Adjust size and position of plot
$p1->SetSize(0.32);
$p1->SetCenter(0.5,0.52);
$p1->SetLegends(array("tooncpu (%d)","qitooncpuUsage (%d)","preprocpu (%d)","othertoon (%d)","freecpu (%d)"));
// Setup slice labels and move them into the plot
$p1->value->SetFont(FF_FONT1,FS_BOLD);
$p1->value->SetColor("darkred");
$p1->SetLabelPos(0.65);

// Explode all slices
$p1->ExplodeAll(10);

// Add drop shadow
$p1->SetShadow();

// Finally add the plot
$graph->Add($p1);

// ... and stroke it
$graph->Stroke();

?>
