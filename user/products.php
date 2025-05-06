<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Produits</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: #FFFDF7;
            color: #1E293B;
            line-height: 1.6;
        }

        .page-header {
            text-align: center;
            margin-bottom: 3rem;
            padding: 2rem 0;
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1E293B;
        }

        .page-header p {
            display: none;
        }

        .header-bg {
            display: none;
        }

        .products-container {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 2rem;
            max-width: 1400px;
            margin: 0 auto 3rem;
            padding: 0 1.5rem;
        }

        .filters {
            background: #FFFFFF;
            padding: 1.75rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(255, 206, 10, 0.07);
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .filter-group {
            margin-bottom: 1.75rem;
            border-bottom: 1px solid #E2E8F0;
            padding-bottom: 1.5rem;
        }

        .filter-group:last-child {
            margin-bottom: 0;
            border-bottom: none;
            padding-bottom: 0;
        }

        .filter-group h3 {
            color: #1E293B;
            margin-bottom: 1rem;
            font-size: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .filter-group h3 i {
            margin-right: 0.5rem;
            color: #FFCE0A;
        }

        .filter-options {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .filter-checkbox {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            font-size: 0.95rem;
            color: #64748B;
            transition: all 0.3s ease;
        }

        .filter-checkbox:hover {
            color: #1E293B;
        }

        .filter-checkbox input {
            accent-color: #FFCE0A;
            width: 16px;
            height: 16px;
        }

        .price-range {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .price-inputs {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .price-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            font-size: 0.9rem;
            outline: none;
            transition: all 0.3s ease;
        }

        .price-input:focus {
            border-color: #FFCE0A;
            box-shadow: 0 0 0 2px rgba(255, 206, 10, 0.1);
        }

        .apply-price {
            background-color: #FFCE0A;
            color: #1E293B;
            border: none;
            padding: 0.75rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            width: 100%;
        }

        .apply-price:hover {
            background-color: #FFD534;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(255, 206, 10, 0.07);
        }

        .filter-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            background: #FFFFFF;
            color: #64748B;
            font-size: 0.9rem;
            outline: none;
            transition: all 0.3s ease;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%2364748B' width='18px' height='18px'%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
        }

        .filter-select:focus {
            border-color: #FFCE0A;
            box-shadow: 0 0 0 2px rgba(255, 206, 10, 0.1);
            color: #1E293B;
        }

        .products-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .products-count {
            font-size: 0.95rem;
            color: #64748B;
        }

        .products-sort {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sort-label {
            font-size: 0.95rem;
            color: #64748B;
        }

        .sort-select {
            padding: 0.5rem 1rem;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            background: #FFFFFF;
            color: #1E293B;
            font-size: 0.9rem;
            outline: none;
            transition: all 0.3s ease;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%2364748B' width='18px' height='18px'%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            padding-right: 30px;
        }

        .sort-select:focus {
            border-color: #FFCE0A;
            box-shadow: 0 0 0 2px rgba(255, 206, 10, 0.1);
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .product-card {
            background: #FFFFFF;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(255, 206, 10, 0.12);
            transition: all 0.3s ease;
            position: relative;
            border: 1px solid #E2E8F0;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(255, 206, 10, 0.1);
        }

        .product-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background-color: #FFCE0A;
            color: #1E293B;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.3rem 0.6rem;
            border-radius: 20px;
            z-index: 2;
        }

        .product-image-container {
            height: 200px;
            width: 100%;
            background: #f3f4f6;
            position: relative;
            overflow: hidden;
        }

        .product-image {
            height: 100%;
            width: 100%;
            object-fit: contain;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .product-details {
            padding: 1.5rem;
        }

        .product-category {
            font-size: 0.8rem;
            color: #FFCE0A;
            font-weight: 500;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            line-height: 1.4;
            color: #1E293B;
        }

        .product-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 0.75rem;
            font-size: 0.85rem;
            color: #64748B;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .product-price {
            font-weight: 700;
            font-size: 1.2rem;
            color: #1E293B;
            margin: 1rem 0;
            display: flex;
            flex-direction: column; /* Change to column */
            align-items: flex-start; /* Align left */
            gap: 0.25rem; /* Reduce gap */
        }

        .price-original {
            text-decoration: line-through;
            color: #64748B;
            font-size: 0.9rem;
            font-weight: normal;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .price-discount {
            background-color: #FFF8E5;
            color: #966D00;
            padding: 0.2rem 0.5rem;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .product-buttons {
            display: flex;
            flex-direction: column; /* Retour à column au lieu de row */
            gap: 0.75rem;
            margin-top: 1.25rem;
        }

        .btn-cart, .btn-shop {
            width: 100%;
            padding: 0.75rem 1rem;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-cart {
            flex: 1;
            background: white;
            color: #1E293B;
            border: 2px solid #FFCE0A;
        }

        .btn-shop {
            flex: 2;
            background: #FFCE0A;
            color: #1E293B;
        }

        .btn-cart:hover {
            background: #FFF8E5;
            border-color: #FFD534;
        }

        .btn-shop:hover {
            background: #FFD534;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(255, 206, 10, 0.07);
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
            gap: 0.25rem;
        }

        .page-item {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            border: 1px solid #E2E8F0;
            background: #FFFFFF;
            color: #64748B;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .page-item:hover, .page-item.active {
            background: #FFCE0A;
            color: #1E293B;
            border-color: #FFCE0A;
        }

        .page-item.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .filters-mobile-btn {
            display: none;
            padding: 0.75rem 1.25rem;
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            cursor: pointer;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            font-weight: 500;
            color: #1E293B;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .filters-mobile-btn:hover {
            background: #F9FAFB;
        }

        .filters-close {
            display: none;
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #64748B;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            grid-column: 1 / -1;
        }

        .empty-state i {
            font-size: 3rem;
            color: #E2E8F0;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            color: #1E293B;
        }

        .empty-state p {
            color: #64748B;
            margin-bottom: 1.5rem;
        }

        .reset-filters {
            background: none;
            border: none;
            color: #FFCE0A;
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .reset-filters:hover {
            background: rgba(255, 206, 10, 0.05);
        }

        @media (max-width: 992px) {
            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .products-container {
                grid-template-columns: 1fr;
            }

            .filters {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 1000;
                overflow-y: auto;
                border-radius: 0;
                padding-top: 4rem;
            }

            .filters.active {
                display: block;
            }

            .filters-mobile-btn {
                display: flex;
            }

            .filters-close {
                display: block;
            }

            .products-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .products-sort {
                width: 100%;
            }

            .sort-select {
                flex-grow: 1;
            }
        }

        @media (max-width: 576px) {
            .page-header {
                padding: 2rem 1rem;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(100%, 1fr));
            }

            .product-buttons {
                flex-direction: column;
            }

            .pagination {
                flex-wrap: wrap;
                justify-content: center;
            }
        }

        /* Helper classes */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        .overlay.active {
            display: block;
        }
    </style>
</head>
<body>
    <?php include_once '../includes/nav.php'; ?>

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
                            <button class="btn-shop"><i class="fas fa-bolt"></i> Acheter</button>
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
                            <button class="btn-shop"><i class="fas fa-bolt"></i> Acheter</button>
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
                            <button class="btn-shop"><i class="fas fa-bolt"></i> Acheter</button>
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
                            <button class="btn-shop"><i class="fas fa-bolt"></i> Acheter</button>
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
                            <button class="btn-shop"><i class="fas fa-bolt"></i> Acheter</button>
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
                            <button class="btn-shop"><i class="fas fa-bolt"></i> Acheter</button>
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
                            <button class="btn-shop"><i class="fas fa-bolt"></i> Acheter</button>
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
                            <button class="btn-shop"><i class="fas fa-bolt"></i> Acheter</button>
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
                            <button class="btn-shop"><i class="fas fa-bolt"></i> Acheter</button>
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
                            <button class="btn-shop"><i class="fas fa-bolt"></i> Acheter</button>
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
                            <button class="btn-shop"><i class="fas fa-bolt"></i> Acheter</button>
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
                            <button class="btn-shop"><i class="fas fa-bolt"></i> Acheter</button>
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

    <script>
        const filtersBtn = document.querySelector('.filters-mobile-btn');
        const filters = document.querySelector('.filters');
        const filtersClose = document.querySelector('.filters-close');
        const overlay = document.querySelector('.overlay');

        filtersBtn.addEventListener('click', () => {
            filters.classList.add('active');
            overlay.classList.add('active');
        });

        filtersClose.addEventListener('click', () => {
            filters.classList.remove('active');
            overlay.classList.remove('active');
        });

        overlay.addEventListener('click', () => {
            filters.classList.remove('active');
            overlay.classList.remove('active');
        });
    </script>
<?php include_once '../includes/footer.php'; ?>
</body>
</html>