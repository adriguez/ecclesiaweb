<!-- Main content -->

<div class="grid-wrap with-sidebar">

    
    <div class="grid-4" style="float:left;margin-top:10px;">


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

					case "oraciones";
						include('oraciones.php');
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
/*
					case "santos";
						include('santos_ficha.php');
					break;
*/

					case "documentos";
						include('documentos.php');
					break;
/*
					case "todo-santos";
						include('todo-santos.php');
					break;
*/
					default:

						include('featured.php');

						include('noticias.php');

					break;
				}
			?>

	</div>