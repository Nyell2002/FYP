document.addEventListener("DOMContentLoaded", () => {
  const ctaBtn = document.getElementById("cta"); // Button to trigger popup
  const popupContainer = document.getElementById("popup-container");
  const closePopupBtn = document.getElementById("close-popup-btn");

  // Show the popup when "Wanna Doffee?" is clicked
  ctaBtn.addEventListener("click", (e) => {
    e.preventDefault(); // Prevent default link behavior
    popupContainer.style.display = "flex"; // Show popup
  });

  // Close the popup when "Close" is clicked
  closePopupBtn.addEventListener("click", () => {
    popupContainer.style.display = "none";
  });

  // Close the popup when clicking outside the popup content
  popupContainer.addEventListener("click", (e) => {
    if (e.target === popupContainer) {
      popupContainer.style.display = "none";
    }
  });
});
