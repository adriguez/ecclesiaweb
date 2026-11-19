		

	<div class="clearfix"></div>

	</div>
	<!-- Row -->
		
	<div class="clearfix"></div>

		<div id="footer">
			<span><?=$nombreParroquia;?></span>

      <?php if($idparroquia == 1462){ ?>
      
        <div class="clearfix"></div>
        <ul class="redesS">
          <li><a href="https://www.facebook.com/profile.php?id=100075159550499" target="_blank"><img src="<?=$urlOri;?>templates/nuevo1/images/facebook_icon.png" /></a></li>
          <li><a href="https://www.youtube.com/channel/UC6SEUgTqPUxCiDUGDdXCs1w" target="_blank"><img src="<?=$urlOri;?>templates/nuevo1/images/youtube_icon.png" /></a></li>
          <li><a href="https://www.instagram.com/parroquiapresentaciondelsenor/" target="_blank"><img src="<?=$urlOri;?>templates/nuevo1/images/instagram_icon.png" /></a></li>
        </ul>

      <?php } ?>

			<div id="linksbajo">
				<p>Página web desarrollada con el sistema de <a href="http://www.ecclesiared.es/" title="Gestión parroquial online" target="_blank">Ecclesiared</a></p>
				<p><a href="<?=$urlOri;?>aviso-legal.html" title="Aviso legal">Aviso legal</a> | <a href="<?=$urlOri;?>politica-privacidad.html" title="Política de privacidad">Política de privacidad</a>
        | <a href="<?=$urlOri;?>cookies.html" title="Política de cookies">Política de cookies</a></p>
			</div>
			
		</div>

		

		<div class="clearfix"></div>

		</div><!-- #todo-->
	</div><!-- #todo-->

</div><!--.container-->

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
<script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
<script>
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#000"
    },
    "button": {
      "background": "#f1d600"
    }
  },
  "theme": "classic",
  "content": {
    "message": "Este portal web únicamente utiliza cookies propias con finalidad técnica, no recaba ni cede datos de carácter personal de los usuarios sin su conocimiento. Sin embargo, contiene enlaces a sitios web de terceros con políticas de privacidad ajenas este portal web que usted podrá decidir si acepta o no cuando acceda a ellos.",
    "dismiss": "Aceptar",
    "link": "Configuración e información",
    "href": "<?php if($idparroquia == 69) echo $urlRecursos."/uploads/69/Politica_de_proteccion_de_datos.pdf"; else echo $urlOri."/politica-privacidad.html"; ?>"
  }
});
</script>

</body>
</html>