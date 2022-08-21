<?php
$peng = mysql_query("SELECT tb_pengurus.id,tb_pengurus.id_jabatan, tb_umat.nama_umat, tb_jabatan.nama_jabatan FROM tb_pengurus INNER JOIN tb_umat ON tb_pengurus.id_pengurus=tb_umat.id JOIN tb_jabatan ON tb_pengurus.id_jabatan=tb_jabatan.id ORDER BY tb_umat.nama_umat ASC");

if(isset($_POST['add'])) {
    $cek = mysql_query("SELECT * FROM tb_pengurus WHERE id_pengurus='$_POST[nama]'");
    if($ada=mysql_num_rows($cek)>0) {
        echo "<script>window.alert('Maaf, pengurus tersebut sudah terdaftar. Harap periksa kembali data Anda.')
        location='?page=pengurus'</script>";
    } else {
        mysql_query("INSERT INTO tb_pengurus SET id='',id_pengurus='$_POST[nama]',id_jabatan='$_POST[jabatan]'");
        echo "<script>location='?page=pengurus'</script>";
    }
}
if(isset($_POST['edit'])) {
    mysql_query("UPDATE tb_pengurus SET id_jabatan='$_POST[jabatan]' WHERE id='$_POST[id]'");
    echo "<script>location='?page=pengurus'</script>";
}
if(isset($_POST['hapus'])) {
    mysql_query("DELETE FROM tb_pengurus WHERE id='$_POST[id]'");
    echo "<script>location='?page=pengurus'</script>";
}
?>
<div class="inner" style="min-height: 1px">
    <div class="row">
        <div class="col-lg-12">
            <h2><i class="icon-wrench"></i> Data Pengurus</h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12">
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addPengurus"><i class="icon-pencil"></i> Tambah Pengurus</a><br><br>
            <div class="panel panel-default">
                <div class="panel-heading">Daftar data pengurus dalam tabel</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Pengurus</th>
                                    <th>Jabatan</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while($p = mysql_fetch_array($peng)) : ?>
                                <tr class="odd gradeX">
                                    <td class="text-center"><?= $no; ?></td>
                                    <td><?= $p['nama_umat']; ?></td>
                                    <td><?= $p['nama_jabatan']; ?></td>
                                    <td class="text-center">
                                        <a class="open-AddBookDialog" data-id="<?=$p['id'];?>" data-id1="<?=$p['nama_umat'];?>" data-id2="<?=$p['id_jabatan'];?>" data-toggle="modal" data-target="#editPengurus" href="#" title="Edit"><i class="icon-edit"></i></a>&nbsp;&nbsp;
                                        <a class="open-AddBookDialog" data-id="<?=$p['id'];?>" data-toggle="modal" data-target="#hapusPengurus" href="#" title="Hapus"><i class="icon-trash"></i></a></td>
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
    <div class="modal fade" id="addPengurus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-pencil"></i> Add Pengurus</h4>
                </div>
                <div class="modal-body">
                   <form action="" method="POST" class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-lg-2">Pengurus</label>
                            <div class="col-lg-10">
                                <select name="nama" id="" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <?php
                                    $pen = mysql_query("SELECT * FROM tb_umat ORDER BY nama_umat ASC");
                                    while($list=mysql_fetch_array($pen)) : ?>
                                        <option value="<?= $list['id']; ?>"><?= $list['nama_umat']; ?></option>
                                    <?php endwhile; ?>
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Jabatan</label>
                            <div class="col-lg-10">
                                <select name="jabatan" class="form-control select2" style="width:100%">
                                    <?php
                                    $jab = mysql_query("SELECT * FROM tb_jabatan ORDER BY nama_jabatan ASC");
                                    while($list=mysql_fetch_array($jab)) : ?>
                                        <option value="<?= $list['id']; ?>"><?= $list['nama_jabatan']; ?></option>
                                    <?php endwhile; ?>
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="submit" name="add" class="btn btn-primary">Tambah</button>
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
    <div class="modal fade" id="editPengurus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-edit"></i> Edit Pengurus</h4>
                </div>
                <div class="modal-body">
                   <form action="" method="POST" class="form-horizontal" role="form">
                    <input type="hidden" name='id' id='bookId'>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Pengurus</label>
                            <div class="col-lg-10">
                                <input type="text" name="nama" id="bookId1" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Jabatan</label>
                            <div class="col-lg-10">
                                <select name="jabatan" id="bookId2" class="form-control select2" style="width:100%">
                                    <option id="bookId2" selected>-- Jabatan --</option>
                                    <?php
                                    $jabb = mysql_query("SELECT * FROM tb_jabatan ORDER BY nama_jabatan ASC");
                                    while($list=mysql_fetch_array($jabb)) : ?>
                                        <option value="<?= $list['id']; ?>"><?= $list['nama_jabatan']; ?></option>
                                    <?php endwhile; ?>
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-10">
                                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
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
    <div class="modal fade" id="hapusPengurus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            <p>Hapus data pengurus ?</p>
                            <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        </div>                   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>