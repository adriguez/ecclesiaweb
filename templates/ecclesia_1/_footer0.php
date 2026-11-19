		


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
			<p>Página web desarrollada con el sistema de <a href="http://www.ecclesiared.es/" title="Plataforma de gestión parroquial online" target="_blank">Ecclesiared</a></p>

			<?php if($idparroquia == 73){ ?>
			<a href="<?=$urlOri;?>aviso-legal/368/"><?=getValue("SELECT titulo FROM paginas WHERE id = 368",1);?></a>
			<?php } ?>
		</div>

		<div class="clearfix"></div>

		</div><!-- #todo-->
	</div><!-- #todo-->

</div><!--.container-->

</body>
</html>