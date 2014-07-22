<?php
require_once "_addresses.php";
//if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
//if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
//if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address
/** Archivo generado automaticamente por la clase generadorMVC.php
* Fecha de creacion: 06-August-2013
**/
require_once BASE_URI . "_controlador/_controlador_class.php";

class PromocionesCtrl extends Controlador {
    // TODO 
    static public function promocionesDelMes() {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
        $conn = new MySQL('gcdbmaster', 'w');
        $query = "SELECT *
                    FROM promociones
                    WHERE vigencia_del <= '".date("n/j/Y")."'
                    AND vigencia_al >= '".date("n/j/Y")."';";
        //require_once '_modelo/promociones_modelo.php';
        $promocionesDelMes = $conn->selectToObject($query, 'Promociones');
        $conn->close();
        return $promocionesDelMes;
    }
    
    static public function sliderRecursos() {
        $promociones = array();
        $i=0;
        require_once BASE_URI . "_controlador/promociones_controlador.php";
        $ctrl = new PromocionesCtrl();
        $promocionesDelMes = $ctrl->promocionesDelMes();
        foreach ($promocionesDelMes as $promocion) {
            require_once BASE_URI . "_controlador/productos_controlador.php";
            $productos = ProductosCtrl::buscarProducto('22606', 'id_producto');
            foreach ($productos as $producto) {
                $i++;
                $promociones[$i] = array( 
                    'id_producto' => $producto->getId_Producto(),
                    'imagen' => $producto->getImagen(),
                    'descripcion' => $producto->getDescripcion(),
                    'unidad' => $producto->getUnidad(),
                    'descuento' => $promocion->getDescuento(),
                    'precio' => $producto->getPrecio() );
            }
        }
        return $promociones;
    }
    
    /**
     * Busca en la tabla la promoción vigente del producto solicitado.
     * @param String $id_producto
     * @return float Regresa el porcentaje de descuento.
     */
    static public function buscarPromocionDeProducto($id_producto) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
        $conn = new MySQL('gcdbmaster', 'w');
        $query = "SELECT *
                    FROM promociones
                    WHERE id_producto = '$id_producto'
                    AND vigencia_del <= '".date("n/j/Y")."'
                    AND vigencia_al >= '".date("n/j/Y")."';";
        $promocion = $conn->selectToObject($query, 'Promociones');
//        echo $query;
        $conn->close();
        if (count($promocion) > 0) {
            return $promocion[0]->getDescuento();
        }
        else {
            return 0;
        }
    }
    
    /**
     * 
     * @return array Array de strings de id_producto de los
     * productos en promocion.
     */
    static public function buscarProductosEnPromocion() {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
        $conn = new MySQL('gcdbmaster', 'w');
        $query = "SELECT id_producto
                    FROM promociones
                    WHERE vigencia_del <= '".date("n/j/Y")."'
                    AND vigencia_al >= '".date("n/j/Y")."';";
        $productos = $conn->selectToObject($query, 'Promociones');
        $conn->close();
        $arrayProductos = array();
        foreach ($productos as $producto) {
            array_push($arrayProductos, $producto);
        }
        return $arrayProductos;
    }
}
