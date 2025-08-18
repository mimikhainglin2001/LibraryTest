<?php
require_once APPROOT . '/middleware/authmiddleware.php';

// require_once APPROOT . '/Interfaces/BorrowBookRepositoryInterface.php';
// require_once APPROOT . '/Interfaces/BorrowBookServiceInterface.php';

// require_once APPROOT . '/Repository/BorrowBookRepository.php';
require_once APPROOT . '/Services/BorrowBookService.php';

class BorrowBook extends Controller
{
    private BorrowBookServiceInterface $borrowService;

    public function __construct(BorrowBookServiceInterface $borrowService)
    {
        AuthMiddleware::userOrTeacherOnly(); 
        $this->borrowService = $borrowService;
    }

    // Borrow Book
    public function borrow()
    {
        try {
            $user = $_SESSION['session_loginuser'] ?? null;
            $bookId = isset($_GET['id']) ? (int)$_GET['id'] : null;

            if (!$user || !$bookId) {
                return $this->failRedirect('Invalid user or book.', 'pages/category');
            }

            $this->borrowService->borrowBook($bookId, $user);
            return $this->successRedirect('Book borrowed successfully.', 'user/history');
        } catch (Exception $e) {
            return $this->failRedirect($e->getMessage(), 'pages/category');
        }
    }

    // Return Book
    public function returnBook()
    {
        try {


            $borrowId = isset($_GET['id']) ? (int)$_GET['id'] : null;
            if (!$borrowId) {
                return $this->failRedirect('Invalid request', 'user/history');
            }

            $this->borrowService->returnBook($borrowId);
            return $this->successRedirect('Book returned successfully', 'user/history');
        } catch (Exception $e) {
            return $this->failRedirect($e->getMessage(), 'user/history');
        }
    }

    // Renew Book
    public function renew()
    {
        try {


            $borrowId = isset($_GET['id']) ? (int)$_GET['id'] : null;
            if (!$borrowId) {
                return $this->failRedirect('Invalid request', 'user/history');
            }

            $this->borrowService->renewBook($borrowId);
            return $this->successRedirect('Book renewed successfully', 'user/history');
        } catch (Exception $e) {
            return $this->failRedirect($e->getMessage(), 'user/history');
        }
    }

    // Check Overdue Book
    public function checkOverdue()
    {
        try {


            $this->borrowService->checkOverdueBooks();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    private function failRedirect(string $message, string $location, string $type = 'error')
    {
        setMessage($type, $message);
        redirect($location);
    }

    private function successRedirect(string $message, string $location)
    {
        setMessage('success', $message);
        redirect($location);
    }
}
