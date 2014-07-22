<?php
if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address
/** Archivo generado automaticamente por la clase generadorMVC.php
 * Fecha de creacion: 06-August-2013
 * */
require_once BASE_URI."/_vista/_vista_class.php";

class ProductosVista extends Vista {

// TODO 
    public function getHtml() {
        
    }

    public function htmlRenglonProducto($id_producto) {
        require_once BASE_URI."_controlador/productos_controlador.php";
        //$query = "SELECT id_producto, descripcion, caja, precio FROM productos WHERE id_producto='$id_producto'";
        $productos = ProductosCtrl::buscarProducto($id_producto, 'id_producto');
        $html = "";
        foreach ($productos as $producto) {
            $imagen = BASE_URI."/images/productos/sencillas/" . $producto->getId_Producto() . "_g.jpg";
            if (!file_exists($imagen))
//                $imagen = "imagen_no_disponible.jpg";
                $imagen = BASE_URI."/images/productos/sencillas/imagen_no_disponible.jpg";
            $html .= "<tr>
                        <td><img src=\"$imagen\" height=\"50px\" /></td>
                        <td>" . $producto->getId_Producto() . "</td>
                        <td>" . $producto->getDescripcion() . "</td>
                        <td>" . $producto->getCaja() . "</td>
                        <td>" . $producto->getPrecio() . "</td>
                    </tr>";
        }
        return $html;
    }

    public function htmlTablaProductos() {
        require_once BASE_URI."/_controlador/productos_controlador.php";
        if (!isset($_GET['p']))
            return false;
        $input = $_GET['p'];
        $producto = $this->htmlRenglonProducto($_GET['p']);
        $html = "
                <table class=\"ordertable\">
                    <tr>
                        <th>imagen</th>
                        <th>codigo</th>
                        <th>descripcion</th>
                        <th>caja</th>
                        <th>precio</th>
                    </tr>
                    $producto
                </table>
                </div>
                ";
        $html .= "</div>";
        return $html;
    }

    public function pcMosaicoCodigo($id_producto, $cliente = "") {
        require_once BASE_URI."/_controlador/productos_controlador.php";
        $productos = ProductosCtrl::buscarProductos($id_producto);
        $html = $this->pcMosaicos($productos, $cliente);
        return $html;
    }

    public function pcMosaicoDescripcion($str, $cliente = "") {
        require_once BASE_URI."/_controlador/productos_controlador.php";
        $productos = ProductosCtrl::buscarProductos($str, 'descripcion', 'LIKE');
        $html = $this->pcMosaicos($productos, $cliente);
        return $html;
    }

    public function pcMosaicos($productos, $cliente = "999") {
        $encontrados = count($productos);
        $html = "";
//        $html .= "<div class=\"ui-widget\"><form method=\"get\">
//                    <label for=\"tags\">Tags: </label>
//                    <input id=\"tags\" name=\"tags\" /><input type=\"submit\" value=\"enviar\" /></form>
//                  </div>";
        $html .= "<span>$encontrados productos encontrados:</span><div id=\"products\">";
        $i = 1;
        foreach ($productos as $producto) {
            $file = BASE_URI."images/productos/sencillas/" . $producto->getId_Producto() . "_g.jpg";
            $imagen = BASE_URL."images/productos/sencillas/" . $producto->getId_Producto() . "_g.jpg";
            if (!file_exists($file))
                $imagen = BASE_URL."images/productos/sencillas/imagen_no_disponible.jpg";
            // Busca los valores de descuento del cliente correspondiente y verifica si aplica para promociones:
            $precio = $producto->getPrecio();
            if ($cliente != "") {
                require_once BASE_URI."/_controlador/clientes_controlador.php";
                $descuento = ClientesCtrl::precioCliente($cliente);
                if ($descuento)
                    $precio -= $precio * ($descuento/100);
            }
            $html .= "<div class=\"product\" id=\"" . $producto->getId_Producto() . "\">
                        <a href=\"#\" title=\"Product Link\"><img src=\"$imagen\" alt=\"Product Image\" width=\"165px\" height=\"125px\" ></a>
                        <div class=\"price\">
                            <div class=\"inner\">
                                <strong><span>$</span>" . substr(number_format($precio, 2, '.', ','), 0, -3) . "<sup>" . substr(number_format($producto->getPrecio(), 2, '.', ','), -3, 3) . "</sup></strong>
                                <span class=\"title\">Precio + IVA</span>
                            </div>
                        </div>
                        <div class=\"info\">
                            <p>" . utf8_encode($producto->getDescripcion()) . "</p>
                            <p class=\"number\">Código: " . $producto->getId_Producto() . "</p>
                        </div>
                    </div>";
            if ($i % 4 == 0)
                $html .= "<div class=\"cl\">&nbsp;</div>";
            $i++;
        }
        $html .= "</div>";
        return $html;
    }
    
    public static function urlImagen($id_producto) {
        require_once BASE_URI."/_controlador/productos_controlador.php";
        $file = BASE_URI."images/productos/sencillas/" . $id_producto . "_g.jpg";
        $tagImagen = BASE_URL . "images/productos/sencillas/" . $id_producto . "_g.jpg";
        if (!file_exists($file))
            $tagImagen = BASE_URL."images/productos/sencillas/imagen_no_disponible.jpg";
        return $tagImagen;
    }

}

// Funciones jQuery:
extract($_REQUEST);
if(!isset($f)) $f='';

switch ($f) {
    case "pcMosaicoDescripcion":
        $vista = new ProductosVista();
        echo $vista->pcMosaicoDescripcion($searchit, $cliente);
        break;
    case "pcRenglon":
        $vista = new ProductosVista();
        echo $vista->pcMosaicoCodigo($searchit, $cliente);
        break;
    case "urlImagen":
        $urlImagen = ProductosVista::urlImagen($id_producto);
        echo $urlImagen;
        break;

    default:
        break;
}
?>