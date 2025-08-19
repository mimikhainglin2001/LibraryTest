<?php
interface BookRepositoryInterface
{
    public function findByIsbn (string $isbn): ? array;
    public function insert (array $params): bool;
    public function getById (int $id): ? array;
    public function update (int $id, array $data) : bool;
    public function delete (int $id) : bool;
    public function findByTitle (string $title): ? array;

}
?>