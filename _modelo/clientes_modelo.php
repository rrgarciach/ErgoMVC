<?php
if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address

require_once BASE_URI."_modelo/_modelo_class.php";

class Clientes extends Modelo {
    // TODO
    private $elemento = 'cliente';
    private $id_index = 0;
    private $id_cliente = "";
    private $id_usuario = "";
    private $nombre = "";
    private $apellido_p = "";
    private $apellido_m = "";
    private $rfc = "XAXX010101000";
    private $direccion_fiscal = array();
    private $direcciones_envio = array();
    private $telefono1 = "";
    private $telefono2 = "";
    private $email1 = "";
    private $email2 = "";
    private $descuento = 0; // descuento porcentual
    private $metodo_pago = "EFECTIVO"; // EFECTIVO: default, TRANSFERENCIA, CHEQUE, TDC, TDD
    private $referencia_pago = ""; // en caso de no ser en efectivo, los ultimos 4 digitos de la cuenta a cargo
    private $id_vendedor = "";
    private $id_repartidor = "";
    private $id_tipo = 2; // 1: mayorista, 2: minorista
    private $id_giro = 1; // 1: ferreteria, 2: mecanico, 3: agricola, 4: mineria, 5: construccion, 6: domestico
    private $id_zona = 1; // 1: CUU centro, 2: CUU norte, 3: CUU sur, 4: CUAUH, 5: DEL, 6: BLANQUITA
    private $estatus = "NA"; // NA: default, ACTIVO, INACTIVO

    public function __construct() {
//        $this->direccion_envio = '<direcciones><direccion clase="direccion_envio"><key>id_direccion</key><id_direccion>1</id_direccion><calle>guancone</calle><numero>999</numero><colonia>colonita robles</colonia><cp>31000</cp><localidad>Chihuahua</localidad><ciudad>Chihuahua</ciudad><estado>Chihuahua</estado><x>28.662613</x><y>-106.102889</y></direccion></direcciones>';
//        $this->direccion_fiscal = '<direcciones><direccion clase="direccion_envio"><key>id_direccion</key><id_direccion>1</id_direccion><calle>guancone</calle><numero>999</numero><colonia>colonita robles</colonia><cp>31000</cp><localidad>Chihuahua</localidad><ciudad>Chihuahua</ciudad><estado>Chihuahua</estado><x>28.662613</x><y>-106.102889</y></direccion></direcciones>';
    }
    // Funciones setters y getters:
    public function setId_index($value) {
        $this->id_index = $value;
    }

    public function getId_index() {
        return $this->id_index;
    }

    public function setId_cliente($value) {
        $this->id_cliente = $value;
    }

    public function getId_cliente() {
        return $this->id_cliente;
    }

