// =========================
// SCAN.JS - WITH DATABASE INTEGRATION
// =========================

// =========================
// MODEL CONFIGURATION
// =========================
const URL = "../model/";  // Path to your model folder

let model;
let maxPredictions;
let modelLoaded = false;
let isScanning = false; // Prevent multiple clicks

// =========================
// GET HTML ELEMENTS WITH SAFE CHECKING
// =========================
function getElementSafe(id) {
    const element = document.getElementById(id);
    if (!element) {
        console.warn(`⚠️ Element #${id} not found in DOM`);
    }
    return element;
}

const uploadArea = getElementSafe("uploadArea");
const fileInput = getElementSafe("fileInput");
const browseButton = getElementSafe("browseButton");
const previewContainer = getElementSafe("previewContainer");
const previewImage = getElementSafe("previewImage");
const removeButton = getElementSafe("removeButton");
const scanButton = getElementSafe("scanButton");
const analysisStatus = getElementSafe("analysisStatus");
const progressFill = getElementSafe("progressFill");

// Optional plant info elements
const plantTypeInput = getElementSafe("plantType");
const symptomsInput = getElementSafe("symptoms");
const growthStageInput = getElementSafe("growthStage");

// =========================
// HELPER FUNCTIONS
// =========================
function getSeverityFromConfidence(confidence) {
    const confValue = parseFloat(confidence);
    if (confValue >= 80) return 'High';
    if (confValue >= 60) return 'Medium';
    return 'Low';
}

function getStatusFromClass(className) {
    const classLower = className.toLowerCase();
    
    if (classLower.includes('restricted') || classLower.includes('not a plant')) {
        return 'non-plant';
    } else if (classLower.includes('healthy')) {
        return 'healthy';
    } else if (classLower.includes('early blight')) {
        return 'early-blight';
    } else if (classLower.includes('late blight')) {
        return 'late-blight';
    } else if (classLower.includes('leaf mold')) {
        return 'leaf-mold';
    } else if (classLower.includes('bacterial spot')) {
        return 'bacterial-spot';
    }
    return 'unknown';
}

function getDisplayNameFromClass(className) {
    const classLower = className.toLowerCase();
    
    if (classLower.includes('not a plant')) return 'Not a Plant';
    if (classLower.includes('healthy')) return 'Healthy Plant';
    if (classLower.includes('early blight')) return 'Early Blight';
    if (classLower.includes('late blight')) return 'Late Blight';
    if (classLower.includes('leaf mold')) return 'Leaf Mold';
    if (classLower.includes('bacterial spot')) return 'Bacterial Spot';
    return className;
}

// =========================
// ENHANCED NON-PLANT DETECTION
// =========================
async function isPlantImage(predictions, imageElement) {
    // Get top prediction
    const topPrediction = predictions[0];
    const topClass = topPrediction.className.toLowerCase();
    const topConfidence = topPrediction.probability;
    
    console.log(`🔍 Plant check - Top: ${topClass} (${(topConfidence*100).toFixed(1)}%)`);
    
    // METHOD 1: Check if "not a plant" is the top prediction
    if (topClass.includes('not a plant')) {
        console.log("🚫 Rejected: Not a plant class detected");
        return false;
    }
    
    // METHOD 2: Check confidence threshold
    if (topConfidence < 0.4) {
        console.log("🚫 Rejected: Very low confidence");
        return false;
    }
    
    // METHOD 3: Quick green check for medium confidence images
    if (topConfidence < 0.6) {
        console.log("🔍 Medium confidence - checking green pixels...");
        const hasGreen = await quickGreenCheck(imageElement);
        if (!hasGreen) {
            console.log("🚫 Rejected: No green pixels detected");
            return false;
        }
        console.log("✅ Green pixels detected");
    }
    
    // Check if ANY prediction has high confidence for non-plant
    const hasRestricted = predictions.some(p => 
        p.className.toLowerCase().includes('not a plant') && 
        p.probability > 0.3
    );
    
    if (hasRestricted) {
        console.log("🚫 Rejected: Non-plant in top predictions");
        return false;
    }
    
    console.log("✅ Image passed plant checks");
    return true;
}

