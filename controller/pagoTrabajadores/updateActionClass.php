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
* @author Cristian Ramirez <cristianRamirezXD@outlook.es>
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $idPG = request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::ID, true));
        $fecha = request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA, true));
        $periodo_inicio = request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::PERIODO_INICIO, true));
        $periodo_fin = request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::PERIODO_FIN, true));
        $id_empresa = request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::EMPRESA_ID, true));

        $ids = array(
            pagoTrabajadoresTableClass::ID => $idPG
        );

        $data = array(
            pagoTrabajadoresTableClass::FECHA => $fecha,
            pagoTrabajadoresTableClass::PERIODO_INICIO => $periodo_inicio,
            pagoTrabajadoresTableClass::PERIODO_FIN => $periodo_fin,
            pagoTrabajadoresTableClass::EMPRESA_ID => $id_empresa
        );

        pagoTrabajadoresTableClass::update($ids, $data);
      }
      session::getInstance()->setSuccess(i18n::__('successfulUpdate'));
      routing::getInstance()->redirect('pagoTrabajadores', 'index');
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}