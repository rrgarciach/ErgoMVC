<?php
/** Archivo generado automaticamente por la clase generadorMVC.php
* Fecha de creacion: 06-August-2013
**/
require_once "_vista/_vista_class.php";

class PromocionesVista extends Vista {
    // TODO 
    //private $html;
    private $htmlPromociones = "";
    private $html = "";
    
    function __construct() {
        $this->slider();
        $this->anidarPromociones($this->htmlPromociones);
    }

    public function getHtml() {
        return $this->html;
    }
    
    public function slider() {
        //TODO 
        require_once "_controlador/promociones_controlador.php";
        $promos = new PromocionesCtrl();
        $promociones = $promos->sliderRecursos();
        foreach ($promociones as $promocion) {
            //$id_producto = $promocione['id_producto'];
            $descripcion = $promocion['descripcion'];
            $imagen = $promocion['imagen'];
            $unidad = $promocion['unidad'];
            $descuento = $promocion['descuento'] * 100;
            $precio = $promocion['precio'];
            $precioNeto = $precio - ($precio * $descuento/100);
            $this->htmlPromociones .= <<<HTML
                <li>
                    <img src="images/slide-img0.jpg" alt="Slide Image">
                    <div class="slide-entry">
                        <img src="images/products/$imagen.jpg" alt="$imagen"><h2>$descripcion</h2>
                        <!--<h2>$ $precioNeto MXN / $unidad</h2>-->
                        <h4>$descuento% de descuento</h4>
                        <a href="#" class="buttonMain" title="5306"><span>AGREGAR</span></a>
                    </div>
                </li>
HTML;
            }
        }

         private function anidarPromociones($htmlPromociones) {
             $this->html = <<<HTML
                     
        <!-- Begin Slider -->
        <div id="slider">
            <!-- Begin Shell -->
            <div class="shell">
                <ul class="slider-items">
                    <li>
                        <img src="images/slide-img1.jpg" alt="Slide Image">
                        <div class="slide-entry">
                            <a href="https://www.facebook.com/pages/Distribuidora-GC/116334158538331" target="_blank" class="buttonMain" title="VISITANOS"><span>¡VISITANOS!</span></a>
                        </div>
                    </li>
                        $htmlPromociones
                </ul>
                <div class="cl">&nbsp;</div>
                <div class="slider-nav">
                </div>
            </div>
            <!-- End Shell -->
        </div>
        <!-- End Slider -->
        
HTML;
         }
}

?>