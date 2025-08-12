<?php
require_once APPROOT . '/Interfaces/UserRepositoryInterface.php';
require_once APPROOT . '/config/DBConnection.php';


class UserRepository extends DBconnection implements UserRepositoryInterface
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getUserById($id)
    {
        return $this->getDB()->getById('users', $id);
    }

    public function updateUser($id, array $data)
    {
        return $this->getDB()->update('users', $id, $data);
    }

    public function getBooksByCategory(string $categoryName): array
    {
        $allBooks = $this->getDB()->readAll('book_details');
        return array_filter($allBooks, fn($book) => isset($book['category_name']) && $book['category_name'] === $categoryName);
    }

    public function getReservedBooksByUserId($userId): array
    {
        $allReserved = $this->getDB()->readAll('reservation_view');
        error_log('All reservations from DB: ' . json_encode($allReserved));

        $filtered = array_filter($allReserved, fn($item) => isset($item['user_id']) && $item['user_id'] == $userId);

        error_log('Filtered reservedBooks for userId ' . $userId . ': ' . json_encode($filtered));
        return $filtered;
    }

    public function getBorrowedBooksByUserName($userName): array
    {
        $allBorrowed = $this->getDB()->readAll('borrow_full_view');
        error_log('All borrowed books from DB: ' . json_encode($allBorrowed));

        $filtered = array_filter($allBorrowed, fn($item) => isset($item['name']) && $item['name'] === $userName);

        error_log('Filtered borrowedBooks for userName ' . $userName . ': ' . json_encode($filtered));
        return $filtered;
    }
}
