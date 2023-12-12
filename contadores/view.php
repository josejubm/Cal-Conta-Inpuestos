<?php
require_once('../config.php');

$diccionario = array(
    'subtitulo' => array(
        VIEW_SET_CONTADOR =>    'Agregar Usuario',
        VIEW_GET_CONTADOR =>    'Ver Usuarios',
        VIEW_DELETE_CONTADOR => 'Eliminar Usuarios',
        VIEW_EDIT_CONTADOR =>   'Actualizar Usuarios'
    ),
    'links_menu' => array(
        'VIEW_SET_CONTADOR' =>      MODULO . VIEW_SET_CONTADOR . '/',
        'VIEW_GET_CONTADOR' =>      MODULO . VIEW_GET_CONTADOR . '/',
        'VIEW_EDIT_CONTADOR' =>     MODULO . VIEW_EDIT_CONTADOR . '/',
        'VIEW_DELETE_CONTADOR' =>   MODULO . VIEW_DELETE_CONTADOR . '/'
    ),
    'form_actions' => array(
        'SET' =>    RAIZ . MODULO . SET_CONTADOR . '/',
        'GET' =>    RAIZ . MODULO . GET_CONTADOR . '/',
        'DELETE' => RAIZ . MODULO . DELETE_CONTADOR . '/',
        'EDIT' =>   RAIZ . MODULO . EDIT_CONTADOR . '/'
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
    $file = '../views/contadores/contadores_' . $form . '.html';
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

    if (is_array($data['mensaje']) && !empty($data['mensaje'])) {
        ########### mensaje de alerta ###########
        if ($data['mensaje']['tipo'] == 'success') {
            $mensaje = $data['mensaje']['menss'];
            $alert = '<div class="alert success">
                    <span class="closebtn">&times;</span>
                    <i class="bx bx-check-circle"></i>
                    <strong>¡Éxito!</strong> ' . $mensaje . '.
                </div>';
        } else if ($data['mensaje']['tipo'] == 'error') {
            $mensaje = $data['mensaje']['menss'];
            $alert = '<div class="alert error">
                    <span class="closebtn">&times;</span>
                    <i class="bx bx-error-alt"></i>
                    <strong>¡Error!</strong>' . $mensaje . '.
                </div>';
        } else {
            $alert = ' <div class="alert warning">
                    <span class="closebtn">&times;</span>
                    <i class="bx bx-warning"></i>
                    <strong>¡Advertencia!</strong> Ocurrio un error .
                </div> ';
        }
    } else {
        $alert = "";
    }
    ########### fin mensaje de alerta ########

    #######tabla contenido CONTADORES###
    $comilla = "'";
    $tabla_body = '<tbody>';
    $contador_lista = 1;
    foreach ($data['registros'] as $registro) {
        if (!empty($registro['Nombre']) && !empty($registro['Apellidos'])) // Se verifica que el campo Nombre no esté vacío 
        {
            $fila = '<tr id="' . $registro['Id'] . '">';
            $fila .= '<td>' . $contador_lista++ . '</td>';
            $fila .= '<td>' . $registro['Id'] . '</td>';
            $fila .= '<td>' . $registro['Nombre'] . ' ' . $registro['Apellidos'] . '</td>';
            $fila .= '<td>' . $registro['Telefono'] . '</td>';
            $fila .= '<td>' . $registro['RFC'] . '</td>';
            $fila .= '<td>' . $registro['Especialidad'] . '</td>';
            $fila .= '<td>' . $registro['Titulacion'] . '</td>';
            $fila .= '<td>' . $registro['Registro'] . '</td>';
            $fila .= '<td>' . '<a class="boton boton-outline-warning" href="#" > <i class="bx bx-edit"></i>Editar</a>' . '</td>';
            $fila .= '<td>' . '<a class="boton boton-outline-danger" href="#"  > <i class="bx bx-trash"></i>Eliminar </a>'. '</td>';
            $tabla_body .= $fila . '</tr>';
        }
    }
    $tabla_body .= '</tbody>';
    ######fin tabla#######

    $html = str_replace('{MAIN_CONTENT}', get_vista_html($vista), $html);
    $html = str_replace('{TBODY}', $tabla_body, $html);
    $html = str_replace('{ALERT}', $alert, $html);
    $html = str_replace('{TABLA_NAME}', 'USUARIOS', $html);
    $html = str_replace('{USER}', $_SESSION['user_logueado'], $html);
    /* insertar estilos y escripts propios del modulo */
    $html = str_replace('<!--MODULO_JS-->',  '<script src="../../frontend/js/js_Usuarios.js"></script>', $html);

    $html = render_dinamic_data($html, $diccionario['form_actions']);
    $html = render_dinamic_data($html, $diccionario['links_menu']);

    print $html;
}
