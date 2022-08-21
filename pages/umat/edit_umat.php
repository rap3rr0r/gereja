<?php
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}
else {
	die ("&nbsp;Error. No Kode Selected! ");
}
$edit = mysql_fetch_array(mysql_query("SELECT * FROM tb_umat JOIN tb_keluarga ON tb_umat.id_keluarga=tb_keluarga.id WHERE tb_umat.id='$id'"));
$agama = mysql_fetch_array(mysql_query("SELECT * FROM tb_agama WHERE id='$edit[agama]'"));
$pend = mysql_fetch_array(mysql_query("SELECT * FROM tb_pendidikan WHERE id='$edit[pendidikan]'"));
$hubu = mysql_fetch_array(mysql_query("SELECT * FROM tb_hubungan WHERE id='$edit[id_hubungan]'"));
$statS = mysql_fetch_array(mysql_query("SELECT * FROM tb_status WHERE id='$edit[id_pernikahan]'"));
$alamat = mysql_fetch_array(mysql_query("SELECT * FROM tb_alamat WHERE id_umat='$id'"));
$ortU = mysql_fetch_array(mysql_query("SELECT * FROM tb_ortu WHERE id_umat='$id'"));
$baptis = mysql_fetch_array(mysql_query("SELECT * FROM tb_baptis WHERE id_umat='$id'"));

