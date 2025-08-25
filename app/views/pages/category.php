<?php
require_once __DIR__ . '/../../helpers/session_manager.php';
$session = new SessionManager();
require_once APPROOT . '/views/inc/header.php'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', Helvetica, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }
        .main-content { min-height: 100vh; padding-top: 80px; }

        /* Hero Section */
        .hero-section {
            position: relative;
            background: #393b41ff;
            padding: 60px 0;
            overflow: hidden;
        }
        .hero-image {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
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
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            animation: fadeInUp 1s ease-out;
        }
        .search-container { animation: fadeInUp 1s ease-out 0.3s both; }
        .search-box { max-width: 500px; margin: 0 auto; position: relative; }
        .search-input {
            width: 100%;
            padding: 15px 50px 15px 20px;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }
        .search-input:focus {
            outline: none;
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
            background: white;
        }

        /* Categories Section */
        .categories-section {
            padding: 80px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .categories-section h2 {
            text-align: center;
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 50px;
            position: relative;
        }
        .categories-section h2::after {
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

        /* Books Grid - 3 columns desktop */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(3, 200px);
            justify-content: center;
            gap: 60px 120px;
            margin-top: 20px;
        }
        .book-category {
            width: 200px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .book-category img {
            width: 100%;
            height: 240px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }
        .book-category img:hover {
            transform: scale(1.05);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }
        .book-category p {
            margin-top: 6px;
            font-weight: 600;
            font-size: 1.05rem;
            color: #333;
        }
        .book-category:hover p { color: #667eea; }

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
        .back-btn {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            color: white;
            padding: 12px 25px;
            border-radius: 25px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 5px 15px rgba(108,117,125,0.3);
            transition: all 0.3s ease;
        }
        .back-btn:hover { transform: translateY(-2px); }

        /* Animations */
        @keyframes fadeInUp { from { opacity:0; transform: translateY(30px); } to { opacity:1; transform:translateY(0); } }
        @keyframes fadeIn { to { opacity:1; } }

        /* Responsive */
        @media (max-width: 768px) {
            .books-grid { grid-template-columns: repeat(2, 180px); gap: 12px 16px; }
            .book-category { width: 180px; }
            .book-category img { height: 220px; }
        }
        @media (max-width: 480px) {
            .books-grid { grid-template-columns: 1fr; gap: 12px; justify-content: center; }
            .book-category { width: 180px; }
            .book-category img { width: 180px; height: 240px; margin: 0 auto 8px; }
        }
    </style>
</head>

<body>
    <main class="main-content">
        <span><?php require APPROOT . '/views/components/auth_message.php'; ?></span>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-image">
                <img src="https://images.unsplash.com/photo-1529148482759-b35b25c5f217?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Library books">
            </div>
            <div class="search-section">
                <h1>Find The Book You Love</h1>
                <div class="search-container">
                    <div class="search-box">
                        <input type="text" placeholder="Search books, authors, categories..." class="search-input">
                    </div>
                </div>
            </div>
        </section>

        <!-- Book Categories -->
        <section class="categories-section">
            <h2>Select a Book Category</h2>
            <div class="books-grid">
                <div class="book-category">
                    <a href="/user/literarybook"><img src="/images/literary.avif" alt="Literary Fiction Cover"></a>
                    <p>Literary Fiction</p>
                </div>
                <div class="book-category">
                    <a href="/user/historicalbook"><img src="/images/historical.avif" alt="Historical Fiction Cover"></a>
                    <p>Historical Fiction</p>
                </div>
                <div class="book-category">
                    <a href="/user/educationBook"><img src="/images/education.avif" alt="Education Book Cover"></a>
                    <p>Education/References</p>
                </div>
                <div class="book-category">
                    <a href="/user/romancebook"><img src="/images/romance.avif" alt="Romance Book Cover"></a>
                    <p>Romance</p>
                </div>
                <div class="book-category">
                    <a href="/user/horrorbook"><img src="/images/horror.avif" alt="Horror Book Cover"></a>
                    <p>Horror</p>
                </div>
                <div class="book-category">
                    <a href="/user/cartoonbook"><img src="/images/cartoon.jpg" alt="Cartoon Book Cover"></a>
                    <p>Cartoon</p>
                </div>
            </div>
        </section>
    </main>

    <script>
        const searchInput = document.querySelector('.search-input');
        const bookCategories = document.querySelectorAll('.book-category');

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            bookCategories.forEach(category => {
                const categoryName = category.querySelector('p').textContent.toLowerCase();
                if (categoryName.includes(searchTerm)) {
                    category.style.display = 'block';
                    category.style.animation = 'fadeInUp 0.5s ease-out';
                } else {
                    category.style.display = searchTerm === '' ? 'block' : 'none';
                }
            });
        });
    </script>
</body>
</html>
