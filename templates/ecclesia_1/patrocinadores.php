<?php

//if ($_SERVER['REMOTE_ADDR'] == "93.105.163.176") {
  
	//ini_set('display_errors','1');
	//ini_set("error_reporting",E_ALL);


	$n_patrocinadores = 6;


 	$sql = "SELECT n.* FROM patrocinadores n WHERE n.parroquia = $idparroquia AND n.activar = 1 ORDER BY n.id DESC limit $n_patrocinadores";

  $error='';

  $rs = mysql_query($sql,$conex) or $error=(mysql_error());

  $i=0;
  if(mysql_num_rows($rs) > 0)
  {

?>

<div class="row">
	<div class="col-lg-12" id="patrocinadores">
	 <?php
   echo '<div class="row" style="margin-top:10px;">';
   while($rw = mysql_fetch_assoc($rs))
    {
      $idpatrocinador=$rw["id"];
      $foto = getValue("SELECT foto FROM patrocinadores_fotos 
      	WHERE foto != '' AND idpatrocinador = $idpatrocinador ORDER BY idfoto ASC LIMIT 1",1);

      $foto = $urlRecursos."uploads/$idparroquia/patrocinadores/thb_".$foto;
	  
	  $rw['enlace'] = str_replace("http://","",$rw['enlace']);
	  $rw['enlace'] = str_replace("https://","",$rw['enlace']);
	  $rw['enlace'] = "https://".$rw['enlace'];

      echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="causes-item">
            <div class="cause-img">';
      echo '   <a href="'.$rw["enlace"].'" target="_blank"> <img src="'.$foto.'" class="img-responsive" alt="'.$rw["patrocinador"].'"></a>
            </div>
            <div class="causes-content">
              <a class="causes-heading" href="'.$rw["enlace"]. '" target="_blank"> <h5 class="causes-heading">'.$rw["patrocinador"].'</h5></a>
            </div>
          </div>
        </div>';
    }

    echo '</div></div></div>';  

  }

//}

?>