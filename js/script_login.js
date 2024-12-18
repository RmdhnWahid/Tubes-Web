document
  .getElementById("loginForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    const errorMessage = document.getElementById("error-message");
  });

// Fungsi untuk mengatur cookies
function setCookie(name, value, days) {
  const date = new Date();
  date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
  document.cookie = `${name}=${value};expires=${date.toUTCString()};path=/`;
}

function getCookie(name) {
  const cookies = document.cookie.split("; ");
  for (let cookie of cookies) {
    const [key, value] = cookie.split("=");
    if (key === name) return value;
  }
  return null;
}

// Halaman Login
if (document.getElementById("loginForm")) {
  document.addEventListener("DOMContentLoaded", () => {
    const usernameInput = document.getElementById("username");
    const rememberMeCheckbox = document.getElementById("rememberMe");
    const savedUsername = getCookie("username");

    if (savedUsername) {
      usernameInput.value = savedUsername;
      rememberMeCheckbox.checked = true;
    }
  });

  document
    .getElementById("loginForm")
    .addEventListener("submit", function (event) {
      event.preventDefault();

      const username = document.getElementById("username").value;
      const password = document.getElementById("password").value;
      const rememberMe = document.getElementById("rememberMe").checked;

      const storedUsers = JSON.parse(localStorage.getItem("users")) || [];
      const user = storedUsers.find(
        (u) => u.username === username && u.password === password
      );

      if (user) {
        if (rememberMe) {
          setCookie("username", username, 7); 
        } else {
          setCookie("username", "", -1); 
        }
        alert("Login berhasil! Selamat datang, " + username);
        window.location.href = "dashboard_admin.html";
      } else {
        document.getElementById("error-message").textContent =
          "Username atau password salah!";
      }
    });
}

// Halaman Registrasi
if (document.getElementById("registerForm")) {
  document
    .getElementById("registerForm")
    .addEventListener("submit", function (event) {
      event.preventDefault();

      const username = document.getElementById("regUsername").value;
      const password = document.getElementById("regPassword").value;
      const confirmPassword = document.getElementById("confirmPassword").value;
      const errorMessage = document.getElementById("error-message");
      const successMessage = document.getElementById("register-message");

      // Reset pesan error
      errorMessage.textContent = "";
      successMessage.textContent = "";

      if (password !== confirmPassword) {
        errorMessage.textContent =
          "Password dan Konfirmasi Password tidak cocok!";
        return;
      }

      const storedUsers = JSON.parse(localStorage.getItem("users")) || [];
      if (storedUsers.find((u) => u.username === username)) {
        errorMessage.textContent = "Username sudah terdaftar!";
      } else {
        storedUsers.push({ username, password });
        localStorage.setItem("users", JSON.stringify(storedUsers));
        successMessage.textContent = "Registrasi berhasil! Silakan login.";
        document.getElementById("registerForm").reset();
      }
    });
}
