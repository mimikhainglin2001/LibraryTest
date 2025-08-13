<?php
require_once APPROOT . '/Interfaces/UserServiceInterface.php';
require_once APPROOT . '/Repository/UserRepository.php';

class UserService implements UserServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getBooksByCategory(string $categoryName): array
    {
        return $this->userRepository->getBooksByCategory($categoryName);
    }

    public function getUserHistory($userId, string $userName): array
    {
        error_log("UserService::getUserHistory called with userId=$userId, userName=$userName");

        $reservedBooks = $this->userRepository->getReservedBooksByUserId($userId);
        error_log('Reserved Books: ' . json_encode($reservedBooks));

        $borrowedBooks = $this->userRepository->getBorrowedBooksByUserName($userName);
        error_log('Borrowed Books: ' . json_encode($borrowedBooks));

        return [
            'reservedBooks' => $reservedBooks,
            'borrowedBooks' => $borrowedBooks,
        ];
    }


    public function getUserProfile($id)
{
    $user = $this->userRepository->getUserById($id);

    // Ensure role_name is set
    if (!isset($user['role_name'])) {
        $user['role_name'] = 'User'; // default
    }

    return $user;
}


    public function updateUserProfile($id, array $data): bool
    {
        return $this->userRepository->updateUser($id, $data);
    }

    public function changeUserPassword($userId, string $currentPassword, string $newPassword, string $confirmPassword): array
    {
        $user = $this->userRepository->getUserById($userId);

        if (!$user || base64_encode($currentPassword) !== $user['password']) {
            return ['success' => false, 'message' => 'Current password is incorrect.'];
        }
        if ($newPassword !== $confirmPassword) {
            return ['success' => false, 'message' => 'Passwords must match.'];
        }
        if (strlen($newPassword) < 6) {
            return ['success' => false, 'message' => 'Password length must be at least 6 characters.'];
        }

        $updatedPassword = base64_encode($newPassword);
        $updated = $this->userRepository->updateUser($userId, ['password' => $updatedPassword]);

        if ($updated) {
            return ['success' => true, 'message' => 'Password changed successfully.'];
        }

        return ['success' => false, 'message' => 'Failed to change password.'];
    }
}
