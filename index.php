<?php
$menu = [
    1 => ["nama" => "Burger Beef", "harga" => 15000],
    2 => ["nama" => "Pizza Keju", "harga" => 25000],
    3 => ["nama" => "Kentang Goreng", "harga" => 10000],
    4 => ["nama" => "Donat Cokelat", "harga" => 8000],
    5 => ["nama" => "Es Teh", "harga" => 5000]
];

$pesanan = [];
$total = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($menu as $id => $produk) {
        $jumlah = (int) ($_POST["jumlah"][$id] ?? 0);

        if ($jumlah > 0) {
            $subtotal = $produk["harga"] * $jumlah;

            $pesanan[] = [
                "nama" => $produk["nama"],
                "jumlah" => $jumlah,
                "subtotal" => $subtotal
            ];

            $total += $subtotal;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaiA Food - Toko Online Makanan</title>
</head>
<body>

<h1>MaiA Food</h1>
<p>Selamat datang di toko online makanan kami!</p>

<h2>Daftar Menu</h2>

<form method="POST">
    <?php foreach ($menu as $id => $produk): ?>
        <p>
            <?= htmlspecialchars($produk["nama"]) ?> -
            Rp<?= number_format($produk["harga"], 0, ',', '.') ?>

            <br>
            Jumlah:
            <input
                type="number"
                name="jumlah[<?= $id ?>]"
                value="0"
                min="0"
            >
        </p>
    <?php endforeach; ?>

    <button type="submit">Hitung Pesanan</button>
</form>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
    <h2>Rincian Pesanan</h2>

    <?php if (empty($pesanan)): ?>
        <p>Kamu belum memilih makanan.</p>
    <?php else: ?>
        <?php foreach ($pesanan as $item): ?>
            <p>
                <?= htmlspecialchars($item["nama"]) ?>
                (<?= $item["jumlah"] ?>)
                = Rp<?= number_format($item["subtotal"], 0, ',', '.') ?>
            </p>
        <?php endforeach; ?>

        <h3>
            Total: Rp<?= number_format($total, 0, ',', '.') ?>
        </h3>
    <?php endif; ?>
<?php endif; ?>

</body>
</html>
