<?php 


class Vacaciones extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('Vacaciones_model');
    }


    public function index(){

        $currentMenu = array(
            'id'  => '089'
        );
        $this->session->set_userdata('CURRENT_MENU', $currentMenu); 

        $currentMenuItem = array(
            'id'  => '093'
        );
        $this->session->set_userdata('CURRENT_MENU_ITEM', $currentMenuItem);


		$listaEmpleado = $this->Vacaciones_model->getEmpleadoVacaciones();
		$listaPeriodo = $this->Vacaciones_model->getPeriodos();
		$listaCierre = $this->Vacaciones_model->getCierre();
		$listaJefes = $this->Vacaciones_model->getJefes();
		$listaAreas = $this->Vacaciones_model->getAreas();

		$listaEmpleadoInput[ '0' ] = 'TODOS';
		$listaPeriodoInput[ '0' ] = 'TODOS';
		$listaCierreInput[ '0' ] = 'TODOS';
		$listaJefeInput[ '0' ] = 'TODOS';
		$listaAreaInput[ '0' ] = 'TODOS';

		if(!empty($listaEmpleado)){
			foreach($listaEmpleado as $elem){
				//$listaEmpleadoInput[ $elem['idempleado'] ] = $elem['nombres'].' - '.$elem['dni'] ;
				$listaEmpleadoInput[ $elem['dni'] ] = $elem['nombres'].' - '.$elem['dni'] ;
			}
		}
		if(!empty($listaPeriodo)){
			foreach($listaPeriodo as $elem){
				$listaPeriodoInput[ $elem['descripcion'] ] = $elem['descripcion'];

			}
		}
		if(!empty($listaCierre)){
			foreach($listaCierre as $elem){
				$listaCierreInput[ $elem['fecha_corte'] ] = $elem['fecha_corte_tochar'];

			}
		}
		if(!empty($listaJefes)){
			foreach($listaJefes as $elem){
				$listaJefeInput[ $elem['dni'] ] = $elem['nombres'];

			}
		}
		if(!empty($listaAreas)){
			foreach($listaAreas as $elem){
				$listaAreaInput[ $elem['area'] ] = $elem['area_tex'];

			}
		}

		$this->data = [
			'listaEmpleadoInput'=>$listaEmpleadoInput,
			'listaPeriodoInput'=>$listaPeriodoInput,
			'listaCierreInput'=>$listaCierreInput,
			'listaJefeInput'=>$listaJefeInput,
			'listaAreaInput'=>$listaAreaInput,
		];


		$this->middle = 'vacaciones/vacacionesView';
        $this->layout();
    }

	public function listar(){

		$resultado = $this->Vacaciones_model->listar();
		$json["resultado"] = $resultado;
		$json["state"]=true;

		echo json_encode($json);
	}

}


