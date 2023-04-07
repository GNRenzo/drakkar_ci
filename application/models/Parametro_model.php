<?php

class Parametro_model extends CI_Model
{
    public function getEnvioCorreoValue()
    {

        $sql = "
                SELECT 
                key_parametro
                , nombre
            	, value
                FROM dms.parametro
                WHERE key_parametro = 3";

        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function getCorreoNotificaciones()
    {

        $sql = "
                SELECT 
                key_parametro
                , nombre
            	, value
                , value2
                FROM dms.parametro
                WHERE key_parametro = 4";

        $query = $this->db->query($sql);
        return $query->row_array();
    }




}
