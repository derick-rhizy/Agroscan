<?php
require_once 'config/config.php';
require_once 'config/db.php';

header('Content-Type: application/json');

$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 6;

try {
    $stmt = $pdo->prepare("SELECT * FROM reviews WHERE is_approved = 1 ORDER BY created_at DESC LIMIT ?");
    $stmt->execute([$limit]);
    $reviews = $stmt->fetchAll();
    
    echo json_encode([
        'success' => true,
        'reviews' => $reviews
    ]);
    
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Database error: ' . $e->getMessage()
    ]);
}
?>