if(isset($_POST['update'])) {
	$foto = $_FILES['upPhoto']['name'];
	$tmp  = $_FILES['upPhoto']['tmp_name'];
	$newfoto = "umat-" . $edit['nik_umat'] . "-" . $foto;
	$path = "assets/img/umat/" . $newfoto;
	if(move_uploaded_file($tmp, $path)) {
		if(is_file("assets/img/umat/".$edit['avatar']))
			unlink("assets/img/umat/".$edit['avatar']);
		mysql_query("UPDATE tb_umat SET id_keluarga='$_POST[keluarga]',
			id_hubungan='$_POST[hubungan]',
			id_pernikahan='$_POST[status]',
			jk='$_POST[jk]',
			nama_umat='$_POST[nama]',
			tmp_lhr='$_POST[tempat]',
			tgl_lhr='$_POST[tgl]',
			agama='$_POST[agama]',
			pendidikan='$_POST[pendidikan]',
			pekerjaan='$_POST[pekerjaan]',
			negara='$_POST[negara]',
			telp_umat='$_POST[telp]',
			avatar='$newfoto' WHERE id=$id");
		echo "<script>location='?page=umat&id=$id'</script>";
	} else {
		mysql_query("UPDATE tb_umat SET id_keluarga='$_POST[keluarga]',
			id_hubungan='$_POST[hubungan]',
			id_pernikahan='$_POST[status]',
			jk='$_POST[jk]',
			nama_umat='$_POST[nama]',
			tmp_lhr='$_POST[tempat]',
			tgl_lhr='$_POST[tgl]',
			agama='$_POST[agama]',
			pendidikan='$_POST[pendidikan]',
			pekerjaan='$_POST[pekerjaan]',
			negara='$_POST[negara]',
			telp_umat='$_POST[telp]' WHERE id=$id");
		echo "<script>location='?page=edit-umat&id=$id'</script>";
	}
}

if(isset($_POST['alamat'])) {
	if(empty($alamat['id_umat'])) {
		mysql_query("INSERT INTO tb_alamat SET id_umat='$id',
			jln='$_POST[jln]',
			rtrw='$_POST[rt]',
			desa='$_POST[desa]',
			kec='$_POST[kec]',
			kota='$_POST[kota]',
			kode='$_POST[kode]',
			prov='$_POST[prov]'");
		echo "<script>location='?page=edit-umat&id=$id'</script>";
	} else {
		mysql_query("UPDATE tb_alamat SET jln='$_POST[jln]',
			rtrw='$_POST[rt]',
			desa='$_POST[desa]',
			kec='$_POST[kec]',
			kota='$_POST[kota]',
			kode='$_POST[kode]',
			prov='$_POST[prov]' WHERE id_umat='$id'");
		echo "<script>location='?page=edit-umat&id=$id'</script>";
	}
}

if(isset($_POST['ortu'])) {
	if(empty($ortU['id_umat'])) {
		mysql_query("INSERT INTO tb_ortu SET id_umat='$id',nama_ayah='$_POST[ayah]',nama_ibu='$_POST[ibu]'");
		echo "<script>location='?page=edit-umat&id=$id'</script>";
	} else {
		mysql_query("UPDATE tb_ortu SET nama_ayah='$_POST[ayah]',nama_ibu='$_POST[ibu]' WHERE id_umat='$id'");
		echo "<script>location='?page=edit-umat&id=$id'</script>";
	}
}

if(isset($_POST['simpanbaptis'])) {
	if(empty($baptis['id_umat'])) {
		mysql_query("INSERT INTO tb_baptis SET id_umat='$id',
			imam='$_POST[imam]',
			wali1='$_POST[wali1]',
			wali2='$_POST[wali2]',
			baptis='$_POST[baptis]',
			tgl_baptis='$_POST[tgl_baptis]',
			sakramen='$_POST[sakramen]',
			tgl_sakramen='$_POST[tgl_sakramen]',
			paroki='$_POST[paroki]',
			no_paroki='$_POST[no_paroki]'");
		echo "<script>location='?page=edit-umat&id=$id'</script>";
	} else {
		mysql_query("UPDATE tb_baptis SET imam='$_POST[imam]',
			wali1='$_POST[wali1]',
			wali2='$_POST[wali2]',
			baptis='$_POST[baptis]',
			tgl_baptis='$_POST[tgl_baptis]',
			sakramen='$_POST[sakramen]',
			tgl_sakramen='$_POST[tgl_sakramen]',
			paroki='$_POST[paroki]',
			no_paroki='$_POST[no_paroki]' WHERE id_umat='$id'");
		echo "<script>location='?page=edit-umat&id=$id'</script>";
	}
}
?>

<div class="inner" style="min-height: 1px">
	<div class="row">
		<div class="col-lg-12">
			<h2>Edit Data Umat</h2>
		</div>
	</div><hr>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<span class="lead"><strong><?=$edit['nama_umat'];?></strong></span>
				</div>
				<div class="panel-body">
					<ul class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab">Profil</a></li>
                        <li><a href="#alamat" data-toggle="tab">Alamat Lengkap</a></li>
                        <li><a href="#ortu" data-toggle="tab">Orang Tua</a></li>
                        <li><a href="#baptis" data-toggle="tab">Pembaptisan</a></li>
                    </ul>
                    <div class="tab-content">
                    	<div class="tab-pane fade in active" id="home">
							<form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
								<div class="form-group">
			                        <label class="control-label col-lg-2">Foto</label>
			                        <div class="col-lg-8">
			                            <div class="fileupload fileupload-new" data-provides="fileupload">
			                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
			                                	<?php if($edit['avatar']=="") { ?>
			                                			<img src="assets/img/default.png" />
			                                		<?php } else { ?>
			                                			<img src="assets/img/umat/<?=$edit['avatar'];?>" />
			                                	<?php } ?></div>
			                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
			                                <div>
			                                    <span class="btn btn-file btn-primary"><span class="fileupload-new">Pilih Gambar</span><span class="fileupload-exists">Ganti</span><input type="file" accept=".jpg, .jpeg, .png" name="upPhoto" /></span>
			                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Hapus</a>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
								<div class="form-group">
									<label class="control-label col-lg-2">NIK</label>
									<div class="col-lg-8">
										<input name="nik" value="<?= $edit['nik_umat']; ?>" class="form-control" readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Nama Umat</label>
									<div class="col-lg-8">
										<input type="text" name="nama" value="<?= $edit['nama_umat']; ?>" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Tempat Tanggal Lahir</label>
									<div class="col-lg-4">
										<input type="text" name="tempat" value="<?= $edit['tmp_lhr']; ?>" class="form-control">
									</div>
									<div class="col-lg-4">
										<input type="date" name="tgl" value="<?= $edit['tgl_lhr']; ?>" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Jenis Kelamin</label>
									<div class="col-lg-8">
										<select name="jk" class="form-control chzn-select" tabindex="2">
											<?php
											if($edit['jk']=='L') {
												echo "<option value='$edit[jk]' selected>Laki-laki</option>";
											} else {
												echo "<option value='$edit[jk]' selected>Perempuan</option>";
											}
											?>
											<option value="L">Laki-laki</option>
											<option value="P">Perempan</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Agama</label>
									<div class="col-lg-8">
										<select name="agama" class="form-control chzn-select" tabindex="2">
											<option value="<?= $agama['id']; ?>" selected><?=$agama['nama_agama'];?></option>
											<?php
											$ag = mysql_query("SELECT * FROM tb_agama ORDER BY nama_agama ASC");
											while($list=mysql_fetch_array($ag)) : ?>
												<option value="<?= $list['id']; ?>"><?= $list['nama_agama']; ?></option>
											<?php endwhile; ?>
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Nama Keluarga</label>
									<div class="col-lg-8">
										<select name="keluarga" class="form-control chzn-select" tabindex="2">
											<option value="<?= $edit['id_keluarga']; ?>" selected><?= $edit['nama_keluarga']; ?></option>
											<?php
											$kel = mysql_query("SELECT * FROM tb_keluarga ORDER BY nama_keluarga ASC");
											while($list=mysql_fetch_array($kel)) : ?>
												<option value="<?= $list['id']; ?>"><?= $list['nama_keluarga']; ?></option>
											<?php endwhile; ?>
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Status Keluarga</label>
									<div class="col-lg-8">
										<select name="hubungan" class="form-control chzn-select" tabindex="2">
											<option value="<?= $hubu['id']; ?>" selected><?= $hubu['nama_hubungan']; ?></option>
											<?php
											$hub = mysql_query("SELECT * FROM tb_hubungan ORDER BY nama_hubungan ASC");
											while($list=mysql_fetch_array($hub)) : ?>
												<option value="<?= $list['id']; ?>"><?= $list['nama_hubungan']; ?></option>
											<?php endwhile; ?>
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Status Nikah</label>
									<div class="col-lg-8">
										<select name="status" class="form-control chzn-select" tabindex="2">
											<option value="<?= $statS['id']; ?>" selected><?= $statS['nama_status']; ?></option>
											<?php
											$stat = mysql_query("SELECT * FROM tb_status ORDER BY id ASC");
											while($list=mysql_fetch_array($stat)) : ?>
												<option value="<?= $list['id']; ?>"><?= $list['nama_status']; ?></option>
											<?php endwhile; ?>
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Pendidikan</label>
									<div class="col-lg-8">
										<select name="pendidikan" class="form-control chzn-select" tabindex="2">
											<option value="<?= $pend['id']; ?>" selected><?= $pend['nama_pendidikan']; ?></option>
											<?php
											$pendidikan = mysql_query("SELECT * FROM tb_pendidikan ORDER BY nama_pendidikan ASC");
											while($list=mysql_fetch_array($pendidikan)) : ?>
												<option value="<?= $list['id']; ?>"><?= $list['nama_pendidikan']; ?></option>
											<?php endwhile; ?>
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Kewarganegaraan</label>
									<div class="col-lg-8">
										<select name="negara" class="form-control chzn-select" tabindex="2">
											<option value="<?= $edit['negara']; ?>" selected><?= $edit['negara']; ?></option>
											<option value="WNI">WNI</option>
											<option value="WNA">WNA</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Pekerjaan</label>
									<div class="col-lg-8">
										<input type="text" name="pekerjaan" value="<?= $edit['pekerjaan']; ?>" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Telp</label>
									<div class="col-lg-8">
										<input type="number" name="telp" value="<?= $edit['telp_umat']; ?>" class="form-control" maxlength="16">
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-8 col-lg-offset-2">
										<button type="submit" name="update" class="btn btn-primary"><i class="icon-save"></i> Update</button>&nbsp;&nbsp;<a href="?page=umat" class="btn btn-primary"><i class="icon-undo"></i> Batal</a>
									</div>
								</div>
							</form>
						</div>
						<div class="tab-pane fade" id="alamat">
							<form action="" method="POST" class="form-horizontal">
								<div class="form-group">
									<label class="control-label col-lg-2">Alamat</label>
									<div class="col-lg-8">
										<input type="text" name="jln" value="<?=$alamat['jln'];?>" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">RT/RW</label>
									<div class="col-lg-8">
										<input type="text" name="rt" value="<?=$alamat['rtrw'];?>" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Desa/Kelurahan</label>
									<div class="col-lg-8">
										<input type="text" name="desa" value="<?=$alamat['desa'];?>" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Kecamatan</label>
									<div class="col-lg-8">
										<input type="text" name="kec" value="<?=$alamat['kec'];?>" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Kabupaten/Kota</label>
									<div class="col-lg-8">
										<input type="text" name="kota" value="<?=$alamat['kota'];?>" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Kode Pos</label>
									<div class="col-lg-8">
										<input type="number" name="kode" value="<?=$alamat['kode'];?>" class="form-control" maxlength="6">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Provinsi</label>
									<div class="col-lg-8">
										<input type="text" name="prov" value="<?=$alamat['prov'];?>" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-8 col-lg-offset-2">
										<button type="submit" name="alamat" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>
									</div>
								</div>
							</form>
						</div>
						<div class="tab-pane fade" id="ortu">
							<form action="" method="POST" class="form-horizontal">
								<div class="form-group">
									<label class="control-label col-lg-2">Nama Ayah</label>
									<div class="col-lg-8">
										<input type="text" name="ayah" value="<?=$ortU['nama_ayah'];?>" class="form-control" placeholder="Nama lengkap ayah">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Nama Ibu</label>
									<div class="col-lg-8">
										<input type="text" name="ibu" value="<?=$ortU['nama_ibu'];?>" class="form-control" placeholder="Nama lengkap ibu">
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-8 col-lg-offset-2">
										<button type="submit" name="ortu" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>
									</div>
								</div>
							</form>
						</div>
                    	<div class="tab-pane fade" id="baptis">
							<form action="" method="POST" class="form-horizontal">
								<div class="form-group">
									<label class="control-label col-lg-2">yang Membaptis</label>
									<div class="col-lg-8">
										<select name="imam" class="form-control select2" style="width:100%" required>
											<option value="<?=$baptis['imam'];?>" selected><?=$baptis['imam'];?></option>
											<?php
											$imam = mysql_query("SELECT tb_pengurus.id, tb_umat.nama_umat FROM tb_pengurus JOIN tb_umat ON tb_pengurus.id_pengurus=tb_umat.id ORDER BY tb_umat.nama_umat ASC");
											while($list=mysql_fetch_array($imam)) : ?>
												<option value="<?= $list['nama_umat']; ?>"><?= $list['nama_umat']; ?></option>
											<?php endwhile; ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Pembaptisan di</label>
									<div class="col-lg-4">
										<input type="text" name="baptis" value="<?=$baptis['baptis'];?>" class="form-control" placeholder="Tempat baptis">
									</div>
									<div class="col-lg-4">
										<input type="date" name="tgl_baptis" value="<?=$baptis['tgl_baptis'];?>" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Sakramen Krisma di</label>
									<div class="col-lg-4">
										<input type="text" name="sakramen" value="<?=$baptis['sakramen'];?>" class="form-control" placeholder="Tempat sakramen">
									</div>
									<div class="col-lg-4">
										<input type="date" name="tgl_sakramen" value="<?=$baptis['tgl_sakramen'];?>" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Wali Baptis I</label>
									<div class="col-lg-8">
										<select name="wali1" class="form-control select2" style="width:100%" required>
											<option value="<?=$baptis['wali1'];?>" selected><?=$baptis['wali1'];?></option>
											<?php
											$wali1P = mysql_query("SELECT nama_umat FROM tb_umat ORDER BY nama_umat ASC");
											while($list=mysql_fetch_array($wali1P)) : ?>
												<option value="<?=$list['nama_umat'];?>"><?=$list['nama_umat'];?></option>
											<?php endwhile; ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Wali Baptis II</label>
									<div class="col-lg-8">
										<select name="wali2" class="form-control select2" style="width:100%" required>
											<option value="<?=$baptis['wali2'];?>" selected><?=$baptis['wali2'];?></option>
											<?php
											$wali2P = mysql_query("SELECT nama_umat FROM tb_umat ORDER BY nama_umat ASC");
											while($list=mysql_fetch_array($wali2P)) : ?>
												<option value="<?=$list['nama_umat'];?>"><?=$list['nama_umat'];?></option>
											<?php endwhile; ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Buku Permandian</label>
									<div class="col-lg-8">
										<input type="text" name="paroki" value="<?=$baptis['paroki'];?>" class="form-control" placeholder="Nama Paroki">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Nomor</label>
									<div class="col-lg-8">
										<input type="text" name="no_paroki" value="<?=$baptis['no_paroki'];?>" class="form-control" placeholder="Nomor">
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-8 col-lg-offset-2">
										<button type="submit" name="simpanbaptis" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>
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