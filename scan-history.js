// =========================
// SCAN HISTORY SAVER - Call this from scan.js when scan completes
// =========================

class ScanHistory {
    constructor() {
        this.STORAGE_KEY = 'agroscan_history';
    }
    
    // Save a new scan result
    saveScan(scanData) {
        // Get existing history
        let history = this.getHistory();
        
        // Add new scan with ID and timestamp
        const newScan = {
            id: this.generateId(),
            image: scanData.image || 'images/placeholder.jpg',
            diseaseName: scanData.diseaseName || 'Unknown',
            confidence: scanData.confidence || '0',
            date: new Date().toISOString(),
            formattedDate: this.formatDate(new Date()),
            plantType: scanData.plantType || 'Unknown',
            severity: scanData.severity || 'Medium'
        };
        
        // Add to beginning of array
        history.unshift(newScan);
        
        // Keep only last 50 scans (to prevent storage overflow)
        if (history.length > 50) {
            history = history.slice(0, 50);
        }
        
        // Save back to localStorage
        localStorage.setItem(this.STORAGE_KEY, JSON.stringify(history));
        
        // Update stats in history page if open
        this.updateStats();
        
        return newScan;
    }
    
    // Get all history
    getHistory() {
        const history = localStorage.getItem(this.STORAGE_KEY);
        return history ? JSON.parse(history) : [];
    }
    
    // Get single scan by ID
    getScan(id) {
        const history = this.getHistory();
        return history.find(scan => scan.id === id);
    }
    
    // Delete a scan
    deleteScan(id) {
        let history = this.getHistory();
        history = history.filter(scan => scan.id !== id);
        localStorage.setItem(this.STORAGE_KEY, JSON.stringify(history));
        this.updateStats();
        return history;
    }
    
    // Clear all history
    clearHistory() {
        localStorage.removeItem(this.STORAGE_KEY);
        this.updateStats();
    }
    
    // Get stats
    getStats() {
        const history = this.getHistory();
        
        if (history.length === 0) {
            return {
                total: 0,
                uniqueDiseases: 0,
                lastScan: null
            };
        }
        
        // Count unique diseases
        const uniqueDiseases = new Set(history.map(scan => scan.diseaseName)).size;
        
        // Get last scan date
        const lastScan = new Date(history[0].date);
        const now = new Date();
        const diffDays = Math.floor((now - lastScan) / (1000 * 60 * 60 * 24));
        
        let lastScanText;
        if (diffDays === 0) {
            lastScanText = 'Today';
        } else if (diffDays === 1) {
            lastScanText = 'Yesterday';
        } else {
            lastScanText = `${diffDays} days ago`;
        }
        
        return {
            total: history.length,
            uniqueDiseases: uniqueDiseases,
            lastScan: lastScanText
        };
    }
    
    // Generate unique ID
    generateId() {
        return 'scan_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
    }
    
    // Format date
    formatDate(date) {
        const options = { 
            year: 'numeric', 
            month: 'short', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        };
        return date.toLocaleDateString('en-US', options);
    }
    
    // Update stats in history page if it exists
    updateStats() {
        // This will be called from history.js
        if (window.updateHistoryStats) {
            window.updateHistoryStats();
        }
    }
}

// Create global instance
const scanHistory = new ScanHistory();

// =========================
// EXAMPLE: How to use in scan.js after getting results
// =========================
/*
// After getting disease name and confidence from your AI model:
function saveScanResult() {
    const scanData = {
        diseaseName: diseaseName, // from your model
        confidence: confidence, // from your model
        image: previewImage.src, // the scanned image
        plantType: plantType?.value || 'Unknown',
        severity: severityText // from your results
    };
    
    scanHistory.saveScan(scanData);
}
*/