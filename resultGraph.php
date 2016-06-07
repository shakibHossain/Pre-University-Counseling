<?php
	include("pChart2.1.4/class/pData.class.php");
	include("pChart2.1.4/class/pDraw.class.php");
	include("pChart2.1.4/class/pImage.class.php");
	
	session_start();
	/* Connect to the MySQL database */
	require "connect.php";
	$myData = new pData();
	$keepUsername=$_SESSION["name"];
	$sq1=mysqli_query($con,"SELECT `userid` FROM `user information` WHERE `username`='$keepUsername'");
	$result1 = mysqli_fetch_assoc($sq1);
	$keepUserid=(int)$result1['userid'];
	/* Build the query that will returns the data to graph */
	$sq2 = mysqli_query($con,"SELECT `points` FROM `points table` WHERE `Uid`=$keepUserid ORDER BY  `Did` ");
	
	$points="";
	while($row = mysqli_fetch_array($sq2))
	 {
	  /* Push the results of the query in an array */
	  $points[] = $row["points"];
	 }
	/* 
	$total = array_sum($points);
	$hits=$points;
	
	foreach ($points as $hits) {
	   
		$hits= round($hits/ $total * 100, 1);
		//echo "$value <br>";
	}
	*/
	//$browsers = array('Safari' => 13, 'Firefox' => 5);

	
	
	/* Save the data in the pData array */
	$myData->addPoints($points,"Points");
	
	
	
	//$myData->addPoints(array(48,48,39,6,19,88,8,5),"Points");
	$myData->setSerieDescription("Points","Points");
	$myData->setSerieOnAxis("Points",0);
	
	$myData->addPoints(array("CSE","EEE","BBA","MNS","Arcitecture","Law","Pharmacy","Medical"),"Absissa");
	$myData->setAbscissa("Absissa");
	
	$myData->setAxisPosition(0,AXIS_POSITION_LEFT);
	$myData->setAxisName(0,"Points Earned");
	$myData->setAxisUnit(0,"");
	
	$myPicture = new pImage(1200,500,$myData);
	$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>50,"G"=>50,"B"=>50,"Alpha"=>20));
	
	$myPicture->setFontProperties(array("FontName"=>"pChart2.1.4/fonts/GeosansLight.ttf","FontSize"=>15));
	$TextSettings = array("Align"=>TEXT_ALIGN_MIDDLEMIDDLE
	, "R"=>0, "G"=>0, "B"=>0);
	$myPicture->drawText(600,25,"Your Predicted Subject Score",$TextSettings);
	
	$myPicture->setShadow(FALSE);
	$myPicture->setGraphArea(50,50,1175,460);
	$myPicture->setFontProperties(array("R"=>0,"G"=>0,"B"=>0,"FontName"=>"pChart2.1.4/fonts/Forgotte.ttf","FontSize"=>12));
	
	$Settings = array("Pos"=>SCALE_POS_LEFTRIGHT
	, "Mode"=>SCALE_MODE_FLOATING
	, "LabelingMethod"=>LABELING_ALL
	, "GridR"=>255, "GridG"=>255, "GridB"=>255, "GridAlpha"=>50, "TickR"=>0, "TickG"=>0, "TickB"=>0, "TickAlpha"=>50, "LabelRotation"=>0, "CycleBackground"=>1, "DrawXLines"=>1, "DrawSubTicks"=>1, "SubTickR"=>255, "SubTickG"=>0, "SubTickB"=>0, "SubTickAlpha"=>50, "DrawYLines"=>ALL);
	$myPicture->drawScale($Settings);
	
	$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>50,"G"=>50,"B"=>50,"Alpha"=>10));
	
	$Config = array("DisplayValues"=>1, "Rounded"=>1, "AroundZero"=>1);
	$myPicture->drawBarChart($Config);
	
	$Config = array("FontR"=>0, "FontG"=>0, "FontB"=>0, "FontName"=>"pChart2.1.4/fonts/pf_arma_five.ttf", "FontSize"=>6, "Margin"=>6, "Alpha"=>30, "BoxSize"=>5, "Style"=>LEGEND_NOBORDER
	, "Mode"=>LEGEND_HORIZONTAL
	);
	$myPicture->drawLegend(1147,16,$Config);
	
		
	$myPicture->autoOutput("resultGraph.png");
?>
<?php echo "$prt <br>"; ?>
  