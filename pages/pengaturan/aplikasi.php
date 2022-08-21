<?php
if(isset($_POST['update'])) {
	$foto = $_FILES['upPhoto']['name'];
	$tmp  = $_FILES['upPhoto']['tmp_name'];
	$newfoto = "logo-" . $foto;
	$path = "assets/img/" . $newfoto;
	$pass = md5($_POST['password']);
	if($user['password'] == $pass) {
		if(move_uploaded_file($tmp, $path)) {
			if(is_file("assets/img/".$app['logo']))
				unlink("assets/img/".$app['logo']);
			mysql_query("UPDATE tb_app SET nama='$_POST[nama]', logo='$newfoto' WHERE id='$_POST[id]'");
			echo "<script>location='?page=aplikasi'</script>";
		} else {
			mysql_query("UPDATE tb_app SET nama='$_POST[nama]' WHERE id='$_POST[id]'");
			echo "<script>location='?page=aplikasi'</script>";
		}
	} else {
		echo "<script>window.alert('Maaf, kata sandi Anda salah!');
		location=('?page=aplikasi')</script>";
	}
}
?>

<div class="inner" style="min-height: 1px">
	<div class="row">
		<div class="col-lg-12">
			<h2>Pengaturan Aplikasi</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="box dark">
				<header>
					<div class="icons"><i class="icon-th-large"></i></div>
					<h5>Form edit data</h5>
					<div class="toolbar">
						<ul class="nav">
							<li><a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-1"><i class="icon-chevron-up"></i></a></li>
						</ul>
					</div>
				</header>
				<div id="div-1" class="accordion-body collapse in body">
					<form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?=$app['id'];?>">
						<div class="form-group">
							<label class="control-label col-lg-2">Nama Aplikasi</label>
							<div class="col-lg-6">
								<textarea name="nama" class="form-control" maxlength="64" autofocus required><?=$app['nama'];?></textarea>
							</div>
						</div>
						<div class="form-group">
	                        <label class="control-label col-lg-2">Logo</label>
	                        <div class="col-lg-6">
	                            <div class="fileupload fileupload-new" data-provides="fileupload">
	                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
	                                	<?php if($app['logo']=="") { ?>
	                                			<img src="assets/img/default.png" />
	                                		<?php } else { ?>
	                                			<img src="assets/img/<?=$app['logo'];?>" />
	                                	<?php } ?></div>
	                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
	                                <div>
	                                    <span class="btn btn-file btn-primary"><span class="fileupload-new">Pilih Logo</span><span class="fileupload-exists">Ganti</span><input type="file" accept=".jpg, .jpeg, .png" name="upPhoto" /></span>
	                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Hapus</a>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
						<div class="form-group">
							<label class="control-label col-lg-2">Masukkan kata sandi</label>
							<div class="col-lg-6">
								<input type="password" name="password" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-6 col-lg-offset-2">
								<button type="submit" name="update" class="btn btn-primary"><i class="icon-save"></i> Update</button>&nbsp;&nbsp;<button type="reset" class="btn btn-default"><i class="icon-refresh"></i> Reset</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>
</div>