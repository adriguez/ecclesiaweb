<!--  page banner -->
  <header id="page-banner" class="banner-main-block">
    <div class="banner-img" style="background-image: url('<?=$urlOriBase;?>images/top-banner.jpg')">       
      <div class="overlay-bg"></div>
      <div class="container">
        <div class="banner-block">
          <h3 class="section-heading"><?php if($idparroquia == 2021) echo "Enlaces de interés"; else echo "Enlaces Amigos"; ?></h3>
          <ol class="breadcrumb">
            <li><a href="<?=$urlOri;?>">Inicio</a></li>
            <li class="active"><a><?php if($idparroquia == 2021) echo "Enlaces de interés"; else echo "Enlaces Amigos"; ?></a></li>
          </ol>
        </div>
      </div>     
    </div>
  </header>
<!--  end page banner -->
<!--  about  -->
<section id="about-block" class="about-main-block abt-two">
   <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="news-block">


        <div class="news-content text-center">					
          <ul class="enlaces_ami">
          <?=getLinks($idparroquia);?>
        </ul>
				</div>

		</div>
	</div>
</div>
</section>