// Simple green pixel check
function quickGreenCheck(imageElement) {
    return new Promise((resolve) => {
        try {
            const canvas = document.createElement('canvas');
            canvas.width = 50;
            canvas.height = 50;
            const ctx = canvas.getContext('2d');
            
            // Make sure image is loaded
            if (!imageElement.complete || imageElement.naturalWidth === 0) {
                // If image not loaded, wait
                imageElement.onload = () => {
                    ctx.drawImage(imageElement, 0, 0, 50, 50);
                    const data = ctx.getImageData(0, 0, 50, 50).data;
                    const result = analyzeGreenPixels(data);
                    resolve(result);
                };
                return;
            }
            
            ctx.drawImage(imageElement, 0, 0, 50, 50);
            const data = ctx.getImageData(0, 0, 50, 50).data;
            const result = analyzeGreenPixels(data);
            resolve(result);
            
        } catch (error) {
            console.error("Error in green check:", error);
            resolve(true); // If check fails, assume it might be a plant
        }
    });
}

function analyzeGreenPixels(data) {
    let greenPixels = 0;
    const totalPixels = data.length / 4;
    
    for (let i = 0; i < data.length; i += 4) {
        const r = data[i];
        const g = data[i + 1];
        const b = data[i + 2];
        
        // Check for green-dominant pixels
        if (g > r && g > b && g > 70) {
            greenPixels++;
        }
        
        // Also check for brown/earthy tones (soil, stems)
        if (r > 100 && g > 60 && b < 100 && r > g) {
            greenPixels++; // Count as plant-related
        }
    }
    
    const greenPercentage = (greenPixels / totalPixels) * 100;
    console.log(`🌱 Green pixels: ${greenPercentage.toFixed(1)}%`);
    
    return greenPercentage > 8; // At least 8% green/brown pixels
}

// =========================
// IMAGE COMPRESSION FUNCTION
// =========================
function compressImage(dataUrl, maxWidth = 800, quality = 0.6) {
    return new Promise((resolve, reject) => {
        const img = new Image();
        img.src = dataUrl;
        
        img.onload = function() {
            try {
                const canvas = document.createElement('canvas');
                let width = img.width;
                let height = img.height;
                
                if (width > maxWidth) {
                    height = Math.round(height * (maxWidth / width));
                    width = maxWidth;
                }
                
                const maxHeight = 600;
                if (height > maxHeight) {
                    width = Math.round(width * (maxHeight / height));
                    height = maxHeight;
                }
                
                canvas.width = width;
                canvas.height = height;
                
                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0, width, height);
                
                let compressedDataUrl = canvas.toDataURL('image/jpeg', quality);
                
                if (compressedDataUrl.length > 2.5 * 1024 * 1024) {
                    compressedDataUrl = canvas.toDataURL('image/jpeg', 0.4);
                }
                
                console.log(`📸 Image compressed: ${Math.round(dataUrl.length/1024)}KB → ${Math.round(compressedDataUrl.length/1024)}KB`);
                resolve(compressedDataUrl);
                
            } catch (error) {
                console.error("❌ Compression error:", error);
                reject(error);
            }
        };
        
        img.onerror = function() {
            reject(new Error("Failed to load image for compression"));
        };
    });
}

// =========================
// LOAD AI MODEL
// =========================
async function loadModel() {
    if (!scanButton) return;
    
    try {
        console.log("Loading AI model from:", URL);
        
        const modelURL = URL + "model.json";
        const metadataURL = URL + "metadata.json";
        
        const modelCheck = await fetch(modelURL, { method: 'HEAD' }).catch(() => null);
        
        if (!modelCheck) {
            console.warn("Model files not found at:", URL);
            console.warn("Using DEMO MODE - predictions will be simulated");
            modelLoaded = false;
            scanButton.disabled = false;
            showModelStatus("⚠️ Using DEMO MODE - No model found", true);
            return;
        }
        
        model = await tmImage.load(modelURL, metadataURL);
        maxPredictions = model.getTotalClasses();
        modelLoaded = true;
        scanButton.disabled = false;
        
        console.log("✅ Model loaded successfully!");
        console.log("Model has", maxPredictions, "classes");
        
        try {
            const metadata = await fetch(metadataURL).then(res => res.json());
            console.log("📋 Model classes:", metadata.labels);
        } catch (e) {
            console.log("Could not load metadata separately");
        }
        
        showModelStatus("✅ AI Model Ready", false);
        
    } catch (error) {
        console.error("❌ Model loading failed:", error);
        modelLoaded = false;
        scanButton.disabled = false;
        showModelStatus("⚠️ Using DEMO MODE - Model error", true);
    }
}

