<?php

include('_includes/config.php');

//echo $idparroquia;

$valores = getValue("SELECT titulo, dominio FROM configuracion_base WHERE parroquia = '$idparroquia'",0);

$urlWeb = $valores['dominio'];
$nombreParroquia = $valores['titulo'];

$hoy = date('Y-m-d G:i:s');

$ultimaNoticia = getValue("SELECT fecha FROM noticias WHERE parroquia = '$idparroquia' AND fecha <='$hoy' AND activar = 1 ORDER BY fecha DESC LIMIT 1",1);
$ultimaNoticia = gmdate(DATE_RFC822, strtotime($ultimaNoticia));

$xml = '<?xml version="1.0" encoding="UTF-8"?><rss version="2.0"
xmlns:content="http://purl.org/rss/1.0/modules/content/"
xmlns:wfw="http://wellformedweb.org/CommentAPI/"
xmlns:dc="http://purl.org/dc/elements/1.1/"
xmlns:atom="http://www.w3.org/2005/Atom"
xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
xmlns:slash="http://purl.org/rss/1.0/modules/slash/">

<channel>
<title>'.$nombreParroquia.'</title>
<atom:link href="'.$urlWeb.'feed/" rel="self" type="application/rss+xml" />
<link>'.$urlWeb.'</link>
<description>'.$nombreParroquia.'</description>
<lastBuildDate>'.$ultimaNoticia.' </lastBuildDate>
<language>es</language>
<sy:updatePeriod>daily</sy:updatePeriod>
<sy:updateFrequency>1</sy:updateFrequency>

<image>
<url>'.$urlWeb.'images/logo.png</url>
<title>'.$nombreParroquia.'</title>
<link>'.$urlWeb.'</link>
<width>32</width>
<height>32</height>
</image> ';

$sql = "SELECT id, titular, noticia, categoria, fecha FROM noticias WHERE activar = 1 AND fecha <= '$hoy' AND parroquia = '$idparroquia' ORDER BY fecha DESC LIMIT 25";
$rs = mysql_query($sql,$conex);

while($rw = mysql_fetch_assoc($rs)){

    $linkNoticia = $urlWeb.limpiarcadena($rw['titular'],'archivo')."-".$rw['id'].".html";

    $titularNoticia = utf8_encode($rw['titular']);
    $fechaNoticia = gmdate(DATE_RFC822, strtotime($rw['fecha']));

    if($rw['categoria'] > 0){
        $categoria = getValue("SELECT categoria FROM noticias_categorias WHERE id = '".$rw['categoria']."'",1);
    }
    else $categoria = "";

    $xml .= '<item>
    <title>'.$titularNoticia.'</title>
    <link>'.$linkNoticia.'</link>
    
    <pubDate>'.$fechaNoticia.' </pubDate>
            <category><![CDATA['.$categoria.']]></category>
            <guid isPermaLink="false">'.$linkNoticia.'</guid>
    
            <description><![CDATA['.$titularNoticia.']]></description>
            <content:encoded><![CDATA['.utf8_encode($rw['noticia']).']]></content:encoded>
        </item>';
}


$xml .= '</channel>
</rss>';

header("Content-type: text/xml");
echo $xml;

?>