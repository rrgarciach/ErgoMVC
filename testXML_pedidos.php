<?php
require_once 'librerias/sqlserver_class.php';
$conn = new SQLServer("gcmaster", "w");
echo "<h2>Add XML</h2>";
require_once 'librerias/xml_class.php';

$objeto = $conn->selectToObject("SELECT * FROM productos WHERE id_producto='22606'", 'productos');
$xmlProducto = new XML( $objeto[0] );
$xmlProducto->saveToFile('file_obj.xml', '');
//$prod->fileToObject('file_obj.xml', 'xml');
//print_r($prod->toArray());
echo $xmlProducto->getXML();
//if ($conn->insertObject($prod, 'testxml')) echo '<p>Insertado con exito.</p>';
echo "<p>insertObject:</p>";
//$sql = $conn->insertObject($prod, 'testxml');


$xmlProd2 = new XML( XML::fileToObject('file_obj.xml', 'productos') );
//$xmlProd2->loadFromFile('file_obj2.xml');
$xmlProd2->saveToFile('file_obj3.xml');

$objetito = XML::fileToObject('file_obj.xml', 'productos');
print_r($objetito->toArray());

$conn->close();
