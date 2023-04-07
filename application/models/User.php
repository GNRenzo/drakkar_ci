<?php

class User extends MY_Model {
	
   public function __construct(){
        parent::__construct();
        $this->load->model('encriptar_model');
    }

    public function authenticate_Nisira($sucursal,$username, $password) {

        $idusuario = str_replace(" ","",$username);
       
        $preferencia_idioma = 'ENG';
        $preferencia_vista = 'MOSAICOS';
        $sql = "

        SELECT valor_preferencia
        FROM preferencia_usuario 
        WHERE codigo_preferencia = '1'
        AND idusuario ilike '$idusuario'
        ";

        $query = $this->db->query($sql);

        foreach ($query->result() as $row){
            $preferencia_idioma = $row->valor_preferencia;
        }


        $sql2 = "

        SELECT valor_preferencia
        FROM preferencia_usuario 
        WHERE codigo_preferencia = '2'
        AND idusuario ilike '$idusuario'
        ";

        $query2 = $this->db->query($sql2);

        foreach ($query2->result() as $row){
            $preferencia_vista = $row->valor_preferencia;
        }

       

        $passDes = $this->encriptar_model->desencriptar($password);

       		//Ini
        $sql = "

			SELECT idusuario as idusuario,  
				   UPPER(usr_nombres) AS usr_nombres, password AS password, 
				   idcodigogeneral, usu_grus_codigo, '$passDes' AS pwdd, usu_grus_dms_codigo as usu_grus_codigo_dms,  
				   '$preferencia_idioma' as preferencia_idioma, '$preferencia_vista' as preferencia_vista, 
				   '$sucursal' as sucursal,
				   (select nombre as name_sucursal from dms.sucursal where idsucursal = '$sucursal'),
 				   (select idrol_nomina as idrol_nomina from dms.permisos where upper(idusuario) = upper('$idusuario') and idmenu in ('089','090','093','094','095') limit 1) 
			FROM usuario  
			WHERE estado = '1' 
			AND idusuario ilike '$idusuario' AND password = '$password' 
        ";

		//Fin

     
        $query = $this->db->query($sql);

        $result = $query->row_array(0);


        return $result;

    }

    public function getControllers($id){

        $sql = "SELECT link FROM dms.menu WHERE jerarquia like '$id'";

        $query = $this->db->query($sql);

        return $query->result_array();
        
    }


    
}
