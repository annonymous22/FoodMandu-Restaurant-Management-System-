// Lightbox functionality
const galleryItems = document.querySelectorAll(".gallery-item img");
const lightbox = document.getElementById("lightbox");
const lightboxImg = lightbox.querySelector("img");
const closeLightbox = lightbox.querySelector(".close-lightbox");

galleryItems.forEach(item => {
    item.addEventListener("click", () => {
        lightbox.classList.add("active");
        lightboxImg.src = item.src;
    });
});

closeLightbox.addEventListener("click", () => {
    lightbox.classList.remove("active");
});

// Filters functionality
const filterBtns = document.querySelectorAll(".filter-btn");
const allItems = document.querySelectorAll(".gallery-item");

filterBtns.forEach(button => {
    button.addEventListener("click", () => {
        const filter = button.getAttribute("data-filter");
        allItems.forEach(item => {
            if (filter === "all" || item.classList.contains(filter)) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });
    });
});

// Pre-loader functionality
window.addEventListener("load", () => {
    document.querySelector(".loader").style.display = "none";
});
