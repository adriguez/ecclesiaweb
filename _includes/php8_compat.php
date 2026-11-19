<?php
/*
 * Capa de compatibilidad PHP 5.6 -> PHP 8.4
 *
 * - Reimplementa las funciones mysql_* (eliminadas en PHP 7.0) sobre mysqli,
 *   imitando el comportamiento de la extension original (enlace por defecto,
 *   devolver false en vez de lanzar excepciones, etc.) para no tener que
 *   modificar las ~6.000 llamadas existentes.
 * - Polyfills de each() y get_magic_quotes_gpc() (eliminadas en PHP 8.0).
 *
 * Se carga con require_once desde _includes/config.php, _includes/datosConex.php
 * y desde los scripts que abren su propia conexion.
 */

// Juego de caracteres de la conexion. La extension mysql de PHP 5.6 no fijaba
// ninguno (el codigo no usa SET NAMES), y las paginas son ISO-8859-1.
// Si los acentos salen mal, probar con 'utf8' o dejarlo en '' (por defecto del servidor).
if (!defined('MYSQL_COMPAT_CHARSET')) define('MYSQL_COMPAT_CHARSET', 'latin1');

/*
 * MODO PRUEBAS DE CORREO
 * En el servidor de pruebas (rutas o dominio mintrared.es) no se envia ningun
 * correo real: PHPMailer y XPertMailer pasan por correo_pruebas_interceptar().
 * - CORREO_PRUEBAS_DESTINO vacio: no se envia nada; solo se anota en el registro
 *   /var/www/vhosts/mintrared.es/private/correos_pruebas.log
 * - CORREO_PRUEBAS_DESTINO con un email: todos los correos (solo PHPMailer) se
 *   envian a esa direccion en lugar de a los destinatarios reales.
 * En produccion (mintrared.com) no tiene ningun efecto.
 */
if (!defined('CORREO_MODO_PRUEBAS')) {
    $__host = isset($_SERVER['HTTP_HOST']) ? strtolower($_SERVER['HTTP_HOST']) : '';
    define('CORREO_MODO_PRUEBAS',
        strpos(str_replace('\\', '/', __DIR__), '/vhosts/mintrared.es/') !== false
        || ($__host !== '' && substr($__host, -strlen('mintrared.es')) === 'mintrared.es'));
    unset($__host);
}
if (!defined('CORREO_PRUEBAS_DESTINO')) define('CORREO_PRUEBAS_DESTINO', '');

if (!function_exists('correo_pruebas_log')) {
    function correo_pruebas_log($origen, $destinatarios, $asunto, $accion)
    {
        $dir = dirname(__DIR__, 3) . '/private';
        if (!is_dir($dir) || !is_writable($dir)) $dir = sys_get_temp_dir();
        if (is_array($asunto)) $asunto = implode(' ', array_filter($asunto, 'is_scalar'));
        $linea = date('Y-m-d H:i:s') . "\t$origen\t$accion\t" . implode(', ', (array) $destinatarios) . "\t" . str_replace(array("\r", "\n"), ' ', (string) $asunto) . "\n";
        @file_put_contents($dir . '/correos_pruebas.log', $linea, FILE_APPEND);
    }
}

// mail() nativo con el mismo modo pruebas: en pruebas solo se anota en el log.
if (!function_exists('correo_mail')) {
    function correo_mail($para, $asunto, $mensaje, $cabeceras = '', $parametros = '')
    {
        if (defined('CORREO_MODO_PRUEBAS') && CORREO_MODO_PRUEBAS) {
            correo_pruebas_log('mail()', $para, $asunto, 'NO ENVIADO');
            return true;
        }
        return mail($para, $asunto, $mensaje, $cabeceras, $parametros);
    }
}

