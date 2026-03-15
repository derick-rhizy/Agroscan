<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session
session_start();

require_once 'config/config.php';
require_once 'config/db.php';

// Fetch existing reviews
$reviews_stmt = $pdo->query("SELECT * FROM reviews WHERE is_approved = 1 ORDER BY created_at DESC LIMIT 6");
$reviews = $reviews_stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroScan - Smart Plant Disease Detection</title>
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* Review Modal Styles */
        .review-modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            align-items: center;
            justify-content: center;
        }

        .review-modal-content {
            background: white;
            border-radius: 30px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideInUp 0.3s;
        }

        @keyframes slideInUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .review-modal h2 {
            color: #1a4d2e;
            margin-bottom: 10px;
            font-size: 1.8rem;
        }

        .review-modal p {
            color: #2e5f3d;
            margin-bottom: 25px;
        }

        .rating-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
        }

        .rating-label {
            color: #1e4f32;
            font-weight: 500;
        }

        .star-rating {
            display: flex;
            gap: 10px;
            font-size: 2rem;
            cursor: pointer;
        }

        .star-rating i {
            color: #ddd; /* Default gray for unselected stars */
            transition: color 0.2s;
        }

        .star-rating i.fas.fa-star {
            color: #f39c12; /* Yellow for selected stars */
        }

        .star-rating i:hover {
            color: #f1c40f; /* Lighter yellow on hover */
        }

        .rating-hint {
            font-size: 0.9rem;
            color: #7a9a83;
        }

        .review-form-group {
            margin-bottom: 20px;
        }

        .review-form-group label {
            display: block;
            margin-bottom: 8px;
            color: #1e4f32;
            font-weight: 500;
        }

        .review-form-group input,
        .review-form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0f0e0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s;
            font-family: inherit;
        }

        .review-form-group input:focus,
        .review-form-group textarea:focus {
            outline: none;
            border-color: #27ae60;
            box-shadow: 0 0 0 4px rgba(39, 174, 96, 0.1);
        }

        .review-form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .review-form-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
        }

        .review-submit-btn {
            background: #27ae60;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 30px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .review-submit-btn:hover {
            background: #219a52;
            transform: translateY(-2px);
        }

        .review-cancel-btn {
            background: #f8f9fa;
            color: #666;
            border: none;
            border-radius: 12px;
            padding: 12px 30px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .review-cancel-btn:hover {
            background: #e0e0e0;
        }

        .review-status {
            margin-top: 15px;
            padding: 12px;
            border-radius: 8px;
            display: none;
        }

        .review-status.success {
            display: block;
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .review-status.error {
            display: block;
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .login-prompt {
            background: #e8f5e8;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .login-prompt p {
            margin-bottom: 15px;
            color: #1e4f32;
        }

        .login-prompt-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .login-prompt-btn {
            padding: 10px 20px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .login-prompt-btn.login {
            background: #27ae60;
            color: white;
        }

        .login-prompt-btn.register {
            background: white;
            color: #27ae60;
            border: 2px solid #27ae60;
        }

        .login-prompt-btn:hover {
            transform: translateY(-2px);
        }

        .load-more-reviews {
            text-align: center;
            margin-top: 30px;
        }

        .load-more-btn {
            background: transparent;
            color: #27ae60;
            border: 2px solid #27ae60;
            border-radius: 50px;
            padding: 12px 30px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .load-more-btn:hover {
            background: #27ae60;
            color: white;
        }

        .load-more-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Review Action Buttons */
        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .review-actions {
            display: flex;
            gap: 8px;
        }

        .review-action-btn {
            background: none;
            border: none;
            color: #7a9a83;
            cursor: pointer;
            padding: 5px;
            border-radius: 5px;
            transition: all 0.2s;
            font-size: 0.9rem;
        }

        .review-action-btn:hover {
            background: #f0f9f0;
            color: #27ae60;
        }

        .review-action-btn.delete:hover {
            color: #e74c3c;
        }

        .edited-badge {
            font-size: 0.8rem;
            color: #7a9a83;
            margin-left: 8px;
            font-style: italic;
        }

        .edit-modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            align-items: center;
            justify-content: center;
        }

        .edit-modal-content {
            background: white;
            border-radius: 30px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideInUp 0.3s;
        }

        .edit-modal h2 {
            color: #1a4d2e;
            margin-bottom: 10px;
            font-size: 1.8rem;
        }

        .edit-modal p {
            color: #2e5f3d;
            margin-bottom: 25px;
        }

        /* Hero section with background image */
        .hero-section {
            position: relative;
            background-image: url('images/background image/image.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 600px;
            display: flex;
            align-items: center;
            isolation: isolate;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }

        .hero-section .hero-content {
            position: relative;
            z-index: 1;
            color: white;
            padding: 60px 40px;
        }

        .hero-section .hero-title,
        .hero-section .hero-subtitle,
        .hero-section .welcome-message {
            color: white;
        }

        .hero-section .primary-button {
            background: #27ae60;
            color: white;
            border: none;
        }

        .hero-section .secondary-button {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .hero-section .secondary-button:hover {
            background: white;
            color: #27ae60;
        }

        .hero-section .metric-number,
        .hero-section .metric-label {
            color: white;
        }

        .hero-visual {
            display: none;
        }

        /* Dark Mode Styles for Home Page */
        body.dark-mode .featured-section {
            background: #2d2d2d;
        }

        body.dark-mode .section-title,
        body.dark-mode .section-subtitle {
            color: #e0e0e0;
        }

        body.dark-mode .disease-card {
            background: #3d3d3d;
            border-color: #4d4d4d;
        }

        body.dark-mode .disease-name {
            color: #e0e0e0;
        }

        body.dark-mode .disease-description {
            color: #b0b0b0;
        }

        body.dark-mode .card-link {
            color: #27ae60;
        }

        body.dark-mode .how-it-works-section {
            background: linear-gradient(145deg, #2d2d2d, #1a1a1a);
        }

        body.dark-mode .step-item {
            background: #3d3d3d;
            border-color: #4d4d4d;
        }

        body.dark-mode .step-title {
            color: #e0e0e0;
        }

        body.dark-mode .step-description {
            color: #b0b0b0;
        }

        body.dark-mode .reviews-section {
            background: #2d2d2d;
        }

        body.dark-mode .review-card {
            background: #3d3d3d;
            border-color: #4d4d4d;
        }

        body.dark-mode .review-text {
            color: #e0e0e0;
        }

        body.dark-mode .reviewer {
            color: #b0b0b0;
        }
    </style>
</head>
<body>
    <!-- Include Header -->
    <?php include 'includes/header.php'; ?>

    <main>
        <!-- Hero Section with Background Image -->
        <section class="hero-section">
            <div class="hero-content">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <h1 class="hero-title">Ready to Protect Your Plants?</h1>
                    <p class="hero-subtitle">Scan your plants now to detect diseases early and get treatment recommendations.</p>
                    
                    <div class="hero-buttons">
                        <a href="html/scan.php" class="primary-button">
                            <i class="fas fa-cloud-upload-alt"></i> Scan New Plant
                        </a>
                        <a href="html/history.php" class="secondary-button">
                            <i class="fas fa-history"></i> View History
                        </a>
                    </div>
                    
                    <div class="welcome-message" style="background: #27ae60; color: white; padding: 15px; border-radius: 50px; display: inline-block; margin-bottom: 20px;">
                        <i class="fas fa-leaf"></i> 
                        Welcome back, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!
                    </div>
                <?php else: ?>
                    <h1 class="hero-title">Keep Your Plants Healthy & Thriving</h1>
                    <p class="hero-subtitle">Identify plant diseases quickly and accurately with our AI-powered scanner. Get instant diagnosis and treatment recommendations.</p>
                    
                    <div class="hero-buttons">
                        <a href="html/scan.php" class="primary-button">
                            <i class="fas fa-cloud-upload-alt"></i> Upload Image
                        </a>
                        <a href="html/diseases.php" class="secondary-button">
                            <i class="fas fa-leaf"></i> Browse Diseases
                        </a>
                    </div>
                <?php endif; ?>
                
                <div class="metrics-container">
                    <div class="metric-item">
                        <span class="metric-number" id="diseaseMetric">1,250+</span>
                        <span class="metric-label">Plant Diseases</span>
                    </div>
                    <div class="metric-item">
                        <span class="metric-number">94%</span>
                        <span class="metric-label">Accuracy Rate</span>
                    </div>
                    <div class="metric-item">
                        <span class="metric-number">50K+</span>
                        <span class="metric-label">Happy Gardeners</span>
                    </div>
                    <div class="metric-item">
                        <span class="metric-number">24/7</span>
                        <span class="metric-label">Expert Support</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Diseases Section -->
        <section class="featured-section">
            <h2 class="section-title">Featured Diseases</h2>
            <p class="section-subtitle">Common plant diseases and their symptoms</p>
            
            <div class="diseases-grid">
                <?php
                // Fetch 3 featured diseases from database
                try {
                    $stmt = $pdo->query("SELECT id, name, description, severity FROM diseases ORDER BY RAND() LIMIT 3");
                    while($disease = $stmt->fetch()) {
                        $severity_class = strtolower($disease['severity'] ?? 'medium');
                        $desc = substr($disease['description'] ?? 'No description available.', 0, 100) . '...';
                        
                        echo '<article class="disease-card">';
                        echo '<h3 class="disease-name">' . htmlspecialchars($disease['name']) . '</h3>';
                        echo '<span class="severity-badge ' . $severity_class . '">' . ucfirst($severity_class) . ' Severity</span>';
                        echo '<p class="disease-description">' . htmlspecialchars($desc) . '</p>';
                        echo '<a href="html/disease-details.php?id=' . $disease['id'] . '" class="card-link">';
                        echo 'View Details <i class="fas fa-arrow-right"></i>';
                        echo '</a>';
                        echo '</article>';
                    }
                } catch(Exception $e) {
                    // Fallback if database fails
                    ?>
                    <article class="disease-card">
                        <h3 class="disease-name">Powdery Mildew</h3>
                        <span class="severity-badge medium">Medium Severity</span>
                        <p class="disease-description">A fungal disease that appears as white powder on leaves, stems, and flowers.</p>
                        <a href="html/disease-details.php?disease=powdery-mildew" class="card-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </article>
                    
                    <article class="disease-card">
                        <h3 class="disease-name">Root Rot</h3>
                        <span class="severity-badge high">High Severity</span>
                        <p class="disease-description">Decay of plant roots due to overwatering or fungal infection, leading to wilting.</p>
                        <a href="html/disease-details.php?disease=root-rot" class="card-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </article>
                    
                    <article class="disease-card">
                        <h3 class="disease-name">Black Spot</h3>
                        <span class="severity-badge medium">Medium Severity</span>
                        <p class="disease-description">Dark spots on leaves, yellowing, and early leaf drop. Common in roses.</p>
                        <a href="html/disease-details.php?disease=black-spot" class="card-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </article>
                    <?php
                }
                ?>
            </div>
            
            <div class="view-all-container">
                <a href="html/diseases.php" class="view-all-link">
                    View All Diseases <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </section>

        <!-- How It Works Section - 3 steps only -->
        <section class="how-it-works-section">
            <h2 class="section-title light">How It Works</h2>
            <p class="section-subtitle light">Simple steps to diagnose your plant problems.</p>
            
            <div class="steps-container" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; max-width: 1200px; margin: 0 auto;">
                <div class="step-item">
                    <div class="step-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <h4 class="step-title">Upload Image</h4>
                    <p class="step-description">Take a clear photo of the affected plant part or upload from your gallery.</p>
                </div>
                
                <div class="step-item">
                    <div class="step-icon">
                        <i class="fas fa-microchip"></i>
                    </div>
                    <h4 class="step-title">AI Analysis</h4>
                    <p class="step-description">Our advanced algorithm analyzes the image and compares it with our disease database.</p>
                </div>
                
                <div class="step-item">
                    <div class="step-icon">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <h4 class="step-title">Get Results</h4>
                    <p class="step-description">Receive instant diagnosis with treatment recommendations and prevention tips.</p>
                </div>
            </div>
        </section>

        <!-- USER REVIEWS SECTION -->
        <section class="reviews-section">
            <div class="reviews-header">
                <h2 class="reviews-title">What Our Users Say</h2>
                <p class="reviews-subtitle">Real feedback from gardeners and farmers</p>
            </div>
            
            <div class="reviews-grid" id="reviewsContainer">
                <?php if (count($reviews) > 0): ?>
                    <?php foreach ($reviews as $review): ?>
                        <div class="review-card" data-review-id="<?php echo $review['id']; ?>" 
                             data-review-rating="<?php echo $review['rating']; ?>"
                             data-review-text="<?php echo htmlspecialchars($review['review_text']); ?>">
                            <div class="review-header">
                                <div class="review-stars">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <?php if ($i <= $review['rating']): ?>
                                            <i class="fas fa-star" style="color: #f39c12;"></i>
                                        <?php else: ?>
                                            <i class="far fa-star" style="color: #ddd;"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                                
                                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $review['user_id']): ?>
                                <div class="review-actions">
                                    <button class="review-action-btn edit-review" onclick="openEditModal(<?php echo $review['id']; ?>)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="review-action-btn delete" onclick="deleteReview(<?php echo $review['id']; ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <p class="review-text">"<?php echo htmlspecialchars($review['review_text']); ?>"</p>
                            
                            <div class="reviewer">
                                <i class="fas fa-user-circle"></i>
                                <strong><?php echo htmlspecialchars($review['user_name']); ?></strong>
                                <?php if ($review['is_edited']): ?>
                                    <span class="edited-badge">(edited)</span>
                                <?php endif; ?>
                                <span style="color: #7a9a83; font-size: 0.85rem; margin-left: 8px;">
                                    <?php echo date('M j, Y', strtotime($review['created_at'])); ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Fallback reviews -->
                    <div class="review-card">
                        <div class="review-stars">
                            <i class="fas fa-star" style="color: #f39c12;"></i>
                            <i class="fas fa-star" style="color: #f39c12;"></i>
                            <i class="fas fa-star" style="color: #f39c12;"></i>
                            <i class="fas fa-star" style="color: #f39c12;"></i>
                            <i class="fas fa-star" style="color: #f39c12;"></i>
                        </div>
                        <p class="review-text">"This app saved my tomato plants! Identified early blight immediately and gave me treatment options."</p>
                        <div class="reviewer">
                            <i class="fas fa-user-circle"></i>
                            <strong>Sarah Johnson</strong>
                        </div>
                    </div>
                    
                    <div class="review-card">
                        <div class="review-stars">
                            <i class="fas fa-star" style="color: #f39c12;"></i>
                            <i class="fas fa-star" style="color: #f39c12;"></i>
                            <i class="fas fa-star" style="color: #f39c12;"></i>
                            <i class="fas fa-star" style="color: #f39c12;"></i>
                            <i class="fas fa-star-half-alt" style="color: #f39c12;"></i>
                        </div>
                        <p class="review-text">"Very accurate and easy to use. The prevention tips are really helpful for my small farm."</p>
                        <div class="reviewer">
                            <i class="fas fa-user-circle"></i>
                            <strong>Mike Chen</strong>
                        </div>
                    </div>
                    
                    <div class="review-card">
                        <div class="review-stars">
                            <i class="fas fa-star" style="color: #f39c12;"></i>
                            <i class="fas fa-star" style="color: #f39c12;"></i>
                            <i class="fas fa-star" style="color: #f39c12;"></i>
                            <i class="fas fa-star" style="color: #f39c12;"></i>
                            <i class="far fa-star" style="color: #ddd;"></i>
                        </div>
                        <p class="review-text">"Great tool for home gardeners. Quick diagnosis and clear instructions. Highly recommended!"</p>
                        <div class="reviewer">
                            <i class="fas fa-user-circle"></i>
                            <strong>Priya Patel</strong>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="reviews-footer">
                <button class="write-review-btn" id="writeReviewBtn">
                    <i class="fas fa-pen"></i> Write a Review
                </button>
            </div>
        </section>
    </main>

    <!-- Review Modal -->
    <div id="reviewModal" class="review-modal">
        <div class="review-modal-content">
            <h2>Write a Review</h2>
            <p>Share your experience with AgroScan</p>
            
            <?php if (!isset($_SESSION['user_id'])): ?>
                <div class="login-prompt">
                    <p>Please login or register to write a review</p>
                    <div class="login-prompt-buttons">
                        <a href="auth/login.php" class="login-prompt-btn login">Login</a>
                        <a href="auth/register.php" class="login-prompt-btn register">Register</a>
                    </div>
                </div>
            <?php endif; ?>
            
            <form id="reviewForm">
                <div class="rating-container">
                    <span class="rating-label">Your Rating</span>
                    <div class="star-rating" id="starRating">
                        <i class="far fa-star" data-rating="1"></i>
                        <i class="far fa-star" data-rating="2"></i>
                        <i class="far fa-star" data-rating="3"></i>
                        <i class="far fa-star" data-rating="4"></i>
                        <i class="far fa-star" data-rating="5"></i>
                    </div>
                    <span class="rating-hint">Click on the stars to rate</span>
                </div>
                
                <input type="hidden" name="rating" id="ratingValue" value="0">
                
                <?php if (!isset($_SESSION['user_id'])): ?>
                <div class="review-form-group">
                    <label for="user_name">Your Name</label>
                    <input type="text" id="user_name" name="user_name" placeholder="Enter your name" required>
                </div>
                <?php endif; ?>
                
                <div class="review-form-group">
                    <label for="review_text">Your Review</label>
                    <textarea id="review_text" name="review_text" placeholder="Tell us about your experience..." required minlength="10"></textarea>
                </div>
                
                <div class="review-status" id="reviewStatus"></div>
                
                <div class="review-form-actions">
                    <button type="button" class="review-cancel-btn" id="cancelReviewBtn">Cancel</button>
                    <button type="submit" class="review-submit-btn" id="submitReviewBtn">
                        <i class="fas fa-paper-plane"></i> Submit Review
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Review Modal -->
    <div id="editReviewModal" class="edit-modal">
        <div class="edit-modal-content">
            <h2>Edit Your Review</h2>
            <p>Update your experience with AgroScan</p>
            
            <form id="editReviewForm">
                <input type="hidden" name="review_id" id="editReviewId" value="">
                
                <div class="rating-container">
                    <span class="rating-label">Your Rating</span>
                    <div class="star-rating" id="editStarRating">
                        <i class="far fa-star" data-rating="1"></i>
                        <i class="far fa-star" data-rating="2"></i>
                        <i class="far fa-star" data-rating="3"></i>
                        <i class="far fa-star" data-rating="4"></i>
                        <i class="far fa-star" data-rating="5"></i>
                    </div>
                    <span class="rating-hint">Click on the stars to rate</span>
                </div>
                
                <input type="hidden" name="rating" id="editRatingValue" value="0">
                
                <div class="review-form-group">
                    <label for="edit_review_text">Your Review</label>
                    <textarea id="edit_review_text" name="review_text" placeholder="Tell us about your experience..." required minlength="10"></textarea>
                </div>
                
                <div class="review-status" id="editReviewStatus"></div>
                
                <div class="review-form-actions">
                    <button type="button" class="review-cancel-btn" id="cancelEditBtn">Cancel</button>
                    <button type="submit" class="review-submit-btn" id="submitEditBtn">
                        <i class="fas fa-save"></i> Update Review
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Include Footer -->
    <?php include 'includes/footer.php'; ?>

    <!-- JavaScript -->
    <script>
        // Mobile menu toggle
        document.querySelector('.mobile-menu-toggle')?.addEventListener('click', function() {
            document.querySelector('.navigation-menu').classList.toggle('active');
            
            const icon = this.querySelector('i');
            if (document.querySelector('.navigation-menu').classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const menu = document.querySelector('.navigation-menu');
            const toggle = document.querySelector('.mobile-menu-toggle');
            
            if (menu && toggle && !menu.contains(event.target) && !toggle.contains(event.target)) {
                menu.classList.remove('active');
                const icon = toggle.querySelector('i');
                if (icon) {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            }
        });

        // Review Modal Functionality
        const modal = document.getElementById('reviewModal');
        const writeReviewBtn = document.getElementById('writeReviewBtn');
        const cancelBtn = document.getElementById('cancelReviewBtn');
        const stars = document.querySelectorAll('#starRating i');
        const ratingInput = document.getElementById('ratingValue');
        const reviewForm = document.getElementById('reviewForm');
        const reviewStatus = document.getElementById('reviewStatus');

        // Open modal
        if (writeReviewBtn) {
            writeReviewBtn.addEventListener('click', () => {
                modal.style.display = 'flex';
            });
        }

        // Close modal
        if (cancelBtn) {
            cancelBtn.addEventListener('click', () => {
                modal.style.display = 'none';
                reviewForm.reset();
                resetStars();
                reviewStatus.style.display = 'none';
            });
        }

        // Close modal when clicking outside
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
                reviewForm.reset();
                resetStars();
                reviewStatus.style.display = 'none';
            }
        });

        // Close with Escape key
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && modal.style.display === 'flex') {
                modal.style.display = 'none';
                reviewForm.reset();
                resetStars();
                reviewStatus.style.display = 'none';
            }
        });

        // Star rating functionality for write review
        function resetStars() {
            stars.forEach(star => {
                star.className = 'far fa-star';
            });
            ratingInput.value = '0';
        }

        stars.forEach(star => {
            star.addEventListener('mouseenter', () => {
                const rating = star.dataset.rating;
                stars.forEach((s, index) => {
                    if (index < rating) {
                        s.className = 'fas fa-star';
                    } else {
                        s.className = 'far fa-star';
                    }
                });
            });

            star.addEventListener('mouseleave', () => {
                const currentRating = ratingInput.value;
                if (currentRating > 0) {
                    stars.forEach((s, index) => {
                        if (index < currentRating) {
                            s.className = 'fas fa-star';
                        } else {
                            s.className = 'far fa-star';
                        }
                    });
                } else {
                    resetStars();
                }
            });

            star.addEventListener('click', () => {
                const rating = star.dataset.rating;
                ratingInput.value = rating;
                
                stars.forEach((s, index) => {
                    if (index < rating) {
                        s.className = 'fas fa-star';
                    } else {
                        s.className = 'far fa-star';
                    }
                });
            });
        });

        // Submit review
        if (reviewForm) {
            reviewForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const rating = ratingInput.value;
                const reviewText = document.getElementById('review_text').value;
                const userName = document.getElementById('user_name')?.value || '';
                
                // Validate
                if (rating == 0) {
                    reviewStatus.className = 'review-status error';
                    reviewStatus.innerHTML = '<i class="fas fa-exclamation-circle"></i> Please select a rating';
                    reviewStatus.style.display = 'block';
                    return;
                }
                
                if (reviewText.length < 10) {
                    reviewStatus.className = 'review-status error';
                    reviewStatus.innerHTML = '<i class="fas fa-exclamation-circle"></i> Review must be at least 10 characters';
                    reviewStatus.style.display = 'block';
                    return;
                }
                
                // Disable submit button
                const submitBtn = document.getElementById('submitReviewBtn');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
                
                // Prepare form data
                const formData = new FormData();
                formData.append('rating', rating);
                formData.append('review_text', reviewText);
                if (userName) formData.append('user_name', userName);
                
                try {
                    const response = await fetch('submit-review.php', {
                        method: 'POST',
                        body: formData
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        reviewStatus.className = 'review-status success';
                        reviewStatus.innerHTML = '<i class="fas fa-check-circle"></i> ' + data.message;
                        reviewStatus.style.display = 'block';
                        
                        // Reset form after 2 seconds
                        setTimeout(() => {
                            modal.style.display = 'none';
                            reviewForm.reset();
                            resetStars();
                            reviewStatus.style.display = 'none';
                            
                            // Reload reviews
                            location.reload();
                        }, 2000);
                    } else {
                        reviewStatus.className = 'review-status error';
                        reviewStatus.innerHTML = '<i class="fas fa-exclamation-circle"></i> ' + data.error;
                        reviewStatus.style.display = 'block';
                        
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Submit Review';
                    }
                } catch (error) {
                    reviewStatus.className = 'review-status error';
                    reviewStatus.innerHTML = '<i class="fas fa-exclamation-circle"></i> Network error. Please try again.';
                    reviewStatus.style.display = 'block';
                    
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Submit Review';
                }
            });
        }

        // Animate stats counter when in viewport
        function animateStats() {
            const stats = document.querySelectorAll('.metric-number');
            stats.forEach(stat => {
                const value = stat.innerText.replace('+', '').replace('%', '').replace(',', '');
                if (!isNaN(value) && value > 0) {
                    let current = 0;
                    const increment = value / 50;
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= value) {
                            stat.innerText = stat.innerText.includes('%') ? value + '%' : 
                                           (stat.innerText.includes('+') ? value + '+' : value);
                            clearInterval(timer);
                        } else {
                            stat.innerText = stat.innerText.includes('%') ? Math.floor(current) + '%' : 
                                           (stat.innerText.includes('+') ? Math.floor(current) + '+' : Math.floor(current));
                        }
                    }, 20);
                }
            });
        }

        // Trigger animation when metrics section is visible
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateStats();
                    observer.unobserve(entry.target);
                }
            });
        });

        const metricsSection = document.querySelector('.metrics-container');
        if (metricsSection) {
            observer.observe(metricsSection);
        }
        
        // Edit Review Functionality
        const editModal = document.getElementById('editReviewModal');
        const editForm = document.getElementById('editReviewForm');
        const editReviewId = document.getElementById('editReviewId');
        const editRatingInput = document.getElementById('editRatingValue');
        const editReviewText = document.getElementById('edit_review_text');
        const editStars = document.querySelectorAll('#editStarRating i');
        const editStatus = document.getElementById('editReviewStatus');
        const cancelEditBtn = document.getElementById('cancelEditBtn');

        // Open edit modal with review data
        function openEditModal(reviewId) {
            const reviewCard = document.querySelector(`.review-card[data-review-id="${reviewId}"]`);
            
            if (!reviewCard) return;
            
            const rating = reviewCard.dataset.reviewRating;
            const text = reviewCard.dataset.reviewText;
            
            editReviewId.value = reviewId;
            editRatingInput.value = rating;
            editReviewText.value = text;
            
            // Set stars
            editStars.forEach((star, index) => {
                if (index < rating) {
                    star.className = 'fas fa-star';
                } else {
                    star.className = 'far fa-star';
                }
            });
            
            editModal.style.display = 'flex';
            editStatus.style.display = 'none';
        }

        // Close edit modal
        function closeEditModal() {
            editModal.style.display = 'none';
            editForm.reset();
            editStatus.style.display = 'none';
        }

        // Star rating for edit modal
        editStars.forEach(star => {
            star.addEventListener('mouseenter', () => {
                const rating = star.dataset.rating;
                editStars.forEach((s, index) => {
                    if (index < rating) {
                        s.className = 'fas fa-star';
                    } else {
                        s.className = 'far fa-star';
                    }
                });
            });

            star.addEventListener('mouseleave', () => {
                const currentRating = editRatingInput.value;
                if (currentRating > 0) {
                    editStars.forEach((s, index) => {
                        if (index < currentRating) {
                            s.className = 'fas fa-star';
                        } else {
                            s.className = 'far fa-star';
                        }
                    });
                } else {
                    editStars.forEach(s => s.className = 'far fa-star');
                }
            });

            star.addEventListener('click', () => {
                const rating = star.dataset.rating;
                editRatingInput.value = rating;
                
                editStars.forEach((s, index) => {
                    if (index < rating) {
                        s.className = 'fas fa-star';
                    } else {
                        s.className = 'far fa-star';
                    }
                });
            });
        });

        // Cancel edit
        if (cancelEditBtn) {
            cancelEditBtn.addEventListener('click', closeEditModal);
        }

        // Close modal when clicking outside
        window.addEventListener('click', (event) => {
            if (event.target === editModal) {
                closeEditModal();
            }
        });

        // Submit edit
        if (editForm) {
            editForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const rating = editRatingInput.value;
                const reviewText = editReviewText.value;
                const reviewId = editReviewId.value;
                
                // Validate
                if (rating == 0) {
                    editStatus.className = 'review-status error';
                    editStatus.innerHTML = '<i class="fas fa-exclamation-circle"></i> Please select a rating';
                    editStatus.style.display = 'block';
                    return;
                }
                
                if (reviewText.length < 10) {
                    editStatus.className = 'review-status error';
                    editStatus.innerHTML = '<i class="fas fa-exclamation-circle"></i> Review must be at least 10 characters';
                    editStatus.style.display = 'block';
                    return;
                }
                
                // Disable submit button
                const submitBtn = document.getElementById('submitEditBtn');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
                
                // Prepare form data
                const formData = new FormData();
                formData.append('review_id', reviewId);
                formData.append('rating', rating);
                formData.append('review_text', reviewText);
                
                try {
                    const response = await fetch('edit-review.php', {
                        method: 'POST',
                        body: formData
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        editStatus.className = 'review-status success';
                        editStatus.innerHTML = '<i class="fas fa-check-circle"></i> ' + data.message;
                        editStatus.style.display = 'block';
                        
                        // Reload page after 1.5 seconds to show updated review
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        editStatus.className = 'review-status error';
                        editStatus.innerHTML = '<i class="fas fa-exclamation-circle"></i> ' + data.error;
                        editStatus.style.display = 'block';
                        
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<i class="fas fa-save"></i> Update Review';
                    }
                } catch (error) {
                    editStatus.className = 'review-status error';
                    editStatus.innerHTML = '<i class="fas fa-exclamation-circle"></i> Network error. Please try again.';
                    editStatus.style.display = 'block';
                    
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-save"></i> Update Review';
                }
            });
        }

        // Delete review function
        async function deleteReview(reviewId) {
            if (!confirm('Are you sure you want to delete this review? This action cannot be undone.')) {
                return;
            }
            
            try {
                const formData = new FormData();
                formData.append('review_id', reviewId);
                
                const response = await fetch('delete-review.php', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Remove the review card from DOM
                    const reviewCard = document.querySelector(`.review-card[data-review-id="${reviewId}"]`);
                    if (reviewCard) {
                        reviewCard.remove();
                    }
                    
                    // Show success message
                    alert('Review deleted successfully!');
                    
                    // If no reviews left, reload to show fallback
                    if (document.querySelectorAll('.review-card').length === 0) {
                        location.reload();
                    }
                } else {
                    alert('Error: ' + data.error);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Network error. Please try again.');
            }
        }

        // Dynamic Disease Counter - FIXED for the metric section
        async function updateDiseaseCounter() {
            try {
                const response = await fetch('get-disease-stats.php');
                const data = await response.json();
                
                if (data.success) {
                    const diseaseCount = data.total_diseases;
                    
                    // Find the plant diseases metric element by its ID
                    const diseaseMetric = document.getElementById('diseaseMetric');
                    if (diseaseMetric) {
                        animateMetricCounter(diseaseMetric, diseaseCount);
                    }
                }
            } catch (error) {
                console.error('Error fetching disease count:', error);
                // Fallback to default
                const diseaseMetric = document.getElementById('diseaseMetric');
                if (diseaseMetric) {
                    diseaseMetric.textContent = '1,250+';
                }
            }
        }

        // Animate counter function for metrics
        function animateMetricCounter(element, target) {
            const duration = 2000;
            const steps = 50;
            const stepValue = target / steps;
            let current = 0;
            
            const timer = setInterval(() => {
                current += stepValue;
                if (current >= target) {
                    element.textContent = Math.floor(target).toLocaleString() + '+';
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current).toLocaleString() + '+';
                }
            }, duration / steps);
        }

        // Initialize counters when page loads
        document.addEventListener('DOMContentLoaded', function() {
            updateDiseaseCounter();
        });

        // Also update when user scrolls to metrics section
        const metricsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    updateDiseaseCounter();
                    metricsObserver.unobserve(entry.target);
                }
            });
        });

        const metricsContainer = document.querySelector('.metrics-container');
        if (metricsContainer) {
            metricsObserver.observe(metricsContainer);
        }
    </script>
</body>
</html>