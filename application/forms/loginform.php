<?php

class loginForm extends Form {

    public function __construct() {

        parent::__construct(array('prefix' => 'frm'));

    }

    public function getFields() {

        return array(

            'USER' => array('type' => 'TEXT', 'length' => 64, 'class' => 'form-control validate[required] text-input cTamaño_w200 cColor_obligatorio'),

            'CLAVE' => array('type' => 'TEXT', 'length' => 25, 'class' => 'form-control validate[required] text-input cTamaño_w200 cColor_obligatorio'),
            
			'SUCURSAL' => array('type' => 'TEXT', 'length' => 25, 'class' => 'form-control validate[required] text-input cTamaño_w200 cColor_obligatorio'),

            'CAPTCHA' => array('type' => 'TEXT'),

            'CORREO' => array('type' => 'TEXT', 'length' => 64, 'class' => 'form-control validate[required] text-input cTamaño_w200 cColor_obligatorio') //para recuperar contraseña

        );

    }


    public function checkUser($user) {

        $this->ci->load->model('user');

        $asUser = $this->ci->user->checkUser($user);

        if ($asUser) {

            $this->ci->session->set_userdata('USUARIO', $asUser);


            return TRUE;

        }

        return FALSE;

    }

    public function authenticate() {
        /*ini_set ("display_errors", "1");
        error_reporting(E_ALL);*/
        $this->ci->load->model('user');

        $this->ci->load->model('encriptar_model');

        $this->ci->load->model('permisos_model');

        
        $password = $this->ci->encriptar_model->encriptar($this->CLAVE->value);
        $asUser = $this->ci->user->authenticate_Nisira($this->USER->value, $password);


        $permisos = $this->ci->permisos_model->getByMenuPermisos($asUser['idusuario']);
         if($permisos){
            if ($asUser) {

                $this->ci->session->set_userdata('USUARIO', $asUser);

                return TRUE;

            }
        }        

        return FALSE;

    }  

}

