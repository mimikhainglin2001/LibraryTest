<?php
require_once APPROOT . '/Interfaces/ReservationRepositoryInterface.php';

require_once APPROOT . '/config/DBConnection.php';
class ReservationRepository extends DBconnection implements ReservationRepositoryInterface
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getPendingReservationsByUserAndBook(int $userId, int $bookId): array
    {
        $allReservations = $this->getDB()->readAll('reservations');
        return array_filter($allReservations, function ($reservation) use ($userId, $bookId) {
            return $reservation['user_id'] == $userId
                && $reservation['book_id'] == $bookId
                && $reservation['status'] === 'pending';
        });
    }

    public function createReservation(array $data): bool
    {
        return $this->getDB()->create('reservations', $data);
    }

    public function deleteReservation(int $id): bool
    {
        return $this->getDB()->delete('reservations', $id);
    }
    public function getAll(): array
    {
        return $this->getDB()->readAll('borrowBook');
    }
}
