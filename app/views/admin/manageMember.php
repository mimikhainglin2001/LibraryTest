<?php require_once APPROOT . '/views/inc/sidebar.php';
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR3authorization/lQfrg1Bw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
<main class="main-content-area bg-blue-100 shadow-md" style="font-family: 'Inter', Helvetica, sans-serif;">
    <div class="flex items-center justify-between pb-6 border-b border-blue-200 mb-8">
        <h2 class="text-2xl font-bold text-gray-800">User List</h2>
        <?php require APPROOT . '/views/components/auth_message.php'; ?>

        <div class="flex items-center space-x-4">
            <a href="<?php echo URLROOT; ?>/admin/profile"
                class="flex items-center space-x-4 text-gray-700 hover:text-blue-600 transition duration-300">
                <i class="fas fa-user-circle text-2xl"></i>
                <span class="font-medium"><?php echo htmlspecialchars($name['name']); ?></span>
            </a>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-end mb-4">
            <a href="<?php echo URLROOT; ?>/pages/register"
                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition duration-300">
                <i class="fas fa-plus"></i>
                <span>Add Students</span>
            </a>
        </div>

        <div class="hidden md:block overflow-y-auto max-h-[calc(100vh-250px)] rounded-lg shadow border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 sticky top-0 z-10">
                    <tr>

                        <!-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User ID</th> -->
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Roll No</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (!empty($data['members'])): ?>
                        <?php foreach ($data['members'] as $member): ?>
                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4 text-sm text-gray-900"><?= htmlspecialchars($member['name']) ?></td>
                                <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($member['email']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($member['rollno'] ?? '') ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($member['gender']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($member['year'] ?? '') ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <?php
                                    $statusText = $member['is_active'] ? 'Active' : 'Inactive';
                                    $statusClass = $member['is_active'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $statusClass ?>">
                                        <?= $statusText ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button class="view-details-button bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-xs transition duration-300"
                                            data-id="<?= htmlspecialchars($member['id']) ?>"
                                            data-name="<?= htmlspecialchars($member['name']) ?>"
                                            data-email="<?= htmlspecialchars($member['email']) ?>"
                                            data-rollno="<?= htmlspecialchars($member['rollno'] ?? '') ?>"
                                            data-gender="<?= htmlspecialchars($member['gender']) ?>"
                                            data-year="<?= htmlspecialchars($member['year'] ?? '') ?>"
                                            data-status="<?= $member['is_active'] ? 'Active' : 'Inactive' ?>">
                                            Details
                                        </button>
                                        <button class="edit-button bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-xs transition duration-300"
                                            data-id="<?= htmlspecialchars($member['id']) ?>"
                                            data-name="<?= htmlspecialchars($member['name']) ?>"
                                            data-year="<?= htmlspecialchars($member['year'] ?? '') ?>"
                                            data-status="<?= $member['is_active'] ? 'Active' : 'Inactive' ?>">
                                            Edit
                                        </button>
                                        <button class="delete-button bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-xs transition duration-300"
                                            data-id="<?= htmlspecialchars($member['id']) ?>">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="md:hidden space-y-4 overflow-y-auto max-h-[calc(100vh-250px)]">
            <?php if (!empty($data['members'])): ?>
                <?php foreach ($data['members'] as $member): ?>
                    <div class="bg-gray-50 p-4 rounded-lg shadow border border-gray-200">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-lg font-bold text-gray-800"><?= htmlspecialchars($member['name']) ?></h3>
                            <?php
                            $statusText = $member['is_active'] ? 'Active' : 'Inactive';
                            $statusClass = $member['is_active'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                            ?>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $statusClass ?>">
                                <?= $statusText ?>
                            </span>
                        </div>
                        <p class="text-sm text-gray-700 mb-1"><strong>ID:</strong> <?= htmlspecialchars($member['id']) ?></p>
                        <p class="text-sm text-gray-700 mb-1"><strong>Email:</strong> <?= htmlspecialchars($member['email']) ?></p>
                        <p class="text-sm text-gray-700 mb-1"><strong>Roll No:</strong> <?= htmlspecialchars($member['rollno'] ?? '') ?></p>
                        <p class="text-sm text-gray-700 mb-1"><strong>Gender:</strong> <?= htmlspecialchars($member['gender']) ?></p>
                        <p class="text-sm text-gray-700 mb-4"><strong>Year:</strong> <?= htmlspecialchars($member['year'] ?? '') ?></p>
                        <div class="flex space-x-2">
                            <button class="view-details-button bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-xs transition duration-300"
                                data-id="<?= htmlspecialchars($member['id']) ?>"
                                data-name="<?= htmlspecialchars($member['name']) ?>"
                                data-email="<?= htmlspecialchars($member['email']) ?>"
                                data-rollno="<?= htmlspecialchars($member['rollno'] ?? '') ?>"
                                data-gender="<?= htmlspecialchars($member['gender']) ?>"
                                data-year="<?= htmlspecialchars($member['year'] ?? '') ?>"
                                data-status="<?= $member['is_active'] ? 'Active' : 'Inactive' ?>">
                                Details
                            </button>
                            <button class="edit-button bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-xs transition duration-300"
                                data-id="<?= htmlspecialchars($member['id']) ?>"
                                data-name="<?= htmlspecialchars($member['name']) ?>"
                                data-year="<?= htmlspecialchars($member['year'] ?? '') ?>"
                                data-status="<?= $member['is_active'] ? 'Active' : 'Inactive' ?>">
                                Edit
                            </button>
                            <button class="delete-button bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-xs transition duration-300"
                                data-id="<?= htmlspecialchars($member['id']) ?>">
                                Delete
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center py-4 text-gray-500">No users found.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<div id="viewModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <h2 class="text-xl font-bold mb-4">User Details</h2>
        <ul class="space-y-2 text-gray-800">
            <li><strong>ID:</strong> <span id="viewId"></span></li>
            <li><strong>Name:</strong> <span id="viewName"></span></li>
            <li><strong>Email:</strong> <span id="viewEmail"></span></li>
            <li><strong>Roll No:</strong> <span id="viewRoll"></span></li>
            <li><strong>Gender:</strong> <span id="viewGender"></span></li>
            <li><strong>Year:</strong> <span id="viewYear"></span></li>
            <li><strong>Status:</strong> <span id="viewStatus"></span></li>
        </ul>
        <div class="mt-6 text-right">
            <button onclick="closeModal('viewModal')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Close</button>
        </div>
    </div>
</div>

<div id="editModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-[500px] max-w-full">
        <h2 class="text-xl font-bold mb-4 text-gray-800 flex items-center gap-2">
            <i class="fas fa-user-edit text-yellow-500"></i> Edit User
        </h2>
        <form id="editForm" method="POST" class="space-y-4">
            <input type="hidden" id="editId" name="id">
            <?php if (isset($data['csrf_token'])): ?>
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($data['csrf_token']); ?>">
            <?php endif; ?>

            <div>
                <label for="editName" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="editName" name="name" required
                    class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-yellow-400" />
            </div>

            <div>
                <label for="editYear" class="block text-sm font-medium text-gray-700">Year</label>
                <input type="text" id="editYear" name="year" required
                    class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-yellow-400" />
            </div>

            <div>
                <label for="editStatus" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="editStatus" name="status" required
                    class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-yellow-400">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="closeModal('editModal')"
                    class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<div id="deleteModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-[400px] max-w-full">
        <h2 class="text-xl font-bold mb-4 text-red-600">Confirm Deletion</h2>
        <p class="mb-4">Are you sure you want to delete this user?</p>
        <form id="deleteForm" method="POST">
            <input type="hidden" id="deleteInputId" name="id">
            <?php if (isset($csrf_token)): // This should probably be $data['csrf_token'] for consistency if it's passed via data array 
            ?>
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
            <?php endif; ?>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal('deleteModal')" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Cancel</button>
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Delete</button>
            </div>
        </form>
    </div>
</div>

<style>
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .modal.hidden {
        display: none;
    }

    .modal-content {
        background: white;
        padding: 20px;
        border-radius: 8px;
        width: 400px;
        /* Default width for content */
        max-width: 90%;
        /* Max width for smaller screens */
        animation: fadeIn 0.2s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>

<script>
    const viewButtons = document.querySelectorAll('.view-details-button');
    const editButtons = document.querySelectorAll('.edit-button');
    const deleteButtons = document.querySelectorAll('.delete-button');

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    // View Modal Logic
    viewButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('viewId').textContent = btn.dataset.id;
            document.getElementById('viewName').textContent = btn.dataset.name;
            document.getElementById('viewEmail').textContent = btn.dataset.email;
            document.getElementById('viewRoll').textContent = btn.dataset.rollno;
            document.getElementById('viewGender').textContent = btn.dataset.gender;
            document.getElementById('viewYear').textContent = btn.dataset.year;
            document.getElementById('viewStatus').textContent = btn.dataset.status;
            openModal('viewModal');
        });
    });

    // Close view modal when clicking outside
    document.getElementById('viewModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeModal('viewModal');
        }
    });

    // Edit Modal Logic
    editButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('editId').value = btn.dataset.id;
            document.getElementById('editName').value = btn.dataset.name;
            document.getElementById('editYear').value = btn.dataset.year;
            document.getElementById('editStatus').value = btn.dataset.status;
            openModal('editModal');
        });
    });

    document.getElementById('editForm').addEventListener('submit', function(e) {
        const id = document.getElementById('editId').value;
        // Ensure this action URL is correct for editing a member/user
        this.action = "<?php echo URLROOT; ?>/admin/editMemberList/" + id; // Changed to editUser
    });

    // Close edit modal when clicking outside
    document.getElementById('editModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeModal('editModal');
        }
    });

    // Delete Modal Logic
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            document.getElementById('deleteInputId').value = id;
            // Ensure this action URL is correct for deleting a member/user
            document.getElementById('deleteForm').action = "<?php echo URLROOT; ?>/admin/deleteMemberList/" + id; // Changed to deleteUser
            openModal('deleteModal');
        });
    });

    // Close delete modal when clicking outside
    document.getElementById('deleteModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeModal('deleteModal');
        }
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