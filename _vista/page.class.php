<?php
/*require_once "classes/user_id.class.php"; // REQUIERED FOR LOGGIN.
require_once "classes/APPI-orders.class.php";
require_once "classes/binnacle.class.php";*/
/*function __autoload($class) {
  require_once "class/".$class.".class.php"
}*/
//$homeURL = "/distribuidoragc";
$homeURL = "/";
if (session_id() == '') {session_start();}
if ( isset($_POST['act']) ){ if ($_POST['act'] == "close"){$reg = new Binnacle();$reg->write("logged-off");session_destroy();header("Location: $homeURL");} }

/*
 *    author:		Kyle Gadd
 *    documentation:	http://www.php-ease.com/classes/page.html
 *
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
//header('Content-Type: text/html; charset=utf-8');
require_once "_addresses.php";
if(!defined('SITE_NAME'))define ('SITE_NAME', 'Your Website');
//if(!defined('BASE'))define ('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
//if(!defined('BASE_URI'))define ('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
//if(!defined('BASE_URL'))define ('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address
if(!defined('DOCTYPE'))define ('DOCTYPE', 'xhtml strict');

class Page {

  private $home = 'index.php';
  private $title = '';
  private $description = '';
  private $keywords = '';
  private $robots = true;
  private $doctype = '';
  private $xhtml = true;
  private $charset = 'utf-8"';
  private $include = array();
  private $jquery = array();
  private $body = '';
  private $htmlTopBanner = '';
  private $htmlNavigator = '';
  private $htmlFooter = '';

  function __construct ($title='') {
    if (!empty($title)) {
      $this->title = $title;
    } elseif (defined('SITE_NAME')) {
      $this->title = SITE_NAME;
    }
    if (defined('DOCTYPE')) {
      list($type, $standard) = explode(' ', DOCTYPE);
      $this->doctype ($type, $standard);
    } else {
      $this->doctype ('xhtml', 'strict');
    }
  }

  public function doctype ($type='html', $standard='strict') {
    if (in_array($standard, array('strict', 'transitional', 'frameset'))) {
      if ($type == 'html') {
        $this->xhtml = '';
        switch ($standard) {
          case 'strict': $this->doctype = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">'; break;
          case 'transitional': $this->doctype = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">'; break;
          case 'frameset': $this->doctype = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">'; break;
        }
      } elseif ($type == 'xhtml') {
        $this->xhtml = ' /';
        switch ($standard) {
          case 'strict': $this->doctype = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'; break;
          case 'transitional': $this->doctype = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'; break;
          case 'frameset': $this->doctype = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">'; break;
        }
      }
    }
  }

  public function access ($user, $level=1) { 
    switch ($user) {
      case 'users':
        if (!isset($_SESSION['user'])) $this->eject($this->home);
        break;
      case 'admin':
        //if (!isset($_SESSION['admin']) || $_SESSION['admin'] == 0 || $_SESSION['admin'] > $level) $this->eject();
      if ($_SESSION['user']->getAdmin() == 0 || $_SESSION['user']->getAdmin() > $level) $this->eject();
        break;
      case 'others':
        if (isset($_SESSION['user'])) $this->eject($this->home);
        break;
    }
  }

  public function eject ($where='', $msg='') {
    if (stristr($where, BASE_URL)) {
      $url = $where;
    } else {
      $url = BASE_URL . $where;
    }
    if (ob_get_length()) ob_end_clean();
    if (empty($msg)) {
      $url = str_replace('&amp;', '&', $url);
      header("Location: $url");
    } else {
      echo '<script type="text/javascript"> var msg = confirm("' . str_replace(array('<br />', '<br>'), "\\n", addslashes($msg)) . '"); if (msg == true) { window.location = "' . $url . '"; } else { window.location = "' . $url . '"; } </script>';
      echo $msg . '<br /><br /><a href="' . $url . '">Click here to continue.</a>';
    }
    exit; 
  }

  public function title ($title='') {
    if (!empty($title)) $this->title = $title;
    return $this->title;
  }

  public function description ($description) {
    $this->description = $description;
  }

  public function keywords ($keywords) {
    $this->keywords = $keywords;
  }

  public function robots ($robots) {
    if (is_bool($robots)) $this->robots = $robots;
  }

  public function charset ($charset) {
    $this->charset = $charset;
  }

  public function link ($link, $prepend=false) {
    if (!is_array($link)) $link = array($link);
    if ($prepend) {
      $this->include = array_merge($link, $this->include);
    } else {
      foreach ($link as $value) $this->include[] = $value;
    }
  }

  public function jquery ($code, $oneliner=true) {
    if ($oneliner) $code = $this->oneliner($code);
    $this->jquery[] = $code;
  }
  
  public function body ($body) {
    $this->body = $body;
  }

  public function url ($action='', $url='', $key='', $value=NULL) {
    $protocol = ($_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
    if (empty($url)) $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    if ($action == 'ampify') return $this->ampify($url);
    $url = str_replace ('&amp;', '&', $url);
    if (empty($action) && empty($key)) { // clean the slate
      $url = explode('?', $url);
      return $url[0]; // no amps to convert
    }
    $fragment = parse_url ($url, PHP_URL_FRAGMENT);
    if (!empty($fragment)) {
      $fragment = '#' . $fragment; // to add on later
      $url = str_replace ($fragment, '', $url);
    }
    if ($key == '#') {
      if ($action == 'delete') $fragment = '';
      elseif ($action == 'add') $fragment = '#' . urlencode($value);
      return $this->ampify($url . $fragment);
    }
    $url = preg_replace('/(.*)(\?|&)' . $key . '=[^&]+?(&)(.*)/i', '$1$2$4', $url . '&');
    $url = substr($url, 0, -1);
    $value = urlencode($value);
    if ($action == 'delete') {
      return $this->ampify($url . $fragment);
    } elseif ($action == 'add') {
      if (strpos($url, '?') === false) {
        return ($url . '?' . $key . '=' . $value . $fragment); // no amps to convert
      } else {
        return $this->ampify($url . '&' . $key . '=' . $value . $fragment);
      }
    }
  }

  public function display ($content='') {
    $html = '';
    $type = ($this->xhtml) ? 'xhtml' : 'html';
    $frameset = false;
    if (strpos($content, '<frame ') !== false) { // Then this is a frameset ...
      $frameset = true;
      $this->doctype($type, 'frameset');
    } elseif (strpos($this->doctype, 'frameset') !== false) { // If we're here then it's not ...
      $this->doctype($type, 'transitional');
    }
    $html .= $this->doctype . "\n";
    $html .= '<html';
    if ($this->xhtml) $html .= ' lang="en-US" xml:lang="en-US" xmlns="http://www.w3.org/1999/xhtml"';
    $html .= '>' . "\n";
    $html .= '<head>' . "\n";
    $html .= $this->meta_tags();
    $html .= $this->include_scripts();
    //if ( isset($_GET['ses']) ) {
      //if ( $_GET['ses'] == 0 ) { // facebox al iniciar sesion
        //$html .= "<script language=\"javascript\">\n$(document).ready(function() {\n$.facebox.settings.opacity = 0.5;\n$('a[rel*=facebox]').facebox();\n$.facebox('Sesión iniciada.');\n/*$.get('login_window.php', function(html) {\n$.facebox(html);\n});*/\n});\n</script>";
        //unset($_GET['ses']);
        //header("Location: $homeURL?ses=0");
      //}
      //elseif ( $_GET['ses'] == 1 ) { // facebox al cerrar sesion
        //$html .= "<script language=\"javascript\">\n$(document).ready(function() {\n$.facebox.settings.opacity = 0.5;\n$('a[rel*=facebox]').facebox();\n$.facebox('Sesión cerrada.');\n/*$.get('login_window.php', function(html) {\n$.facebox(html);\n});*/\n});\n</script>";
        //unset($_GET['ses']);
        //header("Location: $homeURL?ses=0");
      //}
    //}
    $html .= '</head>' . "\n";
    $html .= ($frameset) ? '<frameset' : '<body';
    if (!empty($this->body)) $html .= ' ' . $this->body;
    $html .= '>';
    $html .= $this->htmlTopBanner; //<---------------------------AQUI VAN LOS HEADERS Y NAVS
    //$html .= "<div id=\"main\" class=\"shell\">\n<div id=\"content\">\n";
    $html .= $this->htmlNavigator;
    $html .= "\n  " . trim($content);
    $html .= "</div>\n<div class=\"cl\">&nbsp;</div>\n<div class=\"slider-nav\">\n</div>\n";
    $html .= $this->htmlFooter;
    $html .= ($frameset) ? "\n</frameset>" : "\n</body>";
    $html .= "\n</html>";
    if (!$this->xhtml) $html = str_replace(' />', '>', $html);
    return $html;
  }

  private function meta_tags () {
    $tags = '  <meta http-equiv="Content-Type" content="text/html; charset=' . $this->charset . '" />' . "\n";
    //$tags .= "<meta charset=\"utf-8\">\n";
    $tags .= '  <title>' . $this->title . '</title>' . "\n";
    $description = (!empty($this->description)) ? $this->description : $this->title;
    $keywords = (!empty($this->keywords)) ? $this->keywords : $this->title;
    $tags .= '  <meta name="description" content="' . $description . '" />' . "\n";
    $tags .= '  <meta name="keywords" content="' . $keywords . '" />' . "\n";
    if (!$this->robots) $tags .= '  <meta name="robots" content="noindex, nofollow" />' . "\n";
    return $tags;
  }

  private function include_scripts () {
    $scripts = $this->combine_scripts($this->sort_scripts($this->include));
    if (!empty($this->jquery)) {
      $this->jquery = array_unique($this->jquery);
      $scripts .= '  <script type="text/javascript">$(document).ready(function(){' . "\n  ";
      $scripts .= implode("\n  ", $this->jquery);
      $scripts .= "\n  })</script>\n";
    }
    return $scripts;
  }
  
  private function sort_scripts ($array) { // used in $this->include_scripts()
    $array = array_unique($array);
    $scripts = array();
    foreach ($array as $script) {
      $parts = explode('.', $script);
      $ext = array_pop($parts);
      $name = implode('.', $parts);
      switch ($ext) {
        case 'ico': $scripts['ico'] = $script; break;
        case 'css': $scripts['css'][] = $name; break;
        case 'js': $scripts['js'][] = $name; break;
        default: $scripts['other'][] = $script; break;
      }
    }
    return $scripts;
  }
  
  private function combine_scripts ($sorted) { // used in $this->include_scripts()
    if (empty($sorted)) return '';
    $scripts = array();
    if (isset($sorted['ico'])) {
      $scripts[] = '<link rel="shortcut icon" type="image/x-icon" href="' . $sorted['ico'] . '" />';
    }
    if (isset($sorted['css'])) {
      foreach ($sorted['css'] as $script) {
        $scripts[] = '<link rel="stylesheet" type="text/css" href="' . $script . '.css" />';
      }
    }
    if (isset($sorted['js'])) {
      foreach ($sorted['js'] as $script) {
        $scripts[] = '<script type="text/javascript" src="' . $script . '.js"></script>';
      }
    }
    if (isset($sorted['other'])) $scripts = array_merge($scripts, $sorted['other']);
    return '  ' . implode("\n  ", $scripts) . "\n";
  }
  
  private function oneliner ($code) {
    return preg_replace('/\s(?=\s)/', '', str_replace(array("\r\n", "\r", "\n"), ' ', $code));
  }

  private function ampify ($string) { // used in $this->url
    return str_replace(array('&amp;', '&'), array('&', '&amp;'), $string);
  }

  public function topBanner () {

    $html = "";
    $html .= "<!-- Begin Wrapper -->\n<div id=\"wrapper\">\n<!-- Begin Header -->\n<div id=\"header\">\n<!-- Begin Shell -->\n<div class=\"shell\">\n<h1 id=\"logo\"><a class=\"notext\" href=\"".$this->home."\" title=\"Distribuidora GC\">Distribuidora GC</a></h1>\n";
    $xmlTop = simplexml_load_file("xml/topbanner.xml");
    $html .= "<div id=\"top-nav\"><ul>";
   
      if ( isset($_SESSION['user']) ) {
         foreach ($xmlTop->children() as $section) {
          $src = $section->src;
          $text = $section->text;
          $onclick = $section->onclick;
          if ($text == "Sesion") {
            $html .= "<li><form name=\"close\" id=\"close\" method=\"post\" action=\"index.php\"><input type=\"hidden\" name=\"act\" id=\"act\" value=\"close\"></form>
            <a href=\"#\" onclick=\"javascript:document.close.submit();return false;\" ><span>Cerrar Sesión</span></a></li>";
          } else {
            $html .= "<li><a href=\"".$src."\" onclick=\"".$onclick."\" ><span>".$text."</span></a></li>";
          }
        }
      } else {
        $html .= "<li><a href=\"#\" ><span id=\"button-login\">Iniciar Sesión</span></a></li>";
        //$html .= "<li><a href=\"#\" onclick=\"javascript:openForm('login.php*content',450); return false;\" ><span>Iniciar Sesión</span></a></li>";
      }

    $html .= "</ul>\n</div>\n<div class=\"cl\">&nbsp;</div>\n";
    if ( isset($_SESSION['user']) ) {
      $html .= "<p id=\"cart\"><span class=\"profile\">Bienvenido, <a href=\"#\" title=\"Ver el perfil del usuario.\">".$_SESSION['user']->getName()."</a> . </span> ".$this->cart()." </p>\n</div>\n";
    } else {
      $html .= "<p id=\"cart\"><span class=\"profile\">Bienvenido, aún no ha iniciado <a href=\"#\" title=\".\">sesión de usuario</a> . </span></p>\n</div>\n";
    }
    $html .= "<!-- End Shell -->\n</div>\n<!-- End Header -->\n";
    $this->htmlTopBanner = $html;

  }

  public function cart () {

    $cart = "";
    if ( isset($_SESSION['user']) ) {
      switch ($_SESSION['user']->getType()) {
        case 'admin':
        case 'vendor':
          if ( isset($_SESSION['order']) ) {
            $cart = "<span class=\"shopping\">Pedido en captura (".count($_SESSION['order']->products)." producto(s)) <a href=\"#\" title=\"Pedido en captura\">$ ".number_format($_SESSION['order']->stl, 2)." MXN</a></span>";
          }
          else {
            $cart = "<span class=\"shopping\">No hay pedido en captura.</span>";
          }
          break;
        
        case 'customer':
          if ( isset($_SESSION['order']) ) {
            $cart = "<span class=\"shopping\">Carrito de Compras (".count($_SESSION['order']->products)." productos(s)) <a href=\"#\" title=\"Carrito de Compras\">$ ".number_format($_SESSION['order']->stl, 2)." MXN</a></span>";
          }
          else {
            $cart = "<span class=\"shopping\">Carrito de Compras (Vacío) <a href=\"#\" title=\"Carrito de Compras\">$ 0.00 MXN</a></span>";
          }
          break;
      }
      
    }
    else {
      $cart = "";
    }
    return $cart;

  }

  public function navigator () {

    $html = "";
    $xmlNav = simplexml_load_file("xml/navigator.xml");
    $html .= "<!-- Begin Navigation -->\n<div id=\"navigation\">\n<!-- Begin Shell -->\n<div class=\"shell\">\n<ul>\n";
    foreach ($xmlNav->general->children() as $section) {
      $src = $section->src;
      $text = $section->text;
      $onclick = $section->onclick;
      $html .= "<li>\n<a href=\"".$src."\"><img src=\"images/order_close.png\" />".$text."</a>\n</li>\n";
      //print "<li class=\"active\"><a href=\"".$src."\" onclick=\"".$onclick."\" title=\"".$text."\">".$text."</a></li>";
    }
    $html .= "</ul>\n</div>\n</li>\n";
    $html .= "<li>\n<a href=\"#\"><img src=\"images/order_close.png\" />CONTACTO</a>\n<div class=\"dd\">\n<ul>\n";
    foreach ($xmlNav->contacto->children() as $section) {
      $src = $section->src;
      $text = $section->text;
      $onclick = $section->onclick;
      $html .= "<li>\n<a href=\"".$src."\">".$text."</a>\n</li>\n";
    }
    $html .= "</ul>\n</div>\n</li>\n";
    if ( isset($_SESSION['user']) ) {
      if ( $_SESSION['user']->getType() == 'vendor' || $_SESSION['user']->getType() == 'admin' ) {
        $html .= "<li>\n<a href=\"#\"><img src=\"images/order_close.png\" />VENTAS</a>\n<div class=\"dd\">\n<ul>\n";
        foreach ($xmlNav->vendor->children() as $section) {
          $src = $section->src;
          $text = $section->text;
          $onclick = $section->onclick;
          $html .= "<li>\n<a href=\"".$src."\">".$text."</a>\n</li>\n";
        }
        $html .= "</ul>\n</div>\n</li>\n";
      }
      if ( $_SESSION['user']->getType() == 'admin' ) {
        $html .= "<li>\n<a href=\"#\" ><img src=\"images/order_close.png\" />CMS</a>\n<div class=\"dd\">\n<ul>\n";
        foreach ($xmlNav->admin->children() as $section) {
          $src = $section->src;
          $text = $section->text;
          $onclick = $section->onclick;
          $html .= "<li>\n<a href=\"".$src."\">".$text."</a>\n</li>\n";
        }
        $html .= "</ul>\n</div>\n</li>\n";
      }
      if ( $_SESSION['user']->getType() == 'customer' ) {
        $html .= "<li>\n<a href=\"#\"><img src=\"images/order_close.png\" />PEDIDOS</a>\n<div class=\"dd\">\n<ul>\n";
        foreach ($xmlNav->customer->children() as $section) {
          $src = $section->src;
          $text = $section->text;
          $onclick = $section->onclick;
          $html .= "<li>\n<a href=\"".$src."\">".$text."</a>\n</li>\n";
        }
        $html .= "</ul>\n</div>\n</li>\n";
      }
    }

    $html .= "</ul>\n<div class=\"cl\">&nbsp;</div>\n</div>\n<!-- End Shell -->\n</div>\n<!-- End Navigation -->\n";
    $this->htmlNavigator = $html;

  }

  public function footer () {

    $html = '<!-- Begin Footer -->
    <div id="footer">
      <div class="boxes">
        <!-- Begin Shell -->
        <div class="shell">
          <div class="box post-box">
            <h2>Acerca de Distribuidora GC</h2>
            <div class="box-entry">
              <img src="images/bottom-logo.png" alt="Distribuidora GC" />
              <p>Alcanzar y mantener un lugar tan destacado en la industria ferretera ha sido posible gracias a una filosofía de trabajo que nos impulsa a realizar nuestras actividades diarias con la máxima eficiencia. Así nos aseguramos de que cada artículo que vendemos con nuestras marcas cumple nuestra promesa de calidad: poner en el mercado los productos con la mejor calidad en su categoría, incluidas aquellas en las que no somos líderes absolutos.</p>
              <p>A lo largo de los años esta filosofía ha ido permeando a todos los colaboradores que se han incorporado a nuestras filas, seleccionados por su actitud positiva y entrega al trabajo hecho con excelencia.
              <div class="cl">&nbsp;</div>
            </div>
          </div>
          <div class="box social-box">
            <h2>Síguenos en:</h2>
            <ul>
              <li><a href="https://www.facebook.com/pages/Distribuidora-GC/116334158538331" title="Facebook" target="_blank"><img src="images/social-icon1.png" alt="Facebook" /><span>Facebook</span><span class="cl">&nbsp;</span></a></li>
              <li><a href="#" title="Twitter"><img src="images/social-icon2.png" alt="Twitter" /><span>Twitter</span><span class="cl">&nbsp;</span></a></li>
            </ul>
            <div class="cl">&nbsp;</div>
          </div>
          <div class="box">
            <h2>Información</h2>
            <ul>
              <li><a href="#" title="Special Offers">Special Offers</a></li>
              <li><a href="#" title="Privacy Policy">Privacy Policy</a></li>
              <li><a href="#" title="Terms &amp; Conditions">Terms &amp; Conditions</a></li>
              <li><a href="#" title="Contact Us">Contact Us</a></li>
              <li><a href="#" title="Log In">Log In</a></li>
              <li><a href="#" title="Account">Account</a></li>
              <li><a href="#" title="Basket">Basket</a></li>
            </ul>
          </div>
          <div class="box last-box">
            <h2>Categorías</h2>
            <ul>
              <li><a href="#" title="Kids">Kids</a></li>
              <li><a href="#" title="Accessories">Accessories</a></li>
            </ul>
          </div>
          <div class="cl">&nbsp;</div>
        </div>
        <!-- End Shell -->
      </div>
      <div class="copy">
        <!-- Begin Shell -->
        <div class="shell">
          <div class="carts">
            <ul>
              <li><span>Aceptamos pagos con: </span></li>
              <li><a href="#" title="VISA"><img src="images/cart-img2.jpg" alt="VISA" /></a></li>
              <li><a href="#" title="MasterCard"><img src="images/cart-img3.jpg" alt="MasterCard" /></a></li>
              <li><a href="#" title="Payworks"><img src="images/banorte-payworks.png" height="24" alt="Payworks" /></a></li>
              <li><a href="#" title="SSL"><img src="images/ssl.png" height="24" alt="SSL" /></a></li>
            </ul>
          </div>
          <p>&copy; www.DistribuidoraGC.com. Todos los derechos reservados.<br />Versión 0.1a. Ultima actualización: 12/01/2012.</p>
          <div class="cl">&nbsp;</div>
        </div>
        <!-- End Shell -->
      </div>
    </div>
    <!-- End Footer -->';
    $this->htmlFooter = $html;
  }

  public function setLayout () {

    $this->topbanner();
    $this->navigator();
    $this->footer();

  }

}

?>