
<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of Empleado
 *
 * @author Carlos Barrera <cabarrera22@misena.edu.co>
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::ID, true));
                $nomEmpleado = trim(request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::NOM_EMPLEADO, true)));
                $apellEmpleado = trim(request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::APELL_EMPLEADO, true)));
//                $telefono = trim(request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true)));
//                $direccion = trim(request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true)));
//                $tipoId = trim(request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::TIPO_ID_ID, true)));
//                $numeroIdentificacion = trim(request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::NUMERO_IDENTIFICACION, true)));
//                $credencialId = trim(request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::CREDENCIAL_ID, true)));
//                $correo = trim(request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true). '_1'));
//                $correo2 = trim(request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true). '_2'));
//                               
                $this->ValidateUpdate($nomEmpleado, $apellEmpleado);

                $ids = array(
                    empleadoTableClass::ID => $id
                );
                $data = array(
                    empleadoTableClass::NOM_EMPLEADO => $nomEmpleado,
                    empleadoTableClass::APELL_EMPLEADO => $apellEmpleado,
//                    empleadoTableClass::TELEFONO => $telefono,
//                    empleadoTableClass::DIRECCION => $direccion,
//                    empleadoTableClass::TIPO_ID_ID => $tipoId,
//                    empleadoTableClass::NUMERO_IDENTIFICACION => $numeroIdentificacion,
//                    empleadoTableClass::CREDENCIAL_ID => $credencialId,
//                    empleadoTableClass::CORREO => $correo,
//                    empleadoTableClass::CORREO => $correo2
                );
                empleadoTableClass::update($ids, $data);
            }
            session::getInstance()->setSuccess(i18n::__('successfulUpdate'));
            session::getInstance()->setAttribute('form_' . empleadoTableClass::getNameTable(), null);
            routing::getInstance()->redirect('empleado', 'index');
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

    private function ValidateUpdate($nomEmpleado, $apellEmpleado) {
        $bandera = FALSE;
        if (strlen($nomEmpleado) > empleadoTableClass::NOM_EMPLEADO_LENGTH) {
            session::getInstance()->setError(i18n::__('errorLengthEmployee', NULL, 'default', array('%nombre%' => $nomEmpleado, '%caracteres%' => empleadoTableClass::NOM_EMPLEADO_LENGTH)), 'errorNombre');
            $bandera = true;
            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::NOM_EMPLEADO, true), true);
        } elseif (!preg_match('/^[a-zA-Z ]*$/', $nomEmpleado)) {
            session::getInstance()->setError(i18n::__('errorText', NULL, 'default', array('%texto%' => $nomEmpleado)), 'errorNombre');
            $bandera = true;
            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::NOM_EMPLEADO, true), true);
        } elseif ($nomEmpleado === NULL) {
            session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'), 'errorNombre');
            $bandera = true;
            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::NOM_EMPLEADO, true), true);
        }
        if (strlen($apellEmpleado) > empleadoTableClass::APELL_EMPLEADO_LENGTH) {
            session::getInstance()->setError(i18n::__('errorLengthLastEmployee', NULL, 'default', array('%apellido%' => $apellEmpleado, '%caracteres%' => empleadoTableClass::APELL_EMPLEADO_LENGTH)), 'errorApellido');
            $bandera = true;
            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::APELL_EMPLEADO, true), true);
        } elseif (!preg_match('/^[a-zA-Z ]*$/', $apellEmpleado)) {
            session::getInstance()->setError(i18n::__('errorText', NULL, 'default', array('%texto%' => $apellEmpleado)), 'errorApellido');
            $bandera = true;
            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::APELL_EMPLEADO, true), true);
        } elseif ($apellEmpleado === NULL) {
            session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'), 'errorApellido');
            $bandera = true;
            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::APELL_EMPLEADO, true), true);
        }
