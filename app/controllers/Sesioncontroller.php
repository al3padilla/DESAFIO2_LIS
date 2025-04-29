<?php
class SesionController {
    public static function isLoggedIn() {
        return isset($_SESSION['usuario']);
    }

    public static function getUserName() {
        return $_SESSION['usuario'] ?? 'Invitado';
    }
}