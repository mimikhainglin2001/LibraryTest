<?php require_once APPROOT . '/views/inc/header.php'; ?>

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

    .password-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .password-wrapper input {
        width: 100%;
        padding-right: 35px;
    }

    .toggle-password {
        position: absolute;
        right: 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
        color: #888;
        opacity: 0.5;
        /* start as disabled look */
        pointer-events: none;
        /* disabled initially */
    }

    .toggle-password.enabled {
        opacity: 1;
        pointer-events: auto;
    }

    .toggle-password:hover {
        color: #000;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        /* left: 0; top: 0; */
        min-width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: #ffffff;
        padding: 2rem;
        border-radius: 0.75rem;
        width: 90%;
        max-width: 500px;
        position: relative;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        text-align: left;
    }

    .modal h3 {
        margin-bottom: 1rem;
        font-size: 1.5rem;
        color: #2d3748;
    }

    .close {
        position: absolute;
        right: 1rem;
        top: 1rem;
        font-size: 1.5rem;
        cursor: pointer;
        color: #718096;
    }

    .close-edit {
        position: absolute;
        right: 1rem;
        top: 1rem;
        font-size: 1.5rem;
        cursor: pointer;
        color: #718096;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.25rem;
        font-weight: 600;
        color: #4a5568;
    }

    .form-group input {
        width: 100%;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        border: 1px solid #cbd5e0;
        outline: none;
    }

    .form-actions {
        text-align: left;
    }

    .btn-password {
        background-color: #f59e0b;
        color: white;
        width: 180px;
        padding: 1rem 1rem;
        border-radius: 0.5rem;
        border: none;
        cursor: pointer;
    }

    .btn-password:hover {
        background-color: #d97706;
    }

    .main-content-area {
        background: linear-gradient(135deg, #ebf8ff 0%, #e0f2fe 100%);
        min-height: 100vh;
        font-family: 'Inter', Helvetica, sans-serif;
    }

    @media (min-width: 640px) {
        .main-content-area {
            padding: 1.5rem;
        }
    }

    @media (min-width: 1024px) {
        .main-content-area {
            padding: 2rem;
        }
    }

    .page-header {
        margin-bottom: 1.5rem;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    @media (min-width: 640px) {
        .page-title {
            font-size: 1.875rem;
        }
    }

    @media (min-width: 1024px) {
        .page-title {
            font-size: 2.25rem;
        }
    }

    .page-subtitle {
        color: #718096;
        font-size: 0.875rem;
    }

    @media (min-width: 640px) {
        .page-subtitle {
            font-size: 1rem;
        }
    }

    .profile-card {
        background-color: #ffffff;
        border-radius: 0.75rem;
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    @media (min-width: 640px) {
        .profile-card {
            margin-bottom: 2rem;
        }
    }

    .profile-header {
        background: #1e3a8a;
        padding: 1.5rem;
    }

    @media (min-width: 640px) {
        .profile-header {
            padding: 2rem;
        }
    }

    .profile-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }

    @media (min-width: 640px) {
        .profile-info {
            flex-direction: row;
            align-items: flex-start;
            gap: 1.5rem;
        }
    }

    .avatar-container {
        flex-shrink: 0;
    }

    .avatar {
        width: 5rem;
        height: 5rem;
        background-color: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    @media (min-width: 640px) {
        .avatar {
            width: 6rem;
            height: 6rem;
        }
    }

    .avatar i {
        color: #3b82f6;
        font-size: 2.5rem;
    }

    @media (min-width: 640px) {
        .avatar i {
            font-size: 3rem;
        }
    }

    .user-details {
        text-align: center;
        flex-grow: 1;
    }

    @media (min-width: 640px) {
        .user-details {
            text-align: left;
        }
    }

    .user-name {
        font-size: 1.25rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 0.5rem;
    }

    @media (min-width: 640px) {
        .user-name {
            font-size: 1.5rem;
        }
    }

    @media (min-width: 1024px) {
        .user-name {
            font-size: 1.875rem;
        }
    }

    .user-badges {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        align-items: center;
    }

    @media (min-width: 640px) {
        .user-badges {
            flex-direction: row;
            align-items: center;
            gap: 1rem;
        }
    }

    .badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
        background-color: rgba(59, 130, 246, 0.2);
        color: #ffffff;
    }

    @media (min-width: 640px) {
        .badge {
            font-size: 0.875rem;
        }
    }

    .badge i {
        margin-right: 0.25rem;
    }

    .separator {
        color: rgba(255, 255, 255, 0.5);
        display: none;
        font-size: 0.875rem;
    }

    @media (min-width: 640px) {
        .separator {
            display: inline;
        }
    }

    .profile-content {
        padding: 1.5rem;
    }

    @media (min-width: 640px) {
        .profile-content {
            padding: 2rem;
        }
    }

    .section-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }

    @media (min-width: 640px) {
        .section-title {
            font-size: 1.25rem;
        }
    }

    .section-title i {
        color: #3b82f6;
        margin-right: 0.5rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    @media (min-width: 640px) {
        .info-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
    }

    @media (min-width: 1024px) {
        .info-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .info-card {
        background-color: #f7fafc;
        border-radius: 0.5rem;
        padding: 1rem;
        border-left: 4px solid;
        transition: all 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .info-card.name {
        border-left-color: #3b82f6;
    }

    .info-card.email {
        border-left-color: #10b981;
    }

    .info-card.gender {
        border-left-color: #8b5cf6;
    }

    .info-card.roll {
        border-left-color: #f59e0b;
    }

    .info-card.year {
        border-left-color: #ef4444;
    }

    .info-card.role {
        border-left-color: #06b6d4;
    }

    .info-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }

    .info-label {
        font-size: 0.75rem;
        font-weight: 500;
        color: #718096;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .info-icon {
        font-size: 1rem;
    }

    .info-icon.name {
        color: #3b82f6;
    }

    .info-icon.email {
        color: #10b981;
    }

    .info-icon.gender {
        color: #8b5cf6;
    }

    .info-icon.roll {
        color: #f59e0b;
    }

    .info-icon.year {
        color: #ef4444;
    }

    .info-icon.role {
        color: #06b6d4;
    }

    .info-value {
        font-size: 0.875rem;
        font-weight: 600;
        color: #2d3748;
        word-break: break-word;
    }

    @media (min-width: 640px) {
        .info-value {
            font-size: 1rem;
        }
    }

    .actions-section {
        /* border-top: 1px solid #e2e8f0; */
        padding-top: 1.5rem;
    }

    .actions-grid {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    @media (min-width: 640px) {
        .actions-grid {
            flex-direction: row;
            gap: 1rem;
        }
    }

    .action-btn {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); */
    }

    @media (min-width: 640px) {
        .action-btn {
            flex: none;
        }
    }

    .action-btn:hover {
        transform: translateY(-1px);
        /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15); */
    }

    .action-btn i {
        margin-right: 0.5rem;
    }

    .btn-edit {
        margin-top: 25px;
        width: 180px;
        height: 56px;
        padding: 1rem 1rem;
        background-color: #3b82f6;
        color: #ffffff;
        cursor: pointer;
    }

    .btn-edit:hover {
        background-color: #2563eb;
        color: #ffffff;
    }

    .btn-password {
        background-color: #f59e0b;
        color: #ffffff;
    }

    .btn-password:hover {
        background-color: #d97706;
        color: #ffffff;
    }

    /* Additional responsive utilities */
    @media (max-width: 639px) {
        .hide-mobile {
            display: none;
        }
    }

    @media (min-width: 640px) {
        .show-mobile {
            display: none;
        }
    }
</style>

<main class="main-content-area" style="padding: 4rem;
">
    <!-- Page Header -->
    <div class="page-header">

        <!-- <p class="page-subtitle">Manage your personal information and account settings</p> -->
        <?php require APPROOT . '/views/components/auth_message.php'; ?>
    </div>

    <!-- Profile Card -->
    <div class="profile-card">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="profile-info">
                <!-- Avatar -->
                <div class="avatar-container">
                    <div class="avatar">
                        <?php if ($data['loginuser']['role_id'] == 2): ?>
                            <i class="fas fa-user-graduate"></i>
                        <?php else: ?>
                            <i class="fas fa-user-tie"></i>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- User Details -->
                <div class="user-details">
                    <h3 class="user-name">
                        <?php echo htmlspecialchars($data['loginuser']['name'] ?? 'User'); ?>
                    </h3>
                    <div class="user-badges">
                        <span class="badge">
                            <i class="fas fa-user"></i>
                            Member
                        </span>
                        <span class="separator">•</span>

                        <?php if ($data['loginuser']['role_id'] == 2): ?>
                            <span class="badge">
                                <i class="fas fa-graduation-cap"></i>
                                Student
                            </span>
                            <span class="separator">•</span>
                            <span class="badge">
                                <i class="fas fa-calendar"></i>
                                Year <?php echo htmlspecialchars($data['loginuser']['year']); ?>
                            </span>
                        <?php else: ?>
                            <span class="badge">
                                <i class="fas fa-building"></i>
                                Teacher
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="profile-content">
            <!-- <h4 class="section-title">
                <i class="fas fa-info-circle"></i>
                Personal Information
            </h4> -->

            <div class="info-grid">
                <!-- Name Card -->
                <div class="info-card name">
                    <div class="info-header">
                        <span class="info-label">Full Name</span>
                        <i class="fas fa-user info-icon name"></i>
                    </div>
                    <div class="info-value"><?php echo htmlspecialchars($data['loginuser']['name']); ?></div>
                </div>

                <!-- Email Card -->
                <div class="info-card email">
                    <div class="info-header">
                        <span class="info-label">Email Address</span>
                        <i class="fas fa-envelope info-icon email"></i>
                    </div>
                    <div class="info-value"><?php echo htmlspecialchars($data['loginuser']['email']); ?></div>
                </div>

                <!-- Gender Card -->
                <div class="info-card gender">
                    <div class="info-header">
                        <span class="info-label">Gender</span>
                        <i class="fas fa-venus-mars info-icon gender"></i>
                    </div>
                    <div class="info-value"><?php echo htmlspecialchars($data['loginuser']['gender']); ?></div>
                </div>

                <?php if ($data['loginuser']['role_id'] == 2): ?>
                    <!-- Student-only Cards -->
                    <div class="info-card roll">
                        <div class="info-header">
                            <span class="info-label">Roll Number</span>
                            <i class="fas fa-id-card info-icon roll"></i>
                        </div>
                        <div class="info-value"><?php echo htmlspecialchars($data['loginuser']['rollno']); ?></div>
                    </div>

                    <div class="info-card year">
                        <div class="info-header">
                            <span class="info-label">Academic Year</span>
                            <i class="fas fa-calendar-alt info-icon year"></i>
                        </div>
                        <div class="info-value"><?php echo htmlspecialchars($data['loginuser']['year']); ?></div>
                    </div>
                <?php else: ?>
                    <!-- Teacher-only Card -->
                    <div class="info-card department">
                        <div class="info-header">
                            <span class="info-label">Department</span>
                            <i class="fas fa-building info-icon role"></i>
                        </div>
                        <div class="info-value"><?php echo htmlspecialchars($data['loginuser']['department']); ?></div>
                    </div>
                <?php endif; ?>

                <!-- System Role Card -->
                <div class="info-card role">
                    <div class="info-header">
                        <span class="info-label">System Role</span>
                        <i class="fas fa-user-tag info-icon role"></i>
                    </div>
                    <div class="info-value">
                        <?php echo ($data['loginuser']['role_id'] == 2) ? 'Student' : 'Teacher'; ?>
                    </div>
                </div>
            </div>

            <!-- Actions Section -->
            <div class="actions-section">
                <h4 class="section-title">
                    <i class="fas fa-cogs"></i>
                    <span class="hide-mobile">Quick Actions</span>
                    <span class="show-mobile">Actions</span>
                </h4>

                <div class="actions-grid">

                    <button id="editProfileBtn" class="action-btn btn-edit">
                        <i class="fas fa-edit"></i> Edit Profile
                    </button>

                    <div class="actions-section">
                        <button id="changePasswordBtn" class="action-btn btn-password">
                            <i class="fas fa-key"></i> Change Password
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Edit Profile Modal -->
<div id="editProfileModal" class="modal">
    <div class="modal-content">
        <span class="close-edit">&times;</span>
        <h3>Edit Profile</h3>
        <form method="POST" action="<?php echo URLROOT; ?>/user/editProfile/<?php echo $data['loginuser']['id']; ?>">

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($data['loginuser']['name']); ?>" required>
            </div>

            <!-- <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($data['loginuser']['email']); ?>" required>
            </div> -->

            <div class="form-group">
                <label>Gender</label>
                <select name="gender" required>
                    <option value="Female" <?= $data['loginuser']['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                    <option value="Male" <?= $data['loginuser']['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                </select>
            </div>

            <?php if ($data['loginuser']['role_id'] == 2): ?>
                <!-- <div class="form-group">
                    <label>Roll No</label>
                    <input type="text" name="rollno" value="<?php echo htmlspecialchars($data['loginuser']['rollno']); ?>">
                </div> -->
                <div class="form-group">
                    <label>Year</label>
                    <input type="text" name="year" value="<?php echo htmlspecialchars($data['loginuser']['year']); ?>">
                </div>
            <?php else: ?>
                <div class="form-group">
                    <label>Department</label>
                    <input type="text" name="department" value="<?php echo htmlspecialchars($data['loginuser']['department']); ?>">
                </div>
            <?php endif; ?>

            <div class="form-actions" style="margin-top: 1rem;">
                <button type="submit" class="btn-edit">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Box -->
<div id="passwordModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Change Password</h3>
        <form action="<?php echo URLROOT; ?>/user/changeUserPassword/<?php echo $data['loginuser']['id']; ?>" method="POST">
            <div class="form-group">
                <label>Current Password</label>
                <div class="password-wrapper">
                    <input type="password" name="currentPassword" required>
                    <span class="toggle-password" title="Show/Hide Password">
                        <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label>New Password</label>
                <div class="password-wrapper">
                    <input type="password" name="newPassword" required>
                    <span class="toggle-password" title="Show/Hide Password">
                        <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <div class="password-wrapper">
                    <input type="password" name="confirmPassword" required>
                    <span class="toggle-password" title="Show/Hide Password">
                        <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-password">Save Changes</button>
            </div>
        </form>
    </div>
</div>


<script>
    // Enable the toggle only if there is input
    document.querySelectorAll('.password-wrapper input').forEach(input => {
        const toggle = input.nextElementSibling;

        input.addEventListener('input', () => {
            if (input.value.length > 0) {
                toggle.classList.add('enabled');
            } else {
                toggle.classList.remove('enabled');
                input.type = 'password'; // reset to hidden
            }
        });

        toggle.addEventListener('click', () => {
            if (!toggle.classList.contains('enabled')) return;
            input.type = input.type === 'password' ? 'text' : 'password';
        });
    });

    // ===== Password Modal =====
    const passwordModal = document.getElementById("passwordModal");
    const passwordBtn = document.getElementById("changePasswordBtn");
    const closePassword = document.querySelector("#passwordModal .close");

    passwordBtn.onclick = () => passwordModal.style.display = "flex";
    closePassword.onclick = () => passwordModal.style.display = "none";
    window.addEventListener("click", (e) => {
        if (e.target === passwordModal) passwordModal.style.display = "none";
    });

    // ===== Edit Profile Modal =====
    const editModal = document.getElementById("editProfileModal");
    const editBtn = document.getElementById("editProfileBtn");
    const closeEdit = document.querySelector("#editProfileModal .close-edit");

    editBtn.onclick = () => editModal.style.display = "flex";
    closeEdit.onclick = () => editModal.style.display = "none";
    window.addEventListener("click", (e) => {
        if (e.target === editModal) editModal.style.display = "none";
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