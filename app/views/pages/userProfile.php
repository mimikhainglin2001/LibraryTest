<?php require_once APPROOT . '/views/inc/header.php'; ?>

<style>
    .main-content-area {
        background: linear-gradient(135deg, #ebf8ff 0%, #e0f2fe 100%);
        min-height: 100vh;
        padding: 1rem;
        font-family: Arial, Helvetica, sans-serif;
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
        background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
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
        border-top: 1px solid #e2e8f0;
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
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    @media (min-width: 640px) {
        .action-btn {
            flex: none;
        }
    }

    .action-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .action-btn i {
        margin-right: 0.5rem;
    }

    .btn-edit {
        background-color: #3b82f6;
        color: #ffffff;
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

<main class="main-content-area">
    <!-- Page Header -->
    <div class="page-header">
        <h2 class="page-title">User Profile</h2>
        <p class="page-subtitle">Manage your personal information and account settings</p>
    </div>

    <!-- Profile Card -->
    <div class="profile-card">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="profile-info">
                <!-- Avatar -->
                <div class="avatar-container">
                    <div class="avatar">
                        <i class="fas fa-user-circle"></i>
                    </div>
                </div>

                <!-- User Details -->
                <div class="user-details">
                    <h3 class="user-name">
                        <?php echo htmlspecialchars($data['name'] ?? 'User'); ?>
                    </h3>
                    <div class="user-badges">
                        <span class="badge">
                            <i class="fas fa-user"></i>
                            Member
                        </span>
                        <span class="separator">•</span>
                        <span class="badge">
                            <i class="fas fa-graduation-cap"></i>
                            Student
                        </span>
                        <span class="separator">•</span>
                        <span class="badge">
                            <i class="fas fa-calendar"></i>
                            Year <?php echo htmlspecialchars($data['loginuser']['year']); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="profile-content">
            <!-- Contact Information Section -->
            <h4 class="section-title">
                <i class="fas fa-info-circle"></i>
                Personal Information
            </h4>

            <div class="info-grid">
                <!-- Name Card -->
                <div class="info-card name">
                    <div class="info-header">
                        <span class="info-label">Full Name</span>
                        <i class="fas fa-user info-icon name"></i>
                    </div>
                    <div class="info-value">
                        <?php echo htmlspecialchars($data['loginuser']['name']); ?>
                    </div>
                </div>

                <!-- Email Card -->
                <div class="info-card email">
                    <div class="info-header">
                        <span class="info-label">Email Address</span>
                        <i class="fas fa-envelope info-icon email"></i>
                    </div>
                    <div class="info-value">
                        <?php echo htmlspecialchars($data['loginuser']['email']); ?>
                    </div>
                </div>

                <!-- Gender Card -->
                <div class="info-card gender">
                    <div class="info-header">
                        <span class="info-label">Gender</span>
                        <i class="fas fa-venus-mars info-icon gender"></i>
                    </div>
                    <div class="info-value">
                        <?php echo htmlspecialchars($data['loginuser']['gender']); ?>
                    </div>
                </div>

                <!-- Roll Number Card -->
                <div class="info-card roll">
                    <div class="info-header">
                        <span class="info-label">Roll Number</span>
                        <i class="fas fa-id-card info-icon roll"></i>
                    </div>
                    <div class="info-value">
                        <?php echo htmlspecialchars($data['loginuser']['rollno']); ?>
                    </div>
                </div>

                <!-- Year Card -->
                <div class="info-card year">
                    <div class="info-header">
                        <span class="info-label">Academic Year</span>
                        <i class="fas fa-calendar-alt info-icon year"></i>
                    </div>
                    <div class="info-value">
                        <?php echo htmlspecialchars($data['loginuser']['year']); ?>
                    </div>
                </div>

                <!-- Role Card -->
                <div class="info-card role">
                    <div class="info-header">
                        <span class="info-label">System Role</span>
                        <i class="fas fa-user-tag info-icon role"></i>
                    </div>
                    <div class="info-value">
                        <?php echo htmlspecialchars($data['loginuser']['role_name'] ?? 'N/A'); ?>
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
                    <a href="<?php echo URLROOT; ?>/pages/editProfile/<?php echo $data['loginuser']['id']; ?>"
                        class="action-btn btn-edit">
                        <i class="fas fa-edit"></i>
                        Edit Profile
                    </a>

                    <a href="<?php echo URLROOT; ?>/pages/changeUserPassword/<?php echo $data['loginuser']['id']; ?>"
                        class="action-btn btn-password">
                        <i class="fas fa-key"></i>
                        <span class="hide-mobile">Change Password</span>
                        <span class="show-mobile">Change Pass</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>