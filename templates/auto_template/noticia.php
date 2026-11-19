<?php 

$urlActual = $urlOri.$_SERVER['REDIRECT_URL'];

if(isset($_GET['m']) && $_GET['m'] > 0) $idnoticia = intval($_GET['m']); else $idnoticia = "";

$bucle = dameBucle($idparroquia, $numNotis, $idnoticia, 0, '', '', 'single');

$bucle = $bucle[0];

if(mysql_num_rows($bucle) > 0)
{
    $rw = mysql_fetch_assoc($bucle);

    $noticia = stripslashes($rw['noticia']);
    $noticia = convertYoutube($noticia);

    $fecha = date('Y-m-d',strtotime($rw['fecha']));
    $fecha = explode("-",$fecha);

    $anyo = $fecha[0];
    $dia = $fecha[2];
    $mes = $fecha[1];

    $fechaPublicada = "Publicada el: ".$dia." de ".getMes($mes)." de ".$anyo;
    //$fechaPublicada = "<div>".$dia."</div>".substr(strtoupper(getMes($mes)),0,3)."<br />".$anyo;

    $catTxt = getValue("SELECT categoria FROM noticias_categorias WHERE id = ".$rw['categoria'],1);

    $urlCat = $urlOri."categoria-".limpiarCadena($catTxt,'archivo')."/".$rw['categoria']."/";

    // **********************
    // **** IMAGENES ********
    // **********************

    $sql = "SELECT * FROM noticias_fotos WHERE parroquia = $idparroquia AND idnoticia = $idnoticia ORDER BY idfoto ASC";
    $rs = mysql_query($sql,$conex) or die (mysql_error());

    $imagenes = "";
    $imagenPrimera = "";
    $conta = 0;

    if(mysql_num_rows($rs) == 1)
    {
        $fila = mysql_fetch_assoc($rs);

        $foto = $urlRecursos."uploads/".$fila['parroquia']."/noticias/big_".$fila['foto'];
        $urlFoto = $urlRecursos."uploads/".$fila['parroquia']."/noticias/big_".$fila['foto'];

        $imagenPrimera = "<img class=\"thumbnail\" src=\"$urlFoto\" />";

    }
    elseif(mysql_num_rows($rs) > 1)
    {
        while($fila = mysql_fetch_assoc($rs))
        {
            $conta++;

            $foto = $urlRecursos."uploads/".$fila['parroquia']."/noticias/big_".$fila['foto'];
            $urlFoto = $urlRecursos."uploads/".$fila['parroquia']."/noticias/big_".$fila['foto'];

            if($conta == 1) $imagenPrimera = "<img class=\"thumbnail\" alt=\"".$rw['titular']."\" src=\"$foto\" />";
            else{
                $imagenes .= "<a href=\"$urlFoto\" class=\"fancybox-thumb\" rel=\"fancybox-thumb\"><img alt=\"".$rw['titular']."\" src=\"$foto\" /></a>";

            }
        }
    }


    // **********************
    // **********************
    // **********************

?>

<div class="item intro2 no-margins" id="intro2">
    		
    		<div class="container">
    
                <div class="row">
                 
                    <div class="col-md-8 col-md-offset-2">
            
                        <h2 class="intro-title2 editContent"><?=$rw['titular'];?></h2>
                        
                        <h3 class="intro-subtitle2 editContent"><?=$fechaPublicada;?></h3>
                       
                    </div><!-- /.col-md-8 -->
                   
                </div><!-- ./row -->
            
    		</div><!-- /.container -->
    	
    	</div><!-- /.item --><div class="item app" id="content2">
    		
    		<div class="container">
    
                <div class="row">
                
                    <div class="col-md-<?php if($imagenPrimera == "") echo "12"; else echo "6"; ?> padding-top-40">
            
				        <?=$noticia;?>
                        

                    </div><!-- /.col-md-6 -->
                
                    <?php if($imagenPrimera != ""){ ?>
                    <div class="col-md-6">
                    
                        <a href="<?=$foto;?>" target="_blank"><?=$imagenPrimera;?></a>
                    
                    </div><!-- /.col-md-6 -->
                    <?php } ?>
                    
                </div><!-- ./row -->
            
    		</div><!-- /.container -->
    	
    	</div><!-- /.item --></div><!-- /#page -->

        
				<?php
				}
				else echo "<h2 style=\"text-align:center;font-weight:normal;margin:10px;\">No existen noticias aquí</h2>";

			?>