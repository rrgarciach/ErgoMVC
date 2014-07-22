<?php
if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address

require_once BASE_URI . "_vista/page.class.php";
$pagina = new page('Distribuidora GC');
$pagina->doctype('html','strict');
$pagina->link('css/style.css');
$pagina->link('css/jquery-ui-1.10.3.distribuidoragc-theme.css');
$pagina->link('css/jquery-ui-1.10.3.distribuidoragc-theme.min.css');
$pagina->link('js/jquery-1.9.1.js');
$pagina->link('js/jquery-ui-1.10.3.custom.js');
//$pagina->link('js/jquery-1.6.2.min.js');
//$pagina->link('http://code.jquery.com/jquery-1.9.1.js');
//$pagina->link('http://code.jquery.com/ui/1.10.3/jquery-ui.js');
$pagina->link('js/cufon-yui.js');
$pagina->link('js/Myriad_Pro_700.font.js');
//$pagina->link('js/jquery-stepy/jquery.stepy.js');
//$pagina->link('js/jquery-stepy/jquery.stepy.min.js');
//$pagina->link('js/jquery-stepy/jquery.validate.min.js');
//$pagina->link('css/jquery.stepy.css');
$pagina->link('js/jwizard/jquery.jWizard.js');
$pagina->link('js/jwizard/jquery.jWizard.css');
$pagina->link('js/jquery.maskedinput.js');

require_once BASE_URI . "_modelo/pedidos_modelo.php";
if (!isset($_SESSION)) session_start();
/*if (!isset($_SESSION['pedidoXML']))  {
    $pagina->link('<script> var pedidoXML = "' . $_SESSION['pedidoXML'] .'"; </script>');
} else {
    $pagina->link('<script> var pedidoXML = \'<?xml version="1.0" encoding="utf-8"?>\'; </script>');
}*/
//        $_SESSION['pedido'] = new Pedidos();
//        $_SESSION['pedido']->setId_vendedor('rgarcia');
//echo json_encode($_SESSION['pedido']->toArray());
//        echo '$.parseJSON(' . json_encode($_SESSION['pedido']->toArray()) .');';
    //var pedidoJSON = $.parseJSON(\'' . json_encode($_SESSION['pedido']->toArray()) .'\');

$pagina->link('js/pedidos_captura.js');
//$pagina->link('js/table-sort/jquery.tablesorter.js');
//$pagina->link('js/table-sort/jquery-latest.js');

//$pagina->link('js/jqgrid/css/ui.jqgrid.css');
//$pagina->link('js/jqgrid/grid.locale-es.js');
//$pagina->link('js/jqgrid/jquery.jqGrid.min.js');
//$pagina->link('js/jqgrid/jquery.jqGrid.src.js');
//
//$pagina->link('js/catalogo.js');
$pagina->link('css/jquery.checkbox.css');
$pagina->link('js/jquery.checkbox.js');
$pagina->link('<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDx5hj10HChnrmakzQfaC0-dc_djuF-xTw&sensor=true"></script>');
//$pagina->link('facebox/facebox.css');
//$pagina->link('facebox/facebox.js');
//$pagina->link("<script language=\"javascript\">\n\n$(document).ready(function() {\n$.facebox.settings.opacity = 0.5;\n$('a[rel*=facebox]').facebox();\n/*$.facebox('This will display after the page has finished loading');*/\n\n$.get('login.php?user=".isset($_POST['user'])."&pass=".isset($_POST['pass'])."', function(html) {\n$.facebox(html);\n});\n\n});\n</script>"); //Opens facebox at page's load.
//$pagina->jquery("jQuery(document).ready(function($) {\n$('a[rel*=facebox]').facebox()\n})");

$pagina->setlayout();
require_once BASE_URI."_vista/pedidos_vista.php";
$content = new PedidosVista();
$html = $content->getHtml();

echo $pagina->display($html);

?>