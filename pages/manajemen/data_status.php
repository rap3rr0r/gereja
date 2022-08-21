<?php
$stat = mysql_query("SELECT * FROM tb_hubungan ORDER BY id ASC");

if(isset($_POST['add'])) {
    $cek = mysql_query("SELECT * FROM tb_hubungan WHERE nama_hubungan='$_POST[nama]'");
    if($ada=mysql_num_rows($cek)>0) {
        echo "<script>window.alert('Maaf, status $_POST[nama] sudah ada. Harap periksa kembali data Anda.')
        location='?page=status'</script>";
    } else {
        mysql_query("INSERT INTO tb_hubungan SET id='',nama_hubungan='$_POST[nama]'");
        echo "<script>location='?page=status'</script>";
    }
}
if(isset($_POST['edit'])) {
    mysql_query("UPDATE tb_hubungan SET nama_hubungan='$_POST[nama]' WHERE id='$_POST[id]'");
    echo "<script>location='?page=status'</script>";
}
if(isset($_POST['hapus'])) {
    mysql_query("DELETE FROM tb_hubungan WHERE id='$_POST[id]'");
    echo "<script>location='?page=status'</script>";
}
?>
<div class="inner" style="min-height: 1px">
    <div class="row">
        <div class="col-lg-12">
            <h2><i class="icon-list-ul"></i> Data Status Keluarga</h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12">
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addStatus"><i class="icon-pencil"></i> Tambah Status</a><br><br>
            <div class="panel panel-default">
                <div class="panel-heading">Daftar status keluarga dalam tabel</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while($s = mysql_fetch_array($stat)) : ?>
                                <tr class="odd gradeX">
                                    <td class="text-center"><?= $no; ?></td>
                                    <td><?= $s['nama_hubungan']; ?></td>
                                    <td class="text-center">
                                        <a class="open-AddBookDialog" data-id="<?=$s['id'];?>" data-id1="<?=$s['nama_hubungan'];?>" data-toggle="modal" data-target="#editStatus" href="#" title="Edit"><i class="icon-edit"></i></a>&nbsp;&nbsp;
                                        <a class="open-AddBookDialog" data-id="<?=$s['id'];?>" data-toggle="modal" data-target="#hapusStatus" href="#" title="Hapus"><i class="icon-trash"></i></a>
                                    </td>
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
    <div class="modal fade" id="addStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-pencil"></i> Add Status</h4>
                </div>
                <div class="modal-body">
                   <form action="" method="POST" class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-lg-3">Nama Status</label>
                            <div class="col-lg-9">
                                <input type="text" name="nama" class="form-control" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-9">
                                <button type="submit" name="add" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>                   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="modal fade" id="editStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-edit"></i> Edit Status</h4>
                </div>
                <div class="modal-body">
                   <form action="" method="POST" class="form-horizontal" role="form">
                    <input type="hidden" name='id' id='bookId'>
                        <div class="form-group">
                            <label class="control-label col-lg-3">Nama Status</label>
                            <div class="col-lg-9">
                                <input type="text" name="nama" id="bookId1" class="form-control" autofocus required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-9">
                                <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>                   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="modal fade" id="hapusStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-trash"></i> Konfirmasi hapus</h4>
                </div>
                <div class="modal-body">
                   <form action="" method="POST" class="form-horizontal" role="form">
                    <input type="hidden" name='id' id='bookId'>
                        <div class="form-group text-center">
                            <p>Anda ingin menghapus status keluarga tersebut ?</p>
                            <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        </div>                   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>