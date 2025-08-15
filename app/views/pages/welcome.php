<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Central Library</title>
    <link rel="stylesheet" href="<?php echo URLROOT;?>/librarycss/welcome.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@300;400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        .book-1 {
    background-image: url('/images/book1.avif');
    background-size: cover;
    background-position: center;
}
.book-2 {
    background-image: url('/images/book2.avif');
    background-size: cover;
    background-position: center;
}
.book-3 {
    background-image: url('/images/book3.avif');
    background-size: cover;
    background-position: center;
}

    </style>
</head>
<body>
    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-background">
                <div class="floating-particles"></div>
            </div>
            <div class="hero-content">
                <h1 class="hero-title">Welcome to Our Library</h1>
                <p class="hero-description">Where knowledge meets curiosity and stories come alive. Discover, learn, and explore in our sanctuary of books and digital resources.</p>
                <div class="hero-actions">
                    <a href="<?php echo URLROOT;?>/pages/home"><button class="btn btn-primary">Get Knowledge</button></a>
                    <a href="<?php echo URLROOT;?>/pages/login"><button class="btn btn-primary">Login</button></a>
                </div>
            </div>
            <div class="hero-visual">
                <div class="book-stack">
                    <div class="book book-1" >
                    </div>
                    <div class="book book-2"></div>
                    <div class="book book-3"></div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="services">
            <div class="container">
                <h2 class="section-title">Our Services</h2>
                <div class="services-grid">
                    <div class="service-card">
                        <div class="service-icon">📚</div>
                        <h3>Book Collection</h3>
                        <p>Over 50,000 books across all genres, from classic literature to contemporary bestsellers and academic resources.</p>
                    </div>
                    <div class="service-card">
                        <div class="service-icon">💻</div>
                        <h3>Digital Resources</h3>
                        <p>Access e-books, audiobooks, online databases, and digital archives from anywhere with your library card.</p>
                    </div>
                    <div class="service-card">
                        <div class="service-icon">👥</div>
                        <h3>Study Spaces</h3>
                        <p>Quiet reading areas, group study rooms, and collaborative workspaces designed for productive learning.</p>
                    </div>
                    <div class="service-card">
                        <div class="service-icon">🎓</div>
                        <h3>Research Help</h3>
                        <p>Professional librarians ready to assist with research projects, citations, and finding the right resources.</p>
                    </div>
                    <div class="service-card">
                        <div class="service-icon">📅</div>
                        <h3>Events & Programs</h3>
                        <p>Book clubs, author readings, workshops, and community events for all ages and interests.</p>
                    </div>
                    <div class="service-card">
                        <div class="service-icon">👶</div>
                        <h3>Children's Section</h3>
                        <p>Dedicated space for young readers with picture books, storytimes, and educational activities.</p>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <script>
        // Add floating particles animation
        function createParticles() {
            const particlesContainer = document.querySelector('.floating-particles');
            const particleCount = 20;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 10 + 's';
                particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
                particlesContainer.appendChild(particle);
            }
        }

        // Initialize particles when page loads
        document.addEventListener('DOMContentLoaded', createParticles);

        // Add smooth hover effects to service cards
        document.querySelectorAll('.service-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</body>
</html>