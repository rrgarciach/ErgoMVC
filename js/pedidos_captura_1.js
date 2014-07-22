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
    }

    step_1_cliente: {
        // Carga del HTML:
        $('#vista-cliente-elemento').load(base_uri + '_vista/clientes_vista.html #vista-cliente-elemento');
        // Carga del JQuery:
        $.getScript(base_uri + '_vista/clientes_vista.js');
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
                height: 285,
                width: 410,
                resizable: false
            }).on("dialogbeforeclose", function(event, ui) {
                $("#productos-encontrados").html(htmlBusqueda);
                $("#dialog-productos").dialog("option", "height", 285).dialog("option", "width", 410).dialog("option", "width", 410);
                $("#dialog-productos").dialog("option", "position", {my: "center", at: "center", of: window});
            });
        }
        funciones: {
            // Autocomplete de productos:
            // Import del catalogo:
            $.getScript(base_uri + "js/catalogo.js").done(function() {
                $('#input-buscar-productos-linea').autocomplete({minLength: 2}, {
                    source: catalogo
                });
            });
            
            // Verifica si es dispositivo movil para habilitar ayuda de teclado:
            if (!jQuery.browser.mobile) {
                $('#input-buscar-productos-linea').prop("type", "text");
                $('#input-buscar-productos-mosaicos').prop("type", "text");
                $('.input-type').hide();
            } else {
                // En caso de si ser dispositivo movil, activa ayuda de teclad:
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
                event.preventDefault();
                var search_this = $('#input-buscar-productos-mosaicos').val();
//                alert(search_this);
//                var cliente = $("#codigo-cliente").val();
                var cliente = '999';
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
                    event.preventDefault();
                    buscarProductosMosaico();
                }
            });
            
            // Funcion al seleccionar un producto con autocomplete:
            $('#input-buscar-productos-linea').on("autocompleteselect", function(event, ui) {
//                $('#input-buscar-productos-linea').prop('type', 'text');
//                var seleccionado = ui.item.value.substring(0, 5);
//                alert(seleccionado);
//                $('#input-buscar-productos-linea').val(seleccionado);
                $('.renglones tr:last').after('<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>');
            });

            $('#input-buscar-productos-linea').keypress(function(e) {
                if (e.which == 13) {
                    event.preventDefault();
//                    var codigo = $('#input-buscar-productos-linea').val();
//                    alert(codigo);
                }
            });

