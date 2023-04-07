<?php
class Inicio_model extends MY_Model{
	
	public function listarRecentContract(){
		$Usuario = $this->session->userdata('USUARIO');  
        $idusuario = $Usuario->username;
         $sql = "
            SELECT 
            movdo_codigo,
            to_char(movdo_fecha, 'DD/MM/YYYY') as movdo_fecha,
            movdo_hora,
            movdo_dofi_codigo,
            movdo_idusuario,
            movdo_evento,
            dofi_codigo,
            dofi_nombre,
            fiex_extension,
            fiex_descripcion,
            fiex_icono,
            dofi_ruta,
            dofi_size
            FROM dms.movimiento_documento
            INNER JOIN dms.document_file on movdo_dofi_codigo = dofi_codigo
            INNER JOIN dms.file_extension on dofi_fiex_codigo = fiex_codigo
            WHERE lower(movdo_idusuario) ilike lower('$idusuario')
            AND movdo_evento = 'VISUALIZACIÓN'
            ORDER BY movdo_fecha desc, movdo_hora desc
            limit 5
         ";
 
        $query = $this->db->query($sql);
 
        return $query->result_array();
	}


    public function listarRecentMacroprocesses(){
        $Usuario = $this->session->userdata('USUARIO');  
        $idusuario = $Usuario->username;
         $sql = "
            SELECT 
            movdopr_codigo,
            to_char(movdopr_fecha, 'DD/MM/YYYY') as movdopr_fecha,
            movdopr_hora,
            movdopr_prfi_codigo,
            movdopr_idusuario,
            movdopr_evento,
            prfi_codigo,
            upper(prfi_nombre_web) as prfi_nombre,
            fiex_extension,
            fiex_descripcion,
            fiex_icono,
            prfi_ruta,
            prfi_size
            FROM dms.movimiento_proceso
            INNER JOIN dms.process_file on movdopr_prfi_codigo = prfi_codigo
            INNER JOIN dms.file_extension on prfi_fiex_codigo = fiex_codigo
            WHERE movdopr_idusuario = '$idusuario'
            AND movdopr_evento = 'VIEW'
            ORDER BY movdopr_fecha desc, movdopr_hora desc
            limit 5
            ";
 
        $query = $this->db->query($sql);
 
        return $query->result_array();
    }



 








    public function listarLastPublished(){
        $Usuario = $this->session->userdata('USUARIO');  
        $idusuario = $Usuario['idusuario'];
         $sql = "
            SELECT 
            movdo_codigo,
            to_char(movdo_fecha, 'DD/MM/YYYY') as movdo_fecha,
            movdo_hora,
            movdo_dofi_codigo,
            movdo_idusuario,
            movdo_evento,
            dofi_codigo,
            dofi_nombre,
            fiex_extension,
            fiex_descripcion,
            fiex_icono,
            dofi_ruta,
            dofi_size
            

            FROM dms.movimiento_documento
            INNER JOIN dms.document_file on movdo_dofi_codigo = dofi_codigo
            INNER JOIN dms.file_extension on dofi_fiex_codigo = fiex_codigo
            INNER JOIN dms.folder_tree on dofi_fotr_codigo = fotr_codigo
            INNER JOIN dms.permiso_usuario_folder on fotr_codigo = pufo_fotr_codigo AND pufo_idusuario = '$idusuario'
            
            WHERE movdo_evento = 'APPROVAL'
            ORDER BY movdo_fecha desc, movdo_hora desc
            limit 4
            
                
         ";
 
        $query = $this->db->query($sql);
 
        return $query->result_array();
    }


    public function listarPendingApproval(){
        $Usuario = $this->session->userdata('USUARIO');  
        $idusuario = $Usuario['idusuario'];
         $sql = "
            SELECT 
            movdo_codigo,
            to_char(movdo_fecha, 'DD/MM/YYYY') as movdo_fecha,
            movdo_hora,
            movdo_dofi_codigo,
            movdo_idusuario,
            movdo_evento,
            dofi_codigo,
            dofi_nombre,
            fiex_extension,
            fiex_descripcion,
            fiex_icono,
            dofi_ruta,
            dofi_size
            FROM dms.movimiento_documento
            INNER JOIN dms.document_file on movdo_dofi_codigo = dofi_codigo
            INNER JOIN dms.file_extension on dofi_fiex_codigo = fiex_codigo
            INNER JOIN dms.folder_tree on dofi_fotr_codigo = fotr_codigo
            INNER JOIN dms.permiso_usuario_folder on fotr_codigo = pufo_fotr_codigo AND pufo_idusuario = '$idusuario' AND pufo_tipo_acceso = '1'
            INNER JOIN public.usuario on pufo_idusuario = idusuario AND (usu_grus_dms_codigo = 1 OR usu_grus_dms_codigo = 11 OR usu_grus_dms_codigo = 12)
            WHERE movdo_evento = 'CREATION'
            AND dofi_estado_aprobacion = '0'
            ORDER BY movdo_fecha desc, movdo_hora desc
            limit 4
            
                
         ";
 
        $query = $this->db->query($sql);
 
        return $query->result_array();
    }


    public function countDocumentByTye(){
        $Usuario = $this->session->userdata('USUARIO');  
        $idusuario = $Usuario->username;
         $sql = "
            SELECT 
            doty_codigo,
            count(dofi_codigo) as count            

            FROM dms.document_file
            INNER JOIN dms.document_type on dofi_doty_codigo = doty_codigo

            GROUP BY doty_codigo
           
         ";
 
        $query = $this->db->query($sql);
 
        return $query->result_array();
    }


	


	
	
}