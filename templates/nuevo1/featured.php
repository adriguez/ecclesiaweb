    <div class="row">

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

    /*
	$featured .= "<li>
                            <a href=\"$foto\" title=\"".$rw['titulo']."\"><img src=\"$foto\"/></a>
                            <a href=\"".$urlFoto."\" target=\"_blank\"></a>
                        </li>";
    */
}

}
else
{
    $featured = "";
}

?>

        <div class="col-sm-5" style="padding:0;margin:0;">

            <div id="misas">

            	<div class="titlemisas">Horario de Misas</div>

            <?php


            $sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 1) ORDER BY tipo ASC LIMIT 1";
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
        </div>

        <div class="col-sm-7" style="margin:0;padding:0;">

            <?php if($idparroquia == 825){ ?>
            
                <div id="videoCarousel" style="width:682px;height:337px;">
                    <video width="682" height="337" controls autoplay muted loop>
                        <source src="https://www.ecclesiared.es/repositorio/sanjavier.webm">
                            Your browser does not support the video tag.
                    </video>
                </div>


            <?php }else if($featured != ""){ ?>

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


            <script type="text/javascript" language="javascript">

                $('.carousel').carousel(
                {
                    interval: 5000 //changes the speed
                });

            </script>

            <?php } ?>

        </div>
</div>

<div class="clearfix"></div>