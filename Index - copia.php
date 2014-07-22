<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"">
        <title>Distribuidora GC</title>
        <meta name="description" content="Distribuidora GC">
        <meta name="keywords" content="Distribuidora GC">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="facebox/facebox.css">
        <script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
        <script type="text/javascript" src="js/cufon-yui.js"></script>
        <script type="text/javascript" src="js/Myriad_Pro_700.font.js"></script>
        <script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>
        <script type="text/javascript" src="js/functions.js"></script>
        <script type="text/javascript" src="facebox/facebox.js"></script>
        <script type="text/javascript">$(document).ready(function() {
                jQuery(document).ready(function($) {
                    $('a[rel*=facebox]').facebox()
                })
            })</script>
    </head>
    <body><!-- Begin Wrapper -->
        <div id="wrapper">
            <!-- Begin Header -->
            <div id="header">
                <!-- Begin Shell -->
                <div class="shell">
                    <h1 id="logo"><a class="notext" href="index.php" title="Distribuidora GC">Distribuidora GC</a></h1>
                    <div id="top-nav"><ul><li><a href="login_window.php" rel="facebox" ><span>Iniciar Sesión</span></a></li></ul>
                    </div>
                    <div class="cl">&nbsp;</div>
                    <p id="cart"><span class="profile">Bienvenido, aún no ha iniciado <a href="#" title=".">sesión de usuario</a> . </span></p>
                </div>
                <!-- End Shell -->
            </div>
            <!-- End Header -->
            <!-- Begin Navigation -->
            <div id="navigation">
                <!-- Begin Shell -->
                <div class="shell">
                    <ul>
                        <li>
                            <a href="#"><img src="images/order_close.png">PROMOCIONES DEL MES</a>
                        </li>
                        <li>
                            <a href="#"><img src="images/order_close.png">CATALOGO EN LINEA</a>
                        </li>
                        <li>
                            <a href="#"><img src="images/order_close.png">SERVICIOS</a>
                            <div class="dd">
                                <ul>
                                    <li>
                                        <a href="#">SISTEMAS FOTOVOLTAICOS</a>
                                    </li>
                                    <li>
                                        <a href="#">ASESORIA EN HERRAMIENTA</a>
                                    </li>
                                    <li>
                                        <a href="#">ASESORIA EN MAQUINARIA</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#"><img src="images/order_close.png">CONTACTO</a>
                            <div class="dd">
                                <ul>
                                    <li>
                                        <a href="#">ATENCION A CLIENTES</a>
                                    </li>
                                    <li>
                                        <a href="#">SOPORTE TECNICO</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <div class="cl">&nbsp;</div>
                </div>
                <!-- End Shell -->
            </div>
            <!-- End Navigation -->
            
            <!-- Begin Slider -->
            <?php
            if ( isset($_GET['s']) ) {
                $s = $_GET['s'];
                if (!@include_once '_vista/'.$s.'_vista.php') {
                    //include_once '_vista/404_vista.php';
                }
            }
            ?>
            <!-- End Slider -->
            
            <!-- Begin Main -->
            <div id="main" class="shell">
                <!-- Begin Content -->
                <div id="content">
                <?php
                if ( isset($_GET['p']) ) {
                    $p = $_GET['p'];
                    if (!@include_once '_vista/'.$p.'_vista.php') {
                        include_once '_vista/404_vista.php';
                    }
                } else {
                    include_once '_vista/posts_vista.php';
                }
                ?>
                </div>
                <!-- End Content -->
                <div class="cl">&nbsp;</div>
            </div>
            <!-- End Main -->
        </div>
        <!-- End Wrapper --><!-- Begin Footer -->
        <div id="footer">
            <div class="boxes">
                <!-- Begin Shell -->
                <div class="shell">
                    <div class="box post-box">
                        <h2>Acerca de Distribuidora GC</h2>
                        <div class="box-entry">
                            <img src="images/bottom-logo.png" alt="Distribuidora GC">
                            <p>Alcanzar y mantener un lugar tan destacado en la industria ferretera ha sido posible gracias a una filosofía de trabajo que nos impulsa a realizar nuestras actividades diarias con la máxima eficiencia. Así nos aseguramos de que cada artículo que vendemos con nuestras marcas cumple nuestra promesa de calidad: poner en el mercado los productos con la mejor calidad en su categoría, incluidas aquellas en las que no somos líderes absolutos.</p>
                            <p>A lo largo de los años esta filosofía ha ido permeando a todos los colaboradores que se han incorporado a nuestras filas, seleccionados por su actitud positiva y entrega al trabajo hecho con excelencia.
                            <div class="cl">&nbsp;</div>
                        </div>
                    </div>
                    <div class="box social-box">
                        <h2>Síguenos en:</h2>
                        <ul>
                            <li><a href="https://www.facebook.com/pages/Distribuidora-GC/116334158538331" title="Facebook" target="_blank"><img src="images/social-icon1.png" alt="Facebook"><span>Facebook</span><span class="cl">&nbsp;</span></a></li>
                            <li><a href="#" title="Twitter"><img src="images/social-icon2.png" alt="Twitter"><span>Twitter</span><span class="cl">&nbsp;</span></a></li>
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
                            <li><a href="#" title="VISA"><img src="images/cart-img2.jpg" alt="VISA"></a></li>
                            <li><a href="#" title="MasterCard"><img src="images/cart-img3.jpg" alt="MasterCard"></a></li>
                            <li><a href="#" title="Payworks"><img src="images/banorte-payworks.png" height="24" alt="Payworks"></a></li>
                            <li><a href="#" title="SSL"><img src="images/ssl.png" height="24" alt="SSL"></a></li>
                        </ul>
                    </div>
                    <p>&copy; www.DistribuidoraGC.com. Todos los derechos reservados.<br>Versión 0.1a. Ultima actualización: 12/01/2012.</p>
                    <div class="cl">&nbsp;</div>
                </div>
                <!-- End Shell -->
            </div>
        </div>
        <!-- End Footer -->
    </body>
</html>