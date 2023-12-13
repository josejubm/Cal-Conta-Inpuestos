<?php
# Importar modelo de abstracción de base de datos
require_once('../models/db_abstract_model.php');

class ContadorModel extends DBAbstractModel
{

    public function get()
    {
        $this->query = "SELECT c.*, u.username
        FROM contadores c
        LEFT JOIN usuarios u ON c.cedula_profesional = u.contador_cedula;
        ";
        $this->get_results_from_query();

        if (!$this->rows) {
            return [
                'mensaje' => 'No se encontraron contadores',
                'registros' => []
            ];
        }
        $resultados = array_map(function ($row) {
            return [
                'Id' => $row['cedula_profesional'],
                'Nombre' => $row['nombre'],
                'Apellidos' => $row['apellidos'],
                'Correo' => $row['correo'],
                'Telefono' => $row['telefono'],
                'RFC' => $row['rfc'],
                'Especialidad' => $row['especialidad'],
                'Usuario' => $row['username'],
                'Titulacion' => $row['fecha_titulacion'],
                'Registro' => $row['fecha_registro']
            ];
        }, $this->rows);

        return [
            'mensaje' => 'CONTADORES encontrados',
            'registros' => $resultados
        ];
    }

    public function set($data_insert = array())
    {
        // Datos del contador
        $cedula_profesional = $data_insert['cedula_profesional'];
        $nombre = $data_insert['nombre'];
        $apellidos = $data_insert['apellidos'];
        $correo = $data_insert['correo'];
        $telefono = $data_insert['telefono'];
        $rfc = $data_insert['rfc'];
        $especialidad = $data_insert['especialidad'];
        $fecha_titulacion = $data_insert['fecha_titulacion'];

        // Datos del usuario
        $usuario = $data_insert['usuario'];
        $password = $data_insert['password'];
        $tipo = $data_insert['tipo'];

        // Comprobar si los datos del usuarios ya existen
        $this->query = "SELECT * FROM contadores WHERE  cedula_profesional = '$cedula_profesional' ";
        $this->get_results_from_query();

        if (count($this->rows) > 0) {

            $mensaje = "Error: El Contador [ $nombre $apellidos ] ya existe";
            return array(
                'tipo' => "error",
                'menss' => $mensaje
            );
        } else {
            // Insertar los datos del Usuario
            $this->query = "INSERT INTO contadores (cedula_profesional, nombre, apellidos, correo, telefono, rfc, especialidad, fecha_titulacion)
                            VALUES ('$cedula_profesional','$nombre', '$apellidos', '$correo', '$telefono', '$rfc', '$especialidad', '$fecha_titulacion')";
            $this->execute_single_query();

            // Insertar los datos del Usuario asociado al Contador
            $this->query = "INSERT INTO usuarios (username, password, contador_cedula, rol_id)
                    VALUES ('$usuario', '$password', '$cedula_profesional', '$tipo')";
            $this->execute_single_query();

            $mensaje = "Contador [$nombre $apellidos] y Usuario [$usuario] agregados correctamente";

            return array(
                'tipo' => "success",
                'menss' => $mensaje
            );
        }
    }

    public function edit($data_new = array())
    {
        $id_old = $data_new['cedula_old'];
        $id  = $data_new['cedula_profesional'];
        $nombre  = $data_new['nombre'];
        $apellidos = $data_new['apellidos'];
        $correo = $data_new['correo'];
        $telefono = $data_new['telefono'];
        $rfc = $data_new['rfc'];
        $especialidad = $data_new['especialidad'];
    
        // Comprobar si los datos del autor existen
        $this->query = "SELECT * FROM contadores WHERE cedula_profesional ='$id_old'";
        $this->get_results_from_query();
        $data  = $this->rows;
        if (count($this->rows) > 0) {
            $this->query = "UPDATE contadores SET
                            cedula_profesional='$id',
                            nombre='$nombre',
                            apellidos='$apellidos',
                            correo='$correo',
                            telefono='$telefono',
                            rfc='$rfc',
                            especialidad='$especialidad'
                            WHERE cedula_profesional='$id_old'";
            $this->execute_single_query();
    
            $mensaje = $this->mensaje = "SE MODIFICÓ EL Contador: " . $data[0]['nombre'] . " " . $data[0]['apellidos'] . " ";
            return array(
                'tipo' => "success",
                'menss' => $mensaje
            );
        } else {
            $mensaje = "NO SE PUDO MODIFICAR AL CONTADOR";
            return array(
                'tipo' => "error",
                'menss' => $mensaje
            );
        }
    }
    


    public function delete($id = '')
    {
        // Comprobar si los datos del usuarios existen
        $this->query = "SELECT * FROM contadores LEFT JOIN usuarios ON contadores.cedula_profesional = usuarios.contador_cedula WHERE contadores.cedula_profesional = '$id'";
        $this->get_results_from_query();
        $data  = $this->rows;

        if (count($this->rows) > 0) {
            $this->query = "DELETE FROM usuarios WHERE contador_cedula = '$id';";
            $this->execute_single_query();

            $this->query = "DELETE FROM contadores WHERE cedula_profesional = '$id'";
            $this->execute_single_query();

            $mensaje = $this->mensaje = "SE ELIMINO EL CONTADOR: " . $data[0]['nombre'] . " " . $data[0]['apellidos'] . " Y SU USUARIO ASOCIADO" . $data[0]['username'] . "";

            return array(
                'tipo' => "success",
                'menss' => $mensaje
            );
        } else {
            $mensaje = "NO EXISTE EL CONTADOR";
            return array(
                'tipo' => "error",
                'menss' => $mensaje
            );
        }
    }
}
