<?php
$kp = mysql_query("SELECT tb_keluarga.nama_keluarga,tb_kepemilikan.id FROM tb_keluarga JOIN tb_kepemilikan ON tb_keluarga.id=tb_kepemilikan.id_keluarga ORDER BY tb_keluarga.nama_keluarga ASC");

if(isset($_POST['hapus'])) {
    mysql_query("DELETE FROM tb_kepemilikan WHERE id='$_POST[id]'");
    echo "<script>location='?page=kepemilikan'</script>";
}
?>
<div class="inner" style="min-height: 1px">
    <div class="row">
        <div class="col-lg-12">
            <h2> Data Kepemilikan Alat Doa dan Kartu Kesehatan</h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12">
            <a href="?page=add-kepemilikan" class="btn btn-success"><i class="icon-pencil"></i> Tambah Data</a><br><br>
            <div class="panel panel-default">
                <div class="panel-heading">Daftar data kepemilikan alat doa dan kartu jaminan kesehatan dalam tabel</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Keluarga</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while($list = mysql_fetch_array($kp)) : ?>
                                <tr class="odd gradeX">
                                    <td class="text-center"><?=$no;?></td>
                                    <td><a href="?page=detail-kepemilikan&id=<?=$list['id'];?>"><?= $list['nama_keluarga']; ?></a></td>
                                    <td class="text-center">
                                        <a href="?page=detail-kepemilikan&id=<?=$list['id'];?>" title="Lihat"><i class="icon-folder-open"></i></a>&nbsp;
                                        <a href="?page=edit-kepemilikan&id=<?=$list['id'];?>" title="Edit"><i class="icon-edit"></i></a>&nbsp;
                                        <a href="#" class="open-AddBookDialog" data-id="<?=$list['id'];?>" data-toggle="modal" data-target="#hapus" title="Hapus"><i class="icon-trash"></i></a></td>
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
                    <h4 class="modal-title"><i class="fa fa-warning"></i> Konfirmasi Hapus!</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" role="form">
                        <input type="hidden" name='id' id='bookId'>
                        <div class="form-group text-center">
                            <p>Anda ingin menghapus data kepemilikan ?
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