//            $.getScript(base_uri + "js/list-grid/list-grid.js");
//            $('head').append('<link rel="stylesheet" href="' + base_uri + 'js/list-grid/list-grid.css" type="text/css" />');
//
//            $('#products').append(
//                    $('<li>').attr('class','clearfix').attr('id','999')
//                        .append( $('<h3>').attr('id','number').text('1.') )
//                        .append( $('<section>').attr('class','left')
//                            .append( $('<img>').attr('src','/images/productos/sencillas/22606_g.jpg').attr('width','68').attr('height','63').attr('alt','vista').attr('class','thumb') )
//                            .append( $('<h3>').text('22606') )
//                            .append( $('<span>').attr('class','meta').text('Pinza pesada de electricista 8", pretul') )
//                        )
//                        .append( $('<section>').attr('class','right')
//                            .append( $('<input>').attr('class','cantidad').attr('id','cantidad').attr('type','text').val('1') )
//                            .append( $('<input>').attr('class','moneda').attr('id','precio').attr('type','text').val('58.00') )
//                            .append( $('<input>').attr('class','moneda').attr('id','desc1').attr('type','text').val('0.00') )
//                            .append( $('<input>').attr('class','moneda').attr('id','desc2').attr('type','text').val('0.00') )
//                            .append( $('<input>').attr('class','moneda').attr('id','promo').attr('type','text').val('0.00') )
//                            .append( $('<span>').attr('class','moneda').attr('id','stl').text('stl:' + '$58.00') )
//                            .append( $('<span>').attr('class','moneda').attr('id','iva').text('iva:' + '$58.00') )
//                            .append( $('<span>').attr('class','darkview') )
//                        )
//                    );
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
//            // Requiere el plugin de price-format
//            $.getScript(base_uri + "js/price-format/jquery.price_format.js").done(monetizar);
//            // Funcion para convertir en moneda:
//            var monetizar = function() {
////                $('.' + inputClass).priceFormat({
//                $('.moneda').priceFormat({
//                    allowNegative: false,
//                    prefix: '$ ',
//                    thousandsSeparator: ',',
//                    centsLimit: 2
//                })
//            }
//            // Funcion para convertir en porcentaje:
//            var porcentualizar = function() {
////                $('.' + inputClass).priceFormat({
//                $('.cantidad').priceFormat({
//                    allowNegative: false,
//                    prefix: '',
//                    suffix: '%',
//                    centsLimit: 2
//                })
//            }

            switchInput: {
                //Include del Table-Sort:
//                $.getScript(base_uri + "js/table-sort/jquery-latest.js");
                $.getScript(base_uri + "js/table-sort/jquery.tablesorter.js").done(function() {
                    $(".tablesorter").tablesorter();
                });
                
                // Funcion Input Switch que permite el cambio entre input-texto de un elemento de texto dado:
                function inputSwitch(tdClass, inputClass, inputType, mobile) {
    //                    foldClass = foldClass || '';
                        mobile = true || false;
                        $('.' + tdClass).css('font-weight', 'bold').css('color', 'blue');
    //                     // Deteccion de Explorador Movil o PC:
    //                    (function(a) {(jQuery.browser = jQuery.browser || {}).mobile = /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))})(navigator.userAgent || navigator.vendor || window.opera);
                        if (mobile && jQuery.browser.mobile) {
                            inputType = 'number" step="any';
                        }
                        // Funcion para convertir a Input
                        var toText = function() {
                            $('.' + inputClass).focusout(function() {
                                var className = $(this).parent().attr('class');
                                className = className.replace(tdClass,'');
                                var idName = $(this).parent().attr('id');
                                $(this).prop('type', 'text');
                                if (tdClass == 'switch-input-porcentaje') porcentualizar();
                                else if (tdClass == 'switch-input-moneda') monetizar();
                                var value = $(this).val();
                                $(this).parent().replaceWith('<td class="' + className + ' ' + tdClass + '" id="' + idName + '">' + value + '</td>');
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
                                className = className.replace(tdClass,'');
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
                                $(this).replaceWith('<td class="' + className + ' ' + tdClass + '" id="' + idName + '"><input type="' + inputType + '"value="' + value + '" class="' + className + ' ' + inputClass + '"></td>');
                                $('.' + inputClass).keypress(function(e) {
                                    if (e.which == 13) {
                                        event.preventDefault();
                                        $(this).focusout();
                                    }
                                });
                                if (tdClass == 'switch-input-porcentaje' && !jQuery.browser.mobile) porcentualizar();
                                else if (tdClass == 'switch-input-moneda' && !jQuery.browser.mobile) monetizar();
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
                                function numberWithCommas(x) {
                                    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                }
                                $(this).find('#promocioni').text('$ ' + numberWithCommas(promocioni.toFixed(2)));
                                $(this).find('#descuento1i').text('$ ' + numberWithCommas(descuento1i.toFixed(2)));
                                $(this).find('#descuento2i').text('$ ' + numberWithCommas(descuento2i.toFixed(2)));
                                $(this).find('#tdescuentos').text('$ ' + numberWithCommas(tdescuentos.toFixed(2)));
                                $(this).find('#importe').text('$ ' + numberWithCommas(importe.toFixed(2)));
                                $(this).find('#iva').text('$ ' + numberWithCommas(iva.toFixed(2)));
                                $(this).find('#subtotal').text('$ ' + numberWithCommas(subtotal.toFixed(2)));
                                subtotalGlobal += importe;
                            });
                            $('.totales').find('#subtotal').text('$ ' +  (subtotalGlobal).toFixed(2) );
                            $('.totales').find('#iva').text('$ ' +  (subtotalGlobal * 0.16).toFixed(2) );
                            $('.totales').find('#total').text('$ ' +  (subtotalGlobal * 1.16).toFixed(2) );
                        }
                        calcular();
                        toText();
                        toInput();
                    }
            
                    // Asignación de campos dinamicos de captura y edicion:
                    $(inputSwitch('switch-input-numero', 'cantidad', 'number'));
                    $(inputSwitch('switch-input-moneda', 'importe', 'text', true));
                    $(inputSwitch('switch-input-porcentaje', 'cantidad', 'text', true));

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
                            $('.descripciones').css('width', '100');
        //                    $('.imagenes').hide();
                            $('.ocultable').hide();
                            $('.abatible').show();
                        }
                    });
            
