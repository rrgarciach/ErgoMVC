<?php

abstract class SQL_class {
    
    abstract function connect();

    abstract function close();

    abstract function query($query);
    
    /**
     * Filtra un parametro recibido para colocar en un query.
     * @param String $input Parametro recibido a filtrar.
     * @return String Parametro filtrado.
     */
    public function filterQueryInput($input) {
        $to = array(' ','!','=',',','DROP','INSERT','SELECT','UPDATE','DELETE');
        $for = "";
        $output = str_replace($to, $for, $input);
        return $output;
    }

}

?>