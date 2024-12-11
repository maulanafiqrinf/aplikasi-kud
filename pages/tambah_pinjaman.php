<?php

require_once("config/config.php");
require_once("config/function.php");
$connection = new Connection();
$conn = $connection->getConnection();

$tgg = date('Y-m-d');

if (isset($_POST['simpan'])) {
    $idp = $_POST['idp'];
    $tgl = $_POST['tgl'];
    $ka = $_POST['ka'];
    $pinjaman = $_POST['pinjaman'];
    $tenor = $_POST['tenor'];
    $angsuran = $_POST['angsuran'];
    $status = "Aktif";

    $sql1 = $conn->query("SELECT count(*) FROM anggota WHERE kode_anggota='" . $_POST["ka"] . "'");
    $row = $sql1->fetchColumn();
    if ($row > 0) {
        $sql3 = $conn->query("SELECT count(*) FROM pinjaman WHERE kode_anggota='" . $_POST["ka"] . "' AND status='Aktif'");
        $row3 = $sql3->fetchColumn();

        if ($row3 == 0) {
            $sql = "INSERT INTO pinjaman VALUES ('$idp','$tgl','$ka','$pinjaman','$tenor','$angsuran','$status')";
            $conn->exec($sql);
            echo "<script>alert('Data berhasil disimpan!'); window.location.href='?p=pinjaman';</script>";
        } else {
            echo "<script>alert('Data gagal disimpan, masih ada pinjaman aktif untuk anggota tersebut!'); window.location.href='?p=pinjaman';</script>";
        }
    } else {
        echo "<script>alert('Data gagal disimpan, silahkan coba lagi!'); window.location.href='?p=tambah_pinjaman';</script>";
    }
}

// Kode buat tamu
$query1 = $conn->prepare("SELECT MAX(kode_pinjaman) as maxID FROM pinjaman WHERE kode_pinjaman LIKE 'P%'");
$query1->execute();
$idMax = $query1->fetch(PDO::FETCH_COLUMN);

$idm1 = (int) substr($idMax, 1, 5);

$query2 = $conn->prepare("SELECT MAX(kode_pinjaman) as maxIDD FROM angsuran WHERE kode_pinjaman LIKE 'P%'");
$query2->execute();
$idMax2 = $query2->fetch(PDO::FETCH_COLUMN);

$idm2 = (int) substr($idMax2, 1, 5);

if ($idm1 >= $idm2) {
    $idm1++;
    $NoUrut = $idm1;
} else {
    $idm2++;
    $NoUrut = $idm2;
}

// Setelah ketemu id terakhir lanjut membuat id baru dengan format sbb:
$NewID = "P" . sprintf('%05s', $NoUrut);

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
function cekangsuran() {
    var pinjaman = document.addem.pinjaman.value;
    var tenor = document.addem.tenor.value;

    totalR = eval(parseInt(pinjaman) * 0.2);
    angsur = eval(parseInt(pinjaman) + totalR);
    cicil = eval(angsur / parseInt(tenor));

    document.addem.angsuran.value = cicil.toFixed(0);
}
</script>

<div class="main-content">
<div class="container-fluid">
    <h3><a href="?p=home">Beranda </a><i class="fa fa-angle-right"></i> <a href="?p=pinjaman">Data Pinjaman</a><i class="fa fa-angle-right"></i> Tambah Pinjaman</h3>

    <!-- BASIC FORM ELEMENTS -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading text-center">
                    <h4 class="mb"><strong>Tambah Data Pinjaman</strong></h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" name="addem" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return confirm('Anda yakin akan menyimpan data?')">
                        <input type="hidden" name="idp" value="<?php echo $NewID; ?>">
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
                            <label class="col-sm-2 col-sm-2 control-label text-right">Jumlah Pinjaman</label>
                            <div class="col-sm-10">
                                <input type="number" name="pinjaman" id="pinjaman" class="form-control" value="0">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label text-right">Tenor</label>
                            <div class="col-sm-10">
                                <select name="tenor" class="form-control" id="tenor" onchange="cekangsuran()">
                                    <option value="">Pilih Tenor</option>
                                    <option value="6">6 Bulan</option>
                                    <option value="12">12 Bulan</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label text-right">Jumlah Angsuran</label>
                            <div class="col-sm-10">
                                <input type="number" name="angsuran" class="form-control" readonly>
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
