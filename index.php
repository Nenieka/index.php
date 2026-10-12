<?php
$nama_toko = "MaiA Food";

$menu = [
    1 => ["nama" => "Burger", "harga" => 15000],
    2 => ["nama" => "Pizza", "harga" => 25000],
    3 => ["nama" => "Kentang Goreng", "harga" => 10000],
    4 => ["nama" => "Donat", "harga" => 8000],
    5 => ["nama" => "Es Teh", "harga" => 5000]
];

$pilihan = "";
$jumlah = 0;
$uang_bayar = 0;
$total = 0;
$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pilihan = (int) ($_POST["pilihan"] ?? 0);
    $jumlah = (int) ($_POST["jumlah"] ?? 0);
    $uang_bayar = (int) ($_POST["uang_bayar"] ?? 0);

    if (!isset($menu[$pilihan])) {
        $pesan = "Pilihan makanan tidak tersedia!";
    } elseif ($jumlah < 1 || $uang_bayar < 0) {
        $pesan = "Jumlah atau uang pembayaran tidak valid!";
    } else {
        $total = $menu[$pilihan]["harga"] * $jumlah;
    }
}

function rupiah($angka) {
    return "Rp" . number_format($angka, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaiA Food</title>
</head>
<body>

<h1><?php echo $nama_toko; ?></h1>
<p>Aplikasi Pembelian Makanan Online</p>
<hr>

<h2>Daftar Menu Makanan</h2>

<?php foreach ($menu as $id => $item) { ?>
    <p>
        <?php echo $id . ". " . $item["nama"]; ?>
        - <?php echo rupiah($item["harga"]); ?>
    </p>
<?php } ?>

<hr>

<h2>Form Pembelian</h2>

<form method="POST" action="">
    <label>Pilih makanan:</label>
    <select name="pilihan" required>
        <?php foreach ($menu as $id => $item) { ?>
            <option value="<?php echo $id; ?>"
                <?php echo ($pilihan == $id) ? "selected" : ""; ?>>
                <?php echo $item["nama"]; ?>
            </option>
        <?php } ?>
    </select>

    <br><br>

    <label>Jumlah pembelian:</label>
    <input type="number" name="jumlah"
        min="1" value="<?php echo $jumlah > 0 ? $jumlah : 1; ?>"
        required>

    <br><br>

    <label>Uang pembayaran (Rp):</label>
    <input type="number" name="uang_bayar"
        min="0" value="<?php echo $uang_bayar; ?>"
        required>

    <br><br>

    <button type="submit">Hitung Pembayaran</button>
</form>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
    <hr>
    <h2>Hasil Pembelian</h2>

    <?php if ($pesan != "") { ?>
        <p><?php echo $pesan; ?></p>
    <?php } else { ?>
        <p>Nama makanan:
            <?php echo $menu[$pilihan]["nama"]; ?></p>

        <p>Harga satuan:
            <?php echo rupiah($menu[$pilihan]["harga"]); ?></p>

        <p>Jumlah beli: <?php echo $jumlah; ?></p>

        <p>Total harga: <?php echo rupiah($total); ?></p>

        <p>Uang bayar: <?php echo rupiah($uang_bayar); ?></p>

        <?php if ($uang_bayar >= $total) { ?>
            <p>Kembalian:
                <?php echo rupiah($uang_bayar - $total); ?></p>
            <p>Pembelian berhasil!</p>
        <?php } else { ?>
            <p>Uang masih kurang:
                <?php echo rupiah($total - $uang_bayar); ?></p>
        <?php } ?>
    <?php } ?>
<?php } ?>

<hr>
<p>Terima kasih sudah berbelanja di MaiA Food!</p>

</body>
</html>
