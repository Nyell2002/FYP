// GET MODAL ELEMENTS
const modal = document.getElementById("imageModal");
const modalImg = document.getElementById("modalImage");
const modalDescription = document.getElementById("modalDescription");
const closeBtn = document.querySelector(".close");

// Add click event listeners to images
const images = document.querySelectorAll(".card-img");
images.forEach((image) => {
  image.addEventListener("click", () => {
    modal.style.display = "block";
    modalImg.src = image.src;
    modalDescription.innerHTML = image.getAttribute("data-description");
  });
});

// Close the modal when clicking the close button
closeBtn.addEventListener("click", () => {
  modal.style.display = "none";
});

// Close the modal when clicking outside the image or description
modal.addEventListener("click", (e) => {
  if (e.target === modal) {
    modal.style.display = "none";
  }
});
