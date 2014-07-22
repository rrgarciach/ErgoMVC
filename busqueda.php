<?php
$busqueda = strip_tags(substr($_GET['t'], 0, 100));
require_once 'php/busqueda_' . $busqueda . '.php';
?>