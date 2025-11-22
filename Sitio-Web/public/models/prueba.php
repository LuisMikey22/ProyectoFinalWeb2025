<?php

/* === Parámetros de conexión === */
$servidor   = ""; // vacío como indicas
$usuario    = "anuiesne_ehqa";
$contrasena = "tgo7VOO=v?Oi";
$baseDatos  = "anuiesne_ehqa";

/* === Crear conexión === */
$conexion = new mysqli($servidor, $usuario, $contrasena, $baseDatos);

/* === Verificar conexión === */
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

/* === Consulta simple === */
$sql = "SELECT nombre, apellidos FROM alumnos";
$resultado = $conexion->query($sql);

/* === Mostrar resultados === */
if ($resultado && $resultado->num_rows > 0) {

    while ($fila = $resultado->fetch_assoc()) {
        echo "Nombre: " . $fila['nombre'] . " | Apellidos: " . $fila['apellidos'] . "<br>";
    }

} else {
    echo "No se encontraron registros.";
}

/* === Cerrar conexión === */
$conexion->close();

?>
