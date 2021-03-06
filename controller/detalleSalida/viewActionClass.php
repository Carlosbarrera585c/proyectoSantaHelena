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
* @author Cristian Ramirez <ccritianramirezc@gmail.com>
 */
class viewActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            
             $where = null;
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');
//aqui validar datos
                if ((isset($filter['fechaFB1']) and $filter['fechaFB1'] !== null and $filter['fechaFB1'] !== "") and ( isset($filter['fechaFB2']) and $filter['fechaFB2'] !== null and $filter['fechaFB2'] !== "")) {
                    $where[detalleSalidaTableClass::FECHA_FABRICACION] = array(
                        date(config::getFormatTimestamp(), strtotime($filter['fechaFB1'] . '00:00:00')),
                        date(config::getFormatTimestamp(), strtotime($filter['fechaFB2'] . '23:59:59'))
                    );
                }

                if ((isset($filter['fechaVC1']) and $filter['fechaVC1'] !== null and $filter['fechaVC1'] !== "") and ( isset($filter['fechaVC2']) and $filter['fechaVC2'] !== null and $filter['fechaVC2'] !== "")) {
                    $where[detalleSalidaTableClass::FECHA_VENCIMIENTO] = array(
                        date(config::getFormatTimestamp(), strtotime($filter['fechaVC1'] . '00:00:00')),
                        date(config::getFormatTimestamp(), strtotime($filter['fechaVC2'] . '23:59:59'))
                    );
                }
                if (isset($filter['cantidad']) and $filter['cantidad'] !== null and $filter['cantidad'] !== "") {
                    $where[detalleSalidaTableClass::CANTIDAD] = $filter['cantidad'];
                }

                if (isset($filter['valor']) and $filter['valor'] !== null and $filter['valor'] !== "") {
                    $where[detalleSalidaTableClass::VALOR] = $filter['valor'];
                }
            } else if (session::getInstance()->hasAttribute('detalleEntradaIndexFilters')) {
                $where = session::getInstance()->getAttribute('detalleEntradaIndexFilters');
            }
          
          $idSalida = request::getInstance()->getRequest(salidaBodegaTableClass::ID, true);
            $fieldsSalida = array(
                salidaBodegaTableClass::ID,
                salidaBodegaTableClass::FECHA
            );
            $where = array(
                salidaBodegaTableClass::ID => $idSalida
            );
            $this->objSalidaBodega = salidaBodegaTableClass::getAll($fieldsSalida, false, null, null, null, null, $where);

            $idDetalle = request::getInstance()->getRequest(detalleSalidaTableClass::ID, true);
            $fieldsDetalle = array(
                detalleSalidaTableClass::ID,
                detalleSalidaTableClass::CANTIDAD,
                detalleSalidaTableClass::VALOR,
                detalleSalidaTableClass::FECHA_FABRICACION,
                detalleSalidaTableClass::FECHA_VENCIMIENTO,
                detalleSalidaTableClass::ID_DOC,
                detalleSalidaTableClass::SALIDA_BODEGA_ID,
                detalleSalidaTableClass::INSUMO_ID
            );
            $where = array(
                detalleSalidaTableClass::SALIDA_BODEGA_ID=> $idDetalle
            );
            
            $orderBy = array(
                detalleSalidaTableClass::ID
            );
            
            $page = 0;

            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $this->cntPages = detalleSalidaTableClass:: getTotalPages(config::getRowGrid(), $where);

            
            $this->objDetalleSalida = detalleSalidaTableClass::getAll($fieldsDetalle, false, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            $this->defineView('view', 'detalleSalida', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo $exc->getTraceAsString();
        }
    }

}
