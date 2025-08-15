<?php require_once APPROOT . '/views/inc/sidebar.php'; 
// var_dump($data);die();
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR3authorization/lQfrg1Bw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<main class="main-content-area bg-blue-100 shadow-md">
    <div class="flex items-center justify-between pb-6 border-b border-blue-200 mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Book List</h2>
        <div class="flex items-center space-x-4">
            <a href="<?php echo URLROOT; ?>/admin/profile" class="flex items-center space-x-4 text-gray-700 hover:text-blue-600 transition duration-300">
                <i class="fas fa-user-circle text-2xl"></i>
                <span class="font-medium"><?php echo htmlspecialchars($name['name']); ?></span>
            </a>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-end mb-4">
            <a href="<?php echo URLROOT; ?>/admin/addNewBook" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-full shadow-md transition duration-300">
                Add New Book 📚
            </a>
        </div>
        
        <div class="table-scroll-container">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="border px-4 py-2">Book ID</th>
                        <th class="border px-4 py-2">ISBN</th>
                        <th class="border px-4 py-2">Title</th>
                        <th class="border px-4 py-2">Author Name</th>
                        <th class="border px-4 py-2">Total Quantity</th>
                        <th class="border px-4 py-2">Available Quantity</th>
                        <th class="border px-4 py-2">Status Description</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">  
    <?php if (!empty($data['booklist'])): ?>
        <?php foreach ($data['booklist'] as $book): ?>
            <tr>
                <td class="table-cell book-id border px-4 py-2"><?= htmlspecialchars($book['id'] ?? '') ?></td>
                <td class="table-cell book-isbn border px-4 py-2"><?= htmlspecialchars($book['isbn'] ?? '') ?></td>
                <td class="table-cell book-title border px-4 py-2"><?= htmlspecialchars($book['title'] ?? '') ?></td>
                <td class="table-cell book-author border px-4 py-2"><?= htmlspecialchars($book['author_name'] ?? '') ?></td>
                <td class="table-cell book-author border px-4 py-2"><?= htmlspecialchars((string)($book['total_quantity'] ?? '')) ?></td>
                <td class="table-cell book-quantity border px-4 py-2"><?= htmlspecialchars($book['available_quantity'] ?? '') ?></td>
                <td class="table-cell book-status border px-4 py-2">
                    <?php
                    $statusText = isset($book['status_description']) ? trim(strtolower($book['status_description'])) : '';
                    $statusClass = $statusText === 'available' ? 'text-green-600' : 'text-red-600';
                    ?>
                    <span class="status <?= $statusClass ?>">
                        <?= $statusText ? htmlspecialchars(ucfirst($statusText)) : 'Unknown' ?>
                    </span>
                </td>
                <td class="table-cell border px-4 py-2">
                    <div class="flex space-x-2">
                        <button class="view-details-button bg-blue-500 text-white px-3 py-1 rounded"
                            data-id="<?= $book['id'] ?>"
                            data-title="<?= htmlspecialchars($book['title'] ?? '') ?>"
                            data-author="<?= htmlspecialchars($book['author_name'] ?? '') ?>"
                            data-isbn="<?= htmlspecialchars($book['isbn'] ?? '') ?>"
                            data-quantity="<?= htmlspecialchars($book['total_quantity'] ?? '') ?>"
                            data-status="<?= htmlspecialchars($book['status_description'] ?? '') ?>">
                            Details
                        </button>
                        <button class="edit-button bg-yellow-500 text-white px-3 py-1 rounded"
                            data-id="<?= $book['id'] ?>"
                            data-title="<?= htmlspecialchars($book['title'] ?? '') ?>"
                            data-author="<?= htmlspecialchars($book['author_name'] ?? '') ?>"
                            data-isbn="<?= htmlspecialchars($book['isbn'] ?? '') ?>"
                            data-quantity="<?= htmlspecialchars($book['total_quantity'] ?? '') ?>"
                            data-status="<?= htmlspecialchars($book['status_description'] ?? '') ?>">
                            Edit
                        </button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="8" class="text-center py-4 text-gray-500">No books found.</td>
        </tr>
    <?php endif; ?>
</tbody>

            </table>
        </div>
        
    </div>
</main>
</div>

