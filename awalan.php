<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Total Belanja</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: yellow;
            background: linear-gradient(to right, yellow 10%,#bdb76b 75%);
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        h1 {
            text-align: center;
            color : #000000;
            margin-bottom: 20px;
        }

        .result {
            margin-top: 20px;
            font-size: 18px;
            line-height: 1.6;
            color: #555;
        }

        .highlight {
            font-weight: bold;
            color: #2980b9;
        }

        .form-group {
            margin-bottom: 10px;
        }

        label {
            font-size: 16px;
            color: #333;
            display: block;
        }

        input[type="number"], input[type="text"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 5px;
            font-size: 16px;
        }

        .button {
            font-family : arial;
            background-color: yellow;
            color: black;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #bdb76b;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Hitung Total Belanja di Store Sahada</h1>
    <form method="POST" action="">
        <div class="form-group">
            <label for="pelanggan">Nama Pelanggan</label>
            <input type="text" name="pelanggan" placeholder="Masukan nama pelanggan" required>
        </div>

        <div class="form-group">
            <label for="total_belanja">Total Belanja (Rp):</label>
            <input type="number" id="total_belanja" name="total_belanja" required min="0">
        </div>

        <div class="form-group">
            <label for="is_member">Apakah Anda Member?</label>
            <select id="is_member" name="is_member" required>
                <option value="1">Ya</option>
                <option value="0">Tidak</option>
            </select>
        </div>

        <button type="submit" class="button">Hitung</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $pelanggan = ucwords(strtolower($_POST['pelanggan']));  // Ubah jadi huruf kapital di awal setiap kata
        $total_belanja = $_POST['total_belanja'];               // Input total belanja dari form
        $is_member = $_POST['is_member'] == '1';                // Input status member dari form

        echo "<p>Total Belanja : <span class='highlight'>Rp" . number_format($total_belanja, 2, ',', '.') . "</span></p>";

        function hitung_total_belanja($pelanggan, $total_belanja, $is_member) {
            $diskon = 0;

            // Cek jika pembeli adalah member, mendapatkan diskon 10%
            if ($is_member) {
                echo "<p class='highlight'>Pembeli adalah member, mendapatkan diskon 10%.</p>";
                $diskon += 0.10;  // Diskon 10% untuk member
            }

            // Cek diskon berdasarkan total belanja
            if ($total_belanja >= 500000) {
                echo "<p class='highlight'>Total pembelian lebih dari atau sama dengan Rp500.000, mendapatkan tambahan diskon 10%.</p>";
                $diskon += 0.10;  // Diskon tambahan 10% jika pembelian >= Rp500.000
            } elseif ($total_belanja >= 300000) {
                echo "<p class='highlight'>Total pembelian lebih dari atau sama dengan Rp300.000, mendapatkan potongan 5%.</p>";
                $diskon += 0.05;  // Diskon 5% jika pembelian >= Rp300.000
            }

            // Hitung total diskon
            $total_diskon = $total_belanja * $diskon;
            $total_akhir = $total_belanja - $total_diskon;

            // Output hasil perhitungan
            echo "<div class='result'>";
            echo "<p>Nama Pelanggan: <span class='highlight'>" . htmlspecialchars($pelanggan) . "</span></p>";
            echo "<p>Total belanja sebelum diskon: <span class='highlight'>Rp" . number_format($total_belanja, 2, ',', '.') . "</span></p>";
            echo "<p>Total diskon: <span class='highlight'>Rp" . number_format($total_diskon, 2, ',', '.') . "</span></p>";
            echo "<p>Total belanja setelah diskon: <span class='highlight'>Rp" . number_format($total_akhir, 2, ',', '.') . "</span></p>";
            echo "</div>";
        }

        // Panggil fungsi untuk menghitung total belanja
        hitung_total_belanja($pelanggan, $total_belanja, $is_member);
    }
    ?>
</div>

</body>
</html>
