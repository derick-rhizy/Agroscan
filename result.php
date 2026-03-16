<?php
session_start();
require_once '../config/config.php';
require_once '../config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$scan_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$scan = null;

if ($scan_id > 0) {
    // Fetch scan data
    $stmt = $pdo->prepare("SELECT * FROM plant_scans WHERE id = ? AND user_id = ?");
    $stmt->execute([$scan_id, $_SESSION['user_id']]);
    $scan = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Results - AgroScan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/result.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <div class="breadcrumb">
            <a href="../index.php" class="breadcrumb-link">Home</a>
            <i class="fas fa-chevron-right breadcrumb-separator"></i>
            <a href="scan.php" class="breadcrumb-link">Scan Plant</a>
            <i class="fas fa-chevron-right breadcrumb-separator"></i>
            <span class="breadcrumb-current">Results</span>
        </div>

        <div class="results-header">
            <h1 class="results-title">Diagnosis Results</h1>
            <p class="results-subtitle">AI-powered analysis complete. Here's what we found.</p>
        </div>

        <?php if ($scan): ?>
            <div class="results-container">
                <div class="results-left">
                    <div class="image-card">
                        <div class="image-wrapper">
                            <img src="<?php echo $scan['image_path'] ?? '../images/placeholder.jpg'; ?>" 
                                 alt="Scanned plant" 
                                 class="plant-image"
                                 onerror="this.src='https://via.placeholder.com/400x300?text=Plant+Image'">
                            <div class="confidence-badge">
                                <span class="confidence-value"><?php echo $scan['confidence_score'] ?? '94'; ?></span>% Confidence
                            </div>
                        </div>

                        <div class="image-info">
                            <div class="info-row">
                                <i class="fas fa-calendar-alt"></i>
                                <span>Scanned on: <strong><?php echo date('F j, Y', strtotime($scan['scanned_at'])); ?></strong></span>
                            </div>
                            <div class="info-row">
                                <i class="fas fa-hashtag"></i>
                                <span>Scan ID: <strong>#<?php echo $scan['id']; ?></strong></span>
                            </div>
                        </div>
                    </div>

                    <div class="quick-actions-grid">
                        <button class="quick-action-btn" onclick="window.print()">
                            <i class="fas fa-print"></i> <span>Print</span>
                        </button>
                        <a href="scan.php" class="quick-action-btn">
                            <i class="fas fa-camera"></i> <span>New Scan</span>
                        </a>
                    </div>

                    <div class="plant-details-card">
                        <h3 class="plant-details-title">
                            <i class="fas fa-seedling"></i> Plant Information
                        </h3>
                        <div class="plant-details-content">
                            <div class="detail-item">
                                <span class="detail-label">Plant Type:</span>
                                <span class="detail-value"><?php echo htmlspecialchars($scan['plant_name'] ?? 'Unknown'); ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Confidence:</span>
                                <span class="detail-value"><?php echo $scan['confidence_score'] ?? '94'; ?>%</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Disease:</span>
                                <span class="detail-value"><?php echo htmlspecialchars($scan['disease_name'] ?? 'Unknown'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="results-right">
                    <div class="disease-card">
                        <div class="disease-header">
                            <div>
                                <h2 class="disease-name"><?php echo htmlspecialchars($scan['disease_name'] ?? 'Early Blight'); ?></h2>
                                <p class="disease-scientific">Detected Disease</p>
                            </div>
                            <span class="disease-type fungal">Disease</span>
                        </div>

                        <div class="description-section">
                            <h3 class="section-subheading">
                                <i class="fas fa-info-circle"></i> Description
                            </h3>
                            <p class="disease-description">
                                Our AI analysis has detected signs of <?php echo htmlspecialchars($scan['disease_name'] ?? 'a plant disease'); ?> 
                                in your sample. Please consult with a plant expert for confirmation and treatment.
                            </p>
                        </div>
                    </div>

                    <div class="expert-card">
                        <div class="expert-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="expert-content">
                            <h4 class="expert-title">Need expert advice?</h4>
                            <p class="expert-text">Our plant health specialists can provide personalized guidance.</p>
                        </div>
                        <button class="expert-button" onclick="window.location.href='mailto:support@agroscan.com'">
                            Consult Now <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="result-actions" style="display: flex; gap: 15px; justify-content: center; margin: 30px 0;">
                <a href="scan.php" class="action-btn primary-btn" style="background: #27ae60; color: white; padding: 12px 30px; border-radius: 50px; text-decoration: none;">
                    <i class="fas fa-camera"></i> Scan Another Plant
                </a>
                <a href="history.php" class="action-btn secondary-btn" style="background: white; color: #27ae60; border: 2px solid #27ae60; padding: 12px 30px; border-radius: 50px; text-decoration: none;">
                    <i class="fas fa-history"></i> View History
                </a>
            </div>

        <?php else: ?>
            <div class="no-data-alert" style="text-align: center; padding: 60px; background: white; border-radius: 30px;">
                <i class="fas fa-exclamation-circle" style="font-size: 4rem; color: #f39c12; margin-bottom: 20px;"></i>
                <h3>No Scan Results Found</h3>
                <p>We couldn't find any scan results to display.</p>
                <a href="scan.php" style="display: inline-block; background: #27ae60; color: white; padding: 12px 30px; border-radius: 50px; text-decoration: none; margin-top: 20px;">Go to Scan Page</a>
            </div>
        <?php endif; ?>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>