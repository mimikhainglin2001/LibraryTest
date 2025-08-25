<?php require_once APPROOT . '/views/inc/sidebar.php'; // Your existing sidebar 
?>

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
<main class="main-content-area bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen p-4 sm:p-6 lg:p-8" style="font-family: 'Inter', Helvetica, sans-serif;">
    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="mb-4">
            <div class="px-4 py-3 rounded-lg shadow-md 
            <?= $_SESSION['flash_message']['type'] === 'success'
                ? 'bg-green-100 text-green-800 border border-green-300'
                : 'bg-red-100 text-red-800 border border-red-300' ?>">
                <?= htmlspecialchars($_SESSION['flash_message']['text']); ?>
            </div>
        </div>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>

    <!-- Page Header -->
    <div class="mb-6 sm:mb-8">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-800">Admin Profile</h2>
        <p class="text-gray-600 mt-2 text-sm sm:text-base">Manage your account information and settings</p>
        <?php require APPROOT . '/views/components/auth_message.php'; ?>

    </div>

    <!-- Profile Card -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6 sm:mb-8">
        <!-- Profile Header -->
        <div class="bg-blue-900 p-6 sm:p-8">
            <div class="flex flex-col sm:flex-row items-center sm:items-start space-y-4 sm:space-y-0 sm:space-x-6">
                <!-- Profile Avatar -->
                <div class="flex-shrink-0">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 bg-white rounded-full flex items-center justify-center shadow-lg">
                        <i class="fas fa-user-circle text-blue-600 text-4xl sm:text-5xl"></i>
                    </div>
                </div>

                <!-- Profile Info -->
                <div class="text-center sm:text-left flex-grow">
                    <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white mb-2">
                        <?php echo htmlspecialchars($data['name'] ?? 'Admin'); ?>
                    </h3>
                    <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-1 sm:space-y-0">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs sm:text-sm font-medium bg-blue-100 text-blue-800">
                            <i class="fas fa-shield-alt mr-1"></i>
                            Administrator
                        </span>
                        <span class="text-blue-100 text-sm hidden sm:inline">•</span>
                        <span class="text-blue-100 text-sm">
                            <i class="fas fa-envelope mr-1"></i>
                            <?php
                            if (!empty($data['loginuser']) && is_array($data['loginuser'])) {
                                echo htmlspecialchars($data['loginuser']['email']);
                            } else {
                                echo 'Email not available';
                            }
                            ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Details -->
        <div class="p-6 sm:p-8">
            <!-- Contact Information Section -->
            <div class="mb-8">
                <!-- <h4 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                    Contact Information
                </h4> -->

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    <!-- Name Card -->
                    <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-blue-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Full Name</p>
                                <p class="text-base sm:text-lg font-semibold text-gray-800 mt-1">
                                    <?php
                                    if (!empty($data['loginuser']) && is_array($data['loginuser'])) {
                                        echo htmlspecialchars($data['loginuser']['name']);
                                    } else {
                                        echo 'Name not available';
                                    }
                                    ?>
                                </p>
                            </div>
                            <i class="fas fa-user text-blue-500 text-xl"></i>
                        </div>
                    </div>

                    <!-- Email Card -->
                    <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-green-500">
                        <div class="flex items-center justify-between">
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-gray-600">Email Address</p>
                                <p class="text-base sm:text-lg font-semibold text-gray-800 mt-1 truncate">
                                    <?php if (!empty($data['loginuser']) && is_array($data['loginuser'])): ?>
                                        <?php echo htmlspecialchars($data['loginuser']['email'] ?? ''); ?>
                                    <?php else: ?>
                                <p>User data not available.</p>
                            <?php endif; ?>
                            </p>
                            </div>
                            <i class="fas fa-envelope text-green-500 text-xl ml-2"></i>
                        </div>
                    </div>

                    <!-- Gender Card -->
                    <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-purple-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Gender</p>
                                <p class="text-base sm:text-lg font-semibold text-gray-800 mt-1 capitalize">
                                    <?php if (!empty($data['loginuser']) && is_array($data['loginuser'])): ?>
                                        <?php echo htmlspecialchars($data['loginuser']['gender'] ?? 'Not specified'); ?>
                                    <?php else: ?>
                                <p>User data not available.</p>
                            <?php endif; ?>
                            </p>
                            </div>
                            <i class="fas fa-venus-mars text-purple-500 text-xl"></i>
                        </div>
                    </div>

                    <!-- Role Card -->
                    <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-orange-500 sm:col-span-2 lg:col-span-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">System Role</p>
                                <p class="text-base sm:text-lg font-semibold text-gray-800 mt-1">
                                    <?php echo htmlspecialchars($data['loginuser']['role_name'] ?? 'N/A'); ?>
                                </p>
                            </div>
                            <i class="fas fa-user-cog text-orange-500 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="border-t pt-6">
                <h4 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-cogs text-blue-600 mr-2"></i>
                    Quick Actions
                </h4>

                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                    <!-- Edit Profile Trigger -->
                    <button id="editProfileBtn"
                        class="flex-1 sm:flex-none bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center transition duration-300">
                        <i class="fas fa-edit mr-2"></i>
                        <span>Edit Profile</span>
                    </button>

                    <!-- Change Password Trigger -->
                    <button id="changePasswordBtn"
                        class="flex-1 sm:flex-none bg-amber-600 hover:bg-amber-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center transition duration-300">
                        <i class="fas fa-key mr-2"></i>
                        <span>Change Password</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</main>

