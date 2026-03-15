<?php
session_start();
require_once 'config/config.php';
require_once 'config/db.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit();
}

$rating = (int)($_POST['rating'] ?? 0);
$review_text = trim($_POST['review_text'] ?? '');
$user_name = trim($_POST['user_name'] ?? 'Anonymous');

// Validate
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
    $user_id = $_SESSION['user_id'] ?? null;
    
    // If user is logged in, use their name from session
    if ($user_id && isset($_SESSION['user_name'])) {
        $user_name = $_SESSION['user_name'];
    }
    
    $stmt = $pdo->prepare("INSERT INTO reviews (user_id, user_name, rating, review_text, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->execute([$user_id, $user_name, $rating, $review_text]);
    
    echo json_encode([
        'success' => true,
        'message' => 'Thank you for your review!'
    ]);
    
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Database error: ' . $e->getMessage()
    ]);
}
?>