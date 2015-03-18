<?php

use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = insumoTableClass::ID ?>
<?php $desc_insumo = insumoTableClass::DESC_INSUMO ?>
<?php $precio = insumoTableClass::PRECIO ?>
<?php $tipo_insumo_id = insumoTableClass::TIPO_INSUMO_ID ?>

<div class="container container-fluid">
    <h1>Información De Insumo</h1>
    <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('insumo', 'deleteSelect') ?>" method="POST">
        <div style="margin-bottom: 10px; margin-top: 30px">
            <a href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'insert') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
            <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion()">Borrar</a>
            <a href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'index') ?>" class="btn btn-info btn-xs"><?php echo i18n::__('back')?></a>
        </div>
        <table class="table table-bordered table-responsive table-condensed">
            <thead>
                <tr>
                    <th><?php echo i18n::__('id')?></th>
                    <th><?php echo i18n::__('descriptionInput')?></th>
                    <th><?php echo i18n::__('price')?></th>
                    <th><?php echo i18n::__('IdentificatiOfInpuType')?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo ((isset($objInsu) == true) ? $objInsu[0]->$id : '') ?></td>
                    <td><?php echo ((isset($objInsu) == true) ? $objInsu[0]->$desc_insumo : '') ?></td>
                    <td><?php echo ((isset($objInsu) == true) ? $objInsu[0]->$precio : '') ?></td>
                    <td><?php echo ((isset($objInsu) == true) ? $objInsu[0]->$tipo_insumo_id : '') ?></td>
                </tr>
            </tbody>
        </table>
    </form>
    <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('insumo', 'delete') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo insumoTableClass::getNameField(insumoTableClass::ID, true) ?>">
    </form>
</div>