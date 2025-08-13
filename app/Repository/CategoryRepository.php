<?php
require_once APPROOT . '/Interfaces/CategoryRepositoryInterface.php';
require_once APPROOT . '/config/DBConnection.php';

class CategoryRepository extends DBconnection implements CategoryRepositoryInterface
{

    public function __construct()
    {
        parent::__construct();
    }

    public function findByName(string $name): ?array
    {
        return $this->getDB()->columnFilter('categories', 'name', $name);
    }
}
