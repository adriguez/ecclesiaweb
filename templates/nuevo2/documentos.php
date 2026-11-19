<div class="row">
	<div class="col-lg-12">
			<div class="noticia">

					<div class="titular-noticia">

					<?php 
						//(OM) 07/08/2018 PARROQUIA SANTA MARÍA DE GUADALUPE quiere cambiar el nombre de documentos
						$titulo="Documentos Disponibles"; 
						if($idparroquia == 339) { $titulo="Escuela de Laicos";}
					?>
						
						<span><?php echo $titulo; ?></span>
					
					</div>
					<!-- #titular noticia -->
					<div class="bajonoticia"></div>

				<div class="texto-noticia">
					<div style="clear:both;"></div>
					<?=getDocsPage($idparroquia);?>
				</div>

			</div>
	</div>
</div>