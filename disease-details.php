<?php
session_start();
require_once '../config/config.php';
require_once '../config/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disease Details - AgroScan</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- CSS files -->
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/disease-details.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>
<body>
    <!-- HEADER SECTION - Using include -->
    <?php include '../includes/header.php'; ?>

    <!-- MAIN CONTENT -->
    <main>
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb">
            <a href="../index.php" class="breadcrumb-link">Home</a>
            <i class="fas fa-chevron-right breadcrumb-separator"></i>
            <a href="diseases.php" class="breadcrumb-link">Disease Library</a>
            <i class="fas fa-chevron-right breadcrumb-separator"></i>
            <span class="breadcrumb-current" id="diseaseBreadcrumb">Loading...</span>
        </div>

        <!-- Back Button -->
        <div class="back-nav">
            <a href="diseases.php" class="back-btn">
                <i class="fas fa-arrow-left"></i> Back to Disease Library
            </a>
        </div>

        <!-- Loading Indicator -->
        <div class="loading-indicator" id="loadingIndicator">
            <i class="fas fa-spinner fa-spin"></i>
            <p>Loading disease information...</p>
        </div>

        <!-- Disease Detail Container (hidden initially) -->
        <div class="disease-detail-container" id="diseaseDetailContainer" style="display: none;">
            <!-- Header Section -->
            <div class="detail-header">
                <div class="title-section">
                    <h1 class="disease-title" id="diseaseTitle"></h1>
                    <p class="scientific-name" id="scientificName"></p>
                </div>
                <div class="header-badges">
                    <span class="type-badge" id="typeBadge"></span>
                    <span class="severity-badge" id="severityBadge"></span>
                </div>
            </div>

            <!-- Quick Info Cards -->
            <div class="quick-info-grid">
                <div class="info-card">
                    <i class="fas fa-seedling"></i>
                    <div>
                        <span class="info-label">Affected Plants</span>
                        <span class="info-value" id="affectedPlants">Loading...</span>
                    </div>
                </div>
                <div class="info-card">
                    <i class="fas fa-temperature-high"></i>
                    <div>
                        <span class="info-label">Optimal Conditions</span>
                        <span class="info-value" id="optimalConditions">Loading...</span>
                    </div>
                </div>
                <div class="info-card">
                    <i class="fas fa-tint"></i>
                    <div>
                        <span class="info-label">Humidity Needs</span>
                        <span class="info-value" id="humidityNeeds">Loading...</span>
                    </div>
                </div>
                <div class="info-card">
                    <i class="fas fa-globe"></i>
                    <div>
                        <span class="info-label">Common Regions</span>
                        <span class="info-value" id="commonRegions">Loading...</span>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="detail-grid">
                <!-- Left Column - Images and Gallery -->
                <div class="detail-left">
                    <div class="image-gallery">
                        <div class="main-image">
                            <img src="" alt="Disease image" id="mainDiseaseImage" onerror="this.src='https://via.placeholder.com/500x300?text=No+Image'">
                        </div>
                        <div class="thumbnail-grid" id="thumbnailGrid">
                            <!-- Thumbnails will be populated by JavaScript -->
                        </div>
                    </div>
                </div>

                <!-- Right Column - Detailed Information -->
                <div class="detail-right">
                    <!-- Description -->
                    <div class="info-section">
                        <h3><i class="fas fa-info-circle"></i> Description</h3>
                        <p class="disease-description" id="diseaseDescription"></p>
                    </div>

                    <!-- Symptoms -->
                    <div class="info-section">
                        <h3><i class="fas fa-exclamation-triangle"></i> Symptoms</h3>
                        <ul class="symptoms-list" id="symptomsList">
                            <!-- Will be populated by JavaScript -->
                        </ul>
                    </div>

                    <!-- PREVENTION & CONTROL SECTION -->
                    <div class="prevention-section">
                        <h3><i class="fas fa-shield-alt"></i> Prevention & Control Strategies</h3>
                        <p class="prevention-intro">Effective management of plant diseases relies on an Integrated Pest Management (IPM) approach, combining cultural, biological, and chemical methods.</p>

                        <div class="prevention-grid">
                            <div class="prevention-card cultural">
                                <i class="fas fa-leaf"></i>
                                <h4>Cultural Control</h4>
                                <ul id="culturalList">
                                    <!-- Will be populated by JavaScript -->
                                </ul>
                            </div>

                            <div class="prevention-card biological">
                                <i class="fas fa-bug"></i>
                                <h4>Biological Control</h4>
                                <ul id="biologicalList">
                                    <!-- Will be populated by JavaScript -->
                                </ul>
                            </div>

                            <div class="prevention-card chemical">
                                <i class="fas fa-flask"></i>
                                <h4>Chemical Control</h4>
                                <ul id="chemicalList">
                                    <!-- Will be populated by JavaScript -->
                                </ul>
                            </div>

                            <div class="prevention-card monitoring">
                                <i class="fas fa-search"></i>
                                <h4>Monitoring</h4>
                                <ul id="monitoringList">
                                    <!-- Will be populated by JavaScript -->
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Similar Diseases -->
                    <div class="similar-section">
                        <h3><i class="fas fa-search"></i> Similar Diseases</h3>
                        <div class="similar-grid" id="similarDiseases">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="disease-cta">
                <div class="cta-content">
                    <h3>Think your plant has this disease?</h3>
                    <p>Use our AI scanner to get an instant, accurate diagnosis.</p>
                    <a href="scan.php" class="scan-now-btn">
                        <i class="fas fa-camera"></i> Scan Your Plant Now
                    </a>
                </div>
            </div>
        </div>

        <!-- Disease Not Found Message (hidden initially) -->
        <div class="not-found-container" id="notFoundContainer" style="display: none;">
            <div class="not-found-content">
                <i class="fas fa-exclamation-triangle"></i>
                <h2>Disease Not Found</h2>
                <p>Sorry, we couldn't find the disease you're looking for.</p>
                <a href="diseases.php" class="back-to-library-btn">
                    <i class="fas fa-arrow-left"></i> Back to Disease Library
                </a>
            </div>
        </div>
    </main>

    <!-- FOOTER SECTION -->
    <?php include '../includes/footer.php'; ?>

    <!-- JavaScript files - Load in correct order -->
    <script src="../js/disease-data.js"></script>
    <script src="../js/disease-details.js"></script>
    
    <script>
        // Simple check - no complex code here
        document.addEventListener('DOMContentLoaded', function() {
            console.log("✅ Disease details PHP page loaded");
            // The disease-details.js will handle the rest
        });
    </script>
</body>
</html>