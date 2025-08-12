<?php
interface UserServiceInterface {
    public function getBooksByCategory(string $categoryName): array;
    public function getUserHistory($userId, string $userName): array;
    public function getUserProfile($id);
    public function updateUserProfile($id, array $data): bool;
    public function changeUserPassword($userId, string $currentPassword, string $newPassword, string $confirmPassword): array;
}
