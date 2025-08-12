<?php
interface ReservationRepositoryInterface
{
    public function getPendingReservationsByUserAndBook(int $userId, int $bookId): array;
    public function createReservation(array $data): bool;
    public function deleteReservation(int $id): bool;
     public function getAll(): array;
}

?>