<?php
global $prefijo;

error_reporting(0);

require_once("./".$prefijo."db/DBO.php");
//require_once("./".$prefijo."Smarty/libs/Smarty.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/Smarty/libs/Smarty.class.php");
require_once("./".$prefijo."db/db.gvlCiudad.php");
require_once("./".$prefijo."db/db.gvlDepartamento.php");
require_once("./".$prefijo."db/db.gvlUsuario.php");
require_once("./".$prefijo."class/cleanDoor.php");


require_once("./".$prefijo."class/departamentos.php");
require_once("./".$prefijo."class/ciudades.php");
require_once("./".$prefijo."class/usuarios.php");
require_once("./".$prefijo."excel/class.ExportExcel.inc.php");

$smarty = new Smarty();


//$smarty->display('./index.html');
/*
$smarty->compile_check = true;
$smarty->left_delimiter = '{#';
$smarty->right_delimiter = '#}';

//Ruta absoluta de las imagenes
//$smarty->assign("rutaImagenes","http://72.34.50.144/~colom25/");
$smarty->assign("rutaImagenes","http://www.colombina.com/");
*/

?>