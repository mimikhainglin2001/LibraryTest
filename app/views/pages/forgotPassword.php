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
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
    </style>
</head>

<body class="font-inter bg-gradient-to-r from-blue-100 via-blue-300 to-blue-500 min-h-screen flex items-center justify-center p-6 relative overflow-hidden">

    <!-- Background accents -->
    <div class="absolute inset-0 -z-10">
        <div class="absolute w-72 h-72 bg-purple-300/30 rounded-full blur-3xl top-10 left-10"></div>
        <div class="absolute w-96 h-96 bg-pink-300/30 rounded-full blur-3xl bottom-10 right-10"></div>
    </div>

    <!-- Forgot Password Card -->
    <div class="w-full max-w-md bg-white/90 backdrop-blur-xl rounded-3xl shadow-xl p-8 animate-[fadeInUp_0.6s_ease-out]">

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-10 h-10 mx-auto flex items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-500 to-green-400 shadow-lg animate-bounce-slow relative">
                <i class="fas fa-lock text-white text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold bg-gradient-to-r from-indigo-500 to-blue-600 bg-clip-text text-transparent mt-4">Forgot Password?</h1>
            <p class="text-slate-600 mt-2">Reset your password with your email</p>
        </div>

        <!-- Flash messages -->
        <?php require APPROOT . '/views/components/auth_message.php'; ?>

        <!-- Form -->
        <form method="POST" action="<?php echo URLROOT; ?>/auth/forgotPassword" id="forgotForm" class="space-y-6">

            <!-- Email input -->
            <div class="relative">
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter your email address"
                    required
                    class="w-full rounded-xl border-2 border-slate-200 bg-white py-3 pl-12 pr-4 text-slate-800 placeholder-slate-400 text-base focus:border-emerald-500 focus:ring-4 focus:ring-emerald-200 outline-none transition" />
                <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
                <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-emerald-500 to-green-400 text-white font-semibold py-3 rounded-xl shadow-md hover:shadow-lg transition hover:-translate-y-1 active:translate-y-0">
                    <i class="fas fa-paper-plane"></i> Send Reset Link
                </button>
                <a href="<?php echo URLROOT; ?>/pages/login" class="flex-1 inline-flex items-center justify-center gap-2 bg-slate-50 text-slate-600 border-2 border-slate-200 font-semibold py-3 rounded-xl hover:bg-slate-100 hover:text-slate-700 transition">
                    <i class="fas fa-arrow-left"></i> Back to Login
                </a>
            </div>
        </form>

        <!-- Register link -->
        <!-- <div class="mt-8 pt-6 border-t border-slate-200 text-center relative">
      <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-white px-3 text-xs font-semibold text-slate-400">OR</span>
      <p class="text-slate-600">Don't have an account?
        <a href="<?php echo URLROOT; ?>/pages/register" class="font-bold text-emerald-600 hover:text-emerald-700 underline underline-offset-4">Create New Account</a>
      </p>
    </div>
  </div> -->

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
        </script>

        <style>
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

            .animate-bounce-slow {
                animation: float 3s ease-in-out infinite;
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
        </style>
</body>

</html>