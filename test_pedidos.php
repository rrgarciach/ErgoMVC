<?php
//        require_once 'librerias/xml_class.php';
//        require_once '_controlador/pedidos_controlador.php';
//        $pedidos = PedidosCtrl::buscarPedidos('4', 'id_pedido');
//        foreach ($pedidos as $pedido) {
//            $pedido = $pedido->toArray();
//            print_r($pedido);
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

          // GENERRA UN XML DE UN PRODUCTO
//          require_once '_controlador/productos_controlador.php';
//          ProductosCtrl::generarXML(22606);
          
          // GENERA XML DE UN PEDIDO
          require_once '_controlador/pedidos_controlador.php';
//          PedidosCtrl::generarXML(3);
//          print_r(PedidosCtrl::buscarPedidos(3));
          
          // CARGAR XML DE UN PEDIDO A LA BASE DE DATOS
//          $pedidoASubir = PedidosCtrl::abrirXML('pedido000003.xml');
//          PedidosCtrl::agregarPedidos($pedidoASubir);
//          print_r($pedidoASubir->toArray());
          PedidosCtrl::generarXML(1);
//          $pedido = PedidosCtrl::buscarPedidos(5);
//          echo $pedido[0]->getId_cliente();
//          print_r($pedido[0]->toArray());
        
//        // INSERTAR PEDIDO
//        require_once '_controlador/pedidos_controlador.php';
//        require_once '_modelo/pedidos_modelo.php';
//        $p = new Pedidos();
//        $p->setId_pedido(6);
//        $p->setCliente('996');
//        require_once '_controlador/productos_controlador.php';
//        $p1 = ProductosCtrl::buscarProductos('10012', 'id_producto');
//        //$p2 = ProductosCtrl::buscarProductos('22606', 'id_producto');
//        $productos = array ($p1[0]);
//        //print_r($productos);
//        $p->setProductos($productos);
//        $p->setVendedor('100');
//        $fecha = date("Y-m-d H:m:s:0");
//        $p->setFecha($fecha);
//        $p->setNotas('NOTAS CARGADAS DESDE PHP.');
//        PedidosCtrl::agregarPedidos($p);
        
//        // MODIFICAR PEDIDO
//        require_once '_controlador/pedidos_controlador.php';
//        require_once '_modelo/pedidos_modelo.php';
//        $p = new Pedidos();
//        $p->setId_pedido(1);
//        $p->setId_cliente('996');
//        require_once '_controlador/productos_controlador.php';
//        $p1 = ProductosCtrl::buscarProductos('10012', 'id_producto');
//        //$p2 = ProductosCtrl::buscarProductos('22606', 'id_producto');
//        $productos = array ($p1[0]);
//        $p->setProductos($productos);
//        require_once '_modelo/direccion_envio_modelo.php';
//        $direccion = new Direccion_Envio();
//        $direccion->setId_direccion(2);
//        $direccion->setCalle("calle");
//        $direccion->setNumero("2345");
//        $direccion->setColonia("Colonia");
//        $direccion->setCp("31100");
//        $direccion->setCiudad("Ciudad");
//        $direccion->setEstado("Estado");
//        $direccion->setLocalidad("Localidad");
//        $direccion->setX("12345");
//        $direccion->setY("98765");
//        $direcciones = array ($direccion);
//        $p->setDireccion_envio($direcciones);
//        $p->setId_vendedor('ruy');
//        $fecha = date("Y-m-d H:m:s:0");
//        $p->setFecha($fecha);
//        $p->setNotas('PEDIDO MODIFICADO.');
//        PedidosCtrl::actualizarPedidos($p);
//        //print_r($p->toArray());
        
//        // ELIMINAR PEDIDO
//        require_once '_controlador/pedidos_controlador.php';
//        require_once '_modelo/pedidos_modelo.php';
//        $p = new Pedidos();
//        $p->setId_pedido(5);
//        $p->setId_cliente('996');
//        require_once '_controlador/productos_controlador.php';
//        $p1 = ProductosCtrl::buscarProductos('10012', 'id_producto');
//        //$p2 = ProductosCtrl::buscarProductos('22606', 'id_producto');
//        $productos = array ($p1[0]);
//        $p->setProductos($productos);
//        $p->setId_vendedor('ruy');
//        $fecha = date("Y-m-d H:m:s:0");
//        $p->setFecha($fecha);
//        $p->setNotas('PEDIDO MODIFICADO.');
//        PedidosCtrl::borrarPedidos($p);
//        //print_r($p->toArray());