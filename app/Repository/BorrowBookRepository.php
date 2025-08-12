<?php

require_once APPROOT . '/Interfaces/BorrowBookRepositoryInterface.php';

require_once APPROOT . '/config/DBConnection.php';

class BorrowBookRepository extends DBconnection implements BorrowBookRepositoryInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getById(int $id): ?array
    {
        return $this->getDB()->getById('borrowBook', $id);
    }

    public function create(array $data): bool
    {
        return $this->getDB()->create('borrowBook', $data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->getDB()->update('borrowBook', $id, $data);
    }

    public function getBorrowedBooksByUser(int $userId): array
    {
        $allRecords = $this->getDB()->readAll('borrowBook');

        if (!is_array($allRecords) || empty($allRecords)) {
            return [];
        }
        $filtered = array_values(array_filter($allRecords, function ($record) use ($userId) {
            return isset($record['user_id'], $record['status'])
                && $record['user_id'] == $userId
                && in_array($record['status'], ['borrowed', 'renewed']);
        }));
        return $filtered;
    }

    public function getBorrowRecordByBookId(int $bookId): ?array
    {
        $records = $this->getDB()->columnFilter('borrowBook', 'book_id', $bookId);

        if (is_array($records) && !empty($records)) {
            //return $records[0]; // safe now
        }

        return null; // no record found
    }

    public function getAll(): array
    {
        return $this->getDB()->readAll('borrowBook');
    }

    // Book-related
    public function getBookById(int $bookId): ?array
    {
        return $this->getDB()->getById('books', $bookId);
    }

    public function incrementBookAvailability(int $bookId): void
    {
        $book = $this->getBookById($bookId);
        if (!$book) {
            return;
        }

        $newAvailable = max(0, (int)$book['available_quantity'] + 1);
        $statusDesc   = $newAvailable > 0 ? 'Available' : 'Not Available';

        $this->getDB()->update('books', $bookId, [
            'available_quantity' => $newAvailable,
            'status_description' => $statusDesc
        ]);
    }

    // Reservation-related
    public function incrementReservationQuantity(int $bookId): void
    {
        $reservation = $this->getDB()->columnFilter('reservations', 'book_id', $bookId);
        if (!$reservation) {
            return;
        }

        $newQuantity = max(0, (int)$reservation['available_quantity'] + 1);
        $this->getDB()->update('reservations', $reservation['id'], ['available_quantity' => $newQuantity]);
    }
    // Add this new method for decrementing available quantity
    public function decrementBookAvailability(int $bookId): void
    {
        $book = $this->getBookById($bookId);
        if (!$book) {
            return;
        }

        $newAvailable = max(0, (int)$book['available_quantity'] - 1);
        $statusDesc   = $newAvailable > 0 ? 'Available' : 'Not Available';

        $this->getDB()->update('books', $bookId, [
            'available_quantity' => $newAvailable,
            'status_description' => $statusDesc
        ]);
    }
    public function updateBookAvailability(int $bookId, int $availableQuantity, string $statusDescription): bool
    {
        return $this->getDB()->update('books', $bookId, [
            'available_quantity' => $availableQuantity,
            'status_description' => $statusDescription,
        ]);
    }
}
