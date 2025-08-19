<?php
require_once APPROOT . '/Interfaces/BookServiceInterface.php';
require_once APPROOT . '/Repository/BookRepository.php';

class BookService implements BookServiceInterface
{
    private $bookRepo;
    private $authorRepo;
    private $categoryRepo;

    public function __construct(
        BookRepositoryInterface $bookRepo,
        AuthorRepositoryInterface $authorRepo,
        CategoryRepositoryInterface $categoryRepo
    ) {
        $this->bookRepo = $bookRepo;
        $this->authorRepo = $authorRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function registerBook(array $data, array $file): bool
    {
        // Validate quantity
        if ((int)$data['total_quantity'] <= 0) {
            throw new Exception("Total quantity must be positive.");
        }

        // Check duplicate ISBN
        if ($this->bookRepo->findByIsbn($data['isbn'])) {
            throw new Exception("ISBN already exists.");
        }
        //  Check duplicate Title
        if ($this->bookRepo->findByTitle($data['title'])) {
            throw new Exception("Book already exists.");
        }

        // Get category ID
        $category = $this->categoryRepo->findByName($data['category']);
        if (!$category) {
            throw new Exception("Invalid category.");
        }
        $categoryId = $category['id'];

        // Get or create author
        $author = $this->authorRepo->findByName($data['author']);
        if (!$author) {
            $this->authorRepo->insert($data['author']);
            $author = $this->authorRepo->findByName($data['author']);
        }
        $authorId = $author['id'];

        // --- Secure File Upload ---
        $uploadDir = 'public/images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Check for upload errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("File upload error: " . $file['error']);
        }

        // ✅ Check file size (e.g., max 5MB)
        $maxFileSize = 5 * 1024 * 1024; // 5 MB
        if ($file['size'] > $maxFileSize) {
            throw new Exception("File is too large. Max allowed size is 5MB.");
        }

        // Validate file type (allow only images)
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/avif'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mimeType, $allowedMimeTypes)) {
            throw new Exception("Invalid file type. Only JPG, PNG, AVIF, and GIF allowed.");
        }

        // ✅ Sanitize and limit file name
        $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

        // Keep only safe chars in filename
        $sanitizedBase = preg_replace("/[^A-Za-z0-9_\-]/", '', $originalName);

        // Limit length to avoid filesystem issues
        $sanitizedBase = substr($sanitizedBase, 0, 50);

        // Generate unique name
        $imageName = uniqid('book_', true) . '_' . $sanitizedBase . '.' . strtolower($extension);

        $targetPath = $uploadDir . $imageName;

        // Move uploaded file safely
        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            throw new Exception("Image upload failed.");
        }

        // Insert book
        return $this->bookRepo->insert([
            $data['title'],
            $targetPath,
            $data['isbn'],
            $categoryId,
            $authorId,
            $data['total_quantity'],
            $data['total_quantity'],
            1,
            'Available'
        ]);
    }


    public function editBook(int $id, array $data): bool
    {
        $book = $this->bookRepo->getById($id);
        if (!$book) {
            throw new Exception("Book not found.");
        }

        $currentBookByIsbn = $this->bookRepo->findByIsbn($data['isbn']);
        if (!$currentBookByIsbn) {
            throw new Exception("Invalid ISBN.");
        }

        $quantityDifference = $data['total_quantity'] - $currentBookByIsbn['total_quantity'];
        $availableQuantity = max(0, $currentBookByIsbn['available_quantity'] + $quantityDifference);

        return $this->bookRepo->update($id, [
            'total_quantity'     => $data['total_quantity'],
            'available_quantity' => $availableQuantity,
            'status_description' => $data['status_description']
        ]);
    }

    public function deleteBook(int $id): bool
    {
        $book = $this->bookRepo->getById($id);
        if (!$book) {
            throw new Exception("Book not found.");
        }

        // ✅ Optional: remove the cover image if exists
        if (!empty($book['image']) && file_exists($book['image'])) {
            unlink($book['image']);
        }

        return $this->bookRepo->delete($id);
    }
}
