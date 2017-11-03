<?php
require("db/requires.php");
date_default_timezone_set('America/Bogota');

//if (isset($verify) && $verify == "Clr-C0r-".date('d')) {
	$General = new Usuarios;
	$datos = $General->getUsuario();
	$fecha = date('Y-m-d H:i:s');
	
	$excel_obj = new ExportExcel($fecha."-personas registradas.xls");
	// Setting the values of the headers and data of the excel file
	// and these values comes from the other file which file shows the data
	$excelHeader = array(
		"Nombres",
		"Apellidos",
		"Departamento",
		"Ciudad",
		"Correo",
		"Telefono",
		"Fecha"
		);
	
	if($datos){
		$excelValues = array();
		for( $i=0; $i < count($datos); $i++){
			$excelValues[$i][]= $datos[$i]->nombres;
			$excelValues[$i][] = $datos[$i]->apellidos;
			$excelValues[$i][] = $datos[$i]->nombreDepto;
			$excelValues[$i][] = $datos[$i]->nombreCiudad;
			$excelValues[$i][] = $datos[$i]->correo;
			$excelValues[$i][] = $datos[$i]->telefono;
			$excelValues[$i][] = $datos[$i]->fecha;
			
				
		}
		$excel_obj->setHeadersAndValues($excelHeader, $excelValues);
		// Now generate the excel file with the data and headers set
		$excel_obj->GenerateExcelFile();
	}
//}