<?php
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

?>
 <section id="news" class="news-main-block">
    <div class="container">
      <div class="section text-center">
        <h3 class="section-heading"><?php if($idparroquia == 855) echo "Vida Parroquial"; else if($idioma == "en") echo "Last news"; else echo "Últimas noticias"; ?></h3>
      </div>

<?php
    include_once "noticias.php";
?>

    </div>
  </section>

  <?php
    }else{
  ?>
  
   <section id="news" class="news-main-block">
    <div class="container">
      <div class="section text-center">
        <h3 class="section-heading"><?php if($idioma == "en") echo "Last news"; else echo "Últimas noticias"; ?></h3>
      </div>
	  
	  <h2 style="text-align:center;"><?php if($idioma == "en") echo "No news here"; else echo "No existen noticias aqu&iacute;"; ?></h2>
  
      </div>
  </section>
	<?php } ?>