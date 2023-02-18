<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Calendario extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('calendario_model');
        $this->load->library(['ion_auth', 'form_validation']);

        date_default_timezone_set('America/Santiago');
    }


    public function getCalendario()
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


            if ($query = $this->calendario_model->getCalendario()) {
                foreach ($query->result() as $res) {
                    $row = null;
                    $row = new stdClass();
                    $row->id_agendamiento = $res->id_agendamiento;
                    $row->id_club = $res->id_club;
                    $row->id_usuario = $res->id_usuario;
                    $row->nombre_club = $res->nombre_club;
                    $row->id_serie = $res->id_serie;
                    $row->nombre_serie = $res->nombre_serie;
                    $row->id_usuario_1 = $res->id_1;
                    $row->nombre_usuario_1 = $res->nombre_1;
                    $row->id_usuario_2 = $res->id_2;
                    $row->nombre_usuario_2 = $res->nombre_2;
                    $row->fecha_agenda_inicio = $res->fecha_agenda_inicio;
                    $row->fecha_agenda_fin = $res->fecha_agenda_fin;
                    $row->festivo = $res->festivo;
                    $row->observacion = $res->observacion;

                    array_push($response->data, $row);
                }
            }
            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    public function getCalendarioById()
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

            $id_agendamiento = "";

            if (!empty($this->input->post('id_agendamiento'))) {
                $id_agendamiento = $this->security->xss_clean($this->input->post('id_agendamiento'));
            }

            $where = " WHERE id_agendamiento = " . $id_agendamiento;

            if ($query = $this->calendario_model->getCalendarioById($where)) {
                foreach ($query->result() as $res) {
                    $row = null;
                    $row = new stdClass();
                    $row->id_agendamiento = $res->id_agendamiento;
                    $row->id_club = $res->id_club;
                    $row->id_usuario = $res->id_usuario;
                    $row->nombre_club = $res->nombre_club;
                    $row->id_serie = $res->id_serie;
                    $row->nombre_serie = $res->nombre_serie;
                    $row->id_usuario_1 = $res->id_1;
                    $row->nombre_usuario_1 = $res->nombre_1;
                    $row->id_usuario_2 = $res->id_2;
                    $row->nombre_usuario_2 = $res->nombre_2;
                    $row->fecha_agenda_inicio = $res->fecha_agenda_inicio;
                    $row->fecha_agenda_fin = $res->fecha_agenda_fin;
                    $row->festivo = $res->festivo;
                    $row->observacion = $res->observacion;

                    array_push($response->data, $row);
                }
            }
            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    public function addCalendario()
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

            if (!empty($this->input->post('id_serie'))) {
                $request->id_serie = $this->security->xss_clean($this->input->post('id_serie'));
            }

            if (!empty($this->input->post('id_club'))) {
                $request->id_club = $this->security->xss_clean($this->input->post('id_club'));
            }

            if (!empty($this->input->post('fecha_inicio_agenda'))) {
                $request->fecha_inicio_agenda = $this->security->xss_clean($this->input->post('fecha_inicio_agenda'));
            }

            if (!empty($this->input->post('fecha_fin_agenda'))) {
                $request->fecha_fin_agenda = $this->security->xss_clean($this->input->post('fecha_fin_agenda'));
            }

            if (!empty($this->input->post('festivo'))) {
                $request->festivo = $this->security->xss_clean($this->input->post('festivo'));
            }

            if (!empty($this->input->post('observacion'))) {
                $request->observacion = $this->security->xss_clean($this->input->post('observacion'));
            }

            if (!empty($this->input->post('id_usuario_1'))) {
                $request->id_usuario_1 = $this->security->xss_clean($this->input->post('id_usuario_1'));
            }

            if (!empty($this->input->post('id_usuario_2'))) {
                $request->id_usuario_2 = $this->security->xss_clean($this->input->post('id_usuario_2'));
            }


            //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
            $datos = array(
                'id_usuario' => $request->id_usuario,
                'id_serie' => $request->id_serie,
                'id_club' => $request->id_club,
                'fecha_agenda_inicio' => $request->fecha_inicio_agenda,
                'fecha_agenda_fin' => $request->fecha_fin_agenda,
                'festivo' => "1",
                'observacion' => $request->observacion,
                'id_usuario_1' =>  $request->id_usuario_1,
                'id_usuario_2' =>  $request->id_usuario_2
            );


            //INSERCION, ACTUALIZACION U OPERACIONES
            if ($query = $this->calendario_model->addCalendario('agendamiento', $datos)) {
                $response->proceso = 1;
                $response->id = $query;
                $response->data = $datos;
            } else {
                // print_r($this->calendario_model->addCalendario('calendario', $datos));

                $response->errores[] = "El dato no pudo ser ingresado";
            }

            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    public function updateCalendario()
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
            if ($this->input->post('id_calendario')) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_calendario', true)));
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
                if ($query = $this->calendario_model->updateCalendario('agendamiento', 'id_agendamiento', $datos, $request->id)) {
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

    public function deleteCalendario()
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
                if ($this->calendario_model->deleteCalendario($where)) {
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


    public function deleteDetallesCotizacion()
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
            if ($this->input->post('id_cotizacion')) {
                $request->id = $this->security->xss_clean($this->input->post('id_cotizacion'));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $where = " AND id_cotizacion=$request->id";


            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($query = $this->calendario_model->deleteDetalles($where, $fecha)) {
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
