<?php

interface ReservationServiceInterface
{
    public function reserveBook(int $userId, int $bookId): bool;
    public function cancelReservation(int $reservationId): bool;
}
