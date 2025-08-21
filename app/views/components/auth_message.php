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


