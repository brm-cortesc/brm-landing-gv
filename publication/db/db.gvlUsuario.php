<?php
/**
 * Table Definition for gvl_usuario
 */

class DataObjects_GvlUsuario extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'gvl_usuario';                     // table name
    public $id;                              // int(11)  not_null primary_key auto_increment
    public $nombres;                         // string(50)  
    public $apellidos;                       // string(50)  
    public $idDepto;                         // int(11)  multiple_key
    public $idCiudad;                        // int(11)  multiple_key
    public $correo;                          // string(50)  
    public $telefono;                        // int(10)  
    public $fecha;                        // int(10) 

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_GvlUsuario',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'nombres' =>  DB_DATAOBJECT_STR,
             'apellidos' =>  DB_DATAOBJECT_STR,
             'idDepto' =>  DB_DATAOBJECT_INT,
             'idCiudad' =>  DB_DATAOBJECT_INT,
             'correo' =>  DB_DATAOBJECT_STR,
             'telefono' =>  DB_DATAOBJECT_INT,
             'fecha'     => DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
         );
    }

    function keys()
    {
         return array('id');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('id', true, false);
    }

    function defaults() // column default values 
    {
         return array(
             'nombres' => '',
             'apellidos' => '',
             'correo' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
