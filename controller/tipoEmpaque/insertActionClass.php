<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of Tipo Empaque
 *
 * @author Carlos Barrera <cabarrera22@misena.edu.co>
 */
class insertActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $this->defineView('insert', 'tipoEmpaque', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo $exc->getTraceAsString();
        }
    }

}
