<?php
session_start();
require_once('./config.php');

if (isset($_SESSION["user_logueado"])) {
    header("Location: ".R_HOME);
} else {
    header("Location: login.php");
}
