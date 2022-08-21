<?php
$uskup = mysql_query("SELECT * FROM tb_keuskupan ORDER BY tgl_nikah DESC");
if(isset($_POST['add'])) {
    $qry = mysql_query("INSERT INTO tb_keuskupan SET m_pria='$_POST[pria]',m_wanita='$_POST[wanita]',tgl_nikah='$_POST[tgl]'");
    if($qry) {
        $last_id = mysql_insert_id();
        echo "<script>location='?page=add-keuskupan&id=$last_id'</script>";
    }
}
if(isset($_POST['hapus'])) {
    $delete = mysql_query("DELETE FROM tb_keuskupan WHERE id='$_POST[id]'");
    $delete = mysql_query("DELETE FROM tb_nikah WHERE id_nikah='$_POST[id]'");
    $delete = mysql_query("DELETE FROM tb_surat_nikah WHERE id_nikah='$_POST[id]'");
    if($delete) {
        echo "<script>location='?page=keuskupan'</script>";
    }
}
?>
<div class="inner" style="min-height: 1px">
    <div class="row">
        <div class="col-lg-12">
            <h2><i class="icon-calendar"></i> Data Keuskupan</h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12">
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addNikah"><i class="icon-pencil"></i> Tambah Data</a><br><br>
            <div class="panel panel-default">
                <div class="panel-heading">Daftar data keuskupan dalam tabel</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Mempelai Pria</th>
                                    <th>Mempelai Wanita</th>
                                    <th>Tanggal Nikah</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while($u = mysql_fetch_array($uskup)) : ?>
                                <tr class="odd gradeX tengah">
                                    <td class="text-center" style="vertical-align: middle;"><?=$no;?></td>
                                    <td style="vertical-align: middle;"><?=$u['m_pria'];?></td>
                                    <td style="vertical-align: middle;"><?=$u['m_wanita'];?></td>
                                    <td style="vertical-align: middle;"><?=tgl_indo($u['tgl_nikah']);?></td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        <a href="?page=lihat-keuskupan&id=<?=$u['id'];?>"><i class="icon-folder-open"></i></a>&nbsp;
                                        <a href="?page=add-keuskupan&id=<?=$u['id'];?>"><i class="icon-edit"></i></a>&nbsp;
                                        <a href="#" class="open-AddBookDialog" data-id="<?=$u['id'];?>" data-toggle="modal" data-target="#hapus" title="Hapus"><i class="icon-trash"></i></a>
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

<!-- Modal add nikah -->
<div class="col-lg-12">
    <div class="modal fade" id="addNikah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-pencil"></i> Add Pernikahan</h4>
                </div>
                <div class="modal-body">
                   <form action="" method="POST" class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-4">Mempelai Pria</label>
                            <div class="col-sm-8">
                                <input type="text" name="pria" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4">Mempelai Wanita</label>
                            <div class="col-sm-8">
                                <input type="text" name="wanita" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4">Tanggal Pernikahan</label>
                            <div class="col-sm-8">
                                <input type="date" name="tgl" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-4">
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

<!-- Modal hapus -->
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
                            <p>Anda yakin ingin menghapus ?<br>Seluruh data tersebut akan dihapus!
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