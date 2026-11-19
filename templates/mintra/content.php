<div class="col-lg-6 col-md-8 contenido col-lg-push-3 col-md-push-4">

			<?php if(isset($_GET['sec']) && $_GET['sec'] != "") $sec = addslashes($_GET['sec']); else $sec = "index";

				switch($sec)
				{
					case "noticia";
						include('noticia.php');
					break;

					case "noticias";
						include('noticias.php');
					break;

					case "avisolegal";
						include('aviso-legal.php');
					break;

					case "cookies";
						include('cookies.php');
					break;

					case "politica";
						include('politica.php');
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

					case "grupos";
						include('grupos.php');
					break;

					case "contacto";
						include('contacto.php');
					break;

					case "misas";
						include('misas.php');
					break;

					case "documentos";
						include('documentos.php');
					break;

					case "especial";
						include('especial.php');
					break;

					case "oraciones";
						include('oraciones.php');
					break;

					case "oracionesNew";
						include('oracionesForm.php');
					break;

					default:

						include('featured.php');

						include('noticias.php');

					break;
				}
			?>

</div>