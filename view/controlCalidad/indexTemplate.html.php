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
<?php view::includePartial('empleado/menu') ?>
<div class="container container-fluid">
  <!-- Uso de ventana modal para reportes con filtro-->
  <div class="modal fade" id="myModalFILTROSREPORTE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('generate report') ?></h4>
        </div>
        <div class="modal-body">
          <form method="POST" class="form-horizontal" id="reportFilterForm" action="<?php echo routing::getInstance()->getUrlWeb('controlCalidad', 'report') ?>">
            <div class="form-group">
              <label for="reportDate1" class="col-sm-2 control-label"><?php echo i18n::__('date') ?></label>
              <div class="col-sm-10">
                <input type="date" name="report[fechaCreacion1]" class="form-control" id="filterCreacion1" placeholder="<?php echo i18n::__('date') ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="reportDate1" class="col-sm-2 control-label"><?php echo i18n::__('date') ?></label>
              <div class="col-sm-10">
                <input type="date" name="report[fechaCreacion2]" class="form-control" id="filterCreacion2" placeholder="<?php echo i18n::__('date') ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="reportTurno" class="col-sm-2 control-label"><?php echo i18n::__('turn') ?></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="filterTurno" name="report[Turno]" placeholder="<?php echo i18n::__('turn') ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="reportBrix" class="col-sm-2 control-label"><?php echo i18n::__('brix') ?></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="filterBrix" name="report[Brix]" placeholder="<?php echo i18n::__('brix') ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="reportPh" class="col-sm-2 control-label"><?php echo i18n::__('ph') ?></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="filterPh" name="report[Ph]" placeholder="<?php echo i18n::__('ph') ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="reportAr" class="col-sm-2 control-label"><?php echo i18n::__('ar') ?></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="filterAr" name="report[Ar]" placeholder="<?php echo i18n::__('ar') ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="reportSacarosa" class="col-sm-2 control-label"><?php echo i18n::__('saccharose') ?></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="filterSacarosa" name="report[Sacarosa]" placeholder="<?php echo i18n::__('saccharose') ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="reportPureza" class="col-sm-2 control-label"><?php echo i18n::__('purity') ?></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="filterPureza" name="report[Pureza]" placeholder="<?php echo i18n::__('purity') ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="reportEmpleado" class="col-sm-2 control-label"><?php echo i18n::__('idEmployed') ?></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="filterPureza" name="report[Empleado]" placeholder="<?php echo i18n::__('idEmployed') ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="reportProveedor" class="col-sm-2 control-label"><?php echo i18n::__('idProvider') ?></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="filterPureza" name="report[Proveedor]" placeholder="<?php echo i18n::__('idProvider') ?>">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
          <button type="button" onclick="$('#reportFilterForm').submit()" class="btn btn-primary"><?php echo i18n::__('generate') ?></button>
        </div>
      </div>
    </div>
  </div>
