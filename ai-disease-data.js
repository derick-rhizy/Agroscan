// =========================
// AI DISEASE DATA - For Teachable Machine Model
// Based on metadata.json classes:
// ["not a plant", "healthy plant", "early blight", "late blight", "leaf mold", "bacterial spot"]
// =========================

const AiDiseaseData = {
    // Model class to disease mapping
    classMapping: {
        "not a plant": "non-plant",
        "healthy plant": "healthy",
        "early blight": "early-blight",
        "late blight": "late-blight",
        "leaf mold": "leaf-mold",
        "bacterial spot": "bacterial-spot"
    },
    
    // Reverse mapping for display
    displayNames: {
        "not a plant": "Not a Plant",
        "healthy plant": "Healthy Plant",
        "early blight": "Early Blight",
        "late blight": "Late Blight",
        "leaf mold": "Leaf Mold",
        "bacterial spot": "Bacterial Spot"
    },
    
    // Detailed disease information
    diseases: {
        "non-plant": {
            id: "non-plant",
            name: "Not a Plant",
            scientific: "N/A",
            type: "invalid",
            severity: "low",
            icon: "fa-image",
            color: "#95a5a6",
            affectedPlants: "None",
            optimalConditions: "N/A",
            description: "The uploaded image does not appear to be a plant. Please upload a clear photo of a plant leaf showing the affected area for accurate disease detection.",
            symptoms: [
                "Image does not contain plant material",
                "Upload a clear photo of a plant leaf",
                "Ensure the plant is in focus",
                "Include both healthy and diseased tissue if possible"
            ],
            treatment: [
                {
                    name: "Retake Photo",
                    description: "Take a new photo focusing on the plant leaf",
                    tip: "Use natural lighting and hold the camera steady"
                },
                {
                    name: "Check Image Quality",
                    description: "Ensure the image is clear and the plant is visible",
                    tip: "Avoid blurry or dark images"
                }
            ],
            prevention: [
                {
                    name: "Good Photography",
                    description: "Take photos in good lighting conditions",
                    tip: "Morning light works best"
                }
            ],
            products: []
        },
        
        "healthy": {
            id: "healthy",
            name: "Healthy Plant",
            scientific: "Various species",
            type: "healthy",
            severity: "low",
            icon: "fa-seedling",
            color: "#27ae60",
            affectedPlants: "All plant species",
            description: "Your plant appears to be healthy! No signs of disease were detected in the image. Continue providing good care to keep your plant thriving.",
            symptoms: [
                "No visible disease symptoms",
                "Normal leaf coloration",
                "Healthy growth pattern",
                "No spots, lesions, or discoloration"
            ],
            treatment: [
                {
                    name: "Continue Good Care",
                    description: "Maintain proper watering, lighting, and nutrition",
                    tip: "Different plants have different needs - research your specific plant"
                },
                {
                    name: "Regular Monitoring",
                    description: "Check your plant weekly for any changes",
                    tip: "Early detection is key to preventing problems"
                }
            ],
            prevention: [
                {
                    name: "Proper Watering",
                    description: "Water appropriately for your plant type",
                    tip: "Most plants prefer to dry out slightly between waterings"
                },
                {
                    name: "Good Air Circulation",
                    description: "Ensure adequate space between plants",
                    tip: "This prevents humidity buildup and disease spread"
                },
                {
                    name: "Clean Leaves",
                    description: "Wipe leaves gently to remove dust",
                    tip: "This helps the plant photosynthesize better"
                }
            ],
            products: [
                {
                    name: "Organic Fertilizer",
                    description: "Balanced plant food for healthy growth",
                    icon: "fa-flask",
                    rating: 4.5
                },
                {
                    name: "Moisture Meter",
                    description: "Helps prevent over/under watering",
                    icon: "fa-tint",
                    rating: 4.7
                }
            ]
        },
        
        "early-blight": {
            id: "early-blight",
            name: "Early Blight",
            scientific: "Alternaria solani",
            type: "fungal",
            severity: "high",
            icon: "fa-leaf",
            color: "#e67e22",
            affectedPlants: "Tomatoes, Potatoes, Peppers, Eggplants",
            description: "Early blight is a common fungal disease that appears as dark spots with concentric rings (target-like appearance) on lower leaves first.",
            symptoms: [
                "Dark brown to black spots with concentric rings",
                "Spots appear on older leaves first",
                "Yellow halos surrounding leaf spots",
                "Leaf yellowing and defoliation",
                "Stem lesions – dark, slightly sunken areas"
            ],
            treatment: [
                {
                    name: "Remove Affected Leaves",
                    description: "Prune and remove all leaves showing symptoms immediately",
                    tip: "Dispose of them in the trash, not compost"
                },
                {
                    name: "Apply Organic Fungicide",
                    description: "Use copper-based fungicide or neem oil",
                    tip: "Apply every 7-10 days, especially after rain"
                },
                {
                    name: "Improve Air Circulation",
                    description: "Space plants properly and prune for airflow",
                    tip: "Water at the base, not on leaves"
                }
            ],
            prevention: [
                {
                    name: "Crop Rotation",
                    description: "Don't plant tomatoes in the same spot for 3-4 years",
                    tip: "Rotate with non-host crops like beans or corn"
                },
                {
                    name: "Mulch",
                    description: "Apply mulch around plants to prevent soil splash",
                    tip: "Use straw or untreated grass clippings"
                },
                {
                    name: "Water Carefully",
                    description: "Water at the base of plants in the morning",
                    tip: "Avoid getting leaves wet"
                }
            ],
            products: [
                {
                    name: "Copper Fungicide",
                    description: "Organic fungicide for blight control",
                    icon: "fa-flask",
                    rating: 4.6
                },
                {
                    name: "Neem Oil",
                    description: "Natural fungicide and pest repellent",
                    icon: "fa-leaf",
                    rating: 4.5
                },
                {
                    name: "Pruning Shears",
                    description: "Sharp, clean cuts to remove infected leaves",
                    icon: "fa-cut",
                    rating: 4.8
                }
            ]
        },
        
        "late-blight": {
            id: "late-blight",
            name: "Late Blight",
            scientific: "Phytophthora infestans",
            type: "oomycete",
            severity: "high",
            icon: "fa-leaf",
            color: "#8e44ad",
            affectedPlants: "Tomatoes, Potatoes",
            description: "Late blight is a devastating disease that spreads rapidly in cool, wet conditions. It can destroy entire crops within days.",
            symptoms: [
                "Dark, water-soaked lesions on leaves",
                "White, cottony growth on leaf undersides in high humidity",
                "Rapid wilting and plant death",
                "Brown lesions on stems",
                "Firm, brown rot on fruits and tubers"
            ],
            treatment: [
                {
                    name: "Remove Infected Plants",
                    description: "Remove and destroy infected plants immediately",
                    tip: "Do NOT compost - bag and trash them"
                },
                {
                    name: "Apply Copper Fungicide",
                    description: "Use copper-based fungicide immediately",
                    tip: "Apply before rain events if possible"
                },
                {
                    name: "Monitor Nearby Plants",
                    description: "Check all nearby plants daily for symptoms",
                    tip: "This disease spreads extremely fast"
                }
            ],
            prevention: [
                {
                    name: "Resistant Varieties",
                    description: "Plant late blight-resistant varieties when available",
                    tip: "Look for varieties labeled as resistant"
                },
                {
                    name: "Avoid Overhead Watering",
                    description: "Use drip irrigation or water at the base",
                    tip: "Keep leaves as dry as possible"
                },
                {
                    name: "Good Spacing",
                    description: "Provide adequate space between plants",
                    tip: "Improves air circulation and drying"
                }
            ],
            products: [
                {
                    name: "Copper Fungicide",
                    description: "Effective for late blight control",
                    icon: "fa-flask",
                    rating: 4.5
                },
                {
                    name: "Garden Sulfur",
                    description: "Preventive fungicide",
                    icon: "fa-cube",
                    rating: 4.3
                }
            ]
        },
        
        "leaf-mold": {
            id: "leaf-mold",
            name: "Leaf Mold",
            scientific: "Passalora fulva",
            type: "fungal",
            severity: "medium",
            icon: "fa-leaf",
            color: "#f39c12",
            affectedPlants: "Tomatoes (especially greenhouse)",
            description: "Leaf mold causes olive-green to brown velvety growth on leaf undersides. Common in greenhouses with high humidity.",
            symptoms: [
                "Pale green to yellow spots on upper leaf surfaces",
                "Olive-green to brown velvety mold on leaf undersides",
                "Leaves turn yellow then brown and die",
                "Defoliation starting from lower leaves"
            ],
            treatment: [
                {
                    name: "Improve Ventilation",
                    description: "Increase air circulation immediately",
                    tip: "Use fans in greenhouses"
                },
                {
                    name: "Remove Affected Leaves",
                    description: "Prune and remove infected leaves",
                    tip: "Start with the lowest leaves first"
                },
                {
                    name: "Reduce Humidity",
                    description: "Ventilate to lower humidity levels",
                    tip: "Keep humidity below 85%"
                }
            ],
            prevention: [
                {
                    name: "Space Plants",
                    description: "Provide adequate space between plants",
                    tip: "Good airflow prevents disease"
                },
                {
                    name: "Water Carefully",
                    description: "Water at the base, not on leaves",
                    tip: "Morning watering allows leaves to dry"
                },
                {
                    name: "Remove Lower Leaves",
                    description: "Remove lower leaves as plants grow",
                    tip: "Improves air circulation near soil"
                }
            ],
            products: [
                {
                    name: "Sulfur Spray",
                    description: "Effective against leaf mold",
                    icon: "fa-flask",
                    rating: 4.4
                },
                {
                    name: "Hygrometer",
                    description: "Monitor greenhouse humidity",
                    icon: "fa-tachometer-alt",
                    rating: 4.7
                }
            ]
        },
        
        "bacterial-spot": {
            id: "bacterial-spot",
            name: "Bacterial Spot",
            scientific: "Xanthomonas spp.",
            type: "bacterial",
            severity: "high",
            icon: "fa-bacterium",
            color: "#c0392b",
            affectedPlants: "Tomatoes, Peppers",
            description: "Bacterial spot causes small, water-soaked spots that turn brown or black with yellow halos. Spreads rapidly in warm, wet weather.",
            symptoms: [
                "Small, water-soaked spots on leaves",
                "Spots turn brown or black with yellow halos",
                "Lesions may coalesce, causing leaf blight",
                "Raised, scabby spots on fruits",
                "Defoliation in severe cases"
            ],
            treatment: [
                {
                    name: "Remove Infected Leaves",
                    description: "Prune and remove affected leaves",
                    tip: "Sterilize tools between cuts"
                },
                {
                    name: "Apply Copper Spray",
                    description: "Use copper-based bactericide",
                    tip: "Apply every 7-10 days"
                },
                {
                    name: "Avoid Working When Wet",
                    description: "Don't handle plants when leaves are wet",
                    tip: "Bacteria spread easily in water"
                }
            ],
            prevention: [
                {
                    name: "Resistant Varieties",
                    description: "Plant resistant tomato and pepper varieties",
                    tip: "Look for varieties labeled as resistant"
                },
                {
                    name: "Clean Seed",
                    description: "Use disease-free seed or treat seeds",
                    tip: "Hot water treatment can kill bacteria"
                },
                {
                    name: "Crop Rotation",
                    description: "Rotate with non-host crops for 2-3 years",
                    tip: "Avoid planting tomatoes/peppers in same spot"
                }
            ],
            products: [
                {
                    name: "Copper Bactericide",
                    description: "Effective against bacterial spot",
                    icon: "fa-flask",
                    rating: 4.5
                },
                {
                    name: "Fixed Copper Spray",
                    description: "Preventive bactericide",
                    icon: "fa-spray-can",
                    rating: 4.4
                }
            ]
        }
    },
    
    // Helper methods
    getDiseaseByClass: function(className) {
        const id = this.classMapping[className.toLowerCase()];
        return id ? this.diseases[id] : null;
    },
    
    getDiseaseById: function(id) {
        return this.diseases[id] || null;
    },
    
    getDisplayName: function(className) {
        return this.displayNames[className.toLowerCase()] || className;
    },
    
    getAllDiseases: function() {
        return Object.values(this.diseases);
    },
    
    getSeverity: function(status, confidence) {
        if (status === 'non-plant' || status === 'healthy') return 'Low';
        
        const conf = parseFloat(confidence);
        if (conf >= 80) return 'High';
        if (conf >= 60) return 'Medium';
        return 'Low';
    }
};

// Make it globally available
window.AiDiseaseData = AiDiseaseData;

// Log to confirm loading
console.log("✅ AI Disease Data loaded successfully!");
console.log("📊 AI Model classes:", Object.keys(AiDiseaseData.classMapping));
console.log("📋 Disease database has", Object.keys(AiDiseaseData.diseases).length, "entries");