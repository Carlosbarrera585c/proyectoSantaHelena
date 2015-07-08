<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as bitacora;

/**
 * Description of create CreateActionClass
 * @author  Bayron Henao <bairon_henao_1995@hotmail.com> 
 * @method post  los datos de la tabla llegan por metodo post.
 * @param getNameField se especifica los nombres de los capos contenidos en la tabla.
 * $data los datos del recorrido de la tabla controlCalidad se guardan
 * en la variable $data  
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $fecha = request::getInstance()->getPost(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::FECHA, true));
        $empleado_id = request::getInstance()->getPost(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::EMPLEADO_ID, true));
        $proveedor_id = request::getInstance()->getPost(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::PROVEEDOR_ID, true));
        $cantidad = request::getInstance()->getPost(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::CANTIDAD, true));
        $procedencia_caña = request::getInstance()->getPost(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::PROCEDENCIA_CAÑA, true));
        $peso_caña = request::getInstance()->getPost(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::PESO_CAÑA, true));
        $num_vagon = request::getInstance()->getPost(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::NUM_VAGON, true));
        

        //$this->Validate($turno, $brix, $ph, $ar, $sacarosa, $pureza);

        $data = array(
            ingresoCañaTableClass::FECHA => $fecha,
            ingresoCañaTableClass::EMPLEADO_ID => $empleado_id,
            ingresoCañaTableClass::PROVEEDOR_ID => $proveedor_id,
            ingresoCañaTableClass::CANTIDAD => $cantidad,
            ingresoCañaTableClass::PROCEDENCIA_CAÑA => $procedencia_caña,
            ingresoCañaTableClass::PESO_CAÑA => $peso_caña,
            ingresoCañaTableClass::NUM_VAGON => $num_vagon
        );


        ingresoCañaTableClass::insert($data);
        session::getInstance()->setSuccess(i18n::__('successfulRegister'));
        routing::getInstance()->redirect('ingresoCaña', 'index');
      } else {
        routing::getInstance()->redirect('ingresoCaña', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('ingresoCaña', 'insert');
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }
//funcion para validacion de campos en formulario 
  private function Validate($turno, $brix, $ph, $ar, $sacarosa, $pureza) {
    $bandera = FALSE;
//validaciones para que no se superen el maximo de caracteres.
    if (strlen($turno) > ingresoCañaTableClass::TURNO_LENGHT) {
      session::getInstance()->setError(i18n::__('errorLenghtTurn', NULL, 'default', array('%turno%' => $turno, '%caracteres%' => ingresoCañaTableClass::TURNO_LENGHT)));
      $bandera = true;
      session::getInstance()->setFlash(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::TURNO, true), true);
    }
    if ($brix > ingresoCañaTableClass::BRIX_LENGHT) {
      session::getInstance()->setError(i18n::__('errorLenghtBrix', NULL, 'default', array('%brix%' => $brix, '%caracteres%' => ingresoCañaTableClass::BRIX_LENGHT)));
      $bandera = true;
      session::getInstance()->setFlash(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::BRIX, true), true);
    }
    if ($ph > ingresoCañaTableClass::PH_LENGHT) {
      session::getInstance()->setError(i18n::__('errorLenghtPh', NULL, 'default', array('%ph%' => $ph, '%caracteres%' => ingresoCañaTableClass::PH_LENGHT)));
      $bandera = true;
      session::getInstance()->setFlash(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::PH, true), true);
    }
    if ($ar > ingresoCañaTableClass::AR_LENGHT) {
      session::getInstance()->setError(i18n::__('errorLenghtAr', NULL, 'default', array('%ar%' => $ar, '%caracteres%' => ingresoCañaTableClass::AR_LENGHT)));
      $bandera = true;
      session::getInstance()->setFlash(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::AR, true), true);
    }
    if ($sacarosa > ingresoCañaTableClass::SACAROSA_LENGHT) {
      session::getInstance()->setError(i18n::__('errorLenghtSaccharose', NULL, 'default', array('%sacarosa%' => $sacarosa, '%caracteres%' => ingresoCañaTableClass::SACAROSA_LENGHT)));
      $bandera = true;
      session::getInstance()->setFlash(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::SACAROSA, true), true);
    }
    if ($pureza > ingresoCañaTableClass::PUREZA_LENGHT) {
      session::getInstance()->setError(i18n::__('errorLenghtPurity', NULL, 'default', array('%pureza%' => $pureza, '%caracteres%' => ingresoCañaTableClass::PUREZA_LENGHT)));
      $bandera = true;
      session::getInstance()->setFlash(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::PUREZA, true), true);
    }
//validar que el campo sea solo texto
    if (!ereg("^[A-Za-z]*$", $turno)){
      session::getInstance()->setError(i18n::__('errorTexto', NULL, 'default'));
      $bandera = true;
      session::getInstance()->setFlash(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::PUREZA, true), true);
    }
 //validar que el campo sea numerico.
    if (!is_numeric($brix)) {
      session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'));
      $bandera = true;
      session::getInstance()->setFlash(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::BRIX, true), true);
    }
    if (!is_numeric($ph)) {
      session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'));
      $bandera = true;
      session::getInstance()->setFlash(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::PH, true), true);
    }
    if (!is_numeric($ar)) {
      session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'));
      $bandera = true;
      session::getInstance()->setFlash(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::AR, true), true);
    }
    if (!is_numeric($sacarosa)) {
      session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'));
      $bandera = true;
      session::getInstance()->setFlash(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::SACAROSA, true), true);
    }
    if (!is_numeric($pureza)) {
      session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'));
      $bandera = true;
      session::getInstance()->setFlash(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::PUREZA, true), true);
    }
 //validar que no se envie el campo vacio o nulo
    if($turno === '' or $turno === NULL) {
      session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'));
      $bandera = true;
      session::getInstance()->setFlash(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::TURNO, true), true);
    }
    if($brix === '' or $brix === NULL) {
      session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'));
      $bandera = true;
      session::getInstance()->setFlash(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::BRIX, true), true);
    }
    if($ph === '' or $ph === NULL) {
      session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'));
      $bandera = true;
      session::getInstance()->setFlash(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::PH, true), true);
    }
    if($ar === '' or $ar === NULL) {
      session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'));
      $bandera = true;
      session::getInstance()->setFlash(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::AR, true), true);
    }
    if($sacarosa === '' or $sacarosa === NULL) {
      session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'));
      $bandera = true;
      session::getInstance()->setFlash(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::SACAROSA, true), true);
    }
    if($pureza === '' or $pureza === NULL) {
      session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'));
      $bandera = true;
      session::getInstance()->setFlash(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::PUREZA, true), true);
    }
    if ($bandera === true) {
      request::getInstance()->setMethod('GET');
      routing::getInstance()->forward('ingresoCaña', 'insert');
    }
  }

}
