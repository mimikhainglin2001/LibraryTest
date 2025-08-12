<?php require_once APPROOT . '/views/inc/sidebar.php'; ?>
<main class="main-content-area bg-blue-100 shadow-md">
    <div class="flex items-center justify-between pb-6 border-b border-blue-200 mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Reserved Book List</h2>
        <div class="flex items-center space-x-4">
            
            <a href="<?php echo URLROOT; ?>/admin/profile" class="flex items-center space-x-4 text-gray-700 hover:text-blue-600 transition duration-300">
                <i class="fas fa-user-circle text-2xl"></i>
                <span class="font-medium"><?php echo htmlentities($name['name']); ?></span>
            </a>
        </div>
    </div>

   
    <div class="bg-white p-6 rounded-lg shadow-md">
    <div class="overflow-x-auto w-full">
        <table class="table-auto min-w-max border-collapse border border-gray-300 w-full">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="border px-4 py-2">Member Name</th>
                    <th class="border px-4 py-2">Title</th>
                    <th class="border px-4 py-2">Available Quantity</th>
                    <th class="border px-4 py-2">Reserved Date</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($data['reservedBookList'] as $book):

                if ($book['available_quantity'] > 0) {
                    $status = "available";
                } elseif ($book['available_quantity'] == 0) {
                    $status = "pending";
                } else {
                    $status = "unknown";
                }

            ?>
        <tr class="hover:bg-blue-50">
            <td class="border px-4 py-2"><?= htmlspecialchars($book['user_name']) ?></td>
            <td class="border px-4 py-2"><?= htmlspecialchars($book['book_title']) ?></td>
            <td class="border px-4 py-2"><?= htmlspecialchars($book['available_quantity']) ?></td>
            <td class="border px-4 py-2"><?= htmlspecialchars($book['reserved_at']) ?></td>
            <td class="border px-4 py-2">
                <span class="inline-block px-3 py-1 text-sm font-semibold 
                    <?= $status === 'available' ? 'text-green-800 bg-green-100' : 'text-yellow-800 bg-yellow-100' ?> 
                    rounded-full">
                    <?= htmlspecialchars($status) ?>
                </span>
            </td>
            <td class="border px-4 py-2 space-x-2">
    <?php if ($book['available_quantity'] > 0): ?>
        <a href="<?= URLROOT ?>/ConfirmReservation/confirmreservation?user_id=<?= $book['user_id'] ?>&book_id=<?= $book['book_id'] ?>&available_quantity=<?= $book['available_quantity'] ?>" 
           class="bg-green-500 hover:bg-green-600 text-white px-4 py-1 rounded-full text-sm transition duration-200 inline-block">
            Confirm
        </a>

        <a href="<?= URLROOT ?>/ConfirmReservation/cancel?user_id=<?= $book['user_id'] ?>&book_id=<?= $book['book_id'] ?>" 
           class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded-full text-sm transition duration-200 inline-block">
            Cancel
        </a>
    <?php else: ?>
        <span class="text-sm font-semibold text-red-600">Not Available</span>
    <?php endif; ?>
</td>


            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

        </table>
    </div>
</div>

</main>
</div>

<!-- Optional Logout Message Box Script (commented out, safe to remove or enable) -->
<!--
<div id="logoutMessageBox" class="message-box-overlay">
    <div class="message-box-content">
        <h4 class="text-2xl font-bold text-gray-800 mb-4">Logged Out Successfully!</h4>
        <p class="text-gray-600 mb-6">You have been successfully logged out of the admin dashboard.</p>
        <button id="closeMessageBox" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-full transition duration-300">
            OK
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const logoutButton = document.getElementById('logoutButton');
        const logoutMessageBox = document.getElementById('logoutMessageBox');
        const closeMessageBox = document.getElementById('closeMessageBox');

        function showMessageBox() {
            logoutMessageBox.classList.add('show');
        }

        function hideMessageBox() {
            logoutMessageBox.classList.remove('show');
        }

        if (logoutButton) {
            logoutButton.addEventListener('click', function(event) {
                event.preventDefault();
                showMessageBox();
            });
        }

        closeMessageBox.addEventListener('click', hideMessageBox);

        logoutMessageBox.addEventListener('click', function(event) {
            if (event.target === logoutMessageBox) {
                hideMessageBox();
            }
        });
    });
</script>
-->

</body>
</html>
