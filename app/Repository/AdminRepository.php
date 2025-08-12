<?php

require_once APPROOT . '/config/DBConnection.php';
require_once APPROOT . '/Interfaces/AdminRepositoryInterface.php';


// repositories/UserRepository.php
class AdminRepository extends DBconnection implements AdminRepositoryInterface
{
   public function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers(): array
    {
        return $this->getDB()->readAll('users');
    }

    public function getUserById(int $id): ?array
    {
        return $this->getDB()->getById('users', $id);
    }

    public function updateUser(int $id, array $data): bool
    {
        return $this->getDB()->update('users', $id, $data);
    }

    public function deleteUser(int $id): bool
    {
        return $this->getDB()->delete('users', $id);
    }
    public function getAllBooks(): array
    {
        return $this->getDB()->readAll('book_details');
    }

    public function getAllBorrowedBooks(): array
    {
        return $this->getDB()->readAll('borrow_full_view');
    }

    public function getAllReservations(): array
    {
        return $this->getDB()->readAll('reservation_view');
    }
    

}

