<?php

class Usuario_model extends MY_Model {


	public function listar() {

		$sql =  "SELECT 
		count(idmenu) as nromenusadd, 
		lower(usu.idusuario) as idusuario, 
		usr_nombres, 
		idcodigogeneral, 
		grus_nombre, 
		usu.estado,
		usu_corporate_email,
		depa.nombre as departamento,
		are.nombre as area,
		secc.nombre as seccion,
		car.nombre as cargo
		FROM public.usuario usu
		LEFT JOIN dms.grupo_usuario ON usu_grus_dms_codigo = grus_codigo 
		LEFT JOIN dms.permisos ON 	usu.idusuario ilike permisos.idusuario
		LEFT JOIN public.seccion secc ON usu.seccion_codigo = secc.codigo
		LEFT JOIN public.area are ON secc.area_codigo = are.codigo
		LEFT JOIN public.departamento depa ON are.departamento_codigo = depa.codigo
		LEFT JOIN public.cargo car ON usu.cargo_codigo = car.codigo
		WHERE grus_codigo != 1 OR grus_nombre IS NULL
		GROUP BY usu.idusuario,grupo_usuario.grus_nombre,
		usr_nombres, 
		idcodigogeneral, 
		grus_nombre,
		usu_corporate_email,
		usu.estado,
		depa.nombre,
		are.nombre,
		secc.nombre,
		car.nombre 
		ORDER BY usu.idusuario ASC";

		$query = $this->db->query($sql);
		return $query->result_array();

	}

	public function listarSecciones($area) {

		$sql =  "SELECT 
		secc.codigo, secc.nombre
		FROM public.seccion secc 

		where secc.estado = '1'
		and area_codigo = '$area'
		ORDER BY secc.nombre ASC";

		$query = $this->db->query($sql);
		return $query->result_array();

	}


	public function listarAreas($departamento) {

		$sql =  "SELECT 
		are.codigo, are.nombre
		FROM public.area are 

		where are.estado = '1'
		and departamento_codigo = '$departamento'
		ORDER BY are.nombre ASC";

		$query = $this->db->query($sql);
		return $query->result_array();

	}


	public function listarDepartamentos() {

		$sql =  "SELECT 
		codigo, nombre
		FROM public.departamento 

		where estado = '1'
		ORDER BY nombre ASC";

		$query = $this->db->query($sql);
		return $query->result_array();

	}

	public function listarCargos() {

		$sql =  "SELECT 
		codigo, nombre
		FROM public.cargo 

		where estado = '1'
		ORDER BY nombre ASC";

		$query = $this->db->query($sql);
		return $query->result_array();

	}


	public function listarUsuariosSeguridad($fotr_codigo) {
		$Usuario = $this->session->userdata('USUARIO');
		$idusuario = $Usuario['idusuario'];
		$sql =  "

		SELECT 
		
		idusuario, 
		usr_nombres,
		usu_corporate_email
		FROM public.usuario 
		
		WHERE estado = '1'
		AND idusuario != '$idusuario'
		AND idusuario NOT IN (
			SELECT pufo_idusuario from dms.permiso_usuario_folder where pufo_fotr_codigo = '$fotr_codigo'
		)
		
		ORDER BY usuario.idusuario ASC";

		$query = $this->db->query($sql);
		return $query->result_array();

	}

	public function listarUsuariosContractViewGood() {
		$Usuario = $this->session->userdata('USUARIO');
		$idusuario = $Usuario['idusuario'];
		$sql =  "

		SELECT 
		
		idusuario, 
		usr_nombres,
		usu_corporate_email
		FROM public.usuario 
		
		WHERE estado = '1'

		
		ORDER BY usuario.idusuario ASC";

		$query = $this->db->query($sql);
		return $query->result_array();

	}


	public function listarUsuariosContractLegal() {
		$Usuario = $this->session->userdata('USUARIO');
		$idusuario = $Usuario['idusuario'];
		$sql =  "

		SELECT 
		
		idusuario, 
		usr_nombres,
		usu_corporate_email
		FROM public.usuario 
		
		WHERE estado = '1'

		AND idarea = 4

		
		ORDER BY idusuario ASC";

		$query = $this->db->query($sql);
		return $query->result_array();

	}

	public function listarUsuariosRepresentanteLegal() {
		$Usuario = $this->session->userdata('USUARIO');
		$idusuario = $Usuario['idusuario'];
		$sql =  "

		SELECT 
		
		idusuario, 
		usr_nombres,
		usu_corporate_email
		FROM public.usuario 
		
		WHERE estado = '1'

		AND representante_legal = '1'



		
		ORDER BY usuario.idusuario ASC";

		$query = $this->db->query($sql);
		return $query->result_array();

	}


