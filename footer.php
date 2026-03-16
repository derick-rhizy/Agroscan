<?php
// No session needed in footer, but we'll keep it simple
?>
<footer>
    <div class="footer-wrapper">
        <div class="footer-grid">
            <div class="footer-about">
                <div class="footer-logo">
                    <i class="fas fa-leaf footer-logo-icon"></i>
                    <span class="footer-logo-text">AgroScan</span>
                </div>
                <p class="footer-description">Advanced plant disease identification using AI technology to help gardeners and farmers protect their plants.</p>
                <a href="../html/contact.php" class="contact-support-btn">
                    <i class="fas fa-headset"></i> Contact Support
                </a>
            </div>
            
            <div class="footer-quick-links">
                <h4 class="footer-heading">Quick Links</h4>
                <ul class="footer-links-list">
                    <li class="footer-list-item"><a href="<?php echo BASE_URL; ?>index.php" class="footer-link">Home</a></li>
                    <li class="footer-list-item"><a href="<?php echo BASE_URL; ?>html/diseases.php" class="footer-link">Diseases</a></li>
                    <li class="footer-list-item"><a href="<?php echo BASE_URL; ?>html/scan.php" class="footer-link">Scan Plant</a></li>
                    <li class="footer-list-item"><a href="<?php echo BASE_URL; ?>html/history.php" class="footer-link">History</a></li>
                    <li class="footer-list-item"><a href="<?php echo BASE_URL; ?>html/about.php" class="footer-link">About</a></li>
                </ul>
            </div>
            
            <div class="footer-resources">
                <h4 class="footer-heading">Resources</h4>
                <ul class="footer-links-list">
                    <li class="footer-list-item"><a href="#" class="footer-link">Plant Care Guides</a></li>
                    <li class="footer-list-item"><a href="#" class="footer-link">Seasonal Tips</a></li>
                    <li class="footer-list-item"><a href="#" class="footer-link">Pest Control Methods</a></li>
                    <li class="footer-list-item"><a href="#" class="footer-link">Organic Treatments</a></li>
                    <li class="footer-list-item"><a href="#" class="footer-link">Gardening Community</a></li>
                </ul>
            </div>
            
            <div class="footer-connect">
                <h4 class="footer-heading">Connect With Us</h4>
                <div class="contact-info-item">
                    <i class="far fa-envelope contact-icon"></i>
                    <p class="contact-text">support@agroscan.com</p>
                </div>
                <div class="contact-info-item">
                    <i class="fas fa-phone-alt contact-icon"></i>
                    <p class="contact-text">+1 (800) 123-4567</p>
                </div>
                <div class="contact-info-item">
                    <i class="fas fa-map-pin contact-icon"></i>
                    <p class="contact-text">123 Garden Street, Green City</p>
                </div>
                
                <!-- Social Media Icons -->
                <div class="social-icons" style="display: flex; gap: 15px; margin-top: 20px;">
                    <a href="#" style="color: #406a4c; font-size: 1.5rem; transition: color 0.2s ease;" onmouseover="this.style.color='#1f5e3a'" onmouseout="this.style.color='#406a4c'">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" style="color: #406a4c; font-size: 1.5rem; transition: color 0.2s ease;" onmouseover="this.style.color='#1f5e3a'" onmouseout="this.style.color='#406a4c'">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" style="color: #406a4c; font-size: 1.5rem; transition: color 0.2s ease;" onmouseover="this.style.color='#1f5e3a'" onmouseout="this.style.color='#406a4c'">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" style="color: #406a4c; font-size: 1.5rem; transition: color 0.2s ease;" onmouseover="this.style.color='#1f5e3a'" onmouseout="this.style.color='#406a4c'">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="copyright-section">
            <p class="copyright-text">© <?php echo date('Y'); ?> AgroScan. All rights reserved | Designed with <span class="heart-icon" style="color: #e74c3c;">❤️</span> for plant lovers</p>
        </div>
    </div>
</footer>

