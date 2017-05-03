<?php

$temp_fil = $_FILES["file"]["tmp_name"];
$filnavn = $_FILES["file"]["name"];
$helt_filnavn = ".../temp/".$filnavn;
move_uploaded_file($temp_fil, $helt_filnavn);
echo "<img src ='.../temp/$filnavn' height='200' align='left'>";