	public function listarUsuariosRepresentanteLegal1M5M() {
		$Usuario = $this->session->userdata('USUARIO');
		$idusuario = $Usuario['idusuario'];
		$sql =  "

		SELECT 
		
		idusuario, 
		usr_nombres,
		usu_corporate_email
		FROM public.usuario 
		
		WHERE estado = '1'

		AND representante_legal = '1'

		
		ORDER BY usuario.idusuario ASC";

		$query = $this->db->query($sql);
		return $query->result_array();

	}

	public function listarUsuariosActivosPublic() {
		$Usuario = $this->session->userdata('USUARIO');
        $idusuarioActual = $Usuario['idusuario'];

		$sql =  "SELECT 
		
		idusuario, 
		usr_nombres
		FROM public.usuario 
		LEFT JOIN dms.grupo_usuario ON usu_grus_dms_codigo = grus_codigo 
		WHERE estado = '1' AND
		idusuario not like '$idusuarioActual' AND
		grus_codigo != 1

		ORDER BY usuario.idusuario ASC";

		$query = $this->db->query($sql);
		return $query->result_array();

	}




	public function modificar($idusuario){

		$representante_legal = '0';

		if ($this->input->post('checkReprentanteLegal')) {
			$representante_legal = '1';
		}





			$data = [
				'usu_grus_dms_codigo' => strtoupper($this->input->post('cboGrupoUsuario')),
				'representante_legal' => $representante_legal,
				'usu_corporate_email' => strtolower($this->input->post('txtCorreoCorp')),
				'cargo_codigo' =>  $this->input->post('cboCargo'),
				'seccion_codigo' =>  $this->input->post('cboSeccion')
 			];


		$this->db->where('idusuario ilike', $idusuario);
		return $this->db->update('public.usuario', $data);
	}


	// AGREGADOS
	public function registrarNew(){

		date_default_timezone_set('America/Lima');
		$date = date('Y-m-d');
		$time = date('H:i:s');


		$data = [
			'idusuario' => strtoupper($this->input->post('txtAccountNew')),
			'usr_nombres' => strtoupper($this->input->post('txtNameNew')),
			'password' => base64_encode($this->input->post('txtPasswordNew')),
			'idcodigogeneral' => strtoupper($this->input->post('txtDNINew')),
			'usu_grus_codigo' => strtoupper($this->input->post('cboGrupoUsuarioIntranet')),
			'usu_corporate_email' => strtoupper($this->input->post('txtCorreoCorpNew')),
			'fecha_creacion' => $date.' '. $time,
			'usu_grus_dms_codigo' => strtoupper($this->input->post('cboGrupoUsuarioDMS')),
            'representante_legal' => $this->input->post('valRepresentateLegalNew'),
			'estado' => 1
		];
		return $this->db->insert('public.usuario', $data);
	}

