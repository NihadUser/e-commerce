const icon = document.getElementById("basket");
const basketBack = document.getElementById("basket1");
const basket = document.getElementById("basket2");
const colse = document.getElementById("close");
icon.addEventListener("click", (event) => {
  basketBack.classList.add("active2");
});
basketBack.addEventListener("click", () => {
  basketBack.classList.remove("active2");
});
basket.addEventListener("click", (e) => {
  e.stopPropagation();
});
colse.addEventListener("click", () => {
  basketBack.classList.remove("active2");
});
