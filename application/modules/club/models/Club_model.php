<?php

class Club_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function getClub($where='')
    {
        $sql = "SELECT c.*
        FROM club c
        $where
        ORDER BY id_club ASC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function insertClub($tabla, $data)
    {
        $query = $this->db->insert($tabla, $data);
		if ($query)
			return $this->db->insert_id();
		else
			return false;
    }
    public function updateClub($tabla, $comparar, $datos, $id)
    {
    	$this->db->where($comparar, $id);
		$result = $this->db->update($tabla, $datos);
		if ($result)
			return true;
		else
			return false;
    }

    public function deleteDetalles($where, $fecha){

      $sql = "UPDATE Club SET ESTADO=0, FECHA_BAJA ='$fecha' WHERE ESTADO=1 $where";
      $query = $this->db->query($sql);
      // var_dump($this->db->last_query());

      if ($query)
          return true;
      else
          return false;
    }

}
