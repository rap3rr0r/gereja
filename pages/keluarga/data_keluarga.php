<?php
$kel = mysql_query("SELECT * FROM tb_keluarga ORDER BY nama_keluarga ASC");
$kelR = mysql_num_rows($kel);

if(isset($_POST['add'])) {
    $cek = mysql_query("SELECT * FROM tb_keluarga WHERE nama_keluarga='$_POST[nama]'");
    if($ada=mysql_num_rows($cek)>0) {
        echo "<script>window.alert('Maaf, keluarga $_POST[nama] sudah ada. Harap periksa kembali data Anda.')
        location='?page=keluarga'</script>";
    } else {
        mysql_query("INSERT INTO tb_keluarga SET id='',nama_keluarga='$_POST[nama]'");
        echo "<script>location='?page=keluarga'</script>";
    }
}
if(isset($_POST['edit'])) {
    mysql_query("UPDATE tb_keluarga SET nama_keluarga='$_POST[nama]' WHERE id='$_POST[id]'");
    echo "<script>location='?page=keluarga'</script>";
}
if(isset($_POST['hapus'])) {
    $del = mysql_fetch_array(mysql_query("SELECT * FROM tb_umat WHERE id_keluarga='$_POST[id]'"));
    if(is_file("assets/img/umat/".$del['avatar']))
        unlink("assets/img/umat/".$del['avatar']);
    $delete = mysql_query("DELETE FROM tb_umat WHERE id_keluarga='$_POST[id]'");
    $delete = mysql_query("DELETE FROM tb_keluarga WHERE id='$_POST[id]'");
    $delete = mysql_query("DELETE FROM tb_pengurus WHERE id_pengurus='$_POST[id]'");
    $delete = mysql_query("DELETE FROM tb_alamat WHERE id_umat='$_POST[id]'");
    $delete = mysql_query("DELETE FROM tb_ortu WHERE id_umat='$_POST[id]'");
    $delete = mysql_query("DELETE FROM tb_kepemilikan WHERE id_keluarga='$_POST[id]'");
    if($delete) {
        echo "<script>location='?page=keluarga'</script>";
    }
}
?>
<div class="inner" style="min-height: 1px">
    <div class="row">
        <div class="col-lg-12">
            <h2> Data Keluarga <small><?=$kelR;?> Keluarga</small></h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12">
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addKeluarga"><i class="icon-pencil"></i> Tambah Data</a><br><br>
            <div class="panel panel-default">
                <div class="panel-heading">Daftar data keluarga dalam tabel</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama</th>
                                    <th>Anggota Keluarga</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while($k = mysql_fetch_array($kel)) :
                                $rst = $k['id'];
                                $r=mysql_num_rows(mysql_query("SELECT * FROM tb_umat WHERE id_keluarga='$rst'")); ?>
                                <tr class="odd gradeX">
                                    <td class="text-center"><?= $no; ?></td>
                                    <td><a href="?page=lihat-keluarga&id=<?=$k['id'];?>"><?= $k['nama_keluarga']; ?></a></td>
                                    <td class="text-center"><?php if($r>0){echo"$r Orang";}else{echo"--";} ?></td>
                                    <td class="text-center">
                                        <a href="?page=lihat-keluarga&id=<?=$k['id'];?>" title="Lihat"><i class="icon-folder-open"></i></a>&nbsp;
                                        <a href="#" class="open-AddBookDialog" data-id="<?=$k['id'];?>" data-id1="<?=$k['nama_keluarga'];?>" data-toggle="modal" data-target="#editKeluarga" title="Edit"><i class="icon-edit"></i></a>&nbsp;
                                        <a href="#" class="open-AddBookDialog" data-id="<?=$k['id'];?>" data-toggle="modal" data-target="#hapus" title="Hapus"><i class="icon-trash"></i></a></td>
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

<div class="col-lg-12">
    <div class="modal fade" id="addKeluarga" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-pencil"></i> Add Keluarga</h4>
                </div>
                <div class="modal-body">
                   <form action="" method="POST" class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-lg-3">Nama Keluarga</label>
                            <div class="col-lg-9">
                                <input type="text" name="nama" class="form-control" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-9 col-lg-offset-3">
                                <button type="submit" name="add" class="btn btn-primary">Tambah</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            </div>
                        </div>                   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="modal fade" id="editKeluarga" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="icon-edit"></i> Edit Keluarga</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" role="form">
                        <input type="hidden" name='id' id='bookId'>
                        <div class="form-group">
                            <label>Nama Keluarga</label>
                            <input type="text" name="nama" id="bookId1" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>                   
                    </form>
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
                    <h4 class="modal-title"><i class="fa fa-warning"></i> Konfirmasi Hapus!</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" role="form">
                        <input type="hidden" name='id' id='bookId'>
                        <div class="form-group text-center">
                            <p>Anda yakin ingin menghapus ?<br>Semua data-data keluarga akan dihapus!
                            </p>
                            <button type="submit" name="hapus" class="btn btn-warning">Lanjutkan</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        </div>                   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>