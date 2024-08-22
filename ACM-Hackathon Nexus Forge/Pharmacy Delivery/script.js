let cart = [];

        function addToCart(product, price, quantity) {
            quantity = parseInt(quantity);
            const existingProduct = cart.find(item => item.product === product);
            if (existingProduct) {
                existingProduct.quantity += quantity;
                existingProduct.total = existingProduct.quantity * existingProduct.price;
            } else {
                cart.push({ product, price, quantity, total: price * quantity });
            }
        }

        function openCart() {
            const cartModal = document.getElementById('cartModal');
            cartModal.style.display = 'block';
            renderCartItems();
        }


function closeCart() {
            const cartModal = document.getElementById('cartModal');
            cartModal.style.display = 'none';
        }

        function renderCartItems() {
            const cartItems = document.getElementById('cartItems');
            cartItems.innerHTML = '';
            let totalAmount = 0;
            cart.forEach((item, index) => {
                totalAmount += item.total;
                cartItems.innerHTML += `
                    <tr>
                        <td>${item.product}</td>
                        <td>$${item.price}</td>
                        <td>
                            <input type="number" value="${item.quantity}" min="1" onchange="updateQuantity(${index}, this.value)">
                        </td>
                        <td>$${item.total}</td>
                        <td><button onclick="removeFromCart(${index})">Remove</button></td>
                    </tr>
                `;
            });
            document.getElementById('totalAmount').textContent = totalAmount;
        }

        function updateQuantity(index, quantity) {
            quantity = parseInt(quantity);
            const item = cart[index];
            item.quantity = quantity;
            item.total = item.quantity * item.price;
            renderCartItems();
        }

        function removeFromCart(index) {
            cart.splice(index, 1);
            renderCartItems();
        }

        function showFileName() {
            const fileInput = document.getElementById('prescriptionInput');
            const fileLabel = document.getElementById('fileLabel');
            fileLabel.textContent = `Selected file: ${fileInput.files[0].name}`;
        }

        
  
    document.getElementById('openPopupBtn').addEventListener('click', function() {
        document.getElementById('popupForm').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
    });

    document.getElementById('closePopupBtn').addEventListener('click', function() {
        document.getElementById('popupForm').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    });

    document.getElementById('overlay').addEventListener('click', function() {
        document.getElementById('popupForm').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    });