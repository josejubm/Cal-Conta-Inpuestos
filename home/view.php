<?php
require_once('../config.php');
require_once('../extras/constantes_globales.php');

$diccionario = array(
    'subtitulo' => array(
        VIEW_SET_HOME =>    'ADD HOME',
        VIEW_GET_HOME =>    'INICIO HOME',
        VIEW_DELETE_HOME => 'DELETE HOME',
        VIEW_EDIT_HOME =>   'UPDATE HOME'
    ),
    'links_menu' => array(
        'VIEW_HOME_CONTADORES' => VIEW_INICIO_CONTADORES,
        'VIEW_HOME_CONTRIBUYENTES' => VIEW_INICIO_CONTRIBUYENTES,
        #'VIEW_SET_HOME' =>      MODULO . VIEW_SET_HOME . '/',
        #'VIEW_GET_HOME' =>      MODULO . VIEW_GET_HOME . '/',
        #'VIEW_EDIT_HOME' =>     MODULO . VIEW_EDIT_HOME . '/',
        #'VIEW_DELETE_HOME' =>   MODULO . VIEW_DELETE_HOME . '/'
    ),
    'form_actions' => array(
        'SET' =>    RAIZ . MODULO . SET_HOME . '/',
        'GET' =>    RAIZ . MODULO . GET_HOME . '/',
        'DELETE' => RAIZ . MODULO . DELETE_HOME . '/',
        'EDIT' =>   RAIZ . MODULO . EDIT_HOME . '/'
    )
);

function get_main_template($value = 'header or footer file')
{
    $file = '../views/main_' . $value . '.html';
    $main_template = file_get_contents($file);
    return $main_template;
}

function get_vista_html($form = 'get')
{
    $file = '../views/home_' . $form . '.html';
    $template = file_get_contents($file);
    return $template;
}

function render_dinamic_data($html, $data)
{
    foreach ($data as $clave => $valor) {
        $html = str_replace('{' . $clave . '}', $valor, $html);
    }
    return $html;
}

function retornar_vista($vista, $data = array())
{
    global $diccionario;
    $html = get_main_template('template');
    $html = str_replace(
        '{subtitulo}',
        $diccionario['subtitulo'][$vista],
        $html
    );

    $html = str_replace('{MAIN_CONTENT}', get_vista_html($vista), $html);

    $html = str_replace('{USER}', $_SESSION['user_logueado'], $html);

    $html = render_dinamic_data($html, $diccionario['form_actions']);
    $html = render_dinamic_data($html, $diccionario['links_menu']);

    print $html;
}
