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
    <title>Register — MySite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        /* Error/Success Messages */
        .auth-message {
            padding: 0.75rem 1rem;
            border-radius: 12px;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 0.95rem;
        }

        .auth-message.error {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .auth-message.success {
            background: #d1fae5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }

        body {
            font-family: 'Inter', Helvetica, sans-serif;
            background: linear-gradient(to right, #dbeafe, #93c5fd, #3b82f6);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            color: #1e293b;
        }

        .main-container {
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.15);
            max-width: 950px;
            width: 100%;
            height: auto;
            min-height: 500px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
            background: white;
        }

        .left-section {
            background: #1e3a8a;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .left-section img {
            height: auto;
            width: 80%;
            max-width: 350px;
            object-fit: contain;
        }

        .right-section {
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
        }

        .form-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: navy;
            margin-bottom: 1rem;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #11998e;
            box-shadow: 0 0 0 3px rgba(17, 153, 142, 0.1);
        }

        .gender-selection {
            display: flex;
            gap: 0.75rem;
            justify-content: center;
        }

        .gender-option {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            background: white;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .gender-option input[type="radio"] {
            margin-right: 0.5rem;
            width: 18px;
            height: 18px;
            accent-color: #11998e;
        }

        .gender-option.selected {
            border-color: #11998e;
            background: rgba(17, 153, 142, 0.05);
        }

        .submit-btn {
            width: 100%;
            background: #27497c;
            color: white;
            padding: 0.9rem;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            margin-top: 1rem;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background: #1e3a8a;
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
            font-size: 0.9rem;
        }

        .login-link a {
            color: #11998e;
            font-weight: 600;
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #3b82f6;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Responsive */
        @media (max-width: 850px) {
            .main-container {
                grid-template-columns: 1fr;
                max-width: 500px;
            }

            .left-section {
                display: none;
            }

            .right-section {
                padding: 1.5rem;
            }
        }
    </style>

</head>

<body>
    <a href="<?php echo URLROOT; ?>/admin/manageTeacher" class="back-button" title="Go Back">
        <i class="fas fa-arrow-left"></i>
    </a>

    <div class="main-container">
        <div class="left-section">
            <img src="/images/download (2).png" class="img">
        </div>
        <div class="right-section">
            <h1 class="form-title">Create an Account</h1>

            <form method="post" action="<?php echo URLROOT; ?>/auth/adminRegister" id="registerForm">
                <?php require APPROOT . '/views/components/auth_message.php'; ?>

                <div class="form-group">
                    <input type="text" name="name" placeholder="Full Name" class="form-input" />
                </div>

                <div class="form-group">
                    <input type="email" name="email" placeholder="Email Address" class="form-input" />
                </div>

                <div class="form-group">
                    <input type="text" name="department" placeholder="Department" class="form-input" />
                </div>

                <div class="form-group">
                    <div class="gender-selection">
                        <label class="gender-option">
                            <input type="radio" name="gender" value="male" />
                            <span>Male</span>
                        </label>
                        <label class="gender-option">
                            <input type="radio" name="gender" value="female" />
                            <span>Female</span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Create Password" class="form-input" />
                </div>
                <div class="form-group">
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" class="form-input" />
                </div>

                <div class="g-recaptcha" data-sitekey="6LcgC6srAAAAALsBkoG1fkh0WkvgKh87AlkDBrDW"></div>

                <button type="submit" class="submit-btn">Create My Account</button>

                <div class="login-link">
                    <p>
                        Already have an account?
                        <a href="<?php echo URLROOT; ?>/pages/login">Login here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gender selection styling
            const genderOptions = document.querySelectorAll('.gender-option');
            genderOptions.forEach(option => {
                const radio = option.querySelector('input[type="radio"]');
                radio.addEventListener('change', function() {
                    genderOptions.forEach(opt => opt.classList.remove('selected'));
                    if (this.checked) {
                        option.classList.add('selected');
                    }
                });
            });

            // Password confirmation validation
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm_password');

            function validatePasswords() {
                if (confirmPassword.value && password.value !== confirmPassword.value) {
                    confirmPassword.setCustomValidity('Passwords do not match');
                    confirmPassword.classList.add('error');
                } else {
                    confirmPassword.setCustomValidity('');
                    confirmPassword.classList.remove('error');
                }
            }

            password.addEventListener('input', validatePasswords);
            confirmPassword.addEventListener('input', validatePasswords);

            // Submit button loading state
            const form = document.getElementById('registerForm');
            form.addEventListener('submit', function() {
                const submitBtn = form.querySelector('.submit-btn');
                submitBtn.textContent = 'Creating Account...';
            });
        });
        // ===== Auto-hide auth messages =====
        document.addEventListener("DOMContentLoaded", () => {
            const authMessage = document.querySelector(".auth-message");
            if (authMessage) {
                setTimeout(() => {
                    authMessage.style.transition = "opacity 0.5s ease";
                    authMessage.style.opacity = "0";
                    setTimeout(() => authMessage.remove(), 500); // remove from DOM after fade
                }, 3000); // ⏳ disappear after 3 seconds
            }
        });
    </script>
</body>

</html>