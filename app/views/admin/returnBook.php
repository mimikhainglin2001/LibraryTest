<?php require_once APPROOT . '/views/inc/sidebar.php'; ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR3authorization/lQfrg1Bw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<main class="main-content-area bg-blue-100 shadow-md">
    <div class="flex items-center justify-between pb-6 border-b border-blue-200 mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Returned Books</h2>
        <div class="flex items-center space-x-4">
            <a href="<?php echo URLROOT; ?>/admin/profile" class="flex items-center space-x-4 text-gray-700 hover:text-blue-600 transition duration-300">
                <i class="fas fa-user-circle text-2xl"></i>
                <span class="font-medium"><?php echo htmlentities($name['name']); ?></span>
            </a>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="hidden md:block overflow-y-auto max-h-[calc(100vh-250px)] rounded-lg shadow border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 sticky top-0 z-10">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>

                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrow Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Return Date</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (!empty($data['returnBookList'])): ?>
                        <?php foreach ($data['returnBookList'] as $book): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($book['id']) ?></td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($book['book_id']) ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900"><?= htmlspecialchars($book['name']) ?></td>
                                <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($book['title']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($book['borrow_date']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($book['return_date'] ?? '') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">No returned books found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="md:hidden space-y-4 overflow-y-auto max-h-[calc(100vh-250px)]">
            <?php if (!empty($data['returnBookList'])): ?>
                <?php foreach ($data['returnBookList'] as $book): ?>
                    <div class="bg-gray-50 p-4 rounded-lg shadow border border-gray-200">
                        <h3 class="text-lg font-bold text-gray-800 mb-2"><?= htmlspecialchars($book['title']) ?></h3>
                        <p class="text-sm text-gray-700 mb-1"><strong>Book ID:</strong> <?= htmlspecialchars($book['book_id']) ?></p>
                        <p class="text-sm text-gray-700 mb-1"><strong>Member:</strong> <?= htmlspecialchars($book['name']) ?></p>
                        <p class="text-sm text-gray-700 mb-1"><strong>Borrowed:</strong> <?= htmlspecialchars($book['borrow_date']) ?></p>
                        <p class="text-sm text-gray-700"><strong>Returned:</strong> <?= htmlspecialchars($book['return_date'] ?? 'N/A') ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center py-4 text-gray-500">No returned books found.</p>
            <?php endif; ?>
        </div>

        <div class="mt-8 flex justify-end">
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-full shadow-md transition duration-300" onclick="window.location.href='<?php echo URLROOT; ?>/admin/adminDashboard'">
                <i class="fas fa-arrow-left mr-2"></i>Back
            </button>
        </div>
    </div>
</main>