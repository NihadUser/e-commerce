var priceRange = document.getElementById("priceRange");
var minPrice = document.getElementById("minPrice");
var maxPrice = document.getElementById("maxPrice");
var thumb = document.querySelector(".slider-thumb");

priceRange.addEventListener("input", function () {
  var value = parseInt(priceRange.value);
  var min = parseInt(priceRange.min);
  var max = parseInt(priceRange.max);
  var thumbPosition = ((value - min) / (max - min)) * 100;

  thumb.style.left = thumbPosition + "%";
  minPrice.textContent = "$" + value;
});

// Update thumb position and price values on page load
var value = parseInt(priceRange.value);
var min = parseInt(priceRange.min);
var max = parseInt(priceRange.max);
var thumbPosition = ((value - min) / (max - min)) * 100;
thumb.style.left = thumbPosition + "%";
minPrice.textContent = value;
maxPrice.textContent = max;
