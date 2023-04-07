<?php

class Auth extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('loginForm');
		$this->load->model('loginApi');
        $this->load->model('Usuario_model','usuarioModel');
    }

    public function index() {

		if(!$this->session->userdata('USUARIO')){//condicion: si está logueado (sesion iniciada) ya no muestra el Login

			$this->loginForm->set_action('Auth/login');

            //Ini
			$this->load->model('Sucursal_model');
			$lista = $this->Sucursal_model->listarSucursales();
			if(!empty($lista)){
				foreach($lista as $elem){
					$listaSucursales[ $elem['idsucursal'] ] = $elem['nombre'];
				}
			}

			$this->load->view('login', array('form' => $this->loginForm, 'listaSucursales'=>$listaSucursales));
			//fin

		} else {
			redirect('inicio');
		}
    }

	public function login(){
		if($this->session->userdata('USUARIO'))
			redirect('inicio'); //si ya
		if(!$this->input->post())
			redirect('inicio');
		$this->config->load('urls_api',true);
		$urls = $this->config->item('urls_api');
		$u = $this->loginApi->validateLogin($urls['api_smart_agro'],$this->input->post());
        if($u){
            $usu = $this->usuarioModel->searchUserFromApi($u->username);
            if(is_numeric($usu)){
                $usu = [
                    'username'          => $u->username,
                    'nombres'           => $u->name,
                    'email_corporate'   => $u->email,
                    'dni'               => $u->dni,
                    'token'             => $u->jti,
                    'rol'               => $u->rol,
                    'user_id'           => $u->user_id
                ];
                $usu['key_user'] = $this->usuarioModel->newUserFromApi($usu);
                $usu = (object) $usu;
            }
            $this->usuarioModel->startSession($usu);
            header('Location: '.base_url('inicio'));
            echo '<pre>';
            var_dump($usu);
            echo '</pre>';
            exit();
        }
        else{
            $this->session->set_userdata('ERROR_LOGIN',true);
            header('Location: '.base_url('auth'));
        }
	}

    public function login2() {

        if($this->session->userdata('USUARIO'))
        redirect('inicio'); //si ya

        $asPostData = $this->input->post('frm');
        $this->loginForm->setData($asPostData);
        //LOGUEO CORRECTO
        if ($this->loginForm->authenticate()){

            redirect('inicio');
            // $this->middle = 'inicio';
            // $this->layout();
        }
        //NO SE PUDO LOGUEAR
            $this->loginForm->set_action('Auth/login');

           //Ini
			$this->load->model('Sucursal_model');
			$lista = $this->Sucursal_model->listarSucursales();
			if(!empty($lista)){
				foreach($lista as $elem){
					$listaSucursales[ $elem['idsucursal'] ] = $elem['nombre'];
				}
			}

            $this->session->set_userdata('ERROR_LOGIN', TRUE);
			$this->load->view('login', array('form' => $this->loginForm, 'listaSucursales'=>$listaSucursales));

			//Fin

            // $this->data = array('error' => TRUE, 'form' => $this->loginForm);

            // $this->middle = 'login';
            // $this->layout();

    }

    public function logout() {
        $this->session->unset_userdata('USUARIO');
        $this->session->unset_userdata('PERMISOS');
        redirect('/');
        //$this->load->view('login', array('error' => TRUE, 'form' => $this->loginForm, 'CAPTCHA' => $this->loginForm->generateCaptcha()));
    }


        public function forgot() {
        // $nombre = $this->input->post('txtNombre');
        // $correo = $this->input->post('txtCorreo');

        // $nombre = 'Terrones Ortiz alberto';
        // $correo = 'luis.terrones@agrovision.com.pe';
        // $idUser = 'luis.terrones';

        $nombre = $this->input->get('txtNombre');
        $correo = $this->input->get('txtCorreo');
        $idUser = $this->input->get('txtUser');

        $this->data = [
            'nombre'=>$nombre,
            'correo'=>$correo,
            'idUser'=>$idUser
        ];

        $this->session->unset_userdata('USUARIO');
        $this->session->unset_userdata('PERMISOS');

        $this->loginForm->set_action('Auth/forgot');

        $this->load->view('forgot', array('form' => $this->loginForm));

    }


    public function forgot_actualizar_clave() {

        $idUser = $this->input->post('txtIdUser');
        $nombreUser = $this->input->post('txtNombreUser');
        $newClave = base64_encode($this->input->post('txtNewClave'));

        $json["resultado"] = [];

        $db_dms = $this->load->database('dbdms', TRUE);

        $sql_dms = " update public.usuario 
                set password = '".$newClave."' 
                where upper(idusuario) = upper('".$idUser."') ";

        $db_dms->query($sql_dms);


        $sql_agvbi = " update public.usuario 
                set password = '".$newClave."' 
                where upper(idusuario) = upper('".$idUser."') ";

        $this->db->query($sql_agvbi);


        $json["state"]=true;

        echo json_encode($json);

    }

}
