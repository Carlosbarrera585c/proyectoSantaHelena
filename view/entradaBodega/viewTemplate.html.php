<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>
<?php $id = entradaBodegaTableClass::ID ?>
<?php $fecha = entradaBodegaTableClass::FECHA ?>
<?php $provee = proveedorTableClass::ID ?>
<?php $proveeRS = proveedorTableClass::RAZON_SOCIAL ?>
<?php view::includePartial('empleado/menu') ?>
<div class="container container-fluid">
    <div class="page-header  text-center titulo">
        <h1><i class="glyphicon glyphicon-user"> <?php echo i18n::__('infoCellarEntrance') ?></i></h1>
    </div>
    <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('entradaBodega', 'deleteSelect') ?>" method="POST">
        <div style="margin-bottom: 10px; margin-top: 30px">
            <a href="<?php echo routing::getInstance()->getUrlWeb('entradaBodega', 'insert') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
            <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion()"><?php echo i18n::__('delete') ?></a>
            <a href="<?php echo routing::getInstance()->getUrlWeb('entradaBodega', 'index') ?>" class="btn btn-info btn-xs"><?php echo i18n::__('back') ?></a>
        </div>
        <table class="table table-bordered table-responsive table-condensed">
            <thead>
                <tr>
                    <th><?php echo i18n::__('id') ?></th>
                    <th><?php echo i18n::__('date') ?></th>
                    <th><?php echo i18n::__('provider') ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo ((isset($objEntradaBodega) == true) ? $objEntradaBodega[0]->$id : '') ?></td>
                    <td><?php echo ((isset($objEntradaBodega) == true) ? $objEntradaBodega[0]->$fecha : '') ?></td>
                    <td><?php echo ((isset($objProveedor) == true) ? $objProveedor[0]->$proveeRS : '') ?></td>
                </tr>
            </tbody>
        </table>
    </form>
    <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('entradaBodega', 'delete') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID, true) ?>">
    </form>
</div>
