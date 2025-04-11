<!DOCTYPE html>
<html>
<head>
    <title>Hasil Pembelian</title>
</head>
<body>
    <h2>Detail Pembelian</h2>

    <p>Nama Barang: <strong>{{ $itemName }}</strong></p>
    <p>Harga Satuan: Rp {{ number_format($price, 2, ',', '.') }}</p>
    <p>Jumlah: {{ $quantity }}</p>
    <p>Subtotal: Rp {{ number_format($subtotal, 2, ',', '.') }}</p>
    <p>Diskon ({{ $discount }}%): Rp {{ number_format($discountAmt, 2, ',', '.') }}</p>
    <p>Pajak ({{ $tax }}%): Rp {{ number_format($taxAmt, 2, ',', '.') }}</p>
    <p><strong>Total Bayar: Rp {{ number_format($total, 2, ',', '.') }}</strong></p>
    <p>Uang Diberikan: Rp {{ number_format($payment, 2, ',', '.') }}</p>
    <p><strong>Kembalian: Rp {{ number_format($change, 2, ',', '.') }}</strong></p>

    <br>
    <a href="/purchase">Kembali ke Form</a>
</body>
</html>
