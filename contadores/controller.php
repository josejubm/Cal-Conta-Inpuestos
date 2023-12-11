<?php
session_start();
if (!isset($_SESSION["user_logueado"])) {
    header("Location: /dwp_2023_pf_bmanuel/index.php");
  return;
}

require_once('../config.php');
require_once('constants.php');
require_once('model.php');
require_once('view.php');
function handler()
{

    if (empty($_SERVER['REQUEST_URI']) || $_SERVER['REQUEST_URI'] === MODULO) {
        header("Location: " . MODULO . VIEW_GET_CONTADOR . "/");
        exit();
    }

    $event = VIEW_SET_CONTADOR;
    $uri = $_SERVER['REQUEST_URI'];
    $peticiones = array(
        SET_CONTADOR,          GET_CONTADOR,          DELETE_CONTADOR,           EDIT_CONTADOR,
        VIEW_SET_CONTADOR,     VIEW_GET_CONTADOR,     VIEW_DELETE_CONTADOR,      VIEW_EDIT_CONTADOR
    );

    foreach ($peticiones as $peticion) {
        $uri_peticion = MODULO . $peticion . '/';
        if (strpos($uri, $uri_peticion) == true) {
            $event = $peticion;
        }
    }

    $usuario = set_obj_usuario();

    switch ($event) {
        case SET_CONTADOR:
            if (!empty($_POST)) {
                $result_set = $usuario->set($_POST);
                $_SESSION['mensaje_action'] = $result_set;
                header('Location: ' . RAIZ . MODULO . GET_CONTADOR . '/');
            } else {
                header('Location: ' . RAIZ . MODULO . GET_CONTADOR . '/');
            }
            break;
        case GET_CONTADOR:
            $mensaje = isset($_SESSION['mensaje_action']) ? $_SESSION['mensaje_action'] : '';
            unset($_SESSION['mensaje_action']);
            $usuarios = $usuario->get();
            $usuarios['mensaje'] = $mensaje;
            retornar_vista(VIEW_SET_CONTADOR, $usuarios);
            break;
        case DELETE_CONTADOR:
            if (!empty($_POST)) {
                $result_delete = $usuario->delete($_POST['id_delete']);
                $_SESSION['mensaje_action'] = $result_delete;
                header('Location: ' . RAIZ . MODULO . GET_CONTADOR . '/');
            } else {
                header('Location: ' . RAIZ . MODULO . GET_CONTADOR . '/');
            }
            /* header("Location: /dwp_2023_pf_bmanuel/autores/mostrar/"); */
            break;
        case EDIT_CONTADOR:
            if (!empty($_POST)) {
                $result_edited = $usuario->edit($_POST);
                $_SESSION['mensaje_action'] = $result_edited;
                header('Location: ' . RAIZ . MODULO . GET_CONTADOR . '/');
            } else {
                header('Location: ' . RAIZ . MODULO . GET_CONTADOR . '/');
            }
            break;
        default:
        header('Location: ' . RAIZ . MODULO . GET_CONTADOR . '/');

    }
}
function set_obj_usuario()
{
    $obj = new UsuarioModel();
    return $obj;
}
handler();