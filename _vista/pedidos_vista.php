
<?php
/** Archivo generado automaticamente por la clase generadorMVC.php
* Fecha de creacion: 22-August-2013
**/
require_once "_vista/_vista_class.php";
        
class PedidosVista extends Vista {
    // TODO
    private $htmlFile = "pedidos_captura_usuario.html";
//<<<HTML HTML;
        
    public function getHtml() {
        $html = file_get_contents("html/" . $this->htmlFile);
        return $html;
    }
        
}
        