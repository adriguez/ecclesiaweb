	<div style="width:314px;float:right;">

        <div class="grid-2 widgets-container">


			<div id="mw-widget-twitter-feed-3" class="widget sidebar-widget mw-widget-twitter-feed" style="margin-top:11px;">
<?php

$sql = "SELECT * FROM bloques_home WHERE parroquia = $idparroquia ORDER BY tipo ASC";
$result = mysql_query($sql,$conex);

if(mysql_num_rows($result) > 0)
{
	while($rw = mysql_fetch_assoc($result))
	{
		if($rw['texto'] != "")
		{
			echo "<div class=\"widget-boxed has-head\" style=\"margin-bottom:15px;\"><div class=\"widget-head\"><h3>".$rw['titulo']."</h3></div>
					<div class=\"widget-body\">
						<ul class=\"mw-widget-twitter-feed-list\">
						<li>".$rw['texto']."</li>
						</ul>\n
				
						</div>
					</div>";
		}
	}
}

?>
				</div>

				<?=getBloques("izquierda", 3);?>
				<?=getBloques("derecha", 3);?>   
	</div>

</div>

<!-- End of main content -->


<b class="grid-divider"></b>
    
</div><!-- /#content-wrap-inner -->