<?php require_once APPROOT . '/views/inc/sidebar.php'; ?>

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
        <h2 class="text-2xl font-bold text-gray-800">Reserved Book List</h2>
        <?php require APPROOT . '/views/components/auth_message.php'; ?>

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

                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book Title</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Available Quantity</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reserved Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (!empty($data['reservedBookList'])): ?>
                        <?php foreach ($data['reservedBookList'] as $book): ?>
                            <?php
                            $status = "unknown";
                            $statusClass = "text-gray-800 bg-gray-100"; // Default unknown status color
                            if ($book['available_quantity'] > 0) {
                                $status = "available";
                                $statusClass = "text-green-800 bg-green-100";
                            } elseif ($book['available_quantity'] == 0) {
                                $status = "pending";
                                $statusClass = "text-yellow-800 bg-yellow-100";
                            }
                            ?>
                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4 text-sm text-gray-900"><?= htmlspecialchars($book['user_name']) ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900"><?= htmlspecialchars($book['book_title']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($book['available_quantity']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($book['reserved_at']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $statusClass ?>">
                                        <?= htmlspecialchars($status) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <?php if ($book['available_quantity'] > 0): ?>
                                            <a href="<?= URLROOT ?>/ConfirmReservation/confirmreservation?user_id=<?= $book['user_id'] ?>&book_id=<?= $book['book_id'] ?>&available_quantity=<?= $book['available_quantity'] ?>"
                                                class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md text-xs transition duration-300">
                                                Confirm
                                            </a>
                                            <a href="<?= URLROOT ?>/ConfirmReservation/cancel?user_id=<?= $book['user_id'] ?>&book_id=<?= $book['book_id'] ?>"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs transition duration-300">
                                                Cancel
                                            </a>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Not Available
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">No reserved books found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="md:hidden space-y-4 overflow-y-auto max-h-[calc(100vh-250px)]">
            <?php if (!empty($data['reservedBookList'])): ?>
                <?php foreach ($data['reservedBookList'] as $book): ?>
                    <?php
                    $status = "unknown";
                    $statusClass = "text-gray-800 bg-gray-100"; // Default unknown status color
                    if ($book['available_quantity'] > 0) {
                        $status = "available";
                        $statusClass = "text-green-800 bg-green-100";
                    } elseif ($book['available_quantity'] == 0) {
                        $status = "pending";
                        $statusClass = "text-yellow-800 bg-yellow-100";
                    }
                    ?>
                    <div class="bg-gray-50 p-4 rounded-lg shadow border border-gray-200">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-lg font-bold text-gray-800"><?= htmlspecialchars($book['book_title']) ?></h3>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $statusClass ?>">
                                <?= htmlspecialchars($status) ?>
                            </span>
                        </div>
                        <p class="text-sm text-gray-700 mb-1"><strong>Member:</strong> <?= htmlspecialchars($book['user_name']) ?></p>
                        <p class="text-sm text-gray-700 mb-1"><strong>Quantity:</strong> <?= htmlspecialchars($book['available_quantity']) ?></p>
                        <p class="text-sm text-gray-700 mb-4"><strong>Reserved Date:</strong> <?= htmlspecialchars($book['reserved_at']) ?></p>

                        <div class="flex space-x-2">
                            <?php if ($book['available_quantity'] > 0): ?>
                                <a href="<?= URLROOT ?>/ConfirmReservation/confirmreservation?user_id=<?= $book['user_id'] ?>&book_id=<?= $book['book_id'] ?>&available_quantity=<?= $book['available_quantity'] ?>"
                                    class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md text-xs transition duration-300">
                                    Confirm
                                </a>
                                <a href="<?= URLROOT ?>/ConfirmReservation/cancel?user_id=<?= $book['user_id'] ?>&book_id=<?= $book['book_id'] ?>"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs transition duration-300">
                                    Cancel
                                </a>
                            <?php else: ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Not Available
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center py-4 text-gray-500">No reserved books found.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<script>
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