//            $('.maximizar').click(function() {
//                $(':th.renglones').click();
//            // Deteccion de Explorador Movil o PC:
//            (function(a) {(jQuery.browser = jQuery.browser || {}).mobile = /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))})(navigator.userAgent || navigator.vendor || window.opera);
//            
//            if (jQuery.browser.mobile) {
//                    $(inputSwitch('moneda', 'importe', 'number', 'descuentos'));
//                    $(inputSwitch('porcentaje', 'cantidad', 'number', 'descuentos'));
////                    convertirAInputMovil();
////                    convertirATextoMovil();
//                }
//                else if (!jQuery.browser.mobile) {
//                    $(inputSwitch('moneda', 'importe', 'text', 'descuentos'));
//                    $(inputSwitch('porcentaje', 'cantidad', 'text', 'descuentos'));
////                    convertirAInputPC();
////                    convertirATextoPC();
//                }
                
//            var cantidadAInput = function() {
//                $('.cantidad').focusout(function() {
//                    $(this).prop('type', 'text');
//                    var value = $(this).val();
//                    $(this).parent().replaceWith('<td class="numero descuentos">' + value + '</td>');
////                alert('funciona focusout');
//                    cantidadAText();
//                });
//            }
//            var cantidadAText = function() {
//                $('.numero').click(function() {
//                    var value = $(this).text();
////                var value = $(this).parent().text();
////                alert(value);
//                    $(this).replaceWith('<td class="numero descuentos"><input type="number" value="' + value + '" class="cantidad"></td>');
////                monetizar();
//                    $('.cantidad').focus();
//                    cantidadAInput();
////                var tag = $(this).parent().html();
////                $(this).parent().html( tag.replace('parametro','input type="text"') );
////                $(this).prop('value','12');
//                });
//            }
//            var porcentajeAInput = function() {
//                $('.cantidad').focusout(function() {
//                    $(this).prop('type', 'text');
//                    
//                    var value = $(this).val();
//                    $(this).parent().replaceWith('<td class="porcentaje descuentos">' + value + '</td>');
////                alert('funciona focusout');
//                    porcentajeAText();
//                });
//            }
//            var porcentajeAText = function() {
//                $('.porcentaje').click(function() {
////                    var value = $(this).text();
//                    var value = $(this).text();
//                    var value = value.replace('%', '');
////                var value = $(this).parent().text();
////                alert(value);
//                    $(this).replaceWith('<td class="porcentaje descuentos"><input type="text" value="' + value + '" class="cantidad"></td>');
//                    porcentualizar();
//                    $('.cantidad').focus();
//                    porcentajeAInput();
////                var tag = $(this).parent().html();
////                $(this).parent().html( tag.replace('parametro','input type="text"') );
////                $(this).prop('value','12');
//                });
//            }
            
//            cantidadAInput();
//            cantidadAText();
//            porcentajeAInput();
//            porcentajeAText();

                
                

                // Vista para Movil:
