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
            setMessage('error', 'Invalid request.');
            return;
        }

        try {
            $this->bookService->registerBook($_POST, $_FILES['image']);
            setMessage('success', 'Book added successfully.');
            redirect('admin/manageBook');
        } catch (Exception $e) {
            setMessage('error', $e->getMessage());
            redirect('admin/addnewBook');
        }
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
}
