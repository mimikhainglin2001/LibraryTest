<?php

class Auth extends Controller
{
    private $db;

    public function __construct()
    {
        $this->model('UserModel');
        $this->model('BorrowBookModel');
        $this->db = new Database();
    }

    public function index()
    {
        // some default behavior
    }

    // Login
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['email']) || empty($_POST['password'])) {
            return;
        }

        // Initialize attempt tracking if not set
        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = 0;
            $_SESSION['last_attempt_time'] = time();
        }

        // Check if user is locked out
        if ($_SESSION['login_attempts'] >= 3) {
            $timeSinceLastAttempt = time() - $_SESSION['last_attempt_time'];
            if ($timeSinceLastAttempt < 60) {
                setMessage('error', 'Too many failed attempts. Please wait ' . (60 - $timeSinceLastAttempt) . ' seconds.');
                redirect('pages/login');
                return;
            } else {
                // Reset attempts after cooldown
                $_SESSION['login_attempts'] = 0;
            }
        }

        // Verify Google reCAPTCHA
        $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';
        $secretKey = "6LcgC6srAAAAAGhCpaK0vUxbSQrm6UzEtzecY0hx"; // from Google reCAPTCHA dashboard

        if (!$recaptchaResponse) {
            setMessage('error', 'Please complete the reCAPTCHA challenge.');
            redirect('pages/login');
            return;
        }

        $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptchaResponse}");
        $responseData = json_decode($verify);

        if (!$responseData->success) {
            setMessage('error', 'reCAPTCHA verification failed. Please try again.');
            redirect('pages/login');
            return;
        }

        try {
            $email = $_POST['email'];
            $password = base64_encode($_POST['password']);

            $user = $this->db->loginCheck($email, $password);
            if (!$user) {
                // Increase failed attempts
                $_SESSION['login_attempts']++;
                $_SESSION['last_attempt_time'] = time();

                setMessage('error', 'Invalid email and password. Please try again.');
                redirect('pages/login');
                return;
            }

            // Reset attempts on successful login
            $_SESSION['login_attempts'] = 0;

            // Set login session
            $this->db->setLogin($user['id']);
            $_SESSION['session_loginuser'] = $user;

            // Role-based redirect
            switch ($user['role_id']) {
                case 1: // Admin role id
                    redirect('admin/adminDashboard');
                    break;
                case 2: // User role id
                case 3: // Teacher role id
                    redirect('pages/category');
                    break;
                default:
                    setMessage('error', 'Invalid Username & Password');
                    redirect('pages/login');
                    break;
            }
        } catch (Exception $e) {
            setMessage('error', 'Login error: ' . $e->getMessage());
            redirect('pages/login');
        }
    }


    // Form Register email check
    public function formRegister()
    {
        if (
            $_SERVER['REQUEST_METHOD'] !== 'POST' ||
            empty($_POST['email_check']) ||
            $_POST['email_check'] != 1
        ) {
            return;
        }

        try {
            $email = $_POST['email'] ?? '';
            if (!$email) {
                return;
            }
            // Check if user already exists
            if ($this->db->columnFilter('users', 'email', $email)) {
                echo 'Sorry! Email has already been taken. Please try another.';
            }
        } catch (Exception $e) {
            echo 'Error checking email: ' . $e->getMessage();
        }
    }

    // Admin register
    public function adminRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            setMessage('error', 'Please fill all fields required');
            redirect('admin/adminregister');
            return;
        }
        // Verify Google reCAPTCHA
        $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';
        $secretKey = "6LcgC6srAAAAAGhCpaK0vUxbSQrm6UzEtzecY0hx"; // from Google reCAPTCHA dashboard

        if (!$recaptchaResponse) {
            setMessage('error', 'Please complete the reCAPTCHA challenge.');
            redirect('admin/adminregister');
            return;
        }

        $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptchaResponse}");
        $responseData = json_decode($verify);

        if (!$responseData->success) {
            setMessage('error', 'reCAPTCHA verification failed. Please try again.');
            redirect('admin/adminregister');
            return;
        }

        try {
            $email = $_POST['email'] ?? '';
            // Fail fast if email already exists
            if ($this->db->columnFilter('users', 'email', $email)) {
                setMessage('error', 'Email already exists');
                redirect('admin/adminregister');
                return;
            }

            $name = $_POST['name'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $department = $_POST['department'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            // Fail if passwords do not match
            if ($password !== $confirmPassword) {
                setMessage('error', 'Password does not match');
                redirect('admin/adminregister');
                return;
            }

            // Fail if password is too short
            if (strlen($password) < 6) {
                setMessage('error', 'Password must be at least 6 characters.');
                redirect('admin/adminregister');
                return;
            }
            // Encode password (replace with password_hash in production)
            $encodedPassword = base64_encode($password);

            $params = [
                $name,
                $email,
                null,
                $department,
                $gender,
                null,
                $encodedPassword,
                0,
                0,
                0,
                date('Y-m-d H:i:s'),
                1, // role_id for admin
                null,
                null
            ];

            if (!$this->db->storeprocedure('InsertUser', $params)) {
                setMessage('error', 'Failed to register');
                redirect('admin/adminregister');
                return;
            }

            (new Mail())->verifyMail($email, $name);
            setMessage('success', 'Mail is sent');
            redirect('admin/adminlist');
        } catch (Exception $e) {
            setMessage('error', 'Registration error: ' . $e->getMessage());
            redirect('admin/adminregister');
        }
    }

    public function teacherRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            setMessage('error', 'Please fill all fields required');
            redirect('admin/teacherRegister');
            return;
        }
        // Verify Google reCAPTCHA
        $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';
        $secretKey = "6LcgC6srAAAAAGhCpaK0vUxbSQrm6UzEtzecY0hx"; // from Google reCAPTCHA dashboard

        if (!$recaptchaResponse) {
            setMessage('error', 'Please complete the reCAPTCHA challenge.');
            redirect('admin/teacherRegister');
            return;
        }

        $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptchaResponse}");
        $responseData = json_decode($verify);

        if (!$responseData->success) {
            setMessage('error', 'reCAPTCHA verification failed. Please try again.');
            redirect('admin/teacherRegister');
            return;
        }

        try {
            $email = $_POST['email'] ?? '';
            // Fail fast if email already exists
            if ($this->db->columnFilter('users', 'email', $email)) {
                setMessage('error', 'Email already exists');
                redirect('admin/teacherRegister');
                return;
            }

            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $department = $_POST['department'] ?? '';
            $password = $this->generatePassword(8);

            // Encode password (replace with password_hash in production)
            $encodedPassword = base64_encode($password);
            // Encode password (replace with password_hash in production)

            $params = [
                $name,
                $email,
                null,
                $department,
                $gender,
                null,
                $encodedPassword,
                0,
                0,
                0,
                date('Y-m-d H:i:s'),
                3, // role_id for teacher
                null,
                null
            ];

            if (!$this->db->storeprocedure('InsertUser', $params)) {
                setMessage('error', 'Failed to register');
                redirect('admin/teacherRegister');
                return;
            }

            (new Mail())->sendPasswordEmail($email, $name, $password);
            setMessage('success', 'Mail is sent');
            redirect('admin/manageTeacher');
        } catch (Exception $e) {
            setMessage('error', 'Registration error: ' . $e->getMessage());
            redirect('admin/teacherRegister');
        }
    }

    //generate random password
    private function generatePassword($length = 8)
    {
        $upper   = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lower   = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $special = '!@#$%^&*()-_=+[]{}|;:,.<>?';

        // Ensure at least one from each set
        $password  = $upper[rand(0, strlen($upper) - 1)];
        $password .= $lower[rand(0, strlen($lower) - 1)];
        $password .= $numbers[rand(0, strlen($numbers) - 1)];
        $password .= $special[rand(0, strlen($special) - 1)];

        // Fill remaining length
        $all = $upper . $lower . $numbers . $special;
        for ($i = strlen($password); $i < $length; $i++) {
            $password .= $all[rand(0, strlen($all) - 1)];
        }

        return str_shuffle($password);
    }


    // Register user
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            setMessage('error', 'Please fill all fields required');
            redirect('pages/register');
            return;
        }

        // Verify Google reCAPTCHA
        $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';
        $secretKey = "6LcgC6srAAAAAGhCpaK0vUxbSQrm6UzEtzecY0hx"; // from Google reCAPTCHA dashboard

        if (!$recaptchaResponse) {
            setMessage('error', 'Please complete the reCAPTCHA challenge.');
            redirect('pages/register');
            return;
        }

        $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptchaResponse}");
        $responseData = json_decode($verify);

        if (!$responseData->success) {
            setMessage('error', 'reCAPTCHA verification failed. Please try again.');
            redirect('pages/register');
            return;
        }


        try {
            $email = $_POST['email'] ?? '';

            // Fail if email exists
            if ($this->db->columnFilter('users', 'email', $email)) {
                setMessage('error', 'Email already exists.');
                redirect('pages/register');
                return;
            }

            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $roll = $_POST['rollno'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $year = $_POST['year'] ?? '';

            $password = $this->generatePassword(8);

            // Encode password (replace with password_hash in production)
            $encodedPassword = base64_encode($password);

            $params = [
                $name,
                $email,
                $roll,
                null,
                $gender,
                $year,
                $encodedPassword,
                0,
                0,
                0,
                date('Y-m-d H:i:s'),
                2, // role_id for user
                null,
                null
            ];

            if (!$this->db->storeprocedure('InsertUser', $params)) {
                setMessage('error', 'Failed to register');
                redirect('pages/register');
                return;
            }

            (new Mail())->sendPasswordEmail($email, $name, $password);
            setMessage('success', 'Mail is sent');
            redirect('admin/manageMember');
        } catch (Exception $e) {
            setMessage('error', 'Registration error: ' . $e->getMessage());
            redirect('pages/register');
        }
    }

    // Forgot Password
    public function forgotPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        try {
            $email = $_POST['email'] ?? '';

            // Check if user exists
            $userExists = $this->db->columnFilter('users', 'email', $email);

            if (!$userExists) {
                setMessage('error', 'Email Not Found');
                redirect('pages/forgotPassword');
                exit;
            }

            // Generate OTP
            $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $otp_expiry = date('Y-m-d H:i:s');

            // Store OTP in database
            if (!$this->db->storeotp($email, $otp, $otp_expiry)) {
                setMessage('error', 'Failed to store OTP.');
                redirect('pages/forgotPassword');
                exit;
            }

            // Save email in session
            $_SESSION['post_email'] = $email;

            // Redirect immediately to OTP page
            redirect('pages/otp');

            // Send OTP email in background
            $mail = new Mail();
            $mail->sendotp($email, $otp);
        } catch (Exception $e) {
            echo "Error during forgot password: " . $e->getMessage();
        }
    }

    // Verify OTP
    public function verify_otp()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $email = $_SESSION['post_email'] ?? null;
        if (!$email) {
            setMessage('error', 'Session expired. Please try again.');
            redirect('pages/otp');
            return;
        }

        $otp = implode('', $_POST['otp'] ?? []);

        try {
            if ($this->db->checkotp($email, $otp)) {
                redirect('pages/changepassword');
            } else {
                setMessage('error', 'Invalid OTP');
                redirect('pages/otp');
            }
        } catch (Exception $e) {
            setMessage('error', 'OTP verification error: ' . $e->getMessage());
            redirect('pages/otp');
        }
    }

    //resend OTP
    public function resendOtp()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_SESSION['post_email'] ?? null;

            $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $otp_expiry = date('Y-m-d H:i:s');

            if (!$this->db->storeotp($email, $otp, $otp_expiry)) {
                setMessage('error', 'Failed to store OTP.');
                redirect('pages/forgotPassword');
                exit;
            }

            $mail = new Mail();

            if (!$mail->sendotp($email, $otp)) {
                setMessage('error', 'Failed to send OTP email.');
                redirect('pages/forgotPassword');
                exit;
            }

            $_SESSION['post_email'] = $email;
            redirect('pages/otp');
        }
    }

    // Changed Password
    public function changedPassword()
    {
        $email = $_SESSION['post_email'] ?? null;

        if (!$email) {
            setMessage('error', 'Session expired. Please try again.');
            redirect('pages/changePassword');
            return;
        }

        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if (!$password || !$confirmPassword) {
            setMessage('error', 'All fields are required.');
            redirect('pages/changePassword');
            return;
        }

        if ($password !== $confirmPassword) {
            setMessage('error', 'Passwords do not match.');
            redirect('pages/changePassword');
            return;
        }

        if (strlen($password) < 6) {
            setMessage('error', 'Password must be at least 6 characters.');
            redirect('pages/changePassword');
            return;
        }

        $updatedPassword = base64_encode($password);

        try {
            $user = $this->db->columnFilter('users', 'email', $email);
            if (!$user) {
                setMessage('error', 'User not found.');
                redirect('pages/changePassword');
                return;
            }

            $this->db->update('users', $user['id'], ['password' => $updatedPassword]);

            setMessage('success', 'Password changed successfully. Please log in again.');
            redirect('pages/login');
        } catch (Exception $e) {
            setMessage('error', 'Password change error: ' . $e->getMessage());
            redirect('pages/changePassword');
        }
    }

    // Logout
    public function logout()
    {
        $id = $_SESSION['session_loginuser']['id'] ?? null;
        if ($id) {
            $this->db->unsetLogin($id);
        }

        session_destroy();
        $this->view('pages/login');
        exit();
    }
}
