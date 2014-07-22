<?php
require_once '_modelo/renglones_modelo.php';
require_once '_controlador/renglones_controlador.php';

// PRUEBA PARA CREAR UN RENGLON
$renglon = new Renglones('22606', 1, 0, 0, 0.1379, 'PAGADO');
print_r($renglon->toArray());

//echo "<h3>iva: " . RenglonesCtrl::importeIVA($renglon) . "<h3/>";
//echo "<h3>importe: " . RenglonesCtrl::importe($renglon) . "<h3/>";
//echo "<h3>total: " . RenglonesCtrl::subtotal($renglon) . "<h3/><br />";
// PRUEBA PARA GENERAR UN ARRAY CON LOS VALORES CALCULADOS
$detalle = RenglonesCtrl::arrayDetalleCalculos($renglon);
echo "<h3>PU: " . $detalle['precio'] . "<h3/>";
echo "<h3>cantidad: " . $detalle['cantidad'] . "<h3/>";
echo "<h3>importe: " . $detalle['importe'] . "<h3/>";
echo "<h3>iva: " . $detalle['iva'] *100 . "%<h3/>";
echo "<h3>importe iva: " . $detalle['importe_iva'] . "<h3/>";
echo "<h3>subtotal: " . $detalle['subtotal'] . "<h3/>";
echo "<h3>promocion: -" . $detalle['promocion'] * 100 . "%<h3/>";
echo "<h3>importe promocion: " . $detalle['importe_promocion'] . "<h3/>";
echo "<h3>descuento a cliente: -" . $detalle['importe_descuento_cliente'] * 100 . "%<h3/>";
echo "<h3>importe descuento a cliente: " . $detalle['importe_descuento_cliente'] . "<h3/>";
echo "<h3>descuento adicional: -" . $detalle['descuento_adicional'] * 100 . "%<h3/>";
echo "<h3>importe descuento adicional: " . $detalle['importe_descuento_adicional'] . "<h3/>";
echo "<h3>total de descuentos: " . $detalle['total_descuentos'] . "<h3/>";
echo "<h3>total: " . $detalle['total'] . "<h3/>";