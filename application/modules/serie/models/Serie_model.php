<?php

class Serie_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function getSerie($where='')
    {
        $sql = "SELECT s.*
        FROM serie s
        $where
        ORDER BY id_serie ASC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function insertSerie($tabla, $data)
    {
        $query = $this->db->insert($tabla, $data);
		if ($query)
			return $this->db->insert_id();
		else
			return false;
    }
    public function updateSerie($tabla, $comparar, $datos, $id)
    {
    	$this->db->where($comparar, $id);
		$result = $this->db->update($tabla, $datos);
		if ($result)
			return true;
		else
			return false;
    }

    public function deleteSerie($where, $fecha){

      $sql = "UPDATE calendario SET ESTADO=0, FECHA_BAJA ='$fecha' WHERE ESTADO=1 $where";
      $query = $this->db->query($sql);
      // var_dump($this->db->last_query());

      if ($query)
          return true;
      else
          return false;
    }

}
