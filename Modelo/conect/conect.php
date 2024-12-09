<?php 

define("USER", "root");
define("SERVER", "localhost");
define("BD", "Estanciaii");
define("PASS", "");
define("BACKUP_PATH", "../respaldo/");
date_default_timezone_set('America/Mexico_City');

class SGBD {

    // Método para ejecutar consultas SQL
    public static function sql($query) {
        $con = mysqli_connect(SERVER, USER, PASS, BD);

        if (!$con) {
            die("Error al conectar con el servidor: " . mysqli_connect_error());
        }

        mysqli_set_charset($con, 'utf8');

        $result = mysqli_query($con, $query);

        if (!$result) {
            echo "Error en la consulta SQL ejecutada: " . mysqli_error($con);
        }

        mysqli_close($con);

        return $result;
    }

    // Método para limpiar cadenas y evitar inyecciones SQL
    public static function limpiarcadena($valor) {
        $valor = addslashes($valor);
        $valor = str_ireplace("<script>", "", $valor);
        $valor = str_ireplace("</script>", "", $valor);
        $valor = str_ireplace("SELECT * FROM", "", $valor);
        $valor = str_ireplace("DELETE FROM", "", $valor);
        $valor = str_ireplace("UPDATE", "", $valor);
        $valor = str_ireplace("INSERT INTO", "", $valor);
        $valor = str_ireplace("DROP TABLE", "", $valor);
        $valor = str_ireplace("TRUNCATE TABLE", "", $valor);
        $valor = str_ireplace("--", "", $valor);
        $valor = str_ireplace("'", "", $valor);
        $valor = str_ireplace("[", "", $valor);
        $valor = str_ireplace("]", "", $valor);
        $valor = str_ireplace("\\", "", $valor);
        $valor = str_ireplace("=", "", $valor);
        return $valor;
    }

    // Función para crear el trigger: crear_credencial_administrador
    public static function crearTriggerAdministrador() {
        $query = "
        CREATE TRIGGER crear_credencial_administrador
        AFTER INSERT ON administrador
        FOR EACH ROW
        BEGIN
            INSERT INTO credenciales (id_usuario, usuario, contrasena, tipo_usuario)
            VALUES (NEW.idAdministrador, CONCAT(NEW.Nombre, '.', NEW.ApPaterno), 'contrasena123', 'Administrador');
        END;
        ";
        return self::sql($query);
    }

    // Función para crear el trigger: eliminar_credenciales_administrador
    public static function eliminarTriggerAdministrador() {
        $query = "
        CREATE TRIGGER eliminar_credenciales_administrador
        AFTER DELETE ON administrador
        FOR EACH ROW
        BEGIN
            DELETE FROM credenciales WHERE id_usuario = OLD.idAdministrador;
        END;
        ";
        return self::sql($query);
    }

    // Función para crear el trigger: crear_credencial_paciente
    public static function crearTriggerPaciente() {
        $query = "
        CREATE TRIGGER crear_credencial_paciente
        AFTER INSERT ON paciente
        FOR EACH ROW
        BEGIN
            INSERT INTO credenciales (id_usuario, usuario, contrasena, tipo_usuario)
            VALUES (NEW.idPaciente, CONCAT(NEW.Nombre, '.', NEW.ApPaterno), 'contrasena123', 'Paciente');
        END;
        ";
        return self::sql($query);
    }

    // Función para crear el trigger: eliminar_credenciales_paciente
    public static function eliminarTriggerPaciente() {
        $query = "
        CREATE TRIGGER eliminar_credenciales_paciente
        AFTER DELETE ON paciente
        FOR EACH ROW
        BEGIN
            DELETE FROM credenciales WHERE id_usuario = OLD.idPaciente;
        END;
        ";
        return self::sql($query);
    }

    // Función para crear el trigger: crear_credencial_psicologo
    public static function crearTriggerPsicologo() {
        $query = "
        CREATE TRIGGER crear_credencial_psicologo
        AFTER INSERT ON psicologo
        FOR EACH ROW
        BEGIN
            INSERT INTO credenciales (id_usuario, usuario, contrasena, tipo_usuario)
            VALUES (NEW.Cedula, CONCAT(NEW.Nombre, '.', NEW.ApPaterno), 'contrasena123', 'Psicólogo');
        END;
        ";
        return self::sql($query);
    }

    // Función para crear el trigger: eliminar_credenciales_psicologo
    public static function eliminarTriggerPsicologo() {
        $query = "
        CREATE TRIGGER eliminar_credenciales_psicologo
        AFTER DELETE ON psicologo
        FOR EACH ROW
        BEGIN
            DELETE FROM credenciales WHERE id_usuario = OLD.Cedula AND tipo_usuario = 'Psicólogo';
        END;
        ";
        return self::sql($query);
    }
}
?>
