<?php
include_once("../conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM Facturas WHERE ID = ?";
    $stmt = sqlsrv_prepare($conn, $query, array(&$id));

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($stmt)) {
        header("Location: ../menu/index.php?message=Factura eliminada con éxito");
        exit();
    } else {
        echo "Error al eliminar la factura.";
    }
} else {
    echo "ID no válido.";
}
?>
