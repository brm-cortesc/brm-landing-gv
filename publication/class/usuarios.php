<?php  

class Usuarios
{ 
	function insertar(){
		$usuarioDBO = DB_DataObject::Factory('GvlUsuario');

		$usuarioDBO->nombres = utf8_decode($this->nombres);
		$usuarioDBO->apellidos = utf8_decode($this->apellidos);
		$usuarioDBO->idDepto = $this->idDepto;
		$usuarioDBO->idCiudad = $this->idCiudad;
		$usuarioDBO->correo = $this->correo;
		$usuarioDBO->telefono = $this->telefono;

		$usuarioDBO->insert();
		$usuarioDBO->free();

		return(true);
	}

	function getUsuario(){
		$usuarioDBO = DB_DataObject::Factory('GvlUsuario');
		$usuarioDBO->find();

	
		$usuario = array();
		$contador = 0;

		while($usuarioDBO->fetch()){
			$departamento = $usuarioDBO->getLink('idDepto','GvlDepartamento','idDepto');
			$ciudad = $usuarioDBO->getLink('idCiudad','GvlCiudad','idCiudad');

			$usuario[$contador]->nombres = $usuarioDBO->nombres;
			$usuario[$contador]->apellidos = $usuarioDBO->apellidos;
			$usuario[$contador]->nombreDepto = $departamento->nombre;
			$usuario[$contador]->nombreCiudad = $ciudad->nombre;
			$usuario[$contador]->correo = $usuarioDBO->correo;
			$usuario[$contador]->telefono = $usuarioDBO->telefono;
			$usuario[$contador]->fecha = $usuarioDBO->fecha;


			$contador++;
		}
		$usuarioDBO->fetch();
		
		return($usuario);

	}

}
?>