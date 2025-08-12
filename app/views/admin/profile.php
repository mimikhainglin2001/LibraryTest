<?php require_once APPROOT . '/views/inc/sidebar.php'; // Your existing sidebar 
?>

<main class="main-content-area bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen p-4 sm:p-6 lg:p-8">
    <!-- Page Header -->
    <div class="mb-6 sm:mb-8">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-800">Admin Profile</h2>
        <p class="text-gray-600 mt-2 text-sm sm:text-base">Manage your account information and settings</p>
    </div>

    <!-- Profile Card -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6 sm:mb-8">
        <!-- Profile Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 sm:p-8">
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
                        <?php echo htmlspecialchars($data['name'] ?? 'Admin User'); ?>
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
                <h4 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                    Contact Information
                </h4>

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
                    <a href="<?php echo URLROOT; ?>/admin/editAdminProfile/"
                        class="flex-1 sm:flex-none bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center">
                        <i class="fas fa-edit mr-2"></i>
                        <span>Edit Profile</span>
                    </a>

                    <a href="<?php echo URLROOT; ?>/admin/changeAdminPassword/"
                        class="flex-1 sm:flex-none bg-amber-600 hover:bg-amber-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center">
                        <i class="fas fa-key mr-2"></i>
                        <span>Change Password</span>
                    </a>

                    <!-- Additional quick action -->
                    <!-- <button class="flex-1 sm:flex-none bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center">
                        <i class="fas fa-download mr-2"></i>
                        <span class="hidden sm:inline">Download</span>
                        <span class="sm:hidden">Export</span>
                    </button> -->
                </div>
            </div>
        </div>
    </div>


</main>