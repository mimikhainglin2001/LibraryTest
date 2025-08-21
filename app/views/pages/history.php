<?php
require_once __DIR__ . '/../../helpers/session_manager.php';
$session = new SessionManager();
require_once APPROOT . '/views/inc/header.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/librarycss/history.css?v=2">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
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

    .action-btn {
        display: inline-block;
        padding: 8px 14px;
        margin: 2px;
        font-size: 14px;
        font-weight: 500;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.25s ease, box-shadow 0.25s ease;
        text-align: center;
        text-decoration: none;
        color: #fff;
    }

    .action-btn.renew {
        background-color: #17a2b8;
    }

    .action-btn.return {
        background-color: yellowgreen;
        color: black;
    }

    .action-btn.overdue-btn {
        background-color: #dc3545;
        color: #fff;
    }

    .action-btn:hover {
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
        opacity: 0.9;
    }

    .action-btn.disabled {
        background-color: #ccc;
        color: #777;
        cursor: not-allowed;
        pointer-events: none;
    }

    .status {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 4px;
        font-weight: bold;
        color: #fff;
    }

    .status.borrowed {
        background-color: lightblue;
    }

    .status.returned {
        background-color: oldlace;
        color: #333;
    }

    .status.overdue {
        background-color: #dc3545;
    }

    .status.reserved {
        background-color: yellow;
        color: #333;
    }

    .status.renewed {
        background-color: #f7ec88ff;
        color: #fff;
    }

    .date-overdue {
        color: red;
        font-weight: bold;
    }

    /* Main content */
    .main-content {
        padding: 4rem 0;
    }

    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    .nav {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        background-color: rgba(30, 58, 138);
        padding: 5px 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        display: flex;
        list-style: none;
        gap: 5px;
        align-items: center;
        justify-content: flex-end;
        margin: 0;
    }

    .nav a {
        color: white;
        text-decoration: none;

        font-weight: 500;
        transition: opacity 0.3s;
        padding: 9px;
    }

    .nav a:hover {
        opacity: 0.8;
    }

    .user-icon1 {
        font-size: 20px;
        color: white;
        margin-left: 15px;
    }

    .user-name {
        color: white;
        font-weight: 500;
        margin-left: 10px;
    }
</style>

