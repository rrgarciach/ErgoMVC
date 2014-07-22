globales: {
// Configuracion de ruta de archivos:
    if (!window.location.origin)
        window.location.origin = window.location.protocol + "//" + window.location.host;
    var base_uri = window.location.origin + "/";
    // Deteccion de Explorador Movil o PC:
    (function(a) {(jQuery.browser = jQuery.browser || {}).mobile = /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))})(navigator.userAgent || navigator.vendor || window.opera);
}

// JQuery funcion inicial:
$(document).ready(function() {
//    var $pedidoXML = $('<?xml version="1.0" encoding="utf-8"?>');
//    var str = '{"key":"id_pedido","elemento":"pedido","Id_pedido":0,"Id_cliente":"","Direccion_envio":[],"Renglones":[],"Id_vendedor":"rgarcia","Fecha":"","Estatus":"NA","Estatus_cobranza":"NA","Saldo":0,"Metodo_pago":"NA","Referencia_pago":"NA","Notas":""}'
//    var pedidoJSON = jQuery.parseJSON(str);
//    alert(pedidoJSON.key);
// Parametros y configuraciones generales:
    generales: {
        // Configura todos los botones:
        $(':button').button();
        // JWizard plugin:
        $("#wizard").jWizard({
            menu: false,
            buttons: {
                cancel: false,
                prev: {
                    text: "Anterior",
                    type: "button",
                    icons: {
                        primary: "ui-icon-circle-triangle-w"
                    }
                },
                next: {
                    text: "Siguiente",
                    type: "button"
                },
                finish: {
                    "class": "ui-priority-primary ui-state-highlight",
                    text: "Enviar Pedido",
                    type: "submit",
                    icons: {
                        secondary: "ui-icon-circle-check"
                    }
                }
            }
        });
        $('#dialog-mensaje').dialog({ autoOpen: false }).hide();
    }

    step_1_cliente: {
        $.post(base_uri + "_controlador/pedidos_controlador.php", {
            f: 'ajaxSetPedido',
            id_vendedor: 'rgarcia'
            }, function(data){
//                alert('apertura:');
//                alert(data);
                setcliente();
            });
        // Carga del HTML:
        $('#vista-cliente-elemento').load(base_uri + '_vista/clientes_vista.html #vista-cliente-elemento');
        // Carga del JQuery:
        $.getScript(base_uri + '_vista/clientes_vista.js');
        
        var setcliente = function() {
            var cliente = $('#codigo-cliente').val();
            $.post(base_uri + "_controlador/pedidos_controlador.php", {
            f: 'ajaxSetCliente',
            id_cliente: cliente
//            id_cliente: '999'
            }, function(data){
//                alert('cliente:');
//                alert(data);
            });}
    }

    step_2_productos: {
        variables: {
            var htmlBusqueda = '<div class="loader"><br /><br /><img src="images/loader.gif" alt="Buscando..."><h3>Buscando...</h3><h3>Por favor espere.</h3></div>';
        }
        configuraciones: {
            // Configuracion de leyendas:
            $('.leyenda').css("font-size", "11px");
            // Configuraciones de botones de busqueda:
            $('#button-buscar-productos-mosaicos').css("padding", "4px").css("margin", "0px").css("font-size", "0.9em");
            $('#button-buscar-productos-linea').css("padding", "4px").css("margin", "0px").css("font-size", "0.9em");
            // Esconde los botones de busqueda de mosaicos para dejar habilitados solo los de captura de linea:
            $('#input-buscar-productos-mosaicos').hide();
            $('#button-buscar-productos-mosaicos').hide();
            // Cambio de contenido HTML del dialog de productos encontrados:
            $("#productos-encontrados").html(htmlBusqueda);
            // Configuracion del dialog de productos encontrados:
            $("#dialog-productos").dialog({
                autoOpen: false,
                modal: true,
                height: 220,
                width: 240,
                resizable: false,
                open: function(event, ui) {
                    $(".ui-dialog-titlebar").hide();
//                            $(".ui-dialog-titlebar").hide();
                },
                beforeClose: function() {
                    $(".ui-dialog-titlebar").show();
                    $("#productos-encontrados").html(htmlBusqueda);
                    $("#dialog-productos").dialog("option", "height", 220).dialog("option", "width", 240);
                    $("#dialog-productos").dialog("option", "position", {my: "center", at: "center", of: window});
                }
            });
//                    .on("dialogbeforeclose", function(event, ui) {
//                $(".ui-dialog-titlebar").show();
//                $("#productos-encontrados").html(htmlBusqueda);
//                $("#dialog-productos").dialog("option", "height", 220).dialog("option", "width", 240);
//                $("#dialog-productos").dialog("option", "position", {my: "center", at: "center", of: window});
//            });
        }
        funciones: {
            // Autocomplete de productos:
            // Import del catalogo:
            $.getScript(base_uri + "js/catalogo.js").done(function() {
//            alert('aloha');
                $('#input-buscar-productos-linea').autocomplete({minLength: 2}, {
                    source: catalogo
                }).on('click', function() {
                    $(this).val('');
                });
            });
            // Funcion al seleccionar un producto con autocomplete:
//            var renglonNo = 0;
            var borrarRenglon = function() {
            $( ".button-borrar a" ).attr('class',"ui-icon ui-icon-trash").attr('title','Eliminar');//.button({ icons: { primary: "ui-icon-trash"} });
                $('.button-borrar a').click(function() {
                    event.preventDefault();
                    var id_renglon = $(this).attr('id');
                    $('#dialog-mensaje').html('¿Eliminar renglón?').dialog({
                        autoOpen: false,
                        title: 'Mensaje de confirmación',
                        modal: true,
                        draggable: false,
                        resizable: false,
                        closeOnEscape: true,
                        buttons: {
                            "Eliminar": function() {
                                $('tr#'+id_renglon+' > td').remove();
                                $('tr#'+id_renglon).remove();
//                                // Simular click en cantidad para modificar:
//                                $('#cantidad:first').click();
//                                borrarRenglon();
                                $('.renglones tbody > tr').each(function() {
                                    var idRow = $(this).attr('id');
//                                    alert('renglon: ' + idRow);
                                    if (idRow > id_renglon) {
                                        $(this).attr('id',idRow - 1);
//                                        $(this).closest('td').attr('id', idRow - 1);
                                        $(this).find('#numero-renglon').text(idRow - 1 +'.');
                                    }
                                });
                                $(".tablesorter").tablesorter();
                                setDynamicInputs();
//                                borrarRenglon();
                                $(this).dialog("close");
                            },
                            "Cancelar": function() {
                                $(this).dialog("close");
//                                return false;
                            }
                        },
                        open: function(event, ui) {
                            $(".ui-dialog-titlebar").hide();
//                            $(".ui-dialog-titlebar").hide();
                        },
                        beforeClose: function() {
////                            $(".ui-dialog-titlebar-close", ui.dialog || ui).show();
                            $(".ui-dialog-titlebar").show();
                        }
                    }).dialog('open');

//                    $('#myOpener').click(function() {
//                        event.preventDefault();
//                        return $myDialog.dialog('open'); //replace the div id with the id of the button/form
//                    });
                });
            }
            
            var agregarRenglon = function(valor) {
                $('#dialog-mensaje').dialog({
                    autoOpen: false,
                    title: 'Mensaje de confirmación',
                    modal: true,
                    draggable: false,
                    resizable: false,
                    closeOnEscape: true,
                    buttons: {
                        "Agregar": function() {
//                            alert('do');
                            $('.ocultable').show();
                            $('.abatible').show();
                            var valorCantidad = $('#cantidad-agregar').val();
                            agregarTr(valorCantidad);
                            $(this).dialog("close");
                            $('#input-buscar-productos-linea').focus();
                            $('#input-buscar-productos-mosaicos').val('');
                            $('#input-buscar-productos-mosaicos').focus();
//                            return agregar($(this));
                            return true;
                        },
                        "Cancelar": function() {
                            $(this).dialog("close");
                            return false;
                        }
                    },
                    open: function(event, ui) {
                        $(".ui-dialog-titlebar").hide();
//                            $(".ui-dialog-titlebar").hide();
                    },
                    beforeClose: function() {
////                            $(".ui-dialog-titlebar-close", ui.dialog || ui).show();
                        $(".ui-dialog-titlebar").show();
                    }
                })
                .html('<div class="loader"><br /><br /><img src="'+base_uri+'images/loader.gif" alt="Buscando..."><h3>Buscando...</h3><h3>Por favor espere.</h3></div>')
                .dialog('open').dialog("option", "position", {my: "center", at: "center", of: window});
                // Adquiere datos del producto para ponerlos en nuevo renglon de la tabla:
                $.post(base_uri + "_controlador/productos_controlador.php", {
                    f: 'buscarProductos',
                    valor: valor
                }, function(data) {
                    var xml = data;
                    if (data == "vacio") {
                        $('#dialog-mensaje').html("<h3>No hubo resultados.</h3>").dialog("option", "buttons", [{
                                text: "Aceptar",
                                click: function() {
                                    $(this).dialog("close");
                                    return false;
                                }
                            }
                        ]).dialog('open');
                    }
                    else {
                        xmlDoc = $.parseXML(xml);
                        $xml = $(xmlDoc);
//                alert('hasta aqui');
                        ventanaCantidad($xml);
                    }
                });
            }
            
            var agregarTr = function(cantidad) {
                var renglonNo = $('.renglones tbody').children('tr').length;
                var $urlImagen;
                var producto = $xml.find('id_producto').text();
                $.post(base_uri + "_vista/productos_vista.php", {
                    f: 'urlImagen',
                    id_producto: producto
                }, function(data) {
                    alert($(data).find('body').text());
                    $urlImagen = $(data).find('body').text();
                });
                $('.renglones tbody').prepend($('<tr id="' + (++renglonNo) + '"></tr>')
                        .append('<td id="numero-renglon">' + renglonNo + '.</td>')
                        .append('<td class="ocultable" id="imagen"><img src="'+ $urlImagen +'" width="68" height="63" alt="default thumb" class="thumb"></td>')
                        .append('<td id="id_producto">' + $xml.find('id_producto').text() + '</td>')
                        .append('<td id="descripcion">' + $xml.find('descripcion').text() + '</td>')
                        .append('<td><p class="switch-input-numero" id="cantidad">' + cantidad + '</p></td>')
                        .append('<td><p class="switch-input-moneda" id="pu">$ ' + (parseFloat($xml.find('precio').text()).toFixed(2)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '</p></td>')
                        .append('<td class="abatible"><p class="switch-input-porcentaje" id="promocionp">0.00%</p></td>')
                        .append('<td class="abatible"><p id="promocioni">$ 0.00</p></td>')
                        .append('<td class="abatible"><p class="switch-input-porcentaje" id="descuento1p">0.00%</p></td>')
                        .append('<td class="abatible"><p id="descuento1i">$ 0.00</p></td>')
                        .append('<td class="abatible"><p class="switch-input-porcentaje" id="descuento2p">0.00%</p></td>')
                        .append('<td class="abatible"><p id="descuento2i">$ 0.00</p></td>')
                        .append('<td class="ocultable"><p id="tdescuentos">$ 0.00</p></td>')
                        .append('<td class="moneda" id="importe">$ 0.00</td>')
                        .append('<td class="moneda" id="iva">$ 0.00</td>')
                        .append('<td id="subtotal">$ 0.00</td>')
                        .append('<td class="button-borrar"><a id="' + renglonNo + '"></a></td>'));
                $('.abatible').hide();
                setDynamicInputs();
                // Volver a invocar el plugin Table Sorter:
                $(".tablesorter").tablesorter();
//                // Simular click en cantidad para modificar:
//                $('#cantidad:first').click();
                borrarRenglon();
//                alert(session_id);
                $.post(base_uri + "_controlador/pedidos_controlador.php", {
                    f: 'ajaxSetRenglon',
                    id_producto: $xml.find('id_producto').text(),
                    cantidad: 0,
                    precio: 0,
                    descuento_cliente: 0,
                    descuento_adicional: 0,
                    estatus: 'activo'
                }, function(data) {
//                    alert('productos:');
//                    alert(data);
                });
            }
            
            $('#button-guardar-xml').click(function(){
//                if (event.preventDefault()) event.preventDefault();
                $.post(base_uri + "_controlador/pedidos_controlador.php", {
                    session_id: session_id,
                    f: 'ajaxGuardarPedidoXML',
                    id_producto: $xml.find('id_producto').text()
                });
            })
            // Vista mosaico de producto:
//            var productoMosaico = function($xml, fx) {
//                $('dialog-mensaje').html('<div class="loader"><br /><br /><img src="'+base_uri+'images/loader.gif" alt="Buscando..."><h3>Buscando...</h3><h3>Por favor espere.</h3></div>').dialog({
//                    autoOpen: false,
//                    title: 'Mensaje de confirmación',
//                    modal: true,
//                    draggable: false,
//                    resizable: false,
//                    closeOnEscape: true,
//                    buttons: {
//                        "Agregar": function() {
////                            alert('do');
//                            $('.ocultable').show();
//                            $('.abatible').show();
//                            var valor = $('#cantidad-agregar').val();
//                            fx(valor);
//                            $(this).dialog("close");
//                            $('#input-buscar-productos-linea').focus();
//                            $('#input-buscar-productos-mosaicos').val('');
//                            $('#input-buscar-productos-mosaicos').focus();
////                            return agregar($(this));
//                            return true;
//                        },
//                        "Cancelar": function() {
//                            $(this).dialog("close");
//                            return false;
//                        }
//                    },
//                    open: function(event, ui) {
//                        $(".ui-dialog-titlebar").hide();
////                            $(".ui-dialog-titlebar").hide();
//                    },
//                    beforeClose: function() {
//////                            $(".ui-dialog-titlebar-close", ui.dialog || ui).show();
//                        $(".ui-dialog-titlebar").show();
//                    }
//                });//.dialog('open');
//                function agregar(x) {
//                        var valor = $('#cantidad-agregar').val();
//                        $('.ocultable').show();
//                        $('.abatible').show();
//                        fx(valor);
//                        $(x).dialog("close");
//                        return true;
//                }
                var ventanaCantidad = function($xml) { $('#dialog-mensaje').html($('<div class="loader"></div>')
                        .append($('<div class="loader"></div>')
                        .append('<img src="/images/productos/sencillas/' + $xml.find('id_producto').text() + '_g.jpg" alt="Product Image" width="165px" height="125px">'))
//                        .append($('<div></div>').attr('class', 'product')
//                        .append($('<div></div>').attr('class', 'price').css('width','300')
//                        .append($('<div></div>').attr('class', 'inner')
//                        .append($('<strong><span>$</span>750<sup>.00</sup></strong>'))
//                        .append('<span class="title">Precio + IVA</span>')))
//                        .append($('<div></div>').attr('class', 'info').css('width', '200')
                        .append($('<p>Rack giratorio para palas y bieldos</p>'))
                        .append('<p class="number mosaico-id_producto">Código: 500500</p><br />')
                        .append($('<input id="cantidad-agregar" class="numero" type="number" min="1" value="1">').css('width','50')
                       ));
                }
                var sync = function() {
                    
                }
                //                $('#cantidad-agregar').keypress(function(e){
//                    if (e.which == 13){
//                        var buttons = $dialogProducto.dialog("option", "buttons");
//                        buttons["Agregar"]();
//                        $dialogProducto.dialog("option", "buttons").buttons["Agregar"]();
////                        return agregar($dialogProducto);
////                        alert('close');
////                        $dialogProducto.dialog('close');
//                    }
//                });
//                return $dialogProducto.dialog('open');
//            }
            
//            <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-9 jcarousel-item-9-horizontal" jcarouselindex="9" style="float: left; list-style: none;">
//						<a href="#" title="Product Link"><img src="css/images/product-slide4.jpg" alt="Product Image"></a>
//						<div class="info">
//							<h4>Puma Drift Cat Ferrari</h4>
//							<span class="number">Product 33</span>
//							<span class="price"><span>$</span>119<sup>.99</sup></span>
//							<div class="cl">&nbsp;</div>
//						</div>
//					</li>
            
//            // Vista mosaico de producto:
//            $('#products').append($('<div></div>').attr('class', 'product')
//                    .append($('<a href="#" title="Link"></a>').append('<img src="/images/productos/sencillas/50050_g.jpg" alt="Product Image" width="165px" height="125px">'))
//                    .append($('<div></div>').attr('class', 'price')
//                    .append($('<div></div>').attr('class', 'inner')
//                    .append($('<strong><span>$</span>750<sup>.00</sup></strong>'))
//                    .append('<span class="title">Precio + IVA</span>')))
//                    .append($('<div></div>').attr('class', 'info')
//                    .append($('<p>Rack giratorio para palas y bieldos</p>'))
//                    .append('<p class="number mosaico-id_producto">Código: 50050</p>'))
//                    );
            
//            var agregarRenglon = function(valor) {
//                // Adquiere datos del producto para ponerlos en nuevo renglon de la tabla:
//                $.post(base_uri + "_controlador/productos_controlador.php", {
//                    funcion: 'buscarProductos',
//                    valor: valor
//                }, function(data) {
//                    var xml = data;
//                    if (data == "vacio") {
//                        $('#dialog-mensaje').attr({class: 'dialog', title: 'dialog'}).html("<h3>No hubo resultados:</h3>").dialog('open');
//                    }
//                    else {  
//                        xmlDoc = $.parseXML(xml);
//                        $xml = $(xmlDoc);
//                        $('.ocultable').show();
//                        $('.abatible').show();
//                        var renglonNo = $('.renglones tbody').children('tr').length;
//                        $('.renglones tbody').prepend($('<tr id="' + (++renglonNo) + '"></tr>')
//                                .append('<td id="numero-renglon">' + renglonNo + '.</td>')
//                                .append('<td class="ocultable" id="imagen"><img src="/images/productos/sencillas/' + $xml.find('id_producto').text() + '_g.jpg" width="68" height="63" alt="default thumb" class="thumb"></td>')
//                                .append('<td id="id_producto">' + $xml.find('id_producto').text() + '</td>')
//                                .append('<td id="descripcion">' + $xml.find('descripcion').text() + '</td>')
//                                .append('<td><p class="switch-input-numero" id="cantidad">1</p></td>')
//                                .append('<td><p class="switch-input-moneda" id="pu">$ ' + (parseFloat($xml.find('precio').text()).toFixed(2)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '</p></td>')
//                                .append('<td class="abatible"><p class="switch-input-porcentaje" id="promocionp">0.00%</p></td>')
//                                .append('<td class="abatible"><p id="promocioni">$ 0.00</p></td>')
//                                .append('<td class="abatible"><p class="switch-input-porcentaje" id="descuento1p">0.00%</p></td>')
//                                .append('<td class="abatible"><p id="descuento1i">$ 0.00</p></td>')
//                                .append('<td class="abatible"><p class="switch-input-porcentaje" id="descuento2p">0.00%</p></td>')
//                                .append('<td class="abatible"><p id="descuento2i">$ 0.00</p></td>')
//                                .append('<td class="ocultable"><p id="tdescuentos">$ 0.00</p></td>')
//                                .append('<td class="moneda" id="importe">$ 0.00</td>')
//                                .append('<td class="moneda" id="iva">$ 0.00</td>')
//                                .append('<td id="subtotal">$ 0.00</td>')
//                                .append('<td class="button-borrar"><a id="' + renglonNo + '"></a></td>'));
//                        $('.abatible').hide();
//                        setDynamicInputs();
//                        // Volver a invocar el plugin Table Sorter:
//                        $(".tablesorter").tablesorter();
//                        // Simular click en cantidad para modificar:
//                        $('#cantidad:first').click();
//                        borrarRenglon();
//                    }
//                });
//            }
            
            $('.product').click(function() {
                alert(id_producto);
                var id_producto = $(this).attr('id');
                agregarRenglon(id_producto);
            });
            $('#input-buscar-productos-linea').on("autocompleteselect", function(event, ui) {
//                $('#input-buscar-productos-linea').prop('type', 'text');
//                $(this).val('');
                var id_producto = ui.item.value.substring(0, 5);
                agregarRenglon(id_producto);
                ui.item.value='';
//                var valor = '22606';
//                alert(seleccionado);
//                $('#input-buscar-productos-linea').val(seleccionado);
                });
//                $('.renglones tr:last').after('<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>');
            // Verifica si es dispositivo movil para habilitar ayuda de teclado:
            if (!jQuery.browser.mobile) {
                $('#input-buscar-productos-linea').prop("type", "text");
                $('#input-buscar-productos-mosaicos').prop("type", "text");
                $('.input-type').hide();
            } else {
                // En caso de si ser dispositivo movil, activa ayuda de teclado:
                // Boton para cambiar tipo de entrada (numerica o hexadecimal):
                $('#input-type').checkbox().click(function() {
                    var value = $('#input-type').attr("value");
                    if (value == '123') {
                        $('#input-buscar-productos-linea').prop("type", "text");
                        $('#input-buscar-productos-mosaicos').prop("type", "text");
                        $('#input-type').prop('value', 'abc');
                    }
                    else if (value == 'abc') {
                        $('#input-buscar-productos-linea').prop("type", "number");
                        $('#input-buscar-productos-mosaicos').prop("type", "number");
                        $('#input-type').prop('value', '123');
                    }
                });
            }
            
            // Boton para cambiar tipo de busqueda de productos:
            $('#busqueda-type').checkbox().click(function() {
                var value = $('#busqueda-type').attr("value");
                if (value == 'linea') {
                    $('#input-buscar-productos-linea').hide();
                    $('#button-buscar-productos-linea').hide();
                    $('#input-buscar-productos-mosaicos').show();
                    $('#button-buscar-productos-mosaicos').show().css("width", "60px");
                    $('#busqueda-type').prop('value', 'mosaicos');
                }
                else if (value == 'mosaicos') {
                    $('#input-buscar-productos-mosaicos').hide();
                    $('#button-buscar-productos-mosaicos').hide();
                    $('#input-buscar-productos-linea').show();
                    $('#button-buscar-productos-linea').show().css("width", "60px");
                    $('#busqueda-type').prop('value', 'linea');
                }
            });
            
            // Busqueda de productos como mosaicos en dialog:
            // Funciones para busqueda de productos:
            function buscarProductosMosaico() {
                var search_this = $('#input-buscar-productos-mosaicos').val();
//                event.preventDefault();
                if(event.preventDefault) event.preventDefault();
//                alert(search_this);
                var cliente = $("#codigo-cliente").val();
//                var cliente = '999';
                var tipoRespuesta = '';
                $.post(base_uri + "_vista/productos_vista.php?f=pcMosaicoDescripcion", {searchit: search_this, cliente: cliente, tipoRespuesta: tipoRespuesta}, function(data) {
                    if (data == "null") {
                        // hacer nada.
                        aler('nada');
                    }
                    else {
                        $("#dialog-productos").dialog("option", "height", 570).dialog("option", "width", 820);
                        $("#dialog-productos").dialog("option", "position", {my: "center", at: "center", of: window});
                        $("#productos-encontrados").html(data);
                        $(".product").focus(function() {
                            $(this).effect('highlight');
                        });
                        $('.product').click(function() {
                            var id_producto = $(this).attr('id');
                            agregarRenglon(id_producto);
                            $("#dialog-productos").dialog('close');
                        });
                    }
                });
                $("#dialog-productos").dialog("open");
            }
            // Al dar clic:
            $('#button-buscar-productos-mosaicos').click(buscarProductosMosaico);
//            $('#input-buscar-productos-mosaicos').click(function(){alert('clicked');});
            // Al presionar enter:
            $('#input-buscar-productos-mosaicos').keypress(function(e) {
                if (e.which == 13) {
                    if(event.preventDefault) event.preventDefault();
                    buscarProductosMosaico();
                }
            });
            
//            // Vista mosaico de producto:
//            var productoMosaico = function($xml) {
//                $(this).append($('<div></div>').attr('class', 'product')
//                        .append($('<a href="#" title="Link"></a>').append('<img src="/images/productos/sencillas/' + $xml.find('id_producto').text() + '_g.jpg" alt="Product Image" width="165px" height="125px">'))
//                        .append($('<div></div>').attr('class', 'price')
//                        .append($('<div></div>').attr('class', 'inner')
//                        .append($('<strong><span>$</span>750<sup>.00</sup></strong>'))
//                        .append('<span class="title">Precio + IVA</span>')))
//                        .append($('<div></div>').attr('class', 'info')
//                        .append($('<p>Rack giratorio para palas y bieldos</p>'))
//                        .append('<p class="number mosaico-id_producto">Código: 50050</p>'))
//                        );
//            }

            $('#input-buscar-productos-linea').keypress(function(e) {
                if (e.which == 13) {
                    event.preventDefault();
                    var id_producto = $(this).val();
                    agregarRenglon(id_producto);
                    $(this).val('');
//                    var codigo = $('#input-buscar-productos-linea').val();
//                    alert(codigo);
                }
            });

//////////////////////////////////////////////////////////////////////////////
//                var $myDialog = $('<div></div>')
//                        .html('You are about to start a war.<br/>Click OK to confirm.  Click Cancel to stop this action.')
//                        .dialog({
//                    autoOpen: false,
//                    title: 'Why so serious?',
//                    buttons: {
//                        "OK": function() {
//                            $(this).dialog("close");
////                            window.open('http://google.com/');
//                            alert('WAR!!!');
//                            return true;
//                        },
//                        "Cancel": function() {
//                            $(this).dialog("close");
//                            return false;
//                        }
//                    }
//                });
//
//                $('#myOpener').click(function() {
//                    event.preventDefault();
//                    return $myDialog.dialog('open'); //replace the div id with the id of the button/form
//                });
//                
////////////////////////////////////////////////////////////////////////////////////

            switchInput: {
                //Include del Table-Sort:
//                $.getScript(base_uri + "js/table-sort/jquery-latest.js");
                $.getScript(base_uri + "js/table-sort/jquery.tablesorter.js").done(function() {
//                    $(".tablesorter").tablesorter();
                });

                // Funcion Input Switch que permite el cambio entre input-texto de un elemento de texto dado:
                function inputSwitch(tdClass, inputClass, inputType, mobile) {
                    //                    foldClass = foldClass || '';
                    mobile = true || false;
                    $('.' + tdClass).css('font-weight', 'bold').css('color', 'blue');
                    //                     // Deteccion de Explorador Movil o PC:
                    //                    (function(a) {(jQuery.browser = jQuery.browser || {}).mobile = /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))})(navigator.userAgent || navigator.vendor || window.opera);
                    if (mobile && jQuery.browser.mobile) {
                        inputType = 'number" step="any" min="1';
                    }
                    else if (inputType == 'number') {
                        inputType = 'number" step="any" min="1';
                    }
                    // Funcion para convertir a Input
                    var toText = function() {
                        $('.' + inputClass).focusout(function() {
                            var className = $(this).attr('class');
//                                className = className.replace(tdClass,'');
                            var idName = $(this).attr('id');
                            $(this).prop('type', 'text');
                            if (tdClass == 'switch-input-porcentaje')
                                porcentualizar();
                            else if (tdClass == 'switch-input-moneda')
                                monetizar();
                            var value = $(this).val();
                            $(this).replaceWith('<p class="' + className + '" id="' + idName + '">' + value + '</p>');
                            $('.' + tdClass).css('font-weight', 'bold').css('color', 'blue');
                            calcular();
                            toInput();
                        });
                    }
                    // Funcion para convertir a Input
                    var toInput = function() {
                        $('.' + tdClass).click(function() {
                            var className = $(this).attr('class');
                            //                            alert(className);
                            className = className.replace(tdClass, '');
                            var idName = $(this).attr('id');
                            //                            if (className.indexOf(foldClass) <= 0) {
                            //                                foldClass = '';
                            //                            }
                            var value = $(this).text();
                            if (tdClass == 'switch-input-porcentaje') {
                                value = value.replace('%', '').replace(',', '');
                            }
                            else if (tdClass == 'switch-input-moneda') {
                                value = value.substr(2);
                                value = value.replace('$ ', '').replace(',', '');
                            }
                            $(this).replaceWith('<input type="' + inputType + '"value="' + value + '" class="' + tdClass + ' ' + className + ' ' + inputClass + '" id="' + idName + '">');
                            $('.' + inputClass).keypress(function(e) {
                                if (e.which == 13) {
                                    event.preventDefault();
                                    $(this).focusout();
                                }
                            });
                            if (tdClass == 'switch-input-porcentaje' && !jQuery.browser.mobile)
                                porcentualizar();
                            else if (tdClass == 'switch-input-moneda' && !jQuery.browser.mobile)
                                monetizar();
                            $('.' + inputClass).focus();
                            $('.' + inputClass).select();
                            toText();
                        });
                    }
                    // Requiere el plugin de price-format
                    $.getScript(base_uri + "js/price-format/jquery.price_format.js").done(monetizar);
                    // Funcion para convertir en moneda:
                    var monetizar = function() {
                        $('.' + inputClass).priceFormat({
                            //                            $('.moneda').priceFormat({
                            allowNegative: false,
                            prefix: '$ ',
                            thousandsSeparator: ',',
                            centsLimit: 2
                        })
                    }
                    // Funcion para convertir en porcentaje:
                    var porcentualizar = function() {
                        $('.' + inputClass).priceFormat({
                            //                            $('.cantidad').priceFormat({
                            allowNegative: false,
                            prefix: '',
                            suffix: '%',
                            centsLimit: 2
                        })
                    }
                    var numberWithCommas = function(x) {
                        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                    var calcular = function() {
                        //                        $('.renglones > tbody  > tr').each(function (){
                        ////                                $this = $(this);
                        //                            alert($(this).attr('id'));
                        //                        })
                        var subtotalGlobal = 0;
                        $('.renglones tbody').find('tr').each(function() {
                            var cantidad = $(this).find('#cantidad').text();
                            //                            alert('cantidad: ' + cantidad);
                            var pu = $(this).find('#pu').text().replace('$ ', '').replace(',', '');
                            //                            pu = pu.replace('$ ','');
                            //                            alert('pu: ' + pu);
                            var promocionp = $(this).find('#promocionp').text().replace('%', '').replace(',', '');
                            var descuento1p = $(this).find('#descuento1p').text().replace('%', '').replace(',', '');
                            //                            alert('descuento 1: ' + promocionp);
                            var descuento2p = $(this).find('#descuento2p').text().replace('%', '').replace(',', '');
                            var importe = (cantidad * pu);
                            var promocioni = promocionp * 0.01 * importe;
                            importe -= promocioni;
                            var descuento1i = descuento1p * 0.01 * importe;
                            importe -= descuento1i;
                            var descuento2i = descuento2p * 0.01 * importe;
                            importe -= descuento2i;
                            var tdescuentos = descuento1i + descuento2i + promocioni;
                            var iva = importe * 0.16;
                            var subtotal = importe + iva;
                            //                            alert('subtotal: ' + subtotal.toFixed(2));

                            $(this).find('#promocioni').text('$ ' + numberWithCommas(promocioni.toFixed(2)));
                            $(this).find('#descuento1i').text('$ ' + numberWithCommas(descuento1i.toFixed(2)));
                            $(this).find('#descuento2i').text('$ ' + numberWithCommas(descuento2i.toFixed(2)));
                            $(this).find('#tdescuentos').text('$ ' + numberWithCommas(tdescuentos.toFixed(2)));
                            $(this).find('#importe').text('$ ' + numberWithCommas(importe.toFixed(2)));
                            $(this).find('#iva').text('$ ' + numberWithCommas(iva.toFixed(2)));
                            $(this).find('#subtotal').text('$ ' + numberWithCommas(subtotal.toFixed(2)));
                            subtotalGlobal += importe;
                        });
                        $('.totales').find('#subtotal').text('$ ' + numberWithCommas( (subtotalGlobal).toFixed(2) ) );
                        $('.totales').find('#iva').text('$ ' + numberWithCommas( (subtotalGlobal * 0.16).toFixed(2) ) );
                        $('.totales').find('#total').text('$ ' + numberWithCommas( (subtotalGlobal * 1.16).toFixed(2) ) );
                    }
                    calcular();
                    toText();
                    toInput();
                    }
            
                // Asignación de campos dinamicos de captura y edicion:
                function setDynamicInputs() {
                    $(inputSwitch('switch-input-numero', 'cantidad', 'number'));
                    $(inputSwitch('switch-input-moneda', 'importe', 'text', true));
                    $(inputSwitch('switch-input-porcentaje', 'cantidad', 'text', true));
                }

                    // Funcion para mostrar/ocultar columnas en tabla:
                    $('.abatible').hide();
                    $('#check-detalle').checkbox().click(function() {
//                    $('.renglones th').click(function switchTabla() {
                        var display = $('.abatible').css('display');
        //                alert(displayed);
                        if (display != 'none') {
                            $('.descripciones').css('width', '200');
        //                    $('.imagenes').show();
                            $('.abatible').hide();
                            $('.ocultable').show();
        //                cantidadAInput();
        //                porcentajeAInput();
                        }
                        else {
                            $('.descripciones').css('width', '80');
        //                    $('.imagenes').hide();
                            $('.ocultable').hide();
                            $('.abatible').show();
                        }
                    });
                           
                    }

                }

        }
    
//    $('#zaz').click(function() {
//        $("#list2").trigger("reloadGrid");
//        alert(event.target.nodeName);
//    });

    step_3_notas: {
        variables: {
        }
        configuraciones: {
        }
        funciones: {
        }
    }

    step_3_notas: {
        variables: {
        }
        configuraciones: {
        }
        funciones: {
        }
    }
});