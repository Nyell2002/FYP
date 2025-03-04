const cartBtn = document.getElementById("cart-btn");
const cartPopup = document.getElementById("cart-popup");
const closeCart = document.getElementById("close-cart");
const cartItemsContainer = document.getElementById("cart-items");

// Show the cart popup
cartBtn.addEventListener("click", () => {
  renderCart();
  cartPopup.style.display = "flex";
});

closeCart.addEventListener("click", () => {
  cartPopup.style.display = "none";
});

// Add item to the cart
function addToCart(item) {
  // Get existing cart from sessionStorage, or create an empty one if not found
  let cart = JSON.parse(sessionStorage.getItem("cart")) || [];

  // Add the new item to the cart
  cart.push(item);

  // Save the updated cart back to sessionStorage
  sessionStorage.setItem("cart", JSON.stringify(cart));

  alert(`${item.name} has been added to your cart!`);
}

// Render the cart
function renderCart() {
  // Get the cart from sessionStorage
  let cart = JSON.parse(sessionStorage.getItem("cart")) || [];

  if (cart.length === 0) {
    cartItemsContainer.innerHTML = "<p>Your cart is empty.</p>";
    return;
  }

  cartItemsContainer.innerHTML = ""; // Clear existing content

  cart.forEach((item, index) => {
    const cartItem = document.createElement("div");
    cartItem.className = "cart-item";

    cartItem.innerHTML = `
      <img src="${item.image}" alt="${item.name}" class="cart-item-image" />
      <div class="cart-item-details">
        <p>${item.name}</p>
        <p>MYR ${item.price.toFixed(2)}</p>
        <button class="remove-btn" data-index="${index}">&#128465;</button>
      </div>
    `;

    cartItemsContainer.appendChild(cartItem);
  });

  // Attach event listeners for remove buttons
  document.querySelectorAll(".remove-btn").forEach((button) => {
    button.addEventListener("click", (e) => {
      const index = parseInt(e.target.getAttribute("data-index"), 10);
      removeFromCart(index);
    });
  });
}

// Remove item from cart
function removeFromCart(index) {
  // Get cart from sessionStorage
  let cart = JSON.parse(sessionStorage.getItem("cart")) || [];

  // Remove the item at the specified index
  cart.splice(index, 1);

  // Save the updated cart to sessionStorage
  sessionStorage.setItem("cart", JSON.stringify(cart));

  renderCart(); // Re-render the cart
}

// Checkout button functionality
const checkoutBtn = document.getElementById("checkout-btn");

checkoutBtn.addEventListener("click", () => {
  // Get cart from sessionStorage
  let cart = JSON.parse(sessionStorage.getItem("cart")) || [];

  if (cart.length === 0) {
    alert("Your cart is empty!");
    return;
  }

  // Pass cart data as JSON in the URL query parameter
  const cartData = encodeURIComponent(JSON.stringify(cart));

  // Redirect to checkout page with cart data
  window.location.href = `checkout.html?cart=${cartData}`;
});

// Hide the cart popup if clicked outside of the cart content
cartPopup.addEventListener("click", (e) => {
  if (e.target === cartPopup) {
    cartPopup.style.display = "none";
  }
});
