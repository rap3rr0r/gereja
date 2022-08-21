<?php
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}
else {
	die ("&nbsp;Error. No Kode Selected! ");
}
$edit = mysql_fetch_array(mysql_query("SELECT * FROM tb_kepemilikan WHERE id='$id'"));
$editK = mysql_fetch_array(mysql_query("SELECT * FROM tb_keluarga WHERE id='$edit[id_keluarga]'"));

if(isset($_POST['edit'])) {
	mysql_query("UPDATE tb_kepemilikan SET
		k_salib		='$_POST[a]',
		k_kitab		='$_POST[b]',
		k_buku		='$_POST[c]',
		k_rosaria	='$_POST[d]',
		k_jamkes	='$_POST[e]' WHERE id='$_POST[id]'");
	echo "<script>location='?page=kepemilikan'</script>";
}
?>

<div class="inner" style="min-height: 1px">
	<div class="row">
		<div class="col-lg-12">
			<h2>Edit Data Kepemilikan Alat Doa dan Kartu Kesehatan</h2>
		</div>
	</div><hr>
	<div class="row">
		<div class="col-lg-12">
			<div class="box dark">
				<header>
					<div class="icons"><i class="icon-edit"></i></div>
					<h5>Form edit data</h5>
					<div class="toolbar">
						<ul class="nav">
							<li><a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-1"><i class="icon-chevron-up"></i></a></li>
						</ul>
					</div>
				</header>
				<div id="div-1" class="accordion-body collapse in body">
					<form action="" method="POST" class="form-horizontal">
						<input type="hidden" name="id" value="<?=$edit['id'];?>">
						<div class="form-group">
							<label class="control-label col-lg-2">Nama Keluarga</label>
							<div class="col-lg-8">
								<input type="text" class="form-control" value="<?=$editK['nama_keluarga'];?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Kartu Jaminan Kesehatan</label>
							<div class="col-lg-8">
								<input type="text" name="e" class="form-control" value="<?=$edit['k_jamkes'];?>" placeholder="Nama Kartu">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Salib</label>
							<div class="col-lg-8">
								<input type="number" name="a" class="form-control" value="<?=$edit['k_salib'];?>" maxlength="3">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Kitab Suci</label>
							<div class="col-lg-8">
								<input type="number" name="b" class="form-control" value="<?=$edit['k_kitab'];?>" maxlength="3">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Buku-buku Doa</label>
							<div class="col-lg-8">
								<input type="number" name="c" class="form-control" value="<?=$edit['k_buku'];?>" maxlength="3">
							</div>
						</div>	
						<div class="form-group">
							<label class="control-label col-lg-2">Rosaria</label>
							<div class="col-lg-8">
								<input type="number" name="d" class="form-control" value="<?=$edit['k_rosaria'];?>" maxlength="3">
							</div>
						</div>						
						<div class="form-group">
							<div class="col-lg-2"></div>
							<div class="col-lg-8">
								<button type="submit" name="edit" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>&nbsp;&nbsp;<a href="?page=kepemilikan" class="btn btn-primary"><i class="icon-undo"></i> Batal</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>
</div>

