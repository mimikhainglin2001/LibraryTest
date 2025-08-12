<?php
require_once APPROOT . '/middleware/authmiddleware.php';
class Pages extends Controller
{

    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function index()
    {
        $this->view('pages/welcome');
    }
    public function home()
    {
        $this->view('pages/home');
    }
    public function login()
    {
        $this->view('pages/login');
    }
    public function register()
    {
        $this->view('pages/register');
    }
    public function category()
    {
        AuthMiddleware::userOnly();

        $this->view('pages/category');
    }
    public function contact()
    {
        $this->view('pages/contact');
    }
    public function forgotPassword()
    {
        $this->view('pages/forgotPassword');
    }
    public function otp()
    {
        $this->view('pages/otp');
    }
    public function changePassword()
    {
        $this->view('pages/changePassword');
    }

    public function admin()
    {
        $this->view('pages/login');
    }
    public function changeUserPassword()
    {
        $this->view('pages/changeUserPassword');
    }
    public function editProfile()
    {
        AuthMiddleware::userOnly();

        // Get logged-in user ID
        $id = is_array($_SESSION['session_loginuser'])
            ? $_SESSION['session_loginuser']['id']
            : $_SESSION['session_loginuser'];

        // Fetch user from database
        $loginuser = $this->db->getById('users', $id);

        // Negative condition: user not found
        if (!$loginuser) {
            setMessage('error', 'User not found');
            redirect('user/userProfile');
            return;
        }

        // Pass data to view
        $data = [
            'loginuser' => $loginuser
        ];
        $this->view('pages/editProfile', $data);
    }
}
