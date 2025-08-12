<?php
interface BorrowBookServiceInterface
{
    public function borrowBook(int $bookId, array $user): bool;
    public function returnBook(int $borrowId): bool;
    public function renewBook(int $borrowId): bool;
    public function checkOverdueBooks(): void;
}
