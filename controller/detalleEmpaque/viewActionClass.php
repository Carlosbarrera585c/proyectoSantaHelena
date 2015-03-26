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
class viewActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $id = request::getInstance()->getRequest(detalleEmpaqueTableClass::ID, true);
            $fields = array(
                detalleEmpaqueTableClass::ID,
                detalleEmpaqueTableClass::CANTIDAD,
                detalleEmpaqueTableClass::INSUMO_ID,
                detalleEmpaqueTableClass::EMPAQUE_ID
            );
           $where = array(
           detalleEmpaqueTableClass::ID => request::getInstance()->getRequest(detalleEmpaqueTableClass::ID)
        );
              $this->objDetalleEmpaque = detalleEmpaqueTableClass::getAll($fields, false, null, null, null, null, $where);
            $this->defineView('view', 'detalleEmpaque', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo $exc->getTraceAsString();
        }
    }

}
