<?php
if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address

require_once BASE_URI . "librerias/mysql_class.php";
//$conn = new SQLServer('gcmaster', 'r');
$conn = new MySQL('gcdbmaster', 'r');
//$term = strip_tags(substr($_POST['searchit'], 0, 100));
//$tipo = strip_tags(substr($_POST['tipo'], 0, 100));
$term = '22'; $tipo = "like";
$term = $conn->filterQueryInput($term);
if ($term == "")
    echo json_encode(array("mensaje" => ""));
//echo 'Enter <span id="IL_AD4" class="IL_AD">Something</span> to search';
else {
    if ($tipo == "=") {
        $query = "select id_producto, descripcion from productos where id_producto = '{$term}'";
    }
    else if ($tipo == "like") {
        $query = "select id_producto, descripcion from productos where id_producto like '{$term}%'";
    }
    $productos = $conn->selectToObject($query, 'Productos');
    $conn->close();
    $string = '<productos>';

    if (count($productos) > 0) {
        foreach ($productos as $producto) {
            require_once 'librerias/xml_class.php';
            $xml = new Xml($producto);
            $string .= htmlspecialchars_decode((string) $xml->getXML());
        }
        $string .= '</productos>';
    } else {
//        $string = json_encode(array("mensaje" => "No se encontraron resultados."));
    $string = "null";
    }

    echo $string;
}
?>