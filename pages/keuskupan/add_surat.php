<?php
if (isset($_GET['tgl'])) {
	$id = $_GET['tgl'];
}
else {
	die ("&nbsp;Error. No Kode Selected! ");
}

$nikah = mysql_fetch_array(mysql_query("SELECT * FROM tb_nikah WHERE tgl_nikah='$id'"));

if(isset($_POST['add'])) {
	mysql_query("INSERT INTO tb_surat_nikah SET id='',id_nikah='$_POST[id]',no_surat='$_POST[no]',buku='$_POST[buku]',tahun='$_POST[tahun]',gereja='$_POST[gereja]',tempat='$_POST[tempat]'");
	echo "<script>location='?page=nikah'</script>";
}
?>

<div class="inner" style="min-height: 1px">
	<div class="row">
		<div class="col-lg-12">
			<h2>Input Data Surat Pernikahan</h2>
		</div>
	</div>
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
					<p class="lead text-center">Surat Pernikahan dari pasangan <strong><?=$nikah['m_pria'];?></strong> dan <strong><?=$nikah['m_wanita'];?></strong>.</p><hr>
					<form action="" method="POST" class="form-horizontal">
						<input type="hidden" name="id" class="form-control" value="<?=$nikah['id'];?>">
						<h4>Keuskupan Agung Merauke</h4>
						<div class="form-group">
							<label class="control-label col-lg-2">Buku</label>
							<div class="col-lg-10">
								<input type="text" name="buku" class="form-control" placeholder="Nama Buku" required autofocus>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Nomor</label>
							<div class="col-lg-10">
								<input type="text" name="no" class="form-control" placeholder="Nomor Buku" required>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Tahun</label>
							<div class="col-lg-10">
								<input type="number" name="tahun" class="form-control" placeholder="Tahun" required>
							</div>
						</div><hr>
						<h4>Kutipan Dari Buku Perkawinan</h4>
						<div class="form-group">
							<label class="control-label col-lg-2">Gereja</label>
							<div class="col-lg-10">
								<input type="text" name="gereja" class="form-control" placeholder="Nama Gereja" required>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Di</label>
							<div class="col-lg-10">
								<input type="text" name="tempat" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2"></div>
							<div class="col-lg-10">
								<button type="submit" name="add" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>&nbsp;&nbsp;<button type="reset" class="btn btn-primary"><i class="icon-refresh"></i> Reset</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>
</div>

