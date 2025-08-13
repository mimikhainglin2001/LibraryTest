<?php
require_once APPROOT . '/Interfaces/AuthorRepositoryInterface.php';
require_once APPROOT . '/config/DBConnection.php';

class AuthorRepository extends DBconnection implements AuthorRepositoryInterface
{


    public function __construct()
    {
        parent::__construct();
    }

    public function findByName(string $name): ?array
    {
        $result = $this->getDB()->columnFilter('authors', 'name', $name);
        return $result === false ? null : $result;
    }


    public function insert(string $name): bool
    {
        return $this->getDB()->storeprocedure('InsertAuthor', [$name]);
    }
}
