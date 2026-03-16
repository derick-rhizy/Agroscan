<?php
session_start();
require_once '../config/config.php';
require_once '../config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['login_error'] = "Please login first to access the scan feature.";
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Plant - AgroScan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/scan.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <div class="page-header">
            <h1 class="page-title">Scan Your Plant</h1>
            <p class="page-description">Upload a clear photo of the affected plant leaf for AI-powered disease detection</p>
        </div>

        <div class="user-info" style="background: #e8f5e9; padding: 15px; border-radius: 10px; margin-bottom: 30px; display: flex; align-items: center; gap: 15px; color: #2c3e50; max-width: 800px; margin-left: auto; margin-right: auto;">
            <i class="fas fa-user-circle" style="font-size: 2rem; color: #27ae60;"></i>
            <div>
                <strong>Logged in as:</strong> <?php echo htmlspecialchars($_SESSION['user_name']); ?><br>
                <small><?php echo htmlspecialchars($_SESSION['user_email']); ?></small>
            </div>
        </div>

        <div class="scan-container">
            <!-- Upload Area -->
            <div class="upload-area" id="uploadArea">
                <i class="fas fa-cloud-upload-alt upload-icon"></i>
                <h3 class="upload-title">Drag & Drop or Click to Upload</h3>
                <p class="upload-hint">Supported formats: JPG, PNG, JPEG (Max: 10MB)</p>
                <input type="file" class="file-input" id="fileInput" accept="image/*">
                <div class="browse-button" id="browseButton">
                    <i class="fas fa-folder-open"></i> Select Image
                </div>
            </div>

            <!-- Preview Container -->
            <div class="preview-container hidden" id="previewContainer">
                <img src="" alt="Preview" class="preview-image" id="previewImage">
                <button class="remove-button" id="removeButton">
                    <i class="fas fa-times"></i> Remove
                </button>
            </div>

            <!-- Analysis Status -->
            <div class="analysis-status hidden" id="analysisStatus">
                <div class="status-loader">
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
                <p class="status-text">Analyzing your plant...</p>
                <div class="progress-bar">
                    <div class="progress-fill" id="progressFill"></div>
                </div>
            </div>

            <!-- Scan Button -->
            <button class="scan-button" id="scanButton" disabled>
                <i class="fas fa-search"></i> Analyze Plant
            </button>

            <!-- Tips Container -->
            <div class="tips-container">
                <h3 class="tips-title">
                    <i class="fas fa-lightbulb"></i> Tips for Best Results:
                </h3>
                <ul class="tips-list">
                    <li class="tip-item">Take photo in natural lighting</li>
                    <li class="tip-item">Focus on the affected area</li>
                    <li class="tip-item">Include both healthy and diseased tissue</li>
                    <li class="tip-item">Avoid blurry or dark images</li>
                    <li class="tip-item">Ensure the leaf is clean and dry</li>
                    <li class="tip-item">Take multiple angles if possible</li>
                </ul>
            </div>
        </div>

        <!-- Recent Scans -->
        <?php
        $recent_stmt = $pdo->prepare("SELECT * FROM plant_scans WHERE user_id = ? ORDER BY scanned_at DESC LIMIT 3");
        $recent_stmt->execute([$_SESSION['user_id']]);
        $recent_scans = $recent_stmt->fetchAll();

        if (count($recent_scans) > 0):
        ?>
        <div class="recent-scans">
            <h2 class="recent-title">Your Recent Scans</h2>
            <div class="scans-grid">
                <?php foreach ($recent_scans as $scan): ?>
                <div class="scan-history-card">
                    <img src="<?php echo $scan['image_path'] ?? '../images/placeholder.jpg'; ?>" 
                         alt="Recent scan" 
                         class="scan-thumbnail"
                         onerror="this.src='https://via.placeholder.com/70x70?text=Plant'">
                    <div class="scan-info">
                        <h4 class="scan-plant"><?php echo htmlspecialchars($scan['plant_name'] ?? 'Unknown Plant'); ?></h4>
                        <p class="scan-result"><?php echo htmlspecialchars($scan['disease_name'] ?? 'Processing'); ?></p>
                        <p class="scan-date"><?php echo date('M j, Y', strtotime($scan['scanned_at'])); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </main>

    <?php include '../includes/footer.php'; ?>
    
    <!-- Load scripts in correct order -->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@2.0.0/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@0.8/dist/teachablemachine-image.min.js"></script>
    <script src="../js/ai-disease-data.js"></script>
    <script src="../js/scan.js"></script>
</body>
</html>