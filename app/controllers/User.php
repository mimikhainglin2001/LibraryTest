<?php
require_once APPROOT . '/middleware/authmiddleware.php';
require_once APPROOT . '/Services/UserService.php';
// require_once APPROOT . '/Repository/UserRepository.php';

class User extends Controller
{
    private UserServiceInterface $userService;
    private $user;

    public function __construct(UserServiceInterface $userService )
    {
        AuthMiddleware::userOrTeacherOnly(); 
        $this->userService = $userService;
        $this->user = $_SESSION['session_loginuser'] ?? null;
    }


    private function booksByCategory(string $categoryName, string $viewName, string $dataKey)
    {
        $books = $this->userService->getBooksByCategory($categoryName);
        $this->view("pages/{$viewName}", [$dataKey => $books]);
    }

    public function literarybook()
    {
        $this->booksByCategory('Literary Book', 'literarybook', 'literaryBooks');
    }
    public function historicalbook()
    {
        $this->booksByCategory('Historical Book', 'historicalbook', 'historicalBooks');
    }
    public function educationbook()
    {
        $this->booksByCategory('Education/References Book', 'educationbook', 'educationBooks');
    }
    public function romancebook()
    {
        $this->booksByCategory('Romance Book', 'romancebook', 'romanceBooks');
    }
    public function horrorbook()
    {
        $this->booksByCategory('Horror Book', 'horrorbook', 'horrorBooks');
    }
    public function cartoonbook()
    {
        $this->booksByCategory('Cartoon Book', 'cartoonbook', 'cartoonBooks');
    }

    public function history()
    {
        try {
        AuthMiddleware::userOrTeacherOnly(); 
            if (!$this->user) {
                setMessage('error', 'User not found.');
                redirect('pages/login');
                return;
            }
            $userId = $this->user['id'] ?? null;
            $userName = $this->user['name'] ?? null;
            if (!$userId || !$userName) {
                setMessage('error', 'User information incomplete.');
                redirect('pages/login');
                return;
            }
            $history = $this->userService->getUserHistory($userId, $userName);
            $this->view('pages/history', [
                'reservedBooks' => $history['reservedBooks'] ?? [],
                'borrowedBooks' => $history['borrowedBooks'] ?? []
            ]);
        } catch (PDOException $e) {
            setMessage('error', 'Error fetching history: ' . $e->getMessage());
            redirect('pages/error');
        }
    }

    public function userProfile()
    {
        try {
        AuthMiddleware::userOrTeacherOnly(); 
            $id = $this->user['id'] ?? null;
            $loginuser = $this->userService->getUserProfile($id);
            $this->view('pages/userProfile', ['loginuser' => $loginuser]);
        } catch (PDOException $e) {
            setMessage('error', 'Error loading profile: ' . $e->getMessage());
            redirect('pages/error');
        }
    }

    public function editProfile($id)
    {
        try {
        AuthMiddleware::userOrTeacherOnly(); 
            $user = $this->userService->getUserProfile($id);

            if (!$user) {
                setMessage('error', 'User not found.');
                redirect('user/userProfile');
                return;
            }

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                $this->view('pages/editProfile', ['user' => $user]);
                return;
            }

            $name   = trim($_POST['name'] ?? '');
            $email  = trim($_POST['email'] ?? '');
            $gender = trim($_POST['gender'] ?? '');
            $department = trim($_POST['department'] ?? '');

            if ($name === '' || $email === '') {
                setMessage('error', 'Name and Email are required.');
                redirect('pages/editProfile');
                return;
            }

            $updatedUser = [
                'name'   => $name,
                'email'  => $email,
                'gender' => $gender,
                'department' => $department,
            ];

            $updated = $this->userService->updateUserProfile($id, $updatedUser);

            if ($updated) {
                setMessage('success', 'User updated successfully.');
            } else {
                setMessage('error', 'User update failed.');
            }

            redirect('user/userProfile');
        } catch (PDOException $e) {
            setMessage('error', 'Error updating profile: ' . $e->getMessage());
            redirect('user/userProfile');
        }
    }

    public function changeUserPassword()
    {
        try {
        AuthMiddleware::userOrTeacherOnly(); 

            if (!$this->user) {
                setMessage('error', 'User not found.');
                redirect('pages/login');
                return;
            }

            $currentPassword = trim($_POST['currentPassword'] ?? '');
            $newPassword     = trim($_POST['newPassword'] ?? '');
            $confirmPassword = trim($_POST['confirmPassword'] ?? '');

            if ($currentPassword === '' || $newPassword === '' || $confirmPassword === '') {
                setMessage('error', 'All fields are required.');
                redirect('user/userProfile ');
                return;
            }

            $result = $this->userService->changeUserPassword($this->user['id'], $currentPassword, $newPassword, $confirmPassword);

            if ($result['success']) {
                setMessage('success', $result['message']);
            } else {
                setMessage('error', $result['message']);
            }

            redirect('user/userProfile');
        } catch (PDOException $e) {
            setMessage('error', 'Error changing password: ' . $e->getMessage());
            redirect('user/userProfile');
        }
    }
}
