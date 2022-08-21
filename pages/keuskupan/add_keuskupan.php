<?php
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}
else {
	die ("&nbsp;Error. No Kode Selected! ");
}
$uskup = mysql_fetch_array(mysql_query("SELECT * FROM tb_keuskupan WHERE id='$id'"));
$surat = mysql_fetch_array(mysql_query("SELECT * FROM tb_surat_nikah WHERE id_nikah='$id'"));
$pria = mysql_fetch_array(mysql_query("SELECT * FROM tb_nikah WHERE status='Pria' AND id_nikah='$id'"));
$wanita = mysql_fetch_array(mysql_query("SELECT * FROM tb_nikah WHERE status='Wanita' AND id_nikah='$id'"));

if(isset($_POST['uskup'])) {
	if(empty($surat['id_nikah'])) {
		mysql_query("INSERT INTO tb_surat_nikah SET id_nikah='$id',imam='$_POST[imam]',no_surat='$_POST[no]',buku='$_POST[buku]',tahun='$_POST[tahun]',gereja='$_POST[gereja]',tempat='$_POST[tempat]'");
		echo "<script>location='?page=add-keuskupan&id=$id'</script>";
	}else {
		mysql_query("UPDATE tb_surat_nikah SET imam='$_POST[imam]',no_surat='$_POST[no]',buku='$_POST[buku]',tahun='$_POST[tahun]',gereja='$_POST[gereja]',tempat='$_POST[tempat]' WHERE id_nikah='$id'");
		echo "<script>location='?page=add-keuskupan&id=$id'</script>";
	}
}

if(isset($_POST['pria'])) {
	if(empty($pria['status'])) {
		mysql_query("INSERT INTO tb_nikah SET id_nikah='$id',status='Pria',tmp_lhr='$_POST[tempat]',tgl_lhr='$_POST[tgl]',ayah='$_POST[ayah]',ibu='$_POST[ibu]',imam='$_POST[imam]',tgl_baptis='$_POST[tgl_baptis]',tgl_sakramen='$_POST[tgl_sakramen]',sakramen='$_POST[sakramen]',wali1='$_POST[wali1]',wali2='$_POST[wali2]'");
		echo "<script>location='?page=add-keuskupan&id=$id'</script>";
	} else {
		mysql_query("UPDATE tb_nikah SET tmp_lhr='$_POST[tempat]',tgl_lhr='$_POST[tgl]',ayah='$_POST[ayah]',ibu='$_POST[ibu]',imam='$_POST[imam]',tgl_baptis='$_POST[tgl_baptis]',tgl_sakramen='$_POST[tgl_sakramen]',sakramen='$_POST[sakramen]',wali1='$_POST[wali1]',wali2='$_POST[wali2]' WHERE status='Pria' AND id_nikah='$id'");
		echo "<script>location='?page=add-keuskupan&id=$id'</script>";
	}
}

if(isset($_POST['wanita'])) {
	if(empty($wanita['status'])) {
		mysql_query("INSERT INTO tb_nikah SET id_nikah='$id',status='Wanita',tmp_lhr='$_POST[tempat]',tgl_lhr='$_POST[tgl]',ayah='$_POST[ayah]',ibu='$_POST[ibu]',imam='$_POST[imam]',tgl_baptis='$_POST[tgl_baptis]',tgl_sakramen='$_POST[tgl_sakramen]',sakramen='$_POST[sakramen]',wali1='$_POST[wali1]',wali2='$_POST[wali2]'");
		echo "<script>location='?page=add-keuskupan&id=$id'</script>";
	} else {
		mysql_query("UPDATE tb_nikah SET tmp_lhr='$_POST[tempat]',tgl_lhr='$_POST[tgl]',ayah='$_POST[ayah]',ibu='$_POST[ibu]',imam='$_POST[imam]',tgl_baptis='$_POST[tgl_baptis]',tgl_sakramen='$_POST[tgl_sakramen]',sakramen='$_POST[sakramen]',wali1='$_POST[wali1]',wali2='$_POST[wali2]' WHERE status='Wanita' AND id_nikah='$id'");
		echo "<script>location='?page=add-keuskupan&id=$id'</script>";
	}
}
?>

