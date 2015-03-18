
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
* @author yefri alexander <yefri-1994@hotmail.com>
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::ID, true));
                $desc_insumo = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true));
                $precio = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::PRECIO, true));
                $tipo_insumo_id= request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, true));
                
                $ids = array(
                    insumoTableClass::ID => $id
                    
                );

                $data = array(
                    insumoTableClass::DESC_INSUMO => $desc_insumo,
                    insumoTableClass::DESC_INSUMO => $desc_insumo,
                    insumoTableClass::PRECIO => $precio,
                    insumoTableClass::TIPO_INSUMO_ID => $tipo_insumo_id
                    
                );

                insumoTableClass::update($ids, $data);
            }
            session::getInstance()->setSuccess(i18n::__('successfulUpdate'));
            
            routing::getInstance()->redirect('insumo', 'index');
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo $exc->getTraceAsString();
        }
    }

}