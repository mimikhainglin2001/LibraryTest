<?php require_once APPROOT . '/views/inc/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Book Categories - Library</title> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

        /* Main Content */
        .main-content {
            min-height: 100vh;
            padding-top: 80px;


        }

        /* Hero Section */
        .hero-section {
            position: relative;
            background: #1e3a8a;
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="books" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><rect width="20" height="20" fill="none"/><path d="M2 2h16v16H2z" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23books)"/></svg>') repeat;
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
            height: 100%;
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

        /* 
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
        } */

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

        /* Books Grid - Fixed 3 columns */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            justify-items: center;
            margin-top: 40px;
        }

        .book-category {
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            animation: fadeInUp 0.8s ease-out;
            width: 100%;
            max-width: 200px;
        }

        .book-category:hover {
            transform: translateY(-10px);
        }

        /* Simplified image styling - no wrapper */
        .book-category img {
            width: 180px;
            height: 240px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            display: block;
            margin: 0 auto 15px;
        }

        .book-category img:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            transform: scale(1.05);
        }

        .book-category p {
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        .book-category:hover p {
            color: #667eea;
        }

        /* Navigation Section */
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
            transition: all 0.3s ease;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
        }

        .back-btn:hover {
            background: linear-gradient(135deg, #5a6268, #495057);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(108, 117, 125, 0.4);
        }

        .back-btn::before {
            content: '\f060';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
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

        @keyframes fadeIn {
            to {
                opacity: 1;
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

            .categories-section {
                padding: 60px 15px;
            }

            .categories-section h2 {
                font-size: 2rem;
                margin-bottom: 30px;
            }

            .books-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            .book-category img {
                width: 140px;
                height: 200px;
            }

            .book-category p {
                font-size: 1rem;
            }

            .navigation {
                padding: 20px 15px;
                margin-top: 30px;
            }

            .back-btn {
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

            .categories-section h2 {
                font-size: 1.6rem;
            }

            .books-grid {
                grid-template-columns: 1fr;
                gap: 25px;
            }

            .book-category img {
                width: 180px;
                height: 240px;
            }

            .book-category p {
                font-size: 1.1rem;
            }

            .navigation {
                justify-content: center;
            }
        }

        /* Loading animation for images */
        .book-category img {
            opacity: 0;
            animation: fadeIn 0.5s ease-out 0.2s forwards;
        }
    </style>
</head>

<body>

    <!-- Note: Original header would be included here -->



    <!-- Main Content -->
    <main class="main-content">
        <span> <?php require APPROOT . '/views/components/auth_message.php'; ?></span>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-image">
                <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Library books">
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
                <!-- Literary Fiction -->
                <div class="book-category">
                    <a href="/user/literarybook">
                        <img src="/images/literary.avif" alt="Literary Fiction Cover">
                    </a>
                    <p>Literary Fiction</p>
                </div>

                <!-- Historical Fiction -->
                <div class="book-category">
                    <a href="/user/historicalbook">
                        <img src="/images/historical.avif" alt="Historical Fiction Cover">
                    </a>
                    <p>Historical Fiction</p>
                </div>

                <!-- Education/References -->
                <div class="book-category">
                    <a href="/user/educationBook">
                        <img src="/images/education.avif" alt="Education Book Cover">
                    </a>
                    <p>Education/References</p>
                </div>

                <!-- Romance -->
                <div class="book-category">
                    <a href="/user/romancebook">
                        <img src="/images/romance.avif" alt="Romance Book Cover">
                    </a>
                    <p>Romance</p>
                </div>

                <!-- Horror -->
                <div class="book-category">
                    <a href="/user/horrorbook">
                        <img src="/images/horror.avif" alt="Horror Book Cover">
                    </a>
                    <p>Horror</p>
                </div>

                <!-- Cartoon -->
                <div class="book-category">
                    <a href="/user/cartoonbook">
                        <img src="/images/cartoon.jpg" alt="Cartoon Book Cover">
                    </a>
                    <p>Cartoon</p>
                </div>
            </div>
        </section>


    </main>

    <script>
        // Add search functionality
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

        // Add loading states for images
        document.querySelectorAll('.book-category img').forEach(img => {
            img.addEventListener('load', function() {
                this.style.opacity = '1';
            });

            img.addEventListener('error', function() {
                this.style.background = 'linear-gradient(135deg, #667eea, #764ba2)';
                this.style.display = 'flex';
                this.style.alignItems = 'center';
                this.style.justifyContent = 'center';
                this.style.color = 'white';
                this.style.fontSize = '1.2rem';
                this.innerHTML = '<i class="fas fa-book"></i>';
            });
        });

        // Add intersection observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe book categories for scroll animations
        bookCategories.forEach(category => {
            category.style.opacity = '0';
            category.style.transform = 'translateY(30px)';
            category.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(category);
        });
    </script>
</body>

</html>