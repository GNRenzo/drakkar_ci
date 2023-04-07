<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Clase base con algunas funciones utilies para el manejo de comandos dml
 * 
 * @author Herald Olivares <heraldmatias.oz@gmail.com>
 */
class MY_Model extends CI_Model {

    private $rCurs;

    /**
     * Devuelve todas las filas de un query. Adicionalmente se puede devolver por
     * paginas.
     *
     * @param string $select Nombre o nombres de campos separados por coma
     * @param int $start Fila desde donde se desean obtener los datos. <b>0 based</b>
     * @param int $count Cantidad de registros a leer desde $start
     * @param string $type object, array o custom
     * @return mixed Devuelve el tipo especificado en el parametro type, Esto puede
     * ser array u object
     */
    public function all($select = '*', $start = NULL, $count = NULL, $type = 'array') {
        if (is_numeric($start) & is_numeric($count)) {
            $this->db->limit($start, $count);
        }
        $this->db->select($select);
        $q = $this->db->get($this->tableName());
        $result = $q->result($type);
        return $result;
    }

    /**
     * Devuelve todas las filas de un query filtrado.
     * Adicionalmente se puede devolver por paginas.
     *
     * @param string $select Nombre o nombres de campos separados por coma
     * @param array $where Un array asociativo que devuelve las filas a crear
     * @param int $start Fila desde donde se desean obtener los datos. <b>0 based</b>
     * @param int $count Cantidad de registros a leer desde $start
     * @param string $type object, array o custom
     * @return mixed Devuelve el tipo especificado en el parametro type, Esto puede
     * ser array u object
     */
    public function allBy($table, $select, $where, $start = NULL, $count = NULL, $type = 'array') {
        if (is_numeric($start) & is_numeric($count)) {
            $this->db->limit($start, $count);
        }
        $this->db->select($select);
        if ($where) {
            $this->db->where($where);
        }
        $q = $this->db->get($table);
        $result = $q->result($type);
        return $result;
    }

    /**
     * Devuelve todas las filas de un query filtrado.
     * Adicionalmente se puede devolver por paginas.
     *
     * @param string $select Nombre o nombres de campos separados por coma
     * @param array $where Un array asociativo que devuelve las filas a crear
     * @sort array $sort Un array que devuelve los campos para ordenar las filas a retornar
     * @param int $start Fila desde donde se desean obtener los datos. <b>0 based</b>
     * @param int $count Cantidad de registros a leer desde $start
     * @param string $type object, array o custom
     * @return mixed Devuelve el tipo especificado en el parametro type, Esto puede
     * ser array u object
     */
    public function allBy_sort($select, $where, $sort, $start = NULL, $count = NULL, $type = 'array') {
        if (is_numeric($start) & is_numeric($count)) {
            $this->db->limit($start, $count);
        }
        $this->db->select($select);
        if ($where) {
            $this->db->where($where);
        }
//        $this->db->order_by($sort[0]);
//        $this->db->order_by($sort[1]);
        foreach ($sort as $value) {
            $this->db->order_by($value);
        }
        $q = $this->db->get($this->tableName());
        //echo $this->db->last_query();exit();
        $result = $q->result($type);
        return $result;
    }

    /**
     * Devuelve la primera fila de un query filtrado.
     *
     * @param array $where Un array asociativo que devuelve las filas a crear
     * @param string $type object, array or custom
     * @return mixed Devuelve el tipo especificado en el parametro type, Esto puede
     * ser array u object
     */
    public function get($table, $where, $select = '*', $type = 'array') {
        $this->db->select($select);
		if($where !== ''){
			$this->db->where($where);
		}
        $q = $this->db->get($table);
        // $result = $q->row(0, $type);
        // return $result;
		// echo $this->db->last_query(); //imprime en pantalla la consulta SQL
		return $q->result_array();
    }

    /**
     * Devuelve los nombres de los campos de la tabla utilizada por el modelo.
     * @return array
     */
    public function getdb_fields() {
        $q = $this->db->list_fields($this->tableName());
        return $q;
    }

    /**
     * Ejecuta una sentencia insert o update a la tabla especificada en el modelo
     *
     * @param array $data Array asociativo que contiene los datos a utilizarse en la sentencia
     * @param bool $existsDB True si se desea ejecutar una validacion exists a nivel de base de datos
     */
    public function save($table, &$data, $where = array()) {
        $rpta = TRUE;
        if ($this->is_multidim_array($data)) {
            foreach ($data as $value) {
                $rpta = $rpta & (($value) ? $this->_save($table, $value, $where) : TRUE);
            }
        } else {
            $rpta = $this->_save($table, $data, $where);
        }
        return $rpta;
    }

