<?php
session_start();
include 'db_fawncoffee.php'; 

// Variable untuk pesan
$successMessage = "";
$errorMessage = "";

// Cek jika form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input
    $username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : null;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : null;
    $confirmPassword = isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : null;

    // Periksa apakah input tidak kosong
    if ($username && $password && $password === $confirmPassword) {
        
        // Cek apakah username sudah ada di database
        $checkUserQuery = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $checkUserQuery);

        if (mysqli_num_rows($result) > 0) {
            // Username sudah ada
            $errorMessage = "Username sudah digunakan. Silakan pilih username lain.";
        } else {
            // Hash password
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);

            // Default role untuk user baru
            $role = 'user';

            // Simpan data ke database
            $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password_hashed', '$role')";

            if (mysqli_query($conn, $sql)) {
                $successMessage = "Registrasi berhasil! Selamat datang, $username.";
            } else {
                $errorMessage = "Terjadi kesalahan: " . mysqli_error($conn);
            }
        }
    } else {
        $errorMessage = "Password tidak cocok atau data tidak lengkap!";
    }

    // Tutup koneksi database
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registrasi - FawnCoffee</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />

    <!-- Style -->
    <link rel="stylesheet" href="css/style_login.css" />
    <script>
      // Fungsi untuk menampilkan pesan keberhasilan atau kegagalan
      window.onload = function () {
          const successMessage = "<?php echo $successMessage; ?>";
          const errorMessage = "<?php echo $errorMessage; ?>";

          if (successMessage) {
              document.getElementById("register-message").innerText = successMessage;
              // Alihkan ke index.php setelah 2 detik
              setTimeout(() => {
                  window.location.href = "index.php";
              }, 2000);
          } else if (errorMessage) {
              document.getElementById("error-message").innerText = errorMessage;
          }
      };
    </script>
  </head>
  <body>
    <!-- Form Register start -->
    <div class="login-container">
      <h2>Registrasi</h2>
      <form action="register.php" method="POST">
        <div class="input-group">
          <label for="regUsername">Username</label>
          <input
            type="text"
            id="regUsername"
            name="username"
            placeholder="Masukkan username"
            required
          />
        </div>
        <div class="input-group">
          <label for="regPassword">Password</label>
          <input
            type="password"
            id="regPassword"
            name="password"
            placeholder="Masukkan password"
            required
          />
        </div>
        <div class="input-group">
          <label for="confirmPassword">Konfirmasi Password</label>
          <input
            type="password"
            id="confirmPassword"
            name="confirmPassword"
            placeholder="Ulangi password"
            required
          />
        </div>
        <button type="submit">Daftar</button>
      </form>

      <p id="register-message" style="color: green"></p>
      <p id="error-message" style="color: red"></p>
      <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>
    <!-- Form Register end -->

  </body>
</html>
