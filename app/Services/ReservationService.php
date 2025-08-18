<?php

require_once APPROOT . '/Interfaces/ReservationServiceInterface.php';
require_once APPROOT . '/Repository/ReservationRepository.php';
class ReservationService implements ReservationServiceInterface
{
    private ReservationRepositoryInterface $reservationRepository;

    public function __construct(ReservationRepositoryInterface $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function reserveBook(int $userId, int $bookId): bool
    {
        $existing = $this->reservationRepository
                         ->getPendingReservationsByUserAndBook($userId, $bookId);

        if (!empty($existing)) {
            return false; // already reserved
        }

        return $this->reservationRepository->createReservation([
            'user_id' => $userId,
            'book_id' => $bookId,
            'status'  => 'pending',
            'available_quantity' => 0,
            'reserved_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function cancelReservation(int $reservationId): bool
    {
        return $this->reservationRepository->deleteReservation($reservationId);
    }
}
