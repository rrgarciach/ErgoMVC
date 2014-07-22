<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "_vista/page.class.php";
$pagina = new page('Distribuidora GC');
$pagina->doctype('html','strict');
$pagina->link('css/style.css');
$pagina->link('css/distribuidoragc-theme/jquery-ui-1.10.3.custom.css');
$pagina->link('js/jquery-1.6.2.min.js');
$pagina->link('js/jquery-1.9.1.js');
$pagina->link('js/jquery-ui-1.10.3.custom.js');
$pagina->link('js/cufon-yui.js');
$pagina->link('js/Myriad_Pro_700.font.js');
$pagina->link('js/jquery.jcarousel.min.js');
$pagina->link('js/functions.js');
$pagina->link('js/index.js');
//$pagina->link('facebox/facebox.css');
//$pagina->link('facebox/facebox.js');
//$pagina->link("<script language=\"javascript\">\n\n$(document).ready(function() {\n$.facebox.settings.opacity = 0.5;\n$('a[rel*=facebox]').facebox();\n/*$.facebox('This will display after the page has finished loading');*/\n\n$.get('login.php?user=".isset($_POST['user'])."&pass=".isset($_POST['pass'])."', function(html) {\n$.facebox(html);\n});\n\n});\n</script>"); //Opens facebox at page's load.
//$pagina->jquery("jQuery(document).ready(function($) {\n$('a[rel*=facebox]').facebox()\n})");
$pagina->setlayout();

require_once "_vista/posts_vista.php";
$content = new PostsVista();
$html = $content->getHtml();

echo $pagina->display($html);

?>