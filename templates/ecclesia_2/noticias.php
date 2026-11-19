<?php

	$contador=0;

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
			$foto = $urlRecursos."uploads/".$rw['parroquia']."/noticias/big_".$tieneFoto;
			$urlFoto = $urlRecursos."uploads/".$rw['parroquia']."/noticias/big_".$tieneFoto;
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

			//$fechaPublicada = "<div>".$dia."</div>".substr(strtoupper(getMes($mes)),0,3)."<br />".$anyo;
			$fechaPublicada = $dia.' '.substr(strtoupper(getMes($mes)),0,3)." ".$anyo;

			$orientacion=$contador%2;


      switch ($orientacion) { 

      	case 0:
		?>

      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          
          <div class="row">
            <div class="news-blockOne">
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="news-imgOne block-effect">

								<?php if($foto != ""){ ?>
								<a href="<?=$urlNoti;?>"><img class="img-responsive" src="<?=$foto;?>" alt="<?=$rw['titular'];?>" /></a>
								<?php } else { ?>
                  <a href="<?=$urlNoti;?>"><img src="<?=$urlOriBase;?>images/blog/news-01.jpg" class="img-responsive" alt="news-img-1"></a>
 								<?php } ?>

                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding-bottom:20px;">
                <div class="news-contentOne">
                  <div class="news-desc">
                    <p class="news-date"><i class="fa fa-calendar"></i><?php if($idioma == "en") echo "Date"; else echo "Fecha"; ?> <?=$fechaPublicada;?></p>
                    <p class="news-date"><i class="fa fa-folder-o"></i><a href="<?=$urlCat;?>"><?=$catTxt;?></a></p>

                    <?php //<p class="news-by"><i class="fa fa-user"></i>Post By : <a href="#">Admin</a></p> ?>
                  </div>
                  <a href="<?=$urlNoti;?>"><h4 class="news-heading"><?=$rw['titular'];?></h4></a>

	<?php if($idparroquia != 538){ ?>
									<p class="news-dtl"><?=strip_tags(stripslashes(RecortaStr(deleteUrls(html_entity_decode($rw['noticia'])), 250,'..')));?></p>
	<?php }else{ ?>
									<p class="news-dtl"><?=strip_tags(stripslashes(RecortaStr(deleteUrls(html_entity_decode($rw['noticia'])), 250,'..')));?></p>
	<?php } ?>

                  <a class="read-more" href="<?=$urlNoti;?>"><?php if($idioma == "en") echo "Read more"; else echo "Ver toda la noticia"; ?><i class="fa fa-long-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


    <?php break;

       case 1:
    ?>

      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="row">
            <div class="news-blockTwo">
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="news-contentTwo">
                  <div class="news-desc">
                    <p class="news-date"><i class="fa fa-calendar"></i>Fecha <?=$fechaPublicada;?></p>
                    <p class="news-date"><i class="fa fa-folder-o"></i><a href="<?=$urlCat;?>"><?=$catTxt;?></a></p>
                    <?php //<p class="news-by"><i class="fa fa-user"></i>Post By : <a href="#">Admin</a></p> ?>
                  </div>
                  <a href="<?=$urlNoti;?>"><h4 class="news-heading"><?=$rw['titular'];?></h4></a>
				  	<?php if($idparroquia != 538){ ?>
                  <p class="news-dtl"><?=strip_tags(stripslashes(RecortaStr(deleteUrls(html_entity_decode($rw['noticia'])), 250,'..')));?></p>
					<?php }else{ ?>
                  <p class="news-dtl"><?=strip_tags(stripslashes(RecortaStr(deleteUrls(html_entity_decode($rw['noticia'])), 250,'..')));?></p>
					<?php } ?>
                  <a class="read-more" href="<?=$urlNoti;?>">Ver toda la noticia<i class="fa fa-long-arrow-right"></i></a>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <div class="news-imgTwo block-effect">


										<?php if($foto != ""){ ?>
											<a href="<?=$urlNoti;?>"><img class="img-responsive" src="<?=$foto;?>" alt="<?=$rw['titular'];?>" /></a>
										<?php } else { ?>
                  		<a href="<?=$urlNoti;?>"><img src="<?=$urlOriBase;?>images/blog/news-01.jpg" class="img-responsive" alt="news-img-1"></a>
 										<?php } ?>

                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="news-blockTwo">
            </div>
        </div>
      </div>

  <?php break;

       }
    ?>

        
  



<?php 

	}

	$contador++;

	}

?>
<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<?php
    if($numRes > 0 && $nPags > 1)
    {
      if(isset($_GET['pg'])) $urlPagAux = str_replace("?pg=".intval($_GET['pg']),"",$_SERVER['REQUEST_URI'])."?pg=[PAG]";
        else $urlPagAux = $_SERVER['REQUEST_URI']."?pg=[PAG]";

        echo getPaginacion($urlPagAux, $numRes, $nPags, $numList = $numNotis, $maxPags = 9, $only=false);

        echo "<div style=\"clear:both;margin-bottom:10px;\"></div>\n";
    }
?>
</div>
</div>