<?php
session_start();
require_once('../config.php');
if (!isset($_SESSION["user_logueado"])) {
    header("Location: " . R_INDEX);
    return;
}

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

    $contador = set_obj_contador();

    switch ($event) {

        case GET_CONTADOR:


            $mensaje = isset($_SESSION['mensaje_action']) ? $_SESSION['mensaje_action'] : '';
            unset($_SESSION['mensaje_action']);
            $contadores = $contador->get();
            $contadores['mensaje'] = $mensaje;
          

            retornar_vista(VIEW_GET_CONTADOR, $contadores);

            break;

        case SET_CONTADOR:

            if (!empty($_POST)) {
                $result_set = $usuario->set($_POST);
                $_SESSION['mensaje_action'] = $result_set;
                header('Location: ' . RAIZ . MODULO . GET_CONTADOR . '/');
            } else {
                header('Location: ' . RAIZ . MODULO . GET_CONTADOR . '/');
            }

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
function set_obj_contador()
{
    $obj = new ContadorModel();
    return $obj;
}
handler();
