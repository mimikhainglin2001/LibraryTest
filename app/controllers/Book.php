<?php
require_once APPROOT . '/middleware/authmiddleware.php';

class Book extends Controller
{
    private $db;

    public function __construct()
    {
        AuthMiddleware::adminOnly();
        $this->model('BookModel');
        $this->model('AuthorModel');
        $this->db = new Database();
    }

    // Add Book
    public function registerBook()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            setMessage('error', 'Invalid request.');
            return;
        }

        // Validate required fields
        $required = ['title', 'author', 'isbn', 'category', 'total_quantity'];
        foreach ($required as $field) {
            if (empty($_POST[$field])) {
                setMessage('error', 'All fields are required.');
                return;
            }
        }

        $title         = trim($_POST['title']);
        $authorName    = trim($_POST['author']);
        $isbn          = trim($_POST['isbn']);
        $categoryName  = trim($_POST['category']);
        $totalQuantity = (int) $_POST['total_quantity'];

        if ($totalQuantity <= 0) {
            setMessage('error', 'Total quantity must be a positive number.');
            return;
        }

        try {
            // Prevent duplicate books by ISBN
            if ($this->db->columnFilter('books', 'isbn', $isbn)) {
                setMessage('error', 'This book already exists.');
                redirect('admin/addnewBook');
                return;
            }

            // Get category ID
            $category = $this->db->columnFilter('categories', 'name', $categoryName);
            if (!$category || !isset($category['id'])) {
                setMessage('error', 'Invalid category.');
                return;
            }
            $categoryId = $category['id'];

            // Get or create author ID
            $author = $this->db->columnFilter('authors', 'name', $authorName);
            if (!$author) {
                $authorModel = new AuthorModel();
                $params = [$authorName];
                $this->db->storeprocedure('InsertAuthor', $params);
                $author = $this->db->columnFilter('authors', 'name', $authorName);
            }
            if (!$author || !isset($author['id'])) {
                setMessage('error', 'Failed to assign author.');
                return;
            }
            $authorId = $author['id'];

            // Handle image upload
            if (empty($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                setMessage('error', 'Image is required.');
                return;
            }

            $uploadDir = 'public/images/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $imageName = uniqid('book_') . '_' . basename($_FILES['image']['name']);
            $targetPath = $uploadDir . $imageName;

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                setMessage('error', 'Failed to upload image.');
                return;
            }

            // Prepare parameters for stored procedure
            $params = [
                $title,
                $targetPath,
                $isbn,
                $categoryId,
                $authorId,
                $totalQuantity,
                $totalQuantity, // availableQty equals totalQuantity initially
                1,              // statusId (Available)
                'Available'     // statusDesc
            ];

            if ($this->db->storeprocedure('InsertBook', $params)) {
                setMessage('success', 'Book added successfully.');
                redirect('admin/manageBook');
            } else {
                setMessage('error', 'Failed to add book.');
                redirect('admin/addnewBook');
            }
        } catch (PDOException $e) {
            setMessage('error', 'Database error: ' . $e->getMessage());
            redirect('admin/addnewBook');
        } catch (Exception $e) {
            setMessage('error', 'Unexpected error: ' . $e->getMessage());
            redirect('admin/addnewBook');
        }
    }

    // Edit Book
    public function editBook($id)
    {
        try {
            $book = $this->db->getById('books', $id);

            if (!$book) {
                setMessage('error', 'Book not found.');
                redirect('admin/manageBook');
                return;
            }

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                return;
            }

            $title = trim($_POST['title'] ?? '');
            $isbn = trim($_POST['isbn'] ?? '');
            $author = trim($_POST['author_name'] ?? '');
            $totalQuantity = isset($_POST['total_quantity']) ? (int)$_POST['total_quantity'] : null;
            $statusDescription = trim($_POST['status_description'] ?? '');

            if ($totalQuantity === null || $totalQuantity < 0) {
                setMessage('error', 'Invalid total quantity.');
                redirect('admin/manageBook');
                return;
            }

            // Fetch current book info by ISBN to calculate available quantity correctly
            $currentBookByIsbn = $this->db->columnFilter('books', 'isbn', $isbn);

            if (!$currentBookByIsbn) {
                setMessage('error', 'Book with provided ISBN not found.');
                redirect('admin/manageBook');
                return;
            }

            // Calculate difference between new total quantity and old total quantity
            $quantityDifference = $totalQuantity - $currentBookByIsbn['total_quantity'];
            $availableQuantity = $currentBookByIsbn['available_quantity'] + $quantityDifference;

            // Make sure available quantity is not negative
            $availableQuantity = max(0, $availableQuantity);

            $updateData = [
                'total_quantity'       => $totalQuantity,
                'available_quantity'   => $availableQuantity,
                'status_description'   => $statusDescription
            ];

            $updated = $this->db->update('books', $id, $updateData);

            if (!$updated) {
                setMessage('error', 'Failed to update book.');
            } else {
                setMessage('success', 'Book updated successfully.');
            }

            redirect('admin/manageBook');
        } catch (PDOException $e) {
            setMessage('error', 'Database error: ' . $e->getMessage());
            redirect('admin/manageBook');
        } catch (Exception $e) {
            setMessage('error', 'Unexpected error: ' . $e->getMessage());
            redirect('admin/manageBook');
        }
    }
}
