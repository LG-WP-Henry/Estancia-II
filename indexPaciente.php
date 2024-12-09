<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Paciente') {
    header("Location: login.php");
    exit();
}

include 'Modelo/BD/bd.php';
include 'Vista/includes/headerPac.php';

$username = $_SESSION['username'];
$sql = "SELECT id_usuario FROM credenciales WHERE usuario = '$username';";
$result = mysqli_query($conn, $sql);
$paciente = mysqli_fetch_assoc($result);
$idPaciente = $paciente['id_usuario'];

$citasSql = "SELECT * FROM citas WHERE CedulaCita = '$idPaciente'";
$citasResult = mysqli_query($conn, $citasSql);

$sqlnombre = "SELECT nombre FROM Paciente WHERE idPaciente = '$idPaciente';"; 
$result2 = mysqli_query($conn, $sqlnombre);
$paciente2 = mysqli_fetch_assoc($result2);
$nombrePaciente = $paciente2['nombre'];
?>
<!DOCTYPE html>
<html lang="es">
<link rel="stylesheet" href="Vista/Estilos/stylesprueba.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paciente</title>
    
</head>
<body>
    <header>
        <h1>Bienvenido, <?php echo htmlspecialchars($nombrePaciente); ?> ¿Cómo estás hoy?</h1>
    </header>
    <main>
        <section>
            <h2>Descubre los consejos de los especialistas para combatir la ansiedad</h2>
            <p>La ansiedad es un trastorno emocional que afecta a un gran número de personas en la actualidad, manifestándose de diversas formas y con diferentes intensidades. Afortunadamente, existen estrategias y consejos que los especialistas en la materia recomiendan para combatirla efectivamente. A continuación, te presentamos algunas recomendaciones fundamentales:</p>
            <ul>
                <li><strong>Ejercicio regular:</strong> La actividad física tiene un impacto positivo en la reducción de la ansiedad, ya que libera endorfinas que ayudan a mejorar el estado de ánimo y a reducir el estrés.</li>
                <li><strong>Técnicas de relajación:</strong> Prácticas como la meditación, la respiración profunda, el yoga o la visualización son eficaces para calmar la mente y el cuerpo, disminuyendo los síntomas de ansiedad.</li>
                <li><strong>Dieta equilibrada:</strong> Mantener una alimentación saludable y balanceada es fundamental para el bienestar mental. Evitar el exceso de cafeína, azúcares refinados y alimentos procesados puede contribuir a reducir la ansiedad.</li>
                <li><strong>Sueño adecuado:</strong> Dormir las horas necesarias y tener un buen descanso es crucial para mantener el equilibrio emocional. La falta de sueño puede aumentar los niveles de ansiedad.</li>
                <li><strong>Terapia psicológica:</strong> Consultar con un profesional de la salud mental puede ser de gran ayuda para aprender a manejar la ansiedad, identificar sus causas y trabajar en estrategias personalizadas de afrontamiento.</li>
            </ul>
        </section>
    </main>
    <footer>
        <p>Todos los derechos reservados por UPEMOR © </p>
    </footer>
</body>
</html>
