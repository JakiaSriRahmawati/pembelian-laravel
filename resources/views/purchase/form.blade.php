<!DOCTYPE html>
<html>
<head>
    <title>Form Pembelian</title>
    <script>
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(angka);
        }
    </script>
</head>
<body>
    <h2>Form Pembelian</h2>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/purchase">
        @csrf

        <h4>Pilih Barang:</h4>
        @foreach ($items as $index => $item)
            <input type="checkbox" name="items[{{ $index }}][name]" value="{{ $item['name'] }}" id="item{{ $index }}" onchange="toggleQuantity({{ $index }})">
            <label for="item{{ $index }}">{{ $item['name'] }} ({{ number_format($item['price'], 0, ',', '.') }})</label>
            Jumlah: 
            <input type="number" name="items[{{ $index }}][quantity]" id="qty{{ $index }}" min="1" style="width: 60px;" disabled><br>
        @endforeach

        <br>
        <label>Diskon (%):</label><br>
        <input type="number" name="discount" value="0"><br><br>

        <label>Pajak (%):</label><br>
        <input type="number" name="tax" value="0"><br><br>

        <label>Uang Pembayaran:</label><br>
        <input type="number" name="payment"><br><br>

        <button type="submit">Hitung</button>
    </form>

    <script>
        function toggleQuantity(index) {
            const checkbox = document.getElementById('item' + index);
            const qtyField = document.getElementById('qty' + index);
            qtyField.disabled = !checkbox.checked;
            if (!checkbox.checked) {
                qtyField.value = '';
            }
        }
    </script>
</body>
</html>