// Start loading model
if (scanButton) {
    loadModel();
}

// =========================
// UPLOAD AREA CLICK HANDLERS
// =========================
if (uploadArea && fileInput) {
    uploadArea.addEventListener("click", function() {
        fileInput.click();
    });
}

if (browseButton && fileInput) {
    browseButton.addEventListener("click", function(e) {
        e.stopPropagation();
        fileInput.click();
    });
}

// =========================
// FILE SELECTION HANDLER
// =========================
if (fileInput) {
    fileInput.addEventListener("change", function() {
        const file = this.files[0];
        if (!file) return;

        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        if (!allowedTypes.includes(file.type)) {
            alert("❌ Please select a valid image file (JPG, PNG, or WEBP)");
            fileInput.value = "";
            return;
        }

        const maxSize = 10 * 1024 * 1024;
        if (file.size > maxSize) {
            alert("❌ File too large. Maximum size is 10MB.");
            fileInput.value = "";
            return;
        }

        const reader = new FileReader();

        reader.onload = function(e) {
            if (previewImage) previewImage.src = e.target.result;
            if (previewContainer) previewContainer.classList.remove("hidden");
            if (uploadArea) uploadArea.classList.add("hidden");
            if (scanButton) scanButton.disabled = false;
            
            if (progressFill) progressFill.style.width = "0%";
            
            console.log("✅ Image loaded:", file.name, "Size:", Math.round(file.size/1024), "KB");
        };

        reader.onerror = function() {
            alert("❌ Error reading file. Please try again.");
        };

        reader.readAsDataURL(file);
    });
}

// =========================
// REMOVE IMAGE HANDLER
// =========================
if (removeButton) {
    removeButton.addEventListener("click", function() {
        if (fileInput) fileInput.value = "";
        if (previewImage) previewImage.src = "#";
        if (previewContainer) previewContainer.classList.add("hidden");
        if (uploadArea) uploadArea.classList.remove("hidden");
        if (scanButton) scanButton.disabled = true;
        if (analysisStatus) analysisStatus.classList.add("hidden");
        if (progressFill) progressFill.style.width = "0%";
        
        console.log("✅ Image removed");
    });
}

// =========================
// DRAG AND DROP
// =========================
if (uploadArea) {
    uploadArea.addEventListener("dragover", function(e) {
        e.preventDefault();
        this.classList.add("dragover");
    });

    uploadArea.addEventListener("dragleave", function(e) {
        e.preventDefault();
        this.classList.remove("dragover");
    });

    uploadArea.addEventListener("drop", function(e) {
        e.preventDefault();
        this.classList.remove("dragover");
        
        const file = e.dataTransfer.files[0];
        if (file && file.type.match('image.*')) {
            if (fileInput) {
                fileInput.files = e.dataTransfer.files;
                const event = new Event('change', { bubbles: true });
                fileInput.dispatchEvent(event);
            }
        } else {
            alert("❌ Please drop an image file");
        }
    });
}

// =========================
// SCAN BUTTON CLICK HANDLER
// =========================
if (scanButton) {
    scanButton.addEventListener("click", async function() {
        if (isScanning) return;
        
        if (!previewImage || !previewImage.src || previewImage.src === "#" || previewImage.src === window.location.href) {
            alert("❌ Please upload an image first.");
            return;
        }

        isScanning = true;
        scanButton.disabled = true;
        
        if (analysisStatus) analysisStatus.classList.remove("hidden");
        
        let progress = 0;
        if (progressFill) progressFill.style.width = "0%";
        
        const interval = setInterval(() => {
            progress += 5;
            if (progressFill) progressFill.style.width = progress + "%";
            
            if (progress >= 100) {
                clearInterval(interval);
            }
        }, 100);
        
        await new Promise(resolve => setTimeout(resolve, 2000));
        
        await runPrediction();
    });
}

