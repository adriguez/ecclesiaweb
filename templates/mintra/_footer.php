
	</div>
	<!-- Row -->

	<div class="clearfix"></div>

	<footer id="footer">
		<div class="row">
			<div class="col-lg-12">
				<div class="contenedorFooter">
			    		<div class="indent">
			          			<div class="fright">
			          				<a href="http://www.ecclesiared.es/" title="Eccesiared - Plataforma de gestión parroquial online" style="color:#000;" class="site-name">Desarrollado por el sistema Ecclesiared</a> &copy; <?=date('Y');?>  Todos los derechos reservados | <a href="<?=$urlOri;?>contacto.html" style="color:#000;">Contactar</a>

									  <p><a href="<?=$urlOri;?>aviso-legal.html" title="Aviso legal">Aviso legal</a> | <a href="<?=$urlOri;?>politica-privacidad.html" title="Política de privacidad">Política de privacidad</a> | <a href="<?=$urlOri;?>cookies.html" title="Política de Cookies">Política de Cookies</a></p>

			          			</div>
			    		</div>
				</div>
			</div>
		</div>
	</footer>

</div><!--.container-->

<script type="text/javascript" src="<?=$urlOri;?>templates/mintra/js/jquery_003.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>templates/mintra/js/scripts.js"></script>

 <!-- this is used by many Wordpress features and for plugins to work proporly -->
<script type="text/javascript"> Cufon.now(); </script>

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