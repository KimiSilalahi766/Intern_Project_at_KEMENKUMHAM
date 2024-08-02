<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="generator" content="CodeIgniter">
    <title>Formulir Penggantian Kata-kata</title>
    <style>
        /* Import font dari Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        /* Styling untuk body */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Poppins', Arial, sans-serif;
            margin: 550px 200px;
            background: #f4f4f4; /* Latar belakang abu-abu */
        }

        /* Efek blur untuk background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('<?= base_url('static\images\bg.jpg') ?>'); /* Lokasi gambar background */
            background-size: cover;
            background-position: center;
            filter: blur(5px); /* Efek blur */
            z-index: -1; /* Letakkan di belakang semua elemen */
        }

        /* Wrapper untuk formulir */
        .form-wrapper {
            width: 90%;
            max-width: 900px; /* Lebar maksimum formulir */
            background: rgba(255, 255, 255, 0.7); /* Latar belakang semi-transparan */
            padding: 25px; /* Padding di dalam formulir */
            border-radius: 10px; /* Sudut bulat */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Bayangan */
            z-index: 1; /* Letakkan di atas latar belakang yang di-blur */
        }

        /* Styling untuk header */
        header {
            text-align: center;
            margin-bottom: 30px;
        }

        /* Styling untuk judul header */
        header h1 {
            font-size: 24px; /* Ukuran font disesuaikan */
            font-weight: bold;
            color: #333; /* Warna teks */
        }

        /* Garis pemisah */
        header hr {
            border: none;
            border-top: 1.5px solid #333; /* Ketebalan dan warna garis */
            margin: 20px 0; /* Margin atas dan bawah */
        }

        /* Grid untuk penempatan elemen formulir */
        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px; /* Jarak antar kolom */
        }

        /* Grup untuk setiap elemen formulir */
        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        /* Input teks dan textarea */
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
            font-family: 'Poppins', Arial, sans-serif;
            resize: vertical; /* Izinkan penyesuaian vertikal */
        }

        /* Judul untuk input */
        .form-title h4 {
            margin: 10px 0;
            font-family: 'Poppins', Arial, sans-serif;
            font-size: 14px; /* Ukuran font disesuaikan */
        }

        /* Label untuk input */
        .form-group label {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #fff;
            border-radius: 4px;
            padding: 0 5px;
            transition: 0.2s;
            color: #aaa;
            font-family: 'Poppins', Arial, sans-serif;
            font-size: 12px;
            pointer-events: none;
        }

        /* Efek focus pada input */
        input:focus + label,
        textarea:focus + label,
        input:not(:placeholder-shown) + label,
        textarea:not(:placeholder-shown) + label {
            top: -12px;
            left: 10px;
            font-size: 12px;
            color: #333;
        }

        /* Efek focus pada input */
        input:focus,
        textarea:focus {
            border-color: #333;
        }

        /* Tombol submit */
        button {
            grid-column: span 2;
            padding: 12px;
            background-color: #2A2D85;
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            font-weight: bold;
            font-family: 'Poppins', Arial, sans-serif;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        /* Efek hover pada tombol submit */
        button:hover {
            background-color: #1f215c;
        }

        /* Styling untuk input file */
        .file-input-wrapper {
            position: relative;
            display: block;
            width: 100%;
            background: #fff; /* Latar belakang putih untuk konsistensi */
            border: 1px solid #ccc; /* Border konsisten dengan input teks */
            border-radius: 4px; /* Sudut bulat */
            padding: 10px;
            box-sizing: border-box; /* Menghitung padding dan border dalam lebar elemen */
            font-family: 'Poppins', Arial, sans-serif; /* Font konsisten */
            margin-bottom: 20px; /* Margin bawah untuk jarak antar elemen */
        }

        .file-input-wrapper input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .file-input-wrapper label {
            font-size: 14px;
            color: #333;
            margin: 0;
            line-height: 20px;
            display: block;
        }

        .file-input-wrapper input[type="file"] + label::before {
            content: 'Unggah File';
            display: inline-block;
            background-color: #2A2D85;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
        }

        .file-input-wrapper input[type="file"]:hover + label::before {
            background-color: #1f215c;
        }

        /* Styling untuk kesalahan validasi */
        .validation-error {
            color: #ff0000;
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* Responsif */
        @media (max-width: 768px) {
            form {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="form-wrapper">
        <header>
            <h1>Formulir Penggantian Kata-kata</h1>
            <hr>
        </header>
        <?php if (isset($validation)) : ?>
            <div class="validation-error">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        <form action="<?= site_url('wordprocessor/replace') ?>" method="post" enctype="multipart/form-data">
            <div class="form-title">
                <h4>Satuan Kerja (Tulis dalam huruf besar untuk KOP)</h4>
                <div class="form-group">
                    <input type="text" id="judul" name="judul" placeholder=" " required>
                    <label for="judul">Masukkan satuan kerja</label>
                </div>
            </div>
            <div class="form-title">
                <h4>Alamat</h4>
                <div class="form-group">
                    <input type="text" id="alamat" name="alamat" placeholder=" " required>
                    <label for="alamat">Masukkan Alamat</label>
                </div>
            </div>
            <div class="form-title">
                <h4>Telpon</h4>
                <div class="form-group">
                    <input type="text" id="telpon" name="telpon" placeholder=" " required>
                    <label for="telpon">Masukkan Nomor Telpon</label>
                </div>
            </div>
            <div class="form-title">
                <h4>Laman</h4>
                <div class="form-group">
                    <input type="text" id="manla" name="manla" placeholder=" " required>
                    <label for="manla">Masukkan Laman</label>
                </div>
            </div>
            <div class="form-title">
                <h4>Surel</h4>
                <div class="form-group">
                    <input type="email" id="relsu" name="relsu" placeholder=" " required>
                    <label for="relsu">Masukkan Surel</label>
                </div>
            </div>
            <div class="form-title">
                <h4>Satuan Kerja (Tulis dalam huruf besar untuk Judul)</h4>
                <div class="form-group">
                    <input type="text" id="namsat" name="namsat" placeholder=" " required>
                    <label for="namsat">Masukkan satuan kerja</label>
                </div>
            </div>
            <div class="form-title">
                <h4>Satuan Kerja (Tulis dalam huruf besar untuk Judul)</h4>
                <div class="form-group">
                    <input type="text" id="satker" name="satker" placeholder=" " required>
                    <label for="satker">Masukkan nama satuan kerja</label>
                </div>
            </div>
            <div class="form-title">
                <h4>Triwulan (E-Monev)</h4>
                <div class="form-group">
                    <input type="text" id="triwulan" name="triwulan" placeholder=" " required>
                    <label for="triwulan">Masukkan Triwulan (E-Monev)</label>
                </div>
            </div>
            <div class="form-title">
                <h4>Tahun (E-Monev)</h4>
                <div class="form-group">
                    <input type="text" id="tahun" name="tahun" placeholder=" " required>
                    <label for="tahun">Masukkan Tahun (E-Monev)</label>
                </div>
            </div>
            <div class="form-title">
                <h4>Output (E-Monev)</h4>
                <div class="form-group">
                    <input type="text" id="output" name="output" placeholder=" " required>
                    <label for="output">Masukkan Output (E-Monev)</label>
                </div>
            </div>
            <div class="form-title">
                <h4>Triwulan (Smart)</h4>
                <div class="form-group">
                    <input type="text" id="wulantri" name="wulantri" placeholder=" " required>
                    <label for="wulantri">Masukkan Triwulan (untuk smart)</label>
                </div>
            </div>
            <div class="form-title">
                <h4>Tahun (Smart)</h4>
                <div class="form-group">
                    <input type="text" id="hunta" name="hunta" placeholder=" " required>
                    <label for="hunta">Masukkan tahun (untuk Smart)</label>
                </div>
            </div>
            <div class="form-title">
                <h4>Output (Smart)</h4>
                <div class="form-group">
                    <input type="text" id="putout" name="putout" placeholder=" " required>
                    <label for="putout">Masukkan Output (untuk Smart)</label>
                </div>
            </div>
            <div class="form-title">
                <h4>Hambatan 1</h4>
                <div class="form-group">
                    <textarea id="hambatan1" name="hambatan1" placeholder=" " required></textarea>
                    <label for="hambatan1">Masukkan Hambatan satu</label>
                </div>
            </div>
            <div class="form-title">
                <h4>Hambatan 2</h4>
                <div class="form-group">
                    <textarea id="hambatan2" name="hambatan2" placeholder=" " required></textarea>
                    <label for="hambatan2">Masukkan Hambatan dua</label>
                </div>
            </div>
            <div class="form-title">
                <h4>Rencana 1</h4>
                <div class="form-group">
                    <textarea id="rencana1" name="rencana1" placeholder=" " required></textarea>
                    <label for="rencana1">Masukkan Rencana satu</label>
                </div>
            </div>
            <div class="form-title">
                <h4>Rencana 2</h4>
                <div class="form-group">
                    <textarea id="rencana2" name="rencana2" placeholder=" " required></textarea>
                    <label for="rencana2">Masukkan Rencana dua</label>
                </div>
            </div>
            <div class="form-title">
                <h4>Gambar E-Monev</h4>
                <div class="file-input-wrapper">
                    <input type="file" id="gambar_gbremonev" name="gambar_gbremonev" required>
                    <label for="gambar_gbremonev">&nbsp&nbsp Untuk Gambar E-Monev</label>
                </div>
            </div>
            <div class="form-title">
                <h4>Gambar Smart</h4>
                <div class="file-input-wrapper">
                    <input type="file" id="gambar_gmbrsmart" name="gambar_gmbrsmart" required>
                    <label for="gambar_gmbrsmart">&nbsp&nbsp Untuk Gambar Smart</label>
                </div>
            </div>
            <div class="form-title">
                <h4>Gambar CAPAIAN E-ERFORMANCE</h4>
                <div class="file-input-wrapper">
                    <input type="file" id="gambar_gbrerformance" name="gambar_gbrerformance" required>
                    <label for="gambar_gbrerformance">&nbsp&nbsp Untuk Gambar E-ERFORMANCE</label>
                </div>
            </div>
            <button type="submit">Kirim</button>
        </form>
    </div>
</body>
</html>
