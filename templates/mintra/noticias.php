			
			<?php

// ******* ARCHIVO PARA CATEGORÍAS 

				$idnoticia = 0;

				$mes = "";
				$anyo = "";

				if(isset($_GET['cat']) && $_GET['cat'] > 0) $idcategoria = intval($_GET['cat']); else $idcategoria = "";
				
				if(isset($_GET['archivo']) && $_GET['archivo'] == 1 && isset($_GET['mes']) && isset($_GET['anyo']) && $_GET['mes'] != "" && $_GET['anyo'] != "")
				{
					$mes = addslashes($_GET['mes']);
					$anyo = addslashes($_GET['anyo']);
				}

				$rs = dameBucle($idparroquia, $numNotis, $idnoticia, $idcategoria, $mes, $anyo);

				$bucle = $rs[0];
				$numRes = $rs[1];
				$nPags = $rs[2];
				$pg = $rs[3];

				$conta = 0;

				if(mysql_num_rows($bucle) > 0)
				{

					if($idparroquia == 61) $title = "Evangelio diario";
					else $title = "Últimas noticias";

					echo "<div class=\"page-header\"><h1>".$title."</h1></div>";

					while($rw = mysql_fetch_assoc($bucle))
					{

						$tieneFoto = getValue("SELECT foto FROM noticias_fotos WHERE idnoticia = ".$rw['id']." ORDER BY idfoto ASC LIMIT 1",1);

						if($tieneFoto != "")
						{
							$foto = $urlRecursos."uploads/".$rw['parroquia']."/noticias/big_".$tieneFoto;
							$urlFoto = $urlRecursos."uploads/".$rw['parroquia']."/noticias/big_".$tieneFoto;
						}
						else{
							$foto = "";
							$urlFoto = "";
						}

						$fechaPublicada = dameFecha(strtotime($rw['fecha']));

						$catTxt = getValue("SELECT categoria FROM noticias_categorias WHERE id = ".$rw['categoria'],1);

						$urlCat = $urlOri."categoria-".limpiarCadena($catTxt,'archivo')."/".$rw['categoria']."/";
						$urlNoti = $urlOri.limpiarCadena($rw['titular'],'archivo')."-".$rw['id'].".html";

					$conta++;

				//	if($conta%2==0) echo "<div class=\"row\">";

				?>
				<div class="row">
					<div class="col-lg-12">

						<article>

							<?php if($foto != ""){ ?>
							<div class="photo-article">
								<a href="<?=$urlNoti;?>"><img class="thumbnail" src="<?=$foto;?>" alt="<?=$rw['titular'];?>" /></a>
							</div>
							<?php } ?>

							<h2><a href="<?=$urlNoti;?>"><?=$rw['titular'];?></a></h2>
							<div class="extra-data">
								<span class="glyphicon glyphicon-calendar"></span> <?=$fechaPublicada;?>
								<span class="glyphicon glyphicon-folder-close"></span> <a href="<?=$urlCat;?>"><?=$catTxt;?></a>
							</div>
							<div class="post-content">

								<?=strip_tags(stripslashes(RecortaStr($rw['noticia'], 250,'..')));?>
									
								<p class="links"><a href="<?=$urlNoti;?>" class="more">Ver artículo</a></p>

							</div><!--#post-content-->
						</article>
					</div>
				</div>
				<?php

					//if($conta%2==0) echo "</div>";

					}
						if($numRes > 0 && $nPags > 1)
						{

							if(isset($_GET['pg'])) $urlPagAux = str_replace("?pg=".intval($_GET['pg']),"",$_SERVER['REQUEST_URI'])."?pg=[PAG]";
							else $urlPagAux = $_SERVER['REQUEST_URI']."?pg=[PAG]";

							echo getPaginacion($urlPagAux, $numRes, $nPags, $numList = $numNotis, $maxPags = 9, $only=false);
						}
				}
				else echo "<h2 style=\"text-align:center;font-weight:normal;margin:10px;\">No existen noticias en esta sección.</b></h2>";

			?>