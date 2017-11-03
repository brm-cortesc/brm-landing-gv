<?php
/**
 * Table Definition for gvl_departamento
 */

class DataObjects_GvlDepartamento extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'gvl_departamento';                // table name
    public $idDepto;                         // int(11)  not_null primary_key
    public $nombre;                          // string(45)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_GvlDepartamento',$k,$v); }

    function table()
    {
         return array(
             'idDepto' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'nombre' =>  DB_DATAOBJECT_STR,
         );
    }

    function keys()
    {
         return array('idDepto');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('idDepto', true, false);
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
