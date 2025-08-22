<?php
class Csrf {
    public static function token() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function inputField() {
        return '<input type="hidden" name="csrf_token" value="' 
               . htmlspecialchars(self::token(), ENT_QUOTES, 'UTF-8') . '">';
    }

    public static function validate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['csrf_token']) || empty($_SESSION['csrf_token'])) {
                return false;
            }
            return hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']);
        }
        return true; // GET requests normally don't need CSRF
    }
}
