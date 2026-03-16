<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/config.php';
?>
<header>
    <div class="header-wrapper">
        <div class="logo-container">
            <i class="fas fa-leaf logo-icon"></i>
            <a href="<?php echo BASE_URL; ?>index.php" class="logo-text">AgroScan</a>
        </div>

        <nav class="navigation-menu">
            <a href="<?php echo BASE_URL; ?>index.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Home</a>
            <a href="<?php echo BASE_URL; ?>html/diseases.php" class="nav-link">Diseases</a>
            <a href="<?php echo BASE_URL; ?>html/scan.php" class="nav-link">Scan Plant</a>
            <a href="<?php echo BASE_URL; ?>html/history.php" class="nav-link">History</a>
            <a href="<?php echo BASE_URL; ?>html/about.php" class="nav-link">About</a>
        </nav>

        <div class="auth-buttons">
            <?php if(isset($_SESSION['user_id'])): ?>
                <div class="user-menu">
                    <span class="welcome-text">
                        <i class="fas fa-user-circle"></i> 
                        <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                    </span>
                    <a href="<?php echo BASE_URL; ?>auth/logout.php" class="exit-btn" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="exit-text">Exit</span>
                    </a>
                </div>
            <?php else: ?>
                <a href="<?php echo BASE_URL; ?>auth/login.php"><button class="login-btn">Login</button></a>
                <a href="<?php echo BASE_URL; ?>auth/register.php"><button class="register-btn">Register</button></a>
            <?php endif; ?>
        </div>

        <button class="mobile-menu-toggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</header>

<style>
/* Header Styles - Fixed spacing */
.header-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 15px 30px;
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: sticky;
    top: 0;
    z-index: 1000;
}

.logo-container {
    display: flex;
    align-items: center;
    gap: 10px;
}

.logo-icon {
    font-size: 24px;
    color: #27ae60;
}

.logo-text {
    font-size: 20px;
    font-weight: bold;
    color: #2c3e50;
    text-decoration: none;
}

.logo-text:hover {
    color: #27ae60;
}

.navigation-menu {
    display: flex;
    gap: 30px; /* Increased gap between nav links */
    margin: 0 20px; /* Added margin left and right */
}

.nav-link {
    color: #555;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
    padding: 5px 0;
    white-space: nowrap; /* Prevents wrapping */
}

.nav-link:hover {
    color: #27ae60;
}

.nav-link.active {
    color: #27ae60;
    border-bottom: 2px solid #27ae60;
}

.auth-buttons {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-left: 20px; /* Added margin to separate from nav */
}

.user-menu {
    display: flex;
    align-items: center;
    gap: 20px;
}

.welcome-text {
    color: #2c3e50;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 5px;
}

.welcome-text i {
    color: #27ae60;
    font-size: 1.2rem;
}

/* EXIT BUTTON STYLES */
.exit-btn {
    background: #e74c3c;
    color: white;
    padding: 8px 20px;
    border-radius: 50px;
    text-decoration: none;
    font-size: 0.95rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(231, 76, 60, 0.3);
    border: 2px solid transparent;
}

.exit-btn:hover {
    background: #c0392b;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(231, 76, 60, 0.4);
}

/* Login/Register Buttons */
.login-btn, .register-btn {
    padding: 8px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.3s;
    border: none;
    white-space: nowrap;
}

.login-btn {
    background: transparent;
    color: #27ae60;
    border: 2px solid #27ae60;
}

.login-btn:hover {
    background: #27ae60;
    color: white;
}

.register-btn {
    background: #27ae60;
    color: white;
    border: 2px solid #27ae60;
}

.register-btn:hover {
    background: #219a52;
    border-color: #219a52;
}

.mobile-menu-toggle {
    display: none;
    background: none;
    border: none;
    font-size: 24px;
    color: #333;
    cursor: pointer;
}

/* Responsive Design */
@media (max-width: 900px) {
    .navigation-menu {
        gap: 15px; /* Smaller gap on medium screens */
        margin: 0 10px;
    }
}

@media (max-width: 768px) {
    .header-wrapper {
        padding: 15px 20px;
    }

    .navigation-menu {
        display: none;
        position: absolute;
        top: 70px;
        left: 0;
        right: 0;
        background: white;
        flex-direction: column;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        z-index: 999;
        gap: 15px;
        margin: 0;
    }
    
    .navigation-menu.active {
        display: flex;
    }
    
    .mobile-menu-toggle {
        display: block;
    }
    
    .auth-buttons {
        margin-left: 0;
    }
    
    .exit-text {
        display: none;
    }
    
    .exit-btn {
        padding: 8px 12px;
    }
}

/* For very small screens */
@media (max-width: 480px) {
    .logo-text {
        font-size: 18px;
    }
    
    .welcome-text span {
        display: none;
    }
    
    .user-menu {
        gap: 10px;
    }
    
    .login-btn, .register-btn {
        padding: 6px 12px;
        font-size: 0.9rem;
    }
}

</style>

<script>
// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const navigation = document.querySelector('.navigation-menu');
    
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            navigation.classList.toggle('active');
            
            // Change icon based on menu state
            const icon = this.querySelector('i');
            if (navigation.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    }
    
    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        if (navigation && menuToggle && 
            !navigation.contains(event.target) && 
            !menuToggle.contains(event.target)) {
            navigation.classList.remove('active');
            const icon = menuToggle.querySelector('i');
            if (icon) {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        }
    });
});
</script>