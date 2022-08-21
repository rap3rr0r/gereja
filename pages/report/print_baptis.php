<?php
error_reporting();
session_start();
include "../../dist/conn.php";
include "../../dist/libb.php";
$a = mysql_fetch_array(mysql_query("SELECT * FROM tb_nikah WHERE id='$_GET[id]'"));
$b = mysql_fetch_array(mysql_query("SELECT * FROM tb_surat_nikah WHERE id_nikah='$a[id_nikah]'"));
$c = mysql_fetch_array(mysql_query("SELECT * FROM tb_keuskupan WHERE id='$a[id_nikah]'"));
$d = mysql_fetch_array(mysql_query("SELECT * FROM tb_umat JOIN tb_pengurus ON tb_umat.id=tb_pengurus.id_pengurus WHERE tb_umat.id='$_GET[pengurus]'"));
?>
<!DOCTYPE html>
<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Print Surat Baptis</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../../assets/plugins/login/css/report.css">
  <link rel="stylesheet" href="../../assets/css/report.css">
</head>
<body onload="window.print()">
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel-group">
					<div class="panel-body">
						<div class="kotak">
							<table width=100%>
								<tr>
                  					<td width="65%" style="font-size:14pt;font-family:'Times';vertical-align:top;"><b>KEUSKUPAN AGUNG MERAUKE</b></td>
                  					<td width="35%" style="font-size:12pt;font-family:'Century Gothic';">
                  						Kutipan dari Buku Permandian<br>
                  						Paroki <?=$b['gereja'];?><br>
                  						No. <?= $b['no_surat']; ?>
                  					</td>
								</tr>
							</table><br>
							<table width="100%">
								<tr>
									<td rowspan="2" width="25%" class="flip" align="right"><img src="../../assets/img/angel.png" width="75" /></td>
									<td width="50%" align="center" style="vertical-align:bottom;"><p>TELAH DIBAPTIS</p>
									</td>
									<td rowspan="2" width="25%"><img src="../../assets/img/angel.png" width="75" /></td>
								</tr>
								<tr>
									<td align="center" style="font-size:12pt;vertical-align:top;font-family:'Century Gothic';text-transform:uppercase;">
										<?php
										if($a['status'] == 'Pria') {
											echo $c['m_pria'];
										} else {
											echo $c['m_wanita'];;
										}
										?>
									</td>
								</tr>
							</table><br>
							<table width="100%" style="font-size:12pt;font-family:'Century Gothic';">
								<tr>
									<td width="25%">Pada tanggal</td>
									<td>: <?=tgl_indo($a['tgl_baptis']);?>, di Gereja <?=$b['gereja'];?></td>
								</tr>
								<tr>
									<td width="25%">Lahir tanggal</td>
									<td>: <?=tgl_indo($a['tgl_lhr']);?>, di <?=$a['tmp_lhr'];?></td>
								</tr>
								<tr>
									<td width="25%">Anak dari</td>
									<td>: <?=$a['ayah'];?>, dan <?=$a['ibu'];?></td>
								</tr>
								<tr>
									<td width="25%">Wali baptis</td>
									<td>: <?=$a['wali1'];?>, dan <?=$a['wali2'];?></td>
								</tr>
								<tr>
									<td width="25%">Yang membaptis</td>
									<td>: <?=$a['imam'];?></td>
								</tr>
								<tr>
									<td width="25%">Sakramen Krisma tgl</td>
									<td>: <?=tgl_indo($a['tgl_sakramen']);?>, di <?=$a['sakramen'];?></td>
								</tr>
								<tr>
									<td width="25%">Telah menikah dengan</td>
									<td>: 
									<?php
									if($a['status'] == 'Pria') {
										echo $c['m_wanita'];
									} else {
										echo $c['m_pria'];;
									}
									?>, pada tanggal <?=tgl_indo($c['tgl_nikah']);?>
									</td>
								</tr>
								<tr>
									<td width="25%" align="right">di&nbsp;</td>
									<td>: <?=$b['tempat'];?></td>
								</tr>
							</table>
							<table width="100%" style="font-size:12pt;font-family:'Century Gothic';">
								<tr>
									<td width="30%" align="center"><br><br><br><br>......................</td>
									<td width="40%">&nbsp;</td>
									<td width="30%" align="center">Sesuai Aslinya,<br>Pastor Paroki/Wakilnya<br><br><br><?=$d['nama_umat'];?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>