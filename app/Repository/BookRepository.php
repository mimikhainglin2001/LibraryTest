<?php

require_once APPROOT . '/Interfaces/BookRepositoryInterface.php';
require_once APPROOT . '/config/DBConnection.php';

class BookRepository extends DBConnection implements BookRepositoryInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findByIsbn(string $isbn): ?array
    {
        $result = $this->getDB()->columnFilter('books', 'isbn', $isbn);
        return (is_array($result)) ? $result : null;
    }
    public function findByTitle(string $title): ?array
    {
        $result = $this->getDB()->columnFilter('books', 'title', $title);
        return (is_array($result)) ? $result : null;
    }

    public function insert(array $params): bool
    {
        return $this->getDB()->storeprocedure('InsertBook', $params);
    }
    public function getById(int $id): ?array
    {
        return $this->getDB()->getById('books', $id);
    }
    public function update(int $id, array $data): bool
    {
        return $this->getDB()->update('books', $id, $data);
    }
    public function delete(int $id): bool
    {
        return $this->getDB()->delete('books', $id, );
    }
}
