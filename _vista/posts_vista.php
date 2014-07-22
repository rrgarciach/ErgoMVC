<?php
/** Archivo generado automaticamente por la clase generadorMVC.php
* Fecha de creacion: 06-August-2013
**/
require_once '_vista/_vista_class.php';

class PostsVista extends Vista {
  
    private $html = <<<HTML
            
        <!-- Begin Main -->
            <div id="main" class="shell">
                <!-- Begin Content -->
                    <div id="content">
                        <div class="post">
                            <h2>Generador eléctrico a gasolina 5,500 W</h2>
                            <img src="images/posts/generador.jpg" alt="Post Image">
                            <p>Motor de 4 tiempos</p>
                            <p>Diseño compacto para fácil transporación con redas y manubrio abatible</p>
                            <p>Protege los aparatos eléctricos ya que cumple con el voltaje y la frecencia indicados, incluso al operarlo con carga nominal</p>
                            <p>El generador más silencioso en su categoría</p>
                            <p>Contamos con Centros de Servicio y REfacciones</p>
                            <p>Ciclo de trabajo: Trabajo continuo a potencia nominal / 30 min. de descanso x tanque consumido.<!--<a href="#" class="more" title="Seguir leyendo...">Seguir leyendo...</a>--></p>
                            <div class="cl">&nbsp;</div>
                        </div>
                    </div>
                <!-- End Content -->
            <div class="cl">&nbsp;</div>
            </div>
        <!-- End Main -->
HTML;
    
    public function getHtml () {
        require_once "_vista/promociones_vista.php";
        $slider = new PromocionesVista();
        $html = $slider->getHtml();
        $html .= $this->html;
        $this->html = $html;
        return $this->html;
    }
}

?>