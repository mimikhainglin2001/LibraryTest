<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register — MySite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover-color: #4338ca;
            --secondary-color: #e0e7ff;
            --text-color: #1f2937;
            --placeholder-color: #9ca3af;
            --border-color: #d1d5db;
            --background-color: #f9fafb;
            --card-background: #ffffff;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .auth-container {
            width: 100%;
            max-width: 400px;
            background-color: var(--card-background);
            border-radius: 1rem;
            box-shadow: var(--shadow);
            padding: 2rem;
            border: 1px solid var(--border-color);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-color);
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            font-size: 1rem;
            color: var(--text-color);
            transition: all 0.2s ease-in-out;
        }

        .form-input::placeholder {
            color: var(--placeholder-color);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .gender-selection {
            display: flex;
            justify-content: space-between;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .gender-option {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-color);
            transition: all 0.2s ease-in-out;
            background-color: #f3f4f6;
        }

        .gender-option:hover {
            border-color: var(--primary-color);
        }

        .gender-option input[type="radio"] {
            display: none;
        }

        .gender-option.selected {
            background-color: var(--secondary-color);
            border-color: var(--primary-color);
            color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2);
        }

        .submit-btn {
            width: 100%;
            background-color: var(--primary-color);
            color: white;
            padding: 0.85rem;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .submit-btn:hover {
            background-color: var(--primary-hover-color);
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.875rem;
            color: #4b5563;
        }

        .login-link a {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s ease-in-out;
        }

        .login-link a:hover {
            color: var(--primary-hover-color);
            text-decoration: underline;
        }

        .auth-message {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 0.9rem;
        }

        .auth-message.error {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .auth-message.success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .g-recaptcha {
            transform: scale(0.9);
            transform-origin: 0 0;
            display: flex;
            justify-content: center;
            margin: 1.5rem 0;
        }

        @media (max-width: 480px) {
            .auth-container {
                padding: 1.5rem;
                margin: 0 1rem;
            }

            .auth-header h1 {
                font-size: 1.5rem;
            }

            .form-input, .submit-btn, .gender-option {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <div class="auth-header">
            <h1>Create an Account</h1>
        </div>

        <?php require APPROOT . '/views/components/auth_message.php'; ?>

        <form method="post" action="<?php echo URLROOT; ?>/auth/adminRegister">
            <div class="form-group">
                <input type="text" name="name" placeholder="Full Name" required class="form-input" />
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email Address" required class="form-input" />
            </div>
            <div class="form-group">
                <input type="text" name="department" placeholder="Department" required class="form-input" />
            </div>

            <div class="gender-selection">
                <label class="gender-option" id="male-option">
                    <input type="radio" name="gender" value="male" required />
                    <span>Male</span>
                </label>
                <label class="gender-option" id="female-option">
                    <input type="radio" name="gender" value="female" />
                    <span>Female</span>
                </label>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Create Password" required class="form-input" />
            </div>
            <div class="form-group">
                <input type="password" name="confirm_password" placeholder="Confirm Password" required class="form-input" />
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const genderOptions = document.querySelectorAll('.gender-option');
            genderOptions.forEach(option => {
                option.addEventListener('click', () => {
                    genderOptions.forEach(opt => opt.classList.remove('selected'));
                    option.classList.add('selected');
                });
            });

            const maleInput = document.querySelector('input[value="male"]');
            const femaleInput = document.querySelector('input[value="female"]');
            
            maleInput.addEventListener('change', () => {
                document.getElementById('male-option').classList.add('selected');
                document.getElementById('female-option').classList.remove('selected');
            });
            
            femaleInput.addEventListener('change', () => {
                document.getElementById('female-option').classList.add('selected');
                document.getElementById('male-option').classList.remove('selected');
            });
        });
    </script>
</body>

</html>