<!--Ventana modal para uso de filtros-->
  <div class="modal fade" id="myModalFilters" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filters') ?></h4>
        </div>
        <div class="modal-body">
          <form method="POST" role="form" class="form-horizontal" id="filterForm" action="<?php echo routing::getInstance()->getUrlWeb('controlCalidad', 'index') ?>">
            <div class="form-group">
              <label for="filterFecha" class="col-sm-2 control-label"><?php echo i18n::__('date') ?></label>
              <div class="col-sm-10">
                <input type="date" class="form-control" id="filterFecha1" name="filter[fecha1]" placeholder="<?php echo i18n::__('date') ?>">
                <br>
                <input type="date" class="form-control" id="filterFecha2" name="filter[fecha2]" placeholder="<?php echo i18n::__('date') ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="filterTurno" class="col-sm-2 control-label"><?php echo i18n::__('turn') ?></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="filterTurno" name="filter[Turno]" placeholder="<?php echo i18n::__('turn') ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="filterBrix" class="col-sm-2 control-label"><?php echo i18n::__('brix') ?></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="filterBrix" name="filter[Brix]" placeholder="<?php echo i18n::__('brix') ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="filterPh" class="col-sm-2 control-label"><?php echo i18n::__('ph') ?></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="filterApellido" name="filter[Ph]" placeholder="<?php echo i18n::__('ph') ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="filterAr" class="col-sm-2 control-label"><?php echo i18n::__('ar') ?></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="filterAr" name="filter[Ar]" placeholder="<?php echo i18n::__('ar') ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="filterSacarosa" class="col-sm-2 control-label"><?php echo i18n::__('saccharose') ?></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="filterSacrosa" name="filter[Sacarosa]" placeholder="<?php echo i18n::__('saccharose') ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="filterPureza" class="col-sm-2 control-label"><?php echo i18n::__('purity') ?></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="filterPureza" name="filter[Pureza]" placeholder="<?php echo i18n::__('purity') ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="filterEmpleado" class="col-sm-2 control-label"><?php echo i18n::__('idEmployed') ?></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="filterEmpleado" name="filter[Empleado]" placeholder="<?php echo i18n::__('idEmployed') ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="filterProveedor" class="col-sm-2 control-label"><?php echo i18n::__('idProvider') ?></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="filterProveedor" name="filter[Proveedor]" placeholder="<?php echo i18n::__('idProvider') ?>">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
          <button type="button" onclick="$('#filterForm').submit()" class="btn btn-primary"><?php echo i18n::__('filtrate') ?></button>
        </div>
      </div>
    </div>
  </div>
  <div class="page-header titulo">
    <h1><i class="glyphicon glyphicon-th-list"><?php echo i18n::__('qualityControl') ?></i></h1>
  </div>


  <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('controlCalidad', 'deleteSelect') ?>" method="POST">
    <div style="margin-bottom: 10px; margin-top: 30px">
      <a href="<?php echo routing::getInstance()->getUrlWeb('controlCalidad', 'insert') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
      <a href="javascript:eliminarMasivo()" class="btn btn-danger btn-xs" id="btnDeleteMass" data-toggle="modal" data-target="#myModalDeleteMass"><?php echo i18n::__('deleteSelect') ?></a>
      <button type="button" data-toggle="modal" data-target="#myModalFilters" class="btn btn-primary  btn-xs"><?php echo i18n::__('filters') ?></button>
      <a href="<?php echo routing::getInstance()->getUrlWeb('controlCalidad', 'deleteFilters') ?>" class="btn btn-default btn-xs"><?php echo i18n::__('deleteFilters') ?></a>
      <a class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModalFILTROSREPORTE" ><?php echo i18n::__('printReport') ?></a>
    </div>
    <?php view::includeHandlerMessage() ?>
    <table class="tablaUsuario table table-bordered table-responsive table-hover">
      <thead>
        <tr class="columna success">
          <th class="tamano"><input type="checkbox" id="chkAll"></th>
          <th><?php echo i18n::__('date') ?></th>
          <th><?php echo i18n::__('idEmployed') ?></th>
          <th><?php echo i18n::__('idProvider') ?></th>
          <th class="tamanoAccion"><?php echo i18n::__('actions') ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($objControlCalidad as $control): ?>
          <tr class="columna">
            <td><input type="checkbox" name="chk[]" value="<?php echo $control->$id ?>"></td>
            <td><?php echo $control->$fecha ?></td>
            <td><?php echo controlCalidadTableClass::getNameEmpleado($control->$empleado_id) ?></td>
            <td><?php echo controlCalidadTableClass::getNameProveedor($control->$proveedor_id) ?></td>
            <td>
              <a href="<?php echo routing::getInstance()->getUrlWeb('controlCalidad', 'view', array(controlCalidadTableClass::ID => $control->$id)) ?>" class="btn btn-info btn-xs"><?php echo i18n::__('view') ?></a></a>
              <a href="<?php echo routing::getInstance()->getUrlWeb('controlCalidad', 'edit', array(controlCalidadTableClass::ID => $control->$id)) ?>" class="btn btn-primary btn-xs"><?php echo i18n::__('edit') ?></a></a>
              <a href="#" data-toggle="modal" data-target="#myModalDelete<?php echo $control->$id ?>" class="btn btn-danger btn-xs"><?php echo i18n::__('delete') ?></a>
            </td>
          </tr>
        <div class="modal fade" id="myModalDelete<?php echo $control->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirmDelete') ?></h4>
              </div>
              <div class="modal-body">
                <?php echo i18n::__('questionDelete') ?> <?php echo $control->$id ?>?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                <button type="button" class="btn btn-primary" onclick="eliminar(<?php echo $control->$id ?>, '<?php echo controlCalidadTableClass::getNameField(controlCalidadTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('controlCalidad', 'delete') ?>')"><?php echo i18n::__('confirmDelete') ?></button>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach ?>
      </tbody>
    </table>
  </form>
  <div class="text-right">
    pagina  <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('controlCalidad', 'index') ?>')">
      <?php for ($x = 1; $x <= $cntPages; $x++): ?>
        <option <?php echo(isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
      <?php endfor ?>
    </select> de <?php echo $cntPages; ?>     
  </div>
  <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('controlCalidad', 'delete') ?>" method="POST">
    <input type="hidden" id="idDelete" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>">
  </form>
</div>
<div class="modal fade" id="myModalDeleteMass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirmDeleteMass') ?></h4>
      </div>
      <div class="modal-body">
        <?php echo i18n::__('confirmDeleteMass') ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
        <button type="button" class="btn btn-primary" onclick="$('#frmDeleteAll').submit()"><?php echo i18n::__('confirmDelete') ?></button>
      </div>
    </div>
  </div>
</div>
</div>
