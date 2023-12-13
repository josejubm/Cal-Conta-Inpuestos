<?php
session_start();
require_once('../config.php');
if (!isset($_SESSION["user_logueado"])) {
    header("Location: " . R_INDEX);
    return;
}

require_once('constants.php');
require_once('../extras/constantes_globales.php');
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

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                print_r($_POST);

                $contador_set = $contador->set($_POST);

                $_SESSION['mensaje_action'] = $contador_set['menss'];

                header("Location: " . RAIZ . MODULO . GET_CONTADOR);
                exit();
            } else {
                $data = $_POST;
                retornar_vista(VIEW_SET_CONTADOR, $data);
            }

            break;
        case DELETE_CONTADOR:
            $id = isset($_GET['cedula']) ? $_GET['cedula'] : null;
            if (isset($id)) {

                $contador_delete = $contador->delete($id);
                $_SESSION['mensaje_action'] = $contador_delete['menss'];

                echo  $_SESSION['mensaje_action'];

                header("Location: " . RAIZ . MODULO . GET_CONTADOR);
            } else {
                $data = $_POST;
                retornar_vista(VIEW_GET_CONTADOR, $data);
            }

            exit();
            break;

        case EDIT_CONTADOR:
            if (!empty($_POST)) {
                print_r($_POST);

                $result_edited = $contador->edit($_POST);
                $_SESSION['mensaje_action'] = $result_edited;


                header('Location: ' . RAIZ . MODULO . GET_CONTADOR . '/');
                exit();
            } else {
                $id = $_GET['cedula'];
                $contadores = $contador->get();
                if ($contadores && isset($contadores['registros'])) {
                    $contadorEncontrado = null;
                    // Iterar sobre los contadores
                    foreach ($contadores['registros'] as $contadorData) {
                        if ($contadorData['Id'] === $id) {
                            // Encontrar el contador que coincide con la cédula
                            $contadorEncontrado = $contadorData;
                            break;
                        }
                    }
                    if ($contadorEncontrado) {
                        retornar_vista2(VIEW_EDIT_CONTADOR, $contadorEncontrado);
                        exit();
                    } else {
                        echo "No se encontró un contador con la cédula especificada.";
                    }
                } else {
                    echo "No se encontraron contadores.";
                }
                exit();
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
