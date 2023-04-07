<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author Herald Olivares <heraldmatias.oz@gmail.com>
 * Clase base para los controladores en la aplicación
 */
class MY_Controller extends CI_Controller {

    //array asociativo que contiene los nombres de todas las vistas que intervienen
    //para renderizar
    var $template = array();
    //los datos que se pasaran a las vistas
    var $data = array();

    /**
     * Metodo que se utiliza para pintar las vistas con el layout por defecto
     * ubicado en la carpeta views/layout
     * @param bool $footer
     */
    public function layout($use = TRUE) {

        if (!$this->session->userdata('USUARIO'))  {

            redirect('auth');


        }else{

            $arr = array();

            $u = explode('/',$_SERVER['HTTP_REFERER']);
            $c = explode('/',$_SERVER['REQUEST_URI']);
            $controllerRequest = '/'.implode('/',array_diff($c,$u));

            //$controllerRequest = "{$_SERVER['REQUEST_URI']}";

            $Usuario = $this->session->userdata('USUARIO');

            $val = '0';

            $this->data['_user'] = $Usuario;
            $this->data['_use'] = $use;
            //$this->data['_menupermiso'] = $this->setMenuPermisos($Usuario['idusuario']);
            $this->data['_menupermiso'] = $this->session->userdata('PERMISOS');

            $chMessage = $this->session->flashdata('msg');

            $this->template['nav'] = $this->load->view('templates/nav', $this->data, true);
            $this->template['sidebar'] = $this->load->view('templates/sidebar', $this->data, true);
            $arr = $this->data['_menupermiso'];

            // $cr = explode("/", $controllerRequest);

            $permiso = '';

            for ($i=0; $i < count($arr); $i++) {

                $permiso = $arr[$i]["link"];

                if (("/".$permiso) == ($controllerRequest) ) {
                    $val = '1';
                    break;
                }else{
                    //$val = "ENTRA ELSE: Permiso: /".$permiso.' ---- ControllerRequest: '.$controllerRequest;
                     $val = '0';
                }
            }



            if ($controllerRequest == '/'
                || $controllerRequest == '/inicio'
                || $controllerRequest == '/auth'
                || $controllerRequest == '/inicio/profile'
                || $controllerRequest == '/ethics'
                || $controllerRequest == '/about_us'
                || $controllerRequest == '/policies'
                || $controllerRequest == '/financial_files/financials'
                || $controllerRequest == '/financial_files/cash_flow'
                || $controllerRequest == '/financial_files/full_cost'
                || $controllerRequest == '/financial_files/download'
                || $controllerRequest == '/Error_custom/pdfWaterMark'
                || $val == '1' ) {

                // echo "ENTRA IF: /".$item["link"].' ---- '.$controllerRequest. ' ------------- '.$val;

                if (isset($this->middle)) {
                    $this->template['middle'] = $this->load->view($this->middle, $this->data, true);
                } else {
                    $this->template['middle'] = '';
                }
                $this->template['footer'] = $this->load->view('templates/footer', $this->data, true);

                $this->load->view('templates/index', $this->template);

            }else{
                // echo "$controllerRequest";
                redirect('inicio');
                // echo $val.'=================';
                // $this->session->unset_userdata('USUARIO');
                // $this->session->unset_userdata('PERMISOS');
                // redirect('auth');
                // foreach ($this->data['_menupermiso'] as $item):
                //     echo "/".$item["link"].'---';
                // endforeach;
            }
        }
    }







    public function sendMail($aParams = array()) {
        $sEmail = (isset($aParams['sEmail']) && $aParams['sEmail']) ? $aParams['sEmail'] : '';
        $sSubject = (isset($aParams['sSubject']) && $aParams['sSubject']) ? $aParams['sSubject'] : '';
        $sRedirectUri = (isset($aParams['sRedirectUri']) && $aParams['sRedirectUri']) ? $aParams['sRedirectUri'] : '';
        $sView = (isset($aParams['sView']) && $aParams['sView']) ? $aParams['sView'] : 'email_template';
        $aData = (isset($aParams['aData']) && $aParams['aData']) ? $aParams['aData'] : array();
        $this->load->library('email');
        $sUrl = base_url() . $sRedirectUri;
        $aData['sUrl'] = $sUrl;
        $aData['sEmail'] = $sEmail;
        $sEmailBody = $this->load->view($sView, $aData, TRUE);

        $flag = $this->email
        ->from(DEFAULT_FROM_EMAIL)
        ->to($sEmail)
        ->subject($sSubject)
        ->message($sEmailBody)
        ->send();

        if (!$flag) {
            echo $this->email->print_debugger();exit;
        }
    }

    public function setMessage($bFlag = FALSE, $chMessage = 'Operación realizada!') {
        if ($bFlag) {
            $this->session->set_flashdata('msg', $chMessage);
        }
    }

    public function getNotificaionesUsuario($idUsuario){
      $notificaciones = [];
		//$this->load->model('notificacion_model');
		//$notificaciones = $this->notificacion_model->get(FALSE, $idUsuario, "ACTIVO");

      return $notificaciones;
  }

  public function setPermisosUsuario($IdTipoUsuario) {

    $this->load->model('permisos_model');
    $asPermisos = $this->permisos_model->getByUsuario($IdTipoUsuario);
    return $asPermisos;
        //$this->ci->session->set_userdata('PERMISOSUSUARIO', $asPermisos);

}

public function setMenuPermisos($IdUsuario) {

    $this->load->model('permisos_model');
    $asPermisos = $this->permisos_model->getByMenuPermisos($IdUsuario);
    return $asPermisos;
        //$this->ci->session->set_userdata('CATEGORIAOPCION', $asCategorias);

}

	public function responseJsonSuccess($message = '',$data = []){
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode(array(
				'message'   => $message,
				'data'      => $data,
				'status'    => 200
			)));
	}

	public function responseJsonError($message = '',$data = []){
		return $this->output
			->set_content_type('application/json')
			->set_status_header(202)
			->set_output(json_encode(array(
				'message'   => $message,
				'data'      => $data,
				'status'    => 202
			)));
	}


}
