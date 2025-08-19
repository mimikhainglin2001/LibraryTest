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
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to right, #dbeafe, #93c5fd, #3b82f6);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .main-container {
            width: 100%;
            max-width: 900px;
            /* control max size */
            border-radius: 20px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #fff;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        /* Mobile/tablet: stack sections */
        @media (max-width: 768px) {
            .main-container {
                grid-template-columns: 1fr;
            }

            .left-section {
                display: none;
                /* hide illustration on small screens */
            }

            .right-section {
                padding: 1.5rem;
            }
        }

        .left-section {
            background: #1e3a8a;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .left-section img {
            height: 229px;
            width: 68%;
            object-fit: cover;
        }


        .right-section {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-group {
            margin-bottom: 1.25rem;
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            margin-bottom: 1rem;
            font-size: 1rem;
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

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
        }

        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
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
            opacity: 0.9;
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
    </style>
</head>

<body>
    <div class="main-container">
        <div class="left-section">
            <img src="/images/b1.png" alt="Register Illustration">
        </div>
        <div class="right-section">
            <h1 class="text-2xl font-bold mb-4">Create an Account</h1>

            <!-- Show messages from backend if available -->
            <?php require APPROOT . '/views/components/auth_message.php'; ?>

            <form method="post" action="<?php echo URLROOT; ?>/auth/register">
                <input type="text" name="name" placeholder="Full Name" required class="form-input" />
                <input type="email" name="email" placeholder="Email Address" required class="form-input" />
                <input type="text" name="rollno" placeholder="Roll No" required class="form-input" />
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

                <select name="year" required class="form-input">
                    <option value="">Select Academic Year</option>
                    <option value="First Year">First Year</option>
                    <option value="Second Year">Second Year</option>
                    <option value="Third Year">Third Year</option>
                    <option value="Fourth Year">Fourth Year</option>
                    <option value="Final Year">Final Year</option>
                </select>
                <!-- Google reCAPTCHA -->
                <div class="g-recaptcha" data-sitekey="6LcgC6srAAAAALsBkoG1fkh0WkvgKh87AlkDBrDW"></div>

                <button type="submit" class="submit-btn">Create My Account</button>
                <div class="login-link">
                    <p>
                        Already have an account?
                        <a href="<?php echo URLROOT; ?>/pages/login">Login in here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>