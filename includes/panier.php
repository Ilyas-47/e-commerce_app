<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f7f7f7;
        }

        .cart-container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #eee;
        }

        .cart-header h1 {
            color: #333;
            font-size: 24px;
        }

        .cart-items {
            margin-top: 20px;
        }

        .cart-item {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            display: grid;
            grid-template-columns: 100px 2fr 1fr 1fr 50px;
            align-items: center;
            gap: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }

        .cart-item:hover {
            transform: translateY(-2px);
        }

        .item-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }

        .item-details h3 {
            color: #333;
            margin-bottom: 5px;
        }

        .item-details p {
            color: #666;
            font-size: 14px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-btn {
            background: #f0f0f0;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            transition: 0.3s;
        }

        .quantity-btn:hover {
            background: #e0e0e0;
        }

        .quantity {
            font-size: 16px;
            font-weight: 600;
        }

        .price {
            font-weight: 600;
            color: #2c3e50;
        }

        .remove-btn {
            background: none;
            border: none;
            color: #e74c3c;
            cursor: pointer;
        }

        .cart-summary {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .total {
            font-size: 20px;
            font-weight: 600;
            color: #2c3e50;
        }

        .checkout-btn {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 20px;
        }

        .checkout-btn:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <?php include('../includes/header.php') ?>

    <div class="cart-container">
        <div class="cart-header">
            <h1>Shopping Cart</h1>
            <span class="items-count">3 Items</span>
        </div>

        <div class="cart-items">
            <!-- Cart items will be dynamically added here -->
        </div>

        <div class="cart-summary">
            <div class="summary-row">
                <span>Subtotal</span>
                <span id="subtotal">$0.00</span>
            </div>
            <div class="summary-row">
                <span>Shipping</span>
                <span>$5.99</span>
            </div>
            <div class="summary-row total">
                <span>Total</span>
                <span id="total">$0.00</span>
            </div>
            <button class="checkout-btn">Proceed to Checkout</button>
        </div>
    </div>

    <script>
        // Sample cart data
        const cartItems = [
            {
                id: 1,
                name: "Product 1",
                price: 29.99,
                image: "path/to/image1.jpg",
                quantity: 1
            },
            {
                id: 2,
                name: "Product 2",
                price: 39.99,
                image: "path/to/image2.jpg",
                quantity: 1
            }
        ];

        // Render cart items
        function renderCart() {
            const cartContainer = document.querySelector('.cart-items');
            cartContainer.innerHTML = '';

            cartItems.forEach(item => {
                const itemElement = document.createElement('div');
                itemElement.className = 'cart-item';
                itemElement.innerHTML = `
                    <img src="${item.image}" alt="${item.name}" class="item-image">
                    <div class="item-details">
                        <h3>${item.name}</h3>
                        <p>Product description</p>
                    </div>
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="updateQuantity(${item.id}, -1)">-</button>
                        <span class="quantity">${item.quantity}</span>
                        <button class="quantity-btn" onclick="updateQuantity(${item.id}, 1)">+</button>
                    </div>
                    <span class="price">$${(item.price * item.quantity).toFixed(2)}</span>
                    <button class="remove-btn" onclick="removeItem(${item.id})">×</button>
                `;
                cartContainer.appendChild(itemElement);
            });

            updateTotals();
        }

        // Update quantity
        function updateQuantity(itemId, change) {
            const item = cartItems.find(item => item.id === itemId);
            if (item) {
                item.quantity = Math.max(1, item.quantity + change);
                renderCart();
            }
        }

        // Remove item
        function removeItem(itemId) {
            const index = cartItems.findIndex(item => item.id === itemId);
            if (index > -1) {
                cartItems.splice(index, 1);
                renderCart();
            }
        }

        // Update totals
        function updateTotals() {
            const subtotal = cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const shipping = 5.99;
            const total = subtotal + shipping;

            document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('total').textContent = `$${total.toFixed(2)}`;
        }

        // Initial render
        renderCart();
    </script>

    <?php include('../includes/script.php') ?>
</body>
</html>