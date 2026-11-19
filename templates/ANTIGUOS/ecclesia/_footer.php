<!-- End of footer -->
    
</div><!-- /#content-wrap -->

<div id="footnotes">
Copyright &copy;<?=date('Y');?> Todos los derechos reservados | <a href="<?=$urlOri;?>" title="EccesiaRed" style="color:#000;" class="site-name">Desarrollado por el sistema EcclesiaRed</a></div>

</div><!-- /#page-wrap -->

<script type="text/javascript" src="<?=$urlOri;?>templates/ecclesia/js/slides.min.jquery.js"></script>
<script type="text/javascript" src="<?=$urlOri;?>templates/ecclesia/js/jquery.plugins.js"></script>

<script type="text/javascript">
$(document).ready(function(){

    /* Main navigation */
    $('#main-nav').pragmaNavigation();
    
    /* Front page slider */
   	$("#front-slider").slides({
        preload: true,
        preloadImage: 'img/loading.gif',
        play: 5000,
        pause: 2500,
        hoverPause: true,
        pagination: false,
        generatePagination: false
    });

});
</script>

</body>
</html>