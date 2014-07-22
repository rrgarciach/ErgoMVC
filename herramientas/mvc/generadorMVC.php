<?php
/**
 * Generador MVC (Framework)
 * @author Ruy Garcia
 * @version 5-Ago-2013
 * @TODO Arreglar variable key. No se establece como variable propia de la clase _modelo.
 */
setlocale(LC_ALL, 'es-ES');
$fecha = date("d-F-Y");
$key ="";

// Carga de los campos recibidos por el formulario:
$campos = array();
$i = 1;
while ( isset($_POST['campo'.$i]) && ($_POST['campo'.$i]!="") ) {
    if ( isset($_POST['ai'.$i]) ) { $ai = "IDENTITY(1,1)"; } else { $ai = ""; }
    if ( $_POST['key'.$i] == "key" ) { $key = $_POST['campo'.$i]; }
    $campo = array(
        'campo' => strtolower($_POST['campo'.$i]), 
        'default' => $_POST['default'.$i], 
        'tipo' => $_POST['tipo'.$i], 
        'longitud' => $_POST['longitud'.$i], 
        'null' => $_POST['null'.$i], 
        'key' => $_POST['key'.$i], 
        'ai' => $ai);
    array_push($campos, $campo);
    $i++;
}

// Nombre del elemento MVC a crear:
$elemento = ucwords($_POST['modelo']);

// Definicion del Modelo:
$modeloName = strtolower($elemento);

$modeloVariables = "";
foreach ($campos as $campo) {
    $nombre = $campo['campo'];
    $default = $campo['default'];
    $modeloVariables .= <<<HTML
    private \$$nombre = "$default";

HTML;
}

$modeloFunciones = "";
foreach ($campos as $campo) {
    $nombreCapital = ucwords($campo['campo']);
    $nombre = $campo['campo'];
    $nombreMinus = ucwords($campo['campo']);
    $modeloFunciones .= <<<HTML
    public function set$nombreCapital(\$value) {
        \$this->$nombre = \$value;
    }

    public function get$nombreMinus() {
        return \$this->$nombre;
    }


HTML;
}

$modeloToArray = "";
$miembrosDelArray = "";
foreach ($campos as $campo) {
    //$nombre = $campo['campo'];
    $nombreMinus = ucwords($campo['campo']);
    $nombreStrLower = strtolower($campo['campo']);
    $miembrosDelArray .= "\$toArray['$nombreMinus'] = \$this->$nombreStrLower;\n\t";
}
$modeloToArray .= <<<HTML
    /**
    * Regresa los valores del objeto en un arreglo.
    * @return array
    */ 
    public function toArray() {
        \$toArray = array();
        \$toArray['key'] = '$key';
        \$toArray['elemento'] = '$nombreStrLower';
        $miembrosDelArray
        return \$toArray;
    }
     
        
HTML;

$modeloContent = <<<HTML
<?php
/** Archivo generado automaticamente por la clase generadorMVC.php
* Fecha de creacion: $fecha
**/
require_once "_modelo/_modelo_class.php";

class $elemento extends Modelo {
    // TODO
$modeloVariables
    // Funciones setters y getters:
$modeloFunciones
$modeloToArray
}
HTML;

// Definicion del Controlador:
$controladorName = strtolower($elemento);

$nombreCtrl = $elemento."Ctrl";
$controladorContent = <<<HTML
<?php
/** Archivo generado automaticamente por la clase generadorMVC.php
* Fecha de creacion: $fecha
**/
require_once "_controlador/_controlador_class.php";
        
class $nombreCtrl extends Controlador {
    // TODO
    /**
     * Busca un elemento en la base de datos y lo retorna como un arreglo de objetos. Cada registro es recibido como un objeto.
     * @param string \$campo La columna en dónde buscar.
     * @param string \$valor El valor a buscar.
     * @return array de Objetos
     */
    static public function buscar$elemento(\$valor, \$campo) {
         require_once "librerias/sqlserver_class.php";
         \$conn = new SQLServer('gcmaster', 'w');
         \$query = "SELECT * FROM $controladorName WHERE \$campo='\$valor'";
         \$$controladorName = \$conn->queryObject(\$query, '$elemento\s');
         \$conn->close();
         return \$$controladorName;
     }
        
   /**
      * Recibe como parametro un objeto $controladorName y, en caso de no existir, lo agrega a la base de datos.
      * @param objeto \$$controladorName
      * @return boolean
      */ 
   static public function agregar$elemento(\$$controladorName) {
        require_once "librerias/sqlserver_class.php";
        \$conn = new SQLServer('gcmaster', 'w');
        \$resultado = \$conn->insertObject(\$$controladorName, '$elemento');
        \$conn->close();
        if (\$resultado) return false;
        return true;
    }