<div id="logoutMessageBox" class="message-box-overlay">
    <div class="message-box-content">
        <h4 class="text-2xl font-bold text-gray-800 mb-4">Logged Out Successfully!</h4>
        <p class="text-gray-600 mb-6">You have been successfully logged out of the admin dashboard.</p>
        <button id="closeMessageBox" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-full transition duration-300">
            OK
        </button>
    </div>
</div>

<div id="viewDetailsMessageBox" class="fixed inset-0 z-50 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <h2 class="text-xl font-bold mb-4">Book Details</h2>
        <ul class="space-y-2 text-gray-800">
            <li><strong>ID:</strong> <span id="viewBookId"></span></li>
            <li><strong>ISBN:</strong> <span id="viewBookISBN"></span></li>
            <li><strong>Title:</strong> <span id="viewBookTitle"></span></li>
            <li><strong>Author:</strong> <span id="viewBookAuthor"></span></li>
            <li><strong>Quantity:</strong> <span id="viewBookQuantity"></span></li>
            <li><strong>Status:</strong> <span id="viewBookStatus"></span></li>
        </ul>
        <div class="mt-6 text-right">
            <button id="closeViewDetailsButton" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Close</button>
        </div>
    </div>
</div>

<div id="editModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-[500px] max-w-full">
        <h2 class="text-xl font-bold mb-4">Edit Book</h2>
        <form id="editForm" method="POST">
            <input type="hidden" id="editId" name="id">

                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($data['csrf_token']); ?>">

            <div class="mb-4">
                <label for="editTitle" class="block text-sm font-medium mb-1">Title</label>
                <input type="text" id="editTitle" name="title" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label for="editAuthor" class="block text-sm font-medium mb-1">Author</label>
                <input type="text" id="editAuthor" name="author_name" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label for="editISBN" class="block text-sm font-medium mb-1">ISBN</label>
                <input type="text" id="editISBN" name="isbn" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label for="editQuantity" class="block text-sm font-medium mb-1">Total Quantity</label>
                <input type="number" id="editQuantity" name="total_quantity" class="w-full border rounded px-3 py-2" required min="1">
            </div>

            <div class="mb-6">
                <label for="editStatus" class="block text-sm font-medium mb-1">Status</label>
                <input type="text" id="editStatus" name="status_description" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Cancel</button>
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Details button logic
    const detailsButtons = document.querySelectorAll('.view-details-button');
    const viewDetailsMessageBox = document.getElementById('viewDetailsMessageBox');

    detailsButtons.forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('viewBookId').textContent = button.dataset.id;
            document.getElementById('viewBookISBN').textContent = button.dataset.isbn;
            document.getElementById('viewBookTitle').textContent = button.dataset.title;
            document.getElementById('viewBookAuthor').textContent = button.dataset.author;
            document.getElementById('viewBookQuantity').textContent = button.dataset.quantity;
            document.getElementById('viewBookStatus').textContent = button.dataset.status;

            openModal('viewDetailsMessageBox');
        });
    });

    document.getElementById('closeViewDetailsButton').addEventListener('click', () => {
        closeModal('viewDetailsMessageBox');
    });

    viewDetailsMessageBox.addEventListener('click', (event) => {
        if (event.target === viewDetailsMessageBox) {
            closeModal('viewDetailsMessageBox');
        }
    });

    // Open and close modal helper functions
    function openModal(id) {
        const modal = document.getElementById(id);
        if (modal) modal.classList.remove('hidden');
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        if (modal) modal.classList.add('hidden');
    }

    // Edit modal logic
    const editButtons = document.querySelectorAll('.edit-button');

    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('editId').value = button.dataset.id;
            document.getElementById('editTitle').value = button.dataset.title;
            document.getElementById('editAuthor').value = button.dataset.author;
            document.getElementById('editISBN').value = button.dataset.isbn;
            document.getElementById('editQuantity').value = button.dataset.quantity;
            document.getElementById('editStatus').value = button.dataset.status;

            openModal('editModal');
        });
    });

    document.getElementById('editForm').addEventListener('submit', function(event) {
        const id = document.getElementById('editId').value;
        this.action = "<?php echo URLROOT; ?>/book/editBook/" + id;
    });

    // Close edit modal when clicking outside
    document.getElementById('editModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeModal('editModal');
        }
    });
</script>