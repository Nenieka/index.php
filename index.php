<?php

$nama_toko = "MaiA Food";

$harga_menu = [
    "Burger" => 15000,
    "Pizza" => 25000,
    "Kentang Goreng" => 10000,
    "Donat" => 8000,
    "Es Teh" => 5000
];

echo "================================\n";
echo "       PEMBELIAN MAKANAN\n";
echo "          $nama_toko\n";
echo "================================\n\n";

echo "DAFTAR MENU MAKANAN:\n";

foreach ($harga_menu as $nama => $harga) {
    echo $nama . " = Rp" .
         number_format($harga, 0, ',', '.') . "\n";
}

echo "\n================================\n";

$pilihan = "Burger";
$jumlah = 2;
$uang_bayar = 40000;

if (isset($harga_menu[$pilihan]) && $jumlah > 0) {

    $harga = $harga_menu[$pilihan];
    $total = $harga * $jumlah;

    echo "Nama makanan : " . $pilihan . "\n";
    echo "Harga satuan : Rp" .
         number_format($harga, 0, ',', '.') . "\n";
    echo "Jumlah beli  : " . $jumlah . "\n";
    echo "Total harga  : Rp" .
         number_format($total, 0, ',', '.') . "\n";
    echo "Uang bayar   : Rp" .
         number_format($uang_bayar, 0, ',', '.') . "\n";

    if ($uang_bayar >= $total) {

        $kembalian = $uang_bayar - $total;

        echo "Kembalian    : Rp" .
             number_format($kembalian, 0, ',', '.') . "\n";
        echo "\nPembelian berhasil!\n";

    } else {

        $kurang = $total - $uang_bayar;

        echo "Uang kurang  : Rp" .
             number_format($kurang, 0, ',', '.') . "\n";
    }

} else {

    echo "Pilihan menu tidak tersedia!\n";
}

echo "================================\n";
echo "Terima kasih sudah berbelanja!\n";

?>
