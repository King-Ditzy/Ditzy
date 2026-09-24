<?php

session_start();


if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

if (isset($_POST['reset'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

class produk {
    public string $nama;
    public string $harga;

    public function __construct(string $nama, string $harga) {
        $this->nama = $nama;
        $this->harga = $harga;
    }

    public function cetakNotif() {
        $hargaFormatted = number_format((int)$this->harga, 0, ',', '.');
        echo "<div class='notif'>Sukses! Produk <strong>{$this->nama}</strong> berharga <strong>Rp{$hargaFormatted}</strong> sudah ditambahkan.</div>";
    }

    public function __destruct() {
        echo "<div class='destruct-msg'>[Destructor]: Produk " . $this->nama . " telah dihapus.</div>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah'])) {
    $inputNama = $_POST['nama_produk'];
    $inputHarga = $_POST['harga_produk'];
    
    $_SESSION['keranjang'][] = [
        'nama' => $inputNama,
        'harga' => $inputHarga
    ];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Produk OOP</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            flex-direction: column;
            padding: 20px 0;
        }
        .container {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 320px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #555;
            font-size: 14px;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
        }
        .btn-proses {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-proses:hover { background-color: #0056b3; }
        
        .btn-reset {
            width: 100%;
            padding: 10px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }
        .btn-reset:hover { background-color: #c82333; }
        
        .notif {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 8px; 
            border: 1px solid #c3e6cb;
            text-align: center;
            font-size: 13px;
        }
        .notif-container {
            margin-bottom: 20px;
        }
        .destruct-msg {
            font-size: 11px;
            color: #aaa;
            text-align: center;
            margin-top: 2px;
        }
        .destruct-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">

        <div class="notif-container">
            <?php
            $kumpulanObjek = [];
            
            if (!empty($_SESSION['keranjang'])) {
                foreach ($_SESSION['keranjang'] as $item) {

                    $produk = new produk($item['nama'], $item['harga']);
                    $produk->cetakNotif();
                    
                    $kumpulanObjek[] = $produk;
                }
            }
            ?>
        </div>

        <h2>Data Produk</h2>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" id="nama_produk" name="nama_produk" placeholder="Misal: Laptop" required autocomplete="off">
            </div>
            
            <div class="form-group">
                <label for="harga_produk">Harga (Rp)</label>
                <input type="number" id="harga_produk" name="harga_produk" placeholder="Misal: 5000000" required>
            </div>
            
            <button type="submit" name="tambah" class="btn-proses">Proses Barang</button>
        </form>

        <form method="POST" action="">
            <button type="submit" name="reset" class="btn-reset">Kosongkan Data</button>
        </form>
    </div>

    <div class="destruct-container">
        <?php
        foreach ($kumpulanObjek as $objek) {

        }
        ?>
    </div>

</body>
</html>