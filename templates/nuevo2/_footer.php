		


	<div class="clearfix"></div>

	</div>
	<!-- Row -->

	<div class="clearfix"></div>

		<div id="footer">

		<?php if($idparroquia == 1){ ?>
			<img src="<?=$urlOri;?>templates/nuevo2/images/moreneta_logo.png" />
		<?php } ?>
			<span>
				<?=$foot;?>
			</span>
		</div>

		<div id="linksbajo">
 		    <?php if($idparroquia == 69){ ?>
			<a href="<?=$urlRecursos;?>/uploads/69/Aviso_legal.pdf" title="Aviso Legal">Aviso Legal</a> - 
			<a href="<?=$urlRecursos;?>/uploads/69/Politica_de_proteccion_de_datos.pdf" title="Política de protección de datos">RGPD</a><br>
			<?php } ?>
			<p>Página web desarrollada con el sistema de <a href="http://www.ecclesiared.es/" title="Plataforma de gestión parroquial online" target="_blank">Ecclesiared</a></p>
			<?php if($idparroquia != 69){ ?>
				<p><a href="<?=$urlOri;?>aviso-legal.html" title="Aviso legal">Aviso legal</a> | <a href="<?=$urlOri;?>politica-privacidad.html" title="Política de privacidad">Política de privacidad</a>
			| <a href="<?=$urlOri;?>cookies.html" title="Política de cookies">Política de cookies</a></p>
			<?php } ?>
		</div>

		<div class="clearfix"></div>

		</div><!-- #todo-->
	</div><!-- #todo-->

</div><!--.container-->

<?php if($idparroquia == 329){ ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-121178896-1']);
  _gaq.push(['_setDomainName', 'parroquiabautismodelseñor.es']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php } ?>

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