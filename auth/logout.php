<?php
require_once('../config.php'); 

session_start();
session_destroy();
header("Location: ". R_INDEX);
