<?php
session_start();
require_once 'config/config.php';
require_once 'config/db.php';

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'You must be logged in to delete a review']);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit();
}

$review_id = (int)($_POST['review_id'] ?? 0);

if ($review_id <= 0) {
    echo json_encode(['success' => false, 'error' => 'Invalid review ID']);
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
    
    // Allow delete if user owns the review
    if ($review['user_id'] != $_SESSION['user_id']) {
        echo json_encode(['success' => false, 'error' => 'You can only delete your own reviews']);
        exit();
    }
    
    // Delete the review
    $stmt = $pdo->prepare("DELETE FROM reviews WHERE id = ?");
    $stmt->execute([$review_id]);
    
    echo json_encode([
        'success' => true,
        'message' => 'Review deleted successfully!'
    ]);
    
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Database error: ' . $e->getMessage()
    ]);
}
?>