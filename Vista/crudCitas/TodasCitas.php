<?php
    require '../../Modelo/BD/bd.php';
    include '../includes/headerregresar.php';
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: ../../login.php");
        exit();
    }

    $username = $_SESSION['username'];
    $sql = "SELECT id_usuario FROM credenciales WHERE usuario = '$username';";
    $result = mysqli_query($conn, $sql);
    $paciente = mysqli_fetch_assoc($result);
    $cedulaPsicologo = $paciente['id_usuario'];
    ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Citas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <script>
    function confirmDelete(idCita) {
        if (confirm("¿Estás seguro de que deseas eliminar esta cita?")) {
        window.location.href = "../../Modelo/GestionCitas/eliminarCita.php?idCita=" + idCita;
        }
    }
    </script>
    
</head>
<body>
    <div class="container mt-5">
    <h2 class="text-center mb-4">Gestión de Citas</h2>

    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID Cita</th>
                <th>Fecha</th>
                <th>Nombre del Paciente</th>
                <th>Apellidos</th>
                <th>Nombre del Psicólgo</th>
                <th>Apellidos</th>
                <th>Eliminar</th>
                <th>Actualizar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $citasSql = "SELECT citas.idCitas, citas.Fecha as Fecha, paciente.Nombre as NPac, paciente.ApPaterno as ApPac, paciente.ApMaterno as AmPac, psicologo.Nombre as NPsico,  psicologo.ApPaterno as ApPsic, psicologo.ApMaterno as AmPsic
                        FROM citas 
                        inner JOIN paciente ON citas.idPacienteCi = paciente.idPaciente join psicologo on citas.CedulaCita = psicologo.Cedula; ";
            
            $citasResult = mysqli_query($conn, $citasSql);
            while ($cita = mysqli_fetch_assoc($citasResult)) {
            ?>
                <tr>
                    <td><?php echo $cita['idCitas']; ?></td>
                    <td><?php echo date('d/m/Y H:i', strtotime($cita['Fecha'])); ?></td>
                    <td><?php echo $cita['NPac']; ?></td>
                    <td><?php echo $cita['ApPac'] . " " . $cita['AmPac']; ?></td>
                    <td><?php echo $cita['NPsico']; ?></td>
                    <td><?php echo $cita['ApPsic'] . " " . $cita['AmPsic']; ?></td>
                    <td><a href="javascript:void(0);" onclick="confirmDelete(<?php echo $cita['idCitas']; ?>)" class="btn btn-danger btn-sm">Eliminar</a></td>
                    <td><a href="../../Vista/crudCitas/EditarCita.php?idCita=<?php echo $cita['idCitas']; ?>" class="btn btn-primary btn-sm">Actualizar</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    <script>
    function confirmDelete(id) {
        if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
            window.location.href = "../../Modelo/GestionCitas/eliCita.php?idCitas=" + id;
        }
    }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
