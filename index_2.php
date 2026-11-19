<?php

include('_includes/config.php');

$head = "templates/performance/_header.php";
$foot = "templates/performance/_footer.php";
$sidebar_left = "templates/performance/sidebar_left.php";
$sidebar_right = "templates/performance/sidebar_right.php";
$content = "templates/performance/content.php";

	include($head);

?>
<?php
	include($sidebar_left);
?>
<?php
	include($content);
?>
<?php
	include($sidebar_right);
?>
<?php
	include($foot);
?>