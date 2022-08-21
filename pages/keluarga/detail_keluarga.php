<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    die ("&nbsp;Error. No Kode Selected! ");
}

$view = mysql_query("SELECT * FROM tb_umat WHERE id_keluarga='$id' ORDER BY nama_umat ASC");
$info = mysql_fetch_array(mysql_query("SELECT * FROM tb_keluarga WHERE id='$id'"));
if(isset($_POST['hapus'])) {
    $del = mysql_fetch_array(mysql_query("SELECT * FROM tb_umat WHERE id='$_POST[id]'"));
    if(is_file("assets/img/umat/".$del['avatar']))
        unlink("assets/img/umat/".$del['avatar']);
    $hapus = mysql_query("DELETE FROM tb_umat WHERE id='$_POST[id]'");
    $hapus = mysql_query("DELETE FROM tb_pengurus WHERE id_pengurus='$_POST[id]'");
    $hapus = mysql_query("DELETE FROM tb_alamat WHERE id_umat='$_POST[id]'");
    $hapus = mysql_query("DELETE FROM tb_ortu WHERE id_umat='$_POST[id]'");
    if($hapus) {
        echo "<script>location='?page=lihat-keluarga&id=$id'</script>";
    }
}
?>
<div class="inner" style="min-height: 1px">
    <div class="row">
        <div class="col-lg-12">
            <h2>Informasi Keluarga <small><?=$info['nama_keluarga'];?></small></h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12">
            <a href="?page=add-umat" class="btn btn-success"><i class="icon-pencil"></i> Tambah Umat</a><br><br>
            <div class="panel panel-default">
                <div class="panel-heading">Daftar anggota keluarga dalam tabel</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Umat</th>
                                    <th>Status</th>
                                    <th>TTL</th>
                                    <th>Umur</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while($v = mysql_fetch_array($view)) :
                                $birthday = new DateTime($v['tgl_lhr']);
                                $today = new DateTime();
                                $umur = $today->diff($birthday);
                                $h = mysql_fetch_array(mysql_query("SELECT * FROM tb_hubungan WHERE id='$v[id_hubungan]'")); ?>
                                <tr class="odd gradeX">
                                    <td class="text-center"><?= $no; ?></td>
                                    <td><a href="?page=lihat-umat&id=<?=$v['id'];?>"><?= $v['nama_umat']; ?></a></td>
                                    <td><?= $h['nama_hubungan']; ?></td>
                                    <td><?= $v['tmp_lhr']; ?>, <?= tgl_indo($v['tgl_lhr']); ?></td>
                                    <td class="center"><?= $umur->y . " Tahun"; ?></td>
                                    <td class="text-center">
                                        <a href="?page=edit-umat&id=<?=$v['id'];?>"><i class="icon-edit"></i></a>&nbsp;
                                        <a href="#" class="open-AddBookDialog" data-id="<?=$v['id'];?>" data-toggle="modal" data-target="#hapus" title="Hapus"><i class="icon-trash"></i></a></td>
                                </tr>
                                <?php $no++;endwhile; ?>
                            </tbody>
                        </table>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-12">
    <div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="icon-signin"></i> Konfirmasi Hapus!</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" role="form">
                        <input type="hidden" name='id' id='bookId'>
                        <div class="form-group text-center">
                            <p>Anda yakin ingin menghapus ?</p>
                            <button type="submit" name="hapus" class="btn btn-warning">Lanjutkan</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        </div>                   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>