<?php if (isset($_SESSION['success'])) { ?>
    <div class="auth-message success" role="alert">
        <?php echo $_SESSION['success'];
            unsetMessage('success');
        ?>
    </div>
<?php } ?>

<?php if (isset($_SESSION['error'])) { ?>
    <p class="auth-message error">
        <?php echo $_SESSION['error'];
        unsetMessage('error');
        ?>
    </p>
<?php } ?>


<!-- <?php if (isset($_SESSION['success']) || isset($_SESSION['error'])): ?>
    <?php
    if (isset($_SESSION['success'])) {
        $type = 'success';
        $message = $_SESSION['success'];
        unsetMessage('success');
    } elseif (isset($_SESSION['error'])) {
        $type = 'error';
        $message = $_SESSION['error'];
        unsetMessage('error');
    }
    ?>
    <div id="authModal" class="modal-overlay" style="display:flex">
        <div class="modal-box">
            <h3 style="margin-bottom:15px;
                       color: <?= $type === 'success' ? '#28a745' : '#dc3545' ?>;">
                <?= ucfirst($type) ?>
            </h3>
            <p><?= htmlspecialchars($message) ?></p>
            <div class="modal-actions">
                <button id="authOk" class="modal-btn yes">OK</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const modal = document.getElementById("authModal");
            const okBtn = document.getElementById("authOk");

            if (okBtn) {
                okBtn.addEventListener("click", () => modal.style.display = "none");
            }

            // Optional: auto close after 4 seconds
            setTimeout(() => {
                if (modal) modal.style.display = "none";
            }, 4000);
        });
    </script>
<?php endif; ?> -->