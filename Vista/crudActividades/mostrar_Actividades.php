<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Psicólogo') {
    header("Location: ../../login.php");
    exit();
}

include '../../Modelo/BD/bd.php';
include '../../Vista/includes/headerPsico_IN.php';

// Obtener la lista de actividades
$sql_actividades = "SELECT idActividades, Actividad FROM actividades";
$result_actividades = mysqli_query($conn, $sql_actividades);

// Obtener la lista de pacientes
$sql_pacientes = "SELECT idPaciente, Nombre, ApPaterno, ApMaterno FROM paciente";
$result_pacientes = mysqli_query($conn, $sql_pacientes);
?>

<body>
    <h1>Asignar Actividades</h1>
    <form action="../../Modelo/GestionActividad/procesar_Actividades.php" method="POST">
        <label for="paciente">Seleccionar Paciente:</label>
        <select name="idPaciente" id="paciente" required>
            <?php while ($paciente = mysqli_fetch_assoc($result_pacientes)) { ?>
                <option value="<?php echo $paciente['idPaciente']; ?>">
                    <?php echo $paciente['Nombre'] . " " . $paciente['ApPaterno'] . " " . $paciente['ApMaterno']; ?>
                </option>
            <?php } ?>
        </select>

        <h2>Actividades</h2>
        <table>
            <thead>
                <tr>
                    <th>Seleccionar</th>
                    <th>Nombre de la Actividad</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($actividad = mysqli_fetch_assoc($result_actividades)) { ?>
                    <tr>
                        <td><input type="checkbox" name="actividades[]" value="<?php echo $actividad['idActividades']; ?>"></td>
                        <td><?php echo $actividad['Actividad']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <button type="submit">Asignar Actividades</button>
    </form>
</body>
</html>
