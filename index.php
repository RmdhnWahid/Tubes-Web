<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FawnCoffee</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
  <?php
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'success') {
        echo "<script>
                alert('Pesan Anda berhasil dikirim!');
                window.history.replaceState({}, document.title, 'index.php');
              </script>";
    } elseif ($_GET['status'] == 'error') {
        echo "<script>
                alert('Maaf, terjadi kesalahan. Coba lagi!');
                window.history.replaceState({}, document.title, 'index.php');
              </script>";
    }
}
?>


    <!-- Navbar start -->
    <nav class="navbar">
      <a href="#" class="navbar-logo">Fawn<span>Coffee</span></a>

      <div class="navbar-nav">
        <a href="#home">Home</a>
        <a href="#about">Tentang Kami</a>
        <a href="#menu">Menu</a>
        <a href="#contact">Kontak</a>
      </div>

      <div class="navbar-extra">
        <a href="cart.php" id="shopping-cart"><i data-feather="shopping-cart"></i></a>
        <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
      </div>
    </nav>
    <!-- Navbar end -->

    <!-- Hero Section start -->
    <section class="hero" id="home">
      <main class="content">
        <h1>Mulai Hari dengan Rasa <span>Kopi</span> yang Sempurna.</h1>
        <a href="#menu" class="cta">Beli Sekarang</a>
      </main>
    </section>
    <!-- Hero Section end -->

    <!-- About Section start -->
    <section id="about" class="about">
      <h2><span>Tentang</span> Kami</h2>

      <div class="row">
        <div class="about-img">
          <img src="img/tentang-kami.jpg" alt="Tentang Kami" />
        </div>
        <div class="content">
          <h3>kenapa memilih kopi kami?</h3>
          <p>
            Kami menyajikan kopi terbaik dari biji pilihan yang diolah dengan
            teknik roasting presisi untuk menciptakan rasa yang kaya dan aroma
            memikat. Setiap cangkir diracik untuk memberikan pengalaman rasa
            yang tak terlupakan.
          </p>
          <p>
            Selain itu, kami mendukung pertanian berkelanjutan melalui kemitraan
            dengan petani lokal. Dengan memilih kopi kami, Anda menikmati cita
            rasa istimewa sambil berkontribusi pada kesejahteraan petani dan
            pelestarian lingkungan.
          </p>
        </div>
      </div>
    </section>
    <!-- About Section end -->

    <!-- Menu Section start -->
    <section id="menu" class="menu">
      <h2><span>Menu</span> Kami</h2>
      <p>
        Nikmati beragam pilihan kopi istimewa, mulai dari seduhan klasik hingga
        kreasi modern yang memanjakan lidah.
      </p>

      <div class="row">
      <div class="menu-card" onclick="addToCart('Espresso', 'IDR 15K')">
          <img src="img/menu/1.jpg" alt="Espresso" class="menu-card-img" />
          <h3 class="menu-card-title">- Espresso -</h3>
          <p class="menu-card-price">IDR 15K</p>
        </div>
        <div class="menu-card" onclick="addToCart('Americano', 'IDR 15K')">
          <img src="img/menu/2.jpg" alt="Americano" class="menu-card-img" />
          <h3 class="menu-card-title">- Americano -</h3>
          <p class="menu-card-price">IDR 15K</p>
        </div>
        <div class="menu-card" onclick="addToCart('Cappucino', 'IDR 18K')">
          <img src="img/menu/3.jpg" alt="Cappucino" class="menu-card-img" />
          <h3 class="menu-card-title">- Cappucino -</h3>
          <p class="menu-card-price">IDR 18K</p>
        </div>
        <div class="menu-card" onclick="addToCart('Cafe Latte', 'IDR 18K')">
          <img src="img/menu/4.jpg" alt="Cafe Latte" class="menu-card-img" />
          <h3 class="menu-card-title">- Cafe Latte -</h3>
          <p class="menu-card-price">IDR 18K</p>
        </div>
        <div class="menu-card" onclick="addToCart('Mocha', 'IDR 24K')">
          <img src="img/menu/5.jpg" alt="Mocha" class="menu-card-img" />
          <h3 class="menu-card-title">- Mocha -</h3>
          <p class="menu-card-price">IDR 24K</p>
        </div>
        <div class="menu-card" onclick="addToCart('Flat White', 'IDR 18K')">
          <img src="img/menu/6.jpg" alt="Flat White" class="menu-card-img" />
          <h3 class="menu-card-title">- Flat White -</h3>
          <p class="menu-card-price">IDR 18K</p>
        </div>
      </div>
    </section>
    <!-- Menu Section end -->

    <!-- Contact Section start -->
    <section id="contact" class="contact">
      <h2><span>Kontak</span> Kami</h2>
      <p>
        Kami siap mendengar Anda! Untuk pertanyaan, saran, atau informasi lebih
        lanjut tentang produk dan layanan kami, jangan ragu untuk menghubungi
        kami.
      </p>

      <div class="row">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d254332.90805976195!2d119.40262754999998!3d-5.111489499999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee329d96c4671%3A0x3030bfbcaf770b0!2sMakassar%2C%20Kota%20Makassar%2C%20Sulawesi%20Selatan!5e0!3m2!1sid!2sid!4v1734431018086!5m2!1sid!2sid"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          class="map"
        ></iframe>

        <form action="send_message.php" method="POST">
  <div class="input-group">
    <i data-feather="user"></i>
    <input type="text" name="name" placeholder="Nama Anda" required />
  </div>
  <div class="input-group">
    <i data-feather="mail"></i>
    <input type="email" name="email" placeholder="Email Anda" required />
  </div>
  <div class="input-group">
    <i data-feather="message-square"></i>
    <input type="text" name="message" placeholder="Pesan Anda" rows="5" required /> 
  </div>
  <button type="submit" class="btn">Kirim Pesan</button>
</form>

      </div>
    </section>
    <!-- Contact Section end -->

    <!-- Footer start -->
    <footer>
      <div class="socials">
        <a href="https://www.instagram.com/rmdhn_wahid">
          <i data-feather="instagram"></i>
        </a>
        <a href="https://www.twitter.com/">
          <i data-feather="twitter"></i>
        </a>
        <a href="https://www.facebook.com/Aw">
          <i data-feather="facebook"></i>
        </a>
      </div>

      <div class="links">
        <a href="#home">Home</a>
        <a href="#about">Tentang Kami</a>
        <a href="#menu">Menu</a>
        <a href="#contact">Kontak</a>
      </div>

      <div class="credit">
        <p>Creater by <a href="">Abdul Wahid</a>. | &copy; 2024.</p>
      </div>
    </footer>
    <!-- Footer end -->

    <!-- Feather Icons -->
    <script>
      feather.replace();
    </script>

    <!-- Javascript -->
    <script src="js/script.js"></script>
  </body>
</html>
