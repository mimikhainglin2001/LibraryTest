<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Central Library</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            --primary-color: #6a82fb; /* A more vibrant blue */
            --primary-dark: #5a70e6;
            --secondary-color: #fc7767; /* A warm, inviting orange-red */
            --accent-color: #00e0b3; /* A fresh teal */
            --text-primary: #1e293b; /* Darker for better contrast */
            --text-secondary: #475569; /* Muted for body text */
            --text-light: #64748b;
            --background: #f8fafc; /* Light off-white */
            --surface: #ffffff; /* Pure white for cards */
            --border: rgba(226, 232, 240, 0.8);
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.12);
            --shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.15);
            --gradient-primary: linear-gradient(135deg, var(--primary-color) 0%, #a4508b 100%); /* Blue to deep purple */
            --gradient-secondary: linear-gradient(135deg, var(--secondary-color) 0%, #ffbb00 100%); /* Orange to vibrant yellow */
            --gradient-accent: linear-gradient(135deg, var(--accent-color) 0%, #0093e9 100%); /* Teal to sky blue */
        }

        /* Body Styles */
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--text-primary);
            background:radial-gradient(rgb(29, 78, 216), rgb(30, 64, 175), rgb(17, 24, 39));
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Utility Classes */
        .container {
            max-width: 1280px; /* Slightly wider container */
            margin: 0 auto;
            padding: 0 2.5rem; /* Increased padding */
        }

        /* --- Hero Section --- */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background: radial-gradient(rgb(29, 78, 216), rgb(30, 64, 175), rgb(17, 24, 39)); /* Use primary gradient */
            overflow: hidden;
            color: white; /* Ensure text is white on dark background */
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            background-size: 200% 200%; /* For animating gradient */
            animation: gradientShift 20s ease infinite; /* Smooth, slow gradient animation */
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .hero-background::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.08)" stroke-width="0.6"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.7; /* Subtler grid */
        }

        .floating-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none; /* Do not interfere with clicks */
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            opacity: 0;
            animation: float 18s infinite linear; /* Longer duration for slower float */
            filter: blur(0.5px); /* Soften particles */
        }

        .particle:nth-child(odd) { background: rgba(var(--secondary-color-rgb), 0.4); }
        .particle:nth-child(3n) { background: rgba(var(--accent-color-rgb), 0.3); width: 6px; height: 6px; }

        @keyframes float {
            0% { transform: translateY(100vh) scale(0); opacity: 0; }
            5% { opacity: 1; transform: translateY(95vh) scale(0.5); }
            95% { opacity: 1; transform: translateY(-50px) scale(1); }
            100% { transform: translateY(-100px) scale(1.2); opacity: 0; }
        }

        .hero-content {
            position: relative;
            z-index: 3;
            text-align: center;
            max-width: 900px;
            padding: 0 2rem;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(3rem, 6vw, 5rem); /* Larger and more responsive */
            font-weight: 700;
            color: white;
            margin-bottom: 1.5rem;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        .hero-description {
            font-size: clamp(1.1rem, 2vw, 1.4rem);
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 3rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            animation: fadeInUp 1s ease-out 0.4s both;
        }

        .hero-actions {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUp 1s ease-out 0.6s both;
        }

        .btn {
            padding: 1.1rem 3rem; /* Slightly larger buttons */
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.15rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-flex; /* Use flex for potential icon alignment */
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-md); /* Add subtle shadow */
            color: white; /* Default button text color */
        }

        .btn-primary {
            background: rgba(255, 255, 255, 0.25); /* More prominent glass effect */
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }

        .btn-primary:hover {
            background: rgba(255, 255, 255, 0.4);
            transform: translateY(-3px) scale(1.02); /* More noticeable lift */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
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
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s ease-out; /* Slower, smoother shine */
            z-index: 1; /* Ensure shine is above text */
        }

        .btn:hover::before {
            left: 100%;
        }

        .hero-visual {
            position: absolute;
            right: 8%; /* Adjusted position */
            bottom: 10%; /* Place at bottom right */
            transform: translateY(0); /* Reset transform */
            z-index: 2;
            animation: fadeInRight 1s ease-out 0.8s both;
        }

        .book-stack {
            position: relative;
            width: 220px; /* Slightly larger books */
            height: 270px;
            display: flex;
            align-items: flex-end; /* Stack books from the bottom */
        }

        .book {
            position: absolute;
            width: 160px;
            height: 220px;
            border-radius: 10px; /* Softer corners */
            box-shadow: var(--shadow-xl);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); /* Smoother transitions */
            transform-origin: bottom center; /* Pivot from bottom */
            background: linear-gradient(145deg, #e2e8f0, #cbd5e0); /* Default for internal book pages */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.7);
            font-weight: 500;
        }

        .book-1 {
            background: var(--gradient-accent); /* Unique gradient for each book */
            transform: rotate(-10deg) translateX(-30px); /* More spread out */
            left: 0;
            z-index: 3;
            box-shadow: 0 15px 30px rgba(0,0,0,0.25);
        }

        .book-2 {
            background: var(--gradient-secondary);
            transform: rotate(0deg);
            left: 50%;
            transform: translateX(-50%); /* Center the middle book */
            z-index: 2;
            box-shadow: 0 12px 25px rgba(0,0,0,0.2);
        }

        .book-3 {
            background: var(--gradient-primary);
            transform: rotate(10deg) translateX(30px);
            right: 0;
            z-index: 1;
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        .book-stack:hover .book-1 {
            transform: rotate(-12deg) translateX(-40px) translateY(-15px);
        }

        .book-stack:hover .book-2 {
            transform: rotate(2deg) translateY(-8px);
        }

        .book-stack:hover .book-3 {
            transform: rotate(12deg) translateX(40px) translateY(-12px);
        }

        /* --- Services Section --- */
        .services {
            padding: 8rem 0; /* More vertical space */
            background: var(--background);
            position: relative;
            z-index: 10; /* Ensure it's above hero background if scroll overlap */
        }

        /*  */


        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 4.5vw, 3.5rem);
            text-align: center;
            margin-bottom: 5rem; /* More space below title */
            color: var(--text-primary);
            position: relative;
            font-weight: 700;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px; /* Lower position for underline */
            left: 50%;
            transform: translateX(-50%);
            width: 100px; /* Wider underline */
            height: 5px;
            background: var(--gradient-accent); /* Use a different gradient for contrast */
            border-radius: 3px;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Slightly smaller min-width for more cards on row */
            gap: 2.5rem; /* Increased gap */
        }

        .service-card {
            background: var(--surface);
            padding: 3rem; /* More padding */
            border-radius: 20px;
            text-align: center;
            box-shadow: var(--shadow-md);
            transition: all 0.4s cubic-bezier(0.2, 0.8, 0.2, 1); /* Smoother spring-like transition */
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
            height: 6px; /* Thicker top border */
            background: var(--gradient-primary);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        .service-card:hover::before {
            transform: scaleX(1);
        }

        .service-card:hover {
            transform: translateY(-10px) scale(1.03); /* More pronounced lift and scale */
            box-shadow: var(--shadow-xl);
            border-color: rgba(var(--primary-color-rgb), 0.5); /* Highlight border on hover */
        }

        .service-icon {
            font-size: 3.5rem; /* Larger icons */
            margin-bottom: 1.8rem;
            color: var(--primary-color); /* Color the icons */
            transition: transform 0.3s ease;
        }

        .service-card:hover .service-icon {
            transform: scale(1.1) rotate(5deg); /* Spin and grow on hover */
            color: var(--secondary-color); /* Change color on hover */
        }

        .service-card h3 {
            font-size: 1.6rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-primary);
        }

        .service-card p {
            color: var(--text-secondary);
            line-height: 1.75;
            font-size: 1.05rem;
        }

        /* --- Responsive Design --- */
        @media (max-width: 992px) {
            .hero-visual {
                position: relative; /* Revert to relative for smaller screens */
                right: auto;
                bottom: auto;
                transform: none;
                margin-top: 3rem;
                order: 2; /* Put visual below content */
            }

            .hero-content {
                order: 1;
            }

            .book-stack {
                width: 180px;
                height: 230px;
                margin: 0 auto;
            }

            .book {
                width: 130px;
                height: 180px;
            }
        }

        @media (max-width: 768px) {
            .hero {
                flex-direction: column;
                padding: 4rem 1rem;
            }

            .hero-title {
                font-size: clamp(2.2rem, 8vw, 3.5rem);
            }

            .hero-description {
                font-size: clamp(1rem, 3vw, 1.2rem);
            }

            .hero-actions {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 300px;
            }

            .services {
                padding: 5rem 0;
            }

            .services-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .service-card {
                padding: 2.5rem;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 1.5rem;
            }

            .hero-content {
                padding: 0 1.5rem;
            }

            .btn {
                padding: 1rem 2rem;
                font-size: 1.05rem;
            }
        }

        /* --- Animations --- */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(40px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* Intersection Observer Animation Classes */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(60px); /* More pronounced initial translateY */
            transition: all 1s cubic-bezier(0.2, 0.8, 0.2, 1); /* Slower, smoother animation */
        }

        .animate-on-scroll.animate {
            opacity: 1;
            transform: translateY(0);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px; /* Wider scrollbar */
        }

        ::-webkit-scrollbar-track {
            background: #e2e8f0; /* Lighter track */
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color); /* Match primary color */
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
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 1;
            visibility: visible;
            transition: opacity 0.6s ease-out, visibility 0.6s ease-out; /* Smooth hide */
        }

        .loading-overlay.hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none; /* Allow interaction after fade */
        }

        .loader {
            width: 60px; /* Larger loader */
            height: 60px;
            border: 4px solid rgba(255, 255, 255, 0.4);
            border-top: 4px solid white;
            border-radius: 50%;
            animation: spin 1s cubic-bezier(0.68, -0.55, 0.27, 1.55) infinite; /* Springy spin */
            filter: drop-shadow(0 0 5px rgba(255,255,255,0.5)); /* Glow effect */
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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
                <h1 class="hero-title">Welcome to Our Modern Library</h1>
                <p class="hero-description">Immerse yourself in a world of knowledge. Explore our extensive collection, utilize cutting-edge digital resources, and find your perfect study sanctuary.</p>
                <div class="hero-actions">
                    <a href="<?php echo URLROOT;?>/pages/home" class="btn btn-primary">Discover Books</a>
                    <a href="<?php echo URLROOT;?>/pages/login" class="btn btn-primary">Login to Your Account</a>
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
                <h2 class="section-title animate-on-scroll">Our Comprehensive Services</h2>
                <div class="services-grid">
                    <div class="service-card animate-on-scroll">
                        <div class="service-icon">📚</div>
                        <h3>Vast Book Collection</h3>
                        <p>Access an expansive physical collection spanning diverse genres and academic disciplines, curated for every reader.</p>
                    </div>
                    <div class="service-card animate-on-scroll">
                        <div class="service-icon">💻</div>
                        <h3>Cutting-Edge Digital Hub</h3>
                        <p>Dive into our digital realm with e-books, audiobooks, premium databases, and online learning platforms available 24/7.</p>
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
                    <div class="service-card animate-on-scroll">
                        <div class="service-icon">📅</div>
                        <h3>Engaging Events & Workshops</h3>
                        <p>Participate in enriching book clubs, author talks, skill-building workshops, and community events for all ages.</p>
                    </div>
                    <div class="service-card animate-on-scroll">
                        <div class="service-icon">👶</div>
                        <h3>Vibrant Children's Corner</h3>
                        <p>A dedicated, imaginative space for our youngest patrons, featuring story times, interactive learning, and delightful books.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        // Store computed values for RGB for gradients for better performance/consistency
        document.documentElement.style.setProperty('--primary-color-rgb', '106, 130, 251'); /* RGB for #6a82fb */
        document.documentElement.style.setProperty('--secondary-color-rgb', '252, 119, 103'); /* RGB for #fc7767 */
        document.documentElement.style.setProperty('--accent-color-rgb', '0, 224, 179'); /* RGB for #00e0b3 */


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
                    
                    // Only add style if not already present
                    if (!document.getElementById('clickRippleKeyframes')) {
                        const style = document.createElement('style');
                        style.id = 'clickRippleKeyframes';
                        style.textContent = `
                            @keyframes clickRipple {
                                to {
                                    transform: scale(3); /* Larger ripple */
                                    opacity: 0;
                                }
                            }
                        `;
                        document.head.appendChild(style);
                    }
                    
                    this.appendChild(circle);
                    
                    // Remove ripple after animation
                    circle.addEventListener('animationend', () => {
                        circle.remove();
                    });
                });
            });
        }

        // Mouse movement parallax for hero elements
        function setupMouseParallax() {
            const heroSection = document.querySelector('.hero');
            const books = document.querySelectorAll('.book');
            const heroTitle = document.querySelector('.hero-title');
            const heroDescription = document.querySelector('.hero-description');

            if (window.innerWidth > 992) { // Apply only on larger screens
                heroSection.addEventListener('mousemove', (e) => {
                    const rect = heroSection.getBoundingClientRect();
                    const centerX = rect.left + rect.width / 2;
                    const centerY = rect.top + rect.height / 2;

                    const mouseX = e.clientX - centerX;
                    const mouseY = e.clientY - centerY;
                    
                    books.forEach((book, index) => {
                        const speed = (index + 1) * 0.02; // Slower, more subtle movement
                        const x = mouseX * speed;
                        const y = mouseY * speed;
                        
                        // Apply movement relative to its initial position
                        const initialTransform = book.dataset.initialTransform || getComputedStyle(book).transform;
                        book.dataset.initialTransform = initialTransform; // Store initial transform

                        book.style.transform = `${initialTransform} translate(${x}px, ${y}px)`;
                    });

                    // Add subtle parallax to text
                    heroTitle.style.transform = `translate(${-mouseX * 0.01}px, ${-mouseY * 0.01}px)`;
                    heroDescription.style.transform = `translate(${-mouseX * 0.005}px, ${-mouseY * 0.005}px)`;
                });

                // Reset on mouse leave for smoother experience
                heroSection.addEventListener('mouseleave', () => {
                    books.forEach(book => {
                        book.style.transform = book.dataset.initialTransform;
                    });
                    heroTitle.style.transform = `translate(0,0)`;
                    heroDescription.style.transform = `translate(0,0)`;
                });
            }
        }

        // Initialize all features when page loads
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();
            setupScrollAnimations();
            setupParallax();
            setupButtonEffects();
            setupMouseParallax(); // Only active on larger screens by its internal logic
            
            // Re-initialize particles on resize
            window.addEventListener('resize', () => {
                createParticles();
                setupMouseParallax(); // Re-evaluate mouse parallax on resize
            });
        });

        // Performance optimization: throttle scroll events (already well-implemented)
        // No changes needed for throttle function itself, it's good.
    </script>
</body>
</html>