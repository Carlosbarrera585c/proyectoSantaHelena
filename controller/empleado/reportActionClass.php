<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class reportActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
     empleadoTableClass::ID,
     empleadoTableClass::NOM_EMPLEADO,
     empleadoTableClass::APELL_EMPLEADO,
     empleadoTableClass::TELEFONO,
     empleadoTableClass::DIRECCION,
     empleadoTableClass::TIPO_ID_ID,
     empleadoTableClass::CREDENCIAL_ID,
     empleadoTableClass::CORREO,
     empleadoTableClass::NUMERO_IDENTIFICACION
      );
      $this->objEmpleado = empleadoTableClass::getAll($fields, FALSE);
      $this->defineView('index', 'empleado', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}




