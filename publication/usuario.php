<?php 
require_once('db/requires.php');

if(isset($_POST['accion'])){
	$accion = $_POST['accion'];
}


if($accion == 'insertar_usuario'){
	$limpiar = new CleanDoor();

	$nombres = $limpiar->allClean($_REQUEST['nombres']);
	$apellidos = $limpiar->allClean($_REQUEST['apellidos']);
	$departamento = $limpiar->allClean($_REQUEST['departamento']);
	$ciudad = $limpiar->allClean($_REQUEST['ciudad']);
	$correo = $limpiar->allClean($_REQUEST['correo']);
	$telefono = $limpiar->allClean($_REQUEST['telefono']);


	$usuario = new Usuarios();

	$usuario->nombres = $nombres;
	$usuario->apellidos = $apellidos;
	$usuario->idDepto = $departamento;
	$usuario->idCiudad = $ciudad;
	$usuario->correo = $correo;
	$usuario->telefono = $telefono;
	
	$resultado = $usuario->insertar();

	echo json_encode($resultado);

	// echo "<script>alert('Datos insertados correctamente.');
	//	</script>";
	
}else if ($accion == 'cargar_ciudad') { 
	$departamento = $_POST['departamento'];
	$ciudad = new Ciudades();
	$datosCiudad = $ciudad->getCiudadDepartamento($departamento);
	echo json_encode($datosCiudad);
}



?>