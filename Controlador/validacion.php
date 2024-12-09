<?php
session_start();
include '../Modelo/BD/bd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $user = mysqli_real_escape_string($conn, $_POST['username']); 
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = $_POST['role'];

    $sql = "SELECT * FROM credenciales WHERE usuario = '$user' AND contrasena = '$password' AND tipo_usuario = '$role';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $_SESSION['username'] = $user;
        $_SESSION['role'] = $role;

        switch ($role) {
            case 'Administrador':
                header("Location: admin.php");
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
    } else {
        
        echo "<script>alert('Usuario o contraseña incorrectos');window.location.href='../login.php';</script>";
    }
}
?>
