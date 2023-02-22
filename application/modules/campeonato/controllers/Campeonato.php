<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Campeonato extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('campeonato_model');
        $this->load->library(['ion_auth', 'form_validation']);

        date_default_timezone_set('America/Santiago');
    }


    public function getCampeonato()
    {
        if (true) {
            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [PETICION]
            $request = new stdClass();
            $request->id = null;
            $request->data = [];

            $fecha = date('Y-m-d H:i:s');

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [RESPUESTA]
            $response = new stdClass();
            $response->id = null;
            $response->data = [];
            $response->proceso = 0;
            $response->errores = [];


            if ($query = $this->campeonato_model->getCampeonato()) {
                foreach ($query->result() as $res) {
                    $row = null;
                    $row = new stdClass();
                    $row->id_campeonato = $res->id_campeonato;
                    $row->id_usuario = $res->id_usuario;
                    $row->titulo = $res->titulo;
                    $row->descripcion = $res->descripcion;
                    $row->fecha_inicio = $res->fecha_inicio;
                    $row->fecha_fin = $res->fecha_fin;
        

                    array_push($response->data, $row);
                }
            }
            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    public function getCampeonatoById()
    {
        if (true) {
            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [PETICION]
            $request = new stdClass();
            $request->id = null;
            $request->data = [];

            $fecha = date('Y-m-d H:i:s');

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [RESPUESTA]
            $response = new stdClass();
            $response->id = null;
            $response->data = [];
            $response->proceso = 0;
            $response->errores = [];

            $id_campeonato = "";

            if (!empty($this->input->post('id_campeonato'))) {
                $id_campeonato = $this->security->xss_clean($this->input->post('id_campeonato'));
            }

            $where = " WHERE id_campeonato = " . $id_campeonato;

            if ($query = $this->campeonato_model->getCampeonatoById($where)) {
                foreach ($query->result() as $res) {
                    $row = null;
                    $row = new stdClass();
                    $row->id_campeonato = $res->id_campeonato;
                    $row->id_usuario = $res->id_usuario;
                    $row->titulo = $res->titulo;
                    $row->descripcion = $res->descripcion;
                    $row->fecha_inicio = $res->fecha_inicio;
                    $row->fecha_fin = $res->fecha_fin;

                    array_push($response->data, $row);
                }
            }
            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    public function addCampeonato()
    {
        if (true) {

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [PETICION]
            $request = new stdClass();
            $request->id = null;
            $request->data = [];

            $fecha = date('Y-m-d H:i:s');

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [RESPUESTA]
            $response = new stdClass();
            $response->id = null;
            $response->data = [];
            $response->proceso = 0;
            $response->errores = [];


            if (!empty($this->input->post('id_usuario'))) {
                $request->id_usuario = $this->security->xss_clean($this->input->post('id_usuario'));
            }

            if (!empty($this->input->post('titulo'))) {
                $request->titulo = $this->security->xss_clean($this->input->post('titulo'));
            }

            if (!empty($this->input->post('descripcion'))) {
                $request->descripcion = $this->security->xss_clean($this->input->post('descripcion'));
            }

            if (!empty($this->input->post('fecha_inicio'))) {
                $request->fecha_inicio = $this->security->xss_clean($this->input->post('fecha_inicio'));
            }

            if (!empty($this->input->post('fecha_fin'))) {
                $request->fecha_fin = $this->security->xss_clean($this->input->post('fecha_fin'));
            }

            if (!empty($this->input->post('id_listado_jugadores'))) {
                $request->id_listado_jugadores = $this->security->xss_clean($this->input->post('id_listado_jugadores'));
            }



            //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
            $datos = array(
                'id_usuario' => $request->id_usuario,
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
                'id_listado_jugadores' => $request->id_listado_jugadores,
            );


            //INSERCION, ACTUALIZACION U OPERACIONES
            if ($query = $this->campeonato_model->addCampeonato('campeonato', $datos)) {
                $response->proceso = 1;
                $response->id = $query;
                $response->data = $datos;
            } else {
                // print_r($this->campeonato_model->addCampeonato('campeonato', $datos));

                $response->errores[] = "El dato no pudo ser ingresado";
            }

            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    public function updateCampeonato()
    {
        if (true) {

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [PETICION]
            $request = new stdClass();
            $request->id = null;
            $request->data = [];

            $fecha = date('Y-m-d H:i:s');

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [RESPUESTA]
            $response = new stdClass();
            $response->id = null;
            $response->data = [];
            $response->proceso = 0;
            $response->errores = [];

            //COMPROBAMOS SI VIENE UN ID MEDIANTE LA PETICION POST, Y SI ES QUE VIENE LO GUARDAMOS (SI NO VIENE EL ID NO ES POSIBLE EDITAR, YA QUE NO ESTAMOS APUNTANDO A NINGUNA TUPLA DE DATOS)
            if ($this->input->post('id_campeonato')) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_campeonato', true)));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            if (sizeof($response->errores) == 0) {
                //VERIFICAMOS LAS VARIABLES QUE RECIBIMOS PARA EDITAR.
                if (!empty($this->input->post('id_usuario'))) {
                    $request->id_usuario = $this->security->xss_clean($this->input->post('id_usuario'));
                }

                if (!empty($this->input->post('id_serie'))) {
                    $request->id_serie = $this->security->xss_clean($this->input->post('id_serie'));
                }

                if (!empty($this->input->post('id_club'))) {
                    $request->id_club = $this->security->xss_clean($this->input->post('id_club'));
                }

                if (!empty($this->input->post('fecha_agenda_inicio'))) {
                    $request->fecha_inicio_agenda = $this->security->xss_clean($this->input->post('fecha_agenda_inicio'));
                }

                if (!empty($this->input->post('fecha_agenda_fin'))) {
                    $request->fecha_fin_agenda = $this->security->xss_clean($this->input->post('fecha_agenda_fin'));
                }

                if (!empty($this->input->post('festivo'))) {
                    $request->festivo = $this->security->xss_clean($this->input->post('festivo'));
                }

                if (!empty($this->input->post('observacion'))) {
                    $request->observacion = $this->security->xss_clean($this->input->post('observacion'));
                }

                //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
                $datos = array(
                    'id_serie' => $request->id_serie,
                    'id_club' => $request->id_club,
                    'fecha_agenda_inicio' => $request->fecha_inicio_agenda,
                    'fecha_agenda_fin' => $request->fecha_fin_agenda,
                    'festivo' => "1",
                    'observacion' => $request->observacion,
                    'id_usuario_1' => 2,
                    'id_usuario_2' => 3
                );
            }

            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($query = $this->campeonato_model->updateCampeonato('agendamiento', 'id_agendamiento', $datos, $request->id)) {
                    //SI EL PROCESO ES EXITOSO, DEVOLVERA UN VALOR DENTRO DEL ARRAY DE RESPUESTA IGUAL A 1
                    $response->proceso = 1;
                    $response->id = $query;
                    $response->data = $datos;
                }
            } else {
                $response->errores[] = "Ocurrió un problema al procesar la edicion";
            }

            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    public function deleteCampeonato()
    {
        if (true) {

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [PETICION]
            $request = new stdClass();
            $request->id = null;
            $fecha = date('Y-m-d H:i:s');

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [RESPUESTA]
            $response = new stdClass();
            $response->id = null;
            $response->data = [];
            $response->proceso = 0;
            $response->errores = [];

            $where = '';

            //COMPROBAMOS SI VIENE UN ID MEDIANTE LA PETICION POST, Y SI ES QUE VIENE LO GUARDAMOS.
            if ($this->input->post('id_agendamiento')) {
                $request->id = $this->security->xss_clean($this->input->post('id_agendamiento'));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $where = " id_agendamiento=".$request->id;

            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($this->campeonato_model->deleteCampeonato($where)) {
                    //SI EL PROCESO ES EXITOSO, DEVOLVERA UN VALOR DENTRO DEL ARRAY DE RESPUESTA IGUAL A 1
                    $response->proceso = 1;
                }
            } else {
                $response->errores[] = "Ocurrió un problema al procesar la eliminacion";
            }

            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

}
