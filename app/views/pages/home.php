<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome for social icons -->
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" xintegrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/librarycss/cartoonbook.css?v=<?= time(); ?>">



</head>
<style>
    /* Navbar brand */
    .nav a {
        color: white;
        text-decoration: none;
        font-family: 'Inter', Helvetica, sans-serif;
        /* font-size: 16px; */
        font-weight: 500;
        transition: opacity 0.3s;
        padding: 9px;
    }

    body {
        font-family: 'Inter', Helvetica, sans-serif;

    }

    .navbar-brand {
        display: inline-flex;
        align-items: center;
        padding: 8px 16px;
        /* background: linear-gradient(135deg, #4e94d1ff, #22176dff); gradient badge */
        border-radius: 12px;
        font-family: Inter, Helvetica, sans-serif;
        font-size: 1.2rem;
        font-weight: 700;
        color: #fff;
        /* white text */
        text-transform: uppercase;
        letter-spacing: 1.5px;
        text-decoration: none;
        /* box-shadow: 0 4px 12px rgba(0,0,0,0.15); */
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    /* Icon inside brand */
    .navbar-brand i {
        margin-right: 8px;
        font-size: 1.4rem;
    }

    /* Hover effects */
    .navbar-brand:hover {
        /* transform: translateY(-3px) scale(1.05);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.25); */
    }

    .nav a {
        font-family: Inter, Helvetica, sans-serif;

    }
</style>

<body class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-full">
    <div class="header-content">
        <nav>
            <ul class="nav">
                <li style="margin-right: 65%;">
                    <a href="<?php echo URLROOT; ?>/index" class="navbar-brand">
                        <i class="fas fa-book-reader"></i> Library
                    </a>
                </li>
                <li><a href="<?php echo URLROOT; ?>/pages/category">Category</a></li>
                <li><a href="<?php echo URLROOT; ?>/user/history">History</a></li>
                <li><a href="<?php echo URLROOT; ?>/pages/login">Login</a></li>

                <!-- <li><a href="<?php echo URLROOT; ?>/auth/logout">Logout</a></li> -->
            </ul>
        </nav>
    </div>

    <!-- Main Section -->
    <!-- Main Section -->
    <section class="flex flex-col md:flex-row items-center justify-between px-8 md:px-20 py-16 bg-white">
        <!-- Left Content -->
        <div class="max-w-lg">
            <h1 class="text-4xl font-bold text-blue-900 mt-2">LIBRARY</h1>
            <p class="text-gray-600 mt-4">
                Empowering students and researchers with access to books, journals, and digital resources to inspire learning, discovery, and innovation.
            </p>
            <button onclick="window.location.href='<?php echo URLROOT; ?>/pages/login';"
                class="mt-6 px-6 py-3 bg-blue-700 text-white font-semibold rounded-2xl shadow hover:bg-blue-800 transition">
                Get More
            </button>

        </div>

        <!-- Right Image Section -->
        <div class="mt-12 md:mt-0 md:ml-16">
            <img src="/images/home.png" alt="Library Illustration" class="w-full max-w-md">
        </div>
    </section>

    <!-- Services Section -->
    <section class="px-8 md:px-20 py-16 bg-white mt-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-blue-900">Our Services</h2>
            <p class="text-gray-600 mt-2">Explore what our library offers to students and researchers</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Service Card 1 -->
            <div class="bg-blue-50 p-6 rounded-2xl shadow hover:shadow-lg transition">
                <i class="fas fa-book text-3xl text-blue-700 mb-4"></i>
                <h3 class="text-xl font-semibold text-blue-900 mb-2">Book List</h3>
                <p class="text-gray-600">Browse thousands of books across various categories, authors, and genres.</p>
            </div>

            <!-- Service Card 2 -->
            <div class="bg-blue-50 p-6 rounded-2xl shadow hover:shadow-lg transition">
                <i class="fas fa-laptop text-3xl text-blue-700 mb-4"></i>
                <h3 class="text-xl font-semibold text-blue-900 mb-2">Digital Library</h3>
                <p class="text-gray-600">Access e-books, research papers, and online study materials anywhere, anytime.</p>
            </div>

            <!-- Service Card 3 -->
            <div class="bg-blue-50 p-6 rounded-2xl shadow hover:shadow-lg transition">
                <i class="fas fa-user-friends text-3xl text-blue-700 mb-4"></i>
                <h3 class="text-xl font-semibold text-blue-900 mb-2">Reading Rooms</h3>
                <p class="text-gray-600">Reserve quiet study spaces and collaborative rooms for group projects.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-10 mt-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                <!-- About Us -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">About Us</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-gray-300">Our Mission</a></li>
                        <li><a href="#" class="hover:text-gray-300">Library Policies</a></li>
                        <li><a href="#" class="hover:text-gray-300">Annual Report</a></li>
                    </ul>
                </div>

                <!-- Terms & Conditions -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Terms & Conditions</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-gray-300">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-gray-300">User Agreement</a></li>
                        <li><a href="#" class="hover:text-gray-300">Borrowing Rules</a></li>
                    </ul>
                </div>

                <!-- Connect -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Connect</h4>
                    <p class="mb-2">University Of Computer Studies,<br>Meiktila</p>
                    <p class="mb-2">Email:
                        <a href="mailto:golibrary2001@gmail.com" class="hover:text-gray-300">golibrary2001@gmail.com</a>
                    </p>
                    <p class="mb-4">Phone: (+95)9441 386 934</p>
                    <div class="flex space-x-4">
                        <a href="https://facebook.com/yourlibrarypage" target="_blank" class="hover:text-gray-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/yourlibraryhandle" target="_blank" class="hover:text-gray-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://instagram.com/yourlibrary" target="_blank" class="hover:text-gray-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://linkedin.com/company/yourlibrary" target="_blank" class="hover:text-gray-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Bottom -->
            <div class="border-t border-gray-600 mt-8 pt-4 text-center text-sm">
                &copy; 2025 UCSMTLA Library. All rights reserved.
            </div>
        </div>
    </footer>


</body>

</html>