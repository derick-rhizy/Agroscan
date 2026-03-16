<?php
session_start();
require_once '../config/config.php';
require_once '../config/db.php';

$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    if (empty($name) || empty($email) || empty($message)) {
        $error = "Please fill in all required fields";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, subject, message, created_at) VALUES (?, ?, ?, ?, NOW())");
            $stmt->execute([$name, $email, $subject, $message]);
            $success = "Your message has been sent successfully! We'll get back to you soon.";
        } catch(PDOException $e) {
            $error = "Failed to send message. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - AgroScan</title>
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
        
        .contact-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 40px;
            background: white;
            border-radius: 30px;
            box-shadow: 0 20px 40px rgba(0,40,0,0.1);
        }
        
        .contact-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .contact-header h1 {
            color: #1a4d2e;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        
        .contact-header p {
            color: #2e5f3d;
            font-size: 1.1rem;
        }
        
        .contact-header i {
            font-size: 4rem;
            color: #27ae60;
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #1e4f32;
            font-weight: 500;
        }
        
        .form-group label i {
            color: #27ae60;
            margin-right: 8px;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0f0e0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #27ae60;
            box-shadow: 0 0 0 4px rgba(39,174,96,0.1);
        }
        
        .form-group textarea {
            min-height: 150px;
            resize: vertical;
        }
        
        .submit-btn {
            background: #27ae60;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .submit-btn:hover {
            background: #219a52;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(39,174,96,0.3);
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
        
        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #2e5f3d;
            text-decoration: none;
            font-weight: 500;
        }
        
        .back-link:hover {
            color: #27ae60;
        }
        
        .back-link i {
            margin-right: 5px;
        }
        
        .required-field {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-left: 5px;
        }
        
        @media (max-width: 768px) {
            .contact-container {
                margin: 20px;
                padding: 30px 20px;
            }
            
            .contact-header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    <main>
        <div class="contact-container">
            <div class="contact-header">
                <i class="fas fa-headset"></i>
                <h1>Contact Support</h1>
                <p>Have questions? We're here to help!</p>
            </div>
            
            <?php if ($success): ?>
                <div class="success-message">
                    <i class="fas fa-check-circle"></i> 
                    <div><?php echo $success; ?></div>
                </div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i> 
                    <div><?php echo $error; ?></div>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label><i class="fas fa-user"></i> Your Name <span class="required-field">*</span></label>
                    <input type="text" name="name" placeholder="Enter your full name" required>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-envelope"></i> Email Address <span class="required-field">*</span></label>
                    <input type="email" name="email" placeholder="your@email.com" required>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-tag"></i> Subject</label>
                    <input type="text" name="subject" placeholder="e.g., Technical Support, Billing, General Inquiry">
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-comment"></i> Message <span class="required-field">*</span></label>
                    <textarea name="message" placeholder="How can we help you?" required></textarea>
                </div>
                
                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i> Send Message
                </button>
                
                <div style="text-align: center; margin-top: 20px;">
                    <a href="../index.php" class="back-link">
                        <i class="fas fa-arrow-left"></i> Back to Home
                    </a>
                </div>
            </form>
            
            <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e0f0e0; text-align: center;">
                <p style="color: #2e5f3d; margin-bottom: 10px;">Or reach us directly:</p>
                <div style="display: flex; justify-content: center; gap: 30px; flex-wrap: wrap;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-phone" style="color: #27ae60;"></i>
                        <span>+1 (800) 123-4567</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-envelope" style="color: #27ae60;"></i>
                        <span>support@agroscan.com</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <?php include '../includes/footer.php'; ?>
</body>
</html>