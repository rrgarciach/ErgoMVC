<?php
if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address

//require_once BASE_URI."librerias/sqlserver_class.php";
require_once BASE_URI . "librerias/mysql_class.php";
//$conn = new SQLServer('gcmaster', 'r');
$conn = new MySQL('gcdbmaster', 'r');
//$connection = mysql_connect('localhost', 'root', '12345');
//$db = mysql_select_db('userdata', $connection);
$term = strip_tags(substr($_POST['searchit'], 0, 100));
$tipo = strip_tags(substr($_POST['tipo'], 0, 100));
//$term = strip_tags(substr($_GET['searchit'], 0, 100));
//$term = mysql_escape_string($term); // Attack Prevention
$term = $conn->filterQueryInput($term);
if ($term == "")
    echo json_encode(array("mensaje" => ""));
//echo 'Enter <span id="IL_AD4" class="IL_AD">Something</span> to search';
else {
    if ($tipo == "=") {
        $query = "select * from clientes where id_cliente = '{$term}'";
    }
    else if ($tipo == "like") {
        $query = "select * from clientes where id_cliente like '{$term}%'";
    }
    $clientes = $conn->selectToObject($query, 'Clientes');
    $conn->close();
    $string = '';

    if (count($clientes) > 0) {
        foreach ($clientes as $cliente) {
            require_once BASE_URI.'librerias/xml_class.php';
            $xml = new Xml($cliente);
            $string .= htmlspecialchars_decode((string) $xml->getXML());
        }
    } else {
//        $string = json_encode(array("mensaje" => "No se encontraron resultados."));
    $string = "null";
    }

    echo $string;
}
?>