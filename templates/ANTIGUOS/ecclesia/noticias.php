			
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

				?>

<div class="post" style="margin-top:30px;">
                <h1><a href="<?=$urlNoti;?>"><?=$rw['titular'];?></a></h1>
                <div class="post-meta">

                    <ul>
                        <li class="post-meta-date"><?=$fechaPublicada;?></li>
                        <li class="post-meta-category">Publicado en <a href="<?=$urlCat;?>" style="font-weight:bold;"><?=$catTxt;?></a></li>
                    </ul>

                </div>
		<p class="large"><?=strip_tags(stripslashes(RecortaStr($rw['noticia'], 250,'..')));?></p>
		<p class="links"><a href="<?=$urlNoti;?>" class="more-link">Ver artículo &raquo;</a></p>
            </div>
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