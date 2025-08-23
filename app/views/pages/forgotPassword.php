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
    <title>Forgot Password — MySite</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* General styles */
        body {
            font-family: 'Inter', Helvetica, sans-serif;
            background: linear-gradient(to right, #bfdbfe, #93c5fd, #3b82f6);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        /* Background accents */
        .background-accent-1,
        .background-accent-2 {
            position: absolute;
            border-radius: 50%;
            filter: blur(3rem);
            z-index: -10;
        }

        .background-accent-1 {
            width: 18rem;
            height: 18rem;
            background-color: rgba(192, 132, 252, 0.3);
            top: 2rem;
            left: 2rem;
        }

        .background-accent-2 {
            width: 24rem;
            height: 24rem;
            background-color: rgba(251, 207, 232, 0.3);
            bottom: 2rem;
            right: 2rem;
        }

        /* Card */
        .forgot-card {
            width: 100%;
            max-width: 22rem;
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 1rem;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
            padding: 2.5rem 2rem;
            animation: fadeInUp 0.6s ease-out;
        }

        /* Header */
        .forgot-card .header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .forgot-card .header .icon-wrapper {
            width: 3rem;
            height: 3rem;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 1rem;
            background: #27497c;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            animation: float 3s ease-in-out infinite;
        }

        .forgot-card .header .icon-wrapper i {
            color: white;
            font-size: 1.5rem;
        }

        .forgot-card .header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            background: navy;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-top: 1rem;
        }

        .forgot-card .header p {
            color: #475569;
            margin-top: 0.5rem;
            font-size: 1rem;
        }

        /* Flash messages */
        .auth-message {
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            font-weight: 600;
            margin-bottom: 1rem;
            text-align: center;
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

        /* Form */
        form input[type="email"] {
            width: 81%;
            border-radius: 1rem;
            border: 2px solid #e2e8f0;
            background: #fff;
            padding: 0.85rem 1rem 0.85rem 3rem;
            color: #1e293b;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }

        form input[type="email"]:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 0.25rem rgba(16, 185, 129, 0.2);
        }

        form input[type="email"]::placeholder {
            color: #94a3b8;
        }

        form .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        /* Buttons */
        .btn-primary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            background: #27497c;
            color: #fff;
            font-weight: 600;
            padding: 0.85rem;
            border-radius: 1rem;
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            font-family: 'Inter', Helvetica, sans-serif;

        }

        .btn-primary:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            background: #f8fafc;
            color: #475569;
            font-weight: 600;
            padding: 0.85rem;
            border-radius: 1rem;
            border: 2px solid #e2e8f0;
            text-decoration: none;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-secondary:hover {
            background: #f1f5f9;
            color: #334155;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        .animate-shake {
            animation: shake 0.4s;
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

        /* Form spacing */
        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-buttons {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        @media (min-width: 640px) {
            .form-buttons {
                flex-direction: row;
            }
        }
    </style>
</head>

<body>
    <div class="background-accent-1"></div>
    <div class="background-accent-2"></div>

    <div class="forgot-card">

        <!-- Header -->
        <div class="header">
            <div class="icon-wrapper">
                <i class="fas fa-lock"></i>
            </div>
            <h1>Forgot Password?</h1>
            <p>Reset your password with your email</p>
        </div>

        <!-- Flash messages -->
        <?php require APPROOT . '/views/components/auth_message.php'; ?>

        <!-- Form -->
        <form method="POST" action="<?php echo URLROOT; ?>/auth/forgotPassword" id="forgotForm">

            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="Enter your email address" required>
                <i class="fas fa-envelope input-icon"></i>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-paper-plane"></i> Send Reset Link
                </button>
                <a href="<?php echo URLROOT; ?>/pages/login" class="btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Login
                </a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.getElementById("forgotForm");
            const email = document.getElementById("email");

            email.addEventListener("blur", () => {
                if (!email.checkValidity()) {
                    email.classList.add("border-red-500", "animate-shake");
                } else {
                    email.classList.remove("border-red-500", "animate-shake");
                }
            });

            form.addEventListener("submit", () => {
                const btn = form.querySelector("button[type=submit]");
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
                btn.disabled = true;
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