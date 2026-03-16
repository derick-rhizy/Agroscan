// =========================
// COMPLETE DISEASE DATABASE - All 20 diseases from Koppert
// =========================

window.diseaseDatabase = {
    // 1. BOTRYTIS (Gray Mold)
    "botrytis": {
        name: "Botrytis (Gray Mold)",
        scientific: "Botrytis cinerea",
        type: "fungal",
        severity: "high",
        affectedPlants: "Tomato, Strawberry, Grape, Rose, Lettuce, Pepper, Cucumber",
        optimalConditions: "Cool (60-75°F), high humidity (>90%)",
        humidityNeeds: ">90% relative humidity",
        commonRegions: "Worldwide, especially in greenhouses and temperate regions",
        description: "Botrytis, also known as gray mold, is a common fungal disease affecting a wide range of plants. It thrives in cool, humid conditions and is a particular problem in greenhouses and during prolonged wet periods. The fungus can infect leaves, stems, flowers, and fruits, often entering through wounds or senescent tissue. It produces masses of gray spores that give the disease its characteristic fuzzy appearance.",
        symptoms: [
            "Fluffy, gray-brown mold on affected plant parts",
            "Soft, watery rot on fruits, flowers, and stems",
            "Leaf spots that enlarge and become covered with spores",
            "Damping-off in seedlings",
            "Survival as sclerotia (hard, black resting structures) in plant debris",
            "Blossom blight - flowers turn brown and rot"
        ],
        images: {
            main: "https://www.koppert.ca/Content/Images/icon-botrytis.jpg",
            thumbnails: [
                "https://www.koppert.ca/Content/Images/icon-botrytis.jpg",
                "https://www.koppert.ca/Content/Images/icon-botrytis.jpg",
                "https://www.koppert.ca/Content/Images/icon-botrytis.jpg",
                "https://www.koppert.ca/Content/Images/icon-botrytis.jpg"
            ]
        },
        prevention: {
            cultural: [
                "Ensure good air circulation by proper plant spacing",
                "Water at the base of plants to keep foliage dry",
                "Remove and destroy infected plant debris immediately",
                "Use well-draining soil and avoid over-fertilization",
                "Practice crop rotation with non-host plants",
                "Reduce humidity in greenhouses through ventilation",
                "Avoid working with plants when they are wet"
            ],
            biological: [
                "Introduce beneficial microorganisms like Trichoderma harzianum",
                "Apply products containing Bacillus subtilis (e.g., Serenade)",
                "Use Gliocladium species to compete with the pathogen",
                "Apply compost teas to enhance natural plant defenses",
                "Use beneficial fungi like Ulocladium oudemansii"
            ],
            chemical: [
                "Apply fungicides preventively during high-risk periods",
                "Rotate fungicides with different modes of action to prevent resistance",
                "Use products containing fenhexamid (e.g., Elevate)",
                "Apply cyprodinil + fludioxonil (e.g., Switch)",
                "Consider polyoxin D (e.g., Endorse) for ornamentals",
                "Always follow label instructions for application rates and safety"
            ],
            monitoring: [
                "Regularly scout plants for early signs of disease",
                "Use sticky traps to monitor for insect vectors",
                "Maintain environmental control in greenhouses (humidity, temperature)",
                "Remove and test suspicious plant tissue",
                "Monitor weather forecasts for prolonged wet periods",
                "Check wounds and senescent tissue - common entry points"
            ]
        },
        similarDiseases: [
            { name: "Sclerotinia", url: "sclerotinia", description: "White mold, also produces sclerotia." },
            { name: "Rhizoctonia", url: "rhizoctonia", description: "Soil-borne, causes root and stem rot." },
            { name: "Phytophthora", url: "phytophthora", description: "Water mold causing root and fruit rot." }
        ]
    },
    
    // 2. POWDERY MILDEW
    "powdery-mildew": {
        name: "Powdery Mildew",
        scientific: "Erysiphales (multiple species)",
        type: "fungal",
        severity: "medium",
        affectedPlants: "Cucumber, Squash, Melon, Pumpkin, Roses, Grapes, Apples, Strawberries",
        optimalConditions: "Warm (68-80°F), moderate humidity (40-70%)",
        humidityNeeds: "High humidity, but dry leaf surfaces",
        commonRegions: "Worldwide, common in greenhouses and temperate regions",
        description: "Powdery mildew is a fungal disease that appears as white powdery spots on leaves and stems. It is one of the most common and easily recognizable plant diseases. Unlike many fungi, it does not require free water on leaf surfaces to germinate, thriving instead in warm, dry conditions with high humidity. The fungus grows on the surface of plant tissues, extracting nutrients through specialized structures called haustoria.",
        symptoms: [
            "White to gray powdery spots on leaves, stems, and flowers",
            "Spots enlarge and coalesce, covering entire leaf surfaces",
            "Leaves may yellow and become distorted",
            "Premature leaf drop",
            "Stunted growth",
            "Reduced fruit quality and yield",
            "In severe cases, buds and flowers may fail to open"
        ],
        images: {
            main: "https://www.koppert.ca/Content/Images/icon-powdery-mildew.jpg",
            thumbnails: [
                "https://www.koppert.ca/Content/Images/icon-powdery-mildew.jpg",
                "https://www.koppert.ca/Content/Images/icon-powdery-mildew.jpg",
                "https://www.koppert.ca/Content/Images/icon-powdery-mildew.jpg",
                "https://www.koppert.ca/Content/Images/icon-powdery-mildew.jpg"
            ]
        },
        prevention: {
            cultural: [
                "Plant resistant varieties when available",
                "Ensure good air circulation through proper spacing and pruning",
                "Avoid overhead watering - keep leaves dry",
                "Prune to open up plant canopy and reduce humidity",
                "Remove and destroy infected plant parts",
                "Avoid excessive nitrogen fertilization (promotes succulent growth)",
                "Apply sulfur dust or sprays preventively"
            ],
            biological: [
                "Apply products containing Bacillus subtilis (e.g., Serenade)",
                "Use sulfur-based biological fungicides",
                "Apply compost tea as a preventive measure",
                "Introduce beneficial fungi like Ampelomyces quisqualis (AQ10)",
                "Use potassium bicarbonate products (e.g., MilStop)"
            ],
            chemical: [
                "Apply fungicides containing sulfur or potassium bicarbonate",
                "Use myclobutanil (e.g., Eagle) for severe infections",
                "Apply trifloxystrobin (e.g., Flint) or azoxystrobin",
                "Use propiconazole or tebuconazole",
                "Rotate between different fungicide classes (FRAC groups)",
                "Apply at first sign of disease, before severe infection"
            ],
            monitoring: [
                "Inspect plants weekly, especially during favorable conditions",
                "Check undersides of leaves for early signs",
                "Monitor weather conditions for disease risk",
                "Keep records of outbreaks to predict future occurrences",
                "Look for stressed plants - they are more susceptible",
                "Use disease forecasting models in commercial settings"
            ]
        },
        similarDiseases: [
            { name: "Downy Mildew", url: "downy-mildew", description: "Yellow spots with grayish mold underneath." },
            { name: "Leaf Spot", url: "leaf-spot", description: "Dark spots with yellow halos." },
            { name: "Rust", url: "rust", description: "Orange or brown pustules on leaves." }
        ]
    },
    
    // 3. DOWNY MILDEW
    "downy-mildew": {
        name: "Downy Mildew",
        scientific: "Peronosporaceae (Plasmopara, Pseudoperonospora, etc.)",
        type: "oomycete",
        severity: "high",
        affectedPlants: "Grapes, Cucurbits (cucumber, melon, squash), Lettuce, Onions, Basil, Impatiens",
        optimalConditions: "Cool (50-70°F), wet conditions, high humidity",
        humidityNeeds: "Free water on leaves required for infection",
        commonRegions: "Temperate regions, areas with high rainfall, humid climates",
        description: "Downy mildew is caused by oomycete pathogens that thrive in cool, wet conditions. Unlike true fungi, they require free water on leaf surfaces to infect and are more closely related to algae. The disease causes significant damage to grapes, cucurbits, and many vegetable crops, leading to defoliation and yield loss. It spreads rapidly in humid conditions and can devastate entire crops if not controlled.",
        symptoms: [
            "Yellow to pale green angular spots on upper leaf surfaces",
            "White to grayish downy growth on leaf undersides (sporulation)",
            "Spots turn brown and necrotic as disease progresses",
            "Premature leaf drop",
            "Fruit may become infected and rot",
            "Systemic infection in some hosts",
            "Stunted growth and reduced yield"
        ],
        images: {
            main: "https://www.koppert.ca/Content/Images/icon-downy-mildew.jpg",
            thumbnails: [
                "https://www.koppert.ca/Content/Images/icon-downy-mildew.jpg",
                "https://www.koppert.ca/Content/Images/icon-downy-mildew.jpg",
                "https://www.koppert.ca/Content/Images/icon-downy-mildew.jpg",
                "https://www.koppert.ca/Content/Images/icon-downy-mildew.jpg"
            ]
        },
        prevention: {
            cultural: [
                "Improve air circulation through proper spacing and pruning",
                "Water early in the day so leaves dry quickly",
                "Avoid overhead irrigation - use drip irrigation at base",
                "Remove and destroy infected plant debris",
                "Use resistant varieties when available",
                "Avoid planting in low, poorly drained areas",
                "Space plants to reduce humidity in the canopy"
            ],
            biological: [
                "Apply products containing Bacillus subtilis (e.g., Serenade)",
                "Use phosphorous acid-based biological fungicides",
                "Apply compost tea as a preventive measure",
                "Introduce beneficial microorganisms like Trichoderma",
                "Use products containing Streptomyces species"
            ],
            chemical: [
                "Apply copper-based fungicides preventively",
                "Use mancozeb or chlorothalonil for severe infections",
                "Apply fungicides before rain events",
                "Rotate between different chemical classes (FRAC groups)",
                "Use metalaxyl/mefenoxam for oomycete control",
                "Apply dimethomorph or cymoxanil",
                "Consider phosphonate products (e.g., ProPhyt)"
            ],
            monitoring: [
                "Scout fields regularly, especially during cool, wet weather",
                "Check undersides of lower leaves first",
                "Use disease forecasting models to time applications",
                "Monitor weather forecasts for infection periods",
                "Look for initial symptoms after prolonged leaf wetness",
                "Record outbreaks to predict future occurrences"
            ]
        },
        similarDiseases: [
            { name: "Powdery Mildew", url: "powdery-mildew", description: "White powder on upper leaf surfaces." },
            { name: "Leaf Blight", url: "leaf-blight", description: "Large brown dead areas on leaves." },
            { name: "Anthracnose", url: "anthracnose", description: "Sunken lesions on leaves and fruit." }
        ]
    },
    
    // 4. FUSARIUM
    "fusarium": {
        name: "Fusarium",
        scientific: "Fusarium oxysporum, F. graminearum, F. solani",
        type: "fungal",
        severity: "high",
        affectedPlants: "Tomato, Banana, Cucurbits, Wheat, Corn, Beans, Many ornamentals",
        optimalConditions: "Warm soil (80-85°F), moist conditions",
        humidityNeeds: "Moist soil, moderate air humidity",
        commonRegions: "Worldwide, more common in warmer regions",
        description: "Fusarium is a large genus of soil-borne fungi that causes wilt, root rot, and head blight in many important crops. Different species affect different plants. Fusarium oxysporum causes vascular wilt by colonizing the water-conducting tissues, leading to wilting and death. Fusarium graminearum causes head blight in cereals, contaminating grain with mycotoxins harmful to humans and animals.",
        symptoms: [
            "Yellowing and wilting of lower leaves, progressing upward",
            "Vascular discoloration (brown streaks in stem tissue)",
            "Stunting and overall plant decline",
            "Root rot and decay",
            "In cereals: bleached spikelets with pink-orange spore masses",
            "Mycotoxin contamination in grains",
            "Sudden plant death in severe cases"
        ],
        images: {
            main: "https://www.koppert.ca/Content/Images/icon-fusarium.jpg",
            thumbnails: [
                "https://www.koppert.ca/Content/Images/icon-fusarium.jpg",
                "https://www.koppert.ca/Content/Images/icon-fusarium.jpg",
                "https://www.koppert.ca/Content/Images/icon-fusarium.jpg",
                "https://www.koppert.ca/Content/Images/icon-fusarium.jpg"
            ]
        },
        prevention: {
            cultural: [
                "Use resistant varieties when available",
                "Practice long crop rotation (4-6 years with non-host crops)",
                "Improve soil drainage",
                "Avoid over-irrigation",
                "Solarize soil in greenhouses",
                "Remove and destroy infected plants",
                "Clean equipment between fields",
                "Use pathogen-free seed and transplants"
            ],
            biological: [
                "Apply beneficial fungi like Trichoderma harzianum",
                "Use Bacillus subtilis and other beneficial bacteria",
                "Incorporate compost and organic amendments to suppressive soils",
                "Apply mycorrhizal fungi to enhance plant resistance",
                "Use products containing Streptomyces species"
            ],
            chemical: [
                "Fumigate soil in severe cases (greenhouses)",
                "Apply fungicides as seed treatments",
                "Use benzimidazole fungicides (where still effective)",
                "Apply strobilurin fungicides for foliar phases",
                "Limited chemical options for vascular wilt once infected",
                "Always rotate fungicide classes to prevent resistance"
            ],
            monitoring: [
                "Test soil for pathogen presence before planting",
                "Inspect plants regularly for early wilting symptoms",
                "Cut stems to check for vascular discoloration",
                "Monitor weather conditions favorable for disease",
                "Test grain for mycotoxins in cereal crops",
                "Keep records of affected areas for rotation planning"
            ]
        },
        similarDiseases: [
            { name: "Verticillium", url: "verticillium", description: "Similar vascular wilt symptoms." },
            { name: "Rhizoctonia", url: "rhizoctonia", description: "Root rot and damping-off." },
            { name: "Pythium", url: "pythium", description: "Root rot, especially in wet soils." }
        ]
    },
    
    // 5. RUST
    "rust": {
        name: "Rust",
        scientific: "Puccinia spp., Uromyces spp., Phragmidium spp.",
        type: "fungal",
        severity: "medium",
        affectedPlants: "Cereals (wheat, barley), Beans, Roses, Snapdragons, Corn, Asparagus",
        optimalConditions: "Cool to moderate temperatures, high humidity, free moisture",
        humidityNeeds: "Free water on leaves required for spore germination",
        commonRegions: "Worldwide, especially in temperate regions",
        description: "Rust diseases are caused by a large group of fungi that produce rusty-colored spore masses on plant surfaces. Many rust fungi have complex life cycles requiring two different host plants. They are obligate parasites, meaning they can only grow on living plants. Rusts can cause significant yield losses in cereal crops and reduce the ornamental value of landscape plants.",
        symptoms: [
            "Orange, yellow, brown, or black pustules on leaves and stems",
            "Pustules may be surrounded by yellow halos",
            "Leaf spots that coalesce, causing leaf death",
            "Premature defoliation",
            "Stunted growth",
            "Reduced yield in grain crops",
            "In severe cases, stem infections can cause girdling"
        ],
        images: {
            main: "https://www.koppert.ca/Content/Images/icon-rust.jpg",
            thumbnails: [
                "https://www.koppert.ca/Content/Images/icon-rust.jpg",
                "https://www.koppert.ca/Content/Images/icon-rust.jpg",
                "https://www.koppert.ca/Content/Images/icon-rust.jpg",
                "https://www.koppert.ca/Content/Images/icon-rust.jpg"
            ]
        },
        prevention: {
            cultural: [
                "Plant resistant varieties when available",
                "Remove alternate hosts (for rusts with complex life cycles)",
                "Space plants for good air circulation",
                "Water at base to keep foliage dry",
                "Remove and destroy infected plant debris",
                "Avoid working with plants when foliage is wet",
                "Use proper plant spacing to reduce humidity"
            ],
            biological: [
                "Apply products containing Bacillus subtilis",
                "Use compost teas as preventive sprays",
                "Apply sulfur-based biological fungicides",
                "Introduce beneficial microorganisms",
                "Use mycorrhizal fungi to enhance plant resistance"
            ],
            chemical: [
                "Apply fungicides preventively before rust appears",
                "Use triazole fungicides (e.g., tebuconazole, propiconazole)",
                "Apply strobilurins (e.g., azoxystrobin)",
                "Use chlorothalonil for broad-spectrum control",
                "Apply sulfur or copper fungicides",
                "Rotate between different fungicide classes"
            ],
            monitoring: [
                "Scout fields regularly, especially during favorable weather",
                "Check lower leaves first - early infection sites",
                "Monitor weather conditions for infection periods",
                "Use disease forecasting models for cereal rusts",
                "Look for small yellow spots before pustules develop",
                "Record outbreaks to predict future occurrences"
            ]
        },
        similarDiseases: [
            { name: "Powdery Mildew", url: "powdery-mildew", description: "White powder, not rust-colored." },
            { name: "Leaf Spot", url: "leaf-spot", description: "Dark spots without pustules." },
            { name: "Anthracnose", url: "anthracnose", description: "Sunken lesions with dark edges." }
        ]
    },
    
    // 6. ALTERNARIA (Early Blight)
    "alternaria": {
        name: "Alternaria (Early Blight)",
        scientific: "Alternaria solani, A. alternata, A. brassicicola",
        type: "fungal",
        severity: "high",
        affectedPlants: "Tomato, Potato, Pepper, Brassicas (cabbage, broccoli), Carrot, Apple",
        optimalConditions: "Warm (75-85°F), alternating wet and dry periods",
        humidityNeeds: "Free moisture or high humidity for infection",
        commonRegions: "Worldwide, common in temperate and subtropical regions",
        description: "Alternaria species cause a wide range of leaf spots, blights, and fruit rots. Early blight, caused by Alternaria solani, is one of the most destructive diseases of tomatoes and potatoes. It produces characteristic target-like spots with concentric rings. The fungus overwinters in plant debris and on seeds, and spreads through wind, rain, and irrigation water.",
        symptoms: [
            "Dark brown to black spots with concentric rings (target-like appearance)",
            "Spots typically appear on older leaves first",
            "Yellow halos surrounding leaf spots",
            "Leaf yellowing and defoliation",
            "Stem lesions – dark, slightly sunken areas",
            "Fruit lesions – dark, leathery spots near stem attachment",
            "In potatoes, tuber lesions with dark, corky rot"
        ],
        images: {
            main: "https://www.koppert.ca/Content/Images/icon-alternaria.jpg",
            thumbnails: [
                "https://www.koppert.ca/Content/Images/icon-alternaria.jpg",
                "https://www.koppert.ca/Content/Images/icon-alternaria.jpg",
                "https://www.koppert.ca/Content/Images/icon-alternaria.jpg",
                "https://www.koppert.ca/Content/Images/icon-alternaria.jpg"
            ]
        },
        prevention: {
            cultural: [
                "Practice crop rotation (2-3 years with non-host crops)",
                "Use disease-free seed and resistant varieties",
                "Space plants for good air circulation",
                "Water at base to keep foliage dry",
                "Remove and destroy infected plant debris",
                "Mulch to reduce soil splash onto leaves",
                "Avoid overhead irrigation",
                "Stake plants to improve airflow"
            ],
            biological: [
                "Apply products containing Bacillus subtilis",
                "Use compost teas as preventive sprays",
                "Apply Trichoderma species to soil",
                "Use potassium bicarbonate products",
                "Apply neem oil as a preventive treatment"
            ],
            chemical: [
                "Apply fungicides preventively before symptoms appear",
                "Use chlorothalonil, mancozeb, or copper fungicides",
                "Apply strobilurins (e.g., azoxystrobin, pyraclostrobin)",
                "Use triazole fungicides (e.g., tebuconazole, difenoconazole)",
                "Rotate between different fungicide classes",
                "Apply at 7-14 day intervals during favorable weather"
            ],
            monitoring: [
                "Scout fields weekly, especially on lower leaves",
                "Monitor weather conditions for disease risk",
                "Use disease forecasting models (e.g., Tom-Cast for tomatoes)",
                "Check plants after rain or irrigation",
                "Look for characteristic target spots",
                "Record outbreaks for rotation planning"
            ]
        },
        similarDiseases: [
            { name: "Septoria Leaf Spot", url: "septoria", description: "Small spots with dark borders and light centers." },
            { name: "Late Blight", url: "late-blight", description: "Irregular lesions with white fungal growth." },
            { name: "Bacterial Spot", url: "bacterial-spot", description: "Small, water-soaked spots." }
        ]
    },
    
    // 7. SCLEROTINIA (White Mold)
    "sclerotinia": {
        name: "Sclerotinia (White Mold)",
        scientific: "Sclerotinia sclerotiorum",
        type: "fungal",
        severity: "high",
        affectedPlants: "Lettuce, Bean, Carrot, Tomato, Cucumber, Sunflower, Canola, Many ornamentals",
        optimalConditions: "Cool (60-70°F), moist conditions",
        humidityNeeds: "High humidity, free moisture on plant surfaces",
        commonRegions: "Worldwide, especially in temperate regions and greenhouses",
        description: "Sclerotinia, also known as white mold, is a devastating fungal pathogen affecting over 400 plant species. It produces hard, black resting structures called sclerotia that can survive in soil for many years. The fungus infects through senescent tissue and requires free moisture to infect. It produces white, cottony mycelium and causes soft rot of stems, leaves, and fruits.",
        symptoms: [
            "Water-soaked lesions on stems, leaves, and fruits",
            "White, cottony fungal growth on infected tissues",
            "Soft rot of plant tissues",
            "Black, hard sclerotia (rat droppings appearance) inside stems",
            "Wilting and plant death",
            "Stems may shred or break at infection site",
            "In lettuce, basal rot and collapse of head"
        ],
        images: {
            main: "https://www.koppert.ca/Content/Images/icon-sclerotinia.jpg",
            thumbnails: [
                "https://www.koppert.ca/Content/Images/icon-sclerotinia.jpg",
                "https://www.koppert.ca/Content/Images/icon-sclerotinia.jpg",
                "https://www.koppert.ca/Content/Images/icon-sclerotinia.jpg",
                "https://www.koppert.ca/Content/Images/icon-sclerotinia.jpg"
            ]
        },
        prevention: {
            cultural: [
                "Practice long crop rotation (3-5 years) with non-host crops (cereals, corn)",
                "Improve air circulation through proper spacing",
                "Avoid over-fertilization with nitrogen",
                "Remove and destroy infected plant debris",
                "Use drip irrigation instead of overhead",
                "Plow deeply to bury sclerotia",
                "Solarize soil in greenhouses",
                "Use disease-free seed and transplants"
            ],
            biological: [
                "Apply the beneficial fungus Coniothyrium minitans (e.g., Contans)",
                "Use Trichoderma species to compete with the pathogen",
                "Apply Bacillus subtilis products",
                "Incorporate organic amendments to promote beneficial microbes",
                "Use mycoparasitic fungi that attack sclerotia"
            ],
            chemical: [
                "Apply fungicides preventively during flowering",
                "Use benzimidazole fungicides (e.g., thiophanate-methyl)",
                "Apply dicarboximide fungicides (e.g., iprodione)",
                "Use strobilurins (e.g., azoxystrobin)",
                "Apply boscalid or other SDHI fungicides",
                "Rotate between different fungicide classes",
                "Time applications to protect senescent tissues"
            ],
            monitoring: [
                "Scout fields during flowering - critical infection period",
                "Look for wilting plants and white mycelium",
                "Monitor weather for cool, moist conditions",
                "Check soil for sclerotia before planting",
                "Inspect stem interiors for black sclerotia",
                "Record infested areas for rotation planning"
            ]
        },
        similarDiseases: [
            { name: "Botrytis", url: "botrytis", description: "Gray mold, also produces sclerotia." },
            { name: "Rhizoctonia", url: "rhizoctonia", description: "Causes stem rot and damping-off." },
            { name: "Phytophthora", url: "phytophthora", description: "Water mold causing root and stem rot." }
        ]
    },
    
    // 8. VERTICILLIUM
    "verticillium": {
        name: "Verticillium Wilt",
        scientific: "Verticillium dahliae, V. albo-atrum",
        type: "fungal",
        severity: "high",
        affectedPlants: "Tomato, Potato, Pepper, Eggplant, Strawberry, Maple, Olive, Cotton, Many ornamentals",
        optimalConditions: "Moderate temperatures (70-80°F), moist soil",
        humidityNeeds: "Moist soil conditions",
        commonRegions: "Temperate regions worldwide, also in subtropics",
        description: "Verticillium wilt is a soil-borne fungal disease that causes vascular wilt in a wide range of plants. The fungus produces long-lived resting structures called microsclerotia that can survive in soil for over a decade. It enters through roots and colonizes the water-conducting tissues, blocking water flow and causing wilting. The disease is particularly problematic in temperate regions and on light, sandy soils.",
        symptoms: [
            "Yellowing and wilting of lower leaves, often on one side first",
            "V-shaped lesions on leaf margins",
            "Stunting and overall plant decline",
            "Vascular discoloration (brown streaking in stem)",
            "Premature defoliation",
            "Reduced yield",
            "In woody plants, branch dieback"
        ],
        images: {
            main: "https://www.koppert.ca/Content/Images/icon-verticillium.jpg",
            thumbnails: [
                "https://www.koppert.ca/Content/Images/icon-verticillium.jpg",
                "https://www.koppert.ca/Content/Images/icon-verticillium.jpg",
                "https://www.koppert.ca/Content/Images/icon-verticillium.jpg",
                "https://www.koppert.ca/Content/Images/icon-verticillium.jpg"
            ]
        },
        prevention: {
            cultural: [
                "Use resistant varieties when available",
                "Practice long crop rotation with non-host crops (cereals, corn, grasses)",
                "Solarize soil in high-value areas",
                "Improve soil drainage",
                "Avoid introducing infected soil",
                "Clean equipment between fields",
                "Use pathogen-free transplants",
                "Avoid planting in known infested fields"
            ],
            biological: [
                "Apply beneficial fungi like Trichoderma species",
                "Use Bacillus subtilis and other beneficial bacteria",
                "Incorporate compost and organic amendments",
                "Apply mycorrhizal fungi to enhance resistance",
                "Use suppressive soils with high organic matter"
            ],
            chemical: [
                "Fumigate soil in severe cases (greenhouses, high-value crops)",
                "Limited chemical options for established plants",
                "Apply fungicides as soil drenches (limited efficacy)",
                "Use phosphonate products to enhance plant defense",
                "No effective curative treatments once symptoms appear"
            ],
            monitoring: [
                "Test soil for microsclerotia before planting",
                "Inspect plants for characteristic wilting patterns",
                "Cut stems to check for vascular discoloration",
                "Map infested areas for rotation planning",
                "Monitor susceptible crops regularly",
                "Record outbreaks to avoid future planting"
            ]
        },
        similarDiseases: [
            { name: "Fusarium", url: "fusarium", description: "Similar vascular wilt symptoms." },
            { name: "Bacterial Wilt", url: "bacterial-wilt", description: "Rapid wilting with bacterial ooze." },
            { name: "Nematode Damage", url: "nematodes", description: "Root knots and stunting." }
        ]
    },
    
    // 9. ERWINIA (Bacterial Soft Rot)
    "erwinia": {
        name: "Erwinia (Bacterial Soft Rot)",
        scientific: "Erwinia carotovora, E. chrysanthemi (now Pectobacterium)",
        type: "bacterial",
        severity: "high",
        affectedPlants: "Potato, Carrot, Onion, Tomato, Pepper, Cabbage, Lettuce, Many ornamentals",
        optimalConditions: "Warm (70-90°F), moist conditions, low oxygen",
        humidityNeeds: "Free moisture on surfaces, high humidity",
        commonRegions: "Worldwide, especially in storage and transit",
        description: "Erwinia causes bacterial soft rot, one of the most destructive diseases of fleshy vegetables and ornamentals. The bacteria produce enzymes that break down plant cell walls, resulting in soft, watery decay. They enter through wounds and natural openings and thrive in warm, moist conditions with low oxygen. Soft rot is a major problem during storage and transit of vegetables.",
        symptoms: [
            "Soft, watery, mushy rot of fleshy tissues",
            "Foul odor from decaying tissue",
            "Water-soaked lesions that enlarge rapidly",
            "In potatoes, blackleg – black, slimy stem rot",
            "Tissue collapses into a slimy mass",
            "In onions, soft rot of bulbs",
            "Infected areas may have a cream to tan color"
        ],
        images: {
            main: "https://www.koppert.ca/Content/Images/icon-erwinia.jpg",
            thumbnails: [
                "https://www.koppert.ca/Content/Images/icon-erwinia.jpg",
                "https://www.koppert.ca/Content/Images/icon-erwinia.jpg",
                "https://www.koppert.ca/Content/Images/icon-erwinia.jpg",
                "https://www.koppert.ca/Content/Images/icon-erwinia.jpg"
            ]
        },
        prevention: {
            cultural: [
                "Use disease-free seed and planting material",
                "Avoid wounding during harvest and handling",
                "Harvest during dry conditions",
                "Cure potatoes and onions properly before storage",
                "Maintain good ventilation in storage",
                "Keep storage areas cool and dry",
                "Clean and disinfect equipment",
                "Rotate crops with non-host plants"
            ],
            biological: [
                "Apply beneficial bacteria like Pseudomonas fluorescens",
                "Use Bacillus subtilis products",
                "Apply bacteriophages specific to Erwinia",
                "Use compost teas containing beneficial microbes",
                "Treat seed with biological control agents"
            ],
            chemical: [
                "Limited chemical options for soft rot control",
                "Apply copper-based bactericides preventively",
                "Use disinfectants on equipment and storage areas",
                "Chlorine washes for post-harvest treatment",
                "No effective curative treatments once rot develops",
                "Antibiotics not recommended (resistance concerns)"
            ],
            monitoring: [
                "Inspect plants for wounds and early rot",
                "Monitor storage conditions (temperature, humidity)",
                "Check stored products regularly for soft rot",
                "Test seed lots for bacterial contamination",
                "Look for foul odor as early indicator",
                "Isolate and remove infected material immediately"
            ]
        },
        similarDiseases: [
            { name: "Pythium", url: "pythium", description: "Water mold causing soft rot." },
            { name: "Phytophthora", url: "phytophthora", description: "Water mold causing rot." },
            { name: "Rhizopus", url: "rhizopus", description: "Fungal soft rot with black sporangia." }
        ]
    },
    
    // 10. RHIZOCTONIA
    "rhizoctonia": {
        name: "Rhizoctonia",
        scientific: "Rhizoctonia solani",
        type: "fungal",
        severity: "high",
        affectedPlants: "Potato, Tomato, Bean, Lettuce, Carrot, Corn, Rice, Many ornamentals",
        optimalConditions: "Moderate temperatures (60-80°F), moist soil",
        humidityNeeds: "Moist soil conditions",
        commonRegions: "Worldwide, common in many soil types",
        description: "Rhizoctonia is a soil-borne fungus that causes damping-off, root rot, stem canker, and tuber lesions on a wide range of plants. It survives in soil as sclerotia and on plant debris. The fungus attacks young seedlings, causing them to rot at the soil line (damping-off). On older plants, it causes sunken cankers on stems and roots, and in potatoes, it produces black scurf on tubers.",
        symptoms: [
            "Damping-off of seedlings - rot at soil line",
            "Sunken, reddish-brown cankers on stems and roots",
            "Root rot and poor root development",
            "In potatoes, black scurf - black sclerotia on tuber surface",
            "Stem lesions that may girdle the plant",
            "Yellowing and stunting",
            "In lettuce, bottom rot of leaves touching soil"
        ],
        images: {
            main: "https://www.koppert.ca/Content/Images/icon-rhizoctonia.jpg",
            thumbnails: [
                "https://www.koppert.ca/Content/Images/icon-rhizoctonia.jpg",
                "https://www.koppert.ca/Content/Images/icon-rhizoctonia.jpg",
                "https://www.koppert.ca/Content/Images/icon-rhizoctonia.jpg",
                "https://www.koppert.ca/Content/Images/icon-rhizoctonia.jpg"
            ]
        },
        prevention: {
            cultural: [
                "Practice crop rotation with non-host crops (cereals)",
                "Use disease-free seed and planting material",
                "Avoid planting too deeply",
                "Improve soil drainage",
                "Avoid over-irrigation",
                "Use well-decomposed organic matter",
                "Solarize soil in high-value areas",
                "Plant when soil temperatures are optimal for rapid growth"
            ],
            biological: [
                "Apply beneficial fungi like Trichoderma species",
                "Use Bacillus subtilis products (e.g., Serenade)",
                "Incorporate compost and organic amendments",
                "Apply mycorrhizal fungi",
                "Use Streptomyces species as biocontrol agents"
            ],
            chemical: [
                "Apply fungicides as seed treatments",
                "Use PCNB (pentachloronitrobenzene) for some crops",
                "Apply azoxystrobin or other strobilurins",
                "Use flutolanil for specific Rhizoctonia control",
                "Apply pencycuron for potato black scurf",
                "Use soil fumigants in severe cases"
            ],
            monitoring: [
                "Inspect seedlings for damping-off",
                "Check roots and stems for cankers",
                "Examine potato tubers for black scurf",
                "Monitor soil moisture levels",
                "Test soil for pathogen presence",
                "Keep records of affected fields"
            ]
        },
        similarDiseases: [
            { name: "Pythium", url: "pythium", description: "Damping-off, but with soft rot." },
            { name: "Fusarium", url: "fusarium", description: "Root rot and wilt." },
            { name: "Sclerotinia", url: "sclerotinia", description: "White mold with sclerotia." }
        ]
    },
    
    // 11. TSWV (Tomato Spotted Wilt Virus)
    "tswv": {
        name: "Tomato Spotted Wilt Virus (TSWV)",
        scientific: "Tomato spotted wilt virus (Bunyaviridae)",
        type: "viral",
        severity: "high",
        affectedPlants: "Tomato, Pepper, Lettuce, Peanut, Tobacco, Chrysanthemum, Many ornamentals",
        optimalConditions: "Warm temperatures, presence of thrips vectors",
        humidityNeeds: "Conditions favorable for thrips",
        commonRegions: "Worldwide, especially in warmer regions and greenhouses",
        description: "Tomato Spotted Wilt Virus (TSWV) is one of the most destructive plant viruses, affecting hundreds of plant species. It is transmitted by several species of thrips, which acquire the virus as larvae and transmit it as adults. The virus causes a wide range of symptoms and can result in complete crop loss. It is particularly problematic in tomato, pepper, and lettuce production.",
        symptoms: [
            "Ring spots and concentric rings on leaves and fruit",
            "Bronzing or purpling of leaves",
            "Wilting and stunting",
            "Necrotic spots and streaks on stems",
            "Distorted growth and leaf curling",
            "Fruit with ringspots or uneven ripening",
            "Top dieback in severe cases"
        ],
        images: {
            main: "https://www.koppert.ca/Content/Images/icon-tswv.jpg",
            thumbnails: [
                "https://www.koppert.ca/Content/Images/icon-tswv.jpg",
                "https://www.koppert.ca/Content/Images/icon-tswv.jpg",
                "https://www.koppert.ca/Content/Images/icon-tswv.jpg",
                "https://www.koppert.ca/Content/Images/icon-tswv.jpg"
            ]
        },
        prevention: {
            cultural: [
                "Use resistant varieties when available",
                "Control thrips vectors with insecticides or biological control",
                "Use reflective mulches to repel thrips",
                "Remove weed hosts that harbor virus and thrips",
                "Isolate new plants before introducing to greenhouses",
                "Use virus-free transplants",
                "Rogue out infected plants immediately",
                "Plant during times of low thrips pressure"
            ],
            biological: [
                "Introduce predatory mites (e.g., Amblyseius cucumeris) for thrips control",
                "Use Orius insidiosus (minute pirate bug) for thrips",
                "Apply entomopathogenic fungi (Beauveria bassiana) for thrips",
                "Use neem oil products for thrips suppression"
            ],
            chemical: [
                "No direct chemical control for the virus itself",
                "Apply insecticides to control thrips vectors",
                "Use spinosad, spinetoram for thrips control",
                "Apply abamectin or other miticides",
                "Rotate insecticide classes to prevent resistance",
                "Systemic insecticides can provide longer control"
            ],
            monitoring: [
                "Use yellow or blue sticky traps for thrips monitoring",
                "Inspect plants regularly for thrips and virus symptoms",
                "Test suspicious plants for virus presence",
                "Monitor thrips populations to time sprays",
                "Check new transplants before planting",
                "Keep records of virus outbreaks"
            ]
        },
        similarDiseases: [
            { name: "INSV", url: "insv", description: "Impatiens Necrotic Spot Virus, similar symptoms." },
            { name: "TSWV", url: "tswv", description: "Same virus, different strain." },
            { name: "CMV", url: "cmv", description: "Cucumber mosaic virus, mosaic patterns." }
        ]
    },
    
    // 12. PHYTOPHTHORA
    "phytophthora": {
        name: "Phytophthora",
        scientific: "Phytophthora infestans, P. capsici, P. cinnamomi, many others",
        type: "oomycete",
        severity: "high",
        affectedPlants: "Tomato, Potato, Pepper, Cucurbits, Soybean, Avocado, Citrus, Many ornamentals",
        optimalConditions: "Cool to warm (50-80°F depending on species), wet conditions",
        humidityNeeds: "Free water required for spore movement and infection",
        commonRegions: "Worldwide, especially in areas with poor drainage",
        description: "Phytophthora species are devastating oomycete pathogens that cause root rot, stem rot, leaf blight, and fruit rot. They are often called 'water molds' because they require free water to complete their life cycle. Late blight of potato, caused by Phytophthora infestans, was responsible for the Irish Potato Famine. Different species affect different crops, but all thrive in wet conditions.",
        symptoms: [
            "Dark, water-soaked lesions on leaves, stems, and fruits",
            "Rapid wilting and plant death",
            "Root rot - brown, decayed roots",
            "Stem cankers that girdle the plant",
            "White fungal growth on infected surfaces in high humidity",
            "In potatoes, brown rot of tubers",
            "Foul odor from decaying tissue"
        ],
        images: {
            main: "https://www.koppert.ca/Content/Images/icon-phytophthora.jpg",
            thumbnails: [
                "https://www.koppert.ca/Content/Images/icon-phytophthora.jpg",
                "https://www.koppert.ca/Content/Images/icon-phytophthora.jpg",
                "https://www.koppert.ca/Content/Images/icon-phytophthora.jpg",
                "https://www.koppert.ca/Content/Images/icon-phytophthora.jpg"
            ]
        },
        prevention: {
            cultural: [
                "Improve soil drainage - plant on raised beds",
                "Avoid over-irrigation",
                "Use resistant varieties when available",
                "Practice crop rotation with non-host crops",
                "Remove and destroy infected plants",
                "Clean equipment between fields",
                "Use pathogen-free planting material",
                "Avoid moving infested soil"
            ],
            biological: [
                "Apply beneficial fungi like Trichoderma species",
                "Use Bacillus subtilis products",
                "Apply phosphonate products (e.g., phosphorous acid)",
                "Incorporate compost and organic amendments",
                "Use mycorrhizal fungi to enhance resistance"
            ],
            chemical: [
                "Apply metalaxyl/mefenoxam for oomycete control",
                "Use phosphonate fungicides (e.g., fosetyl-Al)",
                "Apply dimethomorph or cymoxanil",
                "Use copper-based fungicides",
                "Apply mancozeb or chlorothalonil for foliar phases",
                "Rotate between different chemical classes"
            ],
            monitoring: [
                "Scout fields regularly, especially after rain",
                "Check low spots and poorly drained areas first",
                "Monitor weather conditions for disease risk",
                "Test soil for pathogen presence",
                "Inspect roots of symptomatic plants",
                "Use disease forecasting models for late blight"
            ]
        },
        similarDiseases: [
            { name: "Pythium", url: "pythium", description: "Similar water mold, causes damping-off." },
            { name: "Phytophthora", url: "phytophthora", description: "Different species, same genus." },
            { name: "Downy Mildew", url: "downy-mildew", description: "Oomycete, but foliar only." }
        ]
    },
    
    // 13. CLADOSPORIUM (Leaf Mold)
    "cladosporium": {
        name: "Cladosporium (Leaf Mold)",
        scientific: "Cladosporium fulvum (Passalora fulva)",
        type: "fungal",
        severity: "medium",
        affectedPlants: "Tomato (especially greenhouse), Cucumber",
        optimalConditions: "High humidity (>85%), moderate temperatures (70-80°F)",
        humidityNeeds: "Very high humidity, free moisture on leaves",
        commonRegions: "Worldwide, common in greenhouses and humid areas",
        description: "Cladosporium leaf mold is a common disease of greenhouse tomatoes, though it can also occur in the field during humid weather. The fungus produces olive-green to brown velvety growth on leaf undersides. It thrives in high humidity and poor air circulation. While it rarely kills plants, severe infections can cause significant defoliation and yield loss.",
        symptoms: [
            "Pale green to yellow spots on upper leaf surfaces",
            "Olive-green to brown velvety mold on leaf undersides",
            "Spots enlarge and coalesce",
            "Leaves turn yellow then brown and die",
            "Defoliation starting from lower leaves",
            "In severe cases, flowers and fruit may be affected",
            "Fruit may develop black, leathery rot"
        ],
        images: {
            main: "https://www.koppert.ca/Content/Images/icon-cladosporium.jpg",
            thumbnails: [
                "https://www.koppert.ca/Content/Images/icon-cladosporium.jpg",
                "https://www.koppert.ca/Content/Images/icon-cladosporium.jpg",
                "https://www.koppert.ca/Content/Images/icon-cladosporium.jpg",
                "https://www.koppert.ca/Content/Images/icon-cladosporium.jpg"
            ]
        },
        prevention: {
            cultural: [
                "Improve air circulation in greenhouses",
                "Reduce humidity through ventilation and heating",
                "Space plants properly",
                "Use drip irrigation to keep foliage dry",
                "Remove lower leaves to improve airflow",
                "Use resistant varieties when available",
                "Avoid working with plants when foliage is wet"
            ],
            biological: [
                "Apply Bacillus subtilis products",
                "Use compost teas as preventive sprays",
                "Apply Trichoderma species",
                "Use potassium bicarbonate products"
            ],
            chemical: [
                "Apply fungicides preventively during high humidity",
                "Use chlorothalonil or mancozeb",
                "Apply strobilurins (e.g., azoxystrobin)",
                "Use triazole fungicides (e.g., difenoconazole)",
                "Rotate between different fungicide classes"
            ],
            monitoring: [
                "Monitor humidity levels in greenhouses",
                "Check lower leaves first for symptoms",
                "Look for yellow spots on upper leaf surfaces",
                "Inspect leaf undersides for olive-green mold",
                "Use humidity sensors to time ventilation"
            ]
        },
        similarDiseases: [
            { name: "Powdery Mildew", url: "powdery-mildew", description: "White powder on upper surfaces." },
            { name: "Gray Mold", url: "botrytis", description: "Gray, fluffy mold on all plant parts." },
            { name: "Leaf Spot", url: "leaf-spot", description: "Various fungal leaf spots." }
        ]
    },
    
    // 14. PSEUDOMONAS (Bacterial Leaf Spot)
    "pseudomonas": {
        name: "Pseudomonas (Bacterial Leaf Spot)",
        scientific: "Pseudomonas syringae, P. cichorii, many pathovars",
        type: "bacterial",
        severity: "medium",
        affectedPlants: "Tomato, Pepper, Bean, Cucumber, Lilac, Many ornamentals",
        optimalConditions: "Cool to moderate (60-75°F), wet conditions",
        humidityNeeds: "Free moisture on leaves, high humidity",
        commonRegions: "Worldwide, especially in temperate regions",
        description: "Pseudomonas species cause a wide range of bacterial leaf spots, blights, and wilts. They enter through natural openings and wounds, and spread through rain splash and irrigation water. Different pathovars affect specific host plants. The bacteria can survive on plant debris and on seed, and some cause ice nucleation that damages frost-sensitive plants.",
        symptoms: [
            "Small, water-soaked spots on leaves",
            "Spots turn brown or black with yellow halos",
            "Lesions may coalesce, causing leaf blight",
            "In some hosts, systemic wilting",
            "Cankers on stems and branches",
            "Fruit spots and blossom blast",
            "Bacterial ooze in high humidity"
        ],
        images: {
            main: "https://www.koppert.ca/Content/Images/icon-pseudomonas.jpg",
            thumbnails: [
                "https://www.koppert.ca/Content/Images/icon-pseudomonas.jpg",
                "https://www.koppert.ca/Content/Images/icon-pseudomonas.jpg",
                "https://www.koppert.ca/Content/Images/icon-pseudomonas.jpg",
                "https://www.koppert.ca/Content/Images/icon-pseudomonas.jpg"
            ]
        },
        prevention: {
            cultural: [
                "Use disease-free seed and transplants",
                "Avoid overhead irrigation",
                "Improve air circulation",
                "Remove and destroy infected plant debris",
                "Practice crop rotation",
                "Avoid working with wet plants",
                "Clean equipment between fields",
                "Use copper-tolerant cultivars when available"
            ],
            biological: [
                "Apply Bacillus subtilis products",
                "Use bacteriophages specific to Pseudomonas",
                "Apply compost teas",
                "Use beneficial Pseudomonas fluorescens as competitor",
                "Apply plant extracts with antibacterial properties"
            ],
            chemical: [
                "Apply copper-based bactericides preventively",
                "Use copper plus mancozeb mixtures for improved control",
                "Apply streptomycin where legal and resistance not present",
                "Use fixed copper products (copper hydroxide, copper sulfate)",
                "Rotate copper with other materials to prevent resistance"
            ],
            monitoring: [
                "Inspect plants regularly, especially after rain",
                "Look for water-soaked spots on young leaves",
                "Check undersides of leaves",
                "Monitor weather conditions favorable for disease",
                "Test suspicious spots for bacterial streaming"
            ]
        },
        similarDiseases: [
            { name: "Xanthomonas", url: "xanthomonas", description: "Bacterial spot, similar symptoms." },
            { name: "Bacterial Spot", url: "bacterial-spot", description: "Caused by Xanthomonas." },
            { name: "Angular Leaf Spot", url: "angular-leaf-spot", description: "Caused by Pseudomonas." }
        ]
    },
    
    // 15. CYLINDROCARPON (Root Rot)
    "cylindrocarpon": {
        name: "Cylindrocarpon (Root Rot)",
        scientific: "Cylindrocarpon destructans (Ilyonectria destructans)",
        type: "fungal",
        severity: "high",
        affectedPlants: "Grape, Apple, Strawberry, Ginseng, Many ornamentals",
        optimalConditions: "Cool to moderate temperatures, moist soil",
        humidityNeeds: "Moist soil conditions",
        commonRegions: "Temperate regions worldwide",
        description: "Cylindrocarpon is a soil-borne fungus that causes root rot, especially in perennial crops. It is a major problem in grapevine nurseries, causing black foot disease. The fungus attacks young roots and graft unions, leading to poor establishment and decline. It can survive in soil for many years and is difficult to control once established.",
        symptoms: [
            "Poor growth and stunting",
            "Yellowing and wilting",
            "Reduced root system - dark, decayed roots",
            "Black lesions at base of stems or graft unions",
            "Vascular discoloration in roots",
            "Sudden collapse in severe cases",
            "In grapes, black foot disease - dark, sunken lesions"
        ],
        images: {
            main: "https://www.koppert.ca/Content/Images/icon-cylindrocarpon.jpg",
            thumbnails: [
                "https://www.koppert.ca/Content/Images/icon-cylindrocarpon.jpg",
                "https://www.koppert.ca/Content/Images/icon-cylindrocarpon.jpg",
                "https://www.koppert.ca/Content/Images/icon-cylindrocarpon.jpg",
                "https://www.koppert.ca/Content/Images/icon-cylindrocarpon.jpg"
            ]
        },
        prevention: {
            cultural: [
                "Use disease-free planting material",
                "Avoid planting in infested soil",
                "Improve soil drainage",
                "Solarize soil before planting",
                "Practice long crop rotation",
                "Avoid wounding roots during planting",
                "Use well-decomposed organic matter",
                "Plant at proper depth - avoid deep planting"
            ],
            biological: [
                "Apply beneficial fungi like Trichoderma species",
                "Use mycorrhizal fungi to enhance root health",
                "Incorporate compost and organic amendments",
                "Apply Bacillus subtilis products",
                "Use suppressive soils with high organic matter"
            ],
            chemical: [
                "Fumigate soil in severe cases (nurseries)",
                "Apply fungicides as root dips before planting",
                "Use benzimidazole fungicides (e.g., thiophanate-methyl)",
                "Apply fludioxonil as seed/root treatment",
                "Limited options for established plants"
            ],
            monitoring: [
                "Inspect roots before planting",
                "Test soil for pathogen presence",
                "Monitor young plants for poor growth",
                "Check graft unions for dark lesions",
                "Examine roots of declining plants"
            ]
        },
        similarDiseases: [
            { name: "Phytophthora", url: "phytophthora", description: "Root rot, but with different symptoms." },
            { name: "Rhizoctonia", url: "rhizoctonia", description: "Root rot and stem cankers." },
            { name: "Fusarium", url: "fusarium", description: "Root rot and wilt." }
        ]
    },
    
    // 16. PYTHIUM (Damping-off)
    "pythium": {
        name: "Pythium (Damping-off, Root Rot)",
        scientific: "Pythium ultimum, P. aphanidermatum, many species",
        type: "oomycete",
        severity: "high",
        affectedPlants: "Almost all seedlings, turf, many mature plants",
        optimalConditions: "Cool to warm depending on species, wet soil",
        humidityNeeds: "Wet soil conditions, free water",
        commonRegions: "Worldwide, especially in poorly drained soils",
        description: "Pythium is a water mold that causes damping-off of seedlings and root rot of mature plants. It is one of the most common and destructive pathogens in greenhouses and nurseries. The pathogen thrives in wet soils and can kill seedlings within days. Different species are adapted to different temperature ranges, so Pythium can be a problem in both cool and warm conditions.",
        symptoms: [
            "Pre-emergence damping-off - seeds rot before germination",
            "Post-emergence damping-off - seedlings collapse at soil line",
            "Water-soaked, soft rot of roots",
            "Roots turn brown and slough off",
            "Stunted growth and wilting",
            "In turf, circular patches of dead grass",
            "In hydroponics, rapid root rot"
        ],
        images: {
            main: "https://www.koppert.ca/Content/Images/icon-pythium.jpg",
            thumbnails: [
                "https://www.koppert.ca/Content/Images/icon-pythium.jpg",
                "https://www.koppert.ca/Content/Images/icon-pythium.jpg",
                "https://www.koppert.ca/Content/Images/icon-pythium.jpg",
                "https://www.koppert.ca/Content/Images/icon-pythium.jpg"
            ]
        },
        prevention: {
            cultural: [
                "Use well-draining growing media",
                "Avoid overwatering",
                "Use clean pots and trays",
                "Plant at proper depth",
                "Provide good air circulation",
                "Use raised beds",
                "Solarize or steam pasteurize soil",
                "Use disease-free seed"
            ],
            biological: [
                "Apply beneficial fungi like Trichoderma",
                "Use Gliocladium species",
                "Apply Bacillus subtilis products",
                "Incorporate compost and organic amendments",
                "Use mycorrhizal fungi",
                "Apply Streptomyces species"
            ],
            chemical: [
                "Apply metalaxyl/mefenoxam for oomycete control",
                "Use etridiazole (e.g., Truban)",
                "Apply phosphonate products",
                "Use copper fungicides as preventives",
                "Treat seed with fungicides before planting",
                "Apply as soil drench at planting"
            ],
            monitoring: [
                "Check seedlings daily for damping-off",
                "Monitor soil moisture levels",
                "Inspect roots for discoloration",
                "Test potting media for pathogen",
                "Look for circular patterns in turf",
                "Keep records of outbreaks"
            ]
        },
        similarDiseases: [
            { name: "Phytophthora", url: "phytophthora", description: "Similar, but usually affects older plants." },
            { name: "Rhizoctonia", url: "rhizoctonia", description: "Damping-off, but with dry rot." },
            { name: "Fusarium", url: "fusarium", description: "Root rot, but vascular wilt." }
        ]
    },
    
    // 17. CYLINDROCLADIUM
    "cylindrocladium": {
        name: "Cylindrocladium",
        scientific: "Cylindrocladium scoparium, C. parasiticum",
        type: "fungal",
        severity: "high",
        affectedPlants: "Rhododendron, Azalea, Eucalyptus, Peanut, Many ornamentals",
        optimalConditions: "Warm temperatures, moist conditions",
        humidityNeeds: "High humidity, wet soil",
        commonRegions: "Temperate and subtropical regions",
        description: "Cylindrocladium is a soil-borne fungus that causes root rot, cutting rot, and leaf spots on a wide range of ornamental plants. It is particularly damaging in nurseries and on woody ornamentals. The fungus produces sticky spores that are easily spread in irrigation water and on tools. It can survive in soil for long periods as microsclerotia.",
        symptoms: [
            "Root rot and blackened roots",
            "Stem lesions and cankers",
            "Wilting and defoliation",
            "Leaf spots - brown with dark borders",
            "Cutting rot in propagation",
            "Red-brown discoloration of wood",
            "Plant death in severe cases"
        ],
        images: {
            main: "https://www.koppert.ca/Content/Images/icon-cylindrocladium.jpg",
            thumbnails: [
                "https://www.koppert.ca/Content/Images/icon-cylindrocladium.jpg",
                "https://www.koppert.ca/Content/Images/icon-cylindrocladium.jpg",
                "https://www.koppert.ca/Content/Images/icon-cylindrocladium.jpg",
                "https://www.koppert.ca/Content/Images/icon-cylindrocladium.jpg"
            ]
        },
        prevention: {
            cultural: [
                "Use disease-free cuttings and plants",
                "Avoid overwatering",
                "Improve air circulation",
                "Sanitize tools and benches",
                "Use clean potting media",
                "Remove and destroy infected plants",
                "Avoid splashing water"
            ],
            biological: [
                "Apply Trichoderma species",
                "Use Bacillus subtilis products",
                "Incorporate compost and organic amendments",
                "Apply mycorrhizal fungi"
            ],
            chemical: [
                "Apply fungicides as preventive drenches",
                "Use thiophanate-methyl",
                "Apply fludioxonil",
                "Use azoxystrobin or other strobilurins",
                "Rotate between different classes"
            ],
            monitoring: [
                "Inspect cuttings and new plants",
                "Check roots for discoloration",
                "Look for wilting plants",
                "Monitor irrigation water quality",
                "Test symptomatic plants"
            ]
        },
        similarDiseases: [
            { name: "Phytophthora", url: "phytophthora", description: "Root rot, water mold." },
            { name: "Rhizoctonia", url: "rhizoctonia", description: "Root rot and stem cankers." },
            { name: "Fusarium", url: "fusarium", description: "Root rot and wilt." }
        ]
    },
    
    // 18. MYCOCENTROSPORA
    "mycocentrospora": {
        name: "Mycocentrospora (Leaf Blight)",
        scientific: "Mycocentrospora acerina",
        type: "fungal",
        severity: "medium",
        affectedPlants: "Carrot, Celery, Parsnip, Viola, Many ornamentals",
        optimalConditions: "Cool temperatures, high humidity",
        humidityNeeds: "Free moisture on leaves",
        commonRegions: "Temperate regions, cool growing areas",
        description: "Mycocentrospora causes leaf blight and root rot, particularly on carrots and other umbelliferous crops. It is most severe in cool, wet conditions and can cause significant losses in storage as well as in the field. The fungus produces dark, elongated spores that are spread by water splash. It can survive in soil and on crop debris.",
        symptoms: [
            "Dark brown to black lesions on leaves",
            "Lesions often elongated along veins",
            "Leaf blight and defoliation",
            "On carrots, black rot of roots",
            "Root lesions - dark, sunken areas",
            "In storage, spread from infected roots",
            "Damping-off of seedlings"
        ],
        images: {
            main: "https://www.koppert.ca/Content/Images/icon-mycocentrospora.jpg",
            thumbnails: [
                "https://www.koppert.ca/Content/Images/icon-mycocentrospora.jpg",
                "https://www.koppert.ca/Content/Images/icon-mycocentrospora.jpg",
                "https://www.koppert.ca/Content/Images/icon-mycocentrospora.jpg",
                "https://www.koppert.ca/Content/Images/icon-mycocentrospora.jpg"
            ]
        },
        prevention: {
            cultural: [
                "Practice crop rotation",
                "Improve soil drainage",
                "Avoid overhead irrigation",
                "Harvest during dry conditions",
                "Remove crop debris",
                "Store roots at proper temperature and humidity",
                "Use disease-free seed"
            ],
            biological: [
                "Apply beneficial microorganisms",
                "Use compost teas",
                "Apply Bacillus subtilis products",
                "Incorporate organic amendments"
            ],
            chemical: [
                "Apply fungicides preventively",
                "Use chlorothalonil",
                "Apply copper-based fungicides",
                "Use strobilurins",
                "Treat seed with fungicides"
            ],
            monitoring: [
                "Scout fields during cool, wet weather",
                "Check lower leaves first",
                "Inspect roots at harvest",
                "Monitor stored roots regularly",
                "Look for characteristic elongated lesions"
            ]
        },
        similarDiseases: [
            { name: "Alternaria", url: "alternaria", description: "Leaf spot, target-like spots." },
            { name: "Cercospora", url: "cercospora", description: "Leaf spot, purple borders." },
            { name: "Phytophthora", url: "phytophthora", description: "Root rot, water mold." }
        ]
    },
    
    // 19. ITOSPORA
    "itospora": {
        name: "Itospora",
        scientific: "Itospora species",
        type: "fungal",
        severity: "medium",
        affectedPlants: "Various ornamentals",
        optimalConditions: "Moderate temperatures, humid conditions",
        humidityNeeds: "High humidity",
        commonRegions: "Temperate regions",
        description: "Itospora is a fungal pathogen that affects various ornamental plants, causing leaf spots and blights. While not as common as some other pathogens, it can cause significant damage in nursery production and landscape plantings under favorable conditions. The fungus produces characteristic spore structures on infected tissue.",
        symptoms: [
            "Small, dark leaf spots",
            "Spots enlarge and coalesce",
            "Leaf yellowing and premature drop",
            "Lesions may have concentric rings",
            "In severe cases, defoliation"
        ],
        images: {
            main: "https://www.koppert.ca/Content/Images/icon-itospora.jpg",
            thumbnails: [
                "https://www.koppert.ca/Content/Images/icon-itospora.jpg",
                "https://www.koppert.ca/Content/Images/icon-itospora.jpg",
                "https://www.koppert.ca/Content/Images/icon-itospora.jpg",
                "https://www.koppert.ca/Content/Images/icon-itospora.jpg"
            ]
        },
        prevention: {
            cultural: [
                "Remove infected leaves",
                "Improve air circulation",
                "Avoid overhead watering",
                "Space plants properly",
                "Clean up fallen debris"
            ],
            biological: [
                "Apply beneficial microorganisms",
                "Use compost teas",
                "Apply Bacillus subtilis"
            ],
            chemical: [
                "Apply copper-based fungicides",
                "Use chlorothalonil",
                "Apply strobilurins"
            ],
            monitoring: [
                "Inspect plants regularly",
                "Look for small leaf spots",
                "Monitor humidity levels"
            ]
        },
        similarDiseases: [
            { name: "Leaf Spot", url: "leaf-spot", description: "Various fungal leaf spots." },
            { name: "Anthracnose", url: "anthracnose", description: "Sunken lesions." }
        ]
    },
    
    // 20. XANTHOMONAS
    "xanthomonas": {
        name: "Xanthomonas (Bacterial Leaf Spot)",
        scientific: "Xanthomonas campestris, many pathovars",
        type: "bacterial",
        severity: "high",
        affectedPlants: "Tomato, Pepper, Cabbage, Citrus, Bean, Rice, Many ornamentals",
        optimalConditions: "Warm (75-90°F), wet conditions",
        humidityNeeds: "Free moisture on leaves, high humidity",
        commonRegions: "Worldwide, especially in warm, humid regions",
        description: "Xanthomonas is a large genus of bacteria that cause destructive diseases in many crops. Different pathovars are specialized to infect specific plant families. They cause leaf spots, blights, and vascular wilts. The bacteria enter through natural openings and wounds, and spread rapidly in warm, wet weather. They can survive on seed, in crop debris, and on alternative hosts.",
        symptoms: [
            "Small, water-soaked spots on leaves",
            "Spots turn brown or black, often with yellow halos",
            "Lesions may coalesce, causing blighting",
            "In cabbage, black rot - V-shaped yellow lesions at leaf margins",
            "In citrus, citrus canker - raised, corky lesions",
            "In rice, bacterial blight - wilting and drying",
            "Bacterial ooze in wet weather"
        ],
        images: {
            main: "https://www.koppert.ca/Content/Images/icon-xanthomonas.jpg",
            thumbnails: [
                "https://www.koppert.ca/Content/Images/icon-xanthomonas.jpg",
                "https://www.koppert.ca/Content/Images/icon-xanthomonas.jpg",
                "https://www.koppert.ca/Content/Images/icon-xanthomonas.jpg",
                "https://www.koppert.ca/Content/Images/icon-xanthomonas.jpg"
            ]
        },
        prevention: {
            cultural: [
                "Use disease-free seed and transplants",
                "Plant resistant varieties",
                "Avoid overhead irrigation",
                "Practice crop rotation",
                "Remove and destroy infected plants",
                "Clean equipment between fields",
                "Control weeds that may harbor bacteria",
                "Avoid working in wet fields"
            ],
            biological: [
                "Apply Bacillus subtilis products",
                "Use bacteriophages specific to Xanthomonas",
                "Apply compost teas",
                "Use beneficial Pseudomonas species",
                "Apply plant extracts with antibacterial properties"
            ],
            chemical: [
                "Apply copper-based bactericides",
                "Use copper plus mancozeb for improved control",
                "Apply streptomycin where legal",
                "Use fixed copper products preventively",
                "Rotate copper with other materials"
            ],
            monitoring: [
                "Inspect plants regularly, especially after rain",
                "Look for water-soaked spots",
                "Check seedlots for contamination",
                "Monitor weather conditions",
                "Test suspicious tissue for bacterial streaming",
                "Use diagnostic tests for pathovar identification"
            ]
        },
        similarDiseases: [
            { name: "Pseudomonas", url: "pseudomonas", description: "Bacterial spot, similar symptoms." },
            { name: "Bacterial Spot", url: "bacterial-spot", description: "Caused by Xanthomonas or Pseudomonas." },
            { name: "Angular Leaf Spot", url: "angular-leaf-spot", description: "Bacterial, caused by Pseudomonas." }
        ]
    }
};

// Add a console log to confirm loading
console.log("✅ disease-data.js loaded successfully!");
console.log("📊 Total diseases in database:", Object.keys(diseaseDatabase).length);
console.log("📋 Available disease keys:", Object.keys(diseaseDatabase));

// Helper function to get disease by URL parameter
function getDiseaseByParam(diseaseParam) {
    return diseaseDatabase[diseaseParam] || null;
}

// Helper function to get all diseases (for search/filter)
function getAllDiseases() {
    return Object.keys(diseaseDatabase).map(key => ({
        id: key,
        ...diseaseDatabase[key]
    }));
}