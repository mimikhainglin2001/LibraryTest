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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/form_validate.css">
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
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            line-height: 1.6;
        }

        .main-container {
            display: flex;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-radius: 15px;
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            width: 100%;
            max-width: 960px;
            animation: fadeUp 0.6s ease-out;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Messages */
        .auth-message {
            padding: 1rem;
            border-radius: 12px;
            font-weight: 600;
            margin-bottom: 1rem;
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

        /* Floating books animation */
        .floating-book {
            position: absolute;
            font-size: 2rem;
            color: rgba(255, 255, 255, 0.15);
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

        /* Right Section Custom Styling */
        .form-title {
            font-size: 1.875rem;
            /* 3xl */
            font-weight: 800;
            background: navy;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            color: #111316ff;
            /* slate-600 */
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            color: #1e293b;
            background: #fff;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .form-input::placeholder {
            color: #6b7280;
        }

        .form-input:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.25);
        }

        .submit-btn {
            width: 100%;
            background: #27497c;
            color: #fff;
            font-weight: 600;
            font-size: 1.05rem;
            padding: 0.9rem;
            border-radius: 12px;
            cursor: pointer;
            margin-top: 1.5rem;
        }

        /* .submit-btn:hover {
            transform: translateY(-2px);
        } */
    </style>
</head>

<body>
    <div class="main-container flex flex-col md:flex-row">
        <!-- Left Section -->
        <div class="relative flex-1 flex items-center justify-center bg-[#27497c] text-white p-8">
            <div class="absolute inset-0 bg-1e3a8a from-indigo-900/90 to-indigo-800/80"></div>

            <!-- Floating books -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="floating-book">📚</div>
                <div class="floating-book">📖</div>
                <div class="floating-book">📕</div>
            </div>

            <div class="relative z-10 text-center">
                <!-- <h2 class="text-3xl font-bold mb-2">Welcome Back</h2> -->

                <img src="/images/download (2).png" alt="Library" class="mx-auto max-w-[280px] rounded-lg  mb-4" />
                <p class="text-base opacity-90 max-w-sm mx-auto">Access your personalized dashboard, resources, and tools by signing in.</p>
            </div>
        </div>

        <!-- Right Section -->
        <div class="flex-1 p-8 md:p-12 flex items-center justify-center">
            <div class="w-full max-w-md">
                <!-- Hero -->
                <div class="text-center mb-6">
                    <h1 class="form-title">Sign In</h1>
                    <p class="form-subtitle">Enter your email and password to continue</p>
                </div>

                <!-- Form -->
                <form method="POST" action="<?php echo URLROOT; ?>/auth/login" id="loginForm" class="space-y-5">
                    <?php require APPROOT . '/views/components/auth_message.php'; ?>

                    <!-- Email -->
                    <div>
                        <input type="email" id="email" name="email" placeholder="Email Address" required class="form-input" />
                    </div>

                    <!-- Password -->
                    <div>
                        <input type="password" id="password" name="password" placeholder="Password" required class="form-input" />
                        <div class="flex items-center mt-2">
                            <input type="checkbox" id="showPasswordCheckbox" onchange="togglePasswordVisibility('password', this)" class="mr-2 accent-emerald-600">
                            <label for="showPasswordCheckbox" class="text-sm text-slate-600 cursor-pointer">Show Password</label>
                        </div>
                    </div>

                    <!-- Forgot -->
                    <div class="text-right">
                        <a href="<?php echo URLROOT; ?>/pages/forgotPassword" class="text-emerald-600 font-medium text-sm hover:underline">Forgot Password?</a>
                    </div>

                    <!-- reCAPTCHA -->
                    <div class="g-recaptcha" data-sitekey="6LcgC6srAAAAALsBkoG1fkh0WkvgKh87AlkDBrDW"></div>

                    <!-- Submit -->
                    <button type="submit" class="submit-btn">
                        Sign In to Continue
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        function togglePasswordVisibility(fieldId, checkboxElement) {
            const input = document.getElementById(fieldId);
            input.type = checkboxElement.checked ? "text" : "password";
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const submitBtn = form.querySelector('button[type="submit"]');

            form.addEventListener('submit', function() {
                submitBtn.textContent = 'Signing In...';
                submitBtn.disabled = true;
                submitBtn.classList.add("opacity-70", "cursor-not-allowed");
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