<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
// Incluir la vista
include '../../Vista/crudCitas/consultaCitas.php';

// Conexión a la base de datos y modelo
// Controlador
require '../Modelo/GestionCitas/consultaCitas.php';
$modeloCitas = new CitasModel();
$citasFuturas = $modeloCitas->obtenerCitasFuturas($idPaciente);


$username = $_SESSION['username'];
$sql = "SELECT id_usuario FROM credenciales WHERE usuario = '$username';";
$result = mysqli_query($conn, $sql);
$paciente = mysqli_fetch_assoc($result);
$idPaciente = $paciente['id_usuario'];

// Crear una instancia del modelo y obtener las citas
$modeloCitas = new ModeloCitas($conn);
$citasFuturas = $modeloCitas->obtenerCitasFuturas($idPaciente);
$citasVencidas = $modeloCitas->obtenerCitasVencidas($idPaciente);



// Pasar la variable a la vista
require '../Vista/crudCitas/consultaCitas.php';