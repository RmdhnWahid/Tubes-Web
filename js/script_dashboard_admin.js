// Menangani navigasi sidebar
document.querySelectorAll(".menu-link").forEach((link) => {
  link.addEventListener("click", function (e) {
    e.preventDefault();
    const targetSection = this.getAttribute("href").substring(1);
    document.querySelectorAll(".section").forEach((section) => {
      section.classList.remove("active");
    });
    document.getElementById(targetSection).classList.add("active");
  });
});

// Fungsi untuk membaca file gambar
function readImage(input, callback) {
  const file = input.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      callback(e.target.result);
    };
    reader.readAsDataURL(file);
  }
}

// Fungsi CRUD Hero Section
document.getElementById("heroForm").addEventListener("submit", function (e) {
  e.preventDefault();
  const description = document.getElementById("heroDescription").value;
  readImage(document.getElementById("heroImage"), (imageData) => {
    localStorage.setItem(
      "hero",
      JSON.stringify({ image: imageData, description })
    );
    renderPreview("hero", "heroPreview");
  });
});

// Fungsi CRUD About Section
document.getElementById("aboutForm").addEventListener("submit", function (e) {
  e.preventDefault();
  const description = document.getElementById("aboutDescription").value;
  readImage(document.getElementById("aboutImage"), (imageData) => {
    localStorage.setItem(
      "about",
      JSON.stringify({ image: imageData, description })
    );
    renderPreview("about", "aboutPreview");
  });
});

// Fungsi CRUD Menu Section
document.getElementById("menuForm").addEventListener("submit", function (e) {
  e.preventDefault();
  const description = document.getElementById("menuDescription").value;
  readImage(document.getElementById("menuImage"), (imageData) => {
    const menus = JSON.parse(localStorage.getItem("menu")) || [];
    menus.push({ image: imageData, description });
    localStorage.setItem("menu", JSON.stringify(menus));
    renderMenu();
  });
});

// Render Preview untuk Hero & About Section
function renderPreview(key, previewId) {
  const data = JSON.parse(localStorage.getItem(key)) || {};
  const previewDiv = document.getElementById(previewId);
  previewDiv.innerHTML = data.image
    ? `<img src="${data.image}"><p>${data.description}</p>`
    : "";
}

// Render Menu Section
function renderMenu() {
  const menus = JSON.parse(localStorage.getItem("menu")) || [];
  const previewDiv = document.getElementById("menuPreview");
  previewDiv.innerHTML = menus
    .map(
      (item, index) => `
        <div>
            <img src="${item.image}" alt="Menu">
            <p>${item.description}</p>
            <button onclick="deleteMenu(${index})">Hapus</button>
        </div>
    `
    )
    .join("");
}

function deleteMenu(index) {
  const menus = JSON.parse(localStorage.getItem("menu")) || [];
  menus.splice(index, 1);
  localStorage.setItem("menu", JSON.stringify(menus));
  renderMenu();
}

// Render Semua Data Saat Dimuat
renderPreview("hero", "heroPreview");
renderPreview("about", "aboutPreview");
renderMenu();