// =========================
// RUN PREDICTION FUNCTION
// =========================
async function runPrediction() {
    try {
        let diseaseName = "Unknown";
        let confidence = 0;
        let allPredictions = [];
        let status = "unknown";
        let displayName = "Unknown";
        
        if (modelLoaded && model) {
            // ===== REAL MODEL PREDICTION =====
            console.log("🔍 Running real model prediction...");
            
            const predictions = await model.predict(previewImage);
            allPredictions = predictions;
            
            // Sort predictions
            predictions.sort((a, b) => b.probability - a.probability);
            let highest = predictions[0];
            
            console.log("📊 ALL PREDICTIONS:");
            predictions.forEach((p, index) => {
                console.log(`   ${index + 1}. ${p.className}: ${(p.probability * 100).toFixed(2)}%`);
            });
            
            diseaseName = highest.className;
            confidence = (highest.probability * 100).toFixed(2);
            status = getStatusFromClass(diseaseName);
            displayName = getDisplayNameFromClass(diseaseName);
            
            console.log(`🏆 TOP PREDICTION: ${diseaseName} (${confidence}%) - Status: ${status} - Display: ${displayName}`);
            
            // ===== ENHANCED NON-PLANT DETECTION =====
            const isPlant = await isPlantImage(predictions, previewImage);
            
            if (!isPlant || status === 'non-plant') {
                console.log("🚫 NON-PLANT IMAGE DETECTED - SHOWING POPUP");
                
                if (analysisStatus) analysisStatus.classList.add("hidden");
                if (scanButton) scanButton.disabled = false;
                if (progressFill) progressFill.style.width = "0%";
                isScanning = false;
                
                showNonPlantPopup();
                return;
            }
            
        } else {
            // ===== DEMO MODE =====
            console.log("🎮 Running DEMO MODE prediction...");
            
            await new Promise(resolve => setTimeout(resolve, 1000));
            
            const randomValue = Math.random();
            let selected;
            
            if (randomValue < 0.2) {
                selected = { name: "not a plant", probability: 0.92 };
            } else if (randomValue < 0.4) {
                selected = { name: "healthy plant", probability: 0.88 };
            } else if (randomValue < 0.55) {
                selected = { name: "early blight", probability: 0.85 };
            } else if (randomValue < 0.7) {
                selected = { name: "late blight", probability: 0.87 };
            } else if (randomValue < 0.85) {
                selected = { name: "leaf mold", probability: 0.83 };
            } else {
                selected = { name: "bacterial spot", probability: 0.86 };
            }
            
            diseaseName = selected.name;
            confidence = (selected.probability * 100).toFixed(2);
            status = getStatusFromClass(diseaseName);
            displayName = getDisplayNameFromClass(diseaseName);
            
            console.log(`🎮 DEMO Prediction: ${diseaseName} (${confidence}%) - Status: ${status} - Display: ${displayName}`);
            
            if (status === 'non-plant') {
                console.log("🚫 DEMO: Non-plant detected - showing popup");
                if (analysisStatus) analysisStatus.classList.add("hidden");
                if (scanButton) scanButton.disabled = false;
                if (progressFill) progressFill.style.width = "0%";
                isScanning = false;
                showNonPlantPopup();
                return;
            }
        }
        
        // ===== SAVE AND REDIRECT FOR PLANTS =====
        console.log("🌱 PLANT IMAGE DETECTED - saving and redirecting...");
        
        // Compress image for upload
        console.log("🖼️ Compressing image...");
        const compressedImage = await compressImage(previewImage.src, 600, 0.6);
        
        // Convert base64 to blob for upload
        const blob = dataURLtoBlob(compressedImage);
        const formData = new FormData();
        formData.append('image', blob, 'scan.jpg');
        formData.append('plant_name', plantTypeInput?.value || 'Unknown Plant');
        formData.append('disease_name', displayName);
        formData.append('confidence', confidence);
        
        // Send to server
        try {
            const response = await fetch('save-scan.php', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                console.log("✅ Scan saved to database with ID:", data.scan_id);
                
                // Also save to localStorage as backup
                saveScanToLocalStorage({
                    diseaseName: displayName,
                    confidence: confidence,
                    status: status,
                    image: compressedImage,
                    scanId: data.scan_id
                });
                
                // Redirect to result page with scan ID
                window.location.href = `result.php?id=${data.scan_id}`;
            } else {
                console.error("❌ Failed to save scan:", data.error);
                // Fallback to localStorage only
                saveScanToLocalStorage({
                    diseaseName: displayName,
                    confidence: confidence,
                    status: status,
                    image: compressedImage
                });
                window.location.href = "result.php?scan=success";
            }
        } catch (error) {
            console.error("❌ Error saving scan:", error);
            saveScanToLocalStorage({
                diseaseName: displayName,
                confidence: confidence,
                status: status,
                image: compressedImage
            });
            window.location.href = "result.php?scan=success";
        }
        
    } catch (error) {
        console.error("❌ Prediction error:", error);
        
        if (analysisStatus) analysisStatus.classList.add("hidden");
        if (scanButton) scanButton.disabled = false;
        if (progressFill) progressFill.style.width = "0%";
        isScanning = false;
        
        alert("❌ Analysis failed: " + error.message);
    }
}

