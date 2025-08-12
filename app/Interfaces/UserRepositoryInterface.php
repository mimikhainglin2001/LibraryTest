<?php
interface UserRepositoryInterface {
    public function getUserById($id);
    public function updateUser($id, array $data);
    public function getBooksByCategory(string $categoryName): array;
    public function getReservedBooksByUserId($userId): array;
    public function getBorrowedBooksByUserName(string $userName): array;
}
