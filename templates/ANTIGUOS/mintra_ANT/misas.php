
			<div class="post">
				<h2 class="title">Misa en varios idiomas</h2>
				<p class="byline"><?=$nombreParroquia;?></p>

				<?php if(!isset($_GET['ciclo'])){ ?>	

					<p>Le ofrecemos la posibilidad de descargar en formato PDF todas las lecturas de las misas en los diferentes idiomas disponibles, primero seleccione un ciclo.</p>

					<div align="center">
						<input type="button" class="buttonNew redNew" onclick="document.location.href='misa-en-varios-idiomas/ciclo-A/';" value="Ciclo A" />
						<input type="button" class="buttonNew redNew" onclick="document.location.href='misa-en-varios-idiomas/ciclo-B/';" value="Ciclo B" />
						<input type="button" class="buttonNew redNew" onclick="document.location.href='misa-en-varios-idiomas/ciclo-C/';" value="Ciclo C" />
					</div>
				<?php }else{ ?>
					<?=getMisas(addslashes($_GET['ciclo']));?>
				<?php } ?>

			</div>