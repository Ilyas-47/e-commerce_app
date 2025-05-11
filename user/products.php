<!DOCTYPE html>
<html lang="fr">
<body>
    <?php include_once '../includes/nav.php'; ?>
    <link rel="stylesheet" type="text/css" href="../assets/css/products.css">
    <header class="page-header">
        <h1>Nos produits</h1>
    </header>

    <div class="products-container">
        <button class="filters-mobile-btn">
            <i class="fas fa-sliders-h"></i> Filtrer les produits
        </button>
        
        <aside class="filters">
            <button class="filters-close">&times;</button>
            
            <div class="filter-group">
                <h3><i class="fas fa-tags"></i> Lorem</h3>
                <div class="filter-options">
                    <label class="filter-checkbox">
                        <input type="checkbox" name="category" value="office"> Lorem ipsum 1
                    </label>
                    <label class="filter-checkbox">
                        <input type="checkbox" name="category" value="windows"> Lorem ipsum 2
                    </label>
                    <label class="filter-checkbox">
                        <input type="checkbox" name="category" value="antivirus"> Lorem ipsum 3
                    </label>
                    <label class="filter-checkbox">
                        <input type="checkbox" name="category" value="design"> Lorem ipsum 4
                    </label>
                </div>
            </div>

            <div class="filter-group">
                <h3><i class="fas fa-coins"></i> Lorem</h3>
                <div class="price-range">
                    <div class="price-inputs">
                        <input type="number" class="price-input" placeholder="Min" min="0">
                        <input type="number" class="price-input" placeholder="Max" min="0">
                    </div>
                    <button class="apply-price">Lorem</button>
                </div>
            </div>

            <div class="filter-group">
                <h3><i class="fas fa-laptop"></i> Lorem Ipsum</h3>
                <select class="filter-select" name="system">
                    <option value="">Lorem ipsum</option>
                    <option value="opt1">Lorem 1</option>
                    <option value="opt2">Lorem 2</option>
                    <option value="opt3">Lorem 3</option>
                    <option value="opt4">Lorem 4</option>
                </select>
            </div>

            <div class="filter-group">
                <h3><i class="fas fa-calendar-alt"></i> Lorem</h3>
                <select class="filter-select" name="year">
                    <option value="">Lorem ipsum</option>
                    <option value="2024">Lorem 1</option>
                    <option value="2023">Lorem 2</option>
                    <option value="2022">Lorem 3</option>
                    <option value="2021">Lorem 4</option>
                </select>
            </div>
            
            <div class="filter-group">
                <h3><i class="fas fa-user-tie"></i> Lorem Ipsum</h3>
                <div class="filter-options">
                    <label class="filter-checkbox">
                        <input type="checkbox" name="user_type" value="type1"> Lorem ipsum 1
                    </label>
                    <label class="filter-checkbox">
                        <input type="checkbox" name="user_type" value="type2"> Lorem ipsum 2
                    </label>
                    <label class="filter-checkbox">
                        <input type="checkbox" name="user_type" value="type3"> Lorem ipsum 3
                    </label>
                </div>
            </div>
        </aside>

        <div class="products-content">
            <div class="products-header">
                <span class="products-count">12 produits trouvés</span>
                <div class="products-sort">
                    <span class="sort-label">Trier par:</span>
                    <select class="sort-select">
                        <option value="popular">Popularité</option>
                        <option value="price-asc">Prix: croissant</option>
                        <option value="price-desc">Prix: décroissant</option>
                        <option value="name-asc">Nom: A-Z</option>
                        <option value="name-desc">Nom: Z-A</option>
                    </select>
                </div>
            </div>

            <main class="products-grid">
                <!-- Product 1 -->
                <div class="product-card" 
                    data-category="office" 
                    data-price="149.99"
                    data-system="windows11"
                    data-year="2024"
                    data-user="business">
                    <span class="product-badge">Nouveau</span>
                    <div class="product-image-container">
                        <img src="../assets/images/office.png" alt="Microsoft Office 2024" class="product-image">
                    </div>
                    <div class="product-details">
                        <div class="product-category">Lorem Ipsum</div>
                        <h3 class="product-title">Lorem ipsum dolor sit amet consectetur</h3>
                        <div class="product-meta">
                            <span class="meta-item"><i class="fas fa-laptop"></i> Lorem</span>
                            <span class="meta-item"><i class="fas fa-calendar"></i> 2024</span>
                        </div>
                        <div class="product-price">
                            0.00 Prix
                            <span class="price-original">0.00 Ancien prix</span>
                            <span class="price-discount">-00%</span>
                        </div>
                        <div class="product-buttons">
                            <button class="btn-cart"><i class="fas fa-shopping-cart"></i> Panier</button>
                            <a href="product_page.php" class="btn-shop"><i class="fas fa-bolt"></i> Acheter</a>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="product-card" 
                    data-category="windows" 
                    data-price="219.99"
                    data-system="windows11"
                    data-year="2023"
                    data-user="personal">
                    <div class="product-image-container">
                        <img src="../assets/images/office.png" alt="Windows 11 Pro" class="product-image">
                    </div>
                    <div class="product-details">
                        <div class="product-category">Lorem Ipsum</div>
                        <h3 class="product-title">Lorem ipsum dolor sit amet, consectetur adipiscing</h3>
                        <div class="product-meta">
                            <span class="meta-item"><i class="fas fa-laptop"></i> Lorem</span>
                            <span class="meta-item"><i class="fas fa-calendar"></i> 2024</span>
                        </div>
                        <div class="product-price">
                            0.00 Prix
                            <span class="price-original">0.00 Ancien prix</span>
                            <span class="price-discount">-00%</span>
                        </div>
                        <div class="product-buttons">
                            <button class="btn-cart"><i class="fas fa-shopping-cart"></i> Panier</button>
                            <a href="product_page.php" class="btn-shop"><i class="fas fa-bolt"></i> Acheter</a>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="product-card" 
                    data-category="antivirus" 
                    data-price="89.99"
                    data-system="windows11,windows10,mac"
                    data-year="2024"
                    data-user="personal,business">
                    <span class="product-badge">Populaire</span>
                    <div class="product-image-container">
                        <img src="../assets/images/office.png" alt="Norton 360 Premium" class="product-image">
                    </div>
                    <div class="product-details">
                        <div class="product-category">Lorem Ipsum</div>
                        <h3 class="product-title">Lorem ipsum dolor sit amet, consectetur adipiscing</h3>
                        <div class="product-meta">
                            <span class="meta-item"><i class="fas fa-laptop"></i> Lorem</span>
                            <span class="meta-item"><i class="fas fa-calendar"></i> 2024</span>
                        </div>
                        <div class="product-price">
                            0.00 Prix
                            <span class="price-original">0.00 Ancien prix</span>
                            <span class="price-discount">-00%</span>
                        </div>
                        <div class="product-buttons">
                            <button class="btn-cart"><i class="fas fa-shopping-cart"></i> Panier</button>
                            <a href="product_page.php" class="btn-shop"><i class="fas fa-bolt"></i> Acheter</a>
                        </div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="product-card" 
                    data-category="office" 
                    data-price="99.99"
                    data-system="mac"
                    data-year="2024"
                    data-user="personal,education">
                    <div class="product-image-container">
                        <img src="../assets/images/office.png" alt="Microsoft Office 2024 Home" class="product-image">
                    </div>
                    <div class="product-details">
                        <div class="product-category">Lorem Ipsum</div>
                        <h3 class="product-title">Lorem ipsum dolor sit amet, consectetur adipiscing</h3>
                        <div class="product-meta">
                            <span class="meta-item"><i class="fas fa-laptop"></i> Lorem</span>
                            <span class="meta-item"><i class="fas fa-calendar"></i> 2024</span>
                        </div>
                        <div class="product-price">
                            0.00 Prix
                            <span class="price-original">0.00 Ancien prix</span>
                            <span class="price-discount">-00%</span>
                        </div>
                        <div class="product-buttons">
                            <button class="btn-cart"><i class="fas fa-shopping-cart"></i> Panier</button>
                            <a href="product_page.php" class="btn-shop"><i class="fas fa-bolt"></i> Acheter</a>
                        </div>
                    </div>
                </div>

                <!-- Product 5 -->
                <div class="product-card" 
                    data-category="design" 
                    data-price="399.99"
                    data-system="windows11,mac"
                    data-year="2024"
                    data-user="business">
                    <div class="product-image-container">
                        <img src="../assets/images/office.png" alt="Adobe Creative Cloud" class="product-image">
                    </div>
                    <div class="product-details">
                        <div class="product-category">Lorem Ipsum</div>
                        <h3 class="product-title">Lorem ipsum dolor sit amet, consectetur adipiscing</h3>
                        <div class="product-meta">
                            <span class="meta-item"><i class="fas fa-laptop"></i> Lorem</span>
                            <span class="meta-item"><i class="fas fa-calendar"></i> 2024</span>
                        </div>
                        <div class="product-price">
                            0.00 Prix
                            <span class="price-original">0.00 Ancien prix</span>
                            <span class="price-discount">-00%</span>
                        </div>
                        <div class="product-buttons">
                            <button class="btn-cart"><i class="fas fa-shopping-cart"></i> Panier</button>
                            <a href="product_page.php" class="btn-shop"><i class="fas fa-bolt"></i> Acheter</a>
                        </div>
                    </div>
                </div>

                <!-- Product 6 -->
                <div class="product-card" 
                    data-category="antivirus" 
                    data-price="59.99"
                    data-system="windows10,mac"
                    data-year="2023"
                    data-user="personal">
                    <div class="product-image-container">
                        <img src="../assets/images/office.png" alt="Kaspersky Total Security" class="product-image">
                    </div>
                    <div class="product-details">
                        <div class="product-category">Lorem Ipsum</div>
                        <h3 class="product-title">Lorem ipsum dolor sit amet, consectetur adipiscing</h3>
                        <div class="product-meta">
                            <span class="meta-item"><i class="fas fa-laptop"></i> Lorem</span>
                            <span class="meta-item"><i class="fas fa-calendar"></i> 2024</span>
                        </div>
                        <div class="product-price">
                            0.00 Prix
                            <span class="price-original">0.00 Ancien prix</span>
                            <span class="price-discount">-00%</span>
                        </div>
                        <div class="product-buttons">
                            <button class="btn-cart"><i class="fas fa-shopping-cart"></i> Panier</button>
                            <a href="product_page.php" class="btn-shop"><i class="fas fa-bolt"></i> Acheter</a>
                        </div>
                    </div>
                </div>

                <!-- Product 7 -->
                <div class="product-card" 
                    data-category="design" 
                    data-price="299.99"
                    data-system="windows11,mac"
                    data-year="2024"
                    data-user="business,education">
                    <div class="product-image-container">
                        <img src="../assets/images/office.png" alt="CorelDRAW Graphics Suite" class="product-image">
                    </div>
                    <div class="product-details">
                        <div class="product-category">Lorem Ipsum</div>
                        <h3 class="product-title">Lorem ipsum dolor sit amet, consectetur adipiscing</h3>
                        <div class="product-meta">
                            <span class="meta-item"><i class="fas fa-laptop"></i> Lorem</span>
                            <span class="meta-item"><i class="fas fa-calendar"></i> 2024</span>
                        </div>
                        <div class="product-price">
                            0.00 Prix
                            <span class="price-original">0.00 Ancien prix</span>
                            <span class="price-discount">-00%</span>
                        </div>
                        <div class="product-buttons">
                            <button class="btn-cart"><i class="fas fa-shopping-cart"></i> Panier</button>
                            <a href="product_page.php" class="btn-shop"><i class="fas fa-bolt"></i> Acheter</a>
                        </div>
                    </div>
                </div>

                <!-- Product 8 -->
                <div class="product-card" 
                    data-category="office" 
                    data-price="129.99"
                    data-system="windows10,windows11"
                    data-year="2023"
                    data-user="business,education">
                    <div class="product-image-container">
                        <img src="../assets/images/office.png" alt="Microsoft Office 2023" class="product-image">
                    </div>
                    <div class="product-details">
                        <div class="product-category">Lorem Ipsum</div>
                        <h3 class="product-title">Lorem ipsum dolor sit amet, consectetur adipiscing</h3>
                        <div class="product-meta">
                            <span class="meta-item"><i class="fas fa-laptop"></i> Lorem</span>
                            <span class="meta-item"><i class="fas fa-calendar"></i> 2024</span>
                        </div>
                        <div class="product-price">
                            0.00 Prix
                            <span class="price-original">0.00 Ancien prix</span>
                            <span class="price-discount">-00%</span>
                        </div>
                        <div class="product-buttons">
                            <button class="btn-cart"><i class="fas fa-shopping-cart"></i> Panier</button>
                            <a href="product_page.php" class="btn-shop"><i class="fas fa-bolt"></i> Acheter</a>
                        </div>
                    </div>
                </div>

                <!-- Product 9 -->
                <div class="product-card" 
                    data-category="windows" 
                    data-price="199.99"
                    data-system="windows10"
                    data-year="2022"
                    data-user="personal">
                    <div class="product-image-container">
                        <img src="../assets/images/office.png" alt="Windows 10 Home" class="product-image">
                    </div>
                    <div class="product-details">
                        <div class="product-category">Lorem Ipsum</div>
                        <h3 class="product-title">Lorem ipsum dolor sit amet, consectetur adipiscing</h3>
                        <div class="product-meta">
                            <span class="meta-item"><i class="fas fa-laptop"></i> Lorem</span>
                            <span class="meta-item"><i class="fas fa-calendar"></i> 2024</span>
                        </div>
                        <div class="product-price">
                            0.00 Prix
                            <span class="price-original">0.00 Ancien prix</span>
                            <span class="price-discount">-00%</span>
                        </div>
                        <div class="product-buttons">
                            <button class="btn-cart"><i class="fas fa-shopping-cart"></i> Panier</button>
                            <a href="product_page.php" class="btn-shop"><i class="fas fa-bolt"></i> Acheter</a>
                        </div>
                    </div>
                </div>

                <!-- Product 10 -->
                <div class="product-card" 
                    data-category="antivirus" 
                    data-price="79.99"
                    data-system="windows11,mac"
                    data-year="2023"
                    data-user="personal,business">
                    <div class="product-image-container">
                        <img src="../assets/images/office.png" alt="McAfee Total Protection" class="product-image">
                    </div>
                    <div class="product-details">
                        <div class="product-category">Lorem Ipsum</div>
                        <h3 class="product-title">Lorem ipsum dolor sit amet, consectetur adipiscing</h3>
                        <div class="product-meta">
                            <span class="meta-item"><i class="fas fa-laptop"></i> Lorem</span>
                            <span class="meta-item"><i class="fas fa-calendar"></i> 2024</span>
                        </div>
                        <div class="product-price">
                            0.00 Prix
                            <span class="price-original">0.00 Ancien prix</span>
                            <span class="price-discount">-00%</span>
                        </div>
                        <div class="product-buttons">
                            <button class="btn-cart"><i class="fas fa-shopping-cart"></i> Panier</button>
                            <a href="product_page.php" class="btn-shop"><i class="fas fa-bolt"></i> Acheter</a>
                        </div>
                    </div>
                </div>

                <!-- Product 11 -->
                <div class="product-card" 
                    data-category="design" 
                    data-price="349.99"
                    data-system="windows11,mac"
                    data-year="2024"
                    data-user="business,education">
                    <div class="product-image-container">
                        <img src="../assets/images/office.png" alt="Autodesk AutoCAD" class="product-image">
                    </div>
                    <div class="product-details">
                        <div class="product-category">Lorem Ipsum</div>
                        <h3 class="product-title">Lorem ipsum dolor sit amet, consectetur adipiscing</h3>
                        <div class="product-meta">
                            <span class="meta-item"><i class="fas fa-laptop"></i> Lorem</span>
                            <span class="meta-item"><i class="fas fa-calendar"></i> 2024</span>
                        </div>
                        <div class="product-price">
                            0.00 Prix
                            <span class="price-original">0.00 Ancien prix</span>
                            <span class="price-discount">-00%</span>
                        </div>
                        <div class="product-buttons">
                            <button class="btn-cart"><i class="fas fa-shopping-cart"></i> Panier</button>
                            <a href="product_page.php" class="btn-shop"><i class="fas fa-bolt"></i> Acheter</a>
                        </div>
                    </div>
                </div>

                <!-- Product 12 -->
                <div class="product-card" 
                    data-category="office" 
                    data-price="119.99"
                    data-system="windows10,windows11"
                    data-year="2023"
                    data-user="personal,education">
                    <div class="product-image-container">
                        <img src="../assets/images/office.png" alt="Microsoft Office 2023 Home" class="product-image">
                    </div>
                    <div class="product-details">
                        <div class="product-category">Lorem Ipsum</div>
                        <h3 class="product-title">Lorem ipsum dolor sit amet, consectetur adipiscing</h3>
                        <div class="product-meta">
                            <span class="meta-item"><i class="fas fa-laptop"></i> Lorem</span>
                            <span class="meta-item"><i class="fas fa-calendar"></i> 2024</span>
                        </div>
                        <div class="product-price">
                            0.00 Prix
                            <span class="price-original">0.00 Ancien prix</span>
                            <span class="price-discount">-00%</span>
                        </div>
                        <div class="product-buttons">
                            <button class="btn-cart"><i class="fas fa-shopping-cart"></i> Panier</button>
                            <a href="product_page.php" class="btn-shop"><i class="fas fa-bolt"></i> Acheter</a>
                        </div>
                    </div>
                </div>
            </main>

            <div class="pagination">
                <button class="page-item disabled">&laquo;</button>
                <button class="page-item active">1</button>
                <button class="page-item">2</button>
                <button class="page-item">3</button>
                <button class="page-item">&raquo;</button>
            </div>
        </div>
    </div>

    <div class="overlay"></div>

<?php include_once '../includes/footer.php'; ?>
</body>
</html>