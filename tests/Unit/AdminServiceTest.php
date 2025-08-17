<?php

use PHPUnit\Framework\TestCase;

// Load required files manually (adjust paths if needed)
require_once __DIR__ . '/../../app/config/DBConnection.php';
require_once __DIR__ . '/../../app/Interfaces/AdminRepositoryInterface.php';
require_once __DIR__ . '/../../app/Repositories/AdminRepository.php';

class AdminRepositoryTest extends TestCase
{
    private $dbMock;
    private $adminRepository;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a mock of DBConnection methods
        $this->dbMock = $this->createMock(DBConnection::class);

        // Create a partial mock of AdminRepository, overriding getDB()
        $this->adminRepository = $this->getMockBuilder(AdminRepository::class)
            ->onlyMethods(['getDB'])
            ->getMock();

        $this->adminRepository
            ->method('getDB')
            ->willReturn($this->dbMock);
    }

    public function testGetAllUsers(): void
    {
        $expected = [['id' => 1, 'name' => 'Alice']];

        $this->dbMock
            ->method('readAll')
            ->with('users')
            ->willReturn($expected);

        $result = $this->adminRepository->getAllUsers();

        $this->assertSame($expected, $result);
    }

    public function testGetUserById(): void
    {
        $expected = ['id' => 1, 'name' => 'Alice'];

        $this->dbMock
            ->method('getById')
            ->with('users', 1)
            ->willReturn($expected);

        $result = $this->adminRepository->getUserById(1);

        $this->assertSame($expected, $result);
    }

    public function testDeleteUser(): void
    {
        $this->dbMock
            ->method('delete')
            ->with('users', 1)
            ->willReturn(true);

        $result = $this->adminRepository->deleteUser(1);

        $this->assertTrue($result);
    }
}
