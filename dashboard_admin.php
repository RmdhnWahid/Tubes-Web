<?php
$mysqli = new mysqli("localhost", "root", "", "db_fawncoffee");

// Cek koneksi database
if ($mysqli->connect_error) {
    die("Koneksi database gagal: " . $mysqli->connect_error);
}

// Proses Tambah Data
if (isset($_POST['add'])) {
    $item_name = $mysqli->real_escape_string($_POST['item_name']);
    $price = $mysqli->real_escape_string($_POST['price']);
    $mysqli->query("INSERT INTO orders (item_name, price) VALUES ('$item_name', '$price')");
    header("Location: dashboard_admin.php");
    exit();
}

// Proses Edit Data
if (isset($_POST['edit'])) {
    $id = (int)$_POST['id'];
    $item_name = $mysqli->real_escape_string($_POST['item_name']);
    $price = $mysqli->real_escape_string($_POST['price']);
    $mysqli->query("UPDATE orders SET item_name='$item_name', price='$price' WHERE id=$id");
    header("Location: dashboard_admin.php");
    exit();
}

// Proses Hapus Data
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $mysqli->query("DELETE FROM orders WHERE id=$id");
    header("Location: dashboard_admin.php");
    exit();
}

// Ambil Data dari Database
$result = $mysqli->query("SELECT * FROM orders");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Style -->
    <link rel="stylesheet" href="css/style_dashboard_admin.css">
</head>
<body>
    <h1>Dashboard Admin</h1>
    <a href="logout.php" title="Logout">
    <i data-feather="log-out"></i>
    </a>

    <!-- Form Tambah Data -->
    <h3>Tambah Order Baru</h3>
    <form method="POST" action="">
        <input type="text" name="item_name" placeholder="Nama Item" required>
        <input type="text" name="price" placeholder="Harga" required>
        <button type="submit" name="add">Tambah</button>
    </form>

    <!-- Tabel Data Orders -->
    <h3>Data Orders</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Item</th>
            <th>Harga</th>
            <th>Tanggal Order</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= htmlspecialchars($row['item_name']); ?></td>
            <td><?= htmlspecialchars($row['price']); ?></td>
            <td><?= $row['order_date']; ?></td>
            <td>
                <!-- Tombol Edit -->
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    <input type="text" name="item_name" value="<?= $row['item_name']; ?>" required>
                    <input type="text" name="price" value="<?= $row['price']; ?>" required>
                    <button type="submit" name="edit">Edit</button>
                </form>
                <!-- Tombol Hapus -->
                <a href="?delete=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <script>
  feather.replace();
</script>
</body>
</html>

<?php $mysqli->close(); ?>
