<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    $email = $_SESSION['post_email'] ?? 'your email';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter OTP — MySite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .otp-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 3rem;
            border-radius: 24px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.15);
        }

        .otp-input {
            width: 60px;
            height: 60px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .otp-input:focus {
            border-color: #10b981;
            outline: none;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .submit-btn {
            width: 100%;
            background: #10b981;
            color: white;
            padding: 1.25rem;
            border-radius: 16px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .email-display {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            background: rgba(16, 185, 129, 0.1);
            padding: 0.5rem 1rem;
            border-radius: 12px;
        }

        .email-icon {
            background: #10b981;
            color: white;
            border-radius: 8px;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .timer-display {
            font-weight: 700;
            color: #10b981;
            text-align: center;
            margin-top: 0.5rem;
        }

        .timer-display.expired {
            color: #ef4444;
        }

        .button-group {
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <div class="otp-container">
        <h1 class="text-center text-2xl font-bold mb-4">Verify Your Identity</h1>
        <p class="text-center text-gray-600 mb-6">Enter the 6-digit verification code sent to your email</p>
        <?php require APPROOT . '/views/components/auth_message.php'; ?>

        <div class="email-display">
            <div class="email-icon"><i class="fas fa-envelope"></i></div>
            <div><?php echo $_SESSION['post_email'] ?? 'your email'; ?></div>
        </div>

        <form method="post" action="<?php echo URLROOT; ?>/auth/verify_otp" id="otpForm">
            <div class="flex justify-center gap-3 mb-4">
                <input type="text" maxlength="1" class="otp-input" name="otp[]" required>
                <input type="text" maxlength="1" class="otp-input" name="otp[]" required>
                <input type="text" maxlength="1" class="otp-input" name="otp[]" required>
                <input type="text" maxlength="1" class="otp-input" name="otp[]" required>
                <input type="text" maxlength="1" class="otp-input" name="otp[]" required>
                <input type="text" maxlength="1" class="otp-input" name="otp[]" required>
            </div>
            <div class="button-group">
                <button type="submit" class="submit-btn"><i class="fas fa-check-circle"></i> Verify Code</button>
            </div>
        </form>

        <div class="timer-display" id="timer">00:59</div>
    </div>

    <script>
        // Auto-tab between OTP inputs
        const inputs = document.querySelectorAll('.otp-input');
        inputs.forEach((input, idx) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && idx < inputs.length - 1) {
                    inputs[idx + 1].focus();
                }
            });
        });

        // Countdown timer
        let time = 59;
        const timerEl = document.getElementById('timer');
        const countdown = setInterval(() => {
            const minutes = Math.floor(time / 60).toString().padStart(2, '0');
            const seconds = (time % 60).toString().padStart(2, '0');
            timerEl.textContent = `${minutes}:${seconds}`;
            if (time <= 0) {
                clearInterval(countdown);
                timerEl.textContent = "Expired";
                timerEl.classList.add('expired');
            }
            time--;
        }, 1000);
    </script>
</body>

</html>