if (!function_exists('mysql_connect')) {

    // PHP 8.1+ lanza excepciones por defecto; la extension mysql devolvia false.
    mysqli_report(MYSQLI_REPORT_OFF);

    if (!defined('MYSQL_ASSOC')) define('MYSQL_ASSOC', MYSQLI_ASSOC);
    if (!defined('MYSQL_NUM'))   define('MYSQL_NUM', MYSQLI_NUM);
    if (!defined('MYSQL_BOTH'))  define('MYSQL_BOTH', MYSQLI_BOTH);
    if (!defined('MYSQL_CLIENT_COMPRESS'))     define('MYSQL_CLIENT_COMPRESS', MYSQLI_CLIENT_COMPRESS);
    if (!defined('MYSQL_CLIENT_IGNORE_SPACE')) define('MYSQL_CLIENT_IGNORE_SPACE', MYSQLI_CLIENT_IGNORE_SPACE);
    if (!defined('MYSQL_CLIENT_INTERACTIVE'))  define('MYSQL_CLIENT_INTERACTIVE', MYSQLI_CLIENT_INTERACTIVE);
    if (!defined('MYSQL_CLIENT_SSL'))          define('MYSQL_CLIENT_SSL', MYSQLI_CLIENT_SSL);

    $GLOBALS['__mysql_compat_last_link'] = null;

    // Avisos como los de la extension original (E_WARNING): respetan error_reporting y @
    function __mysql_compat_warn($msg)
    {
        if (error_reporting() & E_WARNING) trigger_error($msg, E_USER_WARNING);
    }
    $GLOBALS['__mysql_compat_links'] = array();

    function __mysql_compat_link($link = null)
    {
        if ($link instanceof mysqli) return $link;
        // Sin enlace: la ultima conexion abierta. Con un enlace no valido (false, ""),
        // la extension original daba un warning y no hacia nada: no usar otra conexion.
        if ($link === null) return $GLOBALS['__mysql_compat_last_link'];
        __mysql_compat_warn('mysql: el enlace indicado no es una conexion valida');
        return null;
    }

    function __mysql_compat_open($server, $username, $password, $new_link, $client_flags, $persistent)
    {
        if ($server === null || $server === '') $server = ini_get('mysqli.default_host') ?: 'localhost';
        $host = $server; $port = null; $socket = null;
        if (strpos($server, ':/') !== false) {           // host:/ruta/al/socket
            list($host, $socket) = explode(':', $server, 2);
        } elseif (substr_count($server, ':') === 1) {    // host:puerto
            list($host, $port) = explode(':', $server, 2);
            $port = (int) $port;
        }
        $key = $server . '|' . $username . '|' . $password;
        if (!$new_link && isset($GLOBALS['__mysql_compat_links'][$key])) {
            $GLOBALS['__mysql_compat_last_link'] = $GLOBALS['__mysql_compat_links'][$key];
            return $GLOBALS['__mysql_compat_links'][$key];
        }
        $mysqli = mysqli_init();
        $ok = @mysqli_real_connect($mysqli, ($persistent ? 'p:' : '') . $host, $username, $password, '', $port, $socket, (int) $client_flags);
        if (!$ok) {
            $GLOBALS['__mysql_compat_connect_error'] = mysqli_connect_error();
            $GLOBALS['__mysql_compat_connect_errno'] = mysqli_connect_errno();
            __mysql_compat_warn('mysql_connect(): ' . mysqli_connect_error());
            return false;
        }
        if (MYSQL_COMPAT_CHARSET !== '') mysqli_set_charset($mysqli, MYSQL_COMPAT_CHARSET);
        $GLOBALS['__mysql_compat_links'][$key] = $mysqli;
        $GLOBALS['__mysql_compat_last_link'] = $mysqli;
        return $mysqli;
    }

    function mysql_connect($server = null, $username = null, $password = null, $new_link = false, $client_flags = 0)
    {
        return __mysql_compat_open($server, $username, $password, $new_link, $client_flags, false);
    }

    function mysql_pconnect($server = null, $username = null, $password = null, $client_flags = 0)
    {
        return __mysql_compat_open($server, $username, $password, false, $client_flags, true);
    }

    function mysql_select_db($database_name, $link = null)
    {
        $l = __mysql_compat_link($link);
        return $l ? mysqli_select_db($l, $database_name) : false;
    }

    function mysql_query($query, $link = null)
    {
        $l = __mysql_compat_link($link);
        if (!$l) { __mysql_compat_warn('mysql_query(): no hay conexion'); return false; }
        $GLOBALS['__mysql_compat_last_query_link'] = $l;
        // PHP 5.6 devolvia false ("Query was empty"); mysqli lanza ValueError.
        $GLOBALS['__mysql_compat_empty_query'] = (trim((string)$query) === '');
        if ($GLOBALS['__mysql_compat_empty_query']) return false;
        return mysqli_query($l, $query);
    }

    function mysql_unbuffered_query($query, $link = null)
    {
        $l = __mysql_compat_link($link);
        if (trim((string)$query) === '') return false;
        return $l ? mysqli_query($l, $query, MYSQLI_USE_RESULT) : false;
    }

    function mysql_db_query($database, $query, $link = null)
    {
        return mysql_select_db($database, $link) ? mysql_query($query, $link) : false;
    }

    function mysql_fetch_array($result, $result_type = MYSQL_BOTH)
    {
        if (!($result instanceof mysqli_result)) return false;
        $r = mysqli_fetch_array($result, $result_type);
        return $r === null ? false : $r;
    }

    function mysql_fetch_assoc($result)
    {
        if (!($result instanceof mysqli_result)) return false;
        $r = mysqli_fetch_assoc($result);
        return $r === null ? false : $r;
    }

    function mysql_fetch_row($result)
    {
        if (!($result instanceof mysqli_result)) return false;
        $r = mysqli_fetch_row($result);
        return $r === null ? false : $r;
    }

    function mysql_fetch_object($result, $class_name = 'stdClass', $params = array())
    {
        if (!($result instanceof mysqli_result)) return false;
        $r = $params ? mysqli_fetch_object($result, $class_name, $params) : mysqli_fetch_object($result, $class_name);
        return $r === null ? false : $r;
    }

    function mysql_num_rows($result)
    {
        return ($result instanceof mysqli_result) ? mysqli_num_rows($result) : false;
    }

    function mysql_num_fields($result)
    {
        return ($result instanceof mysqli_result) ? mysqli_num_fields($result) : false;
    }

    function mysql_result($result, $row, $field = 0)
    {
        if (!($result instanceof mysqli_result)) return false;
        if ($row < 0 || $row >= mysqli_num_rows($result) || !mysqli_data_seek($result, $row)) {
            __mysql_compat_warn("mysql_result(): Unable to jump to row $row");
            return false;
        }
        $fila = mysqli_fetch_array($result, MYSQLI_BOTH);
        if (!$fila) return false;
        if (is_int($field) || ctype_digit((string) $field)) {
            return array_key_exists((int) $field, $fila) ? $fila[(int) $field] : false;
        }
        if (array_key_exists($field, $fila)) return $fila[$field];
        if (strpos($field, '.') !== false) {             // tabla.campo
            $partes = explode('.', $field);
            $campo = end($partes);
            if (array_key_exists($campo, $fila)) return $fila[$campo];
        }
        __mysql_compat_warn("mysql_result(): $field not found in MySQL result index");
        return false;
    }

    function mysql_data_seek($result, $row_number)
    {
        return ($result instanceof mysqli_result) ? mysqli_data_seek($result, $row_number) : false;
    }

    function mysql_free_result($result)
    {
        if ($result instanceof mysqli_result) { mysqli_free_result($result); return true; }
        return false;
    }

    function mysql_insert_id($link = null)
    {
        $l = __mysql_compat_link($link);
        return $l ? mysqli_insert_id($l) : false;
    }

    function mysql_affected_rows($link = null)
    {
        $l = __mysql_compat_link($link);
        return $l ? mysqli_affected_rows($l) : -1;
    }

    // Sin enlace, la extension original devolvia el error de la ultima conexion
    // abierta (no la de la ultima consulta), y con "or die(mysql_error())" el
    // mensaje solia salir vacio. Aqui se usa el enlace de la ultima consulta.
    function mysql_error($link = null)
    {
        if ($link === null && !empty($GLOBALS['__mysql_compat_empty_query'])) return 'Query was empty';
        $l = ($link === null && !empty($GLOBALS['__mysql_compat_last_query_link'])) ? $GLOBALS['__mysql_compat_last_query_link'] : __mysql_compat_link($link);
        if ($l) return mysqli_error($l);
        return isset($GLOBALS['__mysql_compat_connect_error']) ? (string) $GLOBALS['__mysql_compat_connect_error'] : '';
    }

    function mysql_errno($link = null)
    {
        if ($link === null && !empty($GLOBALS['__mysql_compat_empty_query'])) return 1065;
        $l = ($link === null && !empty($GLOBALS['__mysql_compat_last_query_link'])) ? $GLOBALS['__mysql_compat_last_query_link'] : __mysql_compat_link($link);
        if ($l) return mysqli_errno($l);
        return isset($GLOBALS['__mysql_compat_connect_errno']) ? (int) $GLOBALS['__mysql_compat_connect_errno'] : 0;
    }

    function mysql_real_escape_string($unescaped_string, $link = null)
    {
        $l = __mysql_compat_link($link);
        if (!$l) return addslashes((string) $unescaped_string);
        return mysqli_real_escape_string($l, (string) $unescaped_string);
    }

    function mysql_escape_string($unescaped_string)
    {
        return mysql_real_escape_string($unescaped_string);
    }

    function mysql_close($link = null)
    {
        $l = __mysql_compat_link($link);
        if (!$l) return false;
        foreach ($GLOBALS['__mysql_compat_links'] as $k => $v) {
            if ($v === $l) unset($GLOBALS['__mysql_compat_links'][$k]);
        }
        if ($GLOBALS['__mysql_compat_last_link'] === $l) $GLOBALS['__mysql_compat_last_link'] = null;
        return mysqli_close($l);
    }

    function mysql_set_charset($charset, $link = null)
    {
        $l = __mysql_compat_link($link);
        return $l ? mysqli_set_charset($l, $charset) : false;
    }

    function mysql_client_encoding($link = null)
    {
        $l = __mysql_compat_link($link);
        return $l ? mysqli_character_set_name($l) : false;
    }

    function mysql_ping($link = null)
    {
        $l = __mysql_compat_link($link);
        return $l ? mysqli_ping($l) : false;
    }

    function mysql_get_server_info($link = null)
    {
        $l = __mysql_compat_link($link);
        return $l ? mysqli_get_server_info($l) : false;
    }

    function mysql_field_name($result, $field_offset)
    {
        if (!($result instanceof mysqli_result)) return false;
        $f = mysqli_fetch_field_direct($result, $field_offset);
        return $f ? $f->name : false;
    }

    function mysql_field_table($result, $field_offset)
    {
        if (!($result instanceof mysqli_result)) return false;
        $f = mysqli_fetch_field_direct($result, $field_offset);
        return $f ? $f->table : false;
    }

    function mysql_field_len($result, $field_offset)
    {
        if (!($result instanceof mysqli_result)) return false;
        $f = mysqli_fetch_field_direct($result, $field_offset);
        return $f ? $f->length : false;
    }

    function mysql_fetch_field($result, $field_offset = null)
    {
        if (!($result instanceof mysqli_result)) return false;
        if ($field_offset !== null) mysqli_field_seek($result, $field_offset);
        return mysqli_fetch_field($result);
    }

    function mysql_list_tables($database, $link = null)
    {
        $l = __mysql_compat_link($link);
        return $l ? mysqli_query($l, 'SHOW TABLES FROM `' . str_replace('`', '``', $database) . '`') : false;
    }

    function mysql_tablename($result, $i)
    {
        return mysql_result($result, $i, 0);
    }
}

