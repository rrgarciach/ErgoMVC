<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        /*-------------------------
        $id_producto = "22606";
        require_once 'librerias/sqlserver_class.php';
        $conn = new SQLServer("gcmaster", "w");
        $query = "SELECT * FROM productos WHERE id_producto='$id_producto'";
        $productos = $conn->selectToObject($query, "Productos");
        if (!$productos) {
            echo "Producto no encontrado";
        } else {
            foreach ($productos as $producto) {
                $p22606 = $producto;
            }
            $nuevoProducto = $p22606;
            $p22606->setDescripcion('Pinza pesada de electricista 8", Pretul');
            print_r( $p22606->toArray() );
            echo "<h1>".$p22606->getId_Producto()."</h1>";

            $result = $conn->updateObject($p22606, "Productos");
            if (!$result) {
                echo "error al modificar registro";
            } else {
                echo "registro modificado con exito";
            }
        }
        
        $nuevoProducto->setId_Producto('77777');
        $nuevoProducto->setDescripcion('77777');
        
        $result = $conn->insertObject($nuevoProducto, "Productos");
        //echo $result;
        if (!$result) {
            echo "error al insertar registro";
            
        } else {
                echo "registro insertado con exito";
        }
        
//        $result = $conn->deleteObject($nuevoProducto, "Productos");
//        if (!$result) {
//            echo "error al eliminar registro";
//            
//        } else {
//                echo "registro eliminado con exito";
//        }
//        
//        require_once '_controlador/productos_controlador.php';
//        $productosDesc = new ProductosCtrl();
//        $productoEncontrado = $productosDesc->buscarProductosDescripcion('bla');
//        echo $productoEncontrado[0]->getDescripcion();
        
        require_once 'librerias/xml_class.php';
        $xmlClass = new Xml($nuevoProducto);
        $xmlClass->saveFile('file');
//        $modeloFile = fopen("file.xml", "w");
//        fwrite($modeloFile, $xmlFile);
//        fclose($modeloFile);
        //Xml::cargarXML('file.xml', 'Productos');
        
        echo "Es instancia de:".$xmlClass->getRoot($xmlClass);
        //$objeto = $xmlClass->xmlToObject($xmlClass, 'productos');
        $archivoXML = 'file2.xml';
        if (!file_exists($archivoXML)) return false;
        $objeto = $xmlClass->fileToObject($archivoXML, 'productos');
        echo '<h1>array</h1>';
        print_r($objeto->toArray());
        
        echo "<h2>select object</h2>";
        if (! $encontrados = $conn->searchObject($objeto, 'productos')) echo "<h3>No encontrado.</h3>";
        foreach ($encontrados as $objeto) {
            print_r($objeto->toArray());
        }
        echo "<h2>mysql</h2>";
        $producto = "22606";
        require_once 'librerias/mysql_class.php';
        $conn = new MySQL("gcadmin", "w");
        $query = "SELECT * FROM catalogo WHERE id_codigo='$producto'";
        $productos = $conn->selectToObject($query, "productos");
        foreach ($productos as $value) {
            print_r($value->toArray());
        }
        echo "<h2>str_replace</h2>";
        $input = "333, OR id!=0";
        $to = array(' ', '!', '=', ',');
        $for = "";
        $str = "SELECT * FROM table WHERE id=$input";
        echo str_replace($to, $for, $str);
        -------------------*/
        require_once 'librerias/sqlserver_class.php';
        $conn = new SQLServer("gcmaster", "w");
        echo "<h2>Add XML</h2>";
        require_once 'librerias/xml_class.php';
        $xmlProducto = new XML();
        $prod = $xmlProducto->fileToObject('file_obj.xml', 'testxml');
        //$prod->fileToObject('file_obj.xml', 'xml');
        print_r($prod->toArray());
        //if ($conn->insertObject($prod, 'testxml')) echo '<p>Insertado con exito.</p>';
        echo "<p>insertObject:</p>";
        $sql = $conn->insertObject($prod, 'testxml');
        echo "<p>$sql</p>";
        
        $conn->close();
        ?>
    </body>
</html>
