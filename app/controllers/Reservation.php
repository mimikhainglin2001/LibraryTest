<?php
require_once APPROOT . '/middleware/authmiddleware.php';

require_once APPROOT . '/Services/ReservationService.php';
class Reservation extends Controller
{
    private ReservationServiceInterface $reservationService;

    public function __construct(ReservationServiceInterface $reservationService)
    {
        AuthMiddleware::userOnly();
        $this->reservationService = $reservationService;
    }

    public function reserve(): void
    {
        $user   = $_SESSION['session_loginuser'] ?? null;
        $bookId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        if (!$user || $bookId <= 0) {
            setMessage('error', 'Invalid user or book.');
            redirect('pages/category');
            return;
        }

        try {
            $ok = $this->reservationService->reserveBook((int)$user['id'], $bookId);

            if ($ok) {
                setMessage('success', 'Book reserved successfully.');
            } else {
                setMessage('error', 'You have already reserved this book.');
            }
        } catch (Exception $e) {
            setMessage('error', 'An error occurred: ' . $e->getMessage());
        }

        redirect('user/history');
    }

    public function cancelreservation(): void
    {
        $reservationId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        if ($reservationId <= 0) {
            setMessage('error', 'Reservation not found');
            redirect('user/history');
            return;
        }

        try {
            $deleted = $this->reservationService->cancelReservation($reservationId);

            if ($deleted) {
                setMessage('success', 'Successfully deleted reservation');
            } else {
                setMessage('error', 'Failed to delete reservation');
            }
        } catch (Exception $e) {
            setMessage('error', 'An error occurred: ' . $e->getMessage());
        }

        redirect('user/history');
    }
}
