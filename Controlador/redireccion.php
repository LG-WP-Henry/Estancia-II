<?php
include '../Modelo/BD/bd.php';
session_start();

if($_SESSION['role']== 'Paciente'){
header("Location: ../Vista/crudCitas/consultaCitas.php");
}

if($_SESSION['role']== 'Psicólogo'){
    header("Location: ../Vista/crudCitas/verCitasPsicologo.php");
}



?>