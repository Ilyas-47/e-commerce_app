<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Produits</title>
    <style>
        :root {
            --primary-color: #FFCE0A;
            --secondary-color: #ffd840;
            --background: #f8f9fa;
            --text: #2A2A2A;
            --shadow: 0 4px 6px rgba(255, 206, 10, 0.15);
        }

        .products-container {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 2rem;
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .filters {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: var(--shadow);
        }

        .filter-group {
            margin-bottom: 1.5rem;
        }

        .filter-group h3 {
            color: var(--text);
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .filter-options {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .filter-checkbox {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .price-range {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .price-inputs {
            display: flex;
            gap: 1rem;
        }

        .price-input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .filter-select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: white;
            color: var(--text);
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
        }

        .product-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            height: 200px;
            width: 100%;
            object-fit: contain;
            background: #f8f9fa;
        }

        .product-details {
            padding: 1rem;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .product-price {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 1.2rem;
        }

        .product-buttons {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .btn-cart, .btn-shop {
            padding: 0.8rem;
            width: 100%;
            border: none;
            border-radius: 4px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-cart {
            background: white;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .btn-shop {
            background: var(--primary-color);
            color: var(--text);
        }

        .btn-cart:hover, .btn-shop:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .filters-mobile-btn {
            display: none;
            margin-bottom: 1rem;
            padding: 0.5rem 1rem;
            background: var(--primary-color);
            border: none;
            border-radius: 4px;
            cursor: pointer;
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
            }

            .filters.active {
                display: block;
            }

            .filters-mobile-btn {
                display: block;
            }
        }
    </style>
</head>
<body>
    <?php include_once '../includes/nav.php'; ?>

    <div class="products-container">
        <button class="filters-mobile-btn">Filtres ☰</button>
        
        <aside class="filters">
            <div class="filter-group">
                <h3>Catégories</h3>
                <div class="filter-options">
                    <label class="filter-checkbox">
                        <input type="checkbox" name="category" value="office"> Microsoft Office
                    </label>
                    <label class="filter-checkbox">
                        <input type="checkbox" name="category" value="windows"> Windows
                    </label>
                    <label class="filter-checkbox">
                        <input type="checkbox" name="category" value="antivirus"> Antivirus
                    </label>
                </div>
            </div>

            <div class="filter-group">
                <h3>Prix</h3>
                <div class="price-range">
                    <div class="price-inputs">
                        <input type="number" class="price-input" placeholder="Min" min="0">
                        <input type="number" class="price-input" placeholder="Max" min="0">
                    </div>
                    <button class="apply-price">Appliquer</button>
                </div>
            </div>

            <div class="filter-group">
                <h3>Version du système</h3>
                <select class="filter-select" name="system">
                    <option value="">Toutes les versions</option>
                    <option value="windows10">Windows 10</option>
                    <option value="windows11">Windows 11</option>
                    <option value="mac">MacOS</option>
                </select>
            </div>

            <div class="filter-group">
                <h3>Année d'édition</h3>
                <select class="filter-select" name="year">
                    <option value="">Toutes les années</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                </select>
            </div>
        </aside>

        <main class="products-grid">
            <?php for($i = 1; $i <= 9; $i++): ?>
            <div class="product-card" 
                data-category="office" 
                data-price="149.99"
                data-system="windows11"
                data-year="2024">
                <img src="../assets/images/office.png" alt="Product" class="product-image">
                <div class="product-details">
                    <h3 class="product-title">Microsoft Office 2024</h3>
                    <div class="product-price">149.99 MAD</div>
                    <div class="product-buttons">
                        <button class="btn-cart">Add to Cart</button>
                        <button class="btn-shop">Shop Now</button>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </main>
    </div>

    <?php include_once '../includes/footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filters = document.querySelector('.filters');
            const filterBtn = document.querySelector('.filters-mobile-btn');
            const products = document.querySelectorAll('.product-card');
            const categoryFilters = document.querySelectorAll('input[name="category"]');
            const priceInputs = document.querySelectorAll('.price-input');
            const applyPriceBtn = document.querySelector('.apply-price');
            const systemSelect = document.querySelector('select[name="system"]');
            const yearSelect = document.querySelector('select[name="year"]');

            // Mobile filters toggle
            filterBtn.addEventListener('click', () => {
                filters.classList.toggle('active');
            });

            // Filtering function
            function filterProducts() {
                const selectedCategories = Array.from(categoryFilters)
                    .filter(input => input.checked)
                    .map(input => input.value);
                
                const minPrice = parseFloat(priceInputs[0].value) || 0;
                const maxPrice = parseFloat(priceInputs[1].value) || Infinity;
                const selectedSystem = systemSelect.value;
                const selectedYear = yearSelect.value;

                products.forEach(product => {
                    const price = parseFloat(product.dataset.price);
                    const category = product.dataset.category;
                    const system = product.dataset.system;
                    const year = product.dataset.year;
                    
                    const matchesCategory = selectedCategories.length === 0 || 
                                         selectedCategories.includes(category);
                    const matchesPrice = price >= minPrice && price <= maxPrice;
                    const matchesSystem = !selectedSystem || system === selectedSystem;
                    const matchesYear = !selectedYear || year === selectedYear;

                    if (matchesCategory && matchesPrice && matchesSystem && matchesYear) {
                        product.style.display = 'block';
                    } else {
                        product.style.display = 'none';
                    }
                });
            }

            // Event listeners
            categoryFilters.forEach(input => {
                input.addEventListener('change', filterProducts);
            });

            applyPriceBtn.addEventListener('click', filterProducts);
            systemSelect.addEventListener('change', filterProducts);
            yearSelect.addEventListener('change', filterProducts);
        });
    </script>
</body>
</html>
