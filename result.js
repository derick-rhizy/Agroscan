// =========================
// RESULT.JS - WITH AI DISEASE DATA INTEGRATION
// =========================

document.addEventListener("DOMContentLoaded", function() {
    console.log("✅ Results page loaded - connecting to scan data...");
    
    // =========================
    // GET ALL DOM ELEMENTS
    // =========================
    const elements = {
        // Basic info
        diseaseName: document.getElementById("diseaseName"),
        confidenceValue: document.getElementById("confidenceValue"),
        confidenceBadge: document.getElementById("confidenceBadge"),
        confidenceDetail: document.getElementById("confidenceDetail"),
        scanDate: document.getElementById("scanDate"),
        scanId: document.getElementById("scanId"),
        resultImage: document.getElementById("resultImage"),
        
        // Disease details
        scientificName: document.getElementById("scientificName"),
        diseaseDescription: document.getElementById("diseaseDescription"),
        diseaseType: document.getElementById("diseaseType"),
        diseaseTypeBadge: document.getElementById("diseaseTypeBadge"),
        severityText: document.getElementById("severityText"),
        diseaseIcon: document.getElementById("diseaseIcon"),
        
        // Plant info
        plantType: document.getElementById("plantType"),
        
        // Similar diseases
        similarDiseases: document.getElementById("similarDiseases"),
        
        // Recommendations elements
        treatmentList: document.getElementById("treatmentList"),
        preventionList: document.getElementById("preventionList"),
        productsList: document.getElementById("productsList"),
        
        // Tab buttons
        tabTreatment: document.getElementById("tabTreatment"),
        tabPrevention: document.getElementById("tabPrevention"),
        tabProducts: document.getElementById("tabProducts"),
        treatmentContent: document.getElementById("treatmentContent"),
        preventionContent: document.getElementById("preventionContent"),
        productsContent: document.getElementById("productsContent"),
        
        // Action buttons
        printResult: document.getElementById("printResult"),
        shareResult: document.getElementById("shareResult"),
        newScanBtn: document.getElementById("newScanBtn"),
        learnMoreBtn: document.getElementById("learnMoreBtn")
    };
    
    // Check if we have data
    checkForData();
    
    // =========================
    // CHECK LOCALSTORAGE DATA
    // =========================
    function checkForData() {
        // Get data from localStorage
        const diseaseName = localStorage.getItem("diseaseName");
        const confidence = localStorage.getItem("confidence");
        const scanDate = localStorage.getItem("scanDate");
        const scanId = localStorage.getItem("scanId");
        const scannedImage = localStorage.getItem("scannedImage");
        const plantStatus = localStorage.getItem("plantStatus");
        const diseaseId = localStorage.getItem("diseaseId");
        
        console.log("📊 Data from scan:", { 
            diseaseName, 
            confidence, 
            plantStatus,
            diseaseId 
        });
        
        if (!diseaseName || !confidence) {
            showNoDataMessage();
            return;
        }
        
        loadResults({
            diseaseName,
            confidence,
            scanDate,
            scanId,
            scannedImage,
            plantStatus,
            diseaseId
        });
    }
    
    // =========================
    // SHOW NO DATA MESSAGE
    // =========================
    function showNoDataMessage() {
        if (elements.diseaseName) {
            elements.diseaseName.textContent = "No Scan Found";
        }
        if (elements.diseaseDescription) {
            elements.diseaseDescription.textContent = "Please scan a plant first to see results here.";
        }
        if (elements.confidenceValue) {
            elements.confidenceValue.textContent = "0";
        }
        
        const container = document.querySelector(".results-container");
        if (container) {
            const alertDiv = document.createElement("div");
            alertDiv.className = "no-data-alert";
            alertDiv.style.cssText = `
                background: #f8d7da;
                color: #721c24;
                padding: 30px;
                border-radius: 15px;
                text-align: center;
                margin: 20px;
            `;
            alertDiv.innerHTML = `
                <i class="fas fa-exclamation-triangle" style="font-size: 3rem; margin-bottom: 15px;"></i>
                <h3>No scan results found</h3>
                <p>Please scan a plant first to see diagnosis results.</p>
                <a href="scan.html" style="
                    display: inline-block;
                    background: #1f5e3a;
                    color: white;
                    padding: 12px 30px;
                    border-radius: 30px;
                    text-decoration: none;
                    margin-top: 15px;
                ">
                    <i class="fas fa-camera"></i> Go to Scan
                </a>
            `;
            container.prepend(alertDiv);
        }
    }
    
    // =========================
    // LOAD RESULTS INTO PAGE
    // =========================
    function loadResults(data) {
        console.log("📊 Loading results:", data);
        
        // Get disease info from AiDiseaseData
        let diseaseInfo = null;
        
        if (typeof AiDiseaseData !== 'undefined' && data.plantStatus) {
            diseaseInfo = AiDiseaseData.getDiseaseByStatus(data.plantStatus);
            console.log("📚 Disease info from database:", diseaseInfo);
        }
        
        // ===== BASIC INFORMATION =====
        if (elements.diseaseName) {
            elements.diseaseName.textContent = diseaseInfo ? diseaseInfo.name : (data.diseaseName || "Unknown");
        }
        
        if (elements.confidenceValue) {
            elements.confidenceValue.textContent = data.confidence || "0";
        }
        
        if (elements.confidenceDetail) {
            elements.confidenceDetail.textContent = data.confidence + "%";
        }
        
        if (elements.scanDate) {
            elements.scanDate.textContent = data.scanDate || new Date().toLocaleDateString();
        }
        
        if (elements.scanId) {
            elements.scanId.textContent = data.scanId || "N/A";
        }
        
        // ===== IMAGE =====
        if (elements.resultImage && data.scannedImage && data.scannedImage !== "#") {
            elements.resultImage.src = data.scannedImage;
        }
        
        // ===== DISEASE DETAILS FROM DATABASE =====
        if (diseaseInfo) {
            // Update scientific name
            if (elements.scientificName) {
                elements.scientificName.textContent = diseaseInfo.scientificName || "Unknown species";
            }
            
            // Update description
            if (elements.diseaseDescription) {
                elements.diseaseDescription.textContent = diseaseInfo.description || "No description available.";
            }
            
            // Update disease type
            if (elements.diseaseType) {
                elements.diseaseType.textContent = diseaseInfo.type || "Unknown";
            }
            
            if (elements.diseaseTypeBadge) {
                elements.diseaseTypeBadge.textContent = diseaseInfo.type || "Unknown";
                elements.diseaseTypeBadge.className = "disease-type " + (diseaseInfo.type || "unknown").toLowerCase();
            }
            
            // Update icon if exists
            if (elements.diseaseIcon) {
                elements.diseaseIcon.className = `fas ${diseaseInfo.icon || 'fa-leaf'}`;
                if (diseaseInfo.color) {
                    elements.diseaseIcon.style.color = diseaseInfo.color;
                }
            }
            
            // Update learn more button
            if (elements.learnMoreBtn && diseaseInfo.id && diseaseInfo.id !== 'non-plant' && diseaseInfo.id !== 'healthy') {
                elements.learnMoreBtn.href = `disease-details.html?id=${diseaseInfo.id}`;
                elements.learnMoreBtn.style.display = 'inline-block';
            } else if (elements.learnMoreBtn) {
                elements.learnMoreBtn.style.display = 'none';
            }
            
            // Update severity
            const severity = AiDiseaseData.getSeverity(data.plantStatus, parseFloat(data.confidence));
            if (elements.severityText) {
                elements.severityText.textContent = severity;
            }
            updateSeverityBars(severity);
            
            // Load recommendations
            loadRecommendations(diseaseInfo);
            
        } else {
            // Fallback if no database
            console.warn("No disease info found, using defaults");
            
            if (elements.severityText) {
                elements.severityText.textContent = "Medium";
            }
            updateSeverityBars("Medium");
        }
        
        // Load similar diseases
        loadSimilarDiseases(data.plantStatus);
    }
    
    // =========================
    // LOAD RECOMMENDATIONS
    // =========================
    function loadRecommendations(diseaseInfo) {
        // Load treatment
        if (elements.treatmentList && diseaseInfo.treatment) {
            let html = '';
            diseaseInfo.treatment.forEach(item => {
                html += `
                    <li class="recommendation-item">
                        <div class="recommendation-item-header">
                            <i class="fas fa-check-circle recommendation-icon"></i>
                            <strong class="recommendation-name">${item.name}</strong>
                        </div>
                        <p class="recommendation-desc">${item.description || item.desc || ''}</p>
                        ${item.tip ? `
                        <div class="recommendation-tip">
                            <i class="fas fa-lightbulb"></i> ${item.tip}
                        </div>
                        ` : ''}
                    </li>
                `;
            });
            elements.treatmentList.innerHTML = html || '<li class="recommendation-item">No treatment information available.</li>';
        }
        
        // Load prevention
        if (elements.preventionList && diseaseInfo.prevention) {
            let html = '';
            diseaseInfo.prevention.forEach(item => {
                html += `
                    <li class="recommendation-item">
                        <div class="recommendation-item-header">
                            <i class="fas fa-shield-alt recommendation-icon"></i>
                            <strong class="recommendation-name">${item.name}</strong>
                        </div>
                        <p class="recommendation-desc">${item.description || item.desc || ''}</p>
                        ${item.tip ? `
                        <div class="recommendation-tip">
                            <i class="fas fa-lightbulb"></i> ${item.tip}
                        </div>
                        ` : ''}
                    </li>
                `;
            });
            elements.preventionList.innerHTML = html || '<li class="recommendation-item">No prevention information available.</li>';
        }
        
        // Load products
        if (elements.productsList && diseaseInfo.products) {
            let html = '';
            diseaseInfo.products.forEach(item => {
                // Generate stars
                const rating = item.rating || 4.5;
                const fullStars = Math.floor(rating);
                const halfStar = rating % 1 >= 0.5;
                
                let stars = '';
                for (let i = 0; i < fullStars; i++) stars += '<i class="fas fa-star"></i>';
                if (halfStar) stars += '<i class="fas fa-star-half-alt"></i>';
                for (let i = 0; i < 5 - fullStars - (halfStar ? 1 : 0); i++) stars += '<i class="far fa-star"></i>';
                
                html += `
                    <div class="product-card">
                        <div class="product-icon">
                            <i class="fas ${item.icon || 'fa-flask'}"></i>
                        </div>
                        <h4 class="product-name">${item.name}</h4>
                        <p class="product-desc">${item.description || ''}</p>
                        <div class="product-rating">
                            ${stars} <span>(${rating})</span>
                        </div>
                        ${item.price ? `<div class="product-price">${item.price}</div>` : ''}
                        <button class="product-btn">View Details</button>
                    </div>
                `;
            });
            elements.productsList.innerHTML = html || '<p class="no-products">No product recommendations available.</p>';
            
            // Add product button listeners
            document.querySelectorAll('.product-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const productName = this.closest('.product-card').querySelector('.product-name').textContent;
                    alert(`🔍 Viewing details for: ${productName}\n\nIn a full version, this would take you to the product page.`);
                });
            });
        }
    }
    
    // =========================
    // UPDATE SEVERITY BARS
    // =========================
    function updateSeverityBars(severity) {
        const indicator = document.getElementById("severityIndicator");
        if (!indicator) return;
        
        const bars = indicator.querySelectorAll(".severity-bar");
        if (!bars.length) return;
        
        // Remove active class from all bars
        bars.forEach(bar => bar.classList.remove("active"));
        
        // Activate based on severity
        if (severity === "High") {
            if (bars[0]) bars[0].classList.add("active");
            if (bars[1]) bars[1].classList.add("active");
            if (bars[2]) bars[2].classList.add("active");
        } else if (severity === "Medium") {
            if (bars[0]) bars[0].classList.add("active");
            if (bars[1]) bars[1].classList.add("active");
        } else if (severity === "Low") {
            if (bars[0]) bars[0].classList.add("active");
        }
    }
    
    // =========================
    // LOAD SIMILAR DISEASES
    // =========================
    function loadSimilarDiseases(currentStatus) {
        if (!elements.similarDiseases || typeof AiDiseaseData === 'undefined') return;
        
        // Get all diseases except current and non-plant
        const allDiseases = AiDiseaseData.getAllDiseases();
        const similar = allDiseases.filter(d => d.id !== currentStatus && d.id !== 'non-plant');
        
        // Take first 3-4
        const displayDiseases = similar.slice(0, 4);
        
        if (displayDiseases.length === 0) {
            elements.similarDiseases.innerHTML = `
                <div class="similar-item">
                    <span class="similar-name">No similar diseases</span>
                </div>
            `;
            return;
        }
        
        let html = '';
        displayDiseases.forEach(disease => {
            html += `
                <a href="disease-details.html?id=${disease.id}" class="similar-item" style="text-decoration: none;">
                    <span class="similar-name">
                        <i class="fas ${disease.icon || 'fa-leaf'}" style="color: ${disease.color || '#7f8c8d'}; margin-right: 8px;"></i>
                        ${disease.name}
                    </span>
                    <span class="similar-match">Learn more</span>
                </a>
            `;
        });
        
        elements.similarDiseases.innerHTML = html;
    }
    
    // =========================
    // TAB FUNCTIONALITY
    // =========================
    function setupTabs() {
        function switchTab(tab) {
            // Remove active class from all tabs
            if (elements.tabTreatment) elements.tabTreatment.classList.remove("active");
            if (elements.tabPrevention) elements.tabPrevention.classList.remove("active");
            if (elements.tabProducts) elements.tabProducts.classList.remove("active");
            
            // Hide all content
            if (elements.treatmentContent) elements.treatmentContent.classList.add("hidden");
            if (elements.preventionContent) elements.preventionContent.classList.add("hidden");
            if (elements.productsContent) elements.productsContent.classList.add("hidden");
            
            // Show selected
            if (tab === "treatment") {
                if (elements.tabTreatment) elements.tabTreatment.classList.add("active");
                if (elements.treatmentContent) elements.treatmentContent.classList.remove("hidden");
            } else if (tab === "prevention") {
                if (elements.tabPrevention) elements.tabPrevention.classList.add("active");
                if (elements.preventionContent) elements.preventionContent.classList.remove("hidden");
            } else if (tab === "products") {
                if (elements.tabProducts) elements.tabProducts.classList.add("active");
                if (elements.productsContent) elements.productsContent.classList.remove("hidden");
            }
        }
        
        if (elements.tabTreatment) {
            elements.tabTreatment.addEventListener("click", () => switchTab("treatment"));
        }
        if (elements.tabPrevention) {
            elements.tabPrevention.addEventListener("click", () => switchTab("prevention"));
        }
        if (elements.tabProducts) {
            elements.tabProducts.addEventListener("click", () => switchTab("products"));
        }
    }
    
    // =========================
    // ACTION BUTTONS
    // =========================
    function setupActionButtons() {
        // Print
        if (elements.printResult) {
            elements.printResult.addEventListener("click", () => window.print());
        }
        
        // Share
        if (elements.shareResult) {
            elements.shareResult.addEventListener("click", function() {
                const disease = localStorage.getItem("diseaseName") || "Unknown";
                const confidence = localStorage.getItem("confidence") || "0";
                
                if (navigator.share) {
                    navigator.share({
                        title: 'AgroScan Diagnosis',
                        text: `My plant was diagnosed with: ${disease} (${confidence}% confidence)`,
                        url: window.location.href
                    });
                } else {
                    navigator.clipboard.writeText(
                        `AgroScan Diagnosis: ${disease} (${confidence}% confidence)`
                    );
                    alert("📋 Results copied to clipboard!");
                }
            });
        }
        
        // New scan
        if (elements.newScanBtn) {
            elements.newScanBtn.addEventListener("click", function() {
                window.location.href = "scan.html";
            });
        }
    }
    
    // =========================
    // INITIALIZE
    // =========================
    setupTabs();
    setupActionButtons();
    
    // Check if AiDiseaseData is available
    if (typeof AiDiseaseData !== 'undefined') {
        console.log("✅ AI Disease Data loaded with", Object.keys(AiDiseaseData.diseases).length, "diseases");
    } else {
        console.warn("⚠️ AiDiseaseData not found - make sure ai-disease-data.js is loaded before result.js");
    }
});