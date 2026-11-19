		


	<div class="clearfix"></div>

	</div>
	<!-- Row -->

	<div class="clearfix"></div>

		<div id="footer">

			<span>
				<?=$foot;?>
			</span>
			
			<?php if($idparroquia == 73){ ?><p style="font-size:18px;margin-top:10px;color:#fff;">
				Tel&eacute;fono de contacto: 966757059</p>
			<?php } ?>
			
		</div>


		<div id="linksbajo">
  		    <?php if($idparroquia == 30){ ?>
			
			<a href="<?=$urlRecursos;?>/uploads/30/Aviso_legal.pdf" title="Aviso Legal">Aviso Legal</a> - 
			<a href="<?=$urlRecursos;?>/uploads/30/Politica_de_proteccion_de_datos.pdf" title="Política de protección de datos">RGPD</a><br>
			
			<?php } ?>
			
			<?php if($idparroquia == 587){ ?>
			<div class="row">

				<div class="col-md-3">&nbsp;</div>
				<div class="col-md-3" style="text-align: left;">
					Rector: Mn. Ramón Maria Vila<br><br>
					Plaça Carme Llinás, 1<br>
					08620 Sant Vicenç dels Horts<br>
					Barcelona<br><br>
					Telf: 93.656.16.55
				</div>

				<div class="col-md-3" style="text-align: left;">
					Correu e-mail: Mn. Ramón Maria Vila<br>
					ramonmariavila@gmail.com
				</div>

			</div><br>
			<?php } ?>

			<p>Página web desarrollada con el sistema de <a href="https://www.ecclesiared.es/" title="Plataforma de gestión parroquial online" target="_blank">Ecclesiared</a></p>

			<p><a href="<?=$urlOri;?>aviso-legal.html" title="Aviso legal">Aviso legal</a> | <a href="<?=$urlOri;?>politica-privacidad.html" title="Política de privacidad">Política de privacidad</a>
		| <a href="<?=$urlOri;?>cookies.html" title="Política de cookies">Política de cookies</a></p>

			<?php if($idparroquia == 73){ ?>
			<a href="<?=$urlOri;?>aviso-legal/368/"><?=getValue("SELECT titulo FROM paginas WHERE id = 368",1);?></a>
			<?php } ?>


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