   /**
      * Recibe como parametro un objeto $controladorName y, en caso de existir, lo modifica en la base de datos.
      * @param objeto \$$controladorName
      * @return boolean
      */ 
   static public function actualizar$elemento(\$$controladorName) {
        require_once "librerias/sqlserver_class.php";
        \$conn = new SQLServer('gcmaster', 'w');
        \$resultado = \$conn->updateObject(\$$controladorName, '$elemento');
        \$conn->close();
        if (!\$resultado) return false;
        return true;
    }

   /**
      * Recibe como parametro un objeto $controladorName y, en caso de no existir, lo elimina de la base de datos.
      * @param objeto \$$controladorName
      * @return boolean
      */ 
   static public function borrar$elemento(\$$controladorName) {
        require_once "librerias/sqlserver_class.php";
        \$conn = new SQLServer('gcmaster', 'w');
        \$resultado = \$conn->deleteObject(\$$controladorName, '$elemento');
        \$conn->close();
        if (!\$resultado) return false;
        return true;
    }
}
        
HTML;

// Definicion de la Vista:
$vistaName = strtolower($elemento);

$nombreVista = $elemento."Vista";
$vistaContent = <<<HTML
<?php
/** Archivo generado automaticamente por la clase generadorMVC.php
* Fecha de creacion: $fecha
**/
require_once "_vista/_vista_class.php";
        
class ".$nombre."Vista extends Vista {
    // TODO
    private \$html = "";
        
    public function getHtml() {
        return \$this->html;
    }
        
}
        
HTML;


// Generadocion de los archivos en sus respectivas carpetas:

// Direccion base
$raizURL = "../../_";

// Generar modelo.php
$modeloFile = fopen($raizURL."modelo/".$modeloName."_modelo.php", "w");
fwrite($modeloFile, $modeloContent);
fclose($modeloFile);
if ($modeloFile) { echo "<p>Modelo creado exitosamente.</p>"; }

// Generar controlador.php
$controladorFile = fopen($raizURL."controlador/".$controladorName."_controlador.php", "w");
fwrite($controladorFile, $controladorContent);
fclose($controladorFile);
if ($controladorFile) { echo "<p>Controlador creado exitosamente.</p>"; }

// Generar vista.php
$vistaFile = fopen($raizURL."vista/".$vistaName."_vista.php", "w");
fwrite($vistaFile, $vistaContent);
fclose($vistaFile);
if ($vistaFile) { echo "<p>Vista creado exitosamente.</p>"; }

if ($modeloFile && $controladorFile && $vistaFile) {
    crearTabla($modeloName, $campos, $raizURL);
}


// Creacion de la tabla en la Base de Datos
function crearTabla( $modeloName, $campos, $raizURL ) {
    // SQL Server:
    require_once "../../librerias/sqlserver_class.php";
    $conn = new SQLServer("gcmaster", "w");

    // Gestion del query:
    $query = "CREATE TABLE $modeloName (";
    foreach ($campos as $campo) {
            if ($campo['key']=="key") { $campo['key'] = "PRIMARY KEY"; }
            if ($campo['ai']=="ai") { $campo['ai'] = "IDENTITY(1,1)"; }
            if ($campo['longitud']!="") { $campo['longitud'] = "(".$campo['longitud'].")"; }
            if ($campo['default']!="") { $campo['default'] = "DEFAULT '".$campo['default']."'"; }
            $query .= $campo['campo']." ".$campo['tipo']." ".$campo['ai']." ".$campo['longitud']." ".$campo['key']." ".$campo['null']." ".$campo['default'].", " ;
    }
    $query .= "timestamp timestamp)";

    // Envio del query:
    //$try = ;
    if ($conn->query($query)) { echo "<p>Tabla creada exitosamente.</p>"; }
    else { echo "<strong>Ha ocurrido un error al intentar crear la tabla.</strong>"; }
    
    // Cierre de la conexion:p
    //$try = ;
    if ($conn->close()) { echo "<p>Conexión cerrada exitosamente.</p>"; }
    else { echo "<p><strong>Ha ocurrido un error al intentar cerrar la conexin.</strong></p>"; }
    
    $queryDocInfo = <<<TEXT

/**
 * Query oara crear la tabla:
 * SQL SERVER QUERY: $query
**/
TEXT;
    $file = $raizURL."modelo/".$modeloName."_modelo.php";
    file_put_contents($file, $queryDocInfo, FILE_APPEND | LOCK_EX);
}

?>