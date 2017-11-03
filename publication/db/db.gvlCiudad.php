<?php
/**
 * Table Definition for gvl_ciudad
 */

class DataObjects_GvlCiudad extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'gvl_ciudad';                      // table name
    public $idCiudad;                        // int(11)  not_null primary_key
    public $idDepto;                         // int(11)  multiple_key
    public $nombre;                          // string(45)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_GvlCiudad',$k,$v); }

    function table()
    {
         return array(
             'idCiudad' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'idDepto' =>  DB_DATAOBJECT_INT,
             'nombre' =>  DB_DATAOBJECT_STR,
         );
    }

    function keys()
    {
         return array('idCiudad');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('idCiudad', true, false);
    }

    function defaults() // column default values 
    {
         return array(
             'nombre' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