//                function convertirATextoMovil() {
//                    $('.importe').focusout(function() {
//                        $(this).prop('type', 'text');
//                        monetizar();
//                        var value = $(this).val();
//                        $(this).parent().replaceWith('<td class="moneda descuentos">' + value + '</td>');
////                alert('funciona focusout');
//                        convertirAInputMovil();
//                    });
//                }
//                function convertirAInputMovil() {
//                    $('.moneda').click(function() {
//                        var value = $(this).text().substr(2);
//                        var value = value.replace(',', '');
////                var value = $(this).parent().text();
////                alert(value);
//                        $(this).replaceWith('<td class="moneda descuentos"><input type="number" value="' + value + '" class="importe"></td>');
////                monetizar();
//                        $('.importe').focus();
//                        convertirATextoMovil();
////                var tag = $(this).parent().html();
////                $(this).parent().html( tag.replace('parametro','input type="text"') );
////                $(this).prop('value','12');
//                    });
//                }

//                // Vista para PC:
//                function convertirATextoPC() {
//                    $('.edit').focusout(function() {
//                        var value = $(this).val();
//                        $(this).parent().replaceWith('<td class="moneda descuentos">' + value + '</td>');
////                alert('funciona focusout');
//                        convertirAInputPC();
//                    });
//                }
//                function convertirAInputPC() {
//                    $('.moneda').click(function() {
//                        var value = $(this).text().substr(2);
//                        var value = value.replace(',', '');
////                var value = $(this).parent().text();
////                alert(value);
//                        $(this).replaceWith('<td class="moneda descuentos"><input type="text" value="' + value + '" class="edit"></td>');
//                        monetizar();
//                        $('.edit').focus();
//                        convertirATextoPC();
////                var tag = $(this).parent().html();
////                $(this).parent().html( tag.replace('parametro','input type="text"') );
////                $(this).prop('value','12');
//                    });
//                }

                
                    }



                }

//            $.post(base_uri + "js/keyboard/jquery.keyboard.js");
//            $('head').append('<link rel="stylesheet" href="' + base_uri + 'js/keyboard/keyboard.css" type="text/css" />');
//            $('#input-buscar-productos-linea').on('focus', function() {
//                $('#input-buscar-productos-linea').keyboard({layout: "num"});
//            });


//            $.getScript(base_uri + 'js/jqgrid/grid.locale-es.js');
//            $.getScript(base_uri + 'js/jqgrid/jquery.jqGrid.src.js');
//            var lastsel;
//            $.getScript(base_uri + 'js/jqgrid/jquery.jqGrid.min.js').done(function() {
//                jQuery("#list2").jqGrid({
//                    url: base_uri + 'php/server.php?q=2',
//                    datatype: "json",
//                    colNames: ['Inv No', 'Date', 'Client', 'Amount', 'Tax', 'Total', 'Notes'],
//                    colModel: [
//                        {name: 'id', index: 'id', width: 55},
//                        {name: 'invdate', index: 'invdate', width: 90, editable: true},
//                        {name: 'name', index: 'name', width: 100, editable: true},
//                        {name: 'amount', index: 'amount', width: 80, align: "right", editable: true},
//                        {name: 'tax', index: 'tax', width: 80, align: "right", editable: true},
//                        {name: 'total', index: 'total', width: 80, align: "right", editable: true},
//                        {name: 'note', index: 'note', width: 150, sortable: false, editable: true}
//                    ],
//                    rowNum: 10,
//                    rowList: [10, 20, 30],
//                    pager: '#pager2',
//                    sortname: 'id',
//                    viewrecords: true,
//                    sortorder: "desc",
//                    onSelectRow: function(id) {
//                        if (id && id !== lastsel) {
//                            jQuery('#list2').jqGrid('restoreRow', lastsel);
//                            jQuery('#list2').jqGrid('editRow', id, true);
//                            lastsel = id;
//                        }
//                    },
//                    editurl: base_uri + "php/server.php",
//                    caption: "Using events example"
//                });
//                jQuery("#list2").jqGrid('navGrid', "#pager2", {edit: false, add: false, del: false});
//            });


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