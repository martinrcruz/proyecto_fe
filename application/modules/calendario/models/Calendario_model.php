<?php

class Calendario_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function getCalendario($where='')
    {
        $sql = "SELECT a.*,
        a.id_agendamiento as id_agendamiento,
        a.id_jugador as id_usuario,
        u1.id as id_1,
        CONCAT(u1.first_name, ' ', u1.last_name) as nombre_1,
        u2.id as id_2,
        CONCAT(u2.first_name, ' ', u1.last_name) as nombre_2,
        s.id_serie as id_serie,
        s.nombre as nombre_serie,
        c.id_club as id_club,
        c.nombre as nombre_club,
        DATE_FORMAT(a.fecha_agenda_inicio, '%Y-%m-%d %k:%i:%S') as fecha_agenda_inicio,
        DATE_FORMAT(a.fecha_agenda_fin, '%Y-%m-%d %k:%i:%S') as fecha_agenda_fin

        FROM agendamiento a
        LEFT JOIN serie s ON s.id_serie=a.id_serie
        LEFT JOIN club c ON c.id_club=a.id_club
        LEFT JOIN users u1 ON u1.id=a.id_usuario_1
        LEFT JOIN users u2 ON u2.id=a.id_usuario_2
        $where
        ORDER BY id_agendamiento ASC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function getCalendarioById($where='')
    {
        $sql = "SELECT a.*,
        a.id_agendamiento as id_agendamiento,
        a.id_jugador as id_usuario,
        u1.id as id_1,
        CONCAT(u1.first_name, ' ', u1.last_name) as nombre_1,
        u2.id as id_2,
        CONCAT(u2.first_name, ' ', u1.last_name) as nombre_2,
        s.id_serie as id_serie,
        s.nombre as nombre_serie,
        c.id_club as id_club,
        c.nombre as nombre_club,
        DATE_FORMAT(a.fecha_agenda_inicio, '%Y-%m-%d %k:%i:%S') as fecha_agenda_inicio,
        DATE_FORMAT(a.fecha_agenda_fin, '%Y-%m-%d %k:%i:%S') as fecha_agenda_fin

        FROM agendamiento a
        LEFT JOIN serie s ON s.id_serie=a.id_serie
        LEFT JOIN club c ON c.id_club=a.id_club
        LEFT JOIN users u1 ON u1.id=a.id_usuario_1
        LEFT JOIN users u2 ON u2.id=a.id_usuario_2
        $where
        ORDER BY id_agendamiento ASC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function addCalendario($tabla, $data)
    {
        $query = $this->db->insert($tabla, $data);
		if ($query)
			return $this->db->insert_id();
		else
			return false;
    }

    public function updateCalendario($tabla, $comparar, $datos, $id)
    {
    	$this->db->where($comparar, $id);
		$result = $this->db->update($tabla, $datos);
		if ($result)
			return true;
		else
			return false;
    }

    public function deleteCalendario($where){

        $sql = "DELETE FROM agendamiento WHERE $where";
        $query = $this->db->query($sql);
        var_dump($this->db->last_query());
  
        if ($query)
            return true;
        else
            return false;
      }

}
