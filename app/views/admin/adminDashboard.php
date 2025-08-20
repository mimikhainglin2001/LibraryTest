<?php require_once APPROOT . '/views/inc/sidebar.php';
// Total books in stock
$totalbook = 0;
foreach ($data['book'] as $book) {
    $totalbook += $book['available_quantity']; // sum all quantities
}

$user = count($data['user']);

// Count borrowed books
$borrowedCount = 0;
$overdueCount = 0;

foreach ($data['borrowbook'] as $borrow) {
    if ($borrow['status'] === 'borrowed') {
        $borrowedCount++;
    } elseif ($borrow['status'] === 'overdue') {
        $overdueCount++;
    }
}
?>


<main class="main-content-area bg-blue-100 shadow-md">
    <div class="flex items-center justify-between pb-6 border-b border-blue-200 mb-8">
        <div class="flex items-center space-x-4">

        </div>
        <div class="flex items-center space-x-4">
            <a href="<?php echo URLROOT; ?>/admin/profile" class="flex items-center space-x-4 text-gray-700 hover:text-blue-600 transition duration-300">
                <i class="fas fa-user-circle text-2xl"></i>
                <span class="font-medium"><?= htmlspecialchars($name['name']) ?></span>
            </a>
        </div>
    </div>

    <!-- Statistical Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between transform transition duration-300 hover:scale-105">
            <div>
                <p class="text-gray-500 text-sm">Total Books</p>
                <p class="text-3xl font-bold text-blue-800"><? echo htmlspecialchars($totalbook) ?></p>
            </div>
            <i class="fas fa-book text-blue-400 text-4xl"></i>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between transform transition duration-300 hover:scale-105">
            <div>
                <p class="text-gray-500 text-sm">Borrowed Books</p>
                <p class="text-3xl font-bold text-yellow-600"><? echo htmlspecialchars($borrowedCount) ?></p>
            </div>
            <i class="fas fa-clipboard-check text-yellow-400 text-4xl"></i>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between transform transition duration-300 hover:scale-105">
            <div>
                <p class="text-gray-500 text-sm">Overdue Returns</p>
                <p class="text-3xl font-bold text-red-600"><? echo htmlspecialchars($overdueCount) ?></p>
            </div>
            <i class="fas fa-exclamation-triangle text-red-400 text-4xl"></i>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between transform transition duration-300 hover:scale-105">
            <div>
                <p class="text-gray-500 text-sm">Active Members</p>
                <p class="text-3xl font-bold text-green-600"><? echo htmlspecialchars($user) ?></p>
            </div>
            <i class="fas fa-user-friends text-green-400 text-4xl"></i>
        </div>
    </div>
    <!-- Quick Actions and Today's Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 flex-1">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-800 mb-6">Quick Actions</h3>
            <div class="grid grid-cols-2 gap-4">
                <button class="flex flex-col items-center justify-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg shadow-sm transition duration-300" onclick="window.location.href='<?php echo URLROOT; ?>/admin/addnewBook'">
                    <i class="fas fa-plus text-blue-600 text-2xl mb-2"></i>
                    <span class="text-blue-800 font-medium text-center">Add New Book</span>
                </button>
                <button class="flex flex-col items-center justify-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg shadow-sm transition duration-300" onclick="window.location.href='<?php echo URLROOT; ?>/admin/manageMember'">
                    <i class="fas fa-users text-blue-600 text-2xl mb-2"></i>
                    <span class="text-blue-800 font-medium text-center">View Member List</span>
                </button>
                <button class="flex flex-col items-center justify-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg shadow-sm transition duration-300" onclick="window.location.href='<?php echo URLROOT; ?>/admin/adminregister'">
                    <i class="fas fa-book-reader text-blue-600 text-2xl mb-2"></i>
                    <span class="text-blue-800 font-medium text-center">Add Admin </span>
                </button>
                <button class="flex flex-col items-center justify-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg shadow-sm transition duration-300" onclick="window.location.href='<?php echo URLROOT; ?>/admin/adminlist">
                    <i class="fas fa-undo text-blue-600 text-2xl mb-2"></i>
                    <span class="text-blue-800 font-medium text-center">View Admin List</span>
                </button>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">
                Today's Activity
            </h3>
            <p class="text-sm text-gray-500 mb-6">
                <?php echo date("l, F j, Y"); ?>
                <!-- Example: Wednesday, August 20, 2025 -->
            </p>

            <ul class="space-y-4 text-gray-700">
                <li class="flex items-center">
                    <i class="fas fa-user-plus text-green-500 mr-3"></i>
                    <span><?php echo htmlspecialchars($user) ?> New Members Register</span>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-book-open text-blue-500 mr-3"></i>
                    <span><?php echo htmlspecialchars($borrowedCount) ?> Books Borrowed</span>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-bell text-red-500 mr-3"></i>
                    <span><?php echo htmlspecialchars($overdueCount) ?> Overdue Warnings Sent</span>
                </li>
            </ul>
        </div>


    </div>
</main>
</div>

<!-- Logout Message Box
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

            // Function to show the message box
            function showMessageBox() {
                logoutMessageBox.classList.add('show');
            }

            // Function to hide the message box
            function hideMessageBox() {
                logoutMessageBox.classList.remove('show');
            }

            // Event listener for the logout button
            logoutButton.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default link behavior
                console.log('Logout initiated...');
                // In a real application, you would perform actual logout logic here,
                // e.g., clearing session storage, redirecting to a login page, etc.
                showMessageBox(); // Show the custom message box
            });

            // Event listener to close the message box
            closeMessageBox.addEventListener('click', hideMessageBox);

            // Close message box if clicked outside (optional)
            logoutMessageBox.addEventListener('click', function(event) {
                if (event.target === logoutMessageBox) {
                    hideMessageBox();
                }
            });
        });
    </script> -->
</body>

</html>