// =========================
// DISEASE-DETAILS.JS - SIMPLIFIED VERSION
// =========================

document.addEventListener("DOMContentLoaded", function() {
    
    // Get disease database from window object
    const database = window.diseaseDatabase;
    
    if (!database) {
        showError("Disease database not loaded");
        return;
    }
    
    // Get disease ID from URL
    const urlParams = new URLSearchParams(window.location.search);
    const diseaseId = urlParams.get('disease') || urlParams.get('id');
    
    if (!diseaseId) {
        showError("No disease specified");
        return;
    }
    
    // Find disease in database
    let disease = database[diseaseId];
    
    if (!disease) {
        showError(`Disease "${diseaseId}" not found`);
        return;
    }
    
    // Hide loading indicator and show container
    document.getElementById('loadingIndicator').style.display = 'none';
    document.getElementById('diseaseDetailContainer').style.display = 'block';
    
    // Populate page with disease data
    populatePage(disease);
    
    function populatePage(disease) {
        
        // Page title
        document.title = `${disease.name} - AgroScan`;
        
        // Breadcrumb
        document.getElementById("diseaseBreadcrumb").textContent = disease.name;
        
        // Title
        document.getElementById("diseaseTitle").textContent = disease.name;
        
        // Scientific name
        document.getElementById("scientificName").textContent = disease.scientific || "Unknown species";
        
        // Type badge
        const typeElement = document.getElementById("typeBadge");
        typeElement.textContent = disease.type || "Unknown";
        typeElement.className = `type-badge ${(disease.type || "unknown").toLowerCase()}`;
        
        // Severity badge
        const severityElement = document.getElementById("severityBadge");
        severityElement.textContent = (disease.severity || "Medium") + " Severity";
        severityElement.className = `severity-badge ${(disease.severity || "medium").toLowerCase()}`;
        
        // Quick info cards
        document.getElementById("affectedPlants").textContent = disease.affectedPlants || "Various plants";
        document.getElementById("optimalConditions").textContent = disease.optimalConditions || "Varies by region";
        document.getElementById("humidityNeeds").textContent = disease.humidityNeeds || "High humidity";
        document.getElementById("commonRegions").textContent = disease.commonRegions || "Worldwide";
        
        // Main image
        const mainImage = document.getElementById("mainDiseaseImage");
        if (disease.images?.main) {
            mainImage.src = disease.images.main;
        } else {
            mainImage.src = `https://via.placeholder.com/500x300?text=${disease.name}`;
        }
        
        // Thumbnails
        const thumbnailGrid = document.getElementById("thumbnailGrid");
        if (thumbnailGrid && disease.images?.thumbnails) {
            let html = '';
            disease.images.thumbnails.forEach((thumb, index) => {
                html += `<img src="${thumb}" alt="Thumbnail" class="thumbnail ${index === 0 ? 'active' : ''}" onclick="changeMainImage(this.src, this)">`;
            });
            thumbnailGrid.innerHTML = html;
        }
        
        // Description
        document.getElementById("diseaseDescription").textContent = disease.description || "No description available.";
        
        // Symptoms
        const symptomsList = document.getElementById("symptomsList");
        if (symptomsList && disease.symptoms) {
            let html = '';
            disease.symptoms.forEach(symptom => {
                html += `<li>${symptom}</li>`;
            });
            symptomsList.innerHTML = html;
        }
        
        // Prevention lists
        if (disease.prevention) {
            // Cultural
            if (disease.prevention.cultural) {
                let html = '';
                disease.prevention.cultural.forEach(item => {
                    html += `<li>${item}</li>`;
                });
                document.getElementById("culturalList").innerHTML = html;
            }
            
            // Biological
            if (disease.prevention.biological) {
                let html = '';
                disease.prevention.biological.forEach(item => {
                    html += `<li>${item}</li>`;
                });
                document.getElementById("biologicalList").innerHTML = html;
            }
            
            // Chemical
            if (disease.prevention.chemical) {
                let html = '';
                disease.prevention.chemical.forEach(item => {
                    html += `<li>${item}</li>`;
                });
                document.getElementById("chemicalList").innerHTML = html;
            }
            
            // Monitoring
            if (disease.prevention.monitoring) {
                let html = '';
                disease.prevention.monitoring.forEach(item => {
                    html += `<li>${item}</li>`;
                });
                document.getElementById("monitoringList").innerHTML = html;
            }
        }
        
        // Similar diseases
        const similarGrid = document.getElementById("similarDiseases");
        if (similarGrid && disease.similarDiseases) {
            let html = '';
            disease.similarDiseases.forEach(similar => {
                html += `
                    <a href="disease-details.php?disease=${similar.url}" class="similar-card">
                        <h4>${similar.name}</h4>
                        <p>${similar.description}</p>
                    </a>
                `;
            });
            similarGrid.innerHTML = html;
        }
    }
    
    function showError(message) {
        document.getElementById('loadingIndicator').style.display = 'none';
        const notFound = document.getElementById('notFoundContainer');
        notFound.style.display = 'block';
        notFound.querySelector('p').textContent = message;
    }
});

// Image gallery helper
function changeMainImage(src, element) {
    document.getElementById('mainDiseaseImage').src = src;
    document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
    element.classList.add('active');
}