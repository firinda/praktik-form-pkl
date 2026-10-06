<?php
/*
A. ANALISIS VIDEO

1. Apa yang terjadi pada URL browser saat data dikirim menggunakan metode GET?
Jawab: Data yang dikirim dengan metode GET akan ditambahkan ke URL browser sebagai query string, sehingga nilai input dapat terlihat pada alamat URL.

2. Mengapa GET tidak boleh digunakan untuk form yang berisi password atau data sensitif?
Jawab: Karena data GET terlihat pada URL browser dan dapat tersimpan pada riwayat browser atau tercatat pada berbagai log, sehingga tidak cocok untuk password maupun data sensitif.

3. Apa fungsi utama dari pengecekan isset()?
Jawab: isset() digunakan untuk mengecek apakah suatu variabel atau data sudah ada dan memiliki nilai sebelum diproses, sehingga program tidak langsung mengakses data yang belum dikirim.
*/

// B. PRAKTIK FORM HANDLING
if (isset($_POST['submit'])) {
    // Mengambil data dari form
    $nama = trim($_POST['nama'] ?? '');
    $nis = trim($_POST['nis'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $jurusan = $_POST['jurusan'] ?? '';
    $perusahaan = trim($_POST['perusahaan'] ?? '');
    $kompetensi = $_POST['kompetensi'] ?? [];
    $alasan = trim($_POST['alasan'] ?? '');

    // Validasi field wajib
    if (empty($nama) || empty($nis)) {
        $error = 'Nama Lengkap dan NIS wajib diisi.';
    } else {
        $berhasil = true;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Peserta PKL</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f1ed;
            margin: 0;
            padding: 30px 15px;
            color: #333;
        }

        .container {
            max-width: 750px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        h1, h2 {
            color: #5a2d22;
        }

        h1 {
            text-align: center;
            margin-top: 0;
        }

        label, legend {
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 18px;
        }

        input[type="text"],
        input[type="number"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 11px;
            margin-top: 7px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 15px;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        fieldset {
            border: 1px solid #ccc;
            border-radius: 7px;
            margin-bottom: 18px;
            padding: 15px;
        }

        .option {
            display: block;
            margin: 9px 0;
            font-weight: normal;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 7px;
            background: #5a2d22;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #432119;
        }

        .error {
            background: #ffe5e5;
            color: #a40000;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .success {
            background: #e7f7e7;
            padding: 20px;
            border-radius: 8px;
            margin-top: 25px;
        }

        .success p {
            margin: 8px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Pendaftaran Peserta PKL</h1>

    <?php if (isset($error)): ?>
        <div class="error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($nama ?? '') ?>">
        </div>

        <div class="form-group">
            <label for="nis">NIS</label>
            <input type="number" id="nis" name="nis" value="<?= htmlspecialchars($nis ?? '') ?>">
        </div>

        <div class="form-group">
            <label for="email">Email Siswa</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>">
        </div>

        <fieldset>
            <legend>Kompetensi Keahlian / Jurusan</legend>
            <label class="option">
                <input type="radio" name="jurusan" value="RPL" <?= (($jurusan ?? '') === 'RPL') ? 'checked' : '' ?>>
                RPL
            </label>
            <label class="option">
                <input type="radio" name="jurusan" value="TKJ" <?= (($jurusan ?? '') === 'TKJ') ? 'checked' : '' ?>>
                TKJ
            </label>
            <label class="option">
                <input type="radio" name="jurusan" value="DKV" <?= (($jurusan ?? '') === 'DKV') ? 'checked' : '' ?>>
                DKV
            </label>
        </fieldset>

        <div class="form-group">
            <label for="perusahaan">Pilihan Perusahaan PKL</label>
            <input type="text" id="perusahaan" name="perusahaan" value="<?= htmlspecialchars($perusahaan ?? '') ?>">
        </div>

        <fieldset>
            <legend>Kompetensi / Tech Stack yang Dikuasai</legend>
            <?php
            $daftarKompetensi = ['HTML', 'CSS', 'PHP', 'Python', 'JavaScript'];
            foreach ($daftarKompetensi as $item):
            ?>
                <label class="option">
                    <input type="checkbox" name="kompetensi[]" value="<?= htmlspecialchars($item) ?>"
                        <?= in_array($item, $kompetensi ?? []) ? 'checked' : '' ?>>
                    <?= htmlspecialchars($item) ?>
                </label>
            <?php endforeach; ?>
        </fieldset>

        <div class="form-group">
            <label for="alasan">Alasan Memilih Perusahaan</label>
            <textarea id="alasan" name="alasan"><?= htmlspecialchars($alasan ?? '') ?></textarea>
        </div>

        <button type="submit" name="submit">Daftar</button>
    </form>

    <?php if (isset($berhasil) && $berhasil === true): ?>
        <div class="success">
            <h2>Data Pendaftaran PKL</h2>
            <p><strong>Nama Lengkap:</strong> <?= htmlspecialchars($nama) ?></p>
            <p><strong>NIS:</strong> <?= htmlspecialchars($nis) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
            <p><strong>Jurusan:</strong> <?= htmlspecialchars($jurusan ?: '-') ?></p>
            <p><strong>Perusahaan PKL:</strong> <?= htmlspecialchars($perusahaan ?: '-') ?></p>
            <p><strong>Kompetensi:</strong>
                <?= !empty($kompetensi) ? htmlspecialchars(implode(', ', $kompetensi)) : '-' ?>
            </p>
            <p><strong>Alasan:</strong> <?= nl2br(htmlspecialchars($alasan ?: '-')) ?></p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
