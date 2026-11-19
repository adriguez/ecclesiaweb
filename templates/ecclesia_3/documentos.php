<!--  page banner -->
  <header id="page-banner" class="banner-main-block">
    <div class="banner-img" style="background-image: url('<?=$urlOriBase;?>images/top-banner.jpg')">       
      <div class="overlay-bg"></div>
      <div class="container">
        <div class="banner-block">
          <h3 class="section-heading">Documentos Disponibles</h3>
          <ol class="breadcrumb">
            <li><a href="<?=$urlOri;?>">Inicio</a></li>
            <li class="active"><a>Documentos Disponibles</a></li>
          </ol>
        </div>
      </div>    
    </div>
  </header>
<!--  end page banner -->
<!--  about  -->
<section id="about-block" class="about-main-block abt-two">
    <div class="container">
    	<div class="sectionCenter">
    	 	<div class="noticiaCenter">   		

				<div class="texto-noticia">
					<div style="clear:both;"></div>
					<?=getDocsPage($idparroquia);?>
				</div>

		</div>
	</div>
</div>
</section>