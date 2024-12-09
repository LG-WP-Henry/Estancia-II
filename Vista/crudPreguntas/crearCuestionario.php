<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Psicólogo') {
    header("Location: login.php");
    exit();
}

include '../../Modelo/BD/bd.php';
include '../includes/headerregresar.php';

$username = $_SESSION['username'];
$sql = "SELECT id_usuario FROM credenciales WHERE usuario = '$username';";
$result = mysqli_query($conn, $sql);
$psicologo = mysqli_fetch_assoc($result);
$cedulaPsicologo = $psicologo['id_usuario'];

echo "<!-- Cedula del Psicólogo: $cedulaPsicologo -->";

// Consulta para obtener las preguntas
$sql = "SELECT idPregunta, pregunta FROM preguntas";
$result = $conn->query($sql);

// Consulta para obtener los pacientes
$sql_pacientes = "SELECT idPaciente, Nombre, ApPaterno, ApMaterno FROM paciente";
$result_pacientes = $conn->query($sql_pacientes);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Preguntas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Asignar Preguntas a Pacientes</h1>

        <?php if ($result->num_rows > 0 && $result_pacientes->num_rows > 0): ?>
            <form action="../../Controlador/procesar_preguntas.php" method="post">
                <div class="mb-3">
                    <label for="id_paciente" class="form-label">Seleccionar Paciente:</label>
                    <select name="id_paciente" id="id_paciente" class="form-select">
                        <?php while ($row_paciente = $result_pacientes->fetch_assoc()): ?>
                            <option value="<?= htmlspecialchars($row_paciente["idPaciente"]) ?>">
                                <?= htmlspecialchars($row_paciente["Nombre"] . " " . $row_paciente["ApPaterno"] . " " . $row_paciente["ApMaterno"]) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Pregunta</th>
                            <th>Seleccionar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row["pregunta"]) ?></td>
                                <td>
                                    <input type="checkbox" name="preguntas_seleccionadas[]" 
                                            value="<?= htmlspecialchars($row["idPregunta"]) ?>" class="form-check-input">
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        <?php else: ?>
            <div class="alert alert-warning text-center" role="alert">
                No se encontraron preguntas o pacientes para asignar.
            </div>
        <?php endif; ?>

    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>