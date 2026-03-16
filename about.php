<?php
session_start();
require_once '../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - AgroScan</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/about.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <!-- Simple About Section -->
        <div class="about-container" style="text-align: center; padding: 60px 20px; max-width: 800px; margin: 0 auto;">
            <h1 style="font-size: 2.5rem; color: #1a4d2e; margin-bottom: 20px;">About AgroScan</h1>
            <p style="font-size: 1.2rem; color: #2e5f3d; margin-bottom: 40px;">Your AI-powered plant disease detection assistant</p>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; text-align: left;">
                <section style="background: white; padding: 30px; border-radius: 20px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                    <h2 style="color: #1a4d2e; margin-bottom: 15px;"><i class="fas fa-leaf" style="color: #27ae60; margin-right: 10px;"></i>Our Mission</h2>
                    <p style="color: #2e5f3d; line-height: 1.6;">To help gardeners and farmers protect their plants through early disease detection and expert recommendations.</p>
                </section>
                
                <section style="background: white; padding: 30px; border-radius: 20px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                    <h2 style="color: #1a4d2e; margin-bottom: 15px;"><i class="fas fa-microchip" style="color: #27ae60; margin-right: 10px;"></i>How It Works</h2>
                    <p style="color: #2e5f3d; line-height: 1.6;">Using advanced machine learning, AgroScan can identify plant diseases from photos with 94% accuracy.</p>
                </section>
                
                <section style="background: white; padding: 30px; border-radius: 20px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                    <h2 style="color: #1a4d2e; margin-bottom: 15px;"><i class="fas fa-envelope" style="color: #27ae60; margin-right: 10px;"></i>Contact Us</h2>
                    <p style="color: #2e5f3d; line-height: 1.6;">Email: support@agroscan.com<br>Phone: +1 (800) 123-4567</p>
                </section>
            </div>
        </div>

        <!-- Hero Section -->
        <section class="about-hero">
            <div class="hero-content">
                <h1 class="hero-title">Empowering Farmers with AI Technology</h1>
                <p class="hero-subtitle">AgroScan is a diploma project that uses machine learning to help farmers and gardeners detect plant diseases instantly.</p>
                <div class="hero-buttons">
                    <a href="scan.php" class="primary-btn">
                        <i class="fas fa-camera"></i> Try It Now
                    </a>
                    <a href="#mission" class="secondary-btn">
                        <i class="fas fa-arrow-down"></i> Learn More
                    </a>
                </div>
            </div>
            <div class="hero-image">
                <img src="../images/about-hero.svg" alt="AI Plant Analysis" onerror="this.src='https://via.placeholder.com/500x400?text=AI+Plant+Analysis'">
            </div>
        </section>

        <!-- Mission Section -->
        <section id="mission" class="mission-section">
            <h2 class="section-title">Our Mission</h2>
            <p class="section-subtitle">Making plant disease detection accessible to everyone</p>
            
            <div class="mission-grid">
                <div class="mission-card">
                    <div class="mission-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3>Help Small Farmers</h3>
                    <p>Small farmers often lack access to plant pathology experts. AgroScan gives them instant diagnosis in their pocket.</p>
                </div>
                
                <div class="mission-card">
                    <div class="mission-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>Fast & Accurate</h3>
                    <p>Using advanced machine learning, our AI model can identify diseases in seconds with high accuracy.</p>
                </div>
                
                <div class="mission-card">
                    <div class="mission-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3>Reduce Crop Loss</h3>
                    <p>Early detection means early treatment, helping reduce crop loss and increase food security.</p>
                </div>
            </div>
        </section>

        <!-- Story Section -->
        <section class="story-section">
            <div class="story-content">
                <h2 class="story-title">The Story Behind AgroScan</h2>
                <p class="story-text">
                    AgroScan was created as a diploma project by a student who saw the struggles of local farmers firsthand. 
                    Traditional plant disease diagnosis requires sending samples to labs, which takes days or weeks. 
                    By then, the disease may have already spread.
                </p>
                <p class="story-text">
                    The goal was simple: build a tool that anyone with a smartphone can use to get instant, accurate 
                    plant disease diagnosis. Using machine learning, we trained a model on thousands of 
                    plant leaf images to recognize common diseases.
                </p>
                <div class="story-highlight">
                    <i class="fas fa-quote-left"></i>
                    <p>Every farmer deserves access to plant health expertise, regardless of their location or resources.</p>
                    <span>- Project Creator</span>
                </div>
            </div>
            <div class="story-image">
                <img src="../images/farmer-story.jpg" alt="Farmer using AgroScan" onerror="this.src='https://via.placeholder.com/500x600?text=Farmer+using+app'">
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="how-it-works">
            <h2 class="section-title">How It Works</h2>
            <p class="section-subtitle">Three simple steps to protect your plants</p>
            
            <div class="steps-container">
                <div class="step-item">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>Upload a Photo</h3>
                        <p>Take a clear photo of the affected plant leaf or upload from your gallery.</p>
                    </div>
                </div>
                
                <div class="step-item">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>AI Analysis</h3>
                        <p>Our model compares your image with thousands of disease patterns.</p>
                    </div>
                </div>
                
                <div class="step-item">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>Get Results</h3>
                        <p>Receive instant diagnosis with treatment recommendations.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Technology Section - FIXED -->
        <section class="tech-section">
            <h2 class="section-title">Powered By</h2>
            
            <div class="tech-grid">
                <div class="tech-card">
                    <i class="fas fa-brain"></i>
                    <h3>Machine Learning</h3>
                    <p>Advanced AI algorithms trained on thousands of plant disease images for accurate detection</p>
                </div>
                
                <div class="tech-card">
                    <i class="fas fa-database"></i>
                    <h3>Comprehensive Database</h3>
                    <p>Extensive collection of plant diseases covering a wide range of species and conditions</p>
                </div>
                
                <div class="tech-card">
                    <i class="fas fa-mobile-alt"></i>
                    <h3>Easy to Use</h3>
                    <p>Simple interface designed for farmers and gardeners of all technical backgrounds</p>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="team-section">
            <h2 class="section-title">Project Team</h2>
            <p class="section-subtitle">Created with passion for plant health</p>
            
            <div class="team-grid">
                <div class="team-card">
                    <div class="team-avatar">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3>Derick Lazaro</h3>
                    <p class="team-role">Developer & Researcher</p>
                    <p class="team-bio">Diploma student passionate about AI and agriculture</p>
                </div>
                
                <div class="team-card">
                    <div class="team-avatar">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3>Supervisor Name</h3>
                    <p class="team-role">Project Supervisor</p>
                    <p class="team-bio">Guided the project development and research</p>
                </div>
                
                <div class="team-card">
                    <div class="team-avatar">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h3>Local Farmers</h3>
                    <p class="team-role">Beta Testers</p>
                    <p class="team-bio">Provided valuable feedback and real-world testing</p>
                </div>
            </div>
        </section>

        <!-- Stats Section - REMOVED 200+ species -->
        <section class="stats-section">
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-number" id="diseaseStat">1,250+</span>
                    <span class="stat-label">Plant Diseases</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">94%</span>
                    <span class="stat-label">Accuracy Rate</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">50K+</span>
                    <span class="stat-label">Scans Processed</span>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="cta-section">
            <div class="cta-content">
                <h2>Ready to protect your plants?</h2>
                <p>Try AgroScan now - it's free and works instantly</p>
                <a href="scan.php" class="cta-btn">
                    <i class="fas fa-camera"></i> Scan a Plant
                </a>
            </div>
        </section>
    </main>

    <?php include '../includes/footer.php'; ?>

    <script>
        // Dynamic Disease Counter for About Page - FIXED to read actual count
        async function updateAboutDiseaseCounter() {
            try {
                const response = await fetch('../get-disease-stats.php');
                const data = await response.json();
                
                if (data.success) {
                    const diseaseCount = data.total_diseases;
                    console.log('Actual disease count from database:', diseaseCount);
                    
                    // Find the plant diseases stat card by its ID
                    const diseaseStatElement = document.getElementById('diseaseStat');
                    if (diseaseStatElement) {
                        animateAboutCounter(diseaseStatElement, diseaseCount);
                    }
                }
            } catch (error) {
                console.error('Error fetching disease count:', error);
                // Fallback to default
                const diseaseStatElement = document.getElementById('diseaseStat');
                if (diseaseStatElement) {
                    diseaseStatElement.textContent = '1,250+';
                }
            }
        }

        // Animate counter function for about page
        function animateAboutCounter(element, target) {
            const duration = 2000;
            const steps = 50;
            const stepValue = target / steps;
            let current = 0;
            
            const originalText = element.textContent;
            const hasPlus = originalText.includes('+');
            
            const timer = setInterval(() => {
                current += stepValue;
                if (current >= target) {
                    let finalText = Math.floor(target).toLocaleString();
                    if (hasPlus) finalText += '+';
                    element.textContent = finalText;
                    clearInterval(timer);
                } else {
                    let currentText = Math.floor(current).toLocaleString();
                    if (hasPlus) currentText += '+';
                    element.textContent = currentText;
                }
            }, duration / steps);
        }

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            updateAboutDiseaseCounter();
            
            // Animate stats when they come into view
            const statsSection = document.querySelector('.stats-section');
            if (statsSection) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            updateAboutDiseaseCounter();
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.5 });
                
                observer.observe(statsSection);
            }
        });
    </script>
</body>
</html>