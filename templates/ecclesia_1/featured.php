	<div class="row">
		<div class="col-sm-<?php if($idparroquia == 19 || $idparroquia == 1667) echo "12"; else echo "7"; ?>">

<?php 

if(getValue("SELECT COUNT(id) FROM galeria_fotos WHERE parroquia = ".$idparroquia,1) > 0)
{ 

	$sqWhere = "";
	// if($idparroquia == 14) $sqWhere = " AND galeria_fotos.categoria = 40 ";

$sql = "SELECT galeria_fotos.titulo, galeria_fotos.foto FROM galeria_fotos, galeria_categorias WHERE galeria_categorias.parroquia = 0 AND galeria_categorias.especial = 0 ".$sqWhere." AND galeria_fotos.categoria = galeria_categorias.id AND galeria_fotos.parroquia = ".$idparroquia." ORDER BY rand() LIMIT 10";
$result = mysql_query($sql,$conex) or die (mysql_error());

if(mysql_num_rows($result) == 0)
{
	$sql = "SELECT galeria_fotos.titulo, galeria_fotos.foto FROM galeria_fotos, galeria_categorias WHERE galeria_categorias.especial = 0 ".$sqWhere." AND galeria_fotos.categoria = galeria_categorias.id AND galeria_fotos.parroquia = ".$idparroquia." AND galeria_fotos.horizontal = 1 ORDER BY rand() LIMIT 10";
	$result = mysql_query($sql,$conex) or die (mysql_error());
}

$featured = "";
$indicadores = "";
$conta = 0 ;
$numFotos = 0;

while($rw = mysql_fetch_assoc($result))
{
	$urlFoto = "";

	$numFotos++;

	if($idparroquia == 1667) $foto = $urlRecursos."uploads/".$idparroquia."/".$rw['foto'];
	else $foto = $urlRecursos."uploads/".$idparroquia."/big_".$rw['foto'];

	if(!UR_exists($foto)) $foto = str_replace(".jpg",".png",$foto);

	if($rw['foto'] == "p1f8796rk8i5vv4t1hh1rsc4n04.jpg" || $rw['foto'] == "p1f879h8cc1gpd1vod1klho2130e4.jpg") $foto = $urlRecursos."uploads/".$idparroquia."/".$rw['foto'];

	if($conta == 0) $active = "active"; else $active = "";

	$featured .= "<div class=\"item $active\">
                <div class=\"fill\" style=\"background-image:url('".$foto."');\"></div>
                <div class=\"carousel-caption\">
                    <h2>".$rw['titulo']."</h2>
                </div>
            </div>";
/*
	$featured .= "<li>
                            <a href=\"$foto\" title=\"".$rw['titulo']."\"><img src=\"$foto\"/></a>
                            <a href=\"".$urlFoto."\" target=\"_blank\"></a>
                        </li>";*/

    $indicadores .= "<li data-target=\"#myCarousel\" data-slide-to=\"".$conta."\" class=\"".$active."\"></li>";

	$conta++;

}

?>

	    <!-- Full Page Image Background Carousel Header -->
	    <div id="myCarousel" class="carousel slide">
			<?php if($numFotos > 1){ ?>
			<!-- Indicators -->
	        <ol class="carousel-indicators">
	        	<?=$indicadores;?>
	        </ol>
			<?php } ?>

	        <!-- Wrapper for Slides -->
	        <div class="carousel-inner">
				<?=$featured;?>
	        </div>

	        <?php if($numFotos > 1){ ?>
			<!-- Controls -->
	        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
	            <span class="icon-prev"></span>
	        </a>
	        <a class="right carousel-control" href="#myCarousel" data-slide="next">
	            <span class="icon-next"></span>
	        </a>
			<?php } ?>

	    </div>

	    <script>
	    jQuery('.carousel').carousel({
	        interval: 5000 //changes the speed
	    })
	    </script>
<?php } ?>

		</div>

		<?php if($idparroquia != 19 && $idparroquia != 1667){ ?>

		<div class="col-sm-5" style="margin:0;padding:0;">
			<div id="misas">

			<?php if($idparroquia == 1013){ 
			
				$val = getValue("SELECT * FROM galeria_fotos WHERE categoria = '1182' AND parroquia = '1013' ORDER BY id DESC LIMIT 1",0);

				//http://web.mintrared.com/uploads/1013/big_p1frk502g41odb1sdqmfqjj21ad14.jpg
				$urlImagen = $urlRecursos."uploads/".$idparroquia."/big_".$val['foto'];

				echo "<a href=\"$urlImagen\" class=\"fancybox-thumb\" rel=\"fancybox-thumb\"><img src=\"$urlImagen\" style=\"border:none;border-radius:0%;padding:0;margin:0;width:100%;\" /></a>";
				
			?>

			<script type="text/javascript" language="javascript">

			jQuery(document).ready(function() {
				jQuery(".fancybox-thumb").fancybox({
					prevEffect	: 'none',
					nextEffect	: 'none',
					helpers	: {
						title	: {
							type: 'inside'
						},
						thumbs	: {
							width	: 50,
							height	: 50
						}
					}
				});
			});

			</script>
			
			<?php }else{ ?>

				<?php if($idparroquia != 14){ ?><div class="titlemisas"><?php if($idparroquia == 587) echo "Horari de Misses"; else echo "Horario de Misas"; ?></div><?php } ?>

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

			<?php } ?>

			</div>
		</div>

		<?php } ?>

	</div>