<?php

class Campeonato_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function getCampeonato($where='')
    {
        $sql = "SELECT c.*,
        c.id_campeonato as id_campeonato,
        c.id_usuario as id_usuario,
        c.titulo as titulo,
        c.descripcion as descripcion,
        DATE_FORMAT(c.fecha_inicio, '%Y-%m-%d %k:%i:%S') as fecha_inicio,
        DATE_FORMAT(c.fecha_fin, '%Y-%m-%d %k:%i:%S') as fecha_fin

        FROM campeonato c
        $where
        ORDER BY id_campeonato ASC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function getCampeonatoById($where='')
    {
        $sql = "SELECT c.*,
        c.id_campeonato as id_campeonato,
        c.id_usuario as id_usuario,
        c.titulo as titulo,
        c.descripcion as descripcion,
        DATE_FORMAT(c.fecha_inicio, '%Y-%m-%d %k:%i:%S') as fecha_inicio,
        DATE_FORMAT(c.fecha_fin, '%Y-%m-%d %k:%i:%S') as fecha_fin

        FROM campeonato c
        $where
        ORDER BY id_campeonato ASC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function addCampeonato($tabla, $data)
    {
        $query = $this->db->insert($tabla, $data);
		if ($query)
			return $this->db->insert_id();
		else
			return false;
    }

    public function updateCampeonato($tabla, $comparar, $datos, $id)
    {
    	$this->db->where($comparar, $id);
		$result = $this->db->update($tabla, $datos);
		if ($result)
			return true;
		else
			return false;
    }

    public function deleteCampeonato($where){

        $sql = "DELETE FROM campeonato WHERE $where";
        $query = $this->db->query($sql);
        var_dump($this->db->last_query());
  
        if ($query)
            return true;
        else
            return false;
      }

}
