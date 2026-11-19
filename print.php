<?php

if(isset($_GET['tipo']) && $_GET['tipo'] != "")
{
	$tipo = addslashes($_GET['tipo']);

	switch($tipo)
	{
		case "imagen";

		if(isset($_GET['file']) && $_GET['file'] != "")
		{

			echo "<img src=\"".addslashes($_GET['file'])."\" />";
			echo "<script type=\"text/javascript\" language=\"javascript\">print();</script>";

		}
		else echo "<h1>Debe seleccionar al menos una imágen para imprimir.</h1>";

	?>

	<?php

		break;
	}
}

?>