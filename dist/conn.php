<?php
	$op = mysql_connect("localhost","root","");
	if(!$op){
		die("Koneksi ke Engine MySQL Gagal !<br>");
	}
	$conn = mysql_select_db("db_gereja");
	if(!$conn){
		die("Koneksi ke Database Gagal! Database tidak ditemukan.");
	}
?>