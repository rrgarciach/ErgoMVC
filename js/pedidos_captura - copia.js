// Parametros y configuraciones generales:
generales : {
    if (!window.location.origin)
        window.location.origin = window.location.protocol + "//" + window.location.host;
    var base_uri = window.location.origin;
    var x = 0, y = 0;
}
$(document).ready(function() {
    $.getScript("js/googlemaps.js");
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
    $(".jw-button-next").attr("disabled", "disabled").removeClass("ui-state-hover").addClass("ui-state-disabled");
    $("#codigo-cliente").css("width", "80px");
    $("#button_find").css("padding", "3px");
    $("#nombre").prop("disabled", true);
    $("#calle").prop("disabled", true);
    $("#numero").prop("disabled", true);
    $("#colonia").prop("disabled", true);
    $("#cp").prop("disabled", true);
    $("#localidad").prop("disabled", true);
    $("#ciudad").prop("disabled", true);
    $("#estado").prop("disabled", true);
    $("#x").prop("disabled", true);
    $("#y").prop("disabled", true);
    $("#telefono1").prop("disabled", true);
    $("#telefono1").mask("999-999-9999");
    $("#telefono2").prop("disabled", true);
    $("#telefono2").mask("999-999-9999");
    $("#email1").prop("disabled", true);
    $("#email2").prop("disabled", true);
    $('#datepicker').datepicker();

//    $("#search_results").slideUp();
    $("#dialog-cliente-valido").dialog({
        autoOpen: false
    });
    $("#dialog").dialog({
        autoOpen: false
    });
    var htmlBusqueda = '<div class="loader"><br /><br /><img src="images/loader.gif" alt="Buscando..."><h3>Buscando...</h3><h3>Por favor espere.</h3></div>';
    $("#productos-encontrados").html(htmlBusqueda);
    $("#dialog-productos").dialog({
        autoOpen: false,
        modal: true,
        height: 285,
        width: 410,
        resizable: false
//        minWidth: 820,
//        maxWidth: 820,
//        minHeight: 250,
//        maxHeight: 600
    }).on("dialogbeforeclose", function(event, ui) {
        $("#productos-encontrados").html(htmlBusqueda);
        $("#dialog-productos").dialog("option", "height", 285).dialog("option", "width", 410).dialog("option", "width", 410);
        $("#dialog-productos").dialog("option", "position", {my: "center", at: "center", of: window});
    });
    $(':button').button();
    $('.leyenda').css("font-size", "11px");
    $('#button-buscar-productos-mosaicos').css("padding", "4px").css("margin", "0px").css("font-size", "0.9em");
    $('#button-buscar-productos-linea').css("padding", "4px").css("margin", "0px").css("font-size", "0.9em");
    $('#button-buscar-productos-mosaicos').click(buscarProductosMosaico);
    $('#input-buscar-productos-mosaicos').keypress(function(e) {
        if (e.which == 13) {
            buscarProductosMosaico();
        }
    });
    // Funciones para busqueda de productos:
    var buscarProductosMosaico = function() {
        event.preventDefault();
//        $("#dialog-productos").dialog("open");
        var search_this = $('#input-buscar-productos-mosaicos').val();
        var cliente = $("#codigo-cliente").val();
        $.post(base_uri + "/_vista/productos_vista.php?f=pcMosaicoDescripcion", {searchit: search_this, cliente: cliente}, function(data) {
//        alert('hola00');
//            var xml = data;
            if (data == "null") {

                // hacer nada.
            }
            else {
                $("#dialog-productos").dialog("option", "height", 570).dialog("option", "width", 820);
                $("#dialog-productos").dialog("option", "position", {my: "center", at: "center", of: window});
                $("#productos-encontrados").html(data);
            }
        });
        $("#dialog-productos").dialog("open");
    }
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
    // Boton para cambiar tipo de busqueda de productos:
    $('#input-buscar-productos-mosaicos').hide();
    $('#button-buscar-productos-mosaicos').hide();
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

    $("#button_find").button().click(function() {
        event.preventDefault();
        $("#dialog").dialog("open");
        $.getScript("_vista/enlistar.js");
    });
//    $("#button_find").click(function(event) {
//        event.preventDefault();
//        search_ajax_way();
//    });
    $("#codigo-cliente").focus().keyup(function(event) {
        event.preventDefault();
        search_ajax_way();
    });

    function search_ajax_way() {
//        $("#search_results").show();
        var search_this = $("#codigo-cliente").val();
        $.post("busqueda.php?t=clientes", {searchit: search_this, tipo: "="}, function(data) {
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
                $("#x").val("");
                $("#y").val("");
                $("#email1").val("");
                $("#email2").val("");
                $("#telefono1").val("");
                $("#telefono2").val("");
                x = 28.662613;
                y = -106.102889;
                initialize();
            }
            else {
                $(".jw-button-next").removeAttr('disabled').removeClass("ui-state-disabled");
                xmlDoc = $.parseXML(xml);
                $xml = $(xmlDoc);
                //$xml = $( xml ),
                $nombre = $xml.find('nombre');
                $direccion = $xml.find('direccion_fiscal').find('direccion_fiscal').find('direccion');
                $calle = $direccion.find('calle');
                $numero = $direccion.find('numero');
                $colonia = $direccion.find('colonia');
                $cp = $direccion.find('cp');
                $localidad = $direccion.find('localidad');
                $ciudad = $direccion.find('ciudad');
                $estado = $direccion.find('estado');
                $x = $direccion.find('x');
                $y = $direccion.find('y');
                $email1 = $xml.find('email1');
                $email2 = $xml.find('email2');
                $telefono1 = $xml.find('telefono1');
                $telefono2 = $xml.find('telefono2');
//                google.maps.event.addDomListener(window, 'load', initialize);

                //            $("#resultados").html(data);
                //            $("#display_results").html(data);
                $("#nombre").val($nombre.text());
                $("#calle").val($calle.text());
                $("#numero").val($numero.text());
                $("#colonia").val($colonia.text());
                $("#cp").val($cp.text());
                $("#localidad").val($localidad.text());
                $("#ciudad").val($ciudad.text());
                $("#estado").val($estado.text());
                $("#x").val($x.text());
                $("#y").val($y.text());
                x = $x.text();
                y = $y.text();
                initialize();
                $("#email1").val($email1.text());
                $("#email2").val($email2.text());
                $("#telefono1").val($telefono1.text());
                $("#telefono2").val($telefono2.text());
            }
        });
    }

    function buscar_productos() {
        var search_this = $("#buscar-producto").val();
        $.post("busqueda.php?t=productos", {searchit: search_this, tipo: "="}, function(data) {
            var xml = data;
            if (data == "null") {
                $("#nombre").val("");
                $("#calle").val("");
                $("#numero").val("");
                $("#colonia").val("");
                $("#cp").val("");
                $("#localidad").val("");
                $("#ciudad").val("");
                $("#estado").val("");
                $("#x").val("");
                $("#y").val("");
                $("#email1").val("");
                $("#email2").val("");
                $("#telefono1").val("");
                $("#telefono2").val("");
                x = 28.662613;
                y = -106.102889;
                initialize();
            }
            else {
                xmlDoc = $.parseXML(xml),
                        $xml = $(xmlDoc),
                        //$xml = $( xml ),
                        $nombre = $xml.find('nombre');
                $direccion = $xml.find('direccion_fiscal').find('direccion_fiscal').find('direccion');
                $calle = $direccion.find('calle');
                $numero = $direccion.find('numero');
                $colonia = $direccion.find('colonia');
                $cp = $direccion.find('cp');
                $localidad = $direccion.find('localidad');
                $ciudad = $direccion.find('ciudad');
                $estado = $direccion.find('estado');
                $x = $direccion.find('x');
                $y = $direccion.find('y');
                $email1 = $xml.find('email1');
                $email2 = $xml.find('email2');
                $telefono1 = $xml.find('telefono1');
                $telefono2 = $xml.find('telefono2');
//                google.maps.event.addDomListener(window, 'load', initialize);

                //            $("#resultados").html(data);
                //            $("#display_results").html(data);
                $("#nombre").val($nombre.text());
                $("#calle").val($calle.text());
                $("#numero").val($numero.text());
                $("#colonia").val($colonia.text());
                $("#cp").val($cp.text());
                $("#localidad").val($localidad.text());
                $("#ciudad").val($ciudad.text());
                $("#estado").val($estado.text());
                $("#x").val($x.text());
                $("#y").val($y.text());
                x = $x.text();
                y = $y.text();
                initialize();
                $("#email1").val($email1.text());
                $("#email2").val($email2.text());
                $("#telefono1").val($telefono1.text());
                $("#telefono2").val($telefono2.text());
            }
        });
    }
});