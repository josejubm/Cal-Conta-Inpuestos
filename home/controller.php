<?php
require_once('../config.php');
session_start();
if (!isset($_SESSION["user_logueado"])) {
    header("Location: ".R_INDEX);
  return;
}

require_once('../extras/constantes_globales.php');
require_once('constants.php');
require_once('model.php');
require_once('view.php');

function handler()
{
    // redirigir a la vista VIEW_GET_AUTOR si no se especifica ninguna petición
    if (empty($_SERVER['REQUEST_URI']) || $_SERVER['REQUEST_URI'] === MODULO) {
        header("Location: " . MODULO . VIEW_GET_HOME . "/");
        exit();
    }

    $event = VIEW_GET_HOME;
    $uri = $_SERVER['REQUEST_URI'];
    
    $peticiones = array(
        SET_HOME,          GET_HOME,          DELETE_HOME,           EDIT_HOME,
        VIEW_SET_HOME,     VIEW_GET_HOME,     VIEW_DELETE_HOME,      VIEW_EDIT_HOME
    );

    foreach ($peticiones as $peticion) {
        $uri_peticion = MODULO . $peticion . '/';
        if (strpos($uri, $uri_peticion) == true) {
            $event = $peticion;
        }
    }
    $home = set_obj_home();
    switch ($event) {
            case GET_HOME:

            retornar_vista(VIEW_GET_HOME);
            break;
        default:
        header('Location: ' . RAIZ . MODULO . GET_HOME . '/');
    }
}
function set_obj_home()
{
    $obj_Home = new HomeModel();
    return $obj_Home;
}
handler();