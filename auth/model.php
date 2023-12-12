<?php
require_once('../models/db_abstract_model.php');

class AuthModel extends DBAbstractModel
{
    public function get()
    {
    }
    public function set($data_insert = array())
    {
    }
    public function edit($data_new = array())
    {
    }
    public function delete($id = '')
    {
    }

    public function auth($data = array())
    {
        $user = $data['user'];
        $password = $data['password'];

        $this->query = "SELECT * FROM usuarios WHERE username = '$user' AND password = '$password' ";
        $this->get_results_from_query();

        if (!$this->rows) {
            return [
                'status' => 'ERROR',
                'mensaje' => 'NO EXISTE EL USUARIO PARA LOGEARSE ',
                'registros' => []
            ];
        } else {
            $resultado = array_map(function ($row) {
                return [
                    'Id' => $row['usuario_id'],
                    'user' => $row['username'],
                    'password' => $row['password']
                ];
            }, $this->rows);

            return [
                'status' => 'SUCCESS',
                'mensaje' => 'USUARIO LOGUEADO ',
                'registro' => $resultado
            ];
        }
    }
}
