<?php
session_start();
include '../Modelo/BD/bd.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$user = mysqli_real_escape_string($conn, $_SESSION['username']); 
    $password = mysqli_real_escape_string($conn, $_SESSION['password']);
    $role = $_SESSION['role'];


        switch ($role) {
            case 'Administrador':
                header("Location: ../indexAdmin.php");
                break;
            case 'Psicólogo':
                header("Location: ../indexPsicologo.php");
                break;
            case 'Paciente':
                header("Location: ../indexPaciente.php");
                break;
            default:
                echo "Rol no válido.";
                break;
        }