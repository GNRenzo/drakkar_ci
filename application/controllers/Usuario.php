<?php 
class Usuario extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Usuario_model');
	}


	public function index(){

		$currentMenu = array(
                'id'  => '050'
        );
        
        $this->session->set_userdata('CURRENT_MENU', $currentMenu); 


        $currentMenuItem = array(
                'id'  => '052'
        );
        $this->session->set_userdata('CURRENT_MENU_ITEM', $currentMenuItem); 

		$this->load->model('Grupo_usuario_model');
		$lista = $this->Grupo_usuario_model->listar();
		if(!empty($lista)){
			foreach($lista as $elem){
				$listaGrupos[ $elem['grus_codigo'] ] = $elem['grus_nombre'];
			}
		}
		
		$listaGrupUserIntranet = $this->Usuario_model->listarGrupoUserIntranet();
		if(!empty($listaGrupUserIntranet)){
			foreach($listaGrupUserIntranet as $elem){
				$listaGruposIntranet[ $elem['grus_codigo'] ] = $elem['grus_nombre'];
			}
		}

		$listaDep = $this->Usuario_model->listarDepartamentos();
		if(!empty($listaDep)){
			foreach($listaDep as $elem){
				$listaDepartamentos[ $elem['codigo'] ] = $elem['nombre'];
			}
		}

		$listaAre = $this->Usuario_model->listarAreas($listaDep[0]['codigo']);
		if(!empty($listaAre)){
			foreach($listaAre as $elem){
				$listaAreas[ $elem['codigo'] ] = $elem['nombre'];
			}
		}

		$listaSecc = $this->Usuario_model->listarSecciones($listaAre[0]['codigo']);
		if(!empty($listaSecc)){
			foreach($listaSecc as $elem){
				$listaSecciones[ $elem['codigo'] ] = $elem['nombre'];
			}
		}

		$listaCar = $this->Usuario_model->listarCargos();
		if(!empty($listaCar)){
			foreach($listaCar as $elem){
				$listaCargos[ $elem['codigo'] ] = $elem['nombre'];
			}
		}
		
		//$lista = $this->Usuario_model->listar();
		//		'lista'=>$lista,
		$this->data = [
			'listaGrupos'=>$listaGrupos,
			'listaGruposIntranet'=>$listaGruposIntranet,
			'listaAreas'=>$listaAreas,
			'listaSecciones' => $listaSecciones,
			'listaDepartamentos' => $listaDepartamentos,
			'listaCargos' => $listaCargos
		];
		$this->middle = 'usuario/usuarioView';
		$this->layout();

	}

	public function getUsuarioList(){

		$json["resultado"] = $this->Usuario_model->listar();
		$json["state"]=true;

		echo json_encode($json);
	}
	
	public function listarAreasAjax(){

		$json["state"]=false;
		
		$json["resultado"] = $this->Usuario_model->listarAreas($this->input->post('departamento'));

		$json["state"]=true;
        
        echo json_encode($json);
	}

	public function listarSeccionAjax(){

		$json["state"]=false;
		
		$json["resultado"] = $this->Usuario_model->listarSecciones($this->input->post('area'));

		$json["state"]=true;
        
        echo json_encode($json);
	}


	public function registrar(){

		$json["state"]=false;

		$json["upload_signature"]=false;

		if ($this->input->post('txtCodigo')) {

			$this->Usuario_model->modificar($this->input->post('txtCodigo'));

        	$this->Usuario_model->registrarActualizarPermisosNuevoUsuario($this->input->post('txtCodigo'));
		}
		
		

		$json["state"]=true;
        
        echo json_encode($json);
	}


	public function registrarNew(){

		$json["state"]=false;
		$this->Usuario_model->registrarNew($this->input->post('txtCodigo'));
		$json["state"]=true;
		echo json_encode($json);
	}



	public function eliminar(){

		$this->Usuario_model->eliminar($this->input->post('idusuario'));
		$json["state"]=true;
		echo json_encode($json);
	}










	public function registrarDatosTrabajador(){

		$json["state"]=false;
		
		$this->Usuario_model->registrarDatosTrabajador();

		$json["state"]=true;
        
        echo json_encode($json);
	}




	public function resetPass(){

		$json["state"]=false;

		$this->Usuario_model->resetPass($this->input->post('idusuario'));

		$json["state"]=true;
        
        echo json_encode($json);
	}

	public function buscar(){
		
		$json["resultado"] = [];
		$json["resultado"] = $this->Usuario_model->buscar($cuenta);
		$json["state"]=true;

		echo json_encode($json);
	}


	public function leer(){

		$json["resultado"] = [];
		$json["resultado"] = $this->Usuario_model->leer($this->input->post('idusuario'));
		$json["state"]=true;

		echo json_encode($json);
	}


	public function listarUsuariosSeguridad(){

		$json["resultado"] = [];
		$json["resultado"] = $this->Usuario_model->listarUsuariosSeguridad($this->input->post('fotr_codigo'));
		$json["state"]=true;

		echo json_encode($json);
	}

	public function listarUsuariosContractViewGood(){

		$json["resultado"] = [];
		$json["resultado"] = $this->Usuario_model->listarUsuariosContractViewGood();
		$json["state"]=true;

		echo json_encode($json);
	}

	public function listarUsuariosContractLegal(){

		$json["resultado"] = [];
		$json["resultado"] = $this->Usuario_model->listarUsuariosContractLegal();
		$json["state"]=true;

		echo json_encode($json);
	}

	public function listarUsuariosRepresentanteLegal(){

		$json["resultado"] = [];
		$json["resultado"] = $this->Usuario_model->listarUsuariosRepresentanteLegal();
		$json["state"]=true;

		echo json_encode($json);
	}

	public function listarUsuariosRepresentanteLegal1M5M(){

		$json["resultado"] = [];
		$json["resultado"] = $this->Usuario_model->listarUsuariosRepresentanteLegal1M5M();
		$json["state"]=true;

		echo json_encode($json);
	}

	public function listarUsuariosActivosPublic(){

		$json["resultado"] = [];
		$json["resultado"] = $this->Usuario_model->listarUsuariosActivosPublic();
		$json["state"]=true;

		echo json_encode($json);
	}



	public function cambiarEstado(){

		$codigo = $this->input->post('codigo');
		$estado = $this->input->post('estado');
		$json["resultado"] = [];
		$json["resultado"] = $this->Usuario_model->cambiarEstado($codigo, $estado);
		$json["state"]=true;

		echo json_encode($json);
	}

	

	public function actualizarNombres(){

		$this->Usuario_model->actualizarNombres();

		redirect('usuario/leerPerfil');

	}

	public function actualizarDatosPersonales(){

		$this->Usuario_model->actualizarDatosPersonales();

		redirect('usuario/leerPerfil');

	}

	public function actualizarOcupacion(){

		$this->Usuario_model->actualizarOcupacion();

		redirect('usuario/leerPerfil');

	}

	public function actualizarIdentificacion(){

		$this->Usuario_model->actualizarIdentificacion();

		redirect('usuario/leerPerfil');

	}

	public function actualizarLugares(){

		$this->Usuario_model->actualizarLugares();

		redirect('usuario/leerPerfil');

	}

	

}