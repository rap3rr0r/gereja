<?php
$kel = mysql_query("SELECT * FROM tb_keluarga ORDER BY nama_keluarga ASC");
$kelR = mysql_num_rows($kel);
?>
<div class="inner" style="min-height: 1px">
    <div class="row">
        <div class="col-lg-12">
            <h2><i class="icon-print"></i> Cetak Kartu Keluarga <small><?=$kelR;?> Keluarga</small></h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Daftar data keluarga dalam tabel</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Keluarga</th>
                                    <th>Anggota Keluarga</th>
                                    <th class="text-center">Cetak</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while($k = mysql_fetch_array($kel)) :
                                $rst = $k['id'];
                                $r=mysql_num_rows(mysql_query("SELECT * FROM tb_umat WHERE id_keluarga='$rst'")); ?>
                                <tr class="odd gradeX">
                                    <td class="text-center" style="vertical-align: middle;"><?= $no; ?></td>
                                    <td style="vertical-align: middle;"><a href="?page=lihat-keluarga&id=<?=$k['id'];?>"><?= $k['nama_keluarga']; ?></a></td>
                                    <td class="text-center" style="vertical-align: middle;"><?php if($r>0){echo"$r Orang";}else{echo"--";} ?></td>
                                    <td class="text-center">
                                        <a href="#" class="open-AddBookDialog btn btn-success" data-id="<?=$k['id'];?>" data-toggle="modal" data-target="#cetak" title="Print"><i class="icon-print"></i> Kartu Keluarga</a></td>
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
    <div class="modal fade" id="cetak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-print"></i> Pilih Tanda Tangan</h4>
                </div>
                <div class="modal-body">
                   <form action="pages/report/print_kk.php" target="_blank" method="$_GET" class="form-horizontal" role="form">
                    <input type="hidden" name='id' id='bookId'>
                        <div class="form-group">
                            <label class="control-label col-lg-3">Nama Pengurus</label>
                            <div class="col-lg-9">
                                <select name="pengurus" class="form-control select2" style="width:100%">
                                    <option value=""></option>
                                    <?php
                                    $pengP = mysql_query("SELECT tb_pengurus.id_pengurus,tb_umat.nama_umat FROM tb_pengurus JOIN tb_umat ON tb_pengurus.id_pengurus=tb_umat.id ORDER BY tb_umat.nama_umat ASC");
                                    while($list=mysql_fetch_array($pengP)) : ?>
                                        <option value="<?= $list['id_pengurus']; ?>"><?= $list['nama_umat']; ?></option>
                                    <?php endwhile; ?>
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-9">
                                <button type="submit" class="btn btn-primary">Cetak</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            </div>
                        </div>                   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>