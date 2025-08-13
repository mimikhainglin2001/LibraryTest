<?php
interface CategoryRepositoryInterface
{
    public function findByName (string $name): ? array;
}
?>