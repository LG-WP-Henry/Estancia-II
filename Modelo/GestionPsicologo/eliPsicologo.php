

<?php 


include '../BD/bd.php';


    if(isset($_GET['Cedula'])){
        $ID = $_GET['Cedula'];
        $delete = "DELETE from psicologo where Cedula=$ID;";
        $execute = mysqli_query($conn, $delete);
        sleep(2);
        echo "<script>alert('Psicologo eliminado');window.location.href='../../Vista/crudPsicologo/consultaPsicologo.php';</script>";
    } else {
    }

?>