<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — MySite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/form_validate.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>


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
            padding: 1rem;
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
            display: flex;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            width: 60%;
            max-height: 650px;
            animation: slideUp 0.6s ease-out;
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

        .image-section {
            flex: 1;
            position: relative;
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.9) 0%, rgba(30, 58, 138, 0.8) 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 3rem;
            color: white;
        }

        .image-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.85) 0%, rgba(30, 58, 138, 0.75) 100%);
            z-index: 1;
        }

        .image-content {
            position: relative;
            z-index: 2;
        }

        /* Original image-icon and its styles are removed as per user request to replace with checkbox */
        /* .image-icon { ... } */
        /* @keyframes float { ... } */
        /* .image-icon i { ... } */

        .image-title {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            line-height: 1.2;
            text-align: center;
        }

        .image-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            line-height: 1.6;
            max-width: 400px;
            text-align: center;
        }

        .form-section {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-width: 500px;
        }

        .hero-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            background: var(--success-gradient);
            border-radius: 16px;
            margin-bottom: 1.5rem;
            box-shadow: 0 8px 25px rgba(56, 239, 125, 0.3);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .logo-icon i {
            font-size: 1.8rem;
            color: white;
        }

        .main-title {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            letter-spacing: -0.025em;
        }

        .subtitle {
            color: #64748b;
            font-size: 1rem;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1.25rem;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            font-size: 1rem;
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
            box-shadow: 0 0 0 4px rgba(17, 153, 142, 0.1);
            transform: translateY(-2px);
        }

        .form-input:valid {
            border-color: #10b981;
        }

        /* Password field specific styles for the toggle are removed */
        /* .password-field { position: relative; } */
        /* .password-toggle { ... } */
        /* .password-toggle:hover { ... } */

        /* New styles for the checkbox */
        .show-password-checkbox {
            display: flex;
            align-items: center;
            margin-top: 0.5rem;
            /* Space below password input */
            margin-bottom: 1rem;
            /* Space before forgot password/button */
        }

        .show-password-checkbox input[type="checkbox"] {
            margin-right: 0.5rem;
            /* Basic styling for checkbox, you can enhance with custom checkbox styling if needed */
            width: 18px;
            height: 18px;
            accent-color: #11998e;
            /* Changes checkbox color */
        }

        .show-password-checkbox label {
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
        }


        .submit-btn {
            width: 100%;
            background: var(--success-gradient);
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 1rem 2rem;
            border: none;
            border-radius: 16px;
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
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(17, 153, 142, 0.5);
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:active {
            transform: translateY(-1px);
        }

        .forgot-password {
            text-align: right;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
        }

        .forgot-password a {
            color: #11998e;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.2s ease;
            position: relative;
        }

        .forgot-password a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #11998e;
            transition: width 0.3s ease;
        }

        .forgot-password a:hover::after {
            width: 100%;
        }

        .register-link {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e2e8f0;
        }

        .register-link p {
            color: #64748b;
            font-size: 0.95rem;
        }

        .register-link a {
            color: #11998e;
            text-decoration: none;
            font-weight: 600;
            margin-left: 0.25rem;
            transition: all 0.2s ease;
        }

        .register-link a:hover {
            color: #0f766e;
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .main-container {
                max-width: 900px;
            }

            .image-section {
                padding: 2rem;
            }

            .image-title {
                font-size: 2rem;
            }

            .image-subtitle {
                font-size: 1rem;
            }

            .form-section {
                padding: 2.5rem;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 0.5rem;
            }

            .main-container {
                flex-direction: column;
                min-height: auto;
                max-width: 500px;
            }

            .image-section {
                padding: 2rem;
                min-height: 250px;
            }

            /* Original image-icon styles are removed */
            /* .image-icon { ... } */
            /* .image-icon i { ... } */

            .image-title {
                font-size: 1.75rem;
                margin-bottom: 0.5rem;
            }

            .image-subtitle {
                font-size: 0.9rem;
            }

            .form-section {
                padding: 2rem;
            }

            .main-title {
                font-size: 1.75rem;
            }

            .logo-icon {
                width: 60px;
                height: 60px;
                margin-bottom: 1rem;
            }

            .logo-icon i {
                font-size: 1.5rem;
            }

            .form-input {
                padding: 0.875rem 1rem;
                font-size: 0.95rem;
            }

            .submit-btn {
                padding: 0.875rem 1.5rem;
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .form-section {
                padding: 1.5rem;
            }

            .image-section {
                padding: 1.5rem;
            }

            .main-title {
                font-size: 1.5rem;
            }

            .image-title {
                font-size: 1.5rem;
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
            width: 20px;
            height: 20px;
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

        /* Decorative elements */
        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .floating-book {
            position: absolute;
            color: rgba(255, 255, 255, 0.1);
            font-size: 2rem;
            animation: floatBooks 15s linear infinite;
        }

        .floating-book:nth-child(1) {
            left: 10%;
            animation-delay: 0s;
        }

        .floating-book:nth-child(2) {
            left: 50%;
            animation-delay: -5s;
        }

        .floating-book:nth-child(3) {
            left: 80%;
            animation-delay: -10s;
        }

        @keyframes floatBooks {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10%,
            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="image-section">
            <div class="floating-elements">
                <div class="floating-book">📚</div>
                <div class="floating-book">📖</div>
                <div class="floating-book">📕</div>
            </div>

            <div class="image-content">

                <img src="/images/Login.png" alt="Library Image" class="w-full h-auto max-w-[250px] mx-auto rounded-lg " />
            </div>
        </div>

        <div class="form-section">
            <div class="hero-section">

                <h1 class="main-title">Sign In</h1>
                <p class="subtitle">Enter your email and password to continue</p>
            </div>

            <form method="POST" action="<?php echo URLROOT; ?>/auth/login" id="loginForm">
                <?php require APPROOT . '/views/components/auth_message.php'; ?>

                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Email Address" required class="form-input" />
                </div>

                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Password" required class="form-input">
                    <div class="show-password-checkbox">
                        <input type="checkbox" id="showPasswordCheckbox" onchange="togglePasswordVisibility('password', this)">
                        <label for="showPasswordCheckbox">Show Password</label>
                    </div>
                </div>

                <div class="forgot-password">
                    <a href="<?php echo URLROOT; ?>/pages/forgotPassword">Forgot Password?</a>
                </div>
                <!-- Google reCAPTCHA -->
                <div class="g-recaptcha" data-sitekey="6LcgC6srAAAAALsBkoG1fkh0WkvgKh87AlkDBrDW"></div>
                <button type="submit" class="submit-btn">
                    Sign In to Continue
                </button>

            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(fieldId, checkboxElement) {
            const input = document.getElementById(fieldId);
            input.type = checkboxElement.checked ? "text" : "password";
        }

        // Enhanced form interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Form validation
            const form = document.getElementById('loginForm');
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

            // Submit button loading state
            form.addEventListener('submit', function(e) {
                const submitBtn = form.querySelector('.submit-btn');
                submitBtn.classList.add('loading');
                submitBtn.textContent = 'Signing In...';
                // You might want to add a small delay here for better UX before the actual form submission,
                // or ensure your server-side response handles the loading state.
                // For example: setTimeout(() => form.submit(), 500); // And e.preventDefault()
            });

            // Add focus effects
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    // This was targeting parentElement, but form-input is the actual input
                    // For transformation, you might want to wrap input in another div or apply to input itself
                    // For now, let's just use the existing form-input:focus styling.
                    // If you want a parent element scale effect, consider wrapping each input in its own div.
                    // For this change, I'll remove the JS for focus/blur transform and rely on CSS :focus.
                });

                input.addEventListener('blur', function() {
                    // Same as above, removing redundant JS for focus/blur transform.
                });
            });
        });
    </script>
</body>

</html>