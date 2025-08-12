<?php
interface BorrowBookRepositoryInterface
{
    public function getById(int $id): ?array;
    public function create(array $data): bool;
    public function update(int $id, array $data): bool;
    public function getBorrowedBooksByUser(int $userId): array;
    public function getBorrowRecordByBookId(int $bookId): ?array;
    public function getAll(): array;

    // New methods for moving DB logic out of service
    public function getBookById(int $bookId): ?array;
    public function incrementBookAvailability(int $bookId): void;
    public function incrementReservationQuantity(int $bookId): void;
    public function decrementBookAvailability(int $bookId): void;
    public function updateBookAvailability(int $bookId, int $availableQuantity, string $statusDescription): bool;
}
