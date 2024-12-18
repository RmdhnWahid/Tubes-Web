<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $to = "ramanimers22@gmail.com"; // Ganti dengan email Anda
    $subject = "Pesan Baru dari Kontak Website";
    $body = "Nama: $name\nEmail: $email\nPesan:\n$message";
    $headers = "From: $email";

    // Kirim email
    if (mail($to, $subject, $body, $headers)) {
        // Redirect ke index.php setelah pesan terkirim
        header("Location: index.php?status=success");
        exit();
    } else {
        // Redirect ke index.php dengan status error
        header("Location: index.php?status=error");
        exit();
    }
}
?>
