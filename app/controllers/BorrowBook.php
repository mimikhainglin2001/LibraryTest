<?php
require_once APPROOT . '/middleware/authmiddleware.php';

require_once APPROOT . '/Interfaces/IBorrowBookRepository.php';
require_once APPROOT . '/Interfaces/IBorrowBookService.php';
require_once APPROOT . '/Interfaces/IReservationRepository.php';
require_once APPROOT . '/Interfaces/IReservationService.php';

require_once APPROOT . '/Repository/BorrowBookRepository.php';
require_once APPROOT . '/Repository/ReservationRepository.php';

require_once APPROOT . '/Services/BorrowBookService.php';
require_once APPROOT . '/Services/ReservationService.php';

class BorrowBook extends Controller
{
    private IBorrowBookService $borrowBookService;
    private IReservationService $reservationService;

    public function __construct()
    {
        AuthMiddleware::userOnly();

        $borrowBookRepository = new BorrowBookRepository();
        $reservationRepository = new ReservationRepository();

        $this->borrowBookService = new BorrowBookService($borrowBookRepository);
        $this->reservationService = new ReservationService($reservationRepository);
    }

    public function borrow()
    {
        $user = $_SESSION['session_loginuser'] ?? null;
        $bookId = $_GET['id'] ?? null;

        if (!$user || !$bookId) {
            return $this->failRedirect('Invalid user or book.', 'pages/category');
        }

        $result = $this->borrowBookService->borrowBook($user['id'], (int)$bookId);

        if ($result['success']) {
            return $this->successRedirect($result['message'], 'pages/history');
        } else {
            return $this->failRedirect($result['message'], 'pages/category');
        }
    }

    public function returnBook()
    {
        $borrowId = $_GET['id'] ?? null;
        if (!$borrowId) {
            return $this->failRedirect('Invalid borrow record.', 'pages/history');
        }

        $success = $this->borrowBookService->returnBook((int)$borrowId);
        if ($success) {
            return $this->successRedirect('Book returned successfully.', 'pages/history');
        }
        return $this->failRedirect('Failed to return book.', 'pages/history');
    }

    public function renew()
    {
        $borrowId = $_GET['id'] ?? null;
        if (!$borrowId) {
            return $this->failRedirect('Invalid request.', 'pages/history');
        }

        $result = $this->borrowBookService->renewBook((int)$borrowId);

        if ($result['success']) {
            return $this->successRedirect($result['message'], 'pages/history');
        } else {
            return $this->failRedirect($result['message'], 'pages/history');
        }
    }

    public function reserve()
    {
        $user = $_SESSION['session_loginuser'] ?? null;
        $bookId = $_GET['id'] ?? null;

        if (!$user || !$bookId) {
            return $this->failRedirect('Invalid user or book.', 'pages/category');
        }

        $result = $this->reservationService->reserveBook($user['id'], (int)$bookId);
        if ($result['success']) {
            return $this->successRedirect($result['message'], 'pages/history');
        }
        return $this->failRedirect($result['message'], 'pages/category');
    }

    public function cancelReservation()
    {
        $reservationId = $_GET['id'] ?? null;
        if (!$reservationId) {
            return $this->failRedirect('Invalid reservation id.', 'pages/history');
        }

        $success = $this->reservationService->cancelReservation((int)$reservationId);
        if ($success) {
            return $this->successRedirect('Reservation canceled successfully.', 'pages/history');
        }
        return $this->failRedirect('Failed to cancel reservation.', 'pages/history');
    }

    public function checkOverdue()
    {
        AuthMiddleware::adminOnly();
        $this->borrowBookService->checkOverdueBooks();
        $this->successRedirect('Checked overdue books.', 'admin/overdueList');
    }

    // Helper Methods
    private function failRedirect(string $message, string $location, string $type = 'error')
    {
        setMessage($type, $message);
        redirect($location);
        return;
    }

    private function successRedirect(string $message, string $location)
    {
        setMessage('success', $message);
        redirect($location);
        return;
    }

    // mi mi 
}
