<?php

use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    private $dbMock;
    private $controller;

    protected function setUp(): void
    {
        // Create a mock for the Database class
        $this->dbMock = $this->createMock(Database::class);

        // Create a mock for the Controller class
        $this->controller = $this->getMockBuilder(Controller::class)
                                 ->disableOriginalConstructor()
                                 ->onlyMethods(['views', 'models', 'columnFilter'])
                                 ->getMock();

        // Use reflection to access the private/protected 'db' property of the controller
        $reflection = new ReflectionClass($this->controller);
        $dbProperty = $reflection->getProperty('db');  // Adjust 'db' if your property has another name
        $dbProperty->setAccessible(true);

        // Inject the mock database into the controller
        $dbProperty->setValue($this->controller, $this->dbMock);
    }

    public function testLoginWithEmailSuccess()
    {
        // Simulate a POST request
        $_SERVER['REQUEST_METHOD'] = 'POST';

        // Simulate POST data
        $_POST = [
            'email' => 'test@example.com',
            'password' => 'test@123'
        ];

        // Expected data returned from the database for this email
        $expectedUser = [
            'email' => 'test@example.com',
            'password' => password_hash('test@123', PASSWORD_DEFAULT) // simulate hashed password stored in DB
        ];

        // Expect the columnFilter method to be called once with these arguments and return $expectedUser
        $this->controller->expects($this->once())
                         ->method('columnFilter')
                         ->with('users', 'email', 'test@example.com')
                         ->willReturn($expectedUser);

        // Start output buffering to capture any output from the login method (if any)
        ob_start();

        // Call the login method (adjust if your method name differs)
        $this->controller->login();

        // Get the output and clean buffer
        $output = ob_get_clean();

        // Assertions - for example, check output or session changes
        // Assuming login sets a session variable on success
        $this->assertArrayHasKey('user_email', $_SESSION);
        $this->assertEquals('test@example.com', $_SESSION['user_email']);

        // Optional: assert output contains some success message
        $this->assertStringContainsString('Login successful', $output);
    }
}
