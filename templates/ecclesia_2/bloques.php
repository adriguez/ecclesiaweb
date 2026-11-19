
<?php 

if(!isset($_GET['cat'])){

$sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 2) ORDER BY tipo ASC";
$result = mysql_query($sql,$conex);
if(mysql_num_rows($result) > 0) {
  $rw = mysql_fetch_assoc($result);
?>
<!--  about  -->
<section id="despacho" class="about-main-block">

   <div class="section text-center">
    <h3 class="section-heading"><?php echo $rw['titulo'];?></h3>
  </div>
  <div class="container-fluid">
    <div class="row row-spacing">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="about-img">
          <img src="<?=$urlOriBase;?>images/abt/<?php if($idparroquia == 1319) echo "oficina-parroquial.png"; else if($idparroquia == 855) echo "despacho-img2.jpg"; else if($idparroquia == 1011) echo "basilica/basilica_escudo.jpg"; 
          else if($idparroquia == 1110) echo "padua/despacho_parroquial.jpg"; else echo "despacho-img.jpg"; ?>" class="img-responsive" alt="<?php echo $rw['titulo'];?>">
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="about-content">


      <?php
          if($rw['texto'] != ""){ echo $rw['texto']; }
          while($rw = mysql_fetch_assoc($result))
          { 
            if($rw['texto'] != ""){ echo $rw['texto']; }
          }
      ?>

        </div>
      </div>
    </div>
  </div>
</section>
<!--  end about -->
<?php
 }
?>


<?php 
$sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia AND (tipo = 4) ORDER BY tipo ASC";
$result = mysql_query($sql,$conex);
if(mysql_num_rows($result) > 0) {
   $rw = mysql_fetch_assoc($result);
   if($rw['texto'] != ""){
?>
<!--  about  -->
<section id="cementerio" class="about-main-block">

   <div class="section text-center">
    <h3 class="section-heading"><?php echo $rw['titulo'];?></h3>
  </div>
  <div class="container-fluid">
    <div class="row row-spacing">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="about-img">
          <img src="<?=$urlOriBase;?>images/abt/cementerio.jpg" class="img-responsive" alt="<?php echo $rw['titulo'];?>">
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="about-content">


      <?php
          if($rw['texto'] != ""){ echo $rw['texto']; }
          while($rw = mysql_fetch_assoc($result))
          { 
            if($rw['texto'] != ""){ echo $rw['texto']; }
          }
      ?>

        </div>
      </div>
    </div>
  </div>
</section>
<!--  end about -->
<?php
} 
}

}
?>