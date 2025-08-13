<?php

// controllers/Admin.php
require_once APPROOT . '/middleware/authmiddleware.php';
require_once APPROOT . '/Repository/AdminRepository.php';
require_once APPROOT . '/Services/AdminService.php';

class Admin extends Controller
{
    private AdminServiceInterface $adminService;

    public function __construct(AdminServiceInterface $adminService )
    {
        AuthMiddleware::adminOnly();
        $this->adminService = $adminService;
    }

    public function index()
    {
        redirect('admin/profile');
    }

    public function adminDashboard()
    {
        $books = $this->adminService->getBookList();
        $borrowbook = $this->adminService->getBorrowedBooks();
        $allbook = [
            'book' => $books,
            'borrowbook' => $borrowbook
        ];
        $this->view('admin/adminDashboard' , $allbook);
    }

    public function adminregister()
    {

        $this->view('admin/adminregister');
    }

    public function adminlist()
    {
        $admins = $this->adminService->getAdmins();
        $this->view('admin/adminlist', ['admins' => $admins]);
    }

    public function manageMember()
    {
        $members = $this->adminService->getMembers();
        $this->view('admin/manageMember', ['members' => $members]);
    }

    public function manageBook()
    {
        
        $booklist = $this->adminService->getBookList();
        $data = [
            'booklist' => $booklist
        ];
        $this->view('admin/manageBook', $data);
    }

    public function issueBook()
    {
        $borrowBookList = $this->adminService->getBorrowedBooks();
        $this->view('admin/issueBook', ['borrowBookList' => $borrowBookList]);
    }

    public function addnewBook()
    {
        $this->view('admin/addnewBook');
    }

    public function returnBook()
    {
        $returnBookList = $this->adminService->getBorrowedBooks();
        $this->view('admin/returnBook', ['returnBookList' => $returnBookList]);
    }

    public function reservation()
    {
        $reservedBookList = $this->adminService->getReservedBooks();
        $this->view('admin/reservation', ['reservedBookList' => $reservedBookList]);
    }

    public function profile()
    {
        $id = is_array($_SESSION['session_loginuser']) ? $_SESSION['session_loginuser']['id'] : $_SESSION['session_loginuser'];
        $loginuser = $this->adminService->getUserProfile($id);

        if (!$loginuser) {
            setMessage('error', 'User not found.');
            redirect('login');
            exit;
        }

        $this->view('admin/profile', ['loginuser' => $loginuser]);
    }

    public function editAdminProfile()
    {
        $id = is_array($_SESSION['session_loginuser']) ? $_SESSION['session_loginuser']['id'] : $_SESSION['session_loginuser'];
        $user = $this->adminService->getUserProfile($id);

        if (!$user) {
            setMessage('error', 'User not found');
            redirect('admin/profile');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $updatedData = [
                'name'   => $_POST['name'] ?? $user['name'],
                'email'  => $_POST['email'] ?? $user['email'],
                'gender' => $_POST['gender'] ?? $user['gender'],
            ];

            if (!$this->adminService->updateUserProfile($id, $updatedData)) {
                setMessage('error', 'Failed to update profile');
                $this->view('admin/editAdminProfile', ['loginuser' => $user]);
                return;
            }

            setMessage('success', 'Profile updated successfully');
            redirect('admin/profile');
        } else {
            $this->view('admin/editAdminProfile', ['loginuser' => $user]);
        }
    }

    public function editMemberList($id)
    {
        $user = $this->adminService->getUserProfile($id);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // You can load edit view with user data here if needed
            return;
        }

        $updatedData = [
            'name' => $_POST['name'] ?? $user['name'],
            'year' => $_POST['year'] ?? $user['year'],
            // Avoid updating 'id' as primary key
        ];

        if (!$this->adminService->updateUserProfile($id, $updatedData)) {
            setMessage('error', 'Failed to update member list');
            // Optionally redirect or show error view
            return;
        }

        setMessage('success', 'Member list updated successfully');
        redirect('admin/manageMember');
    }

    public function deleteMemberList($id)
    {
        $user = $this->adminService->getUserProfile($id);

        if (!$user) {
            setMessage('error', 'User not found');
            redirect('admin/manageMember');
            return;
        }

        if ($this->adminService->deleteUser($id)) {
            setMessage('success', 'Member deleted successfully');
        } else {
            setMessage('error', 'Failed to delete member');
        }

        redirect('admin/manageMember');
    }

    public function changeAdminPassword()
    {
        $this->view('admin/changeAdminPassword');
    }

    public function changePassword()
    {
        $user = $_SESSION['session_loginuser'];

        $currentPassword = $_POST['currentPassword'] ?? null;
        $newPassword = $_POST['newPassword'] ?? null;
        $confirmPassword = $_POST['confirmPassword'] ?? null;

        if (!$currentPassword || !$newPassword || !$confirmPassword) {
            setMessage('error', 'All fields are required');
            redirect('admin/changeAdminPassword');
            return;
        }

        if ($newPassword !== $confirmPassword) {
            setMessage('error', 'Passwords must match');
            redirect('admin/changeAdminPassword');
            return;
        }

        if (strlen($newPassword) < 6) {
            setMessage('error', 'Password length must be more than 6');
            redirect('admin/changeAdminPassword');
            return;
        }

        if ($this->adminService->changePassword($user['id'], $newPassword)) {
            setMessage('success', 'Password changed successfully');
        } else {
            setMessage('error', 'Failed to change password');
        }

        redirect('admin/profile');
    }

    public function editadminlist($id)
    {
        $user = $this->adminService->getUserProfile($id);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // Optionally, load view here with $user data
            return;
        }

        $updatedData = [
            'name'       => $_POST['name'] ?? $user['name'],
            'department' => $_POST['department'] ?? $user['department'] ?? null,
            // 'id' usually not updated here
        ];

        if (!$this->adminService->updateUserProfile($id, $updatedData)) {
            setMessage('error', 'Failed to update admin list');
            return;
        }

        setMessage('success', 'Admin list updated successfully');
        redirect('admin/adminlist');
    }

    public function deleteadminlist($id)
    {
        $user = $this->adminService->getUserProfile($id);

        if (!$user) {
            setMessage('error', 'Admin not found');
            redirect('admin/adminlist');
            return;
        }

        if ($this->adminService->deleteUser($id)) {
            setMessage('success', 'Admin deleted successfully');
        } else {
            setMessage('error', 'Failed to delete admin');
        }

        redirect('admin/adminlist');
    }
}


