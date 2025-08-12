<?php require_once APPROOT . '/views/inc/header.php'; ?>

<main style="background-color: #ebf8ff; padding: 2rem; min-height: 100vh; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
    <h2 style="font-size: 2rem; font-weight: bold; color: #2d3748; margin-bottom: 1.5rem;">Change Password</h2>

    <div style="background: white; padding: 1.5rem; border-radius: 0.5rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); max-width: 600px; margin: 0 auto;">
        <form 
            action="<?php echo URLROOT; ?>/user/changeUserPassword/<?php echo isset($data['loginuser']['id']) ? $data['loginuser']['id'] : ''; ?>" 
            method="POST"
        >

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #4a5568;">Current Password</label>
                <input type="password" name="currentPassword" value=""
                    style="width: 100%; padding: 0.6rem 1rem; border: 1px solid #cbd5e0; border-radius: 0.5rem; outline: none;"
                    required>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #4a5568;">New Password</label>
                <input type="password" name="newPassword" value=""
                    style="width: 100%; padding: 0.6rem 1rem; border: 1px solid #cbd5e0; border-radius: 0.5rem; outline: none;"
                    required>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #4a5568;">Confirm Password</label>
                <input type="password" name="confirmPassword" value=""
                    style="width: 100%; padding: 0.6rem 1rem; border: 1px solid #cbd5e0; border-radius: 0.5rem; outline: none;"
                    required>
            </div>

            <div style="text-align: center;">
                <button type="submit"
                    style="background-color: #3182ce; color: white; font-weight: 600; padding: 0.6rem 1.5rem; border: none; border-radius: 0.5rem; cursor: pointer; transition: background-color 0.3s;">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</main>