// =========================
// CONVERT DATAURL TO BLOB
// =========================
function dataURLtoBlob(dataURL) {
    const arr = dataURL.split(',');
    const mime = arr[0].match(/:(.*?);/)[1];
    const bstr = atob(arr[1]);
    let n = bstr.length;
    const u8arr = new Uint8Array(n);
    
    while (n--) {
        u8arr[n] = bstr.charCodeAt(n);
    }
    
    return new Blob([u8arr], { type: mime });
}

// =========================
// SAVE TO LOCALSTORAGE WITH LIMIT
// =========================
function saveScanToLocalStorage(scanData) {
    try {
        let scans = [];
        const savedScans = localStorage.getItem('plantScans');
        
        if (savedScans) {
            scans = JSON.parse(savedScans);
        }
        
        const newScan = {
            ...scanData,
            id: Date.now(),
            formattedDate: new Date().toLocaleDateString('en-US', { 
                year: 'numeric', month: 'long', day: 'numeric' 
            })
        };
        
        scans.unshift(newScan);
        
        if (scans.length > 15) {
            scans = scans.slice(0, 15);
        }
        
        localStorage.setItem('plantScans', JSON.stringify(scans));
        console.log("✅ Scan saved directly to localStorage");
        
    } catch (error) {
        console.error("❌ Failed to save scan to localStorage:", error);
        
        if (error.name === 'QuotaExceededError' || error.message.includes('quota')) {
            try {
                let scans = JSON.parse(localStorage.getItem('plantScans') || '[]');
                if (scans.length > 0) {
                    scans.pop();
                    scans.unshift(scanData);
                    localStorage.setItem('plantScans', JSON.stringify(scans));
                    console.log("✅ Scan saved after removing oldest");
                }
            } catch (e) {
                console.error("❌ Still cannot save after cleanup");
            }
        }
    }
}

