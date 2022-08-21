<?php
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}
else {
	die ("&nbsp;Error. No Kode Selected! ");
}
$view = mysql_fetch_array(mysql_query("SELECT * FROM tb_umat JOIN tb_keluarga ON tb_umat.id_keluarga=tb_keluarga.id JOIN tb_hubungan ON tb_umat.id_hubungan=tb_hubungan.id JOIN tb_status ON tb_umat.id_pernikahan=tb_status.id WHERE tb_umat.id='$id'"));
$pen = mysql_fetch_array(mysql_query("SELECT * FROM tb_pendidikan WHERE id='$view[pendidikan]'"));
$ag = mysql_fetch_array(mysql_query("SELECT * FROM tb_agama WHERE id='$view[agama]'"));
$alamat = mysql_fetch_array(mysql_query("SELECT * FROM tb_alamat WHERE id_umat='$id'"));
$ortu = mysql_fetch_array(mysql_query("SELECT * FROM tb_ortu WHERE id_umat='$id'"));
$birthday = new DateTime($view['tgl_lhr']);
$today = new DateTime();
$umur = $today->diff($birthday);
?>

<div class="inner" style="min-height: 1px">
	<div class="row">
		<div class="col-lg-12">
			<h2>Informasi Data Umat</h2>
		</div>
	</div><hr>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<span class="lead"><strong><?=$view['nama_umat'];?></strong></span>
				</div>
				<div class="panel-body">
					<ul class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab">Home</a>
                        </li>
                        <li><a href="#alamat" data-toggle="tab">Alamat Lengkap</a>
                        </li>
                        <li><a href="#ortu" data-toggle="tab">Orang Tua</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                    	<div class="tab-pane fade in active" id="home">
							<form class="form-horizontal">
								<div class="form-group">
									<div class="col-lg-3">
										<?php
										if(empty($view['avatar'])) { ?>
											<img src="assets/img/default.png" class="media-object img-thumbnail user-img" width="150" height="180" />
										<?php } else { ?>
											<a href="assets/img/umat/<?=$view['avatar'];?>" target="_blank"><img src="assets/img/umat/<?=$view['avatar'];?>" class="media-object img-thumbnail user-img" width="150" height="180" /></a>
										<?php } ?><br>
									</div>
									<div class="col-lg-9">
										<table>
											<tbody>
												<tr><th scope="row"><p>N I K</p></th><th class="text-danger"><p><i class="icon-key"></i> <?=$view['nik_umat'];?></p></th></tr>
												<tr><th scope="row"><p>Nama Lengkap</p></th><td class='text-uppercase'><p><i class="icon-user"></i> <?=$view['nama_umat'];?></p></td></tr>
												<tr><th scope="row"><p>Jenis Kelamin</p></th><td><p><i class="fa fa-intersex"></i> <?php if($view['jk']=='L'){echo"Laki-laki";}else{echo"Perempuan";}?></p></td></tr>
												<tr><th scope="row"><p>Agama</p></th><td><p><i class="fa fa-bell"></i> <?=$ag['nama_agama'];?></p></td></tr>
												<tr><th scope="row"><p>Tempat Tanggal Lahir&nbsp;</p></th><td><p><i class="icon-calendar"></i> <?=$view['tmp_lhr'];?>, <?=tgl_indo($view['tgl_lhr']);?></p></td></tr>
												<tr><th scope="row"><p>Umur</p></th><td><p><i class="icon-tag"></i> <?php echo $umur->y." Tahun, ".$umur->m." Bulan, ".$umur->d." Hari";?></p></td></tr>
												<tr><th scope="row"><p>Nama Keluarga</p></th><td><p><i class="icon-group"></i> <a href="?page=lihat-keluarga&id=<?=$view['id_keluarga'];?>"><?=$view['nama_keluarga'];?></a></p></td></tr>
												<tr><th scope="row"><p>Status Keluarga</p></th><td><p><i class="fa fa-child"></i> <?=$view['nama_hubungan'];?></p></td></tr>
												<tr><th scope="row"><p>Status Nikah</p></th><td><p><i class="fa fa-venus-mars"></i> <?=$view['nama_status'];?></p></td></tr>
												<tr><th scope="row"><p>Pendidikan</p></th><td><p><i class="fa fa-graduation-cap"></i> <?=$pen['nama_pendidikan'];?></p></td></tr>
												<tr><th scope="row"><p>Pekerjaan</p></th><td><p><i class="fa fa-briefcase"></i> <?=$view['pekerjaan'];?></p></td></tr>
												<tr><th scope="row"><p>Kewarganegaraan</p></th><td><p><i class="fa fa-flag-o"></i> <?=$view['negara'];?></p></td></tr>
												<tr><th scope="row"><p>Telp</p></th><td><p><i class="fa fa-whatsapp"></i> <?=$view['telp_umat'];?></p></td></tr>
											</tbody>
										</table>
									</div>
								</div>
							</form>
						</div>
						<div class="tab-pane fade" id="alamat">
							<table>
								<tbody>
									<tr><th scope="row"><p>Alamat</p></th><th><p>: <?=$alamat['jln'];?></p></th></tr>
									<tr><th scope="row"><p>RT/RW</p></th><td><p>: <?=$alamat['rtrw'];?></p></td></tr>
									<tr><th scope="row"><p>Desa/Kelurahan</p></th><td><p>: <?=$alamat['desa'];?></p></td></tr>
									<tr><th scope="row"><p>Kecamatan</p></th><td><p>: <?=$alamat['kec'];?></p></td></tr>
									<tr><th scope="row"><p>Kabupaten/Kota&nbsp;</p></th><td><p>: <?=$alamat['kota'];?></p></td></tr>
									<tr><th scope="row"><p>Kode Pos</p></th><td><p>: <?=$alamat['kode'];?></p></td></tr>
									<tr><th scope="row"><p>Provinsi</p></th><td><p>: <?=$alamat['prov'];?></p></td></tr>
								</tbody>
							</table>
						</div>
						<div class="tab-pane fade" id="ortu">
							<table>
								<tbody>
									<tr><th scope="row"><p>Nama Ayah</p></th><td><p>: <?=$ortu['nama_ayah'];?></p></td></tr>
									<tr><th scope="row"><p>Nama ibu</p></th><td><p>: <?=$ortu['nama_ibu'];?></p></td></tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>