<?php

class Usuario_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getUsuario($where='')
    {
        $sql = "SELECT 
        u.id as ID_USUARIO,
        u.username as NOMBRE_USUARIO,
        u.email AS CORREO_USUARIO,
        u.first_name as NOMBRE,
        u.last_name as APELLIDO,
        u.last_login AS ULTIMA_CONEXION,
        pu.NRO_CONTACTO AS CELULAR,
        pu.CARGO as CARGO
        
        FROM users u
        LEFT JOIN perfil_usuario pu ON pu.ID_USUARIO=u.id
        WHERE u.active=1 
        ORDER BY u.ID DESC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function insertUsuario($tabla, $data)
    {
        $query = $this->db->insert($tabla, $data);
		if ($query)
			return $this->db->insert_id();
		else
			return false;
    }
    public function updateUsuario($tabla, $comparar, $datos, $id)
    {
    	$this->db->where($comparar, $id);
		$result = $this->db->update($tabla, $datos);
		if ($result)
			return true;
		else
			return false;
    }



}
