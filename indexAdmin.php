<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Administrador') {
    header("Location: login.php");
    exit();
}

include 'Modelo/BD/bd.php';
include 'Vista/includes/headerAdmin.php';

$sql = "SELECT p.Cedula, p.Nombre, p.ApPaterno, p.ApMaterno, p.sexo, p.telefono, p.direccion, p.fechaNac, 
                c.usuario, c.contrasena
        FROM psicologo AS p
        JOIN credenciales AS c ON p.Cedula = c.id_usuario
        WHERE c.tipo_usuario = 'Psicólogo'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"></link>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center text-primary mb-4">Panel de Administración</h1>
        <h2 class="text-secondary">Lista de Psicólogos</h2>
        
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Sexo</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['Cedula']; ?></td>
                            <td><?php echo $row['Nombre']; ?></td>
                            <td><?php echo $row['ApPaterno']; ?></td>
                            <td><?php echo $row['ApMaterno']; ?></td>
                            <td><?php echo $row['sexo']; ?></td>
                            <td><?php echo $row['telefono']; ?></td>
                            <td><?php echo $row['direccion']; ?></td>
                            <td><?php echo $row['fechaNac']; ?></td>
                            <td><?php echo $row['usuario']; ?></td>
                            <td><?php echo $row['contrasena']; ?></td>
                            <td>
                                <a href="Vista/crudPsicologo/EditarPsicologo.php?cedula=<?php echo $row['Cedula']; ?>" class="btn btn-primary btn-sm">Editar</a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['Cedula']; ?>)" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    function confirmDelete(id) {
        if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
            window.location.href = "Modelo/GestionPsicologo/eliPsicologo.php?Cedula=" + id;
        }
    }
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

<?php
mysqli_close($conn);
?>
