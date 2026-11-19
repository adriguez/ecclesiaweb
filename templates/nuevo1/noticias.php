			

			<?php if($idparroquia == 9 && $_GET['m'] == 18){ ?>

		<div class="row">
			<div class="col-lg-12">
				<div class="noticia">

					<div class="titular-noticia">						
						<a href="#">&nbsp; &nbsp; Introducció - Biografíes</a>
					</div>
					<!-- #titular noticia -->
					<div class="bajonoticia"></div>

					<div class="text-noticia">

			<p>Potser que la idea de Patrimoni artístic-documental es queda curta com a línea argumental per a la Parròquia Puríssima Concepció de Quart de Poblet en aquest segle XXI. En un context contemporani on la difusió del saber es produeix a escales « globalitzadores » és convenient acollir tota la producció parroquial. El caràcter recopilatori de la iniciativa, es caracteritza en el plànol metodològic per l’ús de mesures dirigides a la identificació, documentació, investigació, posada en valor, transmissió i revitalització del patrimoni cultural i dels seus protagonistes. </p>
			<p>És per això que, després dels treballs de personal investigador (Josep Lluís Cebrian, Pau Olmos, Lidia Serer, Beatriz Vidal, Mireia Fuentes, Miriam Mestre), continuem l’itinerari per les persones, és a dir, els homes i les dones que han treballat i treballen en la construcció de la parròquia cada dia. Recuperar aquesta visió històrica també és ben important. El nostre parroquià i benvolgut Cronista de Quart, Sr. Amador Grinyó (q.p.d.) ens aportà les primeres pedres estructurals per bastir aquest edifici. I amb totes les aportacions (Jaume Sanmartín Fita, Pep i Cento Santo, Rafael Valldecabres, etc.) altres continuarem, segurament. </p>
			<p>Una iniciativa per estimar i veure créixer. </p>

					</div>

				</div>
			</div>
		</div>

			<?php } ?>

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
					while($rw = mysql_fetch_assoc($bucle))
					{

						$fechaPublicada = dameFecha(strtotime($rw['fecha']));

						$catTxt = getValue("SELECT categoria FROM noticias_categorias WHERE id = ".$rw['categoria'],1);

						$urlCat = $urlOri."categoria-".limpiarCadena($catTxt,'archivo')."/".$rw['categoria']."/";
						$urlNoti = $urlOri.limpiarCadena($rw['titular'],'archivo')."-".$rw['id'].".html";

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

						$fecha = explode("-",$rw['fecha']);

						$anyo = $fecha[0];
						$dia = date('d',strtotime($rw['fecha']));
						$mes = $fecha[1];

						$fechaPublicada = $dia."<span>".substr(strtoupper(getMes($mes)),0,3)." ".$anyo."</span>";

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
					<!-- #titular noticia -->
					<div class="bajonoticia"></div>

					<div class="text-noticia">
					
						<p><?=strip_tags(stripslashes(RecortaStr($rw['noticia'], 250,'..')));?></p>
						<a href="<?=$urlNoti;?>" class="leermas">Ver toda la noticia</a> <?php if($catTxt != ""){ ?><span class="categoria">En <a href="<?=$urlCat;?>" style="font-weight:bold;"><?=$catTxt;?></a></span><?php } ?>
					
					</div>
				
				</div>
				<!-- # noticia -->
			</div>
		</div>
			
				<div style="clear:both;"></div>
				<div class="separanoticia"></div>

				<?php

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