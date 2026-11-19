
		<!-- start content -->
		<div id="content">

			<?php if(isset($_GET['sec'])) echo breadCumbs();?>

			<?php if(isset($_GET['sec']) && $_GET['sec'] != "") $sec = addslashes($_GET['sec']); else $sec = "index";

				switch($sec)
				{
					case "noticia";
						include('noticia.php');
					break;
					case "noticias";
						include('noticias.php');
					break;
					case "estaticas";
						include('estatica.php');
					break;
					case "galeria";
						include('galeria.php');
					break;

					case "eventos";
						include('eventos.php');
					break;

					case "liturgia";
						include('liturgia.php');
					break;

					case "contacto";
						include('contacto.php');
					break;

					case "santos";
						include('santos_ficha.php');
					break;

					case "documentos";
						include('documentos.php');
					break;

					case "todo-santos";
						include('todo-santos.php');
					break;

					default:
						if(getValue("SELECT activar FROM bloque_bienvenida WHERE parroquia = $idparroquia",1) == 1) 
						{
							include('featured.php');
						}

						include('noticias.php');

						include('santos.php');
					break;
				}
			?>
		</div>
		<!-- end content -->
