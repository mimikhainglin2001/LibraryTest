<?php require_once APPROOT . '/views/inc/sidebar.php'; ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR3authorization/lQfrg1Bw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<main class="main-content-area bg-blue-100 shadow-md">
    <div class="flex items-center justify-between pb-6 border-b border-blue-200 mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Borrow Book List</h2>
        <div class="flex items-center space-x-4">
            <a href="<?php echo URLROOT; ?>/admin/profile" class="flex items-center space-x-4 text-gray-700 hover:text-blue-600 transition duration-300">
                <i class="fas fa-user-circle text-2xl"></i>
                <span class="font-medium"><?php echo htmlspecialchars($name['name']); ?></span>
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
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ISBN</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrow Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Renew Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (!empty($data['borrowBookList'])): ?>
                        <?php foreach ($data['borrowBookList'] as $book): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($book['id'] ?? '') ?></td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($book['book_id'] ?? '') ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($book['isbn'] ?? '') ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900"><?= htmlspecialchars($book['name'] ?? '') ?></td>
                                <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($book['title'] ?? '') ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($book['borrow_date'] ?? '') ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($book['due_date'] ?? '') ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($book['renew_date'] ?? '-') ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <?php
                                    $now = date('Y-m-d H:i:s');
                                    $statusOutput = '';
                                    if (!empty($book['return_date'])) {
                                        $statusOutput = '<span class="bg-green-100 text-green-700 text-sm px-3 py-1 rounded-full font-semibold">Returned</span>';
                                    } elseif (!empty($book['due_date']) && $now > $book['due_date']) {
                                        $statusOutput = '<span class="bg-red-100 text-red-700 text-sm px-3 py-1 rounded-full font-semibold">Overdue</span>';
                                    } else {
                                        $statusOutput = '<span class="bg-yellow-100 text-yellow-700 text-sm px-3 py-1 rounded-full font-semibold">Borrowed</span>';
                                    }
                                    echo $statusOutput;
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">No borrowed books found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="md:hidden space-y-4 overflow-y-auto max-h-[calc(100vh-250px)]">
            <?php if (!empty($data['borrowBookList'])): ?>
                <?php foreach ($data['borrowBookList'] as $book): ?>
                    <div class="bg-gray-50 p-4 rounded-lg shadow border border-gray-200">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-lg font-bold text-gray-800"><?= htmlspecialchars($book['title'] ?? '') ?></h3>
                            <?php
                            $now = date('Y-m-d H:i:s');
                            $statusOutput = '';
                            if (!empty($book['return_date'])) {
                                $statusOutput = '<span class="bg-green-100 text-green-700 text-sm px-3 py-1 rounded-full font-semibold">Returned</span>';
                            } elseif (!empty($book['due_date']) && $now > $book['due_date']) {
                                $statusOutput = '<span class="bg-red-100 text-red-700 text-sm px-3 py-1 rounded-full font-semibold">Overdue</span>';
                            } else {
                                $statusOutput = '<span class="bg-yellow-100 text-yellow-700 text-sm px-3 py-1 rounded-full font-semibold">Borrowed</span>';
                            }
                            echo $statusOutput;
                            ?>
                        </div>
                        <p class="text-sm text-gray-700 mb-1"><strong>Book ID:</strong> <?= htmlspecialchars($book['book_id'] ?? '') ?></p>
                        <p class="text-sm text-gray-700 mb-1"><strong>ISBN:</strong> <?= htmlspecialchars($book['isbn'] ?? '') ?></p>
                        <p class="text-sm text-gray-700 mb-1"><strong>Member:</strong> <?= htmlspecialchars($book['name'] ?? '') ?></p>
                        <p class="text-sm text-gray-700 mb-1"><strong>Borrow Date:</strong> <?= htmlspecialchars($book['borrow_date'] ?? '') ?></p>
                        <p class="text-sm text-gray-700 mb-1"><strong>Due Date:</strong> <?= htmlspecialchars($book['due_date'] ?? '') ?></p>
                        <p class="text-sm text-gray-700 mb-4"><strong>Renew Date:</strong> <?= htmlspecialchars($book['renew_date'] ?? '-') ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center py-4 text-gray-500">No borrowed books found.</p>
            <?php endif; ?>
        </div>
    </div>
</main>
</div>

</body>

</html>