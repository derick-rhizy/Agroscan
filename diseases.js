// =========================
// DISEASES PAGE - FIXED SEARCH FOR POWDERY MILDEW
// =========================

document.addEventListener('DOMContentLoaded', function() {
    console.log("✅ Diseases page loaded");
    
    // =========================
    // DOM ELEMENTS
    // =========================
    const searchInput = document.getElementById('diseaseSearch');
    const plantFilter = document.getElementById('plantFilter');
    const severityFilter = document.getElementById('severityFilter');
    const typeFilter = document.getElementById('typeFilter');
    const resetBtn = document.getElementById('resetFilters');
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    const diseaseGrid = document.getElementById('diseaseGrid');
    const resultsCount = document.getElementById('resultsCount');
    const activeFiltersContainer = document.getElementById('activeFilters');
    
    // =========================
    // STATE VARIABLES
    // =========================
    let currentFilters = {
        search: '',
        plant: 'all',
        severity: 'all',
        type: 'all'
    };
    
    let visibleCount = 12;
    let allDiseaseCards = [];
    let filteredCards = [];
    
    // =========================
    // INITIALIZATION
    // =========================
    function init() {
        // Get all disease cards
        allDiseaseCards = Array.from(document.querySelectorAll('.disease-card'));
        
        // Initially, all cards are visible
        filteredCards = [...allDiseaseCards];
        
        // Log all disease names for debugging
        console.log("=== ALL DISEASES IN DATABASE ===");
        allDiseaseCards.forEach((card, index) => {
            const title = card.querySelector('.disease-card-title')?.textContent || 'Unknown';
            console.log(`${index + 1}. ${title}`);
        });
        
        // Hide cards beyond visible count
        updateVisibility();
        
        // Update results count
        updateResultsCount();
        
        // Setup event listeners
        setupEventListeners();
        
        console.log(`✅ Found ${allDiseaseCards.length} disease cards`);
    }
    
    // =========================
    // SETUP EVENT LISTENERS
    // =========================
    function setupEventListeners() {
        // Search input
        if (searchInput) {
            let searchTimeout;
            searchInput.addEventListener('input', function(e) {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    currentFilters.search = e.target.value.toLowerCase().trim();
                    console.log("🔍 Searching for:", currentFilters.search);
                    visibleCount = 12;
                    applyFilters();
                }, 300);
            });
        }
        
        // Plant filter
        if (plantFilter) {
            plantFilter.addEventListener('change', function(e) {
                currentFilters.plant = e.target.value;
                visibleCount = 12;
                applyFilters();
            });
        }
        
        // Severity filter
        if (severityFilter) {
            severityFilter.addEventListener('change', function(e) {
                currentFilters.severity = e.target.value;
                visibleCount = 12;
                applyFilters();
            });
        }
        
        // Type filter
        if (typeFilter) {
            typeFilter.addEventListener('change', function(e) {
                currentFilters.type = e.target.value;
                visibleCount = 12;
                applyFilters();
            });
        }
        
        // Reset button
        if (resetBtn) {
            resetBtn.addEventListener('click', resetFilters);
        }
        
        // Load more button
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', loadMore);
        }
    }
    
    // =========================
    // APPLY FILTERS - FIXED SEARCH
    // =========================
    function applyFilters() {
        console.log("Applying filters. Search term:", `"${currentFilters.search}"`);
        
        filteredCards = allDiseaseCards.filter(card => {
            // Get ALL text content from the card for searching
            const cardText = card.textContent.toLowerCase();
            
            // Get specific elements for more accurate searching
            const titleElem = card.querySelector('.disease-card-title');
            const title = titleElem ? titleElem.textContent.toLowerCase() : '';
            
            const descElem = card.querySelector('.disease-description');
            const desc = descElem ? descElem.textContent.toLowerCase() : '';
            
            const plantElem = card.querySelector('.disease-plant');
            const plants = plantElem ? plantElem.textContent.toLowerCase() : '';
            
            // Debug for Powdery Mildew
            if (title.includes('powdery')) {
                console.log(`Found: "${title}"`);
            }
            
            // SEARCH FILTER - Check if search term exists ANYWHERE in the card
            let matchesSearch = true;
            if (currentFilters.search && currentFilters.search !== '') {
                // Check in title, description, plants, and full text
                matchesSearch = 
                    title.includes(currentFilters.search) ||
                    desc.includes(currentFilters.search) ||
                    plants.includes(currentFilters.search) ||
                    cardText.includes(currentFilters.search);
            }
            
            // PLANT FILTER
            let matchesPlant = true;
            if (currentFilters.plant && currentFilters.plant !== 'all') {
                const plantSearch = currentFilters.plant.toLowerCase();
                matchesPlant = plants.includes(plantSearch);
            }
            
            // SEVERITY FILTER
            let matchesSeverity = true;
            if (currentFilters.severity && currentFilters.severity !== 'all') {
                const severityElem = card.querySelector('.disease-severity');
                if (severityElem) {
                    const severityClass = severityElem.className;
                    if (currentFilters.severity === 'high') {
                        matchesSeverity = severityClass.includes('high');
                    } else if (currentFilters.severity === 'medium') {
                        matchesSeverity = severityClass.includes('medium');
                    } else if (currentFilters.severity === 'low') {
                        matchesSeverity = severityClass.includes('low');
                    }
                } else {
                    matchesSeverity = false;
                }
            }
            
            // TYPE FILTER
            let matchesType = true;
            if (currentFilters.type && currentFilters.type !== 'all') {
                const typeBadge = card.querySelector('.disease-type-badge');
                if (typeBadge) {
                    const typeClass = typeBadge.className;
                    matchesType = typeClass.includes(currentFilters.type);
                } else {
                    matchesType = false;
                }
            }
            
            return matchesSearch && matchesPlant && matchesSeverity && matchesType;
        });
        
        console.log(`📊 Found ${filteredCards.length} matching cards`);
        
        // Update display
        updateVisibility();
        updateResultsCount();
        updateActiveFilters();
        updateLoadMoreButton();
    }
    
    // =========================
    // UPDATE CARD VISIBILITY
    // =========================
    function updateVisibility() {
        // Hide all cards first
        allDiseaseCards.forEach(card => {
            card.style.display = 'none';
        });
        
        // Show filtered cards up to visible count
        if (filteredCards.length > 0) {
            filteredCards.slice(0, visibleCount).forEach(card => {
                card.style.display = 'block';
            });
        }
        
        // Show/hide no results message
        if (filteredCards.length === 0) {
            showNoResults();
        } else {
            removeNoResults();
        }
    }
    
    // =========================
    // SHOW NO RESULTS MESSAGE
    // =========================
    function showNoResults() {
        let noResultsMsg = document.querySelector('.no-results-message');
        
        if (!noResultsMsg && diseaseGrid) {
            noResultsMsg = document.createElement('div');
            noResultsMsg.className = 'no-results-message';
            noResultsMsg.innerHTML = `
                <i class="fas fa-search"></i>
                <h3>No diseases found</h3>
                <p>Try adjusting your search or filters</p>
                <button class="reset-filters-btn" onclick="window.resetFilters()">
                    <i class="fas fa-redo-alt"></i> Reset Filters
                </button>
            `;
            diseaseGrid.appendChild(noResultsMsg);
        }
    }
    
    function removeNoResults() {
        const noResultsMsg = document.querySelector('.no-results-message');
        if (noResultsMsg) {
            noResultsMsg.remove();
        }
    }
    
    // =========================
    // UPDATE RESULTS COUNT
    // =========================
    function updateResultsCount() {
        if (resultsCount) {
            resultsCount.textContent = filteredCards.length;
        }
    }
    
    // =========================
    // UPDATE ACTIVE FILTERS DISPLAY
    // =========================
    function updateActiveFilters() {
        if (!activeFiltersContainer) return;
        
        activeFiltersContainer.innerHTML = '';
        
        if (currentFilters.search && currentFilters.search !== '') {
            addFilterBadge(`Search: "${currentFilters.search}"`, 'search');
        }
        
        if (currentFilters.plant && currentFilters.plant !== 'all') {
            const plantText = plantFilter?.options[plantFilter.selectedIndex]?.text || currentFilters.plant;
            addFilterBadge(`Plant: ${plantText}`, 'plant');
        }
        
        if (currentFilters.severity && currentFilters.severity !== 'all') {
            const severityText = severityFilter?.options[severityFilter.selectedIndex]?.text || currentFilters.severity;
            addFilterBadge(`Severity: ${severityText}`, 'severity');
        }
        
        if (currentFilters.type && currentFilters.type !== 'all') {
            const typeText = typeFilter?.options[typeFilter.selectedIndex]?.text || currentFilters.type;
            addFilterBadge(`Type: ${typeText}`, 'type');
        }
    }
    
    // =========================
    // ADD FILTER BADGE
    // =========================
    function addFilterBadge(text, filterType) {
        const badge = document.createElement('span');
        badge.className = 'filter-badge';
        badge.innerHTML = `
            ${text}
            <button class="remove-filter" data-filter="${filterType}">
                <i class="fas fa-times"></i>
            </button>
        `;
        
        badge.style.cssText = `
            background: #f0f9f0;
            border: 1px solid #1f5e3a;
            border-radius: 40px;
            padding: 6px 12px 6px 16px;
            font-size: 0.9rem;
            color: #1e4f32;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-right: 10px;
            margin-bottom: 10px;
        `;
        
        const removeBtn = badge.querySelector('.remove-filter');
        removeBtn.style.cssText = `
            background: none;
            border: none;
            color: #7a9a83;
            cursor: pointer;
            padding: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s ease;
        `;
        
        removeBtn.addEventListener('mouseenter', () => {
            removeBtn.style.color = '#b13e30';
        });
        
        removeBtn.addEventListener('mouseleave', () => {
            removeBtn.style.color = '#7a9a83';
        });
        
        removeBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            removeFilter(filterType);
        });
        
        activeFiltersContainer.appendChild(badge);
    }
    
    // =========================
    // REMOVE INDIVIDUAL FILTER
    // =========================
    function removeFilter(filterType) {
        switch(filterType) {
            case 'search':
                if (searchInput) {
                    searchInput.value = '';
                    currentFilters.search = '';
                }
                break;
            case 'plant':
                if (plantFilter) {
                    plantFilter.value = 'all';
                    currentFilters.plant = 'all';
                }
                break;
            case 'severity':
                if (severityFilter) {
                    severityFilter.value = 'all';
                    currentFilters.severity = 'all';
                }
                break;
            case 'type':
                if (typeFilter) {
                    typeFilter.value = 'all';
                    currentFilters.type = 'all';
                }
                break;
        }
        
        visibleCount = 12;
        applyFilters();
    }
    
    // =========================
    // RESET ALL FILTERS
    // =========================
    window.resetFilters = function() {
        console.log("Resetting all filters");
        
        if (searchInput) searchInput.value = '';
        if (plantFilter) plantFilter.value = 'all';
        if (severityFilter) severityFilter.value = 'all';
        if (typeFilter) typeFilter.value = 'all';
        
        currentFilters = {
            search: '',
            plant: 'all',
            severity: 'all',
            type: 'all'
        };
        
        filteredCards = [...allDiseaseCards];
        visibleCount = 12;
        applyFilters();
    };
    
    // =========================
    // LOAD MORE DISEASES
    // =========================
    function loadMore() {
        visibleCount += 8;
        
        if (filteredCards.length > 0) {
            filteredCards.slice(0, visibleCount).forEach(card => {
                card.style.display = 'block';
            });
        }
        
        updateLoadMoreButton();
    }
    
    // =========================
    // UPDATE LOAD MORE BUTTON
    // =========================
    function updateLoadMoreButton() {
        if (!loadMoreBtn) return;
        
        if (visibleCount >= filteredCards.length) {
            loadMoreBtn.style.display = 'none';
        } else {
            loadMoreBtn.style.display = 'inline-flex';
            const remaining = filteredCards.length - visibleCount;
            loadMoreBtn.innerHTML = `<i class="fas fa-sync-alt"></i> Load ${remaining} More Diseases`;
        }
    }
    
    // =========================
    // DEBUG FUNCTION - List all disease titles
    // =========================
    function listAllDiseases() {
        console.log("=== DISEASE TITLES FOR SEARCHING ===");
        allDiseaseCards.forEach(card => {
            const title = card.querySelector('.disease-card-title')?.textContent || 'Unknown';
            console.log(`- "${title}"`);
        });
    }
    
    // =========================
    // INITIALIZE
    // =========================
    init();
    listAllDiseases(); // This will show all disease names in console
    
    // Make resetFilters globally available
    window.resetFilters = resetFilters;
});