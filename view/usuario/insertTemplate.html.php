<?php

use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>
<?php view::includePartial('menu/menu') ?>
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1><i class="fa fa-plus"> <?php echo i18n::__('newUser') ?></i></h1>
    </div>
<?php view::includePartial('usuario/formUser') ?>
</div>
