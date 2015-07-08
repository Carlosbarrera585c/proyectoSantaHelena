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
 *  @author Cristian Ramirez <cristianRamirezXD@outlook.es>
 */
class deleteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {

        $id = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::ID, true));
        
        $ids = array(
            proveedorTableClass::ID => $id
        );
        proveedorTableClass::delete($ids, false);
        //routing::getInstance()->redirect('ciudad', 'index');
        $this->arrayAjax = array(
          'code'=> 200, 
          'msg' => 'La eliminacion del registro fue exitosa'
        );
        session::getInstance()->setSuccess(i18n::__('successfulDelete'));
        $this->defineView('delete', 'proveedor', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('proveedor', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
