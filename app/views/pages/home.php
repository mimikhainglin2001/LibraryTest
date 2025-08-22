<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
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
            border-radius: 12px;
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', Helvetica, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }

        /* Main Content */
        .main-content {
            min-height: 100vh;
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

        /* Common Section Styling for Categories and Popular Books */
        .section-heading {
            text-align: center;
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 50px;
            position: relative;
        }

        .section-heading::after {
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

        .books-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            justify-items: center;
            margin-top: 40px;
            padding: 0 20px;
        }

        .book-item {
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            animation: fadeInUp 0.8s ease-out;
            width: 100%;
            max-width: 200px;
            text-decoration: none;
            color: inherit;
        }

        .book-item:hover {
            transform: translateY(-10px);
        }

        .book-item img {
            width: 180px;
            height: 240px;
            object-fit: cover;
            border-radius: 15px;
            transition: all 0.3s ease;
            display: block;
            margin: 0 auto 15px;
            opacity: 0;
        }

        .book-item img:hover {
            transform: scale(1.05);
        }

        .book-item p {
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        .book-item:hover p {
            color: #667eea;
        }

        /* Specific Section Styling */
        .categories-section,
        .popular-books-section {
            padding: 80px 20px;
            max-width: 1200px;
            margin: 0 auto;
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

        /* Modal Styles */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 100;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.5);
            /* Black w/ opacity */
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            width: 80%;
            max-width: 400px;
            text-align: center;
            position: relative;
            animation: zoomIn 0.3s ease-out;
        }

        .modal-content h3 {
            margin-bottom: 20px;
            color: #333;
            font-size: 1.8rem;
        }

        .modal-content p {
            margin-bottom: 25px;
            color: #666;
            font-size: 1.1rem;
        }

        .modal-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .modal-button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .modal-button:hover {
            background-color: #0056b3;
        }

        .modal-close {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .modal-close:hover,
        .modal-close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .books-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 40px 0;
            }

            .search-section h1 {
                font-size: 2.2rem;
                margin-bottom: 20px;
            }

            .categories-section,
            .popular-books-section {
                padding: 60px 15px;
            }

            .section-heading {
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

            .book-item p {
                font-size: 1rem;
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

            .section-heading {
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

            .book-item p {
                font-size: 1.1rem;
            }

            .modal-content {
                width: 95%;
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <main class="main-content">
        <section class="hero-section">
            <div class="hero-image">
                <img src="https://images.unsplash.com/photo-1529148482759-b35b25c5f217?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
            </div>

            <div class="search-section">
                <h1>Gateway To Your Knowledge</h1>
                <div class="search-container">
                </div>
            </div>
        </section>

        <section class="popular-books-section">
            <h2 class="section-heading">Most Popular Books 🌟</h2>

            <div class="books-grid" id="popularBooksGrid">
                <a href="/books/the-midnight-library" class="book-item">
                    <img src="/images/Latkyan-Layoung.png" alt="The Midnight Library Cover">
                    <p>လက်ကျန်လရောင်</p>
                </a>

                <a href="/books/lessons-in-chemistry" class="book-item">
                    <img src="/images/Akyin-Thu-Thi.png" alt="Lessons in Chemistry Cover">
                    <p>အကြင်သူသည်</p>
                </a>

                <a href="/books/fourth-wing" class="book-item">
                    <img src="/images/Amhat-Taya.png" alt="Fourth Wing Cover">
                    <p>အမှတ်တရ</p>
                </a>

                <a href="/books/atomic-habits" class="book-item">
                    <img src="/images/Achitsonethuyeahtotepati.png" alt="Atomic Habits Cover">
                    <p>အချစ်ဆုံးသူရဲ့အတ္ထုပ္ပတ္တိ</p>
                </a>

                <a href="/books/where-the-crawdads-sing" class="book-item">
                    <img src="/images/nout-sone-nat-khat-300x300.png" alt="Where the Crawdads Sing Cover">
                    <p>နောက်ဆုံးနက္ခတ်</p>
                </a>

                <a href="/books/project-hail-mary" class="book-item">
                    <img src="/images/MgYinMgMaMeMa.jpg" alt="Project Hail Mary Cover">
                    <p>မောင်ရင်မောင် မမယ်မ</p>
                </a>
            </div>
            <div class="books-grid" id="popularBooksGrid">
                <a href="/books/the-midnight-library" class="book-item">
                    <img src="/images/daung-yin-pyan.png" alt="The Midnight Library Cover">
                    <p>ဒေါင်းယာဉ်ပျံဘုံနံဘေးမှာ စာရေးလို့ထားချင်တယ်</p>
                </a>

                <a href="/books/lessons-in-chemistry" class="book-item">
                    <img src="/images/MaEainKan.png" alt="Lessons in Chemistry Cover">
                    <p>မအိမ်ကံ</p>
                </a>

                <a href="/books/fourth-wing" class="book-item">
                    <img src="/images/Juu.png" alt="Fourth Wing Cover">
                    <p>မိန်းမတစ်ယောက်ရဲ့ဖွင့်ဟဝန်ခံချက်</p>
                </a>

                <a href="/books/atomic-habits" class="book-item">
                    <img src="/images/Linkardipa-Chit-Thu.png" alt="Atomic Habits Cover">
                    <p>လင်္ကာဒီပချစ်သူ</p>
                </a>

                <a href="/books/where-the-crawdads-sing" class="book-item">
                    <img src="/images/she.png" alt="Where the Crawdads Sing Cover">
                    <p>သူ့လိုမိန်းမ</p>
                </a>

                <a href="/books/project-hail-mary" class="book-item">
                    <img src="/images/Pann-Tway-Pwint-Phoe.png" alt="Project Hail Mary Cover">
                    <p>ပန်းတွေပွင့်ဖို့စောင့်ရချိန်</p>
                </a>
            </div>
            <div class="navigation">
                <a href="<?= URLROOT; ?>/pages/welcome" class="back-btn">Back</a>
                <!-- <button class="see-more-btn" id="seeMoreBtn">See More Books</button> -->
            </div>
        </section>
    </main>

    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <h3>Login Required</h3>
            <p>You need to be logged in to access this content.</p>
            <div class="modal-buttons">
                <button class="modal-button" id="modalLoginBtn">Login</button>
                <button class="modal-button" id="modalCancelBtn">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        // Get the modal element
        const loginModal = document.getElementById('loginModal');
        // Get the close button
        const closeButton = document.querySelector('.modal-close');
        // Get the Login and Cancel buttons inside the modal
        const modalLoginBtn = document.getElementById('modalLoginBtn');
        const modalCancelBtn = document.getElementById('modalCancelBtn');

        // Select all book item links (the <a> tags)
        const allBookItems = document.querySelectorAll('.book-item');

        // Function to show the modal
        function showModal() {
            loginModal.style.display = 'flex'; // Use flex to center the modal content
        }

        // Function to hide the modal
        function hideModal() {
            loginModal.style.display = 'none';
        }

        // Add a click event listener to each book item
        allBookItems.forEach(item => {
            item.addEventListener('click', function(event) {
                // Prevent the default action of the link
                event.preventDefault();
                // Show the custom modal instead of an alert
                showModal();
            });
        });

        // Event listeners for the modal buttons
        closeButton.addEventListener('click', hideModal);
        modalCancelBtn.addEventListener('click', hideModal);

        modalLoginBtn.addEventListener('click', function() {
            hideModal();
            // Replace '/pages/login' with the actual relative path to your login page
            window.location.href = '/pages/login';
        });

        // Close the modal if the user clicks outside of it
        window.addEventListener('click', function(event) {
            if (event.target == loginModal) {
                hideModal();
            }
        });

        // --- Existing image loading/error and Intersection Observer logic ---
        document.querySelectorAll('.book-item img').forEach(img => {
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

        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        allBookItems.forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(30px)';
            item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(item);
        });
    </script>
</body>

</html>