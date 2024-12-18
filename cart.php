<?php
$mysqli = new mysqli("localhost", "root", "", "db_fawncoffee");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Hapus item dari keranjang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = (int)$_POST['delete_id'];
    $mysqli->query("DELETE FROM cart WHERE id = $delete_id");
    header("Location: cart.php");
    exit();
}

// Lanjutkan pemesanan: Pindahkan data dari cart ke orders
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['process_order'])) {
    $cartItems = $mysqli->query("SELECT * FROM cart");

    while ($row = $cartItems->fetch_assoc()) {
        $name = $mysqli->real_escape_string($row['item_name']);
        $price = $mysqli->real_escape_string($row['price']);
        $mysqli->query("INSERT INTO orders (item_name, price) VALUES ('$name', '$price')");
    }

    // Hapus semua data dari keranjang setelah diproses
    $mysqli->query("DELETE FROM cart");
    echo "<script>alert('Pesanan sedang diproses!'); window.location.href='cart.php';</script>";
    exit();
}

$result = $mysqli->query("SELECT * FROM cart");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
    <h1>Keranjang Belanja</h1>
    <?php if ($result->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>No</th>
                <th>Nama Item</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
            <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['item_name']); ?></td>
                <td><?= htmlspecialchars($row['price']); ?></td>
                <td>
                    <form method="POST" action="">
                        <input type="hidden" name="delete_id" value="<?= $row['id']; ?>">
                        <button type="submit">Batalkan</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

        <!-- Tombol Lanjutkan Pemesanan -->
        <form method="POST" action="">
            <button type="submit" name="process_order" style="margin-top: 10px; padding: 10px;">Lanjutkan Pemesanan</button>
        </form>

    <?php else: ?>
        <p>Keranjang Anda kosong.</p>
    <?php endif; ?>
    <a href="index.php">Kembali ke Menu</a>
</body>
</html>

<?php $mysqli->close(); ?>
