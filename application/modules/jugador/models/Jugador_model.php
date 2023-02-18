<?php

class Jugador_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function getJugador($where='')
    {
        $sql = "SELECT 
        u.id as id_jugador,
        CONCAT(u.first_name, ' ',u.last_name) as nombre
        FROM users u
        $where
        ORDER BY u.first_name ASC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function insertJugador($tabla, $data)
    {
        $query = $this->db->insert($tabla, $data);
		if ($query)
			return $this->db->insert_id();
		else
			return false;
    }
    public function updateJugador($tabla, $comparar, $datos, $id)
    {
    	$this->db->where($comparar, $id);
		$result = $this->db->update($tabla, $datos);
		if ($result)
			return true;
		else
			return false;
    }

    public function deleteJugador($where){

      $sql = "DELETE FROM calendario WHERE $where";
      $query = $this->db->query($sql);
      // var_dump($this->db->last_query());

      if ($query)
          return true;
      else
          return false;
    }

}
