<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register — MySite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(255, 255, 255, 0.2);
            --shadow-soft: 0 8px 32px rgba(31, 38, 135, 0.15);
        }

        body {
            font-family: 'Inter', Helvetica, sans-serif;
            background: linear-gradient(to right, #dbeafe, #93c5fd, #3b82f6);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            color: #1e293b;
        }

        .main-container {
            width: 100%;
            max-width: 960px;
            border-radius: 15px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: var(--glass-bg);
            box-shadow: var(--shadow-soft);
        }

        @media (max-width: 768px) {
            .main-container {
                grid-template-columns: 1fr;
            }

            .left-section {
                display: none;
            }

            .right-section {
                padding: 1.5rem;
            }
        }

        .left-section {
            position: relative;
            /* Ensure absolute positioning works for title */
            background: #1e3a8a;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .left-section img {
            height: auto;
            width: 70%;
            object-fit: cover;
            border-radius: 12px;
        }

        .right-section {
            padding: 2rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-title {
            font-size: 1.775rem;
            /* 3xl */
            font-weight: 800;
            background: navy;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1.2rem;
            /* Increased spacing between inputs */
        }

        .form-input,
        select {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            color: #1e293b;
            background: #fff;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .form-input::placeholder {
            color: #6b7280;
        }

        .form-input:focus,
        select:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.25);
        }

        .gender-selection {
            display: flex;
            gap: 0.75rem;
            justify-content: center;
            margin-top: 1rem;
        }

        .gender-option {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 0.625rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            transition: all 0.3s ease;
            background: #fff;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .gender-option input[type="radio"] {
            margin-right: 0.5rem;
            width: 18px;
            height: 18px;
            accent-color: #10b981;
        }

        .gender-option:hover {
            border-color: #10b981;
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(16, 185, 129, 0.15);
        }

        .gender-option.selected {
            border-color: #10b981;
            background: linear-gradient(135deg, rgba(17, 153, 142, 0.1) 0%, rgba(56, 239, 125, 0.1) 100%);
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
        }

        .submit-btn:hover {
            opacity: 0.95;
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
            color: #10b981;
            font-weight: 600;
            text-decoration: none;
            margin-left: 0.25rem;
            transition: all 0.2s ease;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

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

        .image-title {
            position: absolute;
            top: 40px;
            /* distance from top */
            left: 190px;
            /* distance from left */
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
            z-index: 5;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-align: center;
        }
    </style>
</head>

<body>
    <a href="<?php echo URLROOT; ?>/admin/manageMember" class="back-button" title="Go Back">
        <i class="fas fa-arrow-left"></i>
    </a>
    <div class="main-container">

        <div class="left-section">
            <img src="/images/library.png" alt="Register Illustration">
            <div class="image-title">Library</div>
        </div>
        <div class="right-section">
            <h1 class="form-title">Create an Account</h1>

            <!-- Backend Messages -->
            <?php require APPROOT . '/views/components/auth_message.php'; ?>

            <form method="post" action="<?php echo URLROOT; ?>/auth/register">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Full Name" class="form-input" />
                </div>

                <div class="form-group">
                    <input type="email" name="email" placeholder="Email Address" class="form-input" />
                </div>

                <div class="form-group">
                    <input type="text" name="rollno" placeholder="Roll No" class="form-input" />
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
                    <select name="year" class="form-input">
                        <option value="">Select Academic Year</option>
                        <option value="First Year">First Year</option>
                        <option value="Second Year">Second Year</option>
                        <option value="Third Year">Third Year</option>
                        <option value="Fourth Year">Fourth Year</option>
                        <option value="Final Year">Final Year</option>
                    </select>
                </div>

                <!-- Google reCAPTCHA -->
                <div class="g-recaptcha my-4" data-sitekey="6LcgC6srAAAAALsBkoG1fkh0WkvgKh87AlkDBrDW"></div>

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