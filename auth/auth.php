<?php 
require_once('model.php');
require_once('../config.php');

if (isset($_POST)) {
    $user = new AuthModel();
    $AUTH = $user->auth($_POST);
if ($AUTH['status'] == 'SUCCESS') {

    session_start();
    $user = $AUTH['registro'];
    print $_SESSION['user_logueado'] = $user[0]['user'];
    header("Location: ".R_HOME);
}else{
    header("Location: ".R_INDEX);
}
}else{
    header("Location: ".R_INDEX);
}