<?php
if(isset($_POST['add'])) {
	$cek = mysql_query("SELECT * FROM tb_kepemilikan WHERE id_keluarga='$_POST[a]'");
	if($ada=mysql_num_rows($cek)>0) {
	echo "<script>window.alert('Maaf, data sudah ada. Harap periksa kembali data Anda.')
		location='?page=add-kepemilikan'</script>";
	} else {
		mysql_query("INSERT INTO tb_kepemilikan SET id='',
			id_keluarga	='$_POST[a]',
			k_salib		='$_POST[b]',
			k_kitab		='$_POST[c]',
			k_buku		='$_POST[d]',
			k_rosaria	='$_POST[e]',
			k_jamkes	='$_POST[f]'");
		echo "<script>location='?page=kepemilikan'</script>";
	}
}
?>

<div class="inner" style="min-height: 1px">
	<div class="row">
		<div class="col-lg-12">
			<h2>Input Data Kepemilikan Alat Doa dan Kartu Kesehatan</h2>
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
					<form action="" method="POST" class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-lg-2">Nama Keluarga</label>
							<div class="col-lg-8">
								<select name="a" class="form-control select2" style="width:100%" tabindex="2" required>
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
							<label class="control-label col-lg-2">Kartu Jaminan Kesehatan</label>
							<div class="col-lg-8">
								<input type="text" name="f" class="form-control" placeholder="Nama Kartu">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Salib</label>
							<div class="col-lg-8">
								<input type="number" name="b" class="form-control" maxlength="3">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Kitab Suci</label>
							<div class="col-lg-8">
								<input type="number" name="c" class="form-control" maxlength="3">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Buku Doa</label>
							<div class="col-lg-8">
								<input type="number" name="d" class="form-control" maxlength="3">
							</div>
						</div>	
						<div class="form-group">
							<label class="control-label col-lg-2">Rosaria</label>
							<div class="col-lg-8">
								<input type="number" name="e" class="form-control" maxlength="3">
							</div>
						</div>						
						<div class="form-group">
							<div class="col-lg-2"></div>
							<div class="col-lg-8">
								<button type="submit" name="add" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>&nbsp;&nbsp;<a href="?page=Kepemilikan" class="btn btn-primary"><i class="icon-undo"></i> Batal</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>
</div>

