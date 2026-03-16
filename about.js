// =========================
// ABOUT PAGE - SIMPLE INTERACTIONS
// =========================

document.addEventListener('DOMContentLoaded', function() {
    console.log("✅ About page loaded");
    
    // Smooth scroll for "Learn More" button
    const learnMoreBtn = document.querySelector('.secondary-btn');
    
    if (learnMoreBtn) {
        learnMoreBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            const missionSection = document.getElementById('mission');
            if (missionSection) {
                missionSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    }
    
    // Add animation on scroll (simple)
    const cards = document.querySelectorAll('.mission-card, .tech-card, .team-card');
    
    function checkScroll() {
        cards.forEach(card => {
            const cardTop = card.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (cardTop < windowHeight - 100) {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }
        });
    }
    
    // Set initial styles
    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    });
    
    // Check on load and scroll
    window.addEventListener('load', checkScroll);
    window.addEventListener('scroll', checkScroll);
});