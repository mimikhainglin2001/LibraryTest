<?php
require_once __DIR__ . '/../../helpers/session_manager.php';
$session = new SessionManager();
require_once APPROOT . '/views/inc/header.php';

// Start the session only if it hasn't been started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get and clear the modal type from session to avoid showing it multiple times
$modalData = $_SESSION['modal'] ?? null;
unset($_SESSION['modal']); // Clear it immediately after reading

// Prepare modal data for JavaScript
$modalType = $modalData['type'] ?? 'none';    // 'success' or 'error'
$modalMessage = $modalData['message'] ?? ''; // The actual message text
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        /* font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; */
        line-height: 1.6;
        color: #333;
        background-color: #f8f9fa;
    }

    .main-content {
        min-height: 100vh;
        padding-top: 80px;
    }

    /* Hero Section */
    .hero-section {
        position: relative;
        background: #393b41ff;
        padding: 60px 0;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        /* background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="books" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><rect width="20" height="20" fill="none"/><path d="M2 2h16v16H2z" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23books)"/></svg>') repeat; */
        opacity: 0.1;
    }

    .hero-image {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .hero-image img {
        width: 100%;
        height: 120%;
        object-fit: cover;
        opacity: 0.3;
    }

    .search-section {
        position: relative;
        z-index: 2;
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .search-section h1 {
        color: white;
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 30px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        animation: fadeInUp 1s ease-out;
    }

    .search-container {
        animation: fadeInUp 1s ease-out 0.3s both;
    }

    .search-box {
        max-width: 500px;
        margin: 0 auto;
        position: relative;
    }

    .search-input {
        width: 100%;
        padding: 15px 50px 15px 20px;
        border: none;
        border-radius: 50px;
        font-size: 1.1rem;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        background: white;
    }

    .search-box::after {
        content: '\f002';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
        font-size: 1.2rem;
    }

    /* Book Listing Section */
    .book-listing {
        padding: 80px 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .book-listing h2 {
        text-align: center;
        font-size: 2.5rem;
        color: #333;
        margin-bottom: 50px;
        position: relative;
    }

    .book-listing h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 2px;
    }

    /* Books Grid */
    .books-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        padding: 0;
        list-style: none;
    }

    .book-item {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        text-align: center;
        display: flex;
        flex-direction: column;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .book-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    /* Direct image styling - no wrapper */
    .book-item img {
        width: 100%;
        height: 200px;
        object-fit: contain;
        display: block;
        background-color: #f0f0f0;
        padding: 10px;
        box-sizing: border-box;
    }

    .book-info {
        padding: 0 15px 15px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .book-info span {
        font-size: 1.3rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 8px;
        display: block;
    }

    .book-info p {
        font-size: 0.95rem;
        color: #555;
        margin: 4px 0;
    }

    .book-info p.total-quantity,
    .book-info p.available-quantity {
        font-weight: bold;
    }

    .book-info span:last-of-type {
        font-size: 1rem;
        color: #007bff;
        margin-top: 5px;
        margin-bottom: 10px;
        display: block;
    }

    .rating {
        margin: 10px 0;
        color: #ffc107;
        font-size: 1.1rem;
    }

    .rating .rating-text {
        color: #555;
        font-size: 0.9rem;
        margin-left: 5px;
    }

    .borrow-btn {
        margin-top: auto;
        padding: 12px 25px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
        font-weight: bold;
        transition: background-color 0.3s ease, transform 0.1s ease;
        width: calc(100% - 30px);
        margin-left: 15px;
        margin-right: 15px;
        margin-bottom: 15px;
        background-color: #28a745;
        color: #fff;
    }

    .borrow-btn:hover {
        background-color: #218838;
        transform: translateY(-1px);
    }

    .borrow-btn:disabled {
        background-color: #6c757d;
        cursor: not-allowed;
        transform: none;
        opacity: 0.7;
    }

    .borrow-btn:disabled:hover {
        background-color: #6c757d;
        transform: none;
    }

    .borrow-btn.reserve-btn {
        background-color: #007bff;
    }

    .borrow-btn.reserve-btn:hover {
        background-color: #0056b3;
        transform: translateY(-1px);
    }

    .borrow-btn.borrowed-by-user {
        background-color: #ffc107;
        color: #212529;
        cursor: not-allowed;
    }

    .borrow-btn.borrowed-by-user:hover {
        background-color: #ffc107;
        transform: none;
    }

    .image-placeholder {
        display: none;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 200px;
        color: #777;
        font-size: 1rem;
        background-color: #f8f8f8;
        padding: 10px;
        box-sizing: border-box;
    }

    .image-placeholder.show {
        display: flex;
    }

    .placeholder-icon {
        font-size: 4rem;
        margin-bottom: 10px;
    }

    .placeholder-text {
        font-style: italic;
        color: #555;
    }

    .hidden-book {
        display: none;
    }

    .no-results-message {
        display: none;
        font-size: 1.2rem;
        color: #888;
        padding: 30px;
        border: 1px dashed #ccc;
        border-radius: 8px;
        margin-top: 30px;
        background-color: #f9f9f9;
        text-align: center;
        grid-column: 1 / -1;
    }

    /* Navigation */
    .navigation {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        max-width: 1200px;
        margin: 40px auto 0;
        padding: 30px 20px;
        border-top: 2px solid #e9ecef;
    }

    .back-btn,
    .see-more-btn {
        background: linear-gradient(135deg, #6c757d, #5a6268);
        color: white;
        padding: 12px 25px;
        border-radius: 25px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
    }

    .back-btn:hover,
    .see-more-btn:hover {
        background: linear-gradient(135deg, #5a6268, #495057);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(108, 117, 125, 0.4);
    }

    .back-btn::before {
        content: '\f060';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
    }

    .see-more-btn {
        background: linear-gradient(135deg, #17a2b8, #138496);
    }

    .see-more-btn:hover {
        background: linear-gradient(135deg, #138496, #117a8b);
    }

    /* Modal Styles */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-box {
        background: #fff;
        padding: 25px 30px;
        border-radius: 10px;
        max-width: 400px;
        width: 90%;
        text-align: center;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .modal-actions {
        margin-top: 20px;
        display: flex;
        justify-content: space-around;
    }

    .modal-btn {
        padding: 10px 20px;
        font-size: 1rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }

    .modal-btn.yes {
        background-color: #28a745;
        color: white;
    }

    .modal-btn.no {
        background-color: #dc3545;
        color: white;
    }

    /* Custom Alert */
    .custom-alert {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 8px;
        color: white;
        font-weight: bold;
        z-index: 1000;
        max-width: 300px;
        word-wrap: break-word;
        opacity: 0;
        transform: translateX(100%);
        transition: all 0.3s ease;
        display: none;
    }

    .custom-alert.success {
        background-color: #28a745;
        border-left: 5px solid #155724;
    }

    .custom-alert.error {
        background-color: #dc3545;
        border-left: 5px solid #721c24;
    }

    .custom-alert.warning {
        background-color: #ffc107;
        border-left: 5px solid #856404;
        color: #212529;
    }

    .custom-alert.show {
        opacity: 1;
        transform: translateX(0);
        display: block;
    }

    .custom-alert .close-btn {
        float: right;
        margin-left: 10px;
        cursor: pointer;
        font-size: 18px;
        line-height: 1;
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section {
            padding: 40px 0;
        }

        .search-section h1 {
            font-size: 2.2rem;
            margin-bottom: 20px;
        }

        .book-listing {
            padding: 60px 15px;
        }

        .book-listing h2 {
            font-size: 2rem;
            margin-bottom: 30px;
        }

        .books-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .book-item img {
            width: 140px;
            height: 200px;
        }

        .image-placeholder {
            width: 140px;
            height: 200px;
        }

        .navigation {
            padding: 20px 15px;
            margin-top: 30px;
        }

        .back-btn,
        .see-more-btn {
            padding: 10px 20px;
            font-size: 0.9rem;

        }
    }

    @media (max-width: 480px) {
        .search-section h1 {
            font-size: 1.8rem;
        }

        .search-input {
            padding: 12px 40px 12px 15px;
            font-size: 1rem;
        }

        .book-listing h2 {
            font-size: 1.6rem;
        }

        .books-grid {
            grid-template-columns: 1fr;
            gap: 25px;
        }

        .book-item img {
            width: 180px;
            height: 240px;
        }

        .image-placeholder {
            width: 180px;
            height: 240px;
        }

        .navigation {
            justify-content: center;
            flex-direction: column;
            gap: 15px;
        }
    }
</style>

<main class="main-content">
    <section class="hero-section">
        <div class="hero-image">
            <img src="https://images.unsplash.com/photo-1529148482759-b35b25c5f217?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Library books">
        </div>
        <div class="search-section">
            <h1>Find The Book You Love</h1>
            <div class="search-container">
                <div class="search-box">
                    <input type="text" placeholder="Search by title, author, or ISBN..." class="search-input" id="searchInput">
                </div>
            </div>
        </div>
    </section>

    <span><?php require APPROOT . '/views/components/auth_message.php'; ?></span>

    <section class="book-listing">
        <h2>Education/References Books Listed</h2>
        <div class="books-grid" id="booksGrid">
            <?php if (!empty($data['educationBooks'])): ?>
                <?php foreach ($data['educationBooks'] as $index => $book): ?>
                    <?php
                    // Determine if the book is borrowed by the current user
                    $isBorrowedByUser = isset($book['is_borrowed_by_user']) && $book['is_borrowed_by_user'];
                    $buttonClass = '';
                    $buttonText = 'BORROW';
                    $buttonDisabled = '';

                    if ($isBorrowedByUser) {
                        $buttonClass = ' borrowed-by-user';
                        $buttonText = 'ALREADY BORROWED';
                        $buttonDisabled = 'disabled';
                    } elseif ((int) ($book['available_quantity'] ?? 0) <= 0) {
                        $buttonClass = ' reserve-btn';
                        $buttonText = 'RESERVE';
                    }
                    ?>
                    <div class="book-item <?= $index >= 6 ? 'hidden-book' : '' ?>"
                        data-book-title="<?= htmlspecialchars(strtolower($book['title'])) ?>"
                        data-book-author="<?= htmlspecialchars(strtolower($book['author_name'])) ?>"
                        data-book-isbn="<?= htmlspecialchars(strtolower($book['isbn'])) ?>"
                        data-is-borrowed="<?= $isBorrowedByUser ? 'true' : 'false' ?>">

                        <?php
                        $imagePath = $book['image'] ?? '';
                        $imageUrl = '';
                        if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                            $imageUrl = $imagePath;
                        } elseif (!empty($imagePath)) {
                            $cleanPath = ltrim($imagePath, '/');
                            $imageUrl = URLROOT . '/' . $cleanPath;
                        }
                        ?>

                        <?php if (!empty($imageUrl)): ?>
                            <img src="<?= htmlspecialchars($imageUrl) ?>"
                                alt="<?= htmlspecialchars($book['title']) ?> Cover"
                                onerror="this.style.display='none'; this.nextElementSibling.classList.add('show');" />
                        <?php endif; ?>

                        <div class="image-placeholder <?= empty($imageUrl) ? 'show' : '' ?>">
                            <div class="placeholder-icon">📚</div>
                            <div class="placeholder-text"><?= htmlspecialchars(strlen($book['title']) > 20 ? substr($book['title'], 0, 20) . '...' : $book['title']) ?></div>
                        </div>

                        <div class="book-info">
                            <span><?= htmlspecialchars($book['title']) ?></span>
                            <p class="author">Author: <?= htmlspecialchars($book['author_name']) ?></p>
                            <p class="isbn">ISBN: <?= htmlspecialchars($book['isbn']) ?></p>
                            <p class="total-quantity">Total Quantity: <?= htmlspecialchars($book['total_quantity']) ?></p>
                            <p class="available-quantity">Available Quantity: <?= htmlspecialchars($book['available_quantity'] ?? '0') ?></p>
                            <span><?= htmlspecialchars($book['status_description'] ?? 'N/A') ?></span>

                            <div class="rating">
                                <span class="stars">★★★★☆</span>
                                <span class="rating-text">4.5</span>
                            </div>

                            <button class="borrow-btn<?= $buttonClass ?>"
                                data-book-id="<?= htmlspecialchars($book['id']) ?>"
                                data-book-title="<?= htmlspecialchars($book['title']) ?>"
                                data-book-author="<?= htmlspecialchars($book['author_name']) ?>"
                                data-borrow-url="<?= URLROOT; ?>/BorrowBook/borrow?id=<?= htmlspecialchars($book['id']) ?>"
                                data-reserve-url="<?= URLROOT; ?>/Reservation/reserve?id=<?= htmlspecialchars($book['id']) ?>"
                                data-is-borrowed="<?= $isBorrowedByUser ? 'true' : 'false' ?>"
                                <?= $buttonDisabled ?>>
                                <?= $buttonText ?>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="text-align: center; width: 100%; grid-column: 1 / -1;">No romance books are available at the moment. Please check back later!</p>
            <?php endif; ?>
        </div>

        <div class="no-results-message" id="noResultsMessage">
            No books found matching your search.
        </div>

        <div class="navigation">
            <a href="<?= URLROOT; ?>/pages/category" class="back-btn">Back</a>
            <button class="see-more-btn" id="seeMoreBtn">See More Books</button>
        </div>
    </section>
</main>

<div id="confirmModal" style="display: none;" class="modal-overlay">
    <div class="modal-box">
        <p id="confirmMessage"></p>
        <div class="modal-actions">
            <button id="confirmYes" class="modal-btn yes">Confirm</button>
            <button id="confirmNo" class="modal-btn no">Cancel</button>
        </div>
    </div>
</div>

<div id="user-data" data-borrow-count="<?= $borrowCount ?>"></div>

<div id="customAlert" class="custom-alert">
    <span id="customAlertMessage"></span>
    <span class="close-btn" onclick="this.parentElement.classList.remove('show'); this.parentElement.style.display='none';">&times;</span>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // --- DOM Elements ---
        const searchInput = document.getElementById('searchInput');
        const noResultsMessage = document.getElementById('noResultsMessage');
        const seeMoreBtn = document.getElementById('seeMoreBtn');
        const booksGrid = document.getElementById('booksGrid');
        const bookItems = booksGrid ? booksGrid.querySelectorAll('.book-item') : [];

        const initialDisplayCount = 6;
        const loadMoreCount = 6;
        let currentlyDisplayed = initialDisplayCount;

        // --- Update Book Visibility ---
        function updateBookVisibility() {
            bookItems.forEach((item, index) => {
                if (index < currentlyDisplayed) {
                    item.classList.remove('hidden-book');
                } else {
                    item.classList.add('hidden-book');
                }
            });

            if (seeMoreBtn) {
                seeMoreBtn.style.display = (currentlyDisplayed >= bookItems.length) ? 'none' : 'block';
            }
        }

        // --- Filter Books by Search ---
        function filterBooks() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            let foundBooksCount = 0;

            bookItems.forEach(item => {
                const title = item.dataset.bookTitle?.toLowerCase() || '';
                const author = item.dataset.bookAuthor?.toLowerCase() || '';
                const isbn = item.dataset.bookIsbn?.toLowerCase() || '';

                const matches = (
                    searchTerm === '' ||
                    title.includes(searchTerm) ||
                    author.includes(searchTerm) ||
                    isbn.includes(searchTerm)
                );

                item.classList.toggle('hidden-book', !matches);

                if (matches) foundBooksCount++;
            });

            if (noResultsMessage) {
                noResultsMessage.style.display = (searchTerm !== '' && foundBooksCount === 0) ? 'block' : 'none';
            }

            if (seeMoreBtn) {
                if (searchTerm !== '') {
                    seeMoreBtn.style.display = 'none';
                } else {
                    currentlyDisplayed = initialDisplayCount;
                    updateBookVisibility();
                }
            }
        }

        // --- Search Events ---
        if (searchInput) {
            searchInput.addEventListener('keyup', (event) => {
                if (event.key === 'Enter') filterBooks();
            });
            searchInput.addEventListener('input', filterBooks);
        }

        // --- See More Button ---
        if (seeMoreBtn) {
            seeMoreBtn.addEventListener('click', () => {
                currentlyDisplayed += loadMoreCount;
                updateBookVisibility();
            });
        }

        // --- Initialize Books on Load ---
        updateBookVisibility();

        // --- PHP Passed Alert Modal ---
        const initialModalType = "<?= $modalType ?>";
        const initialModalMessage = "<?= htmlspecialchars($modalMessage) ?>";
        if (initialModalType !== 'none' && initialModalMessage) {
            showAlert(initialModalType, initialModalMessage);
        }

        // --- Custom Alert Logic ---
        const customAlert = document.getElementById('customAlert');
        const customAlertMessage = document.getElementById('customAlertMessage');

        function showAlert(type, message, duration = 5000) {
            if (!customAlert || !customAlertMessage) return;

            customAlert.className = 'custom-alert';
            customAlert.classList.add(type);
            customAlertMessage.textContent = message;

            customAlert.style.display = 'block';
            customAlert.classList.add('show');

            setTimeout(() => {
                customAlert.classList.remove('show');
                setTimeout(() => {
                    customAlert.style.display = 'none';
                }, 300);
            }, duration);
        }

        // --- Confirmation Modal Logic ---
        const confirmModal = document.getElementById('confirmModal');
        const confirmMessage = document.getElementById('confirmMessage');
        const confirmYes = document.getElementById('confirmYes');
        const confirmNo = document.getElementById('confirmNo');
        let confirmAction = null;

        function showConfirm(message, onConfirm) {
            confirmMessage.textContent = message;
            confirmModal.style.display = 'flex';
            confirmAction = onConfirm;
        }

        function hideConfirm() {
            confirmModal.style.display = 'none';
            confirmAction = null;
        }

        confirmYes?.addEventListener('click', () => {
            if (confirmAction) confirmAction();
            hideConfirm();
        });

        confirmNo?.addEventListener('click', hideConfirm);

        // --- Borrow / Reserve Buttons ---
        document.querySelectorAll('.borrow-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const bookTitle = btn.dataset.bookTitle;
                const bookAuthor = btn.dataset.bookAuthor;
                const isBorrowed = btn.dataset.isBorrowed === 'true';

                if (isBorrowed || btn.disabled || btn.classList.contains('borrowed-by-user')) {
                    showAlert('warning', `You have already borrowed "${bookTitle}" by ${bookAuthor}.`, 4000);
                    return;
                }

                if (btn.classList.contains('reserve-btn')) {
                    showConfirm(`Do you want to reserve "${bookTitle}" by ${bookAuthor}?`, () => {
                        window.location.href = btn.dataset.reserveUrl;
                    });
                } else {
                    showConfirm(`Do you want to borrow "${bookTitle}" by ${bookAuthor}?`, () => {
                        window.location.href = btn.dataset.borrowUrl;
                    });
                }
            });
        });
    });
</script>