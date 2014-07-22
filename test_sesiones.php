<?php
require_once '_modelo/sesiones_modelo.php';
require_once '_modelo/renglones_modelo.php';
require_once '_controlador/sesiones_controlador.php';
require_once '_controlador/renglones_controlador.php';

// PRUEBA PARA INICIAR SESION
$usuario = 'rgarcia';
$clave = '1234';
echo SesionesCtrl::iniciarSesion($usuario, $clave);

echo '<h1>usuario</h1>';
print_r($_SESSION['usuario']->toArray());
echo '<h1>sesion</h1>';
print_r($_SESSION['sesion']->toArray());
echo '<h1>carrito</h1>';
print_r($_SESSION['carrito']->toArray());
$p22606 = new Renglones('22606', 6, 9.99, 13.79, 0, 'CAPTURADO');
$renglones = array();
array_push($renglones, $p22606);
$_SESSION['carrito']->setRenglones($renglones);

echo SesionesCtrl::cerrarSesion();