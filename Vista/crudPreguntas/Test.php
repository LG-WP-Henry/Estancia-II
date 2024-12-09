<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Paciente') {
    header("Location: login.php");
    exit();
}

include '../../Modelo/BD/bd.php';
include '../includes/headerregresar.php';

$username = $_SESSION['username'];
$sql = "SELECT id_usuario FROM credenciales WHERE usuario = '$username';";
$result = mysqli_query($conn, $sql);
$paciente = mysqli_fetch_assoc($result);
$idPaciente = $paciente['id_usuario'];

// Obtener el nombre del paciente
$sqlNombre = "SELECT nombre FROM Paciente WHERE idPaciente = '$idPaciente';";
$result2 = mysqli_query($conn, $sqlNombre);
$paciente2 = mysqli_fetch_assoc($result2);
$nombrePaciente = $paciente2['nombre'];

// Obtener las preguntas del test
$sqlPreguntas = "SELECT pregunta, idPregunta FROM test 
                INNER JOIN preguntas ON test.idPreguntaTst = preguntas.idPregunta 
                WHERE $idPaciente = idPacienteTst AND realizado = 0;";
$preguntaResult = mysqli_query($conn, $sqlPreguntas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuestionario - Paciente</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h2>Contesta el test siendo lo más sincero posible</h2>
        </div>
        <div class="card-body">
            <?php if (mysqli_num_rows($preguntaResult) > 0): ?>
            <form action="../../Controlador/procesar_test.php" method="POST">
                <table class="table table-bordered table-hover">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>Pregunta</th>
                            <th>Siempre (5)</th>
                            <th>Casi siempre (4)</th>
                            <th>A veces (3)</th>
                            <th>Casi nunca (2)</th>
                            <th>Nunca (1)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($preg = mysqli_fetch_assoc($preguntaResult)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($preg['pregunta']); ?></td>
                            <td class="text-center"><input type="radio" name="respuesta_<?php echo $preg['idPregunta']; ?>" value="5" required></td>
                            <td class="text-center"><input type="radio" name="respuesta_<?php echo $preg['idPregunta']; ?>" value="4"></td>
                            <td class="text-center"><input type="radio" name="respuesta_<?php echo $preg['idPregunta']; ?>" value="3"></td>
                            <td class="text-center"><input type="radio" name="respuesta_<?php echo $preg['idPregunta']; ?>" value="2"></td>
                            <td class="text-center"><input type="radio" name="respuesta_<?php echo $preg['idPregunta']; ?>" value="1"></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Enviar respuestas</button>
                </div>
            </form>
            <?php else: ?>
            <div class="alert alert-warning text-center">
                <strong>No tienes cuestionarios asignados en este momento.</strong>
            </div>
            <?php endif; ?>
        </div>
        <div class="card-footer text-end text-muted">
            <small>Responde con honestidad para obtener mejores resultados.</small>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
mysqli_close($conn);
?>
