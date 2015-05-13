<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of Empleado
 *
 * @author Carlos Barrera <cabarrera22@misena.edu.co>
 */
class deleteSelectActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->hasPost('chk')) {

        $idsToDelete = request::getInstance()->getPost('chk');
        foreach ($idsToDelete as $id) {
          $ids = array(
              empleadoTableClass::ID => $id
          );
          empleadoTableClass::delete($ids, false);
        }
        session::getInstance()->setSuccess(i18n::__('successfulDelete'));
        routing::getInstance()->redirect('empleado', 'index');
      } else {
        routing::getInstance()->redirect('empleado', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
      switch ($exc->getCode()) {
        case 23503:
          session::getInstance()->setError(i18n::__('errorDeleteForeign'));
          routing::getInstance()->redirect('empleado', 'index');
          break;
        case 00000:
          break;
      }
    }
  }

}
