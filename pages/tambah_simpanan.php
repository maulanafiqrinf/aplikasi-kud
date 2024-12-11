<?php

require_once("config/config.php");

require_once("config/function.php");
$connection = new Connection();
$conn = $connection->getConnection();

$tgg = date('Y-m-d');

if (isset($_POST['simpan'])) {
    $tgl = $_POST['tgl'];
    $ka = $_POST['ka'];
    $js = $_POST['js'];

    $sql1 = $conn->query("SELECT count(*) FROM anggota WHERE kode_anggota='" . $_POST["ka"] . "'");
    $row = $sql1->fetchColumn();
    if ($row > 0) {
        $sql = "INSERT INTO simpanan (kode_anggota, tgl_simpan,jumlah_simpan) VALUES ('$ka','$tgl','$js')";
        $conn->exec($sql);
        echo "<script>alert(\"Data berhasil disimpan !\") ; window.location.href='?p=simpanan' ;</script>";
    } else {
        echo "<script>alert(\"Data gagal disimpan, kode anggota tidak terdaftar, silahkan coba lagi !\") ; window.location.href='?p=simpanan' ;</script>";
    }
}

// Fetch anggota data for dropdown
$anggotaQuery = $conn->query("SELECT kode_anggota, nama_anggota FROM anggota ORDER BY nama_anggota ASC");
$anggotaList = $anggotaQuery->fetchAll(PDO::FETCH_ASSOC);

?>

<style>
    #frmCheckUsername {
        border-top: #F0F0F0 2px solid;
        background: #FAF8F8;
        padding: 10px;
    }

    .demoInputBox {
        padding: 7px;
        border: #F0F0F0 1px solid;
        border-radius: 4px;
    }

    .status-available {
        color: #2FC332;
    }

    .status-not-available {
        color: #D60202;
    }

    .dropdown-menu a {
        text-decoration: none;
        display: block;
        text-align: left;
    }

    #nou {
        text-decoration: none;
    }
</style>

<script>
    function checkAvailability() {
        jQuery.ajax({
            url: "cek_available2.php",
            data: 'ka=' + $("#ka").val(),
            type: "POST",
            success: function(data) {
                $("#user-availability-status").html(data);
            },
            error: function() {}
        });
    }
</script>
<div class="main-content">
    <div class="container-fluid">
        <h3><a href="?p=home">Beranda </a><i class="fa fa-angle-right"></i> <a href="?p=simpnan">Data Simpanan</a><i class="fa fa-angle-right"></i> Tambah Simpanan</h3>

        <!-- BASIC FORM ELELEMNTS -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="panel-heading text-center">
                        <h4 class="mb"><strong> Tambah Data Simpanan</strong></h4>
                    </div>
                    <div class="panel-body">

                        <form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return confirm('Anda yakin akan menyimpan data ?')">
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label text-right">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" name="tgl" class="form-control" value="<?php echo $tgg; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label text-right">Kode Anggota</label>
                                <div class="col-sm-10">
                                    <select name="ka" id="ka" class="form-control" required>
                                        <option value="">Pilih Anggota</option>
                                        <?php foreach ($anggotaList as $anggota): ?>
                                            <option value="<?php echo $anggota['kode_anggota']; ?>">
                                                <?php echo $anggota['kode_anggota'] . " - " . $anggota['nama_anggota']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label text-right">Jumlah Simpan</label>
                                <div class="col-sm-10">
                                    <input type="number" name="js" class="form-control" placeholder="Masukan Jumlah Simpanan" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-right">
                                    <button class="btn btn-warning" type="reset" name="reset">Atur Ulang</button>
                                    <button class="btn btn-success" type="submit" name="simpan">Simpan</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div><!-- col-lg-12-->
    </div><!-- /row -->
</div>
</div>