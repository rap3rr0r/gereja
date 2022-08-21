<?php
if(isset($_POST['add'])) {
	$cek = mysql_query("SELECT * FROM tb_umat WHERE nik_umat='$_POST[nik]'");
	if($ada=mysql_num_rows($cek)>0) {
	echo "<script>window.alert('Maaf, data $_POST[nik] sudah ada. Harap periksa kembali data Anda.')
		location='?page=add-umat'</script>";
	} else {
		$status = mysql_fetch_array(mysql_query("SELECT tb_umat.nama_umat,tb_hubungan.id,tb_hubungan.nama_hubungan FROM tb_umat JOIN tb_hubungan ON tb_umat.id_hubungan=tb_hubungan.id WHERE tb_umat.id_keluarga='$_POST[keluarga]' AND tb_hubungan.nama_hubungan='Suami'"));
		if($status['id'] == $_POST['hubungan']) {
			echo "<script>window.alert('Maaf, status suami/istri tidak boleh ganda.')
			location='?page=add-umat'</script>";
		} else {
			$status2 = mysql_fetch_array(mysql_query("SELECT tb_umat.nama_umat,tb_hubungan.id,tb_hubungan.nama_hubungan FROM tb_umat JOIN tb_hubungan ON tb_umat.id_hubungan=tb_hubungan.id WHERE tb_umat.id_keluarga='$_POST[keluarga]' AND tb_hubungan.nama_hubungan='Istri'"));
			if($status2['id'] == $_POST['hubungan']) {
				echo "<script>window.alert('Maaf, status suami/istri tidak boleh ganda.')
				location='?page=add-umat'</script>";
			} else {
				$status3 = mysql_fetch_array(mysql_query("SELECT tb_umat.nama_umat,tb_hubungan.id,tb_hubungan.nama_hubungan FROM tb_umat JOIN tb_hubungan ON tb_umat.id_hubungan=tb_hubungan.id WHERE tb_umat.id_keluarga='$_POST[keluarga]' AND tb_hubungan.nama_hubungan='Kepala Keluarga'"));
				if($status3['id'] == $_POST['hubungan']) {
					echo "<script>window.alert('Maaf, status Kepala Keluarga tidak boleh ganda.')
					location='?page=add-umat'</script>";
				} else {
					$foto = $_FILES['upPhoto']['name'];
					$tmp  = $_FILES['upPhoto']['tmp_name'];
					$newfoto = "umat-" . $_POST['nik'] . "-" . $foto;
					$path = "assets/img/umat/" . $newfoto;
					if(move_uploaded_file($tmp, $path)) {
						$qry = mysql_query("INSERT INTO tb_umat SET id='',id_keluarga='$_POST[keluarga]',id_hubungan='$_POST[hubungan]',id_pernikahan='$_POST[nikah]',nik_umat='$_POST[nik]',nama_umat='$_POST[nama]',jk='$_POST[jk]',agama='$_POST[agama]',tmp_lhr='$_POST[tempat]',tgl_lhr='$_POST[tgl]',pendidikan='$_POST[pendidikan]',negara='$_POST[negara]',pekerjaan='$_POST[pekerjaan]',telp_umat='$_POST[telp]',avatar='$newfoto'");
						if($qry) {
							$last_id = mysql_insert_id();
							echo "<script>location='?page=edit-umat&id=$last_id'</script>";
						}
					} else {
						$qry = mysql_query("INSERT INTO tb_umat SET id='',id_keluarga='$_POST[keluarga]',id_hubungan='$_POST[hubungan]',id_pernikahan='$_POST[nikah]',nik_umat='$_POST[nik]',nama_umat='$_POST[nama]',jk='$_POST[jk]',agama='$_POST[agama]',tmp_lhr='$_POST[tempat]',tgl_lhr='$_POST[tgl]',pendidikan='$_POST[pendidikan]',negara='$_POST[negara]',pekerjaan='$_POST[pekerjaan]',telp_umat='$_POST[telp]'");
						if($qry) {
							$last_id = mysql_insert_id();
							echo "<script>location='?page=edit-umat&id=$last_id'</script>";
						}
					}
				}
			}
		}
	}
}
?>