<div class="inner" style="min-height: 1px">
	<div class="row">
		<div class="col-lg-12">
			<h2>Input Data Pernikahan</h2>
		</div>
	</div><hr>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<span class="lead">Pernikahan dari pasangan <strong><?=$uskup['m_pria'];?></strong> dan <strong><?=$uskup['m_wanita'];?></strong> <a href="?page=keuskupan" class="btn btn-success pull-right hidden-xs"><i class="icon-ok"></i> Simpan</a></span>
				</div>
				<div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab">Keuskupan</a>
                        </li>
                        <li><a href="#pria" data-toggle="tab">Mempelai Pria</a>
                        </li>
                        <li><a href="#wanita" data-toggle="tab">Mempelai Wanita</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                    	<div class="tab-pane fade in active" id="home">
							<form action="" method="POST" class="form-horizontal">
								<h4>Keuskupan Agung Merauke</h4>
								<div class="form-group">
									<label class="control-label col-lg-2">Tanggal Pernikahan</label>
									<div class="col-lg-4">
										<p class="control-label" style="text-align: left !important">: <?= tgl_indo($uskup['tgl_nikah']); ?></p>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Di hadapan Imam</label>
									<div class="col-lg-8">
										<select name="imam" class="form-control select2" style="width:100%">
											<option value="<?=$surat['imam'];?>" selected><?=$surat['imam'];?></option>
											<?php
											$hub = mysql_query("SELECT tb_pengurus.id, tb_umat.nama_umat FROM tb_pengurus JOIN tb_umat ON tb_pengurus.id_pengurus=tb_umat.id ORDER BY tb_umat.nama_umat ASC");
											while($list=mysql_fetch_array($hub)) : ?>
												<option value="<?= $list['nama_umat']; ?>"><?= $list['nama_umat']; ?></option>
											<?php endwhile; ?>
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Buku</label>
									<div class="col-lg-8">
										<input type="text" name="buku" class="form-control" value="<?=$surat['buku'];?>" placeholder="Nama Buku" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Nomor</label>
									<div class="col-lg-8">
										<input type="text" name="no" class="form-control" value="<?=$surat['no_surat'];?>" placeholder="Nomor Buku" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Tahun</label>
									<div class="col-lg-8">
										<input type="number" name="tahun" class="form-control" value="<?=$surat['tahun'];?>" placeholder="Tahun" required>
									</div>
								</div><hr>
								<h4>Kutipan Dari Buku Perkawinan</h4>
								<div class="form-group">
									<label class="control-label col-lg-2">Gereja</label>
									<div class="col-lg-8">
										<input type="text" name="gereja" class="form-control" value="<?=$surat['gereja'];?>" placeholder="Nama Gereja" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Di</label>
									<div class="col-lg-8">
										<input type="text" name="tempat" class="form-control" value="<?=$surat['tempat'];?>" required>
									</div>
								</div>				
								<div class="form-group">
									<div class="col-lg-2"></div>
									<div class="col-lg-8">
										<button type="submit" name="uskup" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>&nbsp;&nbsp;<button type="reset" class="btn btn-default"><i class="icon-refresh"></i> Reset</button>
									</div>
								</div>
							</form>
						</div>
						<div class="tab-pane fade" id="pria">
							<form action="" method="POST" class="form-horizontal">
								<div class="form-group">
									<label class="control-label col-lg-2">Nama Mempelai</label>
									<div class="col-lg-4">
										<p class="control-label" style="text-align: left !important">: <?=$uskup['m_pria'];?></p>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">T T L</label>
									<div class="col-lg-4">
										<input type="text" name="tempat" class="form-control" value="<?=$pria['tmp_lhr'];?>" placeholder="Tempat lahir" required>
									</div>
									<div class="col-lg-4">
										<input type="date" name="tgl" class="form-control" value="<?=$pria['tgl_lhr'];?>" placeholder="Tempat lahir" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Nama Ayah</label>
									<div class="col-lg-8">
										<input type="text" name="ayah" class="form-control" value="<?=$pria['ayah'];?>" placeholder="Nama Ayah" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Nama Ibu</label>
									<div class="col-lg-8">
										<input type="text" name="ibu" class="form-control" value="<?=$pria['ibu'];?>" placeholder="Nama Ibu" required>
									</div>
								</div><hr>
								<h4>Pembaptisan</h4>
								<div class="form-group">
									<label class="control-label col-lg-2">Yang Membaptis</label>
									<div class="col-lg-8">
										<select name="imam" class="form-control select2" style="width:100%" required>
											<option value="<?=$pria['imam'];?>" selected><?=$pria['imam'];?></option>
											<?php
											$imamP = mysql_query("SELECT tb_pengurus.id, tb_umat.nama_umat FROM tb_pengurus JOIN tb_umat ON tb_pengurus.id_pengurus=tb_umat.id ORDER BY tb_umat.nama_umat ASC");
											while($list=mysql_fetch_array($imamP)) : ?>
												<option value="<?= $list['nama_umat']; ?>"><?= $list['nama_umat']; ?></option>
											<?php endwhile; ?>
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Tanggal Baptis</label>
									<div class="col-lg-8">
										<input type="date" name="tgl_baptis" class="form-control" value="<?=$pria['tgl_baptis'];?>" placeholder="Tanggal Baptis" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Sakramen Krisma</label>
									<div class="col-lg-8">
										<input type="date" name="tgl_sakramen" class="form-control" value="<?=$pria['tgl_sakramen'];?>" placeholder="Tanggal Sakramen Krisma" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Di</label>
									<div class="col-lg-8">
										<input type="text" name="sakramen" class="form-control" value="<?=$pria['sakramen'];?>" placeholder="Tempat Sakramen Krisma" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Wali Baptis 1</label>
									<div class="col-lg-8">
										<select name="wali1" class="form-control select2" style="width:100%" required>
											<option value="<?=$pria['wali1'];?>" selected><?=$pria['wali1'];?></option>
											<?php
											$wali1P = mysql_query("SELECT nama_umat FROM tb_umat ORDER BY nama_umat ASC");
											while($list=mysql_fetch_array($wali1P)) : ?>
												<option value="<?= $list['nama_umat']; ?>"><?= $list['nama_umat']; ?></option>
											<?php endwhile; ?>
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Wali Baptis 2</label>
									<div class="col-lg-8">
										<select name="wali2" class="form-control select2" style="width:100%" required>
											<option value="<?=$pria['wali2'];?>" selected><?=$pria['wali2'];?></option>
											<?php
											$wali2P = mysql_query("SELECT nama_umat FROM tb_umat ORDER BY nama_umat ASC");
											while($list=mysql_fetch_array($wali2P)) : ?>
												<option value="<?= $list['nama_umat']; ?>"><?= $list['nama_umat']; ?></option>
											<?php endwhile; ?>
											?>
										</select>
									</div>
								</div>				
								<div class="form-group">
									<div class="col-lg-2"></div>
									<div class="col-lg-8">
										<button type="submit" name="pria" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>&nbsp;&nbsp;<button type="reset" class="btn btn-default"><i class="icon-refresh"></i> Reset</button>
									</div>
								</div>
							</form>
						</div>
						<div class="tab-pane fade" id="wanita">
							<form action="" method="POST" class="form-horizontal">
								<div class="form-group">
									<label class="control-label col-lg-2">Nama Mempelai</label>
									<div class="col-lg-4">
										<p class="control-label" style="text-align: left !important">: <?=$uskup['m_wanita'];?></p>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">T T L</label>
									<div class="col-lg-4">
										<input type="text" name="tempat" class="form-control" value="<?=$wanita['tmp_lhr'];?>" placeholder="Tempat lahir" required>
									</div>
									<div class="col-lg-4">
										<input type="date" name="tgl" class="form-control" value="<?=$wanita['tgl_lhr'];?>" placeholder="Tempat lahir" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Nama Ayah</label>
									<div class="col-lg-8">
										<input type="text" name="ayah" class="form-control" value="<?=$wanita['ayah'];?>" placeholder="Nama Ayah" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Nama Ibu</label>
									<div class="col-lg-8">
										<input type="text" name="ibu" class="form-control" value="<?=$wanita['ibu'];?>" placeholder="Nama Ibu" required>
									</div>
								</div><hr>
								<h4>Pembaptisan</h4>
								<div class="form-group">
									<label class="control-label col-lg-2">Yang Membaptis</label>
									<div class="col-lg-8">
										<select name="imam" class="form-control select2" style="width:100%" required>
											<option value="<?=$wanita['imam'];?>" selected><?=$wanita['imam'];?></option>
											<?php
											$imamW = mysql_query("SELECT tb_pengurus.id, tb_umat.nama_umat FROM tb_pengurus JOIN tb_umat ON tb_pengurus.id_pengurus=tb_umat.id ORDER BY tb_umat.nama_umat ASC");
											while($list=mysql_fetch_array($imamW)) : ?>
												<option value="<?= $list['nama_umat']; ?>"><?= $list['nama_umat']; ?></option>
											<?php endwhile; ?>
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Tanggal Baptis</label>
									<div class="col-lg-8">
										<input type="date" name="tgl_baptis" class="form-control" value="<?=$wanita['tgl_baptis'];?>" placeholder="Tanggal Baptis" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Sakramen Krisma</label>
									<div class="col-lg-8">
										<input type="date" name="tgl_sakramen" class="form-control" value="<?=$wanita['tgl_sakramen'];?>" placeholder="Tanggal Sakramen Krisma" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Di</label>
									<div class="col-lg-8">
										<input type="text" name="sakramen" class="form-control" value="<?=$wanita['sakramen'];?>" placeholder="Tempat Sakramen Krisma" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Wali Baptis 1</label>
									<div class="col-lg-8">
										<select name="wali1" class="form-control select2" style="width:100%" required>
											<option value="<?=$wanita['wali1'];?>" selected><?=$wanita['wali1'];?></option>
											<?php
											$wali1W = mysql_query("SELECT nama_umat FROM tb_umat ORDER BY nama_umat ASC");
											while($list=mysql_fetch_array($wali1W)) : ?>
												<option value="<?= $list['nama_umat']; ?>"><?= $list['nama_umat']; ?></option>
											<?php endwhile; ?>
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Wali Baptis 2</label>
									<div class="col-lg-8">
										<select name="wali2" class="form-control select2" style="width:100%" required>
											<option value="<?=$wanita['wali2'];?>" selected><?=$wanita['wali2'];?></option>
											<?php
											$wali2W = mysql_query("SELECT nama_umat FROM tb_umat ORDER BY nama_umat ASC");
											while($list=mysql_fetch_array($wali2W)) : ?>
												<option value="<?= $list['nama_umat']; ?>"><?= $list['nama_umat']; ?></option>
											<?php endwhile; ?>
											?>
										</select>
									</div>
								</div>			
								<div class="form-group">
									<div class="col-lg-2"></div>
									<div class="col-lg-8">
										<button type="submit" name="wanita" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>&nbsp;&nbsp;<button type="reset" class="btn btn-default"><i class="icon-refresh"></i> Reset</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

