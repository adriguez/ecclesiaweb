<?php
//if(isset($_GET['sec'])) { echo $sec; }
//exit();
?>


			<?php if(isset($_GET['sec']) && $_GET['sec'] != "") $sec = addslashes($_GET['sec']); else $sec = "index";

				switch($sec)
				{
					case "noticia";
						include('noticia.php');
					break;
				
					case "estaticas";
						include('estatica.php');
					break;

					case "cookies";
						include('cookies.php');
					break;

					case "politica";
						include('politica.php');
					break;

					case "avisolegal";
						include('aviso-legal.php');
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

					case "oraciones";
						include('oraciones.php');
					break;

					case "misas";
						include('misas.php');
					break;

					case "documentos";
						include('documentos.php');
					break;

					case "enlaces";
						include('enlaces.php');
					break;

					case "diocesis";
						include('diocesis.php');
					break;

					case "especial";
						include('especial.php');
					break;

					case "oracionesNew";
						include('oracionesForm.php');
					break;

					default:
						include('cuerpo.php');
					break;
				}
			?>		