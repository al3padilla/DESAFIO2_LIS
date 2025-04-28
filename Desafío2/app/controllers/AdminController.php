<?php
class AdminController {
    public function login() {
        require_once '../app/views/admin/login.php';
    }

    public function autenticar() {
        // Aquí validas al admin (revisar en la BD)
    }
}
