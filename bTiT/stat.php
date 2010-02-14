<?php
include ("include/graph/jpgraph.php");
include ("include/graph/jpgraph_pie.php");
include ("include/graph/jpgraph_pie3d.php");
require_once ("include/functions.php");
require_once ("include/config.php");

dbconn(true);

$res = mysql_query("SELECT * FROM summary WHERE summary.info_hash ='".$_GET["id"]."'") or die(mysql_error());
$row = mysql_fetch_array($res);

if (!$row)
  die("Bad ID!");
//$sres = mysql_query("SELECT filename FROM namemap WHERE namemap.info_hash ='".$_GET["id"]."'") or die(mysql_error());
//$srow = mysql_fetch_array($sres);

//$filename = $srow["filename"];
$seeders =  $row["seeds"];
$leechers = $row["leechers"];
$data = array($leechers, $seeders);

$graph = new PieGraph(300,200,"auto");
$graph->img->SetMargin(60,20,30,50);
$graph->SetScale("textint");
$graph->SetShadow();
$graph->SetFrame(false);

//$graph->title->Set("Statistics for $filename");
//$graph->title->SetFont(FF_FONT1,FS_BOLD);

$p1 = new PiePlot3D($data);
$p1->SetAngle(40);
$p1->SetSize(0.5);
$p1->SetCenter(0.45);
$p1->SetLegends(array("Leechers ","Seeders"));
$p1->SetSliceColors(array('#FF0000','#33CC33'));

$graph->Add($p1);
$ih = $graph->Stroke(_IMG_HANDLER);
imagetruecolortopalette ($ih, true, 255 );
$my_trans_color = imagecolorclosest($ih, 255,255,255);
imagecolortransparent($ih, $my_trans_color);
header("Content-type: image/png");
imagepng($ih);
?>