if (!function_exists('each')) {
    // Eliminada en PHP 8.0
    function each(&$array)
    {
        if (!is_array($array) && !is_object($array)) return false;
        $key = key($array);
        if ($key === null) return false;
        $value = current($array);
        next($array);
        return array(1 => $value, 'value' => $value, 0 => $key, 'key' => $key);
    }
}

if (!function_exists('get_magic_quotes_gpc')) {
    // Eliminada en PHP 8.0. Las magic quotes no existen desde PHP 5.4: siempre false.
    function get_magic_quotes_gpc()
    {
        return false;
    }
}

// ereg_replace() y split() (eliminadas en PHP 7.0), usadas en contabilidad/*/includes/func_str.php.
// Se traducen a PCRE sin /u: trabajan byte a byte igual que ereg con cadenas ISO-8859-1.
if (!function_exists('__ereg_a_pcre')) {
    function __ereg_a_pcre($patron)
    {
        return '~' . str_replace('~', '\~', (string)$patron) . '~';
    }
}
if (!function_exists('ereg_replace')) {
    function ereg_replace($patron, $reemplazo, $cadena)
    {
        return preg_replace(__ereg_a_pcre($patron), (string)$reemplazo, (string)$cadena);
    }
}
if (!function_exists('split')) {
    function split($patron, $cadena, $limite = -1)
    {
        return preg_split(__ereg_a_pcre($patron), (string)$cadena, $limite === null ? -1 : $limite);
    }
}
