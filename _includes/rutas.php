<?php
// Rutas del servidor configurables por instalación.
//
// RUTA_WEB_BASE: carpeta raíz del subdominio web (plantilla de las webs parroquiales).
//   - Plesk antiguo: /var/www/vhosts/mintrared.com/subdomains/web/httpdocs/
//   - Plesk nuevo:   /var/www/vhosts/mintrared.es/web.mintrared.es/
// RUTA_WEB_UPLOADS: su carpeta "uploads/" (no se copia a los dominios de las parroquias).
// Siempre con "/" final.
if (!defined('RUTA_WEB_BASE')) define('RUTA_WEB_BASE', '/var/www/vhosts/mintrared.es/web.mintrared.es/');
if (!defined('RUTA_WEB_UPLOADS')) define('RUTA_WEB_UPLOADS', RUTA_WEB_BASE . 'uploads/');
