<?php

function temp13_proximosEventos($limite)
{

	global $conex, $urlOri, $urlOriBase, $idparroquia;

	$ahora = date('Y-m-d G:i:s');

	//  

	$sql = "SELECT * FROM jqcalendar WHERE parroquia = ".$idparroquia." AND StartTime >= '$ahora' ORDER BY StartTime ASC LIMIT $limite";
	$rs = mysql_query($sql,$conex);

	if(mysql_num_rows($rs) > 0)
	{

		$datos = ""; $i=1;

		while($rw = mysql_fetch_assoc($rs))
		{

		$hora = date('G:i',strtotime($rw['StartTime']));

		if($hora != "" && $hora != "0:00") $hora = "<div class=\"hora\">".$hora." horas</div>"; else $hora = "";

		$dia = date('d',strtotime($rw['StartTime']));
		$anyo = date('Y',strtotime($rw['StartTime']));
		$mes = getMes(date('m',strtotime($rw['StartTime'])));


		$diaSemana = date('D',strtotime($rw['StartTime']));

		switch($diaSemana)
		{
			case "Mon"; $diaSemana = "Lunes"; break;
			case "Tue"; $diaSemana = "Martes"; break;
			case "Wed"; $diaSemana = "Miércoles"; break;
			case "Thu"; $diaSemana = "Jueves"; break;
			case "Fri"; $diaSemana = "Viernes"; break;
			case "Sat"; $diaSemana = "Sábado"; break;
			case "Sun"; $diaSemana = "Domingo"; break;
			default: break;
		}


$datos.='<div class="item event-block">
        <div class="event-item"> 
          <div class="event-img">                                       
            <div class="overlay-bg"></div>';
            //<a href="#">
$datos.='<img src="'.$urlOriBase.'images/event/events'.$i.'.jpg" class="img-responsive" alt="'.utf8_decode($rw['Subject']).'">';
//</a>
$datos.='</div>
          <div class="event-countdown">';

$datos.='<div class="coming-countdown" data-countdown="'.$rw['StartTime'].'"></div>';

$datos.='</div>
          <div class="event-content">';
//            <a href="event-details.html">

$datos.='<h4 class="event-heading">'.utf8_decode($rw['Subject']).'</h4>';
//</a>';

$datos.='<p class="event-dtl">'.$diaSemana.',  '.$dia.' de '.$mes.' de '.$anyo.' - '.utf8_decode($rw['Location']).'</p>';
            //<a class="read-more" href="event-details.html">Read More<i class="fa fa-long-arrow-right"></i></a>
$datos.='          </div>
        </div>
      </div>';

      	$i++;

		}


	}
	else $datos = false;


	return $datos;
}


/*
              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="abt-tab-item">    
                <?php echo dameBoton("#despacho", "Horario despacho parroquial", "flaticon-prayers"); ?> 

                  <a href="#despacho">
                    <div class="abt-tab-icon">
                      <i class="flaticon-prayers"></i>
                    </div>
                    <h6 class="abt-icon-name">Horario despacho parroquial</h6>
                  </a>
                </div>
              </div>
*/
//(OM)
function dameBloqueItemManual($enlace, $titulo, $icono){
	
	$item='<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="abt-tab-item" style="height:180px;margin-bottom:20px;">';    
    $item.=dameBoton($enlace, $titulo, $icono);

    $item.='</div></div>';

    return $item; 
}

//(OM)
function dameBoton($enlace, $titulo, $icono){

	$item='<a href="'.$enlace.'">';
	if ($icono<>'') {
		$item.='<div class="abt-tab-icon"><i class="'.$icono.'"></i></div>';
	}
	$item.='<p class="abt-icon-name" style="line-height: normal;padding-top:25px;">'.$titulo.'</p>';
	$item.='</a>';

	return $item;
}

