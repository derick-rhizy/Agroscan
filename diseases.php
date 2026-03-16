<?php
session_start();
require_once '../config/config.php';
require_once '../config/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diseases Library - AgroScan</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- CSS Files -->
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/disease.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Plant Disease Library</h1>
            <p class="page-subtitle">Browse our comprehensive guide to plant diseases. Click on any card to learn more about symptoms, causes, and treatments.</p>
        </div>

        <!-- Search and Filter Section -->
        <div class="search-filter-section">
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" id="diseaseSearch" placeholder="Search by disease name, plant, or symptoms...">
            </div>
            <div class="filter-container">
                <select id="plantFilter" class="filter-select">
                    <option value="all">All Plants</option>
                    <option value="tomato">Tomato</option>
                    <option value="potato">Potato</option>
                    <option value="pepper">Pepper</option>
                    <option value="cucumber">Cucumber</option>
                    <option value="rose">Rose</option>
                    <option value="grape">Grape</option>
                </select>
                <select id="severityFilter" class="filter-select">
                    <option value="all">All Severities</option>
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>
                <select id="typeFilter" class="filter-select">
                    <option value="all">All Disease Types</option>
                    <option value="fungal">Fungal</option>
                    <option value="bacterial">Bacterial</option>
                    <option value="viral">Viral</option>
                    <option value="oomycete">Oomycete</option>
                </select>
                <button class="reset-filters-btn" id="resetFilters">
                    <i class="fas fa-redo-alt"></i> Reset
                </button>
            </div>
        </div>

        <!-- Active Filters -->
        <div class="active-filters" id="activeFilters"></div>

        <!-- Results Count -->
        <div class="results-stats">
            <span class="results-count" id="resultsCount">20</span>
            <span class="results-label">diseases found</span>
        </div>

        <!-- DISEASE GRID - All 20 Diseases from Koppert.ca -->
        <div class="disease-grid" id="diseaseGrid">
            <!-- Botrytis -->
            <div class="disease-card" data-type="fungal" data-severity="high" data-plant="tomato strawberry grape rose lettuce pepper cucumber">
                <div class="card-image-container">
                    <img src="../images/botrytis.png" alt="Botrytis" class="card-image" loading="lazy" onerror="this.src='https://via.placeholder.com/400x200?text=Botrytis'">
                    <span class="disease-badge fungal">Fungal</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Botrytis (Gray Mold)</h3>
                    <p class="card-plants"><i class="fas fa-seedling"></i> Tomato, Strawberry, Grape, Rose</p>
                    <p class="card-description">Gray mold affecting leaves, stems, and fruits. Thrives in humid conditions. Produces fluffy gray spores.</p>
                    <div class="card-footer">
                        <span class="severity-indicator high">High Severity</span>
                        <a href="disease-details.php?disease=botrytis" class="details-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Powdery Mildew -->
            <div class="disease-card" data-type="fungal" data-severity="medium" data-plant="cucumber squash melon pumpkin rose grape apple strawberry">
                <div class="card-image-container">
                    <img src="../images/Powdery-Mildew.png" alt="Powdery Mildew" class="card-image" loading="lazy" onerror="this.src='https://via.placeholder.com/400x200?text=Powdery+Mildew'">
                    <span class="disease-badge fungal">Fungal</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Powdery Mildew</h3>
                    <p class="card-plants"><i class="fas fa-seedling"></i> Cucumber, Squash, Rose, Grape</p>
                    <p class="card-description">White powdery spots on leaves and stems. Common in warm, dry climates with high humidity.</p>
                    <div class="card-footer">
                        <span class="severity-indicator medium">Medium Severity</span>
                        <a href="disease-details.php?disease=powdery-mildew" class="details-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Downy Mildew -->
            <div class="disease-card" data-type="oomycete" data-severity="high" data-plant="grape cucumber melon squash lettuce onion basil">
                <div class="card-image-container">
                    <img src="../images/downy-mildew.png" alt="Downy Mildew" class="card-image" loading="lazy" onerror="this.src='https://via.placeholder.com/400x200?text=Downy+Mildew'">
                    <span class="disease-badge oomycete">Oomycete</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Downy Mildew</h3>
                    <p class="card-plants"><i class="fas fa-seedling"></i> Grape, Cucumber, Lettuce, Onion</p>
                    <p class="card-description">Yellow spots on leaf surfaces with grayish mold underneath. Prefers cool, wet conditions.</p>
                    <div class="card-footer">
                        <span class="severity-indicator high">High Severity</span>
                        <a href="disease-details.php?disease=downy-mildew" class="details-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Fusarium -->
            <div class="disease-card" data-type="fungal" data-severity="high" data-plant="tomato banana cucumber wheat corn bean">
                <div class="card-image-container">
                    <img src="../images/fusarium.png" alt="Fusarium" class="card-image" loading="lazy" onerror="this.src='https://via.placeholder.com/400x200?text=Fusarium'">
                    <span class="disease-badge fungal">Fungal</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Fusarium</h3>
                    <p class="card-plants"><i class="fas fa-seedling"></i> Tomato, Banana, Corn, Wheat</p>
                    <p class="card-description">Soil-borne fungus causing wilt, root rot, and yellowing of leaves. Vascular discoloration.</p>
                    <div class="card-footer">
                        <span class="severity-indicator high">High Severity</span>
                        <a href="disease-details.php?disease=fusarium" class="details-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Rust -->
            <div class="disease-card" data-type="fungal" data-severity="medium" data-plant="wheat barley bean rose corn snapdragon">
                <div class="card-image-container">
                    <img src="../images/rust.png" alt="Rust" class="card-image" loading="lazy" onerror="this.src='https://via.placeholder.com/400x200?text=Rust'">
                    <span class="disease-badge fungal">Fungal</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Rust</h3>
                    <p class="card-plants"><i class="fas fa-seedling"></i> Wheat, Bean, Rose, Snapdragon</p>
                    <p class="card-description">Orange, yellow, or brown pustules on undersides of leaves. Can cause defoliation.</p>
                    <div class="card-footer">
                        <span class="severity-indicator medium">Medium Severity</span>
                        <a href="disease-details.php?disease=rust" class="details-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Alternaria (Early Blight) -->
            <div class="disease-card" data-type="fungal" data-severity="high" data-plant="tomato potato pepper brassica carrot apple">
                <div class="card-image-container">
                    <img src="../images/alternaria.png" alt="Alternaria" class="card-image" loading="lazy" onerror="this.src='https://via.placeholder.com/400x200?text=Alternaria'">
                    <span class="disease-badge fungal">Fungal</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Alternaria (Early Blight)</h3>
                    <p class="card-plants"><i class="fas fa-seedling"></i> Tomato, Potato, Pepper, Carrot</p>
                    <p class="card-description">Dark, target-like spots with concentric rings on leaves. Common on tomatoes and potatoes.</p>
                    <div class="card-footer">
                        <span class="severity-indicator high">High Severity</span>
                        <a href="disease-details.php?disease=alternaria" class="details-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Sclerotinia (White Mold) -->
            <div class="disease-card" data-type="fungal" data-severity="high" data-plant="lettuce bean carrot tomato cucumber sunflower">
                <div class="card-image-container">
                    <img src="../images/sclerotinia.png" alt="Sclerotinia" class="card-image" loading="lazy" onerror="this.src='https://via.placeholder.com/400x200?text=Sclerotinia'">
                    <span class="disease-badge fungal">Fungal</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Sclerotinia (White Mold)</h3>
                    <p class="card-plants"><i class="fas fa-seedling"></i> Lettuce, Bean, Tomato, Sunflower</p>
                    <p class="card-description">White mold causing stem rot, wilt, and plant death. Produces black resting structures.</p>
                    <div class="card-footer">
                        <span class="severity-indicator high">High Severity</span>
                        <a href="disease-details.php?disease=sclerotinia" class="details-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Verticillium -->
            <div class="disease-card" data-type="fungal" data-severity="high" data-plant="tomato potato pepper eggplant strawberry maple">
                <div class="card-image-container">
                    <img src="../images/verticillium.png" alt="Verticillium" class="card-image" loading="lazy" onerror="this.src='https://via.placeholder.com/400x200?text=Verticillium'">
                    <span class="disease-badge fungal">Fungal</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Verticillium Wilt</h3>
                    <p class="card-plants"><i class="fas fa-seedling"></i> Tomato, Potato, Strawberry, Maple</p>
                    <p class="card-description">Vascular wilt disease causing leaf yellowing, wilting, and stunting. V-shaped lesions.</p>
                    <div class="card-footer">
                        <span class="severity-indicator high">High Severity</span>
                        <a href="disease-details.php?disease=verticillium" class="details-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Erwinia (Bacterial Soft Rot) -->
            <div class="disease-card" data-type="bacterial" data-severity="high" data-plant="potato carrot onion tomato pepper cabbage">
                <div class="card-image-container">
                    <img src="../images/Erwinia.png" alt="Erwinia" class="card-image" loading="lazy" onerror="this.src='https://via.placeholder.com/400x200?text=Erwinia'">
                    <span class="disease-badge bacterial">Bacterial</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Erwinia (Soft Rot)</h3>
                    <p class="card-plants"><i class="fas fa-seedling"></i> Potato, Carrot, Onion, Tomato</p>
                    <p class="card-description">Bacterial soft rot causing water-soaked lesions and foul-smelling decay. Common in storage.</p>
                    <div class="card-footer">
                        <span class="severity-indicator high">High Severity</span>
                        <a href="disease-details.php?disease=erwinia" class="details-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Rhizoctonia -->
            <div class="disease-card" data-type="fungal" data-severity="high" data-plant="potato tomato bean lettuce carrot corn">
                <div class="card-image-container">
                    <img src="../images/rhizoctonia.png" alt="Rhizoctonia" class="card-image" loading="lazy" onerror="this.src='https://via.placeholder.com/400x200?text=Rhizoctonia'">
                    <span class="disease-badge fungal">Fungal</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Rhizoctonia</h3>
                    <p class="card-plants"><i class="fas fa-seedling"></i> Potato, Tomato, Bean, Lettuce</p>
                    <p class="card-description">Soil-borne fungus causing damping-off, root rot, and stem cankers. Black scurf on potatoes.</p>
                    <div class="card-footer">
                        <span class="severity-indicator high">High Severity</span>
                        <a href="disease-details.php?disease=rhizoctonia" class="details-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- TSWV (Tomato Spotted Wilt Virus) -->
            <div class="disease-card" data-type="viral" data-severity="high" data-plant="tomato pepper lettuce peanut tobacco">
                <div class="card-image-container">
                    <img src="../images/TSWV.png" alt="TSWV" class="card-image" loading="lazy" onerror="this.src='https://via.placeholder.com/400x200?text=TSWV'">
                    <span class="disease-badge viral">Viral</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">TSWV</h3>
                    <p class="card-plants"><i class="fas fa-seedling"></i> Tomato, Pepper, Lettuce, Peanut</p>
                    <p class="card-description">Tomato Spotted Wilt Virus causes ring spots, stunting, and leaf distortion. Spread by thrips.</p>
                    <div class="card-footer">
                        <span class="severity-indicator high">High Severity</span>
                        <a href="disease-details.php?disease=tswv" class="details-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Phytophthora -->
            <div class="disease-card" data-type="oomycete" data-severity="high" data-plant="tomato potato pepper avocado citrus">
                <div class="card-image-container">
                    <img src="../images/Phytophthora.png" alt="Phytophthora" class="card-image" loading="lazy" onerror="this.src='https://via.placeholder.com/400x200?text=Phytophthora'">
                    <span class="disease-badge oomycete">Oomycete</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Phytophthora</h3>
                    <p class="card-plants"><i class="fas fa-seedling"></i> Tomato, Potato, Pepper, Avocado</p>
                    <p class="card-description">Water mold causing root rot, stem lesions, and fruit rot. Late blight of potato.</p>
                    <div class="card-footer">
                        <span class="severity-indicator high">High Severity</span>
                        <a href="disease-details.php?disease=phytophthora" class="details-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Cladosporium (Leaf Mold) -->
            <div class="disease-card hidden-card" data-type="fungal" data-severity="medium" data-plant="tomato cucumber greenhouse">
                <div class="card-image-container">
                    <img src="../images/cladosporium.png" alt="Cladosporium" class="card-image" loading="lazy" onerror="this.src='https://via.placeholder.com/400x200?text=Cladosporium'">
                    <span class="disease-badge fungal">Fungal</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Cladosporium (Leaf Mold)</h3>
                    <p class="card-plants"><i class="fas fa-seedling"></i> Tomato (greenhouse), Cucumber</p>
                    <p class="card-description">Olive-green mold on leaves, causing leaf spots and defoliation. Common in greenhouses.</p>
                    <div class="card-footer">
                        <span class="severity-indicator medium">Medium Severity</span>
                        <a href="disease-details.php?disease=cladosporium" class="details-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Pseudomonas (Bacterial Leaf Spot) -->
            <div class="disease-card hidden-card" data-type="bacterial" data-severity="medium" data-plant="tomato pepper bean cucumber lilac">
                <div class="card-image-container">
                    <img src="../images/Pseudomonas.png" alt="Pseudomonas" class="card-image" loading="lazy" onerror="this.src='https://via.placeholder.com/400x200?text=Pseudomonas'">
                    <span class="disease-badge bacterial">Bacterial</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Pseudomonas</h3>
                    <p class="card-plants"><i class="fas fa-seedling"></i> Tomato, Pepper, Bean, Lilac</p>
                    <p class="card-description">Bacterial leaf spots, blights, and wilts. Water-soaked spots with yellow halos.</p>
                    <div class="card-footer">
                        <span class="severity-indicator medium">Medium Severity</span>
                        <a href="disease-details.php?disease=pseudomonas" class="details-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Cylindrocarpon (Root Rot) -->
            <div class="disease-card hidden-card" data-type="fungal" data-severity="high" data-plant="grape apple strawberry ginseng">
                <div class="card-image-container">
                    <img src="../images/Cylindrocarpon.png" alt="Cylindrocarpon" class="card-image" loading="lazy" onerror="this.src='https://via.placeholder.com/400x200?text=Cylindrocarpon'">
                    <span class="disease-badge fungal">Fungal</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Cylindrocarpon</h3>
                    <p class="card-plants"><i class="fas fa-seedling"></i> Grape, Apple, Strawberry</p>
                    <p class="card-description">Root rot pathogen causing black roots and plant decline. Common in grape nurseries.</p>
                    <div class="card-footer">
                        <span class="severity-indicator high">High Severity</span>
                        <a href="disease-details.php?disease=cylindrocarpon" class="details-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Pythium (Damping-off) -->
            <div class="disease-card hidden-card" data-type="oomycete" data-severity="high" data-plant="seedlings turf all crops">
                <div class="card-image-container">
                    <img src="../images/pythium.png" alt="Pythium" class="card-image" loading="lazy" onerror="this.src='https://via.placeholder.com/400x200?text=Pythium'">
                    <span class="disease-badge oomycete">Oomycete</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Pythium</h3>
                    <p class="card-plants"><i class="fas fa-seedling"></i> Seedlings, Turf, Many crops</p>
                    <p class="card-description">Water mold causing damping-off, root rot, and poor growth in seedlings and mature plants.</p>
                    <div class="card-footer">
                        <span class="severity-indicator high">High Severity</span>
                        <a href="disease-details.php?disease=pythium" class="details-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Cylindrocladium -->
            <div class="disease-card hidden-card" data-type="fungal" data-severity="high" data-plant="rhododendron azalea eucalyptus peanut">
                <div class="card-image-container">
                    <img src="../images/Cylindrocladium.png" alt="Cylindrocladium" class="card-image" loading="lazy" onerror="this.src='https://via.placeholder.com/400x200?text=Cylindrocladium'">
                    <span class="disease-badge fungal">Fungal</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Cylindrocladium</h3>
                    <p class="card-plants"><i class="fas fa-seedling"></i> Rhododendron, Azalea, Eucalyptus</p>
                    <p class="card-description">Leaf spot and root rot pathogen on various ornamental plants. Common in nurseries.</p>
                    <div class="card-footer">
                        <span class="severity-indicator high">High Severity</span>
                        <a href="disease-details.php?disease=cylindrocladium" class="details-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Mycocentrospora -->
            <div class="disease-card hidden-card" data-type="fungal" data-severity="medium" data-plant="carrot celery parsnip viola">
                <div class="card-image-container">
                    <img src="../images/Mycocentrospora.png" alt="Mycocentrospora" class="card-image" loading="lazy" onerror="this.src='https://via.placeholder.com/400x200?text=Mycocentrospora'">
                    <span class="disease-badge fungal">Fungal</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Mycocentrospora</h3>
                    <p class="card-plants"><i class="fas fa-seedling"></i> Carrot, Celery, Parsnip</p>
                    <p class="card-description">Causing leaf blight and root rot in cool, wet conditions. Black rot of carrots.</p>
                    <div class="card-footer">
                        <span class="severity-indicator medium">Medium Severity</span>
                        <a href="disease-details.php?disease=mycocentrospora" class="details-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Itospora -->
            <div class="disease-card hidden-card" data-type="fungal" data-severity="medium" data-plant="ornamentals">
                <div class="card-image-container">
                    <img src="../images/tinospora.png" alt="Itospora" class="card-image" loading="lazy" onerror="this.src='https://via.placeholder.com/400x200?text=Itospora'">
                    <span class="disease-badge fungal">Fungal</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Itospora</h3>
                    <p class="card-plants"><i class="fas fa-seedling"></i> Ornamental plants</p>
                    <p class="card-description">Fungal pathogen causing leaf spots and blights on various ornamental plants.</p>
                    <div class="card-footer">
                        <span class="severity-indicator medium">Medium Severity</span>
                        <a href="disease-details.php?disease=itospora" class="details-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Xanthomonas -->
            <div class="disease-card hidden-card" data-type="bacterial" data-severity="high" data-plant="tomato pepper cabbage citrus bean rice">
                <div class="card-image-container">
                    <img src="../images/Xanthomonas.png" alt="Xanthomonas" class="card-image" loading="lazy" onerror="this.src='https://via.placeholder.com/400x200?text=Xanthomonas'">
                    <span class="disease-badge bacterial">Bacterial</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Xanthomonas</h3>
                    <p class="card-plants"><i class="fas fa-seedling"></i> Tomato, Pepper, Cabbage, Citrus</p>
                    <p class="card-description">Bacterial leaf spots, blights, and vascular wilts. Citrus canker, black rot of cabbage.</p>
                    <div class="card-footer">
                        <span class="severity-indicator high">High Severity</span>
                        <a href="disease-details.php?disease=xanthomonas" class="details-link">View Details <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Load More Button -->
        <div class="load-more-container">
            <button class="load-more-btn" id="loadMoreBtn">
                <i class="fas fa-sync-alt"></i> Load More Diseases
            </button>
        </div>

        <!-- Need Help Section -->
        <section class="help-section">
            <div class="help-content">
                <h2 class="help-title">Can't find what you're looking for?</h2>
                <p class="help-text">Try our AI-powered scanner for instant diagnosis</p>
                <div class="help-buttons">
                    <a href="scan.php" class="help-scan-btn">
                        <i class="fas fa-cloud-upload-alt"></i> Scan Your Plant
                    </a>
                </div>
            </div>
        </section>
    </main>

    <?php include '../includes/footer.php'; ?>

    <!-- JavaScript Files -->
    <script src="../js/disease-data.js"></script>
    <script src="../js/diseases.js"></script>
</body>
</html>