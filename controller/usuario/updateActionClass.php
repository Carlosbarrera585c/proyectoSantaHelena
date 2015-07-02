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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $id = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::ID, true));
        $usuario = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true));
        $password = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true));

        $this->Validate($usuario, $password);

        $ids = array(
            usuarioTableClass::ID => $id
        );
        $data = array(
            usuarioTableClass::USER => $usuario,
            usuarioTableClass::PASSWORD => $password
        );
        usuarioTableClass::update($ids, $data);
      }
      session::getInstance()->setSuccess(i18n::__('successfulUpdate'));
      session::getInstance()->setAttribute('form_' . usuarioTableClass::getNameTable(), null);
      routing::getInstance()->redirect('usuario', 'index');
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

  private function Validate($usuario, $password) {
    $bandera = false;
    if (strlen($nomEmpleado) > usuarioTableClass::USER_LENGTH) {
      session::getInstance()->setError(i18n::__('errorLengthEmployee', NULL, 'default', array('%usuario%' => $usuario, '%caracteres%' => usuarioTableClass::USER_LENGTH)));
      $bandera = true;
      session::getInstance()->setFlash(usuarioTableClass::getNameField(usuarioTableClass::USER, true), true);
    }
    if ($bandera === true) {
      request::getInstance()->setMethod('GET');
      request::getInstance()->addParamGet(array(usuarioTableClass::ID => request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::ID, true))));
      routing::getInstance()->forward('usuario', 'edit');
    }
  }

}
