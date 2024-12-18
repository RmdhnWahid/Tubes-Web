<?php
include 'db_fawncoffee.php';

// Data pengguna
$username = 'user'; 
$password_baru = 'user123'; 

// Hash password baru
$password_hashed = password_hash($password_baru, PASSWORD_DEFAULT);

// Query untuk mengubah password
$sql = "UPDATE users SET password = '$password_hashed' WHERE username = '$username'";

// Eksekusi query
if (mysqli_query($conn, $sql)) {
    echo "Password berhasil diubah dan di-hash.";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Tutup koneksi database
mysqli_close($conn);
?>