//        if (strlen($telefono) > empleadoTableClass::TELEFONO_LENGTH) {
//            session::getInstance()->setError(i18n::__('errorLengthPhone', NULL, 'default', array('%telefono%' => $telefono, '%caracteres%' => empleadoTableClass::TELEFONO_LENGTH)), 'errorTelefono');
//            $bandera = true;
//            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true), true);
//        } elseif (!is_numeric($telefono)) {
//            session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'), 'errorTelefono');
//            $bandera = true;
//            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true), true);
//        } elseif ($telefono === NULL) {
//            session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'), 'errorTelefono');
//            $bandera = true;
//            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true), true);
//        }
//        if (strlen($direccion) > empleadoTableClass::DIRECCION_LENGTH) {
//            session::getInstance()->setError(i18n::__('errorLengthDirection', NULL, 'default', array('%direccion%' => $direccion, '%caracteres%' => empleadoTableClass::DIRECCION_LENGTH)), 'errorDireccion');
//            $bandera = true;
//            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true), true);
//        } elseif (strlen($direccion) === NULL) {
//            session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'), 'errorDireccion');
//            $bandera = true;
//            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true), true);
//        }
//        if (strlen($numeroIdentificacion) > empleadoTableClass::NUMERO_IDENTIFICACION_LENGTH) {
//            session::getInstance()->setError(i18n::__('errorLengthNumIdentification', NULL, 'default', array('%numIdentification%' => $numeroIdentificacion, '%caracteres%' => empleadoTableClass::NUMERO_IDENTIFICACION_LENGTH)), 'errorNumeroIdentificacion');
//            $bandera = true;
//            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::NUMERO_IDENTIFICACION, true), true);
//        } elseif (!is_numeric($numeroIdentificacion)) {
//            session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'), 'errorNumeroIdentificacion');
//            $bandera = true;
//            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::NUMERO_IDENTIFICACION, true), true);
//        } elseif ($numeroIdentificacion === NULL) {
//            session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'), 'errorNumeroIdentificacion');
//            $bandera = true;
//            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::NUMERO_IDENTIFICACION, true), true);
//        }
//        if ($correo !== $correo2) {
//            session::getInstance()->setError(i18n::__('errorMail', NULL, 'default'), 'errorCorreo');
//            $bandera = true;
//            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true), true);
//        } else if (filter_var(strlen($correo), FILTER_VALIDATE_EMAIL)) {
//            session::getInstance()->setError(i18n::__('errorMailCharacters', NULL, 'default'), 'errorCorreo');
//            $bandera = true;
//            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true), true);
//        } elseif (strlen($correo) === NULL) {
//            session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'), 'errorCorreo');
//            $bandera = true;
//            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true), true);
//        }
//        if (strlen($correo2) === NULL) {
//            session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'), 'errorCorreo');
//            $bandera = true;
//            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true), true);
//        }
//        if ($tipoId === NULL) {
//            session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'), 'errorTipoId');
//            $bandera = true;
//            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::TIPO_ID_ID, true), true);
//        } elseif (!is_numeric($tipoId)) {
//            session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'), 'errorTipoId');
//            $bandera = true;
//            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::TIPO_ID_ID, true), true);
//        }
//        if ($credencialId === NULL) {
//            session::getInstance()->setError(i18n::__('errorNull', NULL, 'default'), 'errorCredencial');
//            $bandera = true;
//            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::CREDENCIAL_ID, true), true);
//        } elseif (!is_numeric($credencialId)) {
//            session::getInstance()->setError(i18n::__('errorNumeric', NULL, 'default'), 'errorCredencial');
//            $bandera = true;
//            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::CREDENCIAL_ID, true), true);
//        }
        if ($bandera === true) {
            request::getInstance()->setMethod('GET');
            request::getInstance()->addParamGet(array(empleadoTableClass::ID => request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::ID, TRUE))));
            routing::getInstance()->forward('empleado', 'edit');
        }
    }

}
