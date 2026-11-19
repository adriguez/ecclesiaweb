<div id="featt">

<?php 

if(getValue("SELECT COUNT(id) FROM galeria_fotos WHERE parroquia = ".$idparroquia,1) > 0)
{ 

$sql = "SELECT galeria_fotos.titulo, galeria_fotos.foto FROM galeria_fotos, galeria_categorias WHERE galeria_categorias.parroquia = 0 AND galeria_categorias.especial = 0 ".$sqWhere." AND galeria_fotos.categoria = galeria_categorias.id AND galeria_fotos.parroquia = ".$idparroquia." ORDER BY rand() LIMIT 10";
$result = mysql_query($sql,$conex) or die (mysql_error());

if(mysql_num_rows($result) == 0)
{
	$sql = "SELECT galeria_fotos.titulo, galeria_fotos.foto FROM galeria_fotos, galeria_categorias WHERE galeria_categorias.especial = 0 AND galeria_fotos.categoria = galeria_categorias.id AND galeria_fotos.parroquia = ".$idparroquia." AND galeria_fotos.horizontal = 1 ORDER BY rand() LIMIT 10";
	$result = mysql_query($sql,$conex) or die (mysql_error());
}

$featured = "";

while($rw = mysql_fetch_assoc($result))
{
	$urlFoto = "";

	$foto = $urlOri."uploads/".$idparroquia."/big_".$rw['foto'];

	$featured .= "<li>
                            <a href=\"$foto\" title=\"".$rw['titulo']."\"><img src=\"$foto\"/></a>
                            <a href=\"".$urlFoto."\" target=\"_blank\"></a>
                        </li>";
}

?>

<div style="clear:both;"></div>

<div id="misas">

	<div class="titlemisas">Horario de Misas</div>

<?php


$sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 1) ORDER BY tipo ASC";
$result = mysql_query($sql,$conex);

if(mysql_num_rows($result) > 0)
{
	while($rw = mysql_fetch_assoc($result))
	{
		if($rw['texto'] != "")
		{
			echo $rw['texto'];
		}
	}
}

?>

</div>

<div class="panel" style="width:500px;margin:0 auto 0 auto;">
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

<div style="clear:both;"></div>

<?php } ?>

</div>