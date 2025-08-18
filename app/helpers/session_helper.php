<?php
function setMessage(string $type, string $message): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION['modal'] = [
        'type' => $type,      // success | error | warning
        'message' => $message
    ];
}

function redirect(string $location): void
{
    header("Location: " . URLROOT . "/" . $location);
    exit();
}
