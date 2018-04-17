<?php

print_r($devicelist);
echo "<br>";

foreach ($devicelist as $b => $c) {
	 echo $b.'<br> ';
	foreach ($c as $d) {
		echo '- '.$d['nama_device'].'<br>';
	}
}

?>