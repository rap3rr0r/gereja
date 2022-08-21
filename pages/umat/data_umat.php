<?php
$umat = mysql_query("SELECT * FROM tb_umat ORDER BY nama_umat ASC");
$umat_r = mysql_num_rows($umat);
if(isset($_POST['hapus'])) {
    $del = mysql_fetch_array(mysql_query("SELECT * FROM tb_umat WHERE id='$_POST[id]'"));
    unlink("assets/img/umat/".$del['avatar']);
    $hapus = mysql_query("DELETE FROM tb_umat WHERE id='$_POST[id]'");
    $hapus = mysql_query("DELETE FROM tb_pengurus WHERE id_pengurus='$_POST[id]'");
    $hapus = mysql_query("DELETE FROM tb_alamat WHERE id_umat='$_POST[id]'");
    $hapus = mysql_query("DELETE FROM tb_ortu WHERE id_umat='$_POST[id]'");
    if($hapus) {
        echo "<script>location='?page=umat'</script>";
    }
}
?>
<div class="inner" style="min-height: 1px">
    <div class="row">
        <div class="col-lg-12">
            <h2><i class="icon-user"></i> Data Umat <small><?=$umat_r;?> Umat</small></h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12">
            <a href="?page=add-umat" class="btn btn-success"><i class="icon-pencil"></i> Tambah Data</a><br><br>
            <div class="panel panel-default">
                <div class="panel-heading">Daftar data umat dalam tabel</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Umat</th>
                                    <th>Nama Keluarga</th>
                                    <th>TTL</th>
                                    <th>Umur</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while($u = mysql_fetch_array($umat)) :
                                $birthday = new DateTime($u['tgl_lhr']);
                                $today = new DateTime();
                                $umur = $today->diff($birthday);
                                $k = mysql_fetch_array(mysql_query("SELECT * FROM tb_keluarga WHERE id='$u[id_keluarga]'")); ?>
                                <tr class="odd gradeX">
                                    <td class="text-center"><?=$no;?></td>
                                    <td><a href="?page=lihat-umat&id=<?=$u['id'];?>"><?=$u['nama_umat'];?></a></td>
                                    <td><a href="?page=lihat-keluarga&id=<?=$k['id'];?>"><?=$k['nama_keluarga'];?></a></td>
                                    <td><?=$u['tmp_lhr'];?>, <?=tgl_indo($u['tgl_lhr']);?></td>
                                    <td class="center"><?= $umur->y . " Tahun"; ?></td>
                                    <td class="text-center">
                                        <a href="?page=lihat-umat&id=<?=$u['id'];?>" title="Detail"><i class="icon-folder-open"></i></a>&nbsp;
                                        <a href="?page=edit-umat&id=<?=$u['id'];?>" title="Edit"><i class="icon-edit"></i></a>&nbsp;
                                        <a href="#" class="open-AddBookDialog" data-id="<?=$u['id'];?>" data-toggle="modal" data-target="#hapus" title="Hapus"><i class="icon-trash"></i></a></td>
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
                            <p>Hapus data umat ?<br>Semua data akan dihapus!</p>
                            <button type="submit" name="hapus" class="btn btn-warning">Lanjutkan</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        </div>                   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>