    /**
     * Ejecuta una sentencia insert o update a la tabla especificada en el modelo
     *
     * @param array $data
     * @param bool $existsDB
     */
    private function _save($table, &$data, $where) {
        $update = FALSE;
        if ($where) {
            $update = $this->exists($table, $where);
        }
        if ($update === TRUE) {
            return $this->edit($table, $data, $where) > 0;
        } else {
            return $this->create($table, $data) > 0;
        }
    }

    /**
     * Ejecuta una sentencia insert. Devuelve 0 si no se ha grabado correctamente.
     *
     * @param array $data
     * @return int
     */
    public function create($table, &$data) {
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    /**
     * Ejecuta una sentencia update. Devuelve 0 si no se ha actualizado correctamente.
     *
     * @param array $data
     * @param array $where
     * @return int
     */
    public function edit($table, &$data, $where) {
        //mejorar estas lineas
        $pks = array_keys($where);
        $_data = array();
        foreach ($data as $column => $value) {
            if (!in_array($column, $pks)) {
                $_data[$column] = $value;
            }
        }
        $this->db->update($table, $_data, $where);
        return $this->db->affected_rows();
    }

    /**
     * Ejecuta una sentencia delete. Devuelve 0 si no se ha grabado correctamente.
     *
     * @param array $where
     * @return type
     */
    public function delete($table, $where = array()) {
        $this->db->delete($table, $where);
        return $this->db->affected_rows();
    }

    /**
     * Devuelve TRUE si se ha grabado exitosamente, FALSE en caso contrario.
     *
     * @param array $where
     * @return bool
     */
    public function exists($table, $where) {
        return $this->count($table, $where) > 0;
    }

    /**
     * Devuelve la cantidad de registros de la tabla segun un filtro dado.
     *
     * @param array $where
     * @return int
     */
    public function count($table, $where = FALSE) {
        if ($where) {
            $this->db->where($where);
        }
        $count = $this->db->count_all_results($table);
        return $count;
    }

    function is_multidim_array($arr) {
        if (!is_array($arr)) {
            return false;
        }
        foreach ($arr as $elm) {
            if (!is_array($elm)) {
                return false;
            }
        }
        return true;
    }

    public function closeConnection() {
        try {
            $this->db->close();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        $this->db = NULL;
    }

    protected function stored_procedure($package, $proc, $params) {
        //validar
        $aaResults = array();
        if (!is_array($params)) {
            return $aaResults;
        }
        $conn = $this->db->db_connect();
        if (!$conn) {
            $m = oci_error();
            trigger_error(htmlentities($m['message']), E_USER_ERROR);
        }
        $sParams = $this->paramsName($params);
        $sStatement = sprintf('begin %s.%s(%s); end;', $package, $proc, $sParams);
//        echo $sStatement;exit;
        $stid = oci_parse($conn, $sStatement);
        $bFlag = $this->bindParams($conn, $stid, $params);
        oci_execute($stid);
        if ($bFlag) {
            foreach ($this->rCurs as $key => $rCursor) {
                $aaResults[$key] = array();
                oci_execute($rCursor);
                oci_fetch_all($rCursor, $aaResults[$key], 0, -1, OCI_FETCHSTATEMENT_BY_ROW);
                oci_free_statement($rCursor);
            }
        }
        oci_free_statement($stid);
        oci_close($conn);
        $this->disposeProc();
        return $aaResults;
    }

    private function paramsName($params) {
        $sParams = '';
        foreach ($params as $key => $value) {
            if ($value['name']) {
                if ($sParams !== '') {
                    $sParams .= ',';
                }
                $sParams .= $value['name'];
            }
        }
        return $sParams;
    }

    private function bindParams($conn, $stid, $params) {
        $bFlag = FALSE;
        foreach ($params as $aParam) {
            if ($this->bindParam($conn, $stid, $aParam) === TRUE) {
                $bFlag = TRUE;
            }
        }
        return $bFlag;
    }

    private function bindParam($conn, $stid, $aParam) {
        $bFlag = FALSE;
        if (is_array($aParam)) {
            if ($aParam['type'] === OCI_B_CURSOR) {
                $curs = oci_new_cursor($conn);
                $this->rCurs[$aParam['name']] = $curs;
                oci_bind_by_name($stid, $aParam['name'], $curs, $aParam['length'], OCI_B_CURSOR);
                $bFlag = TRUE;
            } else {
                oci_bind_by_name($stid, $aParam['name'], $aParam['value'], $aParam['length'], $aParam['type']);
            }
        }
        return $bFlag;
    }

    private function disposeProc() {
        $this->rCurs = array();
    }

}
