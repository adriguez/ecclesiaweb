<?php

	if(isset($_GET['id']) && $_GET['id'] > 0)
	{
		$idsanto = intval($_GET['id']);

		if(getValue("SELECT nombre FROM santos WHERE id = $idsanto",1) != "")
		{
			echo getDatosSanto($idsanto);

			echo "<hr class=\"barra\" />";

			include('santos.php');

		}
		else exit();
	}
	else exit();

?>