<?php
//        require_once 'librerias/xml_class.php';
//        require_once '_controlador/clientes_controlador.php';
//        $clientes = ClientesCtrl::buscarClientes('1', 'id_cliente');
//        foreach ($clientes as $cliente) {
//            $cliente = $cliente->toArray();
//            print_r($cliente);
////            $productos = $pedido->getProductos();
////            foreach ($productos as $producto) {
////                print_r( $producto->toArray() );
////                echo $producto->getId_producto()."<br/>";
////            }
//        }
        
//        // GENERAR XML DE UN PRODUCTO
//        require_once '_controlador/productos_controlador.php';
//        $codigo = 10014;
//        $productos = ProductosCtrl::buscarProductos($codigo);
//        require_once 'librerias/xml_class.php';
//        $productoXML = new Xml($productos[0]);
//        $productoXML->saveToFile("producto$codigo.xml");

//          require_once '_controlador/productos_controlador.php';
//          ClientesCtrl::generarXML(22606);
        
        // INSERTAR CLIENTE
        require_once '_controlador/clientes_controlador.php';
        require_once '_modelo/clientes_modelo.php';
//        $p = new Clientes();
//        $p->setId_index(2);
//        $p->setId_cliente('99');
//        $p->setId_usuario('99');
//        $p->setNombre('Nombre Vendedor');
//        $p->setApellido_p('Apellido1');
//        $p->setApellido_m('Apellido2');
////        $p->setCalle('Callejon');
////        $p->setNumero('12345');
////        $p->setColonia('Colonia');
////        $p->setCp('33333');
////        $p->setEstado('Estado');
////        $p->setLocalidad('Localidad');
////        $p->setX(28.674895);
////        $p->setY(-106.137272);
//        $p->setTelefono1('555-555-5555');
//        $p->setEmail1('999@email.com');
//        $p->setDescuento('13.79');
//        $p->setId_zona('3');
//        $p->setId_vendedor('100');
//        $p->setId_repartidor('100');
//        echo ClientesCtrl::agregarClientes($p);
        $clientes = ClientesCtrl::buscarClientes('999');
        $cliente = $clientes[0];
        print_r($cliente);
        
//        // MODIFICAR PEDIDO
//        require_once '_controlador/pedidos_controlador.php';
//        require_once '_modelo/pedidos_modelo.php';
//        $p = new Pedidos();
//        $p->setId_pedido(6);
//        $p->setCliente('996');
//        require_once '_controlador/productos_controlador.php';
//        $p1 = ProductosCtrl::buscarProductos('10012', 'id_producto');
//        //$p2 = ProductosCtrl::buscarProductos('22606', 'id_producto');
//        $productos = array ($p1[0]);
//        $p->setProductos($productos);
//        $p->setVendedor('ruy');
//        $fecha = date("Y-m-d H:m:s:0");
//        $p->setFecha($fecha);
//        $p->setNotas('PEDIDO MODIFICADO.');
//        PedidosCtrl::actualizarPedidos($p);
//        //print_r($p->toArray());
        
//        // ELIMINAR PEDIDO
//        require_once '_controlador/pedidos_controlador.php';
//        require_once '_modelo/pedidos_modelo.php';
//        $p = new Pedidos();
//        $p->setId_pedido(6);
//        $p->setCliente('996');
//        require_once '_controlador/productos_controlador.php';
//        $p1 = ProductosCtrl::buscarProductos('10012', 'id_producto');
//        //$p2 = ProductosCtrl::buscarProductos('22606', 'id_producto');
//        $productos = array ($p1[0]);
//        $p->setProductos($productos);
//        $p->setVendedor('ruy');
//        $fecha = date("Y-m-d H:m:s:0");
//        $p->setFecha($fecha);
//        $p->setNotas('PEDIDO MODIFICADO.');
//        PedidosCtrl::borrarPedidos($p);
//        //print_r($p->toArray());