<?php require_once APPROOT . '/views/inc/sidebar.php'; ?>

<main class="main-content-area bg-blue-100 shadow-md p-8 min-h-screen">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Edit Admin Profile</h2>

    <div class="bg-white p-6 rounded-lg shadow-md max-w-3xl mx-auto">
        <form action="<?php echo URLROOT; ?>/admin/editAdminProfile/<?php echo $data['loginuser']['id']?>" method="POST" class="space-y-6">

            <div>
                <label class="block mb-2 font-semibold text-gray-700">Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($data['loginuser']['name']); ?>"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($data['loginuser']['email']); ?>"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block mb-2 font-semibold text-gray-700">Gender</label>
                <select name="gender"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
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
</main>
