<?php
if(isset($_POST['update'])) {
	$foto = $_FILES['upPhoto']['name'];
	$tmp  = $_FILES['upPhoto']['tmp_name'];
	$newfoto = "admin-" . $foto;
	$path = "assets/img/" . $newfoto;
	$passw = md5($_POST['password']);
	$pass  = md5($_POST['password2']);
	if($user['password'] == $passw) {
		if(!empty($_POST['password2'])) {
			mysql_query("UPDATE tb_user SET password='$pass' WHERE id='$_POST[id]'");
		}
		if(move_uploaded_file($tmp, $path)) {
			if(is_file("assets/img/".$user['avatar']))
				unlink("assets/img/".$user['avatar']);
			mysql_query("UPDATE tb_user SET avatar='$newfoto' WHERE id='$_POST[id]'");
		}
		mysql_query("UPDATE tb_user SET username='$_POST[nama]' WHERE id='$_POST[id]'");
		echo "<script>location='?page=profil'</script>";
	} else {
		echo "<script>window.alert('Maaf, password Anda salah!');
		location=('?page=profil')</script>";
	}
}
?>

<div class="inner" style="min-height: 1px">
	<div class="row">
		<div class="col-lg-12">
			<h2>Pengaturan Profil</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="box dark">
				<header>
					<div class="icons"><i class="icon-th-large"></i></div>
					<h5>Form edit profil</h5>
					<div class="toolbar">
						<ul class="nav">
							<li><a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-1"><i class="icon-chevron-up"></i></a></li>
						</ul>
					</div>
				</header>
				<div id="div-1" class="accordion-body collapse in body">
					<form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?=$user['id'];?>">
						<div class="form-group">
							<label for="username" class="control-label col-lg-2">Username</label>
							<div class="col-lg-8">
								<input type="text" name="nama" id="username" class="form-control" value="<?=$user['username'];?>" autocomplete="username">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Password Lama</label>
							<div class="col-lg-8">
								<input type="password" name="password" class="form-control" autofocus required>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Password Baru</label>
							<div class="col-lg-8">
								<input type="password" name="password2" class="form-control">
								<i class="small">Kosongkan jika tidak diganti</i>
							</div>
						</div>
						<div class="form-group">
	                        <label class="control-label col-lg-2">Foto</label>
	                        <div class="col-lg-8">
	                            <div class="fileupload fileupload-new" data-provides="fileupload">
	                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
	                                	<?php if($user['avatar']=="") { ?>
	                                			<img src="assets/img/default.png" />
	                                		<?php } else { ?>
	                                			<img src="assets/img/<?=$user['avatar'];?>" />
	                                	<?php } ?></div>
	                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
	                                <div>
	                                    <span class="btn btn-file btn-primary"><span class="fileupload-new">Pilih Gambar</span><span class="fileupload-exists">Ganti</span><input type="file" accept=".jpg, .jpeg, .png, .gif" name="upPhoto" /></span>
	                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Hapus</a>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
						<div class="form-group">
							<div class="col-lg-8 col-lg-offset-2">
								<button type="submit" name="update" class="btn btn-primary"><i class="icon-save"></i> Edit</button>&nbsp;&nbsp;<button type="reset" class="btn btn-default"><i class="icon-refresh"></i> Reset</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>
</div>