<?php
require_once('db/requires.php');
require_once('app/fb_init.php');

/* Carga información tabla de departamentos.*/

if(isset($_SESSION['facebook_access_token'])){
	$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);

	try {
	  $response = $fb->get('/me?fields=id,first_name,last_name');
	  $userNode = $response->getGraphUser();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
	  // When Graph returns an error
	  echo 'Graph returned an error: ' . $e->getMessage();
	  exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
	  // When validation fails or other local issues
	  echo 'Facebook SDK returned an error: ' . $e->getMessage();
	  exit;
	}

	$smarty->assign("nombre",$userNode->getFirstName());
	$smarty->assign("apellido",$userNode->getLastName());

}else{
	$helper = $fb->getRedirectLoginHelper();
	$permissions = []; // optional
	$loginUrl = $helper->getLoginUrl('http://localhost:81/brm-landing-gv/publication/login-callback.php', $permissions);

	$departamentos = new Departamentos();
	$datosDepartamentos = $departamentos->getDepartamento();

	$smarty->assign("facebook",$loginUrl);
	$smarty->assign("departamento",$datosDepartamentos);

	$smarty->display('index.html');
}





?>




