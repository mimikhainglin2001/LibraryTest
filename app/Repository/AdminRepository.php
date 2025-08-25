<?php

require_once APPROOT . '/config/DBConnection.php';
require_once APPROOT . '/Interfaces/AdminRepositoryInterface.php';

class AdminRepository extends DBconnection implements AdminRepositoryInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers(): array
    {
        return $this->getDB()->readAll('users');
    }

    public function getUserById(int $id): ?array
    {
        return $this->getDB()->getById('users', $id);
    }

    public function updateUser(int $id, array $data): bool
    {
        return $this->getDB()->update('users', $id, $data);
    }

    public function deleteUser(int $id): bool
    {
        return $this->getDB()->delete('users', $id);
    }

    public function getAllBooks(): array
    {
        return $this->getDB()->readAll('book_details');
    }

    public function getBookById(int $bookId): ?array
    {
        return $this->getDB()->getById('book_details', $bookId);
    }

    public function getAllBorrowedBooks(): array
    {
        return $this->getDB()->readAll('borrow_full_view');
    }

    public function getAllReservations(): array
    {
        return $this->getDB()->readAll('reservation_view');
    }

    public function getBorrowedBookById(int $id): ?array
    {
        return $this->getDB()->getById('borrowBook', $id);
        // make sure `borrowBook` is the actual borrow table (not just the view)
    }

    public function updateBorrowedBook(int $id, array $data): bool
    {
        // Use the same table used by getBorrowedBookById
        return $this->getDB()->update('borrowBook', $id, $data)
            || $this->getDB()->update('borrowBook', $id, $data);
    }

    // Get book by id from book_details table
    // public function getBookById(int $bookId): ?array
    // {
    //     return $this->getDB()->getById('book_details', $bookId)
    //         ?: $this->getDB()->getById('books', $bookId);
    // }

    // Increase available_quantity, and update status_description if you have it
    public function incrementBookAvailability(int $bookId): bool
    {
        $book = $this->getBookById($bookId);
        if (!$book) {
            error_log("incrementBookAvailability: book not found id={$bookId}");
            return false;
        }

        $newAvailable = max(0, (int)($book['available_quantity'] ?? 0) + 1);

        // prepare data for update: try book_details first
        $data = [
            'available_quantity' => $newAvailable
        ];
        // optionally update status_description if your schema has it
        if (array_key_exists('status_description', $book) || array_key_exists('status', $book)) {
            $data['status_description'] = $newAvailable > 0 ? 'Available' : 'Not Available';
        }

        if ($this->getDB()->update('books', $bookId, $data)) {
            return true;
        }

        // fallback to update 'books' table if you use that
        if ($this->getDB()->update('books', $bookId, $data)) {
            return true;
        }

        error_log("incrementBookAvailability: update failed for book id={$bookId}");
        return false;
    }
    public function incrementReservationQuantity(int $bookId): void
    {
        $reservation = $this->getDB()->columnFilter('reservations', 'book_id', $bookId);
        if (!$reservation) {
            return;
        }

        $newQuantity = max(0, (int)$reservation['available_quantity'] + 1);
        $this->getDB()->update('reservations', $reservation['id'], ['available_quantity' => $newQuantity]);
    }
}
