// =========================
// HISTORY PAGE - DISPLAY SCAN HISTORY
// =========================

document.addEventListener('DOMContentLoaded', function() {
    
    // DOM Elements
    const historyGrid = document.getElementById('historyGrid');
    const noHistory = document.getElementById('noHistory');
    const searchInput = document.getElementById('searchHistory');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const clearHistoryBtn = document.getElementById('clearHistory');
    
    // Stats elements
    const totalScansEl = document.getElementById('totalScans');
    const uniqueDiseasesEl = document.getElementById('uniqueDiseases');
    const lastScanEl = document.getElementById('lastScan');
    
    // Current filter state
    let currentFilter = 'all';
    let searchTerm = '';
    
    // Initialize
    loadHistory();
    
    // Make updateStats globally available
    window.updateHistoryStats = updateStats;
    
    // =========================
    // LOAD HISTORY
    // =========================
    function loadHistory() {
        const history = scanHistory.getHistory();
        
        // Update stats
        updateStats();
        
        // Show/hide no history message
        if (history.length === 0) {
            historyGrid.innerHTML = '';
            noHistory.classList.remove('hidden');
            return;
        }
        
        noHistory.classList.add('hidden');
        
        // Filter history
        let filteredHistory = filterHistory(history);
        
        // Display history
        displayHistory(filteredHistory);
    }
    
    // =========================
    // FILTER HISTORY
    // =========================
    function filterHistory(history) {
        return history.filter(scan => {
            // Search filter
            const matchesSearch = searchTerm === '' || 
                scan.diseaseName.toLowerCase().includes(searchTerm.toLowerCase());
            
            // Date filter
            let matchesDate = true;
            const scanDate = new Date(scan.date);
            const now = new Date();
            
            if (currentFilter === 'recent') {
                const sevenDaysAgo = new Date();
                sevenDaysAgo.setDate(sevenDaysAgo.getDate() - 7);
                matchesDate = scanDate >= sevenDaysAgo;
            } else if (currentFilter === 'month') {
                const firstDayOfMonth = new Date(now.getFullYear(), now.getMonth(), 1);
                matchesDate = scanDate >= firstDayOfMonth;
            }
            
            return matchesSearch && matchesDate;
        });
    }
    
    // =========================
    // DISPLAY HISTORY CARDS
    // =========================
    function displayHistory(history) {
        if (history.length === 0) {
            historyGrid.innerHTML = `
                <div class="no-history" style="grid-column: 1/-1;">
                    <i class="fas fa-search"></i>
                    <h3>No matching scans</h3>
                    <p>Try adjusting your search or filter</p>
                </div>
            `;
            return;
        }
        
        let html = '';
        
        history.forEach(scan => {
            // Determine confidence color
            let confidenceColor = '#2e8b57';
            const confValue = parseFloat(scan.confidence);
            if (confValue < 70) {
                confidenceColor = '#f0b000';
            } else if (confValue < 50) {
                confidenceColor = '#b13e30';
            }
            
            html += `
                <div class="history-card" data-id="${scan.id}">
                    <div class="card-image">
                        <img src="${scan.image}" alt="Plant scan" class="scan-image" onerror="this.src='images/placeholder.jpg'">
                        <span class="scan-badge">${scan.confidence}%</span>
                    </div>
                    <div class="card-content">
                        <h3 class="disease-name">${scan.diseaseName}</h3>
                        <div class="scan-meta">
                            <span><i class="fas fa-calendar"></i> ${scan.formattedDate}</span>
                            <span><i class="fas fa-seedling"></i> ${scan.plantType}</span>
                        </div>
                        <div class="confidence-bar">
                            <div class="confidence-fill" style="width: ${scan.confidence}%; background: ${confidenceColor};"></div>
                        </div>
                        <div class="card-footer">
                            <button class="view-details-btn" onclick="viewScanDetails('${scan.id}')">
                                View Details <i class="fas fa-arrow-right"></i>
                            </button>
                            <button class="delete-scan" onclick="deleteScan('${scan.id}')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        });
        
        historyGrid.innerHTML = html;
    }
    
    // =========================
    // UPDATE STATS
    // =========================
    function updateStats() {
        const stats = scanHistory.getStats();
        
        totalScansEl.textContent = stats.total;
        uniqueDiseasesEl.textContent = stats.uniqueDiseases;
        lastScanEl.textContent = stats.lastScan || '-';
    }
    
    // =========================
    // VIEW SCAN DETAILS
    // =========================
    window.viewScanDetails = function(id) {
        const scan = scanHistory.getScan(id);
        if (!scan) return;
        
        // You can redirect to a details page or show a modal
        // For now, just alert with details
        alert(`
📋 Scan Details
━━━━━━━━━━━━━━━━━━
Disease: ${scan.diseaseName}
Confidence: ${scan.confidence}%
Date: ${scan.formattedDate}
Plant: ${scan.plantType}
Severity: ${scan.severity}
        `);
    };
    
    // =========================
    // DELETE SCAN
    // =========================
    window.deleteScan = function(id) {
        if (confirm('Are you sure you want to delete this scan?')) {
            scanHistory.deleteScan(id);
            loadHistory();
        }
    };
    
    // =========================
    // SEARCH
    // =========================
    searchInput.addEventListener('input', function(e) {
        searchTerm = e.target.value;
        loadHistory();
    });
    
    // =========================
    // FILTER BUTTONS
    // =========================
    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all
            filterButtons.forEach(b => b.classList.remove('active'));
            
            // Add active class to clicked
            this.classList.add('active');
            
            // Set filter
            if (this.dataset.filter) {
                currentFilter = this.dataset.filter;
            }
            
            loadHistory();
        });
    });
    
    // =========================
    // CLEAR HISTORY
    // =========================
    clearHistoryBtn.addEventListener('click', function() {
        if (confirm('Are you sure you want to clear ALL scan history? This cannot be undone.')) {
            scanHistory.clearHistory();
            loadHistory();
        }
    });
    
    // =========================
    // ADD SAMPLE DATA FOR TESTING (remove in production)
    // =========================
    function addSampleData() {
        const sampleScans = [
            {
                diseaseName: 'Early Blight',
                confidence: '94',
                image: 'images/sample1.jpg',
                plantType: 'Tomato',
                severity: 'High',
                date: new Date().toISOString()
            },
            {
                diseaseName: 'Powdery Mildew',
                confidence: '87',
                image: 'images/sample2.jpg',
                plantType: 'Cucumber',
                severity: 'Medium',
                date: new Date(Date.now() - 86400000).toISOString()
            },
            {
                diseaseName: 'Black Spot',
                confidence: '91',
                image: 'images/sample3.jpg',
                plantType: 'Rose',
                severity: 'Medium',
                date: new Date(Date.now() - 172800000).toISOString()
            }
        ];
        
        sampleScans.forEach(scan => {
            scanHistory.saveScan(scan);
        });
        
        loadHistory();
    }
    
    // Uncomment to add sample data for testing
    // if (scanHistory.getHistory().length === 0) {
    //     addSampleData();
    // }
});