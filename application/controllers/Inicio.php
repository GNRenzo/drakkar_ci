<?php

class Inicio extends MY_Controller{
	
	public function __construct() {
        parent::__construct();
        $this->load->model('Inicio_model');
    }

	public function index(){

        $currentMenu = array(
                'id'  => '001'
        );
        
        $this->session->set_userdata('CURRENT_MENU', $currentMenu); 
             
		$this->middle = 'inicio';
        $this->layout();
	}



	public function listarRecentContract(){


        $json["resultado"] = $this->Inicio_model->listarRecentContract();
        $json["state"]=true;

        echo json_encode($json);
    }

    public function listarRecentMacroprocesses(){


        $json["resultado"] = [];
        $json["resultado"] = $this->Inicio_model->listarRecentMacroprocesses();
        $json["state"]=true;

        echo json_encode($json);
    }

    public function listarLastPublished(){


        $json["resultado"] = [];
        $json["resultado"] = $this->Inicio_model->listarLastPublished();
        $json["state"]=true;

        echo json_encode($json);
    }

    public function listarPendingApproval(){


        $json["resultado"] = [];
        $json["resultado"] = $this->Inicio_model->listarPendingApproval();
        $json["state"]=true;

        echo json_encode($json);
    }

    public function countDocumentByTye(){


        $json["resultado"] = [];
        $json["resultado"] = $this->Inicio_model->countDocumentByTye();
        $json["state"]=true;

        echo json_encode($json);
    }




	
}