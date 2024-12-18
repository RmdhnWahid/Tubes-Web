// Toggle class active
const navbarNav = document.querySelector(".navbar-nav");
// ketika hamburger menu di klik
document.querySelector("#hamburger-menu").onclick = () => {
  navbarNav.classList.toggle("active");
};

// Klik di luar sidebar untuk menghilangkan nav
const hamburger = document.querySelector("#hamburger-menu");

document.addEventListener("click", function (e) {
  if (!hamburger.contains(e.target) && !navbarNav.contains(e.target)) {
    navbarNav.classList.remove("active");
  }
});

// Array untuk menyimpan cart
let cart = [];

// Fungsi menambahkan item ke cart
function addToCart(itemName, itemPrice) {
  cart.push({ name: itemName, price: itemPrice });
  alert(`${itemName} telah ditambahkan ke keranjang!`);
  console.log("keranjang saat ini:", cart);
}

function addToCart(itemName, itemPrice) {
  fetch("cart_handler.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ name: itemName, price: itemPrice }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        alert(`${itemName} telah ditambahkan ke keranjang!`);
      } else {
        alert("Gagal menambahkan item ke keranjang.");
      }
    });
}
