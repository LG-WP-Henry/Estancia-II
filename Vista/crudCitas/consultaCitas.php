<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mis Citas</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <?php
  require '../../Modelo/BD/bd.php';

  session_start();
  if (!isset($_SESSION['username'])) {
      header("Location: ../../login.php");
      exit();
  }

  $username = $_SESSION['username'];
  $sql = "SELECT id_usuario FROM credenciales WHERE usuario = '$username';";
  $result = mysqli_query($conn, $sql);
  $paciente = mysqli_fetch_assoc($result);
  $idPaciente = $paciente['id_usuario'];

  // Obtener citas futuras
  $queryFuturas = "SELECT fecha, psicologo.Nombre, psicologo.ApPaterno 
                   FROM citas 
                   INNER JOIN psicologo ON citas.CedulaCita = psicologo.Cedula 
                   WHERE idPacienteCi = $idPaciente AND fecha > NOW()
                   ORDER BY fecha ASC";
  $resultFuturas = mysqli_query($conn, $queryFuturas);

  // Obtener citas vencidas
  $queryVencidas = "SELECT fecha, psicologo.Nombre, psicologo.ApPaterno 
                    FROM citas 
                    INNER JOIN psicologo ON citas.CedulaCita = psicologo.Cedula 
                    WHERE idPacienteCi = $idPaciente AND fecha <= NOW()
                    ORDER BY fecha DESC";
  $resultVencidas = mysqli_query($conn, $queryVencidas);
  ?>
</head>
<body>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Mis Citas</h2>

    <!-- Tabla de citas futuras -->
    <div class="mb-5">
      <h4>Citas Futuras</h4>
      <?php if (mysqli_num_rows($resultFuturas) > 0): ?>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Fecha y Hora</th>
              <th>Psicólogo</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($cita = mysqli_fetch_assoc($resultFuturas)): ?>
              <tr>
                <td><?php echo date("d-m-Y H:i", strtotime($cita['fecha'])); ?></td>
                <td><?php echo $cita['Nombre'] . " " . $cita['ApPaterno']; ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p>No tienes citas futuras.</p>
      <?php endif; ?>
    </div>

    <!-- Tabla de citas vencidas -->
    <div>
      <h4>Citas Vencidas</h4>
      <?php if (mysqli_num_rows($resultVencidas) > 0): ?>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Fecha y Hora</th>
              <th>Psicólogo</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($cita = mysqli_fetch_assoc($resultVencidas)): ?>
              <tr>
                <td><?php echo date("d-m-Y H:i", strtotime($cita['fecha'])); ?></td>
                <td><?php echo $cita['Nombre'] . " " . $cita['ApPaterno']; ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p>No tienes citas vencidas.</p>
      <?php endif; ?>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