// =========================
// SHOW NON-PLANT POPUP
// =========================
function showNonPlantPopup() {
    const existingModal = document.querySelector(".non-plant-popup");
    if (existingModal) {
        existingModal.remove();
    }
    
    const overlay = document.createElement("div");
    overlay.className = "non-plant-popup-overlay";
    overlay.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    `;
    
    const popup = document.createElement("div");
    popup.className = "non-plant-popup";
    popup.style.cssText = `
        background: white;
        border-radius: 20px;
        padding: 30px;
        max-width: 400px;
        width: 90%;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    `;
    
    popup.innerHTML = `
        <i class="fas fa-exclamation-triangle" style="font-size: 4rem; color: #f0b000; margin-bottom: 20px;"></i>
        <h2 style="color: #1a4d2e; margin-bottom: 15px; font-size: 1.8rem;">Not a Plant Image</h2>
        <p style="color: #2e5f3d; margin-bottom: 25px; line-height: 1.6;">
            Please upload a clear photo of a plant leaf or affected area.
        </p>
        <button id="popupOkBtn" style="
            background: #1f5e3a;
            color: white;
            border: none;
            border-radius: 40px;
            padding: 12px 40px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
        ">OK</button>
    `;
    
    overlay.appendChild(popup);
    document.body.appendChild(overlay);
    
    const okBtn = document.getElementById("popupOkBtn");
    if (okBtn) {
        okBtn.addEventListener("click", function() {
            document.body.removeChild(overlay);
            if (removeButton) removeButton.click();
        });
    }
    
    overlay.addEventListener("click", function(e) {
        if (e.target === overlay) {
            document.body.removeChild(overlay);
            if (removeButton) removeButton.click();
        }
    });
}

// =========================
// SHOW MODEL STATUS
// =========================
function showModelStatus(message, isError = false) {
    const container = document.querySelector(".scan-container");
    if (!container) return;
    
    const existingStatus = document.querySelector(".model-status");
    if (existingStatus) {
        existingStatus.remove();
    }
    
    const statusDiv = document.createElement("div");
    statusDiv.className = "model-status";
    statusDiv.style.cssText = `
        padding: 12px 20px;
        border-radius: 12px;
        margin: 15px 0;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: slideDown 0.3s ease;
    `;
    
    if (isError) {
        statusDiv.style.background = "#f8d7da";
        statusDiv.style.color = "#721c24";
        statusDiv.style.border = "1px solid #f5c6cb";
        statusDiv.innerHTML = `<i class="fas fa-exclamation-triangle"></i> ${message}`;
    } else {
        statusDiv.style.background = "#d4edda";
        statusDiv.style.color = "#155724";
        statusDiv.style.border = "1px solid #c3e6cb";
        statusDiv.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;
    }
    
    container.prepend(statusDiv);
    
    if (!isError) {
        setTimeout(() => {
            statusDiv.style.opacity = "0";
            statusDiv.style.transition = "opacity 0.5s";
            setTimeout(() => {
                if (statusDiv.parentNode) {
                    statusDiv.remove();
                }
            }, 500);
        }, 3000);
    }
}

// =========================
// INITIALIZATION
// =========================
document.addEventListener("DOMContentLoaded", function() {
    console.log("✅ Scan page loaded");
    
    // Check model files
    console.log("📁 Model path:", URL);
    
    if (!document.querySelector('#scan-animations')) {
        const style = document.createElement('style');
        style.id = 'scan-animations';
        style.textContent = `
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            
            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .upload-area.dragover {
                border-color: #1f5e3a !important;
                background: #e8f5e8 !important;
                transform: scale(1.02);
                transition: all 0.2s ease;
            }
        `;
        document.head.appendChild(style);
    }
});

// =========================
// ERROR HANDLING FOR IMAGE LOAD
// =========================
if (previewImage) {
    previewImage.addEventListener("error", function() {
        console.error("Image failed to load");
        
        const container = document.querySelector(".scan-container");
        if (container) {
            const errorDiv = document.createElement("div");
            errorDiv.style.cssText = `
                background: #f8d7da;
                color: #721c24;
                padding: 15px;
                border-radius: 12px;
                margin: 10px 0;
                text-align: center;
                border: 1px solid #f5c6cb;
            `;
            errorDiv.innerHTML = `
                <i class="fas fa-exclamation-circle"></i>
                Failed to load image. Please try another file.
            `;
            
            container.prepend(errorDiv);
            setTimeout(() => errorDiv.remove(), 3000);
        }
        
        if (fileInput) fileInput.value = "";
        if (previewContainer) previewContainer.classList.add("hidden");
        if (uploadArea) uploadArea.classList.remove("hidden");
        if (scanButton) scanButton.disabled = true;
    });
}