//(OM)
function temp13_getBloques($inicio=1)
{

global $conex, $idparroquia, $urlOri, $idioma;

	$sql = "SELECT * FROM bloques WHERE parroquia = $idparroquia  and activar=1 AND bloque != 'proximos_eventos' ORDER BY parte, orden ASC";
	$result = mysql_query($sql,$conex);

	$devuelve = "";

	if(mysql_num_rows($result) > 0)
	{

        $i=$inicio;

		while($fila = mysql_fetch_assoc($result))
		{

			/*if ($i==1) {$devuelve.='<div class="abt-tab-icons text-center"><div class="row">';
            }*/

			$item='<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
			<div class="abt-tab-item" style="height:180px;margin-bottom:20px;">';                  
            
			switch($fila['bloque'])
			{

			case "proximos_eventos";
				$item.=dameBoton("#eventos", $fila['titulo_bloque'], "flaticon-events");
			break;

			case "ultimos_documentos"; case "calendario_eventos"; case "revista_parroquial";
				$item="";
			break;

			case "ultimas_noticias"; 
				if($idioma == "en") $item.=dameBoton("#news", "News", "fa fa-newspaper-o fa-sm");
				else $item.=dameBoton("#news", "Noticias", "fa fa-newspaper-o fa-sm");
			break;

			case "misa_tv";
			
			
                if ($idparroquia==339) {
                  $enlace = 'https://www.mariavision.com/programacion-horarios/tus-programas-favoritos.html';
                  $titulo = 'María Visión';
               
                } else {  
                  $enlace = 'http://www.radiomaria.es/directo';
                  $titulo = 'Radio Maria';
                }
				//$item.='<a href="'.$enlace.'">';
				//$item.='<div class="abt-tab-icon"><i class="flaticon-help"></i></div>';
				//$item.='<h6 class="abt-icon-name">'.$titulo.'</h6>';
				$item.=dameBoton($enlace, $titulo, "flaticon-help");
			break;

			case "enlaces_amigos"; 
				$enlace=$urlOri."enlaces/";
				if($idparroquia == 2021) $item.=dameBoton($enlace, "Enlaces de interés", "flaticon-video-player");
				else $item.=dameBoton($enlace, $fila['titulo_bloque'], "flaticon-wedding");
			break;

			case "ultimas_noticias_diocesis"; 
				$enlace=$urlOri."diocesis/";
				$item.=dameBoton($enlace, $fila['titulo_bloque'], "fa fa-newspaper-o fa-sm");
			break;

            case "galeria"; 
				$item.=dameBoton("#portfolio", $fila['titulo_bloque'], "fa fa-picture-o fa-sm");
			break;

			case "rincon_lectura"; case "tiempo_reflexion"; case "hermandades_parroquiales";
		    case "campamento_juan_pablo"; case "comunidades_neocatecumenales"; case "lazos_amor_mariano"; 
		    case "pastoral_de_la_familia"; case "congregacion_marta"; case "bono_parroquial_2018"; 
		    case "caritas_protomartir"; case "bautismos_bautismos_senor"; case "partidas_bautismo"; 
		    case "resenyas_bibliograficas"; case "animacion_pastoral";
			case "SMGF"; case "sacramentos"; case "amonestaciones"; case "butlletins"; case "traductor";
			    
				$item .= temp13_getInfoPagina($fila['bloque'], $fila['titulo_bloque']);
			break;

			case "contacto";
			//(OM)
				$item .= getInfoSeccion($fila['bloque']);
			break;
			case "reflexiones"; case "oraciones"; case "pensamientos-de-santa-gema";

				$item.= temp13_getInfoSeccionImagen($fila['bloque'], $fila['titulo_bloque']);
			break;

			
			default:
			
				if($fila['id'] == 1237) $url = $urlOri."/categoria-pildoras-de-fe/377/";
				else if($fila['id'] == 1238) $url = $urlOri."/categoria-espacio-interior/376/";
				else if($fila['id'] == 1158) $url = $urlOri."catequesis/835/";
				else if($fila['id'] == 1329) $url = $urlOri."/categoria-comentario-a-la-palabra-de-dios/399/";
				else $url = "#";
			
				$item.=dameBoton($url, $fila['titulo_bloque'], "flaticon-events");
            }

            if ($item<>'') { 

            	$item.='</div></div>'; 

            	$devuelve.=$item;   

            	$i++;

         		/*if ($i>6) {
         			$devuelve.='</div></div><br><br>';
         			$i=1;
         		}*/
         	}	    

		}


	return $devuelve;

	}
	else return false;

}


