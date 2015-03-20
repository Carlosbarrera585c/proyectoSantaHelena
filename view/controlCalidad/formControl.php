<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>
<?php $id = controlCalidadTableClass::ID ?>
<?php $fecha = controlCalidadTableClass::FECHA ?>
<?php $turno = controlCalidadTableClass::TURNO ?>
<?php $brix = controlCalidadTableClass::BRIX ?>
<?php $ph = controlCalidadTableClass::PH ?>
<?php $ar = controlCalidadTableClass::AR ?>
<?php $sacarosa = controlCalidadTableClass::SACAROSA ?>
<?php $pureza = controlCalidadTableClass::PUREZA ?>
<?php $empleado_id = controlCalidadTableClass::EMPLEADO_ID ?>
<?php $proveedor_id = controlCalidadTableClass::PROVEEDOR_ID ?>
<form class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('controlCalidad', ((isset($objControlCalidad)) ? 'update' : 'create')) ?>">
    <?php if (isset($objControlCalidad) == true): ?>
        <input name="<?php echo controlCalidadTableClass::getNameField(controlCalidadTableClass::ID, true) ?>" value="<?php echo $objControlCalidad[0]->$id ?>" type="hidden">
    <?php endif ?>
    <div class="container container-fluid">
        <?php view::includeHandlerMessage() ?>
        <div class="form-group">
            <label class="col-lg-2 control-label"><?php echo i18n::__('date') ?>:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" value="<?php echo ((isset($objControlCalidad) == true) ? $objControlCalidad[0]->$fecha : '') ?>" name="<?php echo controlCalidadTableClass::getNameField(controlCalidadTableClass::FECHA, true) ?>" placeholder="Introduce La Fecha">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label" ><?php echo i18n::__('turn') ?>:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" value="<?php echo ((isset($objControlCalidad) == true) ? $objControlCalidad[0]->$turno : '') ?>" name="<?php echo controlCalidadTableClass::getNameField(controlCalidadTableClass::TURNO, true) ?>" placeholder="Introduce El Turno">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label"><?php echo i18n::__('brix') ?>:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" value="<?php echo ((isset($objControlCalidad) == true) ? $objControlCalidad[0]->$brix : '') ?>" name="<?php echo controlCalidadTableClass::getNameField(controlCalidadTableClass::BRIX, true) ?>" placeholder="Introduce Los Grados Brix">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label"><?php echo i18n::__('ph') ?>:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" value="<?php echo ((isset($objControlCalidad) == true) ? $objControlCalidad[0]->$ph : '') ?>" name="<?php echo controlCalidadTableClass::getNameField(controlCalidadTableClass::PH, true) ?>" placeholder="Introduce El PH">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label"><?php echo i18n::__('ar') ?>:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" value="<?php echo ((isset($objControlCalidad) == true) ? $objControlCalidad[0]->$ar : '') ?>" name="<?php echo controlCalidadTableClass::getNameField(controlCalidadTableClass::AR, true) ?>" placeholder="Introduce El AR">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label"><?php echo i18n::__('saccharose') ?>:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" value="<?php echo ((isset($objControlCalidad) == true) ? $objControlCalidad[0]->$sacarosa : '') ?>" name="<?php echo controlCalidadTableClass::getNameField(controlCalidadTableClass::SACAROSA, true) ?>" placeholder="Introduce La Cantidad De Sacarosa">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label"><?php echo i18n::__('purity') ?>:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" value="<?php echo ((isset($objControlCalidad) == true) ? $objControlCalidad[0]->$pureza : '') ?>" name="<?php echo controlCalidadTableClass::getNameField(controlCalidadTableClass::PUREZA, true) ?>" placeholder="Introduce La Pureza">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label"><?php echo i18n::__('idEmployed') ?>:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" value="<?php echo ((isset($objControlCalidad) == true) ? $objControlCalidad[0]->$empleado_id : '') ?>" name="<?php echo controlCalidadTableClass::getNameField(controlCalidadTableClass::EMPLEADO_ID, true) ?>" placeholder="Introduce El Empleado">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label"><?php echo i18n::__('idProvider') ?>:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" value="<?php echo ((isset($objControlCalidad) == true) ? $objControlCalidad[0]->$proveedor_id : '') ?>" name="<?php echo controlCalidadTableClass::getNameField(controlCalidadTableClass::PROVEEDOR_ID, true) ?>" placeholder="Introduce El Proveedor">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-12 col-xs-offset-6">
                <input class="btn btn-success btn-sm" type="submit" value="<?php echo i18n::__(((isset($objControlCalidad)) ? 'update' : 'register')) ?>">
                <a href="<?php echo routing::getInstance()->getUrlWeb('controlCalidad', 'index') ?>" class="btn btn-info btn-sm"><?php echo i18n::__('back') ?></a>
            </div>
        </div>
    </div>
</form>