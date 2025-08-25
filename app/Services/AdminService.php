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

    // AdminService.php
    // services/AdminService.php (inside AdminService class)
    public function returnBookByAdmin(int $borrowId): bool
    {
        // 1) fetch borrow record
        $borrowedBook = $this->userRepo->getBorrowedBookById($borrowId);

        if (!$borrowedBook) {
            throw new Exception("Borrow record not found for id {$borrowId}.");
        }

        // 2) get the book id from the borrow row (support common field names)
        $bookId = $borrowedBook['book_id'] ?? $borrowedBook['bookId'] ?? $borrowedBook['bookid'] ?? null;
        if (!$bookId) {
            throw new Exception("Borrow record doesn't contain book_id for borrow id {$borrowId}.");
        }

        // 3) ensure it hasn't already been returned
        if (!empty($borrowedBook['return_date'])) {
            throw new Exception("Book already returned.");
        }

        // 4) update borrow record (set return_date and status)
        $updated = $this->userRepo->updateBorrowedBook($borrowId, [
            'return_date' => date('Y-m-d H:i:s'),
            'status'      => 'returned'
        ]);

        if (!$updated) {
            throw new Exception("Failed to update borrow record (id {$borrowId}).");
        }

        // 5) increment the book availability; check result
        $incOk = $this->userRepo->incrementReservationQuantity($borrowedBook['book_id']);
        $incOk = $this->userRepo->incrementBookAvailability((int)$bookId);
        if (!$incOk) {
            // log or throw — prefer to throw so issues are visible
            throw new Exception("Failed to increment available_quantity for book id {$bookId}.");
        }

        return true;
    }
}
