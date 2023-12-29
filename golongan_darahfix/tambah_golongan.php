<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Deteksi Golongan Darah</title>

    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="asset/css/custom.css" rel="stylesheet">

    <script src="asset/js/jquery-3.6.0.min.js"></script>
    <style>
        #form_simpan{
            display: none;
        }
    </style>
    <?php
        include_once("koneksi.php");

        $result = mysqli_query($conn,"SELECT date from rekam_gol_darah ORDER BY date DESC LIMIT 1");
        $tes = mysqli_fetch_array($result);
        $last_date = $tes['date'];

        $nama = $_POST["nama_pendonor"];
        $jenis_kelamin = $_POST["jenis_kelamin"];
        $alamat = $_POST["alamat_pendonor"];
        $hp = $_POST["nomor_hp"];        
    ?>
</head>
<body>
<div class="container">
    <div id="delete_soon">
        <h2 class="text-center mt-4 mb-4">Menunggu Data</h2>
        <div class="mb-3 text-center">
            <div class="loading">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <form id="form_simpan" class="mt-4 p-4" method="post" action="simpan_data_db.php">
        <h3 class="text-center mb-4">Data Golongan Darah</h3>
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <th class="col-2">Nama</th>
                    <td>: <?=$nama?></td>
                </tr>
                <tr>
                    <th class="col-2">Jenis Kelamin</th>
                    <td>: <?=$jenis_kelamin?></td>
                </tr>
                <tr>
                    <th class="col-2">Alamat</th>
                    <td>: <?=$alamat?></td>
                </tr>
                <tr>
                    <th class="col-2">Nomor Telepon</th>
                    <td>: <?=$hp?></td>
                </tr>
                <tr>
                    <th class="col-2">Golongan Darah</th>
                    <td id="deskripsi_gol">: </td>
                </tr>
            </tbody>
        </table>

        <input type="hidden" name="nama" value="<?=$nama?>">
        <input type="hidden" name="jenis_kelamin" value="<?=$jenis_kelamin?>">
        <input type="hidden" name="alamat" value="<?=$alamat?>">
        <input type="hidden" name="hp" value="<?=$hp?>">
        <input type="hidden" name="gol" id="gol" value="">
        <input type="hidden" name="rhesus" id="rhesus" value="">

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a id="batal" href="tambah_data.php">
            <button type="button" class="btn btn-light">Batal</button>
        </a>
    </form>
</div>
</body>
<script>
    setInterval(function(){
        reload_data("<?=$last_date?>");
    },3000);

    function reload_data(d){
        $.ajax({
            type: 'POST',
            url: "cek.php",
            data:{
                date: d
            },
            success: function(value) {
                values = JSON.parse(value);
                if(values['golongan_darah'] != undefined){
                    $('#delete_soon').css('display','none')
                    $('#form_simpan').css('display','block')
                    $('#batal').attr('href','hapus_data_db.php?id='+values['id_pendonor'])
                    $('#gol').val(values['golongan_darah'])
                    $('#rhesus').val(values['rhesus'])
                    $('#deskripsi_gol').html(": "+values['golongan_darah']+values['rhesus'])
                }
            },
            async: false
        });
    }
</script>
</html>