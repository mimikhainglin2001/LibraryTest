<?php
interface BookServiceInterface
{
    public function registerBook(array $data, array $file): bool;
    public function editBook(int $id, array $data): bool;

    public function deleteBook(int $id): bool;
    public function validateBook(array $data, ?array $file = null): array;
}
