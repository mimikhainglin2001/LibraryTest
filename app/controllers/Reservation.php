<?php
require_once APPROOT . '/middleware/authmiddleware.php';

require_once APPROOT . '/Services/ReservationService.php';

class Reservation extends Controller
{
    private $reservationService;

    public function __construct()
    {
        AuthMiddleware::userOnly();
        $reservationRepo = new ReservationRepository;
        $this->reservationService = new ReservationService($reservationRepo);
    }


    public function reserve()
    {
        $user = $_SESSION['session_loginuser'] ?? null;
        $bookId = $_GET['id'] ?? null;

        if (!$user || !$bookId) {
            $this->redirectWithMessage('Invalid user or book.', 'pages/category', 'error');
            return;
        }

        try {
            $reserved = $this->reservationService->reserveBook($user['id'], (int)$bookId);

            if ($reserved) {
                $this->redirectWithMessage('Book reserved successfully.', 'user/history', 'success');
            } else {
                $this->redirectWithMessage('You have already reserved this book.', 'user/history', 'error');
            }
        } catch (Exception $e) {
            $this->redirectWithMessage('An error occurred: ' . $e->getMessage(), 'user/history', 'error');
        }
    }

    public function cancelreservation()
    {
        $reservationId = $_GET['id'] ?? null;

        if (!$reservationId) {
            setMessage('error', 'Reservation not found');
            redirect('user/history');
            return;
        }

        try {
            $deleted = $this->reservationService->cancelReservation((int)$reservationId);

            if ($deleted) {
                setMessage('success', 'Successfully deleted reservation');
            } else {
                setMessage('error', 'Failed to delete reservation');
            }

            redirect('user/history');
        } catch (Exception $e) {
            setMessage('error', 'An error occurred: ' . $e->getMessage());
            redirect('user/history');
        }
    }

    private function redirectWithMessage(string $message, string $location, string $type = 'error')
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION['flash_message'] = ['type' => $type, 'message' => $message];
        header("Location: /$location");
        exit();
    }
}
