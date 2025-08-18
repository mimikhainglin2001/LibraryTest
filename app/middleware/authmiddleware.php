<?php
class AuthMiddleware
{
    // Role constants
    const Admin   = 1;
    const User    = 2; // Student
    const Teacher = 3;

    /**
     * Core function to check access for one or more roles
     */
    private static function checkAccess($roles)
    {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Normalize to array (so it supports single or multiple roles)
        if (!is_array($roles)) {
            $roles = [$roles];
        }

        // Check if logged in and role matches any allowed role
        if (
            !isset($_SESSION['session_loginuser']) ||
            !in_array($_SESSION['session_loginuser']['role_id'], $roles)
        ) {
            header("Location: " . URLROOT . "/pages/login");
            exit();
        }
    }

    // ✅ Single role checks
    public static function adminOnly()
    {
        self::checkAccess(self::Admin);
    }

    public static function userOnly()
    {
        self::checkAccess(self::User);
    }

    public static function teacherOnly()
    {
        self::checkAccess(self::Teacher);
    }

    // ✅ Combined check (student or teacher)
    public static function userOrTeacherOnly()
    {
        self::checkAccess([self::User, self::Teacher]);
    }
}
