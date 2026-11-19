<div class="row">
	<div class="col-lg-12">
			<div class="noticia">

					<div class="titular-noticia">
						<div class="fecha">&nbsp;</div>
						<span style="margin:0;">Misa en Varios idiomas</span>
					</div>
					<!-- #titular noticia -->
					<div class="bajonoticia"></div>

				<div class="text-noticia">
				<?php if(!isset($_GET['ciclo'])){ ?>	

					<p>Le ofrecemos la posibilidad de descargar en formato PDF todas las lecturas de las misas en los diferentes idiomas disponibles, primero seleccione un ciclo.</p>

					<div align="center">
						<input type="button" class="buttonNew grayNew" onclick="document.location.href='misa-en-varios-idiomas/ciclo-A/';" value="Ciclo A" />
						<input type="button" class="buttonNew grayNew" onclick="document.location.href='misa-en-varios-idiomas/ciclo-B/';" value="Ciclo B" />
						<input type="button" class="buttonNew grayNew" onclick="document.location.href='misa-en-varios-idiomas/ciclo-C/';" value="Ciclo C" />
					</div>
				<?php }else{ ?>
					<?=getMisas(addslashes($_GET['ciclo']));?>
				<?php } ?>
				</div>
	</div>
	</div>
</div>

