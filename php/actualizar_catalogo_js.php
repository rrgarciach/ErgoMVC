<?php
if (!defined('BASE')) define ('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
if (!defined('BASE_URI')) define ('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
if (!defined('BASE_URL')) define ('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address

require_once BASE_URI . "librerias/mysql_class.php";
$conn = new MySQL('gcdbmaster', 'r');
$productos = $conn->selectToObject("SELECT id_producto, clave, descripcion FROM productos", 'productos');
$str = "";
//$str .= "$(function() {
//    $( '#input-buscar-productos-linea' ).autocomplete({ minLength: 2 }, {
//      source: catalogo
//    });
//  });";
$str .= "var catalogo = [\n";
foreach ($productos as $producto) {
    $str.= "'" . $producto->getId_Producto() . " - " . $producto->getClave() . " - " . str_replace("'", "\'", $producto->getDescripcion()) . "',\n";
}
$str = substr($str, 0, -2);
$str .= "\n];";
//$str = utf8_encode($str);
$file = fopen(BASE_URI . 'js/catalogo.js', 'w');
fwrite($file, utf8_encode($str));
echo "<h1>Done</h1>";
?>
