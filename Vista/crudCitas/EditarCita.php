
<?php
    include '../../Modelo/BD/bd.php';
    include '../includes/headerregresar.php';
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: ../../login.php");
        exit();
    }

    // Obtener la información de la cita
    $idCita = $_GET['idCita'];
    $sql = "SELECT * FROM citas WHERE idCitas = $idCita";
    $resultado = mysqli_query($conn, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $cita = mysqli_fetch_assoc($resultado);
        $fecha = $cita['Fecha'];
        $idPacienteCi = $cita['idPacienteCi'];
        $cedulaCita = $cita['CedulaCita'];
    } else {
        echo "<p>Error: No se encontraron datos de la cita.</p>";
        exit;
    }

    $sqlPsicologos = "SELECT Cedula, Nombre, ApPaterno FROM psicologo";
    $resultadoPsicologos = mysqli_query($conn, $sqlPsicologos);

    ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cita</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Estilos/stylesForAddPAc.css">
</head>
<body>
    <h2>Editar Cita</h2>

   

    <form method="post" action="../../Modelo/GestionCitas/actCitas.php?idCita=<?php echo $idCita; ?>" class="form">
        <label>Fecha y Hora:</label>
        <input type="datetime-local" name="fecha" value="<?php echo date('Y-m-d\TH:i', strtotime($fecha)); ?>" required><br><br>

        <input type="hidden" name="idPacienteCi" value="<?php echo $idPacienteCi; ?>"><br>

        <label>Psicólogo:</label>
        <select name="cedulaCita" required>
            <?php while ($psicologo = mysqli_fetch_assoc($resultadoPsicologos)) { ?>
                <option value="<?php echo $psicologo['Cedula']; ?>" 
                    <?php echo $psicologo['Cedula'] == $cedulaCita ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($psicologo['Nombre'] . " " . $psicologo['ApPaterno']); ?>
                </option>
            <?php } ?>
        </select><br><br>
        
        <input type="submit" name="actualizar" value="Guardar Cambios">
    </form>

    <?php 
    mysqli_free_result($resultado);
    mysqli_free_result($resultadoPsicologos);
    mysqli_close($conn);
    ?>
</body>
</html>
