<?php

class Jugador_campeonato_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function getJugadorCampeonato($where='')
    {
        $sql = "SELECT
        jc.id_jugador_campeonato as id_jugador_campeonato,
        u.id as id_jugador,
        CONCAT(u.first_name, ' ',u.last_name) as nombre_jugador
        FROM jugador_campeonato jc
        LEFT JOIN users u WHERE u.id=jc.id_usuario
        LEFT JOIN campeonato c WHERE c.id_campeonato=jc.id_campeonato
        $where
        ORDER BY jc.id_jugador_campeonato ASC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function insertJugadorCampeonato($tabla, $data)
    {
        $query = $this->db->insert($tabla, $data);
		if ($query)
			return $this->db->insert_id();
		else
			return false;
    }
    public function updateJugadorCampeonato($tabla, $comparar, $datos, $id)
    {
    	$this->db->where($comparar, $id);
		$result = $this->db->update($tabla, $datos);
		if ($result)
			return true;
		else
			return false;
    }

    public function deleteJugadorCampeonato($where){

      $sql = "DELETE FROM jugador_campeonato WHERE $where";
      $query = $this->db->query($sql);
      // var_dump($this->db->last_query());

      if ($query)
          return true;
      else
          return false;
    }

}
