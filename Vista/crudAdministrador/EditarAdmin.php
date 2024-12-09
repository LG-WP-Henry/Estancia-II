<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Administrador') {
    header("Location: ../../login.php");
    exit();
}
include '../../Modelo/BD/bd.php';
include '../../Vista/includes/headerRegresar.php';
?>

<?php
$idAdmin = $_GET['id'];

    $sqlPsicologo = "SELECT * FROM administrador WHERE idAdministrador = $idAdmin";
    $sqlCredenciales = "SELECT usuario, contrasena FROM credenciales WHERE id_usuario = $idAdmin AND tipo_usuario = 'Administrador'";

    $resultAdmin = mysqli_query($conn, $sqlPsicologo);
    $resultadoCredenciales = mysqli_query($conn, $sqlCredenciales);

    if ($resultAdmin && mysqli_num_rows($resultAdmin) > 0 && $resultadoCredenciales && mysqli_num_rows($resultadoCredenciales) > 0) {
        $rowAdmin = mysqli_fetch_assoc($resultAdmin);
        $rowCredenciales = mysqli_fetch_assoc($resultadoCredenciales);
    ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Administrador</title>
    <link rel="stylesheet" href="../../Vista/Estilos/stylesForAddPAc.css"> <!-- Ruta de tu archivo CSS -->
</head>
<body>
    <h2>Editar Administrador</h2>
    <form method="post" action="../../Modelo/GestionAdmin/actAdmin.php?idAdministrador=<?php echo $idAdmin?>" class="form">

        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $rowAdmin['Nombre']?>" required><br><br>

        <label>Apellido Paterno:</label>
        <input type="text" name="apPaterno" value="<?php echo $rowAdmin['ApPaterno']?>" required><br><br>

        <label>Apellido Materno:</label>
        <input type="text" name="apMaterno" value="<?php echo $rowAdmin['ApMaterno']?>" required><br><br>

        <label>Usuario:</label>
        <input type="text" name="usuario" value="<?php  echo $rowCredenciales['usuario']?>" required><br><br>

        <label>Contraseña:</label>
        <input type="password" name="contrasena" value="<?php  echo $rowCredenciales['contrasena']?>" required><br><br>

        <input type="submit" value="Registrar Administrador">
    </form>
</body>
</html>

<?php
    } else {
        echo "<p>Error: No se encontraron datos del psicólogo.</p>";
    }

    mysqli_close($conn);
    ?>
