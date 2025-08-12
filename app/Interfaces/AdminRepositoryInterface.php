<?php
// interfaces/IUserRepository.php
interface AdminRepositoryInterface
{
    public function getAllUsers(): array;
    public function getUserById(int $id): ?array;
    public function updateUser(int $id, array $data): bool;
    public function deleteUser(int $id): bool;
    public function getAllBooks(): array;
    public function getAllBorrowedBooks(): array;
    public function getAllReservations(): array;
}
