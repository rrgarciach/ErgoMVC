<?php
/** Archivo generado automaticamente por la clase generadorMVC.php
* Fecha de creacion: 28-September-2013
**/
require_once "_modelo/_modelo_class.php";

class Carritos extends Modelo {
    // TODO
    private $id_usuario = "";
    private $renglones = array();

    // Funciones setters y getters:
    public function setId_usuario($value) {
        $this->id_usuario = $value;
    }
    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setRenglones($value) {
        $this->renglones = $value;
    }
    public function getRenglones() {
        return $this->renglones;
    }


    /**
    * Regresa los valores del objeto en un arreglo.
    * @return array
    */ 
    public function toArray() {
        $toArray = array();
        $toArray['key'] = 'id_usuario';
        $toArray['elemento'] = 'renglon';
        $toArray['Id_usuario'] = $this->id_usuario;
	$toArray['Renglones'] = $this->renglones;
	
        return $toArray;
    }
     
        
}

/*
SQL Server query:
USE [gcmaster]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[carritos](
	[id_usuario] [nvarchar](8) NOT NULL,
	[renglones] [xml] NULL,
	[timestamp] [timestamp] NOT NULL,
 CONSTRAINT [id_usuario_index_carritos] PRIMARY KEY CLUSTERED 
(
	[id_usuario] ASC
)WITH (PAD_INDEX  = ON, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
 */

/*
 MySQL query:
CREATE TABLE  `gcdbmaster`.`carritos` (
`id_usuario` VARCHAR( 8 ) NOT NULL ,
`renglones` TEXT NOT NULL COMMENT  'datos XML',
`timestamp` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
PRIMARY KEY (  `id_usuario` )
) ENGINE = MYISAM
 */