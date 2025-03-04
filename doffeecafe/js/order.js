const urlParams = new URLSearchParams(window.location.search);
const cartData = urlParams.get("cart");

let cart = [];
if (cartData) {
  try {
    cart = JSON.parse(decodeURIComponent(cartData));
  } catch (error) {
    console.error("Error parsing cart data:", error);
  }
}

const cartSummaryContainer = document.getElementById("cart-summary");
const subtotalElement = document.getElementById("subtotal");
const shippingElement = document.getElementById("shipping");
const totalElement = document.getElementById("total");

const shippingCost = 5.0;

function renderCartSummary() {
  if (cart.length === 0) {
    cartSummaryContainer.innerHTML = "<p>Your cart is empty.</p>";
    subtotalElement.textContent = "RM 0.00";
    shippingElement.textContent = "RM 0.00";
    totalElement.textContent = "RM 0.00";
    return;
  }

  let subtotal = 0;
  cartSummaryContainer.innerHTML = cart
    .map((item) => {
      subtotal += item.price * (item.quantity || 1);
      return `
        <div class="cart-item">
          <p>${item.name} x ${item.quantity || 1}</p>
          <p>RM ${item.price.toFixed(2)}</p>
        </div>
      `;
    })
    .join("");

  // Update the order summary
  subtotalElement.textContent = `RM ${subtotal.toFixed(2)}`;
  shippingElement.textContent = `RM ${shippingCost.toFixed(2)}`;
  totalElement.textContent = `RM ${(subtotal + shippingCost).toFixed(2)}`;
}

// Initialize cart summary rendering
renderCartSummary();

// Payment display (show respective forms based on selected payment method)
function showPaymentForm(paymentMethod) {
  // Hide all payment forms
  document.getElementById("credit-card-form").style.display = "none";
  document.getElementById("qr-code-form").style.display = "none";

  // Show the selected payment form
  if (paymentMethod === "credit-card") {
    document.getElementById("credit-card-form").style.display = "block";
  } else if (paymentMethod === "qr-code") {
    document.getElementById("qr-code-form").style.display = "block";
  }
}

// Add event listener to the form submission
document
  .getElementById("checkout-form")
  .addEventListener("submit", function (e) {
    // Prevent form submission until cart data is added
    e.preventDefault();

    // Set cart data in the hidden input field
    document.getElementById("cart-data").value = JSON.stringify(cart);

    // Now submit the form
    this.submit();
  });
