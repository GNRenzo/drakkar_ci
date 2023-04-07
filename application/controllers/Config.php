<?php

class Config extends MY_Controller{
	
	public function __construct() {
        parent::__construct();
        $Usuario = $this->session->userdata('USUARIO');
        if(!$Usuario){
            header('Location: '.base_url('Auth/login') );
        }
        if($Usuario->rol != 'Administrador'){
            header('Location: '.base_url('inicio'));
        }
        $this->load->model('configuracion');
    }

	public function index(){

        $currentMenu = array(
                'id'  => '002'
        );
        
        $this->session->set_userdata('CURRENT_MENU', $currentMenu); 
             
		$this->middle = 'Config/configuracion';
        $this->layout();
	}

    public function loadPermisosPerfiles(){
        if(!$this->input->post())
            header('Location: '.base_url());
        $permisos = $this->configuracion->listarPermisosRol($this->input->post('rol'));
        return $this->responseJsonSuccess('Permisos encontrados',$permisos);
    }

    public function updatePermisoGrupos(){
        if(!$this->input->post())
            header('Location: '.base_url());
        $this->configuracion->actualizaPermiso([
            'create_privilege'                  => $this->input->post('create_privilege'),
            'read_privilege'                    => $this->input->post('read_privilege'),
            'update_privilege'                  => $this->input->post('update_privilege'),
            'delete_pyhysical_privilege'        => $this->input->post('delete_pyhysical_privilege'),
            'delete_logical_privigele'          => $this->input->post('delete_logical_privigele'),
            'download_privigele'                => $this->input->post('download_privigele'),
            'print_privilege'                   => $this->input->post('print_privilege'),
            'preview_privilege'                 => $this->input->post('preview_privilege'),
        ],$this->input->post('key_user_group_menu_assignment'));
        $this->configuracion->actualizaPermisosUsuariosGroup([
            'create_privilege'                  => $this->input->post('create_privilege'),
            'read_privilege'                    => $this->input->post('read_privilege'),
            'update_privilege'                  => $this->input->post('update_privilege'),
            'delete_pyhysical_privilege'        => $this->input->post('delete_pyhysical_privilege'),
            'delete_logical_privilege'          => $this->input->post('delete_logical_privigele'),
            'download_privilege'                => $this->input->post('download_privigele'),
            'print_privilege'                   => $this->input->post('print_privilege'),
            'preview_privilege'                 => $this->input->post('preview_privilege'),
        ],[
            'key_menu'                          => $this->input->post('key_menu'),
            'key_user_group_menu_assignment'    => $this->input->post('key_user_group_menu_assignment')
        ]);
        return $this->responseJsonSuccess('Actualización satisfactoria',[
            'key_user_group_menu_assignment'        => $this->input->post('key_user_group_menu_assignment'),
            'key_menu'                              => $this->input->post('key_menu')
        ]);
    }
}