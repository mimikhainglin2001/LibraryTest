<?php
require_once APPROOT . '/Interfaces/BorrowBookServiceInterface.php';

require_once APPROOT . '/Repository/BorrowBookRepository.php';

class BorrowBookService implements BorrowBookServiceInterface
{
    private BorrowBookRepositoryInterface $borrowRepo;

    public function __construct(BorrowBookRepositoryInterface $borrowRepo)
    {
        $this->borrowRepo = $borrowRepo;
    }

    // Borrow Book
    public function borrowBook(int $bookId, array $user): bool
    {
        if (!isset($user['id'])) {
            throw new Exception("User ID not provided.");
        }

        // Fetch book info
        $book = $this->borrowRepo->getBookById($bookId);
        if (!$book) {
            throw new Exception("Book not found.");
        }

        // Fetch active borrowed books for user
        $borrowedBooks = $this->borrowRepo->getBorrowedBooksByUser($user['id']);

        // Check borrow limit (max 2)
        if (count($borrowedBooks) >= 2) {
            throw new Exception("You can only borrow up to 2 books at the same time.");
        }

        // Prevent borrowing the same book twice
        foreach ($borrowedBooks as $borrow) {
            if ($borrow['book_id'] == $bookId) {
                throw new Exception("You already borrowed this book.");
            }
        }

        // Check book availability
        if ((int)$book['available_quantity'] <= 0) {
            throw new Exception("Book is not available.");
        }

        // Prepare new borrow record
        $now = date('Y-m-d H:i:s');
        $dueDate = date('Y-m-d H:i:s', strtotime('+7 days'));

        $borrowData = [
            'book_id' => $bookId,
            'user_id' => $user['id'],
            'borrow_date' => $now,
            'due_date' => $dueDate,
            'return_date' => null,
            'renew_date' => null,
            'status' => 'borrowed',
            'renew_count' => 0,
        ];

        // Create borrow record in DB
        $created = $this->borrowRepo->create($borrowData);

        if ($created) {
            // Decrement available quantity
            $newAvailable = max(0, (int)$book['available_quantity'] - 1);
            $statusDesc = $newAvailable > 0 ? 'Available' : 'Not Available';

            $this->borrowRepo->updateBookAvailability($bookId, $newAvailable, $statusDesc);
        }

        return $created;
    }



    // Return Book
    public function returnBook(int $borrowId): bool
    {
        $borrowRecord = $this->borrowRepo->getById($borrowId);
        if (!$borrowRecord || $borrowRecord['status'] === 'returned') {
            throw new Exception("Invalid borrow record or already returned.");
        }

        $returnDate = date('Y-m-d H:i:s');

        $updated = $this->borrowRepo->update($borrowId, [
            'return_date' => $returnDate,
            'status'      => 'returned',
        ]);

        if ($updated) {
            $this->borrowRepo->incrementReservationQuantity($borrowRecord['book_id']);
            $this->borrowRepo->incrementBookAvailability($borrowRecord['book_id']);
        }

        return $updated;
    }

    // Renew Book
    public function renewBook(int $borrowId): bool
    {
        $borrowRecord = $this->borrowRepo->getById($borrowId);
        if (!$borrowRecord || $borrowRecord['status'] === 'returned') {
            throw new Exception("Cannot renew a returned or invalid borrow.");
        }

        $renewCount = (int)($borrowRecord['renew_count'] ?? 0) + 1;
        if ($renewCount > 3) {
            throw new Exception("Maximum renewals reached.");
        }

        $originalDate = $borrowRecord['renew_date'] ?? $borrowRecord['due_date'];
        $newRenewDate = date('Y-m-d H:i:s', strtotime("$originalDate +7 days"));

        return $this->borrowRepo->update($borrowId, [
            'renew_date'  => $newRenewDate,
            'renew_count' => $renewCount,
            'status'      => 'renewed',
        ]);
    }

    // Check Overdue Books
    public function checkOverdueBooks(): void
    {
        $today = date('Y-m-d');
        $borrowRecords = $this->borrowRepo->getAll();

        foreach ($borrowRecords as $record) {
            if (!in_array($record['status'], ['borrowed', 'renewed'])) {
                continue;
            }

            $dueDate = $record['renew_date'] ?: $record['due_date'];
            if (!$dueDate) {
                continue;
            }

            if (strtotime($dueDate) < strtotime($today)) {
                $this->borrowRepo->update($record['id'], ['status' => 'overdue']);
            }
        }
    }
    // In BorrowBookService.php
    public function getAllBorrowedBooks(): array
    {
        return $this->borrowRepo->getAll(); // Or whatever method fetches all borrow records
    }
}
