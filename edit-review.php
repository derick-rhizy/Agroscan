<?php
session_start();
require_once 'config/config.php';
require_once 'config/db.php';

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'You must be logged in to edit a review']);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit();
}

$review_id = (int)($_POST['review_id'] ?? 0);
$rating = (int)($_POST['rating'] ?? 0);
$review_text = trim($_POST['review_text'] ?? '');

// Validate
if ($review_id <= 0) {
    echo json_encode(['success' => false, 'error' => 'Invalid review ID']);
    exit();
}

if ($rating < 1 || $rating > 5) {
    echo json_encode(['success' => false, 'error' => 'Rating must be between 1 and 5']);
    exit();
}

if (empty($review_text)) {
    echo json_encode(['success' => false, 'error' => 'Review text is required']);
    exit();
}

if (strlen($review_text) < 10) {
    echo json_encode(['success' => false, 'error' => 'Review must be at least 10 characters']);
    exit();
}

try {
    // First check if the review belongs to this user
    $checkStmt = $pdo->prepare("SELECT user_id FROM reviews WHERE id = ?");
    $checkStmt->execute([$review_id]);
    $review = $checkStmt->fetch();
    
    if (!$review) {
        echo json_encode(['success' => false, 'error' => 'Review not found']);
        exit();
    }
    
    // Allow edit if user owns the review OR if user is admin (you can add admin check later)
    if ($review['user_id'] != $_SESSION['user_id']) {
        echo json_encode(['success' => false, 'error' => 'You can only edit your own reviews']);
        exit();
    }
    
    // Update the review
    $stmt = $pdo->prepare("UPDATE reviews SET rating = ?, review_text = ?, is_edited = 1, updated_at = NOW() WHERE id = ?");
    $stmt->execute([$rating, $review_text, $review_id]);
    
    // Get the updated review
    $fetchStmt = $pdo->prepare("SELECT * FROM reviews WHERE id = ?");
    $fetchStmt->execute([$review_id]);
    $updatedReview = $fetchStmt->fetch();
    
    echo json_encode([
        'success' => true,
        'message' => 'Review updated successfully!',
        'review' => $updatedReview
    ]);
    
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Database error: ' . $e->getMessage()
    ]);
}
?>