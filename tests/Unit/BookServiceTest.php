<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../app/Interfaces/BookRepositoryInterface.php';
require_once __DIR__ . '/../../app/Interfaces/AuthorRepositoryInterface.php';
require_once __DIR__ . '/../../app/Interfaces/CategoryRepositoryInterface.php';
require_once __DIR__ . '/../../app/Services/BookService.php';
require_once __DIR__ . '/../../app/Services/FileStorageInterface.php';
final class BookServiceTest extends TestCase
{
    private $bookRepo;
    private $authorRepo;
    private $categoryRepo;
    // private $files;
    private BookService $service;

    protected function setUp(): void
    {
        $this->bookRepo     = $this->createMock(BookRepositoryInterface::class);
        $this->authorRepo   = $this->createMock(AuthorRepositoryInterface::class);
        $this->categoryRepo = $this->createMock(CategoryRepositoryInterface::class);

        $this->service = new BookService(
            $this->bookRepo,
            $this->authorRepo,
            $this->categoryRepo
        );
    }

    /** registerBook */

    public function testRegisterBookThrowsWhenQuantityNotPositive(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Total quantity must be positive.');

        $data = [
            'title' => 'T',
            'isbn' => '123',
            'category' => 'Fiction',
            'author' => 'A',
            'total_quantity' => 0,
        ];
        $this->service->registerBook($data, ['name' => 'x.jpg', 'tmp_name' => '/tmp/x']);
    }

    public function testRegisterBookThrowsWhenDuplicateIsbn(): void
    {
        $this->bookRepo->method('findByIsbn')
            ->with('123')
            ->willReturn(['id' => 99]);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Book already exists.');

        $data = [
            'title' => 'T',
            'isbn' => '123',
            'category' => 'Fiction',
            'author' => 'A',
            'total_quantity' => 10,
        ];
        $this->service->registerBook($data, ['name' => 'x.jpg', 'tmp_name' => '/tmp/x']);
    }

    public function testRegisterBookThrowsWhenInvalidCategory(): void
    {
        $this->bookRepo->method('findByIsbn')
            ->willReturn(null);
        $this->categoryRepo->method('findByName')
            ->with('Unknown')
            ->willReturn(null);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid category.');

        $data = [
            'title' => 'T',
            'isbn' => '123',
            'category' => 'Unknown',
            'author' => 'A',
            'total_quantity' => 10,
        ];
        $this->service->registerBook($data, ['name' => 'x.jpg', 'tmp_name' => '/tmp/x']);
    }

    public function testRegisterBookCreatesAuthorIfMissingAndInsertsBook(): void
    {
        $data = [
            'title' => 'Clean Architecture',
            'isbn' => '978-0134494166',
            'category' => 'Tech',
            'author' => 'Robert C. Martin',
            'total_quantity' => 5,
        ];
        $file = ['name' => 'cover.jpg', 'tmp_name' => '/tmp/php123'];

        // No duplicate ISBN
        $this->bookRepo->method('findByIsbn')
            ->with($data['isbn'])
            ->willReturn(null);
        // Category exists
        $this->categoryRepo->method('findByName')
            ->with('Tech')
            ->willReturn(['id' => 10]);
        // Author initially missing, then available after insert
        $this->authorRepo->method('findByName')
            ->with($data['author'])
            ->willReturnOnConsecutiveCalls(null, ['id' => 77]);

        $this->authorRepo->expects($this->once())
            ->method('insert')
            ->with($data['author']);

        // File storage returns final path
        $this->files->expects($this->once())
            ->method('moveUploadedFile')
            ->with($file, 'book_', 'public/images')
            ->willReturn('public/images/book_abc_cover.jpg');

        // Verify insert payload shape & values
        $this->bookRepo->expects($this->once())
            ->method('insert')
            ->with($this->callback(function (array $args) use ($data) {
                // [$title, $image, $isbn, $categoryId, $authorId, $total, $available, $statusId, $statusDesc]
                return $args[0] === $data['title']
                    && str_starts_with($args[1], 'public/images/book_')
                    && $args[2] === $data['isbn']
                    && $args[3] === 10
                    && $args[4] === 77
                    && $args[5] === $data['total_quantity']
                    && $args[6] === $data['total_quantity']
                    && $args[7] === 1
                    && $args[8] === 'Available';
            }))
            ->willReturn(true);

        $ok = $this->service->registerBook($data, $file);
        $this->assertTrue($ok);
    }

    /** editBook */

    public function testEditBookThrowsWhenBookNotFound(): void
    {
        $this->bookRepo->method('getById')
            ->with(42)
            ->willReturn(null);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Book not found.');

        $this->service->editBook(42, [
            'isbn' => 'X',
            'total_quantity' => 10,
            'status_description' => 'Available',
        ]);
    }

    public function testEditBookThrowsWhenInvalidIsbn(): void
    {
        $this->bookRepo->method('getById')
            ->with(1)
            ->willReturn(['id' => 1]);
        $this->bookRepo->method('findByIsbn')
            ->with('NOPE')
            ->willReturn(null);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid ISBN.');

        $this->service->editBook(1, [
            'isbn' => 'NOPE',
            'total_quantity' => 10,
            'status_description' => 'Available',
        ]);
    }

    public function testEditBookUpdatesQuantitiesOnIncrease(): void
    {
        $this->bookRepo->method('getById')
            ->with(1)
            ->willReturn(['id' => 1]);
        $this->bookRepo->method('findByIsbn')
            ->with('123')
            ->willReturn([
                'id' => 1,
                'total_quantity' => 5,
                'available_quantity' => 2,
            ]);

        // total 5 -> 8 => diff +3, available 2 -> 5
        $this->bookRepo->expects($this->once())
            ->method('update')
            ->with(1, [
                'total_quantity'     => 8,
                'available_quantity' => 5,
                'status_description' => 'Available',
            ])
            ->willReturn(true);

        $ok = $this->service->editBook(1, [
            'isbn' => '123',
            'total_quantity' => 8,
            'status_description' => 'Available',
        ]);
        $this->assertTrue($ok);
    }

    public function testEditBookAvailableQuantityNeverNegative(): void
    {
        $this->bookRepo->method('getById')
            ->with(1)
            ->willReturn(['id' => 1]);
        $this->bookRepo->method('findByIsbn')
            ->with('123')
            ->willReturn([
                'id' => 1,
                'total_quantity' => 5,
                'available_quantity' => 1,
            ]);

        // total 5 -> 0 => diff -5, available 1 + (-5) => -4 -> max(0, -4) = 0
        $this->bookRepo->expects($this->once())
            ->method('update')
            ->with(1, [
                'total_quantity'     => 0,
                'available_quantity' => 0,
                'status_description' => 'Unavailable',
            ])
            ->willReturn(true);

        $ok = $this->service->editBook(1, [
            'isbn' => '123',
            'total_quantity' => 0,
            'status_description' => 'Unavailable',
        ]);
        $this->assertTrue($ok);
    }
}
