
			<div class="noticia">

					<div class="titular-noticia">
						<span style="margin:0;margin-left:15px;">Misa en Varios idiomas</span>
					</div>
					<!-- #titular noticia -->

				<div class="text-noticia">
				<?php if(!isset($_GET['ciclo'])){ ?>	

					<div style="clear:both;"></div>
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



