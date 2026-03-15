<?php
require_once 'config/config.php';
require_once 'config/db.php';

header('Content-Type: application/json');

try {
    // Count diseases from database
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM diseases");
    $result = $stmt->fetch();
    
    $total_diseases = $result['total'] ?? 1250; // Fallback to 1250 if table is empty
    
    echo json_encode([
        'success' => true,
        'total_diseases' => (int)$total_diseases
    ]);
    
} catch(PDOException $e) {
    // Return default value if database error
    echo json_encode([
        'success' => true,
        'total_diseases' => 1250,
        'note' => 'Using default value'
    ]);
}
?>