<body>
    <main class="main-content">
        <span> <?php require APPROOT . '/views/components/auth_message.php'; ?></span>

        <div class="container">

            <?php
            $overdueCount = 0;
            $currentlyBorrowed = 0;
            $totalBorrowed = 0;
            $returned = 0;
            $reservedCount = 0;
            $currentDate = new DateTime();

            foreach ($data['borrowedBooks'] as &$book) {
                if ($book['status'] !== 'returned' && $book['due_date'] !== null) {
                    $dueDate = new DateTime($book['due_date']);
                    if ($dueDate < $currentDate) {
                        $book['status'] = 'overdue';
                    }
                }

                if ($book['status'] === 'overdue') $overdueCount++;
                if ($book['status'] === 'borrowed') $currentlyBorrowed++;
                if ($book['status'] === 'returned') $returned++;
                if (in_array($book['status'], ['borrowed', 'returned', 'overdue'])) $totalBorrowed++;
            }
            unset($book);

            foreach ($data['reservedBooks'] as $book) {
                $reservedCount++;
            }
            ?>

            <?php if ($overdueCount > 0): ?>
                <div class="alert alert-warning">
                    ⚠️ You have <?= $overdueCount ?> overdue book<?= $overdueCount > 1 ? 's' : '' ?>.
                </div>
            <?php endif; ?>

            <div class="user-summary">
                <div class="summary-card">
                    <div class="summary-item">
                        <span class="summary-number"><?= $currentlyBorrowed ?></span>
                        <span class="summary-label">Currently Borrowed</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-number"><?= $totalBorrowed ?></span>
                        <span class="summary-label">Total Borrowed</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-number"><?= $returned ?></span>
                        <span class="summary-label">Returned</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-number"><?= $overdueCount ?></span>
                        <span class="summary-label">Overdue</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-number"><?= $reservedCount ?></span>
                        <span class="summary-label">Reserved</span>
                    </div>
                </div>
            </div>

            <div class="filter-section">
                <div class="search-box">
                    <input type="text" placeholder="Search..." id="searchInput">
                </div>
                <div class="filter-options">
                    <select id="statusFilter">
                        <option value="all">All Status</option>
                        <option value="borrowed">Currently Borrowed</option>
                        <option value="returned">Returned</option>
                        <option value="overdue">Overdue</option>
                        <option value="reserved">Reserved</option>
                        <option value="renewed">Renewed</option>
                    </select>
                </div>
            </div>

            <div class="history-section">
                <div class="table-container">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Book</th>
                                <th>Borrow Date</th>
                                <th>Due Date</th>
                                <th>Return Date</th>
                                <th>Renew Date</th>
                                <th>Renew Count</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['borrowedBooks'] as $book): ?>
                                <tr class="<?= $book['status'] === 'overdue' ? 'overdue-row' : '' ?>">
                                    <td>
                                        <img src="/<?= ltrim($book['image'] ?? 'images/default.png', '/') ?>" width="70">
                                        <div>
                                            <strong><?= htmlspecialchars($book['title']) ?></strong><br>
                                            ISBN: <?= htmlspecialchars($book['isbn']) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?= $book['borrow_date']
                                            ? (new DateTime($book['borrow_date']))->format('F, j, Y')
                                            : '-' ?>
                                    </td>
                                    <td class="<?= ($book['status'] === 'overdue') ? 'date-overdue' : '' ?>">
                                        <?= $book['due_date']
                                            ? (new DateTime($book['due_date']))->format('F, j, Y')
                                            : '-' ?>
                                    </td>
                                    <td>
                                        <?= $book['return_date']
                                            ? (new DateTime($book['return_date']))->format('F, j, Y')
                                            : '-' ?>
                                    </td>
                                    <td>
                                        <?= $book['renew_date']
                                            ? (new DateTime($book['renew_date']))->format('F, j, Y')
                                            : '-' ?>
                                    </td>
                                    <td><?= htmlspecialchars($book['renew_count'] ?? '0') ?></td>
                                    <td>
                                        <?php if ($book['status'] === 'overdue'): ?>
                                            <button class="action-btn overdue-btn">Overdue</button>
                                        <?php elseif ($book['status'] === 'renewed'): ?>
                                            <span class="status renewed">Renewed</span>
                                        <?php else: ?>
                                            <span class="status <?= $book['status'] ?>"><?= ucfirst($book['status']) ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($book['status'] !== 'returned'): ?>
                                            <?php
                                            $renewCount = (int)$book['renew_count'];
                                            $maxRenewals = 3;
                                            ?>

                                            <?php if ($renewCount >= $maxRenewals): ?>
                                                <button class="action-btn renew disabled" title="Maximum renewals reached.">Max Renewed</button>
                                            <?php else: ?>
                                                <button class="action-btn renew" title="Renew (<?= $renewCount ?>/3)">
                                                    <a href="/borrowBook/renew?id=<?= $book['id'] ?>&book_id=<?= $book['book_id'] ?>" style="text-decoration: none; color: inherit;">Renew</a>
                                                </button>
                                            <?php endif; ?>

                                            <button class="action-btn return" title="Return this book.">
                                                <a href="/borrowBook/returnBook?id=<?= $book['id'] ?>&book_id=<?= $book['book_id'] ?>" style="text-decoration: none; color: inherit;">Return</a>
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <?php foreach ($data['reservedBooks'] as $book): ?>
                                <tr>
                                    <td>
                                        <img src="/<?= ltrim($book['book_image'] ?? 'images/default.png', '/') ?>" width="70">
                                        <div>
                                            <strong><?= htmlspecialchars($book['book_title']) ?></strong><br>
                                            ISBN: <?= htmlspecialchars($book['book_isbn']) ?>
                                        </div>
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td><span class="status reserved">Reserved</span></td>
                                    <td>
                                        <button class="action-btn return">
                                            <a href="/Reservation/cancelReservation?id=<?= $book['id'] ?>" style="text-decoration: none; color: inherit;">Cancel Reservation</a>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="navigation">
                <a href="<?= URLROOT; ?>/pages/category" class="back-btn">Back</a>
            </div>

        </div>
    </main>

    <script>
        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');

        let debounceTimeout;

        function filterRows() {
            const searchValue = searchInput.value.toLowerCase();
            const statusValue = statusFilter.value;

            document.querySelectorAll('.history-table tbody tr').forEach(row => {
                const title = row.querySelector('td div strong')?.textContent.toLowerCase() || '';
                const statusElement = row.querySelector('.status, .action-btn.overdue-btn');
                const status = statusElement ? statusElement.textContent.toLowerCase() : '';

                const matchesSearch = title.includes(searchValue);
                const matchesStatus = (statusValue === 'all') || (status === statusValue);

                row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
            });
        }

        function debounceFilter() {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(filterRows, 300);
        }

        searchInput.addEventListener('input', debounceFilter);
        statusFilter.addEventListener('change', filterRows);
    </script>
</body>

</html>