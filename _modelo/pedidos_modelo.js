var Pedidos = {
    Initialize: function (private) {
        
    },
    Private: {
        id_cliente: null,
        direccion_envio: new Array(),
        renglones: new Array(),
        id_vendedor: null,
        fecha: null,
        estatus: null,
        estatus_cobranza: null,
        saldo: 0,
        metodo_pago: null,
        referencia_pago: null,
        notas: null
    },
    Public: {
        setId_cliente: function (private, id_cliente) {
            private.id_cliente = id_cliente;
        },
        getId_cliente: function (private) {
            return private.id_cliente;
        },
        setDireccion_envio: function (private, direccion_envio) {
            private.direccion_envio = direccion_envio;
        },
        getDireccion_envio: function (private) {
            return private.direccion_envio;
        },
        setRenglones: function (private, renglones) {
            private.renglones = renglones;
        },
        getRenglones: function (private) {
            return private.renglones;
        },
        setId_vendedor: function (private, id_vendedor) {
            private.id_vendedor = id_vendedor;
        },
        getId_vendedor: function (private) {
            return private.id_vendedor;
        },
        setFecha: function (private, fecha) {
            private.fecha = fecha;
        },
        getFecha: function (private) {
            return private.fecha;
        },
        setEstatus: function (private, estatus) {
            private.estatus = estatus;
        },
        getEstatus: function (private) {
            return private.estatus;
        },
        setEstatus_cobranza: function (private, estatus_cobranza) {
            private.estatus_cobranza = estatus_cobranza;
        },
        getEstatus_cobranza: function (private) {
            return private.estatus_cobranza;
        },
        setSaldo: function (private, saldo) {
            private.saldo = saldo;
        },
        getSaldo: function (private) {
            return private.saldo;
        },
        setMetodo_pago: function (private, metodo_pago) {
            private.metodo_pago = metodo_pago;
        },
        getMetodo_pago: function (private) {
            return private.metodo_pago;
        },
        setReferencia_pago: function (private, referencia_pago) {
            private.referencia_pago = referencia_pago;
        },
        getReferencia_pago: function (private) {
            return private.referencia_pago;
        },
        setNotas: function (private, notas) {
            private.notas = notas;
        },
        getNotas: function (private) {
            return private.notas;
        }
    }
}