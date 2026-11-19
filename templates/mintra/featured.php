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
$indicadores = "";
$conta = 0 ;

while($rw = mysql_fetch_assoc($result))
{
	$urlFoto = "";

	$foto = $urlRecursos."uploads/".$idparroquia."/big_".$rw['foto'];

	if($conta == 0) $active = "active"; else $active = "";

	$featured .= "<div class=\"item $active\">
                <div class=\"fill\" style=\"background-image:url('".$foto."');\"></div>
                <div class=\"carousel-caption\">
                    <h2>".$rw['titulo']."</h2>
                </div>
            </div>";

    $indicadores .= "<li data-target=\"#myCarousel\" data-slide-to=\"".$conta."\" class=\"".$active."\"></li>";

	$conta++;

}

?>

	<div class="clearfix"></div>

    <!-- Full Page Image Background Carousel Header -->
    <div id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
        	<?=$indicadores;?>
        </ol>

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
			<?=$featured;?>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>

    </div>

    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

<?php }else{

echo getBienvenida();

 } ?>