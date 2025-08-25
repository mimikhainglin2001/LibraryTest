<?php
require_once APPROOT . '/middleware/AuthMiddleware.php';
require_once APPROOT . '/Repository/BookRepository.php';
require_once APPROOT . '/Repository/AuthorRepository.php';
require_once APPROOT . '/Repository/CategoryRepository.php';
require_once APPROOT . '/Services/BookService.php';


class Book extends Controller
{
    private BookServiceInterface $bookService;


    public function __construct(BookServiceInterface $bookService)
    {

        AuthMiddleware::adminOnly();
        $this->bookService = $bookService;
    }


    public function registerBook()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode([
                "success" => false,
                "errors" => ["request" => "Invalid request method."]
            ]);
            return;
        }

        try {
            $errors = $this->bookService->validateBook($_POST, $_FILES['image'] ?? null);

            if (!empty($errors)) {
                echo json_encode(["success" => false, "errors" => $errors]);
                return;
            }

            $this->bookService->registerBook($_POST, $_FILES['image'] ?? []);
            echo json_encode(["success" => true]);
        } catch (Exception $e) {
            echo json_encode([
                "success" => false,
                "errors" => ["exception" => $e->getMessage()]
            ]);
        }
    }


    /**
     * Helper: check if request is AJAX
     */
    private function isAjax(): bool
    {
        return (
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        );
    }


    public function editBook($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return; // Only allow POST requests
        }

        // CSRF validation
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            setMessage('error', 'CSRF Validation Failed');
            redirect('pages/login');
            exit; // Stop execution to prevent DB update
        }

        try {
            $this->bookService->editBook($id, $_POST);
            setMessage('success', 'Book updated successfully.');
        } catch (Exception $e) {
            setMessage('error', $e->getMessage());
        }

        redirect('admin/manageBook');
        exit; // Ensure nothing else runs after redirect
    }

    public function deleteBook($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            setMessage('error', 'Invalid request.');
            redirect('admin/manageBook');
            return;
        }

        // ✅ CSRF validation
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            setMessage('error', 'CSRF Validation Failed');
            redirect('pages/login');
            exit;
        }

        try {
            $this->bookService->deleteBook((int)$id);
            setMessage('success', 'Book deleted successfully.');
        } catch (Exception $e) {
            setMessage('error', $e->getMessage());
        }

        redirect('admin/manageBook');
        exit;
    }
}
