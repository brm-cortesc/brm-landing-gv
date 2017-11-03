<?php  

class Ciudades
{ 
	function getCiudadDepartamento($depto){
		$CiudadVerDBO = DB_DataObject::Factory('GvlCiudad');

		$CiudadVerDBO->whereAdd("idDepto = '$depto'");
		//$CiudadVerDBO->get('2');

		$Ciudades = array();
		$contador = 0;

		$CiudadVerDBO->find();

		while($CiudadVerDBO->fetch()){
			$Ciudades[$contador]->idCiudad = $CiudadVerDBO->idCiudad;
			$Ciudades[$contador]->nombre = utf8_encode($CiudadVerDBO->nombre);
			$contador++;
		}
		$CiudadVerDBO->fetch();
		//printVar($Ciudades);
		return($Ciudades);
	}

	function getCiudadCodigo($id){
		$CiudadVerDBO = DB_DataObject::Factory('GvlCiudad');
		$CiudadVerDBO->selectAdd('nombre');
		$CiudadVerDBO->idCiudad = $id;
		//$ingredienteDBO->orderBy("id ASC");
		$CiudadVerDBO->find();


		while($CiudadVerDBO->fetch()){
			$nombre = $CiudadVerDBO->nombre;
		}
		return($nombre);

	}

}
?>