function getPagina($bloque){

    $idPagina=0;

	switch($bloque){
		case "tiempo_reflexion"; $idPagina = 383; break;
		case "rincon_lectura"; $idPagina = 382; break;
		case "butlletins"; $idPagina = 397; break;
		case "campamento_juan_pablo"; $idPagina = 490; break;
		case "hermandades_parroquiales"; $idPagina = 505; break;
		case "lazos_amor_mariano"; $idPagina = 532; break;
		case "congregacion_marta"; $idPagina = 574; break;
		case "pastoral_de_la_familia"; $idPagina = 573; break;
		case "comunidades_neocatecumenales"; $idPagina = 531; break;
		case "bono_parroquial_2018": $idPagina = 582; break;
		case "caritas_protomartir": $idPagina = 597; break;
		case "bautismos_bautismos_senor": $idPagina = 596; break;
		case "partidas_bautismo": $idPagina = 598; break;
		case "resenyas_bibliograficas": $idPagina = 628; break;
		case "SMGF": $idPagina = 629; break;
		case "sacramentos": $idPagina = 630; break;
		case "amonestaciones": $idPagina = 631; break;
		case "animacion_pastoral": $idPagina = 673; break;

		case "reflexiones": $idPagina = 616; break;
		case "oraciones": $idPagina = 615; break;
		case "pensamientos-de-santa-gema": $idPagina=680; break;

		case "contacto": $idPagina = 599; break;
		case "bloque_catequesis"; $idPagina = 1133; break;

		default: break;
	}

return $idPagina;

}

//(OM)
function temp13_getInfoPagina($bloque, $titulo){
	// FUNCIÓN PARA SACAR INFO DE UNA PAGINA CON LINK LEER MÁS
	global $conex, $urlOri;

	$item = "";

	$idPagina = getPagina($bloque);

	if($idPagina > 0){
		$val = getValue("SELECT texto, txt_int FROM paginas WHERE id = $idPagina",0);
		$texto = RecortaStr(strip_tags($val[0]), 120, '...');
		$txtInt = $val[1];

		$linkPagina = $urlOri.$txtInt."/".$idPagina."/";
	

		$item='<a href="'.$linkPagina.'" target="_blank">';
		$item.='<p class="abt-icon-name" style="line-height: normal; padding-bottom:8px;">'.$titulo.'</p>';
		$item.='<p class="abt-icon-name" style="line-height: normal; padding:8px;font-size: 11px;">'.$texto.'</p>';
		$item.='<p class="abt-icon-name" style="line-height: normal; padding:8px;padding-top:0px;font-size: 12px;">Leer más</p>';
		$item.='</a>';
	}

	return $item;
}


//(OM)
function temp13_getInfoSeccionImagen($bloque, $titulo){
	//(OM) FUNCIÓN PARA SACAR INFO DE UNA PAGINA solo primera imagen de la seccion
	global $conex, $idparroquia, $urlOri, $urlRecursos;

	$item = "";

	switch($bloque){
		case "reflexiones": $idPagina = 616; break;
		case "oraciones": $idPagina = 615; break;
		case "pensamientos-de-santa-gema": $idPagina=680; break;
		default: break;
	}

	if($idPagina > 0){
		$val = getValue("SELECT texto, txt_int FROM paginas WHERE id = $idPagina",0);
		$texto = $val[0];
		$txtInt = $val[1];

		$val2 = getValue("SELECT foto FROM secciones_fotos where idfoto=1 and idseccion= $idPagina",0);
		$foto = $urlRecursos.'/uploads/'.$idparroquia.'/secciones/thb_'.$val2[0];
		$linkPagina = $urlOri.$txtInt."/".$idPagina."/";


		$fotoDiv = '<div style="padding:6px; width:100%;">
					<img style="width:100%;" src="'.$foto.'" class="img-responsive" align="center" />
			</div>';


		$item='<a href="'.$linkPagina.'" target="_blank" title="'.$txtInt.'">';
		$item.='<p class="abt-icon-name" style="padding:8px;margin:0px;line-height: normal;">'.$titulo.'</p>';
		$item.=$fotoDiv;

		$item.='</a>';
	}

	return $item;

}


?>