<!-- Add any footer-specific CSS that might be missing from footer.css -->
<style>
    /* Ensure footer has proper spacing and background */
    footer {
        background: #f5f9f4;
        border-top: 1px solid #daecd9;
        margin-top: 60px;
        padding: 40px 0 20px;
    }

    .footer-wrapper {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 32px;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 40px;
        margin-bottom: 40px;
    }

    .footer-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .footer-logo-icon {
        font-size: 24px;
        color: #27ae60;
    }

    .footer-logo-text {
        font-size: 1.3rem;
        font-weight: bold;
        color: #1a4d2e;
    }

    .footer-description {
        color: #406a4c;
        line-height: 1.6;
        margin-bottom: 20px;
        font-size: 0.95rem;
    }

    .contact-support-btn {
        background: #1f5e3a;
        color: white;
        border: none;
        border-radius: 40px;
        padding: 12px 24px;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
    }

    .contact-support-btn:hover {
        background: #154e2b;
        transform: translateY(-2px);
    }

    .footer-heading {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1a4d2e;
        margin: 0 0 20px 0;
    }

    .footer-links-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-list-item {
        margin-bottom: 12px;
    }

    .footer-link {
        color: #406a4c;
        text-decoration: none;
        transition: color 0.2s ease;
        font-size: 0.95rem;
    }

    .footer-link:hover {
        color: #1f5e3a;
        text-decoration: underline;
    }

    .contact-info-item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
        color: #406a4c;
        font-size: 0.95rem;
    }

    .contact-icon {
        color: #1f5e3a;
        width: 20px;
    }

    .copyright-section {
        text-align: center;
        padding-top: 30px;
        border-top: 1px solid #daecd9;
    }

    .copyright-text {
        color: #406a4c;
        font-size: 0.9rem;
        margin: 0;
    }

    .heart-icon {
        color: #e74c3c;
        display: inline-block;
        animation: heartbeat 1.5s ease infinite;
    }

    @keyframes heartbeat {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    /* Responsive footer */
    @media (max-width: 768px) {
        .footer-wrapper {
            padding: 0 20px;
        }
        
        .footer-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }
        
        .footer-about {
            text-align: center;
        }
        
        .footer-logo {
            justify-content: center;
        }
        
        .contact-info-item {
            justify-content: center;
        }
        
        .social-icons {
            justify-content: center;
        }
    }/* ===== DARK MODE STYLES FOR FOOTER ===== */
    body.dark-mode footer {
        background: #2d2d2d;
        border-top: 1px solid #404040;
    }

    body.dark-mode .footer-logo-text {
        color: #e0e0e0;
    }

    body.dark-mode .footer-description {
        color: #b0b0b0;
    }

    body.dark-mode .footer-heading {
        color: #e0e0e0;
    }

    body.dark-mode .footer-link {
        color: #b0b0b0;
    }

    body.dark-mode .footer-link:hover {
        color: #27ae60;
    }

    body.dark-mode .contact-info-item {
        color: #b0b0b0;
    }

    body.dark-mode .contact-icon {
        color: #27ae60;
    }

    body.dark-mode .copyright-section {
        border-top-color: #404040;
    }

    body.dark-mode .copyright-text {
        color: #b0b0b0;
    }

    body.dark-mode .heart-icon {
        color: #e74c3c;
    }

    body.dark-mode .contact-support-btn {
        background: #27ae60;
        color: white;
    }

    body.dark-mode .contact-support-btn:hover {
        background: #219a52;
    }

    /* Social media icons in dark mode */
    body.dark-mode .social-icons a {
        color: #b0b0b0 !important;
    }

    body.dark-mode .social-icons a:hover {
        color: #27ae60 !important;
    }

    /* Footer links list in dark mode */
    body.dark-mode .footer-links-list li a {
        color: #b0b0b0;
    }

    body.dark-mode .footer-links-list li a:hover {
        color: #27ae60;
    }

    /* Footer bottom section */
    body.dark-mode .footer-bottom {
        background: #1a1a1a;
    }

    /* Footer columns */
    body.dark-mode .footer-column {
        border-color: #404040;
    }

    /* Newsletter signup (if you have one) */
    body.dark-mode .newsletter-input {
        background: #3d3d3d;
        border-color: #404040;
        color: #e0e0e0;
    }

    body.dark-mode .newsletter-btn {
        background: #27ae60;
        color: white;
    }

    /* Payment icons (if you have them) */
    body.dark-mode .payment-icons i {
        color: #b0b0b0;
    }

    /* Back to top button (if you have one) */
    body.dark-mode .back-to-top {
        background: #27ae60;
        color: white;
    }

    body.dark-mode .back-to-top:hover {
        background: #219a52;
    }
</style>