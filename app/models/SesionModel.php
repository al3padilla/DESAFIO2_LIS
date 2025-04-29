<?php
class SesionModel {
    public static function isClienteLoggedIn() {
        return isset($_SESSION['cliente']);
    }

    public static function isAdminLoggedIn() {
        return isset($_SESSION['admin']);
    }

    public static function cerrarSesion() {
        session_unset();
        session_destroy();
    }
}
?>
