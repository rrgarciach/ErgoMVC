<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "_vista/page.class.php";
$pagina = new page('Distribuidora GC');
$pagina->doctype('html','strict');
$pagina->link('css/style.css');
$pagina->link('js/jquery-1.6.2.min.js');
//$pagina->link('http://code.jquery.com/jquery-1.9.1.js');
$pagina->link('http://code.jquery.com/ui/1.10.3/jquery-ui.js');
$pagina->link('js/cufon-yui.js');
$pagina->link('js/Myriad_Pro_700.font.js');
$pagina->link('js/jquery.jcarousel.min.js');
$pagina->link('js/functions.js');
$pagina->link('facebox/facebox.css');
$pagina->link('facebox/facebox.js');
//$pagina->link("<script language=\"javascript\">\n\n$(document).ready(function() {\n$.facebox.settings.opacity = 0.5;\n$('a[rel*=facebox]').facebox();\n/*$.facebox('This will display after the page has finished loading');*/\n\n$.get('login.php?user=".isset($_POST['user'])."&pass=".isset($_POST['pass'])."', function(html) {\n$.facebox(html);\n});\n\n});\n</script>"); //Opens facebox at page's load.
$pagina->jquery("jQuery(document).ready(function($) {\n$('a[rel*=facebox]').facebox()\n})");

$pagina->link('http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');
$pagina->link('js/catalogo.js');

$pagina->setlayout();

require_once "_vista/productos_vista.php";
$producto = new ProductosVista();
//$html = $producto->htmlTablaProductos();
//$html = $producto->pcMosaicoCodigo('17438');
if (isset($_GET['tags'])) { $codigo = substr($_GET['tags'], 0, 6); }
else { $codigo = '---';}
$html = $producto->pcMosaicoCodigo($codigo);
//$html = $producto->pcMosaicoDescripcion($descripcion);
$html = $html;

echo $pagina->display($html);

?>