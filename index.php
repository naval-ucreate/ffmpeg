<?php
$scaleSize  =       ($_GET['scale_size']!=""?$_GET['scale_size']:320);
$image1     =       getcwd()."/images/input.jpg";
$output     =       getcwd()."/images/input_new_".$scaleSize .".jpg";
echo exec('ffmpeg -i '.$image1.' -vf scale='.$scaleSize.':-1 '.$output);
echo "<p> Original Image</p>\n";
echo '<img src="images/input.jpg">';
echo '<br />';


$src        =       "images/input_new_".$scaleSize.".jpg";

echo "<p>New Image</p>";
echo "<img src='$src'>";

?>