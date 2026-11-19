<!--  page banner -->
  <header id="page-banner" class="banner-main-block">
    <div class="banner-img" style="background-image: url('<?=$urlOriBase;?>images/top-banner.jpg')">       
      <div class="overlay-bg"></div>
      <div class="container">
        <div class="banner-block">
          <h3 class="section-heading">Últimas noticias de la Diócesis</h3>
          <ol class="breadcrumb">
            <li><a href="<?=$urlOri;?>">Inicio</a></li>
            <li class="active"><a>Últimas noticias de la Diócesis</a></li>
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


        <div class="news-content">					
          <ul class="news_diocesis">
          <?php 
          
          $arrayNoticias = getNoticias("ultimas", true, 1);

          if(count($arrayNoticias) == 0) echo "<li><b>No existen Noticias</b></li>";          
          
          ?>
        </ul>

        <div class="row">

          <?php if(count($arrayNoticias) > 0){
            
            $conta=0;
            foreach($arrayNoticias as $i=>$v){

              $fecha = date('d M Y',strtotime($v['fecha']));
              $conta++;
              ?>
          
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="margin-bottom:20px;">
                <div class="news-contentOne">
                  <div class="news-desc">
                    <p class="news-date"><i class="fa fa-calendar"></i>Fecha <?=$fecha;?></p>
                    <p class="news-date"><i class="fa fa-folder-o"></i><a href="<?=$urlOri;?>diocesis/">Noticias de la Diócesis</a></p>

                                      </div>
                  <a href="<?=$v['url'];?>"><h4 class="news-heading"><?=$v['titular'];?></h4></a>

										<p class="news-dtl"></p>
	
                  <a class="read-more" href="<?=$v['url'];?>" target="_blank">Ver toda la noticia<i class="fa fa-long-arrow-right"></i></a>
                </div>
              </div>

          <?php if($conta%2==0) echo "<div style=\"clear:both;\"></div>\n"; 
            }
          } ?>
      </div>

				</div>

		</div>
	</div>
</div>
</section>