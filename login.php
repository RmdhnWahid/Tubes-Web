<?php
// login.php

// Hubungkan ke database
require 'db_fawncoffee.php';

$error_message = ""; // Variabel untuk pesan error
$remembered_username = ""; // Variabel untuk mengisi input username

// Periksa jika cookie 'remember_username' ada
if (isset($_COOKIE['remember_username'])) {
    $remembered_username = $_COOKIE['remember_username'];
}

// Proses login jika form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rememberMe = isset($_POST['rememberMe']); 

    // Lindungi dari SQL Injection
    $username = mysqli_real_escape_string($conn, $username);

    // Query untuk mengambil password yang di-*hash* dan role pengguna
    $sql = "SELECT password, role FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];
        $role = $row['role']; // Ambil role pengguna

        // Verifikasi password dengan password_verify
        if (password_verify($password, $hashed_password)) {
            // Jika "Remember Me" dicentang, simpan username dalam cookie
            if ($rememberMe) {
                setcookie("remember_username", $username, time() + (7 * 24 * 60 * 60), "/"); // Berlaku 7 hari
            } else {
                // Jika tidak dicentang, hapus cookie
                setcookie("remember_username", "", time() - 3600, "/");
            }

            // Cek role pengguna
            if ($role === 'admin') {
                // Jika role admin, alihkan ke dashboard_admin.php
                header("Location: dashboard_admin.php");
                exit();
            } else {
                // Jika role bukan admin, alihkan ke dashboard_user.php
                header("Location: index.php");
                exit();
            }
        } else {
            $error_message = "Password salah.";
        }
    } else {
        $error_message = "Username tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - FawnCoffee</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <!-- Style -->
    <link rel="stylesheet" href="css/style_login.css" />
  </head>
  <body>
    <!-- Form Login start -->
    <div class="login-container">
      <h2>Login</h2>
      <form method="POST" action="login.php">
        <div class="input-group">
          <label for="username">Username</label>
          <input
            type="text"
            id="username"
            name="username"
            placeholder="Masukkan username"
            value="<?php echo htmlspecialchars($remembered_username); ?>" 
            required
          />
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Masukkan password"
            required
          />
        </div>
        <div class="input-group remember-me">
          <input type="checkbox" id="rememberMe" name="rememberMe" 
            <?php echo $remembered_username ? 'checked' : ''; ?> />
          <label for="rememberMe">Ingat Saya</label>
        </div>
        <button type="submit">Login</button>
      </form>
      <!-- Pesan error tampil di sini -->
      <p id="error-message" style="color: red"><?php echo $error_message; ?></p>
      <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </div>
    <!-- Form Login end -->
  </body>
</html>
