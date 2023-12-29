<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Deteksi Golongan Darah</title>
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <?php
        
    ?>
</head>
<body>
<div class="container">
    <h2 class="text-center mt-4 mb-4">Tambah Data Golongan Darah</h2>
    <form action="tambah_golongan.php" method="post">
        <div class="mb-3">
            <label for="nama_pendonor" class="form-label">Nama</label>
            <input type="text" placeholder="Masukkan nama di sini" class="form-control" id="nama_pendonor" name="nama_pendonor">
        </div>
        <div class="mb-3">
            <div>
                <label for="jenis_kelamin_l" class="form-label">Jenis Kelamin</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_l" value="Laki-laki" checked>
                <label class="form-check-label" for="jenis_kelamin_l">Laki - laki</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_p" value="Perempuan">
                <label class="form-check-label" for="jenis_kelamin_p">Perempuan</label>
            </div>
        </div>
        <div class="mb-3">
            <label for="alamat_pendonor" class="form-label">Alamat</label>
            <div class="form-check" style="padding-left: 0;">
                <textarea class="form-control" placeholder="Masukkan alamat di sini" name="alamat_pendonor" id="alamat_pendonor" style="height: 100px"></textarea>
            </div>
        </div>
        <div class="mb-3">
            <label for="nomor_hp" class="form-label">Nomor Telepon</label>
            <input type="text" placeholder="Masukkan nomor telepon di sini" class="form-control" id="nomor_hp" name="nomor_hp">
        </div>
        <button type="submit" class="btn btn-primary">Selanjutnya</button>
        <a href="index.php">
            <button type="button" class="btn btn-light">Kembali</button>
        </a>
    </form>
</div>
</body>
</html>