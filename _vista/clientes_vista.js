/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
vista_cliente_elemento: {
    variables: {
        // Import de Google Maps plugin:
        $.getScript(base_uri + "js/googlemaps.js");
        // Variables para Google Maps:
        var clienteX = 0, clienteY = 0, clienteZoom = 5;
    }
    configuraciones: {
        $("#telefono1").mask("(999)-999-9999");
        $("#telefono2").mask("(999)-999-9999");
        $(".jw-button-next").attr("disabled", "disabled").removeClass("ui-state-hover").addClass("ui-state-disabled");
        // input de codigo de cliente:
        $("#codigo-cliente").css("width", "80px");
        // Boton abrir lista de clientes
        $("#abrir-lista-clientes").css("padding", "3px");
//            $('#datepicker').datepicker();
        $("#dialog-listado-clientes").dialog({
            autoOpen: false
        });
    }
    funciones: {
        $("#abrir-lista-clientes").button().click(function() {
            event.preventDefault();
            $("#dialog").dialog("open");
//        $.getScript(base_uri + "_vista/enlistar.js");
        });
        $("#codigo-cliente").focus().keyup(function(event) {
            event.preventDefault();
            search_ajax_way();
        });
        function search_ajax_way() {
            var search_this = $("#codigo-cliente").val();
            $.post(base_uri + "busqueda.php?t=clientes", {searchit: search_this, tipo: "="}, function(data) {
                var xml = data;
                if (data == "null") {
                    $(".jw-button-next").attr("disabled", "disabled").removeClass("ui-state-hover").addClass("ui-state-disabled");
                    $("#nombre").val("");
                    $("#calle").val("");
                    $("#numero").val("");
                    $("#colonia").val("");
                    $("#cp").val("");
                    $("#localidad").val("");
                    $("#ciudad").val("");
                    $("#estado").val("");
                    $("#descuento").val("");
//                $("#x").val("");
//                $("#y").val("");
                    $("#email1").val("");
                    $("#email2").val("");
                    $("#telefono1").val("");
                    $("#telefono2").val("");
                    clienteX = 28.662613;
                    clienteY = -106.102889;
                    initialize();
                }
                else {
                    $(".jw-button-next").removeAttr('disabled').removeClass("ui-state-disabled");
                    xmlDoc = $.parseXML(xml);
                    $xml = $(xmlDoc);
//                $nombre = $xml.find('nombre');
                    $direccion = $xml.find('direccion_fiscal').find('direccion_fiscal').find('direccion');
//                    $calle = $direccion.find('calle');
//                    $numero = $direccion.find('numero');
//                    $colonia = $direccion.find('colonia');
//                    $cp = $direccion.find('cp');
//                    $localidad = $direccion.find('localidad');
//                    $ciudad = $direccion.find('ciudad');
//                    $estado = $direccion.find('estado');
//                    $clienteX = $direccion.find('x');
//                    $clienteY = $direccion.find('y');
//                    $email1 = $xml.find('email1');
//                    $email2 = $xml.find('email2');
//                    $telefono1 = $xml.find('telefono1');
//                    $telefono2 = $xml.find('telefono2');
                    $("#nombre").val($xml.find('apellido_p').text() + ' ' + $xml.find('apellido_m').text() + ' ' + $xml.find('nombre').text());
                    $("#calle").val($direccion.find('calle').text());
                    $("#numero").val($direccion.find('numero').text());
                    $("#colonia").val($direccion.find('colonia').text());
                    $("#cp").val($direccion.find('cp').text());
                    $("#localidad").val($direccion.find('localidad').text());
                    $("#ciudad").val($direccion.find('ciudad').text());
                    $("#estado").val($direccion.find('estado').text());
                    $("#descuento").val($xml.find('descuento').text());
//                $("#x").val($clienteX.text());
//                $("#y").val($clienteY.text());
                    $("#email1").val($xml.find('email1').text());
                    $("#email2").val($xml.find('email2').text());
                    $("#telefono1").val($xml.find('telefono1').text());
                    $("#telefono2").val($xml.find('telefono2').text());
                    clienteX = $direccion.find('x').text();
                    clienteY = $direccion.find('y').text();
                    initialize();
                }
            });
        }
    }
}