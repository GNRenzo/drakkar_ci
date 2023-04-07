<?php 
class Login extends MY_Controller{

	public function __construct(){
		parent::__construct();
		
	}

	public function sendEmailRequest(){

		$json["correo"]=false;
		$json["state"]=true;

		$this->load->library('email');

		$config['protocol']    = 'smtp';
		$config['smtp_host']    = 'ssl://smtp.gmail.com';
		$config['smtp_port']    = '465';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = 'dms.agv@agrovisioncorp.com';
		$config['smtp_pass']    = '@GV_@rm@g3d0N1';
		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'html'; 
		$config['validation'] = TRUE; 

		$this->email->initialize($config);

		$nombre = $this->input->post('txtName');

		$nombreSistema = ucwords(strtolower($this->input->post('nameSistema')));

		$correo = $this->input->post('txtCorreo');

		$usuario = strtolower($this->input->post('idUsuario'));

		// $comentario = $this->input->post('txtComentario');

		// $mensaje = "
		// <html>
		// <body>

		// <div style = 'width: 500px; border:solid #ff3333 1.0pt; padding:1.5pt 1.5pt 1.5pt 1.5pt'>
		// <div style = 'border:solid #ff3333 1.0pt;padding:7.5pt 7.5pt 7.5pt 7.5pt'>
		// <img src='https://www.agvperu.com/dms/adminlte/img/logos/logo.png'  height='52' width='72'>

		// <p>
		// <b>Solicitud de envío de credenciales.</>
		// </p>
		// <br>
		
		// <p>El usuario <b>$nombre</b> solicita el envío de sus credenciales: 
		// <br>
		// <br>
		// <b>Correo: $correo</b>
		// <br>
		// <b>Comentario:</b> $comentario
		// </p>

		// <p style = 'color: grey'>
		// <br>
		// Area de Inteligencia Comercial
		// <br>
		// Planeamiento y Control de Gestión
		// <br>
		// Dirección de Finanzas
		// </p>


		// </div>
		// </div>

		// </body>
		// <html>
		// ";

		$mensaje = "
		<html>
		<body>

		<div style = 'width: 500px; border:solid #ff3333 1.0pt; padding:1.5pt 1.5pt 1.5pt 1.5pt'>
		<div style = 'border:solid #ff3333 1.0pt;padding:7.5pt 7.5pt 7.5pt 7.5pt'>
		<img src='".base_url('')."adminlte/img/logos/logo.png' style = 'display:block;margin:auto;' height='52' width='72'>

		<p>
		<b>Estimado(a): <br> $nombre </>
		</p>
		<br>
		
		<p>Hemos recibido una solicitud de reestablecimiento de credenciales para la cuenta de usuario <b>$usuario</b>. <br>Para continuar con la recuperación, haga clic en el siguiente enlace:
		<br>
		<br>
		<p style='text-align: center;'>
              <a class='btn btn-info btn-lg'  href='".base_url('')."inet/Auth/forgot?txtNombre=$nombreSistema&txtCorreo=$correo&txtUser=$usuario'> <img style = 'display:block;margin:auto;' width='35%' src='https://www.agvperu.com/inet/fabrex/img/forgot/iconforgot.png' > Cambiar Contraseña  
              </a>
        </p>
		<br>
		
		</p>

		<p style = 'color: grey'>
		<br>
		Area de Inteligencia Comercial
		<br>
		Planeamiento & BI
		<br>
		Dirección de Finanzas
		</p>


		</div>
		</div>

		</body>
		<html>
		";
		
		$this->email->from('dms.agv@agrovisioncorp.com', 'Intranet Agrovision');

		$this->email->bcc($correo);

		$this->email->subject("Recuperación de Credenciales");

		$this->email->message($mensaje);

		if ($this->email->send()) {
			$json["correo"]=true;
			$json["state"]=true;
		}else{
			$json["correo"]=$this->email->print_debugger(array('headers'));;
		}


		echo json_encode($json); 

	}


	
	public function validarExistenciaCorreo() {

        $idCorreo = $this->input->post('correo');

        $json["resultado"] = [];


		 $sql_agvbi = " 
        	SELECT count(*) as nfilasidusuario
			FROM public.usuario
			where lower(usu_corporate_email) like lower('".$idCorreo."') ; ";

        $query = $this->db->query($sql_agvbi);
         

    	 $json["resultado"] = $query->unbuffered_row();

        $json["state"]=true;

        echo json_encode($json);  

    }	


    public function datosUsuario() {

        $idCorreo = $this->input->post('correo');

        $json["resultado"] = [];

     
        $sql_agvbi = " 
        	SELECT idusuario,password, estado, usr_nombres, idcodigogeneral,usu_corporate_email
			FROM public.usuario
			where lower(usu_corporate_email) like lower('".$idCorreo."') ;";

        $query = $this->db->query($sql_agvbi);         

    	 $json["resultado"] = $query->unbuffered_row();

        $json["state"]=true;

        echo json_encode($json);  

    }
	

}