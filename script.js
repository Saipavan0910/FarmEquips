// script.js

// Initialize cart items from localStorage or an empty array
let cartItems = JSON.parse(localStorage.getItem('cart')) || [];

function addToCart(itemName, itemPrice) {
    // Check if the item is already in the cart
    const existingItem = cartItems.find(item => item.name === itemName);

    if (existingItem) {
        // If the item is already in the cart, increase the quantity
        existingItem.quantity += 1;
    } else {
        // If the item is not in the cart, add it with quantity 1
        cartItems.push({
            name: itemName,
            price: itemPrice,
            quantity: 1
        });
        // updateCart();
        // updateLocalStorage();
    }

    // Store the updated cartItems in localStorage
    localStorage.setItem('cart', JSON.stringify(cartItems));

    // Navigate to the cart page
    window.location.href = './cart.html';
}

function updateCart() {
    const cartBody = document.getElementById('cart');
    const totalAmountElement = document.getElementById('totalAmount');

    // Clear the existing cart content
    cartBody.innerHTML = '';

    // Iterate through the cart items and display them in the cart table
    cartItems.forEach(item => {
        const cartRow = document.createElement('tr');
        cartRow.innerHTML = `
            <td>${item.name}</td>
            <td>₹${item.price}</td>
            <td>
                <button onclick="decreaseQuantity('${item.name}')">-</button>
                ${item.quantity}
                <button onclick="increaseQuantity('${item.name}')">+</button>
            </td>
            <td>₹${item.price * item.quantity}</td>
            <td><button onclick="removeItem('${item.name}')">Remove</button></td>
        `;

        cartBody.appendChild(cartRow);
    });

    // Calculate and display the total amount
    const totalAmount = cartItems.reduce((total, item) => total + item.price * item.quantity, 0);

    const submitvalue = document.getElementById("submit-btn").value=totalAmount;

    const banksubmit = document.getElementById("submit-bank").value=totalAmount;

    
    totalAmountElement.innerText = totalAmount;

    console.log("total amt", totalAmount)
    
    

}

function clearCart() {
    cartItems = [];
    updateCart();
    updateLocalStorage();
}

function increaseQuantity(itemName) {
    const item = cartItems.find(item => item.name === itemName);
    if (item) {
        item.quantity += 1;
    }
    updateCart();
    updateLocalStorage();
}

function decreaseQuantity(itemName) {
    const item = cartItems.find(item => item.name === itemName);
    if (item && item.quantity > 1) {
        item.quantity -= 1;
    }
    updateCart();
    updateLocalStorage();
}

function removeItem(itemName) {
    cartItems = cartItems.filter(item => item.name !== itemName);
    updateCart();
    updateLocalStorage();
}

function updateLocalStorage() {
    localStorage.setItem('cart', JSON.stringify(cartItems));
}

updateCart();