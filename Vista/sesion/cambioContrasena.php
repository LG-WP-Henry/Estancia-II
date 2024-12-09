<?php

session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Administrador') {
    header("Location: login.php");
    exit();
}



?>