<!DOCTYPE html>
<html>
<head>
    <title>Hasil Pembelian</title>
</head>
<body>
    <h2>Hasil Pembelian</h2>

    <table border="1" cellpadding="5">
        <tr>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Total</th>
        </tr>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                <td>Rp {{ number_format($item['total'], 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </table>

    <p>Subtotal: Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
    <p>Diskon ({{ $discount }}%): Rp {{ number_format($discountAmt, 0, ',', '.') }}</p>
    <p>Pajak ({{ $tax }}%): Rp {{ number_format($taxAmt, 0, ',', '.') }}</p>
    <h3>Total: Rp {{ number_format($total, 0, ',', '.') }}</h3>
    <p>Bayar: Rp {{ number_format($payment, 0, ',', '.') }}</p>
    <p>Kembalian: Rp {{ number_format($change, 0, ',', '.') }}</p>
</body>
</html>
