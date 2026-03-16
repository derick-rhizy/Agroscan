<?php
session_start();
require_once '../config/config.php';
require_once '../config/db.php';

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Not logged in']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Get form data
$plant_name = $_POST['plant_name'] ?? 'Unknown Plant';
$disease_name = $_POST['disease_name'] ?? 'Unknown Disease';
$confidence = $_POST['confidence'] ?? 85.0;

// Handle image upload
$image_path = '../images/placeholder.jpg';

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $upload_dir = '../uploads/scans/';
    
    // Create directory if it doesn't exist
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $filename = 'scan_' . time() . '_' . $user_id . '.' . $extension;
    $upload_path = $upload_dir . $filename;
    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
        $image_path = '../uploads/scans/' . $filename;
    }
}

try {
    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO plant_scans (user_id, image_path, plant_name, disease_name, confidence_score, scanned_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->execute([$user_id, $image_path, $plant_name, $disease_name, $confidence]);
    
    $scan_id = $pdo->lastInsertId();
    
    echo json_encode([
        'success' => true,
        'scan_id' => $scan_id,
        'message' => 'Scan saved successfully'
    ]);
    
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Database error: ' . $e->getMessage()
    ]);
}
?>