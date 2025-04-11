<!DOCTYPE html>
<html>
<head>
    <title>Form Pembelian</title>
    <script>
        function updatePrice() {
            const itemSelect = document.getElementById('item_name');
            const priceField = document.getElementById('price');

            const itemPrices = @json($items);

            const selectedItem = itemSelect.value;
            priceField.value = itemPrices[selectedItem] || 0;
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

        <label>Nama Barang:</label><br>
        <select name="item_name" id="item_name" onchange="updatePrice()">
            <option value="">-- Pilih Barang --</option>
            @foreach ($items as $name => $price)
                <option value="{{ $name }}">{{ $name }}</option>
            @endforeach
        </select><br><br>

        <label>Harga Satuan:</label><br>
        <input type="number" name="price" id="price" readonly><br><br>

        <label>Jumlah:</label><br>
        <input type="number" name="quantity"><br><br>

        <label>Diskon (%):</label><br>
        <input type="number" name="discount" value="0"><br><br>

        <label>Pajak (%):</label><br>
        <input type="number" name="tax" value="0"><br><br>

        <label>Uang Pembayaran:</label><br>
        <input type="number" name="payment"><br><br>

        <button type="submit">Hitung</button>
    </form>
</body>
</html>
