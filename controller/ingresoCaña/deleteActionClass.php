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
 * @author Bayron Henao <bairon_henao_1995.com>
 */
class deleteActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(ingresoCañaTableClass::getNameField(ingresoCañaTableClass::ID, true));

                $ids = array(
                    ingresoCañaTableClass::ID => $id
                );
                ingresoCañaTableClass::delete($ids, false);
                $this->arrayAjax = array(
                    'code' => 200,
                    'msg' => 'La Eliminación Fue Exitosa'
                );
                $this->defineView('delete', 'controlCalidad', session::getInstance()->getFormatOutput());
                session::getInstance()->setSuccess(i18n::__('successfulDelete'));
            } else {
                routing::getInstance()->redirect('ingresoCaña', 'index');
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo $exc->getTraceAsString();
        }
    }
}