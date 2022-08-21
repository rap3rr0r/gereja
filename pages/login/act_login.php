<?php
include "../../dist/conn.php";
$username	= mysql_real_escape_string($_POST['username']);
$password	= md5($_POST['password']);

$sql = mysql_query("SELECT * FROM tb_user WHERE username='$username' AND password='$password'");
if(mysql_num_rows($sql) > 0){
	$qry = mysql_fetch_array($sql);
	session_start();
	$_SESSION['id']			= $qry['id'];
	$_SESSION['username']   = $qry['username'];
	$_SESSION['hak_akses']  = $qry['hak_akses'];
	
	if($qry['aktif']=="N"){
    echo "<div class='register-logo'><b>Oops!</b> Akun Belum Aktif.</div>	
		<div class='register-box-body'>
			<p class='lead' align='justify'>Saat ini Kami masih memproses data Anda, mohon bersabar.<br /><strong>Terima Kasih.</strong></p>
			<div class='row'>
				<div class='col-xs-8'></div>
				<div class='col-xs-4'>
					<button type='button' onclick=location.href='./' class='btn btn-block btn-warning'>Back</button>
				</div>
			</div>
		</div>";
	}
	else if($qry['hak_akses']=="1"){
		header("location:../../home.php");
	}
	else if($qry['hak_akses']=="Fakultas"){
		header("location:home-fakultas.php");
	}
	else if($qry['hak_akses']=="Dosen"){
		header("location:home-dosen.php");
	}
}
else{
	echo "<script>window.alert('Maaf, username atau password salah!');
               location=('../../')</script>";
}
?>