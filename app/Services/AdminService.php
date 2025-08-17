<?php

require_once APPROOT . '/Interfaces/AdminServiceInterface.php';

require_once APPROOT . '/Repository/AdminRepository.php';
// services/AdminService.php
class AdminService implements AdminServiceInterface
{
    private AdminRepositoryInterface $userRepo;

    public function __construct(AdminRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getAdmins(): array
    {
        $allUsers = $this->userRepo->getAllUsers();
        $admins = [];

        foreach ($allUsers as $user) {
            if ((int)$user['role_id'] === 1) {
                $admins[] = $this->userRepo->getUserById($user['id']);
            }
        }
        return $admins;
    }

    public function getMembers(): array
    {
        $allUsers = $this->userRepo->getAllUsers();
        $members = [];

        foreach ($allUsers as $user) {
            if ((int)$user['role_id'] === 2) {
                $members[] = $this->userRepo->getUserById($user['id']);
            }
        }
        return $members;
    }

    public function getTeachers(): array
    {
        $allUsers = $this->userRepo->getAllUsers();
        $members = [];

        foreach ($allUsers as $user) {
            if ((int)$user['role_id'] === 3) {
                $members[] = $this->userRepo->getUserById($user['id']);
            }
        }
        return $members;
    }

    public function getUserProfile(int $id): ?array
    {
        $user = $this->userRepo->getUserById($id);

        // Ensure role_name is set
        if (!isset($user['role_name'])) {
            $user['role_name'] = 'Admin'; // default
        }

        return $user;
    }

    public function updateUserProfile(int $id, array $data): bool
    {
        return $this->userRepo->updateUser($id, $data);
    }


    public function changePassword(int $id, string $newPassword): bool
    {
        $encodedPassword = base64_encode($newPassword);
        return $this->userRepo->updateUser($id, ['password' => $encodedPassword]);
    }

    public function deleteUser(int $id): bool
    {
        return $this->userRepo->deleteUser($id);
    }
    public function getBookList(): array
    {
        return $this->userRepo->getAllBooks();
    }

    public function getBorrowedBooks(): array
    {
        return $this->userRepo->getAllBorrowedBooks();
    }

    public function getReservedBooks(): array
    {
        return $this->userRepo->getAllReservations();
    }
}
