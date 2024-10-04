<!DOCTYPE html>
<html>
<head>
    <title>Perhitungan Total Pembelian</title>
</head>
<body>

<h2>FORM PEMBELIAN</h2>
<div class="container mt-5">
<form method="post" action="">
    <label for="buyer_name">Nama Pembeli:</label><br>
    <input type="text" id="buyer_name" name="buyer_name" required><br><br>

    <label for="item_name">Nama Barang:</label><br>
    <input type="text" id="item_name" name="item_name" required><br><br>

    <label for="item_quantity">Jumlah Barang yang Dibeli:</label><br>
    <input type="number" id="item_quantity" name="item_quantity" required><br><br>

    <label for="item_price">Harga per Barang:</label><br>
    <input type="number" id="item_price" name="item_price" required><br><br>

    <label for="is_member">Apakah Anda member?</label><br>
    <input type="radio" id="member_yes" name="is_member" value="yes" required> Ya
    <input type="radio" id="member_no" name="is_member" value="no" required> Tidak<br><br>

    <input type="submit" name="submit" value="Hitung">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $buyer_name = $_POST['buyer_name'];
    $item_name = $_POST['item_name'];
    $item_quantity = $_POST['item_quantity'];
    $item_price = $_POST['item_price'];
    $is_member = $_POST['is_member'];

    // Menghitung total pembelian
    $total_purchase = $item_price * $item_quantity;

    $discount = 0;

    if ($is_member == 'yes') {
        // Logika untuk member
        if ($total_purchase >= 500000) {
            $discount = 0.2; // 10% + tambahan 10%
        } elseif ($total_purchase >= 300000) {
            $discount = 0.15; // 10% + 5%
        } else {
            $discount = 0.10; // Diskon 10% saja
        }
    } else {
        // Logika untuk bukan member
        if ($total_purchase >= 500000) {
            $discount = 0.10; // Diskon 10%
        }
    }

    // Menghitung diskon dan total akhir
    $discount_amount = $total_purchase * $discount;
    $final_amount = $total_purchase - $discount_amount;

    // Menampilkan ringkasan
    echo "<h3>Rincian pembelian :</h3>";
    echo "Nama Pembeli: " . htmlspecialchars($buyer_name) . "<br>";
    echo "Nama Barang: " . htmlspecialchars($item_name) . "<br>";
    echo "Jumlah Barang: " . $item_quantity . "<br>";
    echo "Harga per Barang: Rp " . number_format($item_price, 0, ',', '.') . "<br>";
    echo "Total Pembelian: Rp " . number_format($total_purchase, 0, ',', '.') . "<br>";
    echo "Diskon yang Diberikan: " . ($discount * 100) . "%<br>";
    echo "Jumlah Akhir: Rp " . number_format($final_amount, 0, ',', '.');
}
?>
</div>

</body>
</html>
