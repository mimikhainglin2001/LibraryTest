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

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(255, 255, 255, 0.2);
            --shadow-soft: 0 8px 32px rgba(31, 38, 135, 0.15);
            --shadow-hover: 0 15px 35px rgba(31, 38, 135, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to right, rgb(219, 234, 254), rgb(147, 197, 253), rgb(59, 130, 246));
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.2) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        .main-container {
            /* background: var(--glass-bg); */
            /* backdrop-filter: blur(20px); */
            border-radius: 24px;
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow-soft);
            width: 60%;
            /* height: 40%; */
            /* max-width: 1200px; */
            max-height: 650px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
            position: relative;
            /* animation: slideUp 0.8s ease-out; */
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .left-section {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.9) 0%, rgba(30, 58, 138, 0.8) 100%);
            display: flex;

            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            color: white;
            text-align: center;
            position: relative;
        }

        .left-section img {
            border-radius: 20px;
        }

        /* .img{
            box-shadow: 2px 2px 20px #f3f4f8ff;
        } */

        /* .left-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.85) 0%, rgba(30, 58, 138, 0.75) 100%);
            z-index: 1;
        } */

        .left-content {
            position: relative;
            z-index: 2;
        }

        .welcome-icon {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            animation: float 3s ease-in-out infinite;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        .welcome-icon i {
            font-size: 3rem;
            color: white;
        }

        .welcome-title {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            line-height: 1.1;
        }

        .welcome-subtitle {
            font-size: 1.2rem;
            font-weight: 400;
            opacity: 0.95;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .feature-list {
            list-style: none;
            text-align: left;
            max-width: 300px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 1rem;
            opacity: 0.9;
        }

        .feature-item i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
            width: 20px;
        }

        .right-section {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: white;
            position: relative;
            overflow-y: auto;
        }

        .form-header {
            text-align: center;
            margin-top: 10px;
            /* margin-bottom: 2rem; */
        }

        .form-logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background: var(--success-gradient);
            border-radius: 15px;
            margin-bottom: 1rem;
            box-shadow: 0 8px 25px rgba(56, 239, 125, 0.3);
        }

        .form-logo i {
            font-size: 1.5rem;
            color: white;
        }

        .form-title {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            letter-spacing: -0.025em;
        }

        .form-subtitle {
            color: #64748b;
            font-size: 0.95rem;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 1.25rem;
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.95rem;
            color: #1e293b;
            background: #ffffff;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
        }

        .form-input::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .form-input:focus {
            outline: none;
            border-color: #11998e;
            box-shadow: 0 0 0 3px rgba(17, 153, 142, 0.1);
            transform: translateY(-1px);
        }

        .form-input:valid {
            border-color: #10b981;
        }

        .password-field {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #94a3b8;
            font-size: 1rem;
            transition: color 0.2s ease;
            z-index: 10;
        }

        .password-toggle:hover {
            color: #11998e;
        }

        .gender-selection {
            display: flex;
            gap: 0.75rem;
            justify-content: center;
            margin-top: 0.5rem;
        }

        .gender-option {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 0.625rem 1.25rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            transition: all 0.3s ease;
            background: white;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .gender-option:hover {
            border-color: #11998e;
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(17, 153, 142, 0.15);
        }

        .gender-option input[type="radio"] {
            margin-right: 0.5rem;
            width: 18px;
            height: 18px;
            accent-color: #11998e;
        }

        .gender-option.selected {
            border-color: #11998e;
            background: linear-gradient(135deg, rgba(17, 153, 142, 0.1) 0%, rgba(56, 239, 125, 0.1) 100%);
        }

        /* NEW STYLES FOR ROLL NUMBER AND RADIO BUTTONS */
        .rollno-input-group {
            display: flex;
            /* Use flexbox to align items in a row */
            align-items: center;
            /* Vertically align items */
            gap: 0.75rem;
            /* Space between input and radio buttons */
        }

        .rollno-input-group .form-input {
            flex-grow: 1;
            /* Allow the input to grow and take available space */
            max-width: 60%;
            /* Adjust width of the roll number input */
        }

        .rollno-radio-option {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 0.625rem 1rem;
            /* Slightly adjust padding for radio buttons */
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            transition: all 0.3s ease;
            background: white;
            font-weight: 500;
            font-size: 0.9rem;
            white-space: nowrap;
            /* Prevent text from wrapping */
        }

        .rollno-radio-option:hover {
            border-color: #11998e;
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(17, 153, 142, 0.15);
        }

        .rollno-radio-option input[type="radio"] {
            margin-right: 0.5rem;
            width: 18px;
            height: 18px;
            accent-color: #11998e;
        }

        .rollno-radio-option.selected {
            border-color: #11998e;
            background: linear-gradient(135deg, rgba(17, 153, 142, 0.1) 0%, rgba(56, 239, 125, 0.1) 100%);
        }

        /* END NEW STYLES */


        .terms-section {
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.25rem;
            margin: 1.25rem 0;
            transition: all 0.3s ease;
        }

        .terms-section:hover {
            border-color: #11998e;
            box-shadow: 0 3px 10px rgba(17, 153, 142, 0.1);
        }

        .terms-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.875rem;
        }

        .terms-icon {
            width: 35px;
            height: 35px;
            background: var(--success-gradient);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
        }

        .terms-title {
            font-size: 1rem;
            font-weight: 600;
            color: #1e293b;
        }

        .terms-content {
            color: #64748b;
            font-size: 0.85rem;
            line-height: 1.6;
            margin-bottom: 0.875rem;
        }

        .terms-agreement {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .custom-checkbox {
            position: relative;
            width: 20px;
            height: 20px;
            margin-top: 2px;
        }

        .custom-checkbox input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            width: 20px;
            height: 20px;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .custom-checkbox:hover .checkmark {
            border-color: #11998e;
            box-shadow: 0 0 0 3px rgba(17, 153, 142, 0.1);
        }

        .custom-checkbox input:checked~.checkmark {
            background: var(--success-gradient);
            border-color: #11998e;
        }

        .checkmark::after {
            content: "";
            position: absolute;
            display: none;
            left: 6px;
            top: 2px;
            width: 5px;
            height: 8px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .custom-checkbox input:checked~.checkmark::after {
            display: block;
        }

        .terms-text {
            font-size: 0.85rem;
            color: #475569;
            line-height: 1.5;
        }

        .terms-link {
            color: #11998e;
            text-decoration: none;
            font-weight: 600;
            border-bottom: 1px solid transparent;
            transition: border-color 0.2s ease;
        }

        .terms-link:hover {
            border-bottom-color: #11998e;
        }

        .submit-btn {
            width: 100%;
            background: var(--success-gradient);
            color: white;
            font-weight: 600;
            font-size: 1rem;
            padding: 0.875rem 1.5rem;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(17, 153, 142, 0.4);
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(17, 153, 142, 0.5);
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:active {
            transform: translateY(-1px);
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }

        .login-link p {
            color: #64748b;
            font-size: 0.9rem;
        }

        .login-link a {
            color: #11998e;
            text-decoration: none;
            font-weight: 600;
            margin-left: 0.25rem;
            transition: all 0.2s ease;
        }

        .login-link a:hover {
            color: #0f766e;
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .main-container {
                max-width: 900px;
            }

            .left-section {
                padding: 2rem;
            }

            .right-section {
                padding: 2rem;
            }

            .welcome-title {
                font-size: 2.5rem;
            }

            .welcome-subtitle {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .main-container {
                grid-template-columns: 1fr;
                max-width: 500px;
                min-height: auto;
            }

            .left-section {
                padding: 2rem;
                min-height: 300px;
            }

            .welcome-title {
                font-size: 2rem;
            }

            .welcome-subtitle {
                font-size: 1rem;
                margin-bottom: 1rem;
            }

            .feature-list {
                display: none;
            }

            .right-section {
                padding: 2rem 1.5rem;
            }

            .form-title {
                font-size: 1.75rem;
            }

            .gender-selection {
                flex-direction: column;
                gap: 0.75rem;
            }

            .gender-option {
                justify-content: center;
            }

            /* Responsive adjustments for rollno-input-group */
            .rollno-input-group {
                flex-direction: column;
                /* Stack vertically on smaller screens */
                align-items: stretch;
                /* Stretch items to full width */
            }

            .rollno-input-group .form-input {
                max-width: 100%;
                /* Full width on small screens */
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 0.5rem;
            }

            .main-container {
                border-radius: 16px;
            }

            .left-section {
                padding: 1.5rem;
            }

            .right-section {
                padding: 1.5rem 1rem;
            }

            .welcome-title {
                font-size: 1.75rem;
            }

            .form-title {
                font-size: 1.5rem;
            }

            .terms-section {
                padding: 1rem;
            }

            .terms-header {
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
            }

            .terms-agreement {
                flex-direction: column;
                gap: 0.5rem;
            }
        }

        /* Animation for form validation */
        .form-input.error {
            border-color: #ef4444;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        /* Loading state for submit button */
        .submit-btn.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .submit-btn.loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: translateY(-50%) rotate(0deg);
            }

            100% {
                transform: translateY(-50%) rotate(360deg);
            }
        }

        /* New styles for the back button */
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
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
            transition: all 0.3s ease;
            z-index: 10;
        }

        .back-button:hover {
            background-color: rgba(255, 255, 255, 1);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 768px) {
            .back-button {
                top: 10px;
                left: 10px;
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <a href="<?php echo URLROOT;?>/admin/manageTeacher" class="back-button" title="Go Back">
        <i class="fas fa-arrow-left"></i>
    </a>

    <div class="main-container">
        <div class="left-section">
            <h1 class="welcome-title">Create an Account</h1>

            <img src="/images/b1.png" class="img">

        </div>
        <div class="right-section">
            <form method="post" action="<?php echo URLROOT; ?>/auth/teacherRegister" id="registerForm">
                <?php require APPROOT . '/views/components/auth_message.php'; ?>

                <div class="form-group">
                    <input type="text" name="name" placeholder="Full Name" required class="form-input" />
                </div>

                <div class="form-group">
                    <input type="email" name="email" placeholder="Email Address" required class="form-input" />
                </div>

                <div class="form-group">
                    <input type="text" name="department" placeholder="Department" required class="form-input" />
                </div>

                <div class="form-group">
                    <div class="gender-selection">
                        <label class="gender-option">
                            <input type="radio" name="gender" value="male" required />
                            <span>Male</span>
                        </label>
                        <label class="gender-option">
                            <input type="radio" name="gender" value="female" />
                            <span>Female</span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="password-field">
                        <input type="password" id="password" name="password" placeholder="Create Password" required class="form-input">
                        <span class="password-toggle" onclick="togglePassword('password', 'eyeIcon1')">
                            <i id="eyeIcon1" class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="password-field">
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required class="form-input">
                        <span class="password-toggle" onclick="togglePassword('confirm_password', 'eyeIcon2')">
                            <i id="eyeIcon2" class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="submit-btn">
                    Create My Account
                </button>

                <div class="login-link">
                    <p>
                        Already have an account?
                        <a href="<?php echo URLROOT; ?>/pages/login">Login in here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(fieldId, iconId) {
            const input = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            const isPassword = input.type === "password";

            input.type = isPassword ? "text" : "password";
            icon.classList.toggle("fa-eye");
            icon.classList.toggle("fa-eye-slash");
        }

        // Enhanced form interactions
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

            // NEW: Roll Number radio button styling
            const rollnoTypeOptions = document.querySelectorAll('.rollno-radio-option');
            rollnoTypeOptions.forEach(option => {
                const radio = option.querySelector('input[name="rollno_type"]');
                radio.addEventListener('change', function() {
                    rollnoTypeOptions.forEach(opt => opt.classList.remove('selected'));
                    if (this.checked) {
                        option.classList.add('selected');
                    }
                });
            });


            // Form validation
            const form = document.getElementById('registerForm');
            const inputs = form.querySelectorAll('.form-input');

            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (!this.checkValidity()) {
                        this.classList.add('error');
                    } else {
                        this.classList.remove('error');
                    }
                });

                input.addEventListener('input', function() {
                    if (this.classList.contains('error') && this.checkValidity()) {
                        this.classList.remove('error');
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
            form.addEventListener('submit', function(e) {
                const submitBtn = form.querySelector('.submit-btn');
                submitBtn.classList.add('loading');
                submitBtn.textContent = 'Creating Account...';
            });
        });

        // Modal functions (placeholder - implement as needed)
        function openTermsModal() {
            alert('Terms of Service modal would open here');
        }

        function openPrivacyModal() {
            alert('Privacy Policy modal would open here');
        }
    </script>
</body>

</html>