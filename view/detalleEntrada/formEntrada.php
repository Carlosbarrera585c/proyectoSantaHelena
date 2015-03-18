<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>
<?php $id = detalleEntradaTableClass::ID ?>
<?php $cant = detalleEntradaTableClass::CANTIDAD ?>
<?php $valor = detalleEntradaTableClass::VALOR ?>
<?php $fechaFB = detalleEntradaTableClass::FECHA_FABRICACION ?>
<?php $fechaVC = detalleEntradaTableClass::FECHA_VENCIMIENTO ?>
<?php $idDoc = detalleEntradaTableClass::ID_DOC ?>
<?php $desDoc = tipoDocTableClass::DESC_TIPO_DOC ?>
<?php $enBodegaId = detalleEntradaTableClass::ENTRADA_BODEGA_ID ?>
<?php $fecha = entradaBodegaTableClass::FECHA ?>
<?php $insuId = detalleEntradaTableClass::INSUMO_ID ?>
<?php $descInsu = insumoTableClass::DESC_INSUMO ?>

<form class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('detalleEntrada', ((isset($objDetalleEntrada)) ? 'update' : 'create')) ?>">
    <?php if (isset($objDetalleEntrada) == true): ?>
        <input name="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID, true) ?>" value="<?php echo $objDetalleEntrada[0]->$id ?>" type="hidden">
    <?php endif ?>
    <div class="container container-fluid">
        <?php view::includeHandlerMessage() ?>
        <div class="form-group">
            <label class="col-lg-2 control-label"><?php echo i18n::__('amount') ?>:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" value="<?php echo ((isset($objDetalleEntrada) == true) ? $objDetalleEntrada[0]->$cant : '') ?>" name="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::CANTIDAD, true) ?>" placeholder="Introduce la Cantidad">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label" ><?php echo i18n::__('value') ?>:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" value="<?php echo ((isset($objDetalleEntrada) == true) ? $objDetalleEntrada[0]->$valor : '') ?>" name="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, true) ?>" placeholder="Introduce el Valor">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label" ><?php echo i18n::__('manuFacturingDate') ?>:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" value="<?php echo ((isset($objDetalleEntrada) == true) ? $objDetalleEntrada[0]->$fechaFB : '') ?>" name="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::FECHA_FABRICACION, true) ?>" placeholder="Introduce la Fecha de Fabricacion">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label"><?php echo i18n::__('expirationDate') ?>:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" value="<?php echo ((isset($objDetalleEntrada) == true) ? $objDetalleEntrada[0]->$fechaVC : '') ?>" name="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::FECHA_VENCIMIENTO, true) ?>" placeholder="Introduce la Fecha de Vencimiento">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label"><?php echo i18n::__('idDoc') ?>:</label>
            <div class="col-lg-10">
                <select class="form-control" id="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID, TRUE) ?>" name="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID_DOC, TRUE) ?>">
                    <?php foreach ($objTipoDoc as $tipoDoc): ?>
                        <option value="<?php echo $tipoDoc->$idDoc ?>">
                            <?php echo $tipoDoc->$desDoc ?>
                        </option>   
                    <?php endforeach ?>
                </select>
            </div> 
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label"><?php echo i18n::__('idEntrance') ?>:</label>
            <div class="col-lg-10">
                <select class="form-control" id="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID, TRUE) ?>" name="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, TRUE) ?>">
                    <?php foreach ($objEntradaBodega as $entradaB): ?>
                        <option value="<?php echo $entradaB->$enBodegaId ?>">
                            <?php echo $entradaB->$fecha ?>
                        </option>   
                    <?php endforeach ?>
                </select>
            </div> 
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label"><?php echo i18n::__('idInput') ?>:</label>
            <div class="col-lg-10">
                <select class="form-control" id="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID, TRUE) ?>" name="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::INSUMO_ID, TRUE) ?>">
                    <?php foreach ($objInsu as $insu): ?>
                        <option value="<?php echo $insu->$insuId ?>">
                            <?php echo $insu->$descInsu ?>
                        </option>   
                    <?php endforeach ?>
                </select>
            </div> 
        </div>
        <div class="form-group">
            <div class="col-lg-12 col-xs-offset-6">
                <input class="btn btn-success btn-sm" type="submit" value="<?php echo i18n::__(((isset($objDetalleEntrada)) ? 'update' : 'register')) ?>">
                <a href="<?php echo routing::getInstance()->getUrlWeb('detalleEntrada', 'index') ?>" class="btn btn-info btn-sm"><?php echo i18n::__('back') ?></a>
            </div>
        </div>
    </div>
</form>