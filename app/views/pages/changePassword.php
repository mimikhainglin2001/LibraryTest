<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Change Password</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <style>
        .auth-message {
            padding: 0.75rem 1rem;
            border-radius: 12px;
            font-weight: 600;
            margin-bottom: 1rem;
            text-align: center;
        }

        .auth-message.error {
            background: #fee2e2;
            /* light red background */
            color: #dc2626;
            /* red text */
            border: 1px solid #fecaca;
        }

        .auth-message.success {
            background: #d1fae5;
            /* light green background */
            color: #065f46;
            /* green text */
            border: 1px solid #a7f3d0;
        }

        body {
            font-family: 'Inter', Helvetica, sans-serif;
            background: linear-gradient(to right, rgb(219, 234, 254), rgb(147, 197, 253), rgb(59, 130, 246));
            min-height: 100vh;
        }

        .glass-morphism {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .password-strength {
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }

        .icon-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.8;
            }
        }

        .input-focus {
            transition: all 0.3s ease;
        }

        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .submit-btn {
            width: 100%;
            background: #27497c;
            color: white;
            padding: 0.75rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4">
    <div class="glass-morphism p-8 md:p-12 rounded-2xl shadow-2xl max-w-md w-full mx-4 relative z-10">
        <div class="flex justify-center mb-6">
            <div class="w-10 h-10 mx-auto flex items-center justify-center rounded-2xl bg-blue-900 text-white">
                <i class="fas fa-shield-alt"></i>
            </div>
        </div>


        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-blue-900 mb-2">Change Password</h2>
            <p class="text-gray-600 text-sm">Create a new secure password for your account</p>
        </div>

        <form class="space-y-6" method="POST" action="<?php echo URLROOT; ?>/auth/changedPassword" id="passwordForm">
            <?php require APPROOT . '/views/components/auth_message.php'; ?>

            <!-- New Password -->
            <div class="relative">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-lock mr-2 text-gray-400"></i>New Password
                </label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your new password"
                    class="input-focus w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500"
                    required
                    minlength="8" />
                <button
                    type="button"
                    class="absolute right-3 top-11 text-gray-400 hover:text-gray-600"
                    onclick="togglePassword('password')">
                    <i class="fas fa-eye" id="password-eye"></i>
                </button>
                <div class="mt-2">
                    <div class="password-strength bg-gray-200" id="strength-bar"></div>
                    <p class="text-xs text-gray-500 mt-1" id="strength-text">Password strength</p>
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="relative">
                <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-lock mr-2 text-gray-400"></i>Confirm Password
                </label>
                <input
                    type="password"
                    id="confirm_password"
                    name="confirm_password"
                    placeholder="Confirm your new password"
                    class="input-focus w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500"
                    required />
                <button
                    type="button"
                    class="absolute right-3 top-11 text-gray-400 hover:text-gray-600"
                    onclick="togglePassword('confirm_password')">
                    <i class="fas fa-eye" id="confirm_password-eye"></i>
                </button>
                <div class="mt-2">
                    <p class="text-xs" id="match-text"></p>
                </div>
            </div>
            <!-- Submit Button -->
            <button type="submit" class="submit-btn"><i class="fas fa-check mr-2"></i>Update Password</button>

            <div class="text-center mt-6">
                <a href="<?php echo URLROOT; ?>/pages/login" class="text-gray-500 hover:text-purple-600 text-sm transition duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Login
                </a>
            </div>
        </form>
    </div>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const eye = document.getElementById(inputId + '-eye');

            if (input.type === 'password') {
                input.type = 'text';
                eye.classList.remove('fa-eye');
                eye.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                eye.classList.remove('fa-eye-slash');
                eye.classList.add('fa-eye');
            }
        }

        function checkPasswordStrength(password) {
            let strength = 0;
            const requirements = {
                length: password.length >= 8,
                upper: /[A-Z]/.test(password),
                lower: /[a-z]/.test(password),
                number: /[0-9]/.test(password),
                special: /[^A-Za-z0-9]/.test(password)
            };

            Object.values(requirements).forEach(req => req && strength++);

            const strengthBar = document.getElementById('strength-bar');
            const strengthText = document.getElementById('strength-text');

            if (strength === 0) {
                strengthBar.className = 'password-strength bg-gray-200';
                strengthText.textContent = 'Password strength';
            } else if (strength <= 2) {
                strengthBar.className = 'password-strength bg-red-400';
                strengthText.textContent = 'Weak password';
                strengthText.className = 'text-xs text-red-500 mt-1';
            } else if (strength <= 3) {
                strengthBar.className = 'password-strength bg-yellow-400';
                strengthText.textContent = 'Medium password';
                strengthText.className = 'text-xs text-yellow-600 mt-1';
            } else {
                strengthBar.className = 'password-strength bg-green-400';
                strengthText.textContent = 'Strong password';
                strengthText.className = 'text-xs text-green-600 mt-1';
            }

            return strength >= 4;
        }

        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const matchText = document.getElementById('match-text');

            if (confirmPassword === '') {
                matchText.textContent = '';
                return false;
            }

            if (password === confirmPassword) {
                matchText.textContent = 'Passwords match';
                matchText.className = 'text-xs text-green-600';
                return true;
            } else {
                matchText.textContent = 'Passwords do not match';
                matchText.className = 'text-xs text-red-500';
                return false;
            }
        }

        function updateSubmitButton() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const submitBtn = document.getElementById('submitBtn');

            const isStrong = checkPasswordStrength(password);
            const isMatch = checkPasswordMatch();

            if (isStrong && isMatch && password !== '' && confirmPassword !== '') {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('password').addEventListener('input', updateSubmitButton);
            document.getElementById('confirm_password').addEventListener('input', updateSubmitButton);
            updateSubmitButton(); // Initialize on load
        });
    </script>
</body>

</html>