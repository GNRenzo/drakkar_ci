<?php
class permisos_model extends CI_Model{
	
	public function __construct(){
		$this->load->database();
	}
	
	public function getByMenuPermisos($idUsuario){
	

        $Usuario = $this->session->userdata('USUARIO');
        
        if ($Usuario['usu_grus_codigo_dms'] == '1') {
	        $sql = "SELECT menu.id, menu.descripcion, menu.link, menu.icono, menu.jerarquia,  
	        (select COUNT(M2.id) FROM dms.menu M2 WHERE M2.jerarquia!=menu.jerarquia AND M2.jerarquia LIKE CONCAT(menu.jerarquia, '%')) as SUBmenu 
	        FROM dms.menu 
	        WHERE menu.estado = '1'  ORDER BY menu.ordenamiento, menu.descripcion";
	    }else{
	    	$sql = "SELECT menu.id, menu.descripcion, menu.link, menu.icono, menu.jerarquia,  permisos.idmenu, permisos.idusuario, 
	    	(select COUNT(M2.id) FROM dms.menu M2 WHERE M2.jerarquia!=menu.jerarquia AND M2.jerarquia LIKE CONCAT(menu.jerarquia, '%')) as SUBmenu 
	    	FROM dms.menu 
	    	JOIN dms.permisos ON permisos.idmenu=menu.id 
	    	WHERE menu.estado = '1' 
	    	AND permisos.estado = '1' 
	    	AND lower(idusuario) ilike lower('$idUsuario') 
	    	ORDER BY menu.ordenamiento, menu.descripcion";
	    }

		$query = $this->db->query($sql);

        return $query->result_array();
	}




	public function listarMenusSinPermiso($idUsuario){
		$sql = "SELECT 
		m.id AS id,
		m.descripcion as descripcion, 
		m.jerarquia as jerarquia
		FROM dms.menu m
		WHERE m.id 
		NOT IN 
		(SELECT  
		M1.id 
		FROM dms.menu M1 INNER JOIN permisos p ON p.idmenu=M1.id 
		WHERE M1.estado = '1' AND p.estado = '1' AND p.idusuario = '$idUsuario')
		AND m.id <> '001'
		ORDER BY m.id";

		$query = $this->db->query($sql);

        return $query->result_array();
	}

	public function agregarPermiso($idusuario, $idmenu){

		$data = [
			'idmenu'		=> $idmenu,
			'idusuario'			=> $idusuario,
			'estado' => '1'
		];

		return $this->db->insert('dms.permisos', $data);

	}

	public function removerPermiso($idusuario, $idmenu){

		$this->db->where('idusuario', $idusuario);
		$this->db->where('idmenu', $idmenu);

		return $this->db->delete('dms.permisos');
	}
	
	
}