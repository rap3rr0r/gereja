<?php
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}
else {
	die ("&nbsp;Error. No Kode Selected! ");
}
$view = mysql_fetch_array(mysql_query("SELECT * FROM tb_kepemilikan WHERE id='$id'"));
$viewK = mysql_fetch_array(mysql_query("SELECT * FROM tb_keluarga WHERE id='$view[id_keluarga]'"));
?>

<div class="inner" style="min-height: 1px">
	<div class="row">
		<div class="col-lg-12">
			<h2>Informasi Kepemilikan Alat Doa dan Kartu Jaminan Kesehatan</h2>
		</div>
	</div><hr>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<span class="lead"><strong> Keluarga <?=$viewK['nama_keluarga'];?></strong></span>
				</div>
				<div class="panel-body">
                    <div class="tab-content">
							<form class="form-horizontal">
								<div class="form-group">
									<div class="col-lg-12">
										<table>
											<tbody>
												<tr><th scope="row"><p>Nama Kartu jaminan Kesehatan</p></th><th class="text-danger"><p>: <?php if($view['k_jamkes']==''){echo"--";}else{echo"$view[k_jamkes]";}?></p></th></tr>
												<tr><th scope="row"><p>Salib</p></th><td class='text-uppercase'><p>: <?php if($view['k_salib']=='0'){echo"--";}else{echo"$view[k_salib] buah";}?></p></td></tr>
												<tr><th scope="row"><p>Kitab Suci</p></th><td><p>: <?php if($view['k_kitab']=='0'){echo"--";}else{echo"$view[k_kitab] buah";}?></p></td></tr>
												<tr><th scope="row"><p>Buku-buku Doa</p></th><td><p>: <?php if($view['k_buku']=='0'){echo"--";}else{echo"$view[k_buku] buah";}?></p></td></tr>
												<tr><th scope="row"><p>Rosaria</p></th><td><p>: <?php if($view['k_rosaria']=='0'){echo"--";}else{echo"$view[k_rosaria] buah";}?></p></td></tr>
											</tbody>
										</table>
									</div>
								</div>
							</form>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>