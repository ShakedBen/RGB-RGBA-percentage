<?php 
include "imageRGB.php";

if(isset($_POST['submit'])){
	$newImg=new imageRGB($_POST['submit']);

}
function debug_to_console($data) {
	$output = $data;
	if (is_array($output))
		$output = implode(',', $output);

	echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}



?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {
  height: 100%;
  margin: 0;

}

.bg {
  /* The image used */
  background-image: url(<?php echo $newImg->getLocation();?>);
  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;

}
.top-left {
  position: absolute;
  top: 8px;
  left: 16px;
}
.top-right {
  position: absolute;
  top: 8px;
  right: 16px;
}

</style>
</head>
<body>

<div class="bg"></div>
<table class="top-left" border="1" style="width:40% " ;
}>

<tr>

<td bgcolor="red" >RED</td>
<td bgcolor="green">GREEN</td>
<td bgcolor="blue">BLUE</td>


</tr>
<tr>

<td  ><?php echo $newImg->getRedPercentRGB();?></td>
<td ><?php echo $newImg->getGreenPercentRGB();?></td>
<td ><?php echo $newImg->getBluePercentRGB();?></td>
</tr>





</table>
<table class="top-right" border="1" style="width:50%">

<tr>

<td  bgcolor="red"">RED</td>
<td bgcolor="green">GREEN</td>
<td bgcolor="blue">BLUE</td>
<td bgcolor="grey" opacity=0.3% opc>ALPHA</td>


</tr>
<tr>

<td  ><?php echo $newImg->getRedPercentRGBA();?></td>
<td ><?php echo $newImg->getGreenPercentRGBA();?></td>
<td ><?php echo $newImg->getBluePercentRGBA();?></td>
<td ><?php echo $newImg->getAlphaPercentRGBA();?></td>
</tr>

</table>
</body>
</html>


?>