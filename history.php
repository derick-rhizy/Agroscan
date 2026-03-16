<?php
session_start();
require_once '../config/config.php';
require_once '../config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['login_error'] = "Please login to view your scan history";
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle delete request
if (isset($_GET['delete'])) {
    $delete_id = (int)$_GET['delete'];
    
    // First get the image path to delete the file
    $stmt = $pdo->prepare("SELECT image_path FROM plant_scans WHERE id = ? AND user_id = ?");
    $stmt->execute([$delete_id, $user_id]);
    $scan = $stmt->fetch();
    
    if ($scan) {
        // Delete the image file if it exists and is not the placeholder
        if ($scan['image_path'] != '../images/placeholder.jpg' && file_exists('../' . $scan['image_path'])) {
            unlink('../' . $scan['image_path']);
        }
        
        // Delete from database
        $deleteStmt = $pdo->prepare("DELETE FROM plant_scans WHERE id = ? AND user_id = ?");
        $deleteStmt->execute([$delete_id, $user_id]);
        
        $_SESSION['success'] = "Scan deleted successfully!";
    }
    
    header("Location: history.php");
    exit();
}

// Handle clear all history
if (isset($_POST['clear_all'])) {
    // Get all images to delete
    $stmt = $pdo->prepare("SELECT image_path FROM plant_scans WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $scans = $stmt->fetchAll();
    
    foreach ($scans as $scan) {
        if ($scan['image_path'] != '../images/placeholder.jpg' && file_exists('../' . $scan['image_path'])) {
            unlink('../' . $scan['image_path']);
        }
    }
    
    // Delete all scans for this user
    $deleteStmt = $pdo->prepare("DELETE FROM plant_scans WHERE user_id = ?");
    $deleteStmt->execute([$user_id]);
    
    $_SESSION['success'] = "All scans cleared successfully!";
    header("Location: history.php");
    exit();
}

// Get user's scan statistics
$total_stmt = $pdo->prepare("SELECT COUNT(*) as total FROM plant_scans WHERE user_id = ?");
$total_stmt->execute([$user_id]);
$total_scans = $total_stmt->fetch()['total'];

$unique_stmt = $pdo->prepare("SELECT COUNT(DISTINCT disease_name) as unique_diseases FROM plant_scans WHERE user_id = ? AND disease_name IS NOT NULL");
$unique_stmt->execute([$user_id]);
$unique_diseases = $unique_stmt->fetch()['unique_diseases'];

$last_stmt = $pdo->prepare("SELECT scanned_at FROM plant_scans WHERE user_id = ? ORDER BY scanned_at DESC LIMIT 1");
$last_stmt->execute([$user_id]);
$last_scan = $last_stmt->fetch();
$last_scan_date = $last_scan ? date('M j, Y', strtotime($last_scan['scanned_at'])) : 'Never';

// Fetch user's scan history
$scans_stmt = $pdo->prepare("SELECT * FROM plant_scans WHERE user_id = ? ORDER BY scanned_at DESC");
$scans_stmt->execute([$user_id]);
$scans = $scans_stmt->fetchAll();

// Check for success message
$success = $_SESSION['success'] ?? '';
unset($_SESSION['success']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan History - AgroScan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f9f4 0%, #e8f5e8 100%);
            min-height: 100vh;
        }

        .history-wrapper {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-title {
            font-size: 2.5rem;
            color: #1a4d2e;
            margin-bottom: 10px;
        }

        .page-subtitle {
            color: #2e5f3d;
            font-size: 1.2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border: 1px solid #daecd9;
        }

        .stat-card i {
            font-size: 2rem;
            color: #27ae60;
            margin-bottom: 10px;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #1a4d2e;
            display: block;
        }

        .stat-label {
            color: #2e5f3d;
        }

        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .search-section {
            flex: 1;
            min-width: 250px;
        }

        .search-box {
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #7a9a83;
        }

        .search-input {
            width: 100%;
            padding: 12px 20px 12px 45px;
            border: 2px solid #e0f0e0;
            border-radius: 50px;
            font-size: 1rem;
        }

        .search-input:focus {
            outline: none;
            border-color: #27ae60;
        }

        .clear-all-btn {
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 12px 25px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .clear-all-btn:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        .clear-all-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .history-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }

        .scan-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border: 1px solid #daecd9;
            transition: transform 0.3s ease;
            position: relative;
        }

        .scan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(39, 174, 96, 0.1);
        }

        .scan-image {
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .scan-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .delete-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(231, 76, 60, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            z-index: 10;
        }

        .delete-btn:hover {
            background: #c0392b;
            transform: scale(1.1);
        }

        .scan-info {
            padding: 20px;
        }

        .scan-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .scan-plant {
            font-size: 1.3rem;
            color: #1a4d2e;
        }

        .confidence {
            background: #e8f5e8;
            color: #27ae60;
            padding: 4px 12px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .scan-disease {
            color: #e74c3c;
            margin-bottom: 10px;
        }

        .scan-date {
            color: #7a9a83;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .scan-actions {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            flex: 1;
            padding: 8px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: all 0.3s;
            text-decoration: none;
        }

        .view-btn {
            background: #27ae60;
            color: white;
        }

        .view-btn:hover {
            background: #219a52;
        }

        .favorite-btn {
            background: #f8f9fa;
            color: #666;
        }

        .favorite-btn.active {
            background: #f39c12;
            color: white;
        }

        .no-history {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 15px;
            grid-column: 1 / -1;
        }

        .no-history i {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 20px;
        }

        .no-history h3 {
            color: #333;
            margin-bottom: 10px;
        }

        .no-history p {
            color: #666;
            margin-bottom: 20px;
        }

        .scan-now-btn {
            display: inline-block;
            padding: 12px 30px;
            background: #27ae60;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .scan-now-btn:hover {
            background: #219a52;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .history-grid {
                grid-template-columns: 1fr;
            }
            
            .page-title {
                font-size: 2rem;
            }
            
            .action-bar {
                flex-direction: column;
            }
            
            .clear-all-btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 20px;
            max-width: 400px;
            text-align: center;
            animation: slideIn 0.3s;
        }

        .modal-content i {
            font-size: 4rem;
            color: #e74c3c;
            margin-bottom: 20px;
        }

        .modal-content h3 {
            color: #333;
            margin-bottom: 10px;
        }

        .modal-content p {
            color: #666;
            margin-bottom: 25px;
        }

        .modal-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .modal-btn {
            padding: 10px 25px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }

        .confirm-btn {
            background: #e74c3c;
            color: white;
        }

        .confirm-btn:hover {
            background: #c0392b;
        }

        .cancel-btn {
            background: #f8f9fa;
            color: #666;
        }

        .cancel-btn:hover {
            background: #e0e0e0;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
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
    <?php include '../includes/header.php'; ?>

    <main>
        <div class="history-wrapper">
            <div class="page-header">
                <h1 class="page-title">Your Scan History</h1>
                <p class="page-subtitle">Track all your plant health scans and diagnoses</p>
            </div>

            <?php if ($success): ?>
                <div class="success-message">
                    <i class="fas fa-check-circle"></i>
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <div class="stats-grid">
                <div class="stat-card">
                    <i class="fas fa-camera"></i>
                    <span class="stat-number"><?php echo $total_scans; ?></span>
                    <span class="stat-label">Total Scans</span>
                </div>
                <div class="stat-card">
                    <i class="fas fa-leaf"></i>
                    <span class="stat-number"><?php echo $unique_diseases; ?></span>
                    <span class="stat-label">Diseases Found</span>
                </div>
                <div class="stat-card">
                    <i class="fas fa-calendar"></i>
                    <span class="stat-number"><?php echo $last_scan_date; ?></span>
                    <span class="stat-label">Last Scan</span>
                </div>
            </div>

            <div class="action-bar">
                <div class="search-section">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" class="search-input" id="searchInput" placeholder="Search by disease name...">
                    </div>
                </div>
                
                <?php if ($total_scans > 0): ?>
                <button class="clear-all-btn" id="clearAllBtn" onclick="showClearAllModal()">
                    <i class="fas fa-trash-alt"></i> Clear All History
                </button>
                <?php endif; ?>
            </div>

            <div class="history-grid" id="historyGrid">
                <?php if (count($scans) > 0): ?>
                    <?php foreach ($scans as $scan): ?>
                        <div class="scan-card" data-disease="<?php echo strtolower($scan['disease_name'] ?? ''); ?>">
                            <div class="scan-image">
                                <img src="<?php echo $scan['image_path'] ?? '../images/placeholder.jpg'; ?>" 
                                     alt="Plant scan"
                                     onerror="this.src='https://via.placeholder.com/400x200?text=Plant+Scan'">
                                <button class="delete-btn" onclick="showDeleteModal(<?php echo $scan['id']; ?>, '<?php echo addslashes($scan['plant_name']); ?>')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="scan-info">
                                <div class="scan-header">
                                    <h3 class="scan-plant"><?php echo htmlspecialchars($scan['plant_name'] ?? 'Unknown Plant'); ?></h3>
                                    <span class="confidence"><?php echo $scan['confidence_score'] ?? '85'; ?>%</span>
                                </div>
                                <p class="scan-disease">
                                    <i class="fas fa-leaf"></i> 
                                    <?php echo htmlspecialchars($scan['disease_name'] ?? 'Healthy / No Disease'); ?>
                                </p>
                                <p class="scan-date">
                                    <i class="fas fa-calendar-alt"></i>
                                    <?php echo date('F j, Y \a\t g:i A', strtotime($scan['scanned_at'])); ?>
                                </p>
                                <div class="scan-actions">
                                    <a href="result.php?id=<?php echo $scan['id']; ?>" class="action-btn view-btn">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-history">
                        <i class="fas fa-history"></i>
                        <h3>No scan history yet</h3>
                        <p>Start by scanning a plant to see your results here</p>
                        <a href="scan.php" class="scan-now-btn">
                            <i class="fas fa-camera"></i> Scan a Plant
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <!-- Delete Single Item Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <i class="fas fa-exclamation-triangle"></i>
            <h3>Delete Scan</h3>
            <p id="deleteMessage">Are you sure you want to delete this scan?</p>
            <div class="modal-buttons">
                <button class="modal-btn cancel-btn" onclick="closeModal()">Cancel</button>
                <button class="modal-btn confirm-btn" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>

    <!-- Clear All Modal -->
    <div id="clearAllModal" class="modal">
        <div class="modal-content">
            <i class="fas fa-exclamation-triangle"></i>
            <h3>Clear All History</h3>
            <p>Are you sure you want to delete ALL your scan history? This action cannot be undone.</p>
            <div class="modal-buttons">
                <button class="modal-btn cancel-btn" onclick="closeModal()">Cancel</button>
                <form method="POST" style="display: inline;">
                    <button type="submit" name="clear_all" class="modal-btn confirm-btn">Clear All</button>
                </form>
            </div>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>

    <script>
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const scanCards = document.querySelectorAll('.scan-card');
        const historyGrid = document.getElementById('historyGrid');

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                let visibleCount = 0;

                scanCards.forEach(card => {
                    const disease = card.dataset.disease || '';
                    const plant = card.querySelector('.scan-plant')?.textContent.toLowerCase() || '';
                    
                    if (disease.includes(searchTerm) || plant.includes(searchTerm)) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Show "no results" message if needed
                let noResultsMsg = document.querySelector('.no-results');
                
                if (visibleCount === 0 && scanCards.length > 0) {
                    if (!noResultsMsg) {
                        noResultsMsg = document.createElement('div');
                        noResultsMsg.className = 'no-history no-results';
                        noResultsMsg.innerHTML = `
                            <i class="fas fa-search"></i>
                            <h3>No matches found</h3>
                            <p>Try different search terms</p>
                        `;
                        historyGrid.appendChild(noResultsMsg);
                    }
                } else if (noResultsMsg) {
                    noResultsMsg.remove();
                }
            });
        }

        // Delete functionality
        let deleteId = null;

        function showDeleteModal(id, plantName) {
            deleteId = id;
            document.getElementById('deleteMessage').innerText = `Are you sure you want to delete the scan for "${plantName}"?`;
            document.getElementById('deleteModal').style.display = 'flex';
        }

        function showClearAllModal() {
            document.getElementById('clearAllModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('deleteModal').style.display = 'none';
            document.getElementById('clearAllModal').style.display = 'none';
            deleteId = null;
        }

        document.getElementById('confirmDeleteBtn')?.addEventListener('click', function() {
            if (deleteId) {
                window.location.href = 'history.php?delete=' + deleteId;
            }
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('modal')) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>