<!-- Edit Profile Modal -->
<div id="editProfileModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg relative">
        <button class="absolute top-3 right-3 text-gray-500 hover:text-gray-700" id="closeEditProfile">&times;</button>
        <h3 class="text-xl font-bold text-gray-800 mb-4">Edit Profile</h3>
        <form action="<?php echo URLROOT; ?>/admin/editAdminProfile/<?php echo $data['loginuser']['id'] ?>" method="POST" class="space-y-6">
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($data['loginuser']['name']); ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>
            <!-- <div>
                <label class="block mb-2 font-semibold text-gray-700">Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($data['loginuser']['email']); ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
            </div> -->
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Gender</label>
                <select name="gender" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
                    <option value="Female" <?= $data['loginuser']['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
                    <option value="Male" <?= $data['loginuser']['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
                </select>
            </div>
            <div class="text-center">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-300">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Change Password Modal -->
<div id="passwordModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg relative">
        <button class="absolute top-3 right-3 text-gray-500 hover:text-gray-700" id="closePassword">&times;</button>
        <h3 class="text-xl font-bold text-gray-800 mb-4">Change Password</h3>
        <form action="<?php echo URLROOT; ?>/admin/changePassword/<?php echo $data['loginuser']['id'] ?>" method="POST" class="space-y-6">

            <!-- Current Password -->
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Current Password</label>
                <div class="relative">
                    <input type="password" name="currentPassword" id="currentPassword"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 pr-10" required>
                    <button type="button" class="absolute inset-y-0 right-3 flex items-center text-gray-500 toggle-password" data-target="currentPassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- New Password -->
            <div>
                <label class="block mb-2 font-semibold text-gray-700">New Password</label>
                <div class="relative">
                    <input type="password" name="newPassword" id="newPassword"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 pr-10" required>
                    <button type="button" class="absolute inset-y-0 right-3 flex items-center text-gray-500 toggle-password" data-target="newPassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Confirm Password</label>
                <div class="relative">
                    <input type="password" name="confirmPassword" id="confirmPassword"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 pr-10" required>
                    <button type="button" class="absolute inset-y-0 right-3 flex items-center text-gray-500 toggle-password" data-target="confirmPassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="text-center">
                <button type="submit"
                    class="bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-300">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>


<script>
    // Edit Profile Modal
    const editProfileBtn = document.getElementById('editProfileBtn');
    const editProfileModal = document.getElementById('editProfileModal');
    const closeEditProfile = document.getElementById('closeEditProfile');

    editProfileBtn.onclick = () => editProfileModal.classList.remove('hidden');
    closeEditProfile.onclick = () => editProfileModal.classList.add('hidden');
    window.onclick = (e) => {
        if (e.target === editProfileModal) editProfileModal.classList.add('hidden');
    }

    // Change Password Modal
    const changePasswordBtn = document.getElementById('changePasswordBtn');
    const passwordModal = document.getElementById('passwordModal');
    const closePassword = document.getElementById('closePassword');

    changePasswordBtn.onclick = () => passwordModal.classList.remove('hidden');
    closePassword.onclick = () => passwordModal.classList.add('hidden');
    window.onclick = (e) => {
        if (e.target === passwordModal) passwordModal.classList.add('hidden');
    }

    // Toggle show/hide password
    document.querySelectorAll(".toggle-password").forEach(btn => {
        btn.addEventListener("click", function() {
            const target = document.getElementById(this.dataset.target);
            const icon = this.querySelector("i");

            if (target.type === "password") {
                target.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                target.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
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