    public function setId_usuario($value) {
        $this->id_usuario = $value;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setNombre($value) {
        $this->nombre = $value;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setApellido_p($value) {
        $this->apellido_p = $value;
    }

    public function getApellido_p() {
        return $this->apellido_p;
    }

    public function setApellido_m($value) {
        $this->apellido_m = $value;
    }

    public function getApellido_m() {
        return $this->apellido_m;
    }

    public function setRfc($value) {
        $this->rfc = $value;
    }

    public function getRfc() {
        return $this->rfc;
    }

    public function setDireccion_fiscal($value) {
        $this->direccion_fiscal = $value;
    }

    public function getDireccion_fiscal() {
        return $this->direccion_fiscal;
    }

    public function setDirecciones_envio($value) {
        $this->direcciones_envio = $value;
    }

    public function getDirecciones_envio() {
        return $this->direcciones_envio;
    }

    public function setTelefono1($value) {
        $this->telefono1 = $value;
    }

    public function getTelefono1() {
        return $this->telefono1;
    }

    public function setTelefono2($value) {
        $this->telefono2 = $value;
    }

    public function getTelefono2() {
        return $this->telefono2;
    }

    public function setEmail1($value) {
        $this->email1 = $value;
    }

    public function getEmail1() {
        return $this->email1;
    }

    public function setEmail2($value) {
        $this->email2 = $value;
    }

    public function getEmail2() {
        return $this->email2;
    }

    public function setDescuento($value) {
        $this->descuento = $value;
    }

    public function getDescuento() {
        return $this->descuento;
    }

    public function setMetodo_pago($value) {
        $this->metodo_pago = $value;
    }

    public function getMetodo_pago() {
        return $this->metodo_pago;
    }

    public function setReferencia_pago($value) {
        $this->referencia = $value;
    }

    public function getReferencia_pago() {
        return $this->referencia;
    }

    public function setId_vendedor($value) {
        $this->id_vendedor = $value;
    }

    public function getId_vendedor() {
        return $this->id_vendedor;
    }

    public function setId_repartidor($value) {
        $this->id_repartidor = $value;
    }

    public function getId_repartidor() {
        return $this->id_repartidor;
    }
    
    public function getId_tipo() {
        return $this->id_tipo;
    }
    public function setId_tipo($id_tipo) {
        $this->id_tipo = $id_tipo;
    }

    public function getId_giro() {
        return $this->id_giro;
    }
    public function setId_giro($id_giro) {
        $this->id_giro = $id_giro;
    }

    public function setId_zona($value) {
        $this->id_zona = $value;
    }

    public function getId_zona() {
        return $this->id_zona;
    }

    public function setEstatus($value) {
        $this->estatus = $value;
    }

    public function getEstatus() {
        return $this->estatus;
    }


    /**
    * Regresa los valores del objeto en un arreglo.
    * @return array
    */ 
    public function toArray() {
        $toArray = array();
        $toArray['key'] = 'Id_cliente';
        $toArray['elemento'] = $this->elemento;
        $toArray['Id_index'] = $this->id_index;
	$toArray['Id_cliente'] = $this->id_cliente;
	$toArray['Id_usuario'] = $this->id_usuario;
	$toArray['Nombre'] = $this->nombre;
	$toArray['Apellido_p'] = $this->apellido_p;
	$toArray['Apellido_m'] = $this->apellido_m;
	$toArray['Rfc'] = $this->rfc;
	$toArray['Direccion_fiscal'] = $this->direccion_fiscal;
	$toArray['Direcciones_envio'] = $this->direcciones_envio;
	$toArray['Telefono1'] = $this->telefono1;
	$toArray['Telefono2'] = $this->telefono2;
	$toArray['Email1'] = $this->email1;
	$toArray['Email2'] = $this->email2;
	$toArray['Descuento'] = $this->descuento;
	$toArray['Metodo_pago'] = $this->metodo_pago;
	$toArray['Referencia_pago'] = $this->referencia_pago;
	$toArray['Id_tipo'] = $this->id_tipo;
	$toArray['Id_giro'] = $this->id_giro;
	$toArray['Id_zona'] = $this->id_zona;
	$toArray['Id_vendedor'] = $this->id_vendedor;
	$toArray['Id_repartidor'] = $this->id_repartidor;
	$toArray['Estatus'] = $this->estatus;
	
        return $toArray;
    }
     
        
}
/**
 * Query oara crear la tabla:
 * SQL SERVER QUERY: CREATE TABLE clientes (id_index int IDENTITY(1,1)  PRIMARY KEY NOT NULL , id_cliente nvarchar  (8)  NOT NULL , id_usuario nvarchar  (16)  NOT NULL , nombre nvarchar  (64)  NOT NULL , apellido_p nvarchar  (16)  NOT NULL , apellido_m nvarchar  (16)  NOT NULL , rfc nvarchar  (16)  NOT NULL DEFAULT 'XXXX999999XXX', direccion_fiscal xml  NOT NULL , direcciones xml  NOT NULL , telefono1 nvarchar  (16)  NOT NULL , telefono2 nvarchar  (16)  NOT NULL , email1 nvarchar  (32)  NOT NULL , email2 nvarchar  (32)  NOT NULL , descuento float    NOT NULL DEFAULT 0 , metodo_pago nvarchar  (16)  NOT NULL DEFAULT 'EFECTIVO', referencia nvarchar  (16)  NOT NULL , id_zona int    NOT NULL DEFAULT '1', id_vendedor int    NOT NULL , id_repartidor int    NOT NULL , estatus nvarchar  (16)  NOT NULL DEFAULT 'NA', timestamp timestamp)
**/

/*
 MySql query:
 
 CREATE TABLE  `gcdbmaster`.`clientes` (
`index` INT( 4 ) NOT NULL AUTO_INCREMENT ,
`id_cliente` VARCHAR( 8 ) NOT NULL ,
`id_usuario` VARCHAR( 16 ) NOT NULL ,
`nombre` VARCHAR( 64 ) NOT NULL ,
`apellido_p` VARCHAR( 16 ) NOT NULL ,
`apellido_m` VARCHAR( 16 ) NOT NULL ,
`rfc` VARCHAR( 16 ) NOT NULL DEFAULT  'XAXX010101000',
`direccion_fiscal` TEXT NOT NULL COMMENT  'datos XML',
`direcciones_envio` TEXT NOT NULL COMMENT  'datos XML',
`telefono1` VARCHAR( 16 ) NOT NULL ,
`telefono2` VARCHAR( 16 ) NULL ,
`email1` VARCHAR( 32 ) NOT NULL ,
`email2` VARCHAR( 32 ) NULL ,
`descuento` FLOAT NOT NULL DEFAULT  '0',
`metodo_pago` VARCHAR( 16 ) NOT NULL DEFAULT  'EFECTIVO',
`referencia` VARCHAR( 16 ) NULL ,
`id_vendedor` INT( 4 ) NOT NULL ,
`id_repartidor` INT( 4 ) NOT NULL ,
`id_tipo` INT( 4 ) NOT NULL ,
`id_giro` INT( 4 ) NOT NULL ,
`id_zona` INT( 4 ) NOT NULL ,
`estatus` VARCHAR( 16 ) NOT NULL DEFAULT  'NA',
`timestamp` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
PRIMARY KEY (  `id_cliente` ) ,
UNIQUE (
`index`
)
) ENGINE = MYISAM
 */