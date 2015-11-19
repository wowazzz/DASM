<?php

	$im = imagecreatefromjpeg("./girl.jpg");
	$im2 = imagecreatefromjpeg("./girl.jpg");
	
	$f = fopen("./girl.pts", "r");
	$points = array();
	$i = 0;
    while (($line = fgets($f)) !== false) {
        if ($i < 3) {
			$i++;
			continue;
		}
		$points[] = explode(" ", trim($line));
		if (count($points) == 252) break;
    }
    fclose($f);


	for ($i = 0; $i < count($points); $i++) {
		imagefilledellipse($im, $points[$i][0], $points[$i][1], 5, 5, imagecolorallocate($im, 255, 225, 225));
		imagefilledellipse($im2, $points[$i][0], $points[$i][1], 5, 5, imagecolorallocate($im, 255, 225, 225));
		if ($i != 0)
			imageline($im, $points[$i-1][0], $points[$i-1][1], $points[$i][0], $points[$i][1], imagecolorallocate($im, 0, 225, 0));
	}
	
	imagejpeg($im2, "./girl_dots.jpg", 75);
	imagejpeg($im, "./girl_dots_lines.jpg", 75);
	imagedestroy($im);
	imagedestroy($im2);

?>