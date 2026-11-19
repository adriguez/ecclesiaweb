<?php

include('_includes/config.php');

$array = array("p16ljim930167h1i8mfk1797apc1.JPG","p16ljim9301vlj1ff61tdc18mh1qfi2.JPG","p16ljim930oen18o7l9i8bq1gmm3.JPG","p16ljim9301qq516ck1m4m17vjpc4.JPG","p16ljim930tts1jig1o18vhh1qqj5.JPG","p16ljim930kd91vhvr118e211856.JPG","p16ljim9301gg8cpjn42127m3b97.JPG","p16ljim93116g1bgif7h1bk51aqf8.JPG","p16ljim93117021kln1sq51tev1j659.JPG","p16ljim93111ra10ok1dvmj21ss9a.JPG");

foreach($array as $id=>$valor)
{

$foto = "uploads/1/".$valor;

$thumb = new thumbnail($foto);
$thumb->size_width(460);
$thumb->jpeg_quality(100);
$thumb->save("uploads/1/feat_$valor");

}

?>