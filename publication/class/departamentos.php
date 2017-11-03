<?php  

class Departamentos
{ 

	function getDepartamento(){
		$DepartamentoVerDBO = DB_DataObject::Factory('GvlDepartamento');

		//$ingredienteDBO->orderBy("id ASC");
		$DepartamentoVerDBO->find();

		$Departamentos = array();
		$contador = 0;

		while($DepartamentoVerDBO->fetch()){
			$Departamentos[$contador]->idDepto = $DepartamentoVerDBO->idDepto;
			$Departamentos[$contador]->nombre = utf8_encode($DepartamentoVerDBO->nombre);
			$contador++;
		}
		$DepartamentoVerDBO->fetch();
		return($Departamentos);

	}

	function getDeparCodigo($id){
		$DepartamentoVerDBO = DB_DataObject::Factory('GvlDepartamento');
		$DepartamentoVerDBO->selectAdd('nombre');
		$DepartamentoVerDBO->idDepto = $id;
		//$ingredienteDBO->orderBy("id ASC");
		$DepartamentoVerDBO->find();


		while($DepartamentoVerDBO->fetch()){
			$nombre = $DepartamentoVerDBO->nombre;
		}
		return($nombre);

	}

}
?>