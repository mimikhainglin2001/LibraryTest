<?php

// require_once APPROOT . '/Interfaces/ReservationRepositoryInterface.php';
require_once APPROOT . '/Repository/ReservationRepository.php';
class ReservationService
{
    private $reservationRepo;

    public function __construct(ReservationRepositoryInterface $reservationRepo)
    {
        $this->reservationRepo = $reservationRepo;
    }

    public function reserveBook(int $userId, int $bookId): bool
    {
        $existingReservations = $this->reservationRepo->getPendingReservationsByUserAndBook($userId, $bookId);

        if (!empty($existingReservations)) {
            return false; // Already reserved
        }

        date_default_timezone_set('Asia/Yangon');
        $reservationData = [
            'book_id'            => $bookId,
            'available_quantity' => 0,
            'user_id'            => $userId,
            'reserved_at'        => date('Y-m-d H:i:s'),
            'status'             => 'pending',
        ];

        return $this->reservationRepo->createReservation($reservationData);
    }

    public function cancelReservation(int $reservationId): bool
    {
        return $this->reservationRepo->deleteReservation($reservationId);
    }
    // In ReservationService.php
    public function getAllReservations(): array
    {
        return $this->reservationRepo->getAll(); // Or whatever method fetches all reservation records
    }
}