	public function listarGrupoUserIntranet() {

		$this->db

			->select('count(agum_id_menu) as nromenusadd, grus_codigo, grus_nombre, grus_estado')

			->from('public.grupo_usuario')

			->join('asignacion_grupo_usuario_menu', 'grus_codigo = agum_grus_codigo', 'left')

			->group_by("grus_codigo", "grus_nombre", "grus_estado")

			->order_by("grus_nombre", "asc")

			->where('grus_estado', '1')

			->where('grus_codigo !=', '1');

		$query = $this->db->get();

		return $query->result_array();

	}
	public function eliminar($idusuario) {

		$this->db->trans_begin();

		//$idusuario = 'atesteo';
		$this->db->where('idusuario', strtoupper($idusuario));
		$this->db->delete('public.permisos');

		$this->db->where('idusuario', strtoupper($idusuario));
		$this->db->delete('dms.permisos');

		$this->db->where('idusuario',strtoupper ($idusuario));
		$this->db->delete('public.usuario');



		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
		}else{
			$this->db->trans_commit();
		}

	}

	public function resetPass($idusuario){
		$data = [
			'password' => base64_encode('Inicio01')
		];
		$this->db->where('idusuario  ilike', $idusuario);
		return $this->db->update('public.usuario', $data);
	}

	public function registrarActualizarPermisosNuevoUsuario($codigo){
		// $idusuario = strtoupper($codigo);
		$query = $this->db->query("SELECT dms.fn_registrar_actualizar_permisos_nuevo_usuario ('$codigo')");
	}




	public function leer($idusuario) {

		$sql =  "SELECT 
		count(idmenu) as nromenusadd, 
		lower(usu.idusuario) as idusuario, 
		usr_nombres, 
		idcodigogeneral, 
		grus_nombre, 
		usu.estado,
		usu_corporate_email,
		depa.nombre as departamento,
		are.codigo as area_codigo,
		secc.codigo as seccion_codigo,
		depa.codigo as departamento_codigo,
		are.nombre as area,
		secc.nombre as seccion,
		car.nombre as cargo,
		car.codigo as cargo_codigo,
		usu_grus_dms_codigo
		FROM public.usuario usu
		LEFT JOIN dms.grupo_usuario ON usu_grus_dms_codigo = grus_codigo 
		LEFT JOIN dms.permisos ON 	usu.idusuario = permisos.idusuario
		LEFT JOIN public.seccion secc ON usu.seccion_codigo = secc.codigo
		LEFT JOIN public.area are ON secc.area_codigo = are.codigo
		LEFT JOIN public.departamento depa ON are.departamento_codigo = depa.codigo
		LEFT JOIN public.cargo car ON usu.cargo_codigo = car.codigo
		WHERE (grus_codigo != 1  or usu_grus_dms_codigo is null)
		AND usu.idusuario ilike '$idusuario'
		GROUP BY usu.idusuario,grupo_usuario.grus_nombre,
		usr_nombres, 
		idcodigogeneral, 
		grus_nombre,
		usu_corporate_email,
		usu.estado,
		depa.nombre,
		are.nombre,
		secc.nombre,
		car.nombre,
		are.codigo,
		secc.codigo,
		depa.codigo,
		car.codigo
		ORDER BY usu.idusuario ASC";

		$query = $this->db->query($sql);
		return $query->result_array();

	}


	public function cambiarEstado($codigo, $estado) {

		$data = [
			'estado' => $estado
		];

		$this->db->where('idusuario  ilike', $codigo);
		return $this->db->update('public.usuario', $data);

	}

	public function getEmailBySAP($codigo_vacaciones){
		$this->db

			->select('v.codigo_sap, u.usu_corporate_email, usr_nombres as nombres')
			->from('usuario u')
			->join('dms.vacaciones v','v.codigo_sap = u.codigo_sap')
			->where('v.id', $codigo_vacaciones);

		$query = $this->db->get();

		return $query->first_row('array');
	}

	public function searchUserFromApi($user){
		$this->db->select()

			// ->select('v.codigo_sap, u.usu_corporate_email, usr_nombres as nombres')
			// ->from('dms_gh.user_group')
			// ->join('dms.vacaciones v','v.codigo_sap = u.codigo_sap')
			->where('ug.username', $user);

		$query = $this->db->get('dms_gh.user ug');

		$res = $query->result();
        if($res)
            return $res[0];
        else
            return 0;
		//return $query->result();
	}

	public function newUserFromApi($u){
		$this->db->insert('dms_gh.user',$u);
        $id = $this->db->insert_id();
        return $id;
	}

	public function startSession($usu){
		$q = $this->db->select("m.*, p.*, (select COUNT(M2.id) FROM dms_gh.menu M2 WHERE M2.jerarquia!=m.jerarquia AND M2.jerarquia LIKE CONCAT(m.jerarquia, '%')) as SUBmenu ")
				->join('dms_gh.menu m','p.key_menu = m.id')
				->where('p.key_user', $usu->key_user)
				->get('dms_gh.permission p');
		$res = $q->result_array();
		if(!$res){
			$q = $this->db->select("ugm.*, m.*, ug.name as rol, (select COUNT(M2.id) FROM dms_gh.menu M2 WHERE M2.jerarquia!=m.jerarquia AND M2.jerarquia LIKE CONCAT(m.jerarquia, '%')) as SUBmenu ")
					->join('dms_gh.menu m','ugm.key_menu = m.id')
					->join('dms_gh.user_group ug','ug.key_user_group = ugm.key_user_group')
					->where('ug.name',$usu->rol)
					->get('dms_gh.user_group_menu_assignment ugm');
			$res = $q->result_array();
		}
		$usu->idusuario = $usu->key_user;
		$this->session->set_userdata('USUARIO',$usu);
		$this->session->set_userdata('PERMISOS',$res);
		// echo '<pre>';
		// var_dump($usu);
		// var_dump($res);
		// echo '</pre>';
		// exit();
	}


}
