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
        $id_producto = "22606";
        require_once 'librerias/sqlserver_class.php';
        $conn = new SQLServer("gcmaster", "w");
        $query = "SELECT * FROM productos WHERE id_producto='$id_producto'";
        $productos = $conn->selectObject($query, "Productos");
        if (!$productos) {
            echo "Producto no encontrado";
        } else {
            foreach ($productos as $producto) {
                $p22606 = $producto;
            }
            $nuevoProducto = $p22606;
            $p22606->setDescripcion('bla bla bla');
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
        $conn->close();
        
        require_once 'librerias/xml_class.php';
        $xmlClass = new Xml($nuevoProducto);
        $xmlClass->getFile('file');
        
//        $modeloFile = fopen("file.xml", "w");
//        fwrite($modeloFile, $xmlFile);
//        fclose($modeloFile);
        //Xml::cargarXML('file.xml', 'Productos');
        
        echo $xmlClass->esInstanciaDe($xmlClass);
        $objeto = $xmlClass->toObject($xmlClass, 'productos');
        print_r($objeto->toArray());
        ?>
    </body>
</html>
