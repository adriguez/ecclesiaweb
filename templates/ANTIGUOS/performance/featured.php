<?php 

if(getValue("SELECT COUNT(id) FROM galeria_fotos WHERE parroquia = ".$idparroquia,1) > 0)
{ 

$sql = "SELECT titulo, foto FROM galeria_fotos WHERE parroquia = ".$idparroquia." ORDER BY rand() LIMIT 10";
$result = mysql_query($sql,$conex) or die (mysql_error());

$featured = "";

while($rw = mysql_fetch_assoc($result))
{
	$urlFoto = "";

	$foto = $urlOri."uploads/".$idparroquia."/feat_".$rw['foto'];

	$featured .= "<li>
                            <a href=\"$foto\" title=\"".$rw['titulo']."\"><img src=\"$foto\"/></a>
                            <a href=\"".$urlFoto."\" target=\"_blank\"></a>                        
                            <div style=\"left:5px; top:94px; width:336px; height:0;\"> 
                            	<h1>".$rw['titulo']."</h1></div>
                        </li>";
}

?>

<div style="border-bottom:solid 3px #DDDAD5;padding-bottom:20px;">

<div class="panel" style="width:460px;margin:0 auto 0 auto;border:solid 2px #B69B64;box-shadow: 2px 2px 5px #999;">
<div class="container">
        <div class="wt-rotator">
            <div class="screen">
                <noscript><img src="<?=$foto;?>"/></noscript>
            </div>
            <div class="c-panel">
                <div class="thumbnails">
                    <ul>
                        <?=$featured;?>
                    </ul>
              </div>  
		<div class="buttons">
                    <div class="prev-btn"></div>
                    <div class="play-btn"></div>    
                    <div class="next-btn"></div>               
		</div>
	</div>
</div>	
  	</div>
</div>

</div>

<?php }else{

echo getBienvenida();

 } ?>