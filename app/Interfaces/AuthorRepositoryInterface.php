<?php
interface AuthorRepositoryInterface
{
    public function findByName (string $name): ? array;
    public function insert (string $name): bool;
}
?>