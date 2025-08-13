<?php
// interfaces/IAdminService.php
interface AdminServiceInterface
{
    public function getAdmins(): array;
    public function getMembers(): array;
    public function getUserProfile(int $id): ?array;
    public function updateUserProfile(int $id, array $data): bool;
    public function changePassword(int $id, string $newPassword): bool;
    public function deleteUser(int $id): bool;
    public function getBookList(): array;
    public function getBorrowedBooks(): array;
    public function getReservedBooks(): array;

}
