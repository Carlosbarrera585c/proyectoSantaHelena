
<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Bayron Henao <bairon_henao_1995@hotmail.com>
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
	try {
	  if (request::getInstance()->isMethod('POST')) {
		$id = request::getInstance()->getPost(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::ID, true));
		$fecha = request::getInstance()->getPost(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::FECHA, true));
		$empleado_id = request::getInstance()->getPost(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::EMPLEADO_ID, true));
		$proveedor_id = request::getInstance()->getPost(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::PROVEEDOR_ID, true));
		$cantidad = request::getInstance()->getPost(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::CANTIDAD, true));
		$peso_caña = request::getInstance()->getPost(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::PESO_CAÑA, true));
		$peso_caña2 = request::getInstance()->getPost(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::PESO_CAÑA2, true));
		$peso_caña3 = request::getInstance()->getPost(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::PESO_CAÑA3, true));
		$peso_caña4 = request::getInstance()->getPost(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::PESO_CAÑA4, true));
		$peso_caña5 = request::getInstance()->getPost(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::PESO_CAÑA5, true));
		$num_vagon = request::getInstance()->getPost(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::NUM_VAGON, true));
		$num_vagon2 = request::getInstance()->getPost(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::NUM_VAGON2, true));
		$num_vagon3 = request::getInstance()->getPost(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::NUM_VAGON3, true));
		$num_vagon4 = request::getInstance()->getPost(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::NUM_VAGON4, true));
		$num_vagon5 = request::getInstance()->getPost(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::NUM_VAGON5, true));
		$variedad = request::getInstance()->getPost(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::VARIEDAD, true));
		$this->Validate($fecha, $cantidad, $peso_caña, $num_vagon, $empleado_id, $proveedor_id, $num_vagon2, $num_vagon3, $num_vagon4, $num_vagon5, $variedad);
		$ids = array(
			ingresoCanaTableClass::ID => $id
		);

		$data = array(
			ingresoCanaTableClass::ID => $id,
			ingresoCanaTableClass::FECHA => $fecha,
			ingresoCanaTableClass::EMPLEADO_ID => $empleado_id,
			ingresoCanaTableClass::PROVEEDOR_ID => $proveedor_id,
			ingresoCanaTableClass::CANTIDAD => $cantidad,
			ingresoCanaTableClass::PESO_CAÑA => $peso_caña,
			ingresoCanaTableClass::PESO_CAÑA2 => $peso_caña2,
			ingresoCanaTableClass::PESO_CAÑA3 => $peso_caña3,
			ingresoCanaTableClass::PESO_CAÑA4 => $peso_caña4,
			ingresoCanaTableClass::PESO_CAÑA5 => $peso_caña5,
			ingresoCanaTableClass::NUM_VAGON => $num_vagon,
			ingresoCanaTableClass::NUM_VAGON2 => $num_vagon2,
			ingresoCanaTableClass::NUM_VAGON3 => $num_vagon3,
			ingresoCanaTableClass::NUM_VAGON4 => $num_vagon4,
			ingresoCanaTableClass::NUM_VAGON5 => $num_vagon5,
			ingresoCanaTableClass::VARIEDAD => $variedad
		);

		ingresoCanaTableClass::update($ids, $data);
	  }
	  session::getInstance()->setSuccess(i18n::__('successfulUpdate'));
	  session::getInstance()->setAttribute('form_' . ingresoCanaTableClass::getNameTable(), null);
	  routing::getInstance()->redirect('ingresoCana', 'index');
	} catch (PDOException $exc) {
	  echo $exc->getMessage();
	  echo '<br>';
	  echo $exc->getTraceAsString();
	}
  }

  //funcion para validacion de campos en formulario 
  private function Validate($fecha, $cantidad, $peso_caña, $num_vagon, $empleado_id, $proveedor_id, $num_vagon2, $num_vagon3, $num_vagon4, $num_vagon5, $variedad) {
	$bandera = FALSE;
	$pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
	//validaciones para que no se superen el maximo de caracteres.
	if (strlen($cantidad) > ingresoCanaTableClass::CANTIDAD_LENGTH) {
	  session::getInstance()->setError(i18n::__('errorLengthQuantity', NULL, 'default', array('%cantidad%' => $cantidad, '%caracteres%' => ingresoCanaTableClass::CANTIDAD_LENGTH)), 'errorCantidad');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::CANTIDAD, true), true);
	}
	if (strlen($peso_caña) > ingresoCanaTableClass::PESO_CAÑA_LENGTH) {
	  session::getInstance()->setError(i18n::__('errorLengthWeight', NULL, 'default', array('%peso%' => $peso_caña, '%caracteres%' => ingresoCanaTableClass::PESO_CAÑA_LENGTH)), 'errorPeso');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::PESO_CAÑA, true), true);
	}
	if (strlen($num_vagon) > ingresoCanaTableClass::NUM_VAGON_LENGTH) {
	  session::getInstance()->setError(i18n::__('errorLengthNumberWagon', NULL, 'default', array('%vagon%' => $num_vagon, '%caracteres%' => ingresoCanaTableClass::NUM_VAGON_LENGTH)), 'errorVagon');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::NUM_VAGON, true), true);
	}
	if (strlen($num_vagon2) > ingresoCanaTableClass::NUM_VAGON2_LENGTH) {
	  session::getInstance()->setError(i18n::__('errorLengthNumberWagon', NULL, 'default', array('%vagon%' => $num_vagon2, '%caracteres%' => ingresoCanaTableClass::NUM_VAGON_LENGTH)), 'errorVagon');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::NUM_VAGON2, true), true);
	}
	if (strlen($num_vagon3) > ingresoCanaTableClass::NUM_VAGON3_LENGTH) {
	  session::getInstance()->setError(i18n::__('errorLengthNumberWagon', NULL, 'default', array('%vagon%' => $num_vagon3, '%caracteres%' => ingresoCanaTableClass::NUM_VAGON_LENGTH)), 'errorVagon');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::NUM_VAGON3, true), true);
	}
	if (strlen($num_vagon4) > ingresoCanaTableClass::NUM_VAGON4_LENGTH) {
	  session::getInstance()->setError(i18n::__('errorLengthNumberWagon', NULL, 'default', array('%vagon%' => $num_vagon4, '%caracteres%' => ingresoCanaTableClass::NUM_VAGON_LENGTH)), 'errorVagon');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::NUM_VAGON4, true), true);
	}
	if (strlen($num_vagon5) > ingresoCanaTableClass::NUM_VAGON5_LENGTH) {
	  session::getInstance()->setError(i18n::__('errorLengthNumberWagon', NULL, 'default', array('%vagon%' => $num_vagon5, '%caracteres%' => ingresoCanaTableClass::NUM_VAGON_LENGTH)), 'errorVagon');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::NUM_VAGON5, true), true);
	}
	//validar que el campo sea solo texto
	//validar que el campo sea numerico.
	if (!is_numeric($cantidad)) {
	  session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'), 'errorCantidad');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::CANTIDAD, true), true);
	}
        if (!is_numeric($variedad)) {
	  session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'), 'errorVariedad');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::VARIEDAD, true), true);
	}
	if (!is_numeric($peso_caña)) {
	  session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'), 'errorPeso');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::PESO_CAÑA, true), true);
	}
	if (!is_numeric($num_vagon)) {
	  session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'), 'errorVagon');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::NUM_VAGON, true), true);
	}
	if (!is_numeric($num_vagon2)) {
	  session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'), 'errorVagon');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::NUM_VAGON2, true), true);
	}
	if (!is_numeric($num_vagon3)) {
	  session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'), 'errorVagon');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::NUM_VAGON3, true), true);
	}
	if (!is_numeric($num_vagon4)) {
	  session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'), 'errorVagon');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::NUM_VAGON4, true), true);
	}
	if (!is_numeric($num_vagon5)) {
	  session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'), 'errorVagon');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::NUM_VAGON5, true), true);
	}
	if (!is_numeric($empleado_id)) {
	  session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'), 'errorEmpleado');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::EMPLEADO_ID, true), true);
	}
	if (!is_numeric($proveedor_id)) {
	  session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'), 'errorEmpleado');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::PROVEEDOR_ID, true), true);
	}
	//validar que no se envie el campo vacio o nulo
	if ($cantidad === '' or $cantidad === NULL) {
	  session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'), 'errorCantidad');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::CANTIDAD, true), true);
	}
	if ($peso_caña === '' or $peso_caña === NULL) {
	  session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'), 'errorPeso');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::PESO_CAÑA, true), true);
	}

	if ($num_vagon === '' or $num_vagon === NULL) {
	  session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'), 'errorVagon');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::NUM_VAGON, true), true);
	}
	if ($empleado_id === '' or $empleado_id === NULL) {
	  session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'), 'errorEmpleado');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::EMPLEADO_ID, true), true);
	}
	if ($proveedor_id === '' or $proveedor_id === NULL) {
	  session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'), 'errorProveedor');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::PROVEEDOR_ID, true), true);
	}
//	if ($variedad === '' or $variedad === NULL) {
//	  session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'), 'errorVariedad');
//	  $bandera = true;
//	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::VARIEDAD, true), true);
//	}
	//validar fecha
	if (!preg_match($pattern, $fecha)) {
	  session::getInstance()->setError(i18n::__('errorDate', NULL, 'default'), 'errorFecha');
	  $bandera = true;
	  session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::FECHA, true), true);
	}
	if ($bandera === true) {
	  request::getInstance()->setMethod('GET');
	  request::getInstance()->addParamGet(array(ingresoCanaTableClass::ID => request::getInstance()->getPost(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::ID, TRUE))));
	  routing::getInstance()->forward('ingresoCana', 'edit');
	}
  }

}
