<?php
class Configuracion extends CI_Model{
	
	public function listarPermisosRol($rol){
		    
 		$this->db->select()
 
                ->from('dms_gh.user_group_menu_assignment ugm')
                ->join('dms_gh.menu m','ugm.key_menu = m.id')
                ->where('ugm.key_user_group',$rol)
                ->order_by('ugm.key_menu');
        
                $query = $this->db->get();
        
                return $query->result_array();
	}

        public function actualizaPermiso($data, $id){
                $this->db->where('key_user_group_menu_assignment',$id)->update('dms_gh.user_group_menu_assignment',$data);
        }
        
        public function actualizaPermisosUsuariosGroup($data, $where){
                $this->db->where($where)->update('dms_gh.permission',$data);
        }
}