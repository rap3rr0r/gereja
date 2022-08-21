<?php
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}
else {
	die ("&nbsp;Error. No Kode Selected! ");
}
$nikah = mysql_fetch_array(mysql_query("SELECT * FROM tb_keuskupan JOIN tb_surat_nikah ON tb_keuskupan.id=tb_surat_nikah.id_nikah WHERE tb_keuskupan.id='$id'"));
$pria = mysql_fetch_array(mysql_query("SELECT * FROM tb_nikah WHERE status='Pria' AND id_nikah='$id'"));
$wanita = mysql_fetch_array(mysql_query("SELECT * FROM tb_nikah WHERE status='Wanita' AND id_nikah='$id'"));
?>

<div class="inner" style="min-height: 1px">
	<div class="row">
		<div class="col-lg-12">
			<h2>Informasi Data Pernikahan</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="box dark">
				<header>
					<div class="icons"><i class="icon-info-sign"></i></div>
					<h5>Profil nikah</h5>
					<div class="toolbar">
						<ul class="nav">
							<li><a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-1"><i class="icon-chevron-up"></i></a></li>
						</ul>
					</div>
				</header>
				<div id="div-1" class="accordion-body collapse in body">
					<div class="panel panel-default">
						<div class="panel-heading text-center">
							<span class="lead">Pernikahan dari pasangan <strong><?=$nikah['m_pria'];?></strong> dan <strong><?=$nikah['m_wanita'];?></strong></span>
						</div>
						<div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab">Home</a>
                                </li>
                                <li><a href="#pria" data-toggle="tab">Mempelai Pria</a>
                                </li>
                                <li><a href="#wanita" data-toggle="tab">Mempelai Wanita</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                            	<div class="tab-pane fade in active" id="home">
									<form class="form-horizontal">
										<div class="form-group">
											<label class="col-lg-3">Di hadapan Imam</label>
											<div class="col-lg-9">
												<p>: <?=$nikah['imam'];?></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-3">Tempat Pernikahan</label>
											<div class="col-lg-9">
												<p>: Gereja <?=$nikah['gereja'];?> - <?=$nikah['tempat'];?></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-3">Tanggal Pernikahan</label>
											<div class="col-lg-9">
												<p>: <?=tgl_indo($nikah['tgl_nikah']);?></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-3">Buku dan Nomor Pemandian</label>
											<div class="col-lg-9">
												<p>: <?=$nikah['buku'];?>, Nomor <?=$nikah['no_surat'];?></p>
											</div>
										</div>
									</form>
								</div>
								<div class="tab-pane fade" id="pria">									
									<form class="form-horizontal">
										<div class="form-group">
											<label class="col-lg-2">Nama Mempelai</label>
											<div class="col-lg-10">
												<p>: <?=$nikah['m_pria'];?></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-2">Nama Ayah</label>
											<div class="col-lg-10">
												<p>: <?=$pria['ayah'];?></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-2">Nama Ibu</label>
											<div class="col-lg-10">
												<p>: <?=$pria['ibu'];?></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-2">T T L</label>
											<div class="col-lg-10">
												<p>: <?=$pria['tmp_lhr'];?>, <?=tgl_indo($pria['tgl_lhr']);?></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-2">Yang Membaptis</label>
											<div class="col-lg-10">
												<p>: <?=$pria['imam'];?></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-2">Wali Baptis 1</label>
											<div class="col-lg-10">
												<p>: <?=$pria['wali1'];?></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-2">Wali Baptis 2</label>
											<div class="col-lg-10">
												<p>: <?=$pria['wali2'];?></p>
											</div>
										</div>
									</form>
								</div>
								<div class="tab-pane fade" id="wanita">
									<form class="form-horizontal">
										<div class="form-group">
											<label class="col-lg-2">Nama Mempelai</label>
											<div class="col-lg-10">
												<p>: <?=$nikah['m_wanita'];?></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-2">Nama Ayah</label>
											<div class="col-lg-10">
												<p>: <?=$wanita['ayah'];?></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-2">Nama Ibu</label>
											<div class="col-lg-10">
												<p>: <?=$wanita['ibu'];?></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-2">T T L</label>
											<div class="col-lg-10">
												<p>: <?=$wanita['tmp_lhr'];?>, <?=tgl_indo($pria['tgl_lhr']);?></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-2">Yang Membaptis</label>
											<div class="col-lg-10">
												<p>: <?=$wanita['imam'];?></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-2">Wali Baptis 1</label>
											<div class="col-lg-10">
												<p>: <?=$wanita['wali1'];?></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-2">Wali Baptis 2</label>
											<div class="col-lg-10">
												<p>: <?=$wanita['wali2'];?></p>
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

	</div>
</div>