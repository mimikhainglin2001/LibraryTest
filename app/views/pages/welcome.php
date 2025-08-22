<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Global Reset & Box-Sizing */
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Root Variables for Modern Design */
        :root {
            --primary-color: #4267B2;
            /* Facebook blue for a classic, trustworthy feel */
            --primary-dark: #365899;
            --secondary-color: #E60023;
            /* Pinterest red - striking accent */
            --accent-color: #0077B5;
            /* LinkedIn blue - professional */
            --text-primary: #212529;
            /* Deep charcoal for main text */
            --text-secondary: #495057;
            /* Muted dark gray for body text */
            --text-light: #6c757d;
            /* Lighter gray for less emphasis */
            --background: #f8f9fa;
            /* Light greyish white */
            --surface: #ffffff;
            /* Pure white for cards */
            --border: rgba(222, 226, 230, 0.8);
            /* Light, subtle border */
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 10px rgba(0, 0, 0, 0.12);
            /* Slightly stronger shadow */
            --shadow-lg: 0 10px 20px rgba(0, 0, 0, 0.18);
            --shadow-xl: 0 20px 30px rgba(0, 0, 0, 0.22);
            --gradient-hero: linear-gradient(135deg, #1f273d 0%, #303f6f 100%);
            /* Deep blue-grey gradient */
            --gradient-primary: linear-gradient(135deg, var(--primary-color) 0%, #5a85cc 100%);
            /* Primary blue gradient */
            --gradient-secondary: linear-gradient(135deg, var(--secondary-color) 0%, #ff4b2b 100%);
            /* Red to orange gradient */
            --gradient-accent: linear-gradient(135deg, var(--accent-color) 0%, #0099e5 100%);
            /* Teal to sky blue gradient */
        }

        /* Body Styles */
        body {
            font-family: 'Inter', Helvetica, sans-serif;
            line-height: 1.6;
            color: var(--text-primary);
            background: var(--background);
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Utility Classes */
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2.5rem;
        }

        /* --- Hero Section --- */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background: rgb(30 58 138);
            /* Use the new dark hero gradient */
            overflow: hidden;
            color: white;
            padding: 4rem 0;
            /* Add some padding for smaller screens */
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            background-size: 200% 200%;
            animation: gradientShift 20s ease infinite;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .hero-background::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.9;
            /* Slightly more visible grid */
        }

        .floating-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            opacity: 0;
            animation: float 18s infinite linear;
            filter: blur(0.7px);
            /* Slightly more blur */
        }

        .particle:nth-child(odd) {
            background: rgba(var(--secondary-color-rgb), 0.4);
        }

        .particle:nth-child(3n) {
            background: rgba(var(--accent-color-rgb), 0.3);
            width: 7px;
            /* Slightly larger particles */
            height: 7px;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) scale(0);
                opacity: 0;
            }

            5% {
                opacity: 0.8;
                /* Higher peak opacity */
                transform: translateY(95vh) scale(0.6);
            }

            95% {
                opacity: 0.8;
                transform: translateY(-50px) scale(1.1);
            }

            100% {
                transform: translateY(-100px) scale(1.3);
                opacity: 0;
            }
        }

        .hero-content {
            position: relative;
            z-index: 3;
            text-align: center;
            max-width: 900px;
            padding: 0 2rem;
        }

        .hero-title {
            font-family: 'Inter', Helvetica, sans-serif;
            font-size: clamp(3rem, 6vw, 5.2rem);
            /* Larger title */
            font-weight: 400;
            color: white;
            margin-bottom: 1.8rem;
            text-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
            /* Stronger shadow */
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        .hero-description {
            font-size: clamp(1.1rem, 2vw, 1.5rem);
            /* Larger description */
            color: rgba(255, 255, 255, 0.95);
            /* Whiter text */
            margin-bottom: 3.5rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            animation: fadeInUp 1s ease-out 0.4s both;
        }

        .hero-actions {
            display: flex;
            gap: 1.8rem;
            /* Slightly larger gap */
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUp 1s ease-out 0.6s both;
        }

        .btn {
            padding: 1.2rem 3.2rem;
            /* Slightly larger buttons */
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.2rem;
            /* Larger font */
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            color: white;
            /* Default button text color */
        }

        .btn-primary {
            background: #27497c;
            backdrop-filter: blur(15px);
            /* Stronger blur for glass effect */
            border: 1px solid rgba(255, 255, 255, 0.5);
            /* Stronger border */
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            /* background: #27497c; */
            transform: translateY(-5px) scale(1.03);
            /* More pronounced lift */
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.25);
        }

        .btn-primary:active {
            transform: translateY(0);
            box-shadow: var(--shadow-sm);
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            transition: left 0.6s ease-out;
            z-index: 1;
        }

        .btn:hover::before {
            left: 100%;
        }

        .hero-visual {
            position: absolute;
            right: 8%;
            bottom: 10%;
            z-index: 2;
            animation: fadeInRight 1s ease-out 0.8s both;
        }

        .book-stack {
            position: relative;
            width: 250px;
            /* Even larger books */
            height: 300px;
            display: flex;
            align-items: flex-end;
        }

        .book {
            position: absolute;
            width: 180px;
            /* Larger book size */
            height: 240px;
            border-radius: 12px;
            /* Softer corners */
            box-shadow: var(--shadow-xl);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: bottom center;
            background: linear-gradient(145deg, #e2e8f0, #cbd5e0);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 500;
        }

        /* Using placeholder images as per user's original paths */
        .book-1 {
            background: url('/images/book1.avif') no-repeat center/cover;
            transform: rotate(-10deg) translateX(-40px);
            /* More spread out */
            left: 0;
            z-index: 3;
            box-shadow: 0 18px 35px rgba(0, 0, 0, 0.3);
        }

        .book-2 {
            background: url('/images/book2.avif') no-repeat center/cover;
            left: 50%;
            transform: translateX(-50%);
            /* Center the middle book */
            z-index: 2;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
        }

        .book-3 {
            background: url('/images/book3.avif') no-repeat center/cover;
            transform: rotate(10deg) translateX(40px);
            /* More spread out */
            right: 0;
            z-index: 1;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
        }

        .book-stack:hover .book-1 {
            transform: rotate(-12deg) translateX(-50px) translateY(-20px);
        }

        .book-stack:hover .book-2 {
            transform: rotate(2deg) translateY(-10px);
        }

        .book-stack:hover .book-3 {
            transform: rotate(12deg) translateX(50px) translateY(-18px);
        }

        /* --- Services Section --- */
        .services {
            padding: 8rem 0;
            background: var(--background);
            position: relative;
            z-index: 10;
        }

        .section-title {
            font-family: 'Inter', Helvetica, sans-serif;
            font-size: clamp(2.8rem, 4.5vw, 3.8rem);
            /* Slightly larger title */
            text-align: center;
            margin-bottom: 5rem;
            color: var(--text-primary);
            position: relative;
            font-weight: 700;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            /* Wider underline */
            height: 6px;
            /* Thicker underline */
            background: var(--gradient-accent);
            /* Use accent gradient */
            border-radius: 3px;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            /* Slightly larger min-width */
            gap: 3rem;
            /* Increased gap */
        }

        .service-card {
            background: var(--surface);
            padding: 3.5rem;
            /* More padding */
            border-radius: 20px;
            text-align: center;
            box-shadow: var(--shadow-md);
            transition: all 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
            border: 1px solid var(--border);
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            /* Thicker top border */
            background: var(--gradient-primary);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        .service-card:hover::before {
            transform: scaleX(1);
        }

        .service-card:hover {
            transform: translateY(-12px) scale(1.04);
            /* More pronounced lift and scale */
            box-shadow: var(--shadow-lg);
            /* Stronger shadow on hover */
            border-color: rgba(var(--primary-color-rgb), 0.6);
            /* Highlight border on hover */
        }

        .service-icon {
            font-size: 4rem;
            /* Larger icons */
            margin-bottom: 2rem;
            color: var(--primary-color);
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .service-card:hover .service-icon {
            transform: scale(1.15) rotate(7deg);
            /* More spin and grow on hover */
            color: var(--secondary-color);
        }

        .service-card h3 {
            font-size: 1.8rem;
            /* Larger heading */
            font-weight: 600;
            margin-bottom: 1.2rem;
            color: var(--text-primary);
        }

        .service-card p {
            color: var(--text-secondary);
            line-height: 1.8;
            /* More readable line height */
            font-size: 1.1rem;
            /* Slightly larger text */
        }

        /* --- Footer (New Section) --- */
        .main-footer {
            background: rgb(30 58 138);
            /* Keep hero gradient for consistency */
            color: rgba(255, 255, 255, 0.85);
            /* Slightly brighter text */
            padding: 4rem 0;
            font-size: 0.98rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            /* Adjusted min-width for columns */
            gap: 2.5rem;
            padding-bottom: 3rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            /* Slightly more visible border */
        }

        .footer-col h4 {
            font-size: 1.25rem;
            /* Slightly larger heading */
            color: white;
            margin-bottom: 1.6rem;
            font-weight: 600;
        }

        .footer-col ul {
            list-style: none;
            padding-left: 0;
            /* Ensure no default padding */
        }

        .footer-col ul li {
            margin-bottom: 0.9rem;
            /* Slightly more space */
        }

        .footer-col ul li a {
            color: rgba(255, 255, 255, 0.75);
            /* Brighter link color */
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-col ul li a:hover {
            color: var(--accent-color);
            /* Change to accent color on hover */
        }

        .social-links {
            display: flex;
            gap: 1.8rem;
            /* Increased gap between icons */
            margin-top: 1.8rem;
            /* More space above icons */
        }

        .social-links a {
            color: white;
            /* Default social icon color */
            font-size: 1.7rem;
            /* Larger social icons */
            transition: transform 0.3s ease, color 0.3s ease;
            display: flex;
            /* Ensure proper centering if backgrounds are added */
            align-items: center;
            justify-content: center;
            width: 45px;
            /* Define fixed size for circles if needed */
            height: 45px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            /* Subtle background for social icons */
            box-shadow: var(--shadow-sm);
        }

        .social-links a:hover {
            transform: translateY(-5px) scale(1.1);
            /* More pronounced lift and scale */
            color: var(--secondary-color);
            /* Change color on hover */
            box-shadow: var(--shadow-md);
        }

        /* Specific Social Icon Colors on hover for brand recognition */
        .social-links a.facebook:hover {
            color: #3b5998;
            /* Facebook Blue */
        }

        .social-links a.twitter:hover {
            color: #00acee;
            /* Twitter Blue */
        }

        .social-links a.instagram:hover {
            color: #E1306C;
            /* Instagram Red/Pink */
        }

        .social-links a.linkedin:hover {
            color: #0077B5;
            /* LinkedIn Blue */
        }


        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            color: rgba(255, 255, 255, 0.65);
            /* Slightly brighter copyright text */
        }


        /* --- Responsive Design --- */
        @media (max-width: 992px) {
            .hero {
                flex-direction: column;
                /* Stack content and visual */
                text-align: center;
            }

            .hero-visual {
                position: relative;
                right: auto;
                bottom: auto;
                transform: none;
                margin-top: 4rem;
                /* More space between text and books */
                order: 2;
                max-width: 100%;
                /* Allow visual to shrink */
            }

            .hero-content {
                order: 1;
            }

            .book-stack {
                width: 200px;
                height: 250px;
                margin: 0 auto;
            }

            .book {
                width: 150px;
                height: 200px;
            }
        }

        @media (max-width: 768px) {
            .hero {
                padding: 3rem 1rem;
            }

            .hero-title {
                font-size: clamp(2rem, 8vw, 3.8rem);
            }

            .hero-description {
                font-size: clamp(0.95rem, 3vw, 1.25rem);
            }

            .hero-actions {
                flex-direction: column;
                align-items: center;
                gap: 1rem;
            }

            .btn {
                width: 90%;
                max-width: 350px;
                padding: 1rem 2rem;
                font-size: 1.1rem;
            }

            .services {
                padding: 6rem 0;
            }

            .services-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .service-card {
                padding: 2.5rem;
            }

            .section-title {
                font-size: clamp(2rem, 6vw, 3rem);
                margin-bottom: 3.5rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .footer-col ul {
                padding-left: 0;
            }

            .social-links {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 1.5rem;
            }

            .hero-content {
                padding: 0 1rem;
            }

            .btn {
                padding: 0.9rem 1.8rem;
                font-size: 1rem;
            }

            .book-stack {
                width: 160px;
                height: 200px;
            }

            .book {
                width: 120px;
                height: 160px;
            }
        }

        /* --- Animations --- */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(40px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Intersection Observer Animation Classes */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(60px);
            transition: all 1s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        .animate-on-scroll.animate {
            opacity: 1;
            transform: translateY(0);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #e9ecef;
            /* Lighter track */
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

        /* Loading Animation */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--gradient-hero);
            /* Match hero background */
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 1;
            visibility: visible;
            transition: opacity 0.7s ease-out, visibility 0.7s ease-out;
            /* Slightly longer hide */
        }

        .loading-overlay.hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .loader {
            width: 65px;
            /* Larger loader */
            height: 65px;
            border: 5px solid rgba(255, 255, 255, 0.3);
            /* Softer border */
            border-top: 5px solid white;
            border-radius: 50%;
            animation: spin 1.2s cubic-bezier(0.68, -0.55, 0.27, 1.55) infinite;
            /* Slightly slower spin */
            filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.6));
            /* More pronounced glow */
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Click Ripple Animation (Add this to your CSS) */
        @keyframes clickRipple {
            0% {
                transform: scale(0);
                opacity: 1;
            }

            100% {
                transform: scale(2.5);
                /* Increase ripple size */
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loader"></div>
    </div>
    <main>
        <section class="hero">
            <div class="hero-background">
                <div class="floating-particles"></div>
            </div>
            <div class="hero-content">

                <h1 class="hero-title">Welcome to Our UCSMTLA Library</h1>
                <p class="hero-description">Immerse yourself in a world of knowledge. Explore our extensive collection, utilize cutting-edge digital resources, and find your perfect study sanctuary.</p>
                <div class="hero-actions">
                    <a href="<?php echo URLROOT; ?>/pages/home" class="btn btn-primary">Discover Books</a>
                    <a href="<?php echo URLROOT; ?>/pages/login" class="btn btn-primary">Login to Your Account</a>
                </div>
            </div>
            <div class="hero-visual">
                <div class="book-stack">
                    <div class="book book-1"></div>
                    <div class="book book-2"></div>
                    <div class="book book-3"></div>
                </div>
            </div>
        </section>

        <section class="services">
            <div class="container">
                <h2 class="section-title animate-on-scroll">Our Core Offerings</h2>
                <div class="services-grid">
                    <div class="service-card animate-on-scroll">
                        <div class="service-icon">📚</div>
                        <h3>Vast Book Collection</h3>
                        <p>Access an expansive physical collection spanning diverse genres and academic disciplines, curated for every reader.</p>
                    </div>

                    <div class="service-card animate-on-scroll">
                        <div class="service-icon">👥</div>
                        <h3>Inspiring Study Environments</h3>
                        <p>Find your ideal space—from tranquil reading nooks to vibrant collaborative zones and private study rooms.</p>
                    </div>
                    <div class="service-card animate-on-scroll">
                        <div class="service-icon">🎓</div>
                        <h3>Expert Research Assistance</h3>
                        <p>Our experienced librarians are here to guide your research, provide citation support, and help you master information literacy.</p>
                    </div>

                </div>
            </div>
        </section>
        <footer class="main-footer">
            <div class="container">
                <div class="footer-grid">
                    <div class="footer-col">
                        <h4>About Us</h4>
                        <ul>
                            <li><a href="#">Our Mission</a></li>
                            <li><a href="#">Staff Directory</a></li>
                            <li><a href="#">Library Policies</a></li>
                            <li><a href="#">Annual Report</a></li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="#">Catalog Search</a></li>
                            <li><a href="#">Digital Collections</a></li>
                            <li><a href="#">Research Guides</a></li>
                            <li><a href="#">Room Reservations</a></li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h4>Connect</h4>
                        <p>University Of Computer Studies,<br>Meiktila</p>
                        <p>Email: <a href="golibrary2001@gmail.com">golibrary2001@gmail.com</a></p>
                        <p>Phone: (+95)9441 386 934</p>
                        <div class="social-links">
                            <a href="https://facebook.com/yourlibrarypage" target="_blank" aria-label="Facebook" class="facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://twitter.com/yourlibraryhandle" target="_blank" aria-label="Twitter" class="twitter"><i class="fab fa-twitter"></i></a>
                            <a href="https://instagram.com/yourlibrary" target="_blank" aria-label="Instagram" class="instagram"><i class="fab fa-instagram"></i></a>
                            <a href="https://linkedin.com/company/yourlibrary" target="_blank" aria-label="LinkedIn" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    &copy; 2025 UCSMTLA Library. All rights reserved.
                </div>
            </div>
        </footer>
    </main>

    <script>
        // Store computed values for RGB for gradients for better performance/consistency
        document.documentElement.style.setProperty('--primary-color-rgb', '66, 103, 178'); /* RGB for #4267B2 */
        document.documentElement.style.setProperty('--secondary-color-rgb', '230, 0, 35'); /* RGB for #E60023 */
        document.documentElement.style.setProperty('--accent-color-rgb', '0, 119, 181'); /* RGB for #0077B5 */


        // Loading screen
        window.addEventListener('load', function() {
            setTimeout(() => {
                document.getElementById('loadingOverlay').classList.add('hidden');
            }, 800); // Slightly faster fade out
        });

        // Create floating particles animation
        function createParticles() {
            const particlesContainer = document.querySelector('.floating-particles');
            // Clear existing particles to prevent duplicates on resize
            particlesContainer.innerHTML = '';
            const particleCount = window.innerWidth < 768 ? 15 : 30;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%'; // Start at random top position too
                particle.style.width = `${Math.random() * 3 + 2}px`; // Random sizes
                particle.style.height = particle.style.width;
                particle.style.animationDelay = Math.random() * 18 + 's'; // Varied delays
                particle.style.animationDuration = (Math.random() * 10 + 18) + 's'; // Varied durations
                particlesContainer.appendChild(particle);
            }
        }

        // Intersection Observer for scroll animations
        function setupScrollAnimations() {
            const observerOptions = {
                threshold: 0.2, // Trigger earlier
                rootMargin: '0px 0px -80px 0px' // Offset for smoother appearance
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate');
                        // No need for explicit staggered animation delay for service cards here
                        // CSS `transition-delay` on individual cards is better
                    } else {
                        // Optionally remove 'animate' if you want elements to re-animate on scroll back
                        // entry.target.classList.remove('animate');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                observer.observe(el);
            });
        }

        // Parallax effect for hero section
        function setupParallax() {
            const heroBackground = document.querySelector('.hero-background');
            const heroVisual = document.querySelector('.hero-visual');

            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const rate = scrolled * -0.3; // Slower parallax

                if (heroBackground) {
                    heroBackground.style.transform = `translateY(${rate}px)`;
                }

                if (heroVisual && window.innerWidth > 992) { // Apply only on larger screens
                    heroVisual.style.transform = `translateY(${rate * 0.5}px)`; // Slower rate for visual
                }
            });
        }

        // Enhanced button click effects
        function setupButtonEffects() {
            document.querySelectorAll('.btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    const circle = document.createElement('span');
                    const diameter = Math.max(this.clientWidth, this.clientHeight);
                    const radius = diameter / 2;

                    circle.style.cssText = `
                        position: absolute;
                        width: ${diameter}px;
                        height: ${diameter}px;
                        left: ${e.clientX - this.getBoundingClientRect().left - radius}px; /* Calculate relative to button */
                        top: ${e.clientY - this.getBoundingClientRect().top - radius}px; /* Calculate relative to button */
                        background: rgba(255, 255, 255, 0.4);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: clickRipple 0.6s ease-out forwards; /* Use forwards to stay at end state */
                        pointer-events: none;
                        z-index: 2; /* Ensure ripple is above text but below shine */
                    `;

                    // Remove any existing ripples to prevent accumulation
                    this.querySelectorAll('.ripple').forEach(r => r.remove());
                    circle.classList.add('ripple'); // Add a class to identify ripples
                    this.appendChild(circle);
                });
            });
        }

        // Initialize functions on DOMContentLoaded
        document.addEventListener('DOMContentLoaded', () => {
            createParticles();
            setupScrollAnimations();
            setupParallax();
            setupButtonEffects();
        });

        // Recreate particles on window resize for responsiveness
        window.addEventListener('resize', createParticles);
    </script>
</body>

</html>