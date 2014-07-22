<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '_vista/_vista_class.php';

class Error404 extends Vista {
  
    private $html = <<<HTML
            
        <!-- Begin Main -->
            <div id="main" class="shell">
                <!-- Begin Content -->
                    <div id="content">
                        <div class="post">
                            <h1>Lo sentimos. No ha sido posible encontrar la página solicitada.</h1>
                            <img src="images/404-error-sign.jpg" alt="404" width="260">
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
        //$slider = new PromocionesVista();
        //$html = $slider->getHtml();
        //$html .= $this->html;
        //$this->html = $html;
        return $this->html;
    }
}
?>