<div class="inner" style="min-height: 1px">
	<div class="row">
		<div class="col-lg-12">
			<h2>Input Data Umat</h2>
		</div>
	</div><hr>
	<div class="row">
		<div class="col-lg-12">
			<div class="box dark">
				<header>
					<div class="icons"><i class="icon-edit"></i></div>
					<h5>Form input data</h5>
					<div class="toolbar">
						<ul class="nav">
							<li><a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-1"><i class="icon-chevron-up"></i></a></li>
						</ul>
					</div>
				</header>
				<div id="div-1" class="accordion-body collapse in body">
					<form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
						<div class="form-group">
							<label class="control-label col-lg-2">NIK</label>
							<div class="col-lg-8">
								<input type="number" name="nik" class="form-control" placeholder="N I K" autofocus required>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Nama Umat</label>
							<div class="col-lg-8">
								<input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Tempat Tanggal Lahir</label>
							<div class="col-lg-4">
								<input type="text" name="tempat" class="form-control" placeholder="Tempat Lahir" required>
							</div>
							<div class="col-lg-4">
								<input type="date" name="tgl" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Jenis Kelamin</label>
							<div class="col-lg-8">
								<select name="jk" class="form-control select2" tabindex="2" style="width:100%" required>
									<option value=""></option>
									<option value="L">Laki-laki</option>
									<option value="P">Perempuan</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Agama</label>
							<div class="col-lg-8">
								<select name="agama" class="form-control select2" style="width:100%" tabindex="2">
									<option value=""></option>
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
								<select name="keluarga" class="form-control select2" style="width:100%" tabindex="2" required>
									<option value=""></option>
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
								<select name="hubungan" class="form-control select2" style="width:100%" tabindex="2" required>
									<option value=""></option>
									<?php
									$hub = mysql_query("SELECT * FROM tb_hubungan ORDER BY id ASC");
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
								<select name="nikah" class="form-control select2" style="width:100%" tabindex="2">
									<option value=""></option>
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
								<select name="pendidikan" class="form-control select2" style="width:100%" tabindex="2" required>
									<option value=""></option>
									<?php
									$pen = mysql_query("SELECT * FROM tb_pendidikan ORDER BY id ASC");
									while($list=mysql_fetch_array($pen)) : ?>
										<option value="<?=$list['id'];?>"><?= $list['nama_pendidikan']; ?></option>
									<?php endwhile; ?>
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Kewarganegaraan</label>
							<div class="col-lg-8">
								<select name="negara" class="form-control select2" style="width:100%" tabindex="2">
									<option value=""></option>
									<option value="WNI">WNI</option>
									<option value="WNA">WNA</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Pekerjaan</label>
							<div class="col-lg-8">
								<input type="text" name="pekerjaan" class="form-control" placeholder="Jenis Pekerjaan" maxlength="16" required>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Telp</label>
							<div class="col-lg-8">
								<input type="number" name="telp" class="form-control" placeholder="No telp/handphone" maxlength="16" required>
							</div>
						</div>
	                    <div class="form-group">
	                        <label class="control-label col-lg-2">Foto</label>
	                        <div class="col-lg-8">
	                            <div class="fileupload fileupload-new" data-provides="fileupload">
	                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="assets/img/demoUpload.jpg" /></div>
	                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
	                                <div>
	                                    <span class="btn btn-file btn-primary">
	                                    	<span class="fileupload-new">Pilih Gambar</span>
	                                    	<span class="fileupload-exists">Ganti</span>
	                                    	<input type="file" accept=".jpg, .jpeg, .png" name="upPhoto" />
	                                    </span>
	                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Hapus</a>
	                                </div>
	                            </div>
	                        </div>
	                    </div>						
						<div class="form-group">
							<div class="col-lg-8 col-lg-offset-2">
								<button type="submit" name="add" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>&nbsp;&nbsp;<a href="?page=umat" class="btn btn-primary"><i class="icon-undo"></i> Batal</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>
</div>

