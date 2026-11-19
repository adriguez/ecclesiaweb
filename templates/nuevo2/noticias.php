
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

				if(mysql_num_rows($bucle) > 0)
				{

					echo "<h2>Últimas noticias</h2>";

					while($rw = mysql_fetch_assoc($bucle))
					{

						if($rw['noticia_grupo'] == 0)
						{
							$catTxt = getValue("SELECT categoria FROM noticias_categorias WHERE id = ".$rw['categoria'],1);

							$urlCat = $urlOri."categoria-".limpiarCadena($catTxt,'archivo')."/".$rw['categoria']."/";
						}
						else{
							$catTxt = getValue("SELECT nombre FROM grupos_pastorales WHERE id = ".$rw['categoria'],1);

							$urlCat = $urlOri."categoria-grupo-".limpiarCadena($catTxt,'archivo')."/".$rw['categoria']."/";
						}

						$tieneFoto = getValue("SELECT foto FROM noticias_fotos WHERE idnoticia = ".$rw['id']." ORDER BY idfoto ASC LIMIT 1",1);

						if($tieneFoto != "")
						{
							$foto = $urlRecursos."uploads/".$rw['parroquia']."/noticias/".$tieneFoto;
							$urlFoto = $urlRecursos."uploads/".$rw['parroquia']."/noticias/".$tieneFoto;
						}
						else{
							$foto = "";
							$urlFoto = "";
						}						

						$urlNoti = $urlOri.limpiarCadena($rw['titular'],'archivo')."-".$rw['id'].".html";

						if(getValue("SELECT COUNT(id) FROM solicitudes_qr WHERE url = '$urlNoti' AND parroquia = $idparroquia",1) == 0)
						{

						$fecha = date('Y-m-d',strtotime($rw['fecha']));
						$fecha = explode("-",$fecha);

						$anyo = $fecha[0];
						$dia = $fecha[2];
						$mes = $fecha[1];

						$fechaPublicada = "<div>".$dia."</div>".substr(strtoupper(getMes($mes)),0,3)."<br />".$anyo;

				?>
		<div class="row">
			<div class="col-lg-12">

				<div class="noticia">

					<?php if($foto != ""){ ?>
					<div class="photo-article">
						<a href="<?=$urlNoti;?>"><img class="thumbnail" src="<?=$foto;?>" alt="<?=$rw['titular'];?>" /></a>
					</div>
					<?php } ?>


					<div class="titular-noticia row">
						<div class="col-lg-2">
							<div class="fecha"><?=$fechaPublicada;?></div>
						</div>
						<div class="col-lg-10" style="padding:0;">
							<a href="<?=$urlNoti;?>"><?=$rw['titular'];?></a>
						</div>
					</div>
					<div class="clearfix"></div>
					<!-- #titular noticia -->

					<div class="text-noticia">
					
						<p><?=RecortaStr(stripslashes(strip_tags($rw['noticia'])), 250,'..');?></p>
						<a href="<?=$urlNoti;?>" class="leermas">Ver toda la noticia</a> <?php if($catTxt != ""){ ?><span class="categoria">En <a href="<?=$urlCat;?>" style="font-weight:bold;"><?=$catTxt;?></a></span>
						<?php } ?>
					
					</div>
				
				</div>
				<!-- # noticia -->


				<div class="clearfix"></div>
				<div class="separanoticia"></div>

			</div>
		</div>				
			

				<?php

		} // if pep toni

					}
						if($numRes > 0 && $nPags > 1)
						{

							if(isset($_GET['pg'])) $urlPagAux = str_replace("?pg=".intval($_GET['pg']),"",$_SERVER['REQUEST_URI'])."?pg=[PAG]";
							else $urlPagAux = $_SERVER['REQUEST_URI']."?pg=[PAG]";

							echo getPaginacion($urlPagAux, $numRes, $nPags, $numList = $numNotis, $maxPags = 9, $only=false);

							echo "<div style=\"clear:both;margin-bottom:10px;\"></div>\n";
						}
				}
				else echo "<h2 style=\"text-align:center;font-weight:normal;margin:10px;\">No existen noticias en esta sección.</b></h2>";

			?>