
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
        $procedencia_caña = request::getInstance()->getPost(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::PROCEDENCIA_CAÑA, true));
        $peso_caña = request::getInstance()->getPost(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::PESO_CAÑA, true));
        $num_vagon = request::getInstance()->getPost(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::NUM_VAGON, true));
       // $this->Validate($fecha, $empleado_id, $proveedor_id, $cantidad, $procedencia_caña, $peso_caña,$num_vagon);
//        $post = array(
//            ingresoCanaTableClass::FECHA => $fecha,
//            ingresoCanaTableClass::EMPLEADO_ID => $empleado_id,
//            ingresoCanaTableClass::PROVEEDOR_ID => $proveedor_id,
//            ingresoCanaTableClass::CANTIDAD => $cantidad,
//            ingresoCanaTableClass::PROCEDENCIA_CAÑA => $procedencia_caña,
//            ingresoCanaTableClass::PESO_CAÑA => $peso_caña,
//            ingresoCanaTableClass::NUM_VAGON => $num_vagon
//        );
//        
        $ids = array(
            ingresoCanaTableClass::ID => $id
        );

        $data = array(
            ingresoCanaTableClass::ID => $id,
            ingresoCanaTableClass::FECHA => $fecha,
            ingresoCanaTableClass::EMPLEADO_ID => $empleado_id,
            ingresoCanaTableClass::PROVEEDOR_ID => $proveedor_id,
            ingresoCanaTableClass::CANTIDAD => $cantidad,
            ingresoCanaTableClass::PROCEDENCIA_CAÑA => $procedencia_caña,
            ingresoCanaTableClass::PESO_CAÑA => $peso_caña,
            ingresoCanaTableClass::NUM_VAGON => $num_vagon
        );

        ingresoCanaTableClass::update($ids, $data);
      }
      session::getInstance()->setSuccess(i18n::__('successfulUpdate'));
      session::getInstance()->setAttribute('form_'.  ingresoCanaTableClass::getNameTable(), null);
      routing::getInstance()->redirect('ingresoCana', 'index');
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }
////funcion para validacion de campos en formulario 
//  private function Validate($turno, $brix, $ph, $ar, $sacarosa, $pureza) {
//    $bandera = FALSE;
////validaciones para que no se superen el maximo de caracteres.
//    if (strlen($turno) > ingresoCanaTableClass::TURNO_LENGHT) {
//      session::getInstance()->setError(i18n::__('errorLenghtTurn', NULL, 'default', array('%turno%' => $turno, '%caracteres%' => ingresoCanaTableClass::TURNO_LENGHT)));
//      $bandera = true;
//      session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::TURNO, true), true);
//    }
//    if (strlen($brix) > ingresoCanaTableClass::BRIX_LENGHT) {
//      session::getInstance()->setError(i18n::__('errorLenghtBrix', NULL, 'default', array('%brix%' => $brix, '%caracteres%' => ingresoCanaTableClass::BRIX_LENGHT)));
//      $bandera = true;
//      session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::BRIX, true), true);
//    }
//    if (strlen($ph) > ingresoCanaTableClass::PH_LENGHT) {
//      session::getInstance()->setError(i18n::__('errorLenghtPh', NULL, 'default', array('%ph%' => $ph, '%caracteres%' => ingresoCanaTableClass::PH_LENGHT)));
//      $bandera = true;
//      session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::PH, true), true);
//    }
//    if (strlen($ar) > ingresoCanaTableClass::AR_LENGHT) {
//      session::getInstance()->setError(i18n::__('errorLenghtAr', NULL, 'default', array('%ar%' => $ar, '%caracteres%' => ingresoCanaTableClass::AR_LENGHT)));
//      $bandera = true;
//      session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::AR, true), true);
//    }
//    if (strlen($sacarosa) > ingresoCanaTableClass::SACAROSA_LENGHT) {
//      session::getInstance()->setError(i18n::__('errorLenghtSaccharose', NULL, 'default', array('%sacarosa%' => $sacarosa, '%caracteres%' => ingresoCanaTableClass::SACAROSA_LENGHT)));
//      $bandera = true;
//      session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::SACAROSA, true), true);
//    }
//    if (strlen($pureza) > ingresoCanaTableClass::PUREZA_LENGHT) {
//      session::getInstance()->setError(i18n::__('errorLenghtPurity', NULL, 'default', array('%pureza%' => $pureza, '%caracteres%' => ingresoCanaTableClass::PUREZA_LENGHT)));
//      $bandera = true;
//      session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::PUREZA, true), true);
//    }
////validar que el campo sea solo texto
//    if (!ereg("^[A-Za-z]*$", $turno)){
//      session::getInstance()->setError(i18n::__('errorTexto', NULL, 'default'));
//      $bandera = true;
//      session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::PUREZA, true), true);
//    }
// //validar que el campo sea numerico.
//    if (!is_numeric($brix)) {
//      session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'));
//      $bandera = true;
//      session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::BRIX, true), true);
//    }
//    if (!is_numeric($ph)) {
//      session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'));
//      $bandera = true;
//      session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::PH, true), true);
//    }
//    if (!is_numeric($ar)) {
//      session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'));
//      $bandera = true;
//      session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::AR, true), true);
//    }
//    if (!is_numeric($sacarosa)) {
//      session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'));
//      $bandera = true;
//      session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::SACAROSA, true), true);
//    }
//    if (!is_numeric($pureza)) {
//      session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'));
//      $bandera = true;
//      session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::PUREZA, true), true);
//    }
// //validar que no se envie el campo vacio o nulo
//    if($turno === '' or $turno === NULL) {
//      session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'));
//      $bandera = true;
//      session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::TURNO, true), true);
//    }
//    if($brix === '' or $brix === NULL) {
//      session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'));
//      $bandera = true;
//      session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::BRIX, true), true);
//    }
//    if($ph === '' or $ph === NULL) {
//      session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'));
//      $bandera = true;
//      session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::PH, true), true);
//    }
//    if($ar === '' or $ar === NULL) {
//      session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'));
//      $bandera = true;
//      session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::AR, true), true);
//    }
//    if($sacarosa === '' or $sacarosa === NULL) {
//      session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'));
//      $bandera = true;
//      session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::SACAROSA, true), true);
//    }
//    if($pureza === '' or $pureza === NULL) {
//      session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'));
//      $bandera = true;
//      session::getInstance()->setFlash(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::PUREZA, true), true);
//    }
//    if ($bandera === true) {
//      request::getInstance()->setMethod('GET');
//      request::getInstance()->addParamGet(array(ingresoCanaTableClass::ID => request::getInstance()->getPost(ingresoCanaTableClass::getNameField(ingresoCanaTableClass::ID, true))));
//      routing::getInstance()->forward('controlCalidad